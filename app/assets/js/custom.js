/** =========================
 * DEFAULT ON LOAD FUNCTION
 * ========================= */
$(function () {

  // Prevent all forms from refreshing the page
  $("form").on("submit", function (e) {
    e.preventDefault();
  });

  // Initialize autocomplete for product search inputs
  $('input.product_search').each(function (i, el) {

    var $el = $(el);
    $el.autocomplete({
      
      // Fetch data from server
      source: function (request, response) {

        // Abort previous request (prevent multiple firing)
        if ($el.data('xhr')) {
          $el.data('xhr').abort();
        }

        // Prepare payload
        let q = prepare_form_data(0, true);
        q['keyword'] = request.term;
        let json = JSON.stringify(q);

        // Send AJAX request
        var xhr = $.ajax({
          url: server_url + 'ics/api/engine/product_search.php',
          type: 'POST',
          dataType: 'json',
          data: { json: json },

          success: function (res) {

            var aca = [];

            // Map result to autocomplete format
            $.each(res.result, function (i, item) {

              var temp = "";
              temp += "<div class='product-result-item' style='font-family:\"Poppins\",sans-serif;padding:4px 0;'>";
              temp += "<div style='font-size:10px;text-transform:uppercase;color:#E66239;font-weight:600;line-height:1.2;'>";
              temp += "SKU: " + (item.sku || 'N/A');
              temp += "</div>";
              temp += "<div style='font-size:13px;font-weight:500;color:#171717;margin-top:2px;'>";
              temp += item.product_name;
              temp += "</div>";
              temp += "</div>";

              aca.push({
                label: temp,                 // HTML dropdown
                value: item.product_name,    // Default value
                data: item                  // Full object
              });

            });

            response(aca);
          }
        });

        // Save request reference
        $el.data('xhr', xhr);
      },

      minLength: 0,
      delay: 300,

      // When selecting item
      select: function (e, ui) {

        if (ui.item && ui.item.data) {

          var product = ui.item.data;

          // Replace input value with SKU
          $(this)
            .val(product.sku)
            .attr("secondary", product.id);

          console.log("Input updated with SKU:", product.sku);

          return false; // Prevent overwrite by default value
        }
      }

    })

      // Allow HTML rendering in dropdown
      .data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li>")
          .append($("<div>").html(item.label))
          .appendTo(ul);
      };

  });

});


/** =========================
 * PREPARE FORM DATA
 * ========================= */
function prepare_form_data(check_required, raw_data) {

  var q = {};

  // Get session context
  const session_element = document.getElementById('session-context');

  if (session_element) {
    q['company_id'] = session_element.dataset.companyId;
    q['otp'] = session_element.dataset.otp;
  }

  // Include GET parameters
  const url_params = new URLSearchParams(window.location.search);
  url_params.forEach((value, key) => {
    q[key] = value;
  });

  // Collect form inputs
  $(".form-control, .form-select").each(function () {
    if (!$(this).attr("id")) return true;
    q[$(this).attr("id")] = $(this).val();
  });

  // Validate required fields
  if (check_required === 1) {

    const required_inputs = document.querySelectorAll('[required]');
    let is_valid = true;

    required_inputs.forEach(input => {
      if (!input.value.trim()) {
        input.classList.add('is-invalid');
        is_valid = false;
      } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
      }
    });

    if (!is_valid) {
      alert("Please fill in all mandatory fields.");
      return false;
    }
  }

  return (raw_data) ? q : JSON.stringify(q);
}


/** =========================
 * AJAX WRAPPER
 * ========================= */

// Prevent double firing
let isAjaxProcessing = false;

function ajax_request(options) {

  if (isAjaxProcessing) {
    // Instead of rejecting, we just return a "never-ending" promise 
    // or a resolved promise that does nothing.
    console.warn("Request is busy... ignoring click.");
    return new Promise(() => { }); // This stays pending and won't trigger .then or .catch
  }

  isAjaxProcessing = true;

  // Auto prepare form data
  if (options.autoPrepare === true) {

    let payloadJson = prepare_form_data(options.checkRequired ?? 0, true);
    if (payloadJson === false) {
      return Promise.reject("validation_failed");
    }
    
    if(options.data){
      Object.entries(options.data).forEach(([key, value]) => {
        payloadJson[key] = value;
      });
    }

    if(options.action){
      // modify action
      if(options.action === 'manage'){
        options.action = (payloadJson['id'])?'update':'create';
      }
      // add action to JSON
      payloadJson['action'] = options.action;
    }else{
      return Promise.reject("please_define_action");
    }

    options.data = { json: JSON.stringify(payloadJson) };

    // IF formData exist, we pass as $_POST [not json]
    if (options.formData instanceof FormData) {
      // THE BYPASS: If formData exists, move all text data into it
      Object.entries(payloadJson).forEach(([key, value]) => {
        options.formData.append(key, value);
      });
      // Override options.data with the full FormData object
      options.data = options.formData;
    }
  }

  // --- START MODIFIED $.AJAX BLOCK ---
  let isSendingFiles = (options.data instanceof FormData);

  if (options.debugMode) {
    console.log("REQUEST DATA:", options.data);
  }

  // Show loading overlay
  if (options.noLoading !== true) {
    $.LoadingOverlay("show", {
      imageColor: "#525252",
      imageAnimation: "2s rotate_right",
      background: "rgba(255,255,255,0.8)"
    });
  }

  return $.ajax({
    async: true,
    type: options.type || "POST",
    url: options.url,
    data: options.data,
    dataType: "json",
    // These two settings are only triggered when sending files
    processData: isSendingFiles ? false : true,
    contentType: isSendingFiles ? false : "application/x-www-form-urlencoded; charset=UTF-8"
  })
  .then(function (res) {

    isAjaxProcessing = false;
    if (options.noLoading !== true) $.LoadingOverlay("hide");

    if (options.debugMode) {
      console.log("RESPONSE:", res);
      return res;
    }

    if (!res || res.success != 1) {
      bootbox.alert(res?.message || "Unexpected error");
      throw new Error(res?.message || "api_failed");
    }

    options.onSuccess?.(res);
    return res;

  })
  .catch(function (xhr) {

    isAjaxProcessing = false;
    $.LoadingOverlay("hide");

    if (xhr instanceof Error) {
      throw xhr;
    }

    console.error("AJAX Error:", xhr?.responseText);
    bootbox.alert("Server error occurred.");
    throw xhr;
  });
}


/** =========================
 * GENERATE PAGINATION
 * ========================= */
function generate_pagination(table_id, total_records, records_per_page, current_page = 1) {
  records_per_page = records_per_page ?? prop_limit;
  const total_pages = Math.ceil(total_records / records_per_page);

  // 1. Find the table and thead
  const table = document.getElementById(table_id);
  let theme_class = '';

  if (table) {
    const thead = table.querySelector('thead');
    if (thead) {
      // 2. Look through classes for one that starts with "table-"
      const bootstrap_theme = Array.from(thead.classList).find(c => c.startsWith('table-'));

      if (bootstrap_theme) {
        // 3. Convert "table-secondary" to "page-item-secondary"
        theme_class = bootstrap_theme.replace('table-', 'page-item-');
      }
    }
  }

  let pagination_html = `
    <tr>
      <td class="border-bottom-0">
        <span class="text-muted">Showing ${records_per_page} per page</span><br>
        <strong>Total: ${total_records}</strong>
      </td>
      <td colspan="9" class="border-bottom-0">
        <nav aria-label="Page navigation" class="d-flex justify-content-end">
          <ul class="pagination mb-0">`;

  for (let i = 1; i <= total_pages; i++) {
    // Check if 'i' matches the current_page passed to the function
    let active_class = (i === current_page) ? 'active' : '';

    pagination_html += `
      <li class="page-item ${theme_class} ${active_class}" data-page="${i}">
        <a class="page-link" href="javascript:;" onclick="handlePageClick('${table_id}', this, ${i})">${i}</a>
      </li>`;
  }

  pagination_html += `</ul></nav></td></tr>`;
  return pagination_html;
}


function handlePageClick(table_id, element, pageNumber) {
  // 1. Remove 'active' class from all siblings within this specific pagination bar
  const paginationUl = element.closest('.pagination');
  paginationUl.querySelectorAll('.page-item').forEach(li => {
    li.classList.remove('active');
  });

  // 2. Add 'active' class to the clicked parent <li>
  element.parentElement.classList.add('active');

  // 3. Define the dynamic function name
  const dynamicFunctionName = `change_page_${table_id}`;

  // 4. Check if the specific dynamic function exists and call it
  if (typeof window[dynamicFunctionName] === "function") {
    window[dynamicFunctionName](pageNumber);
  } else {
    console.error(`Function ${dynamicFunctionName} not found!`);
  }
}


/** =========================
 * FLATPICKR INITIALIZE
 * ========================= */
flatpickr(".flatpickr", {
  enableTime: true,
  time_24hr: true,
  defaultDate: new Date(),
  altInput: true,
  altFormat: "d/m/Y H:i:s",
  dateFormat: "Y-m-d H:i:s"
});


/** =========================
 * REAL-TIME REQUIRED VALIDATION
 * ========================= */
document.addEventListener('DOMContentLoaded', () => {

  const required_inputs = document.querySelectorAll('[required]');

  required_inputs.forEach(input => {
    input.addEventListener('input', function () {
      if (this.value.trim() !== "") {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
      } else {
        this.classList.remove('is-valid');
        this.classList.add('is-invalid');
      }
    });
  });

});

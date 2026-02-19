<?php 
  session_start();
  require '../config.php';
  require '../include_header.php';

?>

<body>
  <?php require '../include_topbar.php';?>
  <?php require '../include_sidebar.php';?>


  <!-- MAIN CONTENT -->
  <main id="content" class="content py-15">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
            <div class="">
              <h1 class="fs-3 mb-1">Contact</h1>
              <p class="mb-0">Manage your contact</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-5 mb-5">
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card">
            <div class="card-body p-6">
              <div class="d-flex align-items-start gap-3">
                <div class="icon-shape icon-lg bg-primary bg-opacity-10 text-primary rounded-2">
                  <i class="ti ti-category fs-4 "></i>
                </div>
                <div class="">
                  <span>Total Categories</span>
                  <h2 class="fw-bold mb-0">6</h2>
                </div>

              </div>

            </div>

          </div>

        </div>
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card">
            <div class="card-body p-6">
              <div class="d-flex align-items-start gap-3">
                <div class="icon-shape icon-lg bg-info bg-opacity-10 text-info rounded-2">
                  <i class="ti ti-check fs-4 "></i>
                </div>
                <div class="">
                  <span>Active</span>
                  <h2 class="fw-bold mb-0">5</h2>
                </div>

              </div>

            </div>

          </div>

        </div>
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card">
            <div class="card-body p-6">
              <div class="d-flex align-items-start gap-3">
                <div class="icon-shape icon-lg bg-warning bg-opacity-10 text-warning rounded-2">
                  <i class="ti ti-x fs-4 "></i>
                </div>
                <div class="">
                  <span>Inactive</span>
                  <h2 class="fw-bold mb-0">1</h2>
                </div>

              </div>

            </div>

          </div>

        </div>
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card">
            <div class="card-body p-6">
              <div class="d-flex align-items-start gap-3">
                <div class="icon-shape icon-lg bg-warning bg-opacity-10 text-warning rounded-2">
                  <i class="ti ti-box-seam fs-4 "></i>
                </div>
                <div class="">
                  <span>Total Products</span>
                  <h2 class="fw-bold mb-0">356</h2>
                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

      <ul class="nav nav-pills mb-3 bg-light p-2 rounded-2 d-inline-flex" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-contact_type-tab" data-bs-toggle="pill"
            data-bs-target="#pills-contact_type" type="button" role="tab" aria-controls="pills-contact_type"
            aria-selected="true">Contact Type</button>
        </li>
        <li class="nav-item nav-item-secondary" role="presentation">
          <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
            type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contacts</button>
        </li>
      </ul>

      <div class="row g-5 mb-5 tab-pane fade show active" id="pills-contact_type" role="tabpanel"
        aria-labelledby="pills-contact_type-tab">
        <div class="col-12">
          <div class="card overflow-hidden">
            <div class="card-body p-6">

              <div class="mb-6 d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="mb-1 fs-4">Contact Types</h3>
                  <p class="mb-0">List of all Type of Contact</p>
                </div>
                <div>
                  <a href="<?php echo $server_url?>contact/manage_contact_type.php" class="btn btn-primary">
                    <span class="me-1"><i class="ti ti-plus"></i></span>
                    <span>Add Contact Type</span></a>
                </div>
              </div>

              <div class="col-lg-12 mb-5">
                <div class="position-relative">
                  <input type="search" class="form-control ps-9" placeholder="Search by product name or SKU">
                  <span class="position-absolute top-25 ms-4">
                    <i class="ti ti-search text-muted"></i>

                  </span>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table mb-0 text-nowrap table-hover table-centered" id="contact_type">
                  <thead class="table-primary border-light">
                    <tr>
                      <th>Contact Type</th>
                      <th>Description</th>
                      <th>Contact</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  <tbody>

                  </tbody>
                  <tfoot class="">

                  </tfoot>
                </table>

              </div>
            </div>
          </div>
        </div>


      </div>

      <div class="row g-5 mb-5 tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-5">
              <div class="mb-6 d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="mb-1 fs-4">Contacts</h3>
                  <p class="mb-0">List of all contact list</p>
                </div>
                <div>
                  <a href="<?php echo $server_url?>contact/manage_contact.php" class="btn btn-secondary">
                    <span class="me-1"><i class="ti ti-plus"></i></span>
                    <span>Add Contact</span></a>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-hover mb-0 table-centered" id="product">
                  <thead class="table-secondary border-light">
                    <tr>
                      <th>Product</th>
                      <th>SKU</th>
                      <th>Current Stock</th>
                      <th>Min Stock</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot class="">

                  </tfoot>
                </table>
              </div>
            </div>

          </div>

        </div>

      </div>

  </main>

  <?php require "../include_ending.php";?>

  <script>
  function retrieve_contact_type() {

    return ajax_request({
      url: "<?php echo $server_url?>contact/api/engine/contact_type.php",
      autoPrepare: true,
      checkRequired: 0,
      debugMode: 0,
      action: 'read',
      onSuccess: function(res) {

        // Register the array as a table name
        alasql('CREATE TABLE IF NOT EXISTS contact_type');
        alasql.tables.contact_type.data = res.output || [];

        var total_records = alasql.tables.contact_type.data.length;

        var table_id = 'contact_type';

        var page = generate_pagination(table_id,total_records);
        $(`table#${table_id} tfoot`).html(page);

        // dynamic function name
        if (typeof window[`change_page_${table_id}`] === "function") {
          window[`change_page_${table_id}`](1);
        } else {
          console.error(`Function change_page_${table_id} does not exist.`);
        }
      }
    });

  }


  function change_page_contact_type(page_num) {

    var offset = (page_num - 1) * prop_limit;

    var page_data = alasql(`SELECT * FROM contact_type LIMIT ${prop_limit} OFFSET ${offset}`);
  
    var body = ``;
    $.each(page_data, function(key, item) {
      body += `<tr>
            <td class="py-3">${item['contact_type']}</td>
            <td class="py-3">${item['description']}</td>
            <td class="py-3">${item['status']}</td>
            <td class="py-3">
              ${(item['status'])?'<span class="badge bg-success">Active</span>':'<span class="badge bg-secondary">Inactive</span>'}
            </td>
            <td class="py-3">
              <a href="<?php echo $server_url?>contact/manage_contact_type.php?id=${item['id']}" class=""><i class="ti ti-eye fs-5"></i></a>
              <a href="#" class="link-danger"><i class="ti ti-trash ms-2 fs-5"></i></a>
            </td>
          </tr>`;
    })

    $("table#contact_type > tbody").html(body);

  }


  
  function retrieve_product() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/product.php",
      autoPrepare: true,
      checkRequired: 0,
      onSuccess: function(res) {

        // Register the array as a table name
        alasql('CREATE TABLE IF NOT EXISTS product');
        alasql.tables.product.data = res.output || [];

        var total_records = alasql.tables.product.data.length;

        var table_id = 'product';

        var page = generate_pagination(table_id,total_records);
        $(`table#${table_id} tfoot`).html(page);

        // dynamic function name
        if (typeof window[`change_page_${table_id}`] === "function") {
          window[`change_page_${table_id}`](1);
        } else {
          console.error(`Function change_page_${table_id} does not exist.`);
        }
      }
    });

  }


  function change_page_product(page_num) {

    var offset = (page_num - 1) * prop_limit;

    var page_data = alasql(`SELECT * FROM product LIMIT ${prop_limit} OFFSET ${offset}`);

    var body = ``;
    $.each(page_data, function(key, item) {
      body += `<tr>
            <td class="py-3">${item['product_name']}</td>
            <td class="py-3">${item['sku']}</td>
            <td class="py-3">${item['description']}</td>
            <td class="py-3">${item['status']}</td>
            <td class="py-3">
              ${(item['status'])?'<span class="badge bg-success">Active</span>':'<span class="badge bg-secondary">Inactive</span>'}
            </td>
            <td class="py-3">
              <a href="<?php echo $server_url?>inventory/manage_product.php?id=${item['id']}" class=""><i class="ti ti-eye fs-5"></i></a>
              <a href="#" class="link-danger"><i class="ti ti-trash ms-2 fs-5"></i></a>
            </td>
          </tr>`;
    })

    $("table#product > tbody").html(body);

  }

  $(async function() {
    try {
      await retrieve_contact_type();
      // await retrieve_product();
    } catch (e) {
      console.log(e);
    }
  });

  $(document).ready(function() {
    // switching to nav-link from last leave
    $('button.nav-link').on('click', function() {
      nav_id = $(this).attr('id');
      sessionStorage.setItem("contact_nav_id", nav_id);
    })
    let nav_id = sessionStorage.getItem("contact_nav_id");
    if(nav_id){
      $(`button#${nav_id}`).trigger('click');
    }
  })
  </script>


</body>

</html>
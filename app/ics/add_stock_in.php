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
      <div class="row ">
        <div class="col-12">
          <div class="mb-6">
            <h1 class="fs-3 mb-0">Stock In</h1>

          </div>
        </div>
      </div>
      <div class="row g">
        <div class="col-lg-8 col-12">
          <div class="card">
            <div class="card-body p-5">
              <h2 class="fs-5 mb-4">Add Stock</h2>
              <form class="row gx-5">
                <!-- Product Name -->
                <div class="mb-3 col-lg-6">
                  <label for="product_sku" class="form-label">Product</label>
                  <input type="text" id="product_sku" class="form-control product_search"
                    placeholder="Type product name..." autocomplete="off">
                </div>

                <!-- SKU or Product Code -->
                <div class="mb-3 col-lg-6">
                  <label for="quantity" class="form-label">Quantity</label>
                  <input type="number" class="form-control" id="quantity" placeholder="Enter quantity">
                </div>



                <!-- Warehouse -->
                <div class="mb-3 col-lg-6">
                  <label for="warehouse" class="form-label">Warehouse</label>
                  <select name="warehouse" id="warehouse" class="form-select"></select>
                </div>

                <div class="mb-3 col-lg-6">
                  <label for="zone" class="form-label">Zone</label>
                  <select name="zone" id="zone" class="form-select">
                    <option value="">Please select zone</option>
                  </select>
                </div>

                <div class="mb-3 col-lg-6">
                  <label for="aisle" class="form-label">Aisle</label>
                  <select name="aisle" id="aisle" class="form-select">
                    <option value="">Please select aisle</option>
                  </select>
                </div>

                <div class="mb-3 col-lg-6">
                  <label for="rack" class="form-label">Rack</label>
                  <select name="rack" id="rack" class="form-select">
                    <option value="">Please select rack</option>
                  </select>
                </div>

                <!-- Contact -->
                <div class="mb-3 col-lg-6">
                  <label for="contact" class="form-label">Contact</label>
                  <input type="text" class="form-control" id="contact" placeholder="Enter contact name">
                </div>


                <!-- Notes / Description -->
                <div class="mb-3 col-lg-12">
                  <label for="notes" class="form-label">Notes / Description</label>
                  <textarea class="form-control" id="notes" rows="3" placeholder="Enter any notes"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="mb-3 col-lg-12">
                  <button type="submit" class="btn btn-primary" onclick="manage_stock_in();">Add Stock</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>

    </div>
  </main>

  <?php require "../include_ending.php";?>

  <script>
  function manage_stock_in() {

    return ajax_request({
      url: "<?php echo $server_url?>ics/api/engine/manage_stock_in.php",
      autoPrepare: true,
      checkRequired: 0,
      debugMode: 0,
      onSuccess: function(res) {

        window.location.href = "<?php echo $server_url?>ics/stock_in.php";

      }
    });

  }



  function retrieve_warehouse() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/warehouse.php",
      autoPrepare: true,
      checkRequired: 0,
      onSuccess: function(res) {
        var option = `<option value="">Please select warehouse</option>`;
        $.each(res.output, function(key, item) {
          option += `<option value='${item.id}'>${item.warehouse_name}</option>`;
        })
        $(`select#warehouse`).html(option);
      }
    });

  }



  function retrieve_zone() {

    return ajax_request({
      url: "<?php echo $server_url?>ics/api/engine/retrieve_zone.php",
      autoPrepare: true,
      checkRequired: 0,
      noLoading: true,
      onSuccess: function(res) {
        var option = `<option value="">Please select zone</option>`;
        $.each(res.output, function(key, item) {
          option += `<option value='${item.zone}'>${item.zone}</option>`;
        })
        $(`select#zone`).html(option);
      }
    });

  }



  function retrieve_aisle() {

    return ajax_request({
      url: "<?php echo $server_url?>ics/api/engine/retrieve_aisle.php",
      autoPrepare: true,
      checkRequired: 0,
      noLoading: true,
      onSuccess: function(res) {
        var option = `<option value="">Please select aisle</option>`;
        $.each(res.output, function(key, item) {
          option += `<option value='${item}'>${item}</option>`;
        })
        $(`select#aisle`).html(option);
      }
    });

  }



  function retrieve_rack() {

    return ajax_request({
      url: "<?php echo $server_url?>ics/api/engine/retrieve_rack.php",
      autoPrepare: true,
      checkRequired: 0,
      noLoading: true,
      onSuccess: function(res) {
        var option = `<option value="">Please select rack</option>`;
        $.each(res.output, function(key, item) {
          option += `<option value='${item}'>${item}</option>`;
        })
        $(`select#rack`).html(option);
      }
    });

  }



  $(async function() {
    try {
      await retrieve_warehouse();
    } catch (e) {
      console.log(e);
    }
  });


  $("select#warehouse").change(function() {
    retrieve_zone();
  });

  $("select#zone").change(function() {
    retrieve_aisle();
  });

  $("select#aisle").change(function() {
    retrieve_rack();
  });
  

  </script>

</body>

</html>
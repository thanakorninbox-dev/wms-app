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
              <h1 class="fs-3 mb-1">Manage Storage</h1>
              <p class="mb-0">Manage your Storage items</p>
            </div>

          </div>
        </div>
      </div>
      <div class="row" id="storageForm">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-6">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="warehouse" class="form-label">Warehouse</label>
                  <select class="form-select" id="warehouse" required> </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="zone" class="form-label">Zone</label>
                  <input type="text" class="form-control" id="zone" placeholder="Enter zone" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="aisle_from" class="form-label">Aisle From</label>
                  <input type="text" class="form-control" id="aisle_from" placeholder="Enter aisle form" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="aisle_to" class="form-label">Aisle To</label>
                  <input type="text" class="form-control" id="aisle_to" placeholder="Enter aisle to" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="rack_from" class="form-label">Rack From</label>
                  <input type="text" class="form-control" id="rack_from" placeholder="Enter rack form" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="rack_to" class="form-label">Rack To</label>
                  <input type="text" class="form-control" id="rack_to" placeholder="Enter rack to" required>
                </div>
              </div>


              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="4"
                  placeholder="Enter warehouse description"></textarea>
              </div>
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" onclick="manage_storage();">Add Storage</button>
                <button type="reset" class="btn btn-secondary" onclick="reset_input('#storageForm')">Clear</button>
              </div>
            </div>
          </div>


        </div>

      </div>

    </div>

    </div>
  </main>

  <?php require "../include_ending.php";?>

  <script>
  function manage_storage() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/manage_storage.php",
      autoPrepare: true,
      checkRequired: 0,
      debugMode: 0,
      onSuccess: function(res) {

        window.location.href = "<?php echo $server_url?>inventory/warehouse.php";

      }
    });

  }


  function retrieve_warehouse() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/warehouse.php",
      autoPrepare: true,
      checkRequired: 0,
      onSuccess: function(res) {
        var option = ``;
        $.each(res.output, function(key, item) {
          option += `<option value='${item.id}'>${item.warehouse_name}</option>`;
        })
        $(`select#warehouse`).html(option);
      }
    });

  }


  function retreive_for_edit() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/retrieve_storage.php",
      autoPrepare: true,
      checkRequired: 0,
      onSuccess: function(res) {

        $.each(res.output, function(key, item) {
          $(`#${key}`).val(item);
        });

        $(`button[type=submit]`).text('Update Storage');

        $(`button[type=reset]`).hide();

      }
    });

  }



  $(async function() {
    try {
      await retrieve_warehouse();
      <?php if(!empty($_GET["id"])){ ?>
      await retreive_for_edit();
      <?php } ?>
    } catch (e) {
      console.log(e);
    }
  });
  </script>


</body>

</html>
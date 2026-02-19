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
              <h1 class="fs-3 mb-1">Manage Warehouse</h1>
              <p class="mb-0">Manage your Warehouse items</p>
            </div>

          </div>
        </div>
      </div>
      <div class="row" id="warehouseForm">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-6">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="warehouse_name" class="form-label">Warehouse Name</label>
                  <input type="text" class="form-control" id="warehouse_name" placeholder="Enter warehouse name"
                    required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="location" class="form-label">Location</label>
                  <input type="text" class="form-control" id="location" placeholder="Enter Location" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="manager" class="form-label">Manager</label>
                  <select class="form-select" id="manager" required> </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="capacity" class="form-label">Capacity</label>
                  <input type="number" class="form-control" id="capacity" placeholder="0.00" step="0.01" required>
                </div>
              </div>


              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="4"
                  placeholder="Enter warehouse description"></textarea>
              </div>
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" onclick="manage_warehouse();">Add Warehouse</button>
                <button type="reset" class="btn btn-secondary" onclick="reset_input('#warehouseForm')">Clear</button>
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
  function manage_warehouse() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/manage_warehouse.php",
      autoPrepare: true,
      checkRequired: 0,
      debugMode: 0,
      action: 'manage',
      onSuccess: function(res) {

        window.location.href = "<?php echo $server_url?>inventory/warehouse.php";

      }
    });

  }


  function retrieve_manager() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/manager.php",
      autoPrepare: true,
      checkRequired: 0,
      action: 'read',
      onSuccess: function(res) {
        var option = ``;
        $.each(res.output, function(key, item) {
          option += `<option value='${item.user_id}'>${item.name} ${item.surname}</option>`;
        })
        $(`select#manager`).html(option);
      }
    });

  }


  function retreive_for_edit() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/retrieve_warehouse.php",
      autoPrepare: true,
      checkRequired: 0,
      action: 'read',
      onSuccess: function(res) {

        $.each(res.output, function(key, item) {
          $(`#${key}`).val(item);
        });

        $(`button[type=submit]`).text('Update Category');

        $(`button[type=reset]`).hide();

      }
    });

  }



  $(async function() {
    try {
      await retrieve_manager();
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
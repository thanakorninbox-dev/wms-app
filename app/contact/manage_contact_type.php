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
              <h1 class="fs-3 mb-1">Manage Type</h1>
              <p class="mb-0">Create/Update your contact type</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row" id="contact_typeForm">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-6">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="contact_type" class="form-label">Type Name</label>
                  <input type="text" class="form-control" id="contact_type" placeholder="Enter contact_type name" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="status" class="form-label">status</label>
                <select class="form-select" id="status" required>
                  <option value="1">Active</option>
                  <option value="0">inactive</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="4"
                  placeholder="Enter product description"></textarea>
              </div>
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" onclick="manage_type();">Create Type</button>
                <button type="reset" class="btn btn-secondary" onclick="reset_input('#contact_typeForm');">Clear</button>
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
  function manage_type() {

    return ajax_request({
      url: "<?php echo $server_url?>contact/api/engine/manage_contact_type.php",
      autoPrepare: true,
      checkRequired: 1,
      debugMode: 0,
      action: 'manage',
      onSuccess: function(res) {

        window.location.href = "<?php echo $server_url?>contact/contact.php";

      }
    });

  }


  function retreive_for_edit() {

    <?php if(empty($_GET['id'])){ ?>
      return false;
    <?php } ?>

    return ajax_request({
      url: "<?php echo $server_url?>contact/api/engine/retrieve_contact_type.php",
      autoPrepare: true,
      checkRequired: 0,
      action: 'read',
      onSuccess: function(res) {

        $.each(res.output, function(key, item) {
          $(`#${key}`).val(item);
        });

        $(`button[type=submit]`).text('Update');

        $(`button[type=reset]`).hide();

      }
    });

  }



  $(async function() {
    try {
      await retreive_for_edit();
    } catch (e) {
      console.log(e);
    }
  });
  </script>


</body>

</html>
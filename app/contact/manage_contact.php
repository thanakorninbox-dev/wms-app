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
              <h1 class="fs-3 mb-1">Manage Contact</h1>
              <p class="mb-0">Create/Update contact records</p>
            </div>

          </div>
        </div>
      </div>

      <div class="row g-5">
        <div class="col-lg-8 col-12">
          <div class="card mb-5 ">
            <div class="card-body p-6">
              <h2 class="fs-4 mb-3">Contact Information</h2>
              <div class="row g-5">
                <div class="col-lg-6">
                  <label for="productName" class="form-label">Contact Name</label>
                  <input type="text" name="" id="productName" class="form-control" placeholder="Name">

                </div>
                <div class="col-lg-6">
                  <label for="productName" class="form-label">Tax ID/Citizen ID</label>
                  <input type="text" name="" id="productName" class="form-control" placeholder="xxxxxxxxxxxxx">

                </div>
                <div class="col-lg-6">
                  <label for="sku" class="form-label"> Organization</label>
                  <input type="text" name="" id="sku" class="form-control" placeholder="company name">

                </div>
                <div class="col-lg-6">
                  <label for="sku" class="form-label"> Branch</label>
                  <input type="text" name="" id="sku" class="form-control" placeholder="00000">

                </div>
                <div class="col-lg-6">
                  <label for="catogires" class="form-label"> Contact Type</label>
                  <select name="" id="catogires" class="form-select">
                    <option value="Leptop">Leptop</option>
                    <option value="Desktop">Desktop</option>
                    <option value="Accessories">Accessories</option>
                    <option value="Phone">Phone</option>
                  </select>

                </div>
                <div class="col-lg-6">

                </div>
                <div class="col-lg-12">
                  <label for="address" class="form-label"> Billing Address</label>
                  <textarea name="address" rows="3" id="address" class="form-control"
                    placeholder="Customer Billing Address."></textarea>

                </div>

              </div>
            </div>

          </div>
          <div class="card ">
            <div class="card-body p-6">
              <h2 class="fs-4 mb-3">Shipping Information</h2>
              <div class="row g-5">
                <div class="col-lg-12">
                  <label for="shipping_location" class="form-label"> Shipping Location</label>
                  <input type="text" name="" id="shipping_location" class="form-control" placeholder="">

                </div>
                <div class="col-lg-12">
                  <label for="shipping_address" class="form-label"> Shipping Address</label>
                  <textarea name="shipping_address" rows="3" id="shipping_address" class="form-control"
                    placeholder="Customer Shipping Address."></textarea>

                </div>



              </div>
            </div>

          </div>


        </div>
        <div class="col-lg-4 col-12">
          <div class="card mb-5">
            <div class="card-body p-6">
              <h2 class="fs-4 mb-3">Contact Images</h2>
              <div id="custom-dropzone" class="dropzone border border-dashed rounded-3">
                <div class="fallback"><input type="file" name="file" id="file" /></div>
              </div>


            </div>

          </div>
          <div class="card mb-5">
            <div class="card-body p-6">
              <div class="">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                  <option value="1"> Active </option>
                  <option value="0"> Inactive </option>
                  <option value="Draft"> Draft </option>
                </select>

              </div>

            </div>

          </div>
          <div class="card mb-5">
            <div class="card-body p-6">
              <div class="row g-5">
                <div class="col-lg-12">
                  <label for="remark" class="form-label"> Remark</label>
                  <textarea name="remark" rows="10"  id="remark" class="form-control" placeholder=""></textarea>

                </div>
              </div>
            </div>
          </div>
          <div>
            <button type="submit" class="btn btn-primary" onclick="manage_contact();">Create</button>
          </div>

        </div>
      </div>

    </div>
  </main>

  <?php require "../include_ending.php";?>

  <script>

  let myDropzone;

  $(document).ready(function() {
      // Use the ID to initialize, ensuring NO conflict with theme classes
      myDropzone = new Dropzone("#custom-dropzone", { 
          url: "<?php echo $server_url?>contact/api/engine/manage_contact.php",
          autoProcessQueue: false,
          uploadMultiple: true,
          paramName: "contact_files"
      });
  });
  
  function manage_contact() {
    let formData = new FormData();

    let files = myDropzone.getQueuedFiles();

    files.forEach(function(file) {
        // Use 'contact_files[]' so PHP creates an array in $_FILES
        formData.append('contact_files[]', file);
    })

    return ajax_request({
      url: "<?php echo $server_url?>contact/api/engine/manage_contact.php",
      autoPrepare: true,
      checkRequired: 1,
      debugMode: 1,
      formData: formData,
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
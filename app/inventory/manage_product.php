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
              <h1 class="fs-3 mb-1">Add Product</h1>
              <p class="mb-0">Manage your Product items</p>
            </div>

          </div>
        </div>
      </div>
      <div class="row" id="productForm">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-6">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="product_name" class="form-label">Product Name</label>
                  <input type="text" class="form-control" id="product_name" placeholder="Enter product name" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="sku" class="form-label">SKU</label>
                  <input type="text" class="form-control" id="sku" placeholder="Enter SKU" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="price" class="form-label">Price</label>
                  <input type="number" class="form-control" id="price" placeholder="0.00" step="0.01" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" required> </select>
              </div>
              <div class="mb-3">
                <label for="product_image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="product_image" accept="image/*">
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="4"
                  placeholder="Enter product description"></textarea>
              </div>
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary" onclick="add_product();">Create</button>
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
  function add_product() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/manage_product.php",
      autoPrepare: true,
      checkRequired: 0,
      debugMode: 0,
      action: 'manage',
      onSuccess: function(res) {

        window.location.href = "<?php echo $server_url?>inventory/product.php";

      }
    });

  }


  function retrieve_category() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/product_category.php",
      autoPrepare: true,
      checkRequired: 0,
      action: 'read',
      onSuccess: function(res) {

        var option = ``;
        $.each(res.output, function(key, item) {
          option += `<option value='${item.id}'>${item.category}</option>`;
        })
        $(`select#category`).html(option);
      }
    });

  }


  function retreive_for_edit() {

    <?php if(empty($_GET["id"])){ ?>
      return false;
    <?php } ?>

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/retrieve_product.php",
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
      await retrieve_category();
      await retreive_for_edit();
    } catch (e) {
      console.log(e);
    }
  });
  </script>


</body>

</html>
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
          <div class="mb-6 d-flex justify-content-between align-items-center">
            <h1 class="fs-3 mb-0">Stock in
            </h1>
            <a href="<?php echo $server_url?>ics/add_stock_in.php" class="btn btn-primary">
              <span><i class="ti ti-plus"></i></span>
              <span>ADD Stock In</span></a>

          </div>
        </div>
      </div>

      <div class="row g-5">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-5">
              <h2 class="mb-4 fs-5">Item List</h2>
              <div class="table-responsive">
                <table class="table table-hover mb-0 table-centered" id="product">
                  <thead class="table-primary border-light">
                    <tr>
                      <th>Product</th>
                      <th>Quantity</th>
                      <th>Warehouse</th>
                      <th>Storage Location</th>
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

    </div>
  </main>

  <?php require "../include_ending.php";?>

  <script>

  </script>

</body>

</html>
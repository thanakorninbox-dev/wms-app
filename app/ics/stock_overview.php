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
            <h1 class="fs-3 mb-0">Stock Overview</h1>

          </div>
        </div>
      </div>
      <div class="row g-5 mb-5">
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card ">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between">
                <div>
                  <span class="mb-4 d-block">Total Sales</span>
                  <h3 class="fw-bold mb-0">1,234</h3>
                  <p class="mb-0 small text-secondary">Across all warehouses</p>
                </div>
                <div class="">
                  <i class="ti ti-box-seam fs-3 text-muted"></i>
                </div>
              </div>
            </div>
          </div>


        </div>
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card ">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between">
                <div>
                  <span class="mb-4 d-block">Stock In (This Month)</span>
                  <h3 class="fw-bold mb-0 text-success">+456</h3>
                  <p class="mb-0 small text-secondary">Unit added</p>
                </div>
                <div class="">
                  <i class="ti ti-trending-up fs-3 text-success"></i>
                </div>
              </div>
            </div>
          </div>


        </div>
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card ">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between">
                <div>
                  <span class="mb-4 d-block">Stock Out (This Month)</span>
                  <h3 class="fw-bold mb-0 text-danger">-289</h3>
                  <p class="mb-0 small text-secondary">Unit removed</p>
                </div>
                <div class="">
                  <i class="ti ti-trending-down fs-3 text-danger"></i>
                </div>
              </div>
            </div>
          </div>


        </div>
        <div class="col-xl-3 col-md-6 col-12">
          <div class="card ">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between">
                <div>
                  <span class="mb-4 d-block">Low Stock Alerts</span>
                  <h3 class="fw-bold mb-0 text-warning">12</h3>
                  <p class="mb-0 small text-secondary">Items need attention</p>
                </div>
                <div class="">
                  <i class="ti ti-alert-triangle fs-3 text-warning"></i>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
      <div class="row g-5 mb-5">
        <div class="col-lg-6 col-12">

          <div class="card">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between align-items-center">


                <h5 class="mb-0">Stock Movement</h5>
                <div class="d-flex gap-2">
                  <button type="button" class="btn btn-outline-light text-dark btn-icon btn-md">1W</button>
                  <button type="button" class="btn btn-outline-light text-dark btn-icon btn-md">1M</button>
                  <button type="button" class="btn btn-outline-light text-dark btn-icon btn-md">3M</button>
                  <button type="button" class="btn btn-outline-light text-dark btn-icon btn-md">6M</button>
                  <button type="button" class="btn btn-primary btn-icon btn-md">1Y</button>

                </div>
              </div>
              <div>
                <div id="stockMovementChart"></div>
              </div>

            </div>
          </div>

        </div>
        <div class="col-lg-6 col-12">

          <div class="card">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between align-items-center">


                <h5 class="mb-0">Stock Level Trend</h5>

              </div>
              <div>
                <div id="stockLevelTrendChart"></div>
              </div>

            </div>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-5">
              <h3 class="fs-5">Recent Stock Activity</h3>
              <div class="border-bottom d-flex justify-content-between align-items-center mb-4 pb-3">
                <div class="d-flex gap-3 align-items-center py-3">
                  <div class="icon-shape icon-md bg-success bg-opacity-10 text-success rounded-2">
                    <i class="ti ti-trending-up"></i>

                  </div>
                  <div>
                    <h5 class="mb-0">Product A</h5>
                    <p class="mb-0 small text-secondary">Stock In

                    </p>
                  </div>
                </div>
                <div class="d-flex flex-column align-items-end">
                  <span class="fs-5 text-success">+50</span>
                  <span>2 hour ago</span>
                </div>


              </div>
              <div class="border-bottom d-flex justify-content-between align-items-center mb-4 pb-3">
                <div class="d-flex gap-3 align-items-center py-3">
                  <div class="icon-shape icon-md bg-danger bg-opacity-10 text-danger rounded-2">
                    <i class="ti ti-trending-down"></i>

                  </div>
                  <div>
                    <h5 class="mb-0">Product B</h5>
                    <p class="mb-0 small text-secondary">Stock Out

                    </p>
                  </div>
                </div>
                <div class="d-flex flex-column align-items-end">
                  <span class="fs-5 text-danger">-25</span>
                  <span>4 hour ago</span>
                </div>


              </div>
              <div class="border-bottom d-flex justify-content-between align-items-center mb-4 pb-3">
                <div class="d-flex gap-3 align-items-center py-3">
                  <div class="icon-shape icon-md bg-success bg-opacity-10 text-success rounded-2">
                    <i class="ti ti-trending-up"></i>

                  </div>
                  <div>
                    <h5 class="mb-0">Product C</h5>
                    <p class="mb-0 small text-secondary">Stock Out

                    </p>
                  </div>
                </div>
                <div class="d-flex flex-column align-items-end">
                  <span class="fs-5 text-success">+100</span>
                  <span>6 hour ago</span>
                </div>


              </div>
              <div class="border-bottom d-flex justify-content-between align-items-center mb-4 pb-3">
                <div class="d-flex gap-3 align-items-center py-3">
                  <div class="icon-shape icon-md bg-danger bg-opacity-10 text-danger rounded-2">
                    <i class="ti ti-trending-down"></i>

                  </div>
                  <div>
                    <h5 class="mb-0">Product D</h5>
                    <p class="mb-0 small text-secondary">Stock Out

                    </p>
                  </div>
                </div>
                <div class="d-flex flex-column align-items-end">
                  <span class="fs-5 text-danger">-30</span>
                  <span>8 hour ago</span>
                </div>


              </div>

            </div>

          </div>

        </div>
        </div>
        <div class="row">
          <div class="col-12">
            <footer class="text-center py-2 mt-6 text-secondary ">
              <p class="mb-0">Copyright © 2026 InApp Inventory Dashboard. Developed by <a href="https://codescandy.com/"
                  target="_blank" class="text-primary">CodesCandy</a> </p>
            </footer>
          </div>

        </div>
        <div class="position-fixed end-0 bottom-0 m-4">
          <a href="https://codescandy.com/template/inventory-admin-dashboard-template/" class="btn btn-dark"
            target="_blank"> Download Now</a>
        </div>

      </div>
  </main>

  <?php require "../include_ending.php";?>

  <script>

  </script>


</body>

</html>
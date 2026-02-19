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
          <div class="mb-6 d-flex align-items-center justify-content-between">
            <div>
              <h1 class="fs-3 mb-1">Warehouse / Location Management
              </h1>
              <p class="mb-0">Manage your warehouses, storage locations, and capacity.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-5 g-5">
        <div class="col-12">
          <div class="card ">
            <div class="card-body p-0">
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap ">
                <div class=" p-6 flex-grow-1 d-flex justify-content-between">
                  <div class="d-flex flex-column">
                    <span class="fs-2 fw-bold mb-3 d-block">5</span>
                    <span class="fs-5">Total Warehouses</span>
                    <small class="text-info">
                      Across 5 locations</small>
                  </div>
                  <div class="">
                    <span class="text-info">
                      <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21v-13l9 -4l9 4v13" />
                        <path d="M13 13h4v8h-10v-6h6" />
                        <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                      </svg>
                    </span>
                  </div>

                </div>
                <div class=" p-6 flex-grow-1 d-flex justify-content-between">
                  <div class="d-flex flex-column">
                    <span class="fs-2 fw-bold mb-3 d-block">41,000</span>
                    <span class="fs-5">Total Capacity</span>
                    <small class="text-warning">
                      Storage units available</small>
                  </div>
                  <div class="">
                    <span class="text-warning">
                      <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-building-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21h9" />
                        <path d="M9 8h1" />
                        <path d="M9 12h1" />
                        <path d="M9 16h1" />
                        <path d="M14 8h1" />
                        <path d="M14 12h1" />
                        <path
                          d="M5 21v-16c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h10c.53 0 1.039 .211 1.414 .586c.375 .375 .586 .884 .586 1.414v7" />
                        <path d="M16 19h6" />
                        <path d="M19 16v6" />
                      </svg>
                    </span>
                  </div>

                </div>
                <div class=" p-6 flex-grow-1 d-flex justify-content-between">
                  <div class="d-flex flex-column">
                    <span class="fs-2 fw-bold mb-3 d-block">25,500</span>
                    <span class="fs-5">Space Used</span>
                    <small class="text-success">
                      Storage units available</small>
                  </div>
                  <div class="">
                    <span class="text-success">
                      <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-package">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                        <path d="M12 12l8 -4.5" />
                        <path d="M12 12l0 9" />
                        <path d="M12 12l-8 -4.5" />
                        <path d="M16 5.25l-8 4.5" />
                      </svg>
                    </span>
                  </div>

                </div>
                <div class="-0 p-6 flex-grow-1 d-flex justify-content-between">
                  <div class="d-flex flex-column">
                    <span class="fs-2 fw-bold mb-3 d-block">730</span>
                    <span class="fs-5">Total Products</span>
                    <small class="text-primary">
                      Products stored</small>
                  </div>
                  <div class="">
                    <span class="text-primary">
                      <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                      </svg>
                    </span>
                  </div>

                </div>
              </div>

            </div>


          </div>
        </div>


      </div>

      <ul class="nav nav-pills mb-3 bg-light p-2 rounded-2 d-inline-flex" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-warehouse-tab" data-bs-toggle="pill"
            data-bs-target="#pills-warehouse" type="button" role="tab" aria-controls="pills-warehouse"
            aria-selected="true">warehouse</button>
        </li>
        <li class="nav-item nav-item-secondary" role="presentation">
          <button class="nav-link" id="pills-storage-tab" data-bs-toggle="pill" data-bs-target="#pills-storage"
            type="button" role="tab" aria-controls="pills-storage" aria-selected="false">storage</button>
        </li>
      </ul>

      <div class="row g-5 mb-5 tab-pane fade show active" id="pills-warehouse" role="tabpanel"
        aria-labelledby="pills-warehouse-tab">
        <div class="col-12">
          <div class="card ">
            <div class="card-body p-5 justify-content-between">
              <div class="mb-6 d-flex align-items-center justify-content-between">
                <div>
                  <h2 class="fs-4 mb-2">Warehouses</h2>
                  <p>All warehouse facilities and their current status</p>
                </div>
                <div>
                  <a href="<?php echo $server_url?>inventory/manage_warehouse.php" class="btn btn-primary">Add
                    Warehouse</a>
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
                <table class="table mb-0 text-nowrap table-hover table-centered" id="warehouse">
                  <thead class="table-primary border-primary">
                    <tr>
                      <th class="py-3">Warehouse Name</th>
                      <th class="py-3">Location</th>
                      <th class="py-3">Manager</th>
                      <th class="py-3">Capacity</th>
                      <th class="py-3">Products</th>
                      <th class="py-3">Status</th>

                      <th class="py-3">Action</th>
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
      <div class="row g-5 mb-5 tab-pane fade" id="pills-storage" role="tabpanel" aria-labelledby="pills-storage-tab">
        <div class="col-12">
          <div class="card ">
            <div class="card-body p-5">
              <div class="mb-6 d-flex align-items-center justify-content-between">
                <div>
                  <h2 class="fs-4 mb-2">Storage Locations</h2>
                  <p>Zones, aisles, and rack assignments</p>
                </div>
                <div>
                  <a href="<?php echo $server_url?>inventory/manage_storage.php" class="btn btn-secondary">Add
                    Storage</a>
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
                <table class="table mb-0 text-nowrap table-hover table-centered" id="storage">
                  <thead class="table-secondary">
                    <tr>
                      <th class="py-3">Warehouse</th>
                      <th class="py-3">Zone</th>
                      <th class="py-3">Aisle Range</th>
                      <th class="py-3">Rack Range</th>
                      <th class="py-3">Items Stored</th>

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
  function retrieve_warehouse() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/warehouse.php",
      autoPrepare: true,
      checkRequired: 0,
      action: 'read',
      onSuccess: function(res) {

        // Register the array as a table name
        alasql('CREATE TABLE IF NOT EXISTS output');
        alasql.tables.output.data = res.output || [];

        var total_records = alasql.tables.output.data.length;

        var table_id = 'warehouse';

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


  function change_page_warehouse(page_num) {

    var offset = (page_num - 1) * prop_limit;

    var page_data = alasql(`SELECT * FROM output LIMIT ${prop_limit} OFFSET ${offset}`);

    var body = ``;
    $.each(page_data, function(key, item) {
      body += `<tr>
            <td class="py-3">${item['warehouse_name']}</td>
            <td class="py-3">${item['location']}</td>
            <td class="py-3">${item['manager']}</td>
            <td class="py-3">${item['capacity']}</td>
            <td class="py-3">${item['product']}</td>
            <td class="py-3">
              <span class="badge bg-${item['bg_class']}">${item.status}</span>
            </td>
            <td class="py-3">
              <a href="<?php echo $server_url?>inventory/manage_warehouse.php?id=${item['id']}" class=""><i class="ti ti-eye fs-5"></i></a>
              <a href="#" class="link-danger"><i class="ti ti-trash ms-2 fs-5"></i></a>
            </td>
          </tr>`;
    })

    $("table#warehouse > tbody").html(body);

  }


  function retrieve_storage() {

    return ajax_request({
      url: "<?php echo $server_url?>inventory/api/engine/storage.php",
      autoPrepare: true,
      checkRequired: 0,
      action: 'read',
      onSuccess: function(res) {

        // Register the array as a table name
        alasql('CREATE TABLE IF NOT EXISTS storage');
        alasql.tables.storage.data = res.output || [];

        var total_records = alasql.tables.storage.data.length;

        var table_id = 'storage';

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


  function change_page_storage(page_num) {

    var offset = (page_num - 1) * prop_limit;

    var page_data = alasql(`SELECT * FROM storage LIMIT ${prop_limit} OFFSET ${offset}`);

    var body = ``;
    $.each(page_data, function(key, item) {
      body += `<tr>
            <td class="py-3">${item['warehouse_name']}</td>
            <td class="py-3">${item['zone']}</td>
            <td class="py-3">${item['aisle_from']} - ${item["aisle_to"]}</td>
            <td class="py-3">${item['rack_from']} - ${item["rack_to"]}</td>
            <td class="py-3"></td>
            <td class="py-3">
              <a href="<?php echo $server_url?>inventory/manage_storage.php?id=${item['id']}" class=""><i class="ti ti-eye fs-5"></i></a>
              <a href="#" class="link-danger"><i class="ti ti-trash ms-2 fs-5"></i></a>
            </td>
          </tr>`;
    })

    $("table#storage > tbody").html(body);

  }

  $(async function() {
    try {
      await retrieve_warehouse();
      await retrieve_storage();
    } catch (e) {
      console.log(e);
    }
  });

  $(document).ready(function() {
    // switching to nav-link from last leave
    $('button.nav-link').on('click', function() {
      nav_id = $(this).attr('id');
      sessionStorage.setItem("warehouse_nav_id", nav_id);
    })
    let nav_id = sessionStorage.getItem("warehouse_nav_id");
    if(nav_id){
      $(`button#${nav_id}`).trigger('click');
    }
  })
  </script>


</body>

</html>
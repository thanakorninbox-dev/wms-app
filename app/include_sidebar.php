<!-- SIDEBAR -->
<aside id="sidebar" class="sidebar overflow-y-auto">
  <div class="logo-area">
    <a href="index.html" class="d-inline-flex">
      <img
        src="data:image/svg+xml,%3csvg%20width='62'%20height='67'%20viewBox='0%200%2062%2067'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20d='M30.604%2066.378L0.00805664%2048.1582V35.7825L30.604%2054.0023V66.378Z'%20fill='%23302C4D'/%3e%3cpath%20d='M61.1996%2048.1582L30.604%2066.378V54.0023L61.1996%2035.7825V48.1582Z'%20fill='%23E66239'/%3e%3cpath%20d='M30.5955%200L0%2018.2198V30.5955L30.5955%2012.3757V0Z'%20fill='%23657E92'/%3e%3cpath%20d='M61.191%2018.2198L30.5955%200V12.3757L61.191%2030.5955V18.2198Z'%20fill='%23A3B2BE'/%3e%3cpath%20d='M30.604%2048.8457L0.00805664%2030.6259V18.2498L30.604%2036.47V48.8457Z'%20fill='%23302C4D'/%3e%3cpath%20d='M61.1996%2030.6259L30.604%2048.8457V36.47L61.1996%2018.2498V30.6259Z'%20fill='%23E66239'/%3e%3c/svg%3e"
        alt=""
        width="24"
      />
      <span class="logo-text ms-2">
        <img src="./assets/images/logo.svg" alt="" />
      </span>
    </a>
  </div>

  <ul class="nav flex-column">
    <!-- Main -->
    <li class="nav-text-space">
      <small class="nav-text text-muted">Main</small>
    </li>

    <li>
      <a class="nav-link active" href="index.html">
        <i class="ti ti-home"></i>
        <span class="nav-text">Dashboard</span>
      </a>
    </li>

    <li>
      <a class="nav-link" href="inventory.html">
        <i class="ti ti-box-seam"></i>
        <span class="nav-text">Inventory</span>
      </a>
    </li>

    <li>
      <a class="nav-link" href="low-stock-products.html">
        <i class="ti ti-alert-triangle"></i>
        <span class="nav-text">Low Stock Products</span>
      </a>
    </li>

    <li>
      <a class="nav-link" href="stock-expired.html">
        <i class="ti ti-clock"></i>
        <span class="nav-text">Expired Stock</span>
      </a>
    </li>

    <li>
      <a class="nav-link" href="reports.html">
        <i class="ti ti-receipt"></i>
        <span class="nav-text">Reports</span>
      </a>
    </li>

    <!-- Product -->
    <li class="nav-text-space">
      <small class="nav-text text-muted">Master Data</small>
    </li>

    <li>
      <a class="nav-link" href="<?php echo $server_url?>inventory/product.php">
        <i class="ti ti-category"></i>
        <span class="nav-text">Products</span>
      </a>
    </li>

    <li>
      <a class="nav-link" href="<?php echo $server_url?>inventory/warehouse.php">
        <i class="ti ti-map-pin"></i>
        <span class="nav-text">Warehouse Location</span>
      </a>
    </li>

    <li>
      <a class="nav-link" href="<?php echo $server_url?>contact/contact.php">
        <i class="ti ti-users"></i>
        <span class="nav-text">Contact</span>
      </a>
    </li>

    <!-- Inventory / Stock -->
    <li class="nav-text-space">
      <small class="nav-text text-muted">Inventory / Stock</small>
    </li>

    <li>
      <a class="nav-link" href="<?php echo $server_url?>ics/stock_overview.php">
        <i class="ti ti-clipboard"></i>
        <span class="nav-text">Stock Overview</span>
      </a>
    </li>

    <li>
      <a class="nav-link" href="<?php echo $server_url?>ics/stock_in.php">
        <i class="ti ti-package-import"></i>
        <span class="nav-text">Stock In</span>
      </a>
    </li>

    <li>
      <a class="nav-link" href="stock-out.html">
        <i class="ti ti-package-export"></i>
        <span class="nav-text">Stock Out</span>
      </a>
    </li>

    <li>
      <a class="nav-link" href="stock-out.html">
        <i class="ti ti-package"></i>
        <span class="nav-text">Stock Transfer</span>
      </a>
    </li>

    


  </ul>
</aside>

<?php 
  session_start();
  require '../config.php';
  require '../include_header.php';
  // successful login
  if(!empty($_SESSION["login_status"])){
    header('Location: '.$server_url.'dashboard/index.php');
    exit;
  }

?>

<body>

  <div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card " style="max-width:420px; width:100%;">
      <div class="card-body p-5">
        <div class="text-center mb-3">
          <a href="index.html" class="mb-5 d-inline-block"><img
              src="data:image/svg+xml,%3csvg%20width='62'%20height='67'%20viewBox='0%200%2062%2067'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20d='M30.604%2066.378L0.00805664%2048.1582V35.7825L30.604%2054.0023V66.378Z'%20fill='%23302C4D'/%3e%3cpath%20d='M61.1996%2048.1582L30.604%2066.378V54.0023L61.1996%2035.7825V48.1582Z'%20fill='%23E66239'/%3e%3cpath%20d='M30.5955%200L0%2018.2198V30.5955L30.5955%2012.3757V0Z'%20fill='%23657E92'/%3e%3cpath%20d='M61.191%2018.2198L30.5955%200V12.3757L61.191%2030.5955V18.2198Z'%20fill='%23A3B2BE'/%3e%3cpath%20d='M30.604%2048.8457L0.00805664%2030.6259V18.2498L30.604%2036.47V48.8457Z'%20fill='%23302C4D'/%3e%3cpath%20d='M61.1996%2030.6259L30.604%2048.8457V36.47L61.1996%2018.2498V30.6259Z'%20fill='%23E66239'/%3e%3c/svg%3e"
              alt="" width="36">
            <span class=" ms-2"> <img src="<?php echo $server_url?>assets/images/logo.svg" alt=""></span>
          </a>
          <h1 class="card-title mb-5 h5">Sign in to your account</h1>
        </div>

        <form class="needs-validation mt-3" novalidate id="login-form">
          <!-- first step login [OTP] -->
          <?php if(!isset($_SESSION['login_data'])){?>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input id="username" type="username" class="form-control" placeholder="username" required autofocus>
            <div class="invalid-feedback">Please enter a valid email.</div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label d-flex justify-content-between">
              <span>Password</span>
            </label>
            <input id="password" type="password" class="form-control" placeholder="Password" required minlength="6">
            <div class="invalid-feedback">Please provide a password (min 6 characters).</div>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
              <input id="remember" class="form-check-input" type="checkbox">
              <label class="form-check-label small" for="remember">Remember me</label>
            </div>
          </div>
          <button class="btn btn-primary w-100" onclick="login();">Sign in</button>
          <?php }else{ ?>
          <!-- second step login  -->
          <div class="mb-3">
            <label for="otp" class="form-label d-flex justify-content-between">
              <span>One Time Password</span>
            </label>
            <input id="otp" type="otp" class="form-control"
              placeholder="your otp for reference number <?php echo $_SESSION["reference"]?>" required minlength="6">
            <div class="invalid-feedback">Please provide a otp (min 6 characters).</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label d-flex justify-content-between">
              <a href="javascript:;" class="small link-primary" onclick="back()">Back</a>
              <a href="javascript:;" class="small link-primary" onclick="request_new_otp();">Request New OTP</a>
            </label>
          </div>
          <button class="btn btn-primary w-100" onclick="login_confirm();">Sign in</button>
          <?php } ?>
        </form>


      </div>
    </div>
  </div>


  <script>


  // login function
  function login() {

    return ajax_request({
      url: "<?php echo $server_url?>login/api/engine/login_otp.php",
      autoPrepare: true,
      checkRequired: 0,
      action: 'read',
      onSuccess: function(res) {

        window.location.href = "<?php echo $server_url?>index.php";

      }
    });

  }



  // reqquest new otp function
  function request_new_otp() {

    return ajax_request({
      url: "<?php echo $server_url?>login/api/engine/request_new_otp.php",
      autoPrepare: true,
      checkRequired: 0,
      action: 'read',
      onSuccess: function(res) {

        window.location.href = "<?php echo $server_url?>index.php";

      }
    });

  }



  // log_out function
  function back() {

    return ajax_request({
      url: "<?php echo $server_url?>login/api/engine/back.php",
      autoPrepare: true,
      checkRequired: 0,
      action: 'read',
      onSuccess: function(res) {

        window.location.href = "<?php echo $server_url?>index.php";

      }
    });

  }



  // log_in confirm
  function login_confirm() {

    return ajax_request({
      url: "<?php echo $server_url?>login/api/engine/login_confirm.php",
      autoPrepare: true,
      checkRequired: 0,
      action: 'read',
      onSuccess: function(res) {

        window.location.href = "index.php";

      }
    });

  }
  </script>


</body>

</html>
<?php

session_start();
require('../../config/database.php');

?>
<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login Admin</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/img/logo/icon.png" sizes="128x128" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
					<span class="app-brand-logo demo">
					  <img src="../assets/img/logo/hotel1.png" alt="Logo" width="175">
					</span>
                  
                </a>
              </div>
              <!-- /Logo -->
				<div style="text-align: center;">
				  <h4 class="mb-2">Welcome to Re' Hotel 👋</h4>
				  <p class="mb-4">Please sign-in to your account</p>
				</div>
				<!-- Form login-->
				<form id="formAuthentication" class="mb-3" action = "../process/loginstaff.php" method="POST">
				  <div class="mb-3">
					<label for="username" class="form-label">Email</label>
					<input
					  type="text"
					  class="form-control"
					  id="staff_email"
					  name="staff_email"
					  placeholder="admin123@gmail.com"
					  autofocus
					  required />
					
				  </div>
				  <div class="mb-3 form-password-toggle">
					<div class="d-flex justify-content-between">
					  <label class="form-label" for="password">Password</label>
					  <a href="forgetpass.php">
						<small>Forgot Password?</small>
					  </a>
					</div>
					<div class="input-group input-group-merge">
					  <input
						type="password"
						id="password"
						class="form-control"
						name="password"
						placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
						aria-describedby="password"
						required />
					  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
					</div>
				  </div>
				  <div class="mb-3">
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" id="remember-me" />
					  <label class="form-check-label" for="remember-me"> Remember Me </label>
					</div>
				  </div>
				  <div class="mb-3">
					<input type="hidden" name="purpose" value="loginstaff" required>
					<button class="btn btn-primary d-grid w-100" type="submit">Log in</button>
				  </div>
				</form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php if (isset($_SESSION['result']) && $_SESSION['result'] != "") { ?>
    <!-- isset = check ada atau tak & name mesti tak kosong -->
    <script>
      Swal.fire({
        position: 'top-end',
        icon: '<?php echo $_SESSION['icon']; ?>',
        title: '<?php echo $_SESSION['result']; ?>',
        text: '<?php echo $_SESSION['message']; ?>',
        showConfirmButton: false,
        timer: 3000
      })
    </script>
    <?php unset($_SESSION['result']);
  } ?> <!--tak keluar result banyak kali-->
  </body>
</html>
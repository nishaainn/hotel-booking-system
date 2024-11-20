<?php
session_start();
require ("../../config/database.php");
require('../../config/security.php');


$menu = "Add Staff";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Add Staff</title>
  <meta name="description" content="" />
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="../assets/img/logo/icon.png" sizes="128x128" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />
  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />
  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../assets/js/config.js"></script>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <?php include ('./include/sidebar.php'); ?>
      <!-- / Menu -->
      <!-- Layout container -->
      <div class="layout-page">
        <?php include ('./include/navbar.php'); ?>
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hotels /</span> Add Staff Information</h4>
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <h5 class="card-header">Staff Details</h5>
                  <hr class="my-0" />
                  <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="../process/register.php">
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label for="firstName" class="form-label">Staff Name</label>
                          <input class="form-control" type="text" id="firstName" name="staff_name" autofocus required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="lastName" class="form-label">Staff Id</label>
                          <input class="form-control" type="text" name="staff_id" id="staff_id" required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="email" class="form-label">E-mail</label>
                          <input class="form-control" type="email" id="email" name="staff_email"
                            placeholder="john.doe@example.com" required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="position" class="form-label">Position</label>
                          <select id="position" class="form-select" name="position" required>
                            <option value="">Select</option>
                            <option value="Manager">Manager</option>
                            <option value="Assistant Manager">Assistant Manager</option>
                            <option value="Housekeeping Staff">Housekeeping Staff</option>
                            <option value="Concierge">Concierge</option>
                            <option value="Receptionist">Receptionist</option>
                            <option value="Server">Server</option>
                            <option value="Bartender">Bartender</option>
                            <option value="Security Officer">Security Officer</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="phoneNumber">Phone Number</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text">MALAYSIA (+60)</span>
                            <input type="text" id="phoneNumber" name="staff_tel" class="form-control"
                              placeholder="013 456 7890" required />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="hireDate">Hire Date</label>
                          <input type="date" id="hireDate" name="hire_date" class="form-control" required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="address" class="form-label">Address</label>
                          <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                            required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="state">State</label>
                          <select id="state" class="form-select" name="state" required>
                            <option value="">Select</option>
                            <option value="Johor">Johor</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Kelantan">Kelantan</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Pahang">Pahang</option>
                            <option value="Perak">Perak</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Pulau Pinang">Pulau Pinang</option>
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="Wilayah Persekutuan Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
                            <option value="Wilayah Persekutuan Labuan">Wilayah Persekutuan Labuan</option>
                            <option value="Wilayah Persekutuan Putrajaya">Wilayah Persekutuan Putrajaya</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="zipCode" class="form-label">Zip Code</label>
                          <input type="text" class="form-control" id="zipCode" name="zip_code" placeholder="40000"
                            maxlength="6" required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="country" class="form-label">Country</label>
                          <input class="form-control" type="text" id="country" name="country" placeholder="Malaysia"
                            required />
                        </div>
                      </div>
                      <div class="mt-2">
                        <input type="hidden" name="purpose" value="addStaff" required>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                      </div>
                    </form>
                  </div>
                  <!-- /Account -->
                </div>
              </div>
            </div>
          </div>
          <!-- / Content -->
          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->
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
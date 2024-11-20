<?php
session_start();
require ('../../config/database.php');
require ('../../config/security.php');


// Query to fetch staff details
$sql = "SELECT * FROM staff WHERE staff_email = '$staff_email'";
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
// Fetch staff details
while ($row = $result->fetch_array(MYSQLI_BOTH)) {
  $staff_name = $row['staff_name'];
  $staff_email = $row['staff_email'];
  $position = $row['position'];
  $staff_tel = $row['staff_tel'];
  $hire_date = $row['hire_date'];
  $address = $row['address'];
  $state = $row['state'];
  $zip_code = $row['zip_code'];
  $country = $row['country'];
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Account settings</title>
  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="../assets/img/logo/icon.png" sizes="128x128" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>

  <!-- Template customizer & Theme config files -->
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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account /</span> My Account</h4>
            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                  <li class="nav-item">
                    <a class="nav-link active" href="account.php"><i class="bx bx-user me-1"></i> Account</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="password.php"><i class="menu-icon tf-icons bx bx-lock"></i> Password</a>
                  </li>
                </ul>
                <div class="card mb-4">
                  <h5 class="card-header">Profile Details</h5>
                  <!-- Account -->
                  <hr class="my-0" />
                  <div class="card-body">
                    <form id="formAccountSettings" action="../process/update.php" method="POST">
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label for="firstName" class="form-label">First Name</label>
                          <input class="form-control" type="text" id="firstName" name="staff_name"
                            value="<?php echo $staff_name; ?>" autofocus />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="email" class="form-label">E-mail</label>
                          <input class="form-control" type="text" id="email" name="staff_email"
                            value="<?php echo $staff_email; ?>" />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="organization" class="form-label">Position</label>
                          <select id="country" class="select2 form-select" name="position">
                            <option value="">Select</option>
                            <option value="Manager" <?php if ($position == 'Manager')
                              echo "selected"; ?>>Manager</option>
                            <option value="Assistant Manager" <?php if ($position == 'Assistant Manager')
                              echo "selected"; ?>>Assistant Manager</option>
                            <option value="Front Desk Agent" <?php if ($position == 'Front Desk Agent')
                              echo "selected"; ?>>Front Desk Agent</option>
                            <option value="Housekeeping Staff" <?php if ($position == 'Housekeeping Staff')
                              echo "selected"; ?>>Housekeeping Staff</option>
                            <option value="Concierge" <?php if ($position == 'Concierge')
                              echo "selected"; ?>>Concierge
                            </option>
                            <option value="Receptionist" <?php if ($position == 'Receptionist')
                              echo "selected"; ?>>
                              Receptionist</option>
                            <option value="Server" <?php if ($position == 'Server')
                              echo "selected"; ?>>Server</option>
                            <option value="Bartender" <?php if ($position == 'Bartender')
                              echo "selected"; ?>>Bartender
                            </option>
                            <option value="Sales Manager" <?php if ($position == 'Sales Manager')
                              echo "selected"; ?>>
                              Sales Manager</option>
                            <option value="Security Officer" <?php if ($position == 'Security Officer')
                              echo "selected"; ?>>Security Officer</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="phoneNumber">Phone Number</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text">MALAYSIA (+60)</span>
                            <input type="text" id="phoneNumber" name="staff_tel" class="form-control"
                              value="<?php echo $staff_tel; ?>" />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="hireDate">Hire Date</label>
                          <input type="date" id="hireDate" name="hire_date" class="form-control"
                            value="<?php echo $hire_date; ?>" />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="address" class="form-label">Address</label>
                          <input type="text" class="form-control" id="address" name="address"
                            value="<?php echo $address; ?>" />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="country">State</label>
                          <select id="country" class="select2 form-select" name="state">
                            <option value="">Select</option>
                            <option value="Johor" <?php if ($state == 'Johor')
                              echo "selected"; ?>>Johor</option>
                            <option value="Kedah" <?php if ($state == 'Kedah')
                              echo "selected"; ?>>Kedah</option>
                            <option value="Kelantan" <?php if ($state == 'Kelantan')
                              echo "selected"; ?>>Kelantan</option>
                            <option value="Melaka" <?php if ($state == 'Melaka')
                              echo "selected"; ?>>Melaka</option>
                            <option value="Negeri Sembilan" <?php if ($state == 'Negeri Sembilan')
                              echo "selected"; ?>>
                              Negeri Sembilan</option>
                            <option value="Pahang" <?php if ($state == 'Pahang')
                              echo "selected"; ?>>Pahang</option>
                            <option value="Perak" <?php if ($state == 'Perak')
                              echo "selected"; ?>>Perak</option>
                            <option value="Perlis" <?php if ($state == 'Perlis')
                              echo "selected"; ?>>Perlis</option>
                            <option value="Pulau Pinang" <?php if ($state == 'Pulau Pinang')
                              echo "selected"; ?>>Pulau
                              Pinang</option>
                            <option value="Sabah" <?php if ($state == 'Sabah')
                              echo "selected"; ?>>Sabah</option>
                            <option value="Sarawak" <?php if ($state == 'Sarawak')
                              echo "selected"; ?>>Sarawak</option>
                            <option value="Selangor" <?php if ($state == 'Selangor')
                              echo "selected"; ?>>Selangor</option>
                            <option value="Terengganu" <?php if ($state == 'Terengganu')
                              echo "selected"; ?>>Terengganu
                            </option>
                            <option value="Wilayah Persekutuan Kuala Lumpur" <?php if ($state == 'Wilayah Persekutuan Kuala Lumpur')
                              echo "selected"; ?>>Wilayah Persekutuan Kuala Lumpur</option>
                            <option value="Wilayah Persekutuan Labuan" <?php if ($state == 'Wilayah Persekutuan Labuan')
                              echo "selected"; ?>>Wilayah Persekutuan Labuan</option>
                            <option value="Wilayah Persekutuan Putrajaya" <?php if ($state == 'Wilayah Persekutuan Putrajaya')
                              echo "selected"; ?>>Wilayah Persekutuan Putrajaya</option>
                          </select>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="zipCode" class="form-label">Zip Code</label>
                          <input type="text" class="form-control" id="zipcode" name="zip_code" maxlength="6"
                            value="<?php echo $zip_code; ?>" />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="state" class="form-label">Country</label>
                          <input class="form-control" type="text" id="country" name="country"
                            value="<?php echo $country; ?>" />
                        </div>
                      </div>
                      <div class="mt-2">
                        <input type="hidden" name="staff_email" value="<?php echo $staff_email; ?>" required>
                        <input type="hidden" name="purpose" value="account" required>
                        <button type="submit" class="btn btn-primary me-2">Update</button>
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

  <!-- Page JS -->
  <script src="../assets/js/pages-account-settings-account.js"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if(isset($_SESSION['result']) && $_SESSION['result'] != '') { ?>
    <script>
        Swal.fire({
            title: '<?php echo $_SESSION['result']; ?>',
            text: '<?php echo $_SESSION['message']; ?>',
            icon: '<?php echo $_SESSION['icon']; ?>',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    <?php } unset($_SESSION['result']); ?>
</body>

</html>
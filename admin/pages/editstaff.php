<?php

session_start();
require('../../config/database.php');
require('../../config/security.php');


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

$sql = "SELECT * FROM staff  WHERE staff_id = '$id' ";
$result= mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
while($row = $result->fetch_array(MYSQLI_BOTH)) { 
    $staff_id = $row['staff_id'];
    $staff_tel = $row['staff_tel'];
    $staff_name = $row['staff_name'];
    $staff_email = $row['staff_email'];
    $position = $row['position'];
    $hire_date = $row['hire_date'];
    $address = $row['address'];
    $state = $row['state'];
    $zip_code = $row['zip_code'];
    $country = $row['country'];
    $password = $row['password'];
    $status = $row['status'];
	
	$dob = substr($staff_id, 0, 2)."-".substr($staff_id, 2, 2)."-".substr($staff_id, 4, 2);  // (index,panjang)
	$dob = date('d/m/Y', strtotime($dob));

	// GENDER
	$gender = substr($staff_id, 11, 1);
	if($gender % 2 == 0){ $gender = 'Female'; } else { $gender = 'Male'; }

	//AGE
	$age = date('Y') - substr($dob,6,4);
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Edit Staff</title>
  <meta name="description" content="" />
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="../assets/img/logo/icon.png" sizes="128x128" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
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
      <?php include('./include/sidebar.php'); ?>
      <!-- / Menu -->
      <!-- Layout container -->
      <div class="layout-page">
        <?php include('./include/navbar.php'); ?>
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hotels /</span> Edit Staff Information</h4>
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <h5 class="card-header">Staff Details Information</h5>
                  <!-- Account -->
                  <hr class="my-0" />
                  <div class="card-body">
                    <form id="formAccountSettings" action = "../process/update.php"  method="POST">
                      <div class="row">
                        <div class="mb-3 col-md-12">
                          <label class="form-label" for="staff_name">Full Name</label>
                          <div class="input-group input-group-merge">
                            <input type="text" id="staff_name" name="staff_name" class="form-control" value = "<?php echo $staff_name;?>" required />
                          </div>
                        </div>
						<div class="mb-3 col-md-6">
                          <label class="form-label" for="staff_id">IC Number</label>
                          <div class="input-group input-group-merge">
                            <input type="text" id="staff_id" name="staff_id" class="form-control" value = "<?php echo $staff_id;?>" readonly />
                          </div>
                        </div>
						<div class="mb-3 col-md-6">
                          <label class="form-label" for="gender">Gender</label>
                          <div class="input-group input-group-merge">
                            <input type="text" id="gender" name="gender" class="form-control" value = "<?php echo $gender;?>" readonly />
                          </div>
                        </div>
						<div class="mb-3 col-md-6">
                          <label class="form-label" for="staffId">Date of Birth</label>
                          <div class="input-group input-group-merge">
                            <input type="text" id="dob" name="dob" class="form-control" value = "<?php echo $dob;?>" readonly />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="email" class="form-label">E-mail</label>
                          <input class="form-control" type="email" id="staff_email" name="staff_email" value = "<?php echo $staff_email;?>" required />
                        </div>
						<div class="mb-3 col-md-6">
							<label for="position" class="form-label">Position</label>
							<select id="position" name = "position" class="form-select" required>
								<option value="">Select</option>
								<option value="Manager" <?php if($position == "Manager") echo "selected"; ?>>Manager</option>
								<option value="Assistant Manager" <?php if($position == "Assistant Manager") echo "selected"; ?>>Assistant Manager</option>
								<option value="Front Desk Agent" <?php if($position == "Front Desk Agent") echo "selected"; ?>>Front Desk Agent</option>
								<option value="Housekeeping Staff" <?php if($position == "Housekeeping Staff") echo "selected"; ?>>Housekeeping Staff</option>
								<option value="Concierge" <?php if($position == "Concierge") echo "selected"; ?>>Concierge</option>
								<option value="Receptionist" <?php if($position == "Receptionist") echo "selected"; ?>>Receptionist</option>
								<option value="Server" <?php if($position == "Server") echo "selected"; ?>>Server</option>
								<option value="Bartender" <?php if($position == "Bartender") echo "selected"; ?>>Bartender</option>
								<option value="Sales Manager" <?php if($position == "Sales Manager") echo "selected"; ?>>Sales Manager</option>
								<option value="Security Officer" <?php if($position == "Security Officer") echo "selected"; ?>>Security Officer</option>
							</select>
						</div>

                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="phoneNumber">Phone Number</label>
                          <div class="input-group input-group-merge">
                            
                            <input type="text" id="staff_tel" name="staff_tel" class="form-control" value = "<?php echo $staff_tel;?>" required />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="hireDate">Hire Date</label>
                          <input type="date" id="hire_date" name="hire_date" class="form-control" value = "<?php echo $hire_date;?>" required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="address" class="form-label">Address</label>
                          <input type="text" class="form-control" id="address" name="address" placeholder="Address" value = "<?php echo $address;?>" required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="state">State</label>
						  <select id="state"name="state" class="form-select" required>
								<option value="">Select</option>
								<option value="Johor" <?php if($state == "Johor") echo "selected"; ?>>Johor</option>
								<option value="Kedah" <?php if($state == "Kedah") echo "selected"; ?>>Kedah</option>
								<option value="Kelantan" <?php if($state == "Kelantan") echo "selected"; ?>>Kelantan</option>
								<option value="Melaka" <?php if($state == "Melaka") echo "selected"; ?>>Melaka</option>
								<option value="Negeri Sembilan" <?php if($state == "Negeri Sembilan") echo "selected"; ?>>Negeri Sembilan</option>
								<option value="Pahang" <?php if($state == "Pahang") echo "selected"; ?>>Pahang</option>
								<option value="Perak" <?php if($state == "Perak") echo "selected"; ?>>Perak</option>
								<option value="Perlis" <?php if($state == "Perlis") echo "selected"; ?>>Perlis</option>
								<option value="Pulau Pinang" <?php if($state == "Pulau Pinang") echo "selected"; ?>>Pulau Pinang</option>
								<option value="Sabah" <?php if($state == "Sabah") echo "selected"; ?>>Sabah</option>
								<option value="Sarawak" <?php if($state == "Sarawak") echo "selected"; ?>>Sarawak</option>
								<option value="Selangor" <?php if($state == "Selangor") echo "selected"; ?>>Selangor</option>
								<option value="Terengganu" <?php if($state == "Terengganu") echo "selected"; ?>>Terengganu</option>
								<option value="Wilayah Persekutuan Kuala Lumpur" <?php if($state == "Wilayah Persekutuan Kuala Lumpur") echo "selected"; ?>>Wilayah Persekutuan Kuala Lumpur</option>
								<option value="Wilayah Persekutuan Labuan" <?php if($state == "Wilayah Persekutuan Labuan") echo "selected"; ?>>Wilayah Persekutuan Labuan</option>
								<option value="Wilayah Persekutuan Putrajaya" <?php if($state == "Wilayah Persekutuan Putrajaya") echo "selected"; ?>>Wilayah Persekutuan Putrajaya</option>
							</select>				
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="zipCode" class="form-label">Postcode</label>
                          <input type="text" class="form-control" id="zipCode" name="zip_code" placeholder="40000" value = "<?php echo $zip_code;?>" maxlength="6" required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="country" class="form-label">Country</label>
                          <input class="form-control" type="text" id="country" name="country" placeholder="Malaysia" value = "<?php echo $country;?>" required />
                        </div>
						<div class="mb-3 col-md-6">
                          <label class="form-label" for="status">Status</label>
						  <select id="status"name="status" class="form-select" required>
								<option value="">Select</option>
								<option value="active" <?php if($status == "active") echo "selected"; ?>>active</option>
								<option value="inactive" <?php if($status == "inactive") echo "selected"; ?>>inactive</option>
							</select>				
                        </div>
                      </div>
                      <div class="col-12 d-flex justify-content-end">
							<input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>" required>
                            <input type="hidden" name="purpose" value="editstaff" required>
							<button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<?php if(isset($_SESSION['result']) && $_SESSION['result'] != ""){?> <!-- isset = check ada atau tak & name mesti tak kosong -->
	<script>
	Swal.fire({
			title: '<?php echo $_SESSION['result']; ?>',
			text: '<?php echo $_SESSION['message']; ?>',
			icon: '<?php echo $_SESSION['icon']; ?>'
		})
	</script>
	<?php unset($_SESSION['result']); }?> <!--tak keluar result banyak kali-->
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- End custom js for this page -->
  </body>
</html>
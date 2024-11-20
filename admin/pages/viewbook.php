<!--use readonly-->

<?php
session_start();
require('../../config/database.php');

// Retrieve booking_id from the URL
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$id = base64_decode($id); // die get data dri encode

// Fetch booking information from the database
$sql = "SELECT customer.customer_id, customer.customer_name, customer.email, customer.phone_no, booking.checkin, booking.checkout, booking.no_day, booking.room_name, booking.no_pax, booking.request, booking.status,
rooms.room_id, booking.booking_id
        FROM 
            booking
        INNER JOIN 
            customer 
        ON 
            booking.customer_id = customer.customer_id
        INNER JOIN 
            rooms 
        ON 
            booking.room_id = rooms.room_id
        WHERE 
            booking.booking_id = '$id'";

$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
while($row = $result->fetch_array(MYSQLI_BOTH)) { 
  $customer_name = $row['customer_name'];
  $customer_id = $row['customer_id'];
  $email = $row['email'];
  $phone_no = $row['phone_no'];
  $booking_id = $row['booking_id'];
  $checkin = $row['checkin'];
  $checkout = $row['checkout'];
  $room_name = $row['room_name'];
  $no_day = $row['no_day'];
  $no_pax = $row['no_pax'];
  $request = $row['request'];
  $status = $row['status'];
  $room_id = $row['room_id'];
}
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>View Customer Booking</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking /</span> View Booking</h4>
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Customer Information</h5>
                    <!-- Booking -->
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
						<div class="mb-3 col-md-12">
                            <label for="firstName" class="form-label">Full Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="customer_name"
                              name="customer_name"
                              value="<?php echo $customer_name;?>" readonly
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Booking Id</label>
                            <input
                              class="form-control"
                              type="text"
                              id="booking_id"
                              name="booking_id"
                              value="<?php echo $booking_id;?>" readonly
                            />
                          </div>
						  <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">NRIC</label>
                            <input
                              class="form-control"
                              type="text"
                              id="customer_id"
                              name="customer_id"
                              value="<?php echo $customer_id;?>" readonly
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="email"
                              id="email"
                              name="email"
                              placeholder="customername@gmail.com"
                              value="<?php echo $email;?>" readonly
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">MALAYSIA (+60)</span>
                              <input
                                type="text"
                                id="phone_no"
                                name="phone_no"
                                class="form-control"
                                placeholder="013 456 7890"
								                value="<?php echo $phone_no;?>" readonly
                              />
                            </div>
                          </div>
						  <div class="mb-3 col-md-6">
							<label class="form-label" for="checkIn">Date Check In</label>
							<input
								type="timestamp"
								id="checkin"
								name="checkin"
								class="form-control"
                value="<?php echo $checkin;?>" readonly
							  />
						  </div>
						  
						  <div class="mb-3 col-md-6">
							<label class="form-label" for="checkout">Date Check Out</label>
							<input
								type="timestamp"
								id="checkout"
								name="checkout"
								class="form-control"
                value="<?php echo $checkout;?>" readonly
							  />
						  </div>
						  
						  <div class="mb-3 col-md-4">
								<label class="form-label" for="roomtype">Room Type</label> 
								<input
									type="text"
									id="room_name"
									name="room_name"
									class="form-control"
                  value="<?php echo $room_name;?>" readonly
									required
								/>
							</div>
							<div class="mb-3 col-md-4">
								<label class="form-label" for="dayno">Number of days</label> 
								<input
									type="number"
									id="no_day"
									name="no_day"
									class="form-control"
									min="1"
                  value="<?php echo $no_day;?>" readonly
									required
								/>
							</div>

							<div class="mb-3 col-md-4">
								<label class="form-label" for="no_pax">Number of pax</label> 
								<input
									type="number"
									id="no_pax"
									name="no_pax"
									class="form-control"
									min="1"
                  value="<?php echo $no_pax;?>" readonly
									required
								/>
							</div>

							<div class="mb-3 col-md-12">
								<label class="form-label" for="request">Special requests</label> 
								<input
									id="request"
									name="request"
									class="form-control"
									rows="3"
                  value="<?php echo $request;?>" readonly
								>
							</div>
							
							<div class="mb-3 col-md-12">
							  <label class="form-label" for="status">Status Booking</label> 
							  <input id="status" name="status" class="form-control" value="<?php echo $status;?>" readonly>
								
							</div>


                        </div>
                        <div class="mt-2">
                          <a href="listbook.php" class="btn btn-primary me-2">Back</a>
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
  </body>
</html>
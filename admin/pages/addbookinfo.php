<?php


$booking_id = 'B2024' . str_pad(rand(0, 9999999), 6, '0', STR_PAD_LEFT);

?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Add Customer Booking</title>

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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking /</span> Add Booking</h4>
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Booking Information</h5>
                    <!-- Booking -->
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings"  >
                        <div class="row">
						  <div class="mb-3 col-md-6">
                            <label for="booking_id" class="form-label">Booking Number</label>
                            <input
                              class="form-control"
                              type="text"
                              id="booking_id"
                              name="booking_id"
							  value="<?php echo $booking_id; ?>"
                              readonly
                            />
                          </div>
						  <div class="mb-3 col-md-6">
                            <label for="customer_id" class="form-label">IC Number</label>
                            <input
                              class="form-control"
                              type="text"
                              id="customer_id"
                              name="customer_id"
                              autofocus
                            />
                          </div>
						  <div class="mb-3 col-md-12">
                            <label for="customer_name" class="form-label">Full Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="customer_name"
                              name="customer_name"
                              autofocus
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
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phone_no">Phone Number</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">MALAYSIA (+60)</span>
                              <input
                                type="text"
                                id="phone_no"
                                name="phone_no"
                                class="form-control"
                                placeholder="013 456 7890"
								value = ""
                              />
                            </div>
                          </div>
						  <div class="mb-3 col-md-6">
							<label class="form-label" for="checkin">Date Check In</label>
							<input
								type="date"
								id="checkin"
								name="checkin"
								class="form-control"
							  />
						  </div>
						  
						  <div class="mb-3 col-md-6">
							<label class="form-label" for="checkout">Date Check Out</label>
							<input
								type="date"
								id="checkout"
								name="checkout"
								class="form-control"
							  />
						  </div>
						    <div class="mb-3 col-md-3">
								<label class="form-label" for="roomtype">Room Type</label>
								<select id="roomtype" name="roomtype" class="form-control" required>
									<option value="">Select Room Type</option>
									<option value="standard room">Standard Room (100-120)</option>
									<option value="deluxe room">Deluxe Room (200-220)</option>
									<option value="studio">Studio (300-320)</option>
									<option value="suite">Suite (400-420)</option>
								</select>
							</div>
							<div class="mb-3 col-md-3">
								<label class="form-label" for="room_id">Room Number</label>
								<select id="room_id" name="room_id" class="form-control" required>
									<option value="">Select Room Number</option>
								</select>
							</div>
							<div class="mb-3 col-md-3">
								<label class="form-label" for="howManyRooms">Number of Rooms</label>
								<input
									type="number"
									id="no_room"
									name="no_room"
									class="form-control"
									min="1"
									required
								/>
							</div>
							<div class="mb-3 col-md-3">
								<label class="form-label" for="no_pax">Number of Pax</label>
								<input
									type="number"
									id="no_pax"
									name="no_pax"
									class="form-control"
									min="1"
									required
								/>
							</div>
							<div class="mb-3 col-md-12">
								<label class="form-label" for="request">Special requests</label>
								<textarea
									id="request"
									name="request"
									class="form-control"
									rows="3"
								></textarea>
							</div>

                        </div>
                        <div class="mt-2 d-flex justify-content-end">
							
							<button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
							<button type="submit" class="btn btn-primary me-2">Submit</button>
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
	<script>
        document.getElementById('roomtype').addEventListener('change', function() {
            var roomType = this.value;
            var roomNumberSelect = document.getElementById('room_id');
            roomNumberSelect.innerHTML = '<option value="">Select Room Number</option>'; // Clear previous options

            var start, end;
            switch(roomType) {
                case 'standard room':
                    start = 100;
                    end = 120;
                    break;
                case 'deluxe room':
                    start = 200;
                    end = 220;
                    break;
                case 'studio':
                    start = 300;
                    end = 320;
                    break;
                case 'suite':
                    start = 400;
                    end = 420;
                    break;
                default:
                    return; // Exit if no valid room type selected
            }

            for (var i = start; i <= end; i++) {
                var option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                roomNumberSelect.appendChild(option);
            }
        });
    </script>
  </body>
</html>

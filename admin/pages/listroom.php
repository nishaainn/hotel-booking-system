<?php

session_start();
require('../../config/database.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

$sql = "SELECT room_id, room_name, status, description FROM rooms";

$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>List Rooms</title>

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

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
	
    <style>
      .btn-group {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
      }
      .btn-group .btn {
        width: 100px;
        margin-bottom: 5px;
        font-size: 0.875rem;
        padding: 5px 10px;
      }
      .btn-group .btn:last-child {
        margin-bottom: 0;
      }
    </style>
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Rooms /</span> List Rooms</h4>
              <div class="row">
                <div class="col-md-12">
                  <!-- Bordered Table -->
                  <div class="card">
                    <h5 class="card-header"> List Rooms</h5>
                    <div class="card-body">
                      <div class="table-responsive text-nowrap">
                        <table class="table table-bordered" id="bookingTable">
                          <thead>
                            <tr>
                              <th>Room ID</th>
                              <th>Room Type</th>
                              <th>Bed</th>
                              <th><center>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php while ($row = $result->fetch_array(MYSQLI_BOTH)) { ?>
                            <tr>
                                  <td> <?php echo $row['room_id']; ?> </td>
                                  <td> <?php echo $row['room_name']; ?> </td>
                                  <td> <?php echo $row['status']; ?> </td>

								  <td><center>
										<a target="_blank" class="btn btn-warning" href="editroom.php?id=<?php echo $row['room_id']; ?>">
											<span class="bx bx-edit-alt me-1"> </span> Edit
										</a>
										<a class="btn btn-danger" href="../process/deleteroom.php?id=<?php echo base64_encode($row['room_id']); ?>&purpose=deleteRoom">
										  <span class="bx bx-trash me-1"></span> Delete
										</a><center>
								  </td>
                            </tr>
                          <?php } ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!--/ Bordered Table -->
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

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#bookingTable').DataTable();
      });
    </script>
  </body>
</html>
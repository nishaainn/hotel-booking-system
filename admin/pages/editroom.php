<?php

session_start();
require ('../../config/database.php');
require('../../config/security.php');


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

$sql = "SELECT * FROM rooms WHERE room_id = '$id'";
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
while ($row = $result->fetch_array(MYSQLI_BOTH)) {
    $room_id = $row['room_id'];
    $room_name = $row['room_name'];
    $description = $row['description'];
    $price = $row['price'];
    $status = $row['status'];
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
            <?php include ('./include/sidebar.php'); ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include ('./include/navbar.php'); ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Rooms /</span> Update Room
                        </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Update Room</h5>
                                    <!-- Account -->
                                    <hr class="my-0" />
                                    <div class="card-body">
                                        <form id="formAccountSettings" method="POST" action="../process/update.php">
                                            <div class="row">
                                                <div class="mb-3 col-md-12">
                                                    <label for="currentPassword" class="form-label">Room No</label>
                                                    <input class="form-control" type="text" id="roomNo" name="room_id"
                                                        value="<?php echo $room_id; ?>" autofocus />
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label for="currentPassword" class="form-label">Room Name</label>
                                                    <input class="form-control" type="text" id="roomNo" name="room_name"
                                                        value="<?php echo $room_name; ?>" autofocus />
                                                </div>
                                                <div>
                                                    <label for="exampleFormControlTextarea1"
                                                        class="form-label">Description</label>
                                                    <textarea class="form-control" id="description" rows="3"
                                                        name="description"><?php echo $description; ?></textarea>
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label for="confirmPassword" class="form-label">Price</label>
                                                    <input class="form-control" type="text" id="priceRoom" name="price"
                                                        value="<?php echo $price; ?>" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-select" id="status"
                                                        aria-label="Default select example" name="status">
                                                        <option selected>Status</option>
                                                        <option value="available" <?php if ($status == 'available') {
                                                            echo "selected";
                                                        } ?>>Available</option>
                                                        <option value="unavailable" <?php if ($status == 'unavailable') {
                                                            echo "selected";
                                                        } ?>>Unavailable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <input type="hidden" name="room_id" value="<?php echo $room_id; ?>"
                                                    required>
                                                <input type="hidden" name="purpose" value="rooms" required>
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
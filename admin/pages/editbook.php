<?php
session_start();
require('../../config/database.php');
require('../../config/security.php');


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$id = base64_decode($id); // die get data dri encode

$sql = "SELECT 
    customer.customer_name,  
    customer.phone_no,
    customer.email, 
    booking.customer_id, 
    booking.booking_id, 
    booking.checkin, 
    booking.checkout, 
    booking.room_name, 
    booking.no_pax, 
    booking.no_day, 
    booking.room_id, 
    booking.total, 
    booking.status, 
    booking.request
FROM 
    booking 
INNER JOIN 
    customer 
ON 
    booking.customer_id = customer.customer_id 
WHERE 
    booking.booking_id = '$id ';
";
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
while ($row = $result->fetch_array(MYSQLI_BOTH)) {
    $customer_id = $row['customer_id'];
    $booking_id = $row['booking_id'];
    $checkin = $row['checkin'];
    $checkout = $row['checkout'];
    $room_name = $row['room_name'];
    $no_pax = $row['no_pax'];
    $no_day = $row['no_day'];
    $total = $row['total'];
    $request = $row['request'];
    $room_id = $row['room_id'];
    $status = $row['status'];
    $customer_id = $row['customer_id'];
    $email = $row['email'];
    $phone_no = $row['phone_no'];
    $customer_name = $row['customer_name'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Edit Booking</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/png" href="../assets/img/logo/icon.png" sizes="128x128" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="../assets/js/config.js"></script>
</head>

<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include('./include/sidebar.php'); ?>
        <div class="layout-page">
            <?php include('./include/navbar.php'); ?>
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking /</span> Add Booking</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Booking Information</h5>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <form id="formAccountSettings" method="POST" action="../process/update.php">
										<input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>" required>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="booking_id" class="form-label">Booking Number</label>
                                                <input class="form-control" type="text" id="booking_id" name="booking_id" value="<?php echo $booking_id; ?>" readonly />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="customer_id" class="form-label">IC Number</label>
                                                <input class="form-control" type="text" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>" readonly />
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="customer_name" class="form-label">Full Name</label>
                                                <input class="form-control" type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" autofocus />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" type="email" id="email" name="email" value="<?php echo $email; ?>" readonly />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="phone_no">Phone Number</label>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">MALAYSIA (+60)</span>
                                                    <input type="text" id="phone_no" name="phone_no" class="form-control" value="<?php echo $phone_no; ?>" />
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label" for="checkin">Date Check In</label>
                                                <input type="date" id="checkin" name="checkin" class="form-control" value="<?php echo $checkin; ?>"/>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label" for="checkout">Date Check Out</label>
                                                <input type="date" id="checkout" name="checkout" class="form-control" value="<?php echo $checkout; ?>" />
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label" for="no_pax">Number of Pax</label>
                                                <input type="number" id="no_pax" name="no_pax" class="form-control" min="1" max="5" value="<?php echo $no_pax; ?>" required />
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label" for="no_day">No of Stay</label>
                                                <input type="number" id="no_day" name="no_day" class="form-control" value="<?php echo $no_day; ?>" required readonly />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="room_name">Room Type</label>
                                                <select id="room_name" name="room_name" class="form-control" required>
                                                    <option value="standard" <?php if($room_name == "standard") echo "selected"; ?>>Standard Room (RM150)</option>
                                                    <option value="deluxe" <?php if($room_name == "deluxe") echo "selected"; ?>>Deluxe Room (RM180)</option>
                                                    <option value="studio" <?php if($room_name == "studio") echo "selected"; ?>>Studio (RM250)</option>
                                                    <option value="suite" <?php if($room_name == "suite") echo "selected"; ?>>Suite (RM280)</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="room_id">Room Number</label>
                                                <input type="number" id="room_id" name="room_id" class="form-control" value="<?php echo $room_id; ?>" required />
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label" for="total">Total Price</label>
                                                <input type="text" id="total" name="total" class="form-control" value="<?php echo $total; ?>" readonly />
                                            </div>
											<div class="mb-3 col-md-6">
                                                <label class="form-label" for="status">Status booking</label>
                                                <select id="status" name="status" class="form-control" required>
                                                    <option value="confirm" <?php if($status == "confirm") echo "selected"; ?>>Confirm Booking</option>
                                                    <option value="cancel" <?php if($status == "cancel") echo "selected"; ?>>Cancel Booking</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="request">Special requests</label>
                                                <textarea id="request" name="request" class="form-control"  rows="3"><?php echo $request; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="mt-2 d-flex justify-content-end">
											<input type="hidden" name="purpose" value="editbooking" required>
                                            <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
                                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../assets/vendor/js/menu.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/pages-account-settings-account.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Room Type and Room Number Dynamic Generation Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var today = new Date();
    var tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);

    document.getElementById('checkin').setAttribute('min', today.toISOString().split('T')[0]);
    var checkoutInput = document.getElementById('checkout');
    checkoutInput.setAttribute('min', tomorrow.toISOString().split('T')[0]);

    var checkinInput = document.getElementById('checkin');
    checkinInput.addEventListener('change', function () {
        var selectedCheckinDate = new Date(checkinInput.value);
        var nextDay = new Date(selectedCheckinDate);
        nextDay.setDate(selectedCheckinDate.getDate() + 1);
        checkoutInput.setAttribute('min', nextDay.toISOString().split('T')[0]);
    });

    function calculateDays() {
        var checkin = new Date(document.getElementById('checkin').value);
        var checkout = new Date(document.getElementById('checkout').value);
        var diffTime = checkout - checkin;
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        return diffDays;
    }

    function calculateTotal() {
        var roomType = document.getElementById('room_name').value;
        var roomPrice = 0;
        switch (roomType) {
            case 'standard':
                roomPrice = 150;
                break;
            case 'deluxe':
                roomPrice = 180;
                break;
            case 'studio':
                roomPrice = 250;
                break;
            case 'suite':
                roomPrice = 280;
                break;
        }
        var days = calculateDays();
        var total = roomPrice * days;
        document.getElementById('no_day').value = days;
        document.getElementById('total').value = total;
    }

    document.getElementById('checkin').addEventListener('change', calculateTotal);
    document.getElementById('checkout').addEventListener('change', calculateTotal);
    document.getElementById('room_name').addEventListener('change', calculateTotal);
});
</script>
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


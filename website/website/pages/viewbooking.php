<?php
session_start();
require ("../../config/database.php");
require ("../../config/securityWeb.php");

$menu = "Booked";

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$id = base64_decode($id); // die get data dri encode

// GET BOOK DETAILS
$sql = "SELECT * FROM booking WHERE booking_id = '$id'";
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
    $status = $row['status'];
    $customer_id = $row['customer_id'];
}


?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hotel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <!-- Place favicon.ico in the root directory -->
    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
</head>

<body>
    <?php include ('include/navbar.php'); ?>
    <main>
        <!-- slider Area Start-->
        <div class="slider-area">
            <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
                data-background="../assets/img/hero/updatebook.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-11 offset-xl-1 offset-lg-1 offset-md-1">
                            <div class="hero-caption">
                                <span>Booking</span>
                                <h2>View Booking Customer</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End--><br><br><br><br><br>

        <!-- Booking Form Start -->
        <div class="booking-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="booking-form">
                            <h3>Book Your Stay</h3>
                            <form id="formAccountSettings" method="POST" action="../process/register.php">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="checkIn">NRIC</label>
                                        <input type="text" id="customer_id" name="customer_id" class="form-control"
                                            value="<?php echo $customer_id; ?>" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="checkIn">BOOKING ID</label>
                                        <input type="text" id="customer_id" name="customer_id" class="form-control"
                                            value="<?php echo $booking_id; ?>" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="checkIn">DATE CHECK IN</label>
                                        <input type="date" id="checkin" name="checkin" class="form-control"
                                            value="<?php echo $checkin; ?>" readonly />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="checkOut">DATE CHECK OUT</label>
                                        <input type="date" id="checkout" name="checkout" class="form-control"
                                            value="<?php echo $checkout; ?>" readonly />
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="room_name" class="form-label">TYPE OF ROOM</label>
                                        <input type="text" id="room_name" name="room_name" class="form-control"
                                            value="<?php echo $room_name; ?>" readonly />
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="no_pax">NUMBER OF PAX</label>
                                        <input type="number" id="no_pax" name="no_pax" class="form-control" min="1"
                                            value="<?php echo $no_pax; ?>" readonly />
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="totalday">NO OF STAY</label>
                                        <input type="text" id="no_day" name="no_day" class="form-control" required
                                            value="<?php echo $no_day; ?>" readonly />
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="total">TOTAL PRICE</label>
                                        <input type="text" id="total" name="total" class="form-control" required
                                            value="<?php echo $total; ?>" readonly />
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="total">STATUS</label>
                                        <input type="text" id="status" name="status" class="form-control" required
                                            value="<?php echo $status; ?>" readonly />
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="specialrequest">SPECIAL REQUEST</label>
                                        <textarea id="request" name="request" class="form-control" rows="3"
                                            readonly><?php echo $request; ?></textarea>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="bookinghistory.php" type="submit" class="btn btn-primary me-2">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking Form End --><br><br>
        <?php include ('include/footer.php'); ?>

        <!-- JS here -->
        <!-- All JS Custom Plugins Link Here here -->
        <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
        <!-- Jquery, Popper, Bootstrap -->
        <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <!-- Jquery Mobile Menu -->
        <script src="../assets/js/jquery.slicknav.min.js"></script>
        <!-- Jquery Slick, Owl-Carousel Plugins -->
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/slick.min.js"></script>
        <!-- Date Picker -->
        <script src="../assets/js/gijgo.min.js"></script>
        <!-- One Page, Animated-HeadLin -->
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/animated.headline.js"></script>
        <!-- Scrollup, nice-select, sticky -->
        <script src="../assets/js/jquery.scrollUp.min.js"></script>
        <script src="../assets/js/jquery.nice-select.min.js"></script>
        <script src="../assets/js/jquery.sticky.js"></script>
        <script src="../assets/js/jquery.magnific-popup.js"></script>
        <!-- contact js -->
        <script src="../assets/js/contact.js"></script>
        <script src="../assets/js/jquery.form.js"></script>
        <script src="../assets/js/jquery.validate.min.js"></script>
        <script src="../assets/js/mail-script.js"></script>
        <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
        <!-- Jquery Plugins, main Jquery -->
        <script src="../assets/js/plugins.js"></script>
        <script src="../assets/js/main.js"></script>

        <!-- Custom JavaScript -->
        <script>
            function cancelBooking() {
                const bookingId = document.getElementById('bookingId').value;
                if (!bookingId) {
                    alert('Please enter your Booking ID to cancel your booking.');
                    return;
                }
                // Add AJAX request to send booking ID to the server for cancellation
                alert('Your booking has been cancelled successfully.');
            }
        </script>
</body>

</html>
<?php
session_start();
require ('../../config/database.php');

// Check if customer is logged in
if (!isset($_SESSION['customer_id'])) {
    // Redirect to login page if not logged in
    header('Location: login/login.php');
    exit;
}

// Generate a unique booking ID
$booking_id = 'B0' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
$customer_id = $_SESSION['customer_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $checkin = mysqli_real_escape_string($con, $_POST['checkin']);
    $checkout = mysqli_real_escape_string($con, $_POST['checkout']);
    $room_name = mysqli_real_escape_string($con, $_POST['room_name']);
    $no_pax = mysqli_real_escape_string($con, $_POST['no_pax']);
    $no_day = mysqli_real_escape_string($con, $_POST['no_day']);
    $total = mysqli_real_escape_string($con, $_POST['total']);
    $request = mysqli_real_escape_string($con, $_POST['request']);

    // Use prepared statements for better security
    $stmt = $con->prepare("INSERT INTO booking (booking_id, customer_id, checkin, checkout, room_name, no_pax, no_day, total, request) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssids", $booking_id, $customer_id, $checkin, $checkout, $room_name, $no_pax, $no_day, $total, $request);

    if ($stmt->execute()) {
        $_SESSION['result'] = "Success!";
        $_SESSION['message'] = "Booking saved successfully.";
        $_SESSION['icon'] = "success";
        header("Location: payment.php?id=$booking_id&purpose=payment");
        exit();
    } else {
        $_SESSION['result'] = "Error!";
        $_SESSION['message'] = "Booking could not be saved. Please try again.";
        $_SESSION['icon'] = "error";
    }

    $stmt->close();
    $con->close();
}
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <!-- Head content as before -->
</head>
<body>
    <?php include ('include/navbarmember.php'); ?>
    <main>
        <!-- Slider Area and other content as before -->

        <!-- Booking Form Start -->
        <div class="booking-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="booking-form">
                            <h3>Book Your Stay</h3>
                            <?php if (isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['icon']; ?>">
                                    <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                                </div>
                            <?php endif; ?>
                            <form id="formAccountSettings" method="POST">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="booking_id">Booking ID</label>
                                        <input type="text" id="booking_id" name="booking_id" class="form-control"
                                            value="<?php echo $booking_id; ?>" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="checkin">Date Check In</label>
                                        <input type="date" id="checkin" name="checkin" class="form-control"
                                            onchange="calculateDaysAndTotal()" required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="checkout">Date Check Out</label>
                                        <input type="date" id="checkout" name="checkout" class="form-control"
                                            onchange="calculateDaysAndTotal()" required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="room_name" class="form-label">Type of Room</label>
                                        <select id="room_name" name="room_name" class="form-select" required
                                            onchange="calculateDaysAndTotal()">
                                            <option value="">Select Room</option>
                                            <option value="standard">Standard Room (RM150)</option>
                                            <option value="deluxe">Deluxe Room (RM180)</option>
                                            <option value="studio">Studio (RM250)</option>
                                            <option value="suite">Suite (RM280)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="no_pax">Number of Pax</label>
                                        <input type="number" id="no_pax" name="no_pax" class="form-control" min="1"
                                            required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="no_day">No of Stay</label>
                                        <input type="text" id="no_day" name="no_day" class="form-control" required
                                            readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="total">Total Price</label>
                                        <input type="text" id="total" name="total" class="form-control" required
                                            readonly />
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="request">Special Request</label>
                                        <textarea id="request" name="request" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input type="hidden" name="purpose" value="bookingform" required>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <a href="index.php" type="reset" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking Form End -->

        <!-- Footer content as before -->
    </main>

    <!-- JS here -->

    <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/slick.min.js"></script>
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/animated.headline.js"></script>
    <script src="../assets/js/jquery.magnific-popup.js"></script>
    <script src="../assets/js/gijgo.min.js"></script>
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    <script src="../assets/js/jquery.barfiller.js"></script>
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.countdown.min.js"></script>
    <script src="../assets/js/hover-direction-snake.min.js"></script>
    <script src="../assets/js/contact.js"></script>
    <script src="../assets/js/jquery.form.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
    <script>
        // JavaScript function to calculate number of days and total price
        function calculateDaysAndTotal() {
            const checkin = new Date(document.getElementById('checkin').value);
            const checkout = new Date(document.getElementById('checkout').value);
            const roomName = document.getElementById('room_name').value;
            let roomPrice = 0;

            switch (roomName) {
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

            const timeDifference = checkout.getTime() - checkin.getTime();
            const daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));

            if (!isNaN(daysDifference) && roomName) {
                document.getElementById('no_day').value = daysDifference;
                document.getElementById('total').value = daysDifference * roomPrice;
            } else {
                document.getElementById('no_day').value = '';
                document.getElementById('total').value = '';
            }
        }
    </script>
</body>
</html>

<?<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reklhotel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$booking_id = 'B0' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $room_name = $_POST['room_name'];
    $no_pax = $_POST['no_pax'];
    $no_day = $_POST['no_day'];
    $total = $_POST['total'];
    $request = $_POST['request'];
    $room_id = $_POST['room_id'];

    // Insert customer data into customer table
    $customer_sql = "INSERT INTO customer (customer_id, customer_name, phone_no, email) VALUES ('$customer_id', '$customer_name', '$phone_no', '$email')";
    if ($conn->query($customer_sql) === TRUE) {
        // Insert booking data into booking table
        $booking_sql = "INSERT INTO booking (booking_id, customer_id, checkin, checkout, room_name, no_pax, no_day, total, request, room_id) VALUES ('$booking_id', '$customer_id', '$checkin', '$checkout', '$room_name', '$no_pax', '$no_day', '$total', '$request', '$room_id')";
        if ($conn->query($booking_sql) === TRUE) {
            echo "New booking created successfully";
        } else {
            echo "Error: " . $booking_sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $customer_sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Admin Booking</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/png" href="../assets/img/logo/icon.png" sizes="128x128" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
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
            <?php include ('./include/sidebar.php'); ?>
            <div class="layout-page">
                <?php include ('./include/navbar.php'); ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Booking /</span> Add Booking
                        </h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Booking Information</h5>
                                    <hr class="my-0" />
                                    <div class="card-body">
                                        <form id="formAccountSettings" method="POST" action="">
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="booking_id" class="form-label">Booking Number</label>
                                                    <input class="form-control" type="text" id="booking_id"
                                                        name="booking_id" value="<?php echo $booking_id; ?>" readonly />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="customer_id" class="form-label">IC Number</label>
                                                    <input class="form-control" type="text" id="customer_id"
                                                        name="customer_id" autofocus />
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label for="customer_name" class="form-label">Full Name</label>
                                                    <input class="form-control" type="text" id="customer_name"
                                                        name="customer_name" autofocus />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="email" class="form-label">E-mail</label>
                                                    <input class="form-control" type="email" id="email" name="email"
                                                        placeholder="customername@gmail.com" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="phone_no">Phone Number</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text">MALAYSIA (+60)</span>
                                                        <input type="text" id="phone_no" name="phone_no"
                                                            class="form-control" placeholder="013 456 7890" value="" />
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                    <label class="form-label" for="checkin">Date Check In</label>
                                                    <input type="date" id="checkin" name="checkin"
                                                        class="form-control" />
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                    <label class="form-label" for="checkout">Date Check Out</label>
                                                    <input type="date" id="checkout" name="checkout"
                                                        class="form-control" />
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                    <label class="form-label" for="no_pax">Number of Pax</label>
                                                    <input type="number" id="no_pax" name="no_pax" class="form-control"
                                                        min="1" max="5" required />
                                                </div>
                                                <div class="mb-3 col-md-3">
                                                    <label class="form-label" for="no_day">No of Stay</label>
                                                    <input type="number" id="no_day" name="no_day" class="form-control"
                                                        required readonly />
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label class="form-label" for="room_name">Room Type</label>
                                                    <select id="room_name" name="room_name" class="form-control"
                                                        required>
                                                        <option value="standard">Standard Room (RM150)</option>
                                                        <option value="deluxe">Deluxe Room (RM180)</option>
                                                        <option value="studio">Studio (RM250)</option>
                                                        <option value="suite">Suite (RM280)</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label class="form-label" for="room_id">Room Number</label>
                                                    <input type="number" id="room_id" name="room_id"
                                                        class="form-control" required />
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label class="form-label" for="total">Total Price</label>
                                                    <input type="text" id="total" name="total" class="form-control"
                                                        readonly />
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label" for="request">Special requests</label>
                                                    <textarea id="request" name="request" class="form-control"
                                                        rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="mt-2 d-flex justify-content-end">
                                                <button type="reset"
                                                    class="btn btn-outline-secondary me-2">Reset</button>
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
</body>

</html>
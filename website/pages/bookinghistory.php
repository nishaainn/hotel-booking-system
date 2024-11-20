<?php
session_start();
require ('../../config/database.php');
require ('../../config/securityWeb.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

$sql10 = "SELECT customer.email, customer.customer_id, booking.booking_id, booking.checkin, booking.checkout, booking.room_name
FROM booking 
INNER JOIN customer ON booking.customer_id = customer.customer_id 
WHERE customer.email = '$user'";
$result10 = mysqli_query($con, $sql10);


?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hotel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/logo/icon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <style>
        .btn-manage,
        .btn-view {
            padding: 15px 15px;
            font-size: 14px;
            width: 175px;
            margin: 5px 0;
        }

        .btn-manage {
            background-color: #007bff;
            color: white;
        }

        .btn-view {
            background-color: #28a745;
            color: white;
        }

        .btn-manage:hover {
            background-color: #0056b3;
        }

        .btn-view:hover {
            background-color: #218838;
        }

        .booking-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            box-shadow: 0 2px 15px rgba(64, 64, 64, 0.1);
            background-color: #f8f9fa;
        }

        .booking-table th,
        .booking-table td {
            padding: 12px 15px;
            text-align: left;
        }

        .booking-table thead {
            background-color: #707B7C;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        .booking-table td .btn {
            margin: 2px 0;
        }

        .booking-table td i {
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <?php include ('include/navbarmember.php'); ?>
    <main>
        <div class="slider-area">
            <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
                data-background="../assets/img/hero/roomspage_hero.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-11 offset-xl-1 offset-lg-1 offset-md-1">
                            <div class="hero-caption">
                                <span>Booking</span>
                                <h2>Booking History</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br><br><br><br>

        <div class="booking-area">
            <div class="container">
                <h2 class="mt-3">Manage and View Bookings</h2>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="bookingTable" class="table booking-table">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Check-in Date</th>
                                    <th>Check-out Date</th>
                                    <th>Room Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($result10, MYSQLI_ASSOC)) { ?>
                                    <tr>
                                        <td><?php echo $row['booking_id']; ?></td>
                                        <td><?php echo $row['checkin']; ?></td>
                                        <td><?php echo $row['checkout']; ?></td>
                                        <td><?php echo $row['room_name']; ?></td>
                                        <td class="d-flex flex-column align-items-start">
                                            <a href="viewbooking.php?id=<?php echo base64_encode($row['booking_id']); ?>"
                                                class="btn btn-manage"><i class="fa fa-edit"></i> Manage Booking</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php include ('include/footer.php'); ?>

        <!-- JS here -->
        <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.slicknav.min.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/slick.min.js"></script>
        <script src="../assets/js/gijgo.min.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/animated.headline.js"></script>
        <script src="../assets/js/jquery.scrollUp.min.js"></script>
        <script src="../assets/js/jquery.nice-select.min.js"></script>
        <script src="../assets/js/jquery.sticky.js"></script>
        <script src="../assets/js/jquery.magnific-popup.js"></script>
        <script src="../assets/js/contact.js"></script>
        <script src="../assets/js/jquery.form.js"></script>
        <script src="../assets/js/jquery.validate.min.js"></script>
        <script src="../assets/js/mail-script.js"></script>
        <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
        <script src="../assets/js/plugins.js"></script>
        <script src="../assets/js/main.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#bookingTable').DataTable({
                    responsive: true,
                    columnDefs: [
                        {
                            targets: [0, 1, 2, 3, 4, 5],
                            className: 'dt-head-center'
                        }
                    ]
                });
            });
        </script>
</body>

</html>
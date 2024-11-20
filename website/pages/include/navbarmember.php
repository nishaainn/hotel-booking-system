<?php

require ('../../config/database.php');
require ('../../config/securityWeb.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

$sql = "SELECT * FROM customer WHERE email = '$user'";
$result = mysqli_query($con, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $customer_id = $row['customer_id'];
    $customer_name = $row['customer_name'];
    $email = $row['email'];
    $phone_no = $row['phone_no'];

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Adjust the button size and style */
        .btn-sm {
            font-size: 16px;
            /* Increase font size */
            padding: 10px 15px;
            /* Increase padding */
            border-radius: 5px;
            background-color: transparent;
            /* Remove background color */
            border: 1px solid black;
            /* Add black border */
            color: black;
            /* Ensure button text is black */
        }

        .dropdown-menu {
            min-width: 150px;
            /* Adjust width as needed */
        }

        .dropdown-item {
            font-size: 14px;
            padding: 10px 15px;
            color: black;
            /* Ensure dropdown item text is black */
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
            /* Change background color on hover */
            color: #333;
            /* Change text color on hover */
        }

        .dropdown-toggle::after {
            margin-left: 10px;
            /* Adjust arrow position */
        }

        #userDropdown img {
            width: 25px;
            /* Adjust image size */
            margin-right: 10px;
            /* Adjust margin */
        }
    </style>
    <title>Header with Dropdown</title>
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <strong>Hotel</strong>
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
        <div class="header-area header-sticky">
            <div class="main-header">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- logo -->
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="../index.php"><img src="../assets/img/logo/hotel.png" alt="Re' hotel logo"
                                        width="150"></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <!-- main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="member_index.php">Home</a></li>
                                        <li><a href="member_about.php">About</a></li>
                                        <li><a href="member_accomodations.php">Accommodations</a></li>
                                        <li><a href="member_contact.php">Contact</a></li>
                                        <li><a href="bookinghistory.php">Booking</a></li>
                                        <li><a href="chooseroom.php">Rooms</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2">
                            <!-- header-btn -->
                            <div class="dropdown">
                                <button class="btn btn-sm dropdown-toggle" type="button" id="userDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../assets/img/user-icon.jfif" alt="User Icon">
                                    <span class="username"><?php echo $customer_name; ?></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="changepassword.php">Change Password</a>
                                    <a class="dropdown-item" href="../process/logout.php">Logout</a>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
</body>

</html>
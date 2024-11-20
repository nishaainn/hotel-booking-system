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
  <?php include ('include/navbarmember.php'); ?>
<main>
    <!-- slider Area Start-->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center" data-background="../assets/img/hero/updatebook.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 offset-xl-1 offset-lg-1 offset-md-1">
                        <div class="hero-caption">
                            <span>Booking</span>
                            <h2>Edit Booking Customer</h2>
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
                        <center><h3><strong>Update Your Booking</h3></center><br>
                        <form id="formUpdateBooking" method="POST" action="updateBooking.php">
                            <div class="row">
								<div class="mb-3 col-md-6">
									<label for="bookingId" class="form-label">Booking ID</label>
									<input class="form-control" type="text" id="bookingId" name="bookingId" readonly />
								</div>
								<div class="mb-3 col-md-6">
                                    <label for="status" class="form-label">Status Booking</label>
									<select id="state" class="form-select" required autofocus>
										<option value="confirm">confirm</option>
										<option value="cancel">cancel</option>
								    </select>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="fullName" class="form-label">Full Name</label>
                                    <input class="form-control" type="text" id="fullName" name="fullName" value="SITI NURSHALINDA" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="email" id="email" name="email" placeholder="customername@gmail.com"/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">MALAYSIA (+60)</span>
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="013 456 7890"/>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="checkIn">Date Check In</label>
                                    <input type="date" id="checkIn" name="checkIn" class="form-control"/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="checkOut">Date Check Out</label>
                                    <input type="date" id="checkOut" name="checkOut" class="form-control"/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="roomtype">Room Type</label>
                                    <input type="text" id="roomtype" name="roomtype" class="form-control"/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="roomNo">Room Number</label>
                                    <input type="text" id="roomno" name="roomno" class="form-control"/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="howManyRooms">Number of Rooms</label>
                                    <input type="number" id="roomcount" name="roomcount" class="form-control" min="1"/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="howManyBeds">Number of Beds</label>
                                    <input type="number" id="bedcount" name="bedcount" class="form-control" min="1"/>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="dayno">Number of Days</label>
                                    <input type="number" id="dayno" name="dayno" class="form-control" min="1"/>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="adultno">Number of Adults</label>
                                    <input type="number" id="adultno" name="adultno" class="form-control" min="1"/>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label" for="childno">Number of Children</label>
                                    <input type="number" id="childno" name="childno" class="form-control" min="0"/>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="specialrequest">Special Requests</label>
                                    <textarea id="specialrequest" name="specialrequest" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Update Booking</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
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

<?php
session_start();
require("../../config/database.php");

$payment_id = 'P00' . str_pad(rand(0, 9999999), 3, '0', STR_PAD_LEFT);
$receipt_id = 'R' . str_pad(rand(0, 9999999), 4, '0', STR_PAD_LEFT);

$sql = "SELECT * FROM booking WHERE customer_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $_SESSION['customer_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $room_name = $row['room_name'];
    $checkin = $row['checkin'];
    $checkout = $row['checkout'];
    $no_day = $row['no_day'];
    $total = $row['total'];
} else {
    echo "No booking found for this user.";
    exit;
}

$tax_rate = 0.10;
$tax_amount = $total * $tax_rate;
$total_with_tax = $total + $tax_amount;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <style>
        .inputWithIcon input {
            padding-left: 2.5rem;
        }
        .inputWithIcon span {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }
        body {
            background-color: #ffffff;
        }
        .container {
            margin: 20px auto;
            width: 800px;
            padding: 30px;
        }
        .card.box1 {
            width: 350px;
            height: 500px;
            background-color: #3ecc6d;
            color: #baf0c3;
        }
        .card.box2 {
            width: 450px;
            height: 580px;
            background-color: #ffffff;
        }
        .text {
            font-size: 13px;
        }
        .form-control {
            border: none;
            border-bottom: 1px solid #ddd;
            box-shadow: none;
            height: 20px;
            font-weight: 600;
            font-size: 14px;
            padding: 15px 0px;
            letter-spacing: 1.5px;
            border-radius: 0;
        }
        .inputWithIcon {
            position: relative;
        }
        .inputWithIcon span {
            position: absolute;
            right: 0px;
            bottom: 9px;
            color: #57c97d;
            cursor: pointer;
            transition: 0.3s;
            font-size: 14px;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
        .nav.nav-tabs .nav-item .nav-link.active {
            border-bottom: 2px solid #3ecc6d;
        }
    </style>
</head>
<body>
<br><br>
    <center>
        <a href="index.html">
            <img src="../assets/img/logo/hotel1.png" alt="Re' hotel logo" style="width: 200px; height: auto;" />
        </a>
    </center>

    <div class="container bg-light d-md-flex align-items-center mt-5">
        <div class="card box1 shadow-sm p-md-5 p-4">
            <div class="fw-bolder mb-4">
                <span class="ps-6">Check In: <?php echo date('d-m-Y', strtotime($checkin)); ?></span><br>
                <span class="ps-6">Check Out: <?php echo date('d-m-Y', strtotime($checkout)); ?></span>
            </div>
            <div class="d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between text mb-4">
                    <span>Total (Excl. Tax)</span>
                    <span class=""><span class="ps-1">RM<?php echo number_format($total, 2); ?></span></span>
                </div>
                <div class="d-flex align-items-center justify-content-between text mb-4">
                    <span>Tax (10%)</span>
                    <span class=""><span class="ps-1">RM<?php echo number_format($tax_amount, 2); ?></span></span>
                </div>
                <div class="d-flex align-items-center justify-content-between text mb-4">
                    <span>Total (Incl. Tax)</span>
                    <span class=""><span class="ps-1">RM<?php echo number_format($total_with_tax, 2); ?></span></span>
                </div>
                <div class="border-bottom mb-4"></div>
                <div class="d-flex flex-column mb-4">
                    <span class="far fa-file-alt text"><span class="ps-2">Payment ID:</span></span>
                    <span class="ps-3"><?php echo $payment_id;?></span>
                </div>
                <div class="d-flex flex-column mb-5">
                    <span class="far fa-calendar-alt text"><span class="ps-2">Payment Date:</span></span>
                    <span class="ps-3"><?php echo date('j F Y'); ?></span>
                </div>
            </div>
        </div>
        <div class="card box2 shadow-sm">
            <div class="d-flex align-items-center justify-content-between p-md-5 p-4">
                <span class="h5 fw-bold m-0">Payment methods</span>
                <div class="btn btn-success bar">
                    <span class="fas fa-bars"></span>
                </div>
            </div>
            <ul class="nav nav-tabs mb-3 px-md-4 px-2">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#credit-card">Credit Card</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#paypal">Paypal</a>
                </li>
            </ul>
            <div class="tab-content px-md-4 px-2 pb-4">
                <div class="tab-pane fade show active" id="credit-card">
                    <form action="../process/process_payment.php" method="post">
                        <div class="d-flex flex-column pb-3">
                            <label for="payment-id">Payment ID</label>
                            <div class="inputWithIcon">
                                <input type="text" id="payment-id" name="payment_id" class="form-control" value="<?php echo $payment_id;?>" readonly>
                            </div>
                        </div>
                        <div class="d-flex flex-column pb-3">
    <label for="payment-total">Payment Total</label>
    <div class="inputWithIcon">
        <input type="text" id="payment-total" class="form-control" value="RM<?php echo number_format($total_with_tax, 2); ?>" readonly>
        <input type="hidden" name="payment_total" value="<?php echo $total_with_tax; ?>">
    </div>
</div>
                        <div class="d-flex flex-column pb-3">
                            <label for="cardholder-name">Cardholder Name</label>
                            <div class="inputWithIcon">
                                <input type="text" id="cardholder-name" name="card_name" class="form-control" required>
                                <span class="far fa-user"></span>
                                <div class="error" id="card-holder-name-error"></div>
                            </div>
                        </div>
                        <div class="d-flex flex-column pb-3">
                            <label for="card-number">Card Number</label>
                            <div class="inputWithIcon">
                                <input type="text" id="card-number" name="card_number" class="form-control" required>
                                <span class="far fa-credit-card"></span>
                                <div class="error" id="card-number-error"></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center pb-3">
                            <div class="d-flex flex-column pe-3">
                                <label for="expiry-date">Expiry</label>
                                <input type="text" id="expiry-date" name="expirydate" class="form-control" required>
                                <div class="error" id="expiry-date-error"></div>
                            </div>
                            <div class="d-flex flex-column pe-3">
                                <label for="cvv">CVV</label>
                                <input type="password" id="cvv" name="cvv" class="form-control" required>
                                <div class="error" id="cvv-error"></div>
                            </div>
                            <div class="d-flex align-items-center pt-2">
                                <button type="submit" class="btn btn-primary" id="submit-btn">Pay Now</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade pt-3" id="paypal">
                    <h6 class="pb-2">Select your PayPal account type</h6>
                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="optradio" checked> Domestic
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="optradio" class="ml-5"> International
                        </label>
                    </div>
                    <p>
                        <a target="_blank" href="https://www.paypal.com/signin" class="btn btn-primary mt-3">
                            <i class="fa fa-paypal" aria-hidden="true"></i> Log into my PayPal
                        </a>
                    </p>
                    <p class="text-muted">
                        Note: After clicking on the button, you will be directed to a secure gateway for payment. After
                        completing the payment process, you will be redirected back to the website to view details of
                        your order.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../process/payment.js"></script>
	<script>
        $(document).ready(function () {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href"); // activated tab
                if (target == "#online-banking") {
                    $(".bank-list").show();
                } else {
                    $(".bank-list").hide();
                }
            });
        });
    </script>

    <script>
        function validateCardHolderName() {
            const nameInput = document.getElementById('card-holder-name');
            const nameError = document.getElementById('card-holder-name-error');
            const name = nameInput.value;

            if (!/^[A-Z\s]+$/.test(name)) {
                nameError.textContent = 'Card holder name must be in uppercase letters and cannot contain numbers.';
                return false;
            } else {
                nameError.textContent = '';
                return true;
            }
        }

        function validateCardNumber() {
            const cardNumberInput = document.getElementById('card-number');
            const cardNumberError = document.getElementById('card-number-error');
            const cardNumber = cardNumberInput.value.replace(/\s/g, '');

            if (cardNumber.length !== 16) {
                cardNumberError.textContent = 'Card number must be exactly 16 digits.';
                return false;
            } else {
                cardNumberError.textContent = '';
                return true;
            }
        }

        function validateExpiryDate() {
            const expiryDateInput = document.getElementById('expiry-date');
            const expiryDateError = document.getElementById('expiry-date-error');
            const expiryDate = expiryDateInput.value;

            if (!/^\d{2}\/\d{2}$/.test(expiryDate)) {
                expiryDateError.textContent = 'Expiry date must be in the format MM/YY.';
                return false;
            }

            const [month, year] = expiryDate.split('/').map(Number);
            const currentYear = new Date().getFullYear() % 100;
            const currentMonth = new Date().getMonth() + 1;

            if (year < currentYear || (year === currentYear && month < currentMonth)) {
                expiryDateError.textContent = 'Expiry date must be in the future.';
                return false;
            } else {
                expiryDateError.textContent = '';
                return true;
            }
        }

        function validateCVV() {
            const cvvInput = document.getElementById('cvv');
            const cvvError = document.getElementById('cvv-error');
            const cvv = cvvInput.value;

            if (!/^\d{3,4}$/.test(cvv)) {
                cvvError.textContent = 'CVV must be 3 or 4 digits.';
                return false;
            } else {
                cvvError.textContent = '';
                return true;
            }
        }

        document.getElementById('card-number').addEventListener('input', function (e) {
            let input = e.target.value.replace(/\D/g, '').substring(0, 16);
            input = input.match(/.{1,4}/g)?.join(' ') ?? ''; // Add a space every 4 digits
            e.target.value = input;
            validateCardNumber();
        });

        document.getElementById('expiry-date').addEventListener('input', function (e) {
            let input = e.target.value.replace(/\D/g, '').substring(0, 4); // Allow only digits and limit to 4 digits
            if (input.length > 2) {
                input = input.substring(0, 2) + '/' + input.substring(2);
            }
            e.target.value = input;
            validateExpiryDate();
        });

        document.getElementById('cvv').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, ''); // Allow only digits
            validateCVV();
        });

        document.getElementById('submit-button').addEventListener('click', function (e) {
            const isCardNumberValid = validateCardNumber();
            const isExpiryDateValid = validateExpiryDate();
            const isCVVValid = validateCVV();

            if (!isCardNumberValid || !isExpiryDateValid || !isCVVValid) {
                e.preventDefault();
                alert('Please correct the errors before submitting.');
            }
        });
    </script>
</body>
</html>

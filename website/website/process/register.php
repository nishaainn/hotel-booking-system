<?php

session_start();
require ('../../config/database.php');

function filter_form_input($FInput)
{
    $FInput = filter_var($FInput, FILTER_UNSAFE_RAW);
    $FInput = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $FInput);

    return $FInput;
}

// INVOICE GENERATOR
function rand_string($len)
{
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars), 0, $len);
}
$purpose = filter_input(INPUT_POST, 'purpose', FILTER_SANITIZE_STRING);

if ($purpose == 'bookingform') {
    $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $checkin = filter_input(INPUT_POST, 'checkIn', FILTER_SANITIZE_STRING);
    $checkout = filter_input(INPUT_POST, 'checkOut', FILTER_SANITIZE_STRING);
    $room_name = filter_input(INPUT_POST, 'room_name', FILTER_SANITIZE_STRING);
    $no_day = filter_input(INPUT_POST, 'totalday', FILTER_SANITIZE_STRING);
    $no_pax = filter_input(INPUT_POST, 'no_pax', FILTER_SANITIZE_STRING);
    $total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $request = filter_input(INPUT_POST, 'request', FILTER_SANITIZE_STRING);

    // Sanitize inputs for display purposes
    $customer_id = filter_form_input($customer_id);
    $email = filter_form_input($email);
    $checkin = filter_form_input($checkin);
    $checkout = filter_form_input($checkout);
    $room_name = filter_form_input($room_name);
    $no_day = filter_form_input($no_day);
    $no_pax = filter_form_input($no_pax);
    $total = floatval(str_replace(',', '', $total)); // Remove any commas in case of input format like "1,000.00"
    $request = filter_form_input($request);


    // Insert into the booking table
    $sql = "INSERT INTO booking (booking_id, checkin, checkout, room_name, no_day, no_pax, total, request, customer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssdss', $booking_id, $checkin, $checkout, $room_name, $no_day, $no_pax, $total, $request, $customer_id);
    mysqli_stmt_execute($stmt);

    // Redirect to appropriate page based on success
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location:../pages/bookingform3.php");
    } else {
        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "Booking failed. Please try again.";
        $_SESSION['icon'] = "error";
        header("Location:../pages/bookingform1.php"); // Redirect back to previous page
    }

    exit();
}
if ($purpose == 'register') {

    $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_SANITIZE_STRING);
    $customer_name = filter_input(INPUT_POST, 'customer_name', FILTER_SANITIZE_STRING);
    $phone_no = filter_input(INPUT_POST, 'phone_no', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $customer_id = filter_form_input($customer_id);
    $customer_name = filter_form_input($customer_name);
    $phone_no = filter_form_input($phone_no);
    $email = filter_form_input($email);
    $password = filter_form_input($password);

    $hash = password_hash($password, PASSWORD_DEFAULT);
    // echo $hash;
    // exit();

    $sql = "INSERT INTO customer (customer_id,customer_name,phone_no, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'sssss', $customer_id, $customer_name, $phone_no, $email, $hash);

    if (!mysqli_stmt_execute($stmt)) {

        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "Data not saved. Please try again.";
        $_SESSION['icon'] = "error";
        header("Location: ../pages/login/register.php");
        exit();

    } else {

        $stmt->close();
        $con->close();

        $_SESSION['result'] = "Success!";
        $_SESSION['message'] = "Contact save successfully.";
        $_SESSION['icon'] = "success";
        header("Location: ../pages/member_index.php");
        exit();
    }

    if ($purpose == 'payment') {
        $payment_id = filter_input(INPUT_POST, 'payment_id', FILTER_SANITIZE_STRING);
        $card_name = filter_input(INPUT_POST, 'card_name', FILTER_SANITIZE_STRING);
        $card_number = filter_input(INPUT_POST, 'card_number', FILTER_SANITIZE_STRING);
        $expireddate = filter_input(INPUT_POST, 'expireddate', FILTER_SANITIZE_STRING);
        $cvv = filter_input(INPUT_POST, 'cvv', FILTER_SANITIZE_STRING);
        $payment_total = filter_input(INPUT_POST, 'payment_total', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        // Clean up and validate input
        $payment_id = filter_var($payment_id, FILTER_SANITIZE_STRING);
        $card_name = filter_var($card_name, FILTER_SANITIZE_STRING);
        $card_number = filter_var($card_number, FILTER_SANITIZE_STRING);
        $expireddate = filter_var($expireddate, FILTER_SANITIZE_STRING);
        $cvv = filter_var($cvv, FILTER_SANITIZE_STRING);
        $payment_total = floatval(str_replace(',', '', $payment_total)); // Remove any commas in case of input format like "1,000.00"

        // Validate expiry date format (MM/YY)
        if (!preg_match('/^\d{2}\/\d{2}$/', $expirydate)) {
            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "Invalid expiry date format. Please use MM/YY format.";
            $_SESSION['icon'] = "error";
            header("Location: ../pages/index1.php");
            exit();
        }

        // Current date for payment_date
        $payment_date = date('Y-m-d');

        // Prepare SQL statement
        $sql = "INSERT INTO payment(payment_id, payment_date, card_name, card_number, expireddate, cvv, payment_total) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssss', $payment_id, $payment_date, $card_name, $card_number, $expireddate, $cvv, $payment_total);

        // Execute statement
        if (!mysqli_stmt_execute($stmt)) {
            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "Data not saved. Please try again.";
            $_SESSION['icon'] = "error";
            header("Location: ../pages/index1.php");
            exit();
        } else {
            // Close statement and connection
            mysqli_stmt_close($stmt);
            mysqli_close($con);

            $_SESSION['result'] = "Success!";
            $_SESSION['message'] = "Payment saved successfully.";
            $_SESSION['icon'] = "success";
            header("Location: ../website/pages/index.php");
            exit();
        }
    }

    if ($purpose == 'contactus') {

        $message_id = filter_input(INPUT_POST, 'message_id', FILTER_SANITIZE_STRING);
        $message_name = filter_input(INPUT_POST, 'message_name', FILTER_SANITIZE_STRING);
        $message_email = filter_input(INPUT_POST, 'message_email', FILTER_SANITIZE_STRING);
        $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

        $message_id = filter_form_input($message_id);
        $message_name = filter_form_input($message_name);
        $message_email = filter_form_input($message_email);
        $subject = filter_form_input($subject);
        $description = filter_form_input($description);


        //$hash = password_hash($password, PASSWORD_DEFAULT);
        // echo $hash;
        // exit();

        $sql = "INSERT INTO contact(message_id,message_name,message_email,subject,description) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'sssss', $message_id, $message_name, $message_email, $subject, $description);

        if (!mysqli_stmt_execute($stmt)) {

            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "Data not saved. Please try again.";
            $_SESSION['icon'] = "error";
            header("Location: ../pages/index.php");
            exit();

        } else {

            $stmt->close();
            $con->close();

            $_SESSION['result'] = "Success!";
            $_SESSION['message'] = "Contact save successfully.";
            $_SESSION['icon'] = "success";
            header("Location: ../website/pages/member_index.php");
            exit();
        }
    }
} else {
    session_destroy();
    header('Location: ../pages/bookingform.php');
    exit();
}
?>
<?php
session_start();
require("../../config/database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize input values
    $payment_id = $_POST['payment_id'];
    $payment_total = str_replace('RM', '', $_POST['payment_total']); // Remove RM prefix
    $payment_total = floatval($payment_total); // Convert to float
    $card_name = $_POST['card_name'];
    $card_number = $_POST['card_number'];
    $expirydate = $_POST['expirydate'];
    $cvv = $_POST['cvv'];

    // Validate input values (example: basic validation)
    if (empty($card_name) || empty($card_number) || empty($expirydate) || empty($cvv)) {
        echo "Please fill all the required fields.";
        exit;
    }

    // Get today's date
    $payment_date = date('Y-m-d');

    // Retrieve customer_id from session
    $customer_id = $_SESSION['customer_id'];

    // Retrieve booking details
    $sql_booking = "SELECT * FROM booking WHERE customer_id = ? LIMIT 1";
    $stmt_booking = $con->prepare($sql_booking);
    $stmt_booking->bind_param("i", $customer_id);
    $stmt_booking->execute();
    $booking_result = $stmt_booking->get_result();

    if ($booking_result->num_rows > 0) {
        $booking_row = $booking_result->fetch_assoc();
        $booking_id = $booking_row['booking_id'];
    } else {
        echo "Booking not found.";
        exit;
    }

    // Prepare SQL statement to insert payment details
    $sql = "INSERT INTO payment (payment_id, payment_total, card_name, card_number, expirydate, cvv, payment_date, customer_id, booking_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssssss", $payment_id, $payment_total, $card_name, $card_number, $expirydate, $cvv, $payment_date, $customer_id, $booking_id);

    if ($stmt->execute()) {
        // Payment inserted successfully
        header( "Location: ../pages/thankyou.php" );
        // You can also redirect to a success page if needed  
        // header("Location: payment_success.php");
    } else {
        // Error inserting payment
        echo "Error processing payment: " . $stmt->error;
    }

    $stmt->close();
    $stmt_booking->close();
    $con->close();
} else {
    // If the request method is not POST
    echo "Invalid request.";
}
?>

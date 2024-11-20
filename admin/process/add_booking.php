<?php

session_start();
require('../../config/database.php');

// Prepare data for insertion
$customer_id = $_POST['customer_id'];
$customer_name = $_POST['customer_name'];
$phone_no = $_POST['phone_no'];
$email = $_POST['email'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$no_room = $_POST['no_room'];
$no_pax = $_POST['no_pax'];
$request = $_POST['request'];
$total = $_POST['total'];
$booking_id = $_POST['booking_id'];
$room_name = []; // Initialize room_name array
$no_room = []; // Initialize no_room array

// Prepare and bind SQL statement for customer insertion
$stmt = $conn->prepare("INSERT INTO customer (customer_id, customer_name, phone_no, email) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $customer_id, $customer_name, $phone_no, $email);

// Execute customer insertion
$stmt->execute();

// Check for errors
if ($stmt->errno) {
    echo "Error inserting customer: " . $stmt->error;
}

// Close customer statement
$stmt->close();

// Prepare and bind SQL statement for booking insertion
$stmt = $conn->prepare("INSERT INTO booking (booking_id, checkin, checkout, room_name, no_day, no_room, no_pax, request, total, customer_id, room_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters for booking insertion
$stmt->bind_param("ssssiiisdsi", $booking_id, $checkin, $checkout, $room_name, $no_day, $no_room, $no_pax, $request, $total, $customer_id, $room_id);

// Execute booking insertion
$stmt->execute();

// Check for errors
if ($stmt->errno) {
    echo "Error inserting booking: " . $stmt->error;
} else {
    echo "Booking added successfully!";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>


?>
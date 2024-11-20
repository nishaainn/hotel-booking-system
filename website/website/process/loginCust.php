<?php
session_start();
require ("../../config/database.php");

$custemail = $_POST['email'];
$pass = $_POST['password'];
$status = 'active';

// Prepare the SQL statement
$stmt = $con->prepare("SELECT customer_id, password FROM customer WHERE email = ? AND status = ?");
$stmt->bind_param("ss", $custemail, $status);
$stmt->execute();
$stmt->bind_result($customer_id, $password);
$stmt->store_result();
$val = $stmt->num_rows;

while ($stmt->fetch()) {
    // The while loop will execute if a record is found, setting $customer_id and $password
}

// Check if the user exists
if (($val > 0) && ($pass != '')) {
    // Verify the password
    if (password_verify($pass, $password)) {
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['email'] = $custemail;
        $_SESSION['customer_id'] = $customer_id; // Store customer_id in session

        header("Location: ../pages/member_index.php");
        exit();
    } else {
        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "You entered the wrong password.";
        $_SESSION['icon'] = "error";
        header("Location: ../pages/login/login.php");
        exit();
    }
} else {
    $_SESSION['result'] = "Failed!";
    $_SESSION['message'] = "Account does not exist.";
    $_SESSION['icon'] = "error";
    header("Location: ../index.php");
    exit();
}
?>
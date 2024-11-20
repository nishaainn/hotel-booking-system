<?php

session_start();
require ('../../config/database.php');

// FILTER INPUT
function filter_form_input($FInput)
{
    $FInput = filter_var($FInput, FILTER_UNSAFE_RAW);
    $FInput = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $FInput);

    return $FInput;
}


$purpose = filter_input(INPUT_POST, 'purpose', FILTER_SANITIZE_STRING);
// CHANGE PASSWORD
if ($purpose == 'changepassword') {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $currentPassword = filter_input(INPUT_POST, 'currentPassword', FILTER_SANITIZE_STRING);
    $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);
    $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);

    $currentPassword = filter_form_input($currentPassword);
    $newPassword = filter_form_input($newPassword);
    $confirmPassword = filter_form_input($confirmPassword);

    // OTHER
    $hash = password_hash($newPassword, PASSWORD_DEFAULT);
    $previous = $_SERVER['HTTP_REFERER'];

    // CHECK BOTH INPUT
    if ($confirmPassword != $newPassword) {
        session_destroy();
        header("Location:  ../admin/pages/index.php");
        exit();
    }

    // CHECK OLD PASS IN DATABASE
    $stmt = $con->prepare("SELECT password FROM customer WHERE email = ? ");
    $errorchecking = $stmt->bind_param("s", $email);
    $errorchecking = $stmt->execute();
    $stmt->bind_result($password);
    $stmt->store_result();
    $val = $stmt->num_rows;
    while ($stmt->fetch()) {
        $password = $password;
    }



    if (!password_verify($currentPassword, $password)) {
        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "Check your old password.";
        $_SESSION['icon'] = "error";
        header("Location: $previous");
        exit();
    }

    // START PROCESSING
    if ($stmt = $con->prepare("UPDATE customer SET password = ? WHERE email = ?")) {
        $stmt->bind_param("ss", $hash, $email);

        if (!$stmt->execute()) {

            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "Please try again.";
            $_SESSION['icon'] = "error";
            header("Location: $previous");
            exit();

        } else {

            $stmt->close();
            $con->close();

            $_SESSION['result'] = "Success!";
            $_SESSION['message'] = "Password saved.";
            $_SESSION['icon'] = "success";
            header("Location: $previous");
            exit();
        }
    } else {

        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "Please try again.";
        $_SESSION['icon'] = "error";
        header("Location: $previous");
        exit();

    }
}
// END CHANGE PASSWORD
else {
    session_destroy();
    header('Location: ../index.php');
    exit();
}

?>
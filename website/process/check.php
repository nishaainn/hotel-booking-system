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

// GET PURPOSE
$purpose = filter_input(INPUT_POST, 'purpose', FILTER_SANITIZE_STRING);

//  AVAILABILITY
if ($purpose == 'availability') {

    $checkin = filter_input(INPUT_POST, 'checkin', FILTER_SANITIZE_STRING);
    $checkout = filter_input(INPUT_POST, 'checkout', FILTER_SANITIZE_STRING);
    $no_pax = filter_input(INPUT_POST, 'no_pax', FILTER_SANITIZE_STRING);
    $room_name = filter_input(INPUT_POST, 'room_name', FILTER_SANITIZE_STRING);

    $checkin = filter_form_input($checkin);
    $checkout = filter_form_input($checkout);
    $no_pax = filter_form_input($no_pax);
    $room_name = filter_form_input($room_name);

    // OTHER

    if (strtotime($checkin) > strtotime($checkout)) {
        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "Date Checkout Before Date Checkin";
        $_SESSION['icon'] = "error";
        header("Location: ../index.php");
        exit();
    }//klau date checkout sebelum date checkin kluar error

    // CHECK AVAILIBILTY
    $sql = "SELECT * FROM rooms WHERE room_name = '$room_name' AND status = 'available'";
    $result = mysqli_query($con, $sql);
    $total = mysqli_num_rows($result);

    // CHECK ROOM
    if ($total == 0) {

        $sql = "SELECT * FROM rooms WHERE room_name = '$room_name' AND status = 'unavailable'";
        $result = mysqli_query($con, $sql);
        while ($row = $result->fetch_array(MYSQLI_BOTH)) {

            if (strtotime($checkin) >= strtotime($row["availableAt"])) {
                $total++;
            }
        }

        if ($total > 0) {

            $_SESSION['result'] = "Success!";
            $_SESSION['message'] = "Room Available. Before proceed to booking, please login first";
            $_SESSION['icon'] = "success";
            header("Location: ../pages/login/login.php");
            exit();
        } else {

            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "Room unavailable. Please choose another date.";
            $_SESSION['icon'] = "error";
            header("Location: ../pages/index.php");
            exit();
        }

    } else {

        $_SESSION['result'] = "Sucess!";
        $_SESSION['message'] = "Rooms are available.";
        $_SESSION['icon'] = "success";
        header("Location: ../pages/login/login.php");
        exit();

    }
}

if ($purpose == 'availabilityMember') {

    $checkin = filter_input(INPUT_POST, 'checkin', FILTER_SANITIZE_STRING);
    $checkout = filter_input(INPUT_POST, 'checkout', FILTER_SANITIZE_STRING);
    $no_pax = filter_input(INPUT_POST, 'no_pax', FILTER_SANITIZE_STRING);
    $room_name = filter_input(INPUT_POST, 'room_name', FILTER_SANITIZE_STRING);

    $checkin = filter_form_input($checkin);
    $checkout = filter_form_input($checkout);
    $no_pax = filter_form_input($no_pax);
    $room_name = filter_form_input($room_name);

    // OTHER

    if (strtotime($checkin) > strtotime($checkout)) {
        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "Date Checkout Before Date Checkin";
        $_SESSION['icon'] = "error";
        header("Location: ../index.php");
        exit();
    }//klau date checkout sebelum date checkin kluar error

    // CHECK AVAILIBILTY
    $sql = "SELECT * FROM rooms WHERE room_name = '$room_name' AND status = 'available'";
    $result = mysqli_query($con, $sql);
    $total = mysqli_num_rows($result);

    // CHECK ROOM
    if ($total == 0) {

        $sql = "SELECT * FROM rooms WHERE room_name = '$room_name' AND status = 'unavailable'";
        $result = mysqli_query($con, $sql);
        while ($row = $result->fetch_array(MYSQLI_BOTH)) {

            if (strtotime($checkin) >= strtotime($row["availableAt"])) {
                $total++;
            }
        }

        if ($total > 0) {

            $_SESSION['result'] = "Success!";
            $_SESSION['message'] = "Booking successfully.";
            $_SESSION['icon'] = "success";
            header("Location: ../pages/bookingform.php");
            exit();
        } else {

            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "Room unavailable. Please choose another date..";
            $_SESSION['icon'] = "error";
            header("Location: ../pages/member_index.php");
            exit();
        }

    } else {

        $_SESSION['result'] = "Sucess!";
        $_SESSION['message'] = "Rooms are available.";
        $_SESSION['icon'] = "success";
        header("Location: ../pages/bookingform.php");
        exit();

    }
}
// END CHECK
else {
    session_destroy();
    header('Location: ../pages/index.php');
    exit();
}

?>
<?php

session_start();
require ('../../config/database.php');

function filter_form_input($FInput)
{
    $FInput = filter_var($FInput, FILTER_UNSAFE_RAW);
    $FInput = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $FInput);

    return $FInput;
}

$purpose = filter_input(INPUT_POST, 'purpose', FILTER_SANITIZE_STRING);

if ($purpose == 'addStaff') {
    $staff_name = filter_input(INPUT_POST, 'staff_name', FILTER_SANITIZE_STRING);
    $staff_id = filter_input(INPUT_POST, 'staff_id', FILTER_SANITIZE_STRING);
    $staff_email = filter_input(INPUT_POST, 'staff_email', FILTER_SANITIZE_EMAIL);
    $staff_tel = filter_input(INPUT_POST, 'staff_tel', FILTER_SANITIZE_STRING);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
    $hire_date = filter_input(INPUT_POST, 'hire_date', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
    $zip_code = filter_input(INPUT_POST, 'zip_code', FILTER_SANITIZE_STRING);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $staff_name = filter_form_input($staff_name);
    $staff_id = filter_form_input($staff_id);
    $staff_email = filter_form_input($staff_email);
    $staff_tel = filter_form_input($staff_tel);
    $position = filter_form_input($position);
    $hire_date = filter_form_input($hire_date);
    $address = filter_form_input($address);
    $state = filter_form_input($state);
    $zip_code = filter_form_input($zip_code);
    $country = filter_form_input($country);
    $password = filter_form_input($password);

    // Set status and password based on the position
    if (in_array($position, ['Manager', 'Assistant Manager', 'Reception'])) {
        $status = 'active';
        $hash = password_hash('staff123', PASSWORD_DEFAULT);
    } else {
        $status = 'inactive';
        $hash = null; // No password will be inserted
    }

    // Check if staff ID or email already exists
    $stmt = $con->prepare("SELECT staff_name FROM staff WHERE staff_id = ? OR staff_email = ?");
    $stmt->bind_param("ss", $staff_id, $staff_email);
    $stmt->execute();
    $stmt->bind_result($name);
    $stmt->store_result();
    $val = $stmt->num_rows;
    while ($stmt->fetch()) {
        $name = $name;
    }

    if ($val > 0) {
        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "Email or IC already exists";
        $_SESSION['icon'] = "danger";
        header("Location: ../pages/addstaff.php");
        exit();
    } else {
        if ($hash !== null) {
            $sql = "INSERT INTO staff (staff_id, staff_name, staff_email, staff_tel, position, hire_date, address, state, zip_code, country, status, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssssssssss', $staff_id, $staff_name, $staff_email, $staff_tel, $position, $hire_date, $address, $state, $zip_code, $country, $status, $hash);
        } else {
            $sql = "INSERT INTO staff (staff_id, staff_name, staff_email, staff_tel, position, hire_date, address, state, zip_code, country, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, 'sssssssssss', $staff_id, $staff_name, $staff_email, $staff_tel, $position, $hire_date, $address, $state, $zip_code, $country, $status);
        }

        if (!mysqli_stmt_execute($stmt)) {
            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "Data not saved. Please try again.";
            $_SESSION['icon'] = "danger";
            header("Location: ../pages/addstaff.php");
            exit();
        } else {
            $stmt->close();
            $con->close();

            $_SESSION['result'] = "Success!";
            $_SESSION['message'] = "Save successfully.";
            $_SESSION['icon'] = "success";
            header("Location: ../pages/addstaff.php");
            exit();
        }
    }
}


if ($purpose == 'addRoom') {

    $room_id = filter_input(INPUT_POST, 'room_id', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $room_name = filter_input(INPUT_POST, 'room_name', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $room_id = filter_form_input($room_id);
    $description = filter_form_input($description);
    $room_name = filter_form_input($room_name);
    $price = floatval(str_replace(',', '', $price)); // Remove any commas in case of input format like "1,000.00"

    //OTHER

    // GET ROOM DETAILS
    $stmt = $con->prepare("SELECT room_name FROM rooms WHERE room_id = ?");
    $errorchecking = $stmt->bind_param("s", $room_id);
    $errorchecking = $stmt->execute();
    $stmt->bind_result($typesroom);
    $stmt->store_result();
    $val = $stmt->num_rows;
    while ($stmt->fetch()) {
        $typesroom = $typesroom;
    }

    if ($val > 0) {
        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "Room ID or Room Number already existss";
        $_SESSION['icon'] = "danger";
        header("Location: ../addroom.php3");
        exit();
    } else {

        $sql = "INSERT INTO rooms (room_name, room_id, description, price) VALUES ( ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'sssd', $room_name, $room_id, $description, $price);

        if (!mysqli_stmt_execute($stmt)) {

            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "Data not saved. Please try again.";
            $_SESSION['icon'] = "danger";
            header("Location: ../addroom.php2");
            exit();

        } else {

            $stmt->close();
            $con->close();

            $_SESSION['result'] = "Success!";
            $_SESSION['message'] = "Save successfully.";
            $_SESSION['icon'] = "success";
            header("Location: ../pages/index.php");
            exit();
        }
    }
}
if ($purpose == 'addbooking') {

    $booking_id = filter_input(INPUT_POST, 'booking_id', FILTER_SANITIZE_STRING);
    $customer_name = filter_input(INPUT_POST, 'customer_name', FILTER_SANITIZE_STRING);
    $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $phone_no = filter_input(INPUT_POST, 'phone_no', FILTER_SANITIZE_STRING);
    $checkin = filter_input(INPUT_POST, 'checkin', FILTER_SANITIZE_STRING);
    $checkout = filter_input(INPUT_POST, 'checkout', FILTER_SANITIZE_STRING);
    $room_name = filter_input(INPUT_POST, 'room_name', FILTER_SANITIZE_STRING);
    $no_room = filter_input(INPUT_POST, 'no_room', FILTER_SANITIZE_STRING);
    $no_pax = filter_input(INPUT_POST, 'no_pax', FILTER_SANITIZE_STRING);
    $request = filter_input(INPUT_POST, 'request', FILTER_SANITIZE_STRING);

    $customer_name = filter_form_input($customer_name);
    $customer_id = filter_form_input($customer_id);
    $email = filter_form_input($email);
    $phone_no = filter_form_input($phone_no);
    $checkin = filter_form_input($checkin);
    $checkout = filter_form_input($checkout);
    $room_name = filter_form_input($room_name);
    $no_room = filter_form_input($no_room);
    $no_pax = filter_form_input($no_pax);
    $request = filter_form_input($request);

    //OTHER
    $previous = $_SERVER['HTTP_REFERER'];
    $totalAmount = 0;

    if ($room_name == "standard room") {
        $totalAmount = 150 * $no_room;

    } else if ($room_name == "deluxe room") {
        $totalAmount = 180 * $no_room;

    } else if ($room_name == "studio") {
        $totalAmount = 250 * $no_room;

    } else if ($room_name == "suite") {
        $totalAmount = 280 * $no_room;

    }

    if (strtotime($checkin) > strtotime($checkout)) {
        $_SESSION['result'] = "Failed!";
        $_SESSION['message'] = "Date Checkout Before Date Checkin";
        $_SESSION['icon'] = "error";
        header("Location:$previous");
        exit();
    }//klau date checkout sebelum date checkin kluar error

    //CHECK AVAILIBITY
    $sql = "SELECT * FROM rooms WHERE room_name = '$room_name' AND status = 'available'";
    $result = mysqli_query($con, $sql);
    $total = mysqli_num_rows($result);

    if ($total == 0) {

        $sql2 = "SELECT * FROM rooms WHERE room_name = '$room_name' AND status = 'unavailable'";
        $result2 = mysqli_query($con, $sql2);
        while ($row = $result2->fetch_array(MYSQLI_BOTH)) {

            if (strtotime($checkin) >= strtotime($row["availableAt"])) {
                $total2++;
            }
        }

        if ($total2 > 0) {

            $stmt2 = $con->prepare("SELECT customer_name FROM customer WHERE customer_id = ? ");
            $errorchecking2 = $stmt2->bind_param("s", $customer_id);
            $errorchecking2 = $stmt2->execute();
            $stmt2->bind_result($name1);
            $stmt2->store_result();
            $val2 = $stmt2->num_rows;
            while ($stmt2->fetch()) {
                $name1 = $name1;
            }


            if ($val2 > 0) {

                $stmt2 = $con->prepare("UPDATE customer SET customer_name = ?, email = ?, phone_no = ?
				WHERE customer_id = ?");
                $stmt2->bind_param("ssss", $customer_name, $email, $phone_no, $customer_id);
                $stmt2->execute();

            } else {

                $sql = "INSERT INTO customer (customer_id, customer_name, phone_no, email) VALUES ( ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, 'ssss', $customer_id, $customer_name, $phone_no, $email);
                mysqli_stmt_execute($stmt);
            }

            $sql = "INSERT INTO booking (booking_id, checkin, checkout, room_name, no_room,  no_pax, total, request, customer_id) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssssss', $booking_id, $checkin, $checkout, $room_name, $no_room, $no_pax, $totalAmount, $request, $customer_id);
            mysqli_stmt_execute($stmt);

            header("Location:../pages/bookingform1.php");
            exit();

        } else {

            $_SESSION['result'] = "Failed!";
            $_SESSION['message'] = "NRIC unavailable. Please try again.";
            $_SESSION['icon'] = "error";
            header("Location:../pages/bookingform2.php");
            exit();
        }
    } else {

        $sql = "INSERT INTO customer (customer_id, customer_name, phone_no, email) VALUES ( ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $customer_id, $customer_name, $phone_no, $email);
        mysqli_stmt_execute($stmt);

        $sql = "INSERT INTO booking (booking_id, checkin, checkout, room_name, no_room,  no_pax, total, request, customer_id) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssssss', $booking_id, $checkin, $checkout, $room_name, $no_room, $no_pax, $totalAmount, $request, $customer_id);
        mysqli_stmt_execute($stmt);

        header("Location:../pages/bookingform3.php");
        exit();
    }
} else {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>
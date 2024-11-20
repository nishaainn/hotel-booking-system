<?php

	session_start();
	require('../../config/database.php');
	
	// FILTER INPUT
	function filter_form_input($FInput) {
		$FInput = filter_var($FInput, FILTER_UNSAFE_RAW); 
		$FInput = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $FInput);
		
		return $FInput;
	}
	
	
$purpose = filter_input(INPUT_POST, 'purpose', FILTER_SANITIZE_STRING);

// update STAFF
if($purpose == 'editstaff') {

    $staff_id = filter_input(INPUT_POST, 'staff_id', FILTER_SANITIZE_STRING);
    $staff_tel = filter_input(INPUT_POST, 'staff_tel', FILTER_SANITIZE_STRING);
	$staff_name = filter_input(INPUT_POST, 'staff_name', FILTER_SANITIZE_STRING);
    $staff_email = filter_input(INPUT_POST, 'staff_email', FILTER_SANITIZE_STRING);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
	$hire_date = filter_input(INPUT_POST, 'hire_date', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
    $zip_code = filter_input(INPUT_POST, 'zip_code', FILTER_SANITIZE_STRING);
	$country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);


    $staff_tel = filter_form_input($staff_tel);
	$staff_name = filter_form_input($staff_name);
	$staff_email = filter_form_input($staff_email);
    $position = filter_form_input($position);
    $hire_date = filter_form_input($hire_date);
    $address = filter_form_input($address);
    $state = filter_form_input($state);
	$zip_code = filter_form_input($zip_code);
    $country = filter_form_input($country);
    $password = filter_form_input($password);
    $status = filter_form_input($status);
	

    //OTHER
    $hash = password_hash($password, PASSWORD_DEFAULT);
    

    $date = date("Y-m-d");
	$previous = $_SERVER['HTTP_REFERER'];

	if($stmt = $con->prepare("UPDATE staff SET staff_tel = ?, staff_name = ?, staff_email = ?, position = ?, hire_date = ?, address = ?, state = ?,
     zip_code = ?, country = ?, password = ?, status = ? WHERE staff_id = ?"));
    {	
        $stmt->bind_param( "ssssssssssss", $staff_tel, $staff_name, $staff_email, $position, $hire_date,$address, $state,$zip_code, $country, $password, $status, $staff_id);
            
		if(!$stmt->execute()) {

			$_SESSION['result'] = "Failed!"; 
			$_SESSION['message'] = "Data not saved.Please try again.";
			$_SESSION['icon'] = "error";
			header( "Location: $previous" );
			exit();
			
		} else {
			
			$stmt->close();
			$con->close();
		
			$_SESSION['result'] = "Success!";
			$_SESSION['message'] = "Update save successfully.";
			$_SESSION['icon'] = "success";
			header( "Location: $previous" );
			exit();
		}
	}
}	
// END UPDATE STAFF

// CHANGE PASSWORD
if($purpose == 'changepassword') {
	
    $staff_email = filter_input(INPUT_POST, 'staff_email', FILTER_SANITIZE_STRING);
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
	if($confirmPassword != $newPassword){
        session_destroy();
        header( "Location:  ../admin/pages/index.php" );
        exit();
    }

	// CHECK OLD PASS IN DATABASE
	$stmt = $con->prepare("SELECT password FROM staff WHERE staff_email = ? ");
	$errorchecking = $stmt->bind_param("s", $staff_email);
	$errorchecking = $stmt->execute();
	$stmt -> bind_result($password);
	$stmt->store_result();
	$val = $stmt->num_rows; 
	while ($stmt->fetch()){ 
		$password = $password; 
	}

	

	if(!password_verify($currentPassword, $password)) {	
        $_SESSION['result'] = "Failed!";
		$_SESSION['message'] = "Check your old password.";
		$_SESSION['icon'] = "error";
        header( "Location: $previous" );
        exit();
    }

	// START PROCESSING
	if($stmt = $con->prepare("UPDATE staff SET password = ? WHERE staff_email = ?"))
    {	
        $stmt->bind_param( "ss", $hash, $staff_email );
            
		if(!$stmt->execute()) {

			$_SESSION['result'] = "Failed!";
			$_SESSION['message'] = "Please try again.";
			$_SESSION['icon'] = "error";
			header( "Location: $previous" );
			exit();
			
		} else {
			
			$stmt->close();
			$con->close();
		
			$_SESSION['result'] = "Success!";
			$_SESSION['message'] = "Password saved.";
			$_SESSION['icon'] = "success";
			header( "Location: $previous" );
			exit();
		}
	} else{

		$_SESSION['result'] = "Failed!";
		$_SESSION['message'] = "Please try again.";
		$_SESSION['icon'] = "error";
        header( "Location: $previous" );
        exit();
		
	}
}
if ($purpose == 'account') {

	$staff_id = filter_input(INPUT_POST, 'staff_id', FILTER_SANITIZE_STRING);
	$staff_name = filter_input(INPUT_POST, 'staff_name', FILTER_SANITIZE_STRING);
	$staff_email = filter_input(INPUT_POST, 'staff_email', FILTER_SANITIZE_STRING);
	$staff_tel = filter_input(INPUT_POST, 'staff_tel', FILTER_SANITIZE_STRING);
	$position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
	$hire_date = filter_input(INPUT_POST, 'hire_date', FILTER_SANITIZE_STRING);
	$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
	$state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
	$zip_code = filter_input(INPUT_POST, 'zip_code', FILTER_SANITIZE_STRING);
	$country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);


	$staff_id = filter_form_input($staff_id);
	$staff_name = filter_form_input($staff_name);
	$staff_email = filter_form_input($staff_email);
	$staff_tel = filter_form_input($staff_tel);
	$position = filter_form_input($position);
	$hire_date = filter_form_input($hire_date);
	$address = filter_form_input($address);
	$state = filter_form_input($state);
	$zip_code = filter_form_input($zip_code);
	$country = filter_form_input($country);

	//OTHER
	$hash = password_hash($password, PASSWORD_DEFAULT);


	$date = date("Y-m-d");
	$previous = $_SERVER['HTTP_REFERER'];

	if (
		$stmt = $con->prepare("UPDATE staff SET staff_name = ?, staff_id = ?, position = ?, staff_tel = ?, hire_date = ?, address = ?, state = ?,
     zip_code = ?, country = ? WHERE staff_email = ?")
	)
		; {
		$stmt->bind_param("ssssssssss", $staff_name, $staff_id, $position, $staff_tel, $hire_date, $address, $state, $zip_code, $country, $staff_email);

		if (!$stmt->execute()) {

			$_SESSION['result'] = "Failed!";
			$_SESSION['message'] = "Data not saved.Please try again.";
			$_SESSION['icon'] = "error";
			header("Location: $previous");
			exit();

		} else {

			$stmt->close();
			$con->close();

			$_SESSION['result'] = "Success!";
			$_SESSION['message'] = "Update save successfully.";
			$_SESSION['icon'] = "success";
			header("Location: $previous");
			exit();
		}
	}
}
if($purpose == 'editbooking') {

	$booking_id = filter_input(INPUT_POST, 'booking_id', FILTER_SANITIZE_STRING);
    $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_SANITIZE_STRING);
    $customer_name = filter_input(INPUT_POST, 'customer_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone_no = filter_input(INPUT_POST, 'phone_no', FILTER_SANITIZE_STRING);
    $checkin = filter_input(INPUT_POST, 'checkin', FILTER_SANITIZE_STRING);
    $checkout = filter_input(INPUT_POST, 'checkout', FILTER_SANITIZE_STRING);
    $no_pax = filter_input(INPUT_POST, 'no_pax', FILTER_SANITIZE_NUMBER_INT);
    $no_day = filter_input(INPUT_POST, 'no_day', FILTER_SANITIZE_NUMBER_INT);
    $room_name = filter_input(INPUT_POST, 'room_name', FILTER_SANITIZE_STRING);
    $room_id = filter_input(INPUT_POST, 'room_id', FILTER_SANITIZE_STRING);
    $total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    $request = filter_input(INPUT_POST, 'request', FILTER_SANITIZE_STRING);

    $booking_id = filter_form_input($booking_id);
	$customer_id = filter_form_input($customer_id);
	$customer_name = filter_form_input($customer_name);
	$email = filter_form_input($email);
	$phone_no = filter_form_input($phone_no);
	$checkin = filter_form_input($checkin);
	$checkout = filter_form_input($checkout);
	$no_pax = filter_form_input($no_pax);
	$no_day = filter_form_input($no_day);
	$room_name = filter_form_input($room_name);
	$room_id = filter_form_input($room_id);
	$total = filter_form_input($total);
	$status = filter_form_input($status);
	$request = filter_form_input($request);

	// OTHER
    $previous = $_SERVER['HTTP_REFERER'];
	if($room_id != ''){
		$status1 = "unavailable";

		$stmt = $con->prepare("UPDATE rooms SET status = ?, availableAt = ? WHERE room_id = ?");
        $stmt->bind_param( "sss", $status1, $checkout, $room_id );
        $stmt->execute();
	}

    if($stmt = $con->prepare("UPDATE booking SET checkin = ?, checkout = ?, room_name = ?, no_pax = ?, room_id = ?, request = ?, status = ? WHERE booking_id = ?"))
    {	
        $stmt->bind_param( "ssssssss", $checkin, $checkout, $room_name, $no_pax, $room_id, $request, $status, $booking_id);

		$stmt1 = $con->prepare("UPDATE customer SET customer_name = ?, email = ?, phone_no = ? WHERE customer_id = ?");
        $stmt1->bind_param( "ssss", $customer_name, $email, $phone_no, $customer_id);
        $stmt1->execute();

		if(!$stmt->execute()) {

			$_SESSION['result'] = "Failed!";
			$_SESSION['message'] = "Data not saved. Please try again.";
			$_SESSION['icon'] = "error";
			header( "Location: $previous" );
			exit();
			
		} 
        else {
			
			$stmt->close();
			$con->close();
		
			$_SESSION['result'] = "Success!";
			$_SESSION['message'] = "Update save successfully.";
			$_SESSION['icon'] = "success";
			header( "Location:$previous" );
			exit();
		}

		
	}
}
// END CHANGE PASSWORD
// update rooms
if ($purpose == 'rooms') {

	$room_id = filter_input(INPUT_POST, 'room_id', FILTER_SANITIZE_STRING);
	$room_name = filter_input(INPUT_POST, 'room_name', FILTER_SANITIZE_STRING);
	$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
	$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
	$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

	$room_name = filter_form_input($room_name);
	$price = filter_form_input($price);
	$description = filter_form_input($description);
	$status = filter_form_input($status);


	$date = date("Y-m-d");
	$previous = $_SERVER['HTTP_REFERER'];

	if (
		$stmt = $con->prepare("UPDATE rooms SET room_name = ?, price = ?, description = ?, status = ?
         WHERE room_id = ?")
	)
		; {
		$stmt->bind_param("sssss", $room_name, $price, $description, $status, $room_id);

		if (!$stmt->execute()) {

			$_SESSION['result'] = "Failed!";
			$_SESSION['message'] = "Data not saved.Please try again.";
			$_SESSION['icon'] = "error";
			header("Location: $previous");
			exit();

		} else {

			$stmt->close();
			$con->close();

			$_SESSION['result'] = "Success!";
			$_SESSION['message'] = "Update save successfully.";
			$_SESSION['icon'] = "success";
			header("Location: $previous");
			exit();
		}
	}
	
}
else
{
	session_destroy();
    header('Location: ../index.php');
	exit();
}

?>
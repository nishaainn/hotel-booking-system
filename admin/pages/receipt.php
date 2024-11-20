<?php

session_start();
require('../../config/database.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$id = base64_decode($id); // die get data dri encode

// echo $id;
// exit();

$sql = "SELECT customer.customer_id, customer.customer_name, customer.phone_no, customer.email, payment.payment_id FROM customer INNER JOIN payment ON customer.customer_id = payment.customer_id 
WHERE payment_id = '$id'";
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
while($row = $result->fetch_array(MYSQLI_BOTH)) { 
	$payment_id = $row['payment_id'];
	$customer_id = $row['customer_id'];
    $customer_name = $row['customer_name'];
    $phone_no = $row['phone_no'];
    $email = $row['email'];
}

$sql2 = "SELECT booking.booking_id, booking.room_name, booking.no_day, booking.total, payment.payment_date, payment.payment_type, payment.payment_id FROM payment 
INNER JOIN booking ON payment.booking_id = booking.booking_id
WHERE payment_id = '$id'";
$result2 = mysqli_query($con, $sql2);
$total2 = mysqli_num_rows($result2);

$sql4 = "SELECT booking.checkin, booking.checkout, payment.payment_id FROM booking INNER JOIN payment ON booking.booking_id = payment.booking_id
WHERE payment.payment_id = '$id'";
$result4 = mysqli_query($con, $sql4);
while ($row = $result->fetch_array(MYSQLI_BOTH)){ 
    $room_name = $row['payment_id'];
    $checkin = $row['checkin'];
    $checkout = $row['checkout'];
}

$sql5 = "SELECT booking.booking_id, booking.room_name, booking.no_day, booking.total, payment.payment_date, payment.payment_type, payment.payment_id FROM payment 
INNER JOIN booking ON payment.booking_id = booking.booking_id
WHERE payment_id = '$id'";
$result5 = mysqli_query($con, $sql5);
$total5 = mysqli_num_rows($result5);
while($row = $result5->fetch_array(MYSQLI_BOTH)) { 
	$payment_id = $row['payment_id'];
	$payment_date = $row['payment_date'];
    $payment_type = $row['payment_type'];
	$booking_id = $row['booking_id'];
	$room_name = $row['room_name'];
    $no_day = $row['no_day'];
	$total = $row['total'];
}


$sql1 = "SELECT * FROM booking ";
$result1 = mysqli_query($con, $sql1);
$total1 = mysqli_num_rows($result1);
while($row = $result1->fetch_array(MYSQLI_BOTH)) { 
	$booking_id = $row['booking_id'];
	$checkin = $row['checkin'];
    $checkout = $row['checkout'];
}

$tax_rate = 0.10; // 10% tax rate
    // Calculate tax amount
    $tax_amount = $total * $tax_rate;
    // Calculate total payment including tax
    $total_with_tax = $total + $tax_amount;




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Receipt</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 20px;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt-footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
         <div class="text-center">
            <img src="../assets/img/logo/hotel1.png" alt="Re' hotel logo" width="200">
        </div><br>
        <div class="receipt-header">
            <h3>Receipt</h3>
        </div><br>
        <div class="row">
            <div class="col-md-6">
                <h5>Hotel Details:</h5>
                <p><strong>Hotel Name:</strong>Re' Hotel</p>
                <p><strong>Address:</strong> 1012, Jalan Sultan Ismail, 50100 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</p>
                <p><strong>Contact Number:</strong> 03-2778 6666</p>
                <p><strong>Email Address:</strong> enquiry@rekl.com</p>
            </div>
            <div class="col-md-6 text-right">
                <h5>Guest Details:</h5>
                <p><strong>Full Name:</strong><?php echo $customer_name;?></p>
				<p><strong>Email:</strong><?php echo $email;?></p>
				<p><strong>Phone No:</strong><?php echo $phone_no;?></p>
				<p><strong>Booking Number:</strong><?php echo $booking_id;?></p>
            </div>
        </div><br>
        <div class="row">
			<div class="col-md-6">
				<p><strong>Check-in Date:</strong><?php echo date('d F Y', strtotime($checkin)); ?></p>
			</div>
			<div class="col-md-6 text-right">
				<p><strong>Check-out Date:</strong><?php echo date('d F Y', strtotime($checkout)); ?></p>
			</div>	
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Booking Number</th>
                    <th>Date Payment</th>
                    <th>Room Type</th>
					<th>No of Stay</th>
                    <th>Total Price</th>
                    
                </tr>
            </thead>
            <tbody>
			<?php while($row = $result2->fetch_array(MYSQLI_BOTH)) { ?>
                <tr>
					<td> <?php echo $row['booking_id'];?> </td>
                    <td> <?php echo $row['payment_date'];?> </td>
					<td> <?php echo $row['room_name'];?> room</td>
					<td> <?php echo $row['no_day'];?> </td>
                    <td> RM <?php echo $row['total'];?></td>
                    
                </tr>
			<?php } ?>
            </tbody><br>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right"><strong>Tax Rate:</strong></td>
                    <td>10%</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Tax Total:</strong></td>
                    <td>RM<?php echo number_format($tax_amount, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total:</strong></td>
                    <td>RM<?php echo number_format($total_with_tax, 2); ?></td>
                </tr>
            </tfoot>
        </table><br>
        <div class="row">
            <div class="col-md-6">
                <h5>Payment Details:</h5>
				<p><strong>Payment Number:</strong><?php echo $payment_id;?></p>
                <p><strong>Payment Method:</strong><?php echo $payment_type;?></p>
                <p><strong>Payment Date:</strong><?php echo date('d F Y', strtotime($payment_date)); ?></p>
            </div>
            <div class="col-md-6 text-right">
                <h5>Guest's Signature:</h5><br><br>
				<hr>
                <p>Name : <?php echo $customer_name;?></p>
                <p><strong>Date:</strong><?php echo date('d F Y', strtotime($checkout)); ?></p>
            </div>
        </div>
        <div class="receipt-footer">
            <p>Thank you for choosing Re' Kuala Lumpur! We hope to see you again soon.</p>
        </div>
    </div>
</body>
</html>

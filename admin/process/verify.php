<?php

session_start();
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load composer's autoloader
require 'vendor/autoload.php';
$mail = new PHPMailer(true); // Passing `true` enables exceptions
try {
//Server settings
$mail->SMTPDebug = 0;
$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' =>
false,'allow_self_signed' => true)); // Enable verbose debug output
$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'replace with your gmail address'; // SMTP username
$mail->Password = 'replace with your gmail account password'; // SMTP password
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587; // TCP port to connect to
//Recipients
$mail->setFrom('from@example.com', 'Mailer');
$mail->addAddress('recipient email address'); // Add a recipient
$mail->addReplyTo('info@example.com', 'Information');
//Content
$mail->isHTML(true); // Set email format to HTML
$mail->Subject = 'ICT600 Lab 8 - Php Mailer';
$mail->Body = '<b>It works!</b>';
$mail->send();
echo 'Message has been sent';
} catch (Exception $e) {
echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
} 
?>

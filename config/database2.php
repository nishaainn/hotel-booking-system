<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zateeyn_hotel";

// CREATE CONNECTION
$con = new mysqli($servername, $username, $password, $dbname);
// CHECK CONNECTION
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}

date_default_timezone_set("Asia/Kuala_Lumpur");



?>
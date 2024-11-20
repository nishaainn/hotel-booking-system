<?php

if (!isset($_SESSION['loggedin'])) {
   session_destroy();
   header("Location : ../admin/pages/login.php");
   exit();
}

$staff_email = $_SESSION['staff_email'];

?>
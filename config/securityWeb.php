<?php

if (!isset($_SESSION['loggedin'])) {
    session_destroy();
    header("Location : ../pages/index.php");
    exit();
}

$user = $_SESSION['email'];

?>
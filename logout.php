<?php
session_start();
$_SESSION['isLoggedin'] = false;
$_SESSION['account_type'] = '';
header("Location: homepage.php");
exit(); 
?>
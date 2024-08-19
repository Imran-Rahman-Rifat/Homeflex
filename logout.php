<?php
session_start();
$_SESSION['isLoggedin'] = false;
$_SESSION['account_type'] = '';
$_SESSION['username'] = '';
$_SESSION['email'] = '';
$_SESSION['phone_num'] = '';
$_SESSION['owner_id'] = '';
$_SESSION['resident_id'] = '';
header("Location: homepage.php");
exit(); 
?>
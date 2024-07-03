<?php
$errLogin=0;
if(isset($_POST['submit'])){
    include "dbconfig.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql ="Select email, passwords, account_type from users where email = '$email' AND passwords = '$password'";
    $result = $conn -> query($sql);
    if($result && $result->num_rows > 0){
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['account_type'] = $row['account_type'];
        $_SESSION['isLoggedin'] = true;
        $_SESSION['email'] = $email;
        header("Location: homepage.php");
        exit(); 
    }
    else{
    $errLogin=1;
    $_SESSION['isLoggedin'] = false;
    }
    $conn -> close();
}
?>
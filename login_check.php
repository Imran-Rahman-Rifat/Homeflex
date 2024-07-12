<?php
$errLogin=0;
if(isset($_POST['submit'])){
    include "dbconfig.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql ="Select email, passwords, account_type, user_id from users where email = '$email' AND passwords = '$password'";
    $result = $conn -> query($sql);
    if($result && $result->num_rows > 0){
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['account_type'] = $row['account_type'];
        $_SESSION['isLoggedin'] = true;
        $_SESSION['email'] = $email;
        $user=$row['user_id'];
        if($row['account_type'] == 'Owner'){
            $query = "SELECT username,phone_num,owner_id FROM owner WHERE user_id = '$user'";
            $res = $conn -> query($query);
            $row1 = $res->fetch_assoc();
            $_SESSION['username'] = $row1['username'];
            $_SESSION['phone_num'] = $row1['phone_num'];
            $_SESSION['owner_id'] = $row1['owner_id'];          
        }
        else{
            $query = "SELECT * FROM resident WHERE user_id = '$user'";
            $res = $conn -> query($query);
            $row1 = $res->fetch_assoc();
            $_SESSION['username'] = $row1['username'];
            $_SESSION['phone_num'] = $row1['phone_num'];
            $_SESSION['resident_id'] = $row1['resident_id']; 
        }
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
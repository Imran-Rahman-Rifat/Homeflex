<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "homeflex";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("DB Connection failed: " . $conn->connect_error);
    } 
?>

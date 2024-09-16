<?php
include "dbconfig.php";

function insert_ownerOrResident($account_type, $conn, $email, $username, $phone_num) {
    $user_id_query = "SELECT user_id FROM users WHERE email='$email'";
    $result = $conn->query($user_id_query);   
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        
        $sql = "INSERT INTO $account_type (user_id, username, phone_num) VALUES ('$user_id', '$username', '$phone_num')";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: User not found.";
    }
}

$errName = 0;
$errPass = 0; 
$errEmail = 0;
$flag = 1;

if (isset($_POST['submit'])) {
    if (empty($_POST['account_type'])) {
        $errName = 1;
    } else {
        $username = $_POST['username'];
        $phone_num = $_POST['phone_num'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $account_type = $_POST['account_type'] === 'Owner' ? 'Owner' : 'Resident';

        // Check if passwords match
        if ($password !== $confirm_password) {
            $errPass = 1; // Passwords do not match
            $flag = 0;
        }

        // Check password length
        if (strlen($password) < 8 || strlen($password) > 32) {
            $errPass = 2; // Invalid password length
            $flag = 0;
        }

        // Check if email already exists
        $email_check_query = "SELECT email FROM users WHERE email = '$email'";
        $email_check_result = $conn->query($email_check_query);
        if ($email_check_result && $email_check_result->num_rows > 0) {
            $errEmail = 1; // Email already exists
            $flag = 0;
        }

        // If all checks pass, hash the password and insert the data
        if ($flag) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
            $sql = "INSERT INTO users (email, passwords, account_type) VALUES ('$email', '$hashed_password', '$account_type')";
            $result = $conn->query($sql);
            
            if (!$result) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            } else {
                if ($account_type === 'Owner') {
                    insert_ownerOrResident('owner', $conn, $email, $username, $phone_num);
                } else {
                    insert_ownerOrResident('resident', $conn, $email, $username, $phone_num);
                }
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <title>Register</title>
</head>
<body>
    <?php include "navbar.php"; ?>
    <br><br>
    <div class="bg d-flex justify-content-center align-items-center">
        <div class="login-container">
            <h1 class="text-center mb-4" style="color:white">Registration</h1>
            <form action="" method="POST">
                <div>
                    <b><span style="color:white">Are you Owner or Resident?</span></b>
                </div>
                <div>
                    <input type="radio" name="account_type" value="Owner">
                    <label><p style="color:white">Owner</p></label>
                    <input type="radio" name="account_type" value="Resident">
                    <label><p style="color:white">Resident</p></label>
                    <?php
                    if ($errName == 1) {
                        echo '<p style="color:red">Please select account type<p>';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <input type="username" name="username" class="form-control form-control-lg" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="phone_num" class="form-control form-control-lg" placeholder="Phone Number" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email address" required>
                    <?php
                    if ($errEmail == 1) {
                        echo '<p style="color:red">Email address already exists.<p>';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                    <?php
                    if ($errPass == 2) {
                        echo '<p style="color:red">Password must be between 8 and 32 characters.<p>';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <input type="password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm Password" required>
                    <?php
                    if ($errPass == 1) {
                        echo '<p style="color:red">Passwords do not match.<p>';
                    }
                    ?>
                </div>
                <div class="mb-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg w-100">Register</button>
                    <?php
                    if ($flag == 7) {
                        echo '<p style="color:green">Account created successfully.<p>';
                    }
                    ?>
                </div>
                <div class="text-center register-link">
                    <small style="color:white">Already have an account? <a href="login.php">Login</a></small>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

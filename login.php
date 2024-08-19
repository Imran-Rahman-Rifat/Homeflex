<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>Login</title>
    
</head>
<body>
    <?php 
    include "navbar.php";
    include "login_check.php";
    ?>
    <div class="bg d-flex justify-content-center align-items-center">
        <div class="login-container">
            <h1 class="text-center mb-4" style="color:white">Login</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email address" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                </div>
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="formCheck">
                        <label for="formCheck"><small style="color:white">Remember Me</small></label>
                    </div>
                    <div class="forgot">
                        <small><a href="#">Forgot Password?</a></small>
                    </div>
                </div>
                <div class="mb-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg w-100">Login</button>
                    <?php
                    if($errLogin==1){
                        echo '<p style="color:red">Incorrect email or password</p>';
                    }
                    ?>
                    
                </div>
                <div class="text-center register-link">
                    <small style="color:white">Don't have an account? <a href="register.php">Register</a></small>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
  include "navbar.php";
  $update_msg = 0;
  if (isset($_POST['save'])) {
    include "dbconfig.php";
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $email = $_SESSION['email']; 
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT passwords FROM users WHERE user_id = '$user_id'";
    $result = $conn->query($sql);
 
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['passwords'];
        if (password_verify($old_password, $row['passwords'])) {

            if (strlen($new_password) >= 8 && strlen($new_password) <= 32) {
                
                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                
                $update_sql = "UPDATE users SET passwords = '$new_hashed_password' WHERE user_id = '$user_id'";
                $update_result = $conn->query($update_sql);
                
                if ($update_result) {
                  $update_msg = 1;
                    echo "<p style='color: green;'>Password updated successfully!</p>";
                } else {
                    $update_msg = 2;
                    echo "<p style='color: red;'>Error updating password. Please try again.</p>";
                }
                
            } else {
                $update_msg = 3;
                echo "<p style='color: red;'>New password must be between 8 and 32 characters.</p>";
            }
        } else {
            $update_msg = 4;
            echo "<p style='color: red;'>Incorrect old password.</p>";
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomeFlex - Settings</title>
  <!-- css file link -->
  <link rel="stylesheet" href="index.css">
  <!-- Bootstrap link -->
  <link rel="stylesheet"href="css/bootstrap.min.css"></link>
  <scrip scr="js/bootstrap.bundle.min.js"></scrip>
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <br><br>

  <div class="custom-container">
    <div class="custom-card">
      <div class="custom-card-body">
        <h2 class="custom-h2 text-center mb-4">Settings</h2>
        
        <form action="" method="POST">
          <div class="custom-form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username'] ?>" disabled>
          </div>

          <div class="custom-form-group">
            <label for="email" name="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $_SESSION['email'] ?>" disabled>
          </div>

          <div class="custom-form-group">
            <label for="password">Old Password</label>
            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="old Password" required>
          </div>

          <div class="custom-form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
          </div>

          <button name="save" type="submit" class="btn btn-primary custom-btn-save btn-block">Save Changes</button>
        </form>
        <?php
        if($update_msg == 1){
          echo "<p style='color: green;'>Password updated successfully!</p>";
          $update_msg = 0 ;
        }  
        else if($update_msg == 2){
          echo "<p style='color: red;'>Error updating password. Please try again.</p>";
          $update_msg = 0 ;
        } 
        else if($update_msg == 3){
          echo "<p style='color: red;'>New password must be between 8 and 32 characters.</p>";
          $update_msg = 0 ;
        } 
        else if($update_msg == 4){
          echo "<p style='color: red;'>Incorrect old password.</p>";
          $update_msg = 0 ;
        } 
        ?>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

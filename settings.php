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
  <?php include "navbar.php" ?>
  <br><br>

  <div class="custom-container">
    <div class="custom-card">
      <div class="custom-card-body">
        <h2 class="custom-h2 text-center mb-4">Settings</h2>
        
        <form action="save_settings.php" method="POST">
          <div class="custom-form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="Username" disabled>
          </div>

          <div class="custom-form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
          </div>

          <div class="custom-form-group">
            <label for="password">Old Password</label>
            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="old Password" required>
          </div>

          <div class="custom-form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
          </div>

          <button type="submit" class="btn btn-primary custom-btn-save btn-block">Save Changes</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

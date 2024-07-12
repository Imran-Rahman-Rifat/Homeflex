<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomeFlex - Settings</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .custom-container {
      max-width: 600px;
      margin: 50px auto;
    }

    .custom-card {
      border: none;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .custom-card-body {
      padding: 2rem;
    }

    .custom-form-group {
      margin-bottom: 1.5rem;
    }

    .custom-h2 {
      color: #343a40;
    }

    .custom-label {
      font-weight: bold;
    }

    .custom-btn-save {
      background-color: #007bff;
      color: #fff;
      border: none;
    }

    .custom-btn-save:hover {
      background-color: #0056b3;
    }
  </style>
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
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          </div>

          <div class="custom-form-group">
            <label for="notifications">Notifications</label>
            <select class="form-control" id="notifications" name="notifications">
              <option value="on">On</option>
              <option value="off">Off</option>
            </select>
          </div>

          <button type="submit" class="btn custom-btn-save btn-block">Save Changes</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

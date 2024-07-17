<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomeFlex - User Profile</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      background-color: #f8f9fa;
    }

    h1 {
      color: #343a40;
      margin-bottom: 20px;
    }

    .card {
      border: none;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
      margin-bottom: 20px;
    }

    .profile-pic {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
    }

    .btn-edit {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <?php include "navbar.php" ?>
  </br> </br> </br>
  <div class="container my-4">
    <h1 class="text-center mb-4">User Profile</h1>
    <div class="row">
      <div class="col-md-4 text-center">
        <div class="card">
          <div class="card-body">
            <img src="./img/profile.png" alt="Profile Picture" class="profile-pic mb-3">
            <h3><?php echo $_SESSION['username']?></h3>
            <!--<button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>-->
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h4>Personal Information</h4>
            <p>Name: <strong><?php echo $_SESSION['username']?></strong></p>
            <p>Email: <strong><?php echo $_SESSION['email']?></strong></p>
            <p>Phone: <strong><?php echo $_SESSION['phone_num']?></strong></p>
            <p>Acoount Type: <strong><?php echo $_SESSION['account_type']?></strong></p>
            <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editProfileModal">Edit Information</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Profile Modal -->
  <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="profilePicture">Profile Picture</label>
              <input type="file" class="form-control-file" id="profilePicture">
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" value="<?php echo $_SESSION['username']?>">
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" id="phone" value="<?php echo $_SESSION['phone_num']?>">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- appartment added by self -->
  <?php
  include "dbconfig.php";
  if($_SESSION['account_type']== "Owner")
  {
  $owner_id = $_SESSION['owner_id'];
  $sql = "SELECT * FROM appartment 
        INNER JOIN location ON appartment.appart_id = location.appart_id 
        INNER JOIN image ON appartment.appart_id = image.appart_id 
        WHERE appartment.owner_id = '$owner_id'";

  $result = $conn->query($sql);

  ?>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                <?php
                $cnt=0;
                while($row = mysqli_fetch_assoc($result)){
                $cnt++;
                //if($cnt==2) break;
                ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                            <a href="apartmentDetails.php?id=<?php echo $row['appart_id']; ?>"><img class="img-fluid" src="./img/<?php echo $row['title_img']; ?>" alt=""></a>
                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Appartment</div>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-3"><?php echo $row['price']; ?></h5>
                                <a class="d-block h5 mb-2" href="apartmentDetails.php?id=<?php echo $row['appart_id']; ?>"><?php echo $row['title']; ?></a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo "<span>" ." ".$row['thana']. ", " .$row['district']."</span>"; ?></p>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i><?php echo $row['sqft']; ?>sqft</small>
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i><?php echo $row['bedroom_num']; ?> Bed</small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i><?php echo $row['bathroom_num']; ?> Bath</small>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    $conn -> close();
                    ?>
                </div>
            </div>
            
        </div>
        <?php
  }
  ?>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

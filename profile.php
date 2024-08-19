<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomeFlex - User Profile</title>
  <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include "navbar.php";
  include "dbconfig.php";
  ?>
  </br> </br> </br>
  <?php
  if(isset($_GET['id']) && $_GET['id'] != 0 && $_GET['id'] != -1){
    $booking_resident_id = $_GET['id'];
    if(isset($_GET['x']) && $_GET['x']==1) 
      $sql1 = "SELECT * FROM resident inner join users on resident.user_id = users.user_id where resident.resident_id ='$booking_resident_id'";
    else
      $sql1 = "SELECT * FROM owner inner join users on owner.user_id = users.user_id where owner.owner_id ='$booking_resident_id'";
    //$sql1 = "SELECT * FROM resident inner join users on resident.user_id = users.user_id where resident.resident_id ='$booking_resident_id'";
    $result1 = $conn -> query($sql1);
    $row1 = $result1->fetch_assoc();
    $_SESSION['username__'] = $row1['username'];
    $_SESSION['phone_num__'] = $row1['phone_num'];
    $_SESSION['email__'] = $row1['email'];
    $_SESSION['account_type__'] = $row1['account_type'];
    $_SESSION['user_id__'] = $row1['user_id'];
  }
  ?>
  <div class="container my-4">
    <h1 class="text-center mb-4">User Profile</h1>
    <div class="row">
      <div class="col-md-4 text-center">
        <div class="card">
          <div class="card-body">
            <img src="./img/profile.png" alt="Profile Picture" class="profile-pic mb-3">
            <?php
            if((!empty($_SESSION['owner_id']) && $_GET['id'] != -1 && !($_SESSION['owner_id'] == $_SESSION['owner_id_'])) || (!empty($_SESSION['resident_id']) && $_GET['id'] != -1))
            {
            ?>
            <div class="text-white position-absolute end-0 top-0 m-0 py-1 px-3">
              <button class="btn btn-primary" data-toggle="modal" data-target="#editReportModal">Report</button>
            </div>
            <?php
            }
            ?>
            <h3><?php 
            if(isset($_GET['id'])){
              $id = $_GET['id'];
              if($id == -1) echo $_SESSION['username'];
              else if($id == 0) echo $_SESSION['username_'];
              else echo $_SESSION['username__'];
            }
            ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h4>Personal Information</h4>
            <p>Name: <strong><?php
             if(isset($_GET['id'])){
                $id = $_GET['id'];
                if($id == -1) echo $_SESSION['username'];
                else if($id == 0) echo $_SESSION['username_'];
                else echo $_SESSION['username__'];
              }
             ?>
             </strong></p>
            <p>Email: <strong><?php
             if(isset($_GET['id'])){
                $id = $_GET['id'];
                if($id == -1) echo $_SESSION['email'];
                else if($id == 0) echo $_SESSION['email_'];
                else echo $_SESSION['email__'];
              }
             ?>
             </strong></p>
            <p>Phone: <strong><?php
             if(isset($_GET['id'])){
              $id = $_GET['id'];
              if($id == -1) echo $_SESSION['phone_num'];
              else if($id == 0) echo $_SESSION['phone_num_'];
              else echo $_SESSION['phone_num__'];
            }
             ?>
             </strong></p>
            <p>Acoount Type: <strong><?php
             if(isset($_GET['id'])){
              $id = $_GET['id'];
              if($id == -1) echo $_SESSION['account_type'];
              else if($id == 0) echo $_SESSION['account_type_'];
              else echo $_SESSION['account_type__'];
            }
             ?>
             </strong></p>
             <?php 
             if((!empty($_SESSION['owner_id']) && ($_GET['id'] == -1 || $_SESSION['owner_id'] == $_SESSION['owner_id_'])) || (!empty($_SESSION['resident_id']) && $_GET['id'] == -1))
             {
             ?>
            <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editProfileModal">Edit Information</button>
            <?php 
             }
            ?>
            <?php
            if((!empty($_SESSION['owner_id']) && $_GET['id'] != -1 && !($_SESSION['owner_id'] == $_SESSION['owner_id_'])) || (!empty($_SESSION['resident_id']) && $_GET['id'] != -1))
            {
            ?>
            <a href="message.php?ed=<?php echo $_GET['id']; ?>"><button  class="btn btn-primary btn-edit">Message</button></a>
            <?php
            }
            ?>
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

  <!-- edit report modal -->
  <div class="modal fade" id="editReportModal" tabindex="-1" aria-labelledby="editReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="custom-form-group form-group">
                <label for="inputShortDescription">Report</label>
                <textarea class="form-control" name="short_des" id="inputReportDescription" placeholder="Report" rows="5" required></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Report</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- appartment added by self -->
  <div class="container my-5 d-grid gap-5">
  <?php
  include "dbconfig.php";
  if($_GET['id'] == 0 || $_GET['id']== -1){
  if(empty($_SESSION['account_type_'])  || empty($_SESSION['account_type']) || ($_SESSION['account_type_'] == "Owner" && $_GET['id'] == 0) || ($_SESSION['account_type'] == "Owner"))
  {
    if(!$_GET['id'])
      $owner_id = $_SESSION['owner_id_'];
    else
      $owner_id = $_SESSION['owner_id'];
  $sql = "SELECT * FROM appartment 
        INNER JOIN location ON appartment.appart_id = location.appart_id 
        INNER JOIN image ON appartment.appart_id = image.appart_id 
        WHERE appartment.owner_id = '$owner_id'";

  $result = $conn->query($sql);
  ?>
  <?php
  if(!empty($_SESSION['owner_id']) && ($_GET['id'] || $_SESSION['owner_id'] == $_SESSION['owner_id_']))
  {
  ?>
  <h3 class="mb-3">Appartment Added by Yourself</h3>
  <?php
  }
  ?>
  <?php
  if(empty($_SESSION['owner_id'])  || (!$_GET['id'] && !($_SESSION['owner_id'] == $_SESSION['owner_id_'])))
  {
  ?>
  <h3 class="mb-3">More From <?php echo $_SESSION['username_'] ?></h3>
  <?php
  }
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
  }
  $_SESSION['owner_id_'] = "";
  ?>
  </div>
  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha512-oBqDVmMz4fnFO9gybHf4Kz6FblczI6aS3YrTXtVxy6plkEZk9h/8S7uDuScB/wK6e4RjjdLtVrB3LLMcLn5emw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-kenU1KFdBIe4zVF0s0G1M7b4yHCuP4E4SZO6zEMf3Tk3lw59p5X3/hu4h+2JVRcStj5a7r8gJr73zpvU8v+K8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

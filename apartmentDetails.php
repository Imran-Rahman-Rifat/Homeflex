<?php
include "dbconfig.php";
include "navbar.php";
if(isset($_POST['apartment'])){
  $appart_id = $_GET['id'];
  $title = $_POST['title'];
  $price = $_POST['price'];
  $short_des = $_POST['short_des'];
  $whom_to_rent = $_POST['whom_to_rent'];
  $total_room = $_POST['total_room'];
  $bedroom_num = $_POST['bedroom_num'];
  $bathroom_num = $_POST['bathroom_num'];
  $sqft = $_POST['sqft'];
  $lift = $_POST['lift'];
  $date = $_POST['date'];
  $floor_no = $_POST['floor_no'];
  $sql = "UPDATE appartment SET title = '$title', price = '$price', sqft = '$sqft', available_date = '$date', short_des = '$short_des',
          lift_facility = '$lift', bedroom_num = '$bedroom_num', bathroom_num = '$bathroom_num' , total_room = '$total_room',
          whom_to_rent = '$whom_to_rent', floor_no = '$floor_no' WHERE appart_id = '$appart_id'";
  $result = $conn->query($sql);
}
if(isset($_POST['location'])){
  $appart_id = $_GET['id'];
  $division = $_POST['division'];
  $district = $_POST['district'];
  $thana = $_POST['thana'];
  $ward_no = $_POST['ward_no'];
  $house_no = $_POST['house_no'];
  $address = $_POST['address'];
  $sql ="insert into location(appart_id, division, district, thana, ward_no, house_no, address) 
  VALUES ('$appart_id', '$division', '$district', '$thana', '$ward_no', '$house_no', '$address')";
  $sql = "UPDATE location SET division = '$division', district = '$district', thana = '$thana', ward_no = '$ward_no',
          house_no = '$house_no', address = '$address' WHERE appart_id = '$appart_id'";
  $result = $conn->query($sql);
}
?>
<?php
    if (isset($_GET['id'])) {
        $appart_id = $_GET['id'];
        $sql = "SELECT * FROM appartment 
                INNER JOIN location ON appartment.appart_id = location.appart_id 
                INNER JOIN image ON appartment.appart_id = image.appart_id 
                WHERE appartment.appart_id='$appart_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $owner_id = $row['owner_id'];
            $_SESSION['owner_id_'] = $owner_id;
            $sql1 = "SELECT * FROM owner WHERE owner_id = '$owner_id'";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            $_SESSION['username_'] = $row1['username'];
            $_SESSION['phone_num_'] = $row1['phone_num'];
            $user_id = $row1['user_id'];
            $_SESSION['user_id_'] = $user_id;
            $sql2 = "SELECT * FROM users WHERE user_id = '$user_id'";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $_SESSION['email_'] = $row2['email'];
            $_SESSION['account_type_'] = $row2['account_type'];
            $_SESSION['profile_pic_'] = $row2['profile_pic'];
        }
    }
    if(isset($_POST['req_booking'])){
      $from = $_SESSION['resident_id'];
      $to = $_SESSION['owner_id_'];
      $sql = "INSERT INTO booking(from_,to_,appart_id) VALUES ('$from' , '$to' , '$appart_id')";
      $result = $conn->query($sql);
    }
    if(isset($_POST['unbook'])){
      $appart_id = $_GET['id'];
      $sql = "UPDATE appartment SET is_booked = false where appart_id = '$appart_id'";
      $ans = $conn->query($sql);
      $sql = "DELETE FROM booking where appart_id = '$appart_id'";
      $ans = $conn->query($sql);
    }
    
?>
<?php
if(isset($_POST['ok'])){
  $booking_resident_id = $_POST['booking_resident_id'];
  $appart_id = $_POST['appart_id'];
  $updateStatusQuery = "UPDATE booking SET status = 'accepted', status_updated_at = NOW() WHERE from_='$booking_resident_id' AND appart_id='$appart_id'";
  $result = $conn->query($updateStatusQuery);
  $sql = "UPDATE appartment SET is_booked = true WHERE appart_id='$appart_id'";
  $result = $conn ->query($sql);
  $sql = "DELETE FROM booking WHERE from_!='$booking_resident_id' AND appart_id='$appart_id'";
  $result = $conn->query($sql);
}
if(isset($_POST['not_ok'])){
  $booking_resident_id = $_POST['booking_resident_id'];
  $appart_id = $_POST['appart_id'];
  $updateStatusQuery = "UPDATE booking SET status = 'rejected', status_updated_at = NOW() WHERE from_='$booking_resident_id' AND appart_id='$appart_id'";
  $result = $conn->query($updateStatusQuery);
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomeFlex - Apartment Details</title>
  <!-- css file link -->
  <link rel="stylesheet" href="index.css">
    <!-- Bootstrap link -->
    <link rel="stylesheet"href="css/bootstrap.min.css"></link>
    <scrip scr="js/bootstrap.bundle.min.js"></scrip>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <br><br><br>
  <div class="container my-4">
    <h1 class="text-center mb-4">Apartment Details</h1>
    <div class="row">
      <div class="col-md-8">
      <p>Added By <a href="profile.php?id=0" class="custom-added-by-link"><?php echo $_SESSION['username_'] ?></a></p>
        <div id="apartmentCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="./img/<?php echo $row['title_img'];?>" class="d-block w-100" alt="Title Image">
            </div>
            <div class="carousel-item">
              <img src="./img/<?php echo $row['bedroom_img'];?>" class="d-block w-100" alt="Bedroom Image">
            </div>
            <div class="carousel-item">
              <img src="./img/<?php echo $row['bathroom_img'];?>" class="d-block w-100" alt="Bathroom Image">
            </div>
            <div class="carousel-item">
              <img src="./img/<?php echo $row['kitchen_img'];?>" class="d-block w-100" alt="Kitchen Image">
            </div>
            <div class="carousel-item">
              <img src="./img/<?php echo $row['extra_img'];?>" class="d-block w-100" alt="Additional Image">
            </div>
          </div>
          <a class="carousel-control-prev" href="#apartmentCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#apartmentCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          <?php
          if(!empty($_SESSION['account_type']) && $_SESSION['account_type'] == "Resident")
          {
          ?>
          <?php
          $resident_id = $_SESSION['resident_id'];
          $sql = "SELECT * from booking where from_ = '$resident_id' AND appart_id = '$appart_id'";
          $result = $conn -> query($sql);
          $row_ = mysqli_fetch_assoc($result);
          if($result->num_rows <= 0)
          {
          ?>
          <form action="" method="POST">
          <button class="btn btn-booking mt-3" name="req_booking">Request Booking</button>
          </form>
          <?php
          }
          ?>
          <?php
          if($result && $result->num_rows > 0)
          {
            if($row_['status']=='accepted'){
          ?>
          <div class="alert alert-success text-center">Your request accepted</div>
          <?php
            }
            else if($row_['status']=='rejected'){
          ?>
          <div class="alert alert-danger text-center">Your request rejected</div>
          <?php
            }
          else{
          ?>
          <div class="alert alert-info text-center">Request Sent</div>
          <?php
          }
        }
          ?>
          <?php
          }
          if(isset($row['is_booked']) && $row['is_booked'] && !empty($_SESSION['owner_id']) && $owner_id == $_SESSION['owner_id'])
          {
          ?>
          <form action="" method="POST">
          <button class="btn btn-booking mt-3" name="unbook">Unbook</button>
          </form>
          <?php
          }
          ?>
          <?php
          if(!empty($_SESSION['owner_id']) && $owner_id == $_SESSION['owner_id'])
          {
            $owner_id = $_SESSION['owner_id'];
            $sql = "SELECT * FROM booking WHERE to_ = '$owner_id' AND appart_id = '$appart_id' ORDER BY booking_id DESC";
            $result = $conn->query($sql);
            while ($roww = mysqli_fetch_assoc($result))
            {
              if($roww['status']=='pending'){
              $booking_resident_id = $roww['from_'];
              $appart_id = $row['appart_id'];
              $sql1 = "SELECT * FROM resident INNER JOIN users ON resident.user_id = users.user_id WHERE resident.resident_id ='$booking_resident_id'";
              $result1 = $conn->query($sql1);
              $row1 = $result1->fetch_assoc();
          ?>
          <div class="alert alert-info">
            <form method="POST" action="">
            <a href="profile.php?id=<?php echo $roww['from_']; ?>& x=1"><?php echo $row1['username']; ?></a> has sent you a booking request.
            Do you want to rent? &nbsp
            <input type="hidden" name="booking_resident_id" value="<?php echo $booking_resident_id; ?>">
            <input type="hidden" name="appart_id" value="<?php echo $appart_id; ?>">

            <button type="submit" name="ok" class="fa-solid fa-check" style="color: #3eb300;"></button>&nbsp
            <button type="submit" name="not_ok" class="fa-solid fa-xmark" style="color: #e66565;"></button>
            </form>
          </div>
          <?php
            }
          }
          }
          ?>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title"><?php echo $row['title']?></h2>
            <h4 class="text-muted">Monthly Rental Price: <?php echo $row['price']?></h4>
            <p>Available Date: <strong><?php echo $row['available_date']?></strong></p>
            <p>Square Feet: <strong><?php echo $row['sqft']?> sqft</strong></p>
            <p>Description: <strong><?php echo $row['short_des']?></strong></p>
            <p>Total Rooms: <strong><?php echo $row['total_room']?></strong></p>
            <p>Bedrooms: <strong><?php echo $row['bedroom_num']?></strong></p>
            <p>Bathrooms: <strong><?php echo $row['bathroom_num']?></strong></p>
            <p>Lift Facility: <strong><?php echo $row['lift_facility']?></strong></p>
            <p>Whom to Rent: <strong><?php echo $row['whom_to_rent']?></strong></p>
            <p>Floor No: <strong><?php echo $row['floor_no']?></strong></p>
            <?php
            if(!empty($_SESSION['owner_id']) && $owner_id == $_SESSION['owner_id'])
            {
            ?>
            <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editProfileModal">Edit Apartment Information</button>
            <?php
            }
            ?>
            <hr>
            <h4>Location</h4>
            <p>Division: <strong><?php echo $row['division']?></strong></p>
            <p>District: <strong><?php echo $row['district']?></strong></p>
            <p>Thana: <strong><?php echo $row['thana']?></strong></p>
            <p>Ward No: <strong><?php echo $row['ward_no']?></strong></p>
            <p>House No: <strong><?php echo $row['house_no']?></strong></p>
            <p>Address: <strong><?php echo $row['address']?></strong></p>
            <?php
            if(!empty($_SESSION['owner_id']) && $owner_id == $_SESSION['owner_id'])
            {
            ?>
            <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editLocationModal">Edit Location Information</button>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit apartment Modal -->
  <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Edit Apartment Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" class="form-control" id="title" value="<?php echo $row['title']?>">
            </div>
            <div class="form-group">
              <label for="rentalPrice">Monthly Rental Price</label>
              <input type="text" name="price" class="form-control" id="rentalPrice" value="<?php echo $row['price']?>">
            </div>
            <div class="form-group">
              <label for="availableDate">Available Date</label>
              <input type="date" name="date" class="form-control" id="availableDate" value="<?php echo $row['available_date']?>">
            </div>
            <div class="form-group">
              <label for="squareFeet">Square Feet</label>
              <input type="number" name="sqft" class="form-control" id="squareFeet" value="<?php echo $row['sqft']?>">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" name="short_des" id="description" rows="3"><?php echo $row['short_des']?></textarea>
            </div>
            <div class="form-group">
              <label for="totalRooms">Total Rooms</label>
              <input type="number" name="total_room" class="form-control" id="totalRooms" value="<?php echo $row['total_room']?>">
            </div>
            <div class="form-group">
              <label for="bedrooms">Bedrooms</label>
              <input type="number" name="bedroom_num" class="form-control" id="bedrooms" value="<?php echo $row['bedroom_num']?>">
            </div>
            <div class="form-group">
              <label for="bathrooms">Bathrooms</label>
              <input type="number" name="bathroom_num" class="form-control" id="bathrooms" value="<?php echo $row['bathroom_num']?>">
            </div>
            <div class="form-group">
                <label for="inputLiftFacilities">Lift Facilities</label>
                <select class="form-control" id="inputLiftFacilities" name="lift">
                    <option value="<?php echo $row['lift_facility']?>"><?php echo $row['lift_facility']?></option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputWhomToRent">Whom to Rent</label>
                <select class="form-control" id="inputWhomToRent" name="whom_to_rent">
                    <option value="<?php echo $row['whom_to_rent']?>"><?php echo $row['whom_to_rent']?></option>
                    <option value="Family">Family</option>
                    <option value="Bachelor">Bachelor</option>
                    <option value="Any">Any</option>
                </select>
            </div>
            <div class="form-group">
              <label for="floorNo">Floor No</label>
              <input type="number" name="floor_no" class="form-control" id="floorNo" value="<?php echo $row['floor_no']?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="apartment" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit Location Modal -->
  <div class="modal fade" id="editLocationModal" tabindex="-1" aria-labelledby="editLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLocationModalLabel">Edit Location Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
            <div class="form-group">
              <label for="division">Division</label>
              <input type="text" name="division" class="form-control" id="division" value="<?php echo $row['division']?>">
            </div>
            <div class="custom-form-group form-group">
                <label for="inputDivision">Division</label>
                <select class="form-control" id="inputDivision" name="division" required>
                    <option value="<?php echo $row['division']?>"><?php echo $row['division']?></option>
                    <option>Dhaka</option>
                    <option>Chattogram</option>
                    <option>Barisal</option>
                    <option>Khulna</option>
                    <option>Rajshahi</option>
                    <option>Rangpur</option>
                    <option>Mymensingh</option>
                    <option>Sylhet</option>
                </select>
            </div>
            <div class="form-group">
              <label for="district">District</label>
              <input type="text" name="district" class="form-control" id="district" value="<?php echo $row['district']?>">
            </div>
            <div class="form-group">
              <label for="thana">Thana</label>
              <input type="text" name="thana" class="form-control" id="thana" value="<?php echo $row['thana']?>">
            </div>
            <div class="form-group">
              <label for="wardNo">Ward No</label>
              <input type="number" name="ward_no" class="form-control" id="wardNo" value="<?php echo $row['ward_no']?>">
            </div>
            <div class="form-group">
              <label for="houseNo">House No</label>
              <input type="text" name="house_no" class="form-control" id="houseNo" value="<?php echo $row['house_no']?>">
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" name="address" class="form-control" id="address" value="<?php echo $row['address']?>">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="location" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <?php //include "footer.html"; ?>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

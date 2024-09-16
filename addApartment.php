<?php
// error_reporting(0);
include "dbconfig.php";
include "navbar.php";

$message = "";

if (isset($_POST['upload'])) {
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
    $temp = $_SESSION['owner_id'];
    $sql ="insert into appartment(owner_id, price, sqft, available_date, short_des, lift_facility, bedroom_num, bathroom_num, total_room, whom_to_rent, floor_no, title)
           VALUES ('$temp', '$price', '$sqft', '$date', '$short_des', '$lift', '$bedroom_num', '$bathroom_num', '$total_room', '$whom_to_rent', '$floor_no', '$title')";
    $result = $conn->query($sql);

    if ($result) {
        $division = $_POST['division'];
        $district = $_POST['district'];
        $thana = $_POST['thana'];
        $ward_no = $_POST['ward_no'];
        $house_no = $_POST['house_no'];
        $address = $_POST['address'];
        $query = "SELECT appart_id FROM appartment WHERE owner_id='$temp' order by appart_id desc";
        $result = $conn->query($query);
        $row = $result->fetch_assoc(); 
        $appart_id = $row['appart_id'];
        $sql ="insert into location(appart_id, division, district, thana, ward_no, house_no, address) 
               VALUES ('$appart_id', '$division', '$district', '$thana', '$ward_no', '$house_no', '$address')";
        $result = $conn->query($sql);
        
        $filename_title = $_FILES["uploadtitle"]["name"];
        $tempname_title = $_FILES["uploadtitle"]["tmp_name"];
        $folder_title = "./img/" . $filename_title;

        $filename_bed = $_FILES["uploadbed"]["name"];
        $tempname_bed = $_FILES["uploadbed"]["tmp_name"];
        $folder_bed = "./img/" . $filename_bed;

        $filename_bath = $_FILES["uploadbath"]["name"];
        $tempname_bath = $_FILES["uploadbath"]["tmp_name"];
        $folder_bath = "./img/" . $filename_bath;

        $filename_kitchen = $_FILES["uploadkitchen"]["name"];
        $tempname_kitchen = $_FILES["uploadkitchen"]["tmp_name"];
        $folder_kitchen = "./img/" . $filename_kitchen;

        $filename_additional = $_FILES["uploadadditional"]["name"];
        $tempname_additional = $_FILES["uploadadditional"]["tmp_name"];
        $folder_additional = "./img/" . $filename_additional;

        if (move_uploaded_file($tempname_title, $folder_title) && 
        move_uploaded_file($tempname_bed, $folder_bed) &&
        move_uploaded_file($tempname_bath, $folder_bath) &&
        move_uploaded_file($tempname_kitchen, $folder_kitchen) &&
        move_uploaded_file($tempname_additional, $folder_additional)) {

            $sql = "INSERT INTO image (appart_id, title_img, bedroom_img, bathroom_img, kitchen_img, extra_img)
                    VALUES ('$appart_id', '$filename_title', '$filename_bed', '$filename_bath', '$filename_kitchen', '$filename_additional')";
            $result = $conn->query($sql);
        }

        $message = "Successfully added!";
    } else {
        $message = "Error: Unable to add property.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Flex</title>
    <!-- css file link -->
    <link rel="stylesheet" href="index.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <br> <br> <br> 
    <div class="container custom-form-container">
        <h2 class="text-center mb-4">Property Details</h2>
        <?php if ($message): ?>
            <div class="alert alert-info text-center"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="custom-form-group form-group">
                <label for="inputTitle">Title</label>
                <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Title" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputPrice">Price</label>
                <input type="text" name="price" class="form-control" id="inputPrice" placeholder="Price" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputShortDescription">Short Description</label>
                <textarea class="form-control" name="short_des" id="inputShortDescription" placeholder="Short Description" rows="3" required></textarea>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputWhomToRent">Whom to Rent</label>
                <select class="form-control" id="inputWhomToRent" name="whom_to_rent" required>
                    <option value="" disabled selected>Select an option</option>
                    <option value="Family">Family</option>
                    <option value="Bachelor">Bachelor</option>
                    <option value="Any">Any</option>
                </select>
            </div>
            <div class="form-row">
                <div class="custom-form-group form-group col-md-6">
                    <label for="inputTotalRooms">Total Rooms</label>
                    <input type="number" name="total_room" class="form-control" id="inputTotalRooms" placeholder="Total Rooms" required>
                </div>
                <div class="custom-form-group form-group col-md-6">
                    <label for="inputBedrooms">Number of Bedrooms</label>
                    <input type="number" name="bedroom_num" class="form-control" id="inputBedrooms" placeholder="Number of Bedrooms" required>
                </div>
                <div class="custom-form-group form-group col-md-6">
                    <label for="inputBathrooms">Number of Bathrooms</label>
                    <input type="number" name="bathroom_num" class="form-control" id="inputBathrooms" placeholder="Number of Bathrooms" required>
                </div>
                <div class="custom-form-group form-group col-md-6">
                    <label for="inputSqft">Square Feet</label>
                    <input type="number" name="sqft" class="form-control" id="inputSqft" placeholder="Square Feet" required>
                </div>
                <div class="custom-form-group form-group col-md-6">
                    <label for="inputFloorNo">Floor No</label>
                    <input type="number" name="floor_no" class="form-control" id="inputFloorNo" placeholder="Floor No" required>
                </div>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputLiftFacilities">Lift Facilities</label>
                <select class="form-control" id="inputLiftFacilities" name="lift" required>
                    <option value="" disabled selected>Select an option</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputAvailableDate">Available Date</label>
                <input type="date" name="date" class="form-control" id="inputAvailableDate" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputDivision">Division</label>
                <select class="form-control" id="inputDivision" name="division" required>
                    <option value="" disabled selected>Select an option</option>
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
            <div class="custom-form-group form-group">
                <label for="inputDistrict">District</label>
                <input type="text" name="district" class="form-control" id="inputDistrict" placeholder="District" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputThana">Thana</label>
                <input type="text" name="thana" class="form-control" id="inputThana" placeholder="Thana" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputWardNo">Ward No</label>
                <input type="number" name="ward_no" class="form-control" id="inputWardNo" placeholder="Ward No" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputHouseNo">House No</label>
                <input type="text" name="house_no" class="form-control" id="inputHouseNo" placeholder="House No" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputLocation">Address</label>
                <input type="text" name="address" class="form-control" id="inputLocation" placeholder="Address" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputTitleImage">Title Image</label>
                <input type="file" class="form-control-file" name="uploadtitle" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputBedroomImage">Bedroom Image</label>
                <input type="file" class="form-control-file" name="uploadbed" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputBathroomImage">Bathroom Image</label>
                <input type="file" class="form-control-file" name="uploadbath" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputKitchenImage">Kitchen Image</label>
                <input type="file" class="form-control-file" name="uploadkitchen" required>
            </div>
            <div class="custom-form-group form-group">
                <label for="inputAdditionalImage">Additional Image</label>
                <input type="file" class="form-control-file" name="uploadadditional" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="upload">Submit</button>
        </form>
    </div>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha512-oBqDVmMz4fnFO9gybHf4Kz6FblczI6aS3YrTXtVxy6plkEZk9h/8S7uDuScB/wK6e4RjjdLtVrB3LLMcLn5emw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-kenU1KFdBIe4zVF0s0G1M7b4yHCuP4E4SZO6zEMf3Tk3lw59p5X3/hu4h+2JVRcStj5a7r8gJr73zpvU8v+K8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

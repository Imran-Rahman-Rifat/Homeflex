<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Flex - Notifications</title>
    <!-- CSS file link -->
    <link rel="stylesheet" href="index.css">
    <!-- Bootstrap link -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php 
    include "dbconfig.php";
    include "navbar.php";
    ?>
    <br> <br> <br> <br>
    <div class="container notification-container">
        <h2 class="text-center mb-4">Notifications</h2>
        <?php
        if ($_SESSION['account_type'] == 'Owner') {
            $owner_id = $_SESSION['owner_id'];
            $sql = "SELECT * FROM booking WHERE to_ = '$owner_id' ORDER BY booking_id DESC";
            $result = $conn->query($sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $booking_resident_id = $row['from_'];
                $appart_id = $row['appart_id'];
                $sql1 = "SELECT * FROM resident INNER JOIN users ON resident.user_id = users.user_id WHERE resident.resident_id ='$booking_resident_id'";
                $result1 = $conn->query($sql1);
                $row1 = $result1->fetch_assoc();

                $sql_apart = "SELECT * FROM appartment WHERE appart_id = '$appart_id'";
                $result_apart = $conn->query($sql_apart);
                $row_apart = $result_apart->fetch_assoc();
        ?>
                <!--display booking status-->
                <?php
                if ($row['status'] == 'accepted') {
                    echo '<span class="badge bg-success">Accepted</span>';
                } elseif ($row['status'] == 'rejected') {
                    echo '<span class="badge bg-danger">Rejected</span>';
                } 
                ?>
                <div class="alert alert-info">
                    <a href="profile.php?id=<?php echo $row['from_']; ?>& x=1"><?php echo $row1['username']; ?></a> has sent you a booking request for the apartment
                    <a href="apartmentDetails.php?id=<?php echo $row_apart['appart_id']; ?>"><?php echo $row_apart['title']; ?></a> at <?php echo $row['send_at'];?>
                </div>
        <?php
            }
        }
        else
        {
            $resident_id = $_SESSION['resident_id'];
            $sql = "SELECT * FROM booking WHERE from_ = '$resident_id' ORDER BY booking_id DESC";
            $result = $conn->query($sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $booking_owner_id = $row['to_'];
                $appart_id = $row['appart_id'];
                $sql1 = "SELECT * FROM owner INNER JOIN users ON owner.user_id = users.user_id WHERE owner.owner_id ='$booking_owner_id'";
                $result1 = $conn->query($sql1);
                $row1 = $result1->fetch_assoc();

                $sql_apart = "SELECT * FROM appartment WHERE appart_id = '$appart_id'";
                $result_apart = $conn->query($sql_apart);
                $row_apart = $result_apart->fetch_assoc();
        ?>
                <!--display booking status-->
                <?php
                if ($row['status'] == 'accepted') {
                    echo '<br><span class="badge bg-success">Accepted</span>';
                } elseif ($row['status'] == 'rejected') {
                    echo '<br><span class="badge bg-danger">Rejected</span>';
                } 
                ?>
                <div class="alert alert-info">
                    You sent a boooking request to <a href="profile.php?id=<?php echo $row['to_']; ?>"><?php echo $row1['username']; ?></a> for the apartment
                    <a href="apartmentDetails.php?id=<?php echo $row_apart['appart_id']; ?>& x=0"><?php echo $row_apart['title']; ?></a> at <?php echo $row['send_at'];?>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <!-- Bootstrap JS and Popper.js --> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha512-oBqDVmMz4fnFO9gybHf4Kz6FblczI6aS3YrTXtVxy6plkEZk9h/8S7uDuScB/wK6e4RjjdLtVrB3LLMcLn5emw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-kenU1KFdBIe4zVF0s0G1M7b4yHCuP4E4SZO6zEMf3Tk3lw59p5X3/hu4h+2JVRcStj5a7r8gJr73zpvU8v+K8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Flex</title>
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
    ob_start(); // Start output buffering
    include "dbconfig.php";
    include "navbar.php";
    ?>
    <br> <br> <br> <br> <br>
    <div class="username-section">
        <?php
        if ($_GET['ed'] == 0)
            $receiver_id = $_SESSION['user_id_'];
        else if (isset($_GET['sd']) && $_GET['sd'] == 1)
            $receiver_id = $_GET['ed'];
        else
            $receiver_id = $_SESSION['user_id__'];
        $sql ="SELECT * from users where user_id='$receiver_id'";
        $res = $conn -> query($sql);
        $row_ = $res ->fetch_assoc();
        if($row_['account_type'] == 'Owner') $sql1 ="SELECT * from owner where user_id='$receiver_id'";
        else $sql1 = "SELECT * from resident where user_id='$receiver_id'";
        $res1 = $conn -> query($sql1);
        $row__ = $res1->fetch_assoc();
        ?>
        <img src="./img/profile.png" alt="User Avatar" class="user-avatar">
        <strong><?php echo $row__['username']?></strong>
    </div>
    <div class="chat-container">
        <div class="chat-messages">
            <?php
            $sender_id = $_SESSION['user_id'];
            if ($_GET['ed'] == 0)
                $receiver_id = $_SESSION['user_id_'];
            else if (isset($_GET['sd']) && $_GET['sd'] == 1)
                $receiver_id = $_GET['ed'];
            else
                $receiver_id = $_SESSION['user_id__'];

            if (isset($_POST['submit'])) {
                $message = $_POST['message'];
                $sql = "INSERT into conversation(from_, to_, message) values('$sender_id', '$receiver_id', '$message')";
                $result = $conn->query($sql);
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit();
            }

            $sql1 = "SELECT * from conversation where (from_ = '$sender_id' AND to_ = '$receiver_id') OR (to_ = '$sender_id' AND from_ = '$receiver_id')";
            $result1 = $conn->query($sql1);
            while ($row = mysqli_fetch_assoc($result1)) {
            ?>
                <div class="message-box <?php echo $row['from_'] == $sender_id ? 'message-sent' : 'message-received'; ?>">
                    <h5><?php echo $row['message']; ?></h5>
                    <small class="message-time"><?php echo $row['send_at']; ?></small>
                </div>
            <?php
            }
            ?>
        </div>
        <form method="POST" action="" class="chat-form">
            <input type="text" name="message" class="form-control" placeholder="Type Message Here" required>
            <button type="submit" class="btn btn-primary" name="submit">Send</button>
        </form>
    </div>
    <?php
    ob_end_flush();
    ?>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha512-oBqDVmMz4fnFO9gybHf4Kz6FblczI6aS3YrTXtVxy6plkEZk9h/8S7uDuScB/wK6e4RjjdLtVrB3LLMcLn5emw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-kenU1KFdBIe4zVF0s0G1M7b4yHCuP4E4SZO6zEMf3Tk3lw59p5X3/hu4h+2JVRcStj5a7r8gJr73zpvU8v+K8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

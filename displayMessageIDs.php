<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Flex - Chat History</title>
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
include 'navbar.php';
?>
<br> <br> <br>
<div class="container chat-history-container">
    <h2 class="text-center mb-4">Chat History</h2>
    <?php
    include "dbconfig.php";
    $sender_id = $_SESSION['user_id'];

    $sql = "
        SELECT DISTINCT LEAST(from_, to_) AS user1, GREATEST(from_, to_) AS user2
        FROM conversation
        WHERE from_='$sender_id' OR to_='$sender_id' order by conversation_id desc";
    $result = $conn->query($sql);
    while($row = mysqli_fetch_assoc($result)){
        $display_id = ($row['user1'] == $sender_id) ? $row['user2'] : $row['user1'];
        
        $sql_users = "SELECT * FROM users WHERE user_id = '$display_id'";
        $result_users = $conn->query($sql_users);
        $row_users = $result_users->fetch_assoc();

        if($row_users['account_type'] == 'Owner')
            $sql_type = "SELECT * FROM owner WHERE user_id = '$display_id'";
        else
            $sql_type = "SELECT * FROM resident WHERE user_id = '$display_id'";
        
        $result_type = $conn->query($sql_type);
        $row_type = $result_type->fetch_assoc();

        $_SESSION['isMessage'] = true;
        ?>
        <div class="alert alert-info">
            <div class="user-info">
                <img src="./img/profile.png" alt="User Avatar" class="user-avatar">
                <strong><a href="message.php?ed=<?php echo $display_id; ?>&sd=1">
                <?php echo $row_type['username']; ?></a></strong>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<!-- Bootstrap JS and Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha512-oBqDVmMz4fnFO9gybHf4Kz6FblczI6aS3YrTXtVxy6plkEZk9h/8S7uDuScB/wK6e4RjjdLtVrB3LLMcLn5emw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-kenU1KFdBIe4zVF0s0G1M7b4yHCuP4E4SZO6zEMf3Tk3lw59p5X3/hu4h+2JVRcStj5a7r8gJr73zpvU8v+K8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

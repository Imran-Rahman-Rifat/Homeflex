<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rentals</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet"href="css/bootstrap.min.css"></link>
    <scrip scr="js/bootstrap.bundle.min.js"></scrip>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
    include "navbar.php";
    ?>
     <!-- Image -->
     <div class="banner-image-2 w-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="content text-center">
            <h1 class="text-white pb-5">FIND YOUR PERFECT PLACE</h1>
        </div>       
     </div>
    </br></br>
    <?php
    include "allApartment.php";
    ?> 
    </br></br>    
    <?php
    include "footer.html";
    ?>  
</body>
</html>
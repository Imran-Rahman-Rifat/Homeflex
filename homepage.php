<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Flex</title>
    <!-- css file link -->
    <link rel="stylesheet" href="index.css">
    <!-- Bootstrap link -->
    <link rel="stylesheet"href="css/bootstrap.min.css"></link>
    <scrip scr="js/bootstrap.bundle.min.js"></scrip>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
        include "navbar.php";
        $_SESSION['apart_cnt'] = 0;
    ?>
     <!-- Image -->
     <div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center ">
        <div class="content text-center">
            <h1 class="text-white pb-5">FIND YOUR PERFECT PLACE</h1>
            <div class="input-group">
            <form method="GET" action="ManageRental.php" class="d-flex w-100 align-items-center">
                <input type="search" name="search" class="form-control rounded" placeholder="City, ZIP" aria-label="Search" aria-describedby="search-addon" style="flex: 1;" />
                <button type="submit" class="btn btn-primary ms-2">Search</button>
            </form>
            </div>
        </div>       
     </div>

     <!-- Main content Area -->
    <div class="container my-5 d-grid gap-5">
        <div class="p-5 ">
            <header>
                <h1 class="text-center">Explore Rentals in Dhaka</h1>
            </header> 
        </div>
        <!-- Property List Start -->       
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3">Property Listing</h1>
                            <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit diam justo sed rebum.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                            <li class="nav-item me-2">
                                <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Featured</a>
                            </li>
                            <!--<li class="nav-item me-2">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">For Sell</a>
                            </li>
                            <li class="nav-item me-0">
                                <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">For Rent</a>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
        <!-- Property List end -->
    <?php
    include "allApartment.php";
    ?>   
    <div class="col-12 text-center">
        <a class="btn btn-primary py-3 px-5" href="ManageRental.php?id=1">Browse More Property</a>
    </div>      
        
    </div>
    <!-- Main content Area End -->
    <div class="row mydiv1">
        <header>
            <h1 class="text-center pt-5">This Is Our Story</h1>
        </header>
        <div class="story ">
            <p class=" text-center p-5">I'm a paragraph. Click here to add your own text and edit me.<br>It's easy. Just click “Edit Text” or double click me to add your own content and make changes to the font.<br> I’m a great place for you to tell a story and let your users know a little more about you.</p>
            <div class="text-center p-5">
                <!--<button type="button" class="btn btn-outline-primary  py-3 px-5">Read More</button>-->
                <a class="btn btn-primary py-3 px-5" href="about.php">Read More</a>
            </div>
        </div>
    </div>
    
    <div class="row mydiv2">
    <header>
        <h1 class="text-center text-white pt-5">For Anything You Need</h1>
        <h5 class="text-center text-white">Our stellar service</h5>

        <div class="row g-4 d-flex justify-content-center">
            <div class="col-lg-3 col-sm-6 wow fadeInUp d-flex justify-content-center" data-wow-delay="0.1s">
                <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                    <h6>For Family</h6>
                    <div class="rounded p-4 img-container">
                        <div class="icon mb-3 d-flex justify-content-center">
                            <img class="img-fluid custom-img" src="img/family.jpg" alt="Family Icon">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp d-flex justify-content-center" data-wow-delay="0.1s">
                <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                    <h6>For Bachelor</h6>
                    <div class="rounded p-4 img-container">
                        <div class="icon mb-3 d-flex justify-content-center">
                            <img class="img-fluid custom-img" src="img/bachelor.jpg" alt="Bachelor Icon">
                        </div>                      
                    </div>
                </a>
            </div>
        </div>
    </header>
    </div>

    <?php
    include "footer.html"
    ?>  
</body>
</html>
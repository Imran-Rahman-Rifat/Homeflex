<!-- Navbar -->
<?php session_start(); ?>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3" style="background-color:black;">
    <div class="container">
        <a href="homepage.php" class="navbar-brand ">Home Flex</a>
        <button
            type="button"
            class="navbar-toggler"
            data-bs-target="#navbarNav"
            data-bs-toggle="collapse"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle Navbar"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="mx-auto"></div>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link text-white" href="homepage.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="about.php">About</a>
              </li>
              <?php
              if(isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'Owner'){
                echo '<li class="nav-item">
                <a class="nav-link text-white" href="#">Add Appartment</a>
                </li>';
              }
              ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="ManageRental.php">ManageRentals</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="contract.php">Contact </a>
              </li>
              <?php
              if(!isset($_SESSION['isLoggedin']) || $_SESSION['isLoggedin'] == false){
                echo '<li class="nav-item">
                <!-- <i class="fa-solid fa-user  fa-1x text-dark rounded-circle p-2 bg-light"></i> -->
                <a class="nav-link text-white" href="login.php">LogIn</a>
                </li>';
              }
              else{
                echo '<li class="nav-item">
                <!-- <i class="fa-solid fa-user  fa-1x text-dark rounded-circle p-2 bg-light"></i> -->
                <a class="nav-link text-white" href="logout.php">Profile</a>
                </li>';
              }
              ?>              
            </ul>
        </div>
    </div>
 </nav>
 <!-- Javascript Code -->
<script src="js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
  var nav = document.querySelector('nav');

  window.addEventListener('scroll', function () {
    if (window.pageYOffset > 10) {
      nav.classList.add('bg-dark', 'shadow');
    } else {
      nav.classList.remove('bg-dark', 'shadow');
    }
  });
</script>
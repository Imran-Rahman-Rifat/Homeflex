<!-- Navbar -->
<?php session_start(); ?>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3" style="background-color:black;">
    <div class="container">
        <a href="homepage.php" class="navbar-brand">Home Flex</a>
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
                    <a class="nav-link text-white" href="addApartment.php">Add Apartment</a>
                    </li>';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link text-white" href="ManageRental.php?id=1">Manage Rentals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="contact.php">Contact</a>
                </li>
                <?php
                if(!isset($_SESSION['isLoggedin']) || $_SESSION['isLoggedin'] == false){
                    echo '<li class="nav-item">
                    <a class="nav-link text-white" href="login.php">Log In</a>
                    </li>';
                } else {
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profile.php?id=-1">Profile</a></li>
                            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                            <li><a class="dropdown-item" href="notification.php">Notification</a></li>
                            <li><a class="dropdown-item" href="displayMessageIDs.php">Messages</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php
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

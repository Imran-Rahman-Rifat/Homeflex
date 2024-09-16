<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rentals</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php 
    //$val = isset($_GET['location']) ? $_GET['location'] : '';
    if(isset($_GET['search'])) $val = $_GET['search'];
    else if( isset($_GET['location'])) $val = $_GET['location'];
    else $val = '';
    include "navbar.php";
    $_SESSION['apart_cnt'] = 1;
    ?>
    <!-- Image -->
    <div class="banner-image-2 w-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="content text-center">
            <h1 class="text-white pb-5">FIND YOUR PERFECT PLACE</h1>
        </div>       
    </div>
    <br><br>
    <!-- Filter and Sort Options -->
    <div class="container my-4">
        <form method="GET" action="ManageRental.php">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?php echo $val?>">
                </div>
                <div class="col-md-3">
                    <label for="priceRange" class="form-label">Price Range</label>
                    <input type="number" class="form-control" id="priceRangeMin" name="price_min" placeholder="Min" value="<?php echo isset($_GET['price_min']) ? $_GET['price_min'] : ''; ?>">
                </div>
                <div class="col-md-3">
                    <label class="invisible">Placeholder</label>
                    <input type="number" class="form-control mt-2" id="priceRangeMax" name="price_max" placeholder="Max" value="<?php echo isset($_GET['price_max']) ? $_GET['price_max'] : ''; ?>">
                </div>
                <div class="col-md-3">
                    <label for="whomToRent" class="form-label">Whom to Rent</label>
                    <select class="form-control" id="whomToRent" name="whom_to_rent">
                        <option value="">Select an option</option>
                        <option value="Bachelor" <?php echo (isset($_GET['whom_to_rent']) && $_GET['whom_to_rent'] == 'Bachelor') ? 'selected' : ''; ?>>Bachelor</option>
                        <option value="Family" <?php echo (isset($_GET['whom_to_rent']) && $_GET['whom_to_rent'] == 'Family') ? 'selected' : ''; ?>>Family</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="totalRoom" class="form-label">Total Room</label>
                    <input type="number" class="form-control" id="totalRoom" name="total_room" placeholder="Total Room" value="<?php echo isset($_GET['total_room']) ? $_GET['total_room'] : ''; ?>">
                </div>
                <div class="col-md-3">
                    <label for="sqft" class="form-label">Square Feet</label>
                    <input type="number" class="form-control" id="sqft" name="sqft" placeholder="Square Feet" value="<?php echo isset($_GET['sqft']) ? $_GET['sqft'] : ''; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 align-self-end">
                    <button type="submit" name="filter" class="btn btn-primary mt-2">Apply Filters</button>
                </div>
            </div>
        </form>

        <!-- Sorting Options -->
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <form method="GET" action="ManageRental.php">
                    <label for="sort" class="form-label">Sort By:</label>
                    <select class="form-control d-inline-block w-auto" id="sort" name="sort" onchange="this.form.submit()">
                    <option value="newest" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'newest') ? 'selected' : ''; ?>>Newest</option>
                        <option value="oldest" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'oldest') ? 'selected' : ''; ?>>Oldest</option>
                        <option value="price_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') ? 'selected' : ''; ?>>Price (Low to High)</option>
                        <option value="price_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') ? 'selected' : ''; ?>>Price (High to Low)</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <div class="container my-5 d-grid gap-5">
        <?php include "allApartment.php"; ?>
    </div>
    
    </br></br>
    <?php include "footer.html"; ?>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha512-oBqDVmMz4fnFO9gybHf4Kz6FblczI6aS3YrTXtVxy6plkEZk9h/8S7uDuScB/wK6e4RjjdLtVrB3LLMcLn5emw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-kenU1KFdBIe4zVF0s0G1M7b4yHCuP4E4SZO6zEMf3Tk3lw59p5X3/hu4h+2JVRcStj5a7r8gJr73zpvU8v+K8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include "dbconfig.php";

// Initialize filter variables
$whereClause = "";
$sort = "ORDER BY appartment.appart_id DESC"; // Default sorting

// Handle filtering
if (isset($_GET['filter'])) {
    // Price range filter
    $price_min = isset($_GET['price_min']) ? $_GET['price_min'] : 0;
    $price_max = isset($_GET['price_max']) ? $_GET['price_max'] : PHP_INT_MAX;
    $whereClause .= " AND price BETWEEN $price_min AND $price_max";

    // Whom to rent filter
    if (!empty($_GET['whom_to_rent'])) {
        $whom_to_rent = $_GET['whom_to_rent'];
        $whereClause .= " AND whom_to_rent = '$whom_to_rent'";
    }

    // Total rooms filter
    if (!empty($_GET['total_room'])) {
        $total_room = $_GET['total_room'];
        $whereClause .= " AND total_room = $total_room";
    }

    // Square feet filter
    if (!empty($_GET['sqft'])) {
        $sqft = $_GET['sqft'];
        $whereClause .= " AND sqft >= $sqft";
    }
}

// Handle sorting
/*if (isset($_GET['sort'])) {
    $sort_option = $_GET['sort'];
    switch ($sort_option) {
        case 'price_asc':
            $sort = "ORDER BY price ASC";
            break;
        case 'price_desc':
            $sort = "ORDER BY price DESC";
            break;
        case 'newest':
            $sort = "ORDER BY appartment.appart_id DESC";
            break;
        case 'oldest':
            $sort = "ORDER BY appartment.appart_id ASC";
            break;
        default:
            $sort = "ORDER BY appartment.appart_id DESC";
            break;
    }
}*/

// SQL query with filters and sorting
$sql = "SELECT * FROM appartment 
        INNER JOIN location ON appartment.appart_id = location.appart_id 
        INNER JOIN image ON appartment.appart_id = image.appart_id 
        WHERE 1 $whereClause $sort";

$result = $conn->query($sql);

?>
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
    <?php include "navbar.php"; ?>

    <!-- Image -->
    <div class="banner-image-2 w-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="content text-center">
            <h1 class="text-white pb-5">FIND YOUR PERFECT PLACE</h1>
        </div>       
    </div>
    <br><br>

    <!-- Filter and Sort Options -->
    <div class="container my-4">
        <form method="GET" action="allApartment.php">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="priceRange" class="form-label">Price Range</label>
                    <input type="number" class="form-control" id="priceRangeMin" name="price_min" placeholder="Min">
                </div>
                <div class="col-md-3">
                    <label class="invisible">Placeholder</label>
                    <input type="number" class="form-control mt-2" id="priceRangeMax" name="price_max" placeholder="Max">
                </div>
                <div class="col-md-3">
                    <label for="whomToRent" class="form-label">Whom to Rent</label>
                    <select class="form-control" id="whomToRent" name="whom_to_rent">
                        <option value="" disabled selected>Select an option</option>
                        <option value="Family">Family</option>
                        <option value="Bachelor">Bachelor</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="totalRoom" class="form-label">Total Room</label>
                    <input type="number" class="form-control" id="totalRoom" name="total_room" placeholder="Total Room">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="sqft" class="form-label">Square Feet</label>
                    <input type="number" class="form-control" id="sqft" name="sqft" placeholder="Square Feet">
                </div>
                <div class="col-md-3 align-self-end">
                    <button type="submit" class="btn btn-primary mt-2">Apply Filters</button>
                </div>
            </div>
        </form>

        <!-- Sorting Options -->
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <form method="GET" action="allApartment.php">
                    <label for="sort" class="form-label">Sort By:</label>
                    <select class="form-control d-inline-block w-auto" id="sort" name="sort" onchange="this.form.submit()">
                        <option value="newest">Newest</option>
                        <option value="oldest">Oldest</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                    </select>
                </form>
            </div>
        </div>
    </div>


    <?php //include "allApartment.php"; ?>
    <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                <?php
                $cnt=0;
                while($row = mysqli_fetch_assoc($result)){
                $cnt++;
                //if($cnt==2) break;
                ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                            <a href="apartmentDetails.php?id=<?php echo $row['appart_id']; ?>"><img class="img-fluid" src="./img/<?php echo $row['title_img']; ?>" alt=""></a>
                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Appartment</div>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-3"><?php echo $row['price']; ?></h5>
                                <a class="d-block h5 mb-2" href="apartmentDetails.php?id=<?php echo $row['appart_id']; ?>"><?php echo $row['title']; ?></a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo "<span>".$row['thana']. ", " .$row['district']."</span>"; ?></p>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i><?php echo $row['sqft']; ?>sqft</small>
                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i><?php echo $row['bedroom_num']; ?> Bed</small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i><?php echo $row['bathroom_num']; ?> Bath</small>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    $conn -> close();
                    ?>
                </div>
            </div>
            
        </div>
</br></br>
    <?php include "footer.html"; ?>
</body>
</html>

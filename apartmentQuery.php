<?php
include "dbconfig.php";

// Initialize filter variables
$whereClause = "";
$sort = "ORDER BY appartment.appart_id DESC"; // Default sorting
if(isset($_GET['search']) && !empty($_GET['search'])){
    $location = $_GET['search'];
    $whereClause .= " AND (location.division LIKE '%$location%' 
                      OR location.district LIKE '%$location%'
                      OR location.thana LIKE '%$location%'
                      OR location.ward_no LIKE '%$location%'
                      OR location.address LIKE '%$location%')";
    $_GET['search']='';

}

// Handle filtering
if (isset($_GET['filter'])) {
    // Price range filter
    $price_min = isset($_GET['price_min']) ? $_GET['price_min'] : 0;
    $price_max = isset($_GET['price_max']) ? $_GET['price_max'] : PHP_INT_MAX;
    if (empty($price_min)) $price_min = 0;
    if (empty($price_max)) $price_max = PHP_INT_MAX;
    $whereClause .= " AND price BETWEEN $price_min AND $price_max";

    // Location filter
    if (!empty($_GET['location'])) {
        $location = $_GET['location'];
        $whereClause .= " AND (location.division LIKE '%$location%' 
                          OR location.district LIKE '%$location%'
                          OR location.thana LIKE '%$location%'
                          OR location.ward_no LIKE '%$location%'
                          OR location.address LIKE '%$location%')";
    }
    

    // Whom to rent filter
    if (!empty($_GET['whom_to_rent'])) {
        $whom_to_rent = $_GET['whom_to_rent'];
        $whereClause .= " AND (whom_to_rent = '$whom_to_rent' OR whom_to_rent = 'Any')";
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
if (isset($_GET['sort'])) {
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
}

// SQL query with filters and sorting
$sql = "SELECT * FROM appartment 
        INNER JOIN location ON appartment.appart_id = location.appart_id 
        INNER JOIN image ON appartment.appart_id = image.appart_id 
        WHERE 1 $whereClause $sort";
//echo $sql;

$result = $conn->query($sql);

?>

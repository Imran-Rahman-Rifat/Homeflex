<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomeFlex - Apartment Details</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      padding-bottom: 80px; /* Space for the static button */
    }

    h1 {
      color: #343a40;
    }

    .card {
      border: none;
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .card-body {
      padding: 1.5rem;
    }

    .carousel-inner img {
      height: 500px;
      object-fit: cover;
    }

    hr {
      border-top: 1px solid #dee2e6;
    }

    .btn-booking {
      background-color: #007bff;
      color: #fff;
      padding: 1rem 2rem;
      font-size: 1.25rem;
      border: none;
      border-radius: 0;
      width: 100%;
      transition: background-color 0.3s, transform 0.3s;
    }

    .btn-booking:hover {
      background-color: #0056b3;
      transform: scale(1.05);
    }

    .fixed-bottom-btn {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      text-align: center;
      z-index: 1000;
    }
  </style>
</head>
<body>
  <?php include "navbar.php" ?>
  <br><br><br>
  <div class="container my-4">
    <h1 class="text-center mb-4">Apartment Details</h1>
    <div class="row">
      <div class="col-md-8">
        <div id="apartmentCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="./img/carousel-1.jpg" class="d-block w-100" alt="Title Image">
            </div>
            <div class="carousel-item">
              <img src="./img/carousel-2.jpg" class="d-block w-100" alt="Bedroom Image">
            </div>
            <div class="carousel-item">
              <img src="./img/carousel-1.jpg" class="d-block w-100" alt="Bathroom Image">
            </div>
            <div class="carousel-item">
              <img src="./img/carousel-2.jpg" class="d-block w-100" alt="Kitchen Image">
            </div>
            <div class="carousel-item">
              <img src="./img/carousel-1.jpg" class="d-block w-100" alt="Additional Image">
            </div>
          </div>
          <a class="carousel-control-prev" href="#apartmentCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#apartmentCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Apartment Title</h2>
            <h4 class="text-muted">Monthly Rental Price: $1500</h4>
            <p>Available Date: <strong>1st August 2023</strong></p>
            <p>Square Feet: <strong>1200 sqft</strong></p>
            <p>Description: <strong>Beautiful apartment with spacious rooms and modern amenities.</strong></p>
            <p>Total Rooms: <strong>5</strong></p>
            <p>Bedrooms: <strong>3</strong></p>
            <p>Bathrooms: <strong>2</strong></p>
            <p>Lift Facility: <strong>Yes</strong></p>
            <p>Whom to Rent: <strong>Families</strong></p>
            <p>Floor No: <strong>2nd</strong></p>
            <p>Added by: <strong>Username</strong></p>
            <hr>
            <h4>Location</h4>
            <p>Division: <strong>Dhaka</strong></p>
            <p>District: <strong>Dhaka</strong></p>
            <p>Thana: <strong>Gulshan</strong></p>
            <p>Ward No: <strong>12</strong></p>
            <p>House No: <strong>45/A</strong></p>
            <p>Address: <strong>Gulshan Avenue</strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="fixed-bottom-btn">
    <button class="btn btn-booking">Request Booking</button>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

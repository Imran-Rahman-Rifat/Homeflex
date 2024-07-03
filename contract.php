<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Home Flex</title>
    <!-- css file link -->
    <link rel="stylesheet" href="index.css">
    <!-- Bootstrap link -->
    <link rel="stylesheet"href="css/bootstrap.min.css"></link>
    <scrip scr="js/bootstrap.bundle.min.js"></scrip>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    
    <div class="banner-image-2 w-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="content text-center">
            <h1 class="text-white pb-5">CONTACT US</h1>
        </div>       
     </div>

     
    <div class="container my-5">
        <h1 class="text-center my-4">You're Welcome to Visit</h1></br></br>
        <div class="row">
            <div class="col-md-7">
                <h2>Have a Question? We're Here to Help</h2>
                <p>Email us at <a href="mailto:info@my-domain.com">info@my-domain.com</a> or send us a message via the contact form below and we'll get back to you</p>
                <form action="submit_contact.php" method="POST">
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="message" class="form-control" rows="5" placeholder="Type your message here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Submit</button>
                </form>
            </div>
            <div style="alignment:center" class="col-md-5">
                <h2>Our Stores</h2>
                <address>
                    500 Terry Francine Street<br>
                    San Francisco, CA 94158<br>
                    Tel: 123-456-7890
                </address>
                <address>
                    500 Terry Francine Street<br>
                    San Francisco, CA 94158<br>
                    Tel: 123-456-7890
                </address>
                <h2>Opening Hours</h2>
                <p>Mon - Fri: 8am - 8pm</p>
                <p>Saturday: 9am - 9pm</p>
                <p>Sunday: 9am - 10pm</p>
            </div>
        </div>
    </div>
    
    <?php include 'footer.html'; ?>

</body>
</html>

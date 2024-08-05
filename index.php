<?php
session_start();
include "conn.php";

if (isset($_SESSION['error'])) {
    echo '<script>alert("' . $_SESSION['error'] . '");</script>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['rentdeny'])) {
    echo '<script>alert("' . $_SESSION['rentdeny'] . '");</script>';
    unset($_SESSION['rentdeny']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets\css\style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">RentEase- Rent a Car!</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="carlisting.php">Cars</a>
                        </li>
                        <?php if (isset($_SESSION['loginuser'])) { ?>
                        <li class="nav-item dropdown" style="display:flex; align-items: center; padding-right: 0.3rem;
                        padding-left: 0.3rem;">
                            <a href="userprofile.php">
                                <i class="fa fa-user" style="color: #fff;"></i>
                            </a>
                            <a class="nav-link dropdown-toggle" href="userprofile.php" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo "WELCOME " . $_SESSION['loginuser']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- Dropdown menu items -->
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>

                        <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="userlogin.php">Login/Sign-Up</a>
                        </li>
                        <?php } ?>
                        <?php if (isset($_SESSION['agencyuser'])) { ?>
                        <li class="nav-item dropdown" style="display:flex; align-items: center; padding-right: 0.3rem;
                        padding-left: 0.3rem;">
                            <a href="agencyaccount.php">
                                <i class="fa fa-user" style="color: #fff;"></i>
                            </a>
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo "WELCOME " . $_SESSION['agencyuser']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- Dropdown menu items -->
                                <li><a class="dropdown-item" href="agencylogout.php">Logout</a></li>
                            </ul>
                        </li>
                        <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="agencylogin.php">Want to List a Car?</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    

    <section id="hero" class="herobg">
        <div class="container">
            <h2>Efficient and Reliable Car Delivery Services</h2>
            <p>Get your car delivered to your doorstep hassle-free</p>
            <a href="#services" class="btn">Explore Services</a>
        </div>
    </section>

    <section id="services" style=" height: 70vh;  text-align: center;">
    <div class="container">
        <h2>Our Services</h2>
        <div class="service">
            <h3>Doorstep Delivery</h3>
            <p>We deliver your car directly to your doorstep.</p>
        </div>
        <div class="service">
            <h3>Secure Transport</h3>
            <p>Your car is transported securely with utmost care.</p>
        </div>
        <div class="service">
            <h3>Flexible Scheduling</h3>
            <p>Choose a delivery schedule that suits your convenience.</p>
        </div>
    </div>
</section>


    <section id="about" style=" text-align: center; ">
    <div class="container" style=" margin: 0 auto; padding: 0 20px; display: flex; align-items: center;">
        <div class="content" style="flex: 1; margin-right: 20px; text-align: left;">
            <h2>About Us</h2>
            <p>Welcome to RentEase, your trusted partner for seamless car rental experiences in Delhi. At RentEase, we
                understand that convenience, reliability, and affordability are key factors when it comes to renting a
                car, and we're here to provide just that.
                <br>
                With a commitment to excellence and years of industry expertise, RentEase offers a wide range of
                vehicles to suit your every need. Whether you're a local resident in need of a short-term rental or a
                traveler exploring the vibrant streets of Delhi, our diverse fleet of well-maintained cars ensures that
                you'll find the perfect ride for your journey.
                <br>
                At RentEase, customer satisfaction is our top priority. Our dedicated team is here to assist you every
                step of the way, from selecting the right vehicle to providing personalized assistance throughout your
                rental period. With flexible booking options, transparent pricing, and exceptional service, we strive to
                make your car rental experience as smooth and enjoyable as possible.
            </p>
        </div>
        <div class="logo-img" style="max-width: 100%;">
            <img src="assets\imgs\logo.jpg" alt="RentEase Logo">
        </div>
    </div>
</section>


    <section id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Have questions? Contact us for more information.</p>
            <p>Address:<br>
                RentEase Car Rentals<br>
                [Your Street Address]<br>
                Delhi, India<br>
                <br>
                Phone: 9891XXXXXX
                <br>
                Email: rentacar@gmail.com
                <br>
                Business Hours:<br>
                Monday - Saturday: 9:00 AM to 6:00 PM<br>
                Sunday: Closed<br>

                Feel free to reach out to us via phone or email during our business hours.<br>

                We look forward to hearing from you and providing you with the best car rental experience in Delhi!
            </p>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; Car Rental System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
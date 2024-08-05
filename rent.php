<?php
session_start();
include "conn.php";
$_SESSION['caragency'] = $_REQUEST['id'];
$_SESSION['car'] = $_REQUEST['car'];

if (!isset($_SESSION['loginuser'])) {
    $_SESSION['rentdeny'] = "Access Denied: Login to rent";
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['type']) && $_SESSION['type'] == 'agency') {
    $_SESSION['error'] = "Access Denied: You do not have permission to access this page.";
    header("Location: index.php");
    exit();
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
    <style>
    /* Custom styling */
    body {
        background-color: #b8b7b7;
        
    }

    .card-img-top {
        height: 200px;
        /* Adjust the height as needed */
        object-fit: cover;
        /* Ensures the image covers the entire container */
    }
    </style>
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
                            <a class="nav-link" href="carlisting.php">Cars</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact Us</a>
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

    <section id="rentcar" class="m-3 p-2 text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-sty">
                    <h2 class="mb-4 text-center m-5 p-4">Book Car</h2>
                    <form action="process_booking.php" method="POST">
                        <!-- Form fields -->
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name:</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="mb-3" style="height: auto;">
                            <label for="contact" class="form-label">Contact Number:</label>
                            <input type="text" class="form-control" id="Contact" name="contact" required style="padding: 0.375rem 0.75rem; line-height: 1.5;">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Delivery Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="days" class="form-label">Number of Days:</label>
                            <input type="number" class="form-control" id="days" name="days" required>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>







    <footer>
        <p>&copy; Car Rental System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets\javascript\index.js"></script>
</body>

</html>
<?php
session_start();
include "conn.php";

if (isset($_SESSION['booked'])) {
    echo '<script>alert("' . $_SESSION['booked'] . '");</script>';
    unset($_SESSION['booked']);
}

if (isset($_SESSION['car_unavailaible'])) {
    echo '<script>alert("' . $_SESSION['car_unavailaible'] . '");</script>';
    unset($_SESSION['car_unavailaible']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets\css\style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
         body {
        background-color: #b8b7b7;
        
    }
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
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
                            <a class="nav-link" href="index.php#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#contact">Contact Us</a>
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
    <?php
    $sql = "SELECT * FROM car_details";
    $result = $link->query($sql);
    ?>

    <section id="cars">
    <div class="container">
        <div class="m-5" style="padding-top: 2.5rem;">
        <center><h1>AVAILABLE CARS</h1></center>
        </div>
        
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php 
                        $imageURL = 'uploads/'.$row["image"];
                        ?>
                    <img src="<?php echo $imageURL; ?>" class="card-img-top" alt="Car Image">
                        <div class="card-body" style="background-color: #e5e2e2;">
                            <h5 class="card-title"><?php echo $row['model']; ?></h5>
                            <p class="card-text">Vehicle Number: <?php echo $row['number']; ?></p>
                            <p class="card-text">Seating Capacity: <?php echo $row['seat_cap']; ?></p>
                            <p class="card-text">Rent per Day: <?php echo $row['rent']; ?></p>
                            <p class="card-text"  style="display:none;">Agency: <?php echo $row['agency']; ?></p>
                            <?php 
                            if (isset($_SESSION['loginuser'])) { ?>
                            <a href='rent.php?id=<?php echo $row['agency_id']; ?>&car=<?php echo $row['id']; ?>' class="btn btn-primary">Rent Now</a>
                            <?php } else if (isset($_SESSION['agencyuser'])){ ?>
                                <a href="#" class="btn btn-primary" onclick="return confirm('Agency cannot rent!Become a user first!');">Rent Now</a>
                            <?php }
                            else { ?>
                            <a href="userlogin.php" class="btn btn-primary" onclick="return confirm('Login to Rent!');"">Rent Now</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    </section>


    <footer class="footer">
        <p>&copy; Car Rental System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

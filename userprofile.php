<?php
session_start();
include "conn.php";

if (isset($_SESSION['type']) && $_SESSION['type'] == 'agency' || !isset($_SESSION['loginuser'])) {
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
        background-color: #b8b7b7 ;
        
    }
    .car-img img {
        width: 150px;
        height: auto;
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

    <section class=" p-2" id="bookings" style="margin-top:4rem;">
    <div>
            <center><h3>Your Bookings</h3></center>
        </div>
        <br>
        <div class="tablestyle table-responsive mx-auto">
            <table id="example" class="table table-striped table-bordered"
                style="width:80%; text-align:center; margin: 0 auto; background-color: #e5e2e2;">
                <thead>
                    <tr>
                        <td>Sno</td>
                        <td>Vehicle Model</td>
                        <td>Vehicle Number</td>
                        <td>Seating Capacity</td>
                        <td>Rent Per Day</td>
                        <td>Image</td>
                        <td>Agency</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                        <td>No of Days</td>
                        <!-- <td>Action</td> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
          $user = $_SESSION['loginuser'];
          $result = mysqli_query($link, "SELECT 
    cd.*,
    cb.*
FROM 
    car_details cd
JOIN 
    car_booking cb ON cd.id = cb.car_id
JOIN 
    signup s ON cb.customer_id = s.id
WHERE 
    s.username = '$user';")
            or die("FAILED!!");
          $count = 1;
          while ($rows = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td>
                            <?php echo $count; ?>
                        </td>
                        <td>
                            <?php echo $rows['model']; ?>
                        </td>
                        <td>
                            <?php echo $rows['number']; ?>
                        </td>
                        <td>
                            <?php echo $rows['seat_cap']; ?>
                        </td>
                        <td>
                            <?php echo $rows['rent']; ?>
                        </td>
                        <td class="car-img">
                            <?php 
                $imageURL = 'uploads/'.$rows["image"];
                // echo $rows['image']; ?>
                            <img src="<?php echo $imageURL; ?>" alt="" />
                        </td>
                        <td>
                            <?php echo $rows['agency']; ?>
                        </td>
                        <td>  <?php echo $rows['start_dt']; ?> 
                        </td>
                        <td>  <?php echo $rows['end_dt']; ?> 
                        </td>
                        <td>  <?php echo $rows['no_of_days']; ?> 
                        </td>
                        
                    </tr>
                    <?php
            $count++;
          }
          ?>
                </tbody>
            </table>
        </div>

        <div class="rent-button">
        <a href="carlisting.php" class="btn btn-primary" role="button">Rent New Car</a>
        </div>


    </section>





    <footer class="footer">
        <p>&copy; Car Rental System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
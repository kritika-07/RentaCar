<?php
session_start();

if (isset($_SESSION['type']) && $_SESSION['type'] == 'user' || !isset($_SESSION['agencyuser'])) {
    // Redirect to another page (e.g., index.php) and display alert
    $_SESSION['error'] = "Access Denied: You do not have permission to access this page.";
    header("Location: index.php");
    exit();
}


include "conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets\css\addcar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">RentEase- Rent a Car!</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cars</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addcar.php">Add Car</a>
                        </li>
                        <?php if (isset($_SESSION['agencyuser'])) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <?php if (isset($_SESSION['editid'])) { ?>
                            <h3>EDIT CAR <i class="fa fa-car"></i></h3>
                            <form class="requires-validation" novalidate method="POST" action="adddetails.php" enctype="multipart/form-data">

                                <div class="col-md-12" style="display:none;">
                                    <input class="form-control" type="text" name="carid" placeholder="ID" value="<?php echo isset($_SESSION['editid']) ? $_SESSION['editid'] : ''; ?>">
                                </div>

                                <div class="col-md-12">
                                    <input class="form-control" type="text" name="model" placeholder="Vehicle Model" value="<?php echo isset($_SESSION['model']) ? $_SESSION['model'] : ''; ?>">
                                </div>

                                <div class="col-md-12">
                                    <input class="form-control" type="text" name="number" placeholder="Vehicle Number" value="<?php echo isset($_SESSION['number']) ? $_SESSION['number'] : ''; ?>">
                                </div>

                                <div class="col-md-12">
                                    <input class="form-control" type="text" name="seat" placeholder="Seating Capacity" value="<?php echo isset($_SESSION['seat_cap']) ? $_SESSION['seat_cap'] : ''; ?>">
                                </div>

                                <div class="col-md-12" style="margin-bottom:1rem;">
                                    <input class="form-control" type="text" name="rent" placeholder="Rent per Day" value="<?php echo isset($_SESSION['rent']) ? $_SESSION['rent'] : ''; ?>">
                                    <!-- <div class="valid-feedback">Rent field is valid!</div>
                                 <div class="invalid-feedback">Rent field cannot be blank!</div> -->
                                </div>

                                <div class="col-md-12">
                                    <input class="form-control" type="text" id="carimg" enctype="multipart/form-data" placeholder="cannot edit image and model! Kindly delete to add new record!">
                                    <!-- <div class="valid-feedback">Image field is valid!</div>
                                 <div class="invalid-feedback">Image field cannot be blank!</div> -->
                                </div>

                                <div class="form-button mt-3">
                                    <button id="submit" type="submit" class="btn btn-primary" value="Upload">Edit</button>
                                    <button id="submit" type="reset" class="btn btn-primary">RESET</button>
                                    <a id="cancel" class="btn btn-primary" href="agencyaccount.php">CANCEL</a>
                                </div>
                            </form>
                        <?php 
                        unset($_SESSION['editid']);
                        unset($_SESSION['model']);
                        unset($_SESSION['number']);
                        unset($_SESSION['seat_cap']);
                        unset($_SESSION['rent']);
                    } else {
                             ?>
                            <h3>ADD CAR <i class="fa fa-car"></i></h3>

                            <form class="requires-validation" novalidate method="POST" action="adddetails.php" enctype="multipart/form-data">

                                <div class="col-md-12">
                                    <input class="form-control" type="text" name="model" placeholder="Vehicle Model">
                                    <!-- <div class="valid-feedback">Username field is valid!</div>
                               <div class="invalid-feedback">Username field cannot be blank!</div> -->
                                </div>

                                <div class="col-md-12">
                                    <input class="form-control" type="text" name="number" placeholder="Vehicle Number">
                                    <!-- <div class="valid-feedback">Vehicle Number is valid!</div>
                                 <div class="invalid-feedback">Vehicle Number is valid!</div> -->
                                </div>

                                <div class="col-md-12">
                                    <input class="form-control" type="text" name="seat" placeholder="Seating Capacity">
                                    <!-- <div class="valid-feedback">Seating Capacity</div>
                                 <div class="invalid-feedback">Seating Capacity</div> -->
                                </div>

                                <div class="col-md-12" style="margin-bottom:1rem;">
                                    <input class="form-control" type="text" name="rent" placeholder="Rent per Day">
                                    <!-- <div class="valid-feedback">Rent field is valid!</div>
                                 <div class="invalid-feedback">Rent field cannot be blank!</div> -->
                                </div>

                                <div class="col-md-12">
                                    <input class="form-control" type="file" name="carimg" id="carimg" enctype="multipart/form-data">
                                    <p style="font-size:12px;"> Valid Image types: jpg, png, jpeg, gif</p>
                                    <!-- <div class="valid-feedback">Image field is valid!</div>
                                 <div class="invalid-feedback">Image field cannot be blank!</div> -->
                                </div>

                                <div class="form-button mt-3">
                                    <button id="submit" type="submit" class="btn btn-primary" value="Upload">Add</button>
                                    <button id="submit" type="reset" class="btn btn-primary">RESET</button>
                                    <a id="cancel" class="btn btn-primary" href="agencyaccount.php">CANCEL</a>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <footer>
        <p>&copy; Car Rental System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets\javascript\addcar.js"></script>
</body>

</html>
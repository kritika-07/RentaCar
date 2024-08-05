<?php
session_start();
include "conn.php";

$fullname = $_POST['fullname'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$days = $_POST['days'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$agency = $_SESSION['caragency'];  
$username = $_SESSION['loginuser']; 
$car = $_SESSION['car'];            


$stmt = $link->prepare("SELECT id FROM signup WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($customerid);
$stmt->fetch();
$stmt->close();

if ($customerid) {
    // Check if the car is already booked for the given dates
    $stmt = $link->prepare("SELECT COUNT(*) FROM car_booking WHERE car_id = ? AND ((start_dt <= ? AND end_dt >= ?) OR (start_dt <= ? AND end_dt >= ?))");
    $stmt->bind_param("issss", $car, $start_date, $start_date, $end_date, $end_date);
    $stmt->execute();
    $stmt->bind_result($booking_count);
    $stmt->fetch();
    $stmt->close();

    if ($booking_count > 0) {
        $_SESSION['car_unavailaible'] = "The car is already booked for the selected dates.";
        header("Location: carlisting.php"); 
        exit();
    } else {
        $stmt = $link->prepare("INSERT INTO car_booking (fullname, username, contact, del_address, no_of_days, start_dt, end_dt, agency, car_id, customer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssissiii", $fullname, $username, $contact, $address, $days, $start_date, $end_date, $agency, $car, $customerid);

        if ($stmt->execute()) {
            $_SESSION['booked'] = "Thank you for Renting!!";
            unset($_SESSION['caragency']);
            unset($_SESSION['car']);
            header("Location: carlisting.php");
            exit();
        } else {
            echo "Error adding record: " . $stmt->error;
        }

        $stmt->close();
    }
} else {
    echo "Error: Customer ID not found.";
}

$link->close();
?>

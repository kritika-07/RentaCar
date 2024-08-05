<?php
session_start();
include "conn.php";

if (isset($_SESSION['type']) && $_SESSION['type'] == 'user') {
    $_SESSION['error'] = "Access Denied: You do not have permission to access this page.";
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pswd'];

    $check = "SELECT * FROM `agency_signup` WHERE `email`='$email'";
    $checkResult = $link->query($check);

    if ($checkResult->num_rows > 0) {
        // Verify hashed password
        $row = $checkResult->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['agencyuser'] = $row['username'];
            $_SESSION['type'] = 'agency';
            header("Location: agencyaccount.php");
            exit();
        } else {
            $_SESSION['ainvalid'] = "Invalid login credentials.";
            header("Location: agencylogin.php");
            exit();
        }
    } else {
        $_SESSION['ainvalid'] = "Invalid login credentials.";
        header("Location: agencylogin.php");
        exit();
    }
} else {
    echo "Error fetching records";
}
?>

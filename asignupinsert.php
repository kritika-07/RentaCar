<?php
session_start();
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['txt'];
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    $pswdconf = $_POST['confirmPswd'];

    if ($password  !== $pswdconf) {
        echo '<script>alert("Passwords do not match."); window.location.href="userlogin.php";</script>';
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check = "SELECT * FROM `agency_signup` WHERE `username`='$user_name' OR `email`='$email'";
    $checkResult = $link->query($check);

    if ($checkResult->num_rows > 0) {
        $_SESSION['agency_exists_alert'] = "Agency already exists.";
        header("Location: agencylogin.php");
        exit();
    } else {
        $sql = "INSERT INTO `agency_signup` (`username`, `email`, `password`) VALUES ('$user_name', '$email', '$hashed_password')";
        if ($link->query($sql) === TRUE) {
            $_SESSION['agencyregistered'] = "Agency registered. GO TO LOGIN";
            header("Location: agencylogin.php");
            exit();
        } else {
            echo "Error adding record: " . $link->error;
        }
    }
} else {
    echo "Error fetching records";
}
?>

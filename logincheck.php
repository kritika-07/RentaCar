<?php
session_start();
include "conn.php";

$email = $_POST['email'];
$password = $_POST['pswd'];

$check = "SELECT * FROM `signup` WHERE `email` = ?";
$stmt = $link->prepare($check);
$stmt->bind_param("s", $email);
$stmt->execute();
$checkResult = $stmt->get_result();

if ($checkResult->num_rows > 0) {
    $row = $checkResult->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['loginuser'] = $row['username'];
        echo $_SESSION['type'] = 'user';
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['invalid'] = "Invalid LOGIN.";
        header("Location: userlogin.php");
        exit();
    }
} else {
    $_SESSION['invalid'] = "Invalid LOGIN.";
    header("Location: userlogin.php");
    exit();
}

$stmt->close();
$link->close();
?>

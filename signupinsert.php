<?php
session_start();
ini_set('display_errors', 0);
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['txt'];
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
    $pswdconf = $_POST['confirmPswd'];

    if ($pswd  !== $pswdconf) {
        echo '<script>alert("Passwords do not match."); window.location.href="userlogin.php";</script>';
        exit();
    }

    $check = "SELECT * FROM `signup` WHERE `username` = ? OR `email` = ?";
    $stmt = $link->prepare($check);
    $stmt->bind_param("ss", $user_name, $email);
    $stmt->execute();
    $checkResult = $stmt->get_result();

    if ($checkResult->num_rows > 0) {
        $_SESSION['user_exists_alert'] = "User already exists.";
        header("Location: userlogin.php");
        exit();
    } else {
        $hashed_password = password_hash($pswd, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `signup` (`username`, `email`, `password`) VALUES (?, ?, ?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("sss", $user_name, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['userregistered'] = "User registered. GO TO LOGIN";
            header("Location: userlogin.php");
            exit();
        } else {
            echo "Error adding record: " . $stmt->error;
        }
    }

    $stmt->close();
} else {
    echo "Error fetching records";
}

$link->close();
?>

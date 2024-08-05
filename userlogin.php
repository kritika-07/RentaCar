<?php
session_start();
include "conn.php";

if (isset($_SESSION['type']) && $_SESSION['type'] == 'agency') {
    $_SESSION['error'] = "Access Denied: You do not have permission to access this page.";
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['user_exists_alert'])) {
    echo '<script>alert("' . $_SESSION['user_exists_alert'] . '");</script>';
    unset($_SESSION['user_exists_alert']);
}

if (isset($_SESSION['userregistered'])) {
    echo '<script>alert("' . $_SESSION['userregistered'] . '");</script>';
    unset($_SESSION['userregistered']);
}

if (isset($_SESSION['invalid'])) {
    echo '<script>alert("' . $_SESSION['invalid'] . '");</script>';
    unset($_SESSION['invalid']);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="assets\css\userlogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div style="margin-right: 15px; display: flex; flex-direction: row-reverse; ">
            <a href="index.php"> <img src="assets\imgs\homeicon.png" style=" padding: 1rem; height: 2.5rem;"> </a>
        </div>

        <div class="signup">
            <form id="signupForm" method="POST" action="signupinsert.php">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="txt" placeholder="Name" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" id="pswd" name="pswd" placeholder="Password" required="">
                <input type="password" id="confirmPswd" name="confirmPswd" placeholder="Confirm Password" required="">
                <button>Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="POST" action="logincheck.php">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="pswd" placeholder="Password" required="">
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
<script>
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            var password = document.getElementById('pswd').value;
            var confirmPassword = document.getElementById('confirmPswd').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                event.preventDefault(); 
            }
        });
    </script>
</html>

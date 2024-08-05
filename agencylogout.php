<?php
session_start();
include "conn.php";

if (isset($_SESSION['type']) && $_SESSION['type'] == 'user') {
    // Redirect to another page (e.g., index.php) and display alert
    $_SESSION['error'] = "Access Denied: You do not have permission to access this page.";
    header("Location: index.php");
    exit();
}

echo $_SESSION['agencyuser'];


unset($_SESSION['agencyuser']);
session_destroy();
header("Location: index.php");
exit();
?>
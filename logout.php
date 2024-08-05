<?php
session_start();
include "conn.php";

// echo $_SESSION['loginuser'];


unset($_SESSION['loginuser']);
unset($_SESSION['type']);
session_destroy();
header("Location: index.php");
exit();
?>
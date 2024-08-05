<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "123456";
$db_dbname = "car_rent";

$link = mysqli_connect($db_host, $db_user, $db_password, $db_dbname);

if (!$link) {
    die('Could not connect: ' . mysqli_connect_error());
}

// echo 'Connected successfully';
?>
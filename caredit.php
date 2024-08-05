<?php
session_start();
include "conn.php";

echo $id = $_REQUEST['id'];

$sql = "SELECT * FROM car_details WHERE id='$id'";
echo $sql;
$result = $link->query($sql);

$row = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['model'] = $row['model'];
    $_SESSION['number'] = $row['number'];
    $_SESSION['seat_cap'] = $row['seat_cap'];
    $_SESSION['rent'] = $row['rent'];
    $_SESSION['editid'] = $row['id'];
    header("Location:addcar.php");
    exit();
} else {
    echo "Record not found.";
}
?>
<?php session_start();
include "conn.php";

//echo "hello";

$id = $_REQUEST['id'];
// echo $id;
$sql = "DELETE FROM car_details where id='$id'";
$result = $link->query($sql);

if ($result === TRUE) {
    $_SESSION['car_delete_alert'] = "Record deleted successfully.";
} else {
    $_SESSION['car_delete_alert'] = "Error deleting record: ";
}

header("Location:agencyaccount.php");
exit();

?>
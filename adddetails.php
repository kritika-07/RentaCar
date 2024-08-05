<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    echo $id = $_POST['carid'] ?? null;
    $model = $_POST['model'] ?? '';
    $vehicle_number = $_POST['number'] ?? '';
    $seat = $_POST['seat'] ?? '';
    $rent = $_POST['rent'] ?? '';
    $agency = $_SESSION['agencyuser'] ?? '';

    $statusMsg = '';

    // Check if the agency user exists
    $agencyCheck = $link->prepare("SELECT id FROM agency_signup WHERE username = ?");
    $agencyCheck->bind_param("s", $agency);
    $agencyCheck->execute();
    $agencyCheck->store_result();

    if ($agencyCheck->num_rows > 0) {
        $agencyCheck->bind_result($agency_id);
        $agencyCheck->fetch();
    } else {
        $statusMsg = 'Agency user does not exist.';
        echo $statusMsg;
        header("Location: agencyaccount.php");
        exit();
    }
    $agencyCheck->close();

   
    // File upload directory
    $targetDir = "uploads/";
    if (empty($id)) {
        // Add new car
         // Check if the vehiclealready exists
    $vehicleCheck = $link->prepare("SELECT * FROM car_details WHERE number = ? AND model = ?");
    $vehicleCheck->bind_param("ss", $vehicle_number, $model);
    $vehicleCheck->execute();
    $vehicleCheck->store_result();

    if ($vehicleCheck->num_rows > 0) {
        $statusMsg = 'Vehicle number already exists.';
        echo $_SESSION['vehiclexists'] = $statusMsg;
        header("Location: agencyaccount.php");
        exit();
    }
    $vehicleCheck->close();

        if (!empty($_FILES["carimg"]["name"])) {
            $fileName = basename($_FILES["carimg"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["carimg"]["tmp_name"], $targetFilePath)) {
                    // Insert image file name into database
                    $insert = $link->prepare("INSERT INTO `car_details` (`model`, `number`, `seat_cap`, `rent`, `image`, `agency_id`) VALUES (?, ?, ?, ?, ?, ?)");
                    $insert->bind_param("ssiiss", $model, $vehicle_number, $seat, $rent, $fileName, $agency_id);

                    if ($insert->execute()) {
                        $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                    } else {
                        $statusMsg = "File upload failed, please try again.";
                    }
                    $insert->close();
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }

        // Display status message
        echo $statusMsg;
        header("Location: agencyaccount.php");
        exit();
    } else {
        // Edit existing car
        $updateSql = "UPDATE car_details SET `number`=?, `seat_cap`=?, `rent`=? WHERE `id`=?";
        $update = $link->prepare($updateSql);
        $update->bind_param("ssis", $vehicle_number, $seat, $rent, $id);

        if ($update->execute()) {
            echo "Record updated successfully.";
            header("Location: agencyaccount.php");
            exit;
        } else {
             echo "Error updating record: " . $update->error;
        }
        $update->close();
    }
} else {
    // Error: Form not submitted
    echo "Form not submitted.";
}

// Close the database connection
$link->close();
?>

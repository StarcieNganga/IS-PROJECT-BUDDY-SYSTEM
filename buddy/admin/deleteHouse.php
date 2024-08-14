<?php
include '../config.php';

$id = $_GET['id'];

$sql = "SELECT image FROM houses WHERE id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $house = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($house) {
        $imagePath = 'uploads/' . $house['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $sql = "DELETE FROM houses WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (mysqli_stmt_execute($stmt)) {
                echo "House deleted successfully!";
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
        }
    } else {
        echo "House not found.";
    }
} else {
    echo "ERROR: Could not prepare query.";
}
?>

<?php
include '../config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['booking_id'];

    // Delete the booking from the database
    $sql = "DELETE FROM bookings WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $booking_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "Booking deleted successfully.";
        } else {
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
    }

    // Redirect back to the referring page
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'bookings.php';
    header("Location: $referer");
    exit;
    exit;
}

mysqli_close($link);
?>

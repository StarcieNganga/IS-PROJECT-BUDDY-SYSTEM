<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $rent = $_POST['rent'];
    $vacancies = $_POST['vacancies'];

    // Handling file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $imageTempName = $_FILES['image']['tmp_name'];
        $imagePath = 'uploads/' . $image;

        if (move_uploaded_file($imageTempName, $imagePath)) {
            echo "Image uploaded successfully.<br>";
        } else {
            echo "Failed to move uploaded file.<br>";
        }
    } else {
        $image = null; // Or handle the missing image case
        echo "No image uploaded or an error occurred.<br>";
    }

    $sql = "INSERT INTO houses (name, category, location, contact, rent, vacancies, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssdss", $name, $category, $location, $contact, $rent, $vacancies, $image);
        if (mysqli_stmt_execute($stmt)) {
            echo "House added successfully!";
        } else {
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="add-house">
        <div class="admin-links">
            <a href="home.php">Home Page</a>
            <a href="viewHouse.php">View Houses</a>
            <a href="bookings.php">View Bookings</a>
        </div>
        <div class="add-form">
        <h1 style="margin-bottom: 20px;">Add Houses</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-col">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-col">
                <label>Category</label>
                <input type="text" name="category" required>
            </div>
            <div class="form-col">
                <label>Location</label>
                <input type="text" name="location" required>
            </div>
            <div class="form-col">
                <label>Contact</label>
                <input type="text" name="contact" required>
            </div>
            <div class="form-col">
                <label>Rent</label>
                <input type="number" name="rent" required>
            </div>
            <div class="form-col">
                <label>Vacancies</label>
                <input type="text" name="vacancies" required>
            </div>
            <div class="form-col">
                <label>Image</label>
                <input type="file" name="image" required>
            </div>
            <input type="submit" value="Add House">
        </form>
    </div>
    </div>
</body>
</html>


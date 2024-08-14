<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $rent = $_POST['rent'];
    $vacancies = $_POST['vacancies'];
    
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $imageTempName = $_FILES['image']['tmp_name'];
        $imagePath = 'uploads/' . $image;
        move_uploaded_file($imageTempName, $imagePath);
    } else {
        $image = $_POST['old_image'];
    }

    $sql = "UPDATE houses SET name = ?, category = ?, location = ?, contact = ?, rent = ?, vacancies = ?, image = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssdssi", $name, $category, $location, $contact, $rent, $vacancies, $image, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "House updated successfully!";
        } else {
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM houses WHERE id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $house = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    .container {
        max-width: 500px;
        margin: 40px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
    }

    .form-group input[type="text"], .form-group input[type="number"], .form-group input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
        background-color: #3e8e41;
    }

    .image-preview {
        margin-top: 20px;
    }

    .image-preview img {
        width: 100px;
        height: 100px;
        border-radius: 10px;
    }
</style>

<div class="container">
    <h2>Update House</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($house['id']); ?>">
        <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($house['image']); ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($house['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" name="category" value="<?php echo htmlspecialchars($house['category']); ?>" required>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" value="<?php echo htmlspecialchars($house['location']); ?>" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="text" name="contact" value="<?php echo htmlspecialchars($house['contact']); ?>" required>
        </div>
        <div class="form-group">
            <label for="rent">Rent:</label>
            <input type="number" name="rent" value="<?php echo htmlspecialchars($house['rent']); ?>" required>
        </div>
        <div class="form-group">
            <label for="vacancies">Vacancies:</label>
            <input type="number" name="vacancies" value="<?php echo htmlspecialchars($house['vacancies']); ?>" required>
        </div>
        <div class="form-group">
            <label for="image">Upload Image:</label>
            <input type="file" name="image">
            <div class="image-preview">
                <img src="uploads/<?php echo htmlspecialchars($house['image']); ?>" alt="House Image">
            </div>
        </div>
        <div class="form-group">
            <input type="submit" value="Update House">
        </div>
    </form>
</div>

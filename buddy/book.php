<?php
include 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $house_id = $_POST['house_id'];
    $your_name = $_POST['your_name'];
    $your_phone = $_POST['your_phone'];
    $roomate_name = $_POST['roomate_name'];
    $roomate_phone = $_POST['roomate_phone'];

    // Insert booking into database
    $sql = "INSERT INTO bookings (house_id, your_name, your_phone, roomate_name, roomate_phone) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "issss", $house_id, $your_name, $your_phone, $roomate_name, $roomate_phone);
        if (mysqli_stmt_execute($stmt)) {
            echo "Booking successful!";
        } else {
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
    }
}

if (isset($_GET['id'])) {
    $house_id = $_GET['id'];
    $sql = "SELECT * FROM houses WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $house_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($house = mysqli_fetch_assoc($result)) {
            mysqli_stmt_close($stmt);
        } else {
            echo "House not found.";
            exit;
        }
    } else {
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
        exit;
    }
} else {
    echo "Invalid house ID.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book House</title>
    <style>
        .book-form {
            margin: 5% auto;
            width: 50%;
            display: flex;
            flex-direction: column;
        }
        .form-col {
            display: grid;
        }
        .form-col input {
            padding: 10px;
            margin-bottom: 10px;
        }
        .book-form input[type=submit] {
            padding: 10px;
            margin-top: 10px;
            border: none;
            background: green;
            color: #fff;
            border-radius: 5px;
        }
    </style>
</head>
<body style="background-color:azure;">
    <div style="display:grid;">
        <a href="home.php"><img src="img/logo.png" alt="Smiley Face"  style="float:left;"></a>
    </div>
    <div class='book-form'>
        <h1>Book House: <?php echo htmlspecialchars($house['name']); ?></h1>
        <form method="post">
            <input type="hidden" name="house_id" value="<?php echo htmlspecialchars($house['id']); ?>">
            <div class="form-col">
                <label>Your Name</label>
                <input type="text" name="your_name" required>
            </div>

            <div class="form-col">
                <label>Your Phone no.</label>
                <input type="text" name="your_phone" required>
            </div>

            <div class="form-col">
                <label>Roomate's Name</label>
                <input type="text" name="roomate_name" required>
            </div>

            <div class="form-col">
                <label>Roomate's phone</label>
                <input type="text" name="roomate_phone" required>
            </div>

            <input type="submit" value="Book Now">
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($link);
?>

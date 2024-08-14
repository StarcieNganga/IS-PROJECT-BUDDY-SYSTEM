<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$role = isset($_SESSION["role"]) ? $_SESSION["role"] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>

    <link rel="stylesheet" href="css/style.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; border:none; margin: auto; padding:20px; text-align:center; width:95%; }
    </style>
</head>
<body style="background-color: azure;;">
    <a href="home.php"><img src="img/logo.png" alt="Smiley Face"  style="float:left;"></a>

    <?php
        if (isset($role) && $role == 1) {
            echo "<a href='../buddy/admin/addHouse.php'>Admin</a>";
            echo "<a href='logout.php' class='button' style='background-color:#081F5C;border: none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 16px; margin: 4px 2px; cursor: pointer; float: right;'>Sign Out of Your Account</a>";
            echo "<a href='profile.php' class='button' style=' background-color:#081F5C;border: none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 16px; margin: 4px 2px; cursor: pointer; float: right;'>My Profile</a>";
            echo "<a href='matches.php' class='button' style=' background-color: #081F5C;border: none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 16px; margin: 4px 2px; cursor: pointer; float: right;'>My Matches</a>";
        } else {
            echo "<a href='logout.php' class='button' style=' background-color: #081F5C;border: none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 16px; margin: 4px 2px; cursor: pointer; float: right;'>Sign Out of Your Account</a>";
            echo "<a href='profile.php' class='button' style=' background-color: #081F5C;border: none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 16px; margin: 4px 2px; cursor: pointer; float: right;'>My Profile</a>";
            echo "<a href='matches.php' class='button' style=' background-color: #081F5C;border: none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 16px; margin: 4px 2px; cursor: pointer; float: right;'>My Matches</a>";
        }
    ?>

    <br> <br><br> <br><br> <br><br> <br>
    <h1 style="color:black;" class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our verified community!!</h1>

    <h3 style="font-size: 24px; color:black;">To find a roomate, start by taking a match survey<br> Click the button below to get started</h3><br>

    <a href="survey.php" class="button" style=" background-color: #081F5C;border: none; color: white; padding: 15px 32px; text-align: center;text-decoration: none; display: inline-block;font-size: 16px; margin: 4px 0 90px 0; cursor: pointer;">Fill my survey!!</a>

    <h2>View Your Bookings</h2>
    <form method="post" action="">
        <label for="your_name">Enter Your Name to view your bookings:</label>
        <input type="text" id="your_name" name="your_name" required>
        <input type="submit" value="View Bookings">
    </form>

    <?php
    include 'config.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $your_name = $_POST['your_name'];

        $sql = "SELECT b.id, h.name AS house_name, h.category AS category, b.your_name, b.your_phone, b.roomate_name, b.roomate_phone, b.created_at 
        FROM bookings b
        JOIN houses h ON b.house_id = h.id
        WHERE b.your_name = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $your_name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>House Name</th>";
                echo "<th>Category</th>";
                echo "<th>Your Name</th>";
                echo "<th>Your Phone</th>";
                echo "<th>Roomate Name</th>";
                echo "<th>Roomate Phone</th>";
                echo "<th>Booking Date</th>";
                echo "<th>Actions</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['house_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['your_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['your_phone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['roomate_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['roomate_phone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                    echo "<td>";
                    echo "<form method='post' action='./admin/delete_booking.php' style='display:inline;'>";
                    echo "<input type='hidden' name='booking_id' value='" . htmlspecialchars($row['id']) . "'>";
                    echo "<input type='submit' value='Delete' onclick='return confirm(\"Are you sure you want to delete this booking?\");'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }

                echo "</table>";
                mysqli_free_result($result);
            } else {
                echo "No bookings found for the specified user.";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
        }
    }

    mysqli_close($link);
    ?>

    <br><br> 
    

    <footer>
        <div class="footer_credit">
            <div class="footer_inner_credit">
            <p>BUDDY WEB APPLICATION</p>
        <div class="contacts">
            <p>Contact Us:</p>
            <p>Phone: <a href="tel:+254704949417">+254704949417</a></p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

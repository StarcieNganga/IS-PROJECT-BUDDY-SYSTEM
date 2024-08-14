<?php
include 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT * FROM houses";
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>House Listings</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .house-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            width: calc(33% - 40px);
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .house-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .house-card h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .house-card p {
            margin: 5px 0;
        }
        .house-card .actions {
            margin-top: 10px;
        }
        .house-card .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #fff;
        }
        .house-card img{
            height: 200px;
            width: 400px;
        }
        .house-card button {
            background:#081F5C;
            padding: 10px;
            border-radius: 5px;
            border: none;
        }
    </style>
</head>
<body style="background-color:azure;">
    <div style="display:grid;">
        <a href="home.php"><img src="img/logo.png" alt="Smiley Face"  style="float:left;"></a>
        <h1>House Listings</h1>
    </div>
    <div class="container">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='house-card'>";
                echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                echo "<img src='admin/uploads/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
                echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
                echo "<p><strong>Contact:</strong> " . htmlspecialchars($row['contact']) . "</p>";
                echo "<p><strong>Rent:</strong> Kes. " . htmlspecialchars($row['rent']) . "</p>";
                echo "<p><strong>Vacancies:</strong> " . htmlspecialchars($row['vacancies']) . "</p>";
                echo "<div class='actions'>
                        <button><a href='book.php?id=" . htmlspecialchars($row['id']) . "'>Book Now</a></button>
                      </div>";
                echo "</div>";
            }
        } else {
            echo "<p>No houses found</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
mysqli_close($link);
?>

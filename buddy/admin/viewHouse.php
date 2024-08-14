<?php
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Houses</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        /* Additional styling for buttons and layout */
        .admin-links {
            position: absolute;
            left: 10px;
            top: 10px;
        }
        .admin-links a {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            background-color:whitesmoke;
            color: black;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .admin-links a:hover {
            opacity: 0.8;
        }
        .action.edit{
            margin:2px;
            padding:5px 10px;
            background-color:green;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }
        .action.delete{
            margin:2px;
            padding:5px 10px;
            background-color: red;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }
        .actions button {
            margin: 2px;
            padding: 5px 10px;
            background-color: #081F5C;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .actions button:hover {
            opacity: 0.8;
        }
        /* Remove background color from other sections */
        .view-houses {
            background-color: azure;
        }
        table.house-table {
            background-color: transparent;
            color: black;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        
        th {
            background-color: #f0f0f0;
        }
        
        tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        
        .actions {
            text-align: center;
        }
        h1 {
            color: black;
        }
    </style>
</head>
<body>
    <div class="view-houses">
        <div class="admin-links">
            <a href="addHouse.php">Add House</a>
            <a href="bookings.php">View Bookings</a>
        </div>

        <div style="margin-left: 200px;">
            <h1 style="margin-bottom: 20px;">List of Houses</h1>

            <?php
            $sql = "SELECT * FROM houses";
            if ($result = mysqli_query($link, $sql)) {
                echo '<table class="house-table" border="1" style="margin:5% auto; width:90%; border-collapse: collapse;">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Contact</th>
                        <th>Rent</th>
                        <th>Vacancies</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>';
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>
                        <td>' . htmlspecialchars($row['id']) . '</td>
                        <td>' . htmlspecialchars($row['name']) . '</td>
                        <td>' . htmlspecialchars($row['category']) . '</td>
                        <td>' . htmlspecialchars($row['location']) . '</td>
                        <td>' . htmlspecialchars($row['contact']) . '</td>
                        <td>' . htmlspecialchars($row['rent']) . '</td>
                        <td>' . htmlspecialchars($row['vacancies']) . '</td>
                        <td><img src="uploads/' . htmlspecialchars($row['image']) . '" width="100"></td>
                        <td class="actions">
                            <a href="editHouse.php?id=' . htmlspecialchars($row['id']) . '">
                                <button class="edit">Edit</button>
                            </a>
                            <a href="deleteHouse.php?id=' . htmlspecialchars($row['id']) . '" onclick="return confirm(\'Are you sure?\');">
                                <button class="delete">Delete</button>
                            </a>
                        </td>
                    </tr>';
                }
                echo '</table>';
                mysqli_free_result($result);

            }  else 'echo {error($link) . "</p>";'
            
            ?>
        </div>
                echo "<p style='color: red;'>ERROR: Could not execute query: $sql. " . mysqli_</p>
    </div>
</body>
</html>

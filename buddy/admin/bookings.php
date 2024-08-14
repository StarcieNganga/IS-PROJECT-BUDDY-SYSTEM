<?php
include '../config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT b.id, h.name AS house_name, b.your_name, b.your_phone, b.roomate_name, b.roomate_phone, b.created_at 
        FROM bookings b
        JOIN houses h ON b.house_id = h.id";

if ($result = mysqli_query($link, $sql)) {
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:azure;
        }
        
        h1 {
            color: #333;
            margin-bottom: 20px;
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
        
        .delete-button {
            background-color:#081F5C;
            color: #fff;
            border: none;
            padding: 5px 10px;
            font-size: 12px;
            cursor: pointer;
        }
        
        .delete-button:hover {
            background-color: #cc0000;
        }
    </style>
    
    <a href='addHouse.php'>Add House</a><br>
    <a href='viewHouse.php'>View Houses</a><br>
    <h1>Bookings</h1>
    
    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
            <tr>
                <th>ID</th>
                <th>House Name</th>
                <th>Your Name</th>
                <th>Your Phone</th>
                <th>Roomate Name</th>
                <th>Roomate Phone</th>
                <th>Booking Date</th>
                <th>Actions</th>
            </tr>
            
            <?php while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['house_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['your_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['your_phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['roomate_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['roomate_phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td class="actions">
                        <form method='post' action='delete_booking.php' style='display:inline;'>
                            <input type='hidden' name='booking_id' value='<?php echo htmlspecialchars($row['id']); ?>'>
                            <input type='submit' class='delete-button' value='Delete' onclick='return confirm("Are you sure you want to delete this booking?");'>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
        
        <?php mysqli_free_result($result); ?>
    <?php } else { ?>
        <p>No bookings found.</p>
    <?php } ?>
    
    <?php } else { ?>
        <p>ERROR: Could not execute query: <?php echo $sql; ?>. <?php echo mysqli_error($link); ?></p>
    <?php } ?>
    
    <?php mysqli_close($link); ?>
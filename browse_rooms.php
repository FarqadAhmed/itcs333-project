<?php
require 'connection.php';

$sql = "SELECT * FROM rooms";
$statement = $db->prepare($sql);
$statement->execute();
$rooms = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Rooms</title>
</head>
<body>
    <h1>Available Rooms</h1>
    <ul>
        <?php foreach ($rooms as $room): ?>
            <li>
                <h2><?php echo $room['departmentName']; ?></h2>
                <p>Capacity: <?php echo $room['capacity']; ?></p>
                <p>Equipment: <?php echo $room['Equipment'] ? $room['Equipment'] : 'None'; ?></p>
                <a href="room_details.php?id=<?php echo $room['RoomID']; ?>">View Details</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
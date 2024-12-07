<?php
require 'connection.php';

if (!isset($_GET['id'])) {
    die("Room ID is not provided.");
}

$room_id = $_GET['id'];

$sql = "SELECT * FROM rooms WHERE RoomID = ?";
$statement = $db->prepare($sql);
$statement->execute([$room_id]);
$room = $statement->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM timeslots WHERE RoomID = ? AND Is_Available = TRUE";
$statement = $db->prepare($sql);
$statement->execute([$room_id]);
$timeslots = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
</head>
<body>
    <h1><?= $room['departmentName']; ?></h1>
    <h4><p><strong>Room Number:</strong><?= $room['RoomID']; ?></p><p><strong>Room Type:</strong><?= $room['RoomType']; ?></p></h4>
    <p><strong>Capacity:</strong><?php echo $room['capacity']; ?></p>
    <p><strong>Equipment:</strong><?php echo $room['Equipment'] ? $room['Equipment'] : 'None'; ?></p>

    <h2>Available Timeslots</h2>
    <?php if ($timeslots): ?>
        <ul>
            <?php foreach ($timeslots as $timeslot): ?>
                
                <li><?=$timeslot ['TimeslotID']; ?> - <?= $timeslot['StartTime']; ?> - <?php echo $timeslot['EndTime']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No available timeslots.</p>
    <?php endif; ?>

    <a href="browse_rooms.php">Back to Room List</a>
</body>
</html>
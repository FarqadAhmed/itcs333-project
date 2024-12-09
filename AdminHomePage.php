<?php
require 'connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

    // Handle actions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_room'])) {
            $departmentName = $_POST['departmentName'];
            $FloorNum = $_POST['FloorNum'];
            $RoomType = $_POST['RoomType'];
            $capacity = $_POST['capacity'];

            $query = "INSERT INTO Rooms (departmentName, FloorNum, RoomType, capacity)
                      VALUES (:departmentName, :FloorNum, :RoomType, :capacity)";

            $stmt = $db->prepare($query);
            $stmt->execute([
                ':departmentName' => $departmentName,
                ':FloorNum' => $FloorNum,
                ':RoomType' => $RoomType,
                ':capacity' => $capacity
            ]);
        } elseif (isset($_POST['edit_room'])) {
            $RoomID = $_POST['RoomID'];
            $departmentName = $_POST['departmentName'];
            $FloorNum = $_POST['FloorNum'];
            $RoomType = $_POST['RoomType'];
            $capacity = $_POST['capacity'];

            $query = "UPDATE Rooms SET departmentName = :departmentName, FloorNum = :FloorNum, 
                      RoomType = :RoomType, capacity = :capacity WHERE RoomID = :RoomID";
            $stmt = $db->prepare($query);
            $stmt->execute([
                ':departmentName' => $departmentName,
                ':FloorNum' => $FloorNum,
                ':RoomType' => $RoomType,
                ':capacity' => $capacity,
                ':RoomID' => $RoomID
            ]);
        } elseif (isset($_POST['delete_room'])) {
            $RoomID = $_POST['RoomID'];
            $query = "DELETE FROM Rooms WHERE RoomID = :RoomID";
            $stmt = $db->prepare($query);
            $stmt->execute([':RoomID' => $RoomID]);
        }
    }

    // Fetch rooms
    $query = "SELECT * FROM Rooms";
    $stmt = $db->query($query);
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="media.css">
    <title>Room Management</title>
</head>
<body>
    <h1>Room Management</h1>
    <form method="POST">
        <input type="text" name="departmentName" placeholder="Department Name" required>
        <input type="text" name="FloorNum" placeholder="Floor Number" required>
        <input type="text" name="RoomType" placeholder="Room Type" required>
        <input type="number" name="capacity" placeholder="Capacity" required>
        <button type="submit" name="add_room">Add Room</button>
    </form>
    <table border="1">
        <tr>
            <th>RoomID</th>
            <th>Department</th>
            <th>Floor</th>
            <th>Type</th>
            <th>Capacity</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?php echo $room['RoomID']; ?></td>
            <td><?php echo $room['departmentName']; ?></td>
            <td><?php echo $room['FloorNum']; ?></td>
            <td><?php echo $room['RoomType']; ?></td>
            <td><?php echo $room['capacity']; ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="RoomID" value="<?php echo $room['RoomID']; ?>">
                    <button type="submit" name="delete_room">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

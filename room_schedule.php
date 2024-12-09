<?php
// schedule_management.php

// Start session and include database connection
require 'connection.php';
// Start session to verify if admin is logged in
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    // Redirect to login page if not logged in
    header("Location: AdminHomePage.php");
    exit();}

 // Handle add, edit, delete actions
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_schedule'])) {
        $RoomID = $_POST['RoomID'];
        $scheduleDate = $_POST['schedule_date'];
        $startTime = $_POST['start_time'];
        $endTime = $_POST['end_time'];

        $query = "INSERT INTO Schedules (RoomID, schedule_date, start_time, end_time)
                  VALUES (:RoomID, :schedule_date, :start_time, :end_time)";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':RoomID' => $RoomID,
            ':schedule_date' => $scheduleDate,
            ':start_time' => $startTime,
            ':end_time' => $endTime
        ]);
    } elseif (isset($_POST['edit_schedule'])) {
        $ScheduleID = $_POST['ScheduleID'];
        $RoomID = $_POST['RoomID'];
        $scheduleDate = $_POST['schedule_date'];
        $startTime = $_POST['start_time'];
        $endTime = $_POST['end_time'];

        $query = "UPDATE Schedules SET RoomID = :RoomID, schedule_date = :schedule_date, 
                  start_time = :start_time, end_time = :end_time WHERE ScheduleID = :ScheduleID";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':RoomID' => $RoomID,
            ':schedule_date' => $scheduleDate,
            ':start_time' => $startTime,
            ':end_time' => $endTime,
            ':ScheduleID' => $ScheduleID
        ]);
    } elseif (isset($_POST['delete_schedule'])) {
        $ScheduleID = $_POST['ScheduleID'];

        $query = "DELETE FROM Schedules WHERE ScheduleID = :ScheduleID";
        $stmt = $db->prepare($query);
        $stmt->execute([':ScheduleID' => $ScheduleID]);
    }
}

// Fetch all rooms
$roomsQuery = "SELECT * FROM Rooms";
$roomsStmt = $db->query($roomsQuery);
$rooms = $roomsStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all schedules
$schedulesQuery = "SELECT Schedules.*, Rooms.departmentName, Rooms.FloorNum, Rooms.RoomType 
                   FROM Schedules
                   JOIN Rooms ON Schedules.RoomID = Rooms.RoomID";
$schedulesStmt = $db->query($schedulesQuery);
$schedules = $schedulesStmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="media.css">

<title>Schedule Management</title>
</head>
<body>
<h1>Schedule Management</h1>
<form method="POST">
    <select name="RoomID" required>
        <option value="">Select Room</option>
        <?php foreach ($rooms as $room): ?>
            <option value="<?php echo $room['RoomID']; ?>">
                <?php echo $room['departmentName'] . " - " . $room['RoomType'] . " (Floor: " . $room['FloorNum'] . ")"; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="date" name="schedule_date" required>
    <input type="time" name="start_time" required>
    <input type="time" name="end_time" required>
    <button type="submit" name="add_schedule">Add Schedule</button>
</form>
<table border="1">
    <tr>
 <th>Schedule ID</th>
        <th>Room</th>
    </tr>
       
      
        </table>
        </body>
        </html>

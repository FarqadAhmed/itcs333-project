<?php

require 'connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
   
?>

<!DOCTYPE html>
<html>
    <head>
<html lang="en">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="media.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin</h1>
    <a href="room_management.php">Manage Rooms</a><br>
    <a href="schedule_management.php">Manage Schedules</a><br>
    <a href="logout.php">Logout</a>
</body>
</html>

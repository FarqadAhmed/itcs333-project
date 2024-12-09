<?php
require 'connection.php';

if (isset($_GET['RoomID']) && isset($_GET['TimeslotID']) && isset($_GET['BookingDate']) && isset($_GET['Email'])) {
    $roomID = $_GET['RoomID'];
    $timeslotID = $_GET['TimeslotID'];
    $bookingDate = $_GET['BookingDate'];
    $email = $_GET['Email'];

    echo "<h1>Reservation Details</h1>";
    echo "<p><strong>Room ID:</strong> $roomID</p>";
    echo "<p><strong>Timeslot ID:</strong> $timeslotID</p>";
    echo "<p><strong>Booking Date:</strong> $bookingDate</p>";
    echo "<p><strong>Email:</strong> $email</p>";
} else {
    echo "Reservation details are missing.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 10px;
        }

        h1 {
            color: black;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #696969;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <p><a href="book.php">Back to Booking</a></p>
    <p><a href="cancel.php">Go to Cancel</a></p>
</body>
</html>
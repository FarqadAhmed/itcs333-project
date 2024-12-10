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
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0; 
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333; 
    margin-bottom: 20px; 
}

form {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 400px; 
    margin: 0 auto; 
}

label {
    display: block;
    margin: 10px 0 5px; 
    font-weight: bold;
}

input[type="number"] {
    width: 100%; 
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc; 
    border-radius: 4px; 
    box-sizing: border-box; 
}

button {
    background-color:#696969; 
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s; 
    width: 100%;
}

button:hover {
    background-color: #c82333; 
}

p {
    text-align: center; 
    margin-top: 20px; 
}

a {
    text-decoration: none; 
    color: #696969; 
}

a:hover {
    text-decoration: underline; 
}
       
    </style>
    <link rel="stylesheet" href="media.css">
</head>
<body>
    <p><a href="browse_rooms.php"> OK </a></p>
    <p><a href="cancel.php"> To Cancel Booking, Click Here .</a></p>
</body>
</html>

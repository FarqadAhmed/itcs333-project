<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookingID = $_POST['BookingID'];

    // Fetch booking details
    $stmt = $db->prepare("
        SELECT RoomID, TimeslotID, BookingDate FROM bookings WHERE BookingID = ?");
    $stmt->execute([$bookingID]);
    $bookingDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($bookingDetails) {
        // Booking exists, proceed to delete
        $stmt = $db->prepare("
            DELETE FROM bookings WHERE BookingID = ?");
        $stmt->execute([$bookingID]);

        // Check if the deletion was successful
        if ($stmt->rowCount() > 0) {
            echo "Booking with ID $bookingID has been successfully canceled.";
        } else {
            echo "An error occurred while canceling the booking.";
        }
    } else {
        echo "No booking found with that ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <link rel="stylesheet" href="media.css">
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
</head>
<body>
    <h1>Cancel Booking</h1>
    <form action="cancel.php" method="POST">
        <label for="BookingID">Booking ID:</label>
        <input type="number" name="BookingID" required>
        <button type="submit">Cancel Booking</button>
    </form>

    <p><a href="book.php">Back to Booking</a></p>
</body>
</html>

<?php
require 'booking.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookingID = $_POST['BookingID'];

    
    $stmt = $db->prepare("
        SELECT RoomID, TimeslotID, BookingDate FROM bookings WHERE BookingID = ?");
    $stmt->execute([$bookingID]);
    $bookingDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if ($bookingDetails) {
        $roomID = $bookingDetails['RoomID'];
        $timeslotID = $bookingDetails['TimeslotID'];
        $bookingDate = $bookingDetails['BookingDate'];

        
        $stmt = $db->prepare("
            SELECT COUNT(*) FROM bookings
            WHERE RoomID = ? AND TimeslotID = ? AND BookingDate = ?");
        $stmt->execute([$roomID, $timeslotID, $bookingDate]);
        $conflictCount = $stmt->fetchColumn();
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

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

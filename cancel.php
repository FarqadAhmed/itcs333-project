<?php
require 'booking.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookingID = $_POST['BookingID'];

    $stmt = $pdo->prepare("DELETE FROM bookings WHERE BookingID = ?");
    $stmt->execute([$bookingID]);
    echo "Booking cancelled!";
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
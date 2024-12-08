<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookingID = $_POST['BookingID'];

    // Delete booking
    $stmt = $pdo->prepare("DELETE FROM bookings WHERE BookingID = ?");
    $stmt->execute([$bookingID]);
    echo "Booking cancelled!";
}
?>

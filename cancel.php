<?php
require 'connection.php';
require 'booking.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookingID = $_POST['BookingID'];

    
    $stmt = $pdo->prepare("DELETE FROM bookings WHERE BookingID = ?");
    $stmt->execute([$bookingID]);
    echo "Booking cancelled!";
}
?>

<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roomID = $_POST['RoomID'];
    $timeslotID = $_POST['TimeslotID'];
    $bookingDate = $_POST['BookingDate'];
    $email = $_POST['Email'];

    // Check for conflicts
    $stmt = $pdo->prepare("
        SELECT COUNT(*) FROM bookings 
        WHERE RoomID = ? AND TimeslotID = ? AND BookingDate = ?");
    $stmt->execute([$roomID, $timeslotID, $bookingDate]);
    $conflictCount = $stmt->fetchColumn();

    if ($conflictCount > 0) {
        echo "This timeslot is already booked.";
    } else {
        // Insert booking
        $stmt = $pdo->prepare("
            INSERT INTO bookings (RoomID, TimeslotID, BookingDate, Email) 
            VALUES (?, ?, ?, ?)");
        $stmt->execute([$roomID, $timeslotID, $bookingDate, $email]);
        echo "Booking successful!";
    }
}
?>
<?php
require 'connection 1.php';
if (isset($_POST['email'])) {
    $email = $_POST['email'];  // Retrieve the email passed via URL
} else {
    // Handle case where email is not provided (e.g., redirect or show error)
    echo "Error: Email not provided.";
    exit;
}

// Upcoming Bookings Query: Fetch bookings where booking_date is today or in the future
$query_upcoming = "SELECT * FROM bookings WHERE email = '$email' AND BookingDate >= CURDATE()";
$result_upcoming = $db->query($query_upcoming);
$upcomingBookings = [];
if ($result_upcoming->num_rows > 0) {
    while ($row = $result_upcoming->fetch_assoc()) {
        $upcomingBookings[] = $row;
    }
}

// Past Bookings Query: Fetch bookings where booking_date is before today
$query_past = "SELECT * FROM bookings WHERE email = '$email' AND BookingDate < CURDATE()";
$result_past = $db->query($query_past);
$pastBookings = [];
if ($result_past->num_rows > 0) {
    while ($row = $result_past->fetch_assoc()) {
        $pastBookings[] = $row;
    }
}
?>
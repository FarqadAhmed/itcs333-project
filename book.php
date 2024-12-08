<?php
require 'booking.php'; // Include the database connections
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roomID = $_POST['RoomID'];
    $timeslotID = $_POST['TimeslotID'];
    $bookingDate = $_POST['BookingDate'];
    $email = $_POST['Email'];
 
    // Check for conflicts
    $stmt = $db->prepare("
        SELECT COUNT(*) FROM bookings
        WHERE RoomID = ? AND TimeslotID = ? AND BookingDate = ?");
    $stmt->execute([$roomID, $timeslotID, $bookingDate]);
    $conflictCount = $stmt->fetchColumn();
 
    if ($conflictCount > 0) {
        echo "This timeslot is already booked.";
    } else {
        // Insert booking
        $stmt = $db->prepare("
            INSERT INTO bookings (RoomID, TimeslotID, BookingDate, Email)
            VALUES (?, ?, ?, ?)");
     
    }  $stmt->execute([$roomID, $timeslotID, $bookingDate, $email]);
        echo "Booking successful!";

}



  
$roomsStmt = $db->query("SELECT RoomID FROM room");
$rooms = $roomsStmt->fetchAll(PDO::FETCH_ASSOC);


$timeslotsStmt = $db->query("SELECT TimeslotID FROM timeslots WHERE is_available = 1");
$timeslots = $timeslotsStmt->fetchAll(PDO::FETCH_ASSOC);


 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
</head>
<body>
    <h1>Room Booking System</h1>
    <form action="" method="POST">
        <label for="RoomID">Room:</label>
        <select name="RoomID" required>
            <option >Select a room</option>
            <?php
            if (count($rooms) > 0):
                foreach ($rooms as $row): ?>
                    <option value="<?php echo $row['RoomID']; ?>" <?php echo (isset($roomID) && $roomID == $row['RoomID']) ? 'selected' : ''; ?>>
                        <?php echo $row['RoomID']; ?>
                    </option>
                <?php endforeach;
            else: ?>
                <option disabled>No rooms available</option>
            <?php endif; ?>
        </select>
 
        <label for="TimeslotID">Timeslot:</label>
        <select name="TimeslotID" required>
            <option value="">Select a timeslot</option>
            <?php if ($timeslots->num_rows > 0): ?>
                <?php while ($row = $timeslots->fetch_assoc()): ?>
                    <option value="<?php echo $row['TimeslotID']; ?>"></option>
                <?php endwhile; ?>
            <?php endif; ?>
        </select>
 
        <label for="BookingDate">Booking Date:</label>
        <input type="date" name="BookingDate" required>
 
        <label for="Email">Email:</label>
        <input type="email" name="Email" required>
 
        <button type="submit">Book Room</button>
    </form>
 
 
   
 
   
</body>
</html>
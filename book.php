<?php
require 'booking.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roomID = $_POST['RoomID'];
    $timeslotID = $_POST['TimeslotID'];
    $bookingDate = $_POST['BookingDate'];
    $email = $_POST['Email'];

    
    $stmt = $pdo->prepare("
        SELECT COUNT(*) FROM bookings 
        WHERE RoomID = ? AND TimeslotID = ? AND BookingDate = ?");
    $stmt->execute([$roomID, $timeslotID, $bookingDate]);
    $conflictCount = $stmt->fetchColumn();

    if ($conflictCount > 0) {
        echo "This timeslot is already booked.";
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO bookings (RoomID, TimeslotID, BookingDate, Email) 
            VALUES (?, ?, ?, ?)");
        $stmt->execute([$roomID, $timeslotID, $bookingDate, $email]);
        echo "Booking successful! <a href='cancel.php'>Cancel Booking</a>";
    }
}



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
    <form action="book.php" method="POST">
        <label for="RoomID">Room:</label>
        <select name="RoomID" required>
            <option value="">Select a room</option>
            <?php foreach ($rooms as $row): ?>
                <option value="<?php echo $row['RoomID']; ?>"><?php echo $row['RoomID']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="TimeslotID">Timeslot:</label>
        <select name="TimeslotID" required>
            <option value="">Select a timeslot</option>
            <?php foreach ($timeslots as $row): ?>
                <option value="<?php echo $row['TimeslotID']; ?>"><?php echo $row['TimeslotID']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="BookingDate">Booking Date:</label>
        <input type="date" name="BookingDate" required>

        <label for="Email">Email:</label>
        <input type="email" name="Email" required>


    <button type="submit">Book Room</button>
    </form>

    <p><a href="cancel.php">Cancel a Booking</a></p>
</body>
</html>

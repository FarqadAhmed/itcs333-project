
<?php
require 'connection.php'; 



try {
    $roomStmt = $db1->query("SELECT RoomID, FROM Room");
    $room = $roomStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("ERROR fetching rooms: " . $ex->getMessage());
}


try {
    $timeslotsStmt = $db2->query("SELECT TimeslotID,  FROM timeslots WHERE is_available = 1");
    $timeslots = $timeslotsStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("ERROR fetching timeslots: " . $ex->getMessage());
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
            <?php if ($rooms->num_rows > 0): ?>
                <?php while ($row = $room->fetch_assoc()): ?>
                    <option value="<?php echo $row['RoomID']; ?>"></option>
                <?php endwhile; ?>
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

    <h2>Cancel Booking</h2>
    <form action="cancel.php" method="POST">
        <label for="BookingID">Booking ID:</label>
        <input type="number" name="BookingID" required>
        <button type="submit">Cancel Booking</button>
    </form>

   
</body>
</html>

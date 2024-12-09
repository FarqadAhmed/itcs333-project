<?php
require 'connection.php';
if (isset($_GET['RoomID'])) {
    $roomID = $_GET['RoomID'];
    $stmt = $db->prepare("SELECT TimeslotID FROM timeslots  WHERE RoomID = ? AND is_available = 1");
    $stmt->execute([$roomID]);
    $timeslots = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($timeslots);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roomID = $_POST['RoomID'];
    $timeslotID = $_POST['TimeslotID'];
    $bookingDate = $_POST['BookingDate'];
    $email = $_POST['Email'];
 
  
    $stmt = $db->prepare("
        SELECT COUNT(*) FROM bookings
        WHERE RoomID = ? AND TimeslotID = ? AND BookingDate = ?");
    $stmt->execute([$roomID, $timeslotID, $bookingDate]);
    $conflictCount = $stmt->fetchColumn();
 
    if ($conflictCount > 0) {
        echo "This timeslot is already booked.";
    } else {
        
        $stmt = $db->prepare("
            INSERT INTO bookings (RoomID, TimeslotID, BookingDate, Email)
            VALUES (?, ?, ?, ?)");
     
    }  $stmt->execute([$roomID, $timeslotID, $bookingDate, $email]);
        echo "Booking successful!";

}
$roomsStmt = $db->query("SELECT RoomID FROM room");
$room = $roomsStmt->fetchAll(PDO::FETCH_ASSOC);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
    <script>
        function fetchTimeslots() {
            const roomID = document.querySelector('select[name="RoomID"]').value;
            const timeslotSelect = document.querySelector('select[name="TimeslotID"]');
            timeslotSelect.innerHTML = '<option value="">Select a timeslot</option>';
            
            if (roomID) {
                fetch(`?RoomID=${roomID}`)
                    .then(response => response.json())
                    .then(timeslots => {
                        if (timeslots.length > 0) {
                            timeslots.forEach(timeslot => {
                                const option = document.createElement('option');
                                option.value = timeslot.TimeslotID;
                                option.textContent = `Timeslot ${timeslot.TimeslotID}`;
                                timeslotSelect.appendChild(option);
                            });
                        } else {
                            const option = document.createElement('option');
                            option.disabled = true;
                            option.textContent = 'No timeslots available';
                            timeslotSelect.appendChild(option);
                        }
                    })
                    .catch(error => console.error('Error fetching timeslots:', error));
            }
        }
    </script>
</head>
<body>
    <h1>Room Booking System</h1>
    <form action="" method="POST">
        <label for="RoomID">Room:</label>
        <select name="RoomID" onchange="fetchTimeslots()" required>
            <option value="" >Select a room</option>
            <?php
                foreach ($room as $row): ?>
                    <option value="<?php echo $row['RoomID']; ?>">
                        <?php echo $row['RoomID']; ?>
                    </option>
                <?php endforeach; ?>
        </select>
 
        <label for="TimeslotID">Timeslot:</label>
    <select name="TimeslotID" required>
        <option value="">Select a timeslot</option>
        </select>
 
        <label for="BookingDate">Booking Date:</label>
        <input type="date" name="BookingDate" required>
 
        <label for="Email">Email:</label>
        <input type="email" name="Email" required>
 
        <button type="submit">Book Room</button>
    </form> 
</body>
</html>

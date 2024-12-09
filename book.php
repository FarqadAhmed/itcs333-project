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

        header('Location: reservation.php?RoomID=' . $roomID . '&TimeslotID=' . $timeslotID . '&BookingDate=' . $bookingDate . '&Email=' . $email);
        exit;

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
    <style>
      body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0; 
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333; 
    margin-bottom: 20px;
}

form {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 400px; 
    margin: 0 auto; 
}

label {
    display: block;
    margin: 10px 0 5px; 
    font-weight: bold;
}

select, input[type="date"], input[type="email"], button {
    width: 100%; 
    padding: 10px;
    margin-bottom: 15px; 
    border: 1px solid #ccc; 
    border-radius: 4px; 
    box-sizing: border-box; 
}

button {
    background-color: 	#696969; 
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s; 
}

button:hover {
    background-color: #696969; 
}

p {
    text-align: center; 
    margin-top: 20px; 
}

a {
    text-decoration: none; 
    color: #696969; 
}

a:hover {
    text-decoration: underline; 
}
      
    </style>
</head>
<body>
    <h1> Bookn A Room </h1>
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
    <p><a href=" reservation.php"> Reservation information</a></p>
</body>
</html>

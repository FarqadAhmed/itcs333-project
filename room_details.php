<?php
// Include the database connection file
require 'connection.php';

// Check if the 'id' parameter is provided in the URL query string.
if (!isset($_GET['id'])) {
    // If the 'id' parameter is missing, terminate the script and display an error message.
    die("Room ID is not provided.");
}

// Retrieve the room ID from the URL query parameter.
$room_id = $_GET['id'];

// Prepare an SQL query to fetch the details of the specified room from the 'rooms' table.
$sql = "SELECT * FROM rooms WHERE RoomID = ?";
$statement = $db->prepare($sql); // Prepare the query to prevent SQL injection.
$statement->execute([$room_id]); // Execute the query with the provided room ID.
$room = $statement->fetch(PDO::FETCH_ASSOC); // Fetch the room details as an associative array.

// Prepare an SQL query to fetch all available timeslots for the specified room from the 'timeslots' table.
$sql = "SELECT * FROM timeslots WHERE RoomID = ? AND Is_Available = TRUE";
$statement = $db->prepare($sql); // Prepare the query to prevent SQL injection.
$statement->execute([$room_id]); // Execute the query with the provided room ID.
$timeslots = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetch all matching timeslots as an associative array.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Room details page -->
    <title>Room Details</title>
    <link rel="stylesheet" href="media.css">
    <!-- Links for google fonts & bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">

    <!-- Customizing Style -->
    <style>
        a{
            text-decoration : none;
            color :black;
        }
        a:hover{
            color:white;
        }
        h1, h2, p{
            font-family: "Parkinsans", sans-serif;  
            font-optical-sizing: auto;   
            font-style: normal;
        }
    </style>
</head>
<body>

    <div class="container mt-4 ">
        <div class="row">
            <!-- Display the room details -->
            <h1>Deparment Of <?= $room['departmentName']; ?></h1>
            <p><strong>Room Number: </strong><?= $room['RoomID']; ?></p>
            <p><strong>Room Type: </strong><?= $room['RoomType']; ?></p>
            <p><strong>Floor Number: </strong><?php echo $room['FloorNum'] ; ?></p>
            <p><strong>Capacity: </strong><?php echo $room['capacity']; ?></p>
            <p><strong>Equipment: </strong><?php echo $room['Equipment']; ?></p>

            <!-- Display the available timeslots for the room -->
            <h2>Available Timeslots</h2>
            <?php if ($timeslots): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <?php foreach ($timeslots as $timeslot): ?>
                                <?=$timeslot ['TimeslotID']; ?> - <?= $timeslot['StartTime']; ?> - <?php echo $timeslot['EndTime']; ?></br>
                            <?php endforeach; ?>
                <?php else: ?>
                    <p>No available timeslots.</p>
            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Button to go back to browse rooms -->
            <button type="button" class="btn btn-outline-dark me-lg-2 me-3 mb-2" data-bs-toggle="modal" data-bs-target="#roomModal">
                <a href="browse_rooms.php">Back to Room List</a>
            </button>
            <!-- Button to go to the booking page -->
            <button type="button" class="btn btn-outline-dark me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#bookingModal">
                <a href="book.php">For Booking, Clich Here</a>
            </button>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookingID = $_POST['BookingID'];

    // Fetch booking details
    $stmt = $db->prepare("
        SELECT RoomID, TimeslotID, BookingDate FROM bookings WHERE BookingID = ?");
    $stmt->execute([$bookingID]);
    $bookingDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($bookingDetails) {
        // Booking exists, proceed to delete
        $stmt = $db->prepare("
            DELETE FROM bookings WHERE BookingID = ?");
        $stmt->execute([$bookingID]);

        // Check if the deletion was successful
        if ($stmt->rowCount() > 0) {
            echo "Booking with ID $bookingID has been successfully canceled.";
        } else {
            echo "An error occurred while canceling the booking.";
        }
    } else {
        echo "No booking found with that ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Links for google fonts & bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <link rel="stylesheet" href="media.css">
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

input {
    width: 100%; 
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc; 
    border-radius: 4px; 
    box-sizing: border-box; 
}

button {
    background-color:#696969; 
    color: white;
    border: none;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s; 
    width: 100%;
}

button:hover {
    background-color: #c82333; 
}

a{
            text-decoration : none;
            color :black;
        }
        a:hover{
            color:white;
        }
        h1 , label{
            font-family: "Parkinsans", sans-serif;  
            font-optical-sizing: auto;   
            font-style: normal;
        }
       
    </style>
</head>
<body>
    <h1>Cancel Booking</h1>
    <form action="cancel.php" method="POST">
        <label for="BookingID">Booking ID:</label>
        <input type="number" name="BookingID" required>
        <button type="submit" class="btn btn-outline-dark me-lg-2 me-3 mt-2" data-bs-toggle="modal" data-bs-target="#bookingModal">Cancel Booking</button>
    </form>

    <button type="button" class="btn btn-outline-dark me-lg-2 me-3 mt-2" data-bs-toggle="modal" data-bs-target="#bookingModal">
    <a href="browse_rooms.php">Back to  Main Page </a>
            </button>

</body>
</html>

<?php
require 'connection.php';

if (isset($_GET['RoomID']) && isset($_GET['TimeslotID']) && isset($_GET['BookingDate']) && isset($_GET['Email'])) {
    $roomID = $_GET['RoomID'];
    $timeslotID = $_GET['TimeslotID'];
    $bookingDate = $_GET['BookingDate'];
    $email = $_GET['Email'];

    echo "<h1>Reservation Details</h1>";
    echo "<p><strong>Room ID:</strong> $roomID</p>";
    echo "<p><strong>Timeslot ID:</strong> $timeslotID</p>";
    echo "<p><strong>Booking Date:</strong> $bookingDate</p>";
    echo "<p><strong>Email:</strong> $email</p>";
} else {
    echo "Reservation details are missing.";
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
    <title>Reservation Details</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0; 
    margin: 0;
    padding: 20px;
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
        h1 , label ,p{
            font-family: "Parkinsans", sans-serif;  
            font-optical-sizing: auto;   
            font-style: normal;
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

input[type="number"] {
    width: 100%; 
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc; 
    border-radius: 4px; 
    box-sizing: border-box; 
}




p {
    text-align: center; 
    margin-top: 20px; 
}

       
    </style>
    <link rel="stylesheet" href="media.css">
</head>
<body>
<button type="button" class="btn btn-outline-dark me-lg-2 me-3 mb-2" data-bs-toggle="modal" data-bs-target="#bookingModal">
<a href="browse_rooms.php"> OK </a>
            </button>
            <button type="button" class="btn btn-outline-dark me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#bookingModal">
<a href="cancel.php"> To Cancel Booking, Click Here .</a>
            </button>

</body>
</html>

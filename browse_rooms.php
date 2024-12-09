<?php
// Include the database connection file
require 'connection.php';

// SQL query to select all the columns from the "rooms" table
$sql = "SELECT * FROM rooms";

// Prepare the SQL statement to prevent SQL injection and allow execution
$statement = $db->prepare($sql);

// Execute the prepared statement to retrieve data from the database
$statement->execute();

// Fetch all the rows from the executed query as an associative array
// Each row is represented as an associative array where column names are the keys
$rooms = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="media.css">
    <!-- Browse Rooms Page -->
    <title>Browse Rooms</title>
    <!-- links for google fonts & bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">

    <!-- Customizing Style -->
    <style>
        .h-font {
            font-family :'Merienda' , cursive;
        }
        a {
            text-decoration : none;
            color :black;
        }
        a:hover {
            color:white;
        }
        h2, p {
            font-family: "Parkinsans", sans-serif;  
            font-optical-sizing: auto;    
            font-style: normal;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font"  href="welcome.php">IT COLLAGE</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                <div class="d-flex">
                    <!-- Logout Button -->
                    <button type="button" class="btn btn-outline-dark me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <a href="welcome.php">Logout</a>
                    </button>
                    <!-- View Profile Button -->
                    <button type="button" class="btn btn-outline-dark me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <a href="profile.php">Profile</a>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Display all rooms -->
    <div class="container mt-4">
        <div class="row">
            <?php foreach ($rooms as $room){ ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- Display department name -->
                            <h2>Department Of <?php echo $room['departmentName']; ?></h2>
                            <!-- Display room number -->
                            <p>Room Number: <?php echo $room['RoomID']; ?></p>
                            <!-- Display room type (class or lab) -->
                            <p>Room Type: <?php echo $room['RoomType']; ?></p>
                            <!-- Link to view room details -->
                            <a href="room_details.php?id=<?php echo $room['RoomID']; ?>">View Details</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
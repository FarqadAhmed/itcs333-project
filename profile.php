<?php
require 'connection.php';
require 'session.php';

if (!isset($_SESSION['active_user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['active_user_id'];
$sql = "SELECT * FROM users WHERE ID = :id";
$statement = $db->prepare($sql);
$statement->execute(['id' => $user_id]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<div class="profile-card">
        <div class="image">
    <img src="<?= $user['profile_picture'] ? $user['profile_picture'] : 'user.png'; ?>" class="profile-img" alt="Profile Picture">
</div>
<div class="text-data">
    <h1>User Profile</h1>
    <p><strong>Name:</strong> <?= $user['FName'] . " " . $user['LName']; ?></p>
    <p><strong>ID:</strong> <?= $user['ID']; ?></p>
    <p><strong>Email:</strong> <?= $user['Email']; ?></p>
    <p><strong>Role:</strong> <?= $user['role']; ?></p>
</div>
<div class="buttons">
<button class="button"><a href="edit_profile.php">Edit Profile</a></button>
<button class="button"><a href="browse_rooms.php">Browse Rooms</a></button>
</div>
</div>
</body>

</html>
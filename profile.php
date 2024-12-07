<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
</head>

<body>
    <h1>User Profile</h1>
    <img src="<?= $user['profile_picture'] ? $user['profile_picture'] : 'default.png'; ?>" alt="Profile Picture"
    style="width:100px; height:100px; border-radius:50%;">
    <p><strong>Name:</strong> <?= $user['FName'] . " " . $user['LName']; ?></p>
    <p><strong>Email:</strong> <?= $user['Email']; ?></p>
    <p><strong>Role:</strong> <?= $user['role']; ?></p>
    <a href="edit_profile.php">Edit Profile</a>
</body>

</html>
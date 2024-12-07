<?php
require 'connection.php';
include('session.php');

if (!isset($_SESSION['active_user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['active_user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $upload_dir = 'uploads/';
    $file_name = basename($_FILES['profile_picture']['name']);
    $target_file = $upload_dir . $file_name;

    $file_type = mime_content_type($_FILES['profile_picture']['tmp_name']);
    if (in_array($file_type, ['image/jpeg', 'image/png', 'image/gif'])) {
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            $sql = "UPDATE users SET profile_picture = ? WHERE ID = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$target_file, $user_id]);
            echo "Profile picture updated successfully!";
            header("Location: profile.php");
            exit;
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Please upload a valid image file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile Picture</title>
</head>
<body>
    <h1>Upload Profile Picture</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="profile_picture" accept="image/*"><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>

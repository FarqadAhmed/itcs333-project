<?php
require 'connection.php';
include('session.php');

if (!isset($_SESSION['active_user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['active_user_id'];
$sql = "SELECT * FROM users WHERE ID = ?";
$statement = $db->prepare($sql);
$statement->execute([$user_id]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = trim($_POST['FName']);
    $lname = trim($_POST['LName']);
    $email = trim($_POST['Email']);
    $profile_picture = $user['profile_picture'];

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['profile_picture']['name']);
        $target_file = $upload_dir . $file_name;


        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        if (!is_writable($upload_dir)) {
            echo "Upload directory is not writable.";
            exit;
        }

        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_type = mime_content_type($_FILES['profile_picture']['tmp_name']);

        if (
            in_array(strtolower($file_extension), $allowed_extensions) &&
            in_array($file_type, ['image/jpeg', 'image/png', 'image/gif'])
        ) {
            if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
                echo "Failed to upload the profile picture.";
                print_r(error_get_last());
                exit;
            }
            $profile_picture = $target_file;
        } else {
            echo "Invalid file type. Allowed types: JPEG, PNG, GIF.";
            exit;
        }
    } elseif ($_FILES['profile_picture']['error'] != UPLOAD_ERR_NO_FILE) {
        echo "File upload error: " . $_FILES['profile_picture']['error'];
        exit;
    }


    // Update the database
    if (!empty($fname) && !empty($lname) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $update_sql = "UPDATE users SET FName = ?, LName = ?, Email = ?, profile_picture = ? WHERE ID = ?";
        $update_stmt = $db->prepare($update_sql);
        $update_stmt->execute([$fname, $lname, $email, $profile_picture, $user_id]);
        echo "Profile updated successfully!";
        header("Location: profile.php");
        exit;
    } else {
        echo "Invalid input.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>
    <h1>Edit Profile</h1>
    <form method="post" enctype="multipart/form-data">
        <label>First Name:</label>
        <input type="text" name="FName" value="<?php echo $user['FName']; ?>"><br>
        <label>Last Name:</label>
        <input type="text" name="LName" value="<?php echo $user['LName'];
        string: ?>"><br>
        <label>Email:</label>
        <input type="email" name="Email" value="<?php echo $user['Email']; ?>"><br>
        <label>Profile Picture:</label><br>
        <img src="<?php echo $user['profile_picture'] ? $user['profile_picture'] : 'default.png'; ?>"
            alt="Profile Picture" style="width:100px; height:100px; border-radius:50%;"><br>
        <input type="file" name="profile_picture" accept="image/*"><br><br>
        <button type="submit">Save Changes</button>
    </form>
</body>

</html>
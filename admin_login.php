
<?php

require 'connection.php';

if (isset($_SESSION['admin_logged_in'])) {
    header("Location:AdminHomePage.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

        // Fetch admin data
        $query = "SELECT * FROM admin WHERE username='' ";
        $stmt = $db->prepare($query);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashed_password = md5($_POST['password']);

        if ($admin && password_verify($password,$hashed_password)) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: AdminHomePage.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }

    }

?>

<!DOCTYPE html>
<html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="media.css">
</head>
<body>
    <h1>Admin Login</h1>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>

<?php
 require 'connection.php';
 include('session.php');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- java script -->
    <script>
function loginValidation() {
    // Validate the Email field
    if (document.loginForm.email.value == "") {
        document.getElementById("mail").innerHTML = "Please enter your UOB email";
        return false;  // Prevent form submission
    } else {
        document.getElementById("mail").innerHTML = "";  // Clear any previous error message
    }

    // Validate the Password field
    if (document.loginForm.Password.value == "") {
        document.getElementById("pass").innerHTML = "Please enter your password";
        return false;  // Prevent form submission
    } else {
        document.getElementById("pass").innerHTML = "";  // Clear any previous error message
    }
}


</script>


</head>
<body>

<?php
if (isset($_POST['email']) && isset($_POST['Password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['Password']);

    if (!empty($email) && !empty($password)) {
    $sql = "SELECT Email,Password,ID FROM users WHERE Email = :email";
    $r = $db->prepare($sql);
    $r->execute([':email' => $email]);

    if ($r->rowCount() == 1) {
        $row = $r->fetch(PDO::FETCH_ASSOC);

    
        if (password_verify($password, $row['Password'])) {

            $_SESSION['active_user'] = $row['FName'] . " " . $row['LName'];
            $_SESSION['active_user_id'] = $row['ID'];
            $_SESSION['active_user_email'] = $row['Email'];
            if (isset($_POST['remember']))
            {
            setcookie('active_user', $_SESSION['active_user'], time() + (15552000)); // 6 أشهر
            setcookie('active_user_id', $_SESSION['active_user_id'], time() + (15552000)); // 6 أشهر
            setcookie('active_user_email', $_SESSION['active_user_email'], time() + (15552000)); // 6 أشهر

            }
            header("Location: browse_rooms.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    }
}
else {
    echo "Please fill in both email and password.";
}

}
?>
<div class="container"> 
<div class="login-box">
    <h2>Login</h2>
    <form method="post" action="" name="loginForm" onsubmit="return loginValidation()">
    <!-- Email -->
    <label for="Email"></label>
    <input type="text" name="email" placeholder="Email">
    <span id="mail"></span><br>

    <!-- Password -->
    <label for="Password"></label>
    <input type="password" name="Password" placeholder="Password">
    <span id="pass"></span><br>

    <!-- Remember Me -->
    <div class="option">
    <label class="form-group" for="remember" style="color: grey; font-weight: normal; padding-top: 16px;">
        <input type="checkbox" id="remember" name="remember"> Remember me
    </label><br>
</div>
    <button type="submit" >Login</button>
    <p>Don't have an account ? <a href="register.php" id="register">Register</a></p>
</form>
</div>
</div>
</body>
</html>
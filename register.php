<?php
require 'connection.php';
include('session.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
    <script>
function RegisterValidation() {
    // Validate the fname field
    if (document.registerForm.FName.value == "") {
        document.getElementById("fname").innerHTML = "Please enter your first name";
        return false;  // Prevent form submission
    } else {
        document.getElementById("fname").innerHTML = "";  // Clear any previous error message
    }

    // Validate the lname field
    if (document.registerForm.LName.value == "") {
        document.getElementById("lname").innerHTML = "Please enter your last name";
        return false;  // Prevent form submission
    } else {
        document.getElementById("lname").innerHTML = "";  // Clear any previous error message
    }

    // Validate the ID field
    if (document.registerForm.ID.value == "") {
        document.getElementById("id").innerHTML = "Please enter your ID";
        return false;  // Prevent form submission
    } else {
        document.getElementById("id").innerHTML = "";  // Clear any previous error message
    }

    // Validate the email field
    if (document.registerForm.email.value == "") {
        document.getElementById("email").innerHTML = "Please enter your email";
        return false;  // Prevent form submission
    } else {
        document.getElementById("email").innerHTML = "";  // Clear any previous error message
    }

    // Validate the password field
    if (document.registerForm.Password.value == "") {
        document.getElementById("pass").innerHTML = "Please enter your password";
        return false;  // Prevent form submission
    } else {
        document.getElementById("pass").innerHTML = "";  // Clear any previous error message
    }

    // Validate the role field
    if (document.registerForm.role.value == "") {
        document.getElementById("role").innerHTML = "Please select a role (student or doctor)";
        return false;  // Prevent form submission
    } else {
        document.getElementById("role").innerHTML = "";  // Clear any previous error message
    }

    return true;  // Allow form submission
}
</script>

</head>
<body>
    <?php
if (isset($_POST['FName'])){
    $fname = $_POST['FName'];
    $lname = $_POST['LName'];
    $id = $_POST['ID'];
    $email = $_POST['email'];
    $hpassword =password_hash($_POST['Password'],PASSWORD_DEFAULT);
    $role =$_POST['role'];
    $AnyError=false;
if (isset($_POST['submit'])) {
     // Validate UoB email
if (
        ($role == 'student' && !preg_match("/^[0-9]{8,9}@stu\.uob\.edu\.bh$/", $email)) || 
        ($role == 'doctor' && !preg_match("/^[a-z]+@uob\.edu\.bh$/", $email))
    ) {
        $AnyError=True;
        echo "email or role is not valid .. please try again!";
    }

        if (!(strlen($id) == 8 || strlen($id) == 9)) {
            $AnyError=True;
            echo "id must have 8-9 numbers";
        }
            $sql = "SELECT Email FROM users WHERE email = :Email";
            $statement = $db->prepare($sql);
            $statement->execute(['Email' => $email]);
            //row count same email
            $count = $statement->rowCount();
            if ($count!=0){
                $AnyError=True;
            echo " account with that email already exists , please login";
            }

            if ($AnyError == false){
    $sql ="insert into Users value('$fname','$lname','$id','$email','$hpassword','$role',null)";
    $r=$db->exec($sql);
if ($r==1){     
            $_SESSION['active_user'] = $row['FName'] . " " . $row['LName'];
            $_SESSION['active_user_id'] = $row['ID'];
            $_SESSION['active_user_email'] = $row['Email'];
            header("Location: browse_rooms.php");
            exit;
        }
        else {
        echo "Something error";}
        } 
    
}
}
?>
<div class="container"> 
    <div class="register-box"> 
<!-- Heading for the registration form -->
<h2 class="Rg">Registeration</h2> 

<form method="post" action="" name="registerForm" onsubmit="return RegisterValidation()">
    <!-- Container for the form -->
    

        <!-- First Name -->
        <div class="FName">
        <!-- Label for first name -->
            <label for="FName"></label>
            <!-- Input field for first name -->
            <input type="text" name="FName" placeholder="First Name" > 
            <span id="fname"></span> 
        </div>
        
        <!-- Last Name -->
        <div class="LName">
            <!-- Label for last name -->
            <label for="LName"></label> 
            <!-- Input field for last name -->
            <input type="text" name="LName" placeholder="Last Name" >
            <span id="lname"></span> 
        </div>

        <!-- ID -->
        <div class="ID">
            <!-- Label for ID -->
            <label for="ID"></label> 
            <!-- Input field for ID -->
            <input type="text" name="ID" placeholder="ID" > 
            <span id="id"></span> 
        </div>

        <!-- Email -->
        <div class="Email">
            <!-- Label for email -->
            <label for="email"></label> 
            <!-- Input field for email -->
            <input type="text" name="email" placeholder="Email" > 
            <span id="email"></span> 
        </div>

        <!-- Password -->
        <div class="password">
            <!-- Label for password -->
            <label for="Password"></label>
            <!-- Input field for password -->
            <input type="text" name="Password" placeholder="Password" >
            <span id="pass"></span> 
        </div>

        <!-- Role -->
        <div class="Role">
            <!-- Label for role -->
            <label for="role"> 
            <!-- Dropdown for selecting role -->
            <select name="role">
            <option value ="">Please choose your role</option>
                <!-- Option for student -->
                <option value="student">Student</option> 
                <!-- Option for doctor -->
                <option value="doctor">Doctor</option> 
            </select>
            </label>
        
            <span id="role"></span> 
        </div>

        <!-- Submit Button -->
        <button type="submit" name="submit">Register</button> 
    
</form>
</div>
</div>
</body>
</html>


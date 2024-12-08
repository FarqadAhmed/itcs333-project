<?php
// Start a session
session_start();

// Check if the 'active_user' cookie exists
if(isset($_COOKIE['active_user']) && isset($_COOKIE['active_user_id']) && isset($_COOKIE['active_user_email'])) {
    // Restore session variables from cookie values
    $_SESSION['active_user'] = $_COOKIE['active_user'];
    $_SESSION['active_user_id'] = $_COOKIE['active_user_id'];
    $_SESSION['active_user_email'] = $_COOKIE['active_user_email'];
}

?>
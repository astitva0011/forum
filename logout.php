<?php
// Start session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or wherever you want to go after logout
header("Location: login.php");
exit();
?>
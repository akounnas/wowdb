<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();

// Destroy COOKIE
unset($_COOKIE["c_user"]);
 
// Redirect to login page
header("location: index.php");
exit;
?>
<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Print a message
echo "Ho gya ab ghr jao.";

// Redirect to login page (adjust the URL as needed)
header("Location: login.php");
exit();
?>

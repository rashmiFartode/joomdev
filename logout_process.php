<?php
session_start(); // Start the session
if (!isset($_SESSION['user'])) {
      // Redirect to the login page or any other page you prefer
      header('Location: index.php');
      exit; // Stop further script execution
}
// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to a login page or another page of your choice
header('Location: index.php');
exit;

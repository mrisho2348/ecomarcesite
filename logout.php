<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect to the homepage or any other desired page
header("Location: login.php");
exit;
?>

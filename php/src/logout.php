<?php
session_start();

// Clear all session data
$_SESSION = [];
session_unset();
session_destroy();

// Redirect back to home
header("Location: home.php");
exit;
?>

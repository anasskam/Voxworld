<?php 
session_start();

// Destroy all session data //
unset($_SESSION['user_id']); 

// Redirect to the login page //
header("Location: ../index.php"); 
exit();

<?php 
session_start();

// Destroy all session data //
unset($_SESSION['admin_id']); 

// Redirect to the login page //
header("Location: ../auth/admin.php"); 
exit();

<?php
function checkPermission($requiredRole) {
    // Check if the user is logged in and has the required role
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {

        // If not, redirect to a login page
        header('Location: admin.php');
        exit();
    }
}

<?php
function checkAdminSession() {
    if (!isset($_SESSION['adminId'])) {
        // Redirect to login page //
        header('Location: ../pages/admin.php');
        exit();
    }
    return $_SESSION['adminId'];
}

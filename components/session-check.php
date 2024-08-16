<?php
function checkAdminSession() {
    if (!isset($_SESSION['admin_id'])) {
        // Redirect to login page //
        header('Location: ../pages/admin.php');
        exit();
    }
    return $_SESSION['admin_id'];
}

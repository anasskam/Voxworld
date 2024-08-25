<?php
function checkAdminSession() {
    if (!isset($_SESSION['admin_id'])) {
        // Redirect to login page //
        header('Location: ../auth/admin.php');
        exit();
    }
    return $_SESSION['admin_id'];
}

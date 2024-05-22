<?php
session_start();
include '../components/permissions.php';

// Check if the user has the 'admin' role
checkPermission('admin');

//logout
if (isset($_POST['submit'])) {

    session_destroy();
    header('Location: admin.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <h1>Welcome to admin dashboard</h1>
        <button type="submit" name="submit">Logout now</button>
    </form>

</body>
</html>
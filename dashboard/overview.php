<?php
session_start();
// Session Test //
if (!isset($_SESSION['adminId'])) {
    // Redirect to login page //
    header('Location: ../pages/admin.php'); 
    exit();
  }
  $adminId = $_SESSION['adminId'];
// Logout //
if (isset($_POST['submit'])) {

    session_destroy();
    header('Location: ../pages/admin.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Overview</title>
</head>
<body>
    <form method="post">
        <h1>Welcome to admin dashboard</h1>
        <button type="submit" name="submit">Logout now</button>
    </form>

</body>
</html>
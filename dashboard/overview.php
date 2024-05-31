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

    session_destroy ();
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

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">

    <!-- custom js -->
    <script src="../js/theme.js" defer></script>
    <script src="../js/sidebar.js" defer></script>
</head>
<body>

    <div class="dashboard-container">
        <!-- side bar --> 
        <?php
            include "../components/sidebar.php"
        ?>

        <main>
            <!-- header bar -->
            <?php
                include "../components/dashboard-header.php"
            ?>

            <div class="content-container"></div>
        </main>
    </div>


</body>
</html>
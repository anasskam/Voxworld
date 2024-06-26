<?php
session_start();
// Session Test //
include '../components/session-check.php';
$adminId = checkAdminSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Manage comments</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">

    <!-- custom js -->
    <script src="../js/theme.js" type="module" defer></script>
    <script src="../js/sidebar.js" type="module" defer></script>
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
            
            <div class="content-container">

            </div>
        </main>
    </div>
</body>
</html>
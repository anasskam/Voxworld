<?php
session_start();
// Session Test //
include '../components/session-check.php';
include '../components/emptyStateTemplate.php';
$adminId = checkAdminSession();

// DB Connection //
require_once '../components/connect.php';
if(isset($_POST['search-btn']) or isset($_POST['search-bar'])){

    $search_bar = $_POST['search-bar'];

    // Fetch searched users //
    $users = $conn->query("SELECT * FROM users WHERE FirstName LIKE '%{$search_bar}%' OR LastName LIKE '%{$search_bar}%' or email LIKE '%{$search_bar}%'")->fetchAll(PDO::FETCH_ASSOC);

    // Check if no users //
    $usersCount = $conn->query('SELECT COUNT(id) AS NumUsers FROM users')->fetchAll(PDO::FETCH_ASSOC);
}


$emptyIllustration = "";

// Delete User //

if (isset($_POST['user-delete'])) {
    $user_id = $_POST['user-delete'];

    // Prepare and execute the query to delete the user //
    $userDelete = $conn->prepare('DELETE FROM users WHERE id = ?');
    $userDelete->execute([$user_id]);

    // Remove likes related to the deleted user //
    $likeDelete = $conn->prepare('DELETE FROM likes WHERE user_id = ?');
    $likeDelete->execute([$user_id]);

    // Remove comments related to the deleted user //
    $viewsDelete = $conn->prepare('DELETE FROM comments WHERE user_id = ?');
    $viewsDelete->execute([$user_id]);

    // Check if the session user is the one deleted & unset session variables //
    if (isset($_SESSION['user_id']) && $user_id == $_SESSION['user_id']) {
        // Unset session for the deleted user //
        unset($_SESSION['user_id']);
    }
    if ($userDelete) {
        ?>
            <script defer> 
                setTimeout(()=> {
                swal("Success", "User deleted successfully", "success", {
                buttons: false,
                timer:2500,
                }).then(()=> {
                    window.location.href = "./manageUsers.php";
                })
                }, 500)
            </script>
        <?php
    }
    else {
        echo 'Error deleting user';
    }
}

// Empty table check //
if (count($users) == 0) {
    $emptyIllustration = emptyStateTemplate("No users found :(");
}
else {
    $emptyIllustration = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Dashboard | Manage Users</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">

    <!-- custom js -->
    <script src="../js/theme.js" type="module" defer></script>
    <script src="../js/sidebar.js" type="module" defer></script>
    <script src="../js/manageUsers.js" defer type="module"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                <header class="dashboard-content-header">
                    <p class="text-body1"> Manage users(<?php echo count($users);?>)</p>
                    <form method="POST">
                        <div class="search-bar-wrapper">
                            <div class="input-field">
                            <!-- search icon -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
                                <path d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 22L20 20" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <input type="text" placeholder="Search for users..." name="search-bar">
                            <button class="ghost-btn" type="submit" name="search-btn">Search</button>
                            
                            </div>
                        </div>
                    </form>
                </header>
            
                <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user['id']?></td>
                            <td><?php echo $user['FirstName']?></td>
                            <td><?php echo $user['LastName']?></td>
                            <td><?php echo $user['email']?></td>
                            <td>
                                <?php 
                                    $creationDate = $user['CreationDate'];
                                    $dateTime = new DateTime($creationDate);
                                    echo $dateTime->format('M j, Y H:i');
                                ?>
                            </td>
                            <td>
                                <form method="POST">
                                    <button class="ghost-btn delete-btn" type="submit" name="user-delete" value="<?php echo $user['id']?>" onclick="return confirm('Are you sure you want to delete <?php echo $user['FirstName'] .' '. $user['LastName']?>')">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 5.98001C17.67 5.65001 14.32 5.48001 10.98 5.48001C9 5.48001 7.02 5.58001 5.04 5.78001L3 5.98001" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.78999C5.99999 22 5.90999 20.78 5.79999 19.21L5.14999 9.14001" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10.33 16.5H13.66" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M9.5 12.5H14.5" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php echo $emptyIllustration?>
                </div>

            </div>
        </main>
    </div>
</body>
</html>
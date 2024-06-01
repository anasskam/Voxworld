<?php
session_start();
// Session Test //
include '../components/session-check.php';
$adminId = checkAdminSession();

// DB Connection //
require_once '../components/connect.php';
$users = $conn->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
$usersCount = $conn->query('SELECT COUNT(id) AS NumUsers FROM users')->fetchAll(PDO::FETCH_ASSOC);

$emptyIllustration = "";
// Delete User //
if (isset($_POST['user-delete'])) {

    $userID = $_POST['user-delete'];

    // Prepare and execute the query //
    $userDelete = $conn->prepare('DELETE FROM users WHERE id = ?');
    $userDelete->execute([$userID]);

    if ($userDelete) {
        header('location: manageUsers.php');
    }
    else {
        echo 'Error deleting user';
    }
}

// Empty table check //
if ($usersCount[0]['NumUsers'] == 0) {
    $emptyIllustration = '
    <div class="empty-state-wrapper">
    <svg width="200" height="141" viewBox="0 0 200 141" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M42 0.5H162C167.247 0.5 171.5 4.75329 171.5 10V130C171.5 135.247 167.247 139.5 162 139.5H42C36.7533 139.5 32.5 135.247 32.5 130V10C32.5 4.75329 36.7533 0.5 42 0.5Z" fill="currentcolor" stroke="currentcolor"/>
        <g filter="url(#filter0_d_585_8962)">
        <path d="M54 54H189C190.326 54 191.598 54.5268 192.536 55.4645C193.473 56.4021 194 57.6739 194 59V84C194 85.3261 193.473 86.5979 192.536 87.5355C191.598 88.4732 190.326 89 189 89H54C52.6739 89 51.4021 88.4732 50.4645 87.5355C49.5268 86.5979 49 85.3261 49 84V59C49 57.6739 49.5268 56.4021 50.4645 55.4645C51.4021 54.5268 52.6739 54 54 54V54Z" fill="currentcolor"/>
        </g>
        <path opacity="0.3" d="M128 62H102C100.343 62 99 63.3431 99 65C99 66.6569 100.343 68 102 68H128C129.657 68 131 66.6569 131 65C131 63.3431 129.657 62 128 62Z" fill="#4353FE"/>
        <path opacity="0.15" d="M146 75H102C100.343 75 99 76.3431 99 78C99 79.6569 100.343 81 102 81H146C147.657 81 149 79.6569 149 78C149 76.3431 147.657 75 146 75Z" fill="#4353FE"/>
        <path d="M79.5 81C84.7467 81 89 76.7467 89 71.5C89 66.2533 84.7467 62 79.5 62C74.2533 62 70 66.2533 70 71.5C70 76.7467 74.2533 81 79.5 81Z" fill="#4353FE"/>
        <g filter="url(#filter1_d_585_8962)">
        <path d="M11 97H146C147.326 97 148.598 97.5268 149.536 98.4645C150.473 99.4021 151 100.674 151 102V127C151 128.326 150.473 129.598 149.536 130.536C148.598 131.473 147.326 132 146 132H11C9.67392 132 8.40215 131.473 7.46447 130.536C6.52678 129.598 6 128.326 6 127V102C6 100.674 6.52678 99.4021 7.46447 98.4645C8.40215 97.5268 9.67392 97 11 97V97Z" fill="currentcolor"/>
        </g>
        <path opacity="0.3" d="M85 105H59C57.3431 105 56 106.343 56 108C56 109.657 57.3431 111 59 111H85C86.6569 111 88 109.657 88 108C88 106.343 86.6569 105 85 105Z" fill="#4353FE"/>
        <path opacity="0.15" d="M103 118H59C57.3431 118 56 119.343 56 121C56 122.657 57.3431 124 59 124H103C104.657 124 106 122.657 106 121C106 119.343 104.657 118 103 118Z" fill="#4353FE"/>
        <path d="M23.5 124C28.7467 124 33 119.747 33 114.5C33 109.253 28.7467 105 23.5 105C18.2533 105 14 109.253 14 114.5C14 119.747 18.2533 124 23.5 124Z" fill="#4353FE"/>
        <g filter="url(#filter2_d_585_8962)">
        <path d="M146 11H11C8.23858 11 6 13.2386 6 16V41C6 43.7614 8.23858 46 11 46H146C148.761 46 151 43.7614 151 41V16C151 13.2386 148.761 11 146 11Z" fill="currentcolor"/>
        </g>
        <path opacity="0.3" d="M83 19H57C55.3431 19 54 20.3431 54 22C54 23.6569 55.3431 25 57 25H83C84.6569 25 86 23.6569 86 22C86 20.3431 84.6569 19 83 19Z" fill="#4353FE"/>
        <path opacity="0.15" d="M101 32H57C55.3431 32 54 33.3431 54 35C54 36.6569 55.3431 38 57 38H101C102.657 38 104 36.6569 104 35C104 33.3431 102.657 32 101 32Z" fill="#4353FE"/>
        <path d="M36.5 38C41.7467 38 46 33.7467 46 28.5C46 23.2533 41.7467 19 36.5 19C31.2533 19 27 23.2533 27 28.5C27 33.7467 31.2533 38 36.5 38Z" fill="#4353FE"/>
        <defs>
        <filter id="filter0_d_585_8962" x="43" y="51" width="157" height="47" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
        <feOffset dy="3"/>
        <feGaussianBlur stdDeviation="3"/>
        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0"/>
        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_585_8962"/>
        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_585_8962" result="shape"/>
        </filter>
        <filter id="filter1_d_585_8962" x="0" y="94" width="157" height="47" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
        <feOffset dy="3"/>
        <feGaussianBlur stdDeviation="3"/>
        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0"/>
        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_585_8962"/>
        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_585_8962" result="shape"/>
        </filter>
        <filter id="filter2_d_585_8962" x="0" y="8" width="157" height="47" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
        <feOffset dy="3"/>
        <feGaussianBlur stdDeviation="3"/>
        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.161 0"/>
        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_585_8962"/>
        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_585_8962" result="shape"/>
        </filter>
        </defs>
    </svg>
    <p class="text-body1">There are no users to show :(</p>
    </div>
    ';
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
    <script src="../js/sidebar.js" defer></script>
    <script src="../js/manageUsers.js" defer></script>
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
                <p class="text-body1">
                    Manage users(<?php echo $usersCount[0]['NumUsers'];?>)
                </p>
            
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
                                    <button class="delete-btn" type="submit" name="user-delete" value="<?php echo $user['id']?>">
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
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
    <script src="../js/post.js" type="module" defer></script>
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
                <h3>Comments <span>(5)</span></h3>
                <div class="comments-wrapper">

                    <div class="comment-wrapper manage-comment">
                        
                        <div class="comment-body">
                            <div class="comment-img">
                            <img src="../assets/icons/user2.svg" alt="comment user image">
                            </div>

                            <div class="comment-content-wrapper">
                            
                            <div class="comment-header">
                                <p class="text-body2">Anas Karmoua</p>
                                <span class="bullet"></span>
                                <p class="text-caption1 opacity-half">Jun 27, 2024 03:02</p>
                            </div>

                            <div class="comment-content text-button">F1 driver Lance Stroll's guide to a weekend in his hometown Montreal</div>
                            </div>
                        </div>

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

                    </div>

                    <div class="comment-wrapper manage-comment">
                        
                        <div class="comment-body">
                            <div class="comment-img">
                            <img src="../assets/icons/user2.svg" alt="comment user image">
                            </div>

                            <div class="comment-content-wrapper">
                            
                            <div class="comment-header">
                                <p class="text-body2">Anas Karmoua</p>
                                <span class="bullet"></span>
                                <p class="text-caption1 opacity-half">Jun 27, 2024 03:02</p>
                            </div>

                            <div class="comment-content text-button">F1 driver Lance Stroll's guide to a weekend in his hometown Montreal F1 driver Lance Stroll's guide to a weekend in his hometown Montreal </div>
                            </div>
                        </div>

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

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
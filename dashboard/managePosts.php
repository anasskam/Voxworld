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

    <title>Dashboard | Manage Posts</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">

    <!-- custom js -->
    <script src="../js/theme.js" type="module" defer></script>
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

            <div class="content-container">
                <p class="text-body1">
                    Manage posts(10)
                </p>
            
                <div class="posts-wrapper">
                    <div class="post-wrapper">

                        <div class="image-content-wrapper">
                            <!-- post image -->
                            <img src="../assets/images/test.jpg" alt="post image">

                            <div class="post-content">
                                <p class="text-body1 text-md" value>The unseen of spending three years at Pixelgrade...</p>

                                <div class="post-category-date">
                                    <span class="chip1 category text-caption1">Politics</span>
                                    <span class="divider"></span>
                                    <p class="text-button post-date">Feb 2, 2024 19:28 <span>(Updated: Feb 4, 2024 20:51)</span></p>
                                </div>

                                <div class="post-intractions-wrapper">
                                    <div class="post-views-wrapper post-intraction-wrapper">
                                        <img src="../assets/icons/show-pass.svg" alt="views">
                                        <span class="post-views text-button" name="post-views">2,423 </span>views
                                    </div>

                                    <div class="post-likes-wrapper post-intraction-wrapper">
                                        <img src="../assets/icons/like.svg" alt="likes">
                                        <span class="post-likes text-button" name="post-likes">215 </span>likes
                                    </div>

                                    <div class="post-comments-wrapper post-intraction-wrapper">
                                        <img src="../assets/icons/comment.svg" alt="views">
                                        <span class="post-comments text-button" name="post-comments">6 </span>comments
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post-actions">
                            <form method="POST">

                                <button class="ghost-btn" type="submit" name="post-edit" value="">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.26 3.6L5.05 12.29C4.74 12.62 4.44 13.27 4.38 13.72L4.01 16.96C3.88 18.13 4.72 18.93 5.88 18.73L9.1 18.18C9.55 18.1 10.18 17.77 10.49 17.43L18.7 8.74C20.12 7.24 20.76 5.53 18.55 3.44C16.35 1.37 14.68 2.1 13.26 3.6Z" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M11.89 5.04999C12.32 7.80999 14.56 9.91999 17.34 10.2" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3 22H21" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Edit
                                </button>

                                <button class="ghost-btn delete-btn" type="submit" name="post-delete" value="">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 5.98001C17.67 5.65001 14.32 5.48001 10.98 5.48001C9 5.48001 7.02 5.58001 5.04 5.78001L3 5.98001" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.78999C5.99999 22 5.90999 20.78 5.79999 19.21L5.14999 9.14001" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10.33 16.5H13.66" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9.5 12.5H14.5" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Delete
                                </button>

                                <button class="ghost-btn preview-btn" type="submit" name="post-preview" value="">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 11L21.2 2.79999" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M22 6.8V2H17.2" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Preview
                                </button>

                            </form>
                        </div>
                        
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
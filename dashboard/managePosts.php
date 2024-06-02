<?php
session_start();
// Session Test //
include '../components/session-check.php';
$adminId = checkAdminSession();

// DB Connection //
require_once '../components/connect.php';
$posts = $conn->query('SELECT * FROM posts')->fetchAll(PDO::FETCH_ASSOC);
$postsCount = $conn->query('SELECT COUNT(id) AS NumPosts FROM posts')->fetchAll(PDO::FETCH_ASSOC);

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
                    Manage posts(<?php echo $postsCount[0]['NumPosts'];?>)
                </p>
            
                <div class="posts-wrapper">
                    <div class="post-wrapper">
                        <!-- post image -->
                        <?php
                            foreach ($posts as $post) {
                                ?>
                                    <img src="../assets/hostedImages/<?php echo $post['image']?>" alt="post image">

                                    <div class="post-content">
                                        <p class="text-body1 text-md" value><?php echo $post['title']?></p>

                                        <div class="post-category-date">
                                            <span class="chip1 category"><?php echo $post['category']?></span>
                                            <span class="divider"></span>
                                            <p class="text-caption1 post-date"><?php echo $post['CreationDate']?> <span><?php echo $post['UpdateDate']?></span></p>
                                        </div>

                                        <div class="post-intractions-wrapper">
                                            <div class="post-views-wrapper">
                                                <img src="../assets/icons/show-pass.svg" alt="views">
                                                <span class="post-views" name="post-views">2,423 </span>views
                                            </div>

                                            <div class="post-likes-wrapper">
                                                <img src="../assets/icons/like.svg" alt="likes">
                                                <span class="post-likes" name="post-likes">215 </span>likes
                                            </div>

                                            <div class="post-comments-wrapper">
                                                <img src="../assets/icons/comment.svg" alt="views">
                                                <span class="post-comments" name="post-comments">6 </span>comments
                                            </div>
                                        </div>
                                    </div>

                                    <div class="post-actions">
                                        
                                    </div>
                                <?php
                            }
                        ?>

                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
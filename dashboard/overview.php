<?php
session_start();
// Session Test //
include '../components/session-check.php';
$adminId = checkAdminSession();

// DB Connection //
require_once '../components/connect.php';

$categoryMapping = [
    'Politics' => 'politics',
    'Economy' => 'economy',
    'Society' => 'society',
    'Culture' => 'culture',
    'Science & Tech' => 'scienceandtech',
    'Business' => 'business',
    'Sports' => 'sports',
    'Ents & Arts' => 'entsandarts',
    'Mena' => 'mena',
    'Health' => 'health',
    'International' => 'international',
];

// Fetch top posts sorted by likes, views, and comments //
$selectTopPosts = $conn->query("SELECT p.*, 
                                (SELECT COUNT(*) FROM likes WHERE post_id = p.id) AS total_likes,
                                (SELECT COUNT(*) FROM views WHERE post_id = p.id) AS total_views,
                                (SELECT COUNT(*) FROM comments WHERE post_id = p.id) AS total_comments
                                FROM posts p
                                ORDER BY total_likes DESC, total_views DESC, total_comments DESC
                                LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

// Fetch only top posts total number //
$topPostsCount = count($selectTopPosts);

// Fetch posts total number //
$postsCount = $conn->query('SELECT COUNT(id) AS NumPosts FROM posts')->fetchAll(PDO::FETCH_ASSOC);   

// Fetch users total number //
$usersCount = $conn->query('SELECT COUNT(id) AS NumUsers FROM users')->fetchAll(PDO::FETCH_ASSOC);  

// Fetch likes total number //
$likesCount = $conn->query('SELECT COUNT(id) AS NumLikes FROM likes')->fetchAll(PDO::FETCH_ASSOC);

// Fetch views total number //
$viewsCount = $conn->query('SELECT COUNT(id) AS NumViews FROM views')->fetchAll(PDO::FETCH_ASSOC);

// Fetch latest comments //
$selectLatestComments = $conn->query('SELECT c.*, p.category, u.FirstName, u.LastName 
                                      FROM comments c 
                                      JOIN posts p ON c.post_id = p.id 
                                      JOIN users u ON c.user_id = u.id 
                                      ORDER BY c.date DESC LIMIT 6')->fetchAll(PDO::FETCH_ASSOC);

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
    <script src="../js/theme.js" type="module" defer></script>
    <script src="../js/sidebar.js" type="module" defer></script>
    <script src="../js/post.js" type="module" defer></script>
    <script src="../js/overview.js" type="module" defer></script>
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
                <div class="overview-content"> 
                    <div class="main-content">
                        <section class="overview-cards">   
                            <h3>Overview</h3>
                            <div class="overview-cards-wrapper">
                                <div class="overview-card">
                                    <div class="overview-card-header">
                                        <p class="text-button light-gray">Total posts</p>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.66 10.44L20.68 14.62C19.84 18.23 18.18 19.69 15.06 19.39C14.56 19.35 14.02 19.26 13.44 19.12L11.76 18.72C7.59 17.73 6.3 15.67 7.28 11.49L8.26 7.30001C8.46 6.45001 8.7 5.71001 9 5.10001C10.17 2.68001 12.16 2.03001 15.5 2.82001L17.17 3.21001C21.36 4.19001 22.64 6.26001 21.66 10.44Z" stroke="#4353FE" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.06 19.39C14.44 19.81 13.66 20.16 12.71 20.47L11.13 20.99C7.16001 22.27 5.07001 21.2 3.78001 17.23L2.50001 13.28C1.22001 9.31001 2.28001 7.21001 6.25001 5.93001L7.83001 5.41001C8.24001 5.28001 8.63001 5.17001 9.00001 5.10001C8.70001 5.71001 8.46001 6.45001 8.26001 7.30001L7.28001 11.49C6.30001 15.67 7.59001 17.73 11.76 18.72L13.44 19.12C14.02 19.26 14.56 19.35 15.06 19.39Z" stroke="#4353FE" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12.64 8.53L17.49 9.76" stroke="#4353FE" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M11.66 12.4L14.56 13.14" stroke="#4353FE" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <p class="overview-card-content"><span><?php echo $postsCount[0]['NumPosts'];?></span> posts</p>
                                </div>

                                <div class="overview-card">
                                    <div class="overview-card-header">
                                        <p class="text-button light-gray">Total likes</p>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.48001 18.35L10.58 20.75C10.98 21.15 11.88 21.35 12.48 21.35H16.28C17.48 21.35 18.78 20.45 19.08 19.25L21.48 11.95C21.98 10.55 21.08 9.35 19.58 9.35H15.58C14.98 9.35 14.48 8.85 14.58 8.15L15.08 4.95C15.28 4.05 14.68 3.05 13.78 2.75C12.98 2.45 11.98 2.85 11.58 3.45L7.48001 9.55" stroke="#1C9057" stroke-width="1.25" stroke-miterlimit="10"/>
                                            <path d="M2.38 18.35V8.54999C2.38 7.14999 2.98 6.64999 4.38 6.64999H5.38C6.78 6.64999 7.38 7.14999 7.38 8.54999V18.35C7.38 19.75 6.78 20.25 5.38 20.25H4.38C2.98 20.25 2.38 19.75 2.38 18.35Z" stroke="#1C9057" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

                                    </div>
                                    <p class="overview-card-content"><span><?php echo htmlspecialchars($likesCount[0]['NumLikes']); ?></span> likes</p>
                                </div>

                                <div class="overview-card">
                                    <div class="overview-card-header">
                                        <p class="text-button light-gray">Total views</p>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.58 12C15.58 13.98 13.98 15.58 12 15.58C10.02 15.58 8.41998 13.98 8.41998 12C8.41998 10.02 10.02 8.42001 12 8.42001C13.98 8.42001 15.58 10.02 15.58 12Z" stroke="#FEA843" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 20.27C15.53 20.27 18.82 18.19 21.11 14.59C22.01 13.18 22.01 10.81 21.11 9.4C18.82 5.8 15.53 3.72 12 3.72C8.47003 3.72 5.18003 5.8 2.89003 9.4C1.99003 10.81 1.99003 13.18 2.89003 14.59C5.18003 18.19 8.47003 20.27 12 20.27Z" stroke="#FEA843" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

                                    </div>
                                    <p class="overview-card-content"><span><?php echo htmlspecialchars($viewsCount[0]['NumViews']); ?></span> views</p>
                                </div>

                                <div class="overview-card">
                                    <div class="overview-card-header">
                                        <p class="text-button light-gray">Total users</p>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.16 10.87C9.06 10.86 8.94 10.86 8.83 10.87C6.45 10.79 4.56 8.84 4.56 6.44C4.56 3.99 6.54 2 9 2C11.45 2 13.44 3.99 13.44 6.44C13.43 8.84 11.54 10.79 9.16 10.87Z" stroke="#FE4343" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16.41 4C18.35 4 19.91 5.57 19.91 7.5C19.91 9.39 18.41 10.93 16.54 11C16.46 10.99 16.37 10.99 16.28 11" stroke="#FE4343" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M4.16 14.56C1.74 16.18 1.74 18.82 4.16 20.43C6.91 22.27 11.42 22.27 14.17 20.43C16.59 18.81 16.59 16.17 14.17 14.56C11.43 12.73 6.92 12.73 4.16 14.56Z" stroke="#FE4343" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18.34 20C19.06 19.85 19.74 19.56 20.3 19.13C21.86 17.96 21.86 16.03 20.3 14.86C19.75 14.44 19.08 14.16 18.37 14" stroke="#FE4343" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

                                    </div>
                                    <p class="overview-card-content"><span><?php echo $usersCount[0]['NumUsers'];?></span> users</p>
                                </div>
                            </div>
                        </section>

                        <section class="overview-posts">
                            <div class="overview-posts-header">
                                <h3>🔥Top posts <span>(<?= $topPostsCount; ?>)</span></h3>
                                <a href="./managePosts.php" class="see-more">
                                    <p class="text-caption1">See more</p>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.43 5.92999L20.5 12L14.43 18.07" stroke="#4353FE" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3.5 12H20.33" stroke="#4353FE" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>

                            <div class="posts-wrapper overview-posts-wrapper">
                                <?php foreach ($selectTopPosts as $post): ?>
                                <?php 
                                    $topPostId = $post['id'];
                                    $category = $post['category'];
                                ?>
                                <a class="post-wrapper" href="../post.php?post_id=<?= $topPostId; ?>?category=<?= $category; ?>">
                                    <div class="image-content-wrapper">
                                    <!-- post image -->
                                        <img src="../assets/hostedImages/<?php echo $post['image']?>" alt="post image">

                                        <div class="post-content">
                                            <p class="text-body1 text-md"><?php echo $post['title']?></p>

                                            <div class="post-category-date">
                                                <span class="chip1 category text-caption1">
                                                <?php 
                                                    echo array_search($post['category'], $categoryMapping) ?: htmlspecialchars($post['category']);
                                                ?>
                                                </span>
                                                <span class="divider"></span>
                                                <p class="text-button post-date">
                                                    <?php                                      
                                                        $postDate = $post['CreationDate'];
                                                        $dateTime = new DateTime($postDate);
                                                        echo $dateTime->format('M j, Y H:i');                             
                                                    ?>  
                                                    <span>
                                                        <?php
                                                            if ($post['UpdateDate'] && $post['UpdateDate'] != $post['CreationDate']) {
                                                                echo '<span>(Updated: ';
                                                                $updateDatetime = new DateTime($post['UpdateDate']);
                                                                echo $updateDatetime->format('M j, Y H:i');
                                                                echo ')</span>';
                                                            }
                                                        ?>
                                                    </span>
                                                </p>
                                            </div>

                                            <div class="post-intractions-wrapper">
                                                <div class="post-views-wrapper post-intraction-wrapper">
                                                    <img src="../assets/icons/show-pass.svg" alt="views">
                                                    <?php
                                                    if($post['total_views'] == 1){
                                                        echo '<span class="post-views text-button" name="post-views">' . $post['total_views'] . '</span>view';
                                                    } else {
                                                        echo '<span class="post-views text-button" name="post-views">' . $post['total_views'] . '</span>views';                                    }
                                                    ?>
                                                </div>

                                                <div class="post-likes-wrapper post-intraction-wrapper">
                                                    <img src="../assets/icons/like.svg" alt="likes">
                                                    <?php
                                                    if($post['total_likes'] == 1){
                                                        echo '<span class="post-likes text-button" name="post-likes">' . $post['total_likes'] . '</span>like';
                                                    } else {
                                                        echo '<span class="post-likes text-button" name="post-likes">' . $post['total_likes'] . '</span>likes';                                    }
                                                    ?>
                                                </div>

                                                <div class="post-comments-wrapper post-intraction-wrapper">
                                                    <img src="../assets/icons/comment.svg" alt="views">
                                                    <?php
                                                    if($post['total_comments'] == 1){
                                                        echo '<span class="post-comments text-button" name="post-comments">' . $post['total_comments'] . '</span>comment';
                                                    } else {
                                                        echo '<span class="post-comments text-button" name="post-comments">' . $post['total_comments'] . '</span>comments';                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                            </div>


                        </section>
                    </div>

                    <section class="overview-comments">
                        <div class="overview-comments-header">
                            <h3>Recent comments <span>(<?= count($selectLatestComments); ?>)</span></h3>
                            <a href="./comments.php" class="see-more">
                                <p class="text-caption1">See more</p>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.43 5.92999L20.5 12L14.43 18.07" stroke="#4353FE" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.5 12H20.33" stroke="#4353FE" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                        <div class="overview-comments-wrapper">
                            <?php foreach ($selectLatestComments as $comment): ?>
                            <div class="comment-wrapper overview-comment">
                                <a class="comment-body" href="../post.php?post_id=<?= $comment['post_id']; ?>#comments-section">
                                    <div class="comment-img">
                                    <img src="../assets/icons/user2.svg" alt="comment user image">
                                    </div>
                                    
                                    <div class="comment-content-wrapper">
                                    
                                    <div class="comment-header">
                                        <p class="text-body2"><?= $comment['FirstName'] . ' ' . $comment['LastName']; ?></p>
                                        <span class="bullet"></span>
                                        <p class="text-caption1 opacity-half">                        
                                            <?php                                      
                                                $commentDate = $comment['date'];
                                                $dateTime = new DateTime($commentDate);
                                                echo $dateTime->format('M j, Y H:i');                             
                                            ?>
                                        </p>
                                    </div>

                                    <div class="comment-content text-button"><?= $comment['comment']; ?></div>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach; ?>
                        </div>

                    </section>
                </div>

            </div>
        </main>
    </div>


</body>
</html>
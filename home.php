<?php
include 'components/emptyStateTemplate.php';
// Session start //
session_start();
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';
};

include 'interactions/likes.php';
// DB connection
require_once 'components/connect.php';

$emptyIllustration = "";

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
                                LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);

// Fetch latest posts sorted by creation date //
$selectLatestPosts = $conn->query('SELECT p.*, 
                                (SELECT COUNT(*) FROM likes WHERE post_id = p.id) AS total_likes,
                                (SELECT COUNT(*) FROM views WHERE post_id = p.id) AS total_views,
                                (SELECT COUNT(*) FROM comments WHERE post_id = p.id) AS total_comments
                                FROM posts p
                                ORDER BY CreationDate DESC')->fetchAll(PDO::FETCH_ASSOC);

// Check if no posts //
$postsCount = $conn->query('SELECT COUNT(id) AS NumPosts FROM posts')->fetch(PDO::FETCH_ASSOC);
$emptyIllustration = ($postsCount['NumPosts'] == 0) ? emptyStateTemplate("There are no posts to show :(") : "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voxworld | Discover world news here</title>
    <meta name="description" content="The only place you need to know what happen in the world right now!!">

    <!-- custom css links -->
    <link rel="shortcut icon" href="./assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">

    <!-- custom js -->
    <script src="./js/theme.js" type="module" defer></script>
    <script src="./js/toggleTheme.js" type="module" defer></script>
    <script src="./js/index.js" type="module" defer></script>
    <script src="./js/header.js" type="module" defer></script>


</head>
<body>
    <div class="container hidden">

        <!-- header -->
        <?php include './components/header.php'; ?>

        <section class="top-news">
            <h3>TOP NEWS</h3>
            <div class="cards-wrapper">
                <?php foreach ($selectTopPosts as $post): ?>
                <?php 
                    $topPostId = $post['id'];
                    $category = $post['category'];
                ?>
                <div class="card main-card">
                    <a href="post.php?post_id=<?= $topPostId; ?>?category=<?= $category; ?>">
                        <div class="post-img-wrapper">
                            <img src="assets/hostedImages/<?php echo htmlspecialchars($post['image']); ?>" alt="">
                        </div>

                        <div class="card-content">
                            <div class="post-category-date">
                                <span class="chip1 category text-caption1">
                                <?php 
                                    echo array_search($post['category'], $categoryMapping) ?: htmlspecialchars($post['category']);
                                ?>
                                </span>
                                <span class="divider"></span>
                                <p class="text-button post-date"><?php echo date('M j, Y H:i', strtotime($post['CreationDate'])); ?></p>
                            </div>

                            <h2 class="text-md home-post-title"><?php echo htmlspecialchars($post['title']); ?></h2>

                            <div class="divider horizontal"></div>

                            <div class="post-intractions-wrapper">
                                <div class="post-views-wrapper post-intraction-wrapper">
                                    <img src="./assets/icons/show-pass.svg" alt="views">
                                    <?php
                                    if($post['total_views'] == 1){
                                        echo '<span class="post-views" name="post-views">' . $post['total_views'] . '</span>view';
                                    } else {
                                        echo '<span class="post-views" name="post-views">' . $post['total_views'] . '</span>views';                                    }
                                    ?>
                                </div>
                                <div class="post-likes-wrapper post-intraction-wrapper">
                                    <img src="./assets/icons/like.svg" alt="likes">
                                    <?php
                                    if($post['total_likes'] == 1){
                                        echo '<span class="post-likes" name="post-likes">' . $post['total_likes'] . '</span>like';
                                    } else {
                                        echo '<span class="post-likes" name="post-likes">' . $post['total_likes'] . '</span>likes';                                    }
                                    ?>                               
                                </div>
                                <div class="post-comments-wrapper post-intraction-wrapper">
                                    <img src="./assets/icons/comment.svg" alt="comments">
                                    <?php
                                    if($post['total_comments'] == 1){
                                        echo '<span class="post-comments" name="post-comments">' . $post['total_comments'] . '</span>comment';
                                    } else {
                                        echo '<span class="post-comments" name="post-comments">' . $post['total_comments'] . '</span>comments';                                    }
                                    ?>  
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php echo $emptyIllustration?>
        </section>

        <section class="latest-news">
            <h3>LATEST NEWS</h3>
            <div class="cards-wrapper">
                <?php foreach ($selectLatestPosts as $post): ?>
                <?php 
                    $latestPostId = $post['id'];
                    $category = $post['category'];
                ?>
                <div class="card">
                    <a href="post.php?post_id=<?= $latestPostId; ?>?category=<?= $category; ?>">
                        <div class="post-img-wrapper">
                            <img src="assets/hostedImages/<?php echo htmlspecialchars($post['image']); ?>" alt="" class="post-img">
                        </div>
                        
                        <div class="card-content">
                            <div class="post-category-date">
                                <span class="chip1 category text-caption1">
                                <?php 
                                    echo array_search($post['category'], $categoryMapping) ?: htmlspecialchars($post['category']);
                                ?>
                                </span>
                                <span class="divider"></span>
                                <p class="text-caption1 post-date"><?php echo date('M j, Y H:i', strtotime($post['CreationDate'])); ?></p>
                            </div>
                            <h3 class="text-md home-post-title"><?php echo htmlspecialchars($post['title']); ?></h3>
                            <div class="divider horizontal"></div>
                            <div class="post-intractions-wrapper">
                                <div class="post-views-wrapper post-intraction-wrapper text-caption1">
                                    <img src="./assets/icons/show-pass.svg" alt="views">
                                    <?php
                                    if($post['total_views'] == 1){
                                        echo '<span class="post-views" name="post-views">' . $post['total_views'] . '</span>view';
                                    } else {
                                        echo '<span class="post-views" name="post-views">' . $post['total_views'] . '</span>views';                                    }
                                    ?>
                                </div>
                                <div class="post-likes-wrapper post-intraction-wrapper text-caption1">
                                    <img src="./assets/icons/like.svg" alt="likes">
                                    <?php
                                    if($post['total_likes'] == 1){
                                        echo '<span class="post-likes" name="post-likes">' . $post['total_likes'] . '</span>like';
                                    } else {
                                        echo '<span class="post-likes" name="post-likes">' . $post['total_likes'] . '</span>likes';                                    }
                                    ?>
                                </div>
                                <div class="post-comments-wrapper post-intraction-wrapper text-caption1">
                                    <img src="./assets/icons/comment.svg" alt="comments">    
                                    <?php
                                    if($post['total_comments'] == 1){
                                        echo '<span class="post-comments" name="post-comments">' . $post['total_comments'] . '</span>comment';
                                    } else {
                                        echo '<span class="post-comments" name="post-comments">' . $post['total_comments'] . '</span>comments';                                    }
                                    ?>      
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php echo $emptyIllustration?>
        </section>

        <!-- footer -->
        <?php include './components/footer.php'; ?>
        

    </div>
</body>
</html>

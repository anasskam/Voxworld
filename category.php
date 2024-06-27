<?php
include 'components/emptyStateTemplate.php';
// Session start //
session_start();
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    $userID = '';
}

if (isset($_GET['category'])) {
    $category = $_GET['category'];
} else {
    $category = '';
}

// Category mapping array //
$categoryMapping = [
    'politics' => 'Politics',
    'economy' => 'Economy',
    'society' => 'Society',
    'culture' => 'Culture',
    'scienceandtech' => 'Science & Tech',
    'business' => 'Business',
    'sports' => 'Sports',
    'entsandarts' => 'Ents & Arts',
    'mena' => 'Mena',
    'health' => 'Health',
    'international' => 'International'
];

// Use an if statement to get the readable category name //
if (isset($categoryMapping[$category])) {
    $displayCategory = $categoryMapping[$category];
} else {
    $displayCategory = 'Unknown Category';
}

// DB connection
require_once 'components/connect.php';


// Fetch latest posts sorted by creation date //
$selectLatestPosts = $conn->prepare('SELECT p.*, 
                                (SELECT COUNT(*) FROM likes WHERE id_post = p.id) AS total_likes,
                                (SELECT COUNT(*) FROM views WHERE id_post = p.id) AS total_views,
                                (SELECT COUNT(*) FROM comments WHERE id_post = p.id) AS total_comments
                                FROM posts p WHERE category = ?
                                ORDER BY CreationDate DESC');
$selectLatestPosts->execute([$category]);

// Check if no posts //
$postsCount = $conn->query('SELECT COUNT(id) AS NumPosts FROM posts')->fetch(PDO::FETCH_ASSOC);
$emptyIllustration = ($postsCount['NumPosts'] == 0) ? emptyStateTemplate("There are no posts to show :(") : "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    <div class="container">
        
        <!-- header -->
        <?php include './components/header.php'; ?>



        <section class="latest-news">
            <h3 style="text-transform:uppercase"><?php echo htmlspecialchars($displayCategory); ?></h3>
            <div class="cards-wrapper">
                <?php foreach ($selectLatestPosts as $post): ?>
                <div class="card">
                    <a href="#">
                        <img src="assets/hostedImages/<?php echo htmlspecialchars($post['image']); ?>" alt="" class="post-img">
                        <div class="card-content">
                            <div class="post-category-date">
                                <span class="chip1 category text-caption1"><?php echo htmlspecialchars($post['category']); ?></span>
                                <span class="divider"></span>
                                <p class="text-caption1 post-date">
                                    <?php echo date('M j, Y H:i', strtotime($post['CreationDate'])); ?>
                                    <?php if ($post['UpdateDate'] && $post['UpdateDate'] != $post['CreationDate']): ?>
                                        <span>(Updated: <?php echo date('M j, Y H:i', strtotime($post['UpdateDate'])); ?>)</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <h3 class="text-md home-post-title"><?php echo htmlspecialchars($post['title']); ?></h3>
                            <div class="divider horizontal"></div>
                            <div class="post-intractions-wrapper">
                                <div class="post-views-wrapper post-intraction-wrapper text-caption1">
                                    <img src="./assets/icons/show-pass.svg" alt="views">
                                    <span class="post-views" name="post-views"><?php echo htmlspecialchars($post['total_views']); ?> </span>views
                                </div>
                                <div class="post-likes-wrapper post-intraction-wrapper text-caption1">
                                    <img src="./assets/icons/like.svg" alt="likes">
                                    <span class="post-likes" name="post-likes"><?php echo htmlspecialchars($post['total_likes']); ?> </span>likes
                                </div>
                                <div class="post-comments-wrapper post-intraction-wrapper text-caption1">
                                    <img src="./assets/icons/comment.svg" alt="comments">          
                                    <span class="post-comments" name="post-comments"><?php echo htmlspecialchars($post['total_comments']); ?> </span>comments
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <?php echo $emptyIllustration; ?>
    </div>
</body>
</html>

<?php
include 'components/emptyStateTemplate.php';
// Session start //
session_start();
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    $userID = '';
}

// DB connection
require_once 'components/connect.php';

$emptyIllustration = "";

// Fetch top posts sorted by likes, views, and comments //
$selectTopPosts = $conn->query("SELECT p.*, 
                                (SELECT COUNT(*) FROM likes WHERE id_post = p.id) AS total_likes,
                                (SELECT COUNT(*) FROM views WHERE id_post = p.id) AS total_views,
                                (SELECT COUNT(*) FROM comments WHERE id_post = p.id) AS total_comments
                                FROM posts p
                                ORDER BY total_likes DESC, total_views DESC, total_comments DESC
                                LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);

// Fetch latest posts sorted by creation date //
$selectLatestPosts = $conn->query('SELECT p.*, 
                                (SELECT COUNT(*) FROM likes WHERE id_post = p.id) AS total_likes,
                                (SELECT COUNT(*) FROM views WHERE id_post = p.id) AS total_views,
                                (SELECT COUNT(*) FROM comments WHERE id_post = p.id) AS total_comments
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

        <section class="top-news">
            <h3>TOP NEWS</h3>
            <div class="cards-wrapper">
                <?php foreach ($selectTopPosts as $post): ?>
                <?php 
                    $topPostId = $post['id'];
                    $category = $post['category'];
                ?>
                <div class="card main-card">
                    <a href="post.php?postID=<?= $topPostId; ?>?category=<?= $category; ?>">
                        <img src="assets/hostedImages/<?php echo htmlspecialchars($post['image']); ?>" alt="">
                        <div class="card-content">
                            <div class="post-category-date">
                                <span class="chip1 category text-caption1"><?php echo htmlspecialchars($post['category']); ?></span>
                                <span class="divider"></span>
                                <p class="text-button post-date"><?php echo date('M j, Y H:i', strtotime($post['CreationDate'])); ?></p>
                            </div>

                            <h2 class="text-md home-post-title"><?php echo htmlspecialchars($post['title']); ?></h2>

                            <div class="divider horizontal"></div>

                            <div class="post-intractions-wrapper">
                                <div class="post-views-wrapper post-intraction-wrapper">
                                    <img src="./assets/icons/show-pass.svg" alt="views">
                                    <span class="post-views text-button" name="post-views"><?php echo htmlspecialchars($post['total_views']); ?> </span>views
                                </div>
                                <div class="post-likes-wrapper post-intraction-wrapper">
                                    <img src="./assets/icons/like.svg" alt="likes">
                                    <span class="post-likes text-button" name="post-likes"><?php echo htmlspecialchars($post['total_likes']); ?> </span>likes
                                </div>
                                <div class="post-comments-wrapper post-intraction-wrapper">
                                    <img src="./assets/icons/comment.svg" alt="comments">
                                    <span class="post-comments text-button" name="post-comments"><?php echo htmlspecialchars($post['total_comments']); ?> </span>comments
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
                    <a href="post.php?postID=<?= $latestPostId; ?>?category=<?= $category; ?>">
                        <img src="assets/hostedImages/<?php echo htmlspecialchars($post['image']); ?>" alt="" class="post-img">
                        <div class="card-content">
                            <div class="post-category-date">
                                <span class="chip1 category text-caption1"><?php echo htmlspecialchars($post['category']); ?></span>
                                <span class="divider"></span>
                                <p class="text-caption1 post-date"><?php echo date('M j, Y H:i', strtotime($post['CreationDate'])); ?></p>
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
            <?php echo $emptyIllustration?>
        </section>

        

        <footer>
            <div class="upper-fotter">
                <img alt="logo" class="logo home-logo">
                <nav>
                    <ul>
                        <li ><a href="./index.php">About us</a></li>
                        <li ><a href="#">Contact us</a></li>
                        <li ><a href="#">Privacy Policy</a></li>
                    </ul>
                </nav>

                <div class="social-media-wrapper">
                    Follow us on:

                    <div class="social-media-icons">
                        
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.969 10.1571L22.7069 0H20.6363L13.0491 8.81931L6.9893 0H0L9.16366 13.3364L0 23.9877H2.07073L10.083 14.6742L16.4826 23.9877H23.4719L13.9684 10.1571H13.969ZM11.1328 13.4538L10.2043 12.1258L2.81684 1.55881H5.99736L11.9592 10.0867L12.8876 11.4147L20.6373 22.4998H17.4567L11.1328 13.4544V13.4538Z" fill="currentcolor"/>
                        </svg>

                        <svg width="25" height="20" viewBox="0 0 25 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.8559 19.7791C19.1779 20.0071 19.5929 20.0641 19.9629 19.9241C20.3329 19.7831 20.6049 19.4671 20.6869 19.0841C21.5559 15.0001 23.6639 4.66315 24.4549 0.948148C24.5149 0.668148 24.4149 0.377148 24.1949 0.190148C23.9749 0.00314829 23.6699 -0.0508518 23.3979 0.0501482C19.2049 1.60215 6.29188 6.44715 1.01388 8.40015C0.678879 8.52415 0.460879 8.84615 0.471879 9.19915C0.483879 9.55315 0.721879 9.86015 1.06488 9.96315C3.43188 10.6711 6.53888 11.6561 6.53888 11.6561C6.53888 11.6561 7.99088 16.0411 8.74788 18.2711C8.84288 18.5511 9.06188 18.7711 9.35088 18.8471C9.63888 18.9221 9.94688 18.8431 10.1619 18.6401C11.3779 17.4921 13.2579 15.7171 13.2579 15.7171C13.2579 15.7171 16.8299 18.3361 18.8559 19.7791ZM7.84588 11.1021L9.52488 16.6401L9.89788 13.1331C9.89788 13.1331 16.3849 7.28215 20.0829 3.94715C20.1909 3.84915 20.2059 3.68515 20.1159 3.57015C20.0269 3.45515 19.8629 3.42815 19.7399 3.50615C15.4539 6.24315 7.84588 11.1021 7.84588 11.1021Z" fill="currentcolor"/>
                        </svg>

                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.4738 0C9.21405 0 8.80389 0.0136719 7.5246 0.0722656C6.5293 0.0924949 5.54463 0.281371 4.61249 0.630859C3.81132 0.930393 3.08585 1.40248 2.48749 2.01367C1.87685 2.61325 1.40371 3.33829 1.10077 4.13867C0.751144 5.07138 0.562907 6.05682 0.544128 7.05273C0.487488 8.33203 0.471863 8.74023 0.471863 12C0.471863 15.2598 0.485535 15.666 0.544128 16.9473C0.564358 17.9426 0.753233 18.9272 1.10272 19.8594C1.40373 20.6598 1.87563 21.385 2.48553 21.9844C3.0846 22.5956 3.80979 23.0689 4.61053 23.3711C5.5435 23.7198 6.52879 23.908 7.5246 23.9277C8.80389 23.9863 9.2121 24 12.4719 24C15.7316 24 16.1379 23.9863 17.4191 23.9277C18.4149 23.908 19.4002 23.7198 20.3332 23.3711C21.1313 23.0615 21.8561 22.589 22.4614 21.9837C23.0667 21.3784 23.5393 20.6536 23.8488 19.8555C24.1964 18.9228 24.3852 17.9385 24.4074 16.9434C24.4641 15.6641 24.4797 15.2559 24.4797 11.9961C24.4797 8.73633 24.4641 8.32813 24.4074 7.04883C24.3852 6.0531 24.1964 5.06811 23.8488 4.13477C23.5473 3.33411 23.0748 2.6089 22.464 2.00977C21.8661 1.39813 21.1405 0.92597 20.3391 0.626953C19.4035 0.277932 18.4155 0.0903683 17.4172 0.0722656C16.1359 0.0136719 15.7297 0 12.4699 0H12.4738ZM11.3957 2.16211H12.4738C15.6769 2.16211 16.0558 2.17383 17.3215 2.23242C18.0824 2.24108 18.8363 2.38048 19.55 2.64453C20.0711 2.83703 20.5423 3.14406 20.9289 3.54297C21.327 3.93024 21.6339 4.40126 21.8273 4.92188C22.0914 5.63561 22.2308 6.38943 22.2394 7.15039C22.298 8.41406 22.3098 8.79492 22.3098 11.998C22.3098 15.2012 22.298 15.5801 22.2394 16.8457C22.231 17.6061 22.0916 18.3593 21.8273 19.0723C21.6274 19.5894 21.3215 20.059 20.9293 20.4508C20.5371 20.8427 20.0673 21.1482 19.55 21.3477C18.8367 21.6137 18.0827 21.7538 17.3215 21.7617C16.0578 21.8203 15.6769 21.832 12.4738 21.832C9.27069 21.832 8.88983 21.8203 7.62421 21.7617C6.86313 21.7524 6.10931 21.6124 5.39569 21.3477C4.87409 21.156 4.40219 20.8496 4.01483 20.4512C3.61663 20.0644 3.31027 19.5932 3.11835 19.0723C2.85363 18.3586 2.71357 17.6048 2.70428 16.8437C2.64764 15.5781 2.63593 15.1992 2.63593 11.9941C2.63593 8.78906 2.64764 8.41211 2.70428 7.14648C2.7124 6.38529 2.8525 5.63127 3.11835 4.91797C3.31027 4.39706 3.61663 3.92586 4.01483 3.53906C4.4025 3.14052 4.87426 2.83358 5.39569 2.64063C6.10954 2.37673 6.86321 2.2367 7.62421 2.22656C8.73163 2.17773 9.15936 2.16211 11.3957 2.16016V2.16211ZM18.8781 4.1543C18.5929 4.1543 18.3142 4.23888 18.0771 4.39735C17.84 4.55582 17.6553 4.78106 17.5462 5.04455C17.4372 5.30805 17.4088 5.59797 17.4645 5.87763C17.5203 6.15729 17.6578 6.41412 17.8596 6.61562C18.0614 6.81713 18.3184 6.95425 18.5981 7.00965C18.8778 7.06505 19.1677 7.03622 19.4311 6.92683C19.6944 6.81743 19.9194 6.63238 20.0775 6.39508C20.2357 6.15779 20.3199 5.87892 20.3195 5.59375C20.3195 5.40455 20.2822 5.21721 20.2098 5.04244C20.1373 4.86767 20.0311 4.7089 19.8972 4.57521C19.7633 4.44152 19.6044 4.33553 19.4296 4.26331C19.2547 4.19108 19.0673 4.15404 18.8781 4.1543ZM12.4738 5.83789C11.2551 5.83789 10.0637 6.19929 9.05033 6.87639C8.03698 7.55349 7.24716 8.51588 6.78077 9.64186C6.31437 10.7678 6.19234 12.0068 6.43011 13.2022C6.66788 14.3975 7.25476 15.4955 8.11655 16.3573C8.97833 17.2191 10.0763 17.8059 11.2716 18.0437C12.467 18.2815 13.706 18.1594 14.832 17.693C15.9579 17.2267 16.9203 16.4368 17.5974 15.4235C18.2745 14.4101 18.6359 13.2187 18.6359 12C18.6354 10.3659 17.986 8.79881 16.8305 7.6433C15.675 6.4878 14.108 5.83841 12.4738 5.83789ZM12.4738 8C13.2652 7.99884 14.0391 8.23245 14.6977 8.67127C15.3563 9.11009 15.8699 9.7344 16.1735 10.4652C16.4772 11.196 16.5572 12.0005 16.4035 12.7768C16.2499 13.5531 15.8694 14.2664 15.3102 14.8263C14.751 15.3863 14.0383 15.7679 13.2622 15.9227C12.4861 16.0775 11.6815 15.9987 10.9503 15.6961C10.2191 15.3935 9.59399 14.8808 9.15421 14.2229C8.71442 13.565 8.47968 12.7914 8.47968 12C8.48174 10.9415 8.90328 9.92698 9.65193 9.17869C10.4006 8.4304 11.4153 8.00936 12.4738 8.00781V8Z" fill="currentcolor"/>
                        </svg>

                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.79725 12.7824H9.42804V23.6129C9.42804 23.8267 9.6013 24 9.81514 24H14.2757C14.4896 24 14.6628 23.8267 14.6628 23.6129V12.8334H17.6871C17.8838 12.8334 18.0492 12.6859 18.0717 12.4905L18.531 8.50328C18.5436 8.39357 18.5089 8.28372 18.4355 8.20142C18.362 8.11905 18.2569 8.0719 18.1465 8.0719H14.663V5.57249C14.663 4.81904 15.0687 4.43698 15.8689 4.43698C15.9829 4.43698 18.1465 4.43698 18.1465 4.43698C18.3604 4.43698 18.5336 4.26364 18.5336 4.04988V0.389961C18.5336 0.176129 18.3604 0.00286452 18.1465 0.00286452H15.0076C14.9854 0.00178065 14.9363 0 14.8638 0C14.3192 0 12.426 0.106916 10.9306 1.48266C9.27367 3.0072 9.50399 4.83259 9.55903 5.14908V8.07182H6.79725C6.58342 8.07182 6.41016 8.24508 6.41016 8.45892V12.3952C6.41016 12.6091 6.58342 12.7824 6.79725 12.7824Z" fill="currentcolor"/>
                        </svg>

                    </div>

                </div>
            </div>

            <div class="copyright">
                © Copyright, 2024 All rights reserved to Voxworld 
            </div>

        </footer>

    </div>
</body>
</html>

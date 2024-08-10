<?php
// Session start //
session_start();
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    $userID = '';
}

if (isset($_GET['postID'])) {
  $getID = $_GET['postID'];
} else {
  $getID = '';
}

include 'interactions/likes.php';

// DB connection
require_once 'components/connect.php';
// $posts = $conn->prepare('SELECT p.*, 
//                                 COUNT(l.id) AS total_likes,
//                                 COUNT(v.id) AS total_views
//                                 FROM posts p
//                                 LEFT JOIN likes l ON p.id = l.id_post
//                                 LEFT JOIN views v ON p.id = v.id_post
//                                 WHERE p.id = ?
//                                 GROUP BY p.id');
// $posts->execute([$getID]);
// $post = $posts->fetch(PDO::FETCH_ASSOC);
$posts = $conn->prepare('SELECT * FROM posts WHERE id = ?');
$posts->execute([$getID]);
// $confirmLikes = $conn->prepare('SELECT * FROM likes WHERE id_user = ? AND id_post = ?');
// $confirmLikes->execute([$userID, $getID]);

// $likesCount = $conn->prepare('SELECT COUNT(id) AS likesCount FROM likes WHERE id_post = ?');
// $likesCount->execute([$getID]);
// $totalLikes = $likesCount->rowCount();

// $likes = $conn->query('SELECT p.*, 
//                                 (SELECT COUNT(*) FROM likes WHERE id_post = p.id) AS total_likes,
//                                 (SELECT COUNT(*) FROM views WHERE id_post = p.id) AS total_views,
//                                 (SELECT COUNT(*) FROM comments WHERE id_post = p.id) AS total_comments
//                                 FROM posts p
//                                 ORDER BY CreationDate DESC')->fetchAll(PDO::FETCH_ASSOC);
// $posts = $conn->query('SELECT p.*, 
//                               (SELECT COUNT(*) FROM likes WHERE id_post = p.id) AS total_likes,
//                               (SELECT COUNT(*) FROM views WHERE id_post = p.id) AS total_views,
//                               (SELECT COUNT(*) FROM comments WHERE id_post = p.id) AS total_comments
//                               FROM posts p
//                               ORDER BY CreationDate DESC')->fetchAll(PDO::FETCH_ASSOC);

// $getPost = $conn->prepare('SELECT * FROM posts WHERE id = ?');
// $getPost->execute([$getID]);
// $post = $getPost->fetch(PDO::FETCH_ASSOC);

// // Fetch likes, views, comments for the specific post
// $post['total_likes'] = $conn->query('SELECT COUNT(*) FROM likes WHERE id_post = ' . $post['id'])->fetchColumn();
// $post['total_views'] = $conn->query('SELECT COUNT(*) FROM views WHERE id_post = ' . $post['id'])->fetchColumn();
// $post['total_comments'] = $conn->query('SELECT COUNT(*) FROM comments WHERE id_post = ' . $post['id'])->fetchColumn();

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
    <script src="./js/post.js" type="module" defer></script>
    <script src="./js/header.js" type="module" defer></script>

</head>
<body>
    <div class="container">

        <!-- header -->
        <?php include './components/header.php'; ?>

        <div class="container">
        <?php foreach ($posts as $post): ?>
          <div class="post-page-wrapper">
            <header class="post-header">
              <div class="post-category-date">
                <span class="chip1 category text-button"><?php echo htmlspecialchars($post['category']); ?></span>
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

            <h1 class="text-md home-post-title"><?php echo htmlspecialchars($post['title']); ?></h1>
          </header>

          <img src="assets/hostedImages/<?php echo htmlspecialchars($post['image']); ?>" alt="post image" class="post-img">

          <main class="post-content"><?php echo ($post['content']); ?></main>

          <div class="post-intractions-wrapper">
              
              <a href="./interactions/views.php" class="post-views-wrapper post-intraction-wrapper text-body2">
                <img src="./assets/icons/show-pass.svg" alt="views">
                <span class="post-views" name="post-views">10</span>views
              </a>

              <form method="post">
             
                <a name="like" class="post-likes-wrapper post-intraction-wrapper text-body2">
                  <img src="./assets/icons/like.svg" alt="likes">
                  <span class="post-likes" name="post-likes">6</span>likes
                </a>
              </form>
          </div>

            <div class="write-comment-wrapper">
              <h3>Write a comment</h3>
              <form method="POST">
                <div class="write-comment-input input-field">
                  <!-- edit icon -->
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.26 3.6L5.05 12.29C4.74 12.62 4.44 13.27 4.38 13.72L4.01 16.96C3.88 18.13 4.72 18.93 5.88 18.73L9.1 18.18C9.55 18.1 10.18 17.77 10.49 17.43L18.7 8.74C20.12 7.24 20.76 5.53 18.55 3.44C16.35 1.37 14.68 2.1 13.26 3.6Z" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.89 5.04999C12.32 7.80999 14.56 9.91999 17.34 10.2" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3 22H21" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                  <textarea name="write-comment" id="write-comment" rows="4" placeholder="Write your comment"></textarea>

                </div>

                <input type="submit" class="primary-btn" value="Publish">
              </form>

            </div>

            <section class="comments-section-wrapper">
              <h3>Comments (<span>8</span>)</h3>

              <div class="comments-wrapper">

                <div class="comment-wrapper">
                  
                  <div class="comment-img">
                    <img src="./assets/icons/user2.svg" alt="comment user image">
                  </div>

                  <div class="comment-content-wrapper">
                    
                    <div class="comment-header">
                      <p class="text-body2">Anas karmoua</p>
                      <span class="bullet"></span>
                      <p class="text-caption1 opacity-half">Mar 20, 2024 23:14</p>
                    </div>

                    <div class="comment-content text-button">
                      For athletes, high altitude produces two contradictory effects on performance. For explosive events,Physiological respiration involves the mechanisms that ensure that the composition of the functional,Physical space is often conceived in three linear dimensions, although modern physicists usually con
                    </div>
                  </div>

                </div>


              </div>

            </section>

          </div>
        <?php endforeach; ?>
        </div>

        <!-- footer -->
        <?php include './components/footer.php'; ?>
        

    </div>
</body>
</html>

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


// DB connection
require_once 'components/connect.php';

$posts = $conn->prepare('SELECT * FROM posts WHERE id = ?');
$posts->execute([$getID]);


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

        <div class="container">
        <?php foreach ($posts as $post): ?>
          <header class="post-header">
            <div class="post-category-date">
              <span class="chip1 category text-caption1"><?php echo htmlspecialchars($post['category']); ?></span>
              <span class="divider"></span>
              <p class="text-caption1 post-date">
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

          <div class="post-content"><?php echo ($post['content']); ?></div>
        <?php endforeach; ?>
        </div>

    </div>
</body>
</html>

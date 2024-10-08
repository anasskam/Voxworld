<?php

// DB connection
require_once 'components/connect.php';
// Session start //
session_start();

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';
};

include 'interactions/likes.php';
include 'interactions/views.php';
include 'interactions/bookmarksLogic.php';

$get_id = $_GET['post_id'];

$select_title = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
$select_title->execute([$get_id]);
// Default title in case no post found //
$title = 'Title'; 

if ($select_title->rowCount() > 0) {
    $fetch_title = $select_title->fetch(PDO::FETCH_ASSOC);
    $title = isset($fetch_title['title']) ? htmlspecialchars($fetch_title['title']) : $title;
}

if(isset($_POST['add_comment'])){


  $fname = $_POST['fname'];
  $fname = filter_var($fname, FILTER_SANITIZE_STRING);
  $lname = $_POST['lname'];
  $lname = filter_var($lname, FILTER_SANITIZE_STRING);
  $comment = $_POST['comment'];
  $comment = filter_var($comment, FILTER_SANITIZE_STRING);

  $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ? AND user_id = ? AND FirstName = ? AND LastName = ? AND comment = ?");

  $verify_comment->execute([$get_id, $user_id, $fname, $lname, $comment]);

  if($verify_comment->rowCount() > 0){
    $message[] = 'comment already added!';
  }else{
     $insert_comment = $conn->prepare("INSERT INTO `comments`(post_id, user_id, FirstName, LastName, comment) VALUES(?,?,?,?,?)");
     $insert_comment->execute([$get_id, $user_id, $fname, $lname, $comment]);
     if (empty($_SERVER['HTTPS'])) {
      $protocol = 'http';
      } else {
          $protocol = 'https';
      }
      
      $actual_link = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/#comments-section";
       header("Location: $actual_link"); 
  }

}
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

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?= $title; ?></title>

      <!-- custom css links -->
      <link rel="shortcut icon" href="./assets/images/favicon32.png" type="image/x-icon">
      <link rel="stylesheet" href="./css/style.css">

      <!-- custom js -->
      <script src="./js/theme.js" type="module" defer></script>
      <script src="./js/toggleTheme.js" type="module" defer></script>
      <script src="./js/post.js" type="module" defer></script>
      <script src="./js/header.js" type="module" defer></script>
      <script src="./js/share.js" type="module" defer></script>

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  </head>
  <body>
      <div class="container hidden">

          <!-- header -->
          <?php include './components/header.php'; ?>

          <div class="post-page-wrapper">
            <?php
              $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
              $select_posts->execute([$get_id]);
              if($select_posts->rowCount() > 0){
                  while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
                    
                  $post_id = $fetch_posts['id'];

                  $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
                  $count_post_comments->execute([$post_id]);
                  $total_post_comments = $count_post_comments->rowCount(); 

                  $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
                  $count_post_likes->execute([$post_id]);
                  $total_post_likes = $count_post_likes->rowCount();

                  $confirm_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND post_id = ?");
                  $confirm_likes->execute([$user_id, $post_id]);

                  $confirm_bookmarks = $conn->prepare("SELECT * FROM `bookmarks` WHERE user_id = ? AND post_id = ?");
                  $confirm_bookmarks->execute([$user_id, $post_id]);
            ?>
            <form method="post">
              <input type="hidden" name="post_id" value="<?= $post_id; ?>">
              <header class="post-header">
                <div class="post-category-date">
                  <span class="chip1 category text-button">
                  <?php 
                      echo array_search($fetch_posts['category'], $categoryMapping) ?: htmlspecialchars($fetch_posts['category']);
                  ?>
                  </span>
                  <span class="divider"></span>
                  <p class="text-button post-date">
                  <?php                                      
                    $postDate = $fetch_posts['CreationDate'];
                    $dateTime = new DateTime($postDate);
                    echo $dateTime->format('M j, Y H:i');                             
                  ?>  
                  <span>
                    <?php
                        if ($fetch_posts['UpdateDate'] && $fetch_posts['UpdateDate'] != $fetch_posts['CreationDate']) {
                            echo '<span>(Updated: ';
                            $updateDatetime = new DateTime($fetch_posts['UpdateDate']);
                            echo $updateDatetime->format('M j, Y H:i');
                            echo ')</span>';
                        }
                    ?>
                  </span>
                  </p>
                </div>

                <h1 class="text-md home-post-title"><?= $fetch_posts['title']; ?></h1>
              </header>
              <?php
                if($fetch_posts['image'] != ''){  
              ?>
              <img src="assets/hostedImages/<?= $fetch_posts['image']; ?>" alt="post image" class="post-img">
              <?php
              }
              ?>

              <main class="post-content"><?= $fetch_posts['content']; ?></main>

              <div class="post-intractions-wrapper space-between">

                  <div class="views-likes-wrapper">
                    <a class="intraction-widget post-views-wrapper post-intraction-wrapper text-body2">
                      <img src="./assets/icons/show-pass.svg" alt="views">
                      <span class="post-views" name="post-views"> <?php echo $total_views ?></span>
                      <p><?php echo ($total_views == 1)? "view": "views" ?></p>
                    </a>

                    <button id="likes-section" name="like_post" class="intraction-widget post-likes-wrapper post-intraction-wrapper text-body2">
                    
                    <?php 
                      if($confirm_likes->rowCount() > 0){
                          echo '<img src="./assets/icons/like_filled.svg" alt="likes">';
                      } else {
                        echo '<img src="./assets/icons/like.svg" alt="likes">';
                      }
                    ?>
                    <span class="post-likes" name="post-likes"><?php echo $total_post_likes ?></span>
                    <p><?php echo ($total_post_likes == 1)? "like": "likes" ?></p>
  
                    </button>

                    <button id="share-button" class="intraction-widget post-likes-wrapper post-intraction-wrapper text-body2">
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.0601 10.9399C15.3101 13.1899 15.3101 16.8299 13.0601 19.0699C10.8101 21.3099 7.17009 21.3199 4.93009 19.0699C2.69009 16.8199 2.68009 13.1799 4.93009 10.9399" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.59 13.4099C8.24996 11.0699 8.24996 7.26988 10.59 4.91988C12.93 2.56988 16.73 2.57988 19.08 4.91988C21.43 7.25988 21.42 11.0599 19.08 13.4099" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <p>Share</p>
                    </button>

                  </div>

                  <button id="bookmarks-section" name="bookmark_post" class="intraction-widget post-bookmarks-wrapper text-body2 ghost-btn transparent">
                  <?php if($confirm_bookmarks->rowCount() > 0){
                      echo '<img src="./assets/icons/bookmark_filled.svg" alt="bookmark icon">';
                      } else {
                        echo '<img src="./assets/icons/bookmark.svg" alt="bookmark icon">';
                      }
                    ?>
                    <p>Read later</p>
                    
                  </button>
                  
              </div>
            </form>
            <?php
                }
              }else{
                echo '<p>no posts found!</p>';
              }
            ?>
            <div class="write-comment-wrapper">
              <h3>Write a comment</h3>
              <?php
                if($user_id != ''){  
                  $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                  $select_profile->execute([$user_id]);
                  $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
              ?>
                  <form method="POST">
                    <input type="hidden" name="fname" value="<?= $fetch_profile['FirstName']; ?>">
                    <input type="hidden" name="lname" value="<?= $fetch_profile['LastName']; ?>">
                    <div class="write-comment-input input-field">
                      <!-- edit icon -->
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.26 3.6L5.05 12.29C4.74 12.62 4.44 13.27 4.38 13.72L4.01 16.96C3.88 18.13 4.72 18.93 5.88 18.73L9.1 18.18C9.55 18.1 10.18 17.77 10.49 17.43L18.7 8.74C20.12 7.24 20.76 5.53 18.55 3.44C16.35 1.37 14.68 2.1 13.26 3.6Z" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.89 5.04999C12.32 7.80999 14.56 9.91999 17.34 10.2" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3 22H21" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>

                      <textarea name="comment" id="write-comment" rows="4" placeholder="Write your comment"></textarea>

                    </div>

                    <input type="submit" class="primary-btn" value="Publish" name="add_comment">
                  </form>
                  <?php
                    }else{
                  ?>
                    <div class="add-comment">
                      <div class= "empty"> 
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M12 8V13" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M11.9945 16H12.0035" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                          <p>Please <a href="auth/login.php" style="text-decoration:underline">login</a> to add your comment</p>
                      </div>
                    </div>
                  <?php
                    }
                  ?>
            </div>

            <section class="comments-section-wrapper" id="comments-section"> 
              <h3>Comments (<span><?= $total_post_comments; ?></span>)</h3>

              <div class="comments-wrapper">
              <?php
                $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
                $select_comments->execute([$get_id]);
                if($select_comments->rowCount() > 0){
                    while($fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC)){
              ?>

                <div class="comment-wrapper">
                  
                  <div class="comment-img">
                    <p class="text-caption1"></p>
                  </div>

                  <div class="comment-content-wrapper">
                    
                    <div class="comment-header">
                      <p class="text-body2 commentator"><?= $fetch_comments['FirstName'] . ' ' . $fetch_comments['LastName']; ?></p>
                      <span class="bullet"></span>
                      <p class="text-caption1 opacity-half">
                        <?php                                      
                          $commentDate = $fetch_comments['date'];
                          $dateTime = new DateTime($commentDate);
                          echo $dateTime->format('M j, Y H:i');                             
                        ?>
                      </p>
                    </div>

                    <div class="comment-content text-button"><?= $fetch_comments['comment']; ?></div>
                  </div>

                </div>

                <?php
                  }
                }
                  else{
                    echo '
                    <div class= "empty"> 
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 8V13" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.9945 16H12.0035" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>

                      <p>No comments added yet!</p>
                    <div>';
                  }
                ?>


              </div>

            </section>

          </div>

          <!-- footer -->
          <?php include './components/footer.php'; ?>
          

      </div>
  </body>
</html>
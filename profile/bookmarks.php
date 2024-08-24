<?php
// DB connection
require_once '../components/connect.php';
include '../components/emptyStateTemplate.php';

// Session start //
session_start();

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';
};
include '../interactions/bookmarkUndo.php';

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

$selectBookmarked = $conn->prepare("SELECT posts.* FROM posts
                                    INNER JOIN bookmarks ON posts.id = bookmarks.post_id
                                    WHERE bookmarks.user_id = ?") ;
$selectBookmarked->execute([$user_id]);
$bookmarkedPosts = $selectBookmarked->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile | Bookmarks</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">

    <!-- custom js -->
    <script src="../js/theme.js" type="module" defer></script>
    <script src="../js/toggleTheme.js" type="module" defer></script>
    <script src="../js/userSideBar.js" type="module" defer></script>
    <script src="../js/manageUsers.js" type="module" defer></script>
    <!-- <script src="../js/overview.js" type="module" defer></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

  <div class="dashboard-container">
    <!-- side bar --> 
    <?php
        include "../components/userSideBar.php"
    ?>

    <main>
      <!-- header bar -->
      <?php
          include "../components/profile-header.php"
      ?>

      <div class="content-container">
        <header>
          <h3>Bookmarks</h3>
        </header>
        
        <div class="cards-wrapper">
            <?php
              if (empty($bookmarkedPosts)) {
                $emptyIllustration = emptyStateTemplate("There are no bookmarks to show :(");
              } else {
                foreach ($bookmarkedPosts as $post) {              
            ?>
            <?php 
              $post_id = $post['id'];
              $category = $post['category'];
             ?>
              <div class="card">
                <!-- <a href="#"> -->
                  <div class="post-img-wrapper">

                    <img src="../assets/hostedImages/<?php echo htmlspecialchars($post['image']); ?>" alt="" class="post-img">

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
                    <form method="post">
                    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']); ?>">
                      <div class="post-intractions-wrapper">
                        <a href="../post.php?post_id=<?= $post_id; ?>?category=<?= $category; ?>" class="post-likes-wrapper post-intraction-wrapper text-caption1">

                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 11L21.2 2.79999" stroke="#FEA843" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 6.8V2H17.2" stroke="#FEA843" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13" stroke="#FEA843" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>

                          Preview
                        </a>

                        <button name="unbookmark_post" class="post-likes-wrapper post-intraction-wrapper text-caption1 transparent">
                          <img src="../assets/icons/bookmark_filled.svg" alt="bookmark icon">
                          Read later
                        </button>

                      </div>

                    </form>

                  </div>

                <!-- </a> -->

              </div>
            <?php
              }
            }
            ?>
          
        </div>
          
        <?php echo $emptyIllustration?>
      </div>

    </main>

  </div>

</body>
</html>
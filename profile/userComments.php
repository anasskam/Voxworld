<?php
// DB connection //
require_once '../components/connect.php';
include '../components/emptyStateTemplate.php';

// Session start //
session_start();

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';
};

// Comment deletion //
if (isset($_POST['comment-delete'])) {
  $comment_id = $_POST['comment-delete'];
  $delete_comment = $conn->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
  $delete_comment->execute([$comment_id, $user_id]);
  ?>
    <script defer>
        setTimeout(()=> {
            swal("Success", "Comment deleted successfully", "success", {
                buttons: false,
                timer: 2500,
            }).then(()=> {
                window.location.href = "./userComments.php";
            })
        }, 500)
    </script>
  <?php
}

// Show user's comments //
$selectComments = $conn->prepare("SELECT * FROM comments WHERE user_id = ?");
$selectComments->execute([$user_id]);
$comments = $selectComments->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile | Comments</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">

    <!-- custom js -->
    <script src="../js/theme.js" type="module" defer></script>
    <script src="../js/toggleTheme.js" type="module" defer></script>
    <script src="../js/userSideBar.js" type="module" defer></script>
    <script src="../js/profileGeneral.js" type="module" defer></script>
    <script src="../js/post.js" type="module" defer></script>
    <script src="../js/manageUsers.js" type="module" defer></script>
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
          <h3>Comments <span>(<?php echo count($comments); ?>)</span></h3>
          <div class="comments-wrapper">
          <?php
            if (empty($comments)) {
              $emptyIllustration = emptyStateTemplate("No comments found :(");

            } else {
                foreach ($comments as $comment) {
          ?>
            <div class="comment-wrapper manage-comment">
                
              <div class="comment-body">
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
              </div>

              <div class="comments-actions">
                <form method="POST">
                  <a class="ghost-btn preview-btn" type="submit" name="comment-preview" href="../post.php?post_id=<?= $comment['post_id']; ?>#comments-section">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M13 11L21.2 2.79999" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M22 6.8V2H17.2" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Show comment
                  </a>

                  <button class="ghost-btn delete-btn" type="submit" name="comment-delete" value="<?php echo $comment['id']; ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M21 5.98001C17.67 5.65001 14.32 5.48001 10.98 5.48001C9 5.48001 7.02 5.58001 5.04 5.78001L3 5.98001" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.78999C5.99999 22 5.90999 20.78 5.79999 19.21L5.14999 9.14001" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M10.33 16.5H13.66" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M9.5 12.5H14.5" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Delete
                  </button>
                </form>
              </div>

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
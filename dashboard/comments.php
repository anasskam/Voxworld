<?php
session_start();
// Session Test //
include '../components/session-check.php';
include '../components/emptyStateTemplate.php';
$adminId = checkAdminSession();

// DB Connection //
require_once '../components/connect.php';
$LatestComments = $conn->query('SELECT * FROM comments ORDER BY date DESC')->fetchAll(PDO::FETCH_ASSOC);
$commentsCount = $conn->query('SELECT COUNT(id) AS NumComments FROM comments')->fetchAll(PDO::FETCH_ASSOC);
$emptyIllustration = "";

// Empty table check //
if (count($LatestComments) == 0) {
    $emptyIllustration = emptyStateTemplate("There are no comments to show :(");
}
else {
    $emptyIllustration = "";
}



// Delete Post //
if (isset($_POST['comment-delete'])) {

    $commentID = $_POST['comment-delete'];

    // Prepare and execute the query //
    $commentDelete = $conn->prepare('DELETE FROM comments WHERE id = ?');
    $commentDelete->execute([$commentID]);

    if ($commentDelete) {
        ?>
        <script defer>
            setTimeout(()=> {
                swal("Success", "Comment deleted successfully", "success", {
                    buttons: false,
                    timer: 2500,
                }).then(()=> {
                    window.location.href = "./comments.php";
                })
            }, 500)
        </script>
      <?php
    }
    else {
        echo 'Error deleting comment';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Manage comments</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">

    <!-- custom js -->
    <script src="../js/theme.js" type="module" defer></script>
    <script src="../js/sidebar.js" type="module" defer></script>
    <script src="../js/post.js" type="module" defer></script>
    <script src="../js/manageUsers.js" defer type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
                <header class="dashboard-content-header">

                    <p class="text-body1">Comments <span>(<?php echo $commentsCount[0]['NumComments'];?>)</span></p>
                    <form method="POST" action="commentSearch">
                        <div class="search-bar-wrapper">
                            <div class="input-field">
                            <!-- search icon -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
                                <path d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 22L20 20" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <input type="text" placeholder="Search for comments..." name="search-bar">
                            <button class="ghost-btn" type="submit" name="search-btn">Search</button>
                            
                            </div>
                        </div>
                    </form>
                </header>
                <div class="comments-wrapper">
                    <?php
                        foreach ($LatestComments as $comment) {
                            $CommentId = $comment['id'];
                    ?>

                    <div class="comment-wrapper manage-comment">
                        
                        <div class="comment-body">
                            <div class="comment-img">
                                <p class="text-caption1"></p>
                            </div>
                            
                            <div class="comment-content-wrapper">
                            
                            <div class="comment-header">
                                <p class="text-body2 commentator"><?php echo $comment['FirstName'] . ' ' . $comment['LastName'];?></p>
                                <span class="bullet"></span>
                                <p class="text-caption1 opacity-half">
                                    <?php                                      
                                        $commentDate = $comment['date'];
                                        $dateTime = new DateTime($commentDate);
                                        echo $dateTime->format('M j, Y H:i');                             
                                    ?>
                                </p>
                            </div>

                            <div class="comment-content text-button"><?php echo $comment['comment'];?></div>
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

                                    <button class="ghost-btn delete-btn" type="submit" name="comment-delete" value="<?php echo $comment['id']; ?>" onclick="return confirm('Are you sure you want to delete this comment')">
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
                        echo $emptyIllustration;
                    ?>

                </div>
            </div>
        </main>
    </div>
</body>
</html>
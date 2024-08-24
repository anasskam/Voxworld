<?php
session_start();
// Session Test //
include '../components/session-check.php';
include '../components/emptyStateTemplate.php';
$adminId = checkAdminSession();

// DB Connection //
require_once '../components/connect.php';

if(isset($_POST['search-btn']) or isset($_POST['search-bar'])){

    $search_bar = $_POST['search-bar'];

    // Fetch searched posts //
    $selectLatestPosts = $conn->query("SELECT p.*, 
    (SELECT COUNT(*) FROM likes WHERE post_id = p.id) AS total_likes,
    (SELECT COUNT(*) FROM views WHERE post_id = p.id) AS total_views,
    (SELECT COUNT(*) FROM comments WHERE post_id = p.id) AS total_comments
    FROM posts p WHERE title LIKE '%{$search_bar}%' 
                OR content LIKE '%{$search_bar}%' 
                or category LIKE '%{$search_bar}%'")->fetchAll(PDO::FETCH_ASSOC);

    // Check if no posts //
    $postsCount = $conn->query('SELECT COUNT(id) AS NumPosts FROM posts')->fetchAll(PDO::FETCH_ASSOC);

}

// Delete Post //
if (isset($_POST['post-delete'])) {

    $postID = $_POST['post-delete'];

    // Prepare and execute the query //
    $postDelete = $conn->prepare('DELETE FROM posts WHERE id = ?');
    $postDelete->execute([$postID]);

    // remove likes related to deleted posts //
    $likeDelete = $conn->prepare('DELETE FROM likes WHERE post_id = ?');
    $likeDelete->execute([$postID]);

    // remove views related to deleted posts //
    $viewsDelete = $conn->prepare('DELETE FROM views WHERE post_id = ?');
    $viewsDelete->execute([$postID]);
    
    if ($postDelete) {
        ?>
        <script defer>
            setTimeout(()=> {
                swal("Success", "Post deleted successfully", "success", {
                    buttons: false,
                    timer:2500,
                }).then(()=> {
                    window.location.href = "./managePosts.php";
                })
            }, 500)
        </script>
        <?php
    }
    else {
        echo 'Error deleting post';
    }
}

// Redirect to edit page //
if (isset($_POST['post-edit'])) {
    $postID = $_POST['post-edit'];
    $_SESSION['post_id'] = $postID;
    header('Location: editPost.php');
    exit;
}


$emptyIllustration = "";

// Empty table check //
if (count($selectLatestPosts) == 0) {
    $emptyIllustration = emptyStateTemplate("No posts found :(");
}
else {
    $emptyIllustration = "";
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

    <title>Dashboard | Manage Posts</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">

    <!-- custom js -->
    <script src="../js/theme.js" type="module" defer></script>
    <script src="../js/sidebar.js" type="module" defer></script>
    <script src="../js/manageUsers.js" type="module" defer></script>
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
                    <p class="text-body1">
                        Manage posts(<?php echo count($selectLatestPosts);?>)
                    </p>
                    <form method="POST">
                        <div class="search-bar-wrapper">
                            <div class="input-field">
                            <!-- search icon -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
                                <path d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 22L20 20" stroke="currentcolor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                            <input type="text" placeholder="Search for posts..." name="search-bar">
                            <button class="ghost-btn" type="submit" name="search-btn">Search</button>
                            
                            </div>
                        </div>
                    </form>
                </header>
            
                <div class="posts-wrapper">
                    <?php
                        foreach ($selectLatestPosts as $post) {
                            $PostId = $post['id'];
                            $category = $post['category'];
                       
                            ?>
                            <div class="post-wrapper">

                                <div class="image-content-wrapper">
                                <!-- post image -->
                                            <img src="../assets/hostedImages/<?php echo $post['image']?>" alt="post image">

                                            <div class="post-content">
                                                <p class="text-body1 text-md" value><?php echo $post['title']?></p>

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
                                <div class="post-actions">
                                    <form method="POST">
                                        <input type="hidden" name="id-post" value="<?php echo $post['id']?>">

                                        <button class="ghost-btn" type="submit" name="post-edit" value="<?php echo $post['id']; ?>">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.26 3.6L5.05 12.29C4.74 12.62 4.44 13.27 4.38 13.72L4.01 16.96C3.88 18.13 4.72 18.93 5.88 18.73L9.1 18.18C9.55 18.1 10.18 17.77 10.49 17.43L18.7 8.74C20.12 7.24 20.76 5.53 18.55 3.44C16.35 1.37 14.68 2.1 13.26 3.6Z" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M11.89 5.04999C12.32 7.80999 14.56 9.91999 17.34 10.2" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M3 22H21" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Edit
                                        </button>

                                        <button class="ghost-btn delete-btn" type="submit" name="post-delete" value="<?php echo $post['id']?>" onclick="return confirm('Are you sure you want to delete this post')">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 5.98001C17.67 5.65001 14.32 5.48001 10.98 5.48001C9 5.48001 7.02 5.58001 5.04 5.78001L3 5.98001" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M18.85 9.14001L18.2 19.21C18.09 20.78 18 22 15.21 22H8.78999C5.99999 22 5.90999 20.78 5.79999 19.21L5.14999 9.14001" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M10.33 16.5H13.66" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.5 12.5H14.5" stroke="currentcolor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Delete
                                        </button>

                                        <a class="ghost-btn preview-btn" type="submit" name="post-preview" href="../post.php?post_id=<?= $PostId; ?>?category=<?= $category; ?>">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13 11L21.2 2.79999" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M22 6.8V2H17.2" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Preview
                                        </a>

                                    </form>
                                </div>
                                
                            </div>
                            <?php
                        }
                    ?>
                    <?php echo $emptyIllustration?>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
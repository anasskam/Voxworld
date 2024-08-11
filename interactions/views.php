<?php
// DB connection //
require_once 'components/connect.php';

if (!isset($_SESSION['viewed_posts'])) {
    $_SESSION['viewed_posts'] = array();
}

$get_id = $_GET['post_id'];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = ''; 
}

// Generate a session ID for guests //
$session_id = session_id();

// Determine if we use session tracking or user tracking //
if ($user_id === '') {
    // Track views for guests //
    if (!in_array($get_id, $_SESSION['viewed_posts'])) {
        // Increment view count //
        $update_views = $conn->prepare("UPDATE `posts` SET views = views + 1 WHERE id = ?");
        $update_views->execute([$get_id]);

        // Add the post ID to the session array //
        $_SESSION['viewed_posts'][] = $get_id;
    }
} else {
    // Track views for logged users //
    $check_view = $conn->prepare("SELECT * FROM `views` WHERE post_id = ? AND user_id = ?");
    $check_view->execute([$get_id, $user_id]);

    if ($check_view->rowCount() == 0) {
        // Increment //
        $update_views = $conn->prepare("UPDATE `posts` SET views = views + 1 WHERE id = ?");
        $update_views->execute([$get_id]);

        // Insert a new view //
        $insert_view = $conn->prepare("INSERT INTO `views` (post_id, user_id, session_id) VALUES (?, ?, ?)");
        $insert_view->execute([$get_id, $user_id, $session_id]);
    }
}
$count_views = $conn->prepare("SELECT COUNT(*) FROM `views` WHERE post_id = ?");
$count_views->execute([$get_id]);
$total_views = $count_views->fetchColumn();
?>
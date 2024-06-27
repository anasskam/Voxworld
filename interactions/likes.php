<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    $userID = '';
}

if (isset($_POST['like'])) {
    if ($userID != '') {
        // Define base path
        define('BASE_PATH', dirname(__DIR__)); // Set base path to the parent directory of the current directory

        // Database connection
        require_once BASE_PATH . '/components/connect.php';

        $postID = $_POST['id_post'];

        $selectLikes = $conn->prepare('SELECT * FROM likes WHERE id_post = ? AND id_user = ?');
        $selectLikes->execute([$postID, $userID]);

        if ($selectLikes->rowCount() > 0) {
            $removeLikes = $conn->prepare('DELETE FROM likes WHERE id_user = ? AND id_post = ?');
            $removeLikes->execute([$userID, $postID]);
            echo "unliked";
        } else {
            $addLikes = $conn->prepare('INSERT INTO likes (id_user, id_post) VALUES (?, ?)');
            $addLikes->execute([$userID, $postID]);
            echo "liked";
        }
    } else {
        echo "no";
    }
}
?>

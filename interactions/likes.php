<?php
if(isset($POST['like'])){

    if ($userID != ''){
        $postID = $POST['id_post'];

        $selectLikes = $conn->prepare('SELECT * FROM likes WHERE id_post = ? AND id_user = ?');
        $selectLikes->execute([$postID, $userID]);

        if ($selectLikes->rowCount() > 0){
            $removeLikes = $conn->prepare('DELETE FROM likes WHERE id_user = ? AND id_post = ?');
            $removeLikes->execute([$userID, $postID]);
            echo "unliked";
        }
        else {
            $addLikes = $conn->prepare('INSERT INTO likes (id_user, id_post) VALUES (?,?)');
            $addLikes->execute([$userID, $postID]);
            echo "liked";
        }
    }
    else {
        echo "Not logged in";
    }
}





?>
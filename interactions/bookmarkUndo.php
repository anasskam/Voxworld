<?php
// DB connection
require_once '../components/connect.php'; 
if(isset($_POST['unbookmark_post'])){

   if($user_id != ''){
      
      $post_id = $_POST['post_id'];
      $post_id = filter_var($post_id, FILTER_SANITIZE_STRING);
      
      $select_post_bookmark = $conn->prepare("SELECT * FROM `bookmarks` WHERE post_id = ? AND user_id = ?");
      $select_post_bookmark->execute([$post_id, $user_id]);

      if($select_post_bookmark->rowCount() > 0){
         $remove_bookmark = $conn->prepare("DELETE FROM `bookmarks` WHERE post_id = ? AND user_id = ?");
         $remove_bookmark->execute([$post_id, $user_id]);
         header("Location: bookmarks.php");
         exit; // Ensure the script stops execution after redirection
      }
   }
}

?>

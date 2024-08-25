<?php
// DB connection
require_once 'components/connect.php'; 
if(isset($_POST['bookmark_post'])){

   if($user_id != ''){
      
      $post_id = $_POST['post_id'];
      $post_id = filter_var($post_id, FILTER_SANITIZE_STRING);
      
      $select_post_bookmark = $conn->prepare("SELECT * FROM `bookmarks` WHERE post_id = ? AND user_id = ?");
      $select_post_bookmark->execute([$post_id, $user_id]);

      if($select_post_bookmark->rowCount() > 0){
         $remove_bookmark = $conn->prepare("DELETE FROM `bookmarks` WHERE post_id = ? AND user_id = ?");
         $remove_bookmark->execute([$post_id, $user_id]);
      }else{
         $add_bookmark = $conn->prepare("INSERT INTO `bookmarks`(user_id, post_id) VALUES(?,?)");
         $add_bookmark->execute([$user_id, $post_id]);
      }
      header("Location: post.php?post_id=$post_id#likes-section");
   }else{
      ?>
        <script defer>
            setTimeout(()=> {
                swal("Oops!", "Please Log in to save content", "warning", {
                    buttons: {
                        redirect: {
                            text: "Log in",
                            className:"swal-gotoBtn",
                        }
                    },
                }).then((value)=>{
                    if(value === "redirect") {
                        window.location.href = "./auth/login.php";
                    }
                })
            }, 500)
        </script>
      <?php
   }

}

?>

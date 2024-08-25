<?php
// DB connection
require_once 'components/connect.php'; 
if(isset($_POST['like_post'])){

   if($user_id != ''){
      
      $post_id = $_POST['post_id'];
      $post_id = filter_var($post_id, FILTER_SANITIZE_STRING);
      
      $select_post_like = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ? AND user_id = ?");
      $select_post_like->execute([$post_id, $user_id]);

      if($select_post_like->rowCount() > 0){
         $remove_like = $conn->prepare("DELETE FROM `likes` WHERE post_id = ? AND user_id = ?");
         $remove_like->execute([$post_id, $user_id]);
      }else{
         $add_like = $conn->prepare("INSERT INTO `likes`(user_id, post_id) VALUES(?,?)");
         $add_like->execute([$user_id, $post_id]);
      }
      header("Location: post.php?post_id=$post_id#likes-section");
   }else{
      ?>
      <script defer>
          setTimeout(()=> {
              swal("Oops!", "Please sign in to show your appreciation", "warning", {
                  buttons: {
                      redirect: {
                          text: "Sign in",
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

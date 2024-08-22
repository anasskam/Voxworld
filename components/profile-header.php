<?php
// Initialize username variable //
$username = '';

// Check if user_id is set in session //
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Prepare the statement //
    $checkUser = $conn->prepare('SELECT * FROM users WHERE id = ?');
    $checkUser->execute([$user_id]);
    $user = $checkUser->fetch(PDO::FETCH_ASSOC);

    // Check if a user was found //
    if ($user) {
        $username = $user['FirstName'] . ' ' . $user['LastName'];
    }
}
?>
<header class="dashboard-header">
  <h3>Hi, <?php echo htmlspecialchars($username);?></h3>
  <?php 
    include 'themeToggle.php'
  ?>

  <script>
    document.addEventListener("DOMContentLoaded", ()=>{
      document.querySelector(".dashboard-header").style.height = 
      `${document.querySelector(".side-bar-header").getBoundingClientRect().height +1}px`
    })
  </script>

</header>
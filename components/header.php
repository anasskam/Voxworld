<?php

// DB connection //
require_once 'connect.php';

$userID = '';
$username = '';

// Check if userID is set in session //
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];

    // Prepare the statement //
    $checkUser = $conn->prepare('SELECT FirstName, LastName FROM users WHERE id = ?');
    $checkUser->execute([$userID]);
    $user = $checkUser->fetch(PDO::FETCH_ASSOC);

    // Check if a user was found //
    if ($user) {
        $username = $user['FirstName'] . ' '. $user['LastName'];
    } else {
        $username = 'Guest';
    }
}

?>

<header class="main-header">
  <div class="upper-header">
    <a href="./index.php"><img alt="logo" class="logo home-logo"></a>
    
    <?php 
      if($userID){
          echo '
            <div class="profile-dropDown">
              <div class="profile-name">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.1601 10.8705C12.0601 10.8605 11.9401 10.8605 11.8301 10.8705C9.45006 10.7905 7.56006 8.84049 7.56006 6.44049C7.56006 3.99049 9.54006 2.00049 12.0001 2.00049C14.4501 2.00049 16.4401 3.99049 16.4401 6.44049C16.4301 8.84049 14.5401 10.7905 12.1601 10.8705Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M7.16021 14.5595C4.74021 16.1795 4.74021 18.8195 7.16021 20.4295C9.91021 22.2695 14.4202 22.2695 17.1702 20.4295C19.5902 18.8095 19.5902 16.1695 17.1702 14.5595C14.4302 12.7295 9.92021 12.7295 7.16021 14.5595Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                '. htmlspecialchars($username) . '
              </div>';
              include "themeToggle.php";
              echo '<a href="components/logoutUser.php">Log out</a></div>';
      }
      else {
        echo '
        <div class="upper-header-actions">';
          include "themeToggle.php";
          echo '
            <div class="auth-buttons">
              <a class="ghost-btn" href="./pages/login.php">Log in</a>
              <a class="primary-btn" href="./pages/register.php">Sign up</a>
            </div>
          </div>';

      }
    ?>
    
  </div>

  <nav>
    <ul>
      <li data-relation="index"><a href="./index.php">Home</a></li>
      <li data-relation="politics"><a href="./category.php?category=politics">Politics</a></li>
      <li data-relation="economy"><a href="./category.php?category=economy">Economy</a></li>
      <li data-relation="society"><a href="./category.php?category=society">Society</a></li>
      <li data-relation="culture"><a href="./category.php?category=culture">Culture</a></li>
      <li data-relation="scienceTech"><a href="./category.php?category=scienceandtech">Science & Tech</a></li>
      <li data-relation="business"><a href="./category.php?category=business">Business</a></li>
      <li data-relation="sports"><a href="./category.php?category=sports">Sports</a></li>
      <li data-relation="entsArts"><a href="./category.php?category=entsandarts">Ents & Arts</a></li>
      <li data-relation="mena"><a href="./category.php?category=mena">Mena</a></li>
      <li data-relation="health"><a href="./category.php?category=health">Health</a></li>
      <li data-relation="international"><a href="./category.php?category=international">International</a></li>
    </ul>
  </nav>
</header>

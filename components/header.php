<?php

// DB connection //
require_once 'connect.php';

$user_id = '';
$username = '';

// Check if user_id is set in session //
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Prepare the statement //
    $checkUser = $conn->prepare('SELECT FirstName, LastName FROM users WHERE id = ?');
    $checkUser->execute([$user_id]);
    $user = $checkUser->fetch(PDO::FETCH_ASSOC);

    // Check if a user was found //
    if ($user) {
        $username = $user['FirstName'] . ' ' . $user['LastName'];
    } else {
        $username = 'Guest';
    }
}

?>

<header class="main-header">
  <div class="upper-header">
    <a href="./home.php"><img alt="logo" class="logo home-logo"></a>

    <!-- search bar -->
    <?php 
    include 'searchBar.php'
    ?>

    <script src="./js/weather.js" type="module" defer></script>
    <script src="./js/respo.js" type="module" defer></script>

    <div class="profile-weather-wrapper">
      <!-- <div class="weather-wrapper">
        <div class="weather-status">
          <p class="status text-caption1"></p>
          <h3 class="temp"></h3>
        </div>
        <span class="divider"></span>
        <div class="weather-location">
          <p class="weather-date text-caption1"></p>
          <div class="location">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 13.4299C13.7231 13.4299 15.12 12.0331 15.12 10.3099C15.12 8.58681 13.7231 7.18994 12 7.18994C10.2769 7.18994 8.88 8.58681 8.88 10.3099C8.88 12.0331 10.2769 13.4299 12 13.4299Z" stroke="currentcolor" stroke-width="1.25"/>
              <path d="M3.62001 8.49C5.59001 -0.169998 18.42 -0.159997 20.38 8.5C21.53 13.58 18.37 17.88 15.6 20.54C13.59 22.48 10.41 22.48 8.39001 20.54C5.63001 17.88 2.47001 13.57 3.62001 8.49Z" stroke="currentcolor" stroke-width="1.25"/>
            </svg>
            <span class="text-caption1"></span>
          </div>

        </div>
      </div> -->
    </div>

    <div class="upper-header-actions">
      <?php include "themeToggle.php"; 
      
      if($user_id){
        echo '
          <a class="profile-btn" href="./profile/general.php">
              <div class="profile-name">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.1601 10.8705C12.0601 10.8605 11.9401 10.8605 11.8301 10.8705C9.45006 10.7905 7.56006 8.84049 7.56006 6.44049C7.56006 3.99049 9.54006 2.00049 12.0001 2.00049C14.4501 2.00049 16.4401 3.99049 16.4401 6.44049C16.4301 8.84049 14.5401 10.7905 12.1601 10.8705Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M7.16021 14.5595C4.74021 16.1795 4.74021 18.8195 7.16021 20.4295C9.91021 22.2695 14.4202 22.2695 17.1702 20.4295C19.5902 18.8095 19.5902 16.1695 17.1702 14.5595C14.4302 12.7295 9.92021 12.7295 7.16021 14.5595Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                '. htmlspecialchars($username) . '
              </div> 
          </a>';
      }

      else {
          echo '
            <div class="auth-buttons">
              <a class="ghost-btn" href="./pages/login.php">Log in</a>
              <a class="primary-btn" href="./pages/register.php">Sign up</a>
            </div>';
      }
      ?>

    </div>

    <!-- menu icon -->
    <button class="menu-btn hide" data-state="close">
      <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 12.1865H28" stroke="currentcolor" stroke-width="2" stroke-linecap="round"/>
        <path d="M4 19.8135H28" stroke="currentcolor" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </button>

  </div>

  <nav>
    <ul>
      <li data-relation="index"><a href="./home.php">Home</a></li>
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

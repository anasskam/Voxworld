<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bookmarks</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">

    <!-- custom js -->
    <script src="../js/theme.js" type="module" defer></script>
    <script src="../js/toggleTheme.js" type="module" defer></script>
    <script src="../js/userSideBar.js" type="module" defer></script>
    <!-- <script src="../js/overview.js" type="module" defer></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

  <div class="dashboard-container">
    <!-- side bar --> 
    <?php
        include "../components/userSideBar.php"
    ?>

    <main>
      <!-- header bar -->
      <?php
          include "../components/profile-header.php"
      ?>

      <div class="content-container">
        <header>
          <h3>Bookmarks</h3>
        </header>
        
          <div class="cards-wrapper">
            
            <div class="card">
              <a href="#">
                <img src="../assets/images/test.jpg" alt="" class="post-img">
                <div class="card-content">
                  <div class="post-category-date">
                    <span class="chip1 category text-caption1">Health</span>
                    <span class="divider"></span>
                    <p class="text-caption1 post-date">May 8, 2024 19:28</p>
                  </div>

                  <h3 class="text-md home-post-title">Japan bread recalled after 'rat remains' found inside loaves</h3>
                  <div class="divider horizontal"></div>
                  <form method="post">
                    <div class="post-intractions-wrapper">
                      <a class="post-likes-wrapper post-intraction-wrapper text-caption1">

                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M13 11L21.2 2.79999" stroke="#FEA843" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M22 6.8V2H17.2" stroke="#FEA843" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13" stroke="#FEA843" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        
                        Preview
                      </a>

                      <button class="post-likes-wrapper post-intraction-wrapper text-caption1 transparent">
                        <img src="../assets/icons/bookmark_filled.svg" alt="bookmark icon">
                        Read later
                      </button>

                    </div>

                  </form>

                </div>

              </a>

            </div>

        </div>

      </div>

    </main>

  </div>

</body>
</html>
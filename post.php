<?php
// Session start //
session_start();
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    $userID = '';
}

// DB connection
require_once 'components/connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="./assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">

    <!-- custom js -->
    <script src="./js/theme.js" type="module" defer></script>
    <script src="./js/toggleTheme.js" type="module" defer></script>
    <script src="./js/post.js" type="module" defer></script>
    <script src="./js/header.js" type="module" defer></script>

</head>
<body>
    <div class="container">

        <!-- header -->
        <?php include './components/header.php'; ?>

        <div class="container">
          <div class="post-page-wrapper">
            <header class="post-header">
              <div class="post-category-date">
                <span class="chip1 category text-button">Politics</span>
                <span class="divider"></span>
                <p class="text-button post-date">Feb 2, 2024 19:28</p>
              </div>

              <h1 class="text-md home-post-title">Stormy Daniels Parries Trump Lawyer’s Attacks in Hush-Money Trial Testimony.</h1>
            </header>

            <img src="./assets/images/test.jpg" alt="post image" class="post-img">

            <main class="post-content">
              Donald J. Trump, the onetime president, and Stormy Daniels, the longtime porn star, despise one another. But when Ms. Daniels returned to the witness stand at Mr. Trump’s criminal trial on Thursday, his lawyers made them sound a lot alike.
              He wrote more than a dozen self-aggrandizing books; she wrote a tell-all memoir. He mocked her appearance on social media; she fired back with a scatological insult. He peddled a $59.99 Bible; she hawked a $40 “Stormy, saint of indictments” candle, that carried her image draped in a Christ-like robe.

              During Thursday’s grueling cross-examination, Mr. Trump’s lawyers sought to discredit Ms. Daniels as a money-grubbing extortionist who used a passing proximity to Mr. Trump to attain fame and riches. But the more the defense assailed her self-promoting merchandise and online screeds, the more Ms. Daniels resembled the man she was testifying against: a master of marketing, a savant of social-media scorn.
              “Not unlike Mr. Trump,” she said on the stand, though unlike him, she did it without the power and platform of the presidency.

              Ms. Daniels’s appearance plunged the proceeding into turmoil as the defense pleaded with the judge to declare a mistrial in the first criminal trial of an American president. Ms. Daniels’s graphic account of a sexual encounter with Mr. Trump, they argued, had inflicted irreparable damage on the defense.
              But the judge, Juan M. Merchan, rejected the request and rebuked defense lawyers, noting that their decision to deny that the tryst had even occurred had opened the door for much of her explicit testimony. Ms. Daniels offered jurors a first-person account of the encounter with Mr. Trump, helping prosecutors bolster belief in an incident that underpins the case.
            </main>

            <div class="post-intractions-wrapper">
              
              <a href="./interactions/views.php" class="post-views-wrapper post-intraction-wrapper text-body2">
                <img src="./assets/icons/show-pass.svg" alt="views">
                <span class="post-views" name="post-views">10</span>views
              </a>

              <a href="./interactions/likes.php" class="post-likes-wrapper post-intraction-wrapper text-body2">
                <img src="./assets/icons/like.svg" alt="likes">
                <span class="post-likes" name="post-likes">10</span>likes
              </a>
            </div>

            <div class="write-comment-wrapper">
              <h3>Write a comment</h3>
              <form method="POST">
                <div class="write-comment-input input-field">
                  <!-- edit icon -->
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.26 3.6L5.05 12.29C4.74 12.62 4.44 13.27 4.38 13.72L4.01 16.96C3.88 18.13 4.72 18.93 5.88 18.73L9.1 18.18C9.55 18.1 10.18 17.77 10.49 17.43L18.7 8.74C20.12 7.24 20.76 5.53 18.55 3.44C16.35 1.37 14.68 2.1 13.26 3.6Z" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.89 5.04999C12.32 7.80999 14.56 9.91999 17.34 10.2" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3 22H21" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                  <textarea name="write-comment" id="write-comment" rows="4" placeholder="Write your comment"></textarea>

                </div>

                <input type="submit" class="primary-btn" value="Publish">
              </form>

            </div>

            <section class="comments-section-wrapper">
              <h3>Comments (<span>8</span>)</h3>

              <div class="comments-wrapper">

                <div class="comment-wrapper">
                  
                  <div class="comment-img">
                    <img src="./assets/icons/user2.svg" alt="comment user image">
                  </div>

                  <div class="comment-content-wrapper">
                    
                    <div class="comment-header">
                      <p class="text-body2">Anas karmoua</p>
                      <span class="bullet"></span>
                      <p class="text-caption1 opacity-half">Mar 20, 2024 23:14</p>
                    </div>

                    <div class="comment-content text-button">
                      For athletes, high altitude produces two contradictory effects on performance. For explosive events,Physiological respiration involves the mechanisms that ensure that the composition of the functional,Physical space is often conceived in three linear dimensions, although modern physicists usually con
                    </div>
                  </div>

                </div>


              </div>

            </section>

          </div>
        </div>

        <!-- footer -->
        <?php include './components/footer.php'; ?>
        

    </div>
</body>
</html>

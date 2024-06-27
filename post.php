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
    <script src="./js/index.js" type="module" defer></script>
    <script src="./js/header.js" type="module" defer></script>

</head>
<body>
    <div class="container">

        <!-- header -->
        <?php include './components/header.php'; ?>

        <div class="container">
          <header class="post-header">
            <div class="post-category-date">
              <span class="chip1 category text-caption1">Politics</span>
              <span class="divider"></span>
              <p class="text-caption1 post-date">Feb 2, 2024 19:28</p>
            </div>

            <h1 class="text-md home-post-title">Stormy Daniels Parries Trump Lawyer’s Attacks in Hush-Money Trial Testimony.</h1>
          </header>

          <img src="./assets/images/test.jpg" alt="post image" class="post-img">

          <div class="post-content">
            Donald J. Trump, the onetime president, and Stormy Daniels, the longtime porn star, despise one another. But when Ms. Daniels returned to the witness stand at Mr. Trump’s criminal trial on Thursday, his lawyers made them sound a lot alike.
            He wrote more than a dozen self-aggrandizing books; she wrote a tell-all memoir. He mocked her appearance on social media; she fired back with a scatological insult. He peddled a $59.99 Bible; she hawked a $40 “Stormy, saint of indictments” candle, that carried her image draped in a Christ-like robe.

            During Thursday’s grueling cross-examination, Mr. Trump’s lawyers sought to discredit Ms. Daniels as a money-grubbing extortionist who used a passing proximity to Mr. Trump to attain fame and riches. But the more the defense assailed her self-promoting merchandise and online screeds, the more Ms. Daniels resembled the man she was testifying against: a master of marketing, a savant of social-media scorn.
            “Not unlike Mr. Trump,” she said on the stand, though unlike him, she did it without the power and platform of the presidency.

            Ms. Daniels’s appearance plunged the proceeding into turmoil as the defense pleaded with the judge to declare a mistrial in the first criminal trial of an American president. Ms. Daniels’s graphic account of a sexual encounter with Mr. Trump, they argued, had inflicted irreparable damage on the defense.
            But the judge, Juan M. Merchan, rejected the request and rebuked defense lawyers, noting that their decision to deny that the tryst had even occurred had opened the door for much of her explicit testimony. Ms. Daniels offered jurors a first-person account of the encounter with Mr. Trump, helping prosecutors bolster belief in an incident that underpins the case.
          </div>
        </div>

    </div>
</body>
</html>

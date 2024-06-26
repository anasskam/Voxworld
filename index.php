<?php
session_start();
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
    <script src="./js/index.js" defer></script>

</head>
<body>

    <div class="container">
        
        <!-- header -->
        <?php 
            include './components/header.php'
        ?>

        <section class="top-news">
            <h3>TOP NEWS</h3>

            <div class="cards-wrapper">

                <div class="card main-card">

                    <a href="#">
                        <img src="./assets/images/test.jpg" alt="">
                        <div class="card-content">
                            <div class="post-category-date">
                                <span class="chip1 category text-caption1">Politics</span>
                                <span class="divider"></span>
                                <p class="text-button post-date">Feb 2, 2024 19:28</p>
                            </div>

                            <h2 class="text-md home-post-title">Stormy Daniels Parries Trump Lawyer’s Attacks in Hush-Money Trial Testimony there is nothing to add here here err test.</h2>

                            <div class="divider horizontal"></div>

                            <div class="post-intractions-wrapper">
                                <div class="post-views-wrapper post-intraction-wrapper">
                                    <img src="./assets/icons/show-pass.svg" alt="views">
                                    <span class="post-views text-button" name="post-views">2,423 </span>views
                                </div>

                                <div class="post-likes-wrapper post-intraction-wrapper">
                                    <img src="./assets/icons/like.svg" alt="likes">
                                    <span class="post-likes text-button" name="post-likes">215 </span>likes
                                </div>

                                <div class="post-comments-wrapper post-intraction-wrapper">
                                    <img src="./assets/icons/comment.svg" alt="views">
                                    <span class="post-comments text-button" name="post-comments">6 </span>comments
                                </div>
                            </div>
                        </div>
                    </a>
                    
                </div>

                <div class="tow-cards">

                    <!-- first card -->
                    <div class="card first-card">
                        <a href="#">
                            <img src="./assets/images/test.jpg" alt="">
                            <div class="card-content">
                                <div class="post-category-date">
                                    <span class="chip1 category text-caption1">Politics</span>
                                    <span class="divider"></span>
                                    <p class="text-button post-date">Feb 2, 2024 19:28</p>
                                </div>

                                <h2 class="text-md home-post-title">Stormy Daniels Parries Trump Lawyer’s Attacks in Hush-Money Trial Testimony.</h2>
                                
                                <div class="divider horizontal"></div>

                                <div class="post-intractions-wrapper">
                                    <div class="post-views-wrapper post-intraction-wrapper">
                                        <img src="./assets/icons/show-pass.svg" alt="views">
                                        <span class="post-views text-button" name="post-views">2,423 </span>views
                                    </div>

                                    <div class="post-likes-wrapper post-intraction-wrapper">
                                        <img src="./assets/icons/like.svg" alt="likes">
                                        <span class="post-likes text-button" name="post-likes">215 </span>likes
                                    </div>

                                    <div class="post-comments-wrapper post-intraction-wrapper">
                                        <img src="./assets/icons/comment.svg" alt="views">
                                        <span class="post-comments text-button" name="post-comments">6 </span>comments
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- second card -->
                    <div class="card second-card">
                        <a href="#">
                            <img src="./assets/images/test.jpg" alt="">
                            <div class="card-content">
                                <div class="post-category-date">
                                    <span class="chip1 category text-caption1">Politics</span>
                                    <span class="divider"></span>
                                    <p class="text-button post-date">Feb 2, 2024 19:28</p>
                                </div>

                                <h2 class="text-md home-post-title">Stormy Daniels Parries Trump Lawyer’s Attacks in Hush-Money Trial Testimony.</h2>

                                <div class="divider horizontal"></div>

                                <div class="post-intractions-wrapper">
                                    <div class="post-views-wrapper post-intraction-wrapper">
                                        <img src="./assets/icons/show-pass.svg" alt="views">
                                        <span class="post-views text-button" name="post-views">2,423 </span>views
                                    </div>

                                    <div class="post-likes-wrapper post-intraction-wrapper">
                                        <img src="./assets/icons/like.svg" alt="likes">
                                        <span class="post-likes text-button" name="post-likes">215 </span>likes
                                    </div>

                                    <div class="post-comments-wrapper post-intraction-wrapper">
                                        <img src="./assets/icons/comment.svg" alt="views">
                                        <span class="post-comments text-button" name="post-comments">6 </span>comments
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

            </div>

        </section>


        <section class="latest-news">
            <h3>LATEST NEWS</h3>

            <div class="cards-wrapper">

                <div class="card">

                    <a href="#">
                        <img src="./assets/images/test.jpg" alt="">
                        <div class="card-content">
                            <div class="post-category-date">
                                <span class="chip1 category text-caption1">Politics</span>
                                <span class="divider"></span>
                                <p class="text-caption1 post-date">Feb 2, 2024 19:28</p>
                            </div>

                            <h3 class="text-md home-post-title">Stormy Daniels Parries Trump Lawyer’s Attacks in Hush-Money Trial Testimony there is nothing to add here here err test.</h3>

                            <div class="divider horizontal"></div>

                            <div class="post-intractions-wrapper">
                                <div class="post-views-wrapper post-intraction-wrapper text-caption1">
                                    <img src="./assets/icons/show-pass.svg" alt="views">
                                    <span class="post-views" name="post-views">2,423 </span>views
                                </div>

                                <div class="post-likes-wrapper post-intraction-wrapper text-caption1">
                                    <img src="./assets/icons/like.svg" alt="likes">
                                    <span class="post-likes" name="post-likes">215 </span>likes
                                </div>

                                <div class="post-comments-wrapper post-intraction-wrapper text-caption1">
                                    <img src="./assets/icons/comment.svg" alt="views">
                                    <span class="post-comments" name="post-comments">6 </span>comments
                                </div>
                            </div>
                        </div>
                    </a>
                    
                </div>


            </div>

        </section>



    </div>
</body>
</html>
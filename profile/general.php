<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Anas karmoua</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">

    <!-- custom js -->
    <script src="../js/theme.js" type="module" defer></script>
    <script src="../js/userSideBar.js" type="module" defer></script>
    <script src="../js/profileGeneral.js" type="module" defer></script>
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

            <div class="content-container w-half">
                <form method="post">
                    <header>
                        <h1 class="text-sm">General</h1>
                        <p class="text-body2 italic opacity-half">Profile created at: <span>Feb 2, 2024 19:28</span></p>
                    </header>

                    <div class="inputs for-general">
                        <div class="full-name">

                            <div class="input-validation">

                            <div class="fname-input input-field">

                                <!-- user icon -->
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
                                <path d="M12.1601 10.8705C12.0601 10.8605 11.9401 10.8605 11.8301 10.8705C9.45006 10.7905 7.56006 8.84049 7.56006 6.44049C7.56006 3.99049 9.54006 2.00049 12.0001 2.00049C14.4501 2.00049 16.4401 3.99049 16.4401 6.44049C16.4301 8.84049 14.5401 10.7905 12.1601 10.8705Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.16021 14.5595C4.74021 16.1795 4.74021 18.8195 7.16021 20.4295C9.91021 22.2695 14.4202 22.2695 17.1702 20.4295C19.5902 18.8095 19.5902 16.1695 17.1702 14.5595C14.4302 12.7295 9.92021 12.7295 7.16021 14.5595Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <input type="text" placeholder="First name" name="fname" value="">

                            </div>

                            <!-- //TODO: add error message here : get it form register.php -->

                            </div>

                            <div class="input-validation">

                            <div class="lname-input input-field">
                    
                                <!-- user icon -->
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
                                <path d="M12.1601 10.8705C12.0601 10.8605 11.9401 10.8605 11.8301 10.8705C9.45006 10.7905 7.56006 8.84049 7.56006 6.44049C7.56006 3.99049 9.54006 2.00049 12.0001 2.00049C14.4501 2.00049 16.4401 3.99049 16.4401 6.44049C16.4301 8.84049 14.5401 10.7905 12.1601 10.8705Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.16021 14.5595C4.74021 16.1795 4.74021 18.8195 7.16021 20.4295C9.91021 22.2695 14.4202 22.2695 17.1702 20.4295C19.5902 18.8095 19.5902 16.1695 17.1702 14.5595C14.4302 12.7295 9.92021 12.7295 7.16021 14.5595Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            <input type="text" placeholder="Last name" name="lname" value="">

                            </div>

                            <!-- //TODO: add error message here : get it form register.php -->

                            </div>
                        </div>

                        <div class="input-validation">

                            <div class="email-input input-field">
                                <!-- email icon -->
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
                                    <path d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>  

                                <input type="email" placeholder="Enter your email" name="email" value="">
                            </div>
                            
                            <!-- //TODO: add error message here : get it form register.php -->
                        </div>
            
                    </div>

                    <div class="cta center margin-0">
                        <button type="button" name="submit" class="primary-btn">Update</button>
                    </div>

                 </form>
            </div>
        </main>
    </div>

</body>
</html>
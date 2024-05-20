<?php

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Empty fields check //
    if (empty($email)) {
        echo "Email is required.";
    } 

    elseif (empty($password)) {
        echo "Password is required.";
    } 

    else {

        // DB connection //
        require_once '../components/connect.php';

        $selectUser = $conn->prepare('SELECT * FROM users WHERE email = ?');
        $selectUser->execute([$email]);

        if ($selectUser->rowCount() > 0) {
            $user = $selectUser->fetch(PDO::FETCH_ASSOC);

            // Password verification //
            if (password_verify($_POST['password'], $user['password'])) {

                // Start session and store user information //
                session_start();
                $_SESSION['user'] = $user;
                header('Location: ../index.php');
            } 

            else {
                echo "Incorrect password.";
            }
        } 

        else {
            echo "Email not found.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log in</title>

  <!-- custom css links -->
  <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">

  <!-- custom js -->
  <script src="../js/theme.js" defer></script>
  <script src="../js/auth.js" defer></script>
</head>

<body>
  <div class="container">
  <div class="two-cols">
    <div class="left">
      <img src="../assets/images/login-illustration.svg" alt="illustration">
    </div>
    <div class="right">
      <header>
       <img src="../assets/images/logo-dark.svg" alt="logo" class="logo">
      </header>

      <form class="form-container" method="post">
        <header class="center">
          <h1 class="center sm">LOGIN</h1>
          <p class="center">The best place to discover news for free</p>
        </header>

        <div class="inputs">
          <div class="email-input">
            <img src="../assets/icons/email.svg" alt="email icon" class="opacity-40">
            <input type="email" placeholder="Enter your email" name="email" required>
          </div>

          <div class="password-input">
            <img src="../assets/icons/password.svg" alt="password icon" class="opacity-40">
            <input type="password" placeholder="Enter your password" name="password" class="password" required>
            <img src="../assets/icons/show-pass.svg" alt="show toggle icon" class="password-toggle opacity-40">
          </div>
        </div>

        <div class="cta full center">
          <input type="submit" value="Login to my account" name="submit" class="primary-btn full">
          <p class="text-caption1">Don’t have an account? <a href="./register.php">Sign up</a></p>
        </div>
      </form>

      <footer>
          <p class="text-button">© Copyright, 2024 All rights reserved to Voxworld</p>
            <ul>
              <li ><a href="#" class="text-button">Contact</a></li>
              <li ><a href="#" class="text-button">Help</a></li>

            </ul>
      </footer>
    </div>
    
  </div>
  </div>

</body>
</html>

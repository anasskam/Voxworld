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
</head>
<body>
  <div class="container">
  <div class="two-cols">
    <div class="left">
      <img src="../assets/images/login-illustration.svg" alt="illustration">
    </div>
    
    <div class="right">
      <header>
       <img src="../assets/images/logo.svg" alt="logo" class="logo">
      </header>

      <form action="" class="container-auth">
        <header>
          <h1 class="center sm">LOGIN</h1>
          <p class="center">The best place to discover news for free</p>
        </header>
        <div class="inputs">
          <div class="email-input">
            <img src="../assets/icons/email.svg" alt="email icon" class="opacity-40">
            <input type="email" placeholder="Enter your email" required>
          </div>

          <div class="password-input">
            <img src="../assets/icons/password.svg" alt="password icon" class="opacity-40">
            <input type="password" placeholder="Enter your password" required>
            <img src="../assets/icons/eye.svg" alt="show toggle icon" class="opacity-40">
          </div>

        </div>
        <div class="cta">
          <input type="submit" value="Login to my account">
          <p class="text-caption1">Don’t have an account? <a href="./register.php">Sign up</a></p>
        </div>
      </form>
      <footer>
        <div class="two-cols">
          <p>© Copyright, 2024 All rights reserved to Voxworld </p>
          <div class="right">
            <ul>
              <li><a href="">Contact</a></li>
              <li><a href="">Help</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
    
  </div>
  </div>

</body>
</html>
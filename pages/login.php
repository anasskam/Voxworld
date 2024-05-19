<?php

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Empty fields check //
    if (empty($email)) {
        echo "Email is required.";
    } elseif (empty($password)) {
        echo "Password is required.";
    } else {

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
            } else {
                echo "Incorrect password.";
            }
        } else {
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
</head>
<body>
  <div class="two-cols">
    <div class="left">
      <img src="#" alt="illustration">
    </div>
    <div class="right">
      <header>
       <img src="../assets/images/logo.svg" alt="logo">
      </header>

      <form method="post">
        <header>
          <h1>LOGIN</h1>
          <p>The best place to discover news for free</p>
        </header>
        <div class="inputs">
          <div class="email-input">
            <img src="../assets/icons/email.svg" alt="email icon">
            <input type="email" placeholder="Enter your email" required name="email">
          </div>

          <div class="password-input">
            <img src="../assets/icons/password.svg" alt="password icon">
            <input type="password" placeholder="Enter your password" required name="password">
            <img src="../assets/icons/eye.svg" alt="show toggle icon">
          </div>
        </div>
        <div class="cta">
          <input type="submit" value="Login to my account" name="submit">
          <p>Don’t have an account? <a href="./register.php">Sign up</a></p>
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
</body>
</html>

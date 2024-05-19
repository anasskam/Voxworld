<?php

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Empty fields check //
    if (empty($username)) {
        echo "username is required.";
    } elseif (empty($password)) {
        echo "Password is required.";
    } else {

        // DB connection //
        require_once '../components/connect.php';

        $selectUser = $conn->prepare('SELECT * FROM admin WHERE username = ? AND password = ?');
        $selectUser->execute([$username, $password]);

        // Auth check //
        if ($selectUser->rowCount() > 0) {
            $user = $selectUser->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
        } else {
            echo "Incorrect username or password.";
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
          <p>Welcome back to your account!</p>
        </header>
        <div class="inputs">
          <div class="admin-username-input">
            <img src="../assets/icons/user1.svg" alt="username icon">
            <input type="text" placeholder="Enter your username" required name="username">
          </div>

          <div class="password-input">
            <img src="../assets/icons/password.svg" alt="password icon">
            <input type="password" placeholder="Enter your password" required name="password">
            <img src="../assets/icons/eye.svg" alt="show toggle icon">
          </div>

        </div>
        <div class="cta">
          <input type="submit" value="Login to my account" name="submit">
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
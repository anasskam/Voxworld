<?php
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    // Password pattern for validation //
    $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    // Empty fields check
    if (empty($fname)) {
        echo "First name is required.";
    } 

    elseif (empty($lname)) {
        echo "Last name is required.";
    } 

    elseif (empty($email)) {
        echo "Email is required.";
    } 

    elseif (empty($pwd)) {
        echo "Password is required.";
    } 

    elseif (!preg_match($passwordPattern, $pwd)) {
        echo  "Password must have at least 8 characters, including at least 1 uppercase/lowercase letter, 1 number, and 1 special character.";       
    } 

    else {
      
        // DB connection
        require_once '../components/connect.php';

        // Email existence check
        $sqlCheck = $conn->prepare('SELECT * FROM users WHERE email = ?');
        $sqlCheck->execute([$email]);

        if ($sqlCheck->rowCount() > 0) {
            echo "Email already exists. Please use a different email.";
        } 
        
        else {
            // Hash the password after validation
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

            date_default_timezone_set("Africa/Casablanca");
            $date = date('Y-m-d H:i:s');
            $sqlState = $conn->prepare('INSERT INTO users (id, FirstName, LastName, email, password, CreationDate) VALUES (null, ?, ?, ?, ?, ?)');
            $sqlState->execute([$fname, $lname, $email, $hashedPwd, $date]);

            // Redirection to login page
            header('Location: login.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>

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
      <form method="post" class="form-container">
        <header class="center">
          <h1>SIGN UP</h1>
          <p>Explore the world from your bed with a single click</p>
        </header>
        <div class="inputs">
          <div class="full-name">

            <div class="fname-input">
              <img src="../assets/icons/user1.svg" alt="first name icon" class="opacity-40">
              <input type="text" placeholder="First name" required name="fname">
            </div>

            <div class="lname-input">
              <img src="../assets/icons/user1.svg" alt="last name icon" class="opacity-40">
              <input type="text" placeholder="Last name" required name="lname">
            </div>
          </div>

          <div class="email-input">
            <img src="../assets/icons/email.svg" alt="email icon" class="opacity-40">
            <input type="email" placeholder="Enter your email" required name="email">
          </div>

          <div class="password-input">
            <img src="../assets/icons/password.svg" alt="password icon" class="opacity-40">
            <input type="password" placeholder="Enter your password" name="password" class="password" required>
            <img src="../assets/icons/show-pass.svg" alt="show toggle icon" class="password-toggle opacity-40">
          </div>

        </div>

        <div class="privacy-check">
          <input type="checkbox" required>
          <p class="text-caption1">I accept the <a href="#">privacy policy</a></p>
        </div>

        <div class="cta full center margin-0">
          <input type="submit" value="Create my account" name="submit" class="primary-btn full">
          <p class="text-caption1">Already have an account? <a href="./login.php">Log in</a></p>
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
</body>
</html>

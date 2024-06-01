<?php
session_start();

// Initialize error messages //
$errorMessages = ['password'=> '', 'email' => ''];
include '../components/errorTemplate.php';

// Check if form is submitted //
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Empty fields check
    if (empty($email)) {
        $errorMessages['email'] = errorTemplate("Please enter a valid email address.");
    } elseif (empty($password)) {
        $errorMessages['password'] = errorTemplate("Please enter a valid password.");
    } else {
        // DB connection
        require_once '../components/connect.php';

        $selectUser = $conn->prepare('SELECT * FROM users WHERE email = ?');
        $selectUser->execute([$email]);

        if ($selectUser->rowCount() > 0) {
            $user = $selectUser->fetch(PDO::FETCH_ASSOC);

            // Password verification
            if (password_verify($password, $user['password'])) {
                // Start session and store user information
                $_SESSION['role'] = $user;
                header('Location: ../index.php');
            } else {
                $errorMessages['password'] = errorTemplate("Incorrect password.");
            }
        } else {
            $errorMessages['email'] = errorTemplate("Email not found.");
        }
    }

    // Store the email in the session to retain it in the form //
    $_SESSION['email'] = $email;
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
  <script src="../js/theme.js" type="module" defer></script>
  <script src="../js/toggleTheme.js" type="module" defer></script>
  <script src="../js/auth.js" defer></script>
</head>

<body>
  <div class="container">
    <div class="two-cols">
      <div class="left">
        <img src="../assets/images/login-illustration.svg" alt="illustration" class="fit-viewport-height">
      </div>
      <div class="right fit-viewport-height">
        <?php include '../components/auth-header.php'; ?>

      <form class="form-container" method="post">
        <header class="center">
          <h1 class="center text-sm">LOGIN</h1>
          <p class="center">The best place to discover news for free</p>
        </header>

          <div class="inputs">
            <div class="input-validation">
              <div class="email-input input-field">
                <!-- email icon -->
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
                  <path d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="email" placeholder="Enter your email" name="email" 
                value="<?php 
                      if (isset($_SESSION['email'])) {
                          echo htmlspecialchars($_SESSION['email']);
                      } else {
                          echo '';
                      }
                      ?>">
              </div>
              <?php 
                if(isset($_POST['submit']) && !empty($errorMessages)){
                  echo $errorMessages['email'];
                }
              ?>
            </div>

            <div class="input-validation">
              <div class="password-input input-field">
                <!-- password icon -->
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
                  <path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M12 18.5C13.3807 18.5 14.5 17.3807 14.5 16C14.5 14.6193 13.3807 13.5 12 13.5C10.6193 13.5 9.5 14.6193 9.5 16C9.5 17.3807 10.6193 18.5 12 18.5Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="password" placeholder="Enter your password" name="password" class="password">
                <!-- toggle password icon -->
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="password-toggle opacity-40">
                  <path d="M15.58 12C15.58 13.98 13.98 15.58 12 15.58C10.02 15.58 8.41998 13.98 8.41998 12C8.41998 10.02 10.02 8.42001 12 8.42001C13.98 8.42001 15.58 10.02 15.58 12Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M12 20.27C15.53 20.27 18.82 18.19 21.11 14.59C22.01 13.18 22.01 10.81 21.11 9.4C18.82 5.8 15.53 3.72 12 3.72C8.47003 3.72 5.18003 5.8 2.89003 9.4C1.99003 10.81 1.99003 13.18 2.89003 14.59C5.18003 18.19 8.47003 20.27 12 20.27Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <?php
                if(isset($_POST['submit']) && !empty($errorMessages)){
                  echo $errorMessages['password'];
                }
              ?>
            </div>
          </div>

          <div class="cta full center">
            <input type="submit" value="Login to my account" name="submit" class="primary-btn full">
            <p class="text-button">Don’t have an account? <a href="./register.php">Sign up</a></p>
          </div>
        </form>

        <footer>
          <p class="text-button">© Copyright, 2024 All rights reserved to Voxworld</p>
          <ul>
            <li><a href="#" class="text-button">Contact</a></li>
            <li><a href="#" class="text-button">Help</a></li>
          </ul>
        </footer>
      </div>
    </div>
  </div>

</body>
</html>
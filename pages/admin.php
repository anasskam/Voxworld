<?php
session_start();

//inti error msg//
$errorMessages = ['password' => '','username' => ''];

include '../components/errorTemplate.php';

// Check if already logged-in //
if (isset($_SESSION['adminId'])) {
  // Redirect to dashboard page //
  header('Location: ../dashboard/overview.php');
  exit();
}


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Empty fields check //
    if (empty($username)) {
      $errorMessages['username'] = errorTemplate("Username is required");
    } 
    
    elseif (empty($password)) {
      $errorMessages['password'] = errorTemplate("Password is required");
    } 

    else {

        // DB connection //
        require_once '../components/connect.php';

        $selectAdmin = $conn->prepare('SELECT * FROM admin WHERE username = ?');
        $selectAdmin->execute([$username]);

        if ($selectAdmin->rowCount() > 0) {
          $admin = $selectAdmin->fetch(PDO::FETCH_ASSOC);

          // Password verification
          if (password_verify($password, $admin['password'])) {
              $_SESSION['adminId'] = $admin['id_admin'];
              header('Location: ../dashboard/overview.php');
            } else {
                $errorMessages['password'] = errorTemplate("Incorrect password.");
            }
        } else {
            $errorMessages['username'] = errorTemplate("Username not found.");
        }
  }
  // Store the email in the session to retain it in the form
  $_SESSION['username'] = $username;  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Log in</title>

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
      <img src="../assets/images/login-illustration.svg" alt="illustration">
    </div>
    <div class="right">
      <?php include '../components/auth-header.php'; ?>

      <form class="form-container" method="post">
        <header class="center">
          <h1 class="center text-sm">LOGIN</h1>
          <p class="center">Welcome back to your account!</p>
        </header>

        <div class="inputs">

          <div class="input-validation">
            <div class="admin-username-input input-field">

              <!-- user icon -->
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
                <path d="M12.1601 10.8705C12.0601 10.8605 11.9401 10.8605 11.8301 10.8705C9.45006 10.7905 7.56006 8.84049 7.56006 6.44049C7.56006 3.99049 9.54006 2.00049 12.0001 2.00049C14.4501 2.00049 16.4401 3.99049 16.4401 6.44049C16.4301 8.84049 14.5401 10.7905 12.1601 10.8705Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M7.16021 14.5595C4.74021 16.1795 4.74021 18.8195 7.16021 20.4295C9.91021 22.2695 14.4202 22.2695 17.1702 20.4295C19.5902 18.8095 19.5902 16.1695 17.1702 14.5595C14.4302 12.7295 9.92021 12.7295 7.16021 14.5595Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>

              <input type="text" placeholder="Enter your username" name="username" 
              value="<?php 
                      if (isset($_SESSION['username'])) {
                          echo htmlspecialchars($_SESSION['username']);
                      } else {
                          echo '';
                      }
                      ?>">
            </div>

            <?php 
              if(isset($_POST['submit']) && !empty($errorMessages)){
                echo $errorMessages['username'];
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
          <input type="submit" value="Access my dashboard" name="submit" class="primary-btn full">
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
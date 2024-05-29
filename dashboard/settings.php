<?php
session_start();

// Session Test //
if (!isset($_SESSION['adminId'])) {
  // Redirect to login page //
  header('Location: ../pages/admin.php'); 
  exit();
}
$adminId = $_SESSION['adminId'];
require_once '../components/connect.php';

// init error msg //
$errorMessages = ['username'=> '','password' => ''];


//----------------------- USERNAME UPDATE START -----------------------//
if (isset($_POST['update-username'])) {
  
  $currentusername = $_POST['current-username'];
  $newusername = $_POST['new-username'];
  
  if (isset($_POST['current-username'])) {
    $selectUsername = $conn->prepare('SELECT * FROM admin WHERE username = ?');
    $selectUsername->execute([$currentusername]);

    // Checking if the username exists
    if ($selectUsername->rowCount() > 0) {
      // Checking if the new username isn't the current one
      if ($currentusername != $newusername) {
        // Check if the new username already exists
        $checkNewUsername = $conn->prepare('SELECT * FROM admin WHERE username = ?');
        $checkNewUsername->execute([$newusername]);

        if ($checkNewUsername->rowCount() == 0) {
          $updateUsername = $conn->prepare('UPDATE admin SET username = ? WHERE id_admin = ?');
          if ($updateUsername->execute([$newusername, $adminId])) {
            echo 'Username updated successfully';
          } else {
            echo 'Error updating username';
          }
        } else {
          echo 'Username already taken';
        }
      } else {
        echo 'New username cannot be the same as the current username';
      }
    } else {
      echo 'Invalid current username';
    }
  }
} 
//----------------------- USERNAME UPDATE END -----------------------//






//----------------------- PASSWORD UPDATE START -----------------------//
if (isset($_POST['update-password'])) {
  $currentpwd = $_POST['current-password'];
  $newpwd = $_POST['new-password'];

  if (isset($_POST['current-password'])) {
    $selectPwd = $conn->prepare('SELECT * FROM admin WHERE id_admin = ?');
    $selectPwd->execute([$adminId]);

    if ($selectPwd->rowCount() > 0) {
      $admin = $selectPwd->fetch(PDO::FETCH_ASSOC);
      // Checking if the passwords match //
      if (password_verify($currentpwd, $admin['password'])) {

        // Checking if the new password isn't the current one //
        if ($currentpwd != $newpwd) {

          // Hashing and storing the new password //
          $hashed_password = password_hash($newpwd, PASSWORD_DEFAULT);
          $updatePwd = $conn->prepare('UPDATE admin SET password = ? WHERE id_admin = ?');
          if ($updatePwd->execute([$hashed_password, $adminId])) {
            echo 'Password updated successfully.';
          } else {
            echo 'Error updating password.';
          }
        } else {
          echo 'Password already exists';
        }
      } else {
        echo 'Invalid current password';
      }
    } else {
      echo 'Admin not found.';
    }
  }
}
//----------------------- PASSWORD UPDATE END -----------------------//
?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Settings</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/style.css">

  <!-- custom js -->
  <script src="../js/theme.js" defer></script>
  <script src="../js/auth.js" defer></script>
</head>
<body>

  <!-- //TODO: add a global variable for error messages "$errorMessages" -->

  <!-- update username -->
  <form method="post">
    <h3 style="color:black">Update username</h3>
    <div class="update-username-wrapper" style = "width:300px;padding:1rem">

      <div class="input-validation">

        <div class="current-username">

        <!-- user icon -->
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
          <path d="M12.1601 10.8705C12.0601 10.8605 11.9401 10.8605 11.8301 10.8705C9.45006 10.7905 7.56006 8.84049 7.56006 6.44049C7.56006 3.99049 9.54006 2.00049 12.0001 2.00049C14.4501 2.00049 16.4401 3.99049 16.4401 6.44049C16.4301 8.84049 14.5401 10.7905 12.1601 10.8705Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M7.16021 14.5595C4.74021 16.1795 4.74021 18.8195 7.16021 20.4295C9.91021 22.2695 14.4202 22.2695 17.1702 20.4295C19.5902 18.8095 19.5902 16.1695 17.1702 14.5595C14.4302 12.7295 9.92021 12.7295 7.16021 14.5595Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <input type="text" placeholder="Current username" name="current-username">

        </div>

        <?php
          if(isset($_POST['submit']) && !empty($errorMessages)){
            echo $errorMessages['fname']; 
          }
        ?>

      </div>

      <div class="input-validation">

        <div class="new-username">

        <!-- user icon -->
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
          <path d="M12.1601 10.8705C12.0601 10.8605 11.9401 10.8605 11.8301 10.8705C9.45006 10.7905 7.56006 8.84049 7.56006 6.44049C7.56006 3.99049 9.54006 2.00049 12.0001 2.00049C14.4501 2.00049 16.4401 3.99049 16.4401 6.44049C16.4301 8.84049 14.5401 10.7905 12.1601 10.8705Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M7.16021 14.5595C4.74021 16.1795 4.74021 18.8195 7.16021 20.4295C9.91021 22.2695 14.4202 22.2695 17.1702 20.4295C19.5902 18.8095 19.5902 16.1695 17.1702 14.5595C14.4302 12.7295 9.92021 12.7295 7.16021 14.5595Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <input type="text" placeholder="New username" name="new-username">

        </div>

        <?php
          if(isset($_POST['submit']) && !empty($errorMessages)){
            echo $errorMessages['fname']; 
          }
        ?>

      </div>

      <div class="cta full margin-0">
        <input type="submit" value="Update changes" name="update-username" class="primary-btn full">
      </div>

    </div>


  </form>
  
  <!-- update password -->
  <form method="post">
    <h3 style="color:black">Update password</h3>

    <div class="update-password-wrapper" style = "width:300px;padding:1rem">

      <div class="input-validation">

        <div class="current-password">

        <!-- password icon -->
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
          <path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M12 18.5C13.3807 18.5 14.5 17.3807 14.5 16C14.5 14.6193 13.3807 13.5 12 13.5C10.6193 13.5 9.5 14.6193 9.5 16C9.5 17.3807 10.6193 18.5 12 18.5Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <input type="password" placeholder="Current password" name="current-password">

        </div>

        <?php
          if(isset($_POST['submit']) && !empty($errorMessages)){
            echo $errorMessages['']; // TODO: update this fields
          }
        ?>

      </div>

      <div class="input-validation">

        <div class="new-password">

        <!-- password icon -->
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
          <path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M12 18.5C13.3807 18.5 14.5 17.3807 14.5 16C14.5 14.6193 13.3807 13.5 12 13.5C10.6193 13.5 9.5 14.6193 9.5 16C9.5 17.3807 10.6193 18.5 12 18.5Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <input type="password" placeholder="New password" name="new-password">

        </div>

        <?php
          if(isset($_POST['submit']) && !empty($errorMessages)){
            echo $errorMessages['']; // TODO: update this fields
          }
        ?>

      </div>

      <div class="cta full margin-0">
        <input type="submit" value="Update changes" name="update-password" class="primary-btn full">
      </div>

    </div>


  </form>


</body>
</html>
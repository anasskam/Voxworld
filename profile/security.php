<?php
// DB connection //
require_once '../components/connect.php';
// Session start //
session_start();
// Session check for access //
if (!isset($_SESSION['user_id'])) {
  // Redirect to login page //
  header('Location: ../pages/login.php');
  exit();
}

// Initialize error messages //
$errorMessages = [
    'current-username' => '', 
    'new-username' => '', 
    'current-password' => '', 
    'new-password' => '',
];
include '../components/errorTemplate.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}


// ----------------------- PASSWORD UPDATE ----------------------- //
if (isset($_POST['update-password'])) {
    $currentpwd = $_POST['current-password'];
    $newpwd = $_POST['new-password'];

    // Check if the password fields are empty //
    if (empty($currentpwd)) {
        $errorMessages['current-password'] = errorTemplate("Current password cannot be empty.");
    }

    if (empty($newpwd)) {
        $errorMessages['new-password'] = errorTemplate("New password cannot be empty.");
    }

    // Proceed if there is no error msg //
    if (empty($errorMessages['current-password']) && empty($errorMessages['new-password'])) {
        $selectPwd = $conn->prepare('SELECT * FROM users WHERE id = ?');
        $selectPwd->execute([$user_id]);

        if ($selectPwd->rowCount() > 0) {
            $user = $selectPwd->fetch(PDO::FETCH_ASSOC);
            // Check if passwords match //
            if (password_verify($currentpwd, $user['password'])) {

                // Check if ew password isn't same as current one //
                if ($currentpwd != $newpwd) {

                    // Hash nd store new password //
                    $hashed_password = password_hash($newpwd, PASSWORD_DEFAULT);
                    $updatePwd = $conn->prepare('UPDATE users SET password = ? WHERE id = ?');
                    if ($updatePwd->execute([$hashed_password, $user_id])) {
                        
                        ?>
                        <script defer>
                            setTimeout(()=> {
                                swal("Success", "Password updated successfully", "success", {
                                    buttons:false,
                                    timer: 2500,
                                }).then(()=>{
                                    window.location.href = "../pages/login.php";
                                })
                            }, 500)
                        </script>
                        <?php

                        // unset session data //
                        unset($_SESSION['user_id']); 
                    } else {
                        echo 'Error updating password.';
                    }
                } else {
                    $errorMessages['new-password'] = errorTemplate("New password cannot be the same as the current password.");
                }
            } else {
                $errorMessages['current-password'] = errorTemplate("Invalid current password.");
            }
        } else {
            ?>
            <script defer>
                setTimeout(()=> {
                    swal("Oops!", "User not found!", "warning", {
                        buttons: {
                            redirect: {
                                text: "Try again",
                                className:"swal-gotoBtn",
                            }
                        },
                    }).then((value)=>{
                        if(value === "redirect") {
                            window.location.href = "security.php";
                        }
                    })
                }, 500)
            </script>
            <?php
        }
    }
}

// ----------------------- ACCOUNT DELETE ----------------------- //
if (isset($_POST['user-delete'])) {
  $user_id = $_POST['user-delete'];

  // Prepare and execute the query to delete the user //
  $userDelete = $conn->prepare('DELETE FROM users WHERE id = ?');
  $userDelete->execute([$user_id]);

  // Remove likes related to the deleted user //
  $likeDelete = $conn->prepare('DELETE FROM likes WHERE user_id = ?');
  $likeDelete->execute([$user_id]);

  // Remove comments related to the deleted user //
  $viewsDelete = $conn->prepare('DELETE FROM comments WHERE user_id = ?');
  $viewsDelete->execute([$user_id]);

  if ($userDelete) {
    ?>
    <script defer>
        setTimeout(()=> {
            swal("Account Deleted", "Your account has been deleted.", "warning", {
                buttons:false,
                timer: 2500,
            }).then(()=>{
                window.location.href = "../pages/register.php";
            })
        }, 500)
    </script>
    <?php
  }
  else {
      echo 'Error deleting user';
  }
  // Check if the session user is the one deleted & unset session variables //
  if (isset($_SESSION['user_id']) && $user_id == $_SESSION['user_id']) {
      // Unset session for the deleted user //
      unset($_SESSION['user_id']);
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile | Security</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">

    <!-- custom js -->
    <script src="../js/theme.js" type="module" defer></script>
    <script src="../js/toggleTheme.js" type="module" defer></script>
    <script src="../js/userSideBar.js" type="module" defer></script>
    <script src="../js/auth.js" type="module" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        <section class="user-update-password">
          <form method="post">
            <header>
              <h3>Security</h3>
            </header>

            <div class="update-password-wrapper">
              <div class="inputs">

                <div class="input-validation">
                  <div class="password-input input-field">

                  <!-- password icon -->
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
                    <path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 18.5C13.3807 18.5 14.5 17.3807 14.5 16C14.5 14.6193 13.3807 13.5 12 13.5C10.6193 13.5 9.5 14.6193 9.5 16C9.5 17.3807 10.6193 18.5 12 18.5Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                  <input type="password" placeholder="Current password" name="current-password" class="password">
              
                  <!-- toggle password icon -->
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="password-toggle opacity-40">
                    <path d="M15.58 12C15.58 13.98 13.98 15.58 12 15.58C10.02 15.58 8.41998 13.98 8.41998 12C8.41998 10.02 10.02 8.42001 12 8.42001C13.98 8.42001 15.58 10.02 15.58 12Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 20.27C15.53 20.27 18.82 18.19 21.11 14.59C22.01 13.18 22.01 10.81 21.11 9.4C18.82 5.8 15.53 3.72 12 3.72C8.47003 3.72 5.18003 5.8 2.89003 9.4C1.99003 10.81 1.99003 13.18 2.89003 14.59C5.18003 18.19 8.47003 20.27 12 20.27Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
              
                  </div>

                  <?php
                    if(isset($_POST['update-password']) && !empty($errorMessages)){
                      echo  $errorMessages['current-password']; 
                    }
                  ?> 

                </div>

                <div class="input-validation">
                  <div class="password-input input-field">

                  <!-- password icon -->
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-40">
                    <path d="M6 10V8C6 4.69 7 2 12 2C17 2 18 4.69 18 8V10" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 18.5C13.3807 18.5 14.5 17.3807 14.5 16C14.5 14.6193 13.3807 13.5 12 13.5C10.6193 13.5 9.5 14.6193 9.5 16C9.5 17.3807 10.6193 18.5 12 18.5Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17 22H7C3 22 2 21 2 17V15C2 11 3 10 7 10H17C21 10 22 11 22 15V17C22 21 21 22 17 22Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                  <input type="password" placeholder="New password" name="new-password" class="password">
              
                  <!-- toggle password icon -->
                  <div class="password-toggle opacity-40">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" >
                      <path d="M15.58 12C15.58 13.98 13.98 15.58 12 15.58C10.02 15.58 8.41998 13.98 8.41998 12C8.41998 10.02 10.02 8.42001 12 8.42001C13.98 8.42001 15.58 10.02 15.58 12Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M12 20.27C15.53 20.27 18.82 18.19 21.11 14.59C22.01 13.18 22.01 10.81 21.11 9.4C18.82 5.8 15.53 3.72 12 3.72C8.47003 3.72 5.18003 5.8 2.89003 9.4C1.99003 10.81 1.99003 13.18 2.89003 14.59C5.18003 18.19 8.47003 20.27 12 20.27Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>

              
                  </div>

                  <?php
                    if(isset($_POST['update-password']) && !empty($errorMessages)){
                      echo  $errorMessages['new-password']; 
                    }
                  ?> 

                </div>

              </div>

              <div class="cta margin-0">
                <input type="submit" value="Update changes" name="update-password" class="primary-btn">
              </div>

            </div>
          </form>
        </section>

        <section class="user-delete-account">

          <header>
            <h3>Danger zone</h3>
          </header>

          <form method="POST">
            <div class="danger-zone-area">
              <p>Note: Once your account deleted you can't restore it</p>
              <button name="user-delete" value="<?php echo $user['id']?>" onclick="return confirm('Are you sure you want to delete your account?')" class="ghost-btn delete-btn">Delete account</button>
            </div>
          </form>

        </section>
      </div>

    </main>

  </div>

</body>
</html>
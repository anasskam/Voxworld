<?php
// DB connection //
require_once 'connect.php';

$userID = '';
$username = '';

// Check if userID is set in session //
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];

    // Prepare the statement //
    $checkUser = $conn->prepare('SELECT FirstName, LastName FROM users WHERE id = ?');
    $checkUser->execute([$userID]);
    $user = $checkUser->fetch(PDO::FETCH_ASSOC);

    // Check if a user was found //
    if ($user) {
        $username = $user['FirstName'] . ' ' . $user['LastName'];
    } else {
        $username = 'Guest';
    }
}

?>

<header class="main-header">
    <div class="upper-header">
        <img alt="logo" class="logo home-logo">

        <div class="auth-buttons">
            <?php 
            // Check if the user is logged in //
            if ($userID) { 
                echo htmlspecialchars($username);
                echo '<a href="components/logoutUser.php">Log out</a>';
            } else { 
                echo '<a class="ghost-btn" href="./pages/login.php">Log in</a>';
                echo '<a class="primary-btn" href="./pages/register.php">Sign up</a>';
            } 
            ?>
        </div>
    </div>

    <nav>
        <ul>
            <li data-relation="index"><a href="./index.php">Home</a></li>
            <li data-relation="politics"><a href="./category.php?category=politics">Politics</a></li>
            <li data-relation="economy"><a href="./category.php?category=economy">Economy</a></li>
            <li data-relation="society"><a href="./category.php?category=society">Society</a></li>
            <li data-relation="culture"><a href="./category.php?category=culture">Culture</a></li>
            <li data-relation="scienceTech"><a href="./category.php?category=scienceandtech">Science & Tech</a></li>
            <li data-relation="business"><a href="./category.php?category=business">Business</a></li>
            <li data-relation="sports"><a href="./category.php?category=sports">Sports</a></li>
            <li data-relation="entsArts"><a href="./category.php?category=entsandarts">Ents & Arts</a></li>
            <li data-relation="mena"><a href="./category.php?category=mena">Mena</a></li>
            <li data-relation="health"><a href="./category.php?category=health">Health</a></li>
            <li data-relation="international"><a href="./category.php?category=international">International</a></li>
        </ul>
    </nav>
</header>


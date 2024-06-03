<?php
session_start();
// Session Test //
include '../components/session-check.php';
$adminId = checkAdminSession();

$errorMessages = ['title'=> '', 'image' => '', 'content'=> ''];
include '../components/errorTemplate.php';

// DB Connection //
require_once'../components/connect.php';



if (isset($_SESSION['postID'])) {
    $postID = $_SESSION['postID'];

    require_once '../components/connect.php';
    $sqlState = $conn->prepare('SELECT * FROM posts WHERE id = ?');
    $sqlState->execute([$postID]);
    $post = $sqlState->fetch(PDO::FETCH_ASSOC);
}




if (isset($_POST['submit'])) {
    $content = $_POST['editor-content'];
    $title = $_POST['contentTitle'];
    $postDate = date('Y-m-d H:i:s');
    $category = $_POST['categories'];
    date_default_timezone_set("Africa/Casablanca");
    $image = "";
    
    if (empty($title)) {
        $errorMessages['title'] = errorTemplate("Title is required.");
    }

    if (empty($_FILES['file-upload']['name'])) {
        $errorMessages['image'] = errorTemplate("Image is required.");
    } else {
        $image = $_FILES['file-upload']['name'];
    }

    if (empty($content)) {
        $errorMessages['content'] = errorTemplate("Content is required.");
    }

    // Only proceed if there are no error messages //
    if (empty(array_filter($errorMessages))) {
        
        $filename = uniqid() . $image;
        $destination = '../assets/hostedImages/' . $filename;
        if (move_uploaded_file($_FILES['file-upload']['tmp_name'], $destination)) {
            $createPost = $conn->prepare('UPDATE posts SET title = ?, content = ?, image = ?, category = ?, UpdateDate = ? WHERE id = ?');
            $createPost->execute([$title, $content, $filename, $category, $postDate, $postID]);
            // Clear session inputs after successful post creation //
            unset($_SESSION['contentTitle'], $_SESSION['categories'], $_SESSION['file-upload'], $_SESSION['editor-content']);
            header('location: managePosts.php');
        } else {
            $errorMessages['image'] = errorTemplate("Failed to upload image.");
        }
    } else {
        // Store the inputs in the session to retain it in the form //
        $_SESSION['contentTitle'] = $title;
        $_SESSION['categories'] = $category;
        $_SESSION['file-upload'] = $image;
        $_SESSION['editor-content'] = $content;
    }
    
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Dashboard | Create Post</title>

    <!-- custom css links -->
    <link rel="shortcut icon" href="../assets/images/favicon32.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    

    <!-- custom js -->
    <script src="../js/theme.js" type="module" defer></script>
    <script src="../js/sidebar.js" defer></script>
    <script src="../js/createPost.js" type="module" defer></script>
    <script src="../assets/ckeditor5/build/ckeditor.js"></script>

</head>
<body>

    <div class="dashboard-container">

        <!-- side bar --> 
        <?php
            include "../components/sidebar.php"
        ?>

        <!-- main content -->
        <main>
            <?php
                include "../components/dashboard-header2.php"
            ?>
            <div class="content-container">
                <p class="text-body1">Edit this post</p>
                <form method="post" enctype="multipart/form-data">
                    <div class="create-post-inputs-wrapper">
                        <div class="inputs">
                            <div class="input-validation">
                                <div class="title-field input-field">

                                    <!-- title icon -->
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-half">
                                        <path d="M2.67 7.17V5.35C2.67 4.2 3.6 3.28 4.74 3.28H19.26C20.41 3.28 21.33 4.21 21.33 5.35V7.17" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 20.72V4.10999" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.06 20.72H15.94" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                <input type="text" placeholder="Title" name="contentTitle" 
                                value="<?php 
                                    if (isset($_SESSION['contentTitle'])) {
                                        echo htmlspecialchars($_SESSION['contentTitle']);
                                    } else {
                                        echo htmlspecialchars($post['title']);
                                    }
                                    ?>">
                            </div>

                            <?php
                                if(isset($_POST['submit']) && !empty($errorMessages)){
                                    echo $errorMessages['title']; 
                                }
                            ?>

                            </div>

                            <div class="input-validation">
                                <div class="categories-field input-field">

                                    <!-- category icon -->
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-half">
                                        <path d="M22 8.27V4.23C22 2.64 21.36 2 19.77 2H15.73C14.14 2 13.5 2.64 13.5 4.23V8.27C13.5 9.86 14.14 10.5 15.73 10.5H19.77C21.36 10.5 22 9.86 22 8.27Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10.5 8.52V3.98C10.5 2.57 9.86 2 8.27 2H4.23C2.64 2 2 2.57 2 3.98V8.51C2 9.93 2.64 10.49 4.23 10.49H8.27C9.86 10.5 10.5 9.93 10.5 8.52Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10.5 19.77V15.73C10.5 14.14 9.86 13.5 8.27 13.5H4.23C2.64 13.5 2 14.14 2 15.73V19.77C2 21.36 2.64 22 4.23 22H8.27C9.86 22 10.5 21.36 10.5 19.77Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15 15.5H21" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round"/>
                                        <path d="M15 19.5H21" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round"/>
                                    </svg>

                                <?php
                                $categories = ["Politics", "Economy", "Society", "Culture", "Science & Tech", "Business", "Sports", "Ents & Arts", "Mena", "Health", "International"];
                                ?>
                                <select name="categories" id="categories" class="categories-dropDown">
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category ?>" <?php if (isset($_SESSION['categories']) && $_SESSION['categories'] == $category || $post['category'] == $category) { echo 'selected'; } ?>>
                                            <?= $category ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                    <!-- arrow -->
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class= "drop-arrow">
                                        <path d="M8.95 4.08L15.47 10.6C16.24 11.37 16.24 12.63 15.47 13.4L8.95 19.92" stroke="currentcolor" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                </div>
                            </div>

                            <div class="input-validation">
                                <div class="upload-field input-field">
                                    <div class="upload-label">
                                        <!-- image upload icon -->
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-half">
                                            <path d="M9 10C10.1046 10 11 9.10457 11 8C11 6.89543 10.1046 6 9 6C7.89543 6 7 6.89543 7 8C7 9.10457 7.89543 10 9 10Z" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M13 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V10" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.75 5H21.25" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round"/>
                                            <path d="M18.5 7.75V2.25" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round"/>
                                            <path d="M2.67 18.95L7.6 15.64C8.39 15.11 9.53 15.17 10.24 15.78L10.57 16.07C11.35 16.74 12.61 16.74 13.39 16.07L17.55 12.5C18.33 11.83 19.59 11.83 20.37 12.5L22 13.9" stroke="currentcolor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <p class="text-body2 opacity-half file-info">Upload image</p>
                                    </div>
                                    
                                    <input type="file" id="file-upload" name="file-upload" value="upload img">
                                    <label for="file-upload" class="custom-file-upload">Uplaod image</label>
                                    
                                </div>
    
                            <?php
                                if(isset($_POST['submit']) && !empty($errorMessages)){
                                    echo $errorMessages['image']; 
                                }
                            ?>

                            <script>
                                    document.querySelector(".upload-field").style.height = 
                                    `${document.querySelector('.title-field').getBoundingClientRect().height}px`;
                                </script>
                            </div>
                        </div>  

                   
                        <div class="input-validation">
                            <div class="editor-container">
                                <textarea name="editor-content" id="editor">
                                    <?php
                                    if (isset($_SESSION['editor-content'])) {
                                        echo htmlspecialchars($_SESSION['editor-content']);
                                    } else {
                                        echo htmlspecialchars($post['content']);
                                    }                            
                                    ?>
                                </textarea>
                            </div>
                            <?php
                                if(isset($_POST['submit']) && !empty($errorMessages)){
                                    echo $errorMessages['content']; 
                                }
                            ?>
                        </div>
                        
                    <div class="cta margin-0">
                    <input type="submit" value="Update changes" name="submit" class="primary-btn publish-form-btn">
                    </div>
                </form>
            </div>


        </main>

    </div>

</body>
</html>
<?php


session_start();
require_once("includes/include.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Aladin&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>

    <!-- header.html -->
    <div w3-include-html="models/header.php"></div>

    <!-- gallery -->
    <div id="flex_container">
        <?php fill_gallery(0, 4); ?>
    </div>

    <!-- open post -->
    <div style="display: none" id="open_image_wrap">
        <div>
            <img src="" alt="" id="open_image">
            <img src="site_images/not_liked.svg" alt="not liked" id="like_image">
            <span id="like_count"></span>
        </div>
        <img src="site_images/748122.svg" alt="close button" id="close_button">
        <div id="open_image_messages_text"> Messages: </div>
        <div id="messages_wrap"></div>
        <input placeholder="Write comment here" type="text" id="comment_input_content">
        <button id="submit_button">Submit comment</button>
    </div>

    <!-- footer.html -->
    <div w3-include-html="models/footer.php"></div>

    <script src="js/work_with_images.js"></script>
    <script src="js/other.js"></script>
</body>
</html>
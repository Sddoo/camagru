<?php

session_start();
require_once("../includes/include.php");

if ($_SESSION['logged_on_user'] == "") {
    header("/code/index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/account.css">
    <title>Document</title>
</head>
<body>
    <!-- header -->
    <div w3-include-html="../models/header.php"></div>

    <main>
        <div id="video_container">
            <img src="" alt="" id="video_container_image" style="display: none;">
            <video autoplay>
                Wait for loading video...
            </video>
        </div>
        <div class="button_wrap">
            <form id="upload_image" runat="server">
                <input type='file' id="upload_input" val=""/>
                <img id="chosen_upload_image" src="">
            </form>
            <button id='snapshot'>Snapshot</button>
        </div>
        <div id="spb_container">
            <?php fill_superposables(); ?>
        </div>
        <div id="canvas_container">
            <canvas id='canvas' width='900' height='506'></canvas>
        </div>
        <div class="button_wrap" id="sr">
            <button id='save'>Save image?</button>
            <button id='reset'>Reset image</button>
        </div>
    </main>

    <!-- thumbs -->
    <aside>
        <div class="thumb_container">
            <?php fill_thumbnails(); ?>
        </div>
    </aside>

    <!-- scripts -->
    <script src="../js/start_video.js"></script>
    <script src="../js/work_with_spb.js"></script>
    <script src="../js/other.js"></script>
</body>
</html>
<?php

require_once("/code/includes/include.php");

function fill_thumbnails() {
    session_start();
    $pdo = db_auth();
    $stmt = $pdo->prepare("SELECT image_name FROM images WHERE login = ? ORDER BY creation_date DESC");
    $stmt->execute([$_SESSION['logged_on_user']]);
    $fetch = $stmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($fetch as $elem) {
        echo("<div class='thumb_item'>
                <img src='../images/{$elem}' class='thumb_image'>
                <img src='../site_images/748122.svg' class='close_image'>
            </div>");
    }
    $pdo = NULL;
    $stmt = NULL;
}


?>
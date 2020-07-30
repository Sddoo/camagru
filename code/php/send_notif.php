<?php

require_once("/code/includes/include.php");
session_start();
date_default_timezone_set("Europe/Moscow");

if ($_GET['submit'] == "OK" && $_SESSION['logged_on_user'])
{
    $pdo = db_auth();
    $stmt = $pdo->prepare("SELECT login FROM images WHERE image_name = ?;");
    $stmt->execute([$_GET['image_name']]);
    $fetch = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $image_owner = $fetch[0];
    $stmt = $pdo->prepare("SELECT notifs FROM users WHERE login = ?");
    $stmt->execute([$image_owner]);
    $fetch = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if ($fetch[0] == 1 && $_SESSION['logged_on_user'] != $image_owner) {
        mail(get_user_email($image_owner),
            "New comment!",
            "The user " . $_SESSION['logged_on_user'] . " left comment on your image: '" . $_GET['comment_content'] . "'");
    }
    $pdo = NULL;
    $stmt = NULL;
}
else
    echo("Not logged on user");


?>
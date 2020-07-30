<?php

require_once("/code/includes/include.php");
session_start();
date_default_timezone_set("Europe/Moscow");

if ($_GET['submit'] == "OK" && $_SESSION['logged_on_user'])
{
    $_GET['comment_content'] = htmlentities($_GET['comment_content']);
    $pdo = db_auth();
    $creation_date = date("Y-m-d G:i:s");
    $stmt = $pdo->prepare("INSERT INTO comments (image_name, login, content, creation_date) VALUES (:image_name, :login, :content, :creation_date);");
    $stmt->execute([':image_name' => $_GET['image_name'],
                    ':login' => $_SESSION['logged_on_user'],
                    ':content' => $_GET['comment_content'],
                    ':creation_date' => $creation_date]);
    echo("<div class='comment'> <b>" . $_SESSION['logged_on_user'] . ":</b> " . $_GET['comment_content'] .
        " <span class='comment_time'>" . $creation_date . "</span>");
    $pdo = NULL;
    $stmt = NULL;
}
else
    echo("Not logged on user");


?>
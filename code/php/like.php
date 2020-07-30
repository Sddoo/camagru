<?php

require_once("/code/includes/include.php");
session_start();

if ($_GET['submit'] == "OK" && $_SESSION['logged_on_user'])
{
    $pdo = db_auth();
    $stmt = $pdo->prepare("SELECT likes FROM images WHERE image_name = ?;");
    $stmt->execute([$_GET['image_name']]);
    $likes = $stmt->fetch()['likes'];
    $stmt = $pdo->prepare("SELECT image_name FROM likes WHERE login = ?;");
    $stmt->execute([$_SESSION['logged_on_user']]);
    $fetch = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $fetch = array_flip($fetch);
    if (array_key_exists($_GET['image_name'], $fetch)) {
        $stmt = $pdo->prepare("DELETE FROM likes WHERE login = ? AND image_name = ?;");
        $stmt->execute(["{$_SESSION['logged_on_user']}", "{$_GET['image_name']}"]);
        $stmt = $pdo->prepare("UPDATE images SET likes = likes - 1 WHERE image_name = ?;");
        $stmt->execute([$_GET['image_name']]);
        $likes -= 1;
        echo($likes . " delete");
    } else {
        $stmt = $pdo->prepare("INSERT INTO likes (image_name, login) VALUES (?, ?);");
        $stmt->execute(["{$_GET['image_name']}", "{$_SESSION['logged_on_user']}"]);
        $stmt = $pdo->prepare("UPDATE images SET likes = likes + 1 WHERE image_name = ?;");
        $stmt->execute([$_GET['image_name']]);
        $likes += 1;
        echo($likes . " add");
    }
    $pdo = NULL;
    $stmt = NULL;
}
else
    echo("Not logged on user");


?>
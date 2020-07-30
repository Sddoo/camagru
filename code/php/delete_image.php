<?php


require_once("../includes/include.php");
session_start();
if ($_SESSION['logged_on_user']) {
    $pdo = db_auth();
    $stmt = $pdo->prepare("SELECT image_name, login FROM images WHERE image_name = ?");
    $stmt->execute([$_GET['image_name']]);
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($fetch['login'] == $_SESSION['logged_on_user']) {
        echo("OK");
        $stmt = $pdo->prepare("DELETE FROM images WHERE image_name = ?");
        $stmt->execute([$_GET['image_name']]);
        $stmt = $pdo->prepare("DELETE FROM likes WHERE image_name = ?");
        $stmt->execute([$_GET['image_name']]);
        $stmt = $pdo->prepare("DELETE FROM comments WHERE image_name = ?");
        $stmt->execute([$_GET['image_name']]);
        unlink("../images/" . $_GET['image_name']);
    } else {
        echo("KO");
    }
    $pdo = NULL;
    $stmt = NULL;
}


?>
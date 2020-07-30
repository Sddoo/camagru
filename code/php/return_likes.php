<?php

require_once("/code/includes/include.php");
session_start();

$pdo = db_auth();
$stmt = $pdo->prepare("SELECT likes FROM images WHERE image_name = ?;");
$stmt->execute([$_GET['image_name']]);
$likes = $stmt->fetch()['likes'];
$stmt = $pdo->prepare("SELECT image_name FROM likes WHERE login = ?;");
$stmt->execute([$_SESSION['logged_on_user']]);
$fetch = $stmt->fetchAll(PDO::FETCH_COLUMN);
$fetch = array_flip($fetch);
if (array_key_exists($_GET['image_name'], $fetch)) {
    echo($likes . " yes");
} else {
    echo($likes . " no");
}
$pdo = NULL;
$stmt = NULL;


?>
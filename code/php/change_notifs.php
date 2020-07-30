<?php

require_once("../includes/include.php");
session_start();

if ($_GET['status'] && $_SESSION['logged_on_user']) {
    $pdo = db_auth();
    if ($_GET['status'] == 'return') {
        $stmt = $pdo->prepare("SELECT notifs FROM users WHERE login = ?");
        $stmt->execute([$_SESSION['logged_on_user']]);
        $fetch = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo ($fetch[0]);
    } else {
        $booltype = ($_GET['status'] == "true") ? true : false;
        $stmt = $pdo->prepare("UPDATE users SET notifs = :notifs WHERE login = :login");
        $stmt->bindValue(':notifs', $booltype, PDO::PARAM_BOOL);
        $stmt->bindValue(':login', $_SESSION['logged_on_user']);
        $stmt->execute();
        if ($_GET['status'] == 'true')
            echo ('1');
        else
            echo ('0');
    }
    $stmt = NULL;
    $pdo = NULL;
}


?>
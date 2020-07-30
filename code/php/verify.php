<?php

require_once("/code/includes/include.php");

if ($_GET['email']) {
    $pdo = db_auth();
    $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$_GET['email']]);
    $fetch = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if ($fetch[0] == $_GET['email']) {
        $stmt = $pdo->prepare("UPDATE users SET verify = true WHERE email = ?");
        $stmt->execute([$_GET['email']]);
        echo ("Congratulations! Account is verified");
    } else {
        echo ("You haven't created an account");
    }
    $pdo = NULL;
    $stmt = NULL;
}


?>
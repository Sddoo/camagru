<?php

require_once("/code/includes/include.php");

if ($_GET['email']) {
    $pdo = db_auth();
    $stmt = $pdo->prepare("SELECT hash FROM users WHERE email = ?");
    $stmt->execute([$_GET['email']]);
    $fetch = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if ($fetch[0] == $_GET['hash']) {
        echo ("<form action='change_pass.php' method='post'>
                Email: <input type='email' name='email'>
                Password: <input type='password' name='password'>
                <input type='submit' name='submit' value='Submit'>
            </form>");
    } else {
        echo ("<img src='../site_images/zelen.jpg' alt='Vuidi razbinik'>");
    }
    $pdo = NULL;
    $stmt = NULL;
} else if ($_POST['submit'] == "Submit" &&
            $_POST['password'] && $_POST['email']) {
    $pdo = db_auth();
    $stmt = $pdo->prepare("UPDATE users SET passwd = ? WHERE email = ?");
    $stmt->execute([hash("whirlpool", $_POST['password']), $_POST['email']]);
    echo ("Your pass is changed!");
    $pdo = NULL;
    $stmt = NULL;
} else {
    echo ("<img src='../site_images/zelen.jpg' alt='Vuidi razbinik'>");
}


?>
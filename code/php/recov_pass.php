<?php

require_once("/code/includes/include.php");

if ($_GET['submit'] == "OK" && $_GET['email']) {
    $pdo = db_auth();
    $hash = hash("gost", mktime());
    $stmt = $pdo->prepare("UPDATE users SET hash = ? WHERE email = ?");
    $stmt->execute([$hash, $_GET['email']]);
    mail($_GET['email'],
    "Camagru password changing",
    "Hello, here is link for creating new password!\n" .
    "https://" . $_SERVER['HTTP_HOST'] . "/php/change_pass.php?email=" . $_GET['email'] . "&hash=" . $hash);
    $pdo = NULL;
    $stmt = NULL;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    If you wanna to recover your pass, you should write your email below and push submit button.
    <form action="recov_pass.php" method="get">
        <input type="text" name="email">
        <input type="submit" name="submit" value="OK">
    </form>
    <a href="logging_in.php">Back to signing in.</a>
</body>
</html>
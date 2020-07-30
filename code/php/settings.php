<?php

require_once("/code/includes/include.php");

session_start(); 

if ($_SESSION['logged_on_user'] == "") {
    header("../index.php");
}

if ($_POST['submit'] == "OK")
{
    $pdo = db_auth();
	$stmt = $pdo->prepare("SELECT login, passwd, email FROM users WHERE login = ?");
	$stmt->execute([$_SESSION['logged_on_user']]);
    $fetch = $stmt->fetchAll();
    if (valid_login($_POST['new_username']))
    {
        $stmt = $pdo->prepare("UPDATE users SET login = ? WHERE login = ?;");
        $stmt->execute([htmlentities($_POST['new_username']), $_SESSION['logged_on_user']]);
        $stmt = $pdo->prepare("UPDATE images SET login = ? WHERE login = ?;");
        $stmt->execute([htmlentities($_POST['new_username']), $_SESSION['logged_on_user']]);
        $stmt = $pdo->prepare("UPDATE comments SET login = ? WHERE login = ?;");
        $stmt->execute([htmlentities($_POST['new_username']), $_SESSION['logged_on_user']]);
        $stmt = $pdo->prepare("UPDATE likes SET login = ? WHERE login = ?;");
        $stmt->execute([htmlentities($_POST['new_username']), $_SESSION['logged_on_user']]);
        $_SESSION['logged_on_user'] = htmlentities($_POST['new_username']);
        print ("<div id='message'> Username is changed! </div>");
    } else {
        print("<div id='message'>Wrong data. Pass, login and email have to contain 5-30 symbols withoud whitespaces.
                            And pass have to contain at least 1 number. </div>");
    }
    if (valid_pass($_POST['new_password']))
    {
        $cur_passwd = hash("whirlpool", $_POST['cur_password']);
        $new_passwd = hash("whirlpool", $_POST['new_password']);
        $stmt = $pdo->prepare("SELECT passwd FROM users WHERE login = ?;");
        $stmt->execute([$_SESSION['logged_on_user']]);
        $fetch = $stmt->fetchAll();
        $stmt = $pdo->prepare("UPDATE users SET passwd = ? WHERE passwd = ?");
        $stmt->execute([$new_passwd, $cur_passwd]);
        if ($fetch[0]['passwd'] == $cur_passwd)
            print ("<div id='message'> Password is changed! </div>");
        else
            print ("<div id='message'> Wrong current password! </div>");
    }
    if (valid_email($_POST['new_email']))
    {
        $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE login = ?;");
        $stmt->execute([htmlentities($_POST['new_email']), $_SESSION['logged_on_user']]);
        print("<div id='message'> Email is changed! </div>");
    } else {
        print("<div id='message'>Wrong data. Pass, login and email have to contain 5-30 symbols withoud whitespaces.
                            And pass have to contain at least 1 number. </div>");
    }
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
    <link rel="stylesheet" href="../css/settings.css">
    <title>Document</title>
</head>
<body>

    <!-- header.html -->
    <div w3-include-html="../models/header.php" id="f"></div>

    <div id="forms_wrap">
        <form action="settings.php" method="post">
            Current username: <?php print($_SESSION['logged_on_user']);?>
            <br>
            New username: <input type="text" name="new_username">
            <input type="submit" name="submit" value="OK">
        </form>
        <form action="settings.php" method="post">
            Current password: <input type="password" name="cur_password">
            <br>
            New password: <input type="password" name="new_password">
            <input type="submit" name="submit" value="OK">
        </form>
        <form action="settings.php" method="post">
            Current email: <?php print(get_user_email($_SESSION['logged_on_user'])) ?>
            <br>
            New email: <input type="text" name="new_email">
            <input type="submit" name="submit" value="OK">
        </form>
        <div>
            Do you want to recieve notifications?
            <input id="checkbox" type="checkbox"> <br>
        </div>
        <a href="../index.php">Back to gallery</a>
    </div>

    <!-- footer.html -->
    <div w3-include-html="../models/footer.php"></div>

    <script src="../js/settings.js"></script>
    <script src="../js/other.js"></script>
</body>
</html>

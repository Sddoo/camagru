<?php

require_once("/code/includes/include.php");

session_start();

if ($_SESSION['logged_on_user'])
    header("Location: account_page.php");

if ($_POST['submit'] == "OK")
{
    if (auth($_POST['login'], $_POST['passwd']))
        header("Location: account_page.php");
    else {
        print("<div id='message'>Wrong login or pass!</div>");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/logging_in.css">
    <title>Document</title>
</head>
<body>

    <!-- header.html -->
    <div w3-include-html="../models/header.php" id="f"></div>

    <div id="form_wrap">
        <div id="form_wrap_content">
            <h1>Logging in</h1>
            <form action="logging_in.php" method="POST">
                Username: <input type="text" name="login"> <br>
                Password: <input type="password" name="passwd"> <br>
                <input type="submit" value="OK" name="submit">
            </form>
            <div id="a_wrap">
                <a href="sign_up.php">Sign up</a> <br>
                <a href="recov_pass.php">Forgot password?</a> <br>
                <a href="../index.php">Back to gallery</a>
            </div>
        </div>
    </div>

    <!-- footer.html -->
    <div w3-include-html="../models/footer.php"></div>

    <script src="../js/other.js"></script>
</body>
</html>

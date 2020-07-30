<?php

require_once("/code/includes/include.php");

if ($_POST['submit'] == "OK" && valid_login($_POST['login'])
    && valid_email($_POST['email']) && valid_pass($_POST['passwd'])) {
    $pdo = db_auth();
    $res = mail($_POST['email'],
    "Camagru account creation",
    "Hello, here is link for account initialization in Camagru web site!\n" .
    "https://" . $_SERVER['HTTP_HOST'] . "/php/verify.php?email=" . $_POST['email']);
	$stmt = $pdo->prepare("INSERT INTO users (login, passwd, email) VALUES (?, ?, ?);");
	$stmt->execute([htmlentities($_POST['login']), hash('whirlpool', $_POST['passwd']), htmlentities($_POST['email'])]);
    header("Location: logging_in.php");
    $pdo = NULL;
    $stmt = NULL;
} else if ($_POST['submit'] == "OK") {
    echo("<div id='message'>Wrong data. Pass, login and email have to contain 5-30 symbols withoud whitespaces.
                            And pass have to contain at least 1 number. </div>");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/sign_up.css">
    <title>Document</title>
</head>
<body>

    <!-- header.html -->
    <div w3-include-html="../models/header.php" id="f"></div>

    <div id="form_wrap">
        <h1>Sign up</h1>
        <form action="sign_up.php" method="post">
            Username <input type="text" name="login"> <br>
            Password <input type="password" name="passwd"> <br>
            Email <input type="text" name="email"> <br>
            <input type="submit" name="submit" value="OK">
        </form> <br>
        <a href="logging_in.php">Back to logging in.</a>
    </div>

    <!-- footer.html -->
    <div w3-include-html="../models/footer.php"></div>

    <script src="../js/other.js"></script>
</body>
</html>


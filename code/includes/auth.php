<?php

require_once("/code/includes/include.php");

function auth($login, $pass)
{
    $pdo = db_auth();
    $stmt = $pdo->prepare("SELECT login, passwd, verify FROM users WHERE login = ?");
    $stmt->execute([$login]);
    $fetch = $stmt->fetchAll();
    $pdo = NULL;
    $stmt = NULL;
    foreach($fetch as $key => $elem)
    {
        if ($elem['passwd'] == hash('whirlpool', $pass) &&
            $elem['login'] == $login &&
            $elem['verify'] == true)
        {
            session_start();
            $_SESSION['logged_on_user'] = $login;
            return (TRUE);
        }
        else
            return (FALSE);
    }
}

?>
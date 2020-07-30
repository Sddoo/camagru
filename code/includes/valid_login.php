<?php

require_once("/code/includes/include.php");

function valid_login($login) {
    $pdo = db_auth();
    if (strlen($login) > 5 && strlen($login) < 30 &&
        preg_match("/\s/", $login) == false &&
        login_exists($pdo, $login) == false) {
        $pdo = NULL;
        return(true);
    } else {
        echo($login);
        $pdo = NULL;
        return(false);
    }
}


?>
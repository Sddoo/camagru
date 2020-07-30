<?php

require_once("/code/includes/include.php");

function valid_pass($pass) {
    $pdo = db_auth();
    if (strlen($pass) > 5 && strlen($pass) < 30 &&
        preg_match("/[0-9]/", $pass) &&
        preg_match("/\s/", $pass) == false &&
        pass_exists($pdo, $pass) == false) {
        $pdo = NULL;
        return(true);
    } else {
        echo($pass);
        $pdo = NULL;
        return(false);
    }
}


?>
<?php

require_once("/code/includes/include.php");

function valid_email($email) {
    $pdo = db_auth();
    if (strlen($email) > 5 && strlen($email) < 30 &&
        preg_match("/\s/", $email) == false &&
        email_exists($pdo, $email) == false) {
        $pdo = NULL;
        return (true);
    } else {
        echo($email);
        $pdo = NULL;
        return (false);
    }
}


?>
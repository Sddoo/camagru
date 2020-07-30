<?php

function db_auth()
{
    require("/code/config/database.php");
    $DB_DSN = "mysql:host=mysql;dbname=camagru;port=3306";
    $DP_OPT = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true
    ];
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPT);
    return($pdo);
}

?>
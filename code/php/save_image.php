<?php

require_once("/code/includes/include.php");
session_start();
date_default_timezone_set("Europe/Moscow");

if ($_REQUEST['submit'] == "OK" && $_SESSION['logged_on_user'])
{
    $image_name = mktime() . ".jpeg";
    $creation_date = date("Y-m-d G:i:s");
    $new_image = fopen("/code/images/" . $image_name, "w");
    $data = $_POST['img_content'];
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = str_replace(' ', '+', $data);
    $data = base64_decode($data);
    fwrite($new_image, $data);
    fclose($new_image);
    try {
        $pdo = db_auth();
        $stmt = $pdo->prepare("INSERT INTO images (login, image_name, creation_date) VALUES (:login, :name, :date);");
        $stmt->execute([':login' => $_SESSION['logged_on_user'], ':name' => $image_name, 'date' => $creation_date]);
        echo($image_name);
        $pdo = NULL;
        $stmt = NULL;
    } catch (Exception $error) {
        echo("Error" . $error->getMessage);
    }
}

?>
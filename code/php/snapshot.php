<?php

require_once("/code/includes/include.php");
session_start();

if ($_REQUEST['submit'] == "OK" && $_SESSION['logged_on_user'])
{
    ob_start();
    if ($_POST["offsetWidth"] == "NaN")
        $_POST["offsetWidth"] = 0;
    if ($_POST["offsetHeight"] == "NaN")
        $_POST["offsetHeight"] = 0;
    $data = $_POST['img_content'];
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = str_replace(' ', '+', $data);
    $data = base64_decode($data);
    $src = imagecreatefrompng("../superposable/" . $_POST["spb_name"]);
    $dst = imagecreatefromstring($data);
    $resolution = getimagesize("../superposable/" . $_POST["spb_name"]);
    imagecopyresampled($dst, $src, $_POST["offsetWidth"], $_POST["offsetHeight"], 0, 0, 200, 200, $resolution[0], $resolution[1]);
    imageinterlace($dst, true);
    header('Content-Type: image/jpg');
    imagejpeg($dst);
    echo(base64_encode(ob_get_clean()));
    imagedestroy($dst);
    imagedestroy($src);
}

?>

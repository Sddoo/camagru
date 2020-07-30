<?php

require_once("/code/includes/include.php");

function fill_gallery($begin, $step) {
    $pdo = db_auth();
    $stmt = $pdo->prepare("SELECT image_name FROM images ORDER BY creation_date DESC");
    $stmt->execute();
    $fetch = $stmt->fetchAll(PDO::FETCH_COLUMN);
    for ($i = $begin; $i - $begin < $step; $i++) {
        if ($fetch[$i] == false) {
            if ($i % 2 == 1)
                $html .= "<div class='flex_item'> </div>";
            $html .= "<div class='flex_item' id='end'> Images ended </div>";
            break;
        }
        $html .= "<div class='flex_item'> <img src='../images/{$fetch[$i]}'> </div>";
    }
    echo($html);
    $pdo = NULL;
    $stmt = NULL;
}

fill_gallery($_GET['begin'], $_GET['step']);

?>

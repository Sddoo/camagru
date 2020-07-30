<?php


require_once("../includes/include.php");
$pdo = db_auth();
$stmt = $pdo->prepare("SELECT login, content, creation_date FROM comments WHERE image_name = ? ORDER BY creation_date ASC");
$stmt->execute([$_GET['image_name']]);
$fetch = $stmt->fetchAll();
foreach ($fetch as $elem) {
    $html .= "<div class='comment'>
                <div class='comment_login'><b>" . $elem['login'] . ":</b></div>
                <div class='comment_content'>" . $elem['content'] . "</div>
                <div class='comment_time'>" . $elem['creation_date'] . "</div>
            </div>";
}
echo($html);
$pdo = NULL;
$stmt = NULL;


?>
<?php


function login_exists($pdo, $login)
{
	$stmt = $pdo->prepare("SELECT login FROM users WHERE login = ?");
	$stmt->execute([$login]);
    $fetch = $stmt->fetchAll();
    if (empty($fetch) == FALSE)
        return(TRUE);
    else
        return(FALSE);
}


?>
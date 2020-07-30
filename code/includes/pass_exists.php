<?php


function pass_exists($pdo, $passwd)
{
    $passwd = hash('whirlpool', $passwd);
	$stmt = $pdo->prepare("SELECT passwd FROM users WHERE passwd = ?");
	$stmt->execute([$passwd]);
    $fetch = $stmt->fetchAll();
    if (empty($fetch) == FALSE)
        return(TRUE);
    else
        return(FALSE);
}


?>
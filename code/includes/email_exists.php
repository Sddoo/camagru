<?php


function email_exists($pdo, $email)
{
	$stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
	$stmt->execute([$email]);
    $fetch = $stmt->fetchAll();
    if (empty($fetch) == FALSE)
        return(TRUE);
    else
        return(FALSE);
}


?>
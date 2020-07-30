<?PHP

function get_user_email($login)
{
    // require_once("/code/includes/include.php");
    $pdo = db_auth();
	$stmt = $pdo->prepare("SELECT email FROM users WHERE login = ?");
    $stmt->execute([$login]);
    $fetch = $stmt->fetchAll();
    $pdo = NULL;
    $stmt = NULL;
    return ($fetch[0]['email']);
}


?>
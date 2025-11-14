<?php
require_once 'includes/session.php';

// 1. Vider le tableau $_SESSION
$_SESSION = array();

// 2. Supprimer le cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Détruire la session
session_destroy();

// 4. Rediriger vers la page de connexion
header("Location: index.php");
exit();
?>


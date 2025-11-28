<?php
session_start();

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

//function isAdmin(): bool
//{
//    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
//}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header("Location: index.php");
        exit();
    }
}

function logout(): void
{
    // 1. Vider le tableau $_SESSION
    $_SESSION = array();

    // 2. Supprimer le cookie de session (PHPSESSID)
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // 3. Détruire la session côté serveur
    session_destroy();
}

function getCurrentUser() {
    if (isLoggedIn()) {
        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'role' => $_SESSION['user_role']
        ];
    }
    return null;
}

function createUserSession($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_role'] = $user['role'];
}
?>
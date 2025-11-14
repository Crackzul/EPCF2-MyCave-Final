<?php
session_start();
header('Content-Type: application/json');
require_once '../includes/session.php';
require_once '../classes/User.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'POST':
        if (isset($_POST['action'])) {
            switch($_POST['action']) {
                case 'login':
                    login();
                    break;
                case 'register':
                    register();
                    break;
                case 'logout':
                    logout();
                    break;
                default:
                    http_response_code(400);
                    echo json_encode(['error' => 'Action non reconnue']);
            }
        }
        break;
    
    case 'GET':
        if (isset($_GET['action']) && $_GET['action'] === 'me') {
            getCurrentUserInfo();
        }
        break;
    
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Méthode non autorisée']);
}

function login() {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(['error' => 'Email et mot de passe requis']);
        return;
    }
    
    $user = new User();
    if ($user->login($email, $password)) {
        createUserSession([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Connexion réussie',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]
        ]);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Email ou mot de passe incorrect']);
    }
}

function register() {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['name'] ?? '';
    
    if (empty($email) || empty($password) || empty($name)) {
        http_response_code(400);
        echo json_encode(['error' => 'Tous les champs sont requis']);
        return;
    }
    
    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode(['error' => 'Le mot de passe doit contenir au moins 6 caractères']);
        return;
    }
    
    $user = new User();
    $user->email = $email;
    $user->password = $password;
    $user->name = $name;
    $user->role = 'user';
    
    if ($user->create()) {
        createUserSession([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ]);
        
        echo json_encode([
            'success' => true,
            'message' => 'Inscription réussie',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur lors de l\'inscription']);
    }
}

function logout() {
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

    echo json_encode(['success' => true, 'message' => 'Déconnexion réussie']);
    exit();
}

function getCurrentUserInfo() {
    if (isLoggedIn()) {
        $user = getCurrentUser();
        echo json_encode([
            'success' => true,
            'user' => $user
        ]);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Non connecté']);
    }
}
?>
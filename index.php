<?php
require_once 'includes/session.php';
require_once 'classes/User.php';

// Si l'utilisateur est déjà connecté, on le redirige vers le dashboard
if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = 'Veuillez remplir tous les champs.';
    } else {
        $user = new User();
        if ($user->login($email, $password)) {
            // Créer la session
            createUserSession([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]);
            // Rediriger vers le dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $error = 'Email ou mot de passe incorrect.';
        }
    }
}

// --- SOLUTION UNIVERSELLE POUR LES CHEMINS ---
// Calcule l'URL de base pour que les liens (CSS, images) fonctionnent partout.
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
// Calcule le chemin du sous-dossier (ex: /Myv12)
$base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$base_url = "$protocol://$host$base_dir/";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Connexion - MyCAVE</title>
  <link rel="stylesheet" href="<?= $base_url ?>assets/css/style.css" />
</head>
<body class="login-page">

  <header class="header-login">
    <img src="<?= $base_url ?>assets/img/logo-large.png" alt="myCAVE logo" class="logo">
    <div class="login-title">
      <h1>Bienvenue sur MyCAVE</h1>
      <p>La plateforme de gestion de cave à vin</p>
    </div>
  </header>

  <main class="login-main">
    <div class="login-card">
      <img src="<?= $base_url ?>assets/img/pexels-hugoml-6314361.jpg" alt="Image cave" class="login-image">
      <form class="login-form" method="POST" action="index.php">
        <h2>Se connecter</h2>
        <?php if ($error): ?>
            <div class="error-message" style="color: #ffb6c1; background: rgba(255,0,0,0.2); padding: 10px; border-radius: 5px; margin-bottom: 1rem; text-align: center;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Connexion</button>
      </form>
    </div>
  </main>

  <footer class="footer-login">
    <p>&copy; <?= date('Y') ?> MyCAVE. Tous droits réservés.</p>
  </footer>

  </body>
</html>

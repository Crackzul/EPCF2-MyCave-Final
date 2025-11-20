<?php
require_once 'includes/session.php';
require_once 'classes/User.php';

// Si l'utilisateur est déjà connecté, on le redirige vers le dashboard
if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}

$error = '';
$success = '';

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Validation des champs
    if (empty($name) || empty($email) || empty($password) || empty($password_confirm)) {
        $error = 'Veuillez remplir tous les champs.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Veuillez entrer une adresse email valide.';
    } elseif (strlen($password) < 6) {
        $error = 'Le mot de passe doit contenir au moins 6 caractères.';
    } elseif ($password !== $password_confirm) {
        $error = 'Les mots de passe ne correspondent pas.';
    } else {
        // Créer le nouvel utilisateur
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->role = 'ROLE_USER';

        if ($user->create()) {
            // Créer automatiquement la session pour l'utilisateur nouvellement inscrit
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
            $error = 'Une erreur est survenue lors de la création du compte. Cet email est peut-être déjà utilisé.';
        }
    }
}

// --- SOLUTION UNIVERSELLE POUR LES CHEMINS ---
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$base_url = "$protocol://$host$base_dir/";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Inscription - MyCAVE</title>
  <link rel="stylesheet" href="<?= $base_url ?>assets/css/style.css" />
</head>
<body class="login-page">

  <header class="header-login">
    <img src="<?= $base_url ?>assets/img/logo-large.png" alt="myCAVE logo" class="logo">
    <div class="login-title">
      <h1>Créer un compte</h1>
      <p>Commencez à gérer votre cave à vin</p>
    </div>
  </header>

  <main class="login-main">
    <div class="login-card">
      <img src="<?= $base_url ?>assets/img/pexels-hugoml-6314361.jpg" alt="Image cave" class="login-image">
      <form class="login-form" method="POST" action="register.php">
        <h2>Inscription</h2>

        <?php if ($error): ?>
            <div class="error-message" style="color: #ffb6c1; background: rgba(255,0,0,0.2); padding: 10px; border-radius: 5px; margin-bottom: 1rem; text-align: center;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-message" style="color: #b6ffb6; background: rgba(0,255,0,0.2); padding: 10px; border-radius: 5px; margin-bottom: 1rem; text-align: center;">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <input type="text" name="name" placeholder="Nom complet" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        <input type="password" name="password" placeholder="Mot de passe (min. 6 caractères)" required>
        <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required>

        <button type="submit">Créer mon compte</button>

        <p style="text-align: center; margin-top: 1rem; color: #ccc;">
          Vous avez déjà un compte ?
          <a href="index.php" style="color: #8b0000; font-weight: bold; text-decoration: none;">Se connecter</a>
        </p>
      </form>
    </div>
  </main>

  <footer class="footer-login">
    <p>&copy; <?= date('Y') ?> MyCAVE. Tous droits réservés.</p>
  </footer>

</body>
</html>


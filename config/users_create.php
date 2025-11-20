<?php
global $pdo;
require_once 'pdo.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $role     = trim($_POST['role'] ?? '');

    if ($username === '') {
        $message = "Le champ username est obligatoire.";
    } else {
        $sql = "INSERT INTO users (username, role) VALUES (:username, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':role'     => $role !== '' ? $role : null,
        ]);
        $message = "Nouvel utilisateur créé avec succès.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un utilisateur</title>
</head>
<body>
<h1>Créer un utilisateur (CREATE)</h1>

<p><a href="users_index.php">← Retour à la liste</a></p>

<?php if ($message) : ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">
    <p>
        <label>Username (obligatoire) :
            <input type="text" name="username" required>
        </label>
    </p>
    <p>
        <label>Rôle (optionnel) :
            <input type="text" name="role" placeholder="ex : admin, user...">
        </label>
    </p>
    <p>
        <button type="submit">Enregistrer</button>
    </p>
</form>
</body>
</html>

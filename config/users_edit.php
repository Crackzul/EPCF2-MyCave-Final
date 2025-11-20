<?php
require_once 'pdo.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    die('ID utilisateur invalide.');
}

$message = '';

// Si formulaire soumis : on met à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $role     = trim($_POST['role'] ?? '');

    if ($username === '') {
        $message = "Le champ username est obligatoire.";
    } else {
        $sql = "UPDATE users
                SET username = :username,
                    role     = :role
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':role'     => $role !== '' ? $role : null,
            ':id'       => $id,
        ]);
        $message = "Utilisateur mis à jour avec succès.";
    }
}

// On recharge les données
$sql = "SELECT id, username, role, created_at FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$user = $stmt->fetch();

if (!$user) {
    die('Utilisateur introuvable.');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un utilisateur</title>
</head>
<body>
<h1>Modifier un utilisateur (UPDATE)</h1>

<p><a href="users_index.php">← Retour à la liste</a></p>

<?php if ($message) : ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">
    <p>
        <label>Username :
            <input type="text" name="username"
                   value="<?= htmlspecialchars($user['username']) ?>" required>
        </label>
    </p>
    <p>
        <label>Rôle :
            <input type="text" name="role"
                   value="<?= htmlspecialchars($user['role'] ?? '') ?>">
        </label>
    </p>
    <p>
        Créé le : <?= htmlspecialchars($user['created_at']) ?>
    </p>
    <p>
        <button type="submit">Enregistrer les modifications</button>
    </p>
</form>
</body>
</html>

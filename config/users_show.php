<?php
require_once 'pdo.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die('ID utilisateur invalide.');
}

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
    <title>Détail utilisateur</title>
</head>
<body>
<h1>Détail d’un utilisateur (READ)</h1>

<p><a href="users_index.php">← Retour à la liste</a></p>

<ul>
    <li>ID : <?= htmlspecialchars($user['id']) ?></li>
    <li>Username : <?= htmlspecialchars($user['username']) ?></li>
    <li>Rôle : <?= htmlspecialchars($user['role'] ?? '') ?></li>
    <li>Créé le : <?= htmlspecialchars($user['created_at']) ?></li>
</ul>
</body>
</html>

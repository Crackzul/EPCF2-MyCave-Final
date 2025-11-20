<?php
require_once 'pdo.php';

$sql = "SELECT id, username, role, created_at FROM users ORDER BY id DESC";
$users = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
</head>
<body>
<h1>Gestion des utilisateurs (CRUD complet)</h1>

<p><a href="users_create.php">Créer un nouvel utilisateur</a></p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Rôle</th>
        <th>Créé le</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($users)) : ?>
        <tr><td colspan="5">Aucun utilisateur pour le moment.</td></tr>
    <?php else : ?>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['role'] ?? '') ?></td>
                <td><?= htmlspecialchars($user['created_at']) ?></td>
                <td>
                    <a href="users_show.php?id=<?= $user['id'] ?>">Voir</a> |
                    <a href="users_edit.php?id=<?= $user['id'] ?>">Modifier</a> |
                    <form action="users_delete.php" method="post" style="display:inline"
                          onsubmit="return confirm('Supprimer cet utilisateur ?');">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <button type="submit">Supprimer</button>
                    </form>

                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>

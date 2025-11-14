<?php
// Ce script génère un hash de mot de passe sécurisé.
// À utiliser pour mettre à jour manuellement les mots de passe dans la base de données.

$passwordToHash = 'supersecret';
$hashedPassword = password_hash($passwordToHash, PASSWORD_DEFAULT);

echo "<h1>Hash du mot de passe</h1>";
echo "<p>Mot de passe original : " . htmlspecialchars($passwordToHash) . "</p>";
echo "<p><strong>Copiez cette valeur et collez-la dans la colonne 'password1' de votre table 'user' :</strong></p>";
echo "<textarea readonly style='width: 100%; height: 80px; font-family: monospace; font-size: 1.2rem;'>" . htmlspecialchars($hashedPassword) . "</textarea>";

?>


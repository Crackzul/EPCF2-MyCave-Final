<?php
require_once 'pdo.php'; // Récupération de la connexion PDO

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0; // Récupération de l'ID envoyé par le formulaire
if ($id <= 0) {
    die('ID utilisateur invalide.');
}

$sql = "DELETE FROM users WHERE id = :id"; // Préparation de la requête DELETE
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]); // Exécution de la requête avec l'ID

header('Location: users_index.php'); // Redirection vers la liste
exit;

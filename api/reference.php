<?php
header('Content-Type: application/json');
require_once '../includes/session.php';
require_once '../config/database.php';

if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorisé']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit();
}

try {
    $database = new Database();
    $conn = $database->getConnection();

    $regionsStmt = $conn->query(
        'SELECT r.id, r.name, c.id AS country_id, c.name AS country ' .
        'FROM region r JOIN country c ON r.country_id = c.id ' .
        'ORDER BY c.name, r.name'
    );
    $regions = $regionsStmt->fetchAll(PDO::FETCH_ASSOC);

    $grapesStmt = $conn->query('SELECT id, name FROM grape ORDER BY name');
    $grapes = $grapesStmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'regions' => $regions,
        'grapes' => $grapes,
    ]);
} catch (Throwable $e) {
    error_log('reference.php - ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Erreur serveur']);
}


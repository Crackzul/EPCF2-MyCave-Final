<?php
// Augmenter les limites pour le téléversement de fichiers
ini_set('upload_max_filesize', '64M');
ini_set('post_max_size', '64M');

header('Content-Type: application/json');
require_once '../includes/session.php';
require_once '../classes/Wine.php';

// Vérifier que l'utilisateur est connecté
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorisé']);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];
$user = getCurrentUser();

switch($method) {
    case 'GET':
        getWines();
        break;
    case 'POST':
        // Gérer la surcharge de méthode pour les mises à jour avec fichiers
        if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
            updateWine();
        } else {
            addWine();
        }
        break;
    case 'PUT':
        updateWine();
        break;
    case 'DELETE':
        deleteWine();
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Méthode non autorisée']);
}

function getWines() {
    global $user;
    
    $wine = new Wine();
    $wines = $wine->getByUserId($user['id']);
    
    echo json_encode([
        'success' => true,
        'wines' => $wines,
        'count' => count($wines)
    ]);
}

function addWine() {
    global $user;
    
    // Valider les données
    $name = $_POST['name'] ?? '';
    $year = $_POST['year'] ?? '';
    $grapes = $_POST['grapes'] ?? '';
    $country = $_POST['country'] ?? '';
    $region = $_POST['region'] ?? '';
    $description = $_POST['description'] ?? '';
    
    if (empty($name) || empty($year) || empty($grapes) || empty($country) || empty($region)) {
        http_response_code(400);
        echo json_encode(['error' => 'Tous les champs obligatoires doivent être remplis']);
        return;
    }
    
    // Gérer l'upload de l'image
    $picture = '';
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
        $picture = uploadImage($_FILES['picture']);
        if (!$picture) {
            http_response_code(400);
            echo json_encode(['error' => 'Erreur lors de l\'upload de l\'image']);
            return;
        }
    }
    
    $wine = new Wine();
    $wine->user_id = $user['id'];
    $wine->name = $name;
    $wine->year = intval($year);
    $wine->grapes = $grapes;
    $wine->country = $country;
    $wine->region = $region;
    $wine->description = $description;
    $wine->picture = $picture;
    
    if ($wine->create()) {
        echo json_encode([
            'success' => true,
            'message' => 'Bouteille ajoutée avec succès',
            'wine_id' => $wine->id
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur lors de l\'ajout de la bouteille']);
    }
}

function updateWine() {
    global $user;
    
    // Les données de formulaire multipart ne sont pas dans php://input
    // On utilise $_POST pour les champs et $_FILES pour les fichiers.
    $wine_id = $_POST['id'] ?? '';

    if (empty($wine_id)) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de la bouteille requis']);
        return;
    }
    
    $wine = new Wine();
    if (!$wine->getById($wine_id)) {
        http_response_code(404);
        echo json_encode(['error' => 'Bouteille non trouvée']);
        return;
    }
    
    // Vérifier que l'utilisateur a le droit de modifier cette bouteille
    if ($wine->user_id != $user['id'] && $user['role'] !== 'admin') {
        http_response_code(403);
        echo json_encode(['error' => 'Non autorisé']);
        return;
    }

    // Gérer la mise à jour de l'image si une nouvelle est fournie
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
        $new_picture = uploadImage($_FILES['picture']);
        if ($new_picture) {
            // Supprimer l'ancienne image si elle existe et est différente
            if ($wine->picture && file_exists('../uploads/' . $wine->picture)) {
                unlink('../uploads/' . $wine->picture);
            }
            $wine->picture = $new_picture;
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Erreur lors de l\'upload de la nouvelle image']);
            return;
        }
    }

    // Mettre à jour les autres champs
    $wine->name = $_POST['name'] ?? $wine->name;
    $wine->year = $_POST['year'] ?? $wine->year;
    $wine->grapes = $_POST['grapes'] ?? $wine->grapes;
    $wine->country = $_POST['country'] ?? $wine->country;
    $wine->region = $_POST['region'] ?? $wine->region;
    $wine->description = $_POST['description'] ?? $wine->description;

    if ($wine->update()) {
        echo json_encode([
            'success' => true,
            'message' => 'Bouteille mise à jour avec succès',
            'wine' => [ 'id' => $wine->id, 'picture' => $wine->picture ]
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur lors de la mise à jour']);
    }
}

function deleteWine() {
    global $user;
    
    $wine_id = $_GET['id'] ?? '';
    
    if (empty($wine_id)) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de la bouteille requis']);
        return;
    }
    
    $wine = new Wine();
    if ($wine->delete($wine_id, $user['id'])) {
        echo json_encode([
            'success' => true,
            'message' => 'Bouteille supprimée avec succès'
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur lors de la suppression']);
    }
}

function uploadImage($file) {
    $upload_dir = '../uploads/';
    
    // Créer le dossier s'il n'existe pas
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // Vérifier le type de fichier
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowed_types)) {
        return false;
    }
    
    // Générer un nom unique
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $filepath = $upload_dir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return $filename;
    }
    
    return false;
}
?>
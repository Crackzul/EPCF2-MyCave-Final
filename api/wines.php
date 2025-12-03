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
        // Si 'id' est présent, c'est une mise à jour, sinon c'est une création
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            updateWine();
        } else {
            addWine();
        }
        break;
    case 'DELETE':
        deleteWine();
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Méthode non autorisée']);
}


function getWines(): void
{
    global $user;
    $wine = new Wine();
    $wines = $wine->getByUserId($user['id']);
    echo json_encode([
        'success' => true,
        'wines' => $wines,
        'count' => count($wines)
    ]);
}

function addWine(): void
{
    global $user;

    $name = trim($_POST['name'] ?? '');
    $year = (int) ($_POST['year'] ?? 0);
    $regionId = (int) ($_POST['region_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $grapeIds = array_map('intval', $_POST['grapes'] ?? []);

    if ($name === '' || $year === 0 || $regionId === 0 || $description === '' || empty($grapeIds)) {
        http_response_code(400);
        echo json_encode(['error' => 'Nom, année, région, cépages et description sont obligatoires.']);
        return;
    }

    $picture = handlePictureUpload();
    if ($picture === false && isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Erreur lors de l\'upload de l\'image']);
        return;
    }

    $wine = new Wine();
    $wine->user_id = $user['id'];
    $wine->region_id = $regionId;
    $wine->name = $name;
    $wine->year = $year;
    $wine->description = $description;
    $wine->picture = $picture;
    $wine->setGrapesByIds($grapeIds);

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

function updateWine(): void
{
    global $user;

    $wine_id = (int) ($_POST['id'] ?? 0);
    if ($wine_id === 0) {
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

    if ($wine->user_id != $user['id'] && $user['role'] !== 'admin') {
        http_response_code(403);
        echo json_encode(['error' => 'Non autorisé']);
        return;
    }

    $name = trim($_POST['name'] ?? $wine->name);
    $year = (int) ($_POST['year'] ?? $wine->year);
    $regionId = (int) ($_POST['region_id'] ?? $wine->region_id);
    $description = trim($_POST['description'] ?? $wine->description);
    $grapeIds = isset($_POST['grapes']) ? array_map('intval', $_POST['grapes']) : $wine->grapes;

    if ($name === '' || $year === 0 || $regionId === 0 || $description === '' || empty($grapeIds)) {
        http_response_code(400);
        echo json_encode(['error' => 'Nom, année, région, cépages et description sont obligatoires.']);
        return;
    }

    $newPicture = handlePictureUpload($wine->picture);
    if ($newPicture === false && isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Erreur lors de l\'upload de la nouvelle image']);
        return;
    }

    $wine->name = $name;
    $wine->year = $year;
    $wine->region_id = $regionId;
    $wine->description = $description;
    if ($newPicture) {
        $wine->picture = $newPicture;
    }
    $wine->setGrapesByIds($grapeIds);

    if ($wine->update()) {
        echo json_encode([
            'success' => true,
            'message' => 'Bouteille mise à jour avec succès',
            'wine' => ['id' => $wine->id, 'picture' => $wine->picture]
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur lors de la mise à jour']);
    }
}

function deleteWine(): void
{
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

function handlePictureUpload(string $currentPicture = '')
{
    if (!isset($_FILES['picture']) || $_FILES['picture']['error'] !== 0) {
        return $currentPicture ?: '';
    }

    $upload_dir = '../uploads/';
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['picture']['type'], $allowed_types)) {
        return false;
    }

    $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;
    $filepath = $upload_dir . $filename;

    if (move_uploaded_file($_FILES['picture']['tmp_name'], $filepath)) {
        if ($currentPicture && file_exists($upload_dir . $currentPicture)) {
            unlink($upload_dir . $currentPicture);
        }
        return $filename;
    }

    return false;
}
?>
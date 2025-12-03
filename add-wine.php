<?php
require_once 'includes/session.php';
require_once 'classes/Wine.php';

// Vérifier que l'utilisateur est connecté
requireLogin();

$user = getCurrentUser();
$wine = new Wine();
$isEdit = false;
$wineData = null;

// Chargement des options par défaut (utilisé uniquement côté PHP si JS indispo)
$defaultRegions = [];
$defaultGrapes = [];
try {
    $database = new Database();
    $conn = $database->getConnection();
    $regionStmt = $conn->query('SELECT r.id, r.name, c.name AS country FROM region r JOIN country c ON r.country_id = c.id ORDER BY c.name, r.name');
    $defaultRegions = $regionStmt->fetchAll(PDO::FETCH_ASSOC);
    $grapeStmt = $conn->query('SELECT id, name FROM grape ORDER BY name');
    $defaultGrapes = $grapeStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    error_log('add-wine preload - ' . $e->getMessage());
}

// Vérifier si on est en mode édition
if (isset($_GET['id'])) {
    $wineId = intval($_GET['id']);
    if ($wine->getById($wineId)) {
        // Vérifier que l'utilisateur a le droit de modifier cette bouteille
        if ($wine->user_id == $user['id'] || $user['role'] === 'admin') {
            $isEdit = true;
            $wineData = [
                'id' => $wine->id,
                'name' => $wine->name,
                'year' => $wine->year,
                'grapes' => $wine->grapes,
                'country' => $wine->country,
                'region' => $wine->region,
                'region_id' => $wine->region_id,
                'description' => $wine->description,
                'picture' => $wine->picture
            ];
        } else {
            header("Location: dashboard.php");
            exit();
        }
    }
}

$wineCount = $wine->countByUserId($user['id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $isEdit ? 'Modifier' : 'Ajouter' ?> une bouteille – MyCave</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body class="add-wine">
  <header class="add-wine-header">
    <div class="header-content">
      <img src="assets/img/logo-large.png" alt="myCAVE logo" class="logo">
      <div class="header-text">
        <h1>Bienvenue dans votre cave <?= htmlspecialchars($user['name']) ?></h1>
        <p>Elle contient déjà <span id="bottle-count"><?= $wineCount ?></span> bouteilles</p>
      </div>
    </div>
  </header>

  <main class="add-wine-main">
    <div class="background-form">
      <img src="assets/img/ChatGPT Image 16 juil. 2025, 11_16_29.png" alt="Cave background" class="cave-image">
    </div>

    <div class="add-wine-modal">
      <div class="modal-header">
        <button class="btn-back" onclick="window.location.href='dashboard.php'">← Retour</button>
        <h2><?= $isEdit ? 'Modifier votre bouteille' : 'Ajouter votre nouvelle bouteille' ?></h2>
      </div>

      <form class="add-wine-form" id="wineForm" enctype="multipart/form-data">
        <?php if ($isEdit): ?>
        <input type="hidden" name="wine_id" value="<?= $wineData['id'] ?>">
        <?php endif; ?>
        
        <div class="form-group">
          <label>Nom du vin</label>
          <input type="text" name="name" placeholder="Nom du vin" required 
                 value="<?= $isEdit ? htmlspecialchars($wineData['name']) : '' ?>">
        </div>

        <div class="form-group">
          <label>Année</label>
          <input type="number" name="year" placeholder="Année" min="1900" max="2025" required
                 value="<?= $isEdit ? $wineData['year'] : '' ?>">
        </div>

        <div class="form-group">
          <label>Cépages</label>
          <div id="grape-list" class="grape-list">
            <?php foreach ($defaultGrapes as $grape): ?>
              <label class="grape-option">
                <input type="checkbox" name="grapes[]" value="<?= $grape['id'] ?>">
                <span><?= htmlspecialchars($grape['name']) ?></span>
              </label>
            <?php endforeach; ?>
          </div>
          <small>Sélectionnez au moins un cépage</small>
        </div>

        <div class="form-group region-select-group">
          <span id="regionLabel" class="region-label">Région d'origine</span>
          <div class="region-select-wrapper">
            <select name="region_id" id="regionSelect" class="region-select" aria-labelledby="regionLabel" required>
              <option value="">Choisissez votre région</option>
              <?php foreach ($defaultRegions as $region): ?>
                <option value="<?= $region['id'] ?>" data-country="<?= htmlspecialchars($region['country']) ?>">
                  <?= htmlspecialchars($region['name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <span class="region-select-arrow" aria-hidden="true"></span>
          </div>
          <small id="countryDisplay">Pays associé : —</small>
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea name="description" placeholder="Description du vin" rows="3" required><?= $isEdit ? htmlspecialchars($wineData['description']) : '' ?></textarea>
        </div>

        <div class="form-group">
          <label>Photo</label>
          <?php if ($isEdit && $wineData['picture']): ?>
          <div class="current-picture">
            <img src="uploads/<?= htmlspecialchars($wineData['picture']) ?>" alt="Image actuelle">
            <small>Image actuelle</small>
          </div>
          <?php endif; ?>
          <input type="file" name="picture" accept="image/*">
          <?php if ($isEdit): ?>
          <small class="hint-text">Laissez vide pour conserver l'image actuelle</small>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn-submit">
          <img src="assets/img/disquette.svg" alt="" class="icon-svg" aria-hidden="true">
          <?= $isEdit ? 'Mettre à jour' : 'Enregistrer' ?> la bouteille
        </button>
      </form>

      <div id="message" class="message" style="display: none;"></div>
    </div>
  </main>

  <footer class="add-wine-footer">
    <p>© 2025 MyCave - Votre cave à vin digitale</p>
  </footer>

  <script>
    const isEdit = <?= $isEdit ? 'true' : 'false' ?>;
    const wineData = <?= $isEdit ? json_encode($wineData) : 'null' ?>;
    const defaultRegions = <?= json_encode($defaultRegions) ?>;
    const defaultGrapes = <?= json_encode($defaultGrapes) ?>;

    const referenceEndpoint = 'api/reference.php';

    document.addEventListener('DOMContentLoaded', async () => {
      await hydrateReferenceData();
      if (isEdit && wineData) {
        prefillForm();
      }
    });

    async function hydrateReferenceData() {
      try {
        const response = await fetch(referenceEndpoint);
        if (!response.ok) throw new Error('fetch reference');
        const data = await response.json();
        if (!data.success) throw new Error('reference payload');
        populateRegions(data.regions);
        populateGrapes(data.grapes);
      } catch (error) {
        console.warn('Impossible de charger les références depuis l\'API, fallback sur défauts.', error);
        populateRegions(defaultRegions);
        populateGrapes(defaultGrapes);
      }
    }

    function populateRegions(regions) {
      const select = document.getElementById('regionSelect');
      select.innerHTML = '<option value="">Choisissez une région</option>';
      regions.forEach(region => {
        const option = document.createElement('option');
        option.value = region.id;
        option.textContent = region.name;
        option.dataset.country = region.country;
        select.appendChild(option);
      });
      select.addEventListener('change', updateCountryDisplay);
      updateCountryDisplay();
    }

    function populateGrapes(grapes) {
      const container = document.getElementById('grape-list');
      container.innerHTML = '';
      grapes.forEach(grape => {
        const label = document.createElement('label');
        label.className = 'grape-option';
        const input = document.createElement('input');
        input.type = 'checkbox';
        input.name = 'grapes[]';
        input.value = grape.id;
        const span = document.createElement('span');
        span.textContent = grape.name;
        label.appendChild(input);
        label.appendChild(span);
        container.appendChild(label);
      });
    }

    function updateCountryDisplay() {
      const select = document.getElementById('regionSelect');
      const selected = select.options[select.selectedIndex];
      const country = selected ? (selected.dataset.country || '—') : '—';
      document.getElementById('countryDisplay').textContent = `Pays associé : ${country}`;
    }

    function prefillForm() {
      document.querySelectorAll('input[name="grapes[]"]').forEach(input => {
        if (wineData.grapes && wineData.grapes.split(',').map(g => g.trim().toLowerCase()).includes(input.nextElementSibling.textContent.toLowerCase())) {
          input.checked = true;
        }
      });
      if (wineData.region_id) {
        const regionSelect = document.getElementById('regionSelect');
        regionSelect.value = wineData.region_id;
        updateCountryDisplay();
      }
    }

    document.getElementById('wineForm').addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(e.target);
      const checkedGrapes = Array.from(document.querySelectorAll('input[name="grapes[]"]:checked')).map(input => input.value);
      if (checkedGrapes.length === 0) {
        showMessage('Sélectionnez au moins un cépage', 'error');
        return;
      }
      formData.delete('grapes[]');
      checkedGrapes.forEach(value => formData.append('grapes[]', value));

      if (isEdit) {
        formData.append('id', wineData.id);
      }

      try {
        const response = await fetch('api/wines.php', {
          method: 'POST', // POST en création et édition
          body: formData
        });

        const data = await response.json();
        
        if (data.success) {
          showMessage(data.message || 'Bouteille sauvegardée avec succès !', 'success');
          setTimeout(() => {
            window.location.href = 'dashboard.php';
          }, 1500);
        } else {
          showMessage(data.error || 'Erreur lors de la sauvegarde', 'error');
        }
      } catch (error) {
        showMessage('Erreur de connexion au serveur', 'error');
        console.error('Erreur:', error);
      }
    });

    function showMessage(message, type) {
      const messageDiv = document.getElementById('message');
      messageDiv.textContent = message;
      messageDiv.style.display = 'block';
      messageDiv.style.padding = '1rem';
      messageDiv.style.borderRadius = '8px';
      messageDiv.style.marginTop = '1rem';
      messageDiv.style.fontWeight = 'bold';
      
      if (type === 'success') {
        messageDiv.style.background = 'rgba(0, 255, 0, 0.2)';
        messageDiv.style.border = '1px solid rgba(0, 255, 0, 0.5)';
        messageDiv.style.color = '#90EE90';
      } else {
        messageDiv.style.background = 'rgba(255, 0, 0, 0.2)';
        messageDiv.style.border = '1px solid rgba(255, 0, 0, 0.5)';
        messageDiv.style.color = '#FFB6C1';
      }
      
      setTimeout(() => {
        messageDiv.style.display = 'none';
      }, 5000);
    }

    // Pré-remplir le formulaire en mode édition
    if (isEdit && wineData) {
      console.log('Mode édition - Données chargées:', wineData);
    }
  </script>
</body>
</html>
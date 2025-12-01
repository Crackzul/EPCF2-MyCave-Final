# 🎯 SECTION CRUD - Présentation Détaillée
## Gestion Complète des Vins (Create, Read, Update, Delete)

---

## 📋 SLIDE : LE CRUD EN ACTION

### **Titre de la slide :** "CRUD Complet - Gestion des Vins"

### **Structure de la slide :**

```
┌─────────────────────────────────────────────────────────────┐
│             OPÉRATIONS CRUD SUR LES VINS                    │
└─────────────────────────────────────────────────────────────┘

┌──────────────┐  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐
│   CREATE     │  │     READ     │  │   UPDATE     │  │   DELETE     │
├──────────────┤  ├──────────────┤  ├──────────────┤  ├──────────────┤
│              │  │              │  │              │  │              │
│ Formulaire   │  │ Dashboard    │  │ Formulaire   │  │ Confirmation │
│ 7 champs +   │  │ Affichage    │  │ pré-rempli   │  │ Modal +      │
│ upload image │  │ en grille    │  │ + upload     │  │ suppression  │
│              │  │              │  │              │  │              │
│ POST         │  │ GET          │  │ POST+id      │  │ DELETE       │
│ api/wines    │  │ api/wines    │  │ api/wines    │  │ api/wines    │
│              │  │              │  │              │  │              │
│ JSON success │  │ JSON success │  │ JSON success │  │ JSON success │
└──────────────┘  └──────────────┘  └──────────────┘  └──────────────┘

         Architecture : API REST unique + Méthodes HTTP
         Sécurité : user_id vérifié sur CHAQUE opération
```

---

## 🎤 SCRIPT ORAL COMPLET (3-4 minutes)

### **Introduction (15 secondes)**
> "Au cœur de MyCave se trouve un système CRUD complet qui permet aux utilisateurs de gérer leurs vins de manière intuitive et sécurisée. CRUD signifie Create, Read, Update, Delete : les quatre opérations fondamentales sur les données. Je vais vous détailler chacune d'elles."

---

### **1️⃣ CREATE - Création d'un vin (45 secondes)**

**À dire :**
> "**Première opération : CREATE, la création d'un nouveau vin.**
>
> L'utilisateur clique sur 'Ajouter un vin' et accède à un formulaire avec 7 champs :
> - Nom du vin (obligatoire)
> - Année / Millésime (obligatoire)
> - Cépages (obligatoire) - par exemple "Cabernet Sauvignon, Merlot"
> - Pays (obligatoire)
> - Région (obligatoire) - par exemple "Bordeaux", "Bourgogne"
> - Description (zone de texte libre pour les notes de dégustation)
> - Et l'upload d'une photo de la bouteille
>
> Côté technique, lorsque l'utilisateur soumet le formulaire :
> - Le JavaScript envoie les données en **FormData** via une requête POST à l'API
> - Le serveur valide l'image : type MIME (JPEG/PNG/GIF), formats standards acceptés
> - L'image est enregistrée dans le dossier `uploads/` avec un nom unique généré par `uniqid()` suivi de l'extension
> - Les données sont insérées en base via une **requête préparée PDO** avec la méthode `create()` de la classe Wine
> - L'API renvoie un JSON avec `success: true` et l'ID du vin créé (`lastInsertId()`)
> - Le dashboard se met à jour automatiquement sans rechargement de page"

**Extrait de code à montrer (optionnel) :**
```php
// classes/Wine.php - Méthode create() (lignes 23-45)
public function create() {
    $query = "INSERT INTO " . $this->table_name . " 
              SET user_id=:user_id, name=:name, year=:year, grapes=:grapes, 
                  country=:country, region=:region, description=:description, picture=:picture";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":year", $this->year);
    $stmt->bindParam(":grapes", $this->grapes);
    $stmt->bindParam(":country", $this->country);
    $stmt->bindParam(":region", $this->region);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":picture", $this->picture);

    if($stmt->execute()) {
        $this->id = $this->conn->lastInsertId(); // Récupération de l'ID auto-généré
        return true;
    }
    return false;
}

// api/wines.php - Fonction addWine() (lignes 51-97)
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
        $picture = uploadImage($_FILES['picture']); // Fonction d'upload sécurisée
        if (!$picture) {
            http_response_code(400);
            echo json_encode(['error' => 'Erreur lors de l\'upload de l\'image']);
            return;
        }
    }
    
    $wine = new Wine();
    $wine->user_id = $user['id'];
    $wine->name = $name;
    $wine->year = intval($year); // Conversion en entier
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
```

---

### **2️⃣ READ - Lecture et affichage (45 secondes)**

**À dire :**
> "**Deuxième opération : READ, la lecture des données.**
>
> Dès que l'utilisateur se connecte et arrive sur le dashboard :
> - Une requête **GET** est envoyée automatiquement à l'API via JavaScript Fetch
> - L'API récupère UNIQUEMENT les vins de l'utilisateur connecté grâce à la clause `WHERE user_id = :user_id`
> - Cette isolation des données est cruciale pour la sécurité : un utilisateur ne peut JAMAIS voir les vins d'un autre
> - Les données sont renvoyées au format JSON avec un objet contenant `success: true`, le tableau `wines` et le `count` total
> - Le JavaScript parcourt le tableau de vins et génère dynamiquement les cartes HTML
> - Chaque carte affiche : la photo, le nom, l'année, les cépages, le pays et la région
> - Un compteur en haut indique le nombre total de bouteilles dans la cave
> - Le tout est responsive : 3 colonnes sur desktop, 2 sur tablette, 1 sur mobile"

**Extrait de code à montrer (optionnel) :**
```php
// classes/Wine.php - Méthode getByUserId() (lignes 47-58)
public function getByUserId($user_id) {
    $query = "SELECT * FROM " . $this->table_name . " 
              WHERE user_id = :user_id 
              ORDER BY created_at DESC";

    $stmt = $this->conn->prepare($query); // Requête préparée pour éviter les injections SQL
    $stmt->bindParam(":user_id", $user_id); // Sécurisation de la variable user_id
    $stmt->execute(); // Exécution de la requête

    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération de tous les résultats sous forme de tableau associatif
}

// api/wines.php - Fonction getWines() (lignes 41-50)
function getWines() {
    global $user;
    
    $wine = new Wine(); // Création d'un objet Wine
    $wines = $wine->getByUserId($user['id']); // Récupérer les bouteilles de l'utilisateur
    
    echo json_encode([
        'success' => true,
        'wines' => $wines,
        'count' => count($wines)
    ]);
}
```

**JavaScript (dashboard.php) :**
```javascript
async function loadWines() {
    try {
        const response = await fetch('api/wines.php');
        const data = await response.json();
        
        if (data.success) {
            displayWines(data.wines);
            updateCounter(data.count);
        }
    } catch (error) {
        showError('Erreur de chargement des vins');
    }
}
```

---

### **3️⃣ UPDATE - Mise à jour (1 minute)**

**À dire :**
> "**Troisième opération : UPDATE, la modification d'un vin existant.**
>
> Sur chaque carte de vin, il y a une icône crayon. Lorsque l'utilisateur clique dessus :
> - Le JavaScript récupère l'ID du vin
> - Une requête charge les données actuelles du vin depuis l'API
> - Le formulaire s'ouvre **pré-rempli** avec toutes les informations existantes
> - L'utilisateur peut modifier n'importe quel champ
> - Il peut également **changer la photo** ou la conserver
>
> Côté technique, voici comment ça fonctionne :
> - Le formulaire envoie une requête **POST** (comme pour la création)
> - La différence : un champ caché `id` est inclus dans le FormData
> - Côté serveur, dans `api/wines.php`, je détecte la présence de ce champ `id` dans $_POST
> - Si l'ID est présent, je route vers la fonction `updateWine()` au lieu de `addWine()`
> - Cette approche est plus simple que la simulation PUT et fonctionne parfaitement avec FormData et l'upload de fichiers
>
> Niveau sécurité :
> - La requête SQL UPDATE inclut **deux conditions** : `WHERE id = :id AND user_id = :user_id`
> - Cela garantit qu'un utilisateur ne peut JAMAIS modifier un vin qui ne lui appartient pas, même s'il trafique l'ID dans la requête
> - Je vérifie également côté serveur que le `user_id` du vin correspond bien à l'utilisateur connecté avant toute modification
> - Si une nouvelle image est uploadée, l'ancienne est supprimée du serveur avec `unlink()` pour économiser l'espace disque
> - L'API renvoie un JSON avec `success: true` et les informations du vin mis à jour"

**Extrait de code à montrer (optionnel) :**
```php
// classes/Wine.php - Méthode update() (lignes 88-103)
public function update() {
    $query = "UPDATE " . $this->table_name . " 
              SET name=:name, year=:year, grapes=:grapes, country=:country, 
                  region=:region, description=:description, picture=:picture 
              WHERE id=:id AND user_id=:user_id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":year", $this->year);
    $stmt->bindParam(":grapes", $this->grapes);
    $stmt->bindParam(":country", $this->country);
    $stmt->bindParam(":region", $this->region);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":picture", $this->picture);
    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":user_id", $this->user_id);

    return $stmt->execute();
}

// api/wines.php - Fonction updateWine() (lignes 103-155)
function updateWine() {
    global $user;

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
    if ($wine->user_id != $user['id']) {
        http_response_code(403);
        echo json_encode(['error' => 'Non autorisé']);
        return;
    }

    // Gérer la mise à jour de l'image si une nouvelle est fournie
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
        $new_picture = uploadImage($_FILES['picture']);
        if ($new_picture) {
            // Supprimer l'ancienne image si elle existe
            if ($wine->picture && file_exists('../uploads/' . $wine->picture)) {
                unlink('../uploads/' . $wine->picture);
            }
            $wine->picture = $new_picture;
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
```

**Gestion dans api/wines.php (lignes 21-34) :**
```php
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
```

---

### **4️⃣ DELETE - Suppression (45 secondes)**

**À dire :**
> "**Quatrième et dernière opération : DELETE, la suppression d'un vin.**
>
> Sur chaque carte, il y a une icône poubelle. Lorsque l'utilisateur clique dessus :
> - Un modal JavaScript apparaît avec le message 'Êtes-vous sûr de vouloir supprimer ce vin ?'
> - Cette confirmation évite les suppressions accidentelles
> - Si l'utilisateur confirme, une requête **DELETE** est envoyée à l'API avec l'ID du vin en paramètre
>
> Côté serveur :
> - La fonction `deleteWine()` récupère l'ID depuis `$_GET['id']`
> - La requête SQL vérifie : `WHERE id = :id AND user_id = :user_id` (double sécurité)
> - Cette double condition garantit qu'un utilisateur ne peut supprimer QUE ses propres vins
> - L'enregistrement est supprimé de la base de données
> - L'API renvoie un JSON avec `success: true` et un message de confirmation
>
> Côté client :
> - La carte disparaît dynamiquement de l'interface
> - Le compteur se décrémente automatiquement
> - Un message de confirmation s'affiche : 'Bouteille supprimée avec succès'
> - Tout cela sans rechargement de page grâce à JavaScript Fetch et async/await"

**Extrait de code à montrer (optionnel) :**
```php
// classes/Wine.php - Méthode delete() (lignes 107-115)
public function delete($id, $user_id) {
    $query = "DELETE FROM " . $this->table_name . " 
              WHERE id = :id AND user_id = :user_id";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":user_id", $user_id);
    
    return $stmt->execute();
}

// api/wines.php - Fonction deleteWine() (lignes 169-186)
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
```

**JavaScript (dashboard.php) :**
```javascript
async function deleteWine(id) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer ce vin ?')) {
        return;
    }
    
    try {
        const response = await fetch(`api/wines.php?id=${id}`, {
            method: 'DELETE'
        });
        
        const data = await response.json();
        
        if (data.success) {
            showSuccess('Vin supprimé avec succès');
            loadWines(); // Recharger la liste
        } else {
            showError(data.error);
        }
    } catch (error) {
        showError('Erreur lors de la suppression');
    }
}
```

---

## 🔐 SECTION SÉCURITÉ DU CRUD (30 secondes)

**À dire :**
> "**Un point crucial sur la sécurité du CRUD :**
>
> Sur CHAQUE opération (Create, Read, Update, Delete), je vérifie :
> 1. Que l'utilisateur est **authentifié** (session PHP active)
> 2. Que le `user_id` correspond bien à l'utilisateur connecté
> 3. Pour Update et Delete : que le vin appartient bien à cet utilisateur
>
> Si une de ces vérifications échoue, l'API renvoie un **code HTTP 401** (Non autorisé) et stoppe l'opération.
>
> C'est ce qu'on appelle l'**isolation des données** : techniquement impossible pour un utilisateur d'accéder aux vins d'un autre, même en trafiquant les requêtes."

---

## 📊 TABLEAU RÉCAPITULATIF (à afficher sur slide)

| Opération | Méthode HTTP | Endpoint | Validation | Réponse Succès | Action BDD |
|-----------|-------------|----------|------------|-------------|------------|
| **CREATE** | POST | api/wines.php | Image (JPEG/PNG/GIF) + champs obligatoires | `{success: true, wine_id}` | INSERT INTO wine |
| **READ** | GET | api/wines.php | Session user_id | `{success: true, wines, count}` | SELECT WHERE user_id |
| **UPDATE** | POST + id | api/wines.php | Image + user_id + isset($_POST['id']) | `{success: true, wine}` | UPDATE WHERE id AND user_id |
| **DELETE** | DELETE | api/wines.php?id=X | user_id | `{success: true, message}` | DELETE WHERE id AND user_id |

**Sécurité commune à toutes :**
- ✅ Authentification par session PHP (vérifiée au début de api/wines.php)
- ✅ Requêtes préparées PDO (anti-injection SQL)
- ✅ Vérification user_id sur chaque opération
- ✅ Validation côté serveur (jamais confiance au client)

**Point technique UPDATE :**
- Détection via `isset($_POST['id'])` : si présent → updateWine(), sinon → addWine()
- Approche simple et efficace pour gérer FormData avec upload de fichiers

---

## 🎯 POINTS CLÉS À MARTELER

1. **Architecture RESTful** : Une seule URL, plusieurs méthodes HTTP
2. **Sécurité par conception** : user_id vérifié à chaque étape
3. **UX fluide** : Pas de rechargement de page (JavaScript async/await)
4. **Gestion complète des fichiers** : Upload, validation, suppression
5. **Codes HTTP explicites** : 200, 201, 401, 404 selon le contexte

---

## 💡 QUESTIONS FRÉQUENTES SUR LE CRUD

### Q1 : "Pourquoi POST pour la modification au lieu de PUT ?"
**Réponse :**
> "J'ai choisi une approche pragmatique : utiliser POST pour la création ET la modification, avec une distinction par la présence du champ `id`. 
>
> Pourquoi ce choix ?
> - FormData (nécessaire pour l'upload de fichiers) fonctionne naturellement avec POST
> - Côté serveur, je détecte simplement `isset($_POST['id'])` pour router vers la bonne fonction
> - C'est plus simple et plus lisible que de simuler PUT avec un paramètre `_method`
> - L'essentiel de REST est respecté : une API cohérente, des réponses JSON structurées, des codes HTTP appropriés
>
> L'important n'est pas d'utiliser PUT à tout prix, mais d'avoir une architecture claire, sécurisée et maintenable."

### Q2 : "Comment gérez-vous les erreurs ?"
**Réponse :**
> "Trois niveaux de gestion :
> 1. **Validation front-end** : HTML5 (required, type=number) + JavaScript avant envoi
> 2. **Validation back-end** : Vérification de chaque champ + image (type, taille)
> 3. **Gestion des erreurs PDO** : Try/catch avec messages explicites renvoyés en JSON
>
> Si une erreur survient, l'API renvoie un code HTTP approprié (400, 401, 500) avec un message JSON clair."

### Q3 : "Pourquoi ne pas utiliser Ajax/jQuery ?"
**Réponse :**
> "J'ai choisi les standards modernes : Fetch API et async/await font partie du JavaScript natif ES6+. Pas besoin de bibliothèque externe, le code est plus léger, plus rapide et suit les bonnes pratiques actuelles."

### Q4 : "Comment testez-vous le CRUD ?"
**Réponse :**
> "Actuellement, tests manuels avec différents scénarios :
> - Création avec/sans image
> - Modification avec changement d'image
> - Suppression multiple
> - Tests de sécurité : tentative d'accès aux vins d'un autre user
>
> Perspective d'amélioration : ajouter des tests automatisés avec PHPUnit pour le back-end."

---

## 📸 CAPTURES D'ÉCRAN À MONTRER PENDANT L'EXPLICATION

1. **CREATE** : Formulaire vide avec 7 champs + bouton upload
2. **READ** : Dashboard avec grille de cartes (3 colonnes)
3. **UPDATE** : Formulaire pré-rempli avec bouton "Modifier" actif
4. **DELETE** : Modal de confirmation "Êtes-vous sûr ?"
5. **Code** : Extrait de classes/Wine.php avec méthodes CRUD
6. **API** : Extrait de api/wines.php avec switch des méthodes HTTP

---

## ⏱️ TIMING RECOMMANDÉ

- **Introduction CRUD** : 15 sec
- **CREATE** : 45 sec
- **READ** : 45 sec
- **UPDATE** : 1 min
- **DELETE** : 45 sec
- **Sécurité** : 30 sec
- **Tableau récapitulatif** : 15 sec

**TOTAL : 4 minutes** ✅

---

## 🚀 PHRASE DE TRANSITION

**Pour passer à la section suivante :**
> "Voilà pour les opérations CRUD qui constituent le cœur fonctionnel de MyCave. Maintenant que vous avez vu COMMENT ça fonctionne, je vais vous montrer le CODE derrière ces opérations et les bonnes pratiques que j'ai appliquées."

---

## ✨ CONSEIL FINAL

**Pendant la démo live, MONTREZ le CRUD en action :**
1. Créez un vin devant le jury (30 sec)
2. Montrez la liste qui se met à jour (10 sec)
3. Modifiez ce vin (20 sec)
4. Supprimez-le (20 sec)

**Total démo : 1 min 20** qui viendra en complément des 4 minutes d'explication théorique.

**Effet garanti : le jury voit que ça fonctionne vraiment ! 🎉**


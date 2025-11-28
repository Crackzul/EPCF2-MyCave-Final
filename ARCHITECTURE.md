# Architecture MyCave

## 🏗️ Vue d'ensemble

MyCave utilise une **architecture hybride** combinant :
- **Authentification traditionnelle** (formulaires PHP + sessions)
- **API REST** pour la gestion des vins (interface dynamique)

---

## 📂 Structure des dossiers

```
Myv12/
├── api/
│   └── wines.php              # Endpoint REST unique (CRUD vins)
├── assets/
│   ├── css/                   # CSS compilé depuis SCSS
│   ├── scss/                  # Sources SCSS (abstract, base, components, layout)
│   ├── fonts/                 # Police Source Sans Pro
│   └── img/                   # Images, logos, icônes SVG
├── classes/
│   ├── User.php               # Classe métier utilisateurs
│   └── Wine.php               # Classe métier vins
├── config/
│   └── database.php           # Connexion PDO singleton
├── database/
│   └── schema.sql             # Script de création BDD
├── includes/
│   └── session.php            # Gestion sessions (isLoggedIn, createUserSession, etc.)
├── uploads/                   # Images bouteilles uploadées
├── index.php                  # Page de connexion
├── register.php               # Page d'inscription
├── dashboard.php              # Tableau de bord (liste vins)
├── add-wine.php               # Formulaire ajout/édition vin
└── logout.php                 # Déconnexion
```

---

## 🔐 Authentification (Architecture traditionnelle)

### Flux de connexion
```
┌─────────────────────────────────────────────────────────────┐
│  1. Utilisateur remplit formulaire sur index.php           │
└───────────────────────────┬─────────────────────────────────┘
                            │ POST email + password
                            ↓
┌─────────────────────────────────────────────────────────────┐
│  2. index.php traite le formulaire                          │
│     - Récupère $_POST['email'] et $_POST['password']        │
│     - Instancie User::login($email, $password)              │
└───────────────────────────┬─────────────────────────────────┘
                            │
                            ↓
┌─────────────────────────────────────────────────────────────┐
│  3. User.php (classes/User.php)                             │
│     - Requête préparée PDO : SELECT * FROM users            │
│     - Vérification : password_verify($password, $hash)      │
│     - Retourne true/false                                   │
└───────────────────────────┬─────────────────────────────────┘
                            │
                            ↓
┌─────────────────────────────────────────────────────────────┐
│  4. includes/session.php                                    │
│     - createUserSession([id, name, email, role])            │
│     - $_SESSION['user'] = [...]                             │
└───────────────────────────┬─────────────────────────────────┘
                            │
                            ↓
┌─────────────────────────────────────────────────────────────┐
│  5. Redirection vers dashboard.php                          │
│     header("Location: dashboard.php")                       │
└─────────────────────────────────────────────────────────────┘
```

### Composants
- **`index.php`** : Formulaire HTML → POST vers lui-même
- **`register.php`** : Formulaire HTML → POST vers lui-même
- **`logout.php`** : Script de déconnexion → `session_destroy()`
- **`classes/User.php`** : Logique métier (login, create, emailExists)
- **`includes/session.php`** : Helpers session (isLoggedIn, getCurrentUser, requireLogin)

**⚠️ Pas d'API REST pour l'authentification** : tout se passe côté serveur avec sessions PHP.

---

## 🔌 API REST (Gestion des vins)

### Endpoint unique : `api/wines.php`

#### Méthodes HTTP supportées

| Méthode | Route | Description | Authentification |
|---------|-------|-------------|------------------|
| **GET** | `/api/wines.php` | Liste des vins de l'utilisateur | Session requise |
| **POST** | `/api/wines.php` | Créer une nouvelle bouteille | Session requise |
| **PUT** | `/api/wines.php` | Modifier une bouteille existante | Session requise + ownership |
| **DELETE** | `/api/wines.php?id={id}` | Supprimer une bouteille | Session requise + ownership |

#### Authentification API
```php
// Lignes 11-15 de api/wines.php
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorisé']);
    exit();
}
```

Chaque requête vérifie la session PHP via `isLoggedIn()` avant de traiter.

#### Exemples de réponses

**GET** - Succès :
```json
{
  "success": true,
  "wines": [
    {
      "id": "1",
      "name": "Château Margaux",
      "year": "2015",
      "grapes": "Cabernet Sauvignon, Merlot",
      "country": "France",
      "region": "Bordeaux",
      "description": "Un grand cru exceptionnel...",
      "picture": "69175144b12e3.jpg"
    }
  ],
  "count": 12
}
```

**POST/PUT** - Succès :
```json
{
  "success": true,
  "message": "Bouteille ajoutée avec succès",
  "wine_id": 15
}
```

**DELETE** - Succès :
```json
{
  "success": true,
  "message": "Bouteille supprimée avec succès"
}
```

**Erreur** :
```json
{
  "error": "Non autorisé"
}
```

### Flux de données typique (GET wines)

```
┌─────────────────────────────────────────────────────────────┐
│  1. dashboard.php chargé dans le navigateur                 │
│     - PHP génère le HTML avec session utilisateur           │
└───────────────────────────┬─────────────────────────────────┘
                            │
                            ↓
┌─────────────────────────────────────────────────────────────┐
│  2. JavaScript (dashboard.php, ligne ~60)                   │
│     async function loadWines() {                            │
│       const response = await fetch('api/wines.php');        │
│       const data = await response.json();                   │
│     }                                                        │
└───────────────────────────┬─────────────────────────────────┘
                            │ GET HTTP Request
                            ↓
┌─────────────────────────────────────────────────────────────┐
│  3. api/wines.php (ligne 20)                                │
│     - Vérifie session : isLoggedIn()                        │
│     - Switch sur $_SERVER['REQUEST_METHOD']                 │
│     - case 'GET': getWines()                                │
└───────────────────────────┬─────────────────────────────────┘
                            │
                            ↓
┌─────────────────────────────────────────────────────────────┐
│  4. Wine.php (classes/Wine.php)                             │
│     $wine = new Wine();                                     │
│     $wines = $wine->getByUserId($user['id']);               │
│     - Requête préparée PDO :                                │
│       SELECT * FROM wines WHERE user_id = :user_id          │
└───────────────────────────┬─────────────────────────────────┘
                            │
                            ↓
┌─────────────────────────────────────────────────────────────┐
│  5. Base de données MySQL                                   │
│     - Exécution de la requête préparée                      │
│     - Retour des résultats (tableau associatif)             │
└───────────────────────────┬─────────────────────────────────┘
                            │
                            ↓
┌─────────────────────────────────────────────────────────────┐
│  6. api/wines.php (fonction getWines)                       │
│     echo json_encode([                                      │
│       'success' => true,                                    │
│       'wines' => $wines,                                    │
│       'count' => count($wines)                              │
│     ]);                                                     │
└───────────────────────────┬─────────────────────────────────┘
                            │ JSON Response
                            ↓
┌─────────────────────────────────────────────────────────────┐
│  7. JavaScript (dashboard.php)                              │
│     - displayWines(data.wines)                              │
│     - Génère dynamiquement les cartes HTML                  │
│     - updateBottleCount(data.count)                         │
│     - Affichage sans rechargement de page                   │
└─────────────────────────────────────────────────────────────┘
```

---

## 🗄️ Couche métier (Classes PHP)

### User.php (classes/User.php)

**Responsabilités** :
- Créer un utilisateur (inscription)
- Authentifier un utilisateur (login)
- Vérifier si un email existe déjà
- Hasher les mots de passe (`password_hash`)

**Méthodes principales** :
```php
public function create()              // INSERT INTO users
public function login($email, $pwd)   // SELECT + password_verify()
public function emailExists($email)   // SELECT COUNT
```

### Wine.php (classes/Wine.php)

**Responsabilités** :
- Créer un vin
- Récupérer les vins d'un utilisateur
- Modifier un vin
- Supprimer un vin
- Compter les vins d'un utilisateur

**Méthodes principales** :
```php
public function create()                // INSERT INTO wines
public function getByUserId($user_id)   // SELECT WHERE user_id
public function getById($id)            // SELECT WHERE id
public function update()                // UPDATE wines SET...
public function delete($id, $user_id)   // DELETE WHERE id AND user_id
public function countByUserId($id)      // SELECT COUNT(*)
```

**Sécurité** :
- Toutes les requêtes utilisent **PDO prepared statements**
- Filtrage par `user_id` pour isolation des données

---

## 💾 Base de données MySQL

### Table `users`
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Table `wines`
```sql
CREATE TABLE wines (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    grapes VARCHAR(255),
    country VARCHAR(100),
    region VARCHAR(100),
    description TEXT,
    picture VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

**Relation** : `wines.user_id` → `users.id` (CASCADE)

---

## 🎨 Frontend

### Technologies
- **HTML5** : Structure sémantique
- **SCSS** : Préprocesseur CSS (compilé via npm)
- **JavaScript Vanilla** : Fetch API, manipulation DOM
- **Responsive** : Media queries (Desktop → Tablette → Mobile)

### Architecture SCSS
```
assets/scss/
├── style.scss              # Point d'entrée (import de tous les modules)
├── abstract/
│   ├── _variables.scss     # Variables (couleurs, fonts, tailles)
│   └── _mixins.scss        # Mixins réutilisables
├── base/
│   ├── _base.scss          # Reset CSS, box-sizing
│   └── _typography.scss    # Styles de texte
├── components/
│   ├── _buttons.scss       # Boutons (btn-primary, btn-icon, etc.)
│   └── _forms.scss         # Inputs, textareas
└── layout/
    ├── _header.scss        # Header login/register
    ├── _footer.scss        # Footer
    ├── _login.scss         # Pages index.php et register.php
    ├── _dashboard.scss     # Page dashboard.php
    └── _add.scss           # Page add-wine.php
```

**Compilation** : `npm run sass` → `assets/css/style.css`

---

## 🔒 Sécurité

### Authentification
- ✅ Mots de passe hashés avec `password_hash()` (bcrypt)
- ✅ Vérification avec `password_verify()`
- ✅ Sessions PHP sécurisées (`session_start()`)

### Base de données
- ✅ Requêtes préparées PDO (protection injection SQL)
- ✅ Isolation des données par `user_id`
- ✅ Vérification ownership avant UPDATE/DELETE

### Upload de fichiers
- ✅ Validation du type MIME (JPEG, PNG, GIF)
- ✅ Noms de fichiers uniques (`uniqid()`)
- ✅ Stockage dans dossier dédié `uploads/`
- ✅ Suppression de l'ancienne image lors d'une mise à jour

### API
- ✅ Vérification session avant chaque requête
- ✅ Codes HTTP appropriés (401, 403, 404, 500)
- ✅ Validation des données en entrée
- ✅ Messages d'erreur génériques (pas de fuite d'infos)

---

## 🚀 Déploiement

### Développement local
- **Environnement** : WAMP (Windows, Apache, MySQL, PHP 7.4+)
- **IDE** : PHPStorm
- **Outils** : npm (compilation SCSS), phpMyAdmin (BDD)

### Production (recommandations)
- Hébergeur mutualisé PHP/MySQL
- HTTPS obligatoire
- Variables d'environnement pour credentials BDD
- `.htaccess` pour sécurité (bloquer accès direct à `/includes`, `/classes`, `/config`)

---

## 📊 Récapitulatif

| Composant | Type d'architecture | Technologie |
|-----------|---------------------|-------------|
| **Authentification** | Traditionnelle | PHP + Sessions |
| **CRUD Vins** | API REST | JSON + Fetch |
| **Métier** | POO | Classes PHP |
| **Données** | Relationnelle | MySQL + PDO |
| **Frontend** | SPA partielle | HTML/SCSS/JS |

**MyCave = Architecture hybride moderne et pragmatique** ✨


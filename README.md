# 🍷 MyCave - Gestionnaire de Cave à Vin

Version PHP dynamique avec base de données, authentification et API REST.

## 📦 Structure du Projet

```
MyCave/
├── api/                 # API REST
│   ├── reference.php    # Pays, régions, cépages (données de référence)
│   └── wines.php        # CRUD des vins (JSON)
├── assets/
│   ├── css/style.css    # CSS compilé (depuis SCSS)
│   ├── fonts/           # Police SourceSansPro
│   ├── img/             # Illustrations et photos
│   └── scss/
│       ├── abstract/    # Variables, mixins
│       ├── base/, components/, layout/, pages/
│       └── style.scss   # Point d'entrée SASS
├── classes/
│   ├── User.php         # Authentification + rôles
│   └── Wine.php         # Accès aux vins (PDO)
├── config/
│   └── database.php     # Connexion PDO (mycave_v2)
├── database/
│   ├── schema.sql       # Structure complète + seeds
│   ├── seed_regions.sql # Référentiel régions/pays
│   ├── remove_region_duplicates.sql
│   └── *.sql            # Scripts d'entretien
├── doc/                 # Docs projet (rapport, guides)
├── includes/
│   └── session.php      # Helpers de session PHP
├── uploads/             # Photos uploadées
├── add-wine.php         # Formulaire ajout/édition
├── dashboard.php        # Vue principale après login
├── index.php            # Connexion
├── register.php         # Inscription
├── logout.php           # Déconnexion
├── ARCHITECTURE.md, README.md, etc.
├── package.json         # Scripts SASS (npm)
└── node_modules/        # Dépendances locales
```

## 🚀 Installation Rapide

### 1. Prérequis
- **XAMPP/WAMP/MAMP** ou serveur local PHP 7.4+
- **MySQL** 5.7+
- **Navigateur moderne**

### 2. Configuration Base de Données

```bash
# 1. Créer la base de données
mysql -u root -p < database/schema.sql

# 2. Ou via phpMyAdmin :
# - Importer le fichier database/schema.sql
```

### 3. Configuration PHP

Éditer `config/database.php` si nécessaire :
```php
private $host = 'localhost';
private $db_name = 'mycave_db';
private $username = 'root';
private $password = '';
```

### 4. Permissions

```bash
# Créer le dossier uploads avec permissions
mkdir uploads
chmod 777 uploads
```

## 🔑 Comptes de Test

### Utilisateur Standard
- **Email:** didier@mycave.com
- **Mot de passe:** password
- **Cave:** 12 bouteilles pré-remplies

### Administrateur
- **Email:** admin@mycave.com
- **Mot de passe:** password
- **Privilèges:** Gestion de tous les vins

## 📋 Fonctionnalités

### ✅ Version Actuelle (PHP)

#### 🔐 Authentification
- [x] Connexion / Inscription
- [x] Gestion des sessions
- [x] Rôles utilisateur (user/admin)
- [x] Hachage sécurisé des mots de passe

#### 🍷 Gestion des Vins
- [x] Ajout de bouteilles avec photo
- [x] Modification des informations
- [x] Suppression avec confirmation
- [x] Upload d'images sécurisé
- [x] Affichage responsive des cartes

#### 📊 Dashboard
- [x] Vue d'ensemble personnalisée
- [x] Compteur de bouteilles en temps réel
- [x] Interface responsive (mobile/tablet/desktop)
- [x] Chargement dynamique via API

#### 🎨 Design
- [x] Interface moderne avec glassmorphism
- [x] Background fixe avec overlay scrollable
- [x] Responsive design (3 cols → 2 cols → 1 col)
- [x] Animations et transitions fluides

### 🔐 Authentification

**Architecture traditionnelle** (formulaires PHP + sessions) :
- `index.php` : Connexion (POST → `User::login()` → session)
- `register.php` : Inscription (POST → `User::create()` → session)
- `logout.php` : Déconnexion (`session_destroy()`)
- `includes/session.php` : Fonctions de gestion de session

### 🔌 API REST

Les endpoints courants sont :
- `api/wines.php` : CRUD complet sur les bouteilles de l'utilisateur connecté (GET/POST/PUT/DELETE)
- `api/reference.php` : expose les listes de pays, régions et cépages pour alimenter les formulaires

#### Gestion des vins (`/api/wines.php`)
```bash
GET /api/wines.php
# Liste tous les vins de l'utilisateur connecté
# Réponse : {success: true, wines: [...], count: 12}

POST /api/wines.php
# FormData avec name, year, grapes, country, region, description, picture
# Réponse : {success: true, message: "Bouteille ajoutée", wine_id: 15}

PUT /api/wines.php
# FormData avec id + champs à modifier (picture optionnel)
# Réponse : {success: true, message: "Bouteille mise à jour"}

DELETE /api/wines.php?id=123
# Supprime le vin avec l'id 123
# Réponse : {success: true, message: "Bouteille supprimée"}
```

**Authentification** : Toutes les requêtes nécessitent une session PHP active (vérification via `isLoggedIn()`)

## 🗄️ Base de Données

### Table `users`
```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- email (VARCHAR(255), UNIQUE)
- password (VARCHAR(255), HASHED)
- name (VARCHAR(100))
- role (ENUM: 'user', 'admin')
- created_at (TIMESTAMP)
```

### Table `wines`
```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- user_id (INT, FOREIGN KEY)
- name (VARCHAR(255))
- year (INT)
- grapes (VARCHAR(255))
- country (VARCHAR(100))
- region (VARCHAR(100))
- description (TEXT)
- picture (VARCHAR(255))
- created_at (TIMESTAMP)
```

#### Maintenance des régions
1. Nettoyer les doublons existants :
```powershell
cd C:\wamp64\www\Myv12
git --no-pager diff database\remove_region_duplicates.sql # vérifier le script
mysql -u root -p mycave_db < database\remove_region_duplicates.sql
```
2. Réimporter les régions de référence :
```powershell
mysql -u root -p mycave_db < database\seed_regions.sql
```
3. Synchroniser le front : récupérer les listes pays/régions via `api/reference.php` pour alimenter les sélecteurs et empêcher les saisies libres incohérentes.

## 🎯 URLs Principales

| Page | URL | Description |
|------|-----|-------------|
| 🔐 **Connexion** | `/login.php` | Authentification + inscription |
| 📊 **Dashboard** | `/dashboard.php` | Vue d'ensemble des vins |
| ➕ **Ajouter** | `/add-wine.php` | Nouveau vin |
| ✏️ **Modifier** | `/add-wine.php?id=123` | Édition d'un vin |

## 🛠️ Technologies

- **Backend:** PHP 7.4+ avec PDO
- **Base de données:** MySQL avec relations
- **Frontend:** JavaScript ES6+ (Fetch API)
- **Styles:** SCSS avec variables et mixins
- **Sécurité:** Sessions PHP, password_hash(), requêtes préparées
- **Upload:** Gestion sécurisée des fichiers images

## 📱 Responsive Design

### Desktop (≥1024px)
- 3 colonnes de cartes de vins
- Header complet avec actions
- Sidebar potentielle pour futures fonctionnalités

### Tablet (425px → 1023px)
- 2 colonnes de cartes
- Header adapté
- Navigation optimisée

### Mobile (≤425px)
- 1 colonne unique
- Header compact
- Boutons tactiles optimisés

## 🔄 Workflow de Développement

### 1. Version Actuelle
- ✅ **dashboard.html** → **dashboard.php** (Fonctionnel)
- ✅ **add.html** → **add-wine.php** (Fonctionnel)
- ✅ API REST complète
- ✅ Base de données avec données de test

### 2. Prochaines Étapes
- [ ] Interface d'administration
- [ ] Recherche et filtres avancés
- [ ] Export/Import de cave
- [ ] Statistiques et graphiques
- [ ] Notifications et rappels

## ✨ Améliorations Rapides
- **UX/Formulaire :** finaliser l'alignement flex des inputs, limiter la description (même nombre de caractères dans l'API et l'UI) et afficher un aperçu d'image instantané dans `add-wine.php`.
- **SCSS cohérent :** centraliser couleurs/espacements dans `assets/scss/abstract/_variables.scss`, puis n'utiliser que ces tokens dans `components/_forms.scss` et `layout/_dashboard.scss` pour réduire la spécificité.
- **Données fiables :** dédoublonner la table `region` avec `database/remove_region_duplicates.sql`, enrichir `database/seed_regions.sql` avec les pays 1=France, 2=Spain, 3=USA, 4=Italy, 6=Argentina, et exposer ces listes via `api/reference.php`.
- **Performance légère :** activer `loading="lazy"` sur les cartes, ajouter une pagination simple côté `dashboard.php` et minifier `assets/css/style.css` via un script npm.
- **Documentation :** compléter `ARCHITECTURE.md` et ce README avec les conventions SCSS/SQL pour que l'équipe suive le même flux.

## 🚨 Sécurité

### Mesures Implémentées
- ✅ Hachage des mots de passe avec `password_hash()`
- ✅ Requêtes préparées (protection SQL injection)
- ✅ Validation des entrées utilisateur
- ✅ Gestion sécurisée des sessions
- ✅ Upload d'images avec validation de type
- ✅ Vérification des permissions (utilisateur propriétaire)

### À Améliorer
- [ ] Rate limiting sur les API
- [ ] CSRF tokens
- [ ] Validation côté serveur renforcée
- [ ] Logs de sécurité

## 📈 Performance

### Optimisations Actuelles
- ✅ Images optimisées avec lazy loading
- ✅ CSS/JS minifiés
- ✅ Requêtes SQL optimisées avec index
- ✅ Gestion d'erreurs complète

### Améliorations Futures
- [ ] Cache Redis/Memcached
- [ ] CDN pour les assets
- [ ] Compression Gzip
- [ ] Service Workers

## 🎉 Démarrage

1. **Cloner** le projet
2. **Importer** `database/schema.sql`
3. **Configurer** `config/database.php`
4. **Créer** le dossier `uploads/`
5. **Tester** avec les comptes fournis

**🍷 Votre cave digitale est prête !**
# EPCF2-MyCave-Final

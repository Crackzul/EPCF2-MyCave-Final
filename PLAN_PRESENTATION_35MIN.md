# 🎯 PLAN DE PRÉSENTATION COMPLÈTE - 35 MINUTES
## MyCave - Application de Gestion de Cave à Vin
### Projet DWWM - Titre Professionnel Développeur Web et Web Mobile

---

## 📊 STRUCTURE GLOBALE (35 minutes)

| Section | Durée | Slides | Objectif |
|---------|-------|--------|----------|
| 1. Introduction & Contexte | 3 min | 3-4 slides | Présentation personnelle + projet |
| 2. Analyse du Besoin | 4 min | 4-5 slides | Problématique + cahier des charges |
| 3. Conception & Maquettage | 4 min | 5-6 slides | Wireframes, charte graphique, user flow |
| 4. Architecture Technique | 5 min | 6-7 slides | Stack technique, schémas, structure |
| 5. Base de Données | 4 min | 3-4 slides | MCD, MLD, requêtes |
| 6. Démonstration Live | 6 min | 1 slide | Parcours utilisateur complet |
| 7. Code & Bonnes Pratiques | 5 min | 5-6 slides | Extraits commentés |
| 8. Sécurité & Veille | 2 min | 2-3 slides | Mesures + sources |
| 9. Validation des Compétences | 1 min | 1-2 slides | Tableau de correspondance |
| 10. Perspectives & Conclusion | 1 min | 1-2 slides | Évolutions + bilan |
| **TOTAL** | **35 min** | **32-40 slides** | |

---

## 📑 DÉTAIL SLIDE PAR SLIDE

### 🎬 SECTION 1 : INTRODUCTION & CONTEXTE (3 minutes)

#### **Slide 1 : Page de titre**
**Contenu :**
- **Titre principal :** MyCave - Gestion de Cave à Vin Personnelle
- **Sous-titre :** Application Web Full-Stack PHP/MySQL
- **Votre nom + formation :** [Nom] - Développeur Web et Web Mobile (DWWM)
- **Date :** Janvier 2025
- **Logo :** MyCave (bouteille stylisée)
- **Image de fond :** Photo de cave à vin élégante (effet glassmorphism)

**À dire (30 sec) :**
> "Bonjour et merci d'être présents. Je m'appelle [Nom] et je vais vous présenter MyCave, une application web complète de gestion de cave à vin que j'ai développée dans le cadre de ma formation DWWM."

---

#### **Slide 2 : Qui suis-je ?**
**Contenu :**
- Photo professionnelle
- Parcours en 3-4 points :
  - Formation DWWM chez [Organisme]
  - Expérience antérieure (si applicable)
  - Motivations pour le développement web
  - Projet professionnel (développeur full-stack PHP/JavaScript)

**À dire (30 sec) :**
> "Pour me présenter brièvement : je suis en formation DWWM depuis [date], avec un objectif clair : devenir développeur full-stack spécialisé dans les technologies PHP et JavaScript. Ce projet MyCave représente l'aboutissement de mes apprentissages."

---

#### **Slide 3 : Contexte du projet**
**Contenu :**
- **Cadre :** Projet de validation du titre professionnel DWWM
- **Durée :** [X semaines] (ex: 6 semaines)
- **Périmètre :** Application full-stack complète
- **Objectif pédagogique :** Démontrer les 8 compétences du référentiel
- **Méthodologie :** Agile (itérations, tests, documentation)

**À dire (1 min) :**
> "Ce projet s'inscrit dans le cadre de la validation de mon titre DWWM. J'ai choisi de créer une application complète plutôt que 8 exercices séparés, pour démontrer ma capacité à mener un projet de A à Z : de l'analyse du besoin jusqu'au déploiement et à la documentation."

---

#### **Slide 4 : Plan de la présentation**
**Contenu :**
- Sommaire visuel avec icônes :
  1. 🎯 Analyse du besoin
  2. 🎨 Conception & Maquettage
  3. 🏗️ Architecture technique
  4. 💾 Base de données
  5. 🖥️ Démonstration live
  6. 💻 Code & Bonnes pratiques
  7. 🔐 Sécurité
  8. ✅ Compétences validées
  9. 🚀 Perspectives

**À dire (1 min) :**
> "Ma présentation suivra le cycle complet de développement : je vais d'abord vous présenter l'analyse du besoin, puis la conception, l'architecture technique, avant de vous faire une démonstration en direct. Ensuite, nous verrons le code, les aspects sécurité, et enfin les perspectives d'évolution."

---

### 🎯 SECTION 2 : ANALYSE DU BESOIN (4 minutes)

#### **Slide 5 : Problématique**
**Contenu :**
- **Contexte :** Amateur de vin avec une collection grandissante
- **Problèmes identifiés :**
  - ❌ Difficile de se souvenir des caractéristiques de chaque bouteille
  - ❌ Pas de traçabilité du stock (combien de bouteilles restantes ?)
  - ❌ Informations dispersées (photos sur téléphone, notes papier)
  - ❌ Impossible de partager facilement avec d'autres passionnés
- **Citation :** *"Comment gérer efficacement ma cave à vin de manière centralisée et accessible ?"*

**À dire (1 min) :**
> "La problématique de départ est simple mais concrète : un amateur de vin accumule des bouteilles et perd rapidement le fil. Il ne se souvient plus des millésimes, des prix d'achat, des notes de dégustation. Les solutions existantes sont soit trop complexes, soit payantes. D'où l'idée de MyCave : une solution simple, gratuite et personnelle."

---

#### **Slide 6 : Objectifs du projet**
**Contenu :**
- **Objectifs fonctionnels :**
  - ✅ Permettre à chaque utilisateur de créer un compte personnel
  - ✅ Gérer son stock de vins (CRUD complet)
  - ✅ Associer une photo à chaque bouteille
  - ✅ Consulter son stock en un coup d'œil (dashboard)
  - ✅ Isoler les données : chacun ne voit que ses vins

- **Objectifs techniques :**
  - ✅ Interface moderne, responsive et intuitive
  - ✅ Architecture sécurisée (authentification, sessions)
  - ✅ API REST pour la gestion des données
  - ✅ Upload de fichiers (images)

**À dire (1 min) :**
> "J'ai défini deux types d'objectifs : fonctionnels et techniques. Côté utilisateur, il doit pouvoir gérer son stock de manière autonome avec une interface agréable. Côté développement, je devais mettre en pratique les technologies web modernes : PHP orienté objet, API REST, responsive design."

---

#### **Slide 7 : Cible utilisateur & Personas**
**Contenu :**
- **Persona 1 - Marc, 45 ans :** Amateur passionné, 50 bouteilles, veut suivre ses dégustations
- **Persona 2 - Sophie, 32 ans :** Collectionneuse, 200 bouteilles, besoin de traçabilité précise
- **Persona 3 - Jean, 60 ans :** Retraité, cave familiale, souhaite numériser son inventaire

**Besoins communs :**
- Interface simple (pas de formation nécessaire)
- Accès depuis ordinateur et tablette
- Sécurité des données (pas de partage involontaire)

**À dire (1 min) :**
> "J'ai identifié trois profils types d'utilisateurs : l'amateur qui démarre, le collectionneur sérieux, et le senior qui veut numériser sa cave. Tous ont un point commun : ils ne sont pas des experts informatiques, donc l'interface doit être intuitive."

---

#### **Slide 8 : Cahier des charges fonctionnel**
**Contenu :**
- **Fonctionnalités essentielles (MVP) :**
  - Inscription / Connexion / Déconnexion
  - Créer une fiche vin (nom, millésime, appellation, couleur, région, notes, prix, photo)
  - Voir la liste de ses vins avec compteur
  - Modifier une fiche existante
  - Supprimer un vin avec confirmation

- **Contraintes techniques :**
  - Responsive (mobile, tablette, desktop)
  - Performance (chargement < 2 secondes)
  - Sécurité (mots de passe hashés, sessions)
  - Upload d'images (formats JPG/PNG, max 2 Mo)

**À dire (1 min) :**
> "J'ai défini un périmètre de MVP (Minimum Viable Product) : les fonctionnalités essentielles pour qu'un utilisateur puisse gérer sa cave efficacement. Pas de sur-ingénierie : juste ce qui compte vraiment."

---

### 🎨 SECTION 3 : CONCEPTION & MAQUETTAGE (4 minutes)

#### **Slide 9 : User Flow (Parcours utilisateur)**
**Contenu :**
- Schéma de navigation sous forme de flowchart :
```
┌─────────────┐
│  Visiteur   │
└──────┬──────┘
       │
   ┌───┴────┐
   │        │
[Login]  [Register]
   │        │
   └───┬────┘
       │
   ┌───▼──────┐
   │ Dashboard│ ← Page principale
   └─────┬────┘
         │
    ┌────┼────┬─────────┐
    │    │    │         │
[Voir] [Ajouter] [Modifier] [Supprimer]
    │    │    │         │
    └────┴────┴─────────┘
         │
    [Déconnexion]
```

**À dire (1 min) :**
> "Voici le parcours utilisateur type : un visiteur arrive sur la page de connexion, s'identifie, accède à son dashboard où il voit ses vins. De là, il peut ajouter, modifier ou supprimer une bouteille. La navigation est simple et logique."

---

#### **Slide 10 : Wireframes - Écran de connexion**
**Contenu :**
- Wireframe basse fidélité (croquis ou Figma) de la page de connexion
- Éléments visibles :
  - Logo MyCave
  - Formulaire (Email + Password)
  - Bouton "Se connecter"
  - Lien "Créer un compte"
  - Image de fond (cave à vin)

**À dire (30 sec) :**
> "Premier écran : la page de connexion. Design épuré avec un formulaire simple, un lien vers l'inscription, et une image de fond immersive."

---

#### **Slide 11 : Wireframes - Dashboard**
**Contenu :**
- Wireframe du tableau de bord
- Éléments visibles :
  - Header avec logo + déconnexion
  - Compteur de bouteilles
  - Bouton "Ajouter un vin"
  - Grille de cartes (3 colonnes)
  - Chaque carte : image, nom, millésime, appellation, actions (modifier/supprimer)

**À dire (30 sec) :**
> "Le dashboard est le cœur de l'application : affichage en grille responsive, chaque vin est représenté par une carte avec photo et infos essentielles."

---

#### **Slide 12 : Wireframes - Formulaire d'ajout**
**Contenu :**
- Wireframe du formulaire
- 8 champs visibles :
  - Nom du vin*
  - Millésime*
  - Appellation
  - Couleur* (sélecteur)
  - Région
  - Notes de dégustation
  - Prix
  - Image* (upload)
- Boutons : Enregistrer / Annuler

**À dire (30 sec) :**
> "Le formulaire d'ajout reprend tous les champs nécessaires pour décrire une bouteille. Les champs obligatoires sont marqués d'un astérisque."

---

#### **Slide 13 : Charte graphique & Design System**
**Contenu :**
- **Palette de couleurs :**
  - Primaire : #722f37 (bordeaux)
  - Secondaire : #8b5a3c (brun)
  - Succès : #28a745 (vert)
  - Erreur : #dc3545 (rouge)
  - Neutre : #f8f9fa (gris clair)

- **Typographie :**
  - Police : Source Sans Pro (Google Fonts)
  - Titres : Bold 24-32px
  - Texte : Regular 16px
  - Line-height : 1.6

- **Composants réutilisables :**
  - Boutons (primary, secondary, danger)
  - Cartes (wine-card)
  - Formulaires (inputs, selects, file upload)
  - Modales (confirmation de suppression)

**À dire (1 min) :**
> "J'ai créé une charte graphique cohérente autour des couleurs du vin : bordeaux, brun, avec des accents verts et rouges pour les messages. La typographie Source Sans Pro apporte modernité et lisibilité."

---

#### **Slide 14 : Responsive Design**
**Contenu :**
- 3 screenshots côte à côte :
  - **Desktop (> 1024px) :** 3 colonnes
  - **Tablette (768-1023px) :** 2 colonnes
  - **Mobile (< 767px) :** 1 colonne

- **Techniques utilisées :**
  - CSS Grid avec `grid-template-columns`
  - Media queries SCSS
  - Unités relatives (rem, %)
  - Images responsives (max-width: 100%)

**À dire (30 sec) :**
> "L'interface s'adapte automatiquement à tous les écrans grâce aux media queries SCSS. La grille passe de 3 colonnes sur desktop à 1 colonne sur mobile, sans perte d'information."

---

### 🏗️ SECTION 4 : ARCHITECTURE TECHNIQUE (5 minutes)

#### **Slide 15 : Stack technique**
**Contenu :**
- Tableau avec logos :

| Couche | Technologies | Version | Rôle |
|--------|-------------|---------|------|
| **Front-end** | HTML5, CSS3, SCSS, JavaScript ES6+ | - | Interface utilisateur |
| **Back-end** | PHP (POO) | 7.4+ | Logique métier, API |
| **Base de données** | MySQL | 8.0 | Stockage données |
| **Serveur** | Apache (WAMP) | 2.4 | Serveur web local |
| **Outils** | PHPStorm, Git, npm | - | IDE, versioning, build |
| **Libs** | PDO (natif PHP) | - | Accès BDD sécurisé |

**À dire (1 min) :**
> "J'ai choisi une stack LAMP classique mais moderne : PHP orienté objet pour le back-end, MySQL pour la persistance, et JavaScript ES6+ pour le dynamisme côté client. Pas de framework volumineux : l'objectif était de maîtriser les bases avant d'utiliser des abstractions."

---

#### **Slide 16 : Architecture globale (Schéma)**
**Contenu :**
- Schéma en couches avec flèches :

```
┌─────────────────────────────────────────┐
│         COUCHE PRÉSENTATION             │
│  HTML5 / CSS3 (SCSS) / JavaScript ES6+  │
│  - Pages : index, register, dashboard   │
│  - Assets : style.scss, fonts, images   │
└──────────────┬──────────────────────────┘
               │ (HTTP Requests)
               ▼
┌─────────────────────────────────────────┐
│         COUCHE APPLICATION              │
│        PHP (Orienté Objet)              │
│  - Pages PHP : index.php, dashboard.php │
│  - API REST : api/wines.php             │
│  - Sessions : includes/session.php      │
└──────────────┬──────────────────────────┘
               │ (Appels méthodes)
               ▼
┌─────────────────────────────────────────┐
│         COUCHE MÉTIER                   │
│         Classes PHP (POO)               │
│  - classes/User.php (authentification)  │
│  - classes/Wine.php (CRUD vins)         │
└──────────────┬──────────────────────────┘
               │ (Requêtes SQL via PDO)
               ▼
┌─────────────────────────────────────────┐
│         COUCHE DONNÉES                  │
│        MySQL Database (PDO)             │
│  - Table users (id, email, password)    │
│  - Table wines (id, user_id, name, ...) │
└─────────────────────────────────────────┘
```

**À dire (1 min 30) :**
> "L'architecture suit le modèle MVC adapté : la couche présentation gère l'affichage, la couche application orchestre les requêtes HTTP et les sessions, la couche métier encapsule la logique dans des classes PHP, et la couche données persiste tout en MySQL via PDO. Cette séparation garantit maintenabilité et évolutivité."

---

#### **Slide 17 : Structure des dossiers**
**Contenu :**
- Arborescence commentée :
```
Myv12/
│
├── index.php               # Page de connexion
├── register.php            # Page d'inscription
├── dashboard.php           # Page principale (liste vins)
├── add-wine.php            # Formulaire ajout/modification
├── logout.php              # Déconnexion
│
├── api/
│   └── wines.php           # API REST (GET/POST/DELETE)
│
├── assets/
│   ├── css/
│   │   └── style.css       # CSS compilé
│   ├── scss/
│   │   ├── abstract/       # Variables, mixins
│   │   ├── base/           # Reset, typographie
│   │   ├── components/     # Boutons, cartes, formulaires
│   │   ├── layout/         # Header, footer, grilles
│   │   ├── pages/          # Styles spécifiques pages
│   │   └── style.scss      # Fichier principal
│   ├── fonts/              # Source Sans Pro
│   └── img/                # Images de l'interface
│
├── classes/
│   ├── User.php            # Classe Utilisateur
│   └── Wine.php            # Classe Vin
│
├── config/
│   └── database.php        # Configuration PDO
│
├── includes/
│   └── session.php         # Gestion sessions
│
├── uploads/                # Images uploadées
│
├── database/
│   └── schema.sql          # Schéma + données test
│
└── README.md               # Documentation
```

**À dire (1 min) :**
> "L'organisation des dossiers est claire et logique : les pages à la racine, l'API dans un dossier dédié, les assets (CSS/JS/images) séparés, les classes PHP isolées, et les uploads dans un répertoire spécifique. Cette structure facilite la navigation et la maintenance."

---

#### **Slide 18 : API REST - Endpoints**
**Contenu :**
- Tableau des routes :

| Méthode HTTP | Endpoint | Paramètres | Réponse | Code HTTP |
|-------------|----------|------------|---------|-----------|
| `GET` | `/api/wines.php` | - | Liste des vins de l'utilisateur | 200 |
| `POST` | `/api/wines.php` | FormData (8 champs) | Vin créé | 201 |
| `POST` + `_method=PUT` | `/api/wines.php` | FormData + id | Vin modifié | 200 |
| `DELETE` | `/api/wines.php` | id (query string) | Vin supprimé | 200 |

**Exemple de réponse JSON :**
```json
{
  "success": true,
  "wines": [
    {
      "id": 1,
      "name": "Château Margaux",
      "vintage": "2015",
      "appellation": "Margaux",
      "color": "Rouge",
      "region": "Bordeaux",
      "tasting_notes": "Notes de cassis...",
      "price": "150.00",
      "image": "uploads/chateau_margaux.jpg"
    }
  ],
  "count": 1
}
```

**À dire (1 min 30) :**
> "L'API REST expose un endpoint unique qui gère les 4 opérations CRUD via les méthodes HTTP. Important : pour la modification, j'utilise POST avec un paramètre _method=PUT car FormData ne supporte pas PUT nativement lors de l'upload de fichiers. C'est une pratique standard dans les frameworks comme Laravel."

---

### 💾 SECTION 5 : BASE DE DONNÉES (4 minutes)

#### **Slide 19 : Modèle Conceptuel de Données (MCD)**
**Contenu :**
- Diagramme entités-relations :

```
┌─────────────────┐           ┌─────────────────┐
│      USER       │           │      WINE       │
├─────────────────┤           ├─────────────────┤
│ PK id           │ 1       * │ PK id           │
│    username     │───────────│ FK user_id      │
│    email        │  possède  │    name         │
│    password     │           │    vintage      │
│    roles        │           │    appellation  │
└─────────────────┘           │    color        │
                              │    region       │
                              │    tasting_notes│
                              │    price        │
                              │    image        │
                              │    created_at   │
                              │    updated_at   │
                              └─────────────────┘
```

**Cardinalités :**
- Un utilisateur possède 0 ou plusieurs vins (1,n)
- Un vin appartient à 1 et 1 seul utilisateur (1,1)

**À dire (1 min) :**
> "Le modèle conceptuel est simple : deux entités, USER et WINE, reliées par une relation de possession. Un utilisateur peut avoir plusieurs vins, mais chaque vin appartient à un seul utilisateur. C'est une relation one-to-many classique."

---

#### **Slide 20 : Modèle Logique de Données (MLD)**
**Contenu :**
- Structure SQL des tables :

**Table `users` :**
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    roles VARCHAR(255) NOT NULL DEFAULT 'ROLE_USER',
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**Table `wines` :**
```sql
CREATE TABLE wines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    vintage YEAR NOT NULL,
    appellation VARCHAR(255),
    color ENUM('Rouge', 'Blanc', 'Rosé') NOT NULL,
    region VARCHAR(255),
    tasting_notes TEXT,
    price DECIMAL(10,2),
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**À dire (1 min 30) :**
> "Le MLD traduit le MCD en structures SQL. La table users contient les données d'authentification avec un mot de passe hashé. La table wines stocke toutes les informations des bouteilles, avec une clé étrangère vers users. J'ai ajouté des index sur email et user_id pour optimiser les requêtes fréquentes. La contrainte ON DELETE CASCADE garantit que si un utilisateur est supprimé, tous ses vins le sont aussi automatiquement."

---

#### **Slide 21 : Requêtes SQL clés**
**Contenu :**
- 3 exemples de requêtes préparées avec PDO :

**1. Récupérer les vins d'un utilisateur :**
```php
$query = "SELECT * FROM wines WHERE user_id = :user_id ORDER BY created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();
$wines = $stmt->fetchAll(PDO::FETCH_ASSOC);
```

**2. Créer un vin :**
```php
$query = "INSERT INTO wines (user_id, name, vintage, appellation, color, region, tasting_notes, price, image) 
          VALUES (:user_id, :name, :vintage, :appellation, :color, :region, :tasting_notes, :price, :image)";
$stmt = $pdo->prepare($query);
// bindParam pour chaque paramètre...
$stmt->execute();
```

**3. Supprimer un vin avec vérification propriétaire :**
```php
$query = "DELETE FROM wines WHERE id = :id AND user_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $wineId, PDO::PARAM_INT);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();
```

**À dire (1 min 30) :**
> "Toutes mes requêtes utilisent PDO avec des paramètres bindés. Cela protège contre les injections SQL : jamais de concaténation de variables dans les requêtes. Notez la clause AND user_id dans la suppression : cela garantit qu'un utilisateur ne peut supprimer que SES vins, même s'il trafique l'ID dans la requête."

---

### 🖥️ SECTION 6 : DÉMONSTRATION LIVE (6 minutes)

#### **Slide 22 : Démonstration en direct**
**Contenu :**
- Texte simple : "Démonstration de l'application"
- Logo MyCave
- Note en bas : "Parcours utilisateur complet : Connexion → Ajout → Modification → Suppression"

**PARCOURS À EXÉCUTER EN LIVE :**

**1. Connexion (45 sec) :**
- Ouvrir `http://localhost/Myv12/`
- Montrer la page de connexion
- Entrer les identifiants de test (préparer email + password sur un papier)
- Cliquer "Se connecter"
- **Dire :** "La connexion vérifie le mot de passe hashé en base et ouvre une session PHP sécurisée."

**2. Dashboard (45 sec) :**
- Observer la liste des vins affichée
- Pointer le compteur : "Vous avez X bouteilles dans votre cave"
- Montrer une carte de vin : image, nom, millésime, actions
- **Dire :** "Les données sont chargées dynamiquement via l'API REST avec JavaScript Fetch."
- **Ouvrir DevTools (F12) onglet Network** : montrer la requête GET vers api/wines.php

**3. Ajout d'un vin (1 min 30) :**
- Cliquer sur "Ajouter un vin"
- Remplir rapidement le formulaire (avoir les données prêtes) :
  - Nom : "Domaine de la Romanée-Conti"
  - Millésime : 2018
  - Appellation : "Romanée-Conti"
  - Couleur : Rouge
  - Région : "Bourgogne"
  - Notes : "Exceptionnel, notes de fruits rouges"
  - Prix : 3500
  - **IMAGE : Sélectionner une photo de bouteille (prête sur le bureau)**
- Cliquer "Enregistrer"
- Retour au dashboard : la nouvelle bouteille apparaît en haut
- **Dire :** "L'upload se fait en FormData, l'image est validée côté serveur (type MIME, taille), puis stockée dans le dossier uploads/. Le compteur s'incrémente automatiquement."

**4. Modification (1 min 30) :**
- Cliquer sur l'icône "Modifier" (crayon) d'une bouteille existante
- Observer que le formulaire est pré-rempli avec les données actuelles
- Changer un champ (ex : millésime 2017 → 2018)
- Cliquer "Enregistrer"
- Retour au dashboard : la modification est visible
- **Dire :** "La méthode PUT est simulée via POST avec _method=PUT car l'upload nécessite multipart/form-data. Pas de rechargement de page grâce à JavaScript."

**5. Suppression (1 min) :**
- Cliquer sur l'icône "Supprimer" (poubelle)
- Observer la fenêtre de confirmation : "Êtes-vous sûr ?"
- Cliquer "Confirmer"
- La carte disparaît avec une animation
- Le compteur se décrémente
- **Dire :** "La suppression est définitive : l'image est effacée du serveur et l'enregistrement en base est supprimé. La confirmation évite les suppressions accidentelles."

**6. Responsive (30 sec) :**
- **Redimensionner la fenêtre du navigateur** ou **ouvrir DevTools en mode Responsive**
- Montrer que le design s'adapte : 3 colonnes → 2 → 1
- **Dire :** "L'interface est entièrement responsive grâce aux media queries SCSS. Utilisable sur mobile, tablette et desktop."

**7. Déconnexion (15 sec) :**
- Cliquer sur "Déconnexion"
- Retour à la page de connexion
- **Dire :** "La déconnexion détruit la session PHP. Impossible d'accéder aux pages protégées sans être authentifié."

**FIN DE LA DÉMO**
> "Voilà pour le parcours utilisateur complet. Comme vous l'avez vu, l'application est fluide, intuitive et sécurisée."

---

### 💻 SECTION 7 : CODE & BONNES PRATIQUES (5 minutes)

#### **Slide 23 : Architecture POO - Classe User**
**Contenu :**
- Extrait de code de `classes/User.php` :

```php
<?php
class User {
    private $conn;
    private $email;
    private $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Inscription
    public function register($email, $password) {
        $query = "INSERT INTO users (email, password, username, roles) 
                  VALUES (:email, :password, :username, :roles)";
        $stmt = $this->conn->prepare($query);
        
        // Hash du mot de passe avec bcrypt
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':username', $email); // Username = email par défaut
        $stmt->bindParam(':roles', $defaultRole);
        
        return $stmt->execute();
    }

    // Connexion
    public function login($email, $password) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Vérification du mot de passe hashé
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
```

**À dire (1 min 30) :**
> "La classe User encapsule toute la logique d'authentification. Notez deux points essentiels : password_hash avec PASSWORD_DEFAULT qui utilise bcrypt, et password_verify pour comparer les mots de passe. Jamais de stockage en clair, jamais de comparaison directe."

---

#### **Slide 24 : Architecture POO - Classe Wine**
**Contenu :**
- Extrait de code de `classes/Wine.php` :

```php
<?php
class Wine {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Récupérer les vins d'un utilisateur
    public function getByUserId($userId) {
        $query = "SELECT * FROM wines WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Créer un vin avec upload d'image
    public function create($userId, $data, $file) {
        // Validation et upload de l'image
        $imagePath = $this->uploadImage($file);
        
        $query = "INSERT INTO wines (user_id, name, vintage, appellation, color, region, tasting_notes, price, image)
                  VALUES (:user_id, :name, :vintage, :appellation, :color, :region, :tasting_notes, :price, :image)";
        
        $stmt = $this->conn->prepare($query);
        // bindParam pour tous les champs...
        
        return $stmt->execute();
    }

    // Upload d'image avec validation
    private function uploadImage($file) {
        $allowed = ['image/jpeg', 'image/png', 'image/jpg'];
        $maxSize = 2 * 1024 * 1024; // 2 Mo
        
        if (!in_array($file['type'], $allowed)) {
            throw new Exception("Format d'image non autorisé");
        }
        
        if ($file['size'] > $maxSize) {
            throw new Exception("Image trop volumineuse");
        }
        
        $filename = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        move_uploaded_file($file['tmp_name'], 'uploads/' . $filename);
        
        return 'uploads/' . $filename;
    }
}
```

**À dire (1 min 30) :**
> "La classe Wine gère le CRUD des bouteilles. Notez la méthode privée uploadImage qui valide le type MIME et la taille avant d'accepter l'upload. Le nom de fichier est randomisé avec uniqid() pour éviter les collisions et les injections de chemin."

---

#### **Slide 25 : API REST - Routing HTTP**
**Contenu :**
- Extrait de `api/wines.php` :

```php
<?php
require_once '../includes/session.php';
require_once '../config/database.php';
require_once '../classes/Wine.php';

// Vérification session
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorisé']);
    exit();
}

$wine = new Wine($pdo);
$method = $_SERVER['REQUEST_METHOD'];

// Gestion du _method pour PUT simulé
if ($method === 'POST' && isset($_POST['_method'])) {
    $method = $_POST['_method'];
}

switch ($method) {
    case 'GET':
        getWines($wine, $_SESSION['user_id']);
        break;
    
    case 'POST':
        createWine($wine, $_SESSION['user_id'], $_POST, $_FILES);
        break;
    
    case 'PUT':
        updateWine($wine, $_SESSION['user_id'], $_POST, $_FILES);
        break;
    
    case 'DELETE':
        deleteWine($wine, $_SESSION['user_id'], $_GET['id']);
        break;
    
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Méthode non autorisée']);
}

function getWines($wine, $userId) {
    $wines = $wine->getByUserId($userId);
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'wines' => $wines,
        'count' => count($wines)
    ]);
}
// ... autres fonctions
```

**À dire (1 min 30) :**
> "L'API suit une architecture RESTful : une URL unique, plusieurs méthodes HTTP. La première vérification bloque tout accès non authentifié avec un code 401. Le switch route vers la bonne fonction selon la méthode. Chaque réponse inclut un code HTTP explicite et du JSON structuré."

---

#### **Slide 26 : JavaScript moderne - Fetch API**
**Contenu :**
- Extrait de `dashboard.php` :

```javascript
// Chargement des vins au démarrage
async function loadWines() {
    try {
        const response = await fetch('api/wines.php');
        
        if (!response.ok) {
            throw new Error('Erreur de chargement');
        }
        
        const data = await response.json();
        
        if (data.success) {
            displayWines(data.wines);
            updateCounter(data.count);
        }
    } catch (error) {
        showError('Impossible de charger les vins');
        console.error(error);
    }
}

// Suppression avec confirmation
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
            loadWines(); // Rechargement
        } else {
            showError(data.error);
        }
    } catch (error) {
        showError('Erreur lors de la suppression');
    }
}

// Affichage dynamique des vins
function displayWines(wines) {
    const container = document.querySelector('.wines-grid');
    container.innerHTML = ''; // Vider
    
    wines.forEach(wine => {
        const card = createWineCard(wine);
        container.appendChild(card);
    });
}
```

**À dire (1 min 30) :**
> "Le JavaScript utilise les standards modernes : async/await pour la lisibilité, Fetch API pour les requêtes HTTP, try/catch pour la gestion d'erreurs. Chaque action (chargement, suppression) est asynchrone et met à jour le DOM dynamiquement sans rechargement de page."

---

#### **Slide 27 : Organisation SCSS**
**Contenu :**
- Structure du dossier `assets/scss/` :

```scss
// assets/scss/abstract/_variables.scss
$primary-color: #722f37;
$secondary-color: #8b5a3c;
$success-color: #28a745;
$border-radius: 8px;
$spacing: 1rem;

// assets/scss/components/_buttons.scss
.btn {
    padding: $spacing;
    border-radius: $border-radius;
    cursor: pointer;
    
    &-primary {
        background: $primary-color;
        color: white;
        
        &:hover {
            background: darken($primary-color, 10%);
        }
    }
}

// assets/scss/layout/_grid.scss
.wines-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    
    @media (max-width: 1024px) {
        grid-template-columns: repeat(2, 1fr);
    }
    
    @media (max-width: 768px) {
        grid-template-columns: 1fr;
    }
}

// assets/scss/style.scss (fichier principal)
@import 'abstract/variables';
@import 'base/reset';
@import 'components/buttons';
@import 'layout/grid';
// ...
```

**Compilation npm :**
```json
"scripts": {
    "sass": "sass assets/scss/style.scss assets/css/style.css --watch"
}
```

**À dire (1 min) :**
> "Le SCSS est organisé en modules : abstract pour les variables et mixins, base pour les styles globaux, components pour les éléments réutilisables, layout pour les grilles. Cette architecture facilite la maintenance : pour changer la couleur principale, un seul endroit à modifier. La compilation se fait via npm en mode watch pour un feedback immédiat."

---

### 🔐 SECTION 8 : SÉCURITÉ & VEILLE (2 minutes)

#### **Slide 28 : Mesures de sécurité implémentées**
**Contenu :**
- Liste avec icônes :

🔒 **1. Authentification sécurisée**
- Mots de passe hashés avec `password_hash()` (bcrypt)
- Vérification avec `password_verify()`
- Sessions PHP avec `session_start()`

🛡️ **2. Protection contre les injections SQL**
- PDO avec requêtes préparées sur 100% des requêtes
- Paramètres bindés (`bindParam`)
- Jamais de concaténation SQL

🚫 **3. Isolation des données**
- Clause `WHERE user_id = :user_id` sur toutes les opérations
- Un utilisateur ne peut accéder qu'à SES vins
- Vérification côté serveur (pas de confiance côté client)

📁 **4. Upload de fichiers**
- Validation du type MIME (`image/jpeg`, `image/png`)
- Limitation de taille (2 Mo max)
- Nom de fichier randomisé (`uniqid()`)
- Stockage hors de la racine web (uploads/)

✅ **5. Validation des entrées**
- Vérification email unique lors de l'inscription
- Champs obligatoires validés côté serveur
- Gestion des erreurs avec messages clairs

**À dire (1 min 30) :**
> "La sécurité repose sur 5 piliers. Premier point : les mots de passe sont hashés avec bcrypt, un algorithme lent par conception pour ralentir les attaques par force brute. Deuxième point : toutes les requêtes SQL utilisent PDO avec des paramètres préparés, impossible d'injecter du code malveillant. Troisième point : l'isolation des données garantit qu'un utilisateur A ne peut jamais voir ni modifier les vins de l'utilisateur B, même en trafiquant les IDs. Quatrième point : l'upload de fichiers est strictement validé pour éviter l'injection de scripts. Enfin, toute entrée utilisateur est validée côté serveur, car le client ne peut jamais être de confiance."

---

#### **Slide 29 : Veille technologique**
**Contenu :**
- Tableau des ressources consultées :

| Thème | Sources | Apport au projet |
|-------|---------|------------------|
| **Sécurité PHP** | Documentation PHP officielle (password_hash), OWASP | Hashing bcrypt, sessions sécurisées |
| **API REST** | MDN Web Docs (HTTP status codes), articles dev.to | Codes HTTP 200/201/401/404, structure JSON |
| **SCSS** | Documentation Sass officielle, tutoriels | Architecture modulaire, variables, mixins |
| **JavaScript ES6+** | MDN (Fetch API, async/await) | Requêtes asynchrones modernes |
| **PDO** | PHP.net (PDO, requêtes préparées) | Protection injections SQL |

**Fréquence :** 1-2h par semaine de lecture + tests

**Méthode :**
- Consultation documentation officielle en priorité
- Lecture d'articles sur des sites reconnus (MDN, dev.to, Medium)
- Tests en local pour valider la compréhension
- Prise de notes dans un fichier personnel

**À dire (30 sec) :**
> "J'ai maintenu une veille technologique régulière tout au long du projet, en privilégiant les sources officielles : documentation PHP, MDN pour le web, Sass pour le CSS. Cette veille m'a permis de découvrir les bonnes pratiques et de les appliquer immédiatement dans mon code."

---

### ✅ SECTION 9 : VALIDATION DES COMPÉTENCES (1 minute)

#### **Slide 30 : Correspondance avec le référentiel DWWM**
**Contenu :**
- Tableau de synthèse :

| N° | Compétence DWWM | Preuve dans MyCave | Fichiers/Lignes |
|----|-----------------|-------------------|-----------------|
| **1** | Installer et configurer son environnement de travail | WAMP, PHPStorm, Git, npm | README.md |
| **2** | Maquetter des interfaces | Wireframes pages, user flow | Slide 9-12 |
| **3** | Réaliser interfaces statiques | HTML/CSS/SCSS responsive | assets/scss/* |
| **4** | Développer interfaces dynamiques | JavaScript Fetch, manipulation DOM | dashboard.php (L70-120) |
| **5** | Mettre en place une BDD | MySQL (users, wines), relations | database/schema.sql |
| **6** | Développer composants d'accès données | PDO, requêtes préparées | classes/*.php |
| **7** | Développer composants métier | Classes User, Wine, API REST | classes/*.php, api/wines.php |
| **8** | Documenter le déploiement | README, DOC_PROJET, schema.sql | Racine projet |

**Badge de validation :** "8/8 compétences démontrées ✅"

**À dire (1 min) :**
> "Ce projet me permet de valider l'intégralité des 8 compétences du référentiel DWWM. Chaque compétence est démontrée de manière concrète avec des preuves tangibles dans le code. Plutôt que de multiplier les petits exercices, j'ai préféré créer un projet complet qui reflète une situation professionnelle réelle."

---

### 🚀 SECTION 10 : PERSPECTIVES & CONCLUSION (1 minute)

#### **Slide 31 : Perspectives d'évolution**
**Contenu :**
- Roadmap future :

**Court terme (1-2 mois) :**
- 🔐 Ajout de tokens CSRF pour sécuriser les formulaires
- 🔍 Moteur de recherche et filtres (par couleur, région, millésime)
- 📊 Statistiques visuelles (graphiques répartition par région/couleur)

**Moyen terme (3-6 mois) :**
- 📄 Pagination pour les grandes listes (actuellement tout chargé)
- 📸 Prévisualisation image avant upload
- 📱 Progressive Web App (installation mobile, mode hors ligne)
- 💾 Export de la cave en PDF ou Excel

**Long terme (6-12 mois) :**
- 🤝 Partage de cave entre utilisateurs (mode collaboratif)
- 🍷 API publique pour intégration avec d'autres services
- 🧪 Suite de tests automatisés (PHPUnit, Jest, Cypress)
- 🏗️ Migration vers un framework (Symfony/Laravel) pour scalabilité

**À dire (30 sec) :**
> "Le projet est fonctionnel mais évolutif. J'ai identifié plusieurs pistes d'amélioration à court, moyen et long terme : sécurité renforcée avec CSRF, fonctionnalités de recherche et statistiques, optimisation des performances avec pagination, et à terme une migration vers un framework pour gérer des volumes plus importants."

---

#### **Slide 32 : Conclusion & Bilan personnel**
**Contenu :**
- Bilan en 3 points :

**💡 Ce que j'ai appris :**
- Maîtrise de la chaîne complète de développement web (front + back + BDD)
- Importance de la séparation des responsabilités (architecture en couches)
- Bonnes pratiques de sécurité (hash, requêtes préparées, validation)
- Outils modernes (SCSS, Fetch API, async/await, Git)

**🏆 Compétences développées :**
- Autonomie dans la résolution de problèmes techniques
- Capacité à consulter la documentation et faire de la veille
- Rigueur dans l'organisation du code et la structure des dossiers
- Vision globale d'un projet (de la conception au déploiement)

**🎯 Prochaines étapes :**
- Continuer à développer MyCave avec les fonctionnalités identifiées
- Apprendre un framework PHP moderne (Symfony ou Laravel)
- Approfondir JavaScript avec un framework front (Vue.js ou React)
- Contribuer à des projets open-source pour progresser

**Citation finale :**
> *"Un projet complet vaut mieux que mille tutoriels."*

**À dire (30 sec) :**
> "En conclusion, MyCave a été bien plus qu'un simple projet de validation : c'est une expérience complète qui m'a permis de comprendre tous les enjeux du développement web moderne. Je suis maintenant prêt à intégrer une équipe de développement et à continuer d'apprendre. Merci pour votre attention, je suis à votre disposition pour vos questions."

---

## 🎤 GESTION DE LA SESSION QUESTIONS/RÉPONSES (après les 35 min)

### Questions fréquentes anticipées :

**Q1 : "Pourquoi PHP et pas Node.js ?"**
> "PHP reste très présent dans le web professionnel (WordPress, Drupal, Symfony, Laravel). Je voulais maîtriser ces bases avant d'explorer Node.js, que je compte apprendre en parallèle."

**Q2 : "Combien de temps pour développer MyCave ?"**
> "Environ [X] semaines à raison de [Y]h par semaine, soit environ [Z]h au total. Répartition : 20% conception, 50% développement, 20% tests/debug, 10% documentation."

**Q3 : "Utiliseriez-vous MyCave en production ?"**
> "Oui, avec quelques ajustements : HTTPS obligatoire, CSRF tokens, pagination, sauvegarde automatique BDD, monitoring des erreurs. L'architecture de base est saine."

**Q4 : "Quelle est votre plus grande fierté sur ce projet ?"**
> "La qualité de l'architecture : code propre, bien organisé, sécurisé et documenté. C'est un projet dont je suis fier et que je peux montrer à un employeur."

**Q5 : "Quelle a été la plus grande difficulté ?"**
> "Gérer l'upload d'images avec FormData et l'API REST, car multipart/form-data ne supporte pas PUT/PATCH. J'ai dû chercher, tester, et j'ai appris que c'est une contrainte courante résolue par _method."

**Q6 : "Avez-vous travaillé seul ?"**
> "Oui, c'est un projet personnel. J'ai consulté la documentation et des ressources en ligne, mais le code est 100% de moi."

**Q7 : "Quel framework utiliseriez-vous si vous recommenciez ?"**
> "Maintenant que je maîtrise les bases, j'explorerais Symfony pour le back-end et Vue.js pour le front, tout en gardant la même logique architecturale."

**Q8 : "Combien d'utilisateurs MyCave peut-il supporter ?"**
> "Dans l'état actuel, quelques centaines avec WAMP. Pour passer à l'échelle, il faudrait : serveur dédié, cache (Redis), load balancing, CDN pour les images."

---

## 📋 CHECKLIST FINALE AVANT LA PRÉSENTATION

### Technique (30 min avant)
- [ ] WAMP démarré et fonctionnel
- [ ] Base de données avec données de démonstration (5-10 vins)
- [ ] Compte de test prêt (email + password notés)
- [ ] Image de test pour upload (bouteille.jpg sur le bureau)
- [ ] Navigateur ouvert sur http://localhost/Myv12/
- [ ] PHPStorm ouvert avec fichiers clés
- [ ] DevTools (F12) prêts (onglet Network)
- [ ] Présentation PDF ouverte en plein écran

### Mental (10 min avant)
- [ ] Relecture du plan (ce document)
- [ ] Respiration profonde (3x)
- [ ] Verre d'eau à portée
- [ ] Chrono prêt (téléphone en mode avion)
- [ ] Sourire et confiance

### Matériel
- [ ] Laptop chargé + chargeur
- [ ] Câble HDMI/VGA pour projecteur
- [ ] Souris externe (plus confortable)
- [ ] Notes papier (plan simplifié)
- [ ] Clé USB de secours (captures d'écran si bug)

---

## ⏱️ TIMING PRÉCIS AVEC MARGES

| Section | Durée | Début | Fin | Marge |
|---------|-------|-------|-----|-------|
| 1. Introduction | 3 min | 0:00 | 3:00 | 30 sec |
| 2. Analyse besoin | 4 min | 3:00 | 7:00 | 1 min |
| 3. Conception | 4 min | 7:00 | 11:00 | 1 min |
| 4. Architecture | 5 min | 11:00 | 16:00 | 1 min |
| 5. Base de données | 4 min | 16:00 | 20:00 | 1 min |
| 6. **DÉMO LIVE** | 6 min | 20:00 | 26:00 | 2 min |
| 7. Code | 5 min | 26:00 | 31:00 | 1 min |
| 8. Sécurité | 2 min | 31:00 | 33:00 | 30 sec |
| 9. Compétences | 1 min | 33:00 | 34:00 | 30 sec |
| 10. Conclusion | 1 min | 34:00 | 35:00 | 30 sec |
| **TOTAL** | **35 min** | | | **8 min 30** |

**Note :** Les marges permettent de rattraper un imprévu (question, bug, lenteur). Si vous avancez trop vite, développez la démo ou le code.

---

## 🎯 LES 3 MESSAGES CLÉS À FAIRE PASSER

1. **"J'ai créé une application complète de A à Z"**
   - Pas un simple exercice, un vrai projet professionnel

2. **"Je maîtrise les bonnes pratiques de sécurité"**
   - Hash bcrypt, PDO préparé, isolation données, validation uploads

3. **"Je suis capable d'apprendre en autonomie"**
   - Veille technologique, documentation, résolution de problèmes

---

## ✨ PHRASE D'OUVERTURE ET DE CLÔTURE

**OUVERTURE (à mémoriser) :**
> "Bonjour et merci d'être présents aujourd'hui. Je m'appelle [Nom] et je vais vous présenter MyCave, une application web de gestion de cave à vin que j'ai développée dans le cadre de ma formation Développeur Web et Web Mobile. Au cours des 35 prochaines minutes, je vais vous montrer comment ce projet démontre l'ensemble des compétences du référentiel DWWM, de la conception à la sécurité en passant par une démonstration en direct. Commençons par le contexte..."

**CLÔTURE (à mémoriser) :**
> "Merci de votre attention. MyCave représente pour moi bien plus qu'un projet de validation : c'est la preuve concrète de ma capacité à mener un développement web complet, sécurisé et documenté. Je suis maintenant prêt à mettre ces compétences au service d'une équipe et à continuer d'apprendre. Je reste à votre disposition pour répondre à vos questions."

---

## 🚀 DERNIERS CONSEILS

1. **Parlez LENTEMENT** : Vous connaissez votre sujet, le jury découvre
2. **Montrez votre CODE** : Ouvrir les fichiers, pointer les lignes importantes
3. **Assumez vos choix** : "J'ai choisi X parce que Y" (pas d'excuses)
4. **Respirez** : Pause de 2-3 sec entre chaque slide
5. **Regardez le jury** : Pas l'écran, pas vos notes
6. **Souriez** : Vous êtes fier de votre travail, ça doit se voir
7. **Si bug pendant la démo** : Rester calme, expliquer, montrer une capture de secours
8. **Préparez un Plan B** : Captures d'écran de toutes les étapes de la démo

---

**Vous êtes prêt ! Foncez ! 🎉🍷**


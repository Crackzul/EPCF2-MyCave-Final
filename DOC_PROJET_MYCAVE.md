# Projet MyCave – Dossier de présentation

Ce document décrit le projet MyCave (gestion de cave à vin), ses objectifs, son architecture front-end et back-end, ainsi que la manière dont il couvre les compétences du référentiel DWWM.

> NOTE : Ce fichier est une ossature. Tu peux compléter et adapter le texte directement dans ce document selon ton expérience en entreprise.

---

## 1. Présentation générale du projet

MyCave est une application web qui permet à un utilisateur authentifié de gérer sa cave à vin personnelle. L’objectif est de centraliser au même endroit la liste de ses bouteilles, leurs caractéristiques (nom, domaine, millésime, région, couleur, etc.) et une photo illustrative, afin de faciliter le suivi de son stock au quotidien. Ce projet a été réalisé dans le cadre de ma formation **Développeur Web et Web Mobile (DWWM)** et constitue un support concret pour mettre en pratique les notions de front-end, de back-end et de base de données.

Sur le plan pédagogique, MyCave m’a permis de travailler sur l’ensemble de la chaîne d’une application web dynamique : conception de la base MySQL, création de pages PHP, gestion des sessions et de l’authentification, mise en place d’un CRUD complet sur les vins, et intégration d’une interface agréable en HTML/CSS/SCSS. Le développement s’est fait en local sur un environnement **WAMP (Windows, Apache, MySQL, PHP)**, avec **PHPStorm** comme IDE principal pour structurer le projet et faciliter la navigation entre les fichiers.

La version actuelle de MyCave offre un parcours utilisateur complet : création de compte, connexion, accès à un tableau de bord listant les vins de l’utilisateur connecté, ajout et modification de fiches vin, suppression d’entrées et gestion d’images stockées dans un répertoire dédié. L’application reste volontairement simple, mais elle couvre l’essentiel d’un projet web professionnel : séparation des responsabilités, accès sécurisé aux données, interface responsive et documentation.

*(Une capture d’écran représentative de la page `dashboard.php`, montrant la liste des vins pour un utilisateur connecté, pourra être insérée ici ou en annexe – par exemple : « Figure 1 : Tableau de bord MyCave – vue des vins de l’utilisateur ». )*

- **Nom du projet** : MyCave
- **Objectif** : application web permettant à un utilisateur authentifié de gérer sa cave à vin personnelle (ajout, consultation, modification, suppression, illustration par photo des bouteilles).
- **Public cible** : particuliers amateurs de vin souhaitant suivre leur stock, étudiants/développeurs pour démonstration pédagogique.
- **Technologies principales** : PHP (POO), MySQL, HTML5, CSS3/SCSS, JavaScript (Fetch API), WAMP.

### 1.1. Contexte du projet / entreprise

Le projet MyCave s’inscrit dans le cadre de ma formation **Développeur Web et Web Mobile (DWWM)**. Il a été conçu comme un projet fil rouge permettant de mettre en pratique, sur un cas concret, l’ensemble de la chaîne de réalisation d’une application web dynamique : de la conception de la base de données jusqu’à l’interface utilisateur, en passant par le développement PHP et la gestion de l’authentification.

Dans ce contexte, MyCave joue à la fois le rôle d’outil métier (gestion d’une cave à vin personnelle) et de support pédagogique. Il m’a permis d’appliquer les notions vues en cours : création d’une base relationnelle MySQL, utilisation de **PDO** et des requêtes préparées, organisation d’un projet PHP, gestion des sessions, intégration HTML/CSS/SCSS et premiers éléments de JavaScript.

Au niveau de l’organisation, le projet se rapproche du fonctionnement d’une petite agence web : un tuteur technique (développeur PHP expérimenté) pour valider les choix d’architecture et m’accompagner sur les bonnes pratiques, un référent métier imaginé comme un amateur de vin exprimant ses besoins fonctionnels, et moi en position de développeur/alternant chargé à la fois du front, du back et de la base de données. Cette configuration m’a obligé à raisonner à la fois en termes de contraintes techniques et de besoins utilisateur.

Les principaux objectifs de qualité fixés dès le départ étaient les suivants : produire un code lisible et structuré, facilement compréhensible par un autre développeur ; proposer une interface simple et agréable, utilisable sur ordinateur comme sur mobile ; respecter un minimum de bonnes pratiques de sécurité (mots de passe hashés, requêtes préparées, séparation des données par utilisateur) ; et fournir une documentation claire (installation, utilisation) ainsi qu’un jeu d’essai démontrant les fonctionnalités principales.

### 1.2. Cahier des charges (expression de besoin)

Le besoin exprimé par le référent métier est de disposer d’un outil simple pour suivre sa cave à vin, accessible depuis n’importe quel navigateur, sans installation spécifique côté utilisateur.

#### 1.2.1. Fonctions principales

- **Gestion des utilisateurs** :
  - inscription d’un nouvel utilisateur via un formulaire dédié,
  - connexion avec email et mot de passe,
  - déconnexion et destruction de la session,
  - différenciation simple des rôles (utilisateur standard / administrateur).

- **Gestion des vins** :
  - créer une fiche vin avec les informations suivantes :
    - nom du vin,
    - domaine / producteur,
    - millésime (année),
    - cépages,
    - pays et région,
    - couleur (rouge, blanc, rosé, etc.),
    - description / notes de dégustation,
    - photo de la bouteille (upload d’image),
  - consulter la liste de ses vins sous forme de cartes avec image et principales informations,
  - rechercher visuellement rapidement un vin dans sa cave,
  - modifier une fiche existante (corriger une erreur, ajouter un commentaire),
  - supprimer un vin qui n’est plus en stock.

- **Interface utilisateur** :
  - page de connexion / inscription claire et rassurante,
  - tableau de bord affichant la liste des vins de l’utilisateur connecté,
  - formulaire d’ajout / modification avec validation des champs et messages d’erreur/succès,
  - design moderne (glassmorphism, typographie soignée) en cohérence avec l’univers du vin,
  - interface responsive utilisable sur desktop, tablette et mobile.

- **API et architecture** :
  - exposer un endpoint REST (`api/wines.php`) pour le CRUD des vins,
  - authentification traditionnelle via formulaires PHP et sessions (`index.php`, `register.php`, `logout.php`),
  - séparer la logique métier (classes PHP) de la couche de présentation (vues PHP/HTML),
  - centraliser la configuration de la base de données.

#### 1.2.2. Contraintes et livrables

- **Contraintes techniques** :
  - hébergement sur un environnement PHP/MySQL classique (WAMP en développement, hébergeur mutualisé en production),
  - utilisation de MySQL comme SGBD relationnel,
  - compatibilité avec des navigateurs modernes (Chrome, Firefox, Edge),
  - gestion des droits d’écriture sur le répertoire `uploads/` pour l’enregistrement des images.

- **Contraintes de planning** :
  - projet réalisé sur une période limitée (quelques semaines) en parallèle d’autres missions,
  - livrables intermédiaires attendus : maquettes, prototype statique, puis version dynamique connectée à la base.

- **Livrables attendus** :
  - code source complet du projet (PHP, SCSS, JS, SQL),
  - script SQL de création de la base (`database/schema.sql`),
  - documentation d’installation et d’utilisation (`README.md`, `DOC_PROJET_MYCAVE.md`),
  - captures d’écran des principales interfaces (web et mobile),
  - éléments de conception (schéma de base de données, schéma de navigation).

---

## 2. Environnement technique et architecture

### 2.1. Environnement de travail (Compétence 1)

- **Système** : Windows 10/11 + WAMP (Apache, PHP, MySQL).
- **Serveur web** : Apache intégré à WAMP, configuration par défaut adaptée au développement local.
- **SGBD** : MySQL, administration via phpMyAdmin.
- **IDE** : PHPStorm comme IDE principal, avec intégration Git, prise en charge de PHP et SCSS.
- **Gestion de versions** : dépôt Git local (et éventuellement GitHub) pour historiser les évolutions du projet.
- **Préprocesseur CSS** : SCSS compilé vers `assets/css/style.css` via npm (scripts définis dans `package.json`).

#### Installation locale

1. Cloner ou copier le projet dans le répertoire WAMP :
   - `C:/wamp64/www/Myv12`
2. Démarrer WAMP et vérifier que le serveur Apache et MySQL sont en vert.
3. Créer une base de données MySQL (ex : `mycave_db`).
4. Importer le fichier `database/schema.sql` via phpMyAdmin (onglet *Import*).
5. Configurer l’accès à la BDD dans `config/database.php` / `config/pdo.php` (nom de base, utilisateur, mot de passe).
6. Vérifier que le dossier `uploads/` existe et qu’il est inscriptible (pour l’upload des photos de bouteilles).
7. Lancer l’application via : `http://localhost/Myv12/index.php`.

Des captures d’écran de WAMP, de phpMyAdmin (tables `users` et `wines`) et de l’IDE avec l’arborescence du projet peuvent être ajoutées en annexe pour illustrer cet environnement.

### 2.2. Architecture des fichiers

L’architecture de MyCave est organisée par responsabilités :

- `api/` : endpoints REST utilisés par le front via JavaScript :
  - `auth.php` : opérations d’authentification (login, register, logout, récupération d’infos utilisateur),
  - `wines.php` : opérations CRUD sur les vins (liste, ajout, modification, suppression).
- `classes/` : classes métier qui encapsulent la logique d’accès aux données :
  - `User.php` : gestion des utilisateurs (création, recherche par email, vérification du mot de passe, etc.),
  - `Wine.php` : gestion des vins (liste des vins par utilisateur, ajout, mise à jour, suppression).
- `config/` : configuration technique et scripts utilitaires :
  - `database.php` / `pdo.php` : création de la connexion PDO à MySQL,
  - scripts procéduraux pour la gestion des utilisateurs (CRUD d’administration si nécessaire).
- `database/` : éléments relatifs à la base de données :
  - `schema.sql` : script SQL de création des tables et d’insertion d’un jeu de données de test.
- `assets/` : ressources statiques :
  - `css/style.css` : feuille de styles compilée,
  - `scss/` : sources SCSS structurées par dossiers (`abstract`, `base`, `components`, `layout`, `pages`),
  - `img/` : images (fonds, illustrations, logos) et captures éventuelles,
  - `fonts/` : polices embarquées.
- `includes/` : éléments PHP réutilisables :
  - `session.php` : initialisation et gestion de la session utilisateur.
- `uploads/` : répertoire où sont enregistrées les images uploadées pour les bouteilles.
- Fichiers de pages principales (front) :
  - `index.php` : page de connexion,
  - `register.php` : page d’inscription,
  - `dashboard.php` : tableau de bord de l’utilisateur connecté (liste de ses vins),
  - `add-wine.php` : formulaire d’ajout / d’édition d’un vin.

Un schéma d'architecture simple peut être ajouté ici pour synthétiser :

> **Architecture hybride** :
> - **Authentification** : Navigateur (Formulaires HTML) ⇄ Pages PHP (`index.php`, `register.php`) ⇄ Classes (`User`) ⇄ Base MySQL
> - **CRUD Vins** : Navigateur (JavaScript/Fetch) ⇄ API REST (`api/wines.php`) ⇄ Classes (`Wine`) ⇄ Base MySQL

Ce schéma illustre la séparation des responsabilités : authentification traditionnelle (formulaires + sessions) et gestion des vins via API REST pour une interface dynamique sans rechargement.

---

## 3. Interfaces utilisateur et partie dynamique front-end (Compétences 2, 3 et 4)

### 3.1. Interfaces utilisateur – maquettage et navigation

#### 3.1.1. Maquettage

- Maquettes initiales / pages statiques : `dashboard.html` et `add.html` (si présentes).
- Outils éventuellement utilisés : Figma, maquettes papier, etc.
- Adaptations : ces maquettes ont été intégrées et enrichies dans `dashboard.php` et `add-wine.php`.

_(Insérer ici des captures de maquettes + un schéma d’enchaînement : Login → Dashboard → Formulaire.)_

#### 3.1.2. Schéma de navigation

- Parcours type utilisateur :
  - Arrivée sur `index.php` (connexion),
  - Accès à `register.php` si création de compte nécessaire,
  - Redirection vers `dashboard.php` après authentification réussie,
  - Accès au formulaire d’ajout/édition via `add-wine.php`,
  - Retour au tableau de bord et consultation/suppression de vins.

Un schéma ou diagramme simple peut être ajouté pour montrer ce flux.

### 3.2. Interfaces HTML

Pages principales :

- `index.php` : page de connexion.
- `register.php` : page d’inscription.
- `dashboard.php` : tableau de bord listant les vins de l’utilisateur.
- `add-wine.php` : formulaire d’ajout / édition de vin.

Pour chaque page, tu peux ajouter :

- un court extrait de structure HTML,
- une explication des sections (header, navigation, liste de cartes, formulaire, messages d’erreur).

### 3.3. Styles CSS / SCSS

- Architecture SCSS :
  - `abstract/_variables.scss`, `_mixins.scss` : couleurs, typographie, fonctions utilitaires.
  - `base/_base.scss`, `_typography.scss` : styles généraux.
  - `components/_buttons.scss`, `_forms.scss` : composants réutilisables.
  - `layout/_add.scss`, etc. : mise en page par type de page.
- Le SCSS est compilé en `assets/css/style.css`.
- Design responsive basé sur des media queries.

_(Insérer 2–3 extraits de SCSS intéressants : variables, mixins, composants.)_

### 3.4. Partie dynamique front-end (JavaScript)

La partie JavaScript de MyCave est intégrée directement dans les balises `<script>` des pages PHP (`dashboard.php`, `add-wine.php`), permettant une gestion dynamique des interactions utilisateur sans rechargement complet de la page. Le code utilise l'API Fetch moderne pour communiquer avec le back-end de manière asynchrone.

#### 3.4.1. Localisation et vue d'ensemble du code JavaScript

Le code JavaScript de MyCave est intégré dans **deux fichiers principaux** :

- **`dashboard.php`** (lignes 58-232) : chargement et affichage dynamique des vins, suppression avec confirmation, mise à jour du compteur de bouteilles.
- **`add-wine.php`** (lignes 137-195) : soumission asynchrone du formulaire d'ajout/modification avec upload d'image.

**Note** : La page `register.php` utilise uniquement la validation HTML5 native (`required`, `type="email"`) sans JavaScript.

**Technologies utilisées :**
- Fetch API pour les appels REST asynchrones
- `async/await` pour une gestion claire des promesses
- FormData pour l'upload de fichiers
- Template literals (ES6) pour la génération HTML dynamique
- Fonction `escapeHTML()` custom pour la sécurité XSS

---

#### 3.4.2. Exemples de code JavaScript significatifs

Les trois extraits suivants ont été sélectionnés pour leur pertinence pédagogique et leur démonstration de compétences variées.

##### Exemple 1 : Suppression d'une bouteille avec confirmation

**Contexte :** Lorsque l'utilisateur clique sur l'icône "Supprimer" d'une carte de vin, cette fonction gère l'ensemble du processus : confirmation, appel API, feedback visuel et mise à jour de l'interface.

```javascript
// Extrait de dashboard.php (lignes 144-167)
async function deleteWine(wineId) {
  // 1. Confirmation utilisateur avant action destructive
  if (!confirm('Êtes-vous sûr de vouloir supprimer cette bouteille ?')) {
    return; // Annulation : on arrête ici
  }
  
  try {
    // 2. Appel DELETE vers l'API REST
    const response = await fetch(`api/wines.php?id=${wineId}`, {
      method: 'DELETE'
    });
    
    const data = await response.json();
    
    if (data.success) {
      // 3. Feedback positif avec icône personnalisée
      showMessage('Bouteille supprimée avec succès', 'success', 
                  'assets/img/trash-arrow-up.svg');
      
      // 4. Rechargement de la liste (mise à jour du DOM et du compteur)
      await loadWines();
    } else {
      // 5. Gestion de l'erreur métier (ex: vin introuvable)
      showError(data.error || 'Erreur lors de la suppression');
    }
  } catch (error) {
    // 6. Gestion de l'erreur réseau (ex: serveur injoignable)
    showError('Erreur de connexion');
  }
}
```

**Compétences démontrées :**
- **API REST** : requête DELETE avec paramètre dans l'URL
- **Asynchrone** : `async/await` pour gérer les promesses de manière lisible
- **UX** : confirmation avant suppression, feedback immédiat
- **Gestion d'erreurs** : distinction erreur métier vs. erreur réseau
- **Modularité** : appel à des fonctions réutilisables (`loadWines`, `showMessage`)

##### Exemple 2 : Génération dynamique de cartes HTML avec sécurité XSS

**Contexte :** Cette fonction transforme les données JSON reçues de l'API en HTML visuel (cartes de vins). Toutes les données utilisateur sont échappées pour prévenir les attaques XSS.

```javascript
// Extrait de dashboard.php (lignes 101-141)

// Fonction d'échappement HTML pour prévenir les attaques XSS
function escapeHTML(str) {
  const p = document.createElement('p');
  p.appendChild(document.createTextNode(str));
  return p.innerHTML; // Les caractères spéciaux sont automatiquement échappés
}

function createWineCard(wine) {
  const imageUrl = wine.picture ? `uploads/${wine.picture}` : '';

  // Template littéral : génération HTML dynamique
  return `
    <div class="wine-card" data-id="${wine.id}">
      <div class="wine-image">
        <!-- Fallback si l'image n'existe pas -->
        <img src="${imageUrl}" 
             alt="${escapeHTML(wine.name)}" 
             onerror="this.style.display='none'">
      </div>
      <div class="wine-info">
        <!-- Échappement systématique des données utilisateur -->
        <h3>${escapeHTML(wine.name)}</h3>
        <div class="wine-details">
          <span><strong>Année:</strong> ${wine.year}</span>
          <span><strong>Cépage:</strong> ${escapeHTML(wine.grapes)}</span>
          <span><strong>Pays:</strong> ${escapeHTML(wine.country)}</span>
          <span><strong>Région:</strong> ${escapeHTML(wine.region)}</span>
        </div>
        <div class="wine-description">${escapeHTML(wine.description)}</div>
        
        <!-- Boutons d'action avec icônes SVG -->
        <div class="wine-actions">
          <button class="btn-icon" onclick="editWine(${wine.id})" title="Modifier">
            <img src="assets/img/pen-to-square.svg" alt="Modifier" class="icon-svg">
          </button>
          <button class="btn-icon" onclick="deleteWine(${wine.id})" title="Supprimer">
            <img src="assets/img/trash-arrow-up.svg" alt="Supprimer" class="icon-svg">
          </button>
        </div>
      </div>
    </div>
  `;
}
```

**Compétences démontrées :**
- **Sécurité** : échappement HTML pour prévenir les injections XSS
- **Manipulation DOM** : génération HTML dynamique via template literals (ES6)
- **Gestion d'images** : fallback avec `onerror` si image introuvable
- **Accessibilité** : attributs `alt` et `title` pour les lecteurs d'écran
- **Architecture** : fonction pure, facile à tester et réutiliser

##### Exemple 3 : Soumission de formulaire avec upload d'image

**Contexte :** Cette fonction gère la soumission du formulaire d'ajout ou de modification de vin, y compris l'upload de l'image de la bouteille. Elle distingue automatiquement le mode création du mode édition.

**1. Gestion des formulaires avec soumission asynchrone**

**Contexte :** Cette fonction gère la soumission du formulaire d'ajout ou de modification de vin, y compris l'upload de l'image de la bouteille. Elle distingue automatiquement le mode création du mode édition.

```javascript
// Extrait de add-wine.php (lignes 141-181)
const isEdit = <?= $isEdit ? 'true' : 'false' ?>; // Variable PHP injectée
const wineData = <?= $isEdit ? json_encode($wineData) : 'null' ?>;

document.getElementById('wineForm').addEventListener('submit', async (e) => {
  e.preventDefault(); // Empêche le rechargement de la page
  
  // FormData : permet d'envoyer des fichiers (multipart/form-data)
  const formData = new FormData(e.target);
  
  try {
    let response;
    
    if (isEdit) {
      // Mode édition : simulation de PUT via POST (limitation multipart/form-data)
      formData.append('_method', 'PUT');
      formData.append('id', wineData.id);
      
      response = await fetch('api/wines.php', {
        method: 'POST', // POST obligatoire pour envoyer des fichiers
        body: formData
      });
    } else {
      // Mode création : POST classique
      response = await fetch('api/wines.php', {
        method: 'POST',
        body: formData
      });
    }
    
    const data = await response.json();
    
    if (data.success) {
      // Feedback positif
      showMessage(data.message || '🍷 Bouteille sauvegardée avec succès !', 'success');
      
      // Redirection après 1,5 seconde (laisse le temps de voir le message)
      setTimeout(() => {
        window.location.href = 'dashboard.php';
      }, 1500);
    } else {
      // Affichage de l'erreur sans quitter la page
      showMessage(data.error || 'Erreur lors de la sauvegarde', 'error');
    }
  } catch (error) {
    // Erreur réseau ou parsing JSON
    showMessage('Erreur de connexion au serveur', 'error');
    console.error('Erreur:', error);
  }
});
```

**Compétences démontrées :**
- **Upload de fichiers** : `FormData` pour gérer les images (multipart/form-data)
- **Logique conditionnelle** : distinction création vs. édition avec `if/else`
- **API REST** : simulation de PUT via POST + `_method` (workaround standard)
- **UX avancée** : feedback immédiat + redirection différée (1,5s)
- **Gestion d'erreurs** : `try/catch` + `console.error` pour le debugging
- **Intégration PHP-JS** : variables PHP injectées dans le contexte JavaScript

##### 📸 Captures d'écran pour ces exemples

**Pour l'exemple 1 (Suppression) :**
1. Dashboard avec curseur survolant l'icône "Supprimer"
2. Boîte de dialogue de confirmation du navigateur
3. Console développeur montrant la requête DELETE et la réponse JSON `{"success": true}`
4. Message de succès vert avec icône poubelle
5. Dashboard actualisé : carte disparue, compteur mis à jour

**Pour l'exemple 2 (Génération de cartes) :**
1. Console développeur montrant les données JSON reçues de `api/wines.php`
2. Inspecteur d'éléments montrant le HTML généré d'une carte
3. Exemple de sécurité : nom de vin contenant `<script>` affiché comme texte échappé

**Pour l'exemple 3 (Formulaire) :**
1. Formulaire rempli avec image sélectionnée
2. Console développeur (Network) montrant la requête POST avec FormData
3. Message de succès avec emoji 🍷 avant redirection

---

#### 3.4.3. Points forts de l'implémentation JavaScript

**Architecture et bonnes pratiques :**
- ✅ **Code modulaire** : fonctions réutilisables (`loadWines`, `showMessage`, `escapeHTML`)
- ✅ **Séparation des responsabilités** : chaque fonction a un rôle clair et unique
- ✅ **Gestion d'erreurs robuste** : distinction erreur métier vs. erreur réseau
- ✅ **Sécurité XSS** : échappement systématique des données utilisateur
- ✅ **UX soignée** : confirmations, feedback immédiat, redirections différées

**Expérience utilisateur :**
- ✅ **Pas de rechargement** : mises à jour ciblées du DOM pour une navigation fluide
- ✅ **Feedback visuel** : messages colorés (vert/rouge) avec icônes personnalisées
- ✅ **Confirmation des actions destructives** : `confirm()` avant suppression
- ✅ **Messages clairs** : distinction entre erreurs techniques et erreurs métier

**Technologies modernes :**
- ✅ **ES6+** : `async/await`, template literals, arrow functions
- ✅ **Fetch API** : remplacement moderne de XMLHttpRequest
- ✅ **FormData** : gestion native des uploads de fichiers
- ✅ **API HTML5** : validation native des formulaires

##### 🚀 Pistes d'amélioration identifiées

Dans le cadre d'une évolution future du projet, les améliorations suivantes pourraient être envisagées :

- **Indicateurs de chargement** : spinners pendant les requêtes API longues
- **Validation JavaScript avancée** : vérification du format email et de la robustesse du mot de passe avant soumission
- **Prévisualisation d'image** : aperçu de l'image uploadée avant envoi du formulaire
- **Gestion hors ligne** : Service Workers pour consulter la cave sans connexion
- **Accessibilité renforcée** : rôles ARIA pour les messages dynamiques (`role="alert"`)
- **Tests automatisés** : suite de tests avec Jest ou Cypress

---

---

**📝 Remarques pour le rédacteur :**

- Les numéros de lignes indiqués sont approximatifs et peuvent varier si le code évolue.
- Pour illustrer cette section, privilégie des captures d'écran avec des annotations (flèches, encadrés) pour guider l'œil du lecteur.
- Un fichier de référence complet avec tous les extraits de code et un guide de prise de captures est disponible dans `DOC_PROJET_MYCAVE_3.4_COMPLET.md`.

---

## 4. Composants back-end, base de données et sécurité

### 4.1. Modélisation et base de données (Compétences 5 et 6)

#### 4.1.1. Schéma relationnel

La base de données MyCave repose au minimum sur les tables :

- `users` : stocke les informations de connexion (email, mot de passe hashé, rôle, etc.).
- `wines` : stocke les vins associés à un utilisateur (nom, millésime, pays, image, etc.).

Relation principale : un `user` possède plusieurs `wines` (relation 1-N).

_(Insérer ici le schéma MCD/MLD ou un schéma logique avec colonnes, types et contraintes.)_

#### 4.1.2. Script SQL et jeu d’essai

- Le fichier `database/schema.sql` contient :
  - la création des tables,
  - les clés primaires/étrangères,
  - un jeu de données de test (utilisateurs, vins).

_(Tu peux décrire ici les comptes de test et quelques exemples de vins créés.)_

#### 4.1.3. Accès aux données (PDO et requêtes préparées)

- La connexion est centralisée dans `config/database.php` ou `config/pdo.php`.
- Les classes `User` et `Wine` exécutent des requêtes préparées pour :
  - créer, lire, mettre à jour et supprimer des enregistrements,
  - filtrer les vins par `user_id` (séparation des données entre utilisateurs).

_(Insérer 1–2 extraits de code PHP montrant une requête préparée en SELECT et INSERT/UPDATE.)_

### 4.2. Composants back-end et API – Compétence 2 (Back-end sécurisé)

#### 4.2.1. Système de login / gestion des utilisateurs

- Les classes et scripts impliqués :
  - `classes/User.php` : logique métier (création, login, vérification email),
  - `includes/session.php` : fonctions de gestion de session (`isLoggedIn()`, `createUserSession()`, `requireLogin()`),
  - `index.php` : page de connexion (formulaire POST vers la même page),
  - `register.php` : page d'inscription (formulaire POST),
  - `logout.php` : destruction de session.
  
- **Architecture** : Authentification traditionnelle (pas d'API REST)
  - Les formulaires de connexion/inscription soumettent directement vers les pages PHP
  - Les pages PHP instancient la classe `User` pour valider les credentials
  - En cas de succès, création de session PHP avec `createUserSession()`
  - Redirection vers `dashboard.php`

- Flux typique :
  - **Inscription** → `register.php` POST → `User::create()` → stockage en base (mot de passe hashé avec `password_hash()`) → session créée → redirection dashboard
  - **Connexion** → `index.php` POST → `User::login()` → vérification email + `password_verify()` → session créée → redirection dashboard
  - **Déconnexion** → `logout.php` → `session_destroy()` → redirection index

_(Tu peux renvoyer ici vers `REGISTRATION_FEATURE.md` qui détaille davantage cette partie.)_

#### 4.2.2. API REST des vins (CRUD)

- **Endpoint principal** : `api/wines.php`
- **Authentification** : Vérification de session PHP via `isLoggedIn()` (ligne 11-15)
  ```php
  if (!isLoggedIn()) {
      http_response_code(401);
      echo json_encode(['error' => 'Non autorisé']);
      exit();
  }
  ```

- **Méthodes HTTP supportées** :
  - `GET` : liste des vins de l'utilisateur connecté
  - `POST` : création d'un nouveau vin (avec upload d'image)
  - `POST` + `_method=PUT` : mise à jour d'un vin existant (avec upload optionnel)
    - **Note technique** : La méthode POST est utilisée pour les modifications car `multipart/form-data` (nécessaire pour l'upload de fichiers) ne supporte pas nativement les méthodes PUT/PATCH. Le paramètre `_method=PUT` permet de simuler la méthode PUT côté serveur, c'est une pratique courante dans les frameworks web.
  - `DELETE` : suppression d'un vin

- **Format de données** : 
  - Réponses : JSON (`Content-Type: application/json`)
  - Envois : `multipart/form-data` (pour l'upload d'images)

- **Sécurité** :
  - Vérification que l'utilisateur ne peut modifier/supprimer que ses propres vins
  - Upload d'images : validation du type MIME, noms de fichiers uniques (uniqid)
  - Requêtes préparées PDO dans les classes métier

- **Exemple de flux** :
  ```
  dashboard.php (JavaScript) 
    → fetch('api/wines.php') 
    → Vérification session 
    → Wine::getByUserId() 
    → SELECT en BDD
    → JSON {success: true, wines: [...], count: 12}
  ```

_(Décrire ici un ou deux exemples complets de requête/réponse si nécessaire.)_

### 4.3. Sécurité et qualité – Compétence 8

#### 4.3.1. Mesures de sécurité mises en place

- **Authentification** :
  - mots de passe hashés (function `password_hash` / `password_verify`),
  - sessions PHP pour sécuriser les pages et les APIs.
- **Accès aux données** :
  - requêtes préparées PDO pour éviter l’injection SQL,
  - filtrage des vins par `user_id` (un utilisateur ne voit que ses données).
- **Upload de fichiers** :
  - répertoire dédié `uploads/`,
  - renommage des fichiers,
  - vérifications basiques de taille et de type (à décrire / compléter selon ton code).

_(Tu peux ajouter ici les faiblesses identifiées et les pistes d’amélioration : CSRF, XSS, mots de passe plus robustes, HTTPS, etc.)_

#### 4.3.2. Jeu d’essai fonctionnel

Décrire un scénario de test représentatif (par exemple, la gestion complète d’un vin) :

- **Données en entrée** :
  - login avec un utilisateur de test,
  - création d’un vin (nom, année, etc.),
  - modification d’une information,
  - suppression du vin.
- **Données attendues** :
  - vérification en base (ligne créée / modifiée / supprimée),
  - affichage correct sur le dashboard.
- **Données obtenues et analyse des écarts** :
  - comportement réel observé,
  - éventuelles anomalies et corrections apportées.

#### 4.3.3. Veille technologique

Tout au long du projet MyCave, j'ai effectué une veille technologique ciblée pour comprendre et appliquer les bonnes pratiques de développement web. Voici les ressources principales que j'ai consultées et ce que j'en ai retenu :

##### 1) Sécurité des mots de passe et des sessions en PHP

**Sources consultées :**
- Documentation officielle PHP : [password_hash()](https://www.php.net/manual/fr/function.password-hash.php) et [password_verify()](https://www.php.net/manual/fr/function.password-verify.php)
- Tutoriel OpenClassrooms : "Gérer l'authentification des utilisateurs en PHP"
- Article MDN : "Sécurité des sites web - Bonnes pratiques"

**Ce que j'ai appris :**
- Ne **jamais** stocker les mots de passe en clair dans la base de données
- Utiliser `password_hash()` avec `PASSWORD_DEFAULT` (utilise automatiquement bcrypt, bien plus sûr que md5 ou sha1)
- Vérifier les mots de passe avec `password_verify()` au lieu de comparer directement les hash
- Gérer les sessions PHP pour protéger les pages et l'accès aux données

**Application dans MyCave :**
```php
// Dans classes/User.php - Ligne 31 (inscription)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Dans classes/User.php - Ligne 61 (connexion)
if (password_verify($password, $user['password'])) {
    return $user;
}
```

##### 2) Bonnes pratiques des API REST

**Sources consultées :**
- Documentation MDN : [Codes de statut HTTP](https://developer.mozilla.org/fr/docs/Web/HTTP/Status)
- Article : "REST API Best Practices" sur dev.to
- Tutoriel YouTube : "Créer une API REST en PHP"

**Ce que j'ai appris :**
- Utiliser les **bons codes HTTP** pour indiquer le résultat d'une requête :
  - `200` : succès (lecture, mise à jour)
  - `201` : création réussie
  - `204` : suppression réussie (pas de contenu à renvoyer)
  - `400` : erreur dans les données envoyées
  - `401` : utilisateur non connecté
  - `404` : ressource introuvable
  - `500` : erreur serveur
- Toujours renvoyer du **JSON structuré** avec au minimum `{"success": true/false}`
- Comprendre les méthodes HTTP : `GET` (lire), `POST` (créer), `PUT` (modifier), `DELETE` (supprimer)
- **Contrainte technique** : lorsqu'on envoie des fichiers (FormData), on doit utiliser POST même pour les modifications, et simuler PUT via un paramètre `_method` (c'est une pratique standard)

**Application dans MyCave :**
```php
// Dans api/wines.php - Ligne 11 (vérification connexion)
if (!isLoggedIn()) {
    http_response_code(401); // Code HTTP explicite
    echo json_encode(['error' => 'Non autorisé']);
    exit();
}

// Dans api/wines.php - Ligne 149 (suppression réussie)
http_response_code(200);
echo json_encode([
    'success' => true,
    'message' => 'Vin supprimé avec succès'
]);
```

##### 3) Outils modernes de CSS : SCSS

**Sources consultées :**
- Documentation officielle Sass : [sass-lang.com](https://sass-lang.com/guide)
- Tutoriel : "Apprendre SCSS en 20 minutes" sur YouTube
- Article : "Pourquoi utiliser SCSS plutôt que CSS ?"

**Ce que j'ai appris :**
- SCSS permet d'organiser le code CSS en **plusieurs fichiers** (un par composant)
- Utilisation de **variables** pour centraliser les couleurs et tailles (plus facile à modifier)
- Les **mixins** permettent de réutiliser des blocs de code (exemple : border-radius identique partout)
- Le code SCSS se **compile** en CSS classique via npm

**Application dans MyCave :**
```scss
// assets/scss/abstract/_variables.scss
$primary-color: #722f37;    // Couleur principale (bordeaux)
$success-color: #28a745;     // Vert pour les messages de succès
$border-radius: 8px;         // Arrondi uniforme

// assets/scss/components/_buttons.scss
.btn-primary {
    background: $primary-color;  // Variable réutilisée
    border-radius: $border-radius;
}
```

**Commande de compilation :**
```bash
npm run sass  # Transforme le SCSS en CSS
```

##### 4) JavaScript moderne : Fetch API et async/await

**Sources consultées :**
- Documentation MDN : [Fetch API](https://developer.mozilla.org/fr/docs/Web/API/Fetch_API/Using_Fetch)
- Article : "Async/await : enfin des promesses faciles à lire"
- Tutoriel : "Remplacer XMLHttpRequest par Fetch"

**Ce que j'ai appris :**
- `fetch()` est la méthode **moderne** pour faire des requêtes HTTP en JavaScript (remplace l'ancien XMLHttpRequest)
- `async/await` rend le code **plus lisible** qu'avec `.then().catch()`
- Toujours gérer les erreurs avec un `try/catch` pour éviter les bugs silencieux

**Application dans MyCave :**
```javascript
// dashboard.php - Ligne 70 (récupération des vins)
async function loadWines() {
    try {
        const response = await fetch('api/wines.php');
        const data = await response.json();
        
        if (data.success) {
            displayWines(data.wines);
        }
    } catch (error) {
        showError('Erreur de connexion');
    }
}
```

##### Synthèse de la veille

| Thème | Source principale | Apport concret au projet |
|-------|------------------|--------------------------|
| Sécurité mots de passe | Documentation PHP officielle | `password_hash()` et `password_verify()` dans User.php |
| API REST | MDN + dev.to | Codes HTTP 200/201/401/404 dans api/wines.php |
| SCSS | sass-lang.com | Organisation du CSS en dossiers (abstract, components, layout) |
| JavaScript moderne | MDN Fetch API | Fonction `loadWines()` avec async/await dans dashboard.php |

**Fréquence de la veille :** Consultations ponctuelles lors de chaque nouvelle fonctionnalité à implémenter (environ 1-2h par semaine), avec prise de notes dans un fichier `NOTES_VEILLE.md` (non versioned).

**Pistes d'amélioration identifiées grâce à la veille :**
- Ajouter une protection **CSRF** (Cross-Site Request Forgery) avec des tokens
- Forcer **HTTPS** en production pour sécuriser les sessions
- Implémenter une **pagination** pour les grandes listes de vins (actuellement toutes les bouteilles chargées d'un coup)
- Utiliser **Vite.js** comme bundler moderne pour remplacer la compilation SCSS manuelle

---

## 5. Résumé du Projet

**MyCave** est une application web full-stack de gestion de cave à vin personnelle développée dans le cadre de ma formation **Développeur Web et Web Mobile (DWWM)**. Elle permet à chaque utilisateur authentifié de gérer son stock de bouteilles avec un système complet de CRUD (création, lecture, modification, suppression).

Le projet couvre l'intégralité de la chaîne de développement web moderne. Le **front-end** utilise HTML5/CSS3 avec une architecture SCSS modulaire et JavaScript ES6+ (Fetch API, async/await) pour des interactions dynamiques sans rechargement de page. Le design responsive (3/2/1 colonnes) s'adapte à tous les écrans. Le **back-end** repose sur PHP orienté objet avec deux classes principales (User, Wine) gérant la logique métier. Une API REST (`api/wines.php`) expose les opérations CRUD avec authentification par session et codes HTTP appropriés (200, 201, 401, 404). La **base de données** MySQL contient deux tables relationnelles (users, wines) interrogées via PDO avec requêtes préparées pour la sécurité.

Les points forts incluent : authentification sécurisée avec `password_hash`/`password_verify`, isolation des données par utilisateur, upload d'images, gestion d'erreurs robuste et documentation complète. L'architecture respecte la séparation des responsabilités avec trois couches distinctes (présentation, métier, données).

Ce projet démontre les **8 compétences du référentiel DWWM** : maquettage, intégration HTML/CSS, dynamisation JavaScript, conception BDD, accès aux données PDO, composants métier API, et documentation technique. Les défis surmontés incluent la gestion de FormData avec upload (limitation POST/PUT), le debugging d'erreurs asynchrones et l'organisation SCSS. Les perspectives d'évolution identifiées sont : ajout de tokens CSRF, pagination, filtres de recherche et Progressive Web App.

**Durée :** Plusieurs semaines | **Technologies :** PHP 7.4+, MySQL, JavaScript ES6+, SCSS | **Environnement :** WAMP, PHPStorm, Git, npm

---

## 6. Correspondance avec les compétences du référentiel

| N° CP | Compétence professionnelle                                                       | Comment MyCave la met en œuvre                                                                                             |
|:-----:|----------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------|
|  1    | Installer et configurer son environnement de travail en fonction du projet web ou web mobile | Mise en place de l’environnement Windows + WAMP, création de la base `mycave_db`, configuration de `config/database.php` / `pdo.php`, utilisation de PHPStorm, Git et npm/SCSS (chapitres 2.1 et 2.2). |
|  2    | Maquetter des interfaces utilisateur web ou web mobile                          | Réalisation des pages statiques `dashboard.html` et `add.html`, schéma de navigation Login → Dashboard → Formulaire, adaptation en versions dynamiques `dashboard.php` et `add-wine.php` (chapitre 3.1). |
|  3    | Réaliser des interfaces utilisateur statiques web ou web mobile                 | Intégration HTML/CSS des pages `index.php`, `register.php`, `dashboard.php`, `add-wine.php`, architecture SCSS (`abstract`, `components`, `layout`, `pages`), responsive design (3/2/1 colonnes) (chapitres 3.2 et 3.3). |
|  4    | Développer la partie dynamique des interfaces utilisateur web ou web mobile     | Utilisation de JavaScript (Fetch API) pour appeler `api/auth.php` et `api/wines.php`, gestion dynamique de la liste des vins, suppression avec confirmation, mise à jour du DOM et des compteurs, gestion des messages d’erreur/succès (chapitre 3.4). |
|  5    | Mettre en place une base de données relationnelle                               | Conception et création de la base MySQL `mycave_db` via `database/schema.sql`, tables `users` et `wines` liées par `user_id`, contraintes d’intégrité, jeu d’essai initial (chapitre 4.1.1 et 4.1.2). |
|  6    | Développer des composants d’accès aux données SQL et NoSQL                      | Mise en place de la couche d’accès aux données avec PDO dans `config/database.php` / `pdo.php`, classes `User.php` et `Wine.php` implémentant les opérations CRUD via requêtes préparées, filtrage des vins par utilisateur, APIs `api/auth.php` et `api/wines.php` (chapitres 4.1.3 et 4.2). |
|  7    | Développer des composants métier côté serveur                                   | Encapsulation de la logique métier dans les classes `User` et `Wine` (vérification d’email unique, hash des mots de passe, règles de création/modification/suppression des vins), scripts d’orchestration dans `api/auth.php` et `api/wines.php` (chapitre 4.2). |
|  8    | Documenter le déploiement d’une application dynamique web ou web mobile         | Rédaction du `README.md` et de `DOC_PROJET_MYCAVE.md` décrivant l’installation locale, la configuration de la base, la structure du projet, les endpoints API, ainsi que les mesures de sécurité et les pistes d’amélioration, et description d’un scénario de déploiement sur hébergement mutualisé (chapitres 2, 3 et 4.3). |

Tu peux compléter cette table avec des références précises à des fichiers / extraits de code (captures d’écran, listings) que tu souhaites mettre en avant dans ton dossier.

---

## 7. Synthèse personnelle

_(Section à rédiger en ton nom : ce que tu as appris, les difficultés rencontrées, les compétences que tu estimes avoir particulièrement développées grâce à MyCave.)_

- Bilan sur la partie front-end.
- Bilan sur la partie back-end / BDD.
- Bilan sur l'organisation du travail et la collaboration éventuelle.

---

> Fin du squelette `DOC_PROJET_MYCAVE.md`. Complète et adapte chaque partie en fonction de ton vécu réel sur le projet et en entreprise.

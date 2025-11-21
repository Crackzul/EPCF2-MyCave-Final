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
  - exposer des endpoints REST pour l’authentification et le CRUD des vins,
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
- **IDE** : VS Code avec extensions pour PHP, IntelliSense, coloration SCSS et intégration Git.
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

Un schéma d’architecture simple peut être ajouté ici pour synthétiser :

> **Navigateur (HTML/CSS/JS)** ⇄ **Endpoints API PHP (`api/auth.php`, `api/wines.php`)** ⇄ **Classes métier (`User`, `Wine`)** ⇄ **Base MySQL (`users`, `wines`)**

Ce schéma illustre la séparation des responsabilités et la circulation des données entre le front-end, le back-end et la base de données.

---

## 3. Modélisation et base de données (Compétences 5 et 6)

### 3.1. Schéma relationnel

La base de données MyCave repose au minimum sur les tables :

- `users` : stocke les informations de connexion (email, mot de passe hashé, rôle, etc.).
- `wines` : stocke les vins associés à un utilisateur (nom, millésime, pays, image, etc.).

Relation principale : un `user` possède plusieurs `wines` (relation 1-N).

_(Insérer ici le schéma MCD/MLD ou un schéma logique avec colonnes, types et contraintes.)_

### 3.2. Script SQL et jeu d’essai

- Le fichier `database/schema.sql` contient :
  - la création des tables,
  - les clés primaires/étrangères,
  - un jeu de données de test (utilisateurs, vins).

_(Tu peux décrire ici les comptes de test et quelques exemples de vins créés.)_

### 3.3. Accès aux données (PDO et requêtes préparées)

- La connexion est centralisée dans `config/database.php` ou `config/pdo.php`.
- Les classes `User` et `Wine` exécutent des requêtes préparées pour :
  - créer, lire, mettre à jour et supprimer des enregistrements,
  - filtrer les vins par `user_id` (séparation des données entre utilisateurs).

_(Insérer 1–2 extraits de code PHP montrant une requête préparée en SELECT et INSERT/UPDATE.)_

---

## 4. Interfaces utilisateur – maquettes et HTML/CSS (Compétences 2 et 3)

### 4.1. Maquettage

- Maquettes initiales / pages statiques : `dashboard.html` et `add.html` (si présentes).
- Outils éventuellement utilisés : Figma, maquettes papier, etc.
- Adaptations : ces maquettes ont été intégrées et enrichies dans `dashboard.php` et `add-wine.php`.

_(Insérer ici des captures de maquettes + un schéma d’enchaînement : Login → Dashboard → Formulaire.)_

### 4.2. Interfaces HTML

Pages principales :

- `index.php` : page de connexion.
- `register.php` : page d’inscription.
- `dashboard.php` : tableau de bord listant les vins de l’utilisateur.
- `add-wine.php` : formulaire d’ajout / édition de vin.

Pour chaque page, tu peux ajouter :

- un court extrait de structure HTML,
- une explication des sections (header, navigation, liste de cartes, formulaire, messages d’erreur).

### 4.3. Styles CSS / SCSS

- Architecture SCSS :
  - `abstract/_variables.scss`, `_mixins.scss` : couleurs, typographie, fonctions utilitaires.
  - `base/_base.scss`, `_typography.scss` : styles généraux.
  - `components/_buttons.scss`, `_forms.scss` : composants réutilisables.
  - `layout/_add.scss`, etc. : mise en page par type de page.
- Le SCSS est compilé en `assets/css/style.css`.
- Design responsive basé sur des media queries.

_(Insérer 2–3 extraits de SCSS intéressants : variables, mixins, composants.)_

---

## 5. Partie dynamique front-end (JavaScript) – Compétence 4

### 5.1. Fonctionnalités JS principales

- Gestion des formulaires (soumission, affichage d’erreurs / succès).
- Appels asynchrones à l’API (`fetch` vers `api/wines.php` et `api/auth.php`).
- Mise à jour dynamique du DOM :
  - affichage des cartes de vins,
  - mise à jour d’un compteur de bouteilles,
  - suppression de carte sans rechargement complet.

_(Tu pourras préciser ici les fichiers ou balises `<script>` exacts une fois le code figé.)_

### 5.2. Exemple d’interaction

- Exemple type :
  1. L’utilisateur clique sur "Supprimer" sur une carte vin.
  2. Une confirmation JS est affichée.
  3. En cas de validation, un appel `DELETE` est envoyé à l’API.
  4. En cas de succès, la carte correspondante est retirée du DOM et le compteur est mis à jour.

_(Inclure un extrait de code JS commenté illustrant ce scénario.)_

### 5.3. Améliorations UX

- Validation front (champs requis, formats simples).
- Messages de feedback clairs (erreur / succès).
- Prévisualisation de l’image uploadée (si implémentée).

---

## 6. Composants back-end et API – Compétence 2 (Back-end sécurisé)

### 6.1. Système de login / gestion des utilisateurs

- Les classes et scripts impliqués :
  - `classes/User.php`,
  - `api/auth.php`,
  - `includes/session.php`,
  - `index.php`, `register.php`, `logout.php`.
- Flux typique :
  - Inscription → stockage en base (mot de passe hashé),
  - Connexion → vérification de l’email + mot de passe hashé,
  - Ouverture de session → accès aux pages protégées.

_(Tu peux renvoyer ici vers `REGISTRATION_FEATURE.md` qui détaille davantage cette partie.)_

### 6.2. API des vins (CRUD)

- Endpoint principal : `api/wines.php`.
- Méthodes utilisées :
  - `GET` : liste des vins de l’utilisateur courant,
  - `POST` : création d’un vin,
  - `PUT/PATCH` : mise à jour d’un vin existant,
  - `DELETE` : suppression d’un vin.
- Format de données : JSON / `multipart/form-data` pour l’upload d’image.

_(Décrire ici un ou deux exemples complets de requête/réponse.)_

---

## 7. Sécurité et qualité – Compétence 8

### 7.1. Mesures de sécurité mises en place

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

### 7.2. Jeu d’essai fonctionnel

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

### 7.3. Veille technologique

Décrire brièvement la veille effectuée durant le projet (lecture d’articles, documentation, tutoriels) :

- sur la sécurité des mots de passe et des sessions en PHP,
- sur les bonnes pratiques REST (statuts HTTP, messages d’erreur),
- sur les outils modernes de front (SCSS, frameworks JS) et leur intérêt éventuel pour MyCave.

---

## 8. Correspondance avec les compétences du référentiel

| N° CP | Compétence professionnelle                                                       | Comment MyCave la met en œuvre                                                                                             |
|:-----:|----------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------|
|  1    | Installer et configurer son environnement de travail en fonction du projet web ou web mobile | Mise en place de l’environnement Windows + WAMP, création de la base `mycave_db`, configuration de `config/database.php` / `pdo.php`, utilisation de VS Code, Git et npm/SCSS (chapitres 2 et 4). |
|  2    | Maquetter des interfaces utilisateur web ou web mobile                          | Réalisation des pages statiques `dashboard.html` et `add.html`, schéma de navigation Login → Dashboard → Formulaire, adaptation en versions dynamiques `dashboard.php` et `add-wine.php` (chapitre 5.1). |
|  3    | Réaliser des interfaces utilisateur statiques web ou web mobile                 | Intégration HTML/CSS des pages `index.php`, `register.php`, `dashboard.php`, `add-wine.php`, architecture SCSS (`abstract`, `components`, `layout`, `pages`), responsive design (3/2/1 colonnes) (chapitre 5.2 et 5.3). |
|  4    | Développer la partie dynamique des interfaces utilisateur web ou web mobile     | Utilisation de JavaScript (Fetch API) pour appeler `api/auth.php` et `api/wines.php`, gestion dynamique de la liste des vins, suppression avec confirmation, mise à jour du DOM et des compteurs, gestion des messages d’erreur/succès (chapitre 5.4). |
|  5    | Mettre en place une base de données relationnelle                               | Conception et création de la base MySQL `mycave_db` via `database/schema.sql`, tables `users` et `wines` liées par `user_id`, contraintes d’intégrité, jeu d’essai initial (chapitre 3.1 et 3.2). |
|  6    | Développer des composants d’accès aux données SQL et NoSQL                      | Mise en place de la couche d’accès aux données avec PDO dans `config/database.php` / `pdo.php`, classes `User.php` et `Wine.php` implémentant les opérations CRUD via requêtes préparées, filtrage des vins par utilisateur, APIs `api/auth.php` et `api/wines.php` (chapitre 3.3 et 6). |
|  7    | Développer des composants métier côté serveur                                   | Encapsulation de la logique métier dans les classes `User` et `Wine` (vérification d’email unique, hash des mots de passe, règles de création/modification/suppression des vins), scripts d’orchestration dans `api/auth.php` et `api/wines.php` (chapitre 6). |
|  8    | Documenter le déploiement d’une application dynamique web ou web mobile         | Rédaction du `README.md` et de `DOC_PROJET_MYCAVE.md` décrivant l’installation locale, la configuration de la base, la structure du projet, les endpoints API, ainsi que les mesures de sécurité et les pistes d’amélioration, et description d’un scénario de déploiement sur hébergement mutualisé (chapitres 2, 4 et 7). |

Tu peux compléter cette table avec des références précises à des fichiers / extraits de code (captures d’écran, listings) que tu souhaites mettre en avant dans ton dossier.

---

## 9. Synthèse personnelle

_(Section à rédiger en ton nom : ce que tu as appris, les difficultés rencontrées, les compétences que tu estimes avoir particulièrement développées grâce à MyCave.)_

- Bilan sur la partie front-end.
- Bilan sur la partie back-end / BDD.
- Bilan sur l’organisation du travail et la collaboration éventuelle.

---

> Fin du squelette `DOC_PROJET_MYCAVE.md`. Complète et adapte chaque partie en fonction de ton vécu réel sur le projet et en entreprise.

# 🎤 Guide de Présentation Blanche - MyCave
## Projet DWWM - Gestion de Cave à Vin

> **Durée recommandée :** 15-20 minutes (10 min présentation + 5-10 min questions)  
> **Date :** 2025-01-12  
> **Candidat :** [Votre nom]

---

## 📋 PLAN DE PRÉSENTATION (Timing : 10 minutes)

### 1️⃣ INTRODUCTION (1 min)
**Objectif :** Capter l'attention et présenter le contexte

**À dire :**
> "Bonjour, je m'appelle [Nom] et je vais vous présenter **MyCave**, une application web de gestion de cave à vin personnelle que j'ai développée dans le cadre de ma formation Développeur Web et Web Mobile.
>
> Ce projet m'a permis de mettre en pratique l'intégralité des 8 compétences du référentiel DWWM, en créant une application complète du maquettage jusqu'à la documentation technique."

**Points clés à mentionner :**
- ✅ Nom du projet + fonction principale (gérer son stock de vins)
- ✅ Contexte : formation DWWM
- ✅ Périmètre : application full-stack complète
- ✅ Durée : plusieurs semaines

**À montrer :**
- 📸 Slide de titre avec logo MyCave
- 📸 Ou directement page d'accueil de l'application

---

### 2️⃣ PROBLÉMATIQUE & OBJECTIFS (1 min)
**Objectif :** Justifier l'intérêt du projet

**À dire :**
> "La problématique est simple : comment permettre à un amateur de vin de gérer facilement son stock de bouteilles, de se souvenir de leurs caractéristiques et de suivre sa consommation ?
>
> Les objectifs étaient de créer une interface moderne, responsive et sécurisée, avec des fonctionnalités CRUD complètes et une authentification robuste."

**Points clés à mentionner :**
- ✅ Besoin réel : traçabilité du stock personnel
- ✅ Contraintes : sécurité, responsive, upload d'images
- ✅ Compétences visées : full-stack PHP/MySQL/JavaScript

---

### 3️⃣ DÉMONSTRATION FONCTIONNELLE (3 min)
**Objectif :** Montrer l'application en action

**Parcours utilisateur à démontrer en DIRECT :**

#### A) Authentification (30 sec)
- Montrer la page de connexion
- Se connecter avec un compte de test
- Mentionner : "Mot de passe hashé avec bcrypt, session PHP sécurisée"

#### B) Dashboard - Lecture (30 sec)
- Montrer la liste des vins avec le compteur
- Pointer du doigt : "Design responsive avec grid CSS"
- Mentionner : "Données chargées via API REST avec Fetch"

#### C) Création d'un vin (1 min)
- Cliquer sur "Ajouter un vin"
- Remplir le formulaire rapidement (préparer des données à l'avance)
- **Sélectionner une image** (important pour montrer l'upload)
- Soumettre et revenir au dashboard
- Mentionner : "Upload d'image avec validation côté serveur"

#### D) Modification (30 sec)
- Cliquer sur l'icône d'édition d'un vin
- Montrer que le formulaire est pré-rempli
- Changer un champ (ex: millésime)
- Sauvegarder
- Mentionner : "Requête AJAX sans rechargement de page"

#### E) Suppression (30 sec)
- Cliquer sur l'icône de suppression
- Montrer la fenêtre de confirmation
- Confirmer et observer la disparition
- Mentionner : "Suppression de l'image du serveur + en base"

**Phrases types :**
> "Vous voyez ici l'interface responsive qui s'adapte automatiquement à la taille de l'écran..."
>
> "Les interactions sont gérées en JavaScript moderne avec async/await, ce qui rend l'expérience fluide..."
>
> "Chaque utilisateur ne voit que ses propres bouteilles grâce à l'isolation par user_id..."

---

### 4️⃣ ARCHITECTURE TECHNIQUE (2 min)
**Objectif :** Montrer votre compréhension de la structure

**À dire :**
> "L'application est structurée en trois couches bien distinctes..."

**Points clés à mentionner + MONTRER LE CODE :**

#### A) Front-end
- HTML5/CSS3 avec **SCSS modulaire** → Montrer l'arborescence `assets/scss/`
- JavaScript ES6+ avec **Fetch API** → Montrer une fonction `loadWines()` dans le code
- Design **responsive** → Montrer les media queries dans le SCSS

#### B) Back-end
- PHP **orienté objet** → Montrer les classes `User.php` et `Wine.php`
- **API REST** → Montrer `api/wines.php` avec le switch des méthodes HTTP
- **Authentification par session** → Montrer `includes/session.php`

#### C) Base de données
- MySQL avec **deux tables** : `users` et `wines`
- Relation `wines.user_id → users.id`
- **PDO + requêtes préparées** → Montrer un exemple dans `Wine.php` (ligne ~80)

**Capture d'écran à projeter :**
- 📸 Schéma de la base de données (tables + relations)
- 📸 Structure des dossiers du projet (bien organisé)
- 📸 Extrait de code (par ex: `getByUserId()` avec requête préparée)

**Phrases types :**
> "J'ai organisé mon CSS avec SCSS pour faciliter la maintenance, avec des variables centralisées pour les couleurs..."
>
> "L'API REST renvoie des codes HTTP appropriés : 200 pour succès, 401 si non connecté, 404 si ressource introuvable..."
>
> "J'utilise PDO avec des requêtes préparées pour me protéger contre les injections SQL..."

---

### 5️⃣ SÉCURITÉ & BONNES PRATIQUES (1 min)
**Objectif :** Montrer votre professionnalisme

**Points clés à marteler :**

✅ **Mots de passe :**
> "J'utilise `password_hash()` avec bcrypt pour hasher les mots de passe, jamais stockés en clair"
→ Montrer ligne 40 de `User.php`

✅ **Injections SQL :**
> "Toutes mes requêtes SQL utilisent PDO avec des paramètres bindés pour éviter les injections"
→ Montrer une requête préparée

✅ **Sessions :**
> "Les pages privées vérifient la session PHP avec la fonction `isLoggedIn()`"
→ Montrer `includes/session.php`

✅ **Upload de fichiers :**
> "Je valide le type MIME et la taille des images avant de les accepter"
→ Montrer le code de validation dans `Wine.php`

✅ **Isolation des données :**
> "Chaque requête filtre par `user_id` pour que personne ne puisse voir/modifier les vins d'un autre"
→ Montrer une clause WHERE user_id

**Phrase de transition :**
> "Ces pratiques de sécurité sont essentielles en développement web professionnel et font partie de ma veille technologique permanente."

---

### 6️⃣ COMPÉTENCES DWWM VALIDÉES (1 min)
**Objectif :** Faire le lien avec le référentiel

**À dire :**
> "Ce projet me permet de démontrer les 8 compétences du référentiel DWWM..."

**Tableau à projeter (ou réciter) :**

| N° | Compétence | Preuve dans MyCave |
|----|-----------|-------------------|
| 1 | Environnement | WAMP, PHPStorm, Git, npm ✅ |
| 2 | Maquetter | Pages HTML statiques → dynamiques ✅ |
| 3 | Interfaces statiques | HTML/CSS/SCSS responsive ✅ |
| 4 | Interfaces dynamiques | JavaScript Fetch + manipulation DOM ✅ |
| 5 | Base de données | MySQL (users, wines) ✅ |
| 6 | Accès aux données | PDO + requêtes préparées ✅ |
| 7 | Composants métier | Classes PHP + API REST ✅ |
| 8 | Documentation | README + DOC_PROJET complet ✅ |

**Phrase clé :**
> "Plutôt que 8 petits exercices séparés, j'ai préféré créer un projet complet qui démontre toutes les compétences en situation réelle."

---

### 7️⃣ DIFFICULTÉS RENCONTRÉES & SOLUTIONS (1 min)
**Objectif :** Montrer votre capacité à résoudre des problèmes

**3 exemples concrets à raconter :**

#### Difficulté 1 : Upload d'images avec FormData
> "**Problème :** FormData ne supporte pas nativement les méthodes PUT/PATCH pour l'upload.  
> **Solution :** J'envoie en POST avec un paramètre `_method=PUT` pour simuler PUT côté serveur. C'est une pratique standard dans les frameworks comme Laravel."

#### Difficulté 2 : Debugging des erreurs asynchrones
> "**Problème :** Erreurs JavaScript difficiles à débugger avec Fetch.  
> **Solution :** Utilisation systématique de try/catch et de console.log, inspection de l'onglet Network dans les DevTools."

#### Difficulté 3 : Organisation du SCSS
> "**Problème :** Fichier CSS monolithique difficile à maintenir.  
> **Solution :** Découpage en architecture modulaire (abstract, base, components, layout, pages) avec compilation npm."

**Phrase de conclusion :**
> "Chaque difficulté a été une occasion d'apprendre et de consulter la documentation officielle ou des ressources de référence comme MDN."

---

### 8️⃣ PERSPECTIVES D'ÉVOLUTION (30 sec)
**Objectif :** Montrer que vous avez une vision critique

**Améliorations identifiées :**

🔐 **Sécurité :**
- Ajout de tokens CSRF pour les formulaires
- Forcer HTTPS en production
- Implémenter `session_regenerate_id()` après login

⚡ **Performance :**
- Pagination pour les grandes listes (actuellement tout chargé d'un coup)
- Lazy loading des images
- Mise en cache côté client

🎨 **UX :**
- Prévisualisation de l'image avant upload
- Filtres de recherche (couleur, région, millésime)
- Export de la cave en PDF/Excel

📱 **Mobile :**
- Progressive Web App (PWA) pour installation sur mobile
- Mode hors ligne avec Service Workers

**Phrase clé :**
> "Ces pistes d'amélioration montrent que le projet est évolutif et qu'il pourrait être enrichi selon les besoins utilisateurs."

---

### 9️⃣ CONCLUSION (30 sec)
**Objectif :** Clôturer et ouvrir aux questions

**À dire :**
> "En conclusion, MyCave est un projet complet qui m'a permis de :
> - Maîtriser la chaîne complète de développement web full-stack
> - Appliquer les bonnes pratiques de sécurité et d'architecture
> - Développer mon autonomie dans la résolution de problèmes techniques
> - Valider l'ensemble des compétences du référentiel DWWM
>
> Je suis maintenant à votre disposition pour répondre à vos questions."

**Posture :**
- Sourire
- Regarder le jury
- Respirer calmement

---

## ❓ QUESTIONS FRÉQUENTES DU JURY (Préparation)

### Q1 : "Pourquoi avoir choisi ce sujet ?"
**Réponse préparée :**
> "J'ai choisi la gestion de cave à vin car c'est un sujet concret qui me permettait de mettre en pratique toutes les compétences : authentification, CRUD, upload de fichiers, responsive design. C'est aussi un domaine où la visualisation (photos, informations structurées) est importante, ce qui justifie une vraie interface web."

### Q2 : "Combien de temps avez-vous passé sur ce projet ?"
**Réponse préparée :**
> "J'ai travaillé sur ce projet pendant environ [X semaines] en parallèle de ma formation, à raison de [Y heures par semaine]. Les phases principales étaient : maquettage (2-3h), base de données (3-4h), back-end (10-15h), front-end (10-15h), et documentation (5h)."

### Q3 : "Quelle est la partie la plus difficile ?"
**Réponse préparée :**
> "La partie la plus complexe a été la gestion de l'upload d'images avec FormData et l'API REST, car il faut gérer à la fois le multipart/form-data et simuler les méthodes PUT/DELETE. J'ai dû faire de la veille technique et tester plusieurs approches avant de trouver la solution optimale."

### Q4 : "Comment gérez-vous la sécurité ?"
**Réponse préparée :**
> "La sécurité repose sur 4 piliers :
> 1. Mots de passe hashés avec bcrypt (password_hash/verify)
> 2. Requêtes préparées PDO contre les injections SQL
> 3. Authentification par session PHP avec vérification sur chaque requête API
> 4. Isolation des données par user_id : un utilisateur ne peut jamais accéder aux vins d'un autre"

### Q5 : "Avez-vous fait de la veille technologique ?"
**Réponse préparée :**
> "Oui, j'ai consulté régulièrement la documentation PHP officielle, MDN pour JavaScript, et des articles sur les bonnes pratiques REST. Par exemple, j'ai appris que PASSWORD_DEFAULT utilise bcrypt par défaut, que les codes HTTP doivent être explicites (401 vs 403), et comment organiser une architecture SCSS modulaire."

### Q6 : "Pourquoi ne pas avoir utilisé un framework PHP ?"
**Réponse préparée :**
> "L'objectif pédagogique était de comprendre les mécanismes sous-jacents : comment fonctionnent les sessions, comment créer une API REST, comment gérer les routes manuellement. Maintenant que je maîtrise ces bases, je serais capable d'utiliser un framework comme Symfony ou Laravel en comprenant ce qu'il fait en arrière-plan."

### Q7 : "Comment testez-vous votre code ?"
**Réponse préparée :**
> "Actuellement, je teste manuellement avec des comptes utilisateurs de test et différents navigateurs. J'utilise les DevTools (Console, Network) pour débugger. Une amélioration future serait d'ajouter des tests automatisés avec PHPUnit côté back-end et Jest côté front-end."

### Q8 : "Est-ce responsive ?"
**Réponse préparée :**
> "Oui, l'interface s'adapte à toutes les tailles d'écran grâce aux media queries SCSS : 3 colonnes sur grand écran, 2 sur tablette, 1 sur mobile. J'utilise CSS Grid pour le layout et des unités relatives (rem, %). Je peux vous montrer..." [Ouvrir DevTools et redimensionner]

### Q9 : "Quelles sont les limites actuelles ?"
**Réponse préparée :**
> "Les principales limites sont :
> - Pas de pagination : si un utilisateur a 500 bouteilles, tout charge d'un coup
> - Pas de recherche/filtres : difficile de retrouver une bouteille spécifique
> - Pas de statistiques : aucune vue d'ensemble (nombre par région, par couleur, etc.)
> - Pas de CSRF protection sur les formulaires
> Ces points sont identifiés dans mes perspectives d'évolution."

### Q10 : "Utiliseriez-vous cette application en production ?"
**Réponse préparée :**
> "Avec quelques ajustements, oui. Il faudrait :
> - Forcer HTTPS pour sécuriser les sessions
> - Ajouter des tokens CSRF
> - Optimiser les images (compression, formats WebP)
> - Ajouter une pagination
> - Implémenter une sauvegarde automatique de la base
> Mais l'architecture de base est saine et sécurisée."

---

## 🎯 CHECKLIST AVANT LA PRÉSENTATION

### Technique
- [ ] Application fonctionnelle sur localhost
- [ ] WAMP démarré (Apache + MySQL)
- [ ] Compte de test prêt (email + mot de passe notés)
- [ ] Données de démonstration en base (au moins 5-10 vins)
- [ ] Image de test prête pour l'upload (bouteille de vin)
- [ ] Navigateur ouvert sur la page de connexion
- [ ] DevTools ouverts (onglet Network + Console)
- [ ] PHPStorm ouvert sur les fichiers clés (User.php, Wine.php, api/wines.php)

### Documentation
- [ ] DOC_PROJET_MYCAVE.md ouvert (pour référence rapide)
- [ ] Schéma de base de données visible (capture ou phpMyAdmin)
- [ ] Captures d'écran prêtes (si projecteur disponible)

### Mental
- [ ] Respirer profondément
- [ ] Relire le plan de présentation
- [ ] Chronométrer une fois à voix haute (10 min max)
- [ ] Boire de l'eau
- [ ] Sourire 😊

---

## 📸 CAPTURES D'ÉCRAN À PRÉPARER (si slides)

1. **Slide de titre** : Logo MyCave + votre nom + DWWM
2. **Page de connexion** : Montrer l'interface d'authentification
3. **Dashboard avec vins** : Liste des bouteilles + compteur
4. **Formulaire d'ajout** : Les 8 champs + upload
5. **Schéma BDD** : Tables users et wines avec relation
6. **Architecture dossiers** : Arborescence du projet
7. **Code User.php** : Fonction password_hash (ligne 40)
8. **Code Wine.php** : Requête préparée getByUserId (ligne ~80)
9. **Code api/wines.php** : Switch des méthodes HTTP
10. **Code dashboard.php** : Fonction loadWines() en JavaScript

---

## 💡 CONSEILS POUR L'ORAL

### À FAIRE ✅
- **Parler lentement** : Le jury doit comprendre, pas vous impressionner par votre débit
- **Regarder le jury** : Pas l'écran, pas vos notes
- **Montrer votre code** : Ouvrir les fichiers, pointer avec la souris
- **Utiliser des phrases courtes** : Sujet + verbe + complément
- **Démontrer en direct** : L'application fonctionne, montrez-la vraiment
- **Respirer entre chaque partie** : Marquer des pauses
- **Sourire** : Vous êtes fier de votre travail, ça se voit

### À ÉVITER ❌
- Lire vos notes mot à mot
- Dire "euh" toutes les 3 secondes
- Aller trop vite (stress)
- Utiliser trop de jargon sans expliquer
- S'excuser ("c'est pas parfait mais...")
- Tourner le dos au jury
- Paniquer si un bug apparaît (expliquer calmement)

### Phrases magiques
- "Comme vous pouvez le voir ici..."
- "Je vais vous montrer concrètement..."
- "Dans ce fichier, ligne X, on peut observer que..."
- "L'avantage de cette approche est..."
- "J'ai fait le choix de... parce que..."

---

## ⏱️ TIMING RÉCAPITULATIF

| Section | Durée | Cumul |
|---------|-------|-------|
| 1. Introduction | 1 min | 1 min |
| 2. Problématique | 1 min | 2 min |
| 3. Démo fonctionnelle | 3 min | 5 min |
| 4. Architecture technique | 2 min | 7 min |
| 5. Sécurité | 1 min | 8 min |
| 6. Compétences DWWM | 1 min | 9 min |
| 7. Difficultés/Solutions | 1 min | 10 min |
| 8. Perspectives | 30 sec | 10:30 |
| 9. Conclusion | 30 sec | 11 min |

**Marge de sécurité :** 1 minute (pour les imprévus)

---

## 🚀 DERNIERS CONSEILS

1. **Entraînez-vous à voix haute** au moins 2 fois avant la présentation
2. **Chronométrez-vous** : 10 min max, sinon vous serez coupé
3. **Préparez un "Plan B"** : si l'appli plante, avoir des captures d'écran
4. **Hydratez-vous** avant de parler
5. **Dormez bien** la veille (si possible)
6. **Arrivez en avance** pour installer votre poste
7. **Respirez profondément** juste avant de commencer
8. **PROFITEZ** : vous avez fait un super boulot, montrez-le avec fierté !

---

## ✨ PHRASE DE LANCEMENT (à mémoriser)

> "Bonjour à tous, je m'appelle [Nom] et je suis ravi de vous présenter aujourd'hui MyCave, une application web complète de gestion de cave à vin que j'ai développée dans le cadre de ma formation DWWM. 
>
> Au cours des 10 prochaines minutes, je vais vous montrer comment cette application démontre l'ensemble des 8 compétences du référentiel, avec une démo en direct, un aperçu de l'architecture technique, et les bonnes pratiques de sécurité que j'ai appliquées.
>
> Commençons tout de suite avec une démonstration fonctionnelle..."

---

**Bonne chance ! Vous allez assurer ! 🎉🍷**


# Système d'Inscription - MyCAVE

## 📝 Fonctionnalité ajoutée le 14 novembre 2025

### Nouveaux fichiers créés

1. **register.php** - Page d'inscription pour créer un nouveau compte utilisateur

### Fichiers modifiés

1. **index.php** - Ajout d'un lien vers la page d'inscription
2. **classes/User.php** - Ajout de la méthode `emailExists()` pour vérifier l'unicité de l'email

## ✨ Fonctionnalités

### Page d'inscription (register.php)

La page d'inscription permet à un nouvel utilisateur de créer un compte avec :
- **Nom complet** - Requis
- **Email** - Requis et doit être unique
- **Mot de passe** - Minimum 6 caractères
- **Confirmation du mot de passe** - Doit correspondre au mot de passe

### Validations

✅ Tous les champs sont obligatoires
✅ Validation du format email
✅ Mot de passe minimum 6 caractères
✅ Vérification que les mots de passe correspondent
✅ Vérification de l'unicité de l'email dans la base de données
✅ Hash sécurisé du mot de passe avec `password_hash()`

### Expérience utilisateur

- Après inscription, l'utilisateur est **automatiquement connecté** et redirigé vers son dashboard
- Messages d'erreur clairs et explicites
- Conservation des valeurs saisies en cas d'erreur (sauf les mots de passe)
- Lien de navigation entre les pages de connexion et d'inscription

## 🔐 Sécurité

- **Hashage des mots de passe** : Utilisation de `password_hash()` avec l'algorithme par défaut (bcrypt)
- **Validation des entrées** : Filtrage et validation côté serveur
- **Protection XSS** : Utilisation de `htmlspecialchars()` pour l'affichage des données
- **Prévention des doublons** : Vérification de l'unicité de l'email avant insertion

## 🗃️ Base de données

### Table : `user`

Les nouveaux utilisateurs sont enregistrés dans la table `user` avec :
- `email1` - Email unique de l'utilisateur
- `password1` - Mot de passe hashé
- `username` - Nom complet de l'utilisateur
- `roles` - Rôle par défaut : `ROLE_USER`

## 🎨 Interface

L'interface utilise le même design que la page de connexion :
- Cohérence visuelle avec le reste de l'application
- Responsive et adapté à tous les écrans
- Style en accord avec la charte graphique de MyCAVE

## 🔗 Navigation

- **Page de connexion (index.php)** → Lien "Créer un compte" vers register.php
- **Page d'inscription (register.php)** → Lien "Se connecter" vers index.php

## 📋 Comment tester

1. Accédez à http://localhost/Myv12/index.php
2. Cliquez sur le lien "Créer un compte"
3. Remplissez le formulaire d'inscription
4. Après validation, vous êtes automatiquement connecté et redirigé vers votre dashboard

## 🐛 Gestion des erreurs

Messages d'erreur possibles :
- "Veuillez remplir tous les champs"
- "Veuillez entrer une adresse email valide"
- "Le mot de passe doit contenir au moins 6 caractères"
- "Les mots de passe ne correspondent pas"
- "Une erreur est survenue lors de la création du compte. Cet email est peut-être déjà utilisé"

## 💡 Améliorations futures possibles

- Validation de la complexité du mot de passe (majuscules, chiffres, caractères spéciaux)
- Vérification email (envoi d'un lien de confirmation)
- CAPTCHA pour éviter les inscriptions automatisées
- Conditions générales d'utilisation à accepter
- Limite du nombre de tentatives d'inscription


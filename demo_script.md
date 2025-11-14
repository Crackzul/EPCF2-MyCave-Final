# 🎬 Script de Démonstration MyCave

## 🎯 Introduction (2 minutes)

**"Bonjour, je vais vous présenter MyCave, une application de gestion de cave à vin qui démontre ma maîtrise de deux approches de développement web : PHP classique et Symfony 7.3."**

**"Cette approche hybride montre ma capacité à travailler avec différentes technologies et à choisir la solution la plus adaptée."**

---

## 🔧 Version PHP Classique (5 minutes)

### **Présentation de l'architecture**
**"Commençons par la version PHP classique. Cette approche utilise PHP natif avec une structure simple et directe."**

**À montrer dans VS Code :**
- Ouvrir le dossier `classes/`
- Expliquer : "Ici, j'ai créé des classes PHP simples pour gérer les utilisateurs et les vins"
- Ouvrir `api/wines.php` : "Cette API REST gère les opérations CRUD sur les vins"

### **Démonstration fonctionnelle**
**"Maintenant, testons cette version en action."**

**Actions à effectuer :**
1. Aller sur `http://localhost/Myv12/login.php`
2. **Dire :** "Je me connecte avec les identifiants de test"
3. Se connecter avec `didier@mycave.com` / `password`
4. **Dire :** "Voici le dashboard principal. On peut voir les vins de la cave."
5. Cliquer sur "Ajouter une nouvelle bouteille"
6. **Dire :** "Le formulaire d'ajout est simple et fonctionnel"
7. Remplir quelques champs et sauvegarder
8. **Dire :** "Le vin a été ajouté avec succès"

### **Points techniques**
**"Cette version présente plusieurs avantages :"**
- **Simplicité :** Code facile à comprendre et maintenir
- **Performance :** Pas de framework, donc très rapide
- **Indépendance :** Aucune dépendance externe
- **Compatibilité :** Fonctionne sur tous les serveurs PHP

---

## ⚡ Version Symfony 7.3 (5 minutes)

### **Présentation de l'architecture moderne**
**"Maintenant, la même application développée avec Symfony 7.3, une approche moderne et professionnelle."**

**À montrer dans VS Code :**
- Ouvrir le dossier `mycave/src/`
- **Dire :** "Voici l'architecture Symfony avec les contrôleurs, entités et repositories"
- Ouvrir `mycave/src/Entity/Wine.php` : "Cette entité Doctrine représente un vin en base de données"
- Ouvrir `mycave/templates/` : "Les vues utilisent le moteur de template Twig"

### **Démonstration fonctionnelle**
**"Testons maintenant la version Symfony."**

**Actions à effectuer :**
1. Aller sur `http://localhost/Myv12/mycave/public/login.php`
2. **Dire :** "Même interface, même fonctionnalités, mais architecture différente"
3. Se connecter avec les mêmes identifiants
4. **Dire :** "L'interface est identique, mais le code derrière est complètement différent"
5. Naviguer dans le dashboard
6. **Dire :** "Les données sont les mêmes car les deux versions partagent la même base"

### **Points techniques**
**"Symfony apporte des avantages professionnels :"**
- **Architecture MVC :** Séparation claire des responsabilités
- **Sécurité :** Protection CSRF, validation des données
- **Maintenabilité :** Code structuré et documenté
- **Évolutivité :** Facile d'ajouter de nouvelles fonctionnalités
- **Standards :** Respect des bonnes pratiques du développement web

---

## 🔄 Comparaison et Cohabitation (3 minutes)

### **Base de données partagée**
**"Un point important : les deux versions utilisent exactement la même base de données."**

**À démontrer :**
1. Ajouter un vin dans la version PHP
2. Aller sur la version Symfony
3. **Dire :** "Le vin apparaît immédiatement dans la version Symfony"
4. **Dire :** "Cela démontre la compatibilité des deux approches"

### **Ressources partagées**
**"Les deux versions partagent également les mêmes ressources visuelles."**

**À montrer :**
- CSS identique
- Images identiques
- Interface utilisateur cohérente

**"Cette cohabitation permet une migration progressive sans interruption de service."**

---

## ❓ Questions et Réponses (3 minutes)

### **Questions préparées :**

**Q: "Pourquoi avoir développé deux versions ?"**
**R:** "Pour démontrer ma capacité à maîtriser différentes approches de développement. Chaque technologie a ses avantages, et savoir choisir la bonne solution est crucial en développement."

**Q: "Quelle version préférez-vous ?"**
**R:** "Chaque approche a ses forces. PHP classique pour la simplicité et les performances, Symfony pour la maintenabilité et l'évolutivité. Le choix dépend du contexte du projet."

**Q: "Comment gérez-vous la maintenance ?"**
**R:** "La base de données partagée facilite la maintenance. Je peux comparer les performances et fonctionnalités des deux versions en temps réel."

**Q: "Quelle est la prochaine étape ?"**
**R:** "Une fois la version Symfony entièrement testée, je pourrai migrer progressivement vers cette architecture moderne tout en gardant la stabilité du système."

---

## 🎯 Conclusion (2 minutes)

**"Cette approche hybride démontre plusieurs compétences importantes :"**

1. **Maîtrise technique :** Compréhension approfondie de deux paradigmes
2. **Adaptabilité :** Capacité à travailler avec différentes technologies
3. **Vision d'ensemble :** Compréhension des avantages et inconvénients de chaque approche
4. **Approche professionnelle :** Migration progressive sans risque

**"En développement, il n'y a pas de solution universelle. Savoir choisir la bonne technologie selon les besoins du projet est une compétence essentielle."**

**"MyCave illustre cette philosophie : une application fonctionnelle qui évolue vers une architecture moderne tout en conservant sa stabilité."**

---

## 💡 Conseils pour la démonstration

### **Avant la démo :**
- ✅ Tester les deux versions plusieurs fois
- ✅ Préparer des données de test
- ✅ Vérifier que WAMP fonctionne
- ✅ Avoir les URLs prêtes

### **Pendant la démo :**
- ✅ Parler lentement et clairement
- ✅ Expliquer chaque action
- ✅ Rester calme si quelque chose ne fonctionne pas
- ✅ Avoir un plan B (captures d'écran)

### **Après la démo :**
- ✅ Répondre aux questions avec confiance
- ✅ Montrer votre enthousiasme pour le projet
- ✅ Être prêt à discuter des choix techniques

---

**🎯 Objectif : Montrer que vous maîtrisez les deux technologies et que vous savez choisir la bonne approche selon le contexte !** 
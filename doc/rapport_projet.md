## 4.3. Sécurité et qualité

### 4.3.1. Mesures de sécurité mises en place

> Captures d’écran à prévoir :
> - Page d’inscription (`register.php` ou équivalent, par ex. `user_register.php`) montrant le formulaire et le traitement du mot de passe.
> - Page de connexion (`login.php` ou équivalent, par ex. `user_login.php`) montrant le formulaire et la création de la session.
> - Une page protégée (par ex. `liste_vins.php`) montrant la redirection si l’utilisateur n’est pas connecté.
> - Un exemple de requête listant les vins de l’utilisateur (`liste_vins.php` ou `api/vins.php`).
> - Le formulaire d’upload de photo de vin (`ajout_vin.php` ou `edit_vin.php`) + le répertoire `uploads/` dans l’explorateur.

#### Authentification

Les mots de passe ne sont jamais stockés en clair.  
Dans le projet, le hashage est réalisé dans le fichier **`register.php`** (ou `user_register.php` si tu utilises un autre nom) au moment de la création du compte :

```php
// register.php
// ...existing code...
$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
// insertion en base avec $hash
// ...existing code...
```

La vérification du mot de passe est effectuée dans **`login.php`** (ou `user_login.php`) :

```php
// login.php
// ...existing code...
if (password_verify($_POST['password'], $user['password_hash'])) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    // ...existing code...
} else {
    // mot de passe invalide
}
// ...existing code...
```

Les sessions PHP sont utilisées pour protéger les pages et l’API (accès réservé aux utilisateurs authentifiés).  
Toutes les pages protégées commencent par un contrôle de session, par exemple dans `liste_vins.php` :

```php
// liste_vins.php
// ...existing code...
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
// ...existing code...
```

#### Accès aux données

Toutes les requêtes SQL passent par PDO et des requêtes préparées pour éviter l’injection SQL.  
De plus, les vins sont toujours filtrés par `user_id` afin qu’un utilisateur ne voie que ses propres données, par exemple dans `liste_vins.php` ou `api/vins.php` :

```php
// liste_vins.php
// ...existing code...
$stmt = $pdo->prepare('SELECT * FROM vins WHERE user_id = :user_id');
$stmt->execute([
    ':user_id' => $_SESSION['user_id']
]);
$vins = $stmt->fetchAll(PDO::FETCH_ASSOC);
// ...existing code...
```

Aucune concaténation directe de valeurs saisies par l’utilisateur dans les requêtes SQL n’est utilisée.

#### Upload de fichiers

Les fichiers images des vins sont uploadés dans un répertoire dédié `uploads/`, typiquement dans les pages `ajout_vin.php` et `edit_vin.php`.  
Avant l’enregistrement, le fichier est :

- contrôlé sur la taille maximale,
- contrôlé sur le type MIME autorisé (ex. `image/jpeg`, `image/png`),
- renommé avec un nom unique pour éviter les collisions et les noms dangereux.

```php
// ajout_vin.php
// ...existing code...
$maxSize = 2 * 1024 * 1024; // 2 Mo
$allowedTypes = ['image/jpeg', 'image/png'];

if (!empty($_FILES['photo']['name'])) {
    if ($_FILES['photo']['size'] <= $maxSize &&
        in_array(mime_content_type($_FILES['photo']['tmp_name']), $allowedTypes)) {

        // Génération d’un nom unique
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $newName = uniqid('vin_', true) . '.' . $extension;
        $uploadDir = __DIR__ . '/../uploads/';
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $newName);

        // Enregistrement du nom de fichier en base
        // ...existing code pour l’INSERT/UPDATE avec $newName...
    } else {
        // gestion d’erreur : type ou taille invalide
        // ...existing code...
    }
}
// ...existing code...
```

Ces mesures permettent de limiter les risques d’injection SQL, d’accès non autorisé aux données, et d’exécution de fichiers malveillants via l’upload.

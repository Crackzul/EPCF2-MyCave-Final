<?php
// Paramètres de connexion
$host   = 'localhost';        // ou 127.0.0.1
$port   = '3306';             // port MySQL par défaut
$dbname = 'simple_blog';      // nom de ma base de données
$user   = 'root';
$pass   = '';                 // mot de passe (souvent vide en local avec root)

// Construction du DSN
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

try {
    // Création de l'objet PDO
    $pdo = new PDO($dsn, $user, $pass);

    // Configuration du mode d'erreur en exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si on arrive ici, la connexion est OK
    echo "<h2>Connexion réussie à la base de données <code>$dbname</code></h2>";

    // Test rapide : compter le nombre de tables
    $query = $pdo->query("SHOW TABLES");
    $tables = $query->fetchAll(PDO::FETCH_NUM);

    echo "<p>Nombre de tables trouvées : " . count($tables) . "</p>";
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li>Table : <strong>" . htmlspecialchars($table[0]) . "</strong></li>";
    }
    echo "</ul>";

} catch (PDOException $e) {
    // Gestion de l'erreur de connexion
    echo "<h2>Erreur de connexion à la base de données</h2>";
    echo "<p><strong>Message :</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
}

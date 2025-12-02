<?php
// Configuration de la connexion à la base de données MySQL pour le projet MyCave
// Ce fichier retourne un objet PDO prêt à l'emploi.

class Database {
    // Propriété privée qui contiendra l'objet PDO
    private $conn;

    // Méthode publique appelée depuis le reste du projet pour obtenir la connexion
    public function getConnection() {
        // On initialise la connexion à null au cas où
        $this->conn = null;

        try {
            // 1. On définit les paramètres de connexion
            $host = 'localhost';        // Serveur MySQL (WAMP en local)
            $dbName = 'mycave_v2';     // Nom de la base de données
            $charset = 'utf8mb4';      // Encodage conseillé
            $user = 'root';            // Utilisateur MySQL par défaut sous WAMP
            $password = '';            // Mot de passe vide par défaut sous WAMP

            // 2. On construit la chaîne DSN (Data Source Name)
            $dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";

            // 3. On crée l'objet PDO (connexion à MySQL)
            $this->conn = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,      // Remonter les erreurs sous forme d'exceptions
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Renvoyer les résultats sous forme de tableaux associatifs
            ]);

        } catch (PDOException $e) {
            // En cas d'erreur de connexion, on affiche un message clair et on arrête le script
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }

        // 4. On renvoie l'objet PDO au code qui a appelé getConnection()
        return $this->conn;
    }
}
?>
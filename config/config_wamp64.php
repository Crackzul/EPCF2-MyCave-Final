<?php
// Configuration spécifique WAMP64
class Database {
    private $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            // Configuration MySQL WAMP64
            $this->conn = new PDO(
                "mysql:host=localhost;dbname=mycave_db;charset=utf8mb4",
                "root",
                "", // WAMP64 : pas de mot de passe par défaut
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                )
            );
            return $this->conn;
            
        } catch(PDOException $e_mysql) {
            // Fallback SQLite si MySQL ne fonctionne pas
            try {
                $sqliteFile = __DIR__ . "/../database/mycave.db";
                $this->conn = new PDO(
                    "sqlite:" . $sqliteFile,
                    null,
                    null,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                );
                return $this->conn;
                
            } catch(PDOException $e_sqlite) {
                echo "Erreur de connexion BDD: " . $e_mysql->getMessage();
                echo "<br>Erreur SQLite: " . $e_sqlite->getMessage();
            }
        }
        
        return $this->conn;
    }
}
?>
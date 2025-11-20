<?php
require_once 'config/database.php';

class User {
    private $conn;
    private $table_name = "user";

    public $id;
    public $email;
    public $password;
    public $name;
    public $role;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function emailExists($email) {
        $query = "SELECT id FROM " . $this->table_name . " 
                  WHERE email1 = :email LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function create() {
        // Vérifier si l'email existe déjà
        if ($this->emailExists($this->email)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " 
                  SET email1=:email, password1=:password, username=:name, roles=:role";

        $stmt = $this->conn->prepare($query);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":role", $this->role);

        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    public function login($email, $password) {
        $query = "SELECT id, email1, password1, username, roles 
                  FROM " . $this->table_name . " 
                  WHERE email1 = :email LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(password_verify($password, $row['password1'])) {
                $this->id = $row['id'];
                $this->email = $row['email1'];
                $this->name = $row['username'];
                $this->role = $row['roles'];
                return true;
            }
        }
        return false;
    }

    public function getUserById($id) {
        $query = "SELECT id, email1, username, roles, created_at 
                  FROM " . $this->table_name . " 
                  WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        return false;
    }
}
?>
<?php
require_once __DIR__ . '/../config/database.php';

class Wine {
    private $conn;
    private $table_name = "wine";

    public $id;
    public $user_id;
    public $region_id;
    public $name;
    public $year;
    public $description;
    public $picture;
    public $created_at;
    public $updated_at;
    public $region;
    public $country;
    public $grapes = [];

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create(): bool
    {
        try {
            $this->conn->beginTransaction();

            $countryId = $this->getOrCreateCountry($this->country);
            $regionId = $this->getOrCreateRegion($this->region, $countryId);

            $query = "INSERT INTO {$this->table_name} (user_id, region_id, name, year, description, picture) " .
                     "VALUES (:user_id, :region_id, :name, :year, :description, :picture)";
            $stmt = $this->conn->prepare($query);

            $year = (int) $this->year;
            $stmt->bindParam(":user_id", $this->user_id, PDO::PARAM_INT);
            $stmt->bindParam(":region_id", $regionId, PDO::PARAM_INT);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":year", $year, PDO::PARAM_INT);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":picture", $this->picture);

            if ($stmt->execute()) {
                $this->id = (int) $this->conn->lastInsertId();
                $this->region_id = $regionId;
                $this->syncWineGrapes($this->id, $this->getNormalizedGrapeNames());
                $this->conn->commit();
                return true;
            }

            $this->conn->rollBack();
            return false;
        } catch (Throwable $e) {
            $this->conn->rollBack();
            error_log('Wine::create - ' . $e->getMessage());
            return false;
        }
    }

    public function getByUserId($user_id): array
    {
        $query = "SELECT w.id, w.user_id, w.region_id, w.name, w.year, w.description, w.picture, " .
                 "w.created_at, w.updated_at, r.name AS region, c.name AS country, " .
                 "IFNULL(GROUP_CONCAT(DISTINCT g.name ORDER BY g.name SEPARATOR ', '), '') AS grapes " .
                 "FROM {$this->table_name} w " .
                 "JOIN region r ON w.region_id = r.id " .
                 "JOIN country c ON r.country_id = c.id " .
                 "LEFT JOIN wine_grape wg ON w.id = wg.wine_id " .
                 "LEFT JOIN grape g ON wg.grape_id = g.id " .
                 "WHERE w.user_id = :user_id " .
                 "GROUP BY w.id " .
                 "ORDER BY w.created_at DESC";

        $stmt = $this->conn->prepare($query); // Requête préparée pour éviter les injections SQL
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT); // Sécurisation de la variable $user_id
        $stmt->execute(); // Exécution de la requête

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération de tous les résultats sous forme de tableau associatif
    }

    public function getById($id) {
        $query = "SELECT w.id, w.user_id, w.region_id, w.name, w.year, w.description, w.picture, " .
                 "w.created_at, w.updated_at, r.name AS region, c.name AS country, " .
                 "IFNULL(GROUP_CONCAT(DISTINCT g.name ORDER BY g.name SEPARATOR ', '), '') AS grapes " .
                 "FROM {$this->table_name} w " .
                 "JOIN region r ON w.region_id = r.id " .
                 "JOIN country c ON r.country_id = c.id " .
                 "LEFT JOIN wine_grape wg ON w.id = wg.wine_id " .
                 "LEFT JOIN grape g ON wg.grape_id = g.id " .
                 "WHERE w.id = :id " .
                 "GROUP BY w.id " .
                 "LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return false;
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->hydrateFromRow($row);
        return true;
    }

    public function update(): bool
    {
        try {
            $this->conn->beginTransaction();

            $countryId = $this->getOrCreateCountry($this->country);
            $regionId = $this->getOrCreateRegion($this->region, $countryId);

            $query = "UPDATE {$this->table_name} " .
                     "SET region_id = :region_id, name = :name, year = :year, description = :description, " .
                     "picture = :picture, updated_at = NOW() " .
                     "WHERE id = :id AND user_id = :user_id";

            $stmt = $this->conn->prepare($query);
            $year = (int) $this->year;

            $stmt->bindParam(":region_id", $regionId, PDO::PARAM_INT);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":year", $year, PDO::PARAM_INT);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":picture", $this->picture);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $this->user_id, PDO::PARAM_INT);

            $result = $stmt->execute();
            if ($result) {
                $this->syncWineGrapes($this->id, $this->getNormalizedGrapeNames());
                $this->conn->commit();
                return true;
            }

            $this->conn->rollBack();
            return false;
        } catch (Throwable $e) {
            $this->conn->rollBack();
            error_log('Wine::update - ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id, $user_id): bool
    {
        try {
            $this->conn->beginTransaction();

            $deletePivot = $this->conn->prepare("DELETE FROM wine_grape WHERE wine_id = :wine_id");
            $deletePivot->bindParam(":wine_id", $id, PDO::PARAM_INT);
            $deletePivot->execute();

            $query = "DELETE FROM {$this->table_name} WHERE id = :id AND user_id = :user_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

            $stmt->execute();
            if ($stmt->rowCount() === 0) {
                $this->conn->rollBack();
                return false;
            }

            $this->conn->commit();
            return true;
        } catch (Throwable $e) {
            $this->conn->rollBack();
            error_log('Wine::delete - ' . $e->getMessage());
            return false;
        }
    }

    public function countByUserId($user_id) {
        $query = "SELECT COUNT(*) as total FROM {$this->table_name} WHERE user_id = :user_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    private function hydrateFromRow(array $row): void {
        $this->id = (int) $row['id'];
        $this->user_id = (int) $row['user_id'];
        $this->region_id = (int) $row['region_id'];
        $this->name = $row['name'];
        $this->year = (int) $row['year'];
        $this->description = $row['description'];
        $this->picture = $row['picture'];
        $this->created_at = $row['created_at'];
        $this->updated_at = $row['updated_at'];
        $this->region = $row['region'];
        $this->country = $row['country'];
        $this->grapes = $row['grapes'] ?? '';
    }

    private function getOrCreateCountry(string $name): int {
        $cleanName = trim($name);
        if ($cleanName === '') {
            throw new InvalidArgumentException('Le pays est obligatoire.');
        }

        $stmt = $this->conn->prepare('SELECT id FROM country WHERE name = :name LIMIT 1');
        $stmt->bindParam(':name', $cleanName);
        $stmt->execute();

        $existing = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($existing) {
            return (int) $existing['id'];
        }

        $insert = $this->conn->prepare('INSERT INTO country (name) VALUES (:name)');
        $insert->bindParam(':name', $cleanName);
        $insert->execute();

        return (int) $this->conn->lastInsertId();
    }

    private function getOrCreateRegion(string $name, int $countryId): int {
        $cleanName = trim($name);
        if ($cleanName === '') {
            throw new InvalidArgumentException('La région est obligatoire.');
        }

        $stmt = $this->conn->prepare('SELECT id FROM region WHERE name = :name AND country_id = :country_id LIMIT 1');
        $stmt->bindParam(':name', $cleanName);
        $stmt->bindParam(':country_id', $countryId, PDO::PARAM_INT);
        $stmt->execute();

        $existing = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($existing) {
            return (int) $existing['id'];
        }

        $insert = $this->conn->prepare('INSERT INTO region (name, country_id) VALUES (:name, :country_id)');
        $insert->bindParam(':name', $cleanName);
        $insert->bindParam(':country_id', $countryId, PDO::PARAM_INT);
        $insert->execute();

        return (int) $this->conn->lastInsertId();
    }

    private function getOrCreateGrape(string $name): int {
        $cleanName = trim($name);
        if ($cleanName === '') {
            throw new InvalidArgumentException('Le nom du cépage est obligatoire.');
        }

        $stmt = $this->conn->prepare('SELECT id FROM grape WHERE name = :name LIMIT 1');
        $stmt->bindParam(':name', $cleanName);
        $stmt->execute();

        $existing = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($existing) {
            return (int) $existing['id'];
        }

        $insert = $this->conn->prepare('INSERT INTO grape (name) VALUES (:name)');
        $insert->bindParam(':name', $cleanName);
        $insert->execute();

        return (int) $this->conn->lastInsertId();
    }

    private function syncWineGrapes(int $wineId, array $grapeNames): void {
        $stmt = $this->conn->prepare('DELETE FROM wine_grape WHERE wine_id = :wine_id');
        $stmt->bindParam(':wine_id', $wineId, PDO::PARAM_INT);
        $stmt->execute();

        if (empty($grapeNames)) {
            return;
        }

        $insert = $this->conn->prepare('INSERT INTO wine_grape (wine_id, grape_id) VALUES (:wine_id, :grape_id)');

        foreach ($grapeNames as $grapeName) {
            $grapeId = $this->getOrCreateGrape($grapeName);
            $insert->bindParam(':wine_id', $wineId, PDO::PARAM_INT);
            $insert->bindParam(':grape_id', $grapeId, PDO::PARAM_INT);
            $insert->execute();
        }
    }

    private function getNormalizedGrapeNames(): array {
        if (is_array($this->grapes)) {
            $names = $this->grapes;
        } elseif (is_string($this->grapes)) {
            $names = explode(',', $this->grapes);
        } else {
            $names = [];
        }

        $names = array_map(static function ($value) {
            return trim((string) $value);
        }, $names);

        $names = array_filter($names, static function ($value) {
            return $value !== '';
        });

        return array_values(array_unique($names));
    }
}
?>
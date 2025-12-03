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
    public $grape_ids = [];

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create(): bool
    {
        try {
            $this->conn->beginTransaction();

            $query = "INSERT INTO {$this->table_name} (user_id, region_id, name, year, description, picture) " .
                     "VALUES (:user_id, :region_id, :name, :year, :description, :picture)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":user_id", $this->user_id, PDO::PARAM_INT);
            $stmt->bindParam(":region_id", $this->region_id, PDO::PARAM_INT);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":year", $this->year, PDO::PARAM_INT);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":picture", $this->picture);

            if ($stmt->execute()) {
                $this->id = (int) $this->conn->lastInsertId();
                $this->syncWineGrapes($this->id, $this->grape_ids);
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

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT w.id, w.user_id, w.region_id, w.name, w.year, w.description, w.picture, " .
                 "w.created_at, w.updated_at, r.name AS region, c.name AS country, " .
                 "IFNULL(GROUP_CONCAT(DISTINCT g.name ORDER BY g.name SEPARATOR ', '), '') AS grapes, " .
                 "IFNULL(GROUP_CONCAT(DISTINCT g.id ORDER BY g.id), '') AS grape_ids " .
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

            $query = "UPDATE {$this->table_name} " .
                     "SET region_id = :region_id, name = :name, year = :year, description = :description, " .
                     "picture = :picture, updated_at = NOW() " .
                     "WHERE id = :id AND user_id = :user_id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":region_id", $this->region_id, PDO::PARAM_INT);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":year", $this->year, PDO::PARAM_INT);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":picture", $this->picture);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $this->user_id, PDO::PARAM_INT);

            $result = $stmt->execute();
            if ($result) {
                $this->syncWineGrapes($this->id, $this->grape_ids);
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
        $this->grape_ids = $row['grape_ids'] !== '' ? array_map('intval', explode(',', $row['grape_ids'])) : [];
    }

    private function syncWineGrapes(int $wineId, array $grapeIds): void {
        $stmt = $this->conn->prepare('DELETE FROM wine_grape WHERE wine_id = :wine_id');
        $stmt->bindParam(':wine_id', $wineId, PDO::PARAM_INT);
        $stmt->execute();

        if (empty($grapeIds)) {
            return;
        }

        $insert = $this->conn->prepare('INSERT INTO wine_grape (wine_id, grape_id) VALUES (:wine_id, :grape_id)');

        foreach ($grapeIds as $grapeId) {
            $insert->bindParam(':wine_id', $wineId, PDO::PARAM_INT);
            $insert->bindParam(':grape_id', $grapeId, PDO::PARAM_INT);
            $insert->execute();
        }
    }


    public function setGrapesByIds(array $grapeIds): void {
        $this->grape_ids = array_values(array_unique(array_filter($grapeIds)));
    }
}
?>
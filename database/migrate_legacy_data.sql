USE `mycave_v2`;

-- Adaptez ce nom si vos anciennes tables sont dans un autre schéma
SET @legacy_db := 'mycave_db';

-- 1. (Facultatif) sauvegarde actuelle
CREATE TABLE IF NOT EXISTS user_backup LIKE `user`;
INSERT IGNORE INTO user_backup SELECT * FROM `user`;
CREATE TABLE IF NOT EXISTS wine_backup LIKE `wine`;
INSERT IGNORE INTO wine_backup SELECT * FROM `wine`;

-- 2. Utilisateurs
INSERT INTO `user` (id, username, email, password, roles, created_at)
SELECT id,
       username,
       email,
       password,
       COALESCE(roles, 'ROLE_USER'),
       NOW() AS created_at
FROM mycave_db.`user`
ON DUPLICATE KEY UPDATE
  username   = VALUES(username),
  email      = VALUES(email),
  password   = VALUES(password),
  roles      = VALUES(roles),
  created_at = VALUES(created_at);

-- 3. Pays
INSERT INTO country (name)
SELECT DISTINCT country
FROM mycave_db.wine
WHERE country IS NOT NULL AND country <> ''
ON DUPLICATE KEY UPDATE name = VALUES(name);

-- 4. Régions
INSERT INTO region (name, country_id)
SELECT DISTINCT w.region,
       c.id
FROM mycave_db.wine w
JOIN country c ON c.name = w.country
WHERE w.region IS NOT NULL AND w.region <> ''
ON DUPLICATE KEY UPDATE country_id = VALUES(country_id);

-- 5. Cépages
INSERT INTO grape (name)
SELECT DISTINCT TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(w.grapes, ',', n.n), ',', -1)) AS grape_name
FROM mycave_db.wine w
JOIN (SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5
      UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10) AS n
  ON n.n <= 1 + LENGTH(w.grapes) - LENGTH(REPLACE(w.grapes, ',', ''))
WHERE w.grapes IS NOT NULL AND w.grapes <> ''
HAVING grape_name <> ''
ON DUPLICATE KEY UPDATE name = VALUES(name);

-- 6. Vins
INSERT INTO wine (id, user_id, region_id, name, year, description, picture, created_at, updated_at)
SELECT w.id,
       w.user_id,
       r.id,
       w.name,
       w.year,
       w.description,
       w.picture,
       COALESCE(w.created_at, NOW()),
       COALESCE(w.created_at, NOW())
FROM mycave_db.wine w
JOIN region r
  ON r.name = w.region
 AND r.country_id = (SELECT id FROM country WHERE name = w.country LIMIT 1)
ON DUPLICATE KEY UPDATE
  user_id = VALUES(user_id),
  region_id = VALUES(region_id),
  name = VALUES(name),
  year = VALUES(year),
  description = VALUES(description),
  picture = VALUES(picture),
  created_at = VALUES(created_at),
  updated_at = VALUES(updated_at);

-- 7. Table pivot vin/cépages
INSERT INTO wine_grape (wine_id, grape_id)
SELECT DISTINCT w.id,
       g.id
FROM mycave_db.wine w
JOIN (SELECT wine_id,
             TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(grapes, ',', n.n), ',', -1)) AS grape_name
      FROM mycave_db.wine
      JOIN (SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5
            UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10) AS n
        ON n.n <= 1 + LENGTH(grapes) - LENGTH(REPLACE(grapes, ',', ''))
      WHERE grapes IS NOT NULL AND grapes <> '') AS wg
  ON wg.wine_id = w.id AND wg.grape_name <> ''
JOIN grape g ON g.name = wg.grape_name
ON DUPLICATE KEY UPDATE grape_id = VALUES(grape_id);

USE `mycave_v2`;

START TRANSACTION;

-- Conserver pour chaque nom la région au plus petit id
CREATE TEMPORARY TABLE tmp_region_duplicates AS
SELECT name, MIN(id) AS keep_id
FROM region
GROUP BY name
HAVING COUNT(*) > 1;

-- Réassigner les vins vers la région conservée
UPDATE wine w
JOIN region r ON r.id = w.region_id
JOIN tmp_region_duplicates d ON d.name = r.name
SET w.region_id = d.keep_id
WHERE w.region_id <> d.keep_id;

-- Supprimer les doublons désormais inutilisés
DELETE r2
FROM region r2
JOIN tmp_region_duplicates d ON d.name = r2.name
WHERE r2.id <> d.keep_id;

DROP TEMPORARY TABLE IF EXISTS tmp_region_duplicates;

COMMIT;

-- Vérifications rapides
SELECT name, COUNT(*) AS occurrences
FROM region
GROUP BY name
HAVING COUNT(*) > 1;

SELECT r.id, r.name, r.country_id
FROM region r
JOIN wine w ON w.region_id = r.id
GROUP BY r.id, r.name, r.country_id
ORDER BY r.name;


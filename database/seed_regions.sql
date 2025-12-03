USE `mycave_v2`;

-- Exemple d'exécution en CLI :
-- mysql -u root -p < database/seed_regions.sql

START TRANSACTION;

-- Conserver les pays de référence
INSERT INTO `country` (`name`) VALUES
  ('France'),
  ('Spain'),
  ('USA'),
  ('Italy'),
  ('Argentina')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- Remplacer les régions existantes par des régions viticoles reconnues
DELETE FROM `region`;

INSERT INTO `region` (`name`, `country_id`)
SELECT region_name, country_id
FROM (
  SELECT 'Bordeaux' AS region_name, (SELECT id FROM country WHERE name = 'France') AS country_id UNION ALL
  SELECT 'Bourgogne', (SELECT id FROM country WHERE name = 'France') UNION ALL
  SELECT 'Champagne', (SELECT id FROM country WHERE name = 'France') UNION ALL
  SELECT 'Vallée du Rhône', (SELECT id FROM country WHERE name = 'France') UNION ALL
  SELECT 'Loire', (SELECT id FROM country WHERE name = 'France') UNION ALL
  SELECT 'Rioja', (SELECT id FROM country WHERE name = 'Spain') UNION ALL
  SELECT 'Ribera del Duero', (SELECT id FROM country WHERE name = 'Spain') UNION ALL
  SELECT 'Priorat', (SELECT id FROM country WHERE name = 'Spain') UNION ALL
  SELECT 'Napa Valley', (SELECT id FROM country WHERE name = 'USA') UNION ALL
  SELECT 'Sonoma County', (SELECT id FROM country WHERE name = 'USA') UNION ALL
  SELECT 'Willamette Valley', (SELECT id FROM country WHERE name = 'USA') UNION ALL
  SELECT 'Tuscany', (SELECT id FROM country WHERE name = 'Italy') UNION ALL
  SELECT 'Piedmont', (SELECT id FROM country WHERE name = 'Italy') UNION ALL
  SELECT 'Veneto', (SELECT id FROM country WHERE name = 'Italy') UNION ALL
  SELECT 'Mendoza', (SELECT id FROM country WHERE name = 'Argentina') UNION ALL
  SELECT 'Salta', (SELECT id FROM country WHERE name = 'Argentina') UNION ALL
  SELECT 'Patagonia', (SELECT id FROM country WHERE name = 'Argentina')
) AS regions;

COMMIT;

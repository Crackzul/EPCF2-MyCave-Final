-- Cohérence des tables MyCave v2
-- A exécuter dans phpMyAdmin ou mysql CLI :
--   SOURCE database/check_integrity.sql;

USE `mycave_v2`;

/*******************************************************************
1. Récapitulatif des volumes par table principale
*******************************************************************/
SELECT 'user' AS table_name, COUNT(*) AS total FROM `user`
UNION ALL
SELECT 'country', COUNT(*) FROM country
UNION ALL
SELECT 'region', COUNT(*) FROM region
UNION ALL
SELECT 'grape', COUNT(*) FROM grape
UNION ALL
SELECT 'wine', COUNT(*) FROM wine
UNION ALL
SELECT 'wine_grape', COUNT(*) FROM wine_grape;

/*******************************************************************
2. Emails utilisateur en doublon (doit retourner 0 ligne)
*******************************************************************/
SELECT email, COUNT(*) AS duplicates
FROM `user`
GROUP BY email
HAVING COUNT(*) > 1;

/*******************************************************************
3. Orphelins : FK non satisfaites (doivent toutes être vides)
*******************************************************************/
-- Régions sans pays
SELECT r.id, r.name, r.country_id
FROM region r
LEFT JOIN country c ON c.id = r.country_id
WHERE c.id IS NULL;

-- Vins sans utilisateur
SELECT w.id, w.name, w.user_id
FROM wine w
LEFT JOIN `user` u ON u.id = w.user_id
WHERE u.id IS NULL;

-- Vins sans région
SELECT w.id, w.name, w.region_id
FROM wine w
LEFT JOIN region r ON r.id = w.region_id
WHERE r.id IS NULL;

-- Liaisons vin/cépage sans vin ou sans cépage
SELECT wg.wine_id, wg.grape_id, 'missing_wine' AS issue
FROM wine_grape wg
LEFT JOIN wine w ON w.id = wg.wine_id
WHERE w.id IS NULL
UNION ALL
SELECT wg.wine_id, wg.grape_id, 'missing_grape'
FROM wine_grape wg
LEFT JOIN grape g ON g.id = wg.grape_id
WHERE g.id IS NULL;

/*******************************************************************
4. Vérifications métiers complémentaires
*******************************************************************/
-- Vins créés sans cépage associé
SELECT w.id, w.name
FROM wine w
LEFT JOIN wine_grape wg ON wg.wine_id = w.id
GROUP BY w.id
HAVING COUNT(wg.grape_id) = 0;

-- Cépages inutilisés
SELECT g.id, g.name
FROM grape g
LEFT JOIN wine_grape wg ON wg.grape_id = g.id
WHERE wg.grape_id IS NULL;

-- Descriptions trop courtes (exemple : moins de 10 caractères)
SELECT w.id, w.name, LENGTH(COALESCE(w.description, '')) AS description_length
FROM wine w
WHERE LENGTH(COALESCE(w.description, '')) < 10;

/*******************************************************************
5. Dates incohérentes (created_at > updated_at)
*******************************************************************/
SELECT w.id, w.name, w.created_at, w.updated_at
FROM wine w
WHERE w.updated_at IS NOT NULL
  AND w.updated_at < w.created_at;


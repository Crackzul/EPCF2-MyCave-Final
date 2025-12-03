-- SQL (MySQL) : création des tables et exemples d'inserts

USE `mycave_v2`;

-- Table user

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `roles` VARCHAR(255) NOT NULL DEFAULT 'ROLE_USER',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table country

CREATE TABLE IF NOT EXISTS `country` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_country_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table region

CREATE TABLE IF NOT EXISTS `region` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `country_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_region_country_idx` (`country_id`),
  CONSTRAINT `fk_region_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  UNIQUE KEY `uk_region_country` (`name`, `country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table grape

CREATE TABLE IF NOT EXISTS `grape` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_grape_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table wine

CREATE TABLE IF NOT EXISTS `wine` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `region_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `year` INT NOT NULL,
  `description` TEXT DEFAULT NULL,
  `picture` VARCHAR(255) DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wine_user_idx` (`user_id`),
  KEY `fk_wine_region_idx` (`region_id`),
  CONSTRAINT `fk_wine_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_wine_region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pivot wine_grape

CREATE TABLE IF NOT EXISTS `wine_grape` (
  `wine_id` INT NOT NULL,
  `grape_id` INT NOT NULL,
  PRIMARY KEY (`wine_id`, `grape_id`),
  KEY `fk_wine_grape_grape_idx` (`grape_id`),
  CONSTRAINT `fk_wine_grape_wine` FOREIGN KEY (`wine_id`) REFERENCES `wine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_wine_grape_grape` FOREIGN KEY (`grape_id`) REFERENCES `grape` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Jeux de données d'exemple
INSERT INTO `user` (`id`, `username`, `email`, `password`, `roles`)
VALUES
  (1, 'didier', 'didier@example.com', '$2y$12$EXAMPLEHASHFORPASSWORD1', 'ROLE_USER'),
  (2, 'Marty Didier', 'boutcamp@gmail.com', '$2y$12$EXAMPLEHASHFORPASSWORD2', 'ROLE_USER')
ON DUPLICATE KEY UPDATE
  `username` = VALUES(`username`),
  `password` = VALUES(`password`),
  `roles` = VALUES(`roles`);

INSERT INTO `country` (`name`) VALUES
  ('France'), ('Spain'), ('USA'), ('Italy'), ('Argentina')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

INSERT INTO `region` (`name`, `country_id`)
SELECT region_name, country_id FROM (
  SELECT 'Bordeaux' AS region_name, (SELECT id FROM country WHERE name = 'France') AS country_id
  UNION ALL SELECT 'Bourgogne', (SELECT id FROM country WHERE name = 'France')
  UNION ALL SELECT 'Champagne', (SELECT id FROM country WHERE name = 'France')
  UNION ALL SELECT 'Vallée du Rhône', (SELECT id FROM country WHERE name = 'France')
  UNION ALL SELECT 'Loire', (SELECT id FROM country WHERE name = 'France')
  UNION ALL SELECT 'Rioja', (SELECT id FROM country WHERE name = 'Spain')
  UNION ALL SELECT 'Ribera del Duero', (SELECT id FROM country WHERE name = 'Spain')
  UNION ALL SELECT 'Priorat', (SELECT id FROM country WHERE name = 'Spain')
  UNION ALL SELECT 'Napa Valley', (SELECT id FROM country WHERE name = 'USA')
  UNION ALL SELECT 'Sonoma County', (SELECT id FROM country WHERE name = 'USA')
  UNION ALL SELECT 'Willamette Valley', (SELECT id FROM country WHERE name = 'USA')
  UNION ALL SELECT 'Tuscany', (SELECT id FROM country WHERE name = 'Italy')
  UNION ALL SELECT 'Piedmont', (SELECT id FROM country WHERE name = 'Italy')
  UNION ALL SELECT 'Veneto', (SELECT id FROM country WHERE name = 'Italy')
  UNION ALL SELECT 'Mendoza', (SELECT id FROM country WHERE name = 'Argentina')
  UNION ALL SELECT 'Salta', (SELECT id FROM country WHERE name = 'Argentina')
  UNION ALL SELECT 'Patagonia', (SELECT id FROM country WHERE name = 'Argentina')
) AS seeds
ON DUPLICATE KEY UPDATE `country_id` = VALUES(`country_id`);

INSERT INTO `grape` (`name`) VALUES
  ('Grenache'), ('Syrah'), ('Tempranillo'), ('Sauvignon Blanc'), ('Pinot Noir'), ('Nebbiolo'), ('Chardonnay'), ('Merlot')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

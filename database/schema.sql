-- SQL (MySQL) : création des tables et exemples d'inserts

USE `mycave_db`;

-- Table user

CREATE TABLE `user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `roles` VARCHAR(255) NOT NULL DEFAULT 'ROLE_USER',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table wine

CREATE TABLE `wine` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT DEFAULT NULL,
  `name` VARCHAR(255) NOT NULL,
  `year` YEAR DEFAULT NULL,
  `grapes` VARCHAR(255) DEFAULT NULL,
  `country` VARCHAR(100) DEFAULT NULL,
  `region` VARCHAR(100) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `picture` VARCHAR(255) DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_wine_user_idx` (`user_id`),
  CONSTRAINT `fk_wine_user` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exemples d'INSERT pour la table user
INSERT INTO `user` (`id`, `username`, `email`, `password`, `roles`) VALUES
(1, 'didier', 'didier@example.com', '$2y$12$EXAMPLEHASHFORPASSWORD1', 'ROLE_USER'),
(2, 'Marty Didier', 'boutcamp@gmail.com', '$2y$12$EXAMPLEHASHFORPASSWORD2', 'ROLE_USER');

-- Exemples d'INSERT pour la table wine
INSERT INTO `wine` (`user_id`,`name`,`year`,`grapes`,`country`,`region`,`description`,`picture`) VALUES
(1, 'CHATEAU DE SAINT COSME', 2009, 'Grenache / Syrah', 'France', 'Southern Rhone / Gigondas',
 'The aromas of fruit and spice...', 'saint_cosme.jpg'),
(1, 'LAN RIOJA CRIANZA', 2006, 'Tempranillo', 'Spain', 'Rioja',
 'A resurgence of interest in boutique vineyards...', 'lan_rioja.jpg'),
(1, 'MARGERUM SYBARITE', 2010, 'Sauvignon Blanc', 'USA', 'California Central Coast',
 'The cache of a fine Cabernet in ones wine cellar...', 'margerum.jpg'),
(1, 'REX HILL', 2009, 'Pinot Noir', 'USA', 'Oregon',
 'One cannot doubt that this will be the wine served...', 'rex_hill.jpg');

-- Vins d'exemple supplémentaires
INSERT INTO wine (user_id, name, year, grapes, country, region, description, picture) VALUES
(2, 'Château Margaux', 2015, 'Cabernet Sauvignon, Merlot', 'France', 'Bordeaux', 'Un grand cru exceptionnel avec des arômes complexes de fruits rouges et d''épices. Parfait pour les grandes occasions.'),
(2, 'Domaine de la Côte', 2018, 'Pinot Noir', 'France', 'Bourgogne', 'Un pinot noir élégant aux notes de cerise et de sous-bois. Idéal avec les viandes rouges.'),
(2, 'Barolo Brunate', 2016, 'Nebbiolo', 'Italie', 'Piémont', 'Un Barolo puissant et tannique, avec une longue garde. Notes de rose et de truffe.'),
(2, 'Chablis Premier Cru', 2019, 'Chardonnay', 'France', 'Bourgogne', 'Un blanc minéral et frais, parfait avec les fruits de mer et poissons.'),
(2, 'Rioja Gran Reserva', 2014, 'Tempranillo', 'Espagne', 'Rioja', 'Un rouge espagnol complexe, élevé en fût de chêne. Notes de vanille et de fruits mûrs.'),
(2, 'Champagne Dom Pérignon', 2012, 'Chardonnay, Pinot Noir', 'France', 'Champagne', 'Un champagne d''exception aux bulles fines et persistantes. Parfait pour célébrer.'),
(2, 'Sancerre Les Monts', 2020, 'Sauvignon Blanc', 'France', 'Loire', 'Un blanc sec et minéral avec des notes d''agrumes et de pierre à fusil.'),
(2, 'Côtes du Rhône Villages', 2017, 'Grenache, Syrah', 'France', 'Rhône', 'Un rouge généreux aux arômes de garrigue et d''épices. Excellent rapport qualité-prix.'),
(2, 'Brunello di Montalcino', 2015, 'Sangiovese', 'Italie', 'Toscane', 'Un grand vin italien structuré, aux tanins soyeux et à la finale persistante.'),
(2, 'Pouilly-Fumé', 2019, 'Sauvignon Blanc', 'France', 'Loire', 'Un blanc expressif aux arômes fumés caractéristiques. Parfait à l''apéritif.'),
(2, 'Châteauneuf-du-Pape', 2016, 'Grenache, Syrah, Mourvèdre', 'France', 'Rhône', 'Un rouge puissant et complexe, reflet du terroir exceptionnel des galets roulés.'),
(2, 'Moscato d''Asti', 2021, 'Moscato', 'Italie', 'Piémont', 'Un blanc doux et pétillant, parfait pour les desserts ou l''apéritif.');

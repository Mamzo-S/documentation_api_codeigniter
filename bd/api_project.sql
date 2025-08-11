-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour api_project
CREATE DATABASE IF NOT EXISTS `api_project` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `api_project`;

-- Listage de la structure de table api_project. architecture
CREATE TABLE IF NOT EXISTS `architecture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `architecture_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `format_donnee` int DEFAULT NULL,
  `header` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `format_donnee` (`format_donnee`),
  KEY `header` (`header`),
  CONSTRAINT `FK_architecture_format_donnee` FOREIGN KEY (`format_donnee`) REFERENCES `format` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table api_project. authentification
CREATE TABLE IF NOT EXISTS `authentification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `methode_auth` int DEFAULT NULL,
  `lien_auth` int DEFAULT NULL,
  `body` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `methode_auth` (`methode_auth`),
  KEY `lien_auth` (`lien_auth`),
  CONSTRAINT `FK_authentification_lien` FOREIGN KEY (`lien_auth`) REFERENCES `lien` (`id`),
  CONSTRAINT `FK_authentification_methode` FOREIGN KEY (`methode_auth`) REFERENCES `methode` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table api_project. documentation
CREATE TABLE IF NOT EXISTS `documentation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) DEFAULT NULL,
  `descriptions` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table api_project. endpoints
CREATE TABLE IF NOT EXISTS `endpoints` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lien_end` int DEFAULT NULL,
  `parametre` varchar(200) DEFAULT NULL,
  `methode_end` int DEFAULT NULL,
  `reponse` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lien_end` (`lien_end`),
  KEY `methode_end` (`methode_end`),
  CONSTRAINT `FK_endpoints_lien` FOREIGN KEY (`lien_end`) REFERENCES `lien` (`id`),
  CONSTRAINT `FK_endpoints_methode` FOREIGN KEY (`methode_end`) REFERENCES `methode` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table api_project. format
CREATE TABLE IF NOT EXISTS `format` (
  `id` int NOT NULL AUTO_INCREMENT,
  `format` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table api_project. lien
CREATE TABLE IF NOT EXISTS `lien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `base_url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table api_project. methode
CREATE TABLE IF NOT EXISTS `methode` (
  `id` int NOT NULL AUTO_INCREMENT,
  `methode_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table api_project. type_authorization
CREATE TABLE IF NOT EXISTS `type_authorization` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table api_project. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(80) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `motdepasse` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

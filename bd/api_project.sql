-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.4.3 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage des données de la table api_project.architecture : ~3 rows (environ)
DELETE FROM `architecture`;
INSERT INTO `architecture` (`id`, `architecture_name`, `format_donnee`, `header`) VALUES
	(1, 'REST', 1, 'Content-Type: application/json');

-- Listage des données de la table api_project.authentification : ~0 rows (environ)
DELETE FROM `authentification`;

-- Listage des données de la table api_project.documentation : ~0 rows (environ)
DELETE FROM `documentation`;

-- Listage des données de la table api_project.endpoints : ~4 rows (environ)
DELETE FROM `endpoints`;
INSERT INTO `endpoints` (`id`, `titre`, `lien_end`, `parametre`, `methode_end`, `reponse_success`, `reponse_error`, `type`, `endName`, `description`) VALUES
	(3, 'liste des regions', 15, 'aucun', 2, '{\r\n  "code": "0",\r\n  "message": "Traitement effecturé avec succées",\r\n  "status": "SUCCESS",\r\n  "regions": [\r\n    {\r\n      "code_region": "1",\r\n      "value_region": "DAKAR",\r\n      "value_country_short": "SN"\r\n    },\r\n    {\r\n      "code_region": "31",\r\n      "value_region": "DIOURBEL",\r\n      "value_country_short": "SN"\r\n    }\r\n  ]\r\n}', '{ \r\n    "code": 401, \r\n    "message": "Error"   \r\n} ', 'endpoint_simple', 'region', 'Aucun paramètre requis pour cet endpoint.'),
	(5, 'authentification', 17, 'login et password', 1, '{ \r\n    "code": 200, \r\n    "message": "Connexion réussie", \r\n    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ\r\n             pc3MiOiJSRUZFUkVOVElFTCIsInN1YiI6IkxPR0lO\r\n             IiwiaWF0IjoxNzI0NTk0MjI4LCJleHAiOjE3MjUxO\r\n             TkwMjgsInVzZXIiOiJzZW5zb2Z0In0.Wz_9qKbHXg\r\n             BTv8YZ-TSX_aacuM_fSFBYhXb7bt30A2U" \r\n} ', '{ \r\n    "code": 401, \r\n    "message": "Login invalide." \r\n} ', 'authentification', 'login', 'Cet endpoint nécessite un paramètre (le login et le password du user)'),
	(15, 'liste des ief', 15, 'aucun', 2, '{\r\n  "code": 200,\r\n  "message": "Success",\r\n  "data": [\r\n    {\r\n      "id_ief": "4",\r\n      "ief": "IEF Almadies"\r\n    },\r\n    {\r\n      "id_ief": "10",\r\n      "ief": "IEF Dakar Plateau"\r\n    }\r\n  ]\r\n}', '{ \r\n    "code": 401, \r\n    "message": "Error"   \r\n} ', 'endpoint_simple', 'ief', 'Aucun paramètre requis pour cet endpoint.'),
	(17, 'liste des IA', 15, 'aucun', 2, '{\r\n  "code": "200",\r\n  "status": "SUCCESS",\r\n  "message": "Traitement effectué avec succés",\r\n  "ias": [\r\n    {\r\n      "code_ia": "2",\r\n      "value_ia": "IA DAKAR"\r\n    },\r\n    {\r\n      "code_ia": "32",\r\n      "value_ia": "IA DIOURBEL"\r\n    }\r\n  ]\r\n}', '{ \r\n    "code": 401, \r\n    "message": "Error"   \r\n} ', 'endpoint_simple', 'ia', 'Aucun paramètre requis pour cet endpoint.');

-- Listage des données de la table api_project.format : ~4 rows (environ)
DELETE FROM `format`;
INSERT INTO `format` (`id`, `format`) VALUES
	(1, 'JSON'),
	(2, 'TEXT'),
	(4, 'XML');

-- Listage des données de la table api_project.lien : ~2 rows (environ)
DELETE FROM `lien`;
INSERT INTO `lien` (`id`, `base_url`, `nom_url`) VALUES
	(15, 'https://codeco.education.sn/ien-get', 'Codeco'),
	(16, 'https://management.education.sn/api/simenv1', 'Management'),
	(17, 'https://api.education.sn', 'ApiV1');

-- Listage des données de la table api_project.menu : ~6 rows (environ)
DELETE FROM `menu`;
INSERT INTO `menu` (`id`, `code`, `libelle`, `etat`) VALUES
	(1, 'ENDPOINTS', 'endpoints', 1),
	(3, 'ARCHITECTURE', 'architecture', 1),
	(4, 'AUTHENTIFICATION', 'authentification', 1),
	(5, 'ACCUEIL', 'accueil', 1),
	(6, 'CONFIGURATION', 'configuration', 1),
	(7, 'SECURITE', 'securité', 1);

-- Listage des données de la table api_project.methode : ~5 rows (environ)
DELETE FROM `methode`;
INSERT INTO `methode` (`id`, `methode_name`) VALUES
	(1, 'POST'),
	(2, 'GET'),
	(3, 'PUT'),
	(4, 'DELETE');

-- Listage des données de la table api_project.profil : ~4 rows (environ)
DELETE FROM `profil`;
INSERT INTO `profil` (`id`, `profile_name`) VALUES
	(1, 'Administrateur'),
	(2, 'Utilisateur'),
	(3, 'Developpeur');

-- Listage des données de la table api_project.role : ~22 rows (environ)
DELETE FROM `role`;
INSERT INTO `role` (`id`, `d_read`, `d_add`, `d_del`, `d_upd`, `profil_id`, `id_sousmenu`) VALUES
	(1, 1, 1, 1, 1, 1, 9),
	(2, 1, 1, 1, 1, 1, 11),
	(5, 1, 1, 1, 1, 3, 2),
	(9, 1, 0, 0, 0, 2, 9),
	(11, 1, 1, 1, 1, 3, 9),
	(12, 1, 1, 1, 1, 3, 1),
	(13, 1, 1, 1, 1, 3, 2),
	(14, 1, 1, 1, 1, 3, 3),
	(15, 1, 0, 0, 0, 3, 4),
	(16, 1, 0, 0, 0, 3, 5),
	(17, 1, 0, 0, 0, 2, 9),
	(18, 1, 0, 0, 0, 2, 10),
	(19, 1, 0, 0, 0, 2, 11),
	(20, 1, 0, 0, 0, 2, 8),
	(21, 1, 1, 1, 1, 1, 1),
	(22, 1, 1, 1, 1, 1, 2),
	(23, 1, 1, 1, 1, 1, 3),
	(24, 1, 1, 1, 1, 1, 4),
	(25, 1, 1, 1, 1, 1, 5),
	(26, 1, 1, 1, 1, 1, 8),
	(27, 1, 1, 1, 1, 3, 9),
	(28, 1, 1, 1, 1, 3, 10),
	(29, 1, 1, 1, 1, 1, 9),
	(30, 1, 1, 1, 1, 3, 11),
	(31, 1, 1, 1, 1, 1, 10);

-- Listage des données de la table api_project.sous_menu : ~11 rows (environ)
DELETE FROM `sous_menu`;
INSERT INTO `sous_menu` (`id`, `code`, `id_menu`, `etat`, `libelle`) VALUES
	(1, 'METHODE', 6, 1, 'methode'),
	(2, 'FORMAT', 6, 1, 'format_donnee'),
	(3, 'BASE_URL', 6, 1, 'base_url'),
	(4, 'MENU', 6, 1, 'menu'),
	(5, 'SOUS_MENU', 6, 1, 'sous_menu'),
	(6, 'UTILISATEUR', 7, 1, 'utilisateur'),
	(7, 'PROFILE', 7, 1, 'profile'),
	(8, 'ACCUEIL_SM', 5, 1, 'accueil'),
	(9, 'ENDPOINTS_SM', 1, 1, 'endpoints'),
	(10, 'ARCHITECTURE_SM', 3, 1, 'architecture'),
	(11, 'AUTHENTIFICATION_SM', 4, 1, 'authentification');

-- Listage des données de la table api_project.type_authorization : ~2 rows (environ)
DELETE FROM `type_authorization`;
INSERT INTO `type_authorization` (`id`, `libelle`) VALUES
	(1, 'Bearer Token'),
	(2, 'JWT Token');

-- Listage des données de la table api_project.user : ~3 rows (environ)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `motdepasse`, `username`, `profile_id`, `statut`) VALUES
	(1, 'SOW', 'Mamadou', 'sowmamzo2002@gmail.com', '$2y$10$Eb7xf.EssfF6yzE2zwwIKOPcmXUJWO1sdjA.GQuHEhobp0Ovm0tou', 'mamzo123', 1, 1),
	(3, 'Seye', 'Diery', 'diery.seye@education.sn', '$2y$10$tQ.w6fHlepbSxjy1v6Lvr.wNjkAk2Ve7.F7l.6poThB2YCtTmOVEC', 'seye2025', 3, 1),
	(4, 'Sow', 'Aliou', 'sowmamzo1002@gmail.com', '$2y$10$35zcyknGbcfeaMBLVROHM.P1ijeW8Vb03vV9M08nW/WNhQPnyrG8u', 'aliou2025', 2, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               8.0.28 - MySQL Community Server - GPL
-- Server Betriebssystem:        Linux
-- HeidiSQL Version:             11.3.0.6369
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Exportiere Daten aus Tabelle pizza.ingredients: ~6 rows (ungefähr)
INSERT INTO `ingredients` (`id`, `name`) VALUES
	(4, 'anchovies'),
	(3, 'mozarella di bufala'),
	(2, 'mozzarella'),
	(6, 'oil'),
	(5, 'oregano'),
	(7, 'spicy salami'),
	(1, 'tomato');

-- Exportiere Daten aus Tabelle pizza.pizza: ~4 rows (ungefähr)
INSERT INTO `pizza` (`id`, `name`, `price`) VALUES
	(1, 'Margherita', 5),
	(2, 'Bufala', 6),
	(3, 'Romana', 5),
	(4, 'Diavola', 7.5),
	(5, 'Pizza Bianca', 5);

-- Exportiere Daten aus Tabelle pizza.pizza_ingredients_rels: ~14 rows (ungefähr)
INSERT INTO `pizza_ingredients_rels` (`pizza_id`, `ingredients_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 1),
	(2, 3),
	(3, 1),
	(3, 2),
	(3, 4),
	(3, 5),
	(3, 6),
	(4, 1),
	(4, 2),
	(4, 7),
	(5, 2),
	(5, 5);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

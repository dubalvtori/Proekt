-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия на сървъра:            10.4.27-MariaDB - mariadb.org binary distribution
-- ОС на сървъра:                Win64
-- HeidiSQL Версия:              12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дъмп на структурата на БД kurslva_rabota_20408
CREATE DATABASE IF NOT EXISTS `kurslva_rabota_20408` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `kurslva_rabota_20408`;

-- Дъмп структура за таблица kurslva_rabota_20408.student
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `overall_grade` float(3,2) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Дъмп данни за таблица kurslva_rabota_20408.student: ~9 rows (приблизително)
REPLACE INTO `student` (`student_id`, `name`, `age`, `overall_grade`) VALUES
	(1, 'Jordan Kovachki', 18, 3.50),
	(2, 'Georgi Grupchev', 18, 4.50),
	(3, 'Milana Kapcheva', 16, 5.70),
	(4, 'Petia Robeva', 15, 6.00),
	(5, 'David Todev', 17, 5.10),
	(6, 'Dragana Mirkovich', 16, 3.80),
	(7, 'Zlatanka Chokova', 14, 5.60),
	(8, 'Yavor Shulev', 13, 3.30),
	(9, 'Asen Asenov', 17, 2.50);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

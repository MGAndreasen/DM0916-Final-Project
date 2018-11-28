SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- ---------------
-- Create Database
-- ---------------
START TRANSACTION;
CREATE DATABASE IF NOT EXISTS `TFProject` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
COMMIT;

-- -----------
-- Use the DB
-- -----------
USE TFProject;

-- -----------------------
-- Start delete all tables
-- -----------------------
START TRANSACTION;
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS project_image;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS image;
DROP TABLE IF EXISTS project;
DROP TABLE IF EXISTS project_structur;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
-- ---------------------
-- End delete all tables
-- ---------------------

-- -------------------
-- Start create tables
-- -------------------
START TRANSACTION;

-- Customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `hash` char(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` char(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `last_access` datetime NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Project
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `size` smallint(6) NOT NULL DEFAULT '256',
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Project_Structur
CREATE TABLE IF NOT EXISTS `project_structur` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`,`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Image
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_structur_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_structur_id` (`project_structur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Project_Image
CREATE TABLE IF NOT EXISTS `project_image` (
  `project_structur_id` int(10) UNSIGNED NOT NULL,
  `image_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`project_structur_id`,`image_id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.5-10.1.25-MariaDB)
# Database: alaw
# Generation Time: 2017-09-27 04:00:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table qz_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `qz_categories`;

CREATE TABLE `qz_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

LOCK TABLES `qz_categories` WRITE;
/*!40000 ALTER TABLE `qz_categories` DISABLE KEYS */;

INSERT INTO `qz_categories` (`cat_id`, `category`, `parent_id`, `user_id`)
VALUES
	(1,'Law',0,1),
	(2,'First Year',1,1),
	(3,'Contracts',2,1),
	(4,'Criminal Law',2,1),
	(5,'Torts Law',2,1),
	(6,'Web Development',0,1),
	(7,'Javascript',6,1),
	(9,'Set 1',3,1),
	(13,'Definition 1',3,1),
	(14,'Set 1',4,1),
	(15,'Set 2',4,1),
	(16,'Nailing Bar',0,1),
	(17,'Criminal',16,1),
	(18,'Set 1',17,1),
	(19,'MBE 1',4,1),
	(20,'Nail 1',4,1),
	(21,'MBE 1',5,1),
	(22,'MBE 1',3,1),
	(23,'Nailing Bar',5,1),
	(24,'FYLS 1980 Exam',2,1),
	(25,'Nailing Baby Bar',2,1),
	(26,'Siegle\'s Law',2,1),
	(27,'Contracts',26,1),
	(28,'Criminal',26,1),
	(29,'Torts',26,1),
	(30,'Contracts',25,1),
	(31,'Criminal',25,1),
	(32,'Torts',25,1);

/*!40000 ALTER TABLE `qz_categories` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

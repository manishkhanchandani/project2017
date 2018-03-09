/*
SQLyog Community Edition- MySQL GUI v6.15
MySQL - 5.5.5-10.1.21-MariaDB : Database - alaw
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `alaw`;

USE `alaw`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `qz_categories` */

DROP TABLE IF EXISTS `qz_categories`;

CREATE TABLE `qz_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `qz_categories` */

insert  into `qz_categories`(`cat_id`,`category`,`parent_id`,`user_id`) values (1,'Law',0,1),(2,'First Year',1,1),(3,'Contracts',2,1),(4,'Criminal Law',2,1),(5,'Torts Law',2,1),(6,'Web Development',0,1),(7,'Javascript',6,1),(9,'Set 1',3,1),(13,'Definition 1',3,1),(14,'Set 1',4,1),(15,'Set 2',4,1),(16,'Nailing Bar',0,1),(17,'Criminal',16,1),(18,'Set 1',17,1),(19,'MBE 1',4,1),(20,'Nail 1',4,1),(21,'MBE 1',5,1),(22,'MBE 1',3,1),(23,'Nailing Bar',5,1),(24,'FYLS 1980 Exam',2,1),(25,'Nailing Baby Bar',2,1),(26,'Siegle\'s Law',2,1),(27,'Contracts',26,1),(28,'Criminal',26,1),(29,'Torts',26,1),(30,'Contracts',25,1),(31,'Criminal',25,1),(32,'Torts',25,1),(33,'TEST #1 CONTRACTS â€“ TERMS AND FORMATION',25,1),(34,'TEST #2 CONTRACTS â€“ INTERPRETATION AND ENFORCEABILITY',25,1),(35,'TEST #3 CONTRACTS â€“ THIRD PARTIES AND REMEDIES',25,1),(36,'TEST #4 UCC',25,1),(37,'TEST #5 â€“ TORTS â€“ INTENTIONAL TORTS AND DEFENSES',25,1),(38,'TEST # 6 â€“TORTS â€“ NEGLIGENCE AND DEFENSES',25,1),(39,'TEST # 7 â€“ TORTS â€“ DEFAMATION / PRODUCT LIABILITY / MISCELLANEOUS',25,1),(40,'TEST # 8 â€“ CRIMINAL LAW FUNDAMENTALS AND CRIMES AGAINST PROPERTY ',25,1),(42,'TEST # 9 â€“ CRIMES AGAINST THE PERSON / VICARIOUS LIABILITY / DEFENSES',25,1),(43,'LawQuiz',2,1),(44,'Contracts',43,1),(45,'Criminal',43,1),(46,'Torts',43,1),(47,'FYLS 1980 Exam',43,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

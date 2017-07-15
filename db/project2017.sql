/*
SQLyog Community Edition- MySQL GUI v6.15
MySQL - 5.5.5-10.1.21-MariaDB : Database - project2017
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `project2017`;

USE `project2017`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `definitions` */

DROP TABLE IF EXISTS `definitions`;

CREATE TABLE `definitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `definition` text,
  `example` text,
  `exception` text,
  `subject` enum('contracts','criminal','torts') DEFAULT NULL,
  `parent_id` int(1) NOT NULL DEFAULT '0',
  `ref_id` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8;

/*Data for the table `definitions` */

insert  into `definitions`(`id`,`title`,`definition`,`example`,`exception`,`subject`,`parent_id`,`ref_id`,`created`) values (1,'Intentional Torts',NULL,NULL,NULL,'torts',0,0,'2017-07-14 17:57:26'),(2,'Negligence',NULL,NULL,NULL,'torts',0,0,'2017-07-14 17:58:53'),(3,'Miscellaneous Tort Concepts',NULL,NULL,NULL,'torts',0,0,'2017-07-14 17:58:53'),(4,'Strict Liability',NULL,NULL,NULL,'torts',0,0,'2017-07-14 17:59:26'),(5,'Vicarious Liability',NULL,NULL,NULL,'torts',0,0,'2017-07-14 17:59:26'),(6,'Products Liability',NULL,NULL,NULL,'torts',0,0,'2017-07-14 18:00:14'),(7,'Crossovers',NULL,NULL,NULL,'torts',0,0,'2017-07-14 18:00:14'),(8,'Defamation',NULL,NULL,NULL,'torts',0,0,'2017-07-14 18:00:31'),(9,'Invasion of Privacy',NULL,NULL,NULL,'torts',0,0,'2017-07-14 18:00:31'),(10,'Tort Damages',NULL,NULL,NULL,'torts',0,0,'2017-07-14 18:00:46'),(11,'Intentional Torts',NULL,NULL,NULL,'torts',1,0,'2017-07-14 18:02:07'),(12,'Defenses to Intentional Torts',NULL,NULL,NULL,'torts',1,0,'2017-07-14 18:02:07'),(13,'Assault',NULL,NULL,NULL,'torts',11,0,'2017-07-14 18:02:40'),(14,'Battery',NULL,NULL,NULL,'torts',11,0,'2017-07-14 18:02:40'),(15,'False Imprisonment',NULL,NULL,NULL,'torts',11,0,'2017-07-14 18:03:14'),(16,'Intentional Infliction of Mental Distress',NULL,NULL,NULL,'torts',11,0,'2017-07-14 18:03:14'),(17,'Trespass to Land',NULL,NULL,NULL,'torts',11,0,'2017-07-14 18:03:47'),(18,'Trespass to Chattel',NULL,NULL,NULL,'torts',11,0,'2017-07-14 18:03:47'),(19,'Conversion',NULL,NULL,NULL,'torts',11,0,'2017-07-14 18:04:08'),(20,'Consent',NULL,NULL,NULL,'torts',12,0,'2017-07-14 18:04:08'),(21,'Self Defense',NULL,NULL,NULL,'torts',12,0,'2017-07-14 18:04:25'),(22,'Defense of Others',NULL,NULL,NULL,'torts',12,0,'2017-07-14 18:05:11'),(23,'Step-In-Shoes Jurisdictions',NULL,NULL,NULL,'torts',22,0,'2017-07-14 18:05:11'),(24,'Reasonable Appearances Jurisdictions',NULL,NULL,NULL,'torts',22,0,'2017-07-14 18:05:54'),(25,'Defense of Property',NULL,NULL,NULL,'torts',12,0,'2017-07-14 18:05:54'),(26,'Prevention of Crime',NULL,NULL,NULL,'torts',12,0,'2017-07-14 18:06:23'),(27,'Recapture of Property',NULL,NULL,NULL,'torts',12,0,'2017-07-14 18:06:23'),(28,'Legal Authority',NULL,NULL,NULL,'torts',12,0,'2017-07-14 18:06:46'),(29,'Necessity',NULL,NULL,NULL,'torts',12,0,'2017-07-14 18:06:46'),(30,'Re-entry Upon Land',NULL,NULL,NULL,'torts',27,0,'2017-07-14 18:07:35'),(31,'Recapture of Chattel',NULL,NULL,NULL,'torts',27,0,'2017-07-14 18:07:35'),(32,'Shopkeeper\'s Rule',NULL,NULL,NULL,'torts',27,0,'2017-07-14 18:08:26'),(33,'Public Necessity',NULL,NULL,NULL,'torts',29,0,'2017-07-14 18:08:26'),(34,'Private Necessity',NULL,NULL,NULL,'torts',29,0,'2017-07-14 18:08:44'),(35,'Duty',NULL,NULL,NULL,'torts',2,0,'2017-07-14 18:10:04'),(36,'Breach',NULL,NULL,NULL,'torts',2,0,'2017-07-14 18:10:04'),(37,'Causation',NULL,NULL,NULL,'torts',2,0,'2017-07-14 18:10:32'),(38,'Damages',NULL,NULL,NULL,'torts',2,0,'2017-07-14 18:10:32'),(39,'Defenses',NULL,NULL,NULL,'torts',2,0,'2017-07-14 18:11:12'),(40,'Multiple Defendant Issues',NULL,NULL,NULL,'torts',2,0,'2017-07-14 18:11:12'),(41,'General Duty',NULL,NULL,NULL,'torts',35,0,'2017-07-14 18:11:47'),(42,'Special Duty',NULL,NULL,NULL,'torts',35,0,'2017-07-14 18:11:47'),(43,'Direct / Circumstantial',NULL,NULL,NULL,'torts',36,0,'2017-07-14 18:12:30'),(44,'Res Ipsa Loquitur',NULL,NULL,NULL,'torts',36,0,'2017-07-14 18:12:30'),(45,'Actual Cause',NULL,NULL,NULL,'torts',37,0,'2017-07-14 18:15:15'),(46,'Proximate Cause',NULL,NULL,NULL,'torts',37,0,'2017-07-14 18:15:15'),(47,'Physical Harm Needed',NULL,NULL,NULL,'torts',38,0,'2017-07-14 18:15:42'),(48,'NIED',NULL,NULL,NULL,'torts',38,0,'2017-07-14 18:15:42'),(49,'Contributory Negligence',NULL,NULL,NULL,'torts',39,0,'2017-07-14 18:16:29'),(50,'Comparative Negligence',NULL,NULL,NULL,'torts',39,0,'2017-07-14 18:16:29'),(51,'Last Clear Chance',NULL,NULL,NULL,'torts',39,0,'2017-07-14 18:17:06'),(52,'Assumption of the Risk',NULL,NULL,NULL,'torts',39,0,'2017-07-14 18:17:06'),(53,'Joint, Concurrent, Successive',NULL,NULL,NULL,'torts',40,0,'2017-07-14 18:18:11'),(54,'Joint & Several Liability',NULL,NULL,NULL,'torts',40,0,'2017-07-14 18:18:11'),(55,'Contribution & Indemnity',NULL,NULL,NULL,'torts',40,0,'2017-07-14 18:18:28'),(56,'Negligence Per Se',NULL,NULL,NULL,'torts',42,0,'2017-07-14 18:19:15'),(57,'Cars / Auto',NULL,NULL,NULL,'torts',42,0,'2017-07-14 18:19:15'),(58,'Omission',NULL,NULL,NULL,'torts',42,0,'2017-07-14 18:19:45'),(59,'Rescuers / Samaritans',NULL,NULL,NULL,'torts',42,0,'2017-07-14 18:19:45'),(60,'Parents',NULL,NULL,NULL,'torts',42,0,'2017-07-14 18:20:14'),(61,'Landowner / Occupier',NULL,NULL,NULL,'torts',42,0,'2017-07-14 18:20:14'),(62,'Duties of Lessors',NULL,NULL,NULL,'torts',42,0,'2017-07-14 18:20:37'),(63,'\"But For\"',NULL,NULL,NULL,'torts',45,0,'2017-07-14 18:21:30'),(64,'Substantial Factor',NULL,NULL,NULL,'torts',45,0,'2017-07-14 18:21:30'),(65,'Watch the time line',NULL,NULL,NULL,'torts',46,0,'2017-07-14 18:39:43'),(66,'Direct',NULL,NULL,NULL,'torts',46,0,'2017-07-14 18:39:43'),(67,'Intervening Acts',NULL,NULL,NULL,'torts',46,0,'2017-07-14 18:39:57'),(68,'Independent',NULL,NULL,NULL,'torts',67,0,'2017-07-14 18:40:25'),(69,'Dependent',NULL,NULL,NULL,'torts',67,0,'2017-07-14 18:40:25'),(70,'Wrongful Death',NULL,NULL,NULL,'torts',3,0,'2017-07-14 18:41:03'),(71,'Survival Statutes',NULL,NULL,NULL,'torts',3,0,'2017-07-14 18:41:03'),(72,'Statute of Limitations',NULL,NULL,NULL,'torts',3,0,'2017-07-14 18:41:27'),(73,'Immunities',NULL,NULL,NULL,'torts',3,0,'2017-07-14 18:41:27'),(74,'Husband / Wife',NULL,NULL,NULL,'torts',73,0,'2017-07-14 18:42:14'),(75,'Parent / Child',NULL,NULL,NULL,'torts',73,0,'2017-07-14 18:42:14'),(76,'Charities',NULL,NULL,NULL,'torts',73,0,'2017-07-14 18:42:34'),(77,'Government',NULL,NULL,NULL,'torts',73,0,'2017-07-14 18:42:34'),(78,'Animals',NULL,NULL,NULL,'torts',4,0,'2017-07-14 18:45:21'),(79,'Abnormally Dangerous Activities',NULL,NULL,NULL,'torts',4,0,'2017-07-14 18:45:21'),(80,'Employment Relationship - Respondent Superior',NULL,NULL,NULL,'torts',5,0,'2017-07-14 18:46:02'),(81,'Independent Contractor',NULL,NULL,NULL,'torts',5,0,'2017-07-14 18:46:02'),(82,'Joint Enterprise',NULL,NULL,NULL,'torts',5,0,'2017-07-14 18:46:41'),(83,'Bailor / Bailee',NULL,NULL,NULL,'torts',5,0,'2017-07-14 18:46:41'),(84,'Vehicle Ownership',NULL,NULL,NULL,'torts',5,0,'2017-07-14 18:47:11'),(85,'Parent / Child',NULL,NULL,NULL,'torts',5,0,'2017-07-14 18:47:11'),(86,'Scope of Employment',NULL,NULL,NULL,'torts',80,0,'2017-07-14 18:47:53'),(87,'To / From Home',NULL,NULL,NULL,'torts',80,0,'2017-07-14 18:47:53'),(88,'Frolic and Detour',NULL,NULL,NULL,'torts',80,0,'2017-07-14 18:48:11'),(89,'Family Purpose Doctrine',NULL,NULL,NULL,'torts',84,0,'2017-07-14 18:48:45'),(90,'Consent Statutes',NULL,NULL,NULL,'torts',84,0,'2017-07-14 18:48:45'),(91,'General Rule',NULL,NULL,NULL,'torts',6,0,'2017-07-14 18:52:12'),(92,'Defect Type',NULL,NULL,NULL,'torts',6,0,'2017-07-14 18:52:12'),(93,'Theory',NULL,NULL,NULL,'torts',6,0,'2017-07-14 18:52:21'),(94,'Intentional (rare)',NULL,NULL,NULL,'torts',93,0,'2017-07-14 18:52:48'),(95,'Negligence',NULL,NULL,NULL,'torts',93,0,'2017-07-14 18:52:48'),(96,'Breach of Warranty',NULL,NULL,NULL,'torts',93,0,'2017-07-14 18:53:13'),(97,'Strict Liability in Tort',NULL,NULL,NULL,'torts',93,0,'2017-07-14 18:53:13'),(98,'Misrepresentation',NULL,NULL,NULL,'torts',7,0,'2017-07-14 18:53:46'),(99,'Nuisance',NULL,NULL,NULL,'torts',7,0,'2017-07-14 18:53:46'),(100,'Wrongful Litigation',NULL,NULL,NULL,'torts',7,0,'2017-07-14 18:54:12'),(101,'Business Torts',NULL,NULL,NULL,'torts',7,0,'2017-07-14 18:54:12'),(102,'Intentional: Deceit / Fraud',NULL,NULL,NULL,'torts',98,0,'2017-07-14 18:54:51'),(103,'Negligent',NULL,NULL,NULL,'torts',98,0,'2017-07-14 18:54:51'),(104,'Damages',NULL,NULL,NULL,'torts',98,0,'2017-07-14 18:55:05'),(105,'Private Nuisance',NULL,NULL,NULL,'torts',99,0,'2017-07-14 18:55:37'),(106,'Public Nuisance',NULL,NULL,NULL,'torts',99,0,'2017-07-14 18:55:37'),(107,'Malicious Prosecution',NULL,NULL,NULL,'torts',100,0,'2017-07-14 18:56:05'),(108,'Abuse of Process',NULL,NULL,NULL,'torts',100,0,'2017-07-14 18:56:05'),(109,'Disparagement',NULL,NULL,NULL,'torts',101,0,'2017-07-14 18:56:35'),(110,'Interference with Economic Relationship',NULL,NULL,NULL,'torts',101,0,'2017-07-14 18:56:35'),(111,'General Rule',NULL,NULL,NULL,'torts',8,0,'2017-07-14 18:57:01'),(112,'Slander / Slander per se',NULL,NULL,NULL,'torts',8,0,'2017-07-14 18:57:01'),(113,'Libel / Libel per se',NULL,NULL,NULL,'torts',8,0,'2017-07-14 18:57:25'),(114,'Damages',NULL,NULL,NULL,'torts',8,0,'2017-07-14 18:57:25'),(115,'Privileges',NULL,NULL,NULL,'torts',8,0,'2017-07-14 18:57:42'),(116,'Appropriation of Likeness',NULL,NULL,NULL,'torts',9,0,'2017-07-14 18:58:21'),(117,'Intrusion upon Seclusion',NULL,NULL,NULL,'torts',9,0,'2017-07-14 18:58:21'),(118,'False Light',NULL,NULL,NULL,'torts',9,0,'2017-07-14 18:58:46'),(119,'Public Disclosure of Private Facts',NULL,NULL,NULL,'torts',9,0,'2017-07-14 18:58:46'),(120,'Special Damage',NULL,NULL,NULL,'torts',10,0,'2017-07-14 18:59:44'),(121,'General Damage',NULL,NULL,NULL,'torts',10,0,'2017-07-14 18:59:44'),(122,'Punitive Damage',NULL,NULL,NULL,'torts',10,0,'2017-07-14 19:00:11'),(123,'Avoidable Consequence Rule',NULL,NULL,NULL,'torts',10,0,'2017-07-14 19:00:11'),(124,'Collateral Source Rule',NULL,NULL,NULL,'torts',10,0,'2017-07-14 19:00:28'),(125,'Formation',NULL,NULL,NULL,'criminal',0,0,'2017-07-14 19:01:18'),(126,'Inchoate Crimes',NULL,NULL,NULL,'criminal',0,0,'2017-07-14 19:01:18'),(127,'Crimes against Person',NULL,NULL,NULL,'criminal',0,0,'2017-07-14 19:01:46'),(128,'Crimes against Habitation',NULL,NULL,NULL,'criminal',0,0,'2017-07-14 19:01:46'),(129,'Crimes against Property',NULL,NULL,NULL,'criminal',0,0,'2017-07-14 19:02:25'),(130,'Crimes against Property Interests',NULL,NULL,NULL,'criminal',0,0,'2017-07-14 19:02:25'),(131,'Miscellaneous Crimes',NULL,NULL,NULL,'criminal',0,0,'2017-07-14 19:06:01'),(132,'Defenses and Justifications',NULL,NULL,NULL,'criminal',0,0,'2017-07-14 19:06:01'),(133,'Actus Reus / Mens Rea / Concurrence',NULL,NULL,NULL,'criminal',125,0,'2017-07-14 19:06:57'),(134,'Accomplice Liability',NULL,NULL,NULL,'criminal',125,0,'2017-07-14 19:06:57'),(135,'Intent',NULL,NULL,NULL,'criminal',134,0,'2017-07-14 19:07:17'),(136,'Knowledge',NULL,NULL,NULL,'criminal',134,0,'2017-07-14 19:07:17'),(137,'Active Assistance',NULL,NULL,NULL,'criminal',134,0,'2017-07-14 19:08:15'),(138,'Vicarious Liability',NULL,NULL,NULL,'criminal',125,0,'2017-07-14 19:08:30'),(139,'Solicitation',NULL,NULL,NULL,'criminal',126,0,'2017-07-14 19:09:18'),(140,'Attempt',NULL,NULL,NULL,'criminal',126,0,'2017-07-14 19:09:18'),(141,'Conspiracy',NULL,NULL,NULL,'criminal',126,0,'2017-07-14 19:09:30'),(142,'Homicide',NULL,NULL,NULL,'criminal',127,0,'2017-07-14 19:10:08'),(143,'Non-Homicide',NULL,NULL,NULL,'criminal',127,0,'2017-07-14 19:10:08'),(144,'IRAC Homicide',NULL,NULL,NULL,'criminal',142,0,'2017-07-14 19:11:58'),(145,'Causation',NULL,NULL,NULL,'criminal',142,0,'2017-07-14 19:11:58'),(146,'Murder',NULL,NULL,NULL,'criminal',142,0,'2017-07-14 19:12:34'),(147,'First Degree Murder',NULL,NULL,NULL,'criminal',142,0,'2017-07-14 19:12:34'),(148,'Second Degree Murder',NULL,NULL,NULL,'criminal',142,0,'2017-07-14 19:13:03'),(149,'Justification',NULL,NULL,NULL,'criminal',142,0,'2017-07-14 19:13:03'),(150,'Excuse (3 i\'s)',NULL,NULL,NULL,'criminal',142,0,'2017-07-14 19:13:36'),(151,'Mitigation',NULL,NULL,NULL,'criminal',142,0,'2017-07-14 19:13:36'),(152,'Involuntary Manslaughter',NULL,NULL,NULL,'criminal',142,0,'2017-07-14 19:13:55'),(153,'Assault',NULL,NULL,NULL,'criminal',143,0,'2017-07-15 13:17:23'),(154,'Battery',NULL,NULL,NULL,'criminal',143,0,'2017-07-15 13:17:35'),(155,'False Imprisonment',NULL,NULL,NULL,'criminal',143,0,'2017-07-15 13:17:47'),(156,'Kidnapping',NULL,NULL,NULL,'criminal',143,0,'2017-07-15 13:17:53'),(157,'Mayhem',NULL,NULL,NULL,'criminal',143,0,'2017-07-15 13:18:04'),(158,'Rape',NULL,NULL,NULL,'criminal',143,0,'2017-07-15 13:18:12'),(159,'Burglary',NULL,NULL,NULL,'criminal',128,0,'2017-07-15 13:18:47'),(160,'Arson',NULL,NULL,NULL,'criminal',128,0,'2017-07-15 13:18:55'),(161,'Common Law',NULL,NULL,NULL,'criminal',159,0,'2017-07-15 13:19:09'),(162,'Statutory',NULL,NULL,NULL,'criminal',159,0,'2017-07-15 13:25:45'),(163,'Larceny & Larceny by Trick',NULL,NULL,NULL,'criminal',129,0,'2017-07-15 13:26:38'),(164,'False Pretenses',NULL,NULL,NULL,'criminal',129,0,'2017-07-15 13:30:14'),(165,'Embezzlement',NULL,NULL,NULL,'criminal',129,0,'2017-07-15 13:30:23'),(166,'Robbery',NULL,NULL,NULL,'criminal',129,0,'2017-07-15 13:30:26'),(167,'Receiving Stolen Property',NULL,NULL,NULL,'criminal',129,0,'2017-07-15 13:30:38'),(168,'Forgery',NULL,NULL,NULL,'criminal',130,0,'2017-07-15 13:30:54'),(169,'Uttering',NULL,NULL,NULL,'criminal',130,0,'2017-07-15 13:30:57'),(170,'Extortion',NULL,NULL,NULL,'criminal',130,0,'2017-07-15 13:31:00'),(171,'Misprison',NULL,NULL,NULL,'criminal',131,0,'2017-07-15 13:31:16'),(172,'Compounding',NULL,NULL,NULL,'criminal',131,0,'2017-07-15 13:31:21'),(173,'Riot',NULL,NULL,NULL,'criminal',131,0,'2017-07-15 13:31:23'),(174,'Rout',NULL,NULL,NULL,'criminal',131,0,'2017-07-15 13:31:25'),(175,'Unlawful Assembly',NULL,NULL,NULL,'criminal',131,0,'2017-07-15 13:31:32'),(176,'Malicious Mischief',NULL,NULL,NULL,'criminal',131,0,'2017-07-15 13:31:42'),(177,'Breach of Peace',NULL,NULL,NULL,'criminal',131,0,'2017-07-15 13:32:54'),(178,'Defenses',NULL,NULL,NULL,'criminal',132,0,'2017-07-15 13:33:30'),(179,'Justification',NULL,NULL,NULL,'criminal',132,0,'2017-07-15 13:33:38'),(180,'Self Defense',NULL,NULL,NULL,'criminal',178,0,'2017-07-15 13:33:51'),(181,'Defense of Others',NULL,NULL,NULL,'criminal',178,0,'2017-07-15 13:33:56'),(182,'Defense of Property',NULL,NULL,NULL,'criminal',178,0,'2017-07-15 13:34:02'),(183,'Prevention of Crime',NULL,NULL,NULL,'criminal',178,0,'2017-07-15 13:34:07'),(184,'Public Authority',NULL,NULL,NULL,'criminal',178,0,'2017-07-15 13:34:12'),(185,'Domestic Authority',NULL,NULL,NULL,'criminal',178,0,'2017-07-15 13:34:19'),(186,'Necessity',NULL,NULL,NULL,'criminal',178,0,'2017-07-15 13:34:24'),(187,'Mistake of Law',NULL,NULL,NULL,'criminal',179,0,'2017-07-15 13:34:41'),(188,'Mistake of Fact',NULL,NULL,NULL,'criminal',179,0,'2017-07-15 13:34:47'),(189,'Consent',NULL,NULL,NULL,'criminal',179,0,'2017-07-15 13:34:50'),(190,'Duress',NULL,NULL,NULL,'criminal',179,0,'2017-07-15 13:34:55'),(191,'Entrapment',NULL,NULL,NULL,'criminal',179,0,'2017-07-15 13:34:57'),(192,'Formation',NULL,NULL,NULL,'contracts',0,0,'2017-07-15 14:40:54'),(193,'Third Party Rights',NULL,NULL,NULL,'contracts',0,0,'2017-07-15 14:45:16'),(194,'Conditions to Performance',NULL,NULL,NULL,'contracts',0,0,'2017-07-15 14:45:31'),(195,'Discharge of Defendant\'s Duty to Perform',NULL,NULL,NULL,'contracts',0,0,'2017-07-15 14:45:46'),(196,'Breach',NULL,NULL,NULL,'contracts',0,0,'2017-07-15 14:45:51'),(197,'Remedies',NULL,NULL,NULL,'contracts',0,0,'2017-07-15 14:45:53');

/*Table structure for table `hm_categories` */

DROP TABLE IF EXISTS `hm_categories`;

CREATE TABLE `hm_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `hm_categories` */

insert  into `hm_categories`(`cat_id`,`category`,`parent_id`,`user_id`) values (1,'Home',0,1),(2,'Hall',1,1),(3,'TV',2,1),(4,'Big Sofa',2,1),(5,'Small Sofa',2,1),(6,'Attached Table',2,1),(7,'Referigerator',2,1);

/*Table structure for table `lr_reminders` */

DROP TABLE IF EXISTS `lr_reminders`;

CREATE TABLE `lr_reminders` (
  `reminder_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `emailTo` varchar(150) DEFAULT NULL,
  `message` text,
  `fileLink` text,
  `status` int(1) NOT NULL DEFAULT '1',
  `reminder_created_dt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reminder_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `lr_reminders` */

insert  into `lr_reminders`(`reminder_id`,`user_id`,`title`,`emailTo`,`message`,`fileLink`,`status`,`reminder_created_dt`) values (1,1,'Reminder For My Son','son@mkgalaxy.com','hello son, how r u',NULL,1,'2017-06-30 06:38:35'),(2,1,'Reminder For My Mom','mom@mkgalaxy.com','hello mom, how r u',NULL,1,'2017-06-30 06:39:17'),(3,1,'My Friend','friend1@mkgalaxy.com','hello friend1, how r u','http://google.com',0,'2017-06-30 06:39:32'),(4,2,'For My Friend A','friendA@mkgalaxy.com','hi friend A, how are you',NULL,1,'2017-06-30 06:40:19'),(5,2,'For My Friend B','friendB@mkgalaxy.com','hi friend B, how are you',NULL,1,'2017-06-30 06:40:50'),(6,1,'Test 1','test@mkgalaxy.com','test','test',1,'2017-07-03 21:59:29');

/*Table structure for table `lr_users` */

DROP TABLE IF EXISTS `lr_users`;

CREATE TABLE `lr_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `birth_year` int(4) DEFAULT NULL,
  `created_dt` timestamp NULL DEFAULT NULL,
  `login_dt` bigint(20) DEFAULT NULL,
  `emailFlag1` int(1) NOT NULL DEFAULT '0',
  `emailFlag1Date` bigint(20) DEFAULT NULL,
  `cronFlag` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `lr_users` */

insert  into `lr_users`(`user_id`,`email`,`password`,`first_name`,`last_name`,`gender`,`birth_year`,`created_dt`,`login_dt`,`emailFlag1`,`emailFlag1Date`,`cronFlag`) values (1,'manny@mkgalaxy.com','1234','Manish','Khanchandani','male',1974,'2017-06-30 06:35:03',1391369252,1,1499317108,1),(2,'carrie@mkgalaxy.com','password','Carrie','P','female',1970,'2017-06-30 06:35:03',1291369252,1,1499317108,1),(3,'kate@mkgalaxy.com','password','Kate','L','female',1986,'2017-06-30 06:35:03',1191369252,1,1499317108,1);

/*Table structure for table `qz_categories` */

DROP TABLE IF EXISTS `qz_categories`;

CREATE TABLE `qz_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `qz_categories` */

insert  into `qz_categories`(`cat_id`,`category`,`parent_id`,`user_id`) values (1,'Law',0,1),(2,'First Year',1,1),(3,'Contracts',2,1),(4,'Criminal Law',2,1),(5,'Torts Law',2,1),(6,'Web Development',0,1),(7,'Javascript',6,1),(8,'Legal Writings',2,1),(9,'Set 1',3,1),(13,'Definition 1',3,1);

/*Table structure for table `qz_questions` */

DROP TABLE IF EXISTS `qz_questions`;

CREATE TABLE `qz_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `question` text,
  `explanation` text,
  `quiz_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1',
  `answers` text,
  `correct` int(1) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `qz_questions` */

insert  into `qz_questions`(`id`,`user_id`,`category_id`,`question`,`explanation`,`quiz_dt`,`status`,`answers`,`correct`,`topic`) values (1,1,9,'A distributor of stereo equipment phones a merchant-customer and agrees that it will sell 1,200 stereo systems to that merchant-customer for $500 each - if delivery can be made before August 1. The merchant-customer states that he will think about it. The merchant-customer then sends a confirmation form to the distributor, signed by the merchant-customer, stating the price of goods and the quantity of the stereo systems. The distributor receives this form on July 1. On July 16, the distributor informs the merchant-customer that it will not perform, due to an increase in production costs. The merchant-customer sues the distributor for breach of contract. Which of the following statements are most correct?','D is the correct answer. A written letter of confirmation, sent by a merchant withing a reasonable time after the oral contract is made, will satisfy the Statute of Frauds if the receiving party is a merchant and does not object to the contents thereof within 10 days after receipt. Here, the merchant-customer is a merchant, and he signed the confirmation letter. Furthermore, the distributor received the signed confirmation on July 1, and the closest it came to objecting was when it informed the merchant-customer that it would not perform, but this did not occur until July 16, which is more than ten days later.','2017-07-02 10:15:16',1,'[\"Given the above facts, the Parol Evidence Rule is applicable, and the merchant-customer would win\",\"If distributor asserts the statue of Frauds as a defense, the distributor would win\",\"The statue of Frauds requires that the merchant-customer should have signed a written contract with the distributor.\",\"If the distributor asserts the Statute of Frauds, it will probably be unsuccessful.\"]',3,'Statue of Frauds (Written Confirmation Between Merchants)'),(2,1,9,'A woman had been working for a company for a long time. When she was ready to retire, her boss promised to pay her $500 a month for the rest of her life, in appreciation for her years of service. The woman exclaimed, \"Thank you, this is the biggest surprise I\'ve ever gotten!\" The women knew that the company did not have a retirement plan for any of its employees. \r\n\r\nWhat was the legal effect, if any, of the woman\'s statement after hearing the promise of lifetime income?','D is the correct answer. There was no legal effect as to the woman\'s exclamation because there was no binding contract here. A binding contract requires, there to have been an offer, acceptance, and consideration. Here, the boss\' statement that he would pay the woman $500 a month for the rest of her life could be considered a valid offer because it indicated an intent to be bound, had definite and certain terms, and was communicated to the woman. However, the woman\'s response (\"Thank you, this is the biggest surprise I have ever gotten!\") is not a mirror-image acceptance of the offer, as required by the common law. In addition, there was no consideration because the woman did not take on a legal detriment in exchange for the lifetime income. Her past services to the company do not constitute consideration because past services are not valid consideration.','2017-07-02 10:35:38',1,'[\"There was a valid and binding acceptance by the woman.\",\"At the moment of the statement, there was an objective meeting of the minds.\",\"It created acceptance, only if the woman expressly promised not to be self-indulgent with the funds.\",\"It has no binding legal effect.\"]',3,'Offer - Meeting of the Minds'),(3,1,9,'A charitable boy picked up trash at the beach one weekend. His neighbor found out what the body had done and promised to give the boy $100 on his birthday for his charitable work picking up the trash. The boy\'s birthday arrived, but the neighbor did not pay him. The boy sued the neighbor.\r\n\r\nWhat will be the most likely outcome?','D is the correct answer. The boy will not recover because he encountered no legal detriment. His charitable work at the beach was done before the neighbor made the promise and could, thus, not be considered a legal detriment in reliance on the neighbor\'s promise.','2017-07-02 10:50:41',1,'[\"The boy will recover because the neighbor made a legally enforceable gratuitous promise.\",\"The boy will recover because the neighbor had a moral obligation to pay him.\",\"The boy will recover under a promissory estoppel theory.\",\"The boy will not recover.\"]',3,'Consideration - Bargained For Exchange');

/*Table structure for table `qz_results` */

DROP TABLE IF EXISTS `qz_results`;

CREATE TABLE `qz_results` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_question` int(11) DEFAULT NULL,
  `correct_results` int(11) DEFAULT NULL,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `results` text,
  `wrong_results` int(11) DEFAULT NULL,
  `calc_percentage` double DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `qz_results` */

insert  into `qz_results`(`cid`,`category_id`,`user_id`,`total_question`,`correct_results`,`cdate`,`results`,`wrong_results`,`calc_percentage`) values (8,9,1,3,3,'2017-07-02 18:34:47','{\"1\":\"3\",\"2\":\"3\",\"3\":\"3\"}',0,100);

/*Table structure for table `qz_users` */

DROP TABLE IF EXISTS `qz_users`;

CREATE TABLE `qz_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `created_dt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `qz_users` */

insert  into `qz_users`(`user_id`,`email`,`password`,`first_name`,`created_dt`) values (1,'manishkk74@gmail.com','password','Manish','2017-07-01 10:10:10'),(2,'abc@mkgalaxy.com','password','Manish','2017-07-02 09:36:05');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

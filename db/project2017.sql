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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `lr_reminders` */

insert  into `lr_reminders`(`reminder_id`,`user_id`,`title`,`emailTo`,`message`,`fileLink`,`status`,`reminder_created_dt`) values (1,1,'Reminder For My Son','son@mkgalaxy.com','hello son, how r u',NULL,1,'2017-06-30 06:38:35'),(2,1,'Reminder For My Mom','mom@mkgalaxy.com','hello mom, how r u',NULL,1,'2017-06-30 06:39:17'),(3,1,'My Friend','friend1@mkgalaxy.com','hello friend1, how r u','http://google.com',0,'2017-06-30 06:39:32'),(4,2,'For My Friend A','friendA@mkgalaxy.com','hi friend A, how are you',NULL,1,'2017-06-30 06:40:19'),(5,2,'For My Friend B','friendB@mkgalaxy.com','hi friend B, how are you',NULL,1,'2017-06-30 06:40:50');

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

insert  into `lr_users`(`user_id`,`email`,`password`,`first_name`,`last_name`,`gender`,`birth_year`,`created_dt`,`login_dt`,`emailFlag1`,`emailFlag1Date`,`cronFlag`) values (1,'manny@mkgalaxy.com','password','Manish','Khanchandani','male',1974,'2017-06-30 06:35:03',1498886393,0,NULL,0),(2,'carrie@mkgalaxy.com','password','Carrie','P','female',1970,'2017-06-30 06:35:03',1498797303,0,NULL,0),(3,'kate@mkgalaxy.com','password','Kate','L','female',1986,'2017-06-30 06:35:03',1498797303,0,NULL,0);

/*Table structure for table `qz_categories` */

DROP TABLE IF EXISTS `qz_categories`;

CREATE TABLE `qz_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `qz_categories` */

insert  into `qz_categories`(`cat_id`,`category`,`parent_id`,`user_id`) values (1,'Law',0,1),(2,'First Year',1,1),(3,'Contracts',2,1),(4,'Criminal Law',2,1),(5,'Torts Law',2,1),(6,'Web Development',0,1),(7,'Javascript',6,1),(8,'Legal Writings',2,1),(9,'Set 1',3,1);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `qz_questions` */

insert  into `qz_questions`(`id`,`user_id`,`category_id`,`question`,`explanation`,`quiz_dt`,`status`,`answers`,`correct`) values (2,1,9,'first','dkfdkfj','2017-07-01 17:41:51',1,'[\"a\",\"b\",\"c\",\"d\"]',3),(4,1,9,'test2','dfd','2017-07-01 22:54:05',1,'[\"a\",\"v\",\"c\",\"dfd\"]',3);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `qz_results` */

insert  into `qz_results`(`cid`,`category_id`,`user_id`,`total_question`,`correct_results`,`cdate`,`results`,`wrong_results`,`calc_percentage`) values (1,9,1,2,1,'2017-07-02 08:21:45','{\"2\":\"1\",\"4\":\"3\"}',1,NULL),(2,9,1,2,1,'2017-07-02 08:28:32','{\"4\":\"3\",\"2\":\"1\"}',1,50),(3,9,1,2,1,'2017-07-02 08:28:52','{\"4\":\"3\",\"2\":\"1\"}',1,50),(4,9,1,2,0,'2017-07-02 08:50:53','{\"2\":\"2\",\"4\":\"1\"}',2,0),(5,9,1,2,2,'2017-07-02 08:50:59','{\"4\":\"3\",\"2\":\"3\"}',0,100);

/*Table structure for table `qz_users` */

DROP TABLE IF EXISTS `qz_users`;

CREATE TABLE `qz_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `created_dt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `qz_users` */

insert  into `qz_users`(`user_id`,`email`,`password`,`first_name`,`created_dt`) values (1,'abc@mkgalaxy.com','password','Manish','2017-07-01 10:10:10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

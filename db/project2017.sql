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

insert  into `lr_reminders`(`reminder_id`,`user_id`,`title`,`emailTo`,`message`,`fileLink`,`status`,`reminder_created_dt`) values (1,1,'Reminder For My Son','son@mkgalaxy.com','hello son, how r u',NULL,1,'2017-06-30 06:38:35'),(2,1,'Reminder For My Mom','mom@mkgalaxy.com','hello mom, how r u',NULL,1,'2017-06-30 06:39:17'),(3,1,'Reminder For My Friend','friend@mkgalaxy.com','hello friend, how r u',NULL,1,'2017-06-30 06:39:32'),(4,2,'For My Friend A','friendA@mkgalaxy.com','hi friend A, how are you',NULL,1,'2017-06-30 06:40:19'),(5,2,'For My Friend B','friendB@mkgalaxy.com','hi friend B, how are you',NULL,1,'2017-06-30 06:40:50');

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

insert  into `lr_users`(`user_id`,`email`,`password`,`first_name`,`last_name`,`gender`,`birth_year`,`created_dt`,`login_dt`,`emailFlag1`,`emailFlag1Date`,`cronFlag`) values (1,'manny@mkgalaxy.com','password','Manish','Khanchandani','male',1974,'2017-06-30 06:35:03',1498797303,0,NULL,0),(2,'carrie@mkgalaxy.com','password','Carrie','P','female',1970,'2017-06-30 06:35:03',1498797303,0,NULL,0),(3,'kate@mkgalaxy.com','password','Kate','L','female',1986,'2017-06-30 06:35:03',1498797303,0,NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

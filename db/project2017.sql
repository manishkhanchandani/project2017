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

insert  into `lr_users`(`user_id`,`email`,`password`,`first_name`,`last_name`,`gender`,`birth_year`,`created_dt`,`login_dt`,`emailFlag1`,`emailFlag1Date`,`cronFlag`) values (1,'manny@mkgalaxy.com','password','Manish','Khanchandani','male',1974,'2017-06-30 06:35:03',1391369252,1,1499317108,1),(2,'carrie@mkgalaxy.com','password','Carrie','P','female',1970,'2017-06-30 06:35:03',1291369252,1,1499317108,1),(3,'kate@mkgalaxy.com','password','Kate','L','female',1986,'2017-06-30 06:35:03',1191369252,1,1499317108,1);

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

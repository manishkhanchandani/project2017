/*
SQLyog Community Edition- MySQL GUI v6.15
MySQL - 5.5.5-10.1.21-MariaDB : Database - project100
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `project100`;

USE `project100`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `ce_category` */

DROP TABLE IF EXISTS `ce_category`;

CREATE TABLE `ce_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ce_category` */

/*Table structure for table `ce_cities` */

DROP TABLE IF EXISTS `ce_cities`;

CREATE TABLE `ce_cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(200) DEFAULT NULL,
  `state_name` varchar(50) DEFAULT NULL,
  `country_name` varchar(50) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `created_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `city_lat` double DEFAULT NULL,
  `city_lng` double DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ce_cities` */

/*Table structure for table `ce_product_categories` */

DROP TABLE IF EXISTS `ce_product_categories`;

CREATE TABLE `ce_product_categories` (
  `product_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ce_product_categories` */

/*Table structure for table `ce_products` */

DROP TABLE IF EXISTS `ce_products`;

CREATE TABLE `ce_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` text,
  `product_description` text,
  `product_images` text,
  `product_videos` text,
  `product_pdfs` text,
  `product_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_manufacture` int(11) DEFAULT NULL,
  `product_number` varchar(255) DEFAULT NULL,
  `product_xtras` text,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ce_products` */

/*Table structure for table `ce_store_products` */

DROP TABLE IF EXISTS `ce_store_products`;

CREATE TABLE `ce_store_products` (
  `store_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price_regular` double DEFAULT NULL,
  `price_discounted` double DEFAULT NULL,
  `shipping` double DEFAULT NULL,
  `stock` double DEFAULT NULL,
  `product_status` int(1) NOT NULL DEFAULT '1',
  `city_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`store_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ce_store_products` */

/*Table structure for table `dating_profiles` */

DROP TABLE IF EXISTS `dating_profiles`;

CREATE TABLE `dating_profiles` (
  `dating_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `display_dating_name` varchar(50) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `birth_year` int(4) DEFAULT NULL,
  `birth_month` int(2) DEFAULT NULL,
  `birth_day` int(2) DEFAULT NULL,
  `birth_hour` int(2) DEFAULT NULL,
  `birth_minute` int(2) DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `marital_status` enum('single','divorced','separated','widowed','married') DEFAULT NULL,
  `description` text,
  `display_images` text,
  `hobbies` text,
  `dating_city` varchar(25) DEFAULT NULL,
  `dating_state` varchar(25) DEFAULT NULL,
  `dating_country` varchar(25) DEFAULT NULL,
  `dating_lat` double DEFAULT NULL,
  `dating_lng` double DEFAULT NULL,
  `dating_created_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `birth_lat` double DEFAULT NULL,
  `birth_lng` double DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dating_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `dating_profiles` */

/*Table structure for table `jobs_applied` */

DROP TABLE IF EXISTS `jobs_applied`;

CREATE TABLE `jobs_applied` (
  `applied_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) DEFAULT NULL,
  `applied_user_id` int(11) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `cover_letter` varchar(255) DEFAULT NULL,
  `applied_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`applied_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jobs_applied` */

/*Table structure for table `jobs_posting` */

DROP TABLE IF EXISTS `jobs_posting`;

CREATE TABLE `jobs_posting` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_user_id` int(11) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `job_description` text,
  `job_type` enum('full_time','part_time','contract') DEFAULT NULL,
  `job_salary` varchar(255) DEFAULT NULL,
  `job_telecommute` int(1) DEFAULT '0',
  `job_posting_id` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `job_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `job_status` int(1) DEFAULT '1',
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jobs_posting` */

/*Table structure for table `jobs_skills` */

DROP TABLE IF EXISTS `jobs_skills`;

CREATE TABLE `jobs_skills` (
  `skill_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) DEFAULT NULL,
  `skills` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jobs_skills` */

/*Table structure for table `law_essay_issues` */

DROP TABLE IF EXISTS `law_essay_issues`;

CREATE TABLE `law_essay_issues` (
  `essay_issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `issue_id` int(11) DEFAULT NULL,
  `comments` text,
  `sorting` int(11) NOT NULL DEFAULT '0',
  `essay_id` int(11) DEFAULT NULL,
  `statementHint` text,
  PRIMARY KEY (`essay_issue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `law_essay_issues` */

insert  into `law_essay_issues`(`essay_issue_id`,`user_id`,`issue_id`,`comments`,`sorting`,`essay_id`,`statementHint`) values (1,1,105,'BOB v. AL\r\n\r\nThe rights and remedies of the parties here depend on whether there was a valid contract.  A CONTRACT is a promise or set of promises the performance of which the law will recognize as a duty and for the breach of which the law will provide a remedy.\r\n\r\n1. UCC?\r\n\r\nArticle 2 of the UCC governs contracts for the sale of GOODS, movable things at the time of identification to the contract.\r\n\r\nHere the contract is for sale of a movable thing because it was for sale of a \"tuxedo\".\r\n\r\nTherefore this was a contract for a sale of goods and the UCC governs.',1,4,'sale of tuxedo'),(2,1,106,'MERCHANTS?\r\n\r\nUnder the UCC MERCHANTS are people who deal in the goods or hold themselves out by occupation as knowledgeable about the goods in a contract.\r\n\r\nHere Bob deals in tuxedos because he has a clothing store. Al may have \"bought a lot of clothes\" but there is no evidence he deals in tuxedos or hold himself out by occupation as being particularly knowledgeable about them.\r\n\r\nTherefore Bob is a merchant and Al is not.',2,4,'Al had bought a lot of clothes over the years. One day he called tailor Bob'),(3,1,107,'Is a WRITING NEEDED?\r\n\r\nUnder UCC 2-201 a contract for the sale of GOODS over $500 requires a writing. This limit is being raised to $5,000 but many States are still using the $500 limit. Under the UCC a contract between MERCHANTS may satisfy the need for a writing against both parties if there is a sales confirmation indicating the quantity sent to one party by the other and the receiving party does not object to the representation of a contract.\r\n\r\nFurther, under the UCC there is no need for a writing if goods are custom made, the person to be bound acknowledges the contract in a legal setting or where a party has accepted payment or goods.\r\n\r\nHere the goods are over $500 because the tuxedo costs \"$519.95\" and Al is not a merchant as shown above.\r\n\r\nFurther, this was a \"ready-made\" tuxedo, not custom made, and Al never acknowledged the contract in a legal setting or accepted the goods.\r\n\r\nTherefore a writing signed by Al is needed if the contract is to be enforced against him by Bob.',3,4,NULL),(4,1,108,'Did Bob OFFER to sell the tuxedo?\r\n\r\nUnder contract law an OFFER is a manifestation of present contractual intent communicated to the offeree that is so specific observer would reasonably believe assent would form a bargain.\r\n\r\nHere Bob manifested an intent to sell a tuxedo because he \"suggested Al buy\" the tuxedo. And a reasonable person would believe assent to this communication would form a bargain.\r\n\r\nTherefore, Bob made an offer.',4,4,NULL),(5,1,121,'<p><b>Attempt, Homicide, Res Gestae, Depraved Heart</b></p><p>STATE V. TOM</p><p>1. CONSPIRACY? Under common</p><p>Under common law, a CONSPIRACY is an <b>agreement</b> between<b> two or more people</b> to work toward an<b> illegal goal</b>. Modernly an overt step toward the criminal goal is often required. Conspiracy does not merge into ultimate crime.</p><p>Here there was an implied <b>agreement</b> between Tom and Dick, two people, for an<b> illegal goal </b>because they \"burst\" into the store together and \"wanted to rob\" the store. They committed an <b>overt step</b> toward their goal because of this.</p><p>Therefore Tom can be charged with conspiracy.</p>',1,10,'                                                            '),(6,1,132,'<p>2. ATTEMPTED ROBBERY?</p><p>Under criminal law an ATTEMPTED ROBBERY is committed with there is a <b>SUBSTANTIAL STEP</b> taken toward committing a robbery. A robbery is a LARCENY, a <b>trespassory taking of personal property</b> with an<b> intent to permanently deprive</b>, from a <b>person by force or fear </b>overcoming the will of the victom to resist.</p><p>Here Tom took a <b>SUBSTANTIAL STEP</b> toward completing the robbery because he went to the store \"with a gun\" and \"burst\" through&nbsp;the door. And his goal was the crime of robbery because he \"wanted to rob\" the store.</p><p>Therefore, Tom can be charged with attempted robbery.</p>',2,10,'                    '),(7,1,143,'<p>3. DEFENSE OF MISTAKE OF FACT?</p><p>Under criminal law a mistake of fact is a valid defense if it NEGATES IMPLIED CRIMINAL INTENT. Attempt is a <b>SPECIFIC INTENT</b> crime, so any mistake of fact that negates criminal intent is a valid defense.</p><p>Here Tom made a mistake because he thought the store was open for business, but that mistake does not negate intent because he \"wanted to rob\" the store.</p><p>Therefore, Tom\'s mistake of fact does not negate his criminal intent, and his defense argument fails.</p>',3,10,'                              '),(8,1,130,'4. BURGLARY?',4,10,'          '),(9,1,126,NULL,5,10,NULL),(10,1,133,NULL,6,10,NULL),(11,1,136,NULL,7,10,NULL),(12,1,133,NULL,8,10,NULL),(14,1,160,NULL,9,10,NULL),(15,1,133,'10. MURDER of Victor?',10,10,'          '),(16,1,121,'1. CONSPIRACY?',1,11,NULL),(17,1,157,'2. EFFECTIVELY WITHDRAW from the conspiracy?',2,11,NULL),(18,1,138,'3. KIDNAPPING?',3,11,NULL),(19,1,124,'4. RAPE under a theory of ACCOMPLICE LIABILITY?',4,11,NULL),(20,1,133,'5. MURDER of Millie?',5,11,NULL),(21,1,133,'6. MURDER of Louie?',6,11,NULL),(22,1,133,'1. MURDER?',1,12,NULL),(23,1,136,'2. INVOLUNTARY MANSLAUGHTER?',2,12,NULL),(24,1,154,'3. SELF-DEFENSE?',3,12,NULL),(25,1,148,'4. INSANITY?',4,12,NULL),(26,1,125,NULL,1,13,NULL),(27,1,126,NULL,2,13,NULL),(28,1,128,NULL,3,13,NULL),(29,1,128,NULL,4,13,NULL),(30,1,126,'5. LARCENY of $20 BY TRICK?',5,13,NULL),(31,1,126,NULL,1,14,NULL),(32,1,129,NULL,2,14,NULL),(33,1,132,NULL,3,14,NULL),(34,1,143,NULL,4,14,NULL),(35,1,145,NULL,5,14,NULL),(36,1,133,NULL,1,15,NULL),(37,1,133,NULL,2,15,NULL),(38,1,135,NULL,3,15,NULL),(39,1,133,NULL,4,15,NULL),(40,1,133,NULL,5,15,'          ');

/*Table structure for table `law_essays` */

DROP TABLE IF EXISTS `law_essays`;

CREATE TABLE `law_essays` (
  `essay_id` int(11) NOT NULL AUTO_INCREMENT,
  `essay` text,
  `month_year` varchar(200) DEFAULT NULL,
  `created_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `subject` enum('contracts','torts','criminal') DEFAULT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`essay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `law_essays` */

insert  into `law_essays`(`essay_id`,`essay`,`month_year`,`created_dt`,`user_id`,`subject`,`deleted`) values (1,'Dealer operates an antique shop. While traveling, she buys a Union cavalry officerâ€™s handgun for $1,500 from Seller. Dealer takes several photos of the handgun and Seller agrees to ship it to Dealerâ€™s shop. When Dealer arrives home, she immediately shows the photos of the handgun to Buyer. The parties shake hands on a deal to sell the handgun to Buyer for $2,000, payment upon delivery. \r\n\r\nThe next day, Buyer regrets agreeing to the deal without first having an opportunity to actually examine the handgun. Buyer tells Dealer that he will not pay the $2,000 unless she first allows him to have the handgun examined by an expert appraiser. Dealer becomes angry and tells Buyer, â€œA dealâ€™s a deal. Iâ€™ll expect my money when the handgun is delivered to you.â€ \r\n\r\nWhen the handgun arrives at Dealerâ€™s shop, she does some internet research and discovers that the handgun was issued to a general who played a prominent role at the Battle of Gettysburg, which increases the value of the handgun by a factor of ten. The next day, Dealer receives a letter from Buyer stating, â€œSorry. Youâ€™re right. A dealâ€™s a deal.â€ The envelope contains a check for $2,000. Dealer sends the check back to Buyer with a note stating, â€œBuyer: Because you backed out of our deal, I will not sell you the handgun. //Signed// Dealer.â€ \r\n\r\nA few weeks later, Buyer learns that Dealer is offering the handgun for sale at her shop for $20,000 because of its connection to the Civil War general. Buyer brings suit against Dealer for breach of contract, requesting specific performance. \r\n\r\n1. Is Buyer likely to prevail against Dealer in his suit for breach of contract? Discuss. \r\n\r\n2. If so, is the court likely to grant Buyerâ€™s request for specific performance? Discuss ','October 2016','2017-09-02 19:58:51',1,'contracts',0),(2,'Owner wants to turn her warehouse into a restaurant. She decides to install an innovative solar heating system, which Contractor agrees to install at a cost of $50,000. Contractorâ€™s son (â€œSonâ€) wants to use two parking spaces in the warehouse parking lot for his (Sonâ€™s) business. If Owner agrees to designate two parking spaces for Sonâ€™s use for five years, Contractor will drop the price to $35,000. \r\n\r\nOn November 13th, the parties agree to the latter arrangement in a valid written contract in which Contractor promises to start the job on November 17th and to complete it by January 1st. The contract includes a recital stating, â€œTimely performance by Contractor is important to avoid any delay in the opening of Ownerâ€™s restaurant.â€ \r\n\r\nState law requires that all installations of the new solar systems be done by a certified solar technician. On November 15th, the only certified technician who works for Contractor, Tech, is injured in a car accident. Contractor immediately notifies Owner and advises her that the start of the work will be delayed because of Techâ€™s accident. Owner replies, â€œYou know that on-time performance is crucial. Yesterday, the city announced special tax breaks for businesses that open by the end of the year. Can you still finish by then?â€ Contractor says, â€œI donâ€™t know when we can start. It depends on how quickly Tech recovers.â€ Owner tells Contractor that she is terminating the contract. \r\n\r\nOwner finds an alternative supplier of a similar system at a cost of $60,000, but he canâ€™t start work immediately and the restaurant opens in February of the following year. Owner misses the deadline for the city tax break. \r\n\r\nOwner sues Contractor for breach of contract. Son sues Owner for breach of contract, seeking damages for Ownerâ€™s failure to provide the two parking spaces. \r\n\r\n1. Can Owner prevail in her lawsuit against Contractor? Discuss. \r\n\r\n2. If so, can Owner recover \r\n\r\na. The $10,000 in increased costs for the heating system? Discuss. \r\nb. The lost profits for the delay in opening the restaurant? Discuss. \r\nc. The value of the tax reduction? Discuss. \r\n\r\n3. Can Son prevail in his lawsuit against Owner? Discuss. ','October 2016','2017-09-02 19:58:57',1,'contracts',0),(3,'Lucy owned a rent house. She advertised in the newspaper to find a renter, citing rent of $700 a month. \r\n\r\nHomer saw the ad and called Lucy at 9:00 a.m. Homer said, â€œ\"I saw your ad and accept your offer! I will be right there to pay you. I have to see the house, but would you consider $550?â€ \r\n\r\nLucy said, â€œIt\'s a deal. I will rent to you for $550. This is a firm offer.â€ Homer said he would be there in one hour to see the house. \r\n\r\nHomer went 100 miles an hour to see the house, sideswiping Victoria. Victoria crashed and died along with her 7-month fetus. \r\n\r\nAt 3:00 p.m. Homer arrived, five hours late, ran up to Lucy and said, â€œI unequivocally accept. Here is my $550.â€ \r\n\r\nLucy said, â€œI have decided not to rent to you.â€ Discuss the rights of Homer and Lucy\'s defenses. ','Sample Essay 1 lawtutor.org','2017-09-02 20:21:05',1,'contracts',0),(4,'Al had bought a lot of clothes over the years. One day he called tailor Bob and asked him to custom make him a tuxedo to wear to the wedding of his daughter Carla the next Sunday. \r\n\r\nBob told Al that he could not make a tuxedo so fast and suggested instead that Al buy a ready- made tuxedo that he had in stock in exactly Al\'s size. Al agreed and said he would be in to pick it up later that week. Price was not discussed. \r\n\r\nBob sent Al a note several days later stating, \"This is to confirm your order to purchase the tuxedo. The price is normally $750, but for you the price is only $519.95.\" \r\n\r\nAl was shocked at the price, but it was too late for him to get a tuxedo anywhere else on such short notice. He felt he had been taken advantage of, but there was nothing he could do. \r\n\r\nAl came in and tried the tuxedo on the day before the wedding and it did not fit. Bob assured him not to worry. He would take it in. Al nodded. \r\n\r\nBob took in the pants and sent Al a note that said, \"I took in the pants and it should fit you like a glove. With alterations the price is now $750. \r\n\r\nAl was furious. \r\n\r\nCarla\'s wedding was suddenly called off. Al never called Bob and never went to get the tuxedo. Bob was furious. \r\n\r\nDoes Bob have a right to be paid for the tuxedo? What are Al\'s defenses? ','Sample Essay 2 lawtutor.org','2017-09-02 20:21:26',1,'contracts',0),(5,'Groucho entered into a contract with new car dealer Harpo to buy a new Dodge for his brother Chico on his birthday. The agreed sales price was $25,000. Harpo promised the new car would be delivered by Chico\'s birthday within two weeks. Chico was ecstatic. Groucho made a down payment of $2,000 and promised to pay an additional amount of $23,000 for the car over a five- year period. \r\n\r\nHarpo made a deal with another dealer, Swifty. Swifty agreed to deliver a Dodge of the type specified on time for Chico\'s birthday in exchange for an immediate payment of $20,000. \r\n\r\nSwifty became insolvent, its inventory was seized and it did not deliver the Dodge. Harpo blames Swifty.\r\nChico was upset he didn\'t get the car he expected.\r\nWhat are the rights, remedies and defenses of Groucho, Harpo, Chico and Swifty? ','Sample Essay 3 lawtutor.org','2017-09-02 20:21:41',1,'contracts',0),(6,'When Al was in high school he wrote and copyrighted a rap song called \"Dumb and Dead.\" He submitted his song to talent agent Tom. On January 1, two days before his seventeenth birthday, he and Tom reached a valid oral agreement that Tom could have exclusive recording rights until Al was 18 years old. Tom was to receive 25 percent of \"sales.\" \r\n\r\nTom sent Al a signed, written \"sales confirmation\" of their agreement that gave all of the details of the agreement. The memo pointed out that records are \"goods\" under the UCC. After this Al performed completely under the terms of the agreement. \r\n\r\nTom pitched Al\'s song to Deccra Records telling them Al was 19 years old, an adult. Following negotiations by Tom, Deccra and Al signed a written agreement on March 1 that Al would receive 50 percent of gross record sales over the next three years. Deccra was aware that Tom would receive a portion of this money under his contract with Al. \r\n\r\nBefore Deccra paid anything it discovered Al was only 17. A Deccra executive secretly met with Al and told him the company would not stand by its first agreement, and an alternative agreement was proposed that would benefit both parties. Al agreed on April 1 to a new arrangement under which he got 40 percent of gross record sales, Deccra got 60 percent and Tom was cut completely out. \r\n\r\nThe song went straight to the top of the charts and Deccra\'s sales were $1.6 million in the next year. Of this amount Deccra paid Al $640,000, 40 percent of gross sales. Deccra\'s distribution expenses were $360,000, and it made profits of $600,000. Tom got nothing. \r\n\r\nTom got a lawyer and sued both Al and Deccra. \r\n\r\nAl also went to a lawyer. Six months after becoming an adult on his eighteenth birthday he sued Deccra claiming he was a minor when the contract was signed. He demanded return of all remaining revenues, $960,000. \r\n\r\n1) Was the contract of January 1 unenforceable by Tom because it was oral? \r\n\r\n\r\n\r\n2) Was the contract of January 1 enforceable against Tom by Al? \r\n\r\n\r\n\r\n3) Was the contract of March 1 enforceable by Al against Deccra? \r\n\r\n\r\n\r\n4) Was the contract of April 1 enforceable by Deccra against Al? \r\n\r\n\r\n\r\n5) If the contract of April 1 is legally unenforceable by Deccra, what equitable argument might it make? ','Sample Essay 4 lawtutor.org','2017-09-02 20:22:02',1,'contracts',0),(7,'Homeowner Homer orally agreed with builder Bill that he would pay Bill $100,000 to have a custom built home erected on the land that Homer already owned. They agreed the home was to be done before the winter rains set in. \r\n\r\nWhen Bill was half done building, he discovered he had terminal cancer and would only live a few weeks. \r\n\r\nBill told Homer his medical expenses were so high he needed $30,000 more in order to hire a helper or it would be impossible for him to finish the home in time. Homer offered to pay Bill the extra $30,000 this would take because he was tired of living in a tent. \r\n\r\nIn reasonable reliance on Homerâ€™s promise, Bill hired his friend, Fred, and paid Fred wages of $30,000. \r\n\r\nThe home was all done except for the painting when Bill died. Fred split. \r\n\r\nHomer demanded that Billâ€™s widow, Wanda, as executor of Billâ€™s estate, finish the house. She said it was impossible. \r\n\r\nWanda demanded payment of $130,000, but Homer was mad and refused to pay anything. Homer paid painter Paul $10,000 to finish the painting of the home.\r\nDiscuss the rights and defenses of Homer and Wanda against each other.','Sample Essay 5 lawtutor.org','2017-09-02 20:22:20',1,'contracts',0),(8,'Dottie\'s father Fester called her one day and told her he had suffered a stroke. He was paralyzed from the scalp down. He asked her to come live with him and take care of him. He told her that if, and only if, she took care of him for the rest of his life he would leave her his entire estate in his will, including his house. He emphasized that Dottie could only accept his offer by doing what he asked, and that she could not accept by merely promising to take care of him. \r\n\r\nDottie sold her home at a $50,000 loss and moved across the country to take care of Fester for the rest of his life. She gave up her $250,000 per year practice as a brain surgeon nursed Fester 24 hours a day, seven days a week. Similar care in a nursing home would have cost $40,000 per year. \r\n\r\nAfter ten years Fester suddenly said, \"I revoke! Get out of my house.\" Dottie sadly moved into a homeless shelter. \r\n\r\nA month later Fester died leaving his estate, consisting of the house and 1 million shares of Microsoft, to TV evangelist, Reverend Melvin Huckster, and his Society for the Prevention of Cat Teasing. \r\n\r\nDiscuss \r\n\r\n1) Dottie\'s remedies at law relative to the stock? \r\n\r\n\r\n\r\n2) Dottie\'s remedies at law relative to the house? \r\n\r\n\r\n\r\n3) Her remedies for enforcement at equity? \r\n\r\n\r\n\r\n4) Her remedies in alternative to enforcement?','Sample Essay 6 lawtutor.org','2017-09-02 20:22:33',1,'contracts',0),(9,'Sellco sent Buyco a catalogue offering widgets at $6 with a 90-day warranty. \r\n\r\nOn 6/2/99 Buyco wrote Sellco and said, â€œWe hereby accept your catalogue offer and order 10,000 yellow widgets for delivery by 6/8/99 with the standard 90-day warranty.â€ \r\n\r\nOn 6/3/99, Sellco called Buyco and said that they could provide the widgets, but without any warranty. Buyco verbally agreed. \r\n\r\nOn 6/4/99 Sellco sent a written message to Buyco saying, â€œThis is to confirm your order of 10,000 widgets with no warranty.â€ Buyco never responded to this message or signed anything that agreed to waive the warranty. \r\n\r\nOn 6/8/99 Sellco shipped 10,000 blue widgets by mistake. \r\n\r\nOn 6/9/99 Buyco rejected the blue widgets and sent a letter saying, â€œYou sent us the wrong product, you jerks. We had to buy from another supplier, and they cost us $5. You owe us $50,000.\" \r\n\r\nWhat are the rights and remedies of the parties? ','Sample Essay 7 lawtutor.org','2017-09-02 20:22:54',1,'contracts',0),(10,'Tom and Dick burst into the 7-11 store in Sacramento through the open door with their guns drawn at midnight. They wanted to rob the store the first night it opened. \r\n\r\nâ€œStick â€˜em up,â€ yelled Tom. \r\n\r\nUnfortunately, the store was empty because they made a big mistake. No one was there. There was no merchandise. The store wasnâ€™t going to open until the next week. \r\n\r\nThey were so mad they ripped the security camera off the wall and threw it in the river. \r\n\r\nThe next morning Tom and Dick saw themselves on the Dumb Crook Show on TV. The store security camera had filled them trying to rob the empty store. They were afraid they would be caught. So to escape Tom drove real fast to San Francisco with Dick as his passenger. \r\n\r\nOne the freeway going 75 mph, Tom was distracted and accidentally bumped Victoriaâ€™s car. She was only going 70 mph, the posted limit. She spun out of control and crashed. She survived, but went into labor, and her full-term, viable baby was born dead. \r\n\r\nTom then got off the freeway and drove down the crowded city surface streets of San Francisco at 80 mph. Dick was silent. The posted limit was 25 miles per hour. The car ran over homeless person Victor. He died instantly. \r\n\r\nDiscuss the possible charges against Tom and Dick. ','Sample Essay 1 lawtutor.org','2017-09-03 12:17:16',1,'criminal',0),(11,'Huey and Louie agreed to kidnap Frank\'s daughter, Millie, and hold her for ransom. Frank was an old movie star with lots of money. \r\n\r\nHuey knew that Louie was a convicted rapist, so he said, \"Louie! I want you to swear that you won\'t touch this girl. Because we are just in this for the ransom. Nothing else. And if you do anything bad to her, that is going to hurt our chances to get the ransom. So, do you swear?\" \r\n\r\nLouie said, \"Huey, I swear on a stack of bibles I won\'t touch the dame.\"\r\nSo Huey and Louie kidnapped Millie and held her for ransom in a rundown motel. \r\n\r\nHuey went to the store for smokes and when he came back he discovered Louie had sex with Millie by telling her he would let her go in exchange. He was furious and afraid. He said, \"Louie, I quit. I ain\'t having nothing to do with this no more!\" \r\n\r\nHuey left and went to a bar where he got very drunk. That night Millie became so despondent over allowing Louie to have intercourse with her she hung herself in the bathroom of the motel room while Louie was snoring in the bed. \r\n\r\nPolice discovered where Louie was and surrounded the motel room the next morning. Louie vowed not to be taken alive and was gunned down by the cops. \r\n\r\nHuey woke up at noon. Unaware of what happened to Millie and Louie, he decided to turn himself in. So he went to the police that morning and told them everything he knew in an effort to help rescue Millie. \r\n\r\nWhat crimes can Huey be charged with? ','Sample Essay 2 lawtutor.org','2017-09-03 12:19:01',1,'criminal',0),(12,'Tom and his lover Dick made frequent trips to Mexico. Dick was getting a little impotent, so on one trip they bought some Viagra with the intent of smuggling it into the United States. They thought this was a felony, but they were wrong. It was not a crime at all. \r\n\r\nOfficer Oscar tried to pull them over solely because they looked gay, and Oscar hated gays. He intended to harass them. If he was lucky, he thought, maybe he could beat them up. Oscar had some issues to resolve, but he did not have probable cause to stop the car. \r\n\r\nTom was afraid. He felt Oscar must somehow know he was smuggling Viagra. He thought he would be strip searched, and he had an overwhelming phobia of body cavity searches. He thought he would be put in prison and treated very badly. \r\n\r\nTom was scared to death and could not bring himself to stop the car. He knew it was wrong, but he could not help himself. He was in a daze. \r\n\r\nTom continued to drive carefully at 55 mph and Oscar continued to follow him. Oscar was furious. Then Oscar shot at the car several times and Dick was killed. \r\n\r\nTom is charged with the murder of Dick.\r\nDiscuss Tom\'s liability for murder and lessor included offenses, and his applicable defenses.','Sample Essay 3 lawtutor.org','2017-09-03 12:19:19',1,'criminal',0),(13,'Jim was sweet on Sue, a cute little red-haired girl in his Senior class, but she was more interested in a big, dumb, old football player named Chester. \r\n\r\nJim thought that Sue would dump Chester for him if he was a hero. So Jim set fire to the wastepaper basket in old-lady Smith\'s classroom during the class break intending to report it and be a hero. He didn\'t intend any harm to the building, and he honestly believed the fire would not hurt the school at all. Unfortunately, the fire slightly singed the wall, and some other boys poured water on it before Jim could report it. \r\n\r\nIn the confusion Sue dropped her wallet. Jim picked it up and hid it. He planned on giving it back to her that night. Then she would see he is a hero, and she would have to go to homecoming with him. \r\n\r\nJim called Sue\'s house several times that night to tell her he had her wallet. But Sue\'s mother kept saying she was out with Chester. Jim did not tell Sue\'s mother about the wallet. \r\n\r\nThis went on all night and Jim got so depressed he went to the river, pocketed Sue\'s money and threw Sue\'s wallet as far out into the current as he could throw. \r\n\r\nThe next day Chester came up to Jim in first period and asked him a favor. Chester said the football team had to assemble for a yearbook picture, so Chester asked Jim to buy him two homecoming tickets in fifth period for Sue and him to go to the dance. Jim intended to do Chester a favor and took his $10. \r\n\r\nJim got mad and decided he would just keep Chester\'s money. Then after second period Chester offered Jim $20 more so Sue and him could have their pictures taken at the dance. Jim agreed and took the money with every intention of stealing it. \r\n\r\nJim used all of Chester\'s money to buy cigarettes and Playboy magazines. Discuss Jim\'s crimes. ','Sample Essay 4 lawtutor.org','2017-09-03 12:19:54',1,'criminal',0),(14,'Yang rode his bicycle down Rodeo Drive looking for a victim. He saw a \"Hot Tomato\" ready to cross the street, and as he coasted past her he deftly lifted her wallet right out of her purse without her knowing. \r\n\r\nAt the next street he snatched another purse when an \"Old Lady\" wasn\'t even looking. But she was holding tight and fell over into the street. As she hit the pavement she lost her grip and Yang rode away with another prize. \r\n\r\nYang was having a good day. \r\n\r\nAt the next corner Yang reached out to snag another purse. But at the last second as he reached out he realized the \"Young Chick\" was not carrying a purse. \r\n\r\nDisappointed, Yang called it a day. He decided to score some dope with his earnings. Seeing a dude near an alley, he entered into some negotiations. The dude said he could sell him a baggy of \"grass\" for $10. Yang agreed and handed over $10. Suddenly cops came out of nowhere and jumped on them before Yang got possession. It turned out the \"grass\" really was grass -- lawn clippings from the dude\'s back yard. \r\n\r\nWhat crimes can Yang be charged with and what defenses might be raised? ','Sample Essay 5 lawtutor.org','2017-09-03 12:20:34',1,'criminal',0),(15,'Karen was furious because her lover Billy ran off with Mary. Karen decided to kill Mary and looked for some dynamite to blow Mary straight to Hell. \r\n\r\nKaren went to a \"Dynamite R Us Store\", but the owner Marvin refused to sell her any dynamite. Karen pulled a gun and demanded quality service like it said on the sign in the window. Marvin said, \"Yes, Ma\'am!\" and handed over 12 sticks of dynamite. Karen was happy with the service. But as she was putting away the gun, it accidentally went off and shot Marvin between the eyes. Karen felt real bad about it. \r\n\r\nAs Karen approached Mary\'s mobile home she was stopped by Ruby. Ruby gave her a hard look. Ruby \"dissed\" her. Ruby challenged her to a spelling bee and criticized her choice of attire. That was all more than Karen could take, because she always had a short fuse. So she smoked Ruby above the ear with a round from the \'38. \r\n\r\nKaren proceeded to put the dynamite under Mary\'s double-wide \"Jerry Springer\" brand mobile home. She realized that the blast would probably kill Billy too, and she felt real bad about it. Billy was the reason she was acting out, her love for him and all. But the way she figured, a girl\'s got to do what a girl\'s got to do. So she washed that man right out of her hair. \r\n\r\nThat night the blast killed both Mary and Billy. \r\n\r\nDiscuss the potential first degree murder charges Karen might face along with lesser included offenses and her potential defenses. ','Sample Essay 6 lawtutor.org','2017-09-03 12:20:54',1,'criminal',0),(17,'Clark Kent, star reporter for the Daily Planet was approached by panhandler Bill Gates and asked for a quarter. As a prank, Kent (who was secretly Superman) lifted and very gently flew Gates hundreds of feet up to the top of the World Tribune building and left Gates there on a ledge. \r\n\r\nKent hovered over the World Tribune building and never touched the surface of the building. During the flight Gates was apprehensive he might fall, but Kent had a strong grip. \r\n\r\nGates was embarrassed and the crowd below taunted him for hours as the fire department tried to devise a means of rescue. Gates was humiliated. \r\n\r\nAs he stood on the ledge Gates accidentally knocked a decorative panel loose. It fell to the ground and injured fireman Frank. \r\n\r\nSuddenly Gates discovered that there was an unlocked window next to him all the time. He opened the window and escaped immediately. \r\n\r\nDiscuss Kent\'s liability to Gates, the World Tribune and fireman Frank. ','Sample Essay 1 lawtutor.org','2017-09-03 12:25:00',1,'torts',0),(18,'Tom bought some firecrackers in Rural County, where they were legal. He took them into the National Forest where federal law prohibited the possession and use of fireworks. The federal law was enacted to reduce the threat of forest fires and injury on national lands. \r\n\r\nIn the National Forest Tom waded to a gravel bar in the middle of Big River, and there he carefully lit and threw the firecrackers into the air above the river. Occasionally one would fail to explode and it would fall harmlessly into the water. There was no one else around, and there was nothing on the gravel bar that could burn. \r\n\r\nLittle Dick was playing a half-mile upstream from Tom, throwing sticks into Big River. He was three years old. His mother warned him to stay back from the edge of the river because it was dangerous. Dick disobeyed his mother and recklessly pushed a rotted tree into the river and it swirled away in the water. No one was hurt. \r\n\r\nHalf a mile downstream from Tom, Paula was one of five people on the bridge above Big River fishing for trout. Paula was outside the National Forest boundaries. She had ignored a sign that said \"No Fishing From Bridge.\" Fishing from the bridge was prohibited for traffic safety, but she was well off the roadway and there were very few cars this time of year. Paula was sitting carelessly on the edge of the bridge, but it was a nice day, the water was only six feet below her, and she knew how to swim. \r\n\r\nTom threw another firecracker into the air and it did not explode. Instead it fell onto the log that Dick had pushed into the river upstream. \r\n\r\nThe log swept down the river for half a mile before the firecracker exploded just as the log swept under the bridge. \r\n\r\nPaula was startled and fell into the river. \r\n\r\nOther people that had been fishing rushed off the bridge and down the river bank to rescue Paula as she laughingly climbed up the bank. \r\n\r\nHarry had been fishing too, but instead of going to help Paula, he stayed on the bridge and took two dollars out of Paula\'s purse. No one saw Harry take the money and the crime was never solved. Paula was hurt and upset. \r\n\r\nUnder what theories can Paula seek to recover from Tom and Dick and what defenses would they raise? ','Sample Essay 2 lawtutor.org','2017-09-03 12:25:16',1,'torts',0),(19,'The Macho-X99 chainsaw is a light-duty chainsaw designed for trees no bigger than 18\". In the owner\'s manual said in big red letters, \"WARNING -- NEVER TRY TO CUT DOWN A TREE BIGGER THAN 18\" OR THIS SAW MIGHT CATCH FIRE.\" There were no warnings on the saw itself. \r\n\r\nTom went into Sam\'s Bargain Center. Sam told him, \"This is the best chainsaw on the market. The Macho-X99 will cut trees up to 36\" in diameter.\" Tom bought the Macho-X99 chainsaw. \r\n\r\nDick went into Sam\'s Bargain Center and said he didn\'t know much about chainsaws but needed one that could cut a tree about 24\" in diameter. Sam told him, \"I am an expert when it comes to chainsaws. I recommend this Macho-X99.\" Dick bought the Macho-X99 chainsaw. \r\n\r\nMoe went into Sam\'s Bargain Center and bought the Macho-X99 chainsaw without any discussion. \r\n\r\nSam, Tom and Dick never read the owner\'s manual and were unaware of the potential fire danger. When Tom and Dick tried to cut down trees bigger than 18\" the saws burst into flames and burned them. \r\n\r\nMoe saw the warning in the owner\'s manual and tried to return the saw. Sam refused to give Moe his money back. Moe was disgusted and threw the saw in the garbage â€œDumpsterâ€. \r\n\r\nHarry saw Moe\'s old saw in the garbage and took it. There was no owner\'s manual, but the saw was just like brand new. When he first used the saw it burst into flames and burned him. \r\n\r\nDiscuss all the theories under which Tom, Dick and Harry would seek to recover from Sam. Under which theories can they NOT recover? ','Sample Essay 3 lawtutor.org','2017-09-03 12:25:38',1,'torts',0),(20,'Barbara, the famous TV news lady, was assigned to do a story on former governor, Pat Wilson, to find out why Wilson had become almost a recluse in the years since he left office. \r\n\r\nBarbara interviewed Wilson at his home. Wilson\'s speech was slurred, his eyes were bloodshot and he was unsteady. Barbara asked him about his health, and he declined to comment. Barbara knew Wilson had once been an alcoholic, and she suspected he had begun drinking heavily again. But she did not ask him about this because she knew he would deny it. \r\n\r\nOn TV Barbara accurately described Wilson\'s slurred speech, bloodshot eyes and unsteady gait. Then she stated, \"It appears that someone we once knew and respected has gone back to his old ways.\" She did not state who the \"someone\" was, and she did not explain what she meant by \"his old ways.\" \r\n\r\nBecause of the news broadcast, rumors rapidly spread that Wilson had again developed a drinking habit. Wilson\'s approval in polls fell dramatically, and he was passed over for the post of State Republican Chair, but he had little chance of being selected for that post. \r\n\r\nWilson demanded a retraction and apology, but Barbara refuses. Discuss potential action by Wilson. ','Sample Essay 4 lawtutor.org','2017-09-03 12:25:55',1,'torts',0),(21,'The National Inkwire focused on sensational articles about celebrities, complete with candid pictures taken during private moments. Actress Ellen D. Generate was pursued relentlessly. \r\n\r\nOne time The National Inkwire reported that Ellen was secretly a generous philanthropist. In fact, Ellen was a tightwad. As a result of the Inkwire article, Ellen was besieged by requests for donations, and it was professionally impossible for her to turn them all down. \r\n\r\nThen the Inkwire photographer, Dick took pictures of Ellen sunbathing topless on her sailboat. At the time the photo was taken Ellen was anchored four miles from land in international waters, and she had her friend Anne posted as a lookout to warn of any approaching boats or airplanes. The way Dick got the photo was by using a remote controlled, miniature submarine with a powerful telephoto lens. \r\n\r\nEllen was so embarrassed by the nude photo that she remained secluded in her home for weeks. \r\n\r\nEllen decided to sue the Inkwire, so she went to the grocery store and bought a copy of the issue with her photo to show her lawyer. Unfortunately Dick was following her and he took a picture of Ellen buying the Inkwire. Then Inkwire put the picture of Ellen on billboards nationwide with a caption that said \"Ellen D. Generate buys Inkwire!\" \r\n\r\nBefore Ellen could file suit the Inkwire ran an interview with Ellen\'s old boyfriend from college. He said that even though Ellen was now a strong and vocal anti-abortion advocate, she had an abortion herself in college. This was a true fact that Ellen had told her ex-boyfriend in strictest confidence. This disclosure embarrassed Ellen and made her look like a hypocrite. \r\n\r\nDiscuss the possible actions Ellen might bring against the Inkwire and their defenses. ','Sample Essay 5 lawtutor.org','2017-09-03 12:27:43',1,'torts',0),(22,'Ken was a politician from Los Angeles. He moved to Sacramento and purchased a spacious home on the Sacramento River. He felt he got a great deal because he only paid $400,000 and a similar home in Los Angeles would have cost him three times that amount. \r\n\r\nKen realized his home was directly in the flight path of the airplanes taking off and landing from the County airport, and the realtor had prominently disclosed this fact on the sales documents. But Ken didn\'t think the noise was so bad because from his backyard he just loved to hear little birds singing along the public river parkway. \r\n\r\nFour years later Ken lost the election and he wanted to move back to Los Angeles. When he had the house appraised, it was worth $500,000. Ken was furious because his home value had only increased 25 percent in value while most real estate had gone up 50 percent. \r\n\r\nKen blamed the County. In the four years he owned the home the number of flights at the airport increased ten percent. This increased traffic was from increased military use in response to the crisis in Romaria. Ken could not enjoy his yard as much as before, and the little birds on the public river parkway didn\'t seem to sing as much as they used to. \r\n\r\nWhat actions might Ken bring against the County, what defenses might be raised, and what remedies are appropriate? ','Sample Essay 6 lawtutor.org','2017-09-03 12:27:45',1,'torts',0),(23,'Star approached Buck, the owner of JavaManiac, with a business proposal. Star knew where there was a retail space for lease that would be a great place for a JavaManiac franchise. Buck told Star that she would be granted a JavaManiac license if the location was acceptable. Based on this Star described the location in detail and gave Buck its address. Buck said he would have someone \"check it out.\" \r\n\r\nBuck had no intention of giving Star a franchise. He just wanted her to reveal the location. Based on Star\'s description it sounded perfect for a JavaManiac outlet, and Buck wanted to take the space himself. \r\n\r\nBuck went to the location suggested by Star and saw that it was perfect for JavaManiac. He then contacted the owner, Jack. Jack said he already had tentatively promised the lease to someone named Star. Buck said, \"I know Star,\" and held his hand in the air with his thumb out to indicate that Star had a drinking problem. Then Buck looked at Jack very sincerely and said, \"I probably shouldn\'t say this, but I feel I have a duty to tell you that you don\'t want to lease to someone like Star.\" \r\n\r\nBuck reported to Star that the location was unacceptable because it was too small to meet the secret JavaManiac minimum guidelines. \r\n\r\nStar was very dejected and withdrew her offer to lease the space. Jack was relieved. \r\n\r\nThree months later Star happened upon the grand opening of the next new JavaManiac franchise at the very location he had suggested. Standing in front were Buck and Jack shaking hands. Star was furious and accused Buck of cheating her. Buck rolled his eyes at Jack and said, \"See what I mean?\" \r\n\r\nThen Buck sued Star for slander per se for accusing him of questionable business practices. Star won the suit when the jury found her statements had been true. \r\n\r\nWhat are Star\'s possible actions against Buck? (Do not discuss intentional infliction, defamation or false light.) ','Sample Essay 7 lawtutor.org','2017-09-03 12:27:38',1,'torts',0);

/*Table structure for table `law_issues` */

DROP TABLE IF EXISTS `law_issues`;

CREATE TABLE `law_issues` (
  `issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `issue` varchar(255) DEFAULT NULL,
  `subject` enum('contracts','torts','criminal') DEFAULT NULL,
  `template` text,
  `user_id` int(11) DEFAULT NULL,
  `issue_deleted` int(1) NOT NULL DEFAULT '0',
  `hints` text,
  PRIMARY KEY (`issue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;

/*Data for the table `law_issues` */

insert  into `law_issues`(`issue_id`,`issue`,`subject`,`template`,`user_id`,`issue_deleted`,`hints`) values (1,'HOMER VS LUCY','contracts',NULL,1,1,NULL),(2,'UCC?','contracts','UCC Article 2 governs contracts for sale of GOODS, movable things at the time of identification to the contract. Otherwise, only COMMON LAW governs the contract.\r\n\r\nHere the contract does not (does) concern a sale of movable things because ...... \r\n\r\nTherefore, only COMMON LAW / UCC principles govern this contract.\r\n',1,1,NULL),(3,'WRITING REQUIRED - Land?','contracts','Under the STATUTE OF FRAUDS certain types of contract must be in writing to be enforced. A contract for conveyance of an interest in LAND often requires a writing, but not leaseholds of a year or less.\r\n\r\nHere the question involves conveyance of an interest in land because ....\r\n\r\nTherefore, a writing would not (would) generally be required. ',1,1,NULL),(4,'Was the ADVERTISEMENT an OFFER?','contracts','Under contract law an OFFER is a manifestation of present intent to enter into a bargain communicated to the offeree and sufficiently specific that an observer would reasonably believe assent would form a bargain. Advertisements are generally not offers because they usually fail to identity the parties or the quantity being offered. \r\n\r\nHere the advertisement was not (was) specific as to the parties because ....\r\n\r\nTherefore, the advertisement was not (was) an offer. ',1,1,NULL),(5,'OFFER?','contracts','Under contract law an OFFER is a manifestation of present intent to enter into a bargain communicated to the offeree and contains definite terms and conditions and sufficiently specific that an observer would reasonably believe assent would form a bargain.\r\n\r\nHere the statement by [party] did not appear to manifest intent to enter into a bargain because ..... \r\n\r\nNo (yes) reasonable person would believe assent to that statement would form a bargain because ....\r\n\r\nHere party communicated the terms to the other party becuase .....\r\n\r\nHere definite terms and conditions are present because .....',1,1,NULL),(6,'OPTION?','contracts','Under common law an OPTION is a contractual agreement that an offeror will not revoke an offer for a specific period of time in exchange for CONSIDERATION from the offeree. \r\n\r\nHere party promised to give (give no) firm offer and another party gave (gave no) proimse or value in exchange because ...\r\n\r\nTherefore, party\'s offer did not (did) create an option contract, and she could (could not) revoke her offer at any time.',1,1,NULL),(7,'Does UCC apply?','contracts','Note: Always issue #1 if UCC applies, but may be a \"non-issue\" otherwise. This is the FIRST ISSUE TO CONSIDER but do not write about it if it is not really an issue.\r\n\r\nUnder contract law UCC Article 2 controls contracts for the sale of GOODS. Goods are movable things at a time of identification to the contract. Otherwise only the common law controls.\r\n\r\nHere the agreement was NOT (is) for a sale of goods, because ....\r\n\r\nTherefore, only the common law (UCC) determines the rights of the parties here.',1,0,NULL),(8,'Offer?','contracts','Under contract law an OFFER is a manifestation of present contractual intent communicated to the offeree and sufficiently certain that an objective person would reasonably believe assent would form a bargain. Under common law an offer must specify the parties, subject matter, quantity, price, and time of performance in order to be enforceable.\r\n\r\nHere the communication was (not) an offer because ...\r\n\r\nTherefore, the communication was (not) an offer.\r\n\r\nNote: Watch out for catalogues and advertisements. Catalogues are never offers because quantity is always uncertain. Advertisements are seldom offers because either quantity is not set or else the offeree is not described.\r\n\r\nAlso watch out for gift promises and exchanges of gift promises because they never manifest contractual intent. They are not enforceable at law, only at equity may be.\r\n\r\nOK Rule: If saying \"OK!\" to a communication would NOT make an observer reasonably believe an enforceable contract formed, then the communication \"assented to\" was not even an offer.',1,0,NULL),(9,'Unilateral Contract?','contracts','Note: Skip unless the given facts make it entirely clear this is an intended issue or the offer in a GENERAL OFFER.\r\n\r\nUnder the common law a Unilateral Contract Offer is one that unequivocally indicates acceptance can only be manifested by completion of performance by the offeree. GENERAL OFFERS, reward or bounty offers, are always unilateral contract offers.\r\n\r\nHere it is (not) unequivocally clear that the offeree can only accept this offer by completion of performance because ...\r\n\r\nTherefore this is (not) a unilateral contract offer.',1,0,NULL),(10,'Was the communication (action) of [date] an (implied) ACCEPTANCE?','contracts','Note: Only for a formation question. SKIP if question says there was an agreement or contract.\r\n\r\nUnder the common law MIRROR IMAGE RULE an acceptance is unequivocal assent to an offer. [However, acceptance can be implied by silent performance]\r\n\r\nHere the communication was (not) an acceptance because ...\r\n\r\nTherefore, a CONTRACT WAS FORMED on [date]. [Or else the communication was a REJECTION AND COUNTER-OFFER on different terms.]\r\n',1,0,NULL),(11,'Had the OFFER LAPSED before acceptance?','contracts','Note: This issue is frequently tested and poorly taught. Pay attention to it.\r\n\r\nUnder common law an offer LAPSES AND CANNOT BE ACCEPTED unless it is accepted in a reasonable period of time. Oral offers are deemed to lapse at the end of the conversation, and written offers are deemed to lapse within the timeframe implied by the means of dispatch, absent contrary agreement or implication.\r\n\r\nHere the offer was oral (by fax, telegraph, mail, etc) so it would be deemed to have lapsed when ... Therefore the offer did (not) lapse before the offeree attempted to accept it.',1,0,NULL),(12,'Was the communication of an EFFECTIVE ACCEPTANCE?','contracts','Note: SKIP if question says there was an agreement or contract. This is only a possible issue if there is an \"acceptance\" by \"dispatch\" that conflicts with some communication of rejection of revocation.\r\n\r\nUnder the MAILBOX RULES of the common law an acceptance is effective when dispatched if dispatched in the manner specified in the offer, or by the same or faster means the offer was transmitted where the offer does not specify a means of communication.\r\n\r\nHere the acceptance was (not) effective upon dispatch (receipt) because it was (not) sent by the means specified in the offer (no means was specified in the offer and it was sent at the same or faster means than the offer had been sent).\r\n\r\nTherefore ....',1,0,NULL),(13,'Was the communication of [date] an EFFECTIVE REJECTION?','contracts','Note: Only for a formation question. Skip if not applicable\r\n\r\nUnder the MAILBOX RULES of contract law, a rejection is effective upon receipt while an acceptance may be effective upon dispatch. An EXCEPTION is made if the OFFEROR CHANGES POSITION in reliance upon a communication of rejection, not knowing that an acceptance was dispatched prior to receipt of the rejection. In that case, the rejection is effective upon receipt regardless of the fact an acceptance was also dispatched.\r\n\r\nHere the rejection was (not) effective because ...\r\n\r\nHere the offeror (did not) change position in reliance of the rejection because ...\r\n\r\nTherefore ...',1,0,NULL),(14,'Was the communication of [date] an EFFECTIVE REVOCATION?','contracts','Note: Only for a formation question. Skip if not applicable.\r\n\r\nUnder the common law MAILBOX RULES revocation of a contract offer is usually effective upon receipt of the offeree, and an offer cannot be revoked after acceptance.\r\n\r\nFor an unequivocal unilateral offer also say, as appropriate,\r\n\r\nHere the offeror was aware of the offeree had commenced the requested act because ... and the revocation was (was not) effective because...  Therefore ....\r\n\r\nUnder the common law, a unilateral offer could be revoked at any time. Revocation of GENERAL OFFERS, reward or bounty offers, is only effective when published in the same manner the offer was first announced.\r\n\r\nModernly SAVING DOCTRINES prevent revocation of a unilateral contract offer after the offeror is aware the offeree has commenced the requested act for a reasonable period during which the offeree must be allowed to complete the acceptance by performance.\r\n\r\nHere ... Therefore....',1,0,NULL),(15,'Was there an IMPLIED-IN-FACT CONTRACT?','contracts',NULL,1,0,NULL),(16,'Need for a WRITING?','contracts',NULL,1,0,NULL),(17,'CONTRACT TERMS','contracts',NULL,1,0,NULL),(18,'Was TIMELY PERFORMANCE a MATERIAL CONDITION?','contracts',NULL,1,0,NULL),(19,'Was SATISFACTION a MATERIAL CONDITION?','contracts',NULL,1,0,NULL),(20,'Does the PAROL EVIDENCE RULE bar evidence of other covenants and terms?','contracts',NULL,1,0,NULL),(21,'LACK OF INTENT as a defense?','contracts',NULL,1,0,NULL),(22,'LACK OF CONSIDERATION?','contracts',NULL,1,0,NULL),(23,'Was the need for a WRITING SATISFIED?','contracts',NULL,1,0,NULL),(24,'Was the contract UNCONSCIONABLE?','contracts',NULL,1,0,NULL),(25,'Is DURESS a defense?','contracts',NULL,1,0,NULL),(26,'FRAUD, CONCEALMENT or LACK OF DISCLOSURE as a contract defense?','contracts',NULL,1,0,NULL),(27,'Can a DEFENSE OF INCAPACITY be raised?','contracts',NULL,1,0,NULL),(28,'ILLEGALITY?','contracts',NULL,1,0,NULL),(29,'COMMERCIAL IMPRACTICABILITY?','contracts',NULL,1,0,NULL),(30,'IMPOSSIBILITY?','contracts',NULL,1,0,NULL),(31,'FRUSTRATION OF PURPOSE?','contracts',NULL,1,0,NULL),(32,'MUTUAL MISTAKE?','contracts',NULL,1,0,NULL),(33,'UNILATERAL MISTAKE?','contracts',NULL,1,0,NULL),(34,'WAIVER of condition?','contracts',NULL,1,0,NULL),(35,'ANTICIPATORY BREACH?','contracts',NULL,1,0,NULL),(36,'WAIVER of the breach?','contracts',NULL,1,0,NULL),(37,'BREACH OF IMPLIED COVENANT?','contracts',NULL,1,0,NULL),(38,'BREACH of contract? MAJOR OR MINOR?','contracts',NULL,1,0,NULL),(39,'ACCORD AND SATISFACTION?','contracts',NULL,1,0,NULL),(40,'THIRD PARTY BENEFICIARY contract?','contracts',NULL,1,0,NULL),(41,'ASSIGNMENT of contract benefits?','contracts',NULL,1,0,NULL),(42,'MODIFICATION OF CONTRACT AFTER ASSIGNMENT?','contracts',NULL,1,0,NULL),(43,'DELEGATION of contract duties?','contracts',NULL,1,0,NULL),(44,'COMMON LAW REMEDY of the NON-BREACHING PARTY?','contracts',NULL,1,0,NULL),(45,'COMMON LAW REMEDY of the BREACHING PARTY?','contracts',NULL,1,0,NULL),(46,'LIQUIDATED DAMAGES?','contracts',NULL,1,0,NULL),(47,'IMPLIED-IN-LAW CONTRACT?','contracts',NULL,1,0,NULL),(48,'PROMISSORY ESTOPPEL?','contracts',NULL,1,0,NULL),(49,'DETRIMENTAL RELIANCE?','contracts',NULL,1,0,NULL),(50,'ASSAULT?','torts',NULL,1,0,'Apprehensive/concern, Pranks and jokes'),(51,'BATTERY?','torts',NULL,1,0,'Touching/contact/ate/drank'),(52,'CONVERSION?','torts',NULL,1,0,NULL),(53,'FALSE IMPRISONMENT?','torts',NULL,1,0,NULL),(54,'INTENTIONAL INFLICTION OF EMOTIONAL DISTRESS?','torts',NULL,1,0,NULL),(55,'TRESPASS TO LAND?','torts',NULL,1,0,NULL),(56,'TRESPASS TO CHATTELS?','torts',NULL,1,0,NULL),(57,'TRANSFERRED INTENT?','torts',NULL,1,0,'Intent to touch/scare another'),(58,'DAMAGES for INTENTIONAL TORTS?','torts',NULL,1,0,NULL),(59,'DEFENSE of DISCIPLINE?','torts',NULL,1,0,NULL),(60,'DEFENSE of AUTHORITY OF LAW (PREVENTION OF CRIME)?','torts',NULL,1,0,NULL),(61,'DEFENSE of RECAPTURE?','torts',NULL,1,0,NULL),(62,'DEFENSE of NECESSITY?','torts',NULL,1,0,NULL),(63,'DEFENSE of OTHERS?','torts',NULL,1,0,NULL),(64,'DEFENSE of PROPERTY?','torts',NULL,1,0,NULL),(65,'SELF-DEFENSE?','torts',NULL,1,0,NULL),(66,'DEFENSE of INFANCY, INSANITY or INCOMPETENCE?','torts',NULL,1,0,NULL),(67,'RESPONDEAT SUPERIOR?','torts',NULL,1,0,NULL),(68,'VICARIOUS LIABILITY for JOINT ENTERPRISE?','torts',NULL,1,0,NULL),(69,'LIABILITY for acts of INDEPENDENT CONTRACTOR?','torts',NULL,1,0,NULL),(70,'THE ACTUAL CAUSE or a SUBSTANTIAL FACTOR causing injury?','torts',NULL,1,0,NULL),(71,'PROXIMATE CAUSE?','torts',NULL,1,0,NULL),(72,'DAMAGES for TORTS?','torts',NULL,1,0,NULL),(73,'EGG SHELL PLAINTIFF?','torts',NULL,1,0,NULL),(74,'PRODUCTS LIABILITY?','torts','<p>Under tort law, anyone who RELEASES an <b>UNREASONABLY DANGEROUS</b> product into the STREAM OF COMMERCE is liable for <b>PERSONAL INJURY</b> or <b>PROPERTY DAMAGE CAUSED</b>. A product is UNREASONABLY DANGEROUS if the<b> dangers it poses</b> outweigh its <b>utility </b>given the <b>commercial practicality</b> for making it <b>safer, without destroying its utility</b>.</p><p>Liability may be established based on any of four theories: 1) BREACH OF EXPRESS WARRANTY, 2) BREACH OF IMPLIED WARRANTY, 3) NEGLIGENCE or 4) STRICT LIABILITY IN TORT.</p><p>Under a BREACH OF EXPRESS WARRANTY theory, the plaintiff must show the defendant sold goods with <b>express representations</b> (express warranty) which made them unreasonably dangerous, and that it was the actual and proximate cause of injury to the plaintiff.</p><p>Further, under a BREACH OF IMPLIED WARRANTY theory the plaintiff must show the defendant sold goods by representing they were <b>safe for ordinary use</b> or <b>knowing the buyer\'s specific intended use</b> (implied warranty), the goods were unreasonably dangerous for that use, and that it was the actual and proximate cause of injury to the plaintiff.</p><p>Under a NEGLIGENCE theory, the defendant has a duty not to place <b>unreasonably dangerous goods into the stream of commerce</b>. The plaintiff must be a foreseeable plaintiff proximately caused injury by the negligent acts of the defendant.</p><p>And, under a STRICT LIABILITY theory, the plaintiff must show the seller was a <b>COMMERCIAL SUPPLIER</b>, the product was unreasonably dangerous at the time it left the defendant\'s control, and the defendant is <b>only liable for non-economic damages</b>.</p><p>Hereâ€¦ becauseâ€¦ Therefore â€¦</p>',1,0,NULL),(75,'DEFAMATION?','torts',NULL,1,0,NULL),(76,'FALSE LIGHT?','torts',NULL,1,0,NULL),(77,'MISAPPROPRIATION of likeness?','torts',NULL,1,0,NULL),(78,'INTRUSION into the plaintiff\'s solitude?','torts',NULL,1,0,NULL),(79,'PUBLIC DISCLOSURE OF PRIVATE FACTS?','torts',NULL,1,0,NULL),(80,'PRIVATE NUISANCE?','torts',NULL,1,0,NULL),(81,'PUBLIC NUISANCE?','torts',NULL,1,0,NULL),(82,'MALICIOUS PROSECUTION?','torts',NULL,1,0,NULL),(83,'ABUSE OF PROCESS?','torts',NULL,1,0,NULL),(84,'ILLEGAL INTERFERENCE?','torts',NULL,1,0,NULL),(85,'DECEIT (or FRAUD or MISREPRESENTATION)?','torts',NULL,1,0,NULL),(86,'NONDISCLOSURE (CONCEALMENT)?','torts',NULL,1,0,NULL),(87,'TORT RESTITUTION?','torts',NULL,1,0,NULL),(88,'NEGLIGENCE?','torts',NULL,1,0,NULL),(89,'STRICT LIABILITY?','torts',NULL,1,0,NULL),(90,'DUTY?','torts',NULL,1,0,NULL),(91,'ATTRACTIVE NUISANCE DOCTRINE?','torts',NULL,1,0,NULL),(92,'BREACH?','torts',NULL,1,0,NULL),(93,'RES IPSA LOQUITUR?','torts',NULL,1,0,NULL),(94,'BREACH BASED ON NEGLIGENT ENTRUSTMENT?','torts',NULL,1,0,NULL),(95,'ACTUAL CAUSE or a SUBTANTIAL FACTOR?','torts',NULL,1,0,NULL),(96,'PROXIMATE CAUSE?','torts',NULL,1,0,NULL),(97,'DAMAGES?','torts',NULL,1,0,NULL),(98,'NEGLIGENT INFLICTION OF EMOTIONAL DISTRESS?','torts',NULL,1,0,NULL),(99,'VICARIOUS LIABILITY BASED ON RESPONDENT SUPERIOR?','torts',NULL,1,0,NULL),(100,'VICARIOUS LIABILITY for JOINT ENTERPRISE?','torts',NULL,1,0,NULL),(101,'VICARIOUS LIABILITY for acts of INDEPENDENT CONTRACTOR?','torts',NULL,1,0,NULL),(102,'CONTRIBUTORY or COMPARATIVE NEGLIGENCE?','torts',NULL,1,0,NULL),(103,'EGG-SHELL PLAINTIFF?','torts',NULL,1,0,NULL),(104,'ASSUMPTION OF RISK?','torts',NULL,1,0,NULL),(105,'Does the UCC govern?','contracts','Under the contract law the UCC controls contracts for the sale of GOODS. Goods are all things that are movable and identified to the contract at formation. Otherwise the common law controls.\r\n\r\nHere the contract involved a sale because Tom offered to \"sell his boat\". And this was a contract for movable property because \"boats\" can be moved.\r\n\r\nTherefore, this was a contract for a sale of goods and the UCC determines the rights and remedies of the parties.',1,0,NULL),(106,'Are the parties MERCHANTS?','contracts','Under the UCC a MERCHANT is a person who trades in or otherwise holds himself out by occupation as knowledgeable about trade in the goods of the contract.\r\n\r\nImportant: Further, anyone represented by an agent who by occupation is knowledgeable about trade in the goods in the contract will be treated as a merchant.\r\n\r\nHere ... because ... Therefore...\r\n\r\n[Don\'t be afraid to be a little conclusionary here. How do you know \"Buyco and Sellco\" trade in goods? At worst say it is, \"implied by the fact they buy and sell thousands of widgets.\" How do you know that an art collector holds himself out by occupation as knowledgeable? Say it is \"implied by the fact he is an art collector.\"',1,0,NULL),(107,'Need for a WRITING?','contracts','Under UCC 2-201, a contract for sale of goods worth $500 or more must be evidenced by sufficient writing to prove a contract formed that is signed by (or attributable by markings to) the party against whom the contract is to be enforced. But between merchants a SALES CONFIRMATION by one party that lists quantity will bind both of the parties if the receiving party does not object within 10 days. Furthermore, under the UCC no writing is necessary if 1) the contract is for special made goods. 2) the party to be bound admits a contract exists (in pleadings, deposition, or in court) or 3) to the extent there has been partial performance of the contract (acceptance of goods or payment).\r\n\r\nHere ... because ... Therefore....',1,0,NULL),(108,'OFFER?','contracts','Under contract law, an OFFER is a manifestation of present contractual intent communicated to the offeree sufficiently certain as to terms that an objective person would reasonably believe assent would form a bargain. Under the UCC an offer is sufficiently certain if it specifies the parties and quantity, and UCC \"GAP Fillers\" may be used to determine additional terms.\r\n\r\nHere .... because ... Therefore....\r\n\r\n[Tyler\'s Ok Rule: A communication is an offer if an objective observer would be reasonable in concluding a statement of \"OK!\" by the offeree would immediately form a bargain. Suppose Bevis says, \"Come back tomorrow and I will sell you my house for $100, 000\" and Butthead says, \"Ok!\" Did they just form a contract? No, because an objective observer would only conclude that Butthead was agreeing to come back the next day expecting Bevis to sell him the house at that time, not that he was agreeing to buy the house at the present time.]',1,0,NULL),(109,'ACCEPTANCE?','contracts','Note: Only for a formation question.\r\n\r\nUnder UCC 2-206 an acceptance of an offer not otherwise conditioned may be made in a reasonable manner, including a promise to ship or shipment of either conforming or non-conforming goods. BUT a shipment of non-conforming goods as an express accommodation is not an acceptance.\r\n\r\nHere .... because ... Therefore....',1,0,NULL),(110,'ACCEPTANCE WITH VARYING TERMS?','contracts',NULL,1,0,NULL),(111,'CONTRACT TERMS?','contracts',NULL,1,0,NULL),(112,'BREACH by failing to provide REASONABLE ASSURANCES?','contracts',NULL,1,0,NULL),(113,'BREACH?','contracts',NULL,1,0,NULL),(114,'DIVISIBLE CONTRACT?','contracts',NULL,1,0,NULL),(115,'LACK OF CONSIDERATION?','contracts',NULL,1,0,NULL),(116,'REMEDY of NON-BREACHING BUYER?','contracts',NULL,1,0,NULL),(117,'REMEDY of the NON-BREACHING SELLER?','contracts',NULL,1,0,NULL),(118,'REMEDY of the BREACHING BUYER','contracts',NULL,1,0,NULL),(119,'REMEDY of the BREACHING SELLER?','contracts',NULL,1,0,NULL),(120,'SOLICITATION to commit [crime]?','criminal','Under CRIMINAL LAW a SOLICITATION is the crime of urging another person to commit a crime. The crime of SOLICITATION is complete as soon as the urging takes place, whether the person urged commits the crime urged or not. But if the urged crime is committed the SOLICITATION MERGES into the criminal result and the person committing the solicitation becomes an ACCESSORY BEFORE THE FACT  and VICARIOUSLY LIABLE for the crime based on accomplice theory.\r\n\r\nHere A urge B to commit the crime of â€¦ becauseâ€¦Therefore, the defendant can be charged with solicitation to commit [crime].',1,0,'Two or more criminals'),(121,'CONSPIRACY to commit [crime or other illegal goal]?','criminal','Under COMMON LAW the crime of CONSPIRACY was an agreement between two or more people to work toward an illegal goal.  MODERNLY an OVERT ACT in furtherance of the conspiracy goal is often required in many Courts. \r\n\r\nFurther, under the PINKERTON RULE, a member of a conspiracy is VICARIOUSLY LIABLE for the criminal acts of co-conspirators done WITHIN THE SCOPE of the conspiracy goal. This means crimes that were 1) foreseeable and 2) in furtherance of the conspiracy goal.\r\n\r\nEven if the illegal goal of the conspiracy is attained, the CONSPIRACY DOES NOT MERGE into the criminal result, so each member can be convicted of both conspiracy and the other crimes committed during and within the scope of the conspiracy .\r\n\r\n[State the next paragraph if the conspiracy is to commit a crime that necessarily requires more than two people. Receiving stolen property is one of those crimes.]\r\n\r\nAnd under the WHARTON RULE, a  conspiracy requires the participation of more people than the minimum number necessary to commit the criminal act.\r\n\r\n[State the next paragraph if a defendant joins a conspiracy in progress.]  \r\n\r\nIf a defendant joins a conspiracy in progress most Courts hold they are not liable for previous crimes of the co-conspirators unless the joining defendant seeks to profit from those prior crimes.\r\n\r\n [State the next sentence when crimes are committed after the conspiracy ends.]\r\n\r\n A conspiracy ends when the conspiracy goal is ATTAINED or ABANDONED, and vicarious liability will no longer attach based on conspiracy theory . But it may still attach based on accomplice  theory.\r\n\r\n Here two or more parties, A and B, agreed to work toward an illegal goal because â€¦And there was an OVERT ACT in furtherance of the conspiracy when â€¦.\r\n\r\n Therefore, the defendant can be charged with conspiracy to commit [crime].',1,0,'Two or more criminals'),(122,'CRIMINAL ASSAULT?','criminal','Under CRIMINAL LAW an ASSAULT is  the crime of acting with the intention of causing a battery or else to cause apprehension of a battery. The victim of the attempted battery does not have to be aware of the danger. Important!\r\n\r\n Here the defendant attempted to cause a battery (or apprehension of a battery) because â€¦\r\n\r\n Thereforeâ€¦',1,0,NULL),(123,'Can the defendant be charged with CRIMINAL BATTERY?','criminal','Under CRIMINAL LAW a BATTERY is  the crime of acting with the intention of causing a touching of a victimâ€™s person and causing a harmful or offensive touching . Important!\r\n\r\n[Every criminal battery includes a criminal assault as a lesser included offense because an attempted battery is a criminal assault. The assault merges into the larger crime.]\r\n\r\n Here the defendant deliberately acted to cause a touching becauseâ€¦And it caused a harmful (or offensive) touching becauseâ€¦Thereforeâ€¦',1,0,NULL),(124,'RAPE?','criminal','Under common law RAPE was  an intentional act to have sexual intercourse with a female without consent causing actual penetration, no matter how slight. At common law it was held to be legally impossible for a husband to rape a wife because consent to sexual intercourse was implied by marriage.  MODERNLY, the crime of rape has been broadly extended to include any non-consensual sexual act involving penetration, regardless of the relative sexes and marital relationship between the defendant and the victim.\r\n\r\n Here there was an intentional act of sexual intercourse becauseâ€¦And the victim did not consent to have sexual intercourse because â€¦\r\n\r\n Therefore the defendant can be charged with rape.',1,0,NULL),(125,'ARSON?','criminal','Under common law, ARSON was the malicious burning of the dwelling of another.  MODERNLY arson is extended by statute to the burning of other structures.  Malice for arson means that the burning must be done with wrongful intent.\r\n\r\n Here there was a burning becauseâ€¦And there was a malicious intent to burn because â€¦ Therefore the defendant can be charged with arson.',1,0,NULL),(126,'LARCENY?','criminal','Under common law, LARCENY was the trespassory taking and carrying away of the personal property of another with intent to permanently deprive. Where the possession was gained by misrepresentation it was called LARCENY BY TRICK.  MODERNLY larceny is generally codified as â€œTHEFTâ€. Important!\r\n\r\n [Only state the next paragraph if there is a theft from a master or employer.]\r\n\r\n Theft of property from a master or employer by a manager or high-level employee was generally embezzlement and not a larceny, unless the defendant got possession by misrepresentation, a larceny by trick. But theft of the same property by a servant or low-level employee was generally larceny, not embezzlement, unless the defendant took possession from a third party before deciding to steal it, and in that case it was embezzlement.\r\n\r\n [Only state the next paragraph if there is â€œlostâ€ property at issue.]\r\n\r\n Under the RELATION BACK DOCTRINE  some common law courts held that a theft of â€œlostâ€ property by a person who initially intended to return it to the lawful owner was a larceny because a later decision to steal RELATED BACK to make the original taking unlawful. But other courts held this was embezzlement on the theory the original taking formed a â€œconstructive trust.â€\r\n\r\n Here there was a trespassory taking of the personal property of another becauseâ€¦And it was done with intent to permanently deprive becauseâ€¦\r\n\r\n Thereforeâ€¦',1,0,NULL),(127,'Can FALSE PRETENSES be charged?','criminal','Under common law, FALSE PRETENSES was a MISREPRESENTATION of FACT to obtain TITLE to the property of another with intent to permanently deprive. MODERNLY false pretenses is generally codified as â€œTHEFTâ€. Important!\r\n\r\n Here there was intentional misrepresentation of fact to obtain title to property of another becauseâ€¦And there was an intent to permanently deprive because â€¦\r\n\r\n Thereforeâ€¦',1,0,NULL),(128,'EMBEZZLEMENT?','criminal','Under common law, EMBEZZLEMENT was the crime of TRESPASSORY CONVERSION  of the property of another by one entrusted with lawful possession with intent to permanently deprive or else causing substantial risk of loss. MODERNLY embezzlement is generally codified as â€œTHEFTâ€. Important!\r\n\r\n [Only state the next paragraph if there is a theft from a master or employer.]\r\n\r\n Theft of property from a master or employer by a manager or high-level employee was generally embezzlement and not a larceny, unless the defendant got possession by misrepresentation, a larceny by trick. But theft of the same property by a servant or low-level employee was generally larceny, not embezzlement, unless the defendant took possession from a third party before deciding to steal it, and in that case it was embezzlement.\r\n\r\n [Only state the next paragraph if the stolen property was on a common carrier.]\r\n\r\n Further, the COMMON CARRIER DOCTRINE held  that a common carrier such as a taxicab, bus or ship is entrusted with possession of passengerâ€™s property, including lost property, so a theft of passenger property by an employee of a common carrier was more often held to be EMBEZZLEMENT than larceny, even if the property was â€œlostâ€.\r\n\r\n [Only state the next paragraph if â€œlostâ€ property was stolen.]\r\n\r\n When â€œlostâ€ property was stolen by a defendant who first intended to return it to the lawful owner, many courts found EMBEZZLEMENT on the theory the property was held in a â€œconstructive trustâ€. But other courts applied the RELATION BACK DOCTRINE  and held it was a larceny because the decision to steal RELATED BACK to make the original taking unlawful.\r\n\r\nHere there was a trespassory conversion of the property of another with intent to permanently deprive or cause substantial risk of loss because â€¦And the defendant was entrusted with possession (or would be deemed to have lawful possession) of the property becauseâ€¦\r\n\r\n Therefore the defendant could (not) be charged with embezzlement.',1,0,NULL),(129,'Can the defendant be charged with ROBBERY?','criminal','Under CRIMINAL LAW a ROBBERY is  a larceny, defined above (or define larceny here if it was not defined earlier), from a person by use of force or fear to overcome the will of the victim to resist. Important!\r\n\r\n Here there was a larceny from the person becauseâ€¦And the defendant used force ( or fear) to overcome the will of the victim to resist becauseâ€¦Thereforeâ€¦',1,0,NULL),(130,'BURGLARY?','criminal','Under COMMON LAW a BURGLARY was  the breaking and entering of the dwelling of another in the night with intent to commit a felony. The entry of a structure within the CURTILAGE  of the dwelling also constituted a burglary. Important! A physical breaking was generally required, but a CONSTRUCTIVE BREAKING would be found  if entry was the result of TRICK, VIOLENT THREATS, or CONSPIRACY.\r\n\r\n MODERNLY burglary has been extended by statute to all times of the day and all types of structures. Intent to commit a larceny is generally still sufficient to support a burglary charge, even if the larceny is no longer a felony. Further, the â€œbreakingâ€ element will generally be satisfied if there is a TRESPASSORY ENTRY, an entry without consent , express or implied.\r\n\r\n Here there was a breaking and entry (or trespassory entry) into a structure of another becauseâ€¦But it was not a dwelling because it wasâ€¦And the intent at the time of entry was to commit a felony (or larceny) becauseâ€¦\r\n\r\n Therefore the defendant could not be charged with common law BURGLARY but could be charged modernly.\r\n\r\n [More than any other crime you need to compare and contrast the common law burglary against the modern view and state whether the defendant could be charged under both or only modernly.]',1,0,NULL),(131,'RECEIVING STOLEN PROPERTY?','criminal','Under CRIMINAL LAW RECEIVING STOLEN PROPERTY is  the crime of taking possession or control over stolen personal property while knowing it has been stolen from the lawful possessor. Both the defendant that receives the stolen property and the defendant that provides (delivers) the property are liable.  \r\n\r\nUnder the WHARTON RULE there can be no crime of CONSPIRACY TO RECEIVE STOLEN PROPERTY unless there are at least three defendants in agreement.\r\n\r\n [Only state the following if the subject property was placed into the possession of the defendants with the tacit consent of the lawful owner or the police.]\r\n\r\nThe crime of receiving stolen property is a legal impossibility if the property was in the possession of the defendants with the CONSENT of the lawful OWNER or the POLICE as part of a â€œstingâ€ operation. In that case the crime is ATTEMPTED RECEIPT OF STOLEN PROPERTY .\r\n\r\n Hereâ€¦becauseâ€¦Thereforeâ€¦',1,0,NULL),(132,'ATTEMPTED (name the crime attempted)?','criminal','Under CRIMINAL LAW an ATTEMPTED CRIME is a SUBSTANTIAL STEP  taken toward committing an INTENDED CRIME. Important!\r\n\r\n [Only state the following sentence if the facts suggest an issue of LEGAL IMPOSSIBILITY .]\r\n\r\n For an attempted crime to be committed, it must be legally possible for the crime to have been completed at the moment of the first substantial step.  \r\n\r\nHere there was a substantial step toward commission of the crime of (name the crime) because â€¦And the defendant intended to commit that crime becauseâ€¦\r\n\r\n Therefore ATTEMPTED (crime) can be charged.\r\n\r\n [There are particular rules for some â€œattemptedâ€ crimes: \r\n\r\nÂ·        For any attempted crime to be committed it must be legally possible to commit the intended crime at the instant of the first substantial step.\r\n\r\nÂ·        There can be NO ATTEMPTED SOLICITATION  because any â€œattemptâ€ completes the crime.\r\n\r\nÂ·        At common law there was NO ATTEMPTED ASSAULT  because assault by definition is an attempt.\r\n\r\nÂ·        And at common law there was NO ATTEMPTED BATTERY  because that is the crime of assault.\r\n\r\nÂ·        There can be NO ATTEMPTED BURGLARY  unless the defendants approach a structure with intent to enter and commit some other crime and fail to enter at all.\r\n\r\nÂ·        EVERY BURGLARY OR ATTEMPTED BURGLARY  makes the defendant automatically liable for a SECOND ATTEMPT CRIME because it is a substantial step toward commission the second crime the defendant intends to commit after breaking in.\r\n\r\nÂ·        There can be NO RECEIVING STOLEN PROPERTY and can only be a crime of ATTEMPTED RECEIPT if the subject property was conveyed to the receiving defendant with consent of the lawful owner (or the police).\r\n\r\nÂ·        The crime of ATTEMPTED MURDER requires INTENT TO KILL and no other form of malice for murder will suffice. So there can be NO ATTEMPTED DEPRAVED HEART MURDER and NO ATTEPTED FELONY MURDER.\r\n\r\nÂ·        There can be NO ATTEMPTED MANSLAUGHTER because the crime is an alternative to a murder charge that requires a completed homicide.]',1,0,NULL),(133,'MURDER?','criminal','<p>Under CRIMINAL LAW a MURDER is an <b>unlawful HOMICIDE</b>, the killing of one human being by another, with MALICE aforethought. MALICE for murder may be &nbsp;1) an EXPRESS<b> intent to kill</b>, or IMPLIED by 2) intent to commit <b>GREAT BODILY INJURY</b>, 3) intent to commit an <b>INHERENTLY DANGEROUS FELONY</b>, the <b>FELONY MURDER RULE</b>, or 4) intentional creation of EXTREME RISKS to human life with <b>AWARENESS</b> of and <b>CONSCIOUS DISREGARD</b> for the risks, the DEPRAVED HEART MURDER rule. Important!</p><p>&nbsp;Under COMMON LAW there were NO DEGREES of murder but &nbsp;MODERNLY first degree murder is generally codified as a 1) <b>willful, deliberate and premeditated</b> homicide or one 2) done by <b>enumerated means</b>, &nbsp;or 3) caused by commission of an <b>enumerated </b>felony. &nbsp;Important!</p><p><b>&nbsp;[Only state the following if it is not clear a â€œliving human beingâ€ was killed.]</b></p><p>&nbsp;At common law and modernly, a â€œhuman beingâ€ &nbsp;is a person who was born alive and was not yet dead.</p><p><b>&nbsp;[Only state the following if a death occurs long after the act being blamed.]</b></p><p>&nbsp;The common law held that there was NO HOMICIDE if the victim died more than a year and a day after the act blamed for the death. Modernly this has been broadly extended by statute.</p><p><b>&nbsp;[State the following if the death results from suicide .]</b></p><p>&nbsp;A suicide &nbsp;is not a homicide. But a death by suicide constitutes a homicide when it is actually and proximately caused by the acts of the defendant.</p><p><b>&nbsp;[State the following if more than one person was an actual cause of death.]</b></p><p>The prosecution must prove the defendant was the ACTUAL AND PROXIMATE CAUSE of death, and if more than one act was an actual cause of death, the last, unforeseeable, intentional act generally is the only &nbsp;legal cause of death and it terminates the criminal liability flowing from all prior acts. Generally negligence by others is presumed to be foreseeable and criminal acts and intentional torts by third parties are presumed to be unforeseeable absent special knowledge.</p><p><b>&nbsp;[Only state the following if a death occurs during or after the commission of an inherently dangerous felony (rape , robbery, burglary or arson).]</b></p><p>&nbsp;Under the FELONY MURDER RULE, a homicide &nbsp;caused by the commission of an inherently dangerous felony can be prosecuted as a murder if it is the result of acts done within the RES GESTAE of the underlying felony AND results from the INHERENT DANGERS of that type of felony. The RES GESTAE is &nbsp;the sequence of events beginning with the first substantial step to commit the felony and ending when the defendants leave the scene of the crime and reach a place of relative safety.</p><p><b>&nbsp;[Only state the following if a death occurs after a break-in to a structure when the defendantâ€™s sole purpose for breaking into the structure was to attack the victim.] &nbsp;</b></p><p>A murder prosecution cannot be based on the felony murder rule if the death occurred during a burglary that was committed solely for the purpose of attacking the victim because that is not one of the â€œinherent dangersâ€ of burglary. &nbsp;</p><p>Here there was an <b>unlawful HOMICIDE</b> because the victim was a human being and he was killed by the acts of another human being, the defendant. And there was <b>malice aforethought</b> becauseâ€¦ &nbsp;</p><p>Therefore the defendant can (not) be charged with murder.</p><p><b>&nbsp;[Once you determine murder can be charged you should almost always discuss the degree of murder that is indicated by the facts as follows.]</b></p><p>&nbsp;Here the murder would (not) be in the FIRST DEGREE becauseâ€¦</p>',1,0,NULL),(134,'MITIGATING FACTORS?','criminal','(Always discuss if defendant kills while mentally impaired.)\r\n\r\nUnder CRIMINAL LAW, MITIGATING FACTORS may be  weighed by the jury in determining whether or not a defendant killed with sufficient premeditation to support a finding of first-degree murder or whether the defendant acted with malice aforethought at all for a finding of murder. They may cause the jury to find only manslaughter and not murder.\r\n<br>\r\n Here there were mitigating factors because the defendant was (intoxicated, mentally incapacitated, etc.)â€¦ Therefore the jury may find thatâ€¦',1,0,NULL),(135,'VOLUNTARY MANSLAUGHTER?','criminal','<p>(SKIP if the defendant clearly DID NOT intend to kill.)</p><p>&nbsp;Under CRIMINAL LAW, VOLUNTARY MANSLAUGHTER is an <b>INTENTIONAL</b>, unlawful homicide, the killing of one human being by another, without malice aforethought because of ADEQUATE <b>PROVOCATION</b>. <b>Important</b>!</p><p>ADEQUATE PROVOCATION is provocation sufficient to raise a reasonable person to a murderous rage, which did raise the defendant to such a rage, and which was the actual cause of the homicide. Important!</p><p>But ADEQUATE PROVOCATION CANNOT BE FOUND if the defendant had enough time before the killing that a reasonable person would have COOLED DOWN and no longer would have been in a murderous rage.</p><p>Here there was a homicide becauseâ€¦ And, adequate provocation might be found becauseâ€¦</p><p>Thereforeâ€¦</p>',1,0,NULL),(136,'INVOLUNTARY MANSLAUGHTER?','criminal','<p>(SKIP if the defendant clearly DID intend to kill.)</p><p>Under CRIMINAL LAW, INVOLUNTARY MANSLAUGHTER is &nbsp;an <b>UNINTENDED</b> homicide, the killing of one human being by another, as a result of <b>CRIMINAL NEGLIGENCE</b> (a.k.a. â€œnegligent homicideâ€), <b>RECKLESSNESS</b> (a.k.a. â€œreckless homicide â€), or during the commission of a <b>MALUM IN SE crime</b> insufficient for a charge of murder (a.k.a. â€œmisdemeanor manslaughter â€). <b>Important!</b></p><p>&nbsp;CRIMINAL NEGLIGENCE is a <b>deliberate breach</b> of a<b> pre-existing duty</b> to protect others from extreme risks and RECKLESSNESS is a <b>deliberate creation</b> of extreme risks to others.</p><p>A MALUM IN SE crime is one that involves moral turpitude.</p><p>Here there was a <b>homicide</b> because the victim was a human being, and they were killed by the act of the defendant, another human being.</p><p><b>&nbsp;[The following applies if the death was caused by RECKLESSNESS (or CRIMINAL NEGLIGENCE).]</b></p><p>&nbsp;And the defendant <b>deliberately created extreme risks</b> (or <b>deliberately breached a duty to protect others from extreme risks</b>) becauseâ€¦â€¦ But the defendant might not have been fully aware of the risks becauseâ€¦</p><p>&nbsp;Therefore the defendant may be charged with involuntary manslaughter.</p>',1,0,NULL),(137,'REDLINE RULE?','criminal','<p>Under the REDLINE RULE a co-felon &nbsp;in many States cannot be charged with murder under the FELONY MURDER RULE simply because a<b> co-felon was killed</b> by a <b>victim</b>, <b>bystander</b> or the <b>police</b> during the commission of a crime.</p><p>Here the rule would apply because â€¦</p>',1,0,NULL),(138,'KIDNAPPING?','criminal','<p>Under criminal law KIDNAPPING is &nbsp;the crime of <b>unlawfully taking</b> or <b>confining people against their will</b>. At common law the victim had to be taken out of the country or across a state line. Modernly this requirement has been dropped.</p><p>Kidnapping is not one of the â€œinherently dangerous feloniesâ€ for the Felony Murder Rule but modernly is often an â€œenumerated felonyâ€ for first-degree murder.</p><p>Hereâ€¦Thereforeâ€¦</p>',1,0,NULL),(139,'MISPRISON?','criminal','<p>(NEVER DISCUSS this unless the given facts make it entirely clear it is an intended issue &nbsp;for discussion because this has not been a crime for about 200 years!)</p><p>Under old common law MISPRISION was &nbsp;the crime of knowingly failing to report felonies by others to the police. Modernly there is no general duty to report crimes by others, and the crime of misprision no longer exists generally.</p><p>Hereâ€¦Thereforeâ€¦</p>',1,0,NULL),(140,'COMPOUNDING?','criminal','<p>(This is a real crime so discuss this instead of misprision.)</p><p>Under criminal law COMPOUNDING is &nbsp;the crime of<b> taking money or something</b> of value<b> in exchange for a promise to not report crimes</b> committed by others.</p><p>Hereâ€¦Thereforeâ€¦</p>',1,0,NULL),(141,'ACCOMPLICE LIABILITY?','criminal','<p>Under criminal law, ACCOMPLICE LIABILITY is <b class=\"\">vicarious</b> criminal liability for criminal acts of co-criminals that<b> directly and naturally result</b> (foreseeable acts) from the defendantâ€™s own criminal acts. Many Courts do not recognize Withdrawal as a defense to accomplice liability.</p><p>Hereâ€¦Thereforeâ€¦</p>',1,0,NULL),(142,'DEFENSE of INFANCY?','criminal','<p>[Children and youthful defendants!]&nbsp;</p><p>Under the COMMON LAW there as a CONCLUSIVE PRESUMPTION that a child &nbsp;<b>under</b><b> the age of seven</b> was unable to form CRIMINAL INTENT. There was a REBUTTABLE PRESUMPTION that a child <b>between 7 and 14</b> could not form criminal intent, and that a child over the age of 14 could form criminal intent. Modernly similar rules have been adopted by statute.</p><p>&nbsp;Here the defendant may claim he was <b>too young</b> to form criminal intent becauseâ€¦</p><p>&nbsp;Thereforeâ€¦</p>',1,0,NULL),(143,'DEFENSE OF MISTAKE OF FACT?','criminal','<p>[A frequently tested issue.] &nbsp;</p><p>Under CRIMINAL LAW a MISTAKE OF FACT is a complete defense if it negates implied criminal intent. For GENERAL INTENT crimes only a REASONABLE mistake can negate criminal intent. For SPECIFIC INTENT crimes ANY MISTAKE OF FACT may negate criminal intent whether reasonable or not. Battery, rape, burglary, arson, involuntary manslaughter and murders that are not willful and deliberate or based on the felony murder rule are general intent crimes. All other crimes are SPECIFIC INTENT crimes.</p><p>&nbsp;A REASONABLE MISTAKE OF FACT is one that a<b> reasonable person would have made</b> in the same situation. &nbsp;VOLUNTARY INTOXICATION &nbsp;never makes an otherwise unreasonable mistake reasonable. &nbsp;</p><p>A MISTAKE OF FACT is no defense to a charge of ATTEMPT if<b> criminal intent is proven</b> and the mistake merely prevented an otherwise criminal act. &nbsp;</p><p>Here the defendantâ€™s mistake of fact does (not) negate implied criminal intent becauseâ€¦</p><p>&nbsp;Thereforeâ€¦</p>',1,0,NULL),(144,'DEFENSE OF LEGAL IMPOSSIBILITY?','criminal','<p>Under CRIMINAL LAW, LEGAL IMPOSSIBILITY &nbsp;means that an attempted act is not an attempted crime, even if there was criminal intent, when the attempted crime is a legal impossibility at the time of the first substantial step. &nbsp;</p><p>Here the crime charged was a legal impossibility becauseâ€¦ &nbsp;</p><p>Thereforeâ€¦</p>',1,0,NULL),(145,'DEFENSE of MISTAKE OF LAW?','criminal','<p>Under CRIMINAL LAW, A MISTAKE OF LAW about the legality &nbsp;of an act does not alter the legality of the act. If the defendant commits a criminal act believing it is legal, it is still an illegal act. Likewise, if the defendant commits a legal act believing it is illegal, it is still a legal act.</p><p>Here the defendantâ€™s act was legal (illegal) at the time it was committed becauseâ€¦</p><p>Thereforeâ€¦</p>',1,0,NULL),(146,'DEFENSE of FACTUAL IMPOSSIBILITY?','criminal','<p>Under CRIMINAL LAW, FACTUAL IMPOSSIBILITY is a defense that &nbsp;the act actually done by the defendant was NOT A SUBSTANTIAL STEP &nbsp;toward commission of any crime, despite criminal intent, because the act taken could never produce a criminal result.</p><p>Here the defendantâ€™s act was legal (illegal) at the time it was committed becauseâ€¦</p><p>Thereforeâ€¦</p>',1,0,NULL),(147,'DEFENSE of WITHDRAWAL?','criminal','<p>Under CRIMINAL LAW, WITHDRAWAL is a defense that &nbsp;defendants who were members of a CONSPIRACY (or perhaps are accomplices like those who have urged a crime to be committed) are not liable for crimes committed by co-criminals <b>AFTER</b> they have 1) given the co-criminals <b>NOTICE that they are abandoning</b> the criminal enterprise and 2) have TRIED TO STOP the co-criminals from continuing pursuit of the criminal goal.</p><p>Here the defendants did (not) give NOTICE they were abandoning the criminal goal (e.g. conspiracy goal) becauseâ€¦ And they did (not) TRY TO STOP the co-criminals from continuing becauseâ€¦Therefore.</p>',1,0,NULL),(148,'DEFENSE of INSANITY?','criminal','<p>Under CRIMINAL LAW insanity is a defense if it <b>negates criminal intent</b>. The insanity defense &nbsp;is now prescribed by statute in almost all jurisdictions. </p><p>Under the COMMON LAW Mâ€™NAUGHTEN RULE insanity was a defense if a <b>disease of the mind</b> at the <b>time of the act</b> prevented the defendant from <b>knowing</b> the nature and quality of his act, or<b> that they were wrong</b>. </p><p>Under the IRRESISTIBLE IMPULSE RULE insanity is a defense if the defendant knows it is wrong but cannot stop herself. &nbsp;Important!</p><p>Here the defendant would argue that â€¦Thereforeâ€¦</p>',1,0,NULL),(149,'DEFENSE of CONSENT?','criminal','<p>Under CRIMINAL LAW consent is a defense to some crimes. [e.g. rape, larceny, battery â€“ consent to a touching] The consent must be <b>informed</b>, <b>voluntary</b> and given by one with <b>legal capacity</b>. Further, consent is not a legal defense to an act that deliberately causes great bodily harm.</p><p>Hereâ€¦ becauseâ€¦Thereforeâ€¦</p>',1,0,NULL),(150,'DEFENSE of ENTRAPMENT?','criminal','<p>Under CRIMINAL LAW entrapment is a defense if <b>criminal intent</b> was the <b>product of improper police behavior</b>. &nbsp;Courts are split on the application of the entrapment defense, and under the majority view entrapment is no defense if the defendant was <b>predisposed</b> to commit the crime. &nbsp;Under another minority view entrapment is a defense if <b>police conduct was outrageous</b> and <b>instigated</b> the crime, even though the defendant was predisposed.</p><p>Hereâ€¦ becauseâ€¦Thereforeâ€¦</p>',1,0,NULL),(151,'DEFENSE of DURESS?','criminal','<p>Under CRIMINAL LAW a defense may be raised to crimes, EXCEPT MURDER, that the criminal act was the <b>result</b> of DURESS.&nbsp;</p><p>Hereâ€¦ becauseâ€¦Thereforeâ€¦</p>',1,0,NULL),(152,'DEFENSE of NECESSITY?','criminal','<p>Under CRIMINAL LAW a defense of NECESSITY may be raised to certain crimes.</p><p><b>[This defense is really nothing more than self-defense, defense of others, or defense of property. And it is probably best addressed under one of those categories in a criminal law answer. The term defense of â€˜necessityâ€™ more often has tort connotations, especially when it is a â€˜publicâ€™ necessity.]</b></p>',1,0,NULL),(153,'PREVENTION OF CRIME (AUTHORITY OF LAW)?','criminal','<p>Under CRIMINAL LAW a defendant is privileged to act with reasonable force to <b>PREVENT SERIOUS CRIMES</b> &nbsp;being committed in their presence. &nbsp;</p><p><b>[This is only a defense if a crime is about to be committed or already in progress and the defendant is preventing or stopping the crime in progress. It is no defense if the defendant acts AFTER THE CRIME IF OVER, except in the rare fact pattern when a fleeing felon (like a known serial-killer) is shot by police while fleeing because it is the only way to protect future victims from future crimes by the same felon.]</b></p><p>Here â€¦ becauseâ€¦Thereforeâ€¦</p>',1,0,NULL),(154,'SELF-DEFENSE?','criminal','<p>Under CRIMINAL LAW defendants who are NOT AGGRESSORS may act <b>reasonably</b> as <b>NECESSARY</b> to protect <b>their own safety</b>. Modernly defendants can â€œhold their groundâ€ and have is no duty to retreat in most jurisdictions. Aggressors are people who have unreasonably created or increased dangers to others. <b>Important!</b></p><p>Hereâ€¦becauseâ€¦Thereforeâ€¦</p>',1,0,NULL),(155,'DEFENSE of OTHERS?','criminal','<p>Under CRIMINAL LAW defendants are privileged to act <b>reasonably</b> as <b>necessary</b> to <b>defend others</b> who are NOT AGGRESSORS from harm. Aggressors are people who have unreasonably created or increased dangers to others. Courts are split when a defendant unknowingly acts to defend an AGGRESSOR. Under one view the defendant STEPS INTO THE SHOES &nbsp;of the aggressor and has no privilege because the aggressor could not claim self-defense. &nbsp;In other Courts the defendant is privileged to defend the aggressor in a fracas if they act with a <b>REASONABLE BELIEF</b> they are acting to defend an innocent victim of aggression.</p><p><b>[It is generally NOT reasonable (and not privileged) to shoot fleeing criminals. The only time it is justified by â€œdefense of othersâ€ is if the criminal poses a clear danger to the public safety and there is no other feasible way to stop the criminal from escaping. This is often tested.</b></p><p><b>The use of unreasonable force in self-defense, defense of others or defense of property results in an â€œimperfectâ€ defense claim. Where there is an â€œimperfectâ€ defense claim, the jury may consider the motivations of the defendant as a MITIGATING FACTOR.]</b></p><p>Here â€¦ becauseâ€¦Thereforeâ€¦</p>',1,0,NULL),(156,'DEFENSE of PROPERTY?','criminal','<p>Under CRIMINAL LAW a defendant is privileged to use reasonable force to protect his own property or the property of others from harm. It is never reasonable to use deadly force to merely protect property.</p><p><b>[Note: This is never a defense for the use of deadly force. A defendant has no right to shoot thieves who are running away. But this â€œimperfectâ€ defense will be a MITIGATING FACTOR for a jury to consider.]</b></p><p>Here â€¦ becauseâ€¦Thereforeâ€¦</p>',1,0,NULL),(157,'PLACEHOLDER','criminal',NULL,1,0,NULL),(158,'PLACEHOLDER','torts',NULL,1,0,NULL),(159,'PLACEHOLDER','contracts',NULL,1,0,NULL),(160,'Pinkerton\'s Rule','criminal','<p>Under the PINKERTON RULE, a member of a conspiracy is VICARIOUSLY LIABLE for the criminal acts of co-conspirators done WITHIN THE SCOPE of the conspiracy goal. This means crimes that were 1) foreseeable and 2) in furtherance of the conspiracy goal.</p><p>Even if the illegal goal of the conspiracy is attained, the CONSPIRACY DOES NOT MERGE into the criminal result, so each member can be convicted of both conspiracy and the other crimes committed during and within the scope of the conspiracy.</p><p>Here ... because....&nbsp;therefore ...</p><p><br></p>',1,0,NULL);

/*Table structure for table `med_stats` */

DROP TABLE IF EXISTS `med_stats`;

CREATE TABLE `med_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `display_gender` enum('male','female') DEFAULT NULL,
  `display_age` int(4) DEFAULT NULL,
  `display_date` date DEFAULT NULL,
  `submitted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `display_weight` int(4) DEFAULT NULL,
  `display_height` int(4) DEFAULT NULL,
  `problem_suffered` varchar(255) DEFAULT NULL,
  `description` text,
  `causes` varchar(255) DEFAULT NULL,
  `family_history` text,
  `medical_history` text,
  `disease` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `med_stats` */

/*Table structure for table `medical_daily_readings` */

DROP TABLE IF EXISTS `medical_daily_readings`;

CREATE TABLE `medical_daily_readings` (
  `reading_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `blood_pressure_upper` int(11) DEFAULT NULL,
  `blood_pressure_lower` int(11) DEFAULT NULL,
  `blood_suger_fasting` int(11) DEFAULT NULL,
  `blood_sugar_pp` int(11) DEFAULT NULL,
  `blood_sugar_random` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `reading_date` datetime DEFAULT NULL,
  PRIMARY KEY (`reading_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `medical_daily_readings` */

/*Table structure for table `medical_medicines` */

DROP TABLE IF EXISTS `medical_medicines`;

CREATE TABLE `medical_medicines` (
  `medicine_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date DEFAULT NULL,
  `medicine` varchar(200) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `information` text,
  PRIMARY KEY (`medicine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `medical_medicines` */

/*Table structure for table `medical_patient_record` */

DROP TABLE IF EXISTS `medical_patient_record`;

CREATE TABLE `medical_patient_record` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `family_history` text,
  `past_history` text,
  `gender` enum('male','female') DEFAULT NULL,
  `patient_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `medical_patient_record` */

/*Table structure for table `medical_reports` */

DROP TABLE IF EXISTS `medical_reports`;

CREATE TABLE `medical_reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  `report_type` varchar(200) DEFAULT NULL,
  `report_result` text,
  `file_path` text,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `medical_reports` */

/*Table structure for table `public_video_categories` */

DROP TABLE IF EXISTS `public_video_categories`;

CREATE TABLE `public_video_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `public_video_categories` */

/*Table structure for table `public_video_linking` */

DROP TABLE IF EXISTS `public_video_linking`;

CREATE TABLE `public_video_linking` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `public_video_linking` */

/*Table structure for table `public_videos` */

DROP TABLE IF EXISTS `public_videos`;

CREATE TABLE `public_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `video_created_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `video_year` int(4) DEFAULT NULL,
  `video_cast` text,
  `video_length` varchar(255) DEFAULT NULL,
  `video_language` varchar(255) DEFAULT NULL,
  `video_director` varchar(255) DEFAULT NULL,
  `video_genres` varchar(255) DEFAULT NULL,
  `video_image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `video_related` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `public_videos` */

/*Table structure for table `real_estate_properties` */

DROP TABLE IF EXISTS `real_estate_properties`;

CREATE TABLE `real_estate_properties` (
  `re_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `address` varchar(255) DEFAULT NULL,
  `re_lat` double DEFAULT NULL,
  `re_lng` double DEFAULT NULL,
  `property_type` int(11) DEFAULT NULL,
  `county` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `built_year` int(11) DEFAULT NULL,
  `mls_id` varchar(200) DEFAULT NULL,
  `lot_size` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `beds` int(11) DEFAULT NULL,
  `bath` double DEFAULT NULL,
  `sq_feet` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ac` int(1) DEFAULT NULL,
  `washer_dryer` int(1) DEFAULT NULL,
  `pets_allowed` int(1) DEFAULT NULL,
  `buy_rent` int(1) DEFAULT NULL,
  `property_created_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pool` int(1) DEFAULT NULL,
  `fitness` int(1) DEFAULT NULL,
  PRIMARY KEY (`re_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `real_estate_properties` */

/*Table structure for table `religions` */

DROP TABLE IF EXISTS `religions`;

CREATE TABLE `religions` (
  `religion_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `religion_name` varchar(255) DEFAULT NULL,
  `religion_description` text,
  `religion_creation_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `religion_status` int(1) NOT NULL DEFAULT '0',
  `religion_type` enum('public','closed') NOT NULL DEFAULT 'closed',
  `religion_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`religion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `religions` */

insert  into `religions`(`religion_id`,`user_id`,`religion_name`,`religion_description`,`religion_creation_dt`,`religion_status`,`religion_type`,`religion_image`) values (1,1,'Hindu Religion','My hindu Religion','2017-08-07 21:47:43',1,'public','http://www.hinduhumanrights.info/wp-content/uploads/2012/05/the-gods.jpg'),(2,1,'Manny\'s Religion 2','my new religion2','2017-09-08 22:05:32',1,'closed','https://avatars1.githubusercontent.com/u/5247621?v=4&s=460'),(3,1,'3rderere','rererereedfdfd','2017-09-08 22:05:42',0,'public','dfd');

/*Table structure for table `religions_follower` */

DROP TABLE IF EXISTS `religions_follower`;

CREATE TABLE `religions_follower` (
  `follower_id` int(11) NOT NULL AUTO_INCREMENT,
  `religion_id` int(11) DEFAULT NULL,
  `follower_user_id` int(11) DEFAULT NULL,
  `follower_date` datetime DEFAULT NULL,
  PRIMARY KEY (`follower_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `religions_follower` */

insert  into `religions_follower`(`follower_id`,`religion_id`,`follower_user_id`,`follower_date`) values (2,1,3,'2017-08-09 22:10:38'),(10,1,1,'2017-08-21 21:34:31'),(11,2,1,'2017-08-21 21:34:32'),(12,2,2,'2017-09-06 22:16:46');

/*Table structure for table `religions_like` */

DROP TABLE IF EXISTS `religions_like`;

CREATE TABLE `religions_like` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `view_id` int(11) DEFAULT NULL,
  `like_user_id` int(11) DEFAULT NULL,
  `like_date` datetime NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `religions_like` */

insert  into `religions_like`(`like_id`,`view_id`,`like_user_id`,`like_date`) values (2,396,2,'2017-08-16 21:51:45'),(10,395,1,'2017-08-17 22:06:03'),(11,257,1,'2017-08-17 22:13:59');

/*Table structure for table `religions_view` */

DROP TABLE IF EXISTS `religions_view`;

CREATE TABLE `religions_view` (
  `view_id` int(11) NOT NULL AUTO_INCREMENT,
  `view_user_id` int(11) DEFAULT NULL,
  `religion_id` int(11) DEFAULT NULL,
  `view_description` text,
  `category_id` int(2) DEFAULT NULL,
  `view_created_dt` datetime DEFAULT NULL,
  `view_status` int(1) NOT NULL DEFAULT '0',
  `view_images` text,
  `view_videos` text,
  `view_links` text,
  `from_religion_id` int(11) DEFAULT NULL,
  `from_verse_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`view_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `religions_view` */

insert  into `religions_view`(`view_id`,`view_user_id`,`religion_id`,`view_description`,`category_id`,`view_created_dt`,`view_status`,`view_images`,`view_videos`,`view_links`,`from_religion_id`,`from_verse_id`) values (1,2,1,'dfdfd',1,'2017-09-06 22:11:34',3,'[]','[]','[]',NULL,NULL),(2,1,1,'dfdfd',1,'2017-09-07 21:39:32',3,'[]','[]','[]',NULL,NULL),(3,1,1,'dfdfd',1,'2017-09-07 22:13:33',1,'[]','[]','[]',NULL,NULL),(4,1,2,'dfdf',1,'2017-09-07 22:14:14',1,'[]','[]','[]',NULL,NULL),(5,1,1,'dddd',1,'2017-09-08 21:51:01',1,'[]','[]','[]',NULL,NULL);

/*Table structure for table `rf_comments` */

DROP TABLE IF EXISTS `rf_comments`;

CREATE TABLE `rf_comments` (
  `rf_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `commentor_user_id` int(11) DEFAULT NULL,
  `comment` text,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rf_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `rf_comments` */

/*Table structure for table `rf_treatments` */

DROP TABLE IF EXISTS `rf_treatments`;

CREATE TABLE `rf_treatments` (
  `rf_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `problem` varchar(255) DEFAULT NULL,
  `treatment` enum('allopathy','surgery','ayurvedic','acupressure','acupuncture','aromatherapy','balneotherapy','biofeedback','chiropractic','homeopathy','naturopathy','reflexology','reiki','magnetotherapy','massagetherapy') DEFAULT NULL,
  `medicines_taken` text,
  `rf_description` text,
  `rf_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rf_age` int(4) DEFAULT NULL,
  `rf_gender` enum('male','female') DEFAULT NULL,
  `rf_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `rf_treatments` */

/*Table structure for table `sites` */

DROP TABLE IF EXISTS `sites`;

CREATE TABLE `sites` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) DEFAULT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `site_domain` varchar(255) DEFAULT NULL,
  `site_subtitle` text,
  `site_background_img` varchar(255) DEFAULT NULL,
  `site_rightside_img` varchar(255) DEFAULT NULL,
  `site_icon1` varchar(255) DEFAULT NULL,
  `site_icon1_title` varchar(255) DEFAULT NULL,
  `site_icon1_desc` text,
  `site_icon2` varchar(255) DEFAULT NULL,
  `site_icon2_title` varchar(255) DEFAULT NULL,
  `site_icon2_desc` text,
  `site_icon3` varchar(255) DEFAULT NULL,
  `site_icon3_title` varchar(255) DEFAULT NULL,
  `site_icon3_desc` text,
  `site_icon4` varchar(255) DEFAULT NULL,
  `site_icon4_title` varchar(255) DEFAULT NULL,
  `site_icon4_desc` text,
  `site_findoutmorelink` varchar(255) DEFAULT NULL,
  `site_sec_title` varchar(255) DEFAULT NULL,
  `site_sec_desc` text,
  `site_sec_link` varchar(255) DEFAULT NULL,
  `site_default_title` varchar(255) DEFAULT NULL,
  `site_default_desc` text,
  `site_default_image` varchar(255) DEFAULT NULL,
  `site_primary_title` varchar(255) DEFAULT NULL,
  `site_primary_desc` text,
  `site_primary_image` varchar(255) DEFAULT NULL,
  `site_our_team` text,
  `site_about_title` varchar(255) DEFAULT NULL,
  `site_about_desc` text,
  `site_about_image` varchar(255) DEFAULT NULL,
  `site_address` varchar(255) DEFAULT NULL,
  `site_phone` varchar(255) DEFAULT NULL,
  `site_email` varchar(255) DEFAULT NULL,
  `site_timings` varchar(255) DEFAULT NULL,
  `site_links` text,
  `site_admin_email` varchar(255) DEFAULT NULL,
  `site_lat` double DEFAULT NULL,
  `site_lng` double DEFAULT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `sites` */

insert  into `sites`(`site_id`,`site_name`,`site_title`,`site_domain`,`site_subtitle`,`site_background_img`,`site_rightside_img`,`site_icon1`,`site_icon1_title`,`site_icon1_desc`,`site_icon2`,`site_icon2_title`,`site_icon2_desc`,`site_icon3`,`site_icon3_title`,`site_icon3_desc`,`site_icon4`,`site_icon4_title`,`site_icon4_desc`,`site_findoutmorelink`,`site_sec_title`,`site_sec_desc`,`site_sec_link`,`site_default_title`,`site_default_desc`,`site_default_image`,`site_primary_title`,`site_primary_desc`,`site_primary_image`,`site_our_team`,`site_about_title`,`site_about_desc`,`site_about_image`,`site_address`,`site_phone`,`site_email`,`site_timings`,`site_links`,`site_admin_email`,`site_lat`,`site_lng`) values (1,'My Religion','My Incredible Religion','myreligion.tk','Convert your ideas into your Religion','http://quotesideas.com/wp-content/uploads/2015/02/Religion-quote-on-background-hd-2015.jpeg','http://www.allahsword.com/images/books/comparative_religion/comparative_religion_main.png','fa-hand-o-up','Belief','Believe in your own religion. Your views are your religion.','fa-gavel','Leadership','Be a leader of your own religion.','fa-book','Holy Book','Create your holy book by adding your views as verses.','fa-user','Founder','You are the founder of your own religion.',NULL,'Religious Slogan','Science without religion is lame, religion without science is blind.','about.php','Religious Belief','<ul class=\"feature-list\">\r\n<li><i class=\"glyphicon glyphicon-ok\"></i> Faith - It does not make things easy, it makes them possible.</li>\r\n<li><i class=\"glyphicon glyphicon-ok\"></i> Free Trip to heaven. Details Inside.</li>\r\n<li><i class=\"glyphicon glyphicon-ok\"></i> God can hear you.</li>\r\n<li><i class=\"glyphicon glyphicon-ok\"></i> God has a great plan for your life.1</li>\r\n<li><i class=\"glyphicon glyphicon-ok\"></i> God is stronger than my circumstances.</li>\r\n</ul>','https://www.prageru.com/sites/default/files/courses/badges/badge_religioustolerancemadeinamerica.png','More Religious Belief','<ul class=\"feature-list\">\r\n<li><i class=\"glyphicon glyphicon-ok\"></i> I believe in God. Never panic, just pray.</li>\r\n<li><i class=\"glyphicon glyphicon-ok\"></i> If God is for us, Who can be against us?</li>\r\n<li><i class=\"glyphicon glyphicon-ok\"></i> Know God, Know Peace; No God, No Peace.</li>\r\n<li><i class=\"glyphicon glyphicon-ok\"></i> People are like tea bags ï¿½ you have to put them in hot water before you know how strong they are.</li>\r\n</ul>','http://i.dailymail.co.uk/i/pix/2017/03/10/14/3E234A1D00000578-4301306-image-a-33_1489155831037.jpg','[{\"name\":\"Manish Khanchandani\",\"image\":\"http:\\/\\/lifereminder.tk\\/images\\/mk.jpg\",\"designation\":\"Sr. Web Developer\",\"fb\":\"https:\\/\\/www.facebook.com\\/nkhanchandani7\",\"tw\":\"https:\\/\\/twitter.com\\/ManishK92468643\",\"ln\":\"\",\"gp\":\"https:\\/\\/plus.google.com\\/u\\/0\\/100546875099861959996\",\"description\":\"15 years of experience in Web Development. Working on Angular JS, React JS, PHP, Mysql, Javascript, Bootstrap CSS, etc.\"},{\"name\":\"Carrie Parecki\",\"image\":\"http:\\/\\/carrieparecki.com\\/project2017\\/lr\\/images\\/2k_carrie_parecki_square.jpg\",\"designation\":\"Webmaster\",\"fb\":\"https:\\/\\/www.facebook.com\\/carrie.dinitz\",\"tw\":\"https:\\/\\/twitter.com\\/CarrieParecki\",\"ln\":\"\",\"gp\":\"https:\\/\\/plus.google.com\\/u\\/0\\/107540902803960382512\",\"description\":\"Over 10 years of professional experience as a Webmaster, Web assistant, UI Technical Artist and Web and Graphic Designer using HTML, CSS, Dreamweaver, Drupal, Photoshop, and the latest web and 3D technologies.\"},{\"name\":\"Kate\",\"image\":\"http:\\/\\/localhost\\/project100\\/0001_myreligion\\/images\\/kate.jpg\",\"designation\":\"Web developer\",\"fb\":\"https:\\/\\/www.facebook.com\\/kate.liu.733\",\"tw\":\"https:\\/\\/twitter.com\\/earlybirdcatcat\",\"ln\":\"\",\"gp\":\"http:\\/\\/google.com\\/\",\"description\":\" Bachelor\\u2019s degree and Certification in Graphic Design, Certification in Web Site Design, and have a total work experience of 7 years. I am well versed in different areas of front-end web design\\/development and have successfully designed solutions for print media and websites.\\r\\n\\r\\n\"},{\"name\":\"Tamilselvan Karunanidhy\",\"image\":\"http:\\/\\/localhost\\/project100\\/0001_myreligion\\/images\\/tamil.jpg\",\"designation\":\"Senior Software QA Engineer\",\"fb\":\"https:\\/\\/www.facebook.com\\/tkarunanidhy\",\"tw\":\"https:\\/\\/twitter.com\\/tamus1983\",\"ln\":\"\",\"gp\":\"https:\\/\\/plus.google.com\\/u\\/0\\/+tamilselvankarunanidhy\",\"description\":\"10 years of experience in QA, testing & Automation for SaaS, API, iOS and Android Apps\"}]',NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas volutpat, sem quis ornare bibendum, metus odio commodo ante, sit amet finibus sapien nibh vel augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas risus nunc, tristique ac mi non, elementum venenatis elit. Nullam ornare laoreet justo, in dignissim ligula faucibus sit amet.\r\n\r\nSuspendisse tristique diam eu ex dapibus, non finibus quam pellentesque. Fusce eleifend magna vitae sem maximus, eu luctus eros finibus. Aliquam urna leo, finibus vel turpis eget, pretium hendrerit metus. Sed a leo elementum, tempor purus at, lacinia lorem. Praesent porttitor sed ipsum at consequat. Nunc\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas risus nunc, tristique ac mi non, elementum venenatis elit. Nullam ornare laoreet justo, in dignissim ligula faucibus sit amet.','http://lifereminder.tk/images/puzzle.jpg','89 West Main st Merrimac, MA 01860','(555) 555-5555','site@myreligion.tk','Monday - Friday: 9.00 am to 5.00 pm',NULL,'manishkk74@gmail.com',12,13);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `created_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `access_level` enum('member','admin') DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `users` */

/*Table structure for table `users_auth` */

DROP TABLE IF EXISTS `users_auth`;

CREATE TABLE `users_auth` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(255) DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `provider_id` enum('google.com','facebook.com','twitter.com','github.com','email1','email2') DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `access_level` enum('member','admin') NOT NULL DEFAULT 'member',
  `user_created_dt` datetime DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `logged_in_time` bigint(20) DEFAULT NULL,
  `profile_uid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users_auth` */

insert  into `users_auth`(`user_id`,`display_name`,`profile_img`,`email`,`provider_id`,`password`,`access_level`,`user_created_dt`,`uid`,`logged_in_time`,`profile_uid`) values (1,'Manish Khanchandani','https://lh6.googleusercontent.com/-nLg0dFRo0DQ/AAAAAAAAAAI/AAAAAAAArjM/wWzo9wl_lFM/photo.jpg','manishkk74@gmail.com','google.com',NULL,'admin','2017-09-06 21:30:18','W5F3YbU9OTdrDccldzyEnulJp3G2',1504931636,'112913147917981568678'),(2,'Manish Khanchandani','https://scontent.xx.fbcdn.net/v/t1.0-1/p100x100/20229418_10155362155310977_5074678007866764600_n.jpg?oh=edf9f65da26bc84158e548a42e5daebe&oe=59FDF3D9','naveenkhanchandani@gmail.com','facebook.com',NULL,'member','2017-09-06 21:31:05','OKzxRDR5PER9pdgATFoOaM08GRw2',1504761155,'10155378930760977');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

/*
SQLyog Community Edition- MySQL GUI v6.16
MySQL - 5.1.41 : Database - s2s_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `s2s_new`;

USE `s2s_new`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `acos` */

DROP TABLE IF EXISTS `acos`;

CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8;

/*Data for the table `acos` */

insert  into `acos`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,NULL,NULL,'controllers',1,270),(2,1,NULL,NULL,'Pages',2,5),(3,2,NULL,NULL,'display',3,4),(9,1,NULL,NULL,'Addresses',6,9),(10,9,NULL,NULL,'index',7,8),(15,1,NULL,NULL,'Carts',10,21),(16,15,NULL,NULL,'index',11,12),(17,15,NULL,NULL,'view',13,14),(18,15,NULL,NULL,'add',15,16),(19,15,NULL,NULL,'edit',17,18),(20,15,NULL,NULL,'delete',19,20),(21,1,NULL,NULL,'Customers',22,37),(22,21,NULL,NULL,'index',23,24),(23,21,NULL,NULL,'view',25,26),(25,21,NULL,NULL,'edit',27,28),(26,21,NULL,NULL,'delete',29,30),(27,1,NULL,NULL,'Groups',38,61),(28,27,NULL,NULL,'parentNode',39,40),(29,27,NULL,NULL,'index',41,42),(30,27,NULL,NULL,'view',43,44),(31,27,NULL,NULL,'add',45,46),(32,27,NULL,NULL,'edit',47,48),(33,27,NULL,NULL,'delete',49,50),(34,27,NULL,NULL,'admin_index',51,52),(35,27,NULL,NULL,'admin_view',53,54),(36,27,NULL,NULL,'admin_add',55,56),(37,27,NULL,NULL,'admin_edit',57,58),(38,27,NULL,NULL,'admin_delete',59,60),(47,1,NULL,NULL,'Merchants',62,81),(48,47,NULL,NULL,'register',63,64),(49,47,NULL,NULL,'login',65,66),(50,47,NULL,NULL,'logout',67,68),(51,47,NULL,NULL,'admin_index',69,70),(52,47,NULL,NULL,'edit',71,72),(53,47,NULL,NULL,'platform_index',73,74),(54,47,NULL,NULL,'platform_view',75,76),(55,47,NULL,NULL,'platform_edit',77,78),(56,47,NULL,NULL,'platform_delete',79,80),(61,1,NULL,NULL,'Orders',82,93),(62,61,NULL,NULL,'index',83,84),(63,61,NULL,NULL,'view',85,86),(64,61,NULL,NULL,'add',87,88),(65,61,NULL,NULL,'edit',89,90),(66,61,NULL,NULL,'delete',91,92),(67,1,NULL,NULL,'PageTypes',94,105),(68,67,NULL,NULL,'index',95,96),(69,67,NULL,NULL,'view',97,98),(70,67,NULL,NULL,'add',99,100),(71,67,NULL,NULL,'edit',101,102),(72,67,NULL,NULL,'delete',103,104),(73,1,NULL,NULL,'Payments',106,117),(74,73,NULL,NULL,'index',107,108),(75,73,NULL,NULL,'view',109,110),(76,73,NULL,NULL,'add',111,112),(77,73,NULL,NULL,'edit',113,114),(78,73,NULL,NULL,'delete',115,116),(79,1,NULL,NULL,'Products',118,145),(80,79,NULL,NULL,'admin_index',119,120),(81,79,NULL,NULL,'index',121,122),(82,79,NULL,NULL,'view',123,124),(86,1,NULL,NULL,'ProductImages',146,169),(87,86,NULL,NULL,'index',147,148),(88,86,NULL,NULL,'view',149,150),(90,86,NULL,NULL,'edit',151,152),(91,86,NULL,NULL,'delete',153,154),(92,1,NULL,NULL,'Shops',170,181),(93,92,NULL,NULL,'index',171,172),(94,92,NULL,NULL,'view',173,174),(95,92,NULL,NULL,'add',175,176),(96,92,NULL,NULL,'edit',177,178),(97,92,NULL,NULL,'delete',179,180),(98,1,NULL,NULL,'Users',182,219),(99,98,NULL,NULL,'parentNode',183,184),(100,98,NULL,NULL,'index',185,186),(101,98,NULL,NULL,'view',187,188),(102,98,NULL,NULL,'add',189,190),(103,98,NULL,NULL,'edit',191,192),(104,98,NULL,NULL,'login',193,194),(105,98,NULL,NULL,'logout',195,196),(106,98,NULL,NULL,'platform_login',197,198),(107,98,NULL,NULL,'platform_logout',199,200),(108,98,NULL,NULL,'platform_index',201,202),(109,98,NULL,NULL,'delete',203,204),(110,98,NULL,NULL,'admin_index',205,206),(111,98,NULL,NULL,'admin_view',207,208),(112,98,NULL,NULL,'admin_add',209,210),(113,98,NULL,NULL,'admin_edit',211,212),(114,98,NULL,NULL,'admin_delete',213,214),(115,98,NULL,NULL,'afterSave',215,216),(116,1,NULL,NULL,'Webpages',220,241),(117,116,NULL,NULL,'index',221,222),(118,116,NULL,NULL,'view',223,224),(119,116,NULL,NULL,'add',225,226),(120,116,NULL,NULL,'edit',227,228),(121,116,NULL,NULL,'delete',229,230),(122,116,NULL,NULL,'admin_index',231,232),(123,116,NULL,NULL,'admin_view',233,234),(124,116,NULL,NULL,'admin_add',235,236),(125,116,NULL,NULL,'admin_edit',237,238),(126,116,NULL,NULL,'admin_delete',239,240),(137,79,NULL,NULL,'admin_view',125,126),(138,79,NULL,NULL,'admin_add',127,128),(139,79,NULL,NULL,'admin_edit',129,130),(140,79,NULL,NULL,'admin_delete',131,132),(141,79,NULL,NULL,'platform_index',133,134),(142,79,NULL,NULL,'platform_view',135,136),(143,79,NULL,NULL,'platform_add',137,138),(144,79,NULL,NULL,'platform_edit',139,140),(145,79,NULL,NULL,'platform_delete',141,142),(149,98,NULL,NULL,'initDB',217,218),(152,86,NULL,NULL,'admin_index',155,156),(153,86,NULL,NULL,'admin_view',157,158),(154,86,NULL,NULL,'admin_add',159,160),(155,86,NULL,NULL,'admin_edit',161,162),(156,86,NULL,NULL,'admin_delete',163,164),(157,21,NULL,NULL,'register',31,32),(158,21,NULL,NULL,'login',33,34),(159,21,NULL,NULL,'logout',35,36),(160,1,NULL,NULL,'Domains',242,253),(161,160,NULL,NULL,'admin_index',243,244),(162,160,NULL,NULL,'admin_view',245,246),(163,160,NULL,NULL,'admin_add',247,248),(164,160,NULL,NULL,'admin_edit',249,250),(165,160,NULL,NULL,'admin_delete',251,252),(173,1,NULL,NULL,'Themes',254,255),(293,1,NULL,NULL,'AclExtras',256,257),(294,1,NULL,NULL,'CodeCheck',258,259),(296,1,NULL,NULL,'Linkable',260,261),(297,1,NULL,NULL,'MeioUpload',262,263),(298,79,NULL,NULL,'admin_duplicate',143,144),(299,86,NULL,NULL,'admin_list_by_product',165,166),(300,1,NULL,NULL,'Copyable',264,265),(301,1,NULL,NULL,'MeioDuplicate',266,267),(302,86,NULL,NULL,'admin_change_active_status',167,168),(303,1,NULL,NULL,'Recaptcha',268,269);

/*Table structure for table `addresses` */

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `country` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `addresses` */

/*Table structure for table `aros` */

DROP TABLE IF EXISTS `aros`;

CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `aros` */

insert  into `aros`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'Group',1,'administrators',1,2),(2,NULL,'Group',2,'editors',3,4),(3,NULL,'Group',3,'merchants',5,342),(4,NULL,'Group',4,'customers',343,346),(5,3,'User',1,NULL,6,7),(6,3,'User',2,NULL,8,9),(7,3,'User',2,NULL,10,11),(8,3,'User',1,NULL,12,13),(9,3,'User',1,NULL,14,15),(10,3,'User',1,NULL,16,17),(11,3,'User',1,NULL,18,19),(12,3,'User',1,NULL,20,21),(13,3,'User',1,NULL,22,23),(14,3,'User',1,NULL,24,25),(15,3,'User',1,NULL,26,27),(16,3,'User',2,NULL,28,29),(17,3,'User',2,NULL,30,31),(18,3,'User',2,NULL,32,33),(19,3,'User',2,NULL,34,35),(20,3,'User',2,NULL,36,37),(21,3,'User',2,NULL,38,39),(22,3,'User',2,NULL,40,41),(23,3,'User',2,NULL,42,43),(24,3,'User',2,NULL,44,45),(25,3,'User',2,NULL,46,47),(26,3,'User',2,NULL,48,49),(27,3,'User',2,NULL,50,51),(28,3,'User',2,NULL,52,53),(29,3,'User',2,NULL,54,55),(30,3,'User',2,NULL,56,57),(31,3,'User',2,NULL,58,59),(32,NULL,'User',2,NULL,347,348),(33,NULL,'User',2,NULL,349,350),(34,NULL,'User',2,NULL,351,352),(35,NULL,'User',2,NULL,353,354),(36,NULL,'User',2,NULL,355,356),(37,NULL,'User',2,NULL,357,358),(38,NULL,'User',2,NULL,359,360),(39,NULL,'User',2,NULL,361,362),(40,NULL,'User',2,NULL,363,364),(41,NULL,'User',2,NULL,365,366),(42,NULL,'User',2,NULL,367,368),(43,NULL,'User',2,NULL,369,370),(44,NULL,'User',2,NULL,371,372),(45,NULL,'User',2,NULL,373,374),(46,NULL,'User',2,NULL,375,376),(47,NULL,'User',3,NULL,377,378),(48,NULL,'User',2,NULL,379,380),(49,NULL,'User',2,NULL,381,382),(50,NULL,'User',2,NULL,383,384),(51,NULL,'User',2,NULL,385,386),(52,3,'User',2,NULL,60,61),(53,NULL,'User',2,NULL,387,388),(54,3,'User',2,NULL,62,63),(55,NULL,'User',2,NULL,389,390),(56,3,'User',2,NULL,64,65),(57,NULL,'User',2,NULL,391,392),(58,3,'User',2,NULL,66,67),(59,NULL,'User',2,NULL,393,394),(60,NULL,'User',2,NULL,395,396),(61,NULL,'User',2,NULL,397,398),(62,NULL,'User',2,NULL,399,400),(63,NULL,'User',2,NULL,401,402),(64,3,'User',2,NULL,68,69),(65,3,'User',2,NULL,70,71),(66,3,'User',2,NULL,72,73),(67,3,'User',2,NULL,74,75),(68,3,'User',4,NULL,76,77),(69,3,'User',5,NULL,78,79),(70,3,'User',2,NULL,80,81),(71,3,'User',2,NULL,82,83),(72,3,'User',2,NULL,84,85),(73,3,'User',2,NULL,86,87),(74,3,'User',6,NULL,88,89),(75,3,'User',7,NULL,90,91),(76,3,'User',2,NULL,92,93),(77,3,'User',2,NULL,94,95),(78,3,'User',2,NULL,96,97),(79,3,'User',2,NULL,98,99),(80,3,'User',2,NULL,100,101),(81,3,'User',2,NULL,102,103),(82,3,'User',2,NULL,104,105),(83,3,'User',2,NULL,106,107),(84,3,'User',2,NULL,108,109),(85,3,'User',2,NULL,110,111),(86,3,'User',2,NULL,112,113),(87,3,'User',2,NULL,114,115),(88,3,'User',2,NULL,116,117),(89,3,'User',2,NULL,118,119),(90,3,'User',2,NULL,120,121),(91,3,'User',2,NULL,122,123),(92,4,'User',6,NULL,344,345),(93,3,'User',2,NULL,124,125),(94,3,'User',2,NULL,126,127),(95,3,'User',2,NULL,128,129),(96,3,'User',2,NULL,130,131),(97,3,'User',2,NULL,132,133),(98,3,'User',2,NULL,134,135),(99,3,'User',2,NULL,136,137),(100,3,'User',2,NULL,138,139),(101,3,'User',2,NULL,140,141),(102,3,'User',2,NULL,142,143),(103,3,'User',2,NULL,144,145),(104,3,'User',2,NULL,146,147),(105,3,'User',2,NULL,148,149),(106,3,'User',2,NULL,150,151),(107,3,'User',2,NULL,152,153),(108,3,'User',2,NULL,154,155),(109,3,'User',2,NULL,156,157),(110,3,'User',2,NULL,158,159),(111,3,'User',2,NULL,160,161),(112,3,'User',2,NULL,162,163),(113,3,'User',2,NULL,164,165),(114,3,'User',2,NULL,166,167),(115,3,'User',2,NULL,168,169),(116,3,'User',2,NULL,170,171),(117,3,'User',2,NULL,172,173),(118,3,'User',2,NULL,174,175),(119,3,'User',2,NULL,176,177),(120,3,'User',2,NULL,178,179),(121,3,'User',2,NULL,180,181),(122,3,'User',2,NULL,182,183),(123,3,'User',2,NULL,184,185),(124,3,'User',2,NULL,186,187),(125,3,'User',2,NULL,188,189),(126,3,'User',2,NULL,190,191),(127,3,'User',2,NULL,192,193),(128,3,'User',2,NULL,194,195),(129,3,'User',2,NULL,196,197),(130,3,'User',2,NULL,198,199),(131,3,'User',2,NULL,200,201),(132,3,'User',2,NULL,202,203),(133,3,'User',2,NULL,204,205),(134,3,'User',2,NULL,206,207),(135,3,'User',2,NULL,208,209),(136,3,'User',2,NULL,210,211),(137,3,'User',2,NULL,212,213),(138,3,'User',2,NULL,214,215),(139,3,'User',2,NULL,216,217),(140,3,'User',2,NULL,218,219),(141,3,'User',2,NULL,220,221),(142,3,'User',2,NULL,222,223),(143,3,'User',2,NULL,224,225),(144,3,'User',2,NULL,226,227),(145,3,'User',2,NULL,228,229),(146,3,'User',2,NULL,230,231),(147,3,'User',2,NULL,232,233),(148,3,'User',2,NULL,234,235),(149,3,'User',2,NULL,236,237),(150,3,'User',2,NULL,238,239),(151,3,'User',2,NULL,240,241),(152,3,'User',2,NULL,242,243),(153,3,'User',2,NULL,244,245),(154,3,'User',2,NULL,246,247),(155,3,'User',2,NULL,248,249),(156,3,'User',2,NULL,250,251),(157,3,'User',2,NULL,252,253),(158,3,'User',2,NULL,254,255),(159,3,'User',2,NULL,256,257),(160,3,'User',2,NULL,258,259),(161,3,'User',2,NULL,260,261),(162,3,'User',2,NULL,262,263),(163,3,'User',2,NULL,264,265),(164,3,'User',2,NULL,266,267),(165,3,'User',2,NULL,268,269),(166,3,'User',2,NULL,270,271),(167,3,'User',2,NULL,272,273),(168,3,'User',2,NULL,274,275),(169,3,'User',2,NULL,276,277),(170,3,'User',2,NULL,278,279),(171,3,'User',2,NULL,280,281),(172,3,'User',2,NULL,282,283),(173,3,'User',2,NULL,284,285),(174,3,'User',2,NULL,286,287),(175,3,'User',2,NULL,288,289),(176,3,'User',2,NULL,290,291),(177,3,'User',2,NULL,292,293),(178,3,'User',2,NULL,294,295),(179,3,'User',2,NULL,296,297),(180,3,'User',2,NULL,298,299),(181,3,'User',2,NULL,300,301),(182,3,'User',2,NULL,302,303),(183,3,'User',2,NULL,304,305),(184,3,'User',2,NULL,306,307),(185,3,'User',2,NULL,308,309),(186,3,'User',2,NULL,310,311),(187,3,'User',2,NULL,312,313),(188,3,'User',2,NULL,314,315),(189,3,'User',2,NULL,316,317),(190,3,'User',2,NULL,318,319),(191,3,'User',2,NULL,320,321),(192,3,'User',2,NULL,322,323),(193,3,'User',2,NULL,324,325),(194,3,'User',2,NULL,326,327),(195,3,'User',2,NULL,328,329),(196,3,'User',2,NULL,330,331),(197,3,'User',2,NULL,332,333),(198,3,'User',2,NULL,334,335),(199,3,'User',2,NULL,336,337),(200,3,'User',2,NULL,338,339),(201,3,'User',6,NULL,340,341);

/*Table structure for table `aros_acos` */

DROP TABLE IF EXISTS `aros_acos`;

CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`),
  UNIQUE KEY `aro_id` (`aro_id`,`aco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

/*Data for the table `aros_acos` */

insert  into `aros_acos`(`id`,`aro_id`,`aco_id`,`_create`,`_read`,`_update`,`_delete`) values (1,1,1,'1','1','1','1'),(2,2,1,'-1','-1','-1','-1'),(3,2,79,'1','1','1','1'),(4,2,92,'1','1','1','1'),(5,3,1,'-1','-1','-1','-1'),(9,3,50,'1','1','1','1'),(10,3,49,'1','1','1','1'),(11,3,51,'1','1','1','1'),(12,3,80,'1','1','1','1'),(13,3,52,'1','1','1','1'),(14,3,138,'1','1','1','1'),(15,3,139,'1','1','1','1'),(16,3,140,'1','1','1','1'),(17,3,137,'1','1','1','1'),(18,3,154,'1','1','1','1'),(19,3,155,'1','1','1','1'),(20,3,156,'1','1','1','1'),(21,3,153,'1','1','1','1'),(22,3,152,'1','1','1','1'),(23,4,103,'1','1','1','1'),(24,4,105,'1','1','1','1'),(25,4,104,'1','1','1','1'),(26,4,3,'1','1','1','1'),(27,4,25,'1','1','1','1'),(28,4,159,'1','1','1','1'),(29,4,158,'1','1','1','1'),(30,2,3,'1','1','1','1'),(31,3,3,'1','1','1','1'),(32,4,1,'-1','-1','-1','-1'),(33,2,98,'1','1','1','1'),(34,2,160,'1','1','1','1'),(35,3,163,'1','1','1','1'),(36,3,164,'1','1','1','1'),(37,3,165,'1','1','1','1'),(38,3,162,'1','1','1','1'),(39,3,161,'1','1','1','1'),(41,3,96,'1','1','1','1'),(42,3,299,'1','1','1','1'),(43,3,302,'1','1','1','1');

/*Table structure for table `cart_items` */

DROP TABLE IF EXISTS `cart_items`;

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `product_quantity` int(4) NOT NULL DEFAULT '1',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cart_items` */

/*Table structure for table `carts` */

DROP TABLE IF EXISTS `carts`;

CREATE TABLE `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` float(10,2) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `carts` */

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_code` varchar(255) DEFAULT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `customers` */

/*Table structure for table `domains` */

DROP TABLE IF EXISTS `domains`;

CREATE TABLE `domains` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `primary` tinyint(1) NOT NULL DEFAULT '0',
  `always_redirect_here` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `domains` */

insert  into `domains`(`id`,`domain`,`shop_id`,`primary`,`always_redirect_here`) values (1,'http://localhost',5,1,0),(3,'http://shop4.myspree2shop.com',5,0,0),(4,'http://shop3.myspree2shop.com',4,1,0),(5,'http://shop7.myspree2shop.com',6,1,0);

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`created_on`,`modified_on`) values (1,'administrators','2010-04-25 05:41:00','2010-04-25 05:41:00'),(2,'editors','2010-04-25 05:42:00','2010-04-25 05:42:00'),(3,'merchants','2010-04-25 05:42:00','2010-04-25 05:42:00'),(4,'customers','2010-04-25 05:42:00','2010-04-25 05:42:00');

/*Table structure for table `merchants` */

DROP TABLE IF EXISTS `merchants`;

CREATE TABLE `merchants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` tinyint(1) NOT NULL DEFAULT '0',
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `merchants` */

insert  into `merchants`(`id`,`owner`,`shop_id`,`user_id`) values (7,1,1,1),(8,1,2,2),(9,1,3,3),(10,1,4,4),(11,1,5,5),(12,1,6,6);

/*Table structure for table `order_line_items` */

DROP TABLE IF EXISTS `order_line_items`;

CREATE TABLE `order_line_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `product_quantity` int(4) NOT NULL DEFAULT '1',
  `status` int(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `order_line_items` */

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `billing_address_id` int(11) NOT NULL,
  `delivery_address_id` int(11) NOT NULL,
  `order_no` varchar(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` float(10,2) NOT NULL,
  `status` int(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `orders` */

/*Table structure for table `page_types` */

DROP TABLE IF EXISTS `page_types`;

CREATE TABLE `page_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `alias` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `page_types` */

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payments` */

/*Table structure for table `product_images` */

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `cover` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `mimetype` varchar(255) DEFAULT NULL,
  `filesize` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`cover`,`status`,`created`,`modified`,`filename`,`dir`,`mimetype`,`filesize`) values (1,0,1,1,'2010-05-20 07:59:19','2010-05-20 07:59:19','default.jpg','uploads\\products','image/jpeg',6103),(2,3,1,0,'2010-05-20 12:48:03','2010-05-20 12:48:03','2nd.jpg','uploads\\products','image/jpeg',107266);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `description` text,
  `price` float(10,2) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `products` */

insert  into `products`(`id`,`shop_id`,`title`,`code`,`description`,`price`,`created_on`,`modified_on`,`status`) values (1,0,'Dummy Product',NULL,NULL,0.00,'2010-05-20 08:00:24','0000-00-00 00:00:00',1),(3,5,'product test','test','asdsadsadasd',123.00,'2010-05-20 12:47:39','0000-00-00 00:00:00',1);

/*Table structure for table `schema_migrations` */

DROP TABLE IF EXISTS `schema_migrations`;

CREATE TABLE `schema_migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `schema_migrations` */

insert  into `schema_migrations`(`id`,`version`,`type`,`created`) values (1,1,'migrations','2010-04-28 15:32:36'),(2,1,'app','2010-04-28 15:32:52'),(3,3,'app','2010-04-28 15:34:34');

/*Table structure for table `shops` */

DROP TABLE IF EXISTS `shops`;

CREATE TABLE `shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `web_address` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `shops` */

insert  into `shops`(`id`,`theme_id`,`name`,`web_address`,`created_on`,`modified_on`,`status`) values (1,1,'a','http://a.myspree2shop.com','2010-04-25 06:13:48','2010-04-28 13:31:43',1),(2,1,'abcde','http://shop1.myspree2shop.com','2010-04-26 02:39:27','2010-04-28 13:31:43',1),(3,1,'shop2','http://shop2.myspree2shop.com','2010-04-26 02:43:00','2010-04-28 13:31:43',1),(4,1,'shop3','http://shop3.myspree2shop.com','2010-04-26 03:19:15','2010-04-28 13:31:43',1),(5,1,'shop4','http://shop4.myspree2shop.com','2010-04-26 03:20:22','2010-04-28 13:31:43',1),(6,0,'shop7','http://shop7.myspree2shop.com','2010-05-20 08:11:42','0000-00-00 00:00:00',1);

/*Table structure for table `themes` */

DROP TABLE IF EXISTS `themes`;

CREATE TABLE `themes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `available_for_all` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `themes` */

insert  into `themes`(`id`,`name`,`description`,`author`,`created`,`modified`,`available_for_all`) values (1,'blue-white','blue-white','kimsia','2010-05-13 00:00:00','2010-05-13 00:00:00',1),(2,'orange','orange','kimsia','2010-05-13 00:00:00','2010-05-13 00:00:00',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `name_to_call` varchar(255) NOT NULL,
  `last_login_on` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`group_id`,`full_name`,`name_to_call`,`last_login_on`,`status`,`created_on`,`modified_on`) values (1,'m1@a.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'full name','ally',NULL,1,'2010-04-25 06:13:48','0000-00-00 00:00:00'),(2,'merchant1@shop1.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',0,'full','barry',NULL,1,'2010-04-26 02:39:27','0000-00-00 00:00:00'),(3,'owner@shop2.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',0,'cherry','cherry',NULL,1,'2010-04-26 02:43:00','0000-00-00 00:00:00'),(4,'owner@shop3.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'dolly','dolly',NULL,1,'2010-04-26 03:19:15','0000-00-00 00:00:00'),(5,'owner@shop4.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'evey','evey',NULL,1,'2010-04-26 03:20:22','0000-00-00 00:00:00'),(6,'owner@shop7.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'cherry','cherry',NULL,1,'2010-05-20 08:11:42','0000-00-00 00:00:00');

/*Table structure for table `webpages` */

DROP TABLE IF EXISTS `webpages`;

CREATE TABLE `webpages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `page_type_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `meta_title` text,
  `meta_keywords` text,
  `meta_description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `webpages` */

/*Table structure for table `wishlists` */

DROP TABLE IF EXISTS `wishlists`;

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_id` (`customer_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `wishlists` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

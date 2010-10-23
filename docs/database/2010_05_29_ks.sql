/*
SQLyog Community v8.4 
MySQL - 5.1.41 : Database - s2s_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`s2s_new` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `s2s_new`;

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
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=utf8;

/*Data for the table `acos` */

insert  into `acos`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,NULL,NULL,'controllers',1,304),(2,1,NULL,NULL,'Pages',2,7),(3,2,NULL,NULL,'display',3,4),(9,1,NULL,NULL,'Addresses',8,13),(10,9,NULL,NULL,'index',9,10),(15,1,NULL,NULL,'Carts',14,27),(16,15,NULL,NULL,'index',15,16),(17,15,NULL,NULL,'view',17,18),(18,15,NULL,NULL,'add',19,20),(19,15,NULL,NULL,'edit',21,22),(20,15,NULL,NULL,'delete',23,24),(21,1,NULL,NULL,'Customers',28,45),(22,21,NULL,NULL,'index',29,30),(23,21,NULL,NULL,'view',31,32),(25,21,NULL,NULL,'edit',33,34),(26,21,NULL,NULL,'delete',35,36),(27,1,NULL,NULL,'Groups',46,71),(28,27,NULL,NULL,'parentNode',47,48),(29,27,NULL,NULL,'index',49,50),(30,27,NULL,NULL,'view',51,52),(31,27,NULL,NULL,'add',53,54),(32,27,NULL,NULL,'edit',55,56),(33,27,NULL,NULL,'delete',57,58),(34,27,NULL,NULL,'admin_index',59,60),(35,27,NULL,NULL,'admin_view',61,62),(36,27,NULL,NULL,'admin_add',63,64),(37,27,NULL,NULL,'admin_edit',65,66),(38,27,NULL,NULL,'admin_delete',67,68),(47,1,NULL,NULL,'Merchants',72,93),(48,47,NULL,NULL,'register',73,74),(49,47,NULL,NULL,'login',75,76),(50,47,NULL,NULL,'logout',77,78),(51,47,NULL,NULL,'admin_index',79,80),(52,47,NULL,NULL,'edit',81,82),(53,47,NULL,NULL,'platform_index',83,84),(54,47,NULL,NULL,'platform_view',85,86),(55,47,NULL,NULL,'platform_edit',87,88),(56,47,NULL,NULL,'platform_delete',89,90),(61,1,NULL,NULL,'Orders',94,107),(62,61,NULL,NULL,'index',95,96),(63,61,NULL,NULL,'view',97,98),(64,61,NULL,NULL,'add',99,100),(65,61,NULL,NULL,'edit',101,102),(66,61,NULL,NULL,'delete',103,104),(67,1,NULL,NULL,'PageTypes',108,121),(68,67,NULL,NULL,'index',109,110),(69,67,NULL,NULL,'view',111,112),(70,67,NULL,NULL,'add',113,114),(71,67,NULL,NULL,'edit',115,116),(72,67,NULL,NULL,'delete',117,118),(73,1,NULL,NULL,'Payments',122,135),(74,73,NULL,NULL,'index',123,124),(75,73,NULL,NULL,'view',125,126),(76,73,NULL,NULL,'add',127,128),(77,73,NULL,NULL,'edit',129,130),(78,73,NULL,NULL,'delete',131,132),(79,1,NULL,NULL,'Products',136,165),(80,79,NULL,NULL,'admin_index',137,138),(81,79,NULL,NULL,'index',139,140),(82,79,NULL,NULL,'view',141,142),(86,1,NULL,NULL,'ProductImages',166,193),(87,86,NULL,NULL,'index',167,168),(88,86,NULL,NULL,'view',169,170),(90,86,NULL,NULL,'edit',171,172),(91,86,NULL,NULL,'delete',173,174),(92,1,NULL,NULL,'Shops',194,207),(93,92,NULL,NULL,'index',195,196),(94,92,NULL,NULL,'view',197,198),(95,92,NULL,NULL,'add',199,200),(96,92,NULL,NULL,'edit',201,202),(97,92,NULL,NULL,'delete',203,204),(98,1,NULL,NULL,'Users',208,247),(99,98,NULL,NULL,'parentNode',209,210),(100,98,NULL,NULL,'index',211,212),(101,98,NULL,NULL,'view',213,214),(102,98,NULL,NULL,'add',215,216),(103,98,NULL,NULL,'edit',217,218),(104,98,NULL,NULL,'login',219,220),(105,98,NULL,NULL,'logout',221,222),(106,98,NULL,NULL,'platform_login',223,224),(107,98,NULL,NULL,'platform_logout',225,226),(108,98,NULL,NULL,'platform_index',227,228),(109,98,NULL,NULL,'delete',229,230),(110,98,NULL,NULL,'admin_index',231,232),(111,98,NULL,NULL,'admin_view',233,234),(112,98,NULL,NULL,'admin_add',235,236),(113,98,NULL,NULL,'admin_edit',237,238),(114,98,NULL,NULL,'admin_delete',239,240),(115,98,NULL,NULL,'afterSave',241,242),(116,1,NULL,NULL,'Webpages',248,271),(117,116,NULL,NULL,'index',249,250),(118,116,NULL,NULL,'view',251,252),(119,116,NULL,NULL,'add',253,254),(120,116,NULL,NULL,'edit',255,256),(121,116,NULL,NULL,'delete',257,258),(122,116,NULL,NULL,'admin_index',259,260),(123,116,NULL,NULL,'admin_view',261,262),(124,116,NULL,NULL,'admin_add',263,264),(125,116,NULL,NULL,'admin_edit',265,266),(126,116,NULL,NULL,'admin_delete',267,268),(137,79,NULL,NULL,'admin_view',143,144),(138,79,NULL,NULL,'admin_add',145,146),(139,79,NULL,NULL,'admin_edit',147,148),(140,79,NULL,NULL,'admin_delete',149,150),(141,79,NULL,NULL,'platform_index',151,152),(142,79,NULL,NULL,'platform_view',153,154),(143,79,NULL,NULL,'platform_add',155,156),(144,79,NULL,NULL,'platform_edit',157,158),(145,79,NULL,NULL,'platform_delete',159,160),(149,98,NULL,NULL,'initDB',243,244),(152,86,NULL,NULL,'admin_index',175,176),(153,86,NULL,NULL,'admin_view',177,178),(154,86,NULL,NULL,'admin_add',179,180),(155,86,NULL,NULL,'admin_edit',181,182),(156,86,NULL,NULL,'admin_delete',183,184),(157,21,NULL,NULL,'register',37,38),(158,21,NULL,NULL,'login',39,40),(159,21,NULL,NULL,'logout',41,42),(160,1,NULL,NULL,'Domains',272,285),(161,160,NULL,NULL,'admin_index',273,274),(162,160,NULL,NULL,'admin_view',275,276),(163,160,NULL,NULL,'admin_add',277,278),(164,160,NULL,NULL,'admin_edit',279,280),(165,160,NULL,NULL,'admin_delete',281,282),(173,1,NULL,NULL,'Themes',286,289),(293,1,NULL,NULL,'AclExtras',290,291),(294,1,NULL,NULL,'CodeCheck',292,293),(296,1,NULL,NULL,'Linkable',294,295),(297,1,NULL,NULL,'MeioUpload',296,297),(298,79,NULL,NULL,'admin_duplicate',161,162),(299,86,NULL,NULL,'admin_list_by_product',185,186),(300,1,NULL,NULL,'Copyable',298,299),(301,1,NULL,NULL,'MeioDuplicate',300,301),(302,86,NULL,NULL,'admin_change_active_status',187,188),(303,1,NULL,NULL,'Recaptcha',302,303),(304,2,NULL,NULL,'admin_change_active_status',5,6),(305,9,NULL,NULL,'admin_change_active_status',11,12),(306,15,NULL,NULL,'admin_change_active_status',25,26),(307,21,NULL,NULL,'admin_change_active_status',43,44),(308,160,NULL,NULL,'admin_change_active_status',283,284),(309,27,NULL,NULL,'admin_change_active_status',69,70),(310,47,NULL,NULL,'admin_change_active_status',91,92),(311,61,NULL,NULL,'admin_change_active_status',105,106),(312,67,NULL,NULL,'admin_change_active_status',119,120),(313,73,NULL,NULL,'admin_change_active_status',133,134),(314,79,NULL,NULL,'admin_change_active_status',163,164),(315,86,NULL,NULL,'admin_add_by_product',189,190),(316,86,NULL,NULL,'admin_make_this_cover',191,192),(317,92,NULL,NULL,'admin_change_active_status',205,206),(318,173,NULL,NULL,'admin_change_active_status',287,288),(319,98,NULL,NULL,'admin_change_active_status',245,246),(320,116,NULL,NULL,'admin_change_active_status',269,270);

/*Table structure for table `addresses` */

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `country` varchar(3) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `addresses` */

insert  into `addresses`(`id`,`address`,`city`,`region`,`zip_code`,`country`,`customer_id`,`type`) values (1,'qwe','qwe','qwe','123456','qwe',0,1),(2,'adderss','singapore','singapore','123','sng',0,1),(3,'adderss','singapore','singapore','123','sng',0,1),(4,'3dress','3ingapore','3ea','323','3gp',0,1),(5,'4dress','4ingapore','4ea','423','4gp',0,1),(6,'5dress','5ingapore','5ea','523','5gp',0,1),(7,'7ddress1','7ingapore','7eas','7','7gp',0,7),(8,'8ddress3','8ingapore','8ea','8','8gp',0,8),(9,'9ddress4','9ingapore','9ea','9','9gp',0,9),(10,'address5','singapore','sea','1','sgp',10,1),(11,'adderss1','1','1','1','1',11,1),(12,'adderss1','1','1','1','1',12,1),(13,'adderss1','1','1','1','1',12,1),(14,'address1','1','1','1','1',13,1),(15,'address3','3','3','3','3',14,1),(16,'address3','3','3','3','3',14,1),(17,'address3','3','3','3','3',15,1),(18,'address3','3','3','3','3',15,2),(19,'address3','3','3','3','3',16,1),(20,'address3','3','3','3','3',16,2);

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
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `aros` */

insert  into `aros`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'Group',1,'administrators',1,2),(2,NULL,'Group',2,'editors',3,4),(3,NULL,'Group',3,'merchants',5,342),(4,NULL,'Group',4,'customers',343,376),(5,3,'User',1,NULL,6,7),(6,3,'User',2,NULL,8,9),(7,3,'User',2,NULL,10,11),(8,3,'User',1,NULL,12,13),(9,3,'User',1,NULL,14,15),(10,3,'User',1,NULL,16,17),(11,3,'User',1,NULL,18,19),(12,3,'User',1,NULL,20,21),(13,3,'User',1,NULL,22,23),(14,3,'User',1,NULL,24,25),(15,3,'User',1,NULL,26,27),(16,3,'User',2,NULL,28,29),(17,3,'User',2,NULL,30,31),(18,3,'User',2,NULL,32,33),(19,3,'User',2,NULL,34,35),(20,3,'User',2,NULL,36,37),(21,3,'User',2,NULL,38,39),(22,3,'User',2,NULL,40,41),(23,3,'User',2,NULL,42,43),(24,3,'User',2,NULL,44,45),(25,3,'User',2,NULL,46,47),(26,3,'User',2,NULL,48,49),(27,3,'User',2,NULL,50,51),(28,3,'User',2,NULL,52,53),(29,3,'User',2,NULL,54,55),(30,3,'User',2,NULL,56,57),(31,3,'User',2,NULL,58,59),(32,NULL,'User',2,NULL,377,378),(33,NULL,'User',2,NULL,379,380),(34,NULL,'User',2,NULL,381,382),(35,NULL,'User',2,NULL,383,384),(36,NULL,'User',2,NULL,385,386),(37,NULL,'User',2,NULL,387,388),(38,NULL,'User',2,NULL,389,390),(39,NULL,'User',2,NULL,391,392),(40,NULL,'User',2,NULL,393,394),(41,NULL,'User',2,NULL,395,396),(42,NULL,'User',2,NULL,397,398),(43,NULL,'User',2,NULL,399,400),(44,NULL,'User',2,NULL,401,402),(45,NULL,'User',2,NULL,403,404),(46,NULL,'User',2,NULL,405,406),(47,NULL,'User',3,NULL,407,408),(48,NULL,'User',2,NULL,409,410),(49,NULL,'User',2,NULL,411,412),(50,NULL,'User',2,NULL,413,414),(51,NULL,'User',2,NULL,415,416),(52,3,'User',2,NULL,60,61),(53,NULL,'User',2,NULL,417,418),(54,3,'User',2,NULL,62,63),(55,NULL,'User',2,NULL,419,420),(56,3,'User',2,NULL,64,65),(57,NULL,'User',2,NULL,421,422),(58,3,'User',2,NULL,66,67),(59,NULL,'User',2,NULL,423,424),(60,NULL,'User',2,NULL,425,426),(61,NULL,'User',2,NULL,427,428),(62,NULL,'User',2,NULL,429,430),(63,NULL,'User',2,NULL,431,432),(64,3,'User',2,NULL,68,69),(65,3,'User',2,NULL,70,71),(66,3,'User',2,NULL,72,73),(67,3,'User',2,NULL,74,75),(68,3,'User',4,NULL,76,77),(69,3,'User',5,NULL,78,79),(70,3,'User',2,NULL,80,81),(71,3,'User',2,NULL,82,83),(72,3,'User',2,NULL,84,85),(73,3,'User',2,NULL,86,87),(74,3,'User',6,NULL,88,89),(75,3,'User',7,NULL,90,91),(76,3,'User',2,NULL,92,93),(77,3,'User',2,NULL,94,95),(78,3,'User',2,NULL,96,97),(79,3,'User',2,NULL,98,99),(80,3,'User',2,NULL,100,101),(81,3,'User',2,NULL,102,103),(82,3,'User',2,NULL,104,105),(83,3,'User',2,NULL,106,107),(84,3,'User',2,NULL,108,109),(85,3,'User',2,NULL,110,111),(86,3,'User',2,NULL,112,113),(87,3,'User',2,NULL,114,115),(88,3,'User',2,NULL,116,117),(89,3,'User',2,NULL,118,119),(90,3,'User',2,NULL,120,121),(91,3,'User',2,NULL,122,123),(92,4,'User',6,NULL,344,345),(93,3,'User',2,NULL,124,125),(94,3,'User',2,NULL,126,127),(95,3,'User',2,NULL,128,129),(96,3,'User',2,NULL,130,131),(97,3,'User',2,NULL,132,133),(98,3,'User',2,NULL,134,135),(99,3,'User',2,NULL,136,137),(100,3,'User',2,NULL,138,139),(101,3,'User',2,NULL,140,141),(102,3,'User',2,NULL,142,143),(103,3,'User',2,NULL,144,145),(104,3,'User',2,NULL,146,147),(105,3,'User',2,NULL,148,149),(106,3,'User',2,NULL,150,151),(107,3,'User',2,NULL,152,153),(108,3,'User',2,NULL,154,155),(109,3,'User',2,NULL,156,157),(110,3,'User',2,NULL,158,159),(111,3,'User',2,NULL,160,161),(112,3,'User',2,NULL,162,163),(113,3,'User',2,NULL,164,165),(114,3,'User',2,NULL,166,167),(115,3,'User',2,NULL,168,169),(116,3,'User',2,NULL,170,171),(117,3,'User',2,NULL,172,173),(118,3,'User',2,NULL,174,175),(119,3,'User',2,NULL,176,177),(120,3,'User',2,NULL,178,179),(121,3,'User',2,NULL,180,181),(122,3,'User',2,NULL,182,183),(123,3,'User',2,NULL,184,185),(124,3,'User',2,NULL,186,187),(125,3,'User',2,NULL,188,189),(126,3,'User',2,NULL,190,191),(127,3,'User',2,NULL,192,193),(128,3,'User',2,NULL,194,195),(129,3,'User',2,NULL,196,197),(130,3,'User',2,NULL,198,199),(131,3,'User',2,NULL,200,201),(132,3,'User',2,NULL,202,203),(133,3,'User',2,NULL,204,205),(134,3,'User',2,NULL,206,207),(135,3,'User',2,NULL,208,209),(136,3,'User',2,NULL,210,211),(137,3,'User',2,NULL,212,213),(138,3,'User',2,NULL,214,215),(139,3,'User',2,NULL,216,217),(140,3,'User',2,NULL,218,219),(141,3,'User',2,NULL,220,221),(142,3,'User',2,NULL,222,223),(143,3,'User',2,NULL,224,225),(144,3,'User',2,NULL,226,227),(145,3,'User',2,NULL,228,229),(146,3,'User',2,NULL,230,231),(147,3,'User',2,NULL,232,233),(148,3,'User',2,NULL,234,235),(149,3,'User',2,NULL,236,237),(150,3,'User',2,NULL,238,239),(151,3,'User',2,NULL,240,241),(152,3,'User',2,NULL,242,243),(153,3,'User',2,NULL,244,245),(154,3,'User',2,NULL,246,247),(155,3,'User',2,NULL,248,249),(156,3,'User',2,NULL,250,251),(157,3,'User',2,NULL,252,253),(158,3,'User',2,NULL,254,255),(159,3,'User',2,NULL,256,257),(160,3,'User',2,NULL,258,259),(161,3,'User',2,NULL,260,261),(162,3,'User',2,NULL,262,263),(163,3,'User',2,NULL,264,265),(164,3,'User',2,NULL,266,267),(165,3,'User',2,NULL,268,269),(166,3,'User',2,NULL,270,271),(167,3,'User',2,NULL,272,273),(168,3,'User',2,NULL,274,275),(169,3,'User',2,NULL,276,277),(170,3,'User',2,NULL,278,279),(171,3,'User',2,NULL,280,281),(172,3,'User',2,NULL,282,283),(173,3,'User',2,NULL,284,285),(174,3,'User',2,NULL,286,287),(175,3,'User',2,NULL,288,289),(176,3,'User',2,NULL,290,291),(177,3,'User',2,NULL,292,293),(178,3,'User',2,NULL,294,295),(179,3,'User',2,NULL,296,297),(180,3,'User',2,NULL,298,299),(181,3,'User',2,NULL,300,301),(182,3,'User',2,NULL,302,303),(183,3,'User',2,NULL,304,305),(184,3,'User',2,NULL,306,307),(185,3,'User',2,NULL,308,309),(186,3,'User',2,NULL,310,311),(187,3,'User',2,NULL,312,313),(188,3,'User',2,NULL,314,315),(189,3,'User',2,NULL,316,317),(190,3,'User',2,NULL,318,319),(191,3,'User',2,NULL,320,321),(192,3,'User',2,NULL,322,323),(193,3,'User',2,NULL,324,325),(194,3,'User',2,NULL,326,327),(195,3,'User',2,NULL,328,329),(196,3,'User',2,NULL,330,331),(197,3,'User',2,NULL,332,333),(198,3,'User',2,NULL,334,335),(199,3,'User',2,NULL,336,337),(200,3,'User',2,NULL,338,339),(201,3,'User',6,NULL,340,341),(202,4,'User',7,NULL,346,347),(204,4,'User',9,NULL,348,349),(205,4,'User',10,NULL,350,351),(206,4,'User',11,NULL,352,353),(207,4,'User',12,NULL,354,355),(208,4,'User',13,NULL,356,357),(209,4,'User',14,NULL,358,359),(210,4,'User',15,NULL,360,361),(211,4,'User',16,NULL,362,363),(212,4,'User',17,NULL,364,365),(213,4,'User',18,NULL,366,367),(214,4,'User',19,NULL,368,369),(215,4,'User',20,NULL,370,371),(216,4,'User',21,NULL,372,373),(217,4,'User',22,NULL,374,375);

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
  UNIQUE KEY `aro_id` (`aro_id`,`aco_id`),
  KEY `to_aco` (`aco_id`),
  KEY `to_aro` (`aro_id`),
  CONSTRAINT `to_aco` FOREIGN KEY (`aco_id`) REFERENCES `acos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `to_aro` FOREIGN KEY (`aro_id`) REFERENCES `aros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `aros_acos` */

insert  into `aros_acos`(`id`,`aro_id`,`aco_id`,`_create`,`_read`,`_update`,`_delete`) values (1,1,1,'1','1','1','1'),(2,2,1,'-1','-1','-1','-1'),(3,2,79,'1','1','1','1'),(4,2,92,'1','1','1','1'),(5,3,1,'-1','-1','-1','-1'),(9,3,50,'1','1','1','1'),(10,3,49,'1','1','1','1'),(11,3,51,'1','1','1','1'),(12,3,80,'1','1','1','1'),(13,3,52,'1','1','1','1'),(14,3,138,'1','1','1','1'),(15,3,139,'1','1','1','1'),(16,3,140,'1','1','1','1'),(17,3,137,'1','1','1','1'),(18,3,154,'1','1','1','1'),(19,3,155,'1','1','1','1'),(20,3,156,'1','1','1','1'),(21,3,153,'1','1','1','1'),(22,3,152,'1','1','1','1'),(23,4,103,'1','1','1','1'),(24,4,105,'1','1','1','1'),(25,4,104,'1','1','1','1'),(26,4,3,'1','1','1','1'),(27,4,25,'1','1','1','1'),(28,4,159,'1','1','1','1'),(29,4,158,'1','1','1','1'),(30,2,3,'1','1','1','1'),(31,3,3,'1','1','1','1'),(32,4,1,'-1','-1','-1','-1'),(33,2,98,'1','1','1','1'),(34,2,160,'1','1','1','1'),(35,3,163,'1','1','1','1'),(36,3,164,'1','1','1','1'),(37,3,165,'1','1','1','1'),(38,3,162,'1','1','1','1'),(39,3,161,'1','1','1','1'),(41,3,96,'1','1','1','1'),(42,3,299,'1','1','1','1'),(43,3,302,'1','1','1','1'),(44,3,316,'1','1','1','1'),(45,3,315,'1','1','1','1');

/*Table structure for table `cart_items` */

DROP TABLE IF EXISTS `cart_items`;

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` float(10,2) NOT NULL,
  `product_quantity` int(4) NOT NULL DEFAULT '1',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `product` (`product_id`),
  KEY `ci_to_cart` (`cart_id`),
  KEY `ci_to_product` (`product_id`),
  KEY `cart` (`cart_id`),
  CONSTRAINT `ci_to_cart` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ci_to_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  PRIMARY KEY (`id`),
  KEY `customer` (`customer_id`),
  CONSTRAINT `customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `carts` */

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_code` varchar(255) DEFAULT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop` (`shop_id`),
  KEY `user` (`user_id`),
  CONSTRAINT `shop` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `customers` */

insert  into `customers`(`id`,`identity_code`,`shop_id`,`user_id`) values (1,NULL,5,7),(3,NULL,5,9),(4,NULL,5,10),(5,NULL,5,11),(6,NULL,5,12),(7,NULL,5,13),(8,NULL,5,14),(9,NULL,5,15),(10,NULL,5,16),(11,NULL,5,17),(12,NULL,5,18),(13,NULL,5,19),(14,NULL,5,20),(15,NULL,5,21),(16,NULL,5,22);

/*Table structure for table `domains` */

DROP TABLE IF EXISTS `domains`;

CREATE TABLE `domains` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `primary` tinyint(1) NOT NULL DEFAULT '0',
  `always_redirect_here` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `domain_to_shop` (`shop_id`),
  CONSTRAINT `domain_to_shop` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `domains` */

insert  into `domains`(`id`,`domain`,`shop_id`,`primary`,`always_redirect_here`) values (1,'http://localhost',5,1,0),(3,'http://shop4.myspree2shop.com',5,0,0),(4,'http://shop3.myspree2shop.com',4,1,0),(5,'http://shop7.myspree2shop.com',6,1,0);

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`created`,`modified`) values (1,'administrators','2010-04-25 05:41:00','2010-04-25 05:41:00'),(2,'editors','2010-04-25 05:42:00','2010-04-25 05:42:00'),(3,'merchants','2010-04-25 05:42:00','2010-04-25 05:42:00'),(4,'customers','2010-04-25 05:42:00','2010-04-25 05:42:00');

/*Table structure for table `merchants` */

DROP TABLE IF EXISTS `merchants`;

CREATE TABLE `merchants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` tinyint(1) NOT NULL DEFAULT '0',
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `merchant_to_shop` (`shop_id`),
  KEY `merchant_to_user` (`user_id`),
  CONSTRAINT `merchant_to_shop` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `merchant_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  UNIQUE KEY `order_id` (`order_id`,`product_id`),
  KEY `oli_to_order` (`order_id`),
  KEY `oli_to_product` (`product_id`),
  CONSTRAINT `oli_to_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `oli_to_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `order_line_items` */

insert  into `order_line_items`(`id`,`order_id`,`product_id`,`product_price`,`product_quantity`,`status`) values (1,56,3,123.00,3,1),(4,58,3,123.00,3,1),(5,58,4,123.00,3,1),(6,61,3,123.00,5,1),(7,62,3,123.00,5,1),(8,64,3,123.00,5,1),(9,66,3,123.00,1,1),(10,67,3,123.00,1,1),(11,68,3,123.00,1,1),(12,69,3,123.00,1,1),(13,70,3,123.00,1,1),(14,71,3,123.00,1,1),(15,72,3,123.00,1,1),(16,73,3,123.00,1,1),(17,74,3,123.00,1,1),(18,75,3,123.00,1,1),(19,76,3,123.00,1,1),(20,77,3,123.00,1,1),(21,78,3,123.00,1,1);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `billing_address_id` int(11) NOT NULL,
  `delivery_address_id` int(11) NOT NULL,
  `order_no` varchar(20) NOT NULL,
  `created` datetime DEFAULT NULL,
  `amount` float(10,2) NOT NULL,
  `status` int(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `order_to_billing_address` (`billing_address_id`),
  KEY `order_to_customer` (`customer_id`),
  KEY `order_to_delivery_address` (`delivery_address_id`),
  KEY `order_to_shop` (`shop_id`),
  CONSTRAINT `order_to_billing_address` FOREIGN KEY (`billing_address_id`) REFERENCES `addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order_to_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order_to_delivery_address` FOREIGN KEY (`delivery_address_id`) REFERENCES `addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order_to_shop` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

/*Data for the table `orders` */

insert  into `orders`(`id`,`shop_id`,`customer_id`,`billing_address_id`,`delivery_address_id`,`order_no`,`created`,`amount`,`status`) values (44,1,1,1,1,'asd','2010-05-27 11:13:44',123.00,1),(45,1,1,1,1,'asd','2010-05-27 11:26:04',123.00,1),(46,1,1,1,1,'asd','2010-05-27 11:27:02',123.00,1),(47,1,1,1,1,'asd','2010-05-27 11:30:07',123.00,1),(48,1,1,1,1,'asd','2010-05-27 11:32:47',123.00,1),(49,1,1,1,1,'asd','2010-05-27 11:33:54',123.00,1),(50,1,1,1,1,'asd','2010-05-27 11:34:16',123.00,1),(51,1,1,1,1,'asd','2010-05-27 11:34:17',123.00,1),(52,1,1,1,1,'asd','2010-05-27 11:34:17',123.00,1),(53,1,1,1,1,'asd','2010-05-27 11:34:17',123.00,1),(54,1,1,1,1,'asd','2010-05-27 11:34:17',123.00,1),(55,1,1,1,1,'asd','2010-05-27 11:34:30',123.00,1),(56,1,1,1,1,'asd','2010-05-27 11:35:22',123.00,1),(58,1,1,1,1,'asd','2010-05-27 14:27:12',123.00,1),(61,5,1,1,1,'asd','2010-05-28 02:00:07',615.00,1),(62,5,1,1,1,'asd','2010-05-28 02:16:42',615.00,1),(64,5,1,1,1,'asd','2010-05-28 02:19:18',615.00,1),(66,5,1,3,3,'asd','2010-05-29 06:46:38',123.00,1),(67,5,1,3,3,'asd','2010-05-29 07:40:46',123.00,1),(68,5,1,3,3,'asd','2010-05-29 07:41:33',123.00,1),(69,5,1,3,3,'asd','2010-05-29 07:41:42',123.00,1),(70,5,1,3,3,'asd','2010-05-29 07:45:30',123.00,1),(71,5,1,3,3,'asd','2010-05-29 07:49:29',123.00,1),(72,5,1,3,3,'asd','2010-05-29 07:51:21',123.00,1),(73,5,1,3,3,'asd','2010-05-29 08:08:24',123.00,1),(74,5,1,3,3,'asd','2010-05-29 08:14:56',123.00,1),(75,5,1,3,3,'asd','2010-05-29 08:23:56',123.00,1),(76,5,1,12,12,'asd','2010-05-29 09:36:20',123.00,1),(77,5,1,14,14,'asd','2010-05-29 09:38:15',123.00,1),(78,5,16,19,20,'asd','2010-05-29 09:53:29',123.00,1);

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
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `mimetype` varchar(255) DEFAULT NULL,
  `filesize` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`cover`,`created`,`modified`,`filename`,`dir`,`mimetype`,`filesize`) values (1,1,1,'2010-05-20 07:59:19','2010-05-20 07:59:19','default.jpg','uploads\\products','image/jpeg',6103),(2,3,1,'2010-05-20 12:48:03','2010-05-20 12:48:03','2nd.jpg','uploads\\products','image/jpeg',107266),(3,4,1,'2010-05-27 10:45:57','2010-05-27 10:45:57','facebook.png','uploads\\products','image/png',54417),(4,4,0,'2010-05-27 10:45:58','2010-05-27 10:45:58','security_software_2.jpg','uploads\\products','image/jpeg',40191);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `description` text,
  `price` float(10,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_products` (`shop_id`),
  CONSTRAINT `FK_products` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `products` */

insert  into `products`(`id`,`shop_id`,`title`,`code`,`description`,`price`,`created`,`modified`,`status`) values (1,1,'Dummy Product',NULL,NULL,0.00,'2010-05-20 08:00:24','2010-05-20 08:00:24',1),(3,5,'product test','test','asdsadsadasd',123.00,'2010-05-20 12:47:39','2010-05-20 12:47:39',1),(4,5,'qwe','qwe','qwe',123.00,'2010-05-27 10:45:57','2010-05-27 10:45:57',1);

/*Table structure for table `shops` */

DROP TABLE IF EXISTS `shops`;

CREATE TABLE `shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_id` int(11) unsigned NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `web_address` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `shop_to_theme` (`theme_id`),
  CONSTRAINT `FK_shops_themes` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `shops` */

insert  into `shops`(`id`,`theme_id`,`name`,`web_address`,`created`,`modified`,`status`) values (1,1,'a','http://a.myspree2shop.com',NULL,NULL,1),(2,1,'abcde','http://shop1.myspree2shop.com',NULL,NULL,1),(3,1,'shop2','http://shop2.myspree2shop.com',NULL,NULL,1),(4,1,'shop3','http://shop3.myspree2shop.com',NULL,NULL,1),(5,1,'shop4','http://shop4.myspree2shop.com',NULL,NULL,1),(6,1,'shop7','http://shop7.myspree2shop.com',NULL,NULL,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `themes` */

insert  into `themes`(`id`,`name`,`description`,`author`,`created`,`modified`,`available_for_all`) values (1,'blue-white','blue-white','kimsia','2010-05-13 00:00:00','2010-05-13 00:00:00',1),(2,'orange','orange','kimsia','2010-05-13 00:00:00','2010-05-13 00:00:00',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `name_to_call` varchar(255) NOT NULL,
  `last_login_on` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_users` (`group_id`),
  CONSTRAINT `FK_users` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`group_id`,`full_name`,`name_to_call`,`last_login_on`,`status`,`created`,`modified`) values (1,'m1@a.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'full name','ally',NULL,1,'2010-04-25 06:13:48','2010-04-25 06:13:48'),(2,'merchant1@shop1.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'full','barry',NULL,1,'2010-04-26 02:39:27','2010-04-26 02:39:27'),(3,'owner@shop2.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'cherry','cherry',NULL,1,'2010-04-26 02:43:00','2010-04-26 02:43:00'),(4,'owner@shop3.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'dolly','dolly',NULL,1,'2010-04-26 03:19:15','2010-04-26 03:19:15'),(5,'owner@shop4.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'evey','evey',NULL,1,'2010-04-26 03:20:22','2010-04-26 03:20:22'),(6,'owner@shop7.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'cherry','cherry',NULL,1,'2010-05-20 08:11:42','2010-05-20 08:11:42'),(7,'test@test.com','dd7d4e2151754e51cde4cb43dedd4958a0f8b5d5',4,'test','test',NULL,1,'2010-05-27 11:10:40','2010-05-27 11:10:40'),(9,'molly@m.com','b42ce95fab13ebd95a8eede6a95a7e0ae2ed4f42',4,'molly','molly',NULL,1,'2010-05-29 07:43:01','2010-05-29 07:43:01'),(10,'molly@m.com','4b3dc7bf39b4b34deaf638b039aa588729e0dd12',4,'molly','molly',NULL,1,'2010-05-29 07:43:57','2010-05-29 07:43:57'),(11,'molly@m.com','4a42c15faa758aca03207c93c56a681973135994',4,'molly','molly',NULL,1,'2010-05-29 07:45:30','2010-05-29 07:45:30'),(12,'molly1@m.com','b2f62e6e90ab8ec916f79e4afc9b295ce6e9302f',4,'molly','mollt',NULL,1,'2010-05-29 07:49:29','2010-05-29 07:49:29'),(13,'molly2@m.com','23dda2ab1291ba6f90027a62e181ff50efb20267',4,'m','m',NULL,1,'2010-05-29 07:51:21','2010-05-29 07:51:21'),(14,'molly3@m.com','ced0575592aa814632099560a6d2762d32f92bfa',4,'m','m',NULL,1,'2010-05-29 08:08:24','2010-05-29 08:08:24'),(15,'molly4@m.com','684f2df0649e7fb1d867d4ce777b36a5006cddeb',4,'m','m',NULL,1,'2010-05-29 08:14:56','2010-05-29 08:14:56'),(16,'molly5@m.com','9704303d90f71afaa74eed13153ead90d041c5f8',4,'5','5',NULL,1,'2010-05-29 08:23:56','2010-05-29 08:23:56'),(17,'nellly1@n.com','ad6e39539da5557890e19f6b67e4ccf7e136e6d5',4,'nelly','nelly',NULL,1,'2010-05-29 09:35:49','2010-05-29 09:35:49'),(18,'nellly1@n.com','92770ef1a9ef46521e7c8f56723b1a32f46f5e13',4,'nelly','nelly',NULL,1,'2010-05-29 09:36:19','2010-05-29 09:36:19'),(19,'nellly2@n.com','5bbab3a7d685eb5e8a9b1f8d4464e3d52aea27a8',4,'nelly','nelly',NULL,1,'2010-05-29 09:38:15','2010-05-29 09:38:15'),(20,'nellly3@n.com','0e887c525d0ebe40789bd9d01d000b7fb70a74fb',4,'n','n',NULL,1,'2010-05-29 09:50:46','2010-05-29 09:50:46'),(21,'nellly3@n.com','b64e6c5d06ff717ddcd482872020ab3dfd83028c',4,'n','n',NULL,1,'2010-05-29 09:53:06','2010-05-29 09:53:06'),(22,'nellly3@n.com','0b3ea8cb109fa974aca094e05985828c543e11d6',4,'n','n',NULL,1,'2010-05-29 09:53:29','2010-05-29 09:53:29');

/*Table structure for table `webpages` */

DROP TABLE IF EXISTS `webpages`;

CREATE TABLE `webpages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `page_type_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `meta_title` text,
  `meta_keywords` text,
  `meta_description` text,
  PRIMARY KEY (`id`),
  KEY `webpage_to_shop` (`shop_id`),
  KEY `webpage_to_page_type` (`page_type_id`),
  CONSTRAINT `webpage_to_page_type` FOREIGN KEY (`page_type_id`) REFERENCES `page_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `webpage_to_shop` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `webpages` */

/*Table structure for table `wishlists` */

DROP TABLE IF EXISTS `wishlists`;

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_id` (`customer_id`,`product_id`),
  KEY `customer_fk` (`customer_id`),
  KEY `product` (`product_id`),
  CONSTRAINT `customer_fk` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `wishlists` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

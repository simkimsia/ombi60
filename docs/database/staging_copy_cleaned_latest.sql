/*
SQLyog Community v8.71 
MySQL - 5.1.41-3ubuntu12.8 : Database - s2s_new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=utf8;

/*Data for the table `acos` */

insert  into `acos`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,NULL,NULL,'controllers',1,450),(2,1,NULL,NULL,'Pages',2,7),(3,2,NULL,NULL,'display',3,4),(4,2,NULL,NULL,'admin_change_active_status',5,6),(5,1,NULL,NULL,'Orders',8,31),(6,5,NULL,NULL,'paypal',9,10),(7,5,NULL,NULL,'index',11,12),(8,5,NULL,NULL,'admin_index',13,14),(9,5,NULL,NULL,'admin_view',15,16),(10,5,NULL,NULL,'view',17,18),(11,5,NULL,NULL,'add',19,20),(12,5,NULL,NULL,'checkout',21,22),(13,5,NULL,NULL,'success',23,24),(14,5,NULL,NULL,'updatePrices',25,26),(15,5,NULL,NULL,'pay',27,28),(16,5,NULL,NULL,'admin_change_active_status',29,30),(17,1,NULL,NULL,'Payments',32,45),(18,17,NULL,NULL,'admin_index',33,34),(19,17,NULL,NULL,'admin_update_settings',35,36),(20,17,NULL,NULL,'admin_add_custom_payment',37,38),(21,17,NULL,NULL,'admin_edit_custom_payment',39,40),(22,17,NULL,NULL,'admin_delete_custom_payment',41,42),(23,17,NULL,NULL,'admin_change_active_status',43,44),(24,1,NULL,NULL,'Users',46,65),(25,24,NULL,NULL,'parentNode',47,48),(26,24,NULL,NULL,'initDB',49,50),(27,24,NULL,NULL,'login',51,52),(28,24,NULL,NULL,'logout',53,54),(29,24,NULL,NULL,'platform_login',55,56),(30,24,NULL,NULL,'platform_logout',57,58),(31,24,NULL,NULL,'platform_index',59,60),(32,24,NULL,NULL,'afterSave',61,62),(33,24,NULL,NULL,'admin_change_active_status',63,64),(34,1,NULL,NULL,'ProductImages',66,81),(35,34,NULL,NULL,'admin_add',67,68),(36,34,NULL,NULL,'admin_add_by_product',69,70),(37,34,NULL,NULL,'admin_uploadify',71,72),(38,34,NULL,NULL,'admin_list_by_product',73,74),(39,34,NULL,NULL,'admin_delete',75,76),(40,34,NULL,NULL,'admin_make_this_cover',77,78),(41,34,NULL,NULL,'admin_change_active_status',79,80),(42,1,NULL,NULL,'Carts',82,93),(43,42,NULL,NULL,'index',83,84),(44,42,NULL,NULL,'view',85,86),(45,42,NULL,NULL,'edit',87,88),(46,42,NULL,NULL,'delete',89,90),(47,42,NULL,NULL,'admin_change_active_status',91,92),(48,1,NULL,NULL,'Blogs',94,109),(49,48,NULL,NULL,'view',95,96),(50,48,NULL,NULL,'admin_index',97,98),(51,48,NULL,NULL,'admin_view',99,100),(52,48,NULL,NULL,'admin_add',101,102),(53,48,NULL,NULL,'admin_edit',103,104),(54,48,NULL,NULL,'admin_delete',105,106),(55,48,NULL,NULL,'admin_change_active_status',107,108),(56,1,NULL,NULL,'Addresses',110,115),(57,56,NULL,NULL,'index',111,112),(58,56,NULL,NULL,'admin_change_active_status',113,114),(59,1,NULL,NULL,'Webpages',116,131),(60,59,NULL,NULL,'view',117,118),(61,59,NULL,NULL,'admin_index',119,120),(62,59,NULL,NULL,'admin_view',121,122),(63,59,NULL,NULL,'admin_add',123,124),(64,59,NULL,NULL,'admin_edit',125,126),(65,59,NULL,NULL,'admin_delete',127,128),(66,59,NULL,NULL,'admin_change_active_status',129,130),(67,1,NULL,NULL,'Merchants',132,153),(68,67,NULL,NULL,'register',133,134),(69,67,NULL,NULL,'admin_login',135,136),(70,67,NULL,NULL,'admin_logout',137,138),(71,67,NULL,NULL,'admin_index',139,140),(72,67,NULL,NULL,'admin_edit',141,142),(73,67,NULL,NULL,'platform_index',143,144),(74,67,NULL,NULL,'platform_view',145,146),(75,67,NULL,NULL,'platform_edit',147,148),(76,67,NULL,NULL,'platform_delete',149,150),(77,67,NULL,NULL,'admin_change_active_status',151,152),(78,1,NULL,NULL,'Themes',154,159),(79,78,NULL,NULL,'admin_index',155,156),(80,78,NULL,NULL,'admin_change_active_status',157,158),(81,1,NULL,NULL,'Customers',160,169),(82,81,NULL,NULL,'register',161,162),(83,81,NULL,NULL,'login',163,164),(84,81,NULL,NULL,'logout',165,166),(85,81,NULL,NULL,'admin_change_active_status',167,168),(86,1,NULL,NULL,'SavedThemes',170,193),(87,86,NULL,NULL,'admin_index',171,172),(88,86,NULL,NULL,'admin_view',173,174),(89,86,NULL,NULL,'admin_add',175,176),(90,86,NULL,NULL,'admin_upload',177,178),(91,86,NULL,NULL,'admin_edit',179,180),(92,86,NULL,NULL,'admin_delete',181,182),(93,86,NULL,NULL,'admin_edit_image',183,184),(94,86,NULL,NULL,'admin_feature',185,186),(95,86,NULL,NULL,'admin_delete_image',187,188),(96,86,NULL,NULL,'admin_edit_css',189,190),(97,86,NULL,NULL,'admin_change_active_status',191,192),(98,1,NULL,NULL,'Shops',194,201),(99,98,NULL,NULL,'admin_account',195,196),(100,98,NULL,NULL,'admin_cancelaccount',197,198),(101,98,NULL,NULL,'admin_change_active_status',199,200),(102,1,NULL,NULL,'ShippingRates',202,215),(103,102,NULL,NULL,'admin_index',203,204),(104,102,NULL,NULL,'admin_edit',205,206),(105,102,NULL,NULL,'admin_add_price_based',207,208),(106,102,NULL,NULL,'admin_add_weight_based',209,210),(107,102,NULL,NULL,'admin_delete',211,212),(108,102,NULL,NULL,'admin_change_active_status',213,214),(109,1,NULL,NULL,'Groups',216,221),(110,109,NULL,NULL,'parentNode',217,218),(111,109,NULL,NULL,'admin_change_active_status',219,220),(112,1,NULL,NULL,'Domains',222,237),(113,112,NULL,NULL,'admin_index',223,224),(114,112,NULL,NULL,'admin_view',225,226),(115,112,NULL,NULL,'admin_add',227,228),(116,112,NULL,NULL,'admin_make_this_primary',229,230),(117,112,NULL,NULL,'admin_edit',231,232),(118,112,NULL,NULL,'admin_delete',233,234),(119,112,NULL,NULL,'admin_change_active_status',235,236),(120,1,NULL,NULL,'Products',238,281),(121,120,NULL,NULL,'checkout',239,240),(122,120,NULL,NULL,'view_cart',241,242),(123,120,NULL,NULL,'admin_index',243,244),(124,120,NULL,NULL,'admin_view',245,246),(125,120,NULL,NULL,'view',247,248),(126,120,NULL,NULL,'index',249,250),(127,120,NULL,NULL,'admin_add',251,252),(128,120,NULL,NULL,'admin_upload',253,254),(129,120,NULL,NULL,'admin_toggle',255,256),(130,120,NULL,NULL,'admin_edit',257,258),(131,120,NULL,NULL,'admin_delete',259,260),(132,120,NULL,NULL,'admin_duplicate',261,262),(133,120,NULL,NULL,'platform_index',263,264),(134,120,NULL,NULL,'platform_view',265,266),(135,120,NULL,NULL,'platform_add',267,268),(136,120,NULL,NULL,'platform_edit',269,270),(137,120,NULL,NULL,'platform_delete',271,272),(138,120,NULL,NULL,'edit_quantities_in_cart',273,274),(139,120,NULL,NULL,'add_to_cart',275,276),(140,120,NULL,NULL,'delete_from_cart',277,278),(141,120,NULL,NULL,'admin_change_active_status',279,280),(142,1,NULL,NULL,'Posts',282,295),(143,142,NULL,NULL,'view',283,284),(144,142,NULL,NULL,'admin_view',285,286),(145,142,NULL,NULL,'admin_add',287,288),(146,142,NULL,NULL,'admin_edit',289,290),(147,142,NULL,NULL,'admin_delete',291,292),(148,142,NULL,NULL,'admin_change_active_status',293,294),(149,1,NULL,NULL,'GiftCards',296,319),(150,149,NULL,NULL,'index',297,298),(151,149,NULL,NULL,'view',299,300),(152,149,NULL,NULL,'add',301,302),(153,149,NULL,NULL,'edit',303,304),(154,149,NULL,NULL,'delete',305,306),(155,149,NULL,NULL,'admin_index',307,308),(156,149,NULL,NULL,'admin_view',309,310),(157,149,NULL,NULL,'admin_add',311,312),(158,149,NULL,NULL,'admin_edit',313,314),(159,149,NULL,NULL,'admin_delete',315,316),(160,149,NULL,NULL,'admin_change_active_status',317,318),(161,1,NULL,NULL,'MeioUpload',320,321),(162,1,NULL,NULL,'Copyable',322,323),(163,1,NULL,NULL,'CodeCheck',324,325),(164,1,NULL,NULL,'MeioDuplicate',326,327),(165,1,NULL,NULL,'Recaptcha',328,329),(166,1,NULL,NULL,'ThemeFolder',330,331),(167,1,NULL,NULL,'Datasources',332,333),(168,1,NULL,NULL,'LilBlogs',334,421),(169,168,NULL,NULL,'Authors',335,354),(170,169,NULL,NULL,'login',336,337),(171,169,NULL,NULL,'logout',338,339),(172,169,NULL,NULL,'admin_index',340,341),(173,169,NULL,NULL,'admin_add',342,343),(174,169,NULL,NULL,'admin_edit',344,345),(175,169,NULL,NULL,'admin_delete',346,347),(176,169,NULL,NULL,'parseUrl',348,349),(177,169,NULL,NULL,'error404',350,351),(178,169,NULL,NULL,'admin_change_active_status',352,353),(179,168,NULL,NULL,'Comments',355,374),(180,179,NULL,NULL,'index',356,357),(181,179,NULL,NULL,'admin_edit',358,359),(182,179,NULL,NULL,'admin_delete',360,361),(183,179,NULL,NULL,'admin_index',362,363),(184,179,NULL,NULL,'admin_quick',364,365),(185,179,NULL,NULL,'admin_categorize',366,367),(186,179,NULL,NULL,'parseUrl',368,369),(187,179,NULL,NULL,'error404',370,371),(188,179,NULL,NULL,'admin_change_active_status',372,373),(189,168,NULL,NULL,'Blogs',375,390),(190,189,NULL,NULL,'view',376,377),(191,189,NULL,NULL,'admin_index',378,379),(192,189,NULL,NULL,'admin_view',380,381),(193,189,NULL,NULL,'admin_add',382,383),(194,189,NULL,NULL,'admin_edit',384,385),(195,189,NULL,NULL,'admin_delete',386,387),(196,189,NULL,NULL,'admin_change_active_status',388,389),(197,168,NULL,NULL,'Categories',391,406),(198,197,NULL,NULL,'admin_index',392,393),(199,197,NULL,NULL,'admin_add',394,395),(200,197,NULL,NULL,'admin_edit',396,397),(201,197,NULL,NULL,'admin_delete',398,399),(202,197,NULL,NULL,'parseUrl',400,401),(203,197,NULL,NULL,'error404',402,403),(204,197,NULL,NULL,'admin_change_active_status',404,405),(205,168,NULL,NULL,'Posts',407,420),(206,205,NULL,NULL,'view',408,409),(207,205,NULL,NULL,'admin_view',410,411),(208,205,NULL,NULL,'admin_add',412,413),(209,205,NULL,NULL,'admin_edit',414,415),(210,205,NULL,NULL,'admin_delete',416,417),(211,205,NULL,NULL,'admin_change_active_status',418,419),(212,1,NULL,NULL,'AclExtras',422,423),(213,1,NULL,NULL,'Filter',424,425),(214,1,NULL,NULL,'Rest',426,427),(215,1,NULL,NULL,'JamienayZendLucene',428,429),(216,1,NULL,NULL,'Paypal',430,431),(217,1,NULL,NULL,'RandomString',432,433),(218,1,NULL,NULL,'ClearCache',434,435),(219,1,NULL,NULL,'Uploadify',436,437),(220,1,NULL,NULL,'Linkable',438,439),(221,1,NULL,NULL,'DebugKit',440,449),(222,221,NULL,NULL,'ToolbarAccess',441,448),(223,222,NULL,NULL,'history_state',442,443),(224,222,NULL,NULL,'sql_explain',444,445),(225,222,NULL,NULL,'admin_change_active_status',446,447);

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
  `full_name` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `aros` */

insert  into `aros`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'Group',1,'administrators',1,2),(2,NULL,'Group',2,'editors',3,4),(3,NULL,'Group',3,'merchants',5,30),(4,NULL,'Group',4,'customers',31,32),(5,3,'User',1,NULL,6,7),(6,NULL,'Group',5,'casual',33,44),(7,6,'User',3,NULL,34,35),(8,6,'User',4,NULL,36,37),(9,3,'User',5,NULL,8,9),(10,6,'User',6,NULL,38,39),(11,3,'User',7,NULL,10,11),(12,3,'User',8,NULL,12,13),(13,6,'User',9,NULL,40,41),(14,3,'User',10,NULL,14,15),(15,3,'User',11,NULL,16,17),(16,3,'User',12,NULL,18,19),(17,3,'User',13,NULL,20,21),(18,3,'User',14,NULL,22,23),(19,3,'User',15,NULL,24,25),(20,3,'User',16,NULL,26,27),(21,3,'User',17,NULL,28,29),(22,6,'User',18,NULL,42,43);

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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

/*Data for the table `aros_acos` */

insert  into `aros_acos`(`id`,`aro_id`,`aco_id`,`_create`,`_read`,`_update`,`_delete`) values (1,1,1,'1','1','1','1'),(2,2,3,'1','1','1','1'),(3,2,1,'-1','-1','-1','-1'),(4,2,120,'1','1','1','1'),(5,2,98,'1','1','1','1'),(6,2,24,'1','1','1','1'),(7,2,112,'1','1','1','1'),(8,2,78,'1','1','1','1'),(9,3,1,'-1','-1','-1','-1'),(10,3,3,'1','1','1','1'),(11,3,127,'1','1','1','1'),(12,3,130,'1','1','1','1'),(13,3,131,'1','1','1','1'),(14,3,124,'1','1','1','1'),(15,3,123,'1','1','1','1'),(16,3,128,'1','1','1','1'),(17,3,132,'1','1','1','1'),(18,3,129,'1','1','1','1'),(19,3,35,'1','1','1','1'),(20,3,39,'1','1','1','1'),(21,3,38,'1','1','1','1'),(22,3,40,'1','1','1','1'),(23,3,36,'1','1','1','1'),(24,3,37,'1','1','1','1'),(25,3,71,'1','1','1','1'),(26,3,72,'1','1','1','1'),(27,3,70,'1','1','1','1'),(28,3,69,'1','1','1','1'),(29,3,115,'1','1','1','1'),(30,3,117,'1','1','1','1'),(31,3,118,'1','1','1','1'),(32,3,114,'1','1','1','1'),(33,3,113,'1','1','1','1'),(34,3,116,'1','1','1','1'),(35,3,87,'1','1','1','1'),(36,3,91,'1','1','1','1'),(37,3,89,'1','1','1','1'),(38,3,92,'1','1','1','1'),(39,3,94,'1','1','1','1'),(40,3,93,'1','1','1','1'),(41,3,95,'1','1','1','1'),(42,3,96,'1','1','1','1'),(43,3,99,'1','1','1','1'),(44,3,100,'1','1','1','1'),(45,3,18,'1','1','1','1'),(46,3,19,'1','1','1','1'),(47,3,8,'1','1','1','1'),(48,3,9,'1','1','1','1'),(49,3,63,'1','1','1','1'),(50,3,64,'1','1','1','1'),(51,3,65,'1','1','1','1'),(52,3,62,'1','1','1','1'),(53,3,61,'1','1','1','1'),(54,4,1,'-1','-1','-1','-1'),(55,4,3,'1','1','1','1'),(56,4,28,'1','1','1','1'),(57,4,27,'1','1','1','1'),(58,4,84,'1','1','1','1'),(59,4,83,'1','1','1','1');

/*Table structure for table `authors` */

DROP TABLE IF EXISTS `authors`;

CREATE TABLE `authors` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `authors` */

insert  into `authors`(`id`,`admin`,`name`,`email`,`username`,`passwd`,`created`,`modified`) values (1,1,'Administrator','','admin','78e8f77082028fa96a619aa568aa3ca88a72ec8e','2010-08-18 11:38:04','2010-08-18 11:38:04');

/*Table structure for table `authors_blogs` */

DROP TABLE IF EXISTS `authors_blogs`;

CREATE TABLE `authors_blogs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `author_id` int(10) DEFAULT NULL,
  `blog_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `authors_blogs` */

insert  into `authors_blogs`(`id`,`author_id`,`blog_id`) values (1,1,1);

/*Table structure for table `blogs` */

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `description` text,
  `theme` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `shop_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `blogs` */

/*Table structure for table `cake_sessions` */

DROP TABLE IF EXISTS `cake_sessions`;

CREATE TABLE `cake_sessions` (
  `id` varchar(255) NOT NULL,
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `cake_sessions` */

insert  into `cake_sessions`(`id`,`data`,`expires`) values ('te19bhladvbov8uvfli4vm9031','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292255675;s:7:\"timeout\";i:100;}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"875a071bb34fc72b18e54dcf189e04777efbe059\";s:7:\"expires\";i:1292249676;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";Subscription|a:1:{s:6:\"Paypal\";a:1:{s:5:\"TOKEN\";s:20:\"EC-5965302074557372C\";}}NewShopID|s:1:\"2\";',1292255676),('m36mh4snc5fmqssf18g49giqp2','Config|a:4:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292280431;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:2:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:6:\"shop01\";s:11:\"web_address\";s:30:\"http://shop01.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-13 20:33:39\";s:8:\"modified\";s:19:\"2010-12-13 20:33:39\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"0\";s:11:\"deny_access\";s:1:\"0\";}s:6:\"Domain\";a:5:{s:6:\"domain\";s:23:\"http://ombi60.localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"2\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";}}Message|a:0:{}Auth|a:1:{s:8:\"Language\";a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:7:\"English\";s:11:\"locale_name\";s:3:\"eng\";}}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"3bbc7e7bf5183f5bae682e9d87f7b6d13d862d39\";s:7:\"expires\";i:1292262431;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292280431),('lsd1bh5236ec7b0oguii20f7r0','Config|a:4:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292281316;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:2:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:6:\"shop01\";s:11:\"web_address\";s:30:\"http://shop01.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-13 20:33:39\";s:8:\"modified\";s:19:\"2010-12-13 20:33:39\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"0\";s:11:\"deny_access\";s:1:\"0\";}s:6:\"Domain\";a:5:{s:6:\"domain\";s:23:\"http://ombi60.localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"2\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";}}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"33e9846378787e5cf5bda538e24fce9f9df34535\";s:7:\"expires\";i:1292263316;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";Message|a:0:{}Auth|a:4:{s:4:\"User\";a:10:{s:2:\"id\";s:1:\"5\";s:5:\"email\";s:15:\"owner@shop2.com\";s:8:\"group_id\";s:1:\"3\";s:9:\"full_name\";s:5:\"barry\";s:12:\"name_to_call\";s:12:\"barry fuller\";s:13:\"last_login_on\";N;s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2010-12-13 20:57:44\";s:8:\"modified\";s:19:\"2010-12-13 20:57:44\";s:11:\"language_id\";s:1:\"1\";}s:8:\"Merchant\";a:4:{s:2:\"id\";s:1:\"5\";s:5:\"owner\";s:1:\"1\";s:7:\"shop_id\";s:1:\"6\";s:7:\"user_id\";s:1:\"5\";}s:4:\"Shop\";a:8:{s:2:\"id\";N;s:4:\"name\";N;s:11:\"web_address\";N;s:7:\"created\";N;s:8:\"modified\";N;s:6:\"status\";N;s:14:\"saved_theme_id\";N;s:11:\"deny_access\";N;}s:8:\"Language\";a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:7:\"English\";s:11:\"locale_name\";s:3:\"eng\";}}',1292281316),('g04j3s3td5alevqsrju09hu341','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292257116;s:7:\"timeout\";i:100;}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"f4829b79e3adb9dc15ca208747da318a9763b16a\";s:7:\"expires\";i:1292251117;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";Subscription|a:1:{s:6:\"Paypal\";a:1:{s:5:\"TOKEN\";s:20:\"EC-6UW11981TT694984E\";}}NewShopID|s:1:\"3\";',1292257117),('r0r5o3huddhl4os03iku9f79a1','Config|a:4:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292281455;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:2:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"3\";s:4:\"name\";s:5:\"shop2\";s:11:\"web_address\";s:29:\"http://shop2.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-13 20:57:44\";s:8:\"modified\";s:19:\"2010-12-13 20:57:44\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:2:\"18\";s:11:\"deny_access\";s:1:\"0\";}s:6:\"Domain\";a:5:{s:6:\"domain\";s:23:\"http://ombi60.localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"3\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";}}Message|a:0:{}Auth|a:4:{s:4:\"User\";a:10:{s:2:\"id\";s:1:\"5\";s:5:\"email\";s:15:\"owner@shop2.com\";s:8:\"group_id\";s:1:\"3\";s:9:\"full_name\";s:5:\"barry\";s:12:\"name_to_call\";s:12:\"barry fuller\";s:13:\"last_login_on\";N;s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2010-12-13 20:57:44\";s:8:\"modified\";s:19:\"2010-12-13 20:57:44\";s:11:\"language_id\";s:1:\"1\";}s:8:\"Merchant\";a:4:{s:2:\"id\";s:1:\"5\";s:5:\"owner\";s:1:\"1\";s:7:\"shop_id\";s:1:\"6\";s:7:\"user_id\";s:1:\"5\";}s:4:\"Shop\";a:8:{s:2:\"id\";N;s:4:\"name\";N;s:11:\"web_address\";N;s:7:\"created\";N;s:8:\"modified\";N;s:6:\"status\";N;s:14:\"saved_theme_id\";N;s:11:\"deny_access\";N;}s:8:\"Language\";a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:7:\"English\";s:11:\"locale_name\";s:3:\"eng\";}}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"931ca347888be227f6cf9f1d0ed962305d89bc0c\";s:7:\"expires\";i:1292263455;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292281455),('j5s9cisokl41s1tlv0h8e2rah7','Config|a:4:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292283882;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:2:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"3\";s:4:\"name\";s:5:\"shop2\";s:11:\"web_address\";s:29:\"http://shop2.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-13 20:57:44\";s:8:\"modified\";s:19:\"2010-12-13 20:57:44\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:2:\"18\";s:11:\"deny_access\";b:1;}s:6:\"Domain\";a:5:{s:6:\"domain\";s:23:\"http://ombi60.localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"3\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";}}Message|a:0:{}Auth|a:4:{s:8:\"Language\";a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:7:\"English\";s:11:\"locale_name\";s:3:\"eng\";}s:4:\"User\";a:10:{s:2:\"id\";s:1:\"8\";s:5:\"email\";s:15:\"owner@shop4.com\";s:8:\"group_id\";s:1:\"3\";s:9:\"full_name\";s:5:\"barry\";s:12:\"name_to_call\";s:5:\"barry\";s:13:\"last_login_on\";N;s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2010-12-13 21:42:33\";s:8:\"modified\";s:19:\"2010-12-13 21:42:33\";s:11:\"language_id\";s:1:\"1\";}s:8:\"Merchant\";a:4:{s:2:\"id\";s:2:\"12\";s:5:\"owner\";s:1:\"1\";s:7:\"shop_id\";s:1:\"5\";s:7:\"user_id\";s:1:\"8\";}s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"5\";s:4:\"name\";s:5:\"shop4\";s:11:\"web_address\";s:29:\"http://shop4.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-13 21:42:33\";s:8:\"modified\";s:19:\"2010-12-13 21:42:34\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:2:\"20\";s:11:\"deny_access\";s:1:\"0\";}}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"72402d078ba62cdc288c7a9ef0999c7f78ba2fa5\";s:7:\"expires\";i:1292265882;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292283882),('890n206u7vfskojlej5tdq6b94','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292259564;s:7:\"timeout\";i:100;}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"ff5c424a1dbc0dd8b62ab94b9504ce2094208f98\";s:7:\"expires\";i:1292253564;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";Subscription|a:1:{s:6:\"Paypal\";a:1:{s:5:\"TOKEN\";s:20:\"EC-62Y06708TM530621K\";}}NewShopID|s:1:\"4\";',1292259564),('iqvpvft0aip1l1r00hh6pbbsu3','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292259793;s:7:\"timeout\";i:100;}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"e28efedd0eacc240050985443aafba900f4a2bea\";s:7:\"expires\";i:1292253793;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";Subscription|a:1:{s:6:\"Paypal\";a:1:{s:5:\"TOKEN\";s:20:\"EC-7A465438S54026930\";}}NewShopID|s:1:\"5\";',1292259794),('n69ql91kilv7qjdv693j8tstq1','Config|a:4:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292284026;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:2:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"5\";s:4:\"name\";s:5:\"shop4\";s:11:\"web_address\";s:29:\"http://shop4.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-13 21:42:33\";s:8:\"modified\";s:19:\"2010-12-13 21:42:34\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:2:\"20\";s:11:\"deny_access\";b:1;}s:6:\"Domain\";a:5:{s:6:\"domain\";s:23:\"http://ombi60.localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"5\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";}}Message|a:0:{}Auth|a:4:{s:4:\"User\";a:10:{s:2:\"id\";s:1:\"8\";s:5:\"email\";s:15:\"owner@shop4.com\";s:8:\"group_id\";s:1:\"3\";s:9:\"full_name\";s:5:\"barry\";s:12:\"name_to_call\";s:5:\"barry\";s:13:\"last_login_on\";N;s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2010-12-13 21:42:33\";s:8:\"modified\";s:19:\"2010-12-13 21:42:33\";s:11:\"language_id\";s:1:\"1\";}s:8:\"Merchant\";a:4:{s:2:\"id\";s:2:\"12\";s:5:\"owner\";s:1:\"1\";s:7:\"shop_id\";s:1:\"5\";s:7:\"user_id\";s:1:\"8\";}s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"5\";s:4:\"name\";s:5:\"shop4\";s:11:\"web_address\";s:29:\"http://shop4.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-13 21:42:33\";s:8:\"modified\";s:19:\"2010-12-13 21:42:34\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:2:\"20\";s:11:\"deny_access\";s:1:\"0\";}s:8:\"Language\";a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:7:\"English\";s:11:\"locale_name\";s:3:\"eng\";}}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"b5919013b8c22ac1bbaf8f50bcf6e0acc06d8827\";s:7:\"expires\";i:1292266026;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292284029),('75nl6194jjgoj9lm65ncoudpn5','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292260030;s:7:\"timeout\";i:100;}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"de3ae6d14a81e720bb8809206c16a48cad151ebe\";s:7:\"expires\";i:1292254029;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292260031),('c356eprb30p0u758s04c6hcib0','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292426065;s:7:\"timeout\";i:100;}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"08a72cca6d74af643a0860f4d1e5fca08531edf2\";s:7:\"expires\";i:1292420065;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";Subscription|a:1:{s:6:\"Paypal\";a:1:{s:5:\"TOKEN\";s:20:\"EC-8U002920JT463733C\";}}NewShopID|s:2:\"13\";',1292426065),('fkiteg6788787rupbjc4q44aj5','Config|a:4:{s:9:\"userAgent\";s:32:\"d44d3ad92fc64f25864865e2b87ade5e\";s:4:\"time\";i:1292450173;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:2:{s:4:\"Shop\";a:8:{s:2:\"id\";s:2:\"13\";s:4:\"name\";s:6:\"shop12\";s:11:\"web_address\";s:30:\"http://shop12.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-15 19:53:21\";s:8:\"modified\";s:19:\"2010-12-15 19:53:22\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:2:\"24\";s:11:\"deny_access\";s:1:\"0\";}s:6:\"Domain\";a:5:{s:6:\"domain\";s:23:\"http://ombi60.localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:2:\"13\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";}}_Token|s:212:\"a:5:{s:3:\"key\";s:40:\"8f0a40e2ef7a26c3ae7e227aff38167d7a3a14f8\";s:7:\"expires\";i:1292432173;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:1:{i:0;s:21:\"ProductImage.filename\";}}\";',1292450174);

/*Table structure for table `cancellations` */

DROP TABLE IF EXISTS `cancellations`;

CREATE TABLE `cancellations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `short_reason` varchar(100) DEFAULT NULL,
  `long_reason` text,
  `shop_id` int(11) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `cancellations` */

insert  into `cancellations`(`id`,`short_reason`,`long_reason`,`shop_id`,`created`,`modified`,`user_id`) values (1,NULL,NULL,5,'2010-12-13 03:30:56','2010-12-13 03:30:56',8),(2,'Stop business','test 123',5,'2010-12-13 03:32:10','2010-12-13 03:32:10',8),(3,'Stop business','test',5,'2010-12-13 07:29:28','2010-12-13 07:29:28',8),(4,'Stop business','shop2 id 3',3,'2010-12-13 13:33:29','2010-12-13 13:33:29',5),(5,'Choose another provider','i love ombi60',3,'2010-12-13 13:39:57','2010-12-13 13:39:57',7),(6,'Choose another provider','i love 0mbi60',5,'2010-12-13 13:47:09','2010-12-13 13:47:09',8);

/*Table structure for table `cart_items` */

DROP TABLE IF EXISTS `cart_items`;

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `product_quantity` int(4) NOT NULL DEFAULT '1',
  `status` tinyint(1) DEFAULT '1',
  `product_title` varchar(255) DEFAULT NULL,
  `product_weight` decimal(10,4) unsigned DEFAULT NULL,
  `currency` varchar(5) NOT NULL DEFAULT 'SGD',
  `weight_unit` varchar(5) NOT NULL DEFAULT 'kg',
  `shipping_required` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `previous_price` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `previous_currency` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_product_cart_id` (`cart_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cart_items` */

/*Table structure for table `carts` */

DROP TABLE IF EXISTS `carts`;

CREATE TABLE `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `amount` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `status` tinyint(1) DEFAULT '1',
  `hash` varchar(255) DEFAULT NULL,
  `total_weight` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `currency` varchar(5) NOT NULL DEFAULT 'SGD',
  `weight_unit` varchar(5) NOT NULL DEFAULT 'kg',
  `shipped_amount` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `shipped_weight` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `past_checkout_point` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `carts` */

/*Table structure for table `casual_surfers` */

DROP TABLE IF EXISTS `casual_surfers`;

CREATE TABLE `casual_surfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop` (`shop_id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `casual_surfers` */

insert  into `casual_surfers`(`id`,`shop_id`,`user_id`) values (1,2,2),(2,2,3),(3,2,4),(4,3,6),(5,3,9),(6,13,18);

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(4) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `categories` */

/*Table structure for table `categories_posts` */

DROP TABLE IF EXISTS `categories_posts`;

CREATE TABLE `categories_posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(4) DEFAULT NULL,
  `post_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `categories_posts` */

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `body` text,
  `author` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `status` mediumint(4) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `comments` */

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `printable_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_iso` (`iso`),
  UNIQUE KEY `unique_name` (`name`),
  UNIQUE KEY `unique_printable_name` (`printable_name`),
  UNIQUE KEY `unique_iso3` (`iso3`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=utf8;

/*Data for the table `countries` */

insert  into `countries`(`id`,`iso`,`name`,`printable_name`,`iso3`,`numcode`) values (1,'AF','AFGHANISTAN','Afghanistan','AFG',4),(2,'AL','ALBANIA','Albania','ALB',8),(3,'DZ','ALGERIA','Algeria','DZA',12),(4,'AS','AMERICAN SAMOA','American Samoa','ASM',16),(5,'AD','ANDORRA','Andorra','AND',20),(6,'AO','ANGOLA','Angola','AGO',24),(7,'AI','ANGUILLA','Anguilla','AIA',660),(8,'AQ','ANTARCTICA','Antarctica',NULL,NULL),(9,'AG','ANTIGUA AND BARBUDA','Antigua and Barbuda','ATG',28),(10,'AR','ARGENTINA','Argentina','ARG',32),(11,'AM','ARMENIA','Armenia','ARM',51),(12,'AW','ARUBA','Aruba','ABW',533),(13,'AU','AUSTRALIA','Australia','AUS',36),(14,'AT','AUSTRIA','Austria','AUT',40),(15,'AZ','AZERBAIJAN','Azerbaijan','AZE',31),(16,'BS','BAHAMAS','Bahamas','BHS',44),(17,'BH','BAHRAIN','Bahrain','BHR',48),(18,'BD','BANGLADESH','Bangladesh','BGD',50),(19,'BB','BARBADOS','Barbados','BRB',52),(20,'BY','BELARUS','Belarus','BLR',112),(21,'BE','BELGIUM','Belgium','BEL',56),(22,'BZ','BELIZE','Belize','BLZ',84),(23,'BJ','BENIN','Benin','BEN',204),(24,'BM','BERMUDA','Bermuda','BMU',60),(25,'BT','BHUTAN','Bhutan','BTN',64),(26,'BO','BOLIVIA','Bolivia','BOL',68),(27,'BA','BOSNIA AND HERZEGOVINA','Bosnia and Herzegovina','BIH',70),(28,'BW','BOTSWANA','Botswana','BWA',72),(29,'BV','BOUVET ISLAND','Bouvet Island',NULL,NULL),(30,'BR','BRAZIL','Brazil','BRA',76),(31,'IO','BRITISH INDIAN OCEAN TERRITORY','British Indian Ocean Territory',NULL,NULL),(32,'BN','BRUNEI DARUSSALAM','Brunei Darussalam','BRN',96),(33,'BG','BULGARIA','Bulgaria','BGR',100),(34,'BF','BURKINA FASO','Burkina Faso','BFA',854),(35,'BI','BURUNDI','Burundi','BDI',108),(36,'KH','CAMBODIA','Cambodia','KHM',116),(37,'CM','CAMEROON','Cameroon','CMR',120),(38,'CA','CANADA','Canada','CAN',124),(39,'CV','CAPE VERDE','Cape Verde','CPV',132),(40,'KY','CAYMAN ISLANDS','Cayman Islands','CYM',136),(41,'CF','CENTRAL AFRICAN REPUBLIC','Central African Republic','CAF',140),(42,'TD','CHAD','Chad','TCD',148),(43,'CL','CHILE','Chile','CHL',152),(44,'CN','CHINA','China','CHN',156),(45,'CX','CHRISTMAS ISLAND','Christmas Island',NULL,NULL),(46,'CC','COCOS (KEELING) ISLANDS','Cocos (Keeling) Islands',NULL,NULL),(47,'CO','COLOMBIA','Colombia','COL',170),(48,'KM','COMOROS','Comoros','COM',174),(49,'CG','CONGO','Congo','COG',178),(50,'CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE','Congo, the Democratic Republic of the','COD',180),(51,'CK','COOK ISLANDS','Cook Islands','COK',184),(52,'CR','COSTA RICA','Costa Rica','CRI',188),(53,'CI','COTE D\'IVOIRE','Cote D\'Ivoire','CIV',384),(54,'HR','CROATIA','Croatia','HRV',191),(55,'CU','CUBA','Cuba','CUB',192),(56,'CY','CYPRUS','Cyprus','CYP',196),(57,'CZ','CZECH REPUBLIC','Czech Republic','CZE',203),(58,'DK','DENMARK','Denmark','DNK',208),(59,'DJ','DJIBOUTI','Djibouti','DJI',262),(60,'DM','DOMINICA','Dominica','DMA',212),(61,'DO','DOMINICAN REPUBLIC','Dominican Republic','DOM',214),(62,'EC','ECUADOR','Ecuador','ECU',218),(63,'EG','EGYPT','Egypt','EGY',818),(64,'SV','EL SALVADOR','El Salvador','SLV',222),(65,'GQ','EQUATORIAL GUINEA','Equatorial Guinea','GNQ',226),(66,'ER','ERITREA','Eritrea','ERI',232),(67,'EE','ESTONIA','Estonia','EST',233),(68,'ET','ETHIOPIA','Ethiopia','ETH',231),(69,'FK','FALKLAND ISLANDS (MALVINAS)','Falkland Islands (Malvinas)','FLK',238),(70,'FO','FAROE ISLANDS','Faroe Islands','FRO',234),(71,'FJ','FIJI','Fiji','FJI',242),(72,'FI','FINLAND','Finland','FIN',246),(73,'FR','FRANCE','France','FRA',250),(74,'GF','FRENCH GUIANA','French Guiana','GUF',254),(75,'PF','FRENCH POLYNESIA','French Polynesia','PYF',258),(76,'TF','FRENCH SOUTHERN TERRITORIES','French Southern Territories',NULL,NULL),(77,'GA','GABON','Gabon','GAB',266),(78,'GM','GAMBIA','Gambia','GMB',270),(79,'GE','GEORGIA','Georgia','GEO',268),(80,'DE','GERMANY','Germany','DEU',276),(81,'GH','GHANA','Ghana','GHA',288),(82,'GI','GIBRALTAR','Gibraltar','GIB',292),(83,'GR','GREECE','Greece','GRC',300),(84,'GL','GREENLAND','Greenland','GRL',304),(85,'GD','GRENADA','Grenada','GRD',308),(86,'GP','GUADELOUPE','Guadeloupe','GLP',312),(87,'GU','GUAM','Guam','GUM',316),(88,'GT','GUATEMALA','Guatemala','GTM',320),(89,'GN','GUINEA','Guinea','GIN',324),(90,'GW','GUINEA-BISSAU','Guinea-Bissau','GNB',624),(91,'GY','GUYANA','Guyana','GUY',328),(92,'HT','HAITI','Haiti','HTI',332),(93,'HM','HEARD ISLAND AND MCDONALD ISLANDS','Heard Island and Mcdonald Islands',NULL,NULL),(94,'VA','HOLY SEE (VATICAN CITY STATE)','Holy See (Vatican City State)','VAT',336),(95,'HN','HONDURAS','Honduras','HND',340),(96,'HK','HONG KONG','Hong Kong','HKG',344),(97,'HU','HUNGARY','Hungary','HUN',348),(98,'IS','ICELAND','Iceland','ISL',352),(99,'IN','INDIA','India','IND',356),(100,'ID','INDONESIA','Indonesia','IDN',360),(101,'IR','IRAN, ISLAMIC REPUBLIC OF','Iran, Islamic Republic of','IRN',364),(102,'IQ','IRAQ','Iraq','IRQ',368),(103,'IE','IRELAND','Ireland','IRL',372),(104,'IL','ISRAEL','Israel','ISR',376),(105,'IT','ITALY','Italy','ITA',380),(106,'JM','JAMAICA','Jamaica','JAM',388),(107,'JP','JAPAN','Japan','JPN',392),(108,'JO','JORDAN','Jordan','JOR',400),(109,'KZ','KAZAKHSTAN','Kazakhstan','KAZ',398),(110,'KE','KENYA','Kenya','KEN',404),(111,'KI','KIRIBATI','Kiribati','KIR',296),(112,'KP','KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','Korea, Democratic People\'s Republic of','PRK',408),(113,'KR','KOREA, REPUBLIC OF','Korea, Republic of','KOR',410),(114,'KW','KUWAIT','Kuwait','KWT',414),(115,'KG','KYRGYZSTAN','Kyrgyzstan','KGZ',417),(116,'LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC','Lao People\'s Democratic Republic','LAO',418),(117,'LV','LATVIA','Latvia','LVA',428),(118,'LB','LEBANON','Lebanon','LBN',422),(119,'LS','LESOTHO','Lesotho','LSO',426),(120,'LR','LIBERIA','Liberia','LBR',430),(121,'LY','LIBYAN ARAB JAMAHIRIYA','Libyan Arab Jamahiriya','LBY',434),(122,'LI','LIECHTENSTEIN','Liechtenstein','LIE',438),(123,'LT','LITHUANIA','Lithuania','LTU',440),(124,'LU','LUXEMBOURG','Luxembourg','LUX',442),(125,'MO','MACAO','Macao','MAC',446),(126,'MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','Macedonia, the Former Yugoslav Republic of','MKD',807),(127,'MG','MADAGASCAR','Madagascar','MDG',450),(128,'MW','MALAWI','Malawi','MWI',454),(129,'MY','MALAYSIA','Malaysia','MYS',458),(130,'MV','MALDIVES','Maldives','MDV',462),(131,'ML','MALI','Mali','MLI',466),(132,'MT','MALTA','Malta','MLT',470),(133,'MH','MARSHALL ISLANDS','Marshall Islands','MHL',584),(134,'MQ','MARTINIQUE','Martinique','MTQ',474),(135,'MR','MAURITANIA','Mauritania','MRT',478),(136,'MU','MAURITIUS','Mauritius','MUS',480),(137,'YT','MAYOTTE','Mayotte',NULL,NULL),(138,'MX','MEXICO','Mexico','MEX',484),(139,'FM','MICRONESIA, FEDERATED STATES OF','Micronesia, Federated States of','FSM',583),(140,'MD','MOLDOVA, REPUBLIC OF','Moldova, Republic of','MDA',498),(141,'MC','MONACO','Monaco','MCO',492),(142,'MN','MONGOLIA','Mongolia','MNG',496),(143,'MS','MONTSERRAT','Montserrat','MSR',500),(144,'MA','MOROCCO','Morocco','MAR',504),(145,'MZ','MOZAMBIQUE','Mozambique','MOZ',508),(146,'MM','MYANMAR','Myanmar','MMR',104),(147,'NA','NAMIBIA','Namibia','NAM',516),(148,'NR','NAURU','Nauru','NRU',520),(149,'NP','NEPAL','Nepal','NPL',524),(150,'NL','NETHERLANDS','Netherlands','NLD',528),(151,'AN','NETHERLANDS ANTILLES','Netherlands Antilles','ANT',530),(152,'NC','NEW CALEDONIA','New Caledonia','NCL',540),(153,'NZ','NEW ZEALAND','New Zealand','NZL',554),(154,'NI','NICARAGUA','Nicaragua','NIC',558),(155,'NE','NIGER','Niger','NER',562),(156,'NG','NIGERIA','Nigeria','NGA',566),(157,'NU','NIUE','Niue','NIU',570),(158,'NF','NORFOLK ISLAND','Norfolk Island','NFK',574),(159,'MP','NORTHERN MARIANA ISLANDS','Northern Mariana Islands','MNP',580),(160,'NO','NORWAY','Norway','NOR',578),(161,'OM','OMAN','Oman','OMN',512),(162,'PK','PAKISTAN','Pakistan','PAK',586),(163,'PW','PALAU','Palau','PLW',585),(164,'PS','PALESTINIAN TERRITORY, OCCUPIED','Palestinian Territory, Occupied',NULL,NULL),(165,'PA','PANAMA','Panama','PAN',591),(166,'PG','PAPUA NEW GUINEA','Papua New Guinea','PNG',598),(167,'PY','PARAGUAY','Paraguay','PRY',600),(168,'PE','PERU','Peru','PER',604),(169,'PH','PHILIPPINES','Philippines','PHL',608),(170,'PN','PITCAIRN','Pitcairn','PCN',612),(171,'PL','POLAND','Poland','POL',616),(172,'PT','PORTUGAL','Portugal','PRT',620),(173,'PR','PUERTO RICO','Puerto Rico','PRI',630),(174,'QA','QATAR','Qatar','QAT',634),(175,'RE','REUNION','Reunion','REU',638),(176,'RO','ROMANIA','Romania','ROM',642),(177,'RU','RUSSIAN FEDERATION','Russian Federation','RUS',643),(178,'RW','RWANDA','Rwanda','RWA',646),(179,'SH','SAINT HELENA','Saint Helena','SHN',654),(180,'KN','SAINT KITTS AND NEVIS','Saint Kitts and Nevis','KNA',659),(181,'LC','SAINT LUCIA','Saint Lucia','LCA',662),(182,'PM','SAINT PIERRE AND MIQUELON','Saint Pierre and Miquelon','SPM',666),(183,'VC','SAINT VINCENT AND THE GRENADINES','Saint Vincent and the Grenadines','VCT',670),(184,'WS','SAMOA','Samoa','WSM',882),(185,'SM','SAN MARINO','San Marino','SMR',674),(186,'ST','SAO TOME AND PRINCIPE','Sao Tome and Principe','STP',678),(187,'SA','SAUDI ARABIA','Saudi Arabia','SAU',682),(188,'SN','SENEGAL','Senegal','SEN',686),(189,'CS','SERBIA AND MONTENEGRO','Serbia and Montenegro',NULL,NULL),(190,'SC','SEYCHELLES','Seychelles','SYC',690),(191,'SL','SIERRA LEONE','Sierra Leone','SLE',694),(192,'SG','SINGAPORE','Singapore','SGP',702),(193,'SK','SLOVAKIA','Slovakia','SVK',703),(194,'SI','SLOVENIA','Slovenia','SVN',705),(195,'SB','SOLOMON ISLANDS','Solomon Islands','SLB',90),(196,'SO','SOMALIA','Somalia','SOM',706),(197,'ZA','SOUTH AFRICA','South Africa','ZAF',710),(198,'GS','SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','South Georgia and the South Sandwich Islands',NULL,NULL),(199,'ES','SPAIN','Spain','ESP',724),(200,'LK','SRI LANKA','Sri Lanka','LKA',144),(201,'SD','SUDAN','Sudan','SDN',736),(202,'SR','SURINAME','Suriname','SUR',740),(203,'SJ','SVALBARD AND JAN MAYEN','Svalbard and Jan Mayen','SJM',744),(204,'SZ','SWAZILAND','Swaziland','SWZ',748),(205,'SE','SWEDEN','Sweden','SWE',752),(206,'CH','SWITZERLAND','Switzerland','CHE',756),(207,'SY','SYRIAN ARAB REPUBLIC','Syrian Arab Republic','SYR',760),(208,'TW','TAIWAN, PROVINCE OF CHINA','Taiwan, Province of China','TWN',158),(209,'TJ','TAJIKISTAN','Tajikistan','TJK',762),(210,'TZ','TANZANIA, UNITED REPUBLIC OF','Tanzania, United Republic of','TZA',834),(211,'TH','THAILAND','Thailand','THA',764),(212,'TL','TIMOR-LESTE','Timor-Leste',NULL,NULL),(213,'TG','TOGO','Togo','TGO',768),(214,'TK','TOKELAU','Tokelau','TKL',772),(215,'TO','TONGA','Tonga','TON',776),(216,'TT','TRINIDAD AND TOBAGO','Trinidad and Tobago','TTO',780),(217,'TN','TUNISIA','Tunisia','TUN',788),(218,'TR','TURKEY','Turkey','TUR',792),(219,'TM','TURKMENISTAN','Turkmenistan','TKM',795),(220,'TC','TURKS AND CAICOS ISLANDS','Turks and Caicos Islands','TCA',796),(221,'TV','TUVALU','Tuvalu','TUV',798),(222,'UG','UGANDA','Uganda','UGA',800),(223,'UA','UKRAINE','Ukraine','UKR',804),(224,'AE','UNITED ARAB EMIRATES','United Arab Emirates','ARE',784),(225,'GB','UNITED KINGDOM','United Kingdom','GBR',826),(226,'US','UNITED STATES','United States','USA',840),(227,'UM','UNITED STATES MINOR OUTLYING ISLANDS','United States Minor Outlying Islands',NULL,NULL),(228,'UY','URUGUAY','Uruguay','URY',858),(229,'UZ','UZBEKISTAN','Uzbekistan','UZB',860),(230,'VU','VANUATU','Vanuatu','VUT',548),(231,'VE','VENEZUELA','Venezuela','VEN',862),(232,'VN','VIET NAM','Viet Nam','VNM',704),(233,'VG','VIRGIN ISLANDS, BRITISH','Virgin Islands, British','VGB',92),(234,'VI','VIRGIN ISLANDS, U.S.','Virgin Islands, U.s.','VIR',850),(235,'WF','WALLIS AND FUTUNA','Wallis and Futuna','WLF',876),(236,'EH','WESTERN SAHARA','Western Sahara','ESH',732),(237,'YE','YEMEN','Yemen','YEM',887),(238,'ZM','ZAMBIA','Zambia','ZMB',894),(239,'ZW','ZIMBABWE','Zimbabwe','ZWE',716);

/*Table structure for table `custom_payment_modules` */

DROP TABLE IF EXISTS `custom_payment_modules`;

CREATE TABLE `custom_payment_modules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_payment_module_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `instructions` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `custom_payment_modules` */

insert  into `custom_payment_modules`(`id`,`shop_payment_module_id`,`name`,`instructions`) values (5,1,'Cash On Delivery','');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UniqueDomain` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `domains` */

insert  into `domains`(`id`,`domain`,`shop_id`,`primary`,`always_redirect_here`) values (1,'http://ombi60.localhost',13,1,0),(2,'http://shop01.myspree2shop.com',2,0,0),(3,'http://shop2.myspree2shop.com',3,0,0),(4,'http://shop3.myspree2shop.com',4,1,0),(5,'http://shop4.myspree2shop.com',5,0,0),(6,'http://shop5.myspree2shop.com',6,1,0),(7,'http://shop6.myspree2shop.com',7,1,0),(8,'http://shop7.myspree2shop.com',8,1,0),(9,'http://shop8.myspree2shop.com',9,1,0),(10,'http://shop9.myspree2shop.com',10,1,0),(11,'http://shop10.myspree2shop.com',11,1,0),(12,'http://shop11.myspree2shop.com',12,1,0),(13,'http://shop12.myspree2shop.com',13,0,0);

/*Table structure for table `gc_designs` */

DROP TABLE IF EXISTS `gc_designs`;

CREATE TABLE `gc_designs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `gc_designs` */

/*Table structure for table `gift_card_types` */

DROP TABLE IF EXISTS `gift_card_types`;

CREATE TABLE `gift_card_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `gift_card_types` */

insert  into `gift_card_types`(`id`,`type`) values (1,'email'),(2,'print');

/*Table structure for table `gift_cards` */

DROP TABLE IF EXISTS `gift_cards`;

CREATE TABLE `gift_cards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recipient` varchar(255) DEFAULT NULL,
  `amount` decimal(7,2) NOT NULL DEFAULT '0.00',
  `code` varchar(100) NOT NULL,
  `from` varchar(100) DEFAULT NULL,
  `to` varchar(100) DEFAULT NULL,
  `message` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `delivery` datetime DEFAULT NULL,
  `gift_card_type_id` int(3) NOT NULL DEFAULT '1',
  `gc_design_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `gift_cards` */

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`created`,`modified`) values (1,'administrators','2010-04-25 05:41:00','2010-04-25 05:41:00'),(2,'editors','2010-04-25 05:42:00','2010-04-25 05:42:00'),(3,'merchants','2010-04-25 05:42:00','2010-04-25 05:42:00'),(4,'customers','2010-04-25 05:42:00','2010-04-25 05:42:00'),(5,'casual','2010-04-25 05:42:00','2010-04-25 05:42:00');

/*Table structure for table `invoices` */

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `shop_id` int(11) unsigned NOT NULL,
  `description` text,
  `payment_number` varchar(255) DEFAULT NULL,
  `payer_user` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `invoices` */

insert  into `invoices`(`id`,`created`,`title`,`shop_id`,`description`,`payment_number`,`payer_user`) values (1,'2010-12-13 20:33:39','starter',2,'Initial signup',NULL,NULL),(2,'2010-12-13 20:57:44','starter',3,'Initial signup',NULL,NULL),(3,'2010-12-13 21:38:04','starter',4,'Initial signup',NULL,NULL),(4,'2010-12-13 21:42:33','starter',5,'Initial signup',NULL,NULL),(5,'2010-12-15 19:27:01','starter',6,'Initial signup',NULL,NULL),(6,'2010-12-15 19:37:51','starter',7,'Initial signup',NULL,NULL),(7,'2010-12-15 19:39:42','starter',8,'Initial signup',NULL,NULL),(8,'2010-12-15 19:44:21','starter',9,'Initial signup',NULL,NULL),(9,'2010-12-15 19:46:37','starter',10,'Initial signup',NULL,NULL),(10,'2010-12-15 19:48:10','starter',11,'Initial signup',NULL,NULL),(11,'2010-12-15 19:49:24','starter',12,'Initial signup',NULL,NULL),(12,'2010-12-15 19:53:21','starter',13,'Initial signup',NULL,NULL);

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `locale_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `languages` */

insert  into `languages`(`id`,`name`,`locale_name`) values (1,'English','eng'),(2,'Chinese Taiwan','chi'),(3,'Bahasa Melayu','bahasa-melayu');

/*Table structure for table `merchants` */

DROP TABLE IF EXISTS `merchants`;

CREATE TABLE `merchants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` tinyint(1) NOT NULL DEFAULT '0',
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `merchants` */

insert  into `merchants`(`id`,`owner`,`shop_id`,`user_id`) values (1,1,2,1),(10,1,3,5),(11,1,4,7),(12,1,5,8),(13,1,6,10),(14,1,7,11),(15,1,8,12),(16,1,9,13),(17,1,10,14),(18,1,11,15),(19,1,12,16),(20,1,13,17);

/*Table structure for table `nb_categories` */

DROP TABLE IF EXISTS `nb_categories`;

CREATE TABLE `nb_categories` (
  `id` varchar(100) NOT NULL,
  `probability` double NOT NULL DEFAULT '0',
  `word_count` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `nb_categories` */

insert  into `nb_categories`(`id`,`probability`,`word_count`) values ('spam',0.5,0),('ham',0.5,0);

/*Table structure for table `nb_references` */

DROP TABLE IF EXISTS `nb_references`;

CREATE TABLE `nb_references` (
  `id` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `nb_references` */

/*Table structure for table `nb_wordfreqs` */

DROP TABLE IF EXISTS `nb_wordfreqs`;

CREATE TABLE `nb_wordfreqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(100) NOT NULL,
  `category_id` varchar(100) NOT NULL DEFAULT '',
  `count` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `nb_wordfreqs` */

/*Table structure for table `order_line_items` */

DROP TABLE IF EXISTS `order_line_items`;

CREATE TABLE `order_line_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `product_quantity` int(4) NOT NULL DEFAULT '1',
  `status` int(4) DEFAULT '1',
  `product_title` varchar(255) DEFAULT NULL,
  `product_weight` decimal(10,4) unsigned DEFAULT NULL,
  `currency` varchar(5) NOT NULL DEFAULT 'SGD',
  `weight_unit` varchar(5) NOT NULL DEFAULT 'kg',
  `shipping_required` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
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
  `created` datetime DEFAULT NULL,
  `amount` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `status` int(4) DEFAULT '1',
  `hash` varchar(255) DEFAULT NULL,
  `cart_id` int(11) NOT NULL,
  `payment_status` tinyint(2) DEFAULT '0',
  `fulfillment_status` tinyint(2) DEFAULT '0',
  `shipped_weight` decimal(10,4) unsigned DEFAULT NULL,
  `shipped_amount` decimal(10,4) unsigned DEFAULT NULL,
  `weight_unit` varchar(5) NOT NULL DEFAULT 'kg',
  `currency` varchar(5) NOT NULL DEFAULT 'SGD',
  `total_weight` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `past_checkout_point` tinyint(1) unsigned NOT NULL DEFAULT '0',
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

/*Table structure for table `payment_modules` */

DROP TABLE IF EXISTS `payment_modules`;

CREATE TABLE `payment_modules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `payment_modules` */

insert  into `payment_modules`(`id`,`name`,`group`) values (1,'Custom','Custom'),(2,'Paypal','Payment Gateway'),(3,'Cheque','Custom'),(4,'Internet Banking','Custom');

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shops_payment_module_id` int(11) unsigned NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `completed` tinyint(1) unsigned DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `transaction_id_from_gateway` varchar(255) DEFAULT NULL,
  `payment_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payments` */

/*Table structure for table `paypal_payers` */

DROP TABLE IF EXISTS `paypal_payers`;

CREATE TABLE `paypal_payers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payer_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `paypal_payers` */

/*Table structure for table `paypal_payers_customers` */

DROP TABLE IF EXISTS `paypal_payers_customers`;

CREATE TABLE `paypal_payers_customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `paypal_payer_id` int(11) unsigned DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `paypal_payer_customer` (`paypal_payer_id`,`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `paypal_payers_customers` */

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(10) DEFAULT NULL,
  `author_id` int(10) DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `body` text,
  `no_comments` int(4) NOT NULL DEFAULT '0',
  `allow_comments` tinyint(1) NOT NULL DEFAULT '1',
  `allow_pingback` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `posts` */

/*Table structure for table `price_based_rates` */

DROP TABLE IF EXISTS `price_based_rates`;

CREATE TABLE `price_based_rates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `min_price` decimal(10,3) unsigned NOT NULL DEFAULT '0.000',
  `max_price` decimal(10,3) DEFAULT NULL,
  `shipping_rate_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `price_based_rates` */

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`cover`,`created`,`modified`,`filename`,`dir`,`mimetype`,`filesize`) values (1,1,1,'2010-05-20 07:59:19','2010-05-20 07:59:19','default.jpg','uploads\\products','image/jpeg',6103),(2,2,1,'2010-12-13 20:33:40','2010-12-13 20:33:40','default-0.jpg','uploads/products','image/jpeg',6103),(3,3,1,'2010-12-13 20:57:44','2010-12-13 20:57:44','default-1.jpg','uploads/products','image/jpeg',6103),(4,4,1,'2010-12-13 21:38:04','2010-12-13 21:38:04','default-2.jpg','uploads/products','image/jpeg',6103),(5,5,1,'2010-12-13 21:42:34','2010-12-13 21:42:34','default-3.jpg','uploads/products','image/jpeg',6103),(6,6,1,'2010-12-15 19:27:02','2010-12-15 19:27:02','default-4.jpg','uploads/products','image/jpeg',6103),(7,7,1,'2010-12-15 19:37:51','2010-12-15 19:37:51','default-5.jpg','uploads/products','image/jpeg',6103),(8,8,1,'2010-12-15 19:39:42','2010-12-15 19:39:42','default-6.jpg','uploads/products','image/jpeg',6103),(9,9,1,'2010-12-15 19:44:21','2010-12-15 19:44:21','default-7.jpg','uploads/products','image/jpeg',6103),(10,10,1,'2010-12-15 19:46:37','2010-12-15 19:46:37','default-8.jpg','uploads/products','image/jpeg',6103),(11,11,1,'2010-12-15 19:48:10','2010-12-15 19:48:10','default-9.jpg','uploads/products','image/jpeg',6103),(12,12,1,'2010-12-15 19:49:24','2010-12-15 19:49:24','default-10.jpg','uploads/products','image/jpeg',6103),(13,13,1,'2010-12-15 19:53:22','2010-12-15 19:53:22','default-11.jpg','uploads/products','image/jpeg',6103);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `description` text,
  `price` decimal(10,4) unsigned DEFAULT '0.0000',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `weight` decimal(10,4) unsigned DEFAULT NULL,
  `currency` varchar(5) NOT NULL DEFAULT 'SGD',
  `weight_unit` varchar(5) NOT NULL DEFAULT 'kg',
  `shipping_required` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `products` */

insert  into `products`(`id`,`shop_id`,`title`,`code`,`description`,`price`,`created`,`modified`,`status`,`weight`,`currency`,`weight_unit`,`shipping_required`) values (1,1,'Dummy Product',NULL,NULL,'0.0000','2010-05-20 08:00:24','2010-05-20 08:00:24',1,'7.0000','SGD','kg',1),(2,2,'Dummy Product',NULL,NULL,'0.0000','2010-12-13 20:33:39','2010-12-13 20:33:40',1,'7.0000','SGD','kg',1),(3,3,'Dummy Product',NULL,NULL,'0.0000','2010-12-13 20:57:44','2010-12-13 20:57:44',1,'7.0000','SGD','kg',1),(4,4,'Dummy Product',NULL,NULL,'0.0000','2010-12-13 21:38:04','2010-12-13 21:38:04',1,'7.0000','SGD','kg',1),(5,5,'Dummy Product',NULL,NULL,'0.0000','2010-12-13 21:42:33','2010-12-13 21:42:34',1,'7.0000','SGD','kg',1),(6,6,'Dummy Product',NULL,NULL,'0.0000','2010-12-15 19:27:01','2010-12-15 19:27:02',1,'7.0000','SGD','kg',1),(7,7,'Dummy Product',NULL,NULL,'0.0000','2010-12-15 19:37:51','2010-12-15 19:37:51',1,'7.0000','SGD','kg',1),(8,8,'Dummy Product',NULL,NULL,'0.0000','2010-12-15 19:39:42','2010-12-15 19:39:43',1,'7.0000','SGD','kg',1),(9,9,'Dummy Product',NULL,NULL,'0.0000','2010-12-15 19:44:21','2010-12-15 19:44:21',1,'7.0000','SGD','kg',1),(10,10,'Dummy Product',NULL,NULL,'0.0000','2010-12-15 19:46:37','2010-12-15 19:46:37',1,'7.0000','SGD','kg',1),(11,11,'Dummy Product',NULL,NULL,'0.0000','2010-12-15 19:48:10','2010-12-15 19:48:10',1,'7.0000','SGD','kg',1),(12,12,'Dummy Product',NULL,NULL,'0.0000','2010-12-15 19:49:24','2010-12-15 19:49:24',1,'7.0000','SGD','kg',1),(13,13,'Dummy Product',NULL,NULL,'0.0000','2010-12-15 19:53:21','2010-12-15 19:53:22',1,'7.0000','SGD','kg',1);

/*Table structure for table `recurring_payment_profiles` */

DROP TABLE IF EXISTS `recurring_payment_profiles`;

CREATE TABLE `recurring_payment_profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gateway` varchar(100) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  `shop_id` int(11) unsigned DEFAULT NULL,
  `gateway_reference_id` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `recurring_payment_profiles` */

insert  into `recurring_payment_profiles`(`id`,`gateway`,`method`,`shop_id`,`gateway_reference_id`,`created`,`modified`,`status`) values (1,'paypal','express checkout',2,'I-WEL341NUWU2V','2010-12-13 20:34:35','2010-12-13 20:34:35','active'),(2,'paypal','express checkout',3,'I-6WYR87K7W5XL','2010-12-13 20:58:36','2010-12-13 20:58:36','active'),(3,'paypal','express checkout',4,'I-8XB8AWYB3M2U','2010-12-13 21:39:23','2010-12-13 21:39:23','active'),(4,'paypal','express checkout',5,'I-LADUN4LUK7SH','2010-12-13 21:43:13','2010-12-13 21:43:13','cancel'),(5,'paypal','express checkout',13,'I-J8WMY78NABB3','2010-12-15 19:54:24','2010-12-15 19:54:24','active');

/*Table structure for table `saved_themes` */

DROP TABLE IF EXISTS `saved_themes`;

CREATE TABLE `saved_themes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `folder_name` varchar(255) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `featured` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `saved_themes` */

insert  into `saved_themes`(`id`,`name`,`description`,`author`,`created`,`modified`,`folder_name`,`shop_id`,`theme_id`,`featured`) values (17,'alt','alt','tester testerson','2010-12-13 20:33:40','2010-12-13 20:33:40','1_alt',2,4,1),(18,'alt','alt','barry','2010-12-13 20:57:44','2010-12-13 20:57:44','5_alt',3,4,1),(19,'alt','alt','sanchze','2010-12-13 21:38:04','2010-12-13 21:38:04','7_alt',4,4,1),(20,'alt','alt','barry','2010-12-13 21:42:34','2010-12-13 21:42:34','8_alt',5,4,1),(21,'default','default','garry','2010-12-15 19:37:51','2010-12-15 19:37:51','7_cover',7,3,1),(22,'default','default','garry','2010-12-15 19:39:43','2010-12-15 19:39:43','8_cover',8,3,1),(23,'default','default','shop8','2010-12-15 19:44:21','2010-12-15 19:44:21','9_cover',9,3,1),(24,'default','default','o','2010-12-15 19:53:22','2010-12-15 19:53:22','13_cover',13,3,1);

/*Table structure for table `shipments` */

DROP TABLE IF EXISTS `shipments`;

CREATE TABLE `shipments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `completed` tinyint(1) unsigned DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `price` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `shipments` */

insert  into `shipments`(`id`,`order_id`,`completed`,`name`,`price`,`description`) values (1,117,0,'International Shipping','10.0000','From 10kg to 20kg'),(2,146,0,'test2','0.0000','From $2 to $20'),(3,150,0,'Heavy Duty Shipping','25.0000','From 20kg to 50kg'),(5,157,0,'Heavy Duty Shipping','25.0000','From 20kg to 50kg');

/*Table structure for table `shipped_to_countries` */

DROP TABLE IF EXISTS `shipped_to_countries`;

CREATE TABLE `shipped_to_countries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(5) DEFAULT '0',
  `shop_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `shipped_to_countries` */

insert  into `shipped_to_countries`(`id`,`country_id`,`shop_id`) values (1,0,5),(2,192,5);

/*Table structure for table `shipping_rates` */

DROP TABLE IF EXISTS `shipping_rates`;

CREATE TABLE `shipping_rates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,3) unsigned NOT NULL,
  `shipped_to_country_id` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `shipping_rates` */

insert  into `shipping_rates`(`id`,`name`,`price`,`shipped_to_country_id`,`description`) values (2,'Standard Shipping','10.000',2,'From 10kg to 20kg'),(3,'Heavy Duty Shipping','25.000',2,'From 20kg to 50kg'),(13,'test2','5.000',1,'From $2 to $20');

/*Table structure for table `shops` */

DROP TABLE IF EXISTS `shops`;

CREATE TABLE `shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `web_address` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `saved_theme_id` int(11) DEFAULT '0',
  `deny_access` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `shops` */

insert  into `shops`(`id`,`name`,`web_address`,`created`,`modified`,`status`,`saved_theme_id`,`deny_access`) values (1,'a','http://a.myspree2shop.com',NULL,NULL,1,0,0),(2,'shop01','http://shop01.myspree2shop.com','2010-12-13 20:33:39','2010-12-13 20:33:39',1,0,0),(3,'shop2','http://shop2.myspree2shop.com','2010-12-13 20:57:44','2010-12-13 13:39:57',1,18,1),(4,'shop3','http://shop3.myspree2shop.com','2010-12-13 21:38:04','2010-12-13 21:38:04',1,19,0),(5,'shop4','http://shop4.myspree2shop.com','2010-12-13 21:42:33','2010-12-13 13:47:09',1,20,1),(6,'shop5','http://shop5.myspree2shop.com','2010-12-15 19:27:01','2010-12-15 19:27:01',1,0,0),(7,'shop6','http://shop6.myspree2shop.com','2010-12-15 19:37:51','2010-12-15 19:37:52',1,21,0),(8,'shop7','http://shop7.myspree2shop.com','2010-12-15 19:39:42','2010-12-15 19:39:43',1,22,0),(9,'shop8','http://shop8.myspree2shop.com','2010-12-15 19:44:21','2010-12-15 19:44:21',1,23,0),(10,'shop9','http://shop9.myspree2shop.com','2010-12-15 19:46:37','2010-12-15 19:46:37',1,0,0),(11,'shop10','http://shop10.myspree2shop.com','2010-12-15 19:48:10','2010-12-15 19:48:10',1,0,0),(12,'shop11','http://shop11.myspree2shop.com','2010-12-15 19:49:24','2010-12-15 19:49:24',1,0,0),(13,'shop12','http://shop12.myspree2shop.com','2010-12-15 19:53:21','2010-12-15 19:53:22',1,24,0);

/*Table structure for table `shops_payment_modules` */

DROP TABLE IF EXISTS `shops_payment_modules`;

CREATE TABLE `shops_payment_modules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `payment_module_id` int(11) unsigned NOT NULL,
  `default` tinyint(1) unsigned DEFAULT '0',
  `active` tinyint(1) unsigned DEFAULT '1',
  `display_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8;

/*Data for the table `shops_payment_modules` */

insert  into `shops_payment_modules`(`id`,`shop_id`,`payment_module_id`,`default`,`active`,`display_name`) values (1,5,1,0,1,'Cash On Delivery'),(2,5,1,0,1,'Money Order'),(3,5,2,0,1,'Paypal'),(136,2,1,0,1,''),(137,2,2,0,1,''),(138,2,3,0,1,''),(139,2,4,0,1,''),(140,3,1,0,1,''),(141,3,2,0,1,''),(142,3,3,0,1,''),(143,3,4,0,1,''),(144,4,1,0,1,''),(145,4,2,0,1,''),(146,4,3,0,1,''),(147,4,4,0,1,''),(148,5,1,0,1,''),(149,5,2,0,1,''),(150,5,3,0,1,''),(151,5,4,0,1,''),(152,6,1,0,1,''),(153,6,2,0,1,''),(154,6,3,0,1,''),(155,6,4,0,1,''),(156,7,1,0,1,''),(157,7,2,0,1,''),(158,7,3,0,1,''),(159,7,4,0,1,''),(160,8,1,0,1,''),(161,8,2,0,1,''),(162,8,3,0,1,''),(163,8,4,0,1,''),(164,9,1,0,1,''),(165,9,2,0,1,''),(166,9,3,0,1,''),(167,9,4,0,1,''),(168,2,1,0,1,''),(169,2,2,0,1,''),(170,2,3,0,1,''),(171,2,4,0,1,''),(172,3,1,0,1,''),(173,3,2,0,1,''),(174,3,3,0,1,''),(175,3,4,0,1,''),(176,4,1,0,1,''),(177,4,2,0,1,''),(178,4,3,0,1,''),(179,4,4,0,1,''),(180,5,1,0,1,''),(181,5,2,0,1,''),(182,5,3,0,1,''),(183,5,4,0,1,''),(184,6,1,0,1,''),(185,6,2,0,1,''),(186,6,3,0,1,''),(187,6,4,0,1,''),(188,7,1,0,1,''),(189,7,2,0,1,''),(190,7,3,0,1,''),(191,7,4,0,1,''),(192,8,1,0,1,''),(193,8,2,0,1,''),(194,8,3,0,1,''),(195,8,4,0,1,''),(196,9,1,0,1,''),(197,9,2,0,1,''),(198,9,3,0,1,''),(199,9,4,0,1,''),(200,10,1,0,1,''),(201,10,2,0,1,''),(202,10,3,0,1,''),(203,10,4,0,1,''),(204,11,1,0,1,''),(205,11,2,0,1,''),(206,11,3,0,1,''),(207,11,4,0,1,''),(208,12,1,0,1,''),(209,12,2,0,1,''),(210,12,3,0,1,''),(211,12,4,0,1,''),(212,13,1,0,1,''),(213,13,2,0,1,''),(214,13,3,0,1,''),(215,13,4,0,1,'');

/*Table structure for table `site_transfers` */

DROP TABLE IF EXISTS `site_transfers`;

CREATE TABLE `site_transfers` (
  `id` varchar(36) NOT NULL,
  `sess_id` varchar(26) NOT NULL,
  `paypal_token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `site_transfers` */

insert  into `site_transfers`(`id`,`sess_id`,`paypal_token`) values ('4c530584-85b0-4317-916b-5f0c1507707a','u480lp9q7t778f7d444fbmusq3',NULL),('4c530728-1a9c-4bdb-8537-04f61507707a','u480lp9q7t778f7d444fbmusq3',NULL),('4c5307e9-3de8-4357-966f-04f71507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530837-99ac-4498-936f-30371507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c53085f-29d4-4add-87eb-30381507707a','u480lp9q7t778f7d444fbmusq3',NULL),('4c530862-cf5c-4eb7-8215-04f61507707a','u480lp9q7t778f7d444fbmusq3',NULL),('4c530863-c05c-4ac1-a845-04f51507707a','u480lp9q7t778f7d444fbmusq3',NULL),('4c53092c-1108-4bf9-afc8-30371507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c53099f-8048-4867-bf13-30381507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530a6b-5d54-41bc-8528-04f61507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530acc-ff18-424b-9b05-04f51507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530b22-0f90-4b96-ace1-5f0c1507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530bef-5ff8-4c66-8736-390e1507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530e17-a04c-4331-9d0b-04f71507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c531788-66e0-4bb2-b563-30381507707a','vmva1l8loj77b1l8dr7anl6l86','EC-46006742RH5104307'),('4c54efbe-8a64-474f-9c56-050d1507707a','idauebspjp1qaivdr5hao57ha0','EC-5G332069L8682035K'),('4c54f1c5-737c-4fa7-a2bf-17871507707a','idauebspjp1qaivdr5hao57ha0','EC-68K43810C8105712P'),('4c54f253-7adc-4d89-b766-050b1507707a','idauebspjp1qaivdr5hao57ha0','EC-86X198677M6472030'),('4c54f52c-b98c-4f2c-996d-17851507707a','',NULL),('4c54f891-e34c-411d-9c4f-17871507707a','idauebspjp1qaivdr5hao57ha0','EC-2477257836559410J'),('4c60c03b-e580-4d2e-8451-60281507707a','hp52ash1r5vd90t7l083pq5do3','EC-7KN76010F95584617'),('4c92f863-d654-4ff5-bfcf-528d1507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c92fbab-4e50-47d2-a08b-4bdb1507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c92fc07-8914-4f4d-8587-1fd01507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c92fc86-b688-4db9-a5e2-6f311507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c92fd83-f5f4-4e3f-b045-72981507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c92fdfa-ff54-49ba-9e88-0c5c1507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c995ba5-d86c-471a-982e-050c1507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995bc2-9f4c-4176-b536-171d1507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995bd9-0620-4316-b94e-050d1507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995c5e-a37c-4d52-8fa1-0c021507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995cb4-022c-4855-b291-050b1507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995d1c-5dac-4e26-9cb1-17191507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995dd7-7398-4f00-bbeb-0c0a1507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4ca95cc8-07dc-4985-8306-1c741507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca95d47-ec68-4aca-9870-21981507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca95dce-38a8-43f6-9675-052d1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca95dfa-9218-48a2-a9ce-1c531507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca95e1b-f9f0-49a4-b239-052a1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca9609f-7188-46ff-89f4-1c741507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca960da-b1b0-44df-b099-213d1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca960f9-c110-420a-b2f5-052c1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca96191-d924-4942-8f4f-1c721507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca9619f-3ae8-414a-900b-21941507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca96352-49cc-49af-89b2-21971507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca96fe0-0af4-4de6-a8f7-052c1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca9702c-ed30-4b77-97fa-21971507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca97141-2538-414f-b6a6-1c741507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca972fd-7938-416b-a0eb-1c531507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca9731a-56dc-4c5b-a8ef-052d1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca9733d-5394-4edb-b1b0-052c1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4caa8f95-17d0-465b-908f-215c1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caa97d3-25cc-4557-9a6b-215e1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caa9997-7b60-496d-b9a5-21581507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caa9f64-30e4-4eca-90b4-60b91507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caaa134-eb90-448c-9ed1-21581507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caaa1d0-e158-45cc-8b55-21541507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caaa1dc-1808-4907-b841-733b1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caaa2af-54ec-4620-8472-697a1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caaa8e6-0a68-4aea-890b-697a1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caab480-bd84-4fb1-b18a-05be1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caab73f-8320-4859-b847-215d1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caab8bf-ec28-412b-942a-05311507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caab995-e8ac-4903-b264-24fb1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caab9e1-dffc-4dfc-85e8-32c81507707a','sk2lcgcva897uokltbct2fvkt2','EC-5S569044B2055341W'),('4caaba0e-d284-4455-af80-733b1507707a','sk2lcgcva897uokltbct2fvkt2','EC-6PY42009CL365804Y'),('4cabe022-6e98-4819-a1bc-05201507707a','gi2r1vsj9bp0resdd3k1oov113','EC-9XP01146KW846361F'),('4cabe211-fa5c-4214-9c3f-31781507707a','gi2r1vsj9bp0resdd3k1oov113','EC-3XP82027RN070462J'),('4cabe29c-3024-4e9a-b42d-317e1507707a','gi2r1vsj9bp0resdd3k1oov113','EC-5D66601308111852Y'),('4cad2d0e-d0e8-4863-8f03-050c1507707a','ckire0hgq3fenmp0iue0nc9jb5','EC-22329773CB572314D'),('4cad326e-7f54-45db-89c6-05101507707a','ckire0hgq3fenmp0iue0nc9jb5','EC-00S9413236950293K'),('4cae6732-591c-46f2-820f-04ed1507707a','d8b4c0mpuvp6fp76i3p9r9qn54','EC-72263209RM183974T'),('4caee51d-49d0-4a1b-b5d5-050e1507707a','d8b4c0mpuvp6fp76i3p9r9qn54','EC-35811075U6211992T'),('4cb05538-36d0-4d61-a25b-15541507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb05550-a53c-4608-8228-05371507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb0555b-72e8-40a2-aa5c-15561507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb05655-bee8-4b43-a920-05381507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb0568b-8618-455b-81e3-15541507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb056e7-d7d8-4b5d-b7ef-18921507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb05748-f43c-408f-ae44-05361507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb05799-ae60-43e9-9c8e-15541507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb057c3-0fb8-4a30-837d-053a1507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb058cc-6144-4b69-8cf6-18921507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb059ea-3090-4798-89d1-20441507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb05c0d-8648-49da-8dcc-05361507707a','t9vfa21af3l5atg9e1lh7a15r7','EC-7G495828M71036431'),('4cb05c7b-9eb4-41c2-9475-15561507707a','t9vfa21af3l5atg9e1lh7a15r7','EC-0CG33138JU944273J'),('4cb05cd0-0e54-4551-a016-22241507707a','ecb6dsvbhte0bacoc2t9h7baa3',NULL),('4cb05d19-84e8-4354-b0c4-05361507707a','ecb6dsvbhte0bacoc2t9h7baa3','EC-3GL84901WK649141U'),('4cb2c806-41f0-482f-ab36-22251507707a','kr0iir79m77tcn0a2fgoelun47',NULL),('4cd355ff-de3c-4be0-ba8f-04f71507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd35668-6adc-4333-9fbc-04f61507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd3569a-ced8-438a-9919-04f91507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd356c5-3c6c-42e1-8779-3aea1507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd35707-d560-4c21-ac38-3bcc1507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd35768-bba4-49aa-8909-3ac11507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd35928-3e30-4d58-afb3-04fa1507707a','sg553gh049qq8sen6tgqj2qcv2','EC-1LG56621TL9126009'),('4cd359ca-30bc-403b-aa91-04f81507707a','sg553gh049qq8sen6tgqj2qcv2','EC-1K309626V3924353E'),('4cd35a2a-a7c8-4c22-93fe-3abb1507707a','sg553gh049qq8sen6tgqj2qcv2','EC-712968814E389194H'),('4cd35a58-38b4-4f19-9c76-04f71507707a','sg553gh049qq8sen6tgqj2qcv2','EC-5CT70666X33865212'),('4cd35aa5-7688-4b93-894b-04f61507707a','sg553gh049qq8sen6tgqj2qcv2','EC-5MR52951JD8682344'),('4cd35d11-6098-4bc3-996f-04f91507707a','sg553gh049qq8sen6tgqj2qcv2','EC-41U387808T951440W'),('4cd35e5c-a778-4c87-b90b-3aea1507707a','sg553gh049qq8sen6tgqj2qcv2','EC-8FT622333V0410511'),('4cd35f53-4f18-458a-949b-3bcc1507707a','sg553gh049qq8sen6tgqj2qcv2','EC-9RG578540F341041E'),('4cd35fa8-4d4c-4544-b200-3ac11507707a','sg553gh049qq8sen6tgqj2qcv2','EC-443488659M426481G'),('4cd36037-03f4-4994-a762-04f81507707a','m87qog4ts74lf9lk1ar0gvq5o1',NULL),('4cd5069f-5924-4c6a-916e-19251507707a','kbctdurbdfat68qj51e09k5mt7',NULL),('4cd50787-a714-42c1-9e40-1aba1507707a','kbctdurbdfat68qj51e09k5mt7',NULL),('4cd507fd-073c-48dd-88fb-19321507707a','kbctdurbdfat68qj51e09k5mt7',NULL),('4cd50872-5d74-48f5-a746-04fe1507707a','qhofhtpfkrtupore8g3argtmc0',NULL),('4cd50899-3c20-4240-bcae-19331507707a','qhofhtpfkrtupore8g3argtmc0',NULL),('4cd508ef-d424-4eb5-8b66-04fe1507707a','t14p062h8377l84tmrvqlivvo6',NULL),('4cd50915-33f4-4cda-86da-1ae21507707a','t14p062h8377l84tmrvqlivvo6','EC-7UU600616M633893G'),('4cd50a76-1ec4-42e0-ab60-19331507707a','t14p062h8377l84tmrvqlivvo6','EC-392897443R184441A'),('4cd50adb-2d10-4179-8b49-19321507707a','13nnt8sap4oqbitn3dcmhle833',NULL),('4cda5d9f-7198-42cd-896c-05321507707a','fombmao8jv26dk02ocj26r5b23',NULL),('4cda5f69-d4a8-4b1c-879f-77631507707a','fombmao8jv26dk02ocj26r5b23','EC-1YD1959094360491J'),('4cda5fe4-e2a8-4e56-8936-05331507707a','fombmao8jv26dk02ocj26r5b23','EC-10T420284Y624321Y'),('4cdbc870-05d4-4205-9122-05201507707a','eov902rflkpff6v5vmog5op3g7','EC-26L19599P98142053'),('4cdbc9a0-16c8-4dd4-bcf2-051f1507707a','eov902rflkpff6v5vmog5op3g7','EC-75D74411HX4252132');

/*Table structure for table `subscription_plans` */

DROP TABLE IF EXISTS `subscription_plans`;

CREATE TABLE `subscription_plans` (
  `id` varchar(255) NOT NULL,
  `currency_code` varchar(10) DEFAULT NULL,
  `price` decimal(7,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `subscription_plans` */

insert  into `subscription_plans`(`id`,`currency_code`,`price`) values ('starter','SGD','19.90'),('basic','SGD','39.90'),('standard','SGD','99.90'),('business','SGD','399.90');

/*Table structure for table `themes` */

DROP TABLE IF EXISTS `themes`;

CREATE TABLE `themes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `available_for_all` tinyint(1) NOT NULL DEFAULT '1',
  `folder_name` varchar(255) NOT NULL DEFAULT '',
  `shop_id` int(11) DEFAULT '0',
  `price` decimal(7,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `themes` */

insert  into `themes`(`id`,`name`,`description`,`author`,`created`,`modified`,`available_for_all`,`folder_name`,`shop_id`,`price`) values (1,'blue-white','blue-white','kimsia','2010-05-13 00:00:00','2010-05-13 00:00:00',1,'',NULL,'1.00'),(2,'orange','orange','kimsia','2010-05-13 00:00:00','2010-05-13 00:00:00',1,'',NULL,'1.00'),(3,'default','default','kimsia','2010-07-06 12:55:23','2010-07-06 12:55:28',1,'default',NULL,'0.00'),(4,'alt','alt','kimsia','2010-07-08 00:00:00','2010-07-08 00:00:00',1,'alt',NULL,'0.00');

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
  `language_id` int(5) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`group_id`,`full_name`,`name_to_call`,`last_login_on`,`status`,`created`,`modified`,`language_id`) values (1,'owner@shop1.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'tester testerson','tester',NULL,1,'2010-12-13 20:33:39','2010-12-13 20:33:39',1),(2,'payz9vr$@ombi60.com','44d3a314c1be82516b574c8af5b8f4bdf04ba863',5,'casual','casual',NULL,1,'2010-12-13 12:37:26','2010-12-13 12:37:26',1),(3,'dqo$hlb7@ombi60.com','19c32972c688a8587c70afdc39e4232562c82e58',5,'casual','casual',NULL,1,'2010-12-13 12:40:34','2010-12-13 12:40:34',1),(4,'n7tv5ue4@ombi60.com','da04e1bb0774db964e74ae231411b82e6c5449f6',5,'casual','casual',NULL,1,'2010-12-13 12:47:25','2010-12-13 12:47:25',1),(5,'owner@shop2.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'barry','barry fuller',NULL,1,'2010-12-13 20:57:44','2010-12-13 20:57:44',1),(6,'2gulpv7e@ombi60.com','2c368c4deaa4993faaac8d1e67fc22de41aad2d5',5,'casual','casual',NULL,1,'2010-12-13 13:04:09','2010-12-13 13:04:09',1),(7,'owner@shop3.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'sanchze','vicario',NULL,1,'2010-12-13 21:38:04','2010-12-13 21:38:04',1),(8,'owner@shop4.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'barry','barry',NULL,1,'2010-12-13 21:42:33','2010-12-13 21:42:33',1),(9,'9ci3yjst@ombi60.com','d9fe6d376dd12290c0487be9df5b4d98e91003c6',5,'casual','casual',NULL,1,'2010-12-13 13:43:21','2010-12-13 13:43:21',1),(10,'owner@shop5.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'garry','garry',NULL,1,'2010-12-15 19:27:01','2010-12-15 19:27:01',1),(11,'owner@shop6.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'garry','garry',NULL,1,'2010-12-15 19:37:51','2010-12-15 19:37:51',1),(12,'owner@shop7.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'garry','garry',NULL,1,'2010-12-15 19:39:42','2010-12-15 19:39:42',1),(13,'owner@shop8.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'shop8','b',NULL,1,'2010-12-15 19:44:21','2010-12-15 19:44:21',1),(14,'owner@shop9.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'o','o',NULL,1,'2010-12-15 19:46:37','2010-12-15 19:46:37',1),(15,'owner@shop10.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'o','o',NULL,1,'2010-12-15 19:48:10','2010-12-15 19:48:10',1),(16,'owner@shop11.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'o','o',NULL,1,'2010-12-15 19:49:24','2010-12-15 19:49:24',1),(17,'owner@shop12.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'o','o',NULL,1,'2010-12-15 19:53:21','2010-12-15 19:53:21',1),(18,'2kxyqgvo@ombi60.com','4f9c042b5aee3db32b0db64ef35f65f4faf8dc46',5,'casual','casual',NULL,1,'2010-12-15 11:56:05','2010-12-15 11:56:05',1);

/*Table structure for table `webpages` */

DROP TABLE IF EXISTS `webpages`;

CREATE TABLE `webpages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `text` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `meta_title` text,
  `meta_keywords` text,
  `meta_description` text,
  `author` int(11) DEFAULT NULL,
  `real_author` int(11) DEFAULT NULL,
  `handle` varchar(150) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `webpages` */

insert  into `webpages`(`id`,`shop_id`,`title`,`text`,`created`,`modified`,`meta_title`,`meta_keywords`,`meta_description`,`author`,`real_author`,`handle`,`visible`) values (1,5,'welcome','	<div class=\"item\">\r\n		<table cellpadding=\"0\" cellspacing=\"0\" class=\"itemTable\">\r\n			<tr>\r\n				<td class=\"itemLeftCell\">\r\n					Lorem ipsum dolor sit amet, consectetur \r\n					adipiscing elit. <a href=\"#\">Sed semper est sed</a> eros sodales \r\n					in lacinia dolor egestas. Integer semper imperdiet enim eu \r\n					convallis. Suspendisse nec orci tellus. Aenean consectetur \r\n					venenatis gravida. Suspendisse et ipsum nisl. Nam quis libero a \r\n					nibh mollis lobortis. Ut venenatis tortor tellus. In ac magna \r\n					quam. Etiam ac risus magna, nec pretium diam. <a href=\"#\">\r\n					Phasellus euismod</a> \r\n					leo at leo vestibulum dapibus. Quisque sit amet nibh ut nisi \r\n					congue gravida nec nec ligula. Morbi feugiat mattis volutpat. \r\n					Praesent aliquet sem sit amet massa scelerisque vitae semper \r\n					purus varius. Pellentesque habitant morbi tristique senectus et \r\n					netus et malesuada fames ac turpis egestas.\r\n				</td>\r\n				<td class=\"itemRightCell\">\r\n					<img alt=\"Picture 1\" src=\"user_generated_content/images/Jellyfish.jpg\" width=\"192\" height=\"144\" />\r\n				</td>\r\n			</tr>\r\n		</table>\r\n	</div>\r\n	\r\n	<div class=\"itemAlt\">\r\n		<table cellpadding=\"0\" cellspacing=\"0\" class=\"itemTable\">\r\n			<tr>\r\n				<td class=\"itemLeftCell\">\r\n					Proin mauris tortor, ultricies \r\n					interdum posuere eu, placerat vitae orci. Duis non laoreet \r\n					libero. Suspendisse aliquam congue metus non elementum. Cras \r\n					quis bibendum lorem. Quisque cursus aliquam mattis. Sed id orci \r\n					tortor. Suspendisse potenti. Nulla luctus interdum massa in \r\n					malesuada. Fusce mi magna, gravida a pretium quis, ultrices vel \r\n					orci. <a href=\"#\">Nullam sollicitudin</a> nibh ac dolor tempor \r\n					porttitor. Curabitur id lacus vitae ipsum rhoncus varius. Class \r\n					aptent taciti sociosqu ad litora torquent per conubia nostra, \r\n					per inceptos himenaeos. Nunc pharetra eros et dui adipiscing \r\n					ultrices. Nunc eros lectus, bibendum eu consequat id, \r\n					<a href=\"#\">cursus non quam</a>. Nam vel dolor dolor. \r\n					Pellentesque ante tortor, mattis auctor condimentum ut, \r\n					convallis a dui. Mauris scelerisque dapibus libero, vitae \r\n					facilisis tellus mattis a. Pellentesque metus nulla, tristique \r\n					at venenatis et, egestas a diam.\r\n				</td>\r\n				<td class=\"itemRightCell\">\r\n					<img alt=\"Picture 2\" src=\"user_generated_content/images/Koala.jpg\" width=\"192\" height=\"144\" />\r\n				</td>\r\n			</tr>\r\n		</table>\r\n	</div>\r\n	\r\n	<div class=\"item\">\r\n		<table cellpadding=\"0\" cellspacing=\"0\" class=\"itemTable\">\r\n			<tr>\r\n				<td class=\"itemLeftCell\">\r\n					Nulla auctor sapien lorem. Ut vitae \r\n					euismod elit. Ut sit amet sagittis felis. Cras sollicitudin quam \r\n					eu magna tempus eleifend. Donec interdum interdum lacus eget \r\n					iaculis. Nulla facilisi. Phasellus <a href=\"#\">eget lacus auctor</a> \r\n					nibh rhoncus condimentum. Fusce volutpat, felis vel tincidunt \r\n					pellentesque, orci lorem vestibulum elit, ac tristique justo \r\n					magna at ante. <a href=\"#\">Lorem ipsum</a> dolor sit amet, \r\n					consectetur adipiscing elit. Curabitur rutrum interdum tempus. \r\n					Nunc et sapien eros, et ultrices elit. <a href=\"#\">Maecenas in \r\n					leo dui</a>, sit amet iaculis lectus. Duis lacinia, velit ut \r\n					vehicula dictum, eros sem ultricies tortor, ac faucibus dui dui \r\n					et enim. Phasellus feugiat faucibus elit, eget ultrices lacus \r\n					fringilla sit amet. Vivamus faucibus nisl a enim lacinia \r\n					venenatis. In tincidunt tincidunt dolor vel rutrum. Donec vitae \r\n					orci ut nibh tristique laoreet.\r\n				</td>\r\n				<td class=\"itemRightCell\">\r\n					<img alt=\"Picture 3\" src=\"user_generated_content/images/Hydrangeas.jpg\" width=\"192\" height=\"144\" />\r\n				</td>\r\n			</tr>\r\n		</table>\r\n	</div>','2010-09-01 11:38:15','2010-09-16 09:35:28',NULL,NULL,NULL,4,NULL,'shopfront',1),(2,5,'yabba dabba doo','test test','2010-09-05 05:10:11','2010-09-05 05:10:11',NULL,NULL,NULL,5,NULL,'yabba-dabba-doo',1);

/*Table structure for table `weight_based_rates` */

DROP TABLE IF EXISTS `weight_based_rates`;

CREATE TABLE `weight_based_rates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `min_weight` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `max_weight` decimal(10,4) unsigned DEFAULT NULL,
  `shipping_rate_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `weight_based_rates` */

insert  into `weight_based_rates`(`id`,`min_weight`,`max_weight`,`shipping_rate_id`) values (1,'2.0000','20.0000',2),(2,'20.0000','50.0000',3);

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
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

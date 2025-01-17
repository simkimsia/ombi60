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
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=utf8;

/*Data for the table `acos` */

insert  into `acos`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,NULL,NULL,'controllers',1,376),(2,1,NULL,NULL,'Pages',2,7),(3,2,NULL,NULL,'display',3,4),(4,2,NULL,NULL,'admin_change_active_status',5,6),(5,1,NULL,NULL,'PaydollarTransactions',8,13),(6,5,NULL,NULL,'datafeed',9,10),(7,5,NULL,NULL,'admin_change_active_status',11,12),(8,1,NULL,NULL,'Orders',14,37),(9,8,NULL,NULL,'paypal',15,16),(10,8,NULL,NULL,'index',17,18),(11,8,NULL,NULL,'admin_index',19,20),(12,8,NULL,NULL,'admin_view',21,22),(13,8,NULL,NULL,'view',23,24),(14,8,NULL,NULL,'add',25,26),(15,8,NULL,NULL,'checkout',27,28),(16,8,NULL,NULL,'success',29,30),(17,8,NULL,NULL,'updatePrices',31,32),(18,8,NULL,NULL,'pay',33,34),(19,8,NULL,NULL,'admin_change_active_status',35,36),(20,1,NULL,NULL,'Payments',38,55),(21,20,NULL,NULL,'admin_index',39,40),(22,20,NULL,NULL,'admin_update_settings',41,42),(23,20,NULL,NULL,'admin_add_paypal_payment',43,44),(24,20,NULL,NULL,'admin_add_custom_payment',45,46),(25,20,NULL,NULL,'admin_edit_paypal_payment',47,48),(26,20,NULL,NULL,'admin_edit_custom_payment',49,50),(27,20,NULL,NULL,'admin_delete_custom_payment',51,52),(28,20,NULL,NULL,'admin_change_active_status',53,54),(29,1,NULL,NULL,'Users',56,75),(30,29,NULL,NULL,'parentNode',57,58),(31,29,NULL,NULL,'initDB',59,60),(32,29,NULL,NULL,'login',61,62),(33,29,NULL,NULL,'logout',63,64),(34,29,NULL,NULL,'platform_login',65,66),(35,29,NULL,NULL,'platform_logout',67,68),(36,29,NULL,NULL,'platform_index',69,70),(37,29,NULL,NULL,'afterSave',71,72),(38,29,NULL,NULL,'admin_change_active_status',73,74),(39,1,NULL,NULL,'ProductImages',76,91),(40,39,NULL,NULL,'admin_add',77,78),(41,39,NULL,NULL,'admin_add_by_product',79,80),(42,39,NULL,NULL,'admin_uploadify',81,82),(43,39,NULL,NULL,'admin_list_by_product',83,84),(44,39,NULL,NULL,'admin_delete',85,86),(45,39,NULL,NULL,'admin_make_this_cover',87,88),(46,39,NULL,NULL,'admin_change_active_status',89,90),(47,1,NULL,NULL,'Carts',92,103),(48,47,NULL,NULL,'index',93,94),(49,47,NULL,NULL,'view',95,96),(50,47,NULL,NULL,'edit',97,98),(51,47,NULL,NULL,'delete',99,100),(52,47,NULL,NULL,'admin_change_active_status',101,102),(53,1,NULL,NULL,'Blogs',104,119),(54,53,NULL,NULL,'view',105,106),(55,53,NULL,NULL,'admin_index',107,108),(56,53,NULL,NULL,'admin_view',109,110),(57,53,NULL,NULL,'admin_add',111,112),(58,53,NULL,NULL,'admin_edit',113,114),(59,53,NULL,NULL,'admin_delete',115,116),(60,53,NULL,NULL,'admin_change_active_status',117,118),(61,1,NULL,NULL,'Addresses',120,125),(62,61,NULL,NULL,'index',121,122),(63,61,NULL,NULL,'admin_change_active_status',123,124),(64,1,NULL,NULL,'Webpages',126,141),(65,64,NULL,NULL,'view',127,128),(66,64,NULL,NULL,'admin_index',129,130),(67,64,NULL,NULL,'admin_view',131,132),(68,64,NULL,NULL,'admin_add',133,134),(69,64,NULL,NULL,'admin_edit',135,136),(70,64,NULL,NULL,'admin_delete',137,138),(71,64,NULL,NULL,'admin_change_active_status',139,140),(72,1,NULL,NULL,'Merchants',142,163),(73,72,NULL,NULL,'register',143,144),(74,72,NULL,NULL,'admin_login',145,146),(75,72,NULL,NULL,'admin_logout',147,148),(76,72,NULL,NULL,'admin_index',149,150),(77,72,NULL,NULL,'admin_edit',151,152),(78,72,NULL,NULL,'platform_index',153,154),(79,72,NULL,NULL,'platform_view',155,156),(80,72,NULL,NULL,'platform_edit',157,158),(81,72,NULL,NULL,'platform_delete',159,160),(82,72,NULL,NULL,'admin_change_active_status',161,162),(83,1,NULL,NULL,'Themes',164,169),(84,83,NULL,NULL,'admin_index',165,166),(85,83,NULL,NULL,'admin_change_active_status',167,168),(86,1,NULL,NULL,'Customers',170,179),(87,86,NULL,NULL,'register',171,172),(88,86,NULL,NULL,'login',173,174),(89,86,NULL,NULL,'logout',175,176),(90,86,NULL,NULL,'admin_change_active_status',177,178),(91,1,NULL,NULL,'SavedThemes',180,205),(92,91,NULL,NULL,'admin_index',181,182),(93,91,NULL,NULL,'admin_view',183,184),(94,91,NULL,NULL,'admin_switch',185,186),(95,91,NULL,NULL,'admin_add',187,188),(96,91,NULL,NULL,'admin_upload',189,190),(97,91,NULL,NULL,'admin_edit',191,192),(98,91,NULL,NULL,'admin_delete',193,194),(99,91,NULL,NULL,'admin_edit_image',195,196),(100,91,NULL,NULL,'admin_feature',197,198),(101,91,NULL,NULL,'admin_delete_image',199,200),(102,91,NULL,NULL,'admin_edit_css',201,202),(103,91,NULL,NULL,'admin_change_active_status',203,204),(104,1,NULL,NULL,'Shops',206,213),(105,104,NULL,NULL,'admin_account',207,208),(106,104,NULL,NULL,'admin_cancelaccount',209,210),(107,104,NULL,NULL,'admin_change_active_status',211,212),(108,1,NULL,NULL,'ShippingRates',214,227),(109,108,NULL,NULL,'admin_index',215,216),(110,108,NULL,NULL,'admin_edit',217,218),(111,108,NULL,NULL,'admin_add_price_based',219,220),(112,108,NULL,NULL,'admin_add_weight_based',221,222),(113,108,NULL,NULL,'admin_delete',223,224),(114,108,NULL,NULL,'admin_change_active_status',225,226),(115,1,NULL,NULL,'Groups',228,233),(116,115,NULL,NULL,'parentNode',229,230),(117,115,NULL,NULL,'admin_change_active_status',231,232),(118,1,NULL,NULL,'Domains',234,249),(119,118,NULL,NULL,'admin_index',235,236),(120,118,NULL,NULL,'admin_view',237,238),(121,118,NULL,NULL,'admin_add',239,240),(122,118,NULL,NULL,'admin_make_this_primary',241,242),(123,118,NULL,NULL,'admin_edit',243,244),(124,118,NULL,NULL,'admin_delete',245,246),(125,118,NULL,NULL,'admin_change_active_status',247,248),(126,1,NULL,NULL,'Products',250,293),(127,126,NULL,NULL,'checkout',251,252),(128,126,NULL,NULL,'view_cart',253,254),(129,126,NULL,NULL,'admin_index',255,256),(130,126,NULL,NULL,'admin_view',257,258),(131,126,NULL,NULL,'view',259,260),(132,126,NULL,NULL,'index',261,262),(133,126,NULL,NULL,'admin_add',263,264),(134,126,NULL,NULL,'admin_upload',265,266),(135,126,NULL,NULL,'admin_toggle',267,268),(136,126,NULL,NULL,'admin_edit',269,270),(137,126,NULL,NULL,'admin_delete',271,272),(138,126,NULL,NULL,'admin_duplicate',273,274),(139,126,NULL,NULL,'platform_index',275,276),(140,126,NULL,NULL,'platform_view',277,278),(141,126,NULL,NULL,'platform_add',279,280),(142,126,NULL,NULL,'platform_edit',281,282),(143,126,NULL,NULL,'platform_delete',283,284),(144,126,NULL,NULL,'edit_quantities_in_cart',285,286),(145,126,NULL,NULL,'add_to_cart',287,288),(146,126,NULL,NULL,'delete_from_cart',289,290),(147,126,NULL,NULL,'admin_change_active_status',291,292),(148,1,NULL,NULL,'Posts',294,307),(149,148,NULL,NULL,'view',295,296),(150,148,NULL,NULL,'admin_view',297,298),(151,148,NULL,NULL,'admin_add',299,300),(152,148,NULL,NULL,'admin_edit',301,302),(153,148,NULL,NULL,'admin_delete',303,304),(154,148,NULL,NULL,'admin_change_active_status',305,306),(155,1,NULL,NULL,'GiftCards',308,331),(156,155,NULL,NULL,'index',309,310),(157,155,NULL,NULL,'view',311,312),(158,155,NULL,NULL,'add',313,314),(159,155,NULL,NULL,'edit',315,316),(160,155,NULL,NULL,'delete',317,318),(161,155,NULL,NULL,'admin_index',319,320),(162,155,NULL,NULL,'admin_view',321,322),(163,155,NULL,NULL,'admin_add',323,324),(164,155,NULL,NULL,'admin_edit',325,326),(165,155,NULL,NULL,'admin_delete',327,328),(166,155,NULL,NULL,'admin_change_active_status',329,330),(167,1,NULL,NULL,'TinyMce',332,333),(168,1,NULL,NULL,'MeioUpload',334,335),(169,1,NULL,NULL,'Copyable',336,337),(170,1,NULL,NULL,'CodeCheck',338,339),(171,1,NULL,NULL,'MeioDuplicate',340,341),(172,1,NULL,NULL,'Recaptcha',342,343),(173,1,NULL,NULL,'ThemeFolder',344,345),(174,1,NULL,NULL,'Datasources',346,347),(175,1,NULL,NULL,'AclExtras',348,349),(176,1,NULL,NULL,'Filter',350,351),(177,1,NULL,NULL,'Rest',352,353),(178,1,NULL,NULL,'Paypal',354,355),(179,1,NULL,NULL,'RandomString',356,357),(180,1,NULL,NULL,'ClearCache',358,359),(181,1,NULL,NULL,'Uploadify',360,361),(182,1,NULL,NULL,'Paydollar',362,363),(183,1,NULL,NULL,'Linkable',364,365),(184,1,NULL,NULL,'DebugKit',366,375),(185,184,NULL,NULL,'ToolbarAccess',367,374),(186,185,NULL,NULL,'history_state',368,369),(187,185,NULL,NULL,'sql_explain',370,371),(188,185,NULL,NULL,'admin_change_active_status',372,373);

/*Table structure for table `addresses` */

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `country` int(5) unsigned DEFAULT '0',
  `customer_id` int(11) NOT NULL,
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `full_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `addresses` */

insert  into `addresses`(`id`,`address`,`city`,`region`,`zip_code`,`country`,`customer_id`,`type`,`full_name`) values (1,'asd','asd','asd','asd',192,1,1,'asd'),(2,'asd','asd','asd','asd',192,1,2,'asd'),(3,'asd','asd','asd','asd',192,2,1,'asd'),(4,'asd','asd','asd','asd',192,2,2,'asd'),(5,'coffee house 101','Singapore','','123456',192,3,2,'mister customer'),(6,'coffee house 101','Singapore','','123456',192,3,1,'mister customer'),(7,'asd','asd','asd','asd',192,4,1,'asd'),(8,'asd','asd','asd','asd',192,4,2,'asd'),(9,'asd','asd','asd','asd',192,3,1,'asd'),(10,'asd','asd','asd','asd',192,3,2,'asd'),(11,'asd','asd','azsd','asd',192,3,1,'asd'),(12,'asd','asd','azsd','asd',192,3,2,'asd'),(13,'asd','assd','ad','asd',192,3,1,'asd'),(14,'asd','assd','ad','asd',192,3,2,'asd'),(15,'assd','asd','asd','asd',192,3,1,'asd'),(16,'assd','asd','asd','asd',192,3,2,'asd'),(17,'asd','asd','asd','ad',192,3,1,'asd'),(18,'asd','asd','asd','ad',192,3,2,'asd'),(19,'as','as','as','as',192,3,1,'as'),(20,'as','as','as','as',192,3,2,'as');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `aros` */

insert  into `aros`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'Group',1,'administrators',1,2),(2,NULL,'Group',2,'editors',3,4),(3,NULL,'Group',3,'merchants',5,8),(4,NULL,'Group',4,'customers',9,14),(5,NULL,'Group',5,'casual',15,20),(6,3,'User',1,NULL,6,7),(7,5,'User',2,NULL,16,17),(8,5,'User',3,NULL,18,19),(9,4,'User',4,NULL,10,11),(10,4,'User',5,NULL,12,13);

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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

/*Data for the table `aros_acos` */

insert  into `aros_acos`(`id`,`aro_id`,`aco_id`,`_create`,`_read`,`_update`,`_delete`) values (1,1,1,'1','1','1','1'),(2,2,3,'1','1','1','1'),(3,2,1,'-1','-1','-1','-1'),(4,2,126,'1','1','1','1'),(5,2,104,'1','1','1','1'),(6,2,29,'1','1','1','1'),(7,2,118,'1','1','1','1'),(8,2,83,'1','1','1','1'),(9,3,1,'-1','-1','-1','-1'),(10,3,3,'1','1','1','1'),(11,3,133,'1','1','1','1'),(12,3,136,'1','1','1','1'),(13,3,137,'1','1','1','1'),(14,3,130,'1','1','1','1'),(15,3,129,'1','1','1','1'),(16,3,134,'1','1','1','1'),(17,3,138,'1','1','1','1'),(18,3,135,'1','1','1','1'),(19,3,40,'1','1','1','1'),(20,3,44,'1','1','1','1'),(21,3,43,'1','1','1','1'),(22,3,45,'1','1','1','1'),(23,3,41,'1','1','1','1'),(24,3,42,'1','1','1','1'),(25,3,76,'1','1','1','1'),(26,3,77,'1','1','1','1'),(27,3,75,'1','1','1','1'),(28,3,74,'1','1','1','1'),(29,3,121,'1','1','1','1'),(30,3,123,'1','1','1','1'),(31,3,124,'1','1','1','1'),(32,3,120,'1','1','1','1'),(33,3,119,'1','1','1','1'),(34,3,122,'1','1','1','1'),(35,3,92,'1','1','1','1'),(36,3,97,'1','1','1','1'),(37,3,95,'1','1','1','1'),(38,3,98,'1','1','1','1'),(39,3,100,'1','1','1','1'),(40,3,99,'1','1','1','1'),(41,3,101,'1','1','1','1'),(42,3,102,'1','1','1','1'),(43,3,94,'1','1','1','1'),(44,3,105,'1','1','1','1'),(45,3,106,'1','1','1','1'),(46,3,21,'1','1','1','1'),(47,3,22,'1','1','1','1'),(48,3,24,'1','1','1','1'),(49,3,26,'1','1','1','1'),(50,3,27,'1','1','1','1'),(51,3,23,'1','1','1','1'),(52,3,25,'1','1','1','1'),(53,3,109,'1','1','1','1'),(54,3,111,'1','1','1','1'),(55,3,112,'1','1','1','1'),(56,3,110,'1','1','1','1'),(57,3,113,'1','1','1','1'),(58,3,11,'1','1','1','1'),(59,3,12,'1','1','1','1'),(60,3,68,'1','1','1','1'),(61,3,69,'1','1','1','1'),(62,3,70,'1','1','1','1'),(63,3,67,'1','1','1','1'),(64,3,66,'1','1','1','1'),(65,3,57,'1','1','1','1'),(66,3,58,'1','1','1','1'),(67,3,59,'1','1','1','1'),(68,3,56,'1','1','1','1'),(69,3,55,'1','1','1','1'),(70,3,151,'1','1','1','1'),(71,3,152,'1','1','1','1'),(72,3,153,'1','1','1','1'),(73,3,150,'1','1','1','1'),(74,4,1,'-1','-1','-1','-1'),(75,4,3,'1','1','1','1'),(76,4,33,'1','1','1','1'),(77,4,32,'1','1','1','1'),(78,4,89,'1','1','1','1'),(79,4,88,'1','1','1','1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `blogs` */

insert  into `blogs`(`id`,`name`,`short_name`,`description`,`theme`,`created`,`modified`,`shop_id`) values (1,'shop001','shop001',NULL,NULL,'2011-01-02 22:14:57','2011-01-02 22:14:57',2);

/*Table structure for table `cake_sessions` */

DROP TABLE IF EXISTS `cake_sessions`;

CREATE TABLE `cake_sessions` (
  `id` varchar(255) NOT NULL,
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `cake_sessions` */

insert  into `cake_sessions`(`id`,`data`,`expires`) values ('48hbkhg5jbj4a5ifccf9u90ql3','Config|a:4:{s:9:\"userAgent\";s:32:\"99d2786d2e6cfa4c8cace72a8f09e3f5\";s:4:\"time\";i:1294013762;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:2:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"3\";s:4:\"name\";s:7:\"shop001\";s:11:\"web_address\";s:31:\"http://shop001.ombi60.localhost\";s:7:\"created\";s:19:\"2011-01-02 14:45:12\";s:8:\"modified\";s:19:\"2011-01-02 14:45:12\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"1\";s:11:\"deny_access\";s:1:\"0\";}s:6:\"Domain\";a:6:{s:6:\"domain\";s:31:\"http://shop001.ombi60.localhost\";s:2:\"id\";s:1:\"3\";s:7:\"shop_id\";s:1:\"3\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";s:16:\"shop_web_address\";s:1:\"1\";}}Message|a:0:{}Auth|a:4:{s:4:\"User\";a:10:{s:2:\"id\";s:1:\"2\";s:5:\"email\";s:17:\"owner@shop001.com\";s:8:\"group_id\";s:1:\"3\";s:9:\"full_name\";s:7:\"shop001\";s:12:\"name_to_call\";s:7:\"shop001\";s:13:\"last_login_on\";N;s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2011-01-02 14:45:12\";s:8:\"modified\";s:19:\"2011-01-02 14:45:12\";s:11:\"language_id\";s:1:\"1\";}s:8:\"Merchant\";a:4:{s:2:\"id\";s:1:\"2\";s:5:\"owner\";s:1:\"1\";s:7:\"shop_id\";s:1:\"3\";s:7:\"user_id\";s:1:\"2\";}s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"3\";s:4:\"name\";s:7:\"shop001\";s:11:\"web_address\";s:31:\"http://shop001.ombi60.localhost\";s:7:\"created\";s:19:\"2011-01-02 14:45:12\";s:8:\"modified\";s:19:\"2011-01-02 14:45:12\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"1\";s:11:\"deny_access\";s:1:\"0\";}s:8:\"Language\";a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:7:\"English\";s:11:\"locale_name\";s:3:\"eng\";}}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"f8189bcb05a9b2fa093bcab97b8e1f24034887a9\";s:7:\"expires\";i:1293995762;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";Filter|a:1:{s:8:\"products\";a:1:{s:11:\"admin_index\";s:20:\"/Filter.parsed:true/\";}}Shop|a:1:{i:3;a:5:{s:8:\"Payments\";a:1:{i:0;a:25:{s:3:\"amt\";s:5:\"20.00\";s:12:\"currencycode\";s:3:\"SGD\";s:7:\"itemamt\";s:5:\"20.00\";s:11:\"shippingamt\";s:4:\"0.00\";s:22:\"insuranceoptionoffered\";s:0:\"\";s:11:\"handlingamt\";s:0:\"\";s:6:\"taxamt\";s:4:\"0.00\";s:4:\"desc\";s:0:\"\";s:6:\"custom\";s:0:\"\";s:6:\"invnum\";s:0:\"\";s:9:\"notifyurl\";s:0:\"\";s:10:\"shiptoname\";s:0:\"\";s:12:\"shiptostreet\";s:0:\"\";s:13:\"shiptostreet2\";s:0:\"\";s:10:\"shiptocity\";s:0:\"\";s:11:\"shiptostate\";s:0:\"\";s:9:\"shiptozip\";s:0:\"\";s:17:\"shiptocountrycode\";s:0:\"\";s:14:\"shiptophonenum\";s:0:\"\";s:8:\"notetext\";s:0:\"\";s:20:\"allowedpaymentmethod\";s:0:\"\";s:13:\"paymentaction\";s:4:\"Sale\";s:16:\"paymentrequestid\";s:0:\"\";s:21:\"sellerpaypalaccountid\";s:0:\"\";s:11:\"order_items\";a:1:{i:0;a:19:{s:4:\"name\";s:7:\"product\";s:4:\"desc\";s:0:\"\";s:3:\"amt\";s:5:\"10.00\";s:6:\"number\";s:1:\"3\";s:3:\"qty\";s:1:\"2\";s:6:\"taxamt\";s:0:\"\";s:7:\"itemurl\";s:47:\"http://shop001.ombi60.localhost/products/view/3\";s:15:\"itemweightvalue\";s:7:\"10.0000\";s:14:\"itemweightunit\";s:2:\"kg\";s:15:\"itemheightvalue\";s:0:\"\";s:14:\"itemheightunit\";s:0:\"\";s:14:\"itemwidthvalue\";s:0:\"\";s:13:\"itemwidthunit\";s:0:\"\";s:15:\"itemlengthvalue\";s:0:\"\";s:14:\"itemlengthunit\";s:0:\"\";s:14:\"ebayitemnumber\";s:0:\"\";s:20:\"ebayitemauctiontxnid\";s:0:\"\";s:15:\"ebayitemorderid\";s:0:\"\";s:14:\"ebayitemcartid\";s:0:\"\";}}}}s:13:\"paymentAmount\";s:5:\"20.00\";s:12:\"PayPalResult\";a:28:{s:5:\"TOKEN\";N;s:28:\"SUCCESSPAGEREDIRECTREQUESTED\";s:5:\"false\";s:9:\"TIMESTAMP\";s:20:\"2011-01-02T06:48:05Z\";s:13:\"CORRELATIONID\";s:13:\"3063d2aa51b7d\";s:3:\"ACK\";s:7:\"Success\";s:7:\"VERSION\";s:4:\"63.0\";s:5:\"BUILD\";s:7:\"1613703\";s:23:\"INSURANCEOPTIONSELECTED\";s:5:\"false\";s:23:\"SHIPPINGOPTIONISDEFAULT\";s:5:\"false\";s:27:\"PAYMENTINFO_0_TRANSACTIONID\";s:17:\"5991034928295014U\";s:29:\"PAYMENTINFO_0_TRANSACTIONTYPE\";s:4:\"cart\";s:25:\"PAYMENTINFO_0_PAYMENTTYPE\";s:7:\"instant\";s:23:\"PAYMENTINFO_0_ORDERTIME\";s:20:\"2011-01-02T06:48:04Z\";s:17:\"PAYMENTINFO_0_AMT\";s:5:\"30.00\";s:20:\"PAYMENTINFO_0_FEEAMT\";s:4:\"1.52\";s:20:\"PAYMENTINFO_0_TAXAMT\";s:4:\"0.00\";s:26:\"PAYMENTINFO_0_CURRENCYCODE\";s:3:\"SGD\";s:27:\"PAYMENTINFO_0_PAYMENTSTATUS\";s:9:\"Completed\";s:27:\"PAYMENTINFO_0_PENDINGREASON\";s:4:\"None\";s:24:\"PAYMENTINFO_0_REASONCODE\";s:4:\"None\";s:35:\"PAYMENTINFO_0_PROTECTIONELIGIBILITY\";s:10:\"Ineligible\";s:23:\"PAYMENTINFO_0_ERRORCODE\";s:1:\"0\";s:17:\"PAYMENTINFO_0_ACK\";s:7:\"Success\";s:6:\"ERRORS\";a:0:{}s:8:\"PAYMENTS\";a:1:{i:0;a:17:{s:13:\"TRANSACTIONID\";s:17:\"5991034928295014U\";s:15:\"TRANSACTIONTYPE\";s:4:\"cart\";s:11:\"PAYMENTTYPE\";s:7:\"instant\";s:9:\"ORDERTIME\";s:20:\"2011-01-02T06:48:04Z\";s:3:\"AMT\";s:5:\"30.00\";s:6:\"FEEAMT\";s:4:\"1.52\";s:9:\"SETTLEAMT\";s:0:\"\";s:6:\"TAXAMT\";s:4:\"0.00\";s:12:\"EXCHANGERATE\";s:0:\"\";s:12:\"CURRENCYCODE\";s:3:\"SGD\";s:13:\"PAYMENTSTATUS\";s:9:\"Completed\";s:13:\"PENDINGREASON\";s:4:\"None\";s:10:\"REASONCODE\";s:4:\"None\";s:21:\"PROTECTIONELIGIBILITY\";s:10:\"Ineligible\";s:9:\"ERRORCODE\";s:1:\"0\";s:9:\"FMFILTERS\";a:0:{}s:6:\"ERRORS\";a:0:{}}}s:11:\"REQUESTDATA\";a:61:{s:4:\"USER\";s:35:\"merch_1277746388_biz_api1.gmail.com\";s:3:\"PWD\";s:10:\"1277746393\";s:7:\"VERSION\";s:4:\"63.0\";s:12:\"BUTTONSOURCE\";s:0:\"\";s:7:\"SUBJECT\";s:17:\"owner@shop001.com\";s:9:\"SIGNATURE\";s:56:\"AHExNCgTOAf6I0jS8V77WYVPl78nAUalMl21CFNLpKr4giwMI6dr5DKE\";s:6:\"METHOD\";s:24:\"DoExpressCheckoutPayment\";s:5:\"TOKEN\";s:20:\"EC-7ET33190P4081551S\";s:7:\"PAYERID\";s:13:\"L3LUD63MGMMP4\";s:16:\"RETURNFMFDETAILS\";s:1:\"1\";s:11:\"GIFTMESSAGE\";s:0:\"\";s:17:\"GIFTRECEIPTENABLE\";s:0:\"\";s:12:\"GIFTWRAPNAME\";s:0:\"\";s:14:\"GIFTWRAPAMOUNT\";s:0:\"\";s:19:\"BUYERMARKETINGEMAIL\";s:0:\"\";s:14:\"SURVEYQUESTION\";s:0:\"\";s:20:\"SURVEYCHOICESELECTED\";s:0:\"\";s:20:\"ALLOWEDPAYMENTMETHOD\";s:0:\"\";s:20:\"PAYMENTREQUEST_0_AMT\";s:2:\"30\";s:29:\"PAYMENTREQUEST_0_CURRENCYCODE\";s:3:\"SGD\";s:24:\"PAYMENTREQUEST_0_ITEMAMT\";s:5:\"20.00\";s:28:\"PAYMENTREQUEST_0_SHIPPINGAMT\";s:5:\"10.00\";s:39:\"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED\";s:0:\"\";s:28:\"PAYMENTREQUEST_0_HANDLINGAMT\";s:0:\"\";s:23:\"PAYMENTREQUEST_0_TAXAMT\";s:4:\"0.00\";s:21:\"PAYMENTREQUEST_0_DESC\";s:0:\"\";s:23:\"PAYMENTREQUEST_0_CUSTOM\";s:0:\"\";s:23:\"PAYMENTREQUEST_0_INVNUM\";s:18:\"20110102-0648-1001\";s:26:\"PAYMENTREQUEST_0_NOTIFYURL\";s:0:\"\";s:27:\"PAYMENTREQUEST_0_SHIPTONAME\";s:3:\"asd\";s:29:\"PAYMENTREQUEST_0_SHIPTOSTREET\";s:3:\"asd\";s:30:\"PAYMENTREQUEST_0_SHIPTOSTREET2\";s:0:\"\";s:27:\"PAYMENTREQUEST_0_SHIPTOCITY\";s:3:\"asd\";s:28:\"PAYMENTREQUEST_0_SHIPTOSTATE\";s:3:\"asd\";s:26:\"PAYMENTREQUEST_0_SHIPTOZIP\";s:3:\"asd\";s:34:\"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE\";s:2:\"SG\";s:31:\"PAYMENTREQUEST_0_SHIPTOPHONENUM\";s:0:\"\";s:25:\"PAYMENTREQUEST_0_NOTETEXT\";s:0:\"\";s:37:\"PAYMENTREQUEST_0_ALLOWEDPAYMENTMETHOD\";s:0:\"\";s:30:\"PAYMENTREQUEST_0_PAYMENTACTION\";s:4:\"Sale\";s:33:\"PAYMENTREQUEST_0_PAYMENTREQUESTID\";s:0:\"\";s:38:\"PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID\";s:0:\"\";s:24:\"L_PAYMENTREQUEST_0_NAME0\";s:7:\"product\";s:24:\"L_PAYMENTREQUEST_0_DESC0\";s:0:\"\";s:23:\"L_PAYMENTREQUEST_0_AMT0\";s:5:\"10.00\";s:26:\"L_PAYMENTREQUEST_0_NUMBER0\";s:1:\"3\";s:23:\"L_PAYMENTREQUEST_0_QTY0\";s:1:\"2\";s:26:\"L_PAYMENTREQUEST_0_TAXAMT0\";s:0:\"\";s:27:\"L_PAYMENTREQUEST_0_ITEMURL0\";s:47:\"http://shop001.ombi60.localhost/products/view/3\";s:35:\"L_PAYMENTREQUEST_0_ITEMWEIGHTVALUE0\";s:7:\"10.0000\";s:34:\"L_PAYMENTREQUEST_0_ITEMWEIGHTUNIT0\";s:2:\"kg\";s:35:\"L_PAYMENTREQUEST_0_ITEMHEIGHTVALUE0\";s:0:\"\";s:34:\"L_PAYMENTREQUEST_0_ITEMHEIGHTUNIT0\";s:0:\"\";s:34:\"L_PAYMENTREQUEST_0_ITEMWIDTHVALUE0\";s:0:\"\";s:33:\"L_PAYMENTREQUEST_0_ITEMWIDTHUNIT0\";s:0:\"\";s:35:\"L_PAYMENTREQUEST_0_ITEMLENGTHVALUE0\";s:0:\"\";s:34:\"L_PAYMENTREQUEST_0_ITEMLENGTHUNIT0\";s:0:\"\";s:34:\"L_PAYMENTREQUEST_0_EBAYITEMNUMBER0\";s:0:\"\";s:40:\"L_PAYMENTREQUEST_0_EBAYITEMAUCTIONTXNID0\";s:0:\"\";s:35:\"L_PAYMENTREQUEST_0_EBAYITEMORDERID0\";s:0:\"\";s:34:\"L_PAYMENTREQUEST_0_EBAYITEMCARTID0\";s:0:\"\";}s:10:\"RAWREQUEST\";s:1952:\"USER=merch_1277746388_biz_api1.gmail.com&PWD=1277746393&VERSION=63.0&BUTTONSOURCE=OMBI60_3RD_PARTY_FOR_SHOP&SUBJECT=owner@shop001.com&SIGNATURE=AHExNCgTOAf6I0jS8V77WYVPl78nAUalMl21CFNLpKr4giwMI6dr5DKE&METHOD=DoExpressCheckoutPayment&TOKEN=EC-7ET33190P4081551S&PAYERID=L3LUD63MGMMP4&RETURNFMFDETAILS=1&GIFTMESSAGE=&GIFTRECEIPTENABLE=&GIFTWRAPNAME=&GIFTWRAPAMOUNT=&BUYERMARKETINGEMAIL=&SURVEYQUESTION=&SURVEYCHOICESELECTED=&ALLOWEDPAYMENTMETHOD=&BUTTONSOURCE=&PAYMENTREQUEST_0_AMT=30&PAYMENTREQUEST_0_CURRENCYCODE=SGD&PAYMENTREQUEST_0_ITEMAMT=20.00&PAYMENTREQUEST_0_SHIPPINGAMT=10.00&PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED=&PAYMENTREQUEST_0_HANDLINGAMT=&PAYMENTREQUEST_0_TAXAMT=0.00&PAYMENTREQUEST_0_DESC=&PAYMENTREQUEST_0_CUSTOM=&PAYMENTREQUEST_0_INVNUM=20110102-0648-1001&PAYMENTREQUEST_0_NOTIFYURL=&PAYMENTREQUEST_0_SHIPTONAME=asd&PAYMENTREQUEST_0_SHIPTOSTREET=asd&PAYMENTREQUEST_0_SHIPTOSTREET2=&PAYMENTREQUEST_0_SHIPTOCITY=asd&PAYMENTREQUEST_0_SHIPTOSTATE=asd&PAYMENTREQUEST_0_SHIPTOZIP=asd&PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE=SG&PAYMENTREQUEST_0_SHIPTOPHONENUM=&PAYMENTREQUEST_0_NOTETEXT=&PAYMENTREQUEST_0_ALLOWEDPAYMENTMETHOD=&PAYMENTREQUEST_0_PAYMENTACTION=Sale&PAYMENTREQUEST_0_PAYMENTREQUESTID=&PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID=&L_PAYMENTREQUEST_0_NAME0=product&L_PAYMENTREQUEST_0_DESC0=&L_PAYMENTREQUEST_0_AMT0=10.00&L_PAYMENTREQUEST_0_NUMBER0=3&L_PAYMENTREQUEST_0_QTY0=2&L_PAYMENTREQUEST_0_TAXAMT0=&L_PAYMENTREQUEST_0_ITEMURL0=http%3A%2F%2Fshop001.ombi60.localhost%2Fproducts%2Fview%2F3&L_PAYMENTREQUEST_0_ITEMWEIGHTVALUE0=10.0000&L_PAYMENTREQUEST_0_ITEMWEIGHTUNIT0=kg&L_PAYMENTREQUEST_0_ITEMHEIGHTVALUE0=&L_PAYMENTREQUEST_0_ITEMHEIGHTUNIT0=&L_PAYMENTREQUEST_0_ITEMWIDTHVALUE0=&L_PAYMENTREQUEST_0_ITEMWIDTHUNIT0=&L_PAYMENTREQUEST_0_ITEMLENGTHVALUE0=&L_PAYMENTREQUEST_0_ITEMLENGTHUNIT0=&L_PAYMENTREQUEST_0_EBAYITEMNUMBER0=&L_PAYMENTREQUEST_0_EBAYITEMAUCTIONTXNID0=&L_PAYMENTREQUEST_0_EBAYITEMORDERID0=&L_PAYMENTREQUEST_0_EBAYITEMCARTID0=\";s:11:\"RAWRESPONSE\";s:712:\"TOKEN=EC%2d7ET33190P4081551S&SUCCESSPAGEREDIRECTREQUESTED=false&TIMESTAMP=2011%2d01%2d02T06%3a48%3a05Z&CORRELATIONID=3063d2aa51b7d&ACK=Success&VERSION=63%2e0&BUILD=1613703&INSURANCEOPTIONSELECTED=false&SHIPPINGOPTIONISDEFAULT=false&PAYMENTINFO_0_TRANSACTIONID=5991034928295014U&PAYMENTINFO_0_TRANSACTIONTYPE=cart&PAYMENTINFO_0_PAYMENTTYPE=instant&PAYMENTINFO_0_ORDERTIME=2011%2d01%2d02T06%3a48%3a04Z&PAYMENTINFO_0_AMT=30%2e00&PAYMENTINFO_0_FEEAMT=1%2e52&PAYMENTINFO_0_TAXAMT=0%2e00&PAYMENTINFO_0_CURRENCYCODE=SGD&PAYMENTINFO_0_PAYMENTSTATUS=Completed&PAYMENTINFO_0_PENDINGREASON=None&PAYMENTINFO_0_REASONCODE=None&PAYMENTINFO_0_PROTECTIONELIGIBILITY=Ineligible&PAYMENTINFO_0_ERRORCODE=0&PAYMENTINFO_0_ACK=Success\";}s:20:\"checkoutRedirectPass\";b:0;s:11:\"confirmPage\";a:7:{s:13:\"PayPalRequest\";b:0;s:4:\"hash\";s:40:\"6ce0a227c4fa648388ac1aca9d552b2575585367\";s:6:\"amount\";s:7:\"20.0000\";s:14:\"shipped_amount\";s:7:\"20.0000\";s:14:\"shipped_weight\";s:7:\"20.0000\";s:17:\"shipping_required\";b:1;s:15:\"paypal_payer_id\";s:0:\"\";}}}',1294013762),('e48o2qf7fmalj5rnp455mil9b6','Config|a:4:{s:9:\"userAgent\";s:32:\"99d2786d2e6cfa4c8cace72a8f09e3f5\";s:4:\"time\";i:1294042656;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:2:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:7:\"shop001\";s:11:\"web_address\";s:31:\"http://shop001.ombi60.localhost\";s:7:\"created\";s:19:\"2011-01-02 22:14:57\";s:8:\"modified\";s:19:\"2011-01-02 22:14:57\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"1\";s:11:\"deny_access\";s:1:\"0\";}s:6:\"Domain\";a:6:{s:6:\"domain\";s:31:\"http://shop001.ombi60.localhost\";s:2:\"id\";s:1:\"2\";s:7:\"shop_id\";s:1:\"2\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";s:16:\"shop_web_address\";s:1:\"1\";}}_Token|s:211:\"a:5:{s:3:\"key\";s:40:\"ed429566abc84a67f04fa5618e123e7f2b1eb7d9\";s:7:\"expires\";i:1294024657;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:1:{i:0;s:20:\"Order.fixed_delivery\";}}\";Message|a:1:{s:5:\"flash\";a:3:{s:7:\"message\";s:21:\"Product added to cart\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:1:{s:5:\"class\";s:13:\"flash_failure\";}}}Auth|a:4:{s:4:\"User\";a:10:{s:2:\"id\";s:1:\"1\";s:5:\"email\";s:17:\"owner@shop001.com\";s:8:\"group_id\";s:1:\"3\";s:9:\"full_name\";s:7:\"shop001\";s:12:\"name_to_call\";s:7:\"shop001\";s:13:\"last_login_on\";N;s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2011-01-02 22:14:57\";s:8:\"modified\";s:19:\"2011-01-02 22:14:57\";s:11:\"language_id\";s:1:\"1\";}s:8:\"Merchant\";a:4:{s:2:\"id\";s:1:\"1\";s:5:\"owner\";s:1:\"1\";s:7:\"shop_id\";s:1:\"2\";s:7:\"user_id\";s:1:\"1\";}s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:7:\"shop001\";s:11:\"web_address\";s:31:\"http://shop001.ombi60.localhost\";s:7:\"created\";s:19:\"2011-01-02 22:14:57\";s:8:\"modified\";s:19:\"2011-01-02 22:14:57\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"1\";s:11:\"deny_access\";s:1:\"0\";}s:8:\"Language\";a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:7:\"English\";s:11:\"locale_name\";s:3:\"eng\";}}Filter|a:1:{s:8:\"products\";a:1:{s:11:\"admin_index\";s:20:\"/Filter.parsed:true/\";}}Shop|a:1:{i:2;a:6:{s:8:\"Payments\";a:1:{i:0;a:25:{s:3:\"amt\";d:30;s:12:\"currencycode\";s:3:\"SGD\";s:7:\"itemamt\";s:5:\"20.00\";s:11:\"shippingamt\";s:5:\"10.00\";s:22:\"insuranceoptionoffered\";s:0:\"\";s:11:\"handlingamt\";s:0:\"\";s:6:\"taxamt\";s:4:\"0.00\";s:4:\"desc\";s:0:\"\";s:6:\"custom\";s:0:\"\";s:6:\"invnum\";s:4:\"1011\";s:9:\"notifyurl\";s:0:\"\";s:10:\"shiptoname\";s:3:\"asd\";s:12:\"shiptostreet\";s:3:\"asd\";s:13:\"shiptostreet2\";s:0:\"\";s:10:\"shiptocity\";s:3:\"asd\";s:11:\"shiptostate\";s:3:\"asd\";s:9:\"shiptozip\";s:3:\"asd\";s:17:\"shiptocountrycode\";s:2:\"SG\";s:14:\"shiptophonenum\";s:0:\"\";s:8:\"notetext\";s:0:\"\";s:20:\"allowedpaymentmethod\";s:0:\"\";s:13:\"paymentaction\";s:4:\"Sale\";s:16:\"paymentrequestid\";s:0:\"\";s:21:\"sellerpaypalaccountid\";s:0:\"\";s:11:\"order_items\";a:1:{i:0;a:19:{s:4:\"name\";s:1:\"A\";s:4:\"desc\";s:0:\"\";s:3:\"amt\";s:5:\"10.00\";s:6:\"number\";s:1:\"3\";s:3:\"qty\";s:1:\"2\";s:6:\"taxamt\";s:0:\"\";s:7:\"itemurl\";s:47:\"http://shop001.ombi60.localhost/products/view/3\";s:15:\"itemweightvalue\";s:7:\"10.0000\";s:14:\"itemweightunit\";s:2:\"kg\";s:15:\"itemheightvalue\";s:0:\"\";s:14:\"itemheightunit\";s:0:\"\";s:14:\"itemwidthvalue\";s:0:\"\";s:13:\"itemwidthunit\";s:0:\"\";s:15:\"itemlengthvalue\";s:0:\"\";s:14:\"itemlengthunit\";s:0:\"\";s:14:\"ebayitemnumber\";s:0:\"\";s:20:\"ebayitemauctiontxnid\";s:0:\"\";s:15:\"ebayitemorderid\";s:0:\"\";s:14:\"ebayitemcartid\";s:0:\"\";}}}}s:13:\"paymentAmount\";s:5:\"20.00\";s:12:\"PayPalResult\";a:28:{s:5:\"TOKEN\";s:20:\"EC-2KY1167672270801T\";s:28:\"SUCCESSPAGEREDIRECTREQUESTED\";s:5:\"false\";s:9:\"TIMESTAMP\";s:20:\"2011-01-02T22:17:46Z\";s:13:\"CORRELATIONID\";s:12:\"59bed2495607\";s:3:\"ACK\";s:7:\"Success\";s:7:\"VERSION\";s:4:\"63.0\";s:5:\"BUILD\";s:7:\"1613703\";s:23:\"INSURANCEOPTIONSELECTED\";s:5:\"false\";s:23:\"SHIPPINGOPTIONISDEFAULT\";s:5:\"false\";s:27:\"PAYMENTINFO_0_TRANSACTIONID\";s:17:\"20A571849Y093030T\";s:29:\"PAYMENTINFO_0_TRANSACTIONTYPE\";s:4:\"cart\";s:25:\"PAYMENTINFO_0_PAYMENTTYPE\";s:7:\"instant\";s:23:\"PAYMENTINFO_0_ORDERTIME\";s:20:\"2011-01-02T22:17:44Z\";s:17:\"PAYMENTINFO_0_AMT\";s:5:\"30.00\";s:20:\"PAYMENTINFO_0_FEEAMT\";s:4:\"1.52\";s:20:\"PAYMENTINFO_0_TAXAMT\";s:4:\"0.00\";s:26:\"PAYMENTINFO_0_CURRENCYCODE\";s:3:\"SGD\";s:27:\"PAYMENTINFO_0_PAYMENTSTATUS\";s:9:\"Completed\";s:27:\"PAYMENTINFO_0_PENDINGREASON\";s:4:\"None\";s:24:\"PAYMENTINFO_0_REASONCODE\";s:4:\"None\";s:35:\"PAYMENTINFO_0_PROTECTIONELIGIBILITY\";s:10:\"Ineligible\";s:23:\"PAYMENTINFO_0_ERRORCODE\";s:1:\"0\";s:17:\"PAYMENTINFO_0_ACK\";s:7:\"Success\";s:6:\"ERRORS\";a:0:{}s:8:\"PAYMENTS\";a:1:{i:0;a:17:{s:13:\"TRANSACTIONID\";s:17:\"20A571849Y093030T\";s:15:\"TRANSACTIONTYPE\";s:4:\"cart\";s:11:\"PAYMENTTYPE\";s:7:\"instant\";s:9:\"ORDERTIME\";s:20:\"2011-01-02T22:17:44Z\";s:3:\"AMT\";s:5:\"30.00\";s:6:\"FEEAMT\";s:4:\"1.52\";s:9:\"SETTLEAMT\";s:0:\"\";s:6:\"TAXAMT\";s:4:\"0.00\";s:12:\"EXCHANGERATE\";s:0:\"\";s:12:\"CURRENCYCODE\";s:3:\"SGD\";s:13:\"PAYMENTSTATUS\";s:9:\"Completed\";s:13:\"PENDINGREASON\";s:4:\"None\";s:10:\"REASONCODE\";s:4:\"None\";s:21:\"PROTECTIONELIGIBILITY\";s:10:\"Ineligible\";s:9:\"ERRORCODE\";s:1:\"0\";s:9:\"FMFILTERS\";a:0:{}s:6:\"ERRORS\";a:0:{}}}s:11:\"REQUESTDATA\";a:61:{s:4:\"USER\";s:35:\"merch_1277746388_biz_api1.gmail.com\";s:3:\"PWD\";s:10:\"1277746393\";s:7:\"VERSION\";s:4:\"63.0\";s:12:\"BUTTONSOURCE\";s:0:\"\";s:7:\"SUBJECT\";s:17:\"owner@shop001.com\";s:9:\"SIGNATURE\";s:56:\"AHExNCgTOAf6I0jS8V77WYVPl78nAUalMl21CFNLpKr4giwMI6dr5DKE\";s:6:\"METHOD\";s:24:\"DoExpressCheckoutPayment\";s:5:\"TOKEN\";s:20:\"EC-2KY1167672270801T\";s:7:\"PAYERID\";s:13:\"L3LUD63MGMMP4\";s:16:\"RETURNFMFDETAILS\";s:1:\"1\";s:11:\"GIFTMESSAGE\";s:0:\"\";s:17:\"GIFTRECEIPTENABLE\";s:0:\"\";s:12:\"GIFTWRAPNAME\";s:0:\"\";s:14:\"GIFTWRAPAMOUNT\";s:0:\"\";s:19:\"BUYERMARKETINGEMAIL\";s:0:\"\";s:14:\"SURVEYQUESTION\";s:0:\"\";s:20:\"SURVEYCHOICESELECTED\";s:0:\"\";s:20:\"ALLOWEDPAYMENTMETHOD\";s:0:\"\";s:20:\"PAYMENTREQUEST_0_AMT\";s:2:\"30\";s:29:\"PAYMENTREQUEST_0_CURRENCYCODE\";s:3:\"SGD\";s:24:\"PAYMENTREQUEST_0_ITEMAMT\";s:5:\"20.00\";s:28:\"PAYMENTREQUEST_0_SHIPPINGAMT\";s:5:\"10.00\";s:39:\"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED\";s:0:\"\";s:28:\"PAYMENTREQUEST_0_HANDLINGAMT\";s:0:\"\";s:23:\"PAYMENTREQUEST_0_TAXAMT\";s:4:\"0.00\";s:21:\"PAYMENTREQUEST_0_DESC\";s:0:\"\";s:23:\"PAYMENTREQUEST_0_CUSTOM\";s:0:\"\";s:23:\"PAYMENTREQUEST_0_INVNUM\";s:18:\"20110102-2217-1011\";s:26:\"PAYMENTREQUEST_0_NOTIFYURL\";s:0:\"\";s:27:\"PAYMENTREQUEST_0_SHIPTONAME\";s:3:\"asd\";s:29:\"PAYMENTREQUEST_0_SHIPTOSTREET\";s:3:\"asd\";s:30:\"PAYMENTREQUEST_0_SHIPTOSTREET2\";s:0:\"\";s:27:\"PAYMENTREQUEST_0_SHIPTOCITY\";s:3:\"asd\";s:28:\"PAYMENTREQUEST_0_SHIPTOSTATE\";s:3:\"asd\";s:26:\"PAYMENTREQUEST_0_SHIPTOZIP\";s:3:\"asd\";s:34:\"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE\";s:2:\"SG\";s:31:\"PAYMENTREQUEST_0_SHIPTOPHONENUM\";s:0:\"\";s:25:\"PAYMENTREQUEST_0_NOTETEXT\";s:0:\"\";s:37:\"PAYMENTREQUEST_0_ALLOWEDPAYMENTMETHOD\";s:0:\"\";s:30:\"PAYMENTREQUEST_0_PAYMENTACTION\";s:4:\"Sale\";s:33:\"PAYMENTREQUEST_0_PAYMENTREQUESTID\";s:0:\"\";s:38:\"PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID\";s:0:\"\";s:24:\"L_PAYMENTREQUEST_0_NAME0\";s:1:\"A\";s:24:\"L_PAYMENTREQUEST_0_DESC0\";s:0:\"\";s:23:\"L_PAYMENTREQUEST_0_AMT0\";s:5:\"10.00\";s:26:\"L_PAYMENTREQUEST_0_NUMBER0\";s:1:\"3\";s:23:\"L_PAYMENTREQUEST_0_QTY0\";s:1:\"2\";s:26:\"L_PAYMENTREQUEST_0_TAXAMT0\";s:0:\"\";s:27:\"L_PAYMENTREQUEST_0_ITEMURL0\";s:47:\"http://shop001.ombi60.localhost/products/view/3\";s:35:\"L_PAYMENTREQUEST_0_ITEMWEIGHTVALUE0\";s:7:\"10.0000\";s:34:\"L_PAYMENTREQUEST_0_ITEMWEIGHTUNIT0\";s:2:\"kg\";s:35:\"L_PAYMENTREQUEST_0_ITEMHEIGHTVALUE0\";s:0:\"\";s:34:\"L_PAYMENTREQUEST_0_ITEMHEIGHTUNIT0\";s:0:\"\";s:34:\"L_PAYMENTREQUEST_0_ITEMWIDTHVALUE0\";s:0:\"\";s:33:\"L_PAYMENTREQUEST_0_ITEMWIDTHUNIT0\";s:0:\"\";s:35:\"L_PAYMENTREQUEST_0_ITEMLENGTHVALUE0\";s:0:\"\";s:34:\"L_PAYMENTREQUEST_0_ITEMLENGTHUNIT0\";s:0:\"\";s:34:\"L_PAYMENTREQUEST_0_EBAYITEMNUMBER0\";s:0:\"\";s:40:\"L_PAYMENTREQUEST_0_EBAYITEMAUCTIONTXNID0\";s:0:\"\";s:35:\"L_PAYMENTREQUEST_0_EBAYITEMORDERID0\";s:0:\"\";s:34:\"L_PAYMENTREQUEST_0_EBAYITEMCARTID0\";s:0:\"\";}s:10:\"RAWREQUEST\";s:1946:\"USER=merch_1277746388_biz_api1.gmail.com&PWD=1277746393&VERSION=63.0&BUTTONSOURCE=OMBI60_3RD_PARTY_FOR_SHOP&SUBJECT=owner@shop001.com&SIGNATURE=AHExNCgTOAf6I0jS8V77WYVPl78nAUalMl21CFNLpKr4giwMI6dr5DKE&METHOD=DoExpressCheckoutPayment&TOKEN=EC-2KY1167672270801T&PAYERID=L3LUD63MGMMP4&RETURNFMFDETAILS=1&GIFTMESSAGE=&GIFTRECEIPTENABLE=&GIFTWRAPNAME=&GIFTWRAPAMOUNT=&BUYERMARKETINGEMAIL=&SURVEYQUESTION=&SURVEYCHOICESELECTED=&ALLOWEDPAYMENTMETHOD=&BUTTONSOURCE=&PAYMENTREQUEST_0_AMT=30&PAYMENTREQUEST_0_CURRENCYCODE=SGD&PAYMENTREQUEST_0_ITEMAMT=20.00&PAYMENTREQUEST_0_SHIPPINGAMT=10.00&PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED=&PAYMENTREQUEST_0_HANDLINGAMT=&PAYMENTREQUEST_0_TAXAMT=0.00&PAYMENTREQUEST_0_DESC=&PAYMENTREQUEST_0_CUSTOM=&PAYMENTREQUEST_0_INVNUM=20110102-2217-1011&PAYMENTREQUEST_0_NOTIFYURL=&PAYMENTREQUEST_0_SHIPTONAME=asd&PAYMENTREQUEST_0_SHIPTOSTREET=asd&PAYMENTREQUEST_0_SHIPTOSTREET2=&PAYMENTREQUEST_0_SHIPTOCITY=asd&PAYMENTREQUEST_0_SHIPTOSTATE=asd&PAYMENTREQUEST_0_SHIPTOZIP=asd&PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE=SG&PAYMENTREQUEST_0_SHIPTOPHONENUM=&PAYMENTREQUEST_0_NOTETEXT=&PAYMENTREQUEST_0_ALLOWEDPAYMENTMETHOD=&PAYMENTREQUEST_0_PAYMENTACTION=Sale&PAYMENTREQUEST_0_PAYMENTREQUESTID=&PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID=&L_PAYMENTREQUEST_0_NAME0=A&L_PAYMENTREQUEST_0_DESC0=&L_PAYMENTREQUEST_0_AMT0=10.00&L_PAYMENTREQUEST_0_NUMBER0=3&L_PAYMENTREQUEST_0_QTY0=2&L_PAYMENTREQUEST_0_TAXAMT0=&L_PAYMENTREQUEST_0_ITEMURL0=http%3A%2F%2Fshop001.ombi60.localhost%2Fproducts%2Fview%2F3&L_PAYMENTREQUEST_0_ITEMWEIGHTVALUE0=10.0000&L_PAYMENTREQUEST_0_ITEMWEIGHTUNIT0=kg&L_PAYMENTREQUEST_0_ITEMHEIGHTVALUE0=&L_PAYMENTREQUEST_0_ITEMHEIGHTUNIT0=&L_PAYMENTREQUEST_0_ITEMWIDTHVALUE0=&L_PAYMENTREQUEST_0_ITEMWIDTHUNIT0=&L_PAYMENTREQUEST_0_ITEMLENGTHVALUE0=&L_PAYMENTREQUEST_0_ITEMLENGTHUNIT0=&L_PAYMENTREQUEST_0_EBAYITEMNUMBER0=&L_PAYMENTREQUEST_0_EBAYITEMAUCTIONTXNID0=&L_PAYMENTREQUEST_0_EBAYITEMORDERID0=&L_PAYMENTREQUEST_0_EBAYITEMCARTID0=\";s:11:\"RAWRESPONSE\";s:711:\"TOKEN=EC%2d2KY1167672270801T&SUCCESSPAGEREDIRECTREQUESTED=false&TIMESTAMP=2011%2d01%2d02T22%3a17%3a46Z&CORRELATIONID=59bed2495607&ACK=Success&VERSION=63%2e0&BUILD=1613703&INSURANCEOPTIONSELECTED=false&SHIPPINGOPTIONISDEFAULT=false&PAYMENTINFO_0_TRANSACTIONID=20A571849Y093030T&PAYMENTINFO_0_TRANSACTIONTYPE=cart&PAYMENTINFO_0_PAYMENTTYPE=instant&PAYMENTINFO_0_ORDERTIME=2011%2d01%2d02T22%3a17%3a44Z&PAYMENTINFO_0_AMT=30%2e00&PAYMENTINFO_0_FEEAMT=1%2e52&PAYMENTINFO_0_TAXAMT=0%2e00&PAYMENTINFO_0_CURRENCYCODE=SGD&PAYMENTINFO_0_PAYMENTSTATUS=Completed&PAYMENTINFO_0_PENDINGREASON=None&PAYMENTINFO_0_REASONCODE=None&PAYMENTINFO_0_PROTECTIONELIGIBILITY=Ineligible&PAYMENTINFO_0_ERRORCODE=0&PAYMENTINFO_0_ACK=Success\";}s:20:\"checkoutRedirectPass\";b:0;s:11:\"confirmPage\";a:7:{s:13:\"PayPalRequest\";b:0;s:4:\"hash\";s:40:\"7afd22603061c0656b9d2a1d77d63254ce55e0b3\";s:6:\"amount\";s:7:\"20.0000\";s:14:\"shipped_amount\";s:7:\"20.0000\";s:14:\"shipped_weight\";s:7:\"20.0000\";s:17:\"shipping_required\";b:1;s:15:\"paypal_payer_id\";s:0:\"\";}s:8:\"PaypalEC\";a:1:{s:5:\"Order\";a:0:{}}}}',1294042667);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cancellations` */

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `cart_items` */

insert  into `cart_items`(`id`,`cart_id`,`product_id`,`product_price`,`product_quantity`,`status`,`product_title`,`product_weight`,`currency`,`weight_unit`,`shipping_required`,`previous_price`,`previous_currency`) values (1,1,3,'10.0000',2,1,'A','10.0000','SGD','kg',1,'10.0000','SGD'),(2,2,3,'10.0000',2,1,'A','10.0000','SGD','kg',1,'10.0000','SGD'),(3,3,3,'10.0000',2,1,'A','10.0000','SGD','kg',1,'10.0000','SGD'),(4,4,3,'10.0000',2,1,'A','10.0000','SGD','kg',1,'10.0000','SGD'),(5,5,3,'10.0000',2,1,'A','10.0000','SGD','kg',1,'10.0000','SGD'),(6,6,3,'10.0000',2,1,'A','10.0000','SGD','kg',1,'10.0000','SGD'),(7,7,3,'10.0000',2,1,'A','10.0000','SGD','kg',1,'10.0000','SGD'),(8,8,3,'10.0000',2,1,'A','10.0000','SGD','kg',1,'10.0000','SGD'),(9,9,3,'10.0000',2,1,'A','10.0000','SGD','kg',1,'10.0000','SGD'),(10,10,3,'10.0000',2,1,'A','10.0000','SGD','kg',1,'10.0000','SGD'),(11,11,3,'10.0000',2,1,'A','10.0000','SGD','kg',1,'10.0000','SGD');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `carts` */

insert  into `carts`(`id`,`shop_id`,`user_id`,`created`,`amount`,`status`,`hash`,`total_weight`,`currency`,`weight_unit`,`shipped_amount`,`shipped_weight`,`past_checkout_point`) values (1,2,3,'2011-01-02 14:18:31','20.0000',1,'ba7409b8d5ce4135ab2aca018eb4f7f975385d5d','20.0000','SGD','kg','20.0000','20.0000',1),(2,2,3,'2011-01-02 14:31:01','20.0000',1,'208cd5cf7ea1d992292a27d6152353700fd35b04','20.0000','SGD','kg','20.0000','20.0000',1),(3,2,3,'2011-01-02 14:41:18','20.0000',1,'58fc2c34bec1347c587d6a733ed4b9b80789a299','20.0000','SGD','kg','20.0000','20.0000',1),(4,2,3,'2011-01-02 14:45:44','20.0000',1,'db448aa8dc1c5fce456c693b9ad4b45cc4931bb1','20.0000','SGD','kg','20.0000','20.0000',1),(5,2,3,'2011-01-02 14:54:31','20.0000',1,'4ad7f5fe67aea34b945c2f6ec2928733b5b3eb96','20.0000','SGD','kg','20.0000','20.0000',1),(6,2,3,'2011-01-02 15:01:41','20.0000',1,'93c7374d2dfb1d3b254c39ea2699db2a563d03f9','20.0000','SGD','kg','20.0000','20.0000',1),(7,2,3,'2011-01-02 15:44:05','20.0000',1,'f7af2460552a5dcb3b20fa1a77ecc9ee86247214','20.0000','SGD','kg','20.0000','20.0000',1),(8,2,3,'2011-01-02 15:46:19','20.0000',1,'7a0dde9384d033a6e2e3a6d32622ac9074da9898','20.0000','SGD','kg','20.0000','20.0000',1),(9,2,3,'2011-01-02 22:04:23','20.0000',1,'d15e7b982a9a9cff50fc1a7cd34020a8c62d6efa','20.0000','SGD','kg','20.0000','20.0000',1),(10,2,3,'2011-01-02 22:14:50','20.0000',1,'7a3028884fd557f295539d091c9bcf09f1ea0df4','20.0000','SGD','kg','20.0000','20.0000',1),(11,2,3,'2011-01-02 22:16:46','20.0000',1,'e2ca4abee96f2aa9dbaae47bd199a7b93c44d6a3','20.0000','SGD','kg','20.0000','20.0000',1);

/*Table structure for table `casual_surfers` */

DROP TABLE IF EXISTS `casual_surfers`;

CREATE TABLE `casual_surfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop` (`shop_id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `casual_surfers` */

insert  into `casual_surfers`(`id`,`shop_id`,`user_id`) values (1,3,2),(2,2,3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8;

/*Data for the table `countries` */

insert  into `countries`(`id`,`iso`,`name`,`printable_name`,`iso3`,`numcode`) values (1,'AF','AFGHANISTAN','Afghanistan','AFG',4),(2,'AL','ALBANIA','Albania','ALB',8),(3,'DZ','ALGERIA','Algeria','DZA',12),(4,'AS','AMERICAN SAMOA','American Samoa','ASM',16),(5,'AD','ANDORRA','Andorra','AND',20),(6,'AO','ANGOLA','Angola','AGO',24),(7,'AI','ANGUILLA','Anguilla','AIA',660),(8,'AQ','ANTARCTICA','Antarctica',NULL,NULL),(9,'AG','ANTIGUA AND BARBUDA','Antigua and Barbuda','ATG',28),(10,'AR','ARGENTINA','Argentina','ARG',32),(11,'AM','ARMENIA','Armenia','ARM',51),(12,'AW','ARUBA','Aruba','ABW',533),(13,'AU','AUSTRALIA','Australia','AUS',36),(14,'AT','AUSTRIA','Austria','AUT',40),(15,'AZ','AZERBAIJAN','Azerbaijan','AZE',31),(16,'BS','BAHAMAS','Bahamas','BHS',44),(17,'BH','BAHRAIN','Bahrain','BHR',48),(18,'BD','BANGLADESH','Bangladesh','BGD',50),(19,'BB','BARBADOS','Barbados','BRB',52),(20,'BY','BELARUS','Belarus','BLR',112),(21,'BE','BELGIUM','Belgium','BEL',56),(22,'BZ','BELIZE','Belize','BLZ',84),(23,'BJ','BENIN','Benin','BEN',204),(24,'BM','BERMUDA','Bermuda','BMU',60),(25,'BT','BHUTAN','Bhutan','BTN',64),(26,'BO','BOLIVIA','Bolivia','BOL',68),(27,'BA','BOSNIA AND HERZEGOVINA','Bosnia and Herzegovina','BIH',70),(28,'BW','BOTSWANA','Botswana','BWA',72),(29,'BV','BOUVET ISLAND','Bouvet Island',NULL,NULL),(30,'BR','BRAZIL','Brazil','BRA',76),(31,'IO','BRITISH INDIAN OCEAN TERRITORY','British Indian Ocean Territory',NULL,NULL),(32,'BN','BRUNEI DARUSSALAM','Brunei Darussalam','BRN',96),(33,'BG','BULGARIA','Bulgaria','BGR',100),(34,'BF','BURKINA FASO','Burkina Faso','BFA',854),(35,'BI','BURUNDI','Burundi','BDI',108),(36,'KH','CAMBODIA','Cambodia','KHM',116),(37,'CM','CAMEROON','Cameroon','CMR',120),(38,'CA','CANADA','Canada','CAN',124),(39,'CV','CAPE VERDE','Cape Verde','CPV',132),(40,'KY','CAYMAN ISLANDS','Cayman Islands','CYM',136),(41,'CF','CENTRAL AFRICAN REPUBLIC','Central African Republic','CAF',140),(42,'TD','CHAD','Chad','TCD',148),(43,'CL','CHILE','Chile','CHL',152),(44,'CN','CHINA','China','CHN',156),(45,'CX','CHRISTMAS ISLAND','Christmas Island',NULL,NULL),(46,'CC','COCOS (KEELING) ISLANDS','Cocos (Keeling) Islands',NULL,NULL),(47,'CO','COLOMBIA','Colombia','COL',170),(48,'KM','COMOROS','Comoros','COM',174),(49,'CG','CONGO','Congo','COG',178),(50,'CD','CONGO, THE DEMOCRATIC REPUBLIC OF THE','Congo, the Democratic Republic of the','COD',180),(51,'CK','COOK ISLANDS','Cook Islands','COK',184),(52,'CR','COSTA RICA','Costa Rica','CRI',188),(53,'CI','COTE D\'IVOIRE','Cote D\'Ivoire','CIV',384),(54,'HR','CROATIA','Croatia','HRV',191),(55,'CU','CUBA','Cuba','CUB',192),(56,'CY','CYPRUS','Cyprus','CYP',196),(57,'CZ','CZECH REPUBLIC','Czech Republic','CZE',203),(58,'DK','DENMARK','Denmark','DNK',208),(59,'DJ','DJIBOUTI','Djibouti','DJI',262),(60,'DM','DOMINICA','Dominica','DMA',212),(61,'DO','DOMINICAN REPUBLIC','Dominican Republic','DOM',214),(62,'EC','ECUADOR','Ecuador','ECU',218),(63,'EG','EGYPT','Egypt','EGY',818),(64,'SV','EL SALVADOR','El Salvador','SLV',222),(65,'GQ','EQUATORIAL GUINEA','Equatorial Guinea','GNQ',226),(66,'ER','ERITREA','Eritrea','ERI',232),(67,'EE','ESTONIA','Estonia','EST',233),(68,'ET','ETHIOPIA','Ethiopia','ETH',231),(69,'FK','FALKLAND ISLANDS (MALVINAS)','Falkland Islands (Malvinas)','FLK',238),(70,'FO','FAROE ISLANDS','Faroe Islands','FRO',234),(71,'FJ','FIJI','Fiji','FJI',242),(72,'FI','FINLAND','Finland','FIN',246),(73,'FR','FRANCE','France','FRA',250),(74,'GF','FRENCH GUIANA','French Guiana','GUF',254),(75,'PF','FRENCH POLYNESIA','French Polynesia','PYF',258),(76,'TF','FRENCH SOUTHERN TERRITORIES','French Southern Territories',NULL,NULL),(77,'GA','GABON','Gabon','GAB',266),(78,'GM','GAMBIA','Gambia','GMB',270),(79,'GE','GEORGIA','Georgia','GEO',268),(80,'DE','GERMANY','Germany','DEU',276),(81,'GH','GHANA','Ghana','GHA',288),(82,'GI','GIBRALTAR','Gibraltar','GIB',292),(83,'GR','GREECE','Greece','GRC',300),(84,'GL','GREENLAND','Greenland','GRL',304),(85,'GD','GRENADA','Grenada','GRD',308),(86,'GP','GUADELOUPE','Guadeloupe','GLP',312),(87,'GU','GUAM','Guam','GUM',316),(88,'GT','GUATEMALA','Guatemala','GTM',320),(89,'GN','GUINEA','Guinea','GIN',324),(90,'GW','GUINEA-BISSAU','Guinea-Bissau','GNB',624),(91,'GY','GUYANA','Guyana','GUY',328),(92,'HT','HAITI','Haiti','HTI',332),(93,'HM','HEARD ISLAND AND MCDONALD ISLANDS','Heard Island and Mcdonald Islands',NULL,NULL),(94,'VA','HOLY SEE (VATICAN CITY STATE)','Holy See (Vatican City State)','VAT',336),(95,'HN','HONDURAS','Honduras','HND',340),(96,'HK','HONG KONG','Hong Kong','HKG',344),(97,'HU','HUNGARY','Hungary','HUN',348),(98,'IS','ICELAND','Iceland','ISL',352),(99,'IN','INDIA','India','IND',356),(100,'ID','INDONESIA','Indonesia','IDN',360),(101,'IR','IRAN, ISLAMIC REPUBLIC OF','Iran, Islamic Republic of','IRN',364),(102,'IQ','IRAQ','Iraq','IRQ',368),(103,'IE','IRELAND','Ireland','IRL',372),(104,'IL','ISRAEL','Israel','ISR',376),(105,'IT','ITALY','Italy','ITA',380),(106,'JM','JAMAICA','Jamaica','JAM',388),(107,'JP','JAPAN','Japan','JPN',392),(108,'JO','JORDAN','Jordan','JOR',400),(109,'KZ','KAZAKHSTAN','Kazakhstan','KAZ',398),(110,'KE','KENYA','Kenya','KEN',404),(111,'KI','KIRIBATI','Kiribati','KIR',296),(112,'KP','KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','Korea, Democratic People\'s Republic of','PRK',408),(113,'KR','KOREA, REPUBLIC OF','Korea, Republic of','KOR',410),(114,'KW','KUWAIT','Kuwait','KWT',414),(115,'KG','KYRGYZSTAN','Kyrgyzstan','KGZ',417),(116,'LA','LAO PEOPLE\'S DEMOCRATIC REPUBLIC','Lao People\'s Democratic Republic','LAO',418),(117,'LV','LATVIA','Latvia','LVA',428),(118,'LB','LEBANON','Lebanon','LBN',422),(119,'LS','LESOTHO','Lesotho','LSO',426),(120,'LR','LIBERIA','Liberia','LBR',430),(121,'LY','LIBYAN ARAB JAMAHIRIYA','Libyan Arab Jamahiriya','LBY',434),(122,'LI','LIECHTENSTEIN','Liechtenstein','LIE',438),(123,'LT','LITHUANIA','Lithuania','LTU',440),(124,'LU','LUXEMBOURG','Luxembourg','LUX',442),(125,'MO','MACAO','Macao','MAC',446),(126,'MK','MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','Macedonia, the Former Yugoslav Republic of','MKD',807),(127,'MG','MADAGASCAR','Madagascar','MDG',450),(128,'MW','MALAWI','Malawi','MWI',454),(129,'MY','MALAYSIA','Malaysia','MYS',458),(130,'MV','MALDIVES','Maldives','MDV',462),(131,'ML','MALI','Mali','MLI',466),(132,'MT','MALTA','Malta','MLT',470),(133,'MH','MARSHALL ISLANDS','Marshall Islands','MHL',584),(134,'MQ','MARTINIQUE','Martinique','MTQ',474),(135,'MR','MAURITANIA','Mauritania','MRT',478),(136,'MU','MAURITIUS','Mauritius','MUS',480),(137,'YT','MAYOTTE','Mayotte',NULL,NULL),(138,'MX','MEXICO','Mexico','MEX',484),(139,'FM','MICRONESIA, FEDERATED STATES OF','Micronesia, Federated States of','FSM',583),(140,'MD','MOLDOVA, REPUBLIC OF','Moldova, Republic of','MDA',498),(141,'MC','MONACO','Monaco','MCO',492),(142,'MN','MONGOLIA','Mongolia','MNG',496),(143,'MS','MONTSERRAT','Montserrat','MSR',500),(144,'MA','MOROCCO','Morocco','MAR',504),(145,'MZ','MOZAMBIQUE','Mozambique','MOZ',508),(146,'MM','MYANMAR','Myanmar','MMR',104),(147,'NA','NAMIBIA','Namibia','NAM',516),(148,'NR','NAURU','Nauru','NRU',520),(149,'NP','NEPAL','Nepal','NPL',524),(150,'NL','NETHERLANDS','Netherlands','NLD',528),(151,'AN','NETHERLANDS ANTILLES','Netherlands Antilles','ANT',530),(152,'NC','NEW CALEDONIA','New Caledonia','NCL',540),(153,'NZ','NEW ZEALAND','New Zealand','NZL',554),(154,'NI','NICARAGUA','Nicaragua','NIC',558),(155,'NE','NIGER','Niger','NER',562),(156,'NG','NIGERIA','Nigeria','NGA',566),(157,'NU','NIUE','Niue','NIU',570),(158,'NF','NORFOLK ISLAND','Norfolk Island','NFK',574),(159,'MP','NORTHERN MARIANA ISLANDS','Northern Mariana Islands','MNP',580),(160,'NO','NORWAY','Norway','NOR',578),(161,'OM','OMAN','Oman','OMN',512),(162,'PK','PAKISTAN','Pakistan','PAK',586),(163,'PW','PALAU','Palau','PLW',585),(164,'PS','PALESTINIAN TERRITORY, OCCUPIED','Palestinian Territory, Occupied',NULL,NULL),(165,'PA','PANAMA','Panama','PAN',591),(166,'PG','PAPUA NEW GUINEA','Papua New Guinea','PNG',598),(167,'PY','PARAGUAY','Paraguay','PRY',600),(168,'PE','PERU','Peru','PER',604),(169,'PH','PHILIPPINES','Philippines','PHL',608),(170,'PN','PITCAIRN','Pitcairn','PCN',612),(171,'PL','POLAND','Poland','POL',616),(172,'PT','PORTUGAL','Portugal','PRT',620),(173,'PR','PUERTO RICO','Puerto Rico','PRI',630),(174,'QA','QATAR','Qatar','QAT',634),(175,'RE','REUNION','Reunion','REU',638),(176,'RO','ROMANIA','Romania','ROM',642),(177,'RU','RUSSIAN FEDERATION','Russian Federation','RUS',643),(178,'RW','RWANDA','Rwanda','RWA',646),(179,'SH','SAINT HELENA','Saint Helena','SHN',654),(180,'KN','SAINT KITTS AND NEVIS','Saint Kitts and Nevis','KNA',659),(181,'LC','SAINT LUCIA','Saint Lucia','LCA',662),(182,'PM','SAINT PIERRE AND MIQUELON','Saint Pierre and Miquelon','SPM',666),(183,'VC','SAINT VINCENT AND THE GRENADINES','Saint Vincent and the Grenadines','VCT',670),(184,'WS','SAMOA','Samoa','WSM',882),(185,'SM','SAN MARINO','San Marino','SMR',674),(186,'ST','SAO TOME AND PRINCIPE','Sao Tome and Principe','STP',678),(187,'SA','SAUDI ARABIA','Saudi Arabia','SAU',682),(188,'SN','SENEGAL','Senegal','SEN',686),(189,'CS','SERBIA AND MONTENEGRO','Serbia and Montenegro',NULL,NULL),(190,'SC','SEYCHELLES','Seychelles','SYC',690),(191,'SL','SIERRA LEONE','Sierra Leone','SLE',694),(192,'SG','SINGAPORE','Singapore','SGP',702),(193,'SK','SLOVAKIA','Slovakia','SVK',703),(194,'SI','SLOVENIA','Slovenia','SVN',705),(195,'SB','SOLOMON ISLANDS','Solomon Islands','SLB',90),(196,'SO','SOMALIA','Somalia','SOM',706),(197,'ZA','SOUTH AFRICA','South Africa','ZAF',710),(198,'GS','SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','South Georgia and the South Sandwich Islands',NULL,NULL),(199,'ES','SPAIN','Spain','ESP',724),(200,'LK','SRI LANKA','Sri Lanka','LKA',144),(201,'SD','SUDAN','Sudan','SDN',736),(202,'SR','SURINAME','Suriname','SUR',740),(203,'SJ','SVALBARD AND JAN MAYEN','Svalbard and Jan Mayen','SJM',744),(204,'SZ','SWAZILAND','Swaziland','SWZ',748),(205,'SE','SWEDEN','Sweden','SWE',752),(206,'CH','SWITZERLAND','Switzerland','CHE',756),(207,'SY','SYRIAN ARAB REPUBLIC','Syrian Arab Republic','SYR',760),(208,'TW','TAIWAN, PROVINCE OF CHINA','Taiwan, Province of China','TWN',158),(209,'TJ','TAJIKISTAN','Tajikistan','TJK',762),(210,'TZ','TANZANIA, UNITED REPUBLIC OF','Tanzania, United Republic of','TZA',834),(211,'TH','THAILAND','Thailand','THA',764),(212,'TL','TIMOR-LESTE','Timor-Leste',NULL,NULL),(213,'TG','TOGO','Togo','TGO',768),(214,'TK','TOKELAU','Tokelau','TKL',772),(215,'TO','TONGA','Tonga','TON',776),(216,'TT','TRINIDAD AND TOBAGO','Trinidad and Tobago','TTO',780),(217,'TN','TUNISIA','Tunisia','TUN',788),(218,'TR','TURKEY','Turkey','TUR',792),(219,'TM','TURKMENISTAN','Turkmenistan','TKM',795),(220,'TC','TURKS AND CAICOS ISLANDS','Turks and Caicos Islands','TCA',796),(221,'TV','TUVALU','Tuvalu','TUV',798),(222,'UG','UGANDA','Uganda','UGA',800),(223,'UA','UKRAINE','Ukraine','UKR',804),(224,'AE','UNITED ARAB EMIRATES','United Arab Emirates','ARE',784),(225,'GB','UNITED KINGDOM','United Kingdom','GBR',826),(226,'US','UNITED STATES','United States','USA',840),(227,'UM','UNITED STATES MINOR OUTLYING ISLANDS','United States Minor Outlying Islands',NULL,NULL),(228,'UY','URUGUAY','Uruguay','URY',858),(229,'UZ','UZBEKISTAN','Uzbekistan','UZB',860),(230,'VU','VANUATU','Vanuatu','VUT',548),(231,'VE','VENEZUELA','Venezuela','VEN',862),(232,'VN','VIET NAM','Viet Nam','VNM',704),(233,'VG','VIRGIN ISLANDS, BRITISH','Virgin Islands, British','VGB',92),(234,'VI','VIRGIN ISLANDS, U.S.','Virgin Islands, U.s.','VIR',850),(235,'WF','WALLIS AND FUTUNA','Wallis and Futuna','WLF',876),(236,'EH','WESTERN SAHARA','Western Sahara','ESH',732),(237,'YE','YEMEN','Yemen','YEM',887),(238,'ZM','ZAMBIA','Zambia','ZMB',894),(239,'ZW','ZIMBABWE','Zimbabwe','ZWE',716);

/*Table structure for table `custom_payment_modules` */

DROP TABLE IF EXISTS `custom_payment_modules`;

CREATE TABLE `custom_payment_modules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_payment_module_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `instructions` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_spm` (`shop_payment_module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `custom_payment_modules` */

insert  into `custom_payment_modules`(`id`,`shop_payment_module_id`,`name`,`instructions`) values (1,2,'Cash On Delivery','');

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_code` varchar(255) DEFAULT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `customers` */

insert  into `customers`(`id`,`identity_code`,`shop_id`,`user_id`) values (1,NULL,3,4),(2,NULL,3,5),(3,NULL,2,4),(4,NULL,2,5);

/*Table structure for table `domains` */

DROP TABLE IF EXISTS `domains`;

CREATE TABLE `domains` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `primary` tinyint(1) NOT NULL DEFAULT '0',
  `always_redirect_here` tinyint(1) NOT NULL DEFAULT '0',
  `shop_web_address` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UniqueDomain` (`domain`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `domains` */

insert  into `domains`(`id`,`domain`,`shop_id`,`primary`,`always_redirect_here`,`shop_web_address`) values (1,'http://ombi60.localhost',1,1,0,0),(2,'http://shop001.ombi60.localhost',2,1,0,1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `gc_designs` */

/*Table structure for table `gift_card_types` */

DROP TABLE IF EXISTS `gift_card_types`;

CREATE TABLE `gift_card_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `reference` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `invoices` */

insert  into `invoices`(`id`,`created`,`title`,`shop_id`,`description`,`payment_number`,`payer_user`,`reference`) values (1,'2011-01-02 22:14:57','basic',2,'Initial signup',NULL,NULL,'2011-01-02-2214-1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `merchants` */

insert  into `merchants`(`id`,`owner`,`shop_id`,`user_id`) values (1,1,2,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `order_line_items` */

insert  into `order_line_items`(`id`,`order_id`,`product_id`,`product_price`,`product_quantity`,`status`,`product_title`,`product_weight`,`currency`,`weight_unit`,`shipping_required`) values (1,1,3,'10.0000',2,1,'A','10.0000','SGD','kg',1),(2,2,3,'10.0000',2,1,'A','10.0000','SGD','kg',1),(3,3,3,'10.0000',2,1,'A','10.0000','SGD','kg',1),(4,4,3,'10.0000',2,1,'A','10.0000','SGD','kg',1),(5,5,3,'10.0000',2,1,'A','10.0000','SGD','kg',1),(6,6,3,'10.0000',2,1,'A','10.0000','SGD','kg',1),(7,7,3,'10.0000',2,1,'A','10.0000','SGD','kg',1),(8,8,3,'10.0000',2,1,'A','10.0000','SGD','kg',1),(9,9,3,'10.0000',2,1,'A','10.0000','SGD','kg',1),(10,10,3,'10.0000',2,1,'A','10.0000','SGD','kg',1),(11,11,3,'10.0000',2,1,'A','10.0000','SGD','kg',1);

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
  `fulfillment_status` tinyint(2) DEFAULT '1',
  `shipped_weight` decimal(10,4) unsigned DEFAULT NULL,
  `shipped_amount` decimal(10,4) unsigned DEFAULT NULL,
  `weight_unit` varchar(5) NOT NULL DEFAULT 'kg',
  `currency` varchar(5) NOT NULL DEFAULT 'SGD',
  `total_weight` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `past_checkout_point` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `contact_email` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `orders` */

insert  into `orders`(`id`,`shop_id`,`customer_id`,`billing_address_id`,`delivery_address_id`,`order_no`,`created`,`amount`,`status`,`hash`,`cart_id`,`payment_status`,`fulfillment_status`,`shipped_weight`,`shipped_amount`,`weight_unit`,`currency`,`total_weight`,`past_checkout_point`,`contact_email`) values (1,2,3,6,5,'1001','2011-01-02 14:28:25','20.0000',1,'6ef4fd83788f05f7fa8f7f93dc3880fe245ce709',1,2,1,'20.0000','20.0000','kg','SGD','20.0000',1,'cust_spore@gmail.com'),(2,2,4,7,8,'1002','2011-01-02 14:31:25','20.0000',1,'53bf2ec3569e05f76e391afed172061890ea4d90',2,2,1,'20.0000','20.0000','kg','SGD','20.0000',1,'kimcity@gmail.com'),(3,2,3,9,10,'1003','2011-01-02 14:41:38','20.0000',1,'1bd936041c6b951692ff5bef42f33b3a2cbf2e71',3,2,1,'20.0000','20.0000','kg','SGD','20.0000',1,'cust_spore@gmail.com'),(4,2,3,11,12,'1004','2011-01-02 14:46:05','20.0000',1,'6c29be1614da027de13a70c3563f334f68a7196a',4,2,1,'20.0000','20.0000','kg','SGD','20.0000',1,'cust_spore@gmail.com'),(5,2,3,13,14,'1005','2011-01-02 14:54:47','20.0000',1,'d65158641856ade7b12f1e0baf24145c0f869f96',5,2,1,'20.0000','20.0000','kg','SGD','20.0000',1,'cust_spore@gmail.com'),(6,2,3,15,16,'1006','2011-01-02 15:02:11','20.0000',1,'e76d6459712970a99285e2f09166bc24f44ebaa8',6,2,1,'20.0000','20.0000','kg','SGD','20.0000',1,'cust_spore@gmail.com'),(7,2,3,17,18,'1007','2011-01-02 15:44:22','20.0000',1,'7e70f880c2fd10bde4d26ac61b509da01c9c3324',7,2,1,'20.0000','20.0000','kg','SGD','20.0000',1,'cust_spore@gmail.com'),(8,2,3,19,20,'1008','2011-01-02 15:50:13','20.0000',1,'19e906f3b65ee81923a78b54752a65b1a16954ee',8,2,1,'20.0000','20.0000','kg','SGD','20.0000',1,'cust_spore@gmail.com'),(9,2,3,6,5,'1009','2011-01-02 22:05:47','20.0000',1,'3940120d5a62271a02b3660d51de5d8e9e68e92b',9,4,1,'20.0000','20.0000','kg','SGD','20.0000',1,'cust_spore@gmail.com'),(10,2,3,6,5,'1010','2011-01-02 22:15:39','20.0000',1,'1fa6c49809778675ecd0f5c6f4e439d9ae04f901',10,2,1,'20.0000','20.0000','kg','SGD','20.0000',1,'cust_spore@gmail.com'),(11,2,3,9,10,'1011','2011-01-02 22:17:10','20.0000',1,'7afd22603061c0656b9d2a1d77d63254ce55e0b3',11,2,1,'20.0000','20.0000','kg','SGD','20.0000',1,'cust_spore@gmail.com');

/*Table structure for table `page_types` */

DROP TABLE IF EXISTS `page_types`;

CREATE TABLE `page_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `alias` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `page_types` */

/*Table structure for table `paydollar_transactions` */

DROP TABLE IF EXISTS `paydollar_transactions`;

CREATE TABLE `paydollar_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` tinyint(2) NOT NULL,
  `prc` tinyint(2) NOT NULL,
  `ord` varchar(50) NOT NULL,
  `holder` varchar(30) NOT NULL,
  `successcode` tinyint(2) NOT NULL,
  `ref` varchar(50) NOT NULL,
  `payref` varchar(50) NOT NULL,
  `amt` decimal(12,2) NOT NULL DEFAULT '0.00',
  `cur` varchar(3) DEFAULT '702',
  `mpsamt` decimal(12,2) DEFAULT '0.00',
  `mpscur` varchar(4) DEFAULT NULL,
  `mpsforeignamt` decimal(12,2) DEFAULT '0.00',
  `mpsforeigncur` varchar(4) DEFAULT NULL,
  `mpsrate` decimal(12,4) DEFAULT '0.0000',
  `remark` text,
  `authid` varchar(50) NOT NULL,
  `eci` varchar(3) NOT NULL,
  `payerauth` varchar(2) NOT NULL,
  `sourceip` varchar(20) DEFAULT '',
  `ipcountry` varchar(5) DEFAULT '',
  `paymethod` varchar(20) NOT NULL,
  `cardissuingcountry` varchar(5) DEFAULT '',
  `securehash` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `paydollar_transactions` */

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
  `gateway_name` varchar(255) NOT NULL DEFAULT '',
  `transaction_id_from_gateway` varchar(255) DEFAULT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `token_from_gateway` varchar(255) DEFAULT '''''',
  `ordertime_from_gateway` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `currencycode_from_gateway` varchar(3) DEFAULT NULL,
  `feeamt_from_gateway` decimal(9,2) DEFAULT NULL,
  `settleamt_from_gateway` decimal(10,2) DEFAULT NULL,
  `taxamt_from_gateway` decimal(9,2) DEFAULT NULL,
  `exchangerate_from_gateway` decimal(17,7) DEFAULT NULL,
  `paymentstatus_from_gateway` varchar(30) DEFAULT NULL,
  `pendingreason_from_gateway` varchar(50) DEFAULT NULL,
  `reasoncode_from_gateway` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `payments` */

insert  into `payments`(`id`,`shops_payment_module_id`,`order_id`,`gateway_name`,`transaction_id_from_gateway`,`status`,`token_from_gateway`,`ordertime_from_gateway`,`created`,`modified`,`currencycode_from_gateway`,`feeamt_from_gateway`,`settleamt_from_gateway`,`taxamt_from_gateway`,`exchangerate_from_gateway`,`paymentstatus_from_gateway`,`pendingreason_from_gateway`,`reasoncode_from_gateway`) values (1,1,1,'Paypal Express Checkout at Checkout','3T653421TA817125D',2,'\'\'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,2,'Paypal Express Checkout at Payment',NULL,2,'EC-25195565FK1107601',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,1,3,'Paypal Express Checkout at Payment',NULL,2,'EC-58X21576S0001273P',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,4,'Paypal Express Checkout at Payment',NULL,2,'EC-15411859GM4332122',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,1,5,'Paypal Express Checkout at Payment','7JG38461WY087831C',2,'EC-94U79337991348818',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,1,6,'Paypal Express Checkout at Payment','5Y763761ET158164D',2,'EC-08U65198GN178952F',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,1,7,'Paypal Express Checkout at Payment','2CL836737W428884L',2,'EC-2G5282965S149064V',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,1,8,'Paypal Express Checkout at Payment','847303257S289814N',2,'EC-56D32551KN853171U',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,1,9,'',NULL,4,'\'\'',NULL,'2011-01-02 22:07:12','2011-01-02 22:07:12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,1,10,'Paypal Express Checkout at Checkout','7JD36165LE6972446',2,'\'\'','2011-01-02T22:15:45Z','2011-01-02 22:15:46','2011-01-02 22:15:46','SGD','1.52',NULL,'0.00',NULL,'Completed','None','None'),(11,1,11,'Paypal Express Checkout at Payment','20A571849Y093030T',2,'EC-2KY1167672270801T','2011-01-02T22:17:44Z','2011-01-02 22:17:15','2011-01-02 22:17:15','SGD','1.52',NULL,'0.00',NULL,'Completed','None','None');

/*Table structure for table `paypal_payers` */

DROP TABLE IF EXISTS `paypal_payers`;

CREATE TABLE `paypal_payers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payerid` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `payerstatus` varchar(10) NOT NULL,
  `countrycode` varchar(2) NOT NULL,
  `business` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `paypal_payers` */

insert  into `paypal_payers`(`id`,`payerid`,`email`,`payerstatus`,`countrycode`,`business`) values (1,'L3LUD63MGMMP4','cust_spore@gmail.com','verified','SG','');

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

/*Table structure for table `paypal_payers_payments` */

DROP TABLE IF EXISTS `paypal_payers_payments`;

CREATE TABLE `paypal_payers_payments` (
  `id` char(36) NOT NULL,
  `paypal_payer_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `paypal_payers_payments` */

insert  into `paypal_payers_payments`(`id`,`paypal_payer_id`,`payment_id`) values ('4d208bc1-7520-48b0-baf8-04901507707a',1,1),('4d20922f-c058-4e86-a516-0e1d1507707a',1,5),('4d209447-1140-4abf-91dd-048d1507707a',1,6),('4d209d7c-86e4-45f8-bc89-0acb1507707a',1,7),('4d209eec-f208-4832-aa83-0e1d1507707a',1,8),('4d20f711-ff14-410f-9d77-0c741507707a',1,9),('4d20f912-2888-4a9a-b413-0c741507707a',1,10),('4d20f98a-87d0-4f82-9121-0c741507707a',1,11);

/*Table structure for table `paypal_payment_modules` */

DROP TABLE IF EXISTS `paypal_payment_modules`;

CREATE TABLE `paypal_payment_modules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_payment_module_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `account_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_spm` (`shop_payment_module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `paypal_payment_modules` */

insert  into `paypal_payment_modules`(`id`,`shop_payment_module_id`,`name`,`account_email`) values (1,1,'Paypal Express Checkout','owner@shop001.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `posts` */

insert  into `posts`(`id`,`blog_id`,`author_id`,`status`,`title`,`slug`,`body`,`no_comments`,`allow_comments`,`allow_pingback`,`created`,`modified`) values (1,1,1,1,'Open for business!','open-for-business','We are OPEN for business!!',0,1,1,'2011-01-02 22:14:57','2011-01-02 22:14:57');

/*Table structure for table `price_based_rates` */

DROP TABLE IF EXISTS `price_based_rates`;

CREATE TABLE `price_based_rates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `min_price` decimal(10,3) unsigned NOT NULL DEFAULT '0.000',
  `max_price` decimal(10,3) DEFAULT NULL,
  `shipping_rate_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`cover`,`created`,`modified`,`filename`,`dir`,`mimetype`,`filesize`) values (1,1,1,'2010-05-20 07:59:19','2010-05-20 07:59:19','default.jpg','uploads\\products','image/jpeg',6103),(2,2,1,'2011-01-02 22:14:58','2011-01-02 22:14:58','default-0.jpg','uploads/products','image/jpeg',6103),(3,3,1,'2011-01-02 14:18:16','2011-01-02 14:18:16','8cb42ecccafe.jpg','uploads/products','image/jpeg',25926);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `products` */

insert  into `products`(`id`,`shop_id`,`title`,`code`,`description`,`price`,`created`,`modified`,`status`,`weight`,`currency`,`weight_unit`,`shipping_required`) values (1,1,'Dummy Product',NULL,NULL,'0.0000','2010-05-20 08:00:24','2010-05-20 08:00:24',1,'7.0000','SGD','kg',1),(2,2,'Dummy Product',NULL,NULL,'0.0000','2011-01-02 22:14:57','2011-01-02 22:14:58',1,'7.0000','SGD','kg',1),(3,2,'A','ASD','asd','10.0000','2011-01-02 14:18:16','2011-01-02 14:18:18',1,'10.0000','SGD','kg',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `recurring_payment_profiles` */

insert  into `recurring_payment_profiles`(`id`,`gateway`,`method`,`shop_id`,`gateway_reference_id`,`created`,`modified`,`status`) values (1,'paydollar','AddSchPay API',2,'10633','2011-01-02 22:14:59','2011-01-02 22:14:59','active');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `saved_themes` */

insert  into `saved_themes`(`id`,`name`,`description`,`author`,`created`,`modified`,`folder_name`,`shop_id`,`theme_id`,`featured`) values (1,'default','default','shop001','2011-01-02 22:14:57','2011-01-02 22:14:57','2_cover',2,3,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `shipments` */

insert  into `shipments`(`id`,`order_id`,`completed`,`name`,`price`,`description`) values (1,117,0,'International Shipping','10.0000','From 10kg to 20kg'),(2,146,0,'test2','0.0000','From $2 to $20'),(3,150,0,'Heavy Duty Shipping','25.0000','From 20kg to 50kg'),(5,157,0,'Heavy Duty Shipping','25.0000','From 20kg to 50kg'),(6,1,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(7,2,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(8,1,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(9,2,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(10,3,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(11,4,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(12,5,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(13,6,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(14,7,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(15,8,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(16,9,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(17,10,0,'Standard Shipping','10.0000','From 10kg to 20kg'),(18,11,0,'Standard Shipping','10.0000','From 10kg to 20kg');

/*Table structure for table `shipped_to_countries` */

DROP TABLE IF EXISTS `shipped_to_countries`;

CREATE TABLE `shipped_to_countries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `country_id` int(5) DEFAULT '0',
  `shop_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `shipped_to_countries` */

insert  into `shipped_to_countries`(`id`,`country_id`,`shop_id`) values (1,0,1),(2,192,1),(3,192,2),(4,0,2);

/*Table structure for table `shipping_rates` */

DROP TABLE IF EXISTS `shipping_rates`;

CREATE TABLE `shipping_rates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,3) unsigned NOT NULL,
  `shipped_to_country_id` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `shipping_rates` */

insert  into `shipping_rates`(`id`,`name`,`price`,`shipped_to_country_id`,`description`) values (1,'Standard Shipping','10.000',2,'From 10kg to 20kg'),(2,'Heavy Duty Shipping','25.000',2,'From 20kg to 50kg'),(3,'Standard Shipping','10.000',3,'From 10kg to 20kg'),(4,'Heavy Duty','25.000',3,'From 20kg to 50kg'),(5,'Standard Shipping','10.000',4,'From 10kg to 20kg'),(6,'Heavy Duty','25.000',4,'From 20kg to 50kg');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `shops` */

insert  into `shops`(`id`,`name`,`web_address`,`created`,`modified`,`status`,`saved_theme_id`,`deny_access`) values (1,'a','http://a.myspree2shop.com',NULL,NULL,1,0,0),(2,'shop001','http://shop001.ombi60.localhost','2011-01-02 22:14:57','2011-01-02 22:14:57',1,1,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `shops_payment_modules` */

insert  into `shops_payment_modules`(`id`,`shop_id`,`payment_module_id`,`default`,`active`,`display_name`) values (1,2,2,0,1,'Paypal Express Checkout'),(2,2,1,0,1,'Cash On Delivery');

/*Table structure for table `site_transfers` */

DROP TABLE IF EXISTS `site_transfers`;

CREATE TABLE `site_transfers` (
  `id` varchar(36) NOT NULL,
  `sess_id` varchar(26) NOT NULL,
  `paypal_token` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `site_transfers` */

insert  into `site_transfers`(`id`,`sess_id`,`paypal_token`) values ('4c530584-85b0-4317-916b-5f0c1507707a','u480lp9q7t778f7d444fbmusq3',NULL),('4c530728-1a9c-4bdb-8537-04f61507707a','u480lp9q7t778f7d444fbmusq3',NULL),('4c5307e9-3de8-4357-966f-04f71507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530837-99ac-4498-936f-30371507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c53085f-29d4-4add-87eb-30381507707a','u480lp9q7t778f7d444fbmusq3',NULL),('4c530862-cf5c-4eb7-8215-04f61507707a','u480lp9q7t778f7d444fbmusq3',NULL),('4c530863-c05c-4ac1-a845-04f51507707a','u480lp9q7t778f7d444fbmusq3',NULL),('4c53092c-1108-4bf9-afc8-30371507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c53099f-8048-4867-bf13-30381507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530a6b-5d54-41bc-8528-04f61507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530acc-ff18-424b-9b05-04f51507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530b22-0f90-4b96-ace1-5f0c1507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530bef-5ff8-4c66-8736-390e1507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c530e17-a04c-4331-9d0b-04f71507707a','vmva1l8loj77b1l8dr7anl6l86',NULL),('4c531788-66e0-4bb2-b563-30381507707a','vmva1l8loj77b1l8dr7anl6l86','EC-46006742RH5104307'),('4c54efbe-8a64-474f-9c56-050d1507707a','idauebspjp1qaivdr5hao57ha0','EC-5G332069L8682035K'),('4c54f1c5-737c-4fa7-a2bf-17871507707a','idauebspjp1qaivdr5hao57ha0','EC-68K43810C8105712P'),('4c54f253-7adc-4d89-b766-050b1507707a','idauebspjp1qaivdr5hao57ha0','EC-86X198677M6472030'),('4c54f52c-b98c-4f2c-996d-17851507707a','',NULL),('4c54f891-e34c-411d-9c4f-17871507707a','idauebspjp1qaivdr5hao57ha0','EC-2477257836559410J'),('4c60c03b-e580-4d2e-8451-60281507707a','hp52ash1r5vd90t7l083pq5do3','EC-7KN76010F95584617'),('4c92f863-d654-4ff5-bfcf-528d1507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c92fbab-4e50-47d2-a08b-4bdb1507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c92fc07-8914-4f4d-8587-1fd01507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c92fc86-b688-4db9-a5e2-6f311507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c92fd83-f5f4-4e3f-b045-72981507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c92fdfa-ff54-49ba-9e88-0c5c1507707a','c44m5dikhjvuqfnb3c10nchai3',NULL),('4c995ba5-d86c-471a-982e-050c1507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995bc2-9f4c-4176-b536-171d1507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995bd9-0620-4316-b94e-050d1507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995c5e-a37c-4d52-8fa1-0c021507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995cb4-022c-4855-b291-050b1507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995d1c-5dac-4e26-9cb1-17191507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4c995dd7-7398-4f00-bbeb-0c0a1507707a','r5ckmm4supqget8j7kf8nrben7',NULL),('4ca95cc8-07dc-4985-8306-1c741507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca95d47-ec68-4aca-9870-21981507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca95dce-38a8-43f6-9675-052d1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca95dfa-9218-48a2-a9ce-1c531507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca95e1b-f9f0-49a4-b239-052a1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca9609f-7188-46ff-89f4-1c741507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca960da-b1b0-44df-b099-213d1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca960f9-c110-420a-b2f5-052c1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca96191-d924-4942-8f4f-1c721507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca9619f-3ae8-414a-900b-21941507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca96352-49cc-49af-89b2-21971507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca96fe0-0af4-4de6-a8f7-052c1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca9702c-ed30-4b77-97fa-21971507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca97141-2538-414f-b6a6-1c741507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca972fd-7938-416b-a0eb-1c531507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca9731a-56dc-4c5b-a8ef-052d1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4ca9733d-5394-4edb-b1b0-052c1507707a','dh4jqvgup4k7racvk098unhcn7',NULL),('4caa8f95-17d0-465b-908f-215c1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caa97d3-25cc-4557-9a6b-215e1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caa9997-7b60-496d-b9a5-21581507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caa9f64-30e4-4eca-90b4-60b91507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caaa134-eb90-448c-9ed1-21581507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caaa1d0-e158-45cc-8b55-21541507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caaa1dc-1808-4907-b841-733b1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caaa2af-54ec-4620-8472-697a1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caaa8e6-0a68-4aea-890b-697a1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caab480-bd84-4fb1-b18a-05be1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caab73f-8320-4859-b847-215d1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caab8bf-ec28-412b-942a-05311507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caab995-e8ac-4903-b264-24fb1507707a','sk2lcgcva897uokltbct2fvkt2',NULL),('4caab9e1-dffc-4dfc-85e8-32c81507707a','sk2lcgcva897uokltbct2fvkt2','EC-5S569044B2055341W'),('4caaba0e-d284-4455-af80-733b1507707a','sk2lcgcva897uokltbct2fvkt2','EC-6PY42009CL365804Y'),('4cabe022-6e98-4819-a1bc-05201507707a','gi2r1vsj9bp0resdd3k1oov113','EC-9XP01146KW846361F'),('4cabe211-fa5c-4214-9c3f-31781507707a','gi2r1vsj9bp0resdd3k1oov113','EC-3XP82027RN070462J'),('4cabe29c-3024-4e9a-b42d-317e1507707a','gi2r1vsj9bp0resdd3k1oov113','EC-5D66601308111852Y'),('4cad2d0e-d0e8-4863-8f03-050c1507707a','ckire0hgq3fenmp0iue0nc9jb5','EC-22329773CB572314D'),('4cad326e-7f54-45db-89c6-05101507707a','ckire0hgq3fenmp0iue0nc9jb5','EC-00S9413236950293K'),('4cae6732-591c-46f2-820f-04ed1507707a','d8b4c0mpuvp6fp76i3p9r9qn54','EC-72263209RM183974T'),('4caee51d-49d0-4a1b-b5d5-050e1507707a','d8b4c0mpuvp6fp76i3p9r9qn54','EC-35811075U6211992T'),('4cb05538-36d0-4d61-a25b-15541507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb05550-a53c-4608-8228-05371507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb0555b-72e8-40a2-aa5c-15561507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb05655-bee8-4b43-a920-05381507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb0568b-8618-455b-81e3-15541507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb056e7-d7d8-4b5d-b7ef-18921507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb05748-f43c-408f-ae44-05361507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb05799-ae60-43e9-9c8e-15541507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb057c3-0fb8-4a30-837d-053a1507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb058cc-6144-4b69-8cf6-18921507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb059ea-3090-4798-89d1-20441507707a','t9vfa21af3l5atg9e1lh7a15r7',NULL),('4cb05c0d-8648-49da-8dcc-05361507707a','t9vfa21af3l5atg9e1lh7a15r7','EC-7G495828M71036431'),('4cb05c7b-9eb4-41c2-9475-15561507707a','t9vfa21af3l5atg9e1lh7a15r7','EC-0CG33138JU944273J'),('4cb05cd0-0e54-4551-a016-22241507707a','ecb6dsvbhte0bacoc2t9h7baa3',NULL),('4cb05d19-84e8-4354-b0c4-05361507707a','ecb6dsvbhte0bacoc2t9h7baa3','EC-3GL84901WK649141U'),('4cb2c806-41f0-482f-ab36-22251507707a','kr0iir79m77tcn0a2fgoelun47',NULL),('4cd355ff-de3c-4be0-ba8f-04f71507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd35668-6adc-4333-9fbc-04f61507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd3569a-ced8-438a-9919-04f91507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd356c5-3c6c-42e1-8779-3aea1507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd35707-d560-4c21-ac38-3bcc1507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd35768-bba4-49aa-8909-3ac11507707a','sg553gh049qq8sen6tgqj2qcv2',NULL),('4cd35928-3e30-4d58-afb3-04fa1507707a','sg553gh049qq8sen6tgqj2qcv2','EC-1LG56621TL9126009'),('4cd359ca-30bc-403b-aa91-04f81507707a','sg553gh049qq8sen6tgqj2qcv2','EC-1K309626V3924353E'),('4cd35a2a-a7c8-4c22-93fe-3abb1507707a','sg553gh049qq8sen6tgqj2qcv2','EC-712968814E389194H'),('4cd35a58-38b4-4f19-9c76-04f71507707a','sg553gh049qq8sen6tgqj2qcv2','EC-5CT70666X33865212'),('4cd35aa5-7688-4b93-894b-04f61507707a','sg553gh049qq8sen6tgqj2qcv2','EC-5MR52951JD8682344'),('4cd35d11-6098-4bc3-996f-04f91507707a','sg553gh049qq8sen6tgqj2qcv2','EC-41U387808T951440W'),('4cd35e5c-a778-4c87-b90b-3aea1507707a','sg553gh049qq8sen6tgqj2qcv2','EC-8FT622333V0410511'),('4cd35f53-4f18-458a-949b-3bcc1507707a','sg553gh049qq8sen6tgqj2qcv2','EC-9RG578540F341041E'),('4cd35fa8-4d4c-4544-b200-3ac11507707a','sg553gh049qq8sen6tgqj2qcv2','EC-443488659M426481G'),('4cd36037-03f4-4994-a762-04f81507707a','m87qog4ts74lf9lk1ar0gvq5o1',NULL),('4cd5069f-5924-4c6a-916e-19251507707a','kbctdurbdfat68qj51e09k5mt7',NULL),('4cd50787-a714-42c1-9e40-1aba1507707a','kbctdurbdfat68qj51e09k5mt7',NULL),('4cd507fd-073c-48dd-88fb-19321507707a','kbctdurbdfat68qj51e09k5mt7',NULL),('4cd50872-5d74-48f5-a746-04fe1507707a','qhofhtpfkrtupore8g3argtmc0',NULL),('4cd50899-3c20-4240-bcae-19331507707a','qhofhtpfkrtupore8g3argtmc0',NULL),('4cd508ef-d424-4eb5-8b66-04fe1507707a','t14p062h8377l84tmrvqlivvo6',NULL),('4cd50915-33f4-4cda-86da-1ae21507707a','t14p062h8377l84tmrvqlivvo6','EC-7UU600616M633893G'),('4cd50a76-1ec4-42e0-ab60-19331507707a','t14p062h8377l84tmrvqlivvo6','EC-392897443R184441A'),('4cd50adb-2d10-4179-8b49-19321507707a','13nnt8sap4oqbitn3dcmhle833',NULL),('4cda5d9f-7198-42cd-896c-05321507707a','fombmao8jv26dk02ocj26r5b23',NULL),('4cda5f69-d4a8-4b1c-879f-77631507707a','fombmao8jv26dk02ocj26r5b23','EC-1YD1959094360491J'),('4cda5fe4-e2a8-4e56-8936-05331507707a','fombmao8jv26dk02ocj26r5b23','EC-10T420284Y624321Y'),('4cdbc870-05d4-4205-9122-05201507707a','eov902rflkpff6v5vmog5op3g7','EC-26L19599P98142053'),('4cdbc9a0-16c8-4dd4-bcf2-051f1507707a','eov902rflkpff6v5vmog5op3g7','EC-75D74411HX4252132'),('4d208941-e7a4-4e54-bed7-0a4d1507707a','e48o2qf7fmalj5rnp455mil9b6','EC-7A4241116H716731Y');

/*Table structure for table `subscription_plans` */

DROP TABLE IF EXISTS `subscription_plans`;

CREATE TABLE `subscription_plans` (
  `id` varchar(255) NOT NULL,
  `currency_code` varchar(10) DEFAULT NULL,
  `price` decimal(7,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `subscription_plans` */

insert  into `subscription_plans`(`id`,`currency_code`,`price`) values ('basic','SGD','39.90'),('business','SGD','399.90'),('standard','SGD','99.90'),('starter','SGD','19.90');

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
  `folder_name` varchar(255) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`group_id`,`full_name`,`name_to_call`,`last_login_on`,`status`,`created`,`modified`,`language_id`) values (1,'owner@shop001.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'shop001','shop001',NULL,1,'2011-01-02 22:14:57','2011-01-02 22:14:57',1),(2,'wkorxpqu@ombi60.com','b4f48dd07966a3440f68148c1ed49dad85bad90d',5,'casual','casual',NULL,1,'2011-01-02 14:16:02','2011-01-02 14:16:02',1),(3,'nfwth79x@ombi60.com','05ad6f9c9fc75ad29d7876166a19803b36455b79',5,'casual','casual',NULL,1,'2011-01-02 14:16:53','2011-01-02 14:16:53',1),(4,'cust_spore@gmail.com','5a4eff62fa8d7ef339d0f8cb3f52e398cf99ab39',4,'mister customer','mister customer',NULL,1,'2011-01-02 14:28:25','2011-01-02 14:28:25',1),(5,'kimcity@gmail.com','9c0e87ac30d399967817b3070d38f676a147cedd',4,'asd','asd',NULL,1,'2011-01-02 14:31:25','2011-01-02 14:31:25',1);

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

insert  into `webpages`(`id`,`shop_id`,`title`,`text`,`created`,`modified`,`meta_title`,`meta_keywords`,`meta_description`,`author`,`real_author`,`handle`,`visible`) values (1,1,'welcome','<div class=\"item\">\r\n		\r\n<table class=\"itemTable\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"itemLeftCell\">\r\n					Lorem ipsum dolor sit amet, consectetur \r\n					adipiscing elit. <a href=\"#\">Sed semper est sed</a> eros sodales \r\n					in lacinia dolor egestas. Integer seper imperdiet enim eu \r\n					convallis. Suspendisse nec orci tellus. Aenean consectetur \r\n					venenatis gravida. Suspendisse et ipsum nisl. Nam quis libero a \r\n					nibh mollis lobortis. Ut venenatis tortor tellus. In ac magna \r\n					quam. Etiam ac risus magna, nec pretium diam. <a href=\"#\">\r\n					Phasellus euismod</a> \r\n					leo at leo vestibulum dapibus. Quisque sit amet nibh ut nisi \r\n					congue gravida nec nec ligula. Morbi feugiat mattis volutpat. \r\n					Praesent aliquet sem sit amet massa scelerisque vitae semper \r\n					purus varius. Pellentesque habitant morbi tristique senectus et \r\n					netus et malesuada fames ac turpis egestas.\r\n				</td>\r\n<td class=\"itemRightCell\">\r\n					<img src=\"user_generated_content/images/Jellyfish.jpg\" alt=\"Picture 1\" width=\"192\" height=\"144\" />\r\n				</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<div class=\"itemAlt\">\r\n		\r\n<table class=\"itemTable\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"itemLeftCell\">\r\n					Proin mauris tortor, ultricies \r\n					interdum posuere eu, placerat vitae orci. Duis non laoreet \r\n					libero. Suspendisse aliquam congue metus non elementum. Cras \r\n					quis bibendum lorem. Quisque cursus aliquam mattis. Sed id orci \r\n					tortor. Suspendisse potenti. Nulla luctus interdum massa in \r\n					malesuada. Fusce mi magna, gravida a pretium quis, ultrices vel \r\n					orci. <a href=\"#\">Nullam sollicitudin</a> nibh ac dolor tempor \r\n					porttitor. Curabitur id lacus vitae ipsum rhoncus varius. Class \r\n					aptent taciti sociosqu ad litora torquent per conubia nostra, \r\n					per inceptos himenaeos. Nunc pharetra eros et dui adipiscing \r\n					ultrices. Nunc eros lectus, bibendum eu consequat id, \r\n					<a href=\"#\">cursus non quam</a>. Nam vel dolor dolor. \r\n					Pellentesque ante tortor, mattis auctor condimentum ut, \r\n					convallis a dui. Mauris scelerisque dapibus libero, vitae \r\n					facilisis tellus mattis a. Pellentesque metus nulla, tristique \r\n					at venenatis et, egestas a diam.\r\n				</td>\r\n<td class=\"itemRightCell\">\r\n					<img src=\"user_generated_content/images/Koala.jpg\" alt=\"Picture 2\" width=\"192\" height=\"144\" />\r\n				</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<div class=\"item\">\r\n		\r\n<table class=\"itemTable\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"itemLeftCell\">\r\n					Nulla auctor sapien lorem. Ut vitae \r\n					euismod elit. Ut sit amet sagittis felis. Cras sollicitudin quam \r\n					eu magna tempus eleifend. Donec interdum interdum lacus eget \r\n					iaculis. Nulla facilisi. Phasellus <a href=\"#\">eget lacus auctor</a> \r\n					nibh rhoncus condimentum. Fusce volutpat, felis vel tincidunt \r\n					pellentesque, orci lorem vestibulum elit, ac tristique justo \r\n					magna at ante. <a href=\"#\">Lorem ipsum</a> dolor sit amet, \r\n					consectetur adipiscing elit. Curabitur rutrum interdum tempus. \r\n					Nunc et sapien eros, et ultrices elit. <a href=\"#\">Maecenas in \r\n					leo dui</a>, sit amet iaculis lectus. Duis lacinia, velit ut \r\n					vehicula dictum, eros sem ultricies tortor, ac faucibus dui dui \r\n					et enim. Phasellus feugiat faucibus elit, eget ultrices lacus \r\n					fringilla sit amet. Vivamus faucibus nisl a enim lacinia \r\n					venenatis. In tincidunt tincidunt dolor vel rutrum. Donec vitae \r\n					orci ut nibh tristique laoreet.\r\n				</td>\r\n<td class=\"itemRightCell\">\r\n					<img src=\"user_generated_content/images/Hydrangeas.jpg\" alt=\"Picture 3\" width=\"192\" height=\"144\" />\r\n				</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>','2010-09-01 11:38:15','2010-12-22 02:15:17',NULL,NULL,NULL,1,NULL,'shopfront',1),(2,2,'Welcome','<div class=\"item\">\n		\n<table class=\"itemTable\" cellspacing=\"0\" cellpadding=\"0\">\n<tbody>\n<tr>\n<td class=\"itemLeftCell\">\n					Lorem ipsum dolor sit amet, consectetur \n					adipiscing elit. <a href=\"#\">Sed semper est sed</a> eros sodales \n					in lacinia dolor egestas. Integer seper imperdiet enim eu \n					convallis. Suspendisse nec orci tellus. Aenean consectetur \n					venenatis gravida. Suspendisse et ipsum nisl. Nam quis libero a \n					nibh mollis lobortis. Ut venenatis tortor tellus. In ac magna \n					quam. Etiam ac risus magna, nec pretium diam. <a href=\"#\">\n					Phasellus euismod</a> \n					leo at leo vestibulum dapibus. Quisque sit amet nibh ut nisi \n					congue gravida nec nec ligula. Morbi feugiat mattis volutpat. \n					Praesent aliquet sem sit amet massa scelerisque vitae semper \n					purus varius. Pellentesque habitant morbi tristique senectus et \n					netus et malesuada fames ac turpis egestas.\n				</td>\n<td class=\"itemRightCell\">\n					<img src=\"user_generated_content/images/Jellyfish.jpg\" alt=\"Picture 1\" width=\"192\" height=\"144\" />\n				</td>\n</tr>\n</tbody>\n</table>\n</div>\n<div class=\"itemAlt\">\n		\n<table class=\"itemTable\" cellspacing=\"0\" cellpadding=\"0\">\n<tbody>\n<tr>\n<td class=\"itemLeftCell\">\n					Proin mauris tortor, ultricies \n					interdum posuere eu, placerat vitae orci. Duis non laoreet \n					libero. Suspendisse aliquam congue metus non elementum. Cras \n					quis bibendum lorem. Quisque cursus aliquam mattis. Sed id orci \n					tortor. Suspendisse potenti. Nulla luctus interdum massa in \n					malesuada. Fusce mi magna, gravida a pretium quis, ultrices vel \n					orci. <a href=\"#\">Nullam sollicitudin</a> nibh ac dolor tempor \n					porttitor. Curabitur id lacus vitae ipsum rhoncus varius. Class \n					aptent taciti sociosqu ad litora torquent per conubia nostra, \n					per inceptos himenaeos. Nunc pharetra eros et dui adipiscing \n					ultrices. Nunc eros lectus, bibendum eu consequat id, \n					<a href=\"#\">cursus non quam</a>. Nam vel dolor dolor. \n					Pellentesque ante tortor, mattis auctor condimentum ut, \n					convallis a dui. Mauris scelerisque dapibus libero, vitae \n					facilisis tellus mattis a. Pellentesque metus nulla, tristique \n					at venenatis et, egestas a diam.\n				</td>\n<td class=\"itemRightCell\">\n					<img src=\"user_generated_content/images/Koala.jpg\" alt=\"Picture 2\" width=\"192\" height=\"144\" />\n				</td>\n</tr>\n</tbody>\n</table>\n</div>\n<div class=\"item\">\n		\n<table class=\"itemTable\" cellspacing=\"0\" cellpadding=\"0\">\n<tbody>\n<tr>\n<td class=\"itemLeftCell\">\n					Nulla auctor sapien lorem. Ut vitae \n					euismod elit. Ut sit amet sagittis felis. Cras sollicitudin quam \n					eu magna tempus eleifend. Donec interdum interdum lacus eget \n					iaculis. Nulla facilisi. Phasellus <a href=\"#\">eget lacus auctor</a> \n					nibh rhoncus condimentum. Fusce volutpat, felis vel tincidunt \n					pellentesque, orci lorem vestibulum elit, ac tristique justo \n					magna at ante. <a href=\"#\">Lorem ipsum</a> dolor sit amet, \n					consectetur adipiscing elit. Curabitur rutrum interdum tempus. \n					Nunc et sapien eros, et ultrices elit. <a href=\"#\">Maecenas in \n					leo dui</a>, sit amet iaculis lectus. Duis lacinia, velit ut \n					vehicula dictum, eros sem ultricies tortor, ac faucibus dui dui \n					et enim. Phasellus feugiat faucibus elit, eget ultrices lacus \n					fringilla sit amet. Vivamus faucibus nisl a enim lacinia \n					venenatis. In tincidunt tincidunt dolor vel rutrum. Donec vitae \n					orci ut nibh tristique laoreet.\n				</td>\n<td class=\"itemRightCell\">\n					<img src=\"user_generated_content/images/Hydrangeas.jpg\" alt=\"Picture 3\" width=\"192\" height=\"144\" />\n				</td>\n</tr>\n</tbody>\n</table>\n</div>','2011-01-02 22:14:57','2011-01-02 22:14:57',NULL,NULL,NULL,1,NULL,'shopfront',1);

/*Table structure for table `weight_based_rates` */

DROP TABLE IF EXISTS `weight_based_rates`;

CREATE TABLE `weight_based_rates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `min_weight` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `max_weight` decimal(10,4) unsigned DEFAULT NULL,
  `shipping_rate_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `weight_based_rates` */

insert  into `weight_based_rates`(`id`,`min_weight`,`max_weight`,`shipping_rate_id`) values (1,'10.0000','20.0000',1),(2,'20.0000','50.0000',2),(3,'10.0000','20.0000',3),(4,'20.0000','50.0000',4),(5,'10.0000','20.0000',5),(6,'20.0000','50.0000',6);

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

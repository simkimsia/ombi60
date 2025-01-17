/*
SQLyog Community v8.81
MySQL - 5.1.41-3ubuntu12.10 : Database - s2s_new
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
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=utf8;

/*Data for the table `acos` */

insert  into `acos`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,NULL,NULL,'controllers',1,514),(2,1,NULL,NULL,'Pages',2,9),(3,2,NULL,NULL,'display',3,4),(4,2,NULL,NULL,'forceSSL',5,6),(5,2,NULL,NULL,'admin_change_active_status',7,8),(6,1,NULL,NULL,'Payments',10,29),(7,6,NULL,NULL,'admin_index',11,12),(8,6,NULL,NULL,'admin_update_settings',13,14),(9,6,NULL,NULL,'admin_add_paypal_payment',15,16),(10,6,NULL,NULL,'admin_add_custom_payment',17,18),(11,6,NULL,NULL,'admin_edit_paypal_payment',19,20),(12,6,NULL,NULL,'admin_edit_custom_payment',21,22),(13,6,NULL,NULL,'admin_delete_custom_payment',23,24),(14,6,NULL,NULL,'forceSSL',25,26),(15,6,NULL,NULL,'admin_change_active_status',27,28),(16,1,NULL,NULL,'ShippingRates',30,45),(17,16,NULL,NULL,'admin_index',31,32),(18,16,NULL,NULL,'admin_edit',33,34),(19,16,NULL,NULL,'admin_add_price_based',35,36),(20,16,NULL,NULL,'admin_add_weight_based',37,38),(21,16,NULL,NULL,'admin_delete',39,40),(22,16,NULL,NULL,'forceSSL',41,42),(23,16,NULL,NULL,'admin_change_active_status',43,44),(24,1,NULL,NULL,'PaydollarTransactions',46,53),(25,24,NULL,NULL,'datafeed',47,48),(26,24,NULL,NULL,'forceSSL',49,50),(27,24,NULL,NULL,'admin_change_active_status',51,52),(28,1,NULL,NULL,'SavedThemes',54,81),(29,28,NULL,NULL,'admin_index',55,56),(30,28,NULL,NULL,'admin_view',57,58),(31,28,NULL,NULL,'admin_switch',59,60),(32,28,NULL,NULL,'admin_add',61,62),(33,28,NULL,NULL,'admin_upload',63,64),(34,28,NULL,NULL,'admin_edit',65,66),(35,28,NULL,NULL,'admin_delete',67,68),(36,28,NULL,NULL,'admin_edit_image',69,70),(37,28,NULL,NULL,'admin_feature',71,72),(38,28,NULL,NULL,'admin_delete_image',73,74),(39,28,NULL,NULL,'admin_edit_css',75,76),(40,28,NULL,NULL,'forceSSL',77,78),(41,28,NULL,NULL,'admin_change_active_status',79,80),(42,1,NULL,NULL,'Addresses',82,89),(43,42,NULL,NULL,'index',83,84),(44,42,NULL,NULL,'forceSSL',85,86),(45,42,NULL,NULL,'admin_change_active_status',87,88),(46,1,NULL,NULL,'GiftCards',90,115),(47,46,NULL,NULL,'index',91,92),(48,46,NULL,NULL,'view',93,94),(49,46,NULL,NULL,'add',95,96),(50,46,NULL,NULL,'edit',97,98),(51,46,NULL,NULL,'delete',99,100),(52,46,NULL,NULL,'admin_index',101,102),(53,46,NULL,NULL,'admin_view',103,104),(54,46,NULL,NULL,'admin_add',105,106),(55,46,NULL,NULL,'admin_edit',107,108),(56,46,NULL,NULL,'admin_delete',109,110),(57,46,NULL,NULL,'forceSSL',111,112),(58,46,NULL,NULL,'admin_change_active_status',113,114),(59,1,NULL,NULL,'Products',116,167),(60,59,NULL,NULL,'checkout',117,118),(61,59,NULL,NULL,'view_cart',119,120),(62,59,NULL,NULL,'admin_index',121,122),(63,59,NULL,NULL,'admin_view',123,124),(64,59,NULL,NULL,'view',125,126),(65,59,NULL,NULL,'view_by_group',127,128),(66,59,NULL,NULL,'admin_add',129,130),(67,59,NULL,NULL,'admin_upload',131,132),(68,59,NULL,NULL,'admin_toggle',133,134),(69,59,NULL,NULL,'admin_edit',135,136),(70,59,NULL,NULL,'save_image',137,138),(71,59,NULL,NULL,'admin_delete',139,140),(72,59,NULL,NULL,'admin_duplicate',141,142),(73,59,NULL,NULL,'platform_index',143,144),(74,59,NULL,NULL,'platform_view',145,146),(75,59,NULL,NULL,'platform_add',147,148),(76,59,NULL,NULL,'platform_edit',149,150),(77,59,NULL,NULL,'platform_delete',151,152),(79,59,NULL,NULL,'add_to_cart',153,154),(80,59,NULL,NULL,'delete_from_cart',155,156),(81,59,NULL,NULL,'admin_search',157,158),(82,59,NULL,NULL,'forceSSL',159,160),(83,59,NULL,NULL,'admin_change_active_status',161,162),(84,1,NULL,NULL,'Domains',168,185),(85,84,NULL,NULL,'admin_index',169,170),(86,84,NULL,NULL,'admin_view',171,172),(87,84,NULL,NULL,'admin_add',173,174),(88,84,NULL,NULL,'admin_make_this_primary',175,176),(89,84,NULL,NULL,'admin_edit',177,178),(90,84,NULL,NULL,'admin_delete',179,180),(91,84,NULL,NULL,'forceSSL',181,182),(92,84,NULL,NULL,'admin_change_active_status',183,184),(93,1,NULL,NULL,'Shops',186,197),(94,93,NULL,NULL,'admin_general_settings',187,188),(95,93,NULL,NULL,'admin_account',189,190),(96,93,NULL,NULL,'admin_cancelaccount',191,192),(97,93,NULL,NULL,'forceSSL',193,194),(98,93,NULL,NULL,'admin_change_active_status',195,196),(99,1,NULL,NULL,'Customers',198,209),(100,99,NULL,NULL,'register',199,200),(101,99,NULL,NULL,'login',201,202),(102,99,NULL,NULL,'logout',203,204),(103,99,NULL,NULL,'forceSSL',205,206),(104,99,NULL,NULL,'admin_change_active_status',207,208),(105,1,NULL,NULL,'Links',210,235),(106,105,NULL,NULL,'index',211,212),(107,105,NULL,NULL,'view',213,214),(108,105,NULL,NULL,'add',215,216),(109,105,NULL,NULL,'edit',217,218),(110,105,NULL,NULL,'delete',219,220),(111,105,NULL,NULL,'admin_index',221,222),(112,105,NULL,NULL,'admin_order',223,224),(113,105,NULL,NULL,'admin_add',225,226),(114,105,NULL,NULL,'admin_edit',227,228),(115,105,NULL,NULL,'admin_delete',229,230),(116,105,NULL,NULL,'forceSSL',231,232),(117,105,NULL,NULL,'admin_change_active_status',233,234),(118,1,NULL,NULL,'Groups',236,243),(119,118,NULL,NULL,'parentNode',237,238),(120,118,NULL,NULL,'forceSSL',239,240),(121,118,NULL,NULL,'admin_change_active_status',241,242),(122,1,NULL,NULL,'Blogs',244,259),(123,122,NULL,NULL,'admin_index',245,246),(124,122,NULL,NULL,'admin_view',247,248),(125,122,NULL,NULL,'admin_add',249,250),(126,122,NULL,NULL,'admin_edit',251,252),(127,122,NULL,NULL,'admin_delete',253,254),(128,122,NULL,NULL,'forceSSL',255,256),(129,122,NULL,NULL,'admin_change_active_status',257,258),(130,1,NULL,NULL,'ProductGroups',260,291),(131,130,NULL,NULL,'admin_index',261,262),(132,130,NULL,NULL,'admin_view_smart',263,264),(133,130,NULL,NULL,'admin_add_smart',265,266),(134,130,NULL,NULL,'admin_edit_smart',267,268),(135,130,NULL,NULL,'admin_view_custom',269,270),(136,130,NULL,NULL,'admin_add_custom',271,272),(137,130,NULL,NULL,'admin_add_product_in_group',273,274),(138,130,NULL,NULL,'admin_remove_product_from_group',275,276),(139,130,NULL,NULL,'admin_edit_custom',277,278),(140,130,NULL,NULL,'admin_delete',279,280),(141,130,NULL,NULL,'admin_toggle',281,282),(142,130,NULL,NULL,'admin_remove_condition',283,284),(143,130,NULL,NULL,'admin_save_condition',285,286),(144,130,NULL,NULL,'forceSSL',287,288),(145,130,NULL,NULL,'admin_change_active_status',289,290),(146,1,NULL,NULL,'ProductImages',292,313),(147,146,NULL,NULL,'admin_add',293,294),(148,146,NULL,NULL,'admin_add_by_product',295,296),(149,146,NULL,NULL,'admin_uploadify',297,298),(150,146,NULL,NULL,'admin_list_by_product',299,300),(151,146,NULL,NULL,'admin_delete',301,302),(152,146,NULL,NULL,'admin_make_this_cover',303,304),(153,146,NULL,NULL,'admin_ajax_product_image_upload',305,306),(154,146,NULL,NULL,'admin_delete_me',307,308),(155,146,NULL,NULL,'forceSSL',309,310),(156,146,NULL,NULL,'admin_change_active_status',311,312),(157,1,NULL,NULL,'Carts',314,327),(158,157,NULL,NULL,'index',315,316),(159,157,NULL,NULL,'view',317,318),(160,157,NULL,NULL,'edit',319,320),(161,157,NULL,NULL,'delete',321,322),(162,157,NULL,NULL,'forceSSL',323,324),(163,157,NULL,NULL,'admin_change_active_status',325,326),(173,1,NULL,NULL,'Orders',328,353),(174,173,NULL,NULL,'paypal',329,330),(175,173,NULL,NULL,'index',331,332),(176,173,NULL,NULL,'admin_index',333,334),(177,173,NULL,NULL,'admin_view',335,336),(178,173,NULL,NULL,'view',337,338),(179,173,NULL,NULL,'add',339,340),(180,173,NULL,NULL,'checkout',341,342),(181,173,NULL,NULL,'success',343,344),(182,173,NULL,NULL,'updatePrices',345,346),(183,173,NULL,NULL,'pay',347,348),(184,173,NULL,NULL,'forceSSL',349,350),(185,173,NULL,NULL,'admin_change_active_status',351,352),(186,1,NULL,NULL,'Merchants',354,377),(187,186,NULL,NULL,'register',355,356),(188,186,NULL,NULL,'admin_login',357,358),(189,186,NULL,NULL,'admin_logout',359,360),(190,186,NULL,NULL,'admin_index',361,362),(191,186,NULL,NULL,'admin_edit',363,364),(192,186,NULL,NULL,'platform_index',365,366),(193,186,NULL,NULL,'platform_view',367,368),(194,186,NULL,NULL,'platform_edit',369,370),(195,186,NULL,NULL,'platform_delete',371,372),(196,186,NULL,NULL,'forceSSL',373,374),(197,186,NULL,NULL,'admin_change_active_status',375,376),(198,1,NULL,NULL,'Themes',378,385),(199,198,NULL,NULL,'admin_index',379,380),(200,198,NULL,NULL,'forceSSL',381,382),(201,198,NULL,NULL,'admin_change_active_status',383,384),(202,1,NULL,NULL,'Webpages',386,407),(203,202,NULL,NULL,'view',387,388),(204,202,NULL,NULL,'frontpage',389,390),(205,202,NULL,NULL,'admin_index',391,392),(206,202,NULL,NULL,'admin_view',393,394),(207,202,NULL,NULL,'admin_toggle',395,396),(208,202,NULL,NULL,'admin_add',397,398),(209,202,NULL,NULL,'admin_edit',399,400),(210,202,NULL,NULL,'admin_delete',401,402),(211,202,NULL,NULL,'forceSSL',403,404),(212,202,NULL,NULL,'admin_change_active_status',405,406),(213,1,NULL,NULL,'Users',408,429),(214,213,NULL,NULL,'parentNode',409,410),(215,213,NULL,NULL,'initDB',411,412),(216,213,NULL,NULL,'login',413,414),(217,213,NULL,NULL,'logout',415,416),(218,213,NULL,NULL,'platform_login',417,418),(219,213,NULL,NULL,'platform_logout',419,420),(220,213,NULL,NULL,'platform_index',421,422),(221,213,NULL,NULL,'afterSave',423,424),(222,213,NULL,NULL,'forceSSL',425,426),(223,213,NULL,NULL,'admin_change_active_status',427,428),(224,1,NULL,NULL,'Posts',430,449),(225,224,NULL,NULL,'view',431,432),(226,224,NULL,NULL,'index',433,434),(227,224,NULL,NULL,'admin_view',435,436),(228,224,NULL,NULL,'admin_add',437,438),(229,224,NULL,NULL,'admin_edit',439,440),(230,224,NULL,NULL,'admin_delete',441,442),(231,224,NULL,NULL,'admin_toggle',443,444),(232,224,NULL,NULL,'forceSSL',445,446),(233,224,NULL,NULL,'admin_change_active_status',447,448),(234,1,NULL,NULL,'Linkable',450,451),(235,1,NULL,NULL,'ThemeFolder',452,453),(236,1,NULL,NULL,'Paypal',454,455),(237,1,NULL,NULL,'Rest',456,457),(238,1,NULL,NULL,'TwigView',458,459),(239,1,NULL,NULL,'Visible',460,461),(240,1,NULL,NULL,'RandomString',462,463),(241,1,NULL,NULL,'Paydollar',464,465),(242,1,NULL,NULL,'DebugKit',466,477),(243,242,NULL,NULL,'ToolbarAccess',467,476),(244,243,NULL,NULL,'history_state',468,469),(245,243,NULL,NULL,'sql_explain',470,471),(246,243,NULL,NULL,'forceSSL',472,473),(247,243,NULL,NULL,'admin_change_active_status',474,475),(248,1,NULL,NULL,'AclExtras',478,479),(249,1,NULL,NULL,'Filter',480,481),(250,1,NULL,NULL,'ClearCache',482,483),(251,1,NULL,NULL,'Handleize',484,485),(252,1,NULL,NULL,'Datasources',486,487),(253,1,NULL,NULL,'TinyMce',488,489),(254,1,NULL,NULL,'Uploadify',490,491),(255,1,NULL,NULL,'Recaptcha',492,493),(256,1,NULL,NULL,'Copyable',494,495),(257,1,NULL,NULL,'MeioUpload',496,497),(258,1,NULL,NULL,'Log',498,507),(259,258,NULL,NULL,'Logs',499,506),(260,259,NULL,NULL,'index',500,501),(261,259,NULL,NULL,'forceSSL',502,503),(262,259,NULL,NULL,'admin_change_active_status',504,505),(263,1,NULL,NULL,'CodeCheck',508,509),(264,1,NULL,NULL,'TimeZone',510,511),(265,1,NULL,NULL,'MeioDuplicate',512,513),(266,59,NULL,NULL,'change_qty_for_1_item_in_cart',163,164),(267,59,NULL,NULL,'admin_remove_variant_option',165,166);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `addresses` */

insert  into `addresses`(`id`,`address`,`city`,`region`,`zip_code`,`country`,`customer_id`,`type`,`full_name`) values (1,'asd','asd','asd','asd',192,1,1,'asd'),(2,'asd','asd','asd','asd',192,1,2,'asd'),(3,'asd','asd','asd','asd',192,2,1,'asd'),(4,'asd','asd','asd','asd',192,2,2,'asd'),(5,'asd','asd','asd','asd',1,3,1,'asd'),(6,'asd','asd','asd','asd',1,3,2,'asd'),(7,'asd','asd','asd','asd',192,4,1,'asd'),(8,'asd','asd','asd','asd',192,4,2,'asd'),(9,'asd','asd','asd','asd',192,5,1,'asd'),(10,'asd','asd','asd','asd',192,5,2,'asd'),(11,'asd','asd','asd','asd',192,6,1,'asd'),(12,'asd','asd','asd','asd',192,6,2,'asd');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `aros` */

insert  into `aros`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'Group',1,'administrators',1,2),(2,NULL,'Group',2,'editors',3,4),(3,NULL,'Group',3,'merchants',5,8),(4,NULL,'Group',4,'customers',9,10),(5,NULL,'Group',5,'casual',11,12),(6,3,'User',1,NULL,6,7),(7,NULL,'User',2,NULL,13,14),(8,NULL,'User',3,NULL,15,16);

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
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

/*Data for the table `aros_acos` */

insert  into `aros_acos`(`id`,`aro_id`,`aco_id`,`_create`,`_read`,`_update`,`_delete`) values (1,1,1,'1','1','1','1'),(2,2,3,'1','1','1','1'),(3,2,1,'-1','-1','-1','-1'),(4,2,59,'1','1','1','1'),(5,2,93,'1','1','1','1'),(6,2,213,'1','1','1','1'),(7,2,84,'1','1','1','1'),(8,2,198,'1','1','1','1'),(9,3,1,'-1','-1','-1','-1'),(10,3,3,'1','1','1','1'),(11,3,66,'1','1','1','1'),(12,3,69,'1','1','1','1'),(13,3,71,'1','1','1','1'),(14,3,63,'1','1','1','1'),(15,3,62,'1','1','1','1'),(16,3,67,'1','1','1','1'),(17,3,72,'1','1','1','1'),(18,3,68,'1','1','1','1'),(19,3,133,'1','1','1','1'),(20,3,134,'1','1','1','1'),(21,3,132,'1','1','1','1'),(22,3,136,'1','1','1','1'),(23,3,139,'1','1','1','1'),(24,3,135,'1','1','1','1'),(25,3,140,'1','1','1','1'),(26,3,131,'1','1','1','1'),(27,3,141,'1','1','1','1'),(28,3,143,'1','1','1','1'),(29,3,111,'1','1','1','1'),(30,3,113,'1','1','1','1'),(31,3,114,'1','1','1','1'),(32,3,115,'1','1','1','1'),(33,3,112,'1','1','1','1'),(34,3,147,'1','1','1','1'),(35,3,151,'1','1','1','1'),(36,3,150,'1','1','1','1'),(37,3,152,'1','1','1','1'),(38,3,148,'1','1','1','1'),(39,3,149,'1','1','1','1'),(40,3,153,'1','1','1','1'),(41,3,154,'1','1','1','1'),(42,3,190,'1','1','1','1'),(43,3,191,'1','1','1','1'),(44,3,189,'1','1','1','1'),(45,3,188,'1','1','1','1'),(46,3,87,'1','1','1','1'),(47,3,89,'1','1','1','1'),(48,3,90,'1','1','1','1'),(49,3,86,'1','1','1','1'),(50,3,85,'1','1','1','1'),(51,3,88,'1','1','1','1'),(52,3,29,'1','1','1','1'),(53,3,34,'1','1','1','1'),(54,3,32,'1','1','1','1'),(55,3,35,'1','1','1','1'),(56,3,37,'1','1','1','1'),(57,3,36,'1','1','1','1'),(58,3,38,'1','1','1','1'),(59,3,39,'1','1','1','1'),(60,3,31,'1','1','1','1'),(61,3,95,'1','1','1','1'),(62,3,96,'1','1','1','1'),(63,3,94,'1','1','1','1'),(64,3,7,'1','1','1','1'),(65,3,8,'1','1','1','1'),(66,3,10,'1','1','1','1'),(67,3,12,'1','1','1','1'),(68,3,13,'1','1','1','1'),(69,3,9,'1','1','1','1'),(70,3,11,'1','1','1','1'),(71,3,17,'1','1','1','1'),(72,3,19,'1','1','1','1'),(73,3,20,'1','1','1','1'),(74,3,18,'1','1','1','1'),(75,3,21,'1','1','1','1'),(76,3,176,'1','1','1','1'),(77,3,177,'1','1','1','1'),(78,3,199,'1','1','1','1'),(79,3,208,'1','1','1','1'),(80,3,209,'1','1','1','1'),(81,3,210,'1','1','1','1'),(82,3,206,'1','1','1','1'),(83,3,205,'1','1','1','1'),(84,3,207,'1','1','1','1'),(85,3,125,'1','1','1','1'),(86,3,126,'1','1','1','1'),(87,3,127,'1','1','1','1'),(88,3,124,'1','1','1','1'),(89,3,123,'1','1','1','1'),(90,3,228,'1','1','1','1'),(91,3,229,'1','1','1','1'),(92,3,230,'1','1','1','1'),(93,3,227,'1','1','1','1'),(94,3,231,'1','1','1','1'),(95,4,1,'-1','-1','-1','-1'),(96,4,3,'1','1','1','1'),(97,3,267,'1','1','1','1');

/*Table structure for table `blogs` */

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `short_name` varchar(150) NOT NULL,
  `description` text,
  `theme` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `visible_post_count` int(10) unsigned NOT NULL DEFAULT '0',
  `all_post_count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `blogs` */

insert  into `blogs`(`id`,`title`,`short_name`,`description`,`theme`,`created`,`modified`,`shop_id`,`visible_post_count`,`all_post_count`) values (1,'shop001','shop001',NULL,NULL,'2011-06-20 10:58:09','2011-06-20 10:58:09',2,1,1);

/*Table structure for table `cake_sessions` */

DROP TABLE IF EXISTS `cake_sessions`;

CREATE TABLE `cake_sessions` (
  `id` varchar(255) NOT NULL,
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `cake_sessions` */

insert  into `cake_sessions`(`id`,`data`,`expires`) values ('ldtc4rmclmhnogksc10a308fa4','Config|a:4:{s:9:\"userAgent\";s:32:\"997977d27bf0c17592c26460c3294fea\";s:4:\"time\";i:1308993890;s:7:\"timeout\";i:100;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:3:{s:4:\"Shop\";a:15:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:7:\"shop001\";s:7:\"created\";s:19:\"2011-06-20 10:58:09\";s:8:\"modified\";s:19:\"2011-06-20 10:58:10\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"1\";s:11:\"deny_access\";s:1:\"0\";s:3:\"url\";s:31:\"http://shop001.ombi60.localhost\";s:14:\"primary_domain\";s:31:\"http://shop001.ombi60.localhost\";s:16:\"permanent_domain\";s:24:\"shop001.ombi60.localhost\";s:5:\"email\";s:17:\"owner@shop001.com\";s:17:\"all_product_count\";s:1:\"8\";s:21:\"visible_product_count\";s:1:\"8\";s:19:\"product_group_count\";s:1:\"0\";s:12:\"vendor_count\";s:1:\"0\";}s:6:\"Domain\";a:6:{s:6:\"domain\";s:31:\"http://shop001.ombi60.localhost\";s:2:\"id\";s:1:\"2\";s:7:\"shop_id\";s:1:\"2\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";s:16:\"shop_web_address\";s:1:\"1\";}s:11:\"ShopSetting\";a:10:{s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"2\";s:8:\"timezone\";s:14:\"Asia/Singapore\";s:11:\"unit_system\";s:6:\"metric\";s:8:\"currency\";s:3:\"SGD\";s:27:\"money_in_html_with_currency\";s:11:\"${{amount}}\";s:13:\"money_in_html\";s:10:\"{{amount}}\";s:28:\"money_in_email_with_currency\";s:11:\"${{amount}}\";s:14:\"money_in_email\";s:10:\"{{amount}}\";s:17:\"checkout_language\";s:1:\"1\";}}_Token|s:212:\"a:5:{s:3:\"key\";s:40:\"e4fbafe0d70a4a1691519c451b2dc3629d415c06\";s:7:\"expires\";i:1308998889;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:1:{i:0;s:21:\"ProductImage.filename\";}}\";Message|a:0:{}Shop|a:1:{i:2;a:1:{s:13:\"paymentAmount\";d:0;}}',1308993890),('6n0skulh8br3shk26g97883ps1','Config|a:4:{s:9:\"userAgent\";s:32:\"997977d27bf0c17592c26460c3294fea\";s:4:\"time\";i:1308994318;s:7:\"timeout\";i:100;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:3:{s:4:\"Shop\";a:15:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:7:\"shop001\";s:7:\"created\";s:19:\"2011-06-20 10:58:09\";s:8:\"modified\";s:19:\"2011-06-20 10:58:10\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"1\";s:11:\"deny_access\";s:1:\"0\";s:3:\"url\";s:31:\"http://shop001.ombi60.localhost\";s:14:\"primary_domain\";s:31:\"http://shop001.ombi60.localhost\";s:16:\"permanent_domain\";s:24:\"shop001.ombi60.localhost\";s:5:\"email\";s:17:\"owner@shop001.com\";s:17:\"all_product_count\";s:1:\"8\";s:21:\"visible_product_count\";s:1:\"8\";s:19:\"product_group_count\";s:1:\"0\";s:12:\"vendor_count\";s:1:\"0\";}s:6:\"Domain\";a:6:{s:6:\"domain\";s:31:\"http://shop001.ombi60.localhost\";s:2:\"id\";s:1:\"2\";s:7:\"shop_id\";s:1:\"2\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";s:16:\"shop_web_address\";s:1:\"1\";}s:11:\"ShopSetting\";a:10:{s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"2\";s:8:\"timezone\";s:14:\"Asia/Singapore\";s:11:\"unit_system\";s:6:\"metric\";s:8:\"currency\";s:3:\"SGD\";s:27:\"money_in_html_with_currency\";s:11:\"${{amount}}\";s:13:\"money_in_html\";s:10:\"{{amount}}\";s:28:\"money_in_email_with_currency\";s:11:\"${{amount}}\";s:14:\"money_in_email\";s:10:\"{{amount}}\";s:17:\"checkout_language\";s:1:\"1\";}}_Token|s:212:\"a:5:{s:3:\"key\";s:40:\"2e8eeb12edc1cd03849dee28b61ee3c8e330cb1d\";s:7:\"expires\";i:1308999319;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:1:{i:0;s:21:\"ProductImage.filename\";}}\";Shop|a:1:{i:2;a:1:{s:13:\"paymentAmount\";d:0;}}',1308994320),('h9ndnoupa3ijs2qjrooeo99at4','Config|a:4:{s:9:\"userAgent\";s:32:\"3442fa7b0d6d9d27ad79c277a0c0fa67\";s:4:\"time\";i:1308994534;s:7:\"timeout\";i:100;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:3:{s:4:\"Shop\";a:15:{s:2:\"id\";s:1:\"2\";s:4:\"name\";s:7:\"shop001\";s:7:\"created\";s:19:\"2011-06-20 10:58:09\";s:8:\"modified\";s:19:\"2011-06-20 10:58:10\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"1\";s:11:\"deny_access\";s:1:\"0\";s:3:\"url\";s:31:\"http://shop001.ombi60.localhost\";s:14:\"primary_domain\";s:31:\"http://shop001.ombi60.localhost\";s:16:\"permanent_domain\";s:24:\"shop001.ombi60.localhost\";s:5:\"email\";s:17:\"owner@shop001.com\";s:17:\"all_product_count\";s:1:\"8\";s:21:\"visible_product_count\";s:1:\"8\";s:19:\"product_group_count\";s:1:\"0\";s:12:\"vendor_count\";s:1:\"0\";}s:6:\"Domain\";a:6:{s:6:\"domain\";s:31:\"http://shop001.ombi60.localhost\";s:2:\"id\";s:1:\"2\";s:7:\"shop_id\";s:1:\"2\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";s:16:\"shop_web_address\";s:1:\"1\";}s:11:\"ShopSetting\";a:10:{s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"2\";s:8:\"timezone\";s:14:\"Asia/Singapore\";s:11:\"unit_system\";s:6:\"metric\";s:8:\"currency\";s:3:\"SGD\";s:27:\"money_in_html_with_currency\";s:11:\"${{amount}}\";s:13:\"money_in_html\";s:10:\"{{amount}}\";s:28:\"money_in_email_with_currency\";s:11:\"${{amount}}\";s:14:\"money_in_email\";s:10:\"{{amount}}\";s:17:\"checkout_language\";s:1:\"1\";}}_Token|s:212:\"a:5:{s:3:\"key\";s:40:\"ea0c992e7ab3638417c946e1c4570d60eb829a5c\";s:7:\"expires\";i:1308999533;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:1:{i:0;s:21:\"ProductImage.filename\";}}\";Message|a:0:{}Shop|a:1:{i:2;a:1:{s:13:\"paymentAmount\";d:0;}}',1308994534);

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
  `visible` tinyint(1) unsigned DEFAULT '1',
  `product_title` varchar(255) DEFAULT NULL,
  `product_weight` int(10) unsigned DEFAULT '0',
  `currency` varchar(5) NOT NULL DEFAULT 'SGD',
  `shipping_required` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `previous_price` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `previous_currency` varchar(5) DEFAULT NULL,
  `variant_id` int(12) unsigned DEFAULT NULL,
  `variant_title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `cart_items` */

insert  into `cart_items`(`id`,`cart_id`,`product_id`,`product_price`,`product_quantity`,`visible`,`product_title`,`product_weight`,`currency`,`shipping_required`,`previous_price`,`previous_currency`,`variant_id`,`variant_title`) values (8,2,9,'1.0000',2,1,'ewe',1000,'SGD',1,'1.0000','SGD',9,'Default Title'),(15,3,9,'1.0000',1,1,'ewe',1000,'SGD',1,'1.0000','SGD',9,'Default Title');

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
  `total_weight` decimal(10,0) unsigned NOT NULL DEFAULT '0',
  `currency` varchar(5) NOT NULL DEFAULT 'SGD',
  `shipped_amount` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `shipped_weight` int(10) unsigned NOT NULL DEFAULT '0',
  `past_checkout_point` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `cart_item_count` int(7) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `carts` */

insert  into `carts`(`id`,`shop_id`,`user_id`,`created`,`amount`,`status`,`hash`,`total_weight`,`currency`,`shipped_amount`,`shipped_weight`,`past_checkout_point`,`cart_item_count`) values (2,2,2,'2011-06-22 00:09:20','2.0000',1,'b50c02969d74ad3d627194991fef16478df1ea17','2000','SGD','2.0000',2000,0,1),(3,2,3,'2011-06-25 09:16:01','1.0000',1,'e6d74533b2a6b57cfde3c419d4f7075a02603e0c','1000','SGD','1.0000',1000,0,1);

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

insert  into `casual_surfers`(`id`,`shop_id`,`user_id`) values (1,2,2),(2,2,3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `custom_payment_modules` */

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_code` varchar(255) DEFAULT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `live_cart_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `customers` */

insert  into `customers`(`id`,`identity_code`,`shop_id`,`user_id`,`live_cart_id`) values (1,NULL,3,4,0),(2,NULL,3,5,0),(3,NULL,2,3,0),(4,NULL,2,3,0),(5,NULL,2,4,0),(6,NULL,2,5,0);

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

insert  into `invoices`(`id`,`created`,`title`,`shop_id`,`description`,`payment_number`,`payer_user`,`reference`) values (1,'2011-06-20 10:58:09','starter',2,'Initial signup',NULL,NULL,'2011-06-20-1058-1');

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `locale_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `languages` */

insert  into `languages`(`id`,`name`,`locale_name`) values (1,'English','eng'),(2,'Chinese Taiwan','chi'),(3,'Bahasa Melayu','bahasa-melayu');

/*Table structure for table `link_lists` */

DROP TABLE IF EXISTS `link_lists`;

CREATE TABLE `link_lists` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `deletable` tinyint(1) unsigned DEFAULT '0',
  `link_count` int(3) unsigned DEFAULT '0',
  `handle` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `link_lists` */

insert  into `link_lists`(`id`,`shop_id`,`name`,`deletable`,`link_count`,`handle`) values (1,2,'Main Menu',0,5,'main-menu'),(2,2,'Footer Menu',0,2,'footer-menu');

/*Table structure for table `links` */

DROP TABLE IF EXISTS `links`;

CREATE TABLE `links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `link_list_id` int(11) unsigned DEFAULT NULL,
  `model` varchar(100) DEFAULT '',
  `action` varchar(155) DEFAULT '',
  `order` int(2) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `links` */

insert  into `links`(`id`,`name`,`route`,`link_list_id`,`model`,`action`,`order`) values (1,'Home','/',1,'/','',0),(2,'About Us','/pages/about-us',1,'/pages/','about-us',1),(3,'Catalogue','/collections/all',1,'/collections/all','',2),(4,'Blog','/blogs/shop001',1,'/blogs/','shop001',3),(5,'Cart','/cart',1,'/cart','',4),(6,'Terms of Service','/pages/terms-of-service',2,'/pages/','terms-of-service',0),(7,'About Us','/pages/about-us',2,'/pages/','about-us',1);

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `change` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `logs` */

insert  into `logs`(`id`,`title`,`created`,`description`,`model`,`model_id`,`action`,`user_id`,`change`) values (1,'Dummy Product','2011-06-20 10:58:10','Product \"Dummy Product\" (2) added by System.','Product',2,'add',0,'price, visible, weight, currency, shipping_required, vendor_id, product_type_id, shop_id, title, handle, created'),(2,'Dummy Product','2011-06-20 10:58:11','Product (2) updated by System.','Product',2,'edit',0,'shop_id, vendor_id, product_type_id'),(3,'test1','2011-06-21 09:16:59','Product \"test1\" (3) added by System.','Product',3,'add',0,'shop_id, title, code, visible, shipping_required, currency, price, created, handle, weight'),(4,'Dummy Product','2011-06-21 09:26:19','Product \"Dummy Product\" (2) updated by System.','Product',2,'edit',0,'shop_id, price'),(5,'Dummy Product','2011-06-21 09:31:19','Product \"Dummy Product\" (2) updated by System.','Product',2,'edit',0,'shop_id'),(6,'test shirt 1','2011-06-23 12:21:05','Product \"test shirt 1\" (4) added by System.','Product',4,'add',0,'shop_id, title, description, visible, shipping_required, currency, price, created, handle, weight'),(7,'das','2011-06-23 12:22:08','Product \"das\" (5) added by System.','Product',5,'add',0,'shop_id, title, description, visible, shipping_required, currency, price, created, handle, weight'),(8,'test again','2011-06-23 12:27:52','Product \"test again\" (6) added by System.','Product',6,'add',0,'shop_id, title, description, visible, shipping_required, currency, price, created, handle, weight'),(9,'das','2011-06-23 12:57:59','Product \"das\" (7) added by System.','Product',7,'add',0,'shop_id, title, description, visible, shipping_required, currency, price, created, handle, weight'),(10,'maroon','2011-06-23 14:04:51','Product \"maroon\" (8) added by System.','Product',8,'add',0,'shop_id, title, description, code, visible, shipping_required, currency, price, created, handle, weight'),(11,'ewe','2011-06-23 14:05:47','Product \"ewe\" (9) added by System.','Product',9,'add',0,'shop_id, title, description, code, visible, shipping_required, currency, price, created, handle, weight');

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
  `product_weight` int(10) unsigned DEFAULT '0',
  `currency` varchar(5) NOT NULL DEFAULT 'SGD',
  `shipping_required` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `variant_id` int(12) unsigned NOT NULL,
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
  `fulfillment_status` tinyint(2) DEFAULT '1',
  `shipped_weight` int(10) unsigned DEFAULT '0',
  `shipped_amount` decimal(10,4) unsigned DEFAULT NULL,
  `currency` varchar(5) NOT NULL DEFAULT 'SGD',
  `total_weight` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `past_checkout_point` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `contact_email` varchar(255) DEFAULT '',
  `order_line_item_count` int(5) unsigned DEFAULT '0',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payments` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

/*Table structure for table `paypal_payers_payments` */

DROP TABLE IF EXISTS `paypal_payers_payments`;

CREATE TABLE `paypal_payers_payments` (
  `id` char(36) NOT NULL,
  `paypal_payer_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `paypal_payers_payments` */

/*Table structure for table `paypal_payment_modules` */

DROP TABLE IF EXISTS `paypal_payment_modules`;

CREATE TABLE `paypal_payment_modules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shop_payment_module_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `account_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_spm` (`shop_payment_module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `paypal_payment_modules` */

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(10) DEFAULT NULL,
  `author_id` int(10) DEFAULT NULL,
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `content` text,
  `no_comments` int(4) NOT NULL DEFAULT '0',
  `allow_comments` tinyint(1) NOT NULL DEFAULT '1',
  `allow_pingback` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `posts` */

insert  into `posts`(`id`,`blog_id`,`author_id`,`visible`,`title`,`slug`,`content`,`no_comments`,`allow_comments`,`allow_pingback`,`created`,`modified`,`published`) values (1,1,1,1,'Open for business!','open-for-business','We are OPEN for business!!',0,1,1,'2011-06-20 10:58:09','2011-06-20 10:58:09',NULL);

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

/*Table structure for table `product_groups` */

DROP TABLE IF EXISTS `product_groups`;

CREATE TABLE `product_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `shop_id` int(11) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `description` text,
  `all_product_count` int(7) unsigned DEFAULT '0',
  `handle` varchar(150) DEFAULT NULL,
  `vendor_count` int(7) unsigned DEFAULT '0',
  `visible` tinyint(1) unsigned DEFAULT '1',
  `type` tinyint(1) unsigned DEFAULT '0',
  `visible_product_count` int(7) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `product_groups` */

insert  into `product_groups`(`id`,`title`,`shop_id`,`created`,`modified`,`description`,`all_product_count`,`handle`,`vendor_count`,`visible`,`type`,`visible_product_count`) values (1,'Frontpage',2,'2011-06-20 10:58:11','2011-06-24 14:16:43',NULL,1,'frontpage',0,1,0,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`cover`,`created`,`modified`,`filename`,`dir`,`mimetype`,`filesize`) values (1,1,1,'2010-05-20 07:59:19','2010-05-20 07:59:19','default.jpg','uploads\\products','image/jpeg',6103),(2,2,1,'2011-06-20 10:58:10','2011-06-20 10:58:10','default-0.jpg','uploads/products','image/jpeg',6103),(3,3,1,'2011-06-21 09:16:59','2011-06-21 09:16:59','wal_mart_t_shirt_for_web.jpg','uploads/products','image/jpeg',14479),(4,5,1,'2011-06-23 12:22:08','2011-06-23 12:22:08','t_shirt_with_logo.gif','uploads/products','image/gif',14477),(5,5,0,'2011-06-23 12:22:12','2011-06-23 12:22:12','Superman_Shield_t_shirt.jpg','uploads/products','image/jpeg',26190),(6,6,1,'2011-06-23 12:27:52','2011-06-23 12:27:52','panel_sports_t_shirt.jpg','uploads/products','image/jpeg',10819),(7,6,0,'2011-06-23 12:27:52','2011-06-23 12:27:52','t_shirt_with_logo-0.gif','uploads/products','image/gif',14477),(8,7,1,'2011-06-23 12:57:59','2011-06-23 12:57:59','8cb42ecccafe.jpg','uploads/products','image/jpeg',25926),(9,6,0,'2011-06-23 12:58:09','2011-06-23 12:58:09','images.jpg','uploads/products','image/jpeg',5257),(10,6,0,'2011-06-23 12:58:21','2011-06-23 12:58:21','8cb42ecccafe-0.jpg','uploads/products','image/jpeg',25926),(11,8,1,'2011-06-23 14:04:51','2011-06-23 14:04:51','panel_sports_t_shirt-0.jpg','uploads/products','image/jpeg',10819),(12,9,1,'2011-06-23 14:05:47','2011-06-23 14:05:47','8cb42ecccafe-1.jpg','uploads/products','image/jpeg',25926);

/*Table structure for table `product_options` */

DROP TABLE IF EXISTS `product_options`;

CREATE TABLE `product_options` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `order` tinyint(2) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `product_options` */

/*Table structure for table `product_types` */

DROP TABLE IF EXISTS `product_types`;

CREATE TABLE `product_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `handle` varchar(150) DEFAULT NULL,
  `visible_product_count` int(7) unsigned DEFAULT '0',
  `all_product_count` int(7) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `product_types` */

insert  into `product_types`(`id`,`shop_id`,`created`,`modified`,`title`,`handle`,`visible_product_count`,`all_product_count`) values (1,2,'2011-06-20 10:58:10','2011-06-20 10:58:10','Shirts','shirts',1,1);

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
  `visible` tinyint(1) unsigned DEFAULT '1',
  `weight` int(10) unsigned DEFAULT '0',
  `currency` varchar(5) NOT NULL DEFAULT 'SGD',
  `shipping_required` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `vendor_id` int(10) unsigned DEFAULT '0',
  `handle` varchar(150) DEFAULT NULL,
  `product_type_id` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `products` */

insert  into `products`(`id`,`shop_id`,`title`,`code`,`description`,`price`,`created`,`modified`,`visible`,`weight`,`currency`,`shipping_required`,`vendor_id`,`handle`,`product_type_id`) values (1,1,'Dummy Product',NULL,NULL,'0.0000','2010-05-20 08:00:24','2010-05-20 08:00:24',1,7000,'SGD',1,0,NULL,0),(2,2,'Dummy Product','','','2.0000','2011-06-20 10:58:10','2011-06-24 14:16:43',1,7000,'SGD',1,1,'dummy-product',1),(3,2,'test1','asd','','1.0000','2011-06-21 09:16:59','2011-06-21 09:16:59',1,1000,'SGD',1,0,'test1',0),(4,2,'test shirt 1','','<p>asd</p>','1.0000','2011-06-23 12:21:05','2011-06-23 12:21:05',1,1000,'SGD',1,0,'test-shirt-1',0),(5,2,'das','','<p>ads</p>','2.0000','2011-06-23 12:22:07','2011-06-24 14:12:49',1,2000,'SGD',1,0,'das',0),(6,2,'test again','','<p>asd</p>','2.0000','2011-06-23 12:27:52','2011-06-24 14:03:55',1,2000,'SGD',1,0,'test-again',0),(7,2,'das','','<p>dasdasd</p>','1.0000','2011-06-23 12:57:59','2011-06-23 12:57:59',1,1000,'SGD',1,0,'das-1',0),(8,2,'maroon','ads','<p>asd</p>','1.0000','2011-06-23 14:04:51','2011-06-23 14:04:51',1,1000,'SGD',1,0,'maroon',0),(9,2,'ewe','wewe','<p>ewew</p>','1.0000','2011-06-23 14:05:47','2011-06-23 14:05:47',1,1000,'SGD',1,0,'ewe',0);

/*Table structure for table `products_in_groups` */

DROP TABLE IF EXISTS `products_in_groups`;

CREATE TABLE `products_in_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `product_group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `products_in_groups` */

insert  into `products_in_groups`(`id`,`product_id`,`product_group_id`) values (1,2,1);

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

insert  into `recurring_payment_profiles`(`id`,`gateway`,`method`,`shop_id`,`gateway_reference_id`,`created`,`modified`,`status`) values (1,'paydollar','AddSchPay API',2,'11370','2011-06-20 10:58:18','2011-06-20 10:58:18','active');

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

insert  into `saved_themes`(`id`,`name`,`description`,`author`,`created`,`modified`,`folder_name`,`shop_id`,`theme_id`,`featured`) values (1,'default','default','asd','2011-06-20 10:58:10','2011-06-20 10:58:10','2Cover',2,3,1);

/*Table structure for table `shipments` */

DROP TABLE IF EXISTS `shipments`;

CREATE TABLE `shipments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `completed` tinyint(1) unsigned DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `price` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000',
  `description` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `shipments` */

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

/*Table structure for table `shop_settings` */

DROP TABLE IF EXISTS `shop_settings`;

CREATE TABLE `shop_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) unsigned DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `unit_system` varchar(50) DEFAULT 'metric',
  `currency` varchar(100) DEFAULT NULL,
  `money_in_html_with_currency` varchar(255) DEFAULT NULL,
  `money_in_html` varchar(255) DEFAULT NULL,
  `money_in_email_with_currency` varchar(255) DEFAULT NULL,
  `money_in_email` varchar(255) DEFAULT NULL,
  `checkout_language` int(3) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `shop_settings` */

insert  into `shop_settings`(`id`,`shop_id`,`timezone`,`unit_system`,`currency`,`money_in_html_with_currency`,`money_in_html`,`money_in_email_with_currency`,`money_in_email`,`checkout_language`) values (1,2,'Asia/Singapore','metric','SGD','${{amount}}','{{amount}}','${{amount}}','{{amount}}',1);

/*Table structure for table `shops` */

DROP TABLE IF EXISTS `shops`;

CREATE TABLE `shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `saved_theme_id` int(11) DEFAULT '0',
  `deny_access` tinyint(1) unsigned DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `primary_domain` varchar(255) DEFAULT NULL,
  `permanent_domain` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `all_product_count` int(7) unsigned DEFAULT '0',
  `visible_product_count` int(7) unsigned DEFAULT '0',
  `product_group_count` int(7) unsigned DEFAULT '0',
  `vendor_count` int(7) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `shops` */

insert  into `shops`(`id`,`name`,`created`,`modified`,`status`,`saved_theme_id`,`deny_access`,`url`,`primary_domain`,`permanent_domain`,`email`,`all_product_count`,`visible_product_count`,`product_group_count`,`vendor_count`) values (1,'a',NULL,NULL,1,0,0,NULL,'http://a.ombi60.com/',NULL,NULL,1,1,0,0),(2,'shop001','2011-06-20 10:58:09','2011-06-20 10:58:10',1,1,0,'http://shop001.ombi60.localhost','http://shop001.ombi60.localhost','shop001.ombi60.localhost','owner@shop001.com',8,8,0,0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `shops_payment_modules` */

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

/*Table structure for table `smart_collection_conditions` */

DROP TABLE IF EXISTS `smart_collection_conditions`;

CREATE TABLE `smart_collection_conditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `smart_collection_id` int(11) NOT NULL,
  `field` varchar(25) CHARACTER SET latin1 NOT NULL,
  `relation` varchar(25) CHARACTER SET latin1 NOT NULL,
  `condition` varchar(25) CHARACTER SET latin1 NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `smart_collection_conditions` */

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
  `live_cart_id` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`group_id`,`full_name`,`name_to_call`,`last_login_on`,`status`,`created`,`modified`,`language_id`,`live_cart_id`) values (1,'owner@shop001.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'asd','asd',NULL,1,'2011-06-20 10:58:09','2011-06-20 10:58:09',1,0),(2,'e417b$op@ombi60.com','4b91e3050ad7c9fafde64a5a1dfb235ee7594e86',5,'casual','casual',NULL,1,'2011-06-20 13:31:44','2011-06-24 01:14:33',1,2),(3,'zkej$6b1@ombi60.com','a07709a7cd88efe261ab58ec79680d2a71eae3b8',5,'casual','casual',NULL,1,'2011-06-25 09:15:55','2011-06-25 09:16:01',1,3);

/*Table structure for table `variant_options` */

DROP TABLE IF EXISTS `variant_options`;

CREATE TABLE `variant_options` (
  `id` int(14) unsigned NOT NULL AUTO_INCREMENT,
  `variant_id` int(12) unsigned DEFAULT NULL,
  `field` varchar(100) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `order` tinyint(2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `variant_options` */

insert  into `variant_options`(`id`,`variant_id`,`field`,`value`,`order`) values (1,1,'Title','Default Title',0),(28,2,'title','2',NULL),(3,3,'Title','Default Title',0),(26,5,'title','Default Title',NULL),(7,7,'Title','Default Title',0),(8,8,'Title','Default Title',0),(9,9,'Title','Default Title',0),(27,2,'style','Default Value',NULL),(19,6,'title','Default Value',NULL),(25,5,'color','Default Value',NULL),(29,2,'title','Default Value',NULL);

/*Table structure for table `variants` */

DROP TABLE IF EXISTS `variants`;

CREATE TABLE `variants` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `sku_code` varchar(100) DEFAULT NULL,
  `weight` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `shipping_required` tinyint(1) unsigned DEFAULT '1',
  `price` decimal(10,4) unsigned DEFAULT NULL,
  `order` int(2) unsigned DEFAULT NULL,
  `compare_with_price` decimal(10,4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `variants` */

insert  into `variants`(`id`,`title`,`product_id`,`sku_code`,`weight`,`created`,`modified`,`currency`,`shipping_required`,`price`,`order`,`compare_with_price`) values (1,'Default Title',1,NULL,7000,NULL,NULL,'SGD',1,'0.0000',1,NULL),(2,'Default Title',2,NULL,7000,'2011-06-20 10:58:10','2011-06-20 10:58:10','SGD',1,'0.0000',1,NULL),(3,'Default Title',3,'asd',1000,'2011-06-21 09:16:59','2011-06-21 09:16:59','SGD',1,'1.0000',0,NULL),(4,'Default Title',4,'',1000,'2011-06-23 12:21:05','2011-06-23 12:21:05','SGD',1,'1.0000',0,NULL),(5,'Default Title',5,'',2000,'2011-06-23 12:22:08','2011-06-23 12:22:08','SGD',1,'2.0000',0,NULL),(6,'Default Title',6,'',2000,'2011-06-23 12:27:52','2011-06-23 12:27:52','SGD',1,'2.0000',0,NULL),(7,'Default Title',7,'',1000,'2011-06-23 12:58:00','2011-06-23 12:58:00','SGD',1,'1.0000',0,NULL),(8,'Default Title',8,'ads',1000,'2011-06-23 14:04:52','2011-06-23 14:04:52','SGD',1,'1.0000',0,NULL),(9,'Default Title',9,'wewe',1000,'2011-06-23 14:05:48','2011-06-23 14:05:48','SGD',1,'1.0000',0,NULL);

/*Table structure for table `vendors` */

DROP TABLE IF EXISTS `vendors`;

CREATE TABLE `vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `handle` varchar(150) DEFAULT NULL,
  `visible_product_count` int(7) unsigned DEFAULT '0',
  `all_product_count` int(7) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `vendors` */

insert  into `vendors`(`id`,`shop_id`,`created`,`modified`,`title`,`handle`,`visible_product_count`,`all_product_count`) values (1,2,'2011-06-20 10:58:10','2011-06-20 10:58:10','OMBI60','ombi60',1,1);

/*Table structure for table `webpages` */

DROP TABLE IF EXISTS `webpages`;

CREATE TABLE `webpages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `meta_title` text,
  `meta_keywords` text,
  `meta_description` text,
  `author` int(11) DEFAULT NULL,
  `real_author` int(11) DEFAULT NULL,
  `handle` varchar(150) DEFAULT NULL,
  `visible` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `webpages` */

insert  into `webpages`(`id`,`shop_id`,`title`,`content`,`created`,`modified`,`meta_title`,`meta_keywords`,`meta_description`,`author`,`real_author`,`handle`,`visible`) values (1,1,'welcome','<div class=\"item\">\r\n		\r\n<table class=\"itemTable\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"itemLeftCell\">\r\n					Lorem ipsum dolor sit amet, consectetur \r\n					adipiscing elit. <a href=\"#\">Sed semper est sed</a> eros sodales \r\n					in lacinia dolor egestas. Integer seper imperdiet enim eu \r\n					convallis. Suspendisse nec orci tellus. Aenean consectetur \r\n					venenatis gravida. Suspendisse et ipsum nisl. Nam quis libero a \r\n					nibh mollis lobortis. Ut venenatis tortor tellus. In ac magna \r\n					quam. Etiam ac risus magna, nec pretium diam. <a href=\"#\">\r\n					Phasellus euismod</a> \r\n					leo at leo vestibulum dapibus. Quisque sit amet nibh ut nisi \r\n					congue gravida nec nec ligula. Morbi feugiat mattis volutpat. \r\n					Praesent aliquet sem sit amet massa scelerisque vitae semper \r\n					purus varius. Pellentesque habitant morbi tristique senectus et \r\n					netus et malesuada fames ac turpis egestas.\r\n				</td>\r\n<td class=\"itemRightCell\">\r\n					<img src=\"user_generated_content/images/Jellyfish.jpg\" alt=\"Picture 1\" width=\"192\" height=\"144\" />\r\n				</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<div class=\"itemAlt\">\r\n		\r\n<table class=\"itemTable\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"itemLeftCell\">\r\n					Proin mauris tortor, ultricies \r\n					interdum posuere eu, placerat vitae orci. Duis non laoreet \r\n					libero. Suspendisse aliquam congue metus non elementum. Cras \r\n					quis bibendum lorem. Quisque cursus aliquam mattis. Sed id orci \r\n					tortor. Suspendisse potenti. Nulla luctus interdum massa in \r\n					malesuada. Fusce mi magna, gravida a pretium quis, ultrices vel \r\n					orci. <a href=\"#\">Nullam sollicitudin</a> nibh ac dolor tempor \r\n					porttitor. Curabitur id lacus vitae ipsum rhoncus varius. Class \r\n					aptent taciti sociosqu ad litora torquent per conubia nostra, \r\n					per inceptos himenaeos. Nunc pharetra eros et dui adipiscing \r\n					ultrices. Nunc eros lectus, bibendum eu consequat id, \r\n					<a href=\"#\">cursus non quam</a>. Nam vel dolor dolor. \r\n					Pellentesque ante tortor, mattis auctor condimentum ut, \r\n					convallis a dui. Mauris scelerisque dapibus libero, vitae \r\n					facilisis tellus mattis a. Pellentesque metus nulla, tristique \r\n					at venenatis et, egestas a diam.\r\n				</td>\r\n<td class=\"itemRightCell\">\r\n					<img src=\"user_generated_content/images/Koala.jpg\" alt=\"Picture 2\" width=\"192\" height=\"144\" />\r\n				</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<div class=\"item\">\r\n		\r\n<table class=\"itemTable\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"itemLeftCell\">\r\n					Nulla auctor sapien lorem. Ut vitae \r\n					euismod elit. Ut sit amet sagittis felis. Cras sollicitudin quam \r\n					eu magna tempus eleifend. Donec interdum interdum lacus eget \r\n					iaculis. Nulla facilisi. Phasellus <a href=\"#\">eget lacus auctor</a> \r\n					nibh rhoncus condimentum. Fusce volutpat, felis vel tincidunt \r\n					pellentesque, orci lorem vestibulum elit, ac tristique justo \r\n					magna at ante. <a href=\"#\">Lorem ipsum</a> dolor sit amet, \r\n					consectetur adipiscing elit. Curabitur rutrum interdum tempus. \r\n					Nunc et sapien eros, et ultrices elit. <a href=\"#\">Maecenas in \r\n					leo dui</a>, sit amet iaculis lectus. Duis lacinia, velit ut \r\n					vehicula dictum, eros sem ultricies tortor, ac faucibus dui dui \r\n					et enim. Phasellus feugiat faucibus elit, eget ultrices lacus \r\n					fringilla sit amet. Vivamus faucibus nisl a enim lacinia \r\n					venenatis. In tincidunt tincidunt dolor vel rutrum. Donec vitae \r\n					orci ut nibh tristique laoreet.\r\n				</td>\r\n<td class=\"itemRightCell\">\r\n					<img src=\"user_generated_content/images/Hydrangeas.jpg\" alt=\"Picture 3\" width=\"192\" height=\"144\" />\r\n				</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>','2010-09-01 11:38:15','2010-12-22 02:15:17',NULL,NULL,NULL,1,NULL,'shopfront',1),(2,2,'Welcome','<div>\n                                <h2>Welcome</h2>\n                                <p>Congratulations on starting your own e-commerce store and on your way towards buiding a business empire!</p>\n                                <p>This is the front page of your store - the first thing your customers will see when they arrive</p>\n                                <p>To start adding products or edit this page, head over to <a href=\"/\">Admin</a></p>\n                                <p>Enjoy our services, <br />\n                                Team OMBI60</p>\n                                </div>','2011-06-20 10:58:09','2011-06-20 10:58:09',NULL,NULL,NULL,1,NULL,'welcome',1),(3,2,'About Us','<p>The <strong>About Us</strong> page is important.</p>\n				     <p>Customers visit About Us page when they are new to your online shop. They want to establish a level of trust in your business.  Since trust is crucial when selling online, it\'s a good idea to provide a fair amount of information about yourself and your business.  Here are a few things you should touch on:</p>\n<ul>\n	\n  <li>Who you are</li>\n	\n  <li>Why you are selling these items</li>\n	\n  <li>Where your business is located</li>\n	\n  <li>How long you have been in business</li>\n	\n  <li>Who are the people on your team</li>\n</ul>\n<p>Go to the <a href=\"/admin/pages\">Blogs &amp; Pages</a> in administration menu.</p>','2011-06-20 10:58:09','2011-06-20 10:58:09',NULL,NULL,NULL,1,NULL,'about-us',1),(4,2,'Terms of Service','<p>The <strong>Terms of Service</strong> page is for you to enter any privacy statements or terms of service you wish to render.</p>\n				     <p>Customers may need to know the limits of their patronage, so here are a few things you should touch on:</p>\n<ul>\n	\n  <li>Who you are</li>\n	\n  <li>What you would consider as acceptable customer behavior</li>\n	\n  <li>Any limits as to whom you can serve or which regions you can serve</li>\n	\n  <li>What legal recourses you would seek if customers abuse your service</li>\n  \n  <li>What rights you reserve as a business owner</li>\n</ul>\n<p>Go to the <a href=\"/admin/pages\">Blogs &amp; Pages</a> in administration menu.</p>','2011-06-20 10:58:09','2011-06-20 10:58:09',NULL,NULL,NULL,1,NULL,'terms-of-service',1);

/*Table structure for table `weight_based_rates` */

DROP TABLE IF EXISTS `weight_based_rates`;

CREATE TABLE `weight_based_rates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `min_weight` int(10) unsigned NOT NULL DEFAULT '0',
  `max_weight` int(10) unsigned DEFAULT NULL,
  `shipping_rate_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `weight_based_rates` */

insert  into `weight_based_rates`(`id`,`min_weight`,`max_weight`,`shipping_rate_id`) values (1,10000,20000,1),(2,20000,50000,2),(3,10,20,3),(4,20,50,4),(5,10,20,5),(6,20,50,6);

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


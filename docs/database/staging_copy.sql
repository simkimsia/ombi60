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
) ENGINE=InnoDB AUTO_INCREMENT=462 DEFAULT CHARSET=utf8;

/*Data for the table `acos` */

insert  into `acos`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,NULL,NULL,'controllers',1,448),(2,1,NULL,NULL,'Pages',2,7),(3,2,NULL,NULL,'display',3,4),(9,1,NULL,NULL,'Addresses',8,13),(10,9,NULL,NULL,'index',9,10),(21,1,NULL,NULL,'Customers',14,23),(27,1,NULL,NULL,'Groups',24,29),(28,27,NULL,NULL,'parentNode',25,26),(47,1,NULL,NULL,'Merchants',30,51),(48,47,NULL,NULL,'register',31,32),(51,47,NULL,NULL,'admin_index',33,34),(53,47,NULL,NULL,'platform_index',35,36),(54,47,NULL,NULL,'platform_view',37,38),(55,47,NULL,NULL,'platform_edit',39,40),(56,47,NULL,NULL,'platform_delete',41,42),(61,1,NULL,NULL,'Orders',52,75),(62,61,NULL,NULL,'index',53,54),(63,61,NULL,NULL,'view',55,56),(64,61,NULL,NULL,'add',57,58),(73,1,NULL,NULL,'Payments',76,89),(79,1,NULL,NULL,'Products',90,133),(80,79,NULL,NULL,'admin_index',91,92),(81,79,NULL,NULL,'index',93,94),(82,79,NULL,NULL,'view',95,96),(86,1,NULL,NULL,'ProductImages',134,149),(92,1,NULL,NULL,'Shops',150,155),(98,1,NULL,NULL,'Users',156,175),(99,98,NULL,NULL,'parentNode',157,158),(104,98,NULL,NULL,'login',159,160),(105,98,NULL,NULL,'logout',161,162),(106,98,NULL,NULL,'platform_login',163,164),(107,98,NULL,NULL,'platform_logout',165,166),(108,98,NULL,NULL,'platform_index',167,168),(115,98,NULL,NULL,'afterSave',169,170),(116,1,NULL,NULL,'Webpages',176,191),(118,116,NULL,NULL,'view',177,178),(122,116,NULL,NULL,'admin_index',179,180),(123,116,NULL,NULL,'admin_view',181,182),(124,116,NULL,NULL,'admin_add',183,184),(125,116,NULL,NULL,'admin_edit',185,186),(126,116,NULL,NULL,'admin_delete',187,188),(137,79,NULL,NULL,'admin_view',97,98),(138,79,NULL,NULL,'admin_add',99,100),(139,79,NULL,NULL,'admin_edit',101,102),(140,79,NULL,NULL,'admin_delete',103,104),(141,79,NULL,NULL,'platform_index',105,106),(142,79,NULL,NULL,'platform_view',107,108),(143,79,NULL,NULL,'platform_add',109,110),(144,79,NULL,NULL,'platform_edit',111,112),(145,79,NULL,NULL,'platform_delete',113,114),(149,98,NULL,NULL,'initDB',171,172),(154,86,NULL,NULL,'admin_add',135,136),(156,86,NULL,NULL,'admin_delete',137,138),(157,21,NULL,NULL,'register',15,16),(158,21,NULL,NULL,'login',17,18),(159,21,NULL,NULL,'logout',19,20),(160,1,NULL,NULL,'Domains',192,207),(161,160,NULL,NULL,'admin_index',193,194),(162,160,NULL,NULL,'admin_view',195,196),(163,160,NULL,NULL,'admin_add',197,198),(164,160,NULL,NULL,'admin_edit',199,200),(165,160,NULL,NULL,'admin_delete',201,202),(173,1,NULL,NULL,'Themes',208,213),(293,1,NULL,NULL,'AclExtras',214,215),(294,1,NULL,NULL,'CodeCheck',216,217),(296,1,NULL,NULL,'Linkable',218,219),(297,1,NULL,NULL,'MeioUpload',220,221),(298,79,NULL,NULL,'admin_duplicate',115,116),(299,86,NULL,NULL,'admin_list_by_product',139,140),(300,1,NULL,NULL,'Copyable',222,223),(301,1,NULL,NULL,'MeioDuplicate',224,225),(302,86,NULL,NULL,'admin_change_active_status',141,142),(303,1,NULL,NULL,'Recaptcha',226,227),(304,2,NULL,NULL,'admin_change_active_status',5,6),(305,9,NULL,NULL,'admin_change_active_status',11,12),(307,21,NULL,NULL,'admin_change_active_status',21,22),(308,160,NULL,NULL,'admin_change_active_status',203,204),(309,27,NULL,NULL,'admin_change_active_status',27,28),(310,47,NULL,NULL,'admin_change_active_status',43,44),(311,61,NULL,NULL,'admin_change_active_status',59,60),(313,73,NULL,NULL,'admin_change_active_status',77,78),(314,79,NULL,NULL,'admin_change_active_status',117,118),(315,86,NULL,NULL,'admin_add_by_product',143,144),(316,86,NULL,NULL,'admin_make_this_cover',145,146),(317,92,NULL,NULL,'admin_change_active_status',151,152),(318,173,NULL,NULL,'admin_change_active_status',209,210),(319,98,NULL,NULL,'admin_change_active_status',173,174),(320,116,NULL,NULL,'admin_change_active_status',189,190),(322,61,NULL,NULL,'checkout',61,62),(323,79,NULL,NULL,'view_cart',119,120),(324,79,NULL,NULL,'edit_quantities_in_cart',121,122),(325,79,NULL,NULL,'add_to_cart',123,124),(326,79,NULL,NULL,'delete_from_cart',125,126),(327,1,NULL,NULL,'RandomString',228,229),(328,1,NULL,NULL,'ClearCache',230,231),(329,73,NULL,NULL,'admin_index',79,80),(330,73,NULL,NULL,'admin_update_settings',81,82),(331,61,NULL,NULL,'admin_index',63,64),(332,61,NULL,NULL,'admin_view',65,66),(335,61,NULL,NULL,'paypal',67,68),(337,79,NULL,NULL,'checkout',127,128),(339,1,NULL,NULL,'Filter',232,233),(340,1,NULL,NULL,'Rest',234,235),(341,1,NULL,NULL,'Paypal',236,237),(342,1,NULL,NULL,'Datasources',238,239),(343,1,NULL,NULL,'Blogs',240,255),(344,343,NULL,NULL,'view',241,242),(345,343,NULL,NULL,'admin_index',243,244),(346,343,NULL,NULL,'admin_view',245,246),(347,343,NULL,NULL,'admin_add',247,248),(348,343,NULL,NULL,'admin_edit',249,250),(349,343,NULL,NULL,'admin_delete',251,252),(350,343,NULL,NULL,'admin_change_active_status',253,254),(351,1,NULL,NULL,'GiftCards',256,279),(352,351,NULL,NULL,'index',257,258),(353,351,NULL,NULL,'view',259,260),(354,351,NULL,NULL,'add',261,262),(355,351,NULL,NULL,'edit',263,264),(356,351,NULL,NULL,'delete',265,266),(357,351,NULL,NULL,'admin_index',267,268),(358,351,NULL,NULL,'admin_view',269,270),(359,351,NULL,NULL,'admin_add',271,272),(360,351,NULL,NULL,'admin_edit',273,274),(361,351,NULL,NULL,'admin_delete',275,276),(362,351,NULL,NULL,'admin_change_active_status',277,278),(363,1,NULL,NULL,'SavedThemes',280,303),(364,363,NULL,NULL,'admin_index',281,282),(365,363,NULL,NULL,'admin_view',283,284),(366,363,NULL,NULL,'admin_add',285,286),(367,363,NULL,NULL,'admin_upload',287,288),(368,363,NULL,NULL,'admin_edit',289,290),(369,363,NULL,NULL,'admin_delete',291,292),(370,363,NULL,NULL,'admin_edit_image',293,294),(371,363,NULL,NULL,'admin_feature',295,296),(372,363,NULL,NULL,'admin_delete_image',297,298),(373,363,NULL,NULL,'admin_edit_css',299,300),(374,363,NULL,NULL,'admin_change_active_status',301,302),(375,79,NULL,NULL,'admin_upload',129,130),(376,79,NULL,NULL,'admin_toggle',131,132),(377,73,NULL,NULL,'admin_add_custom_payment',83,84),(378,73,NULL,NULL,'admin_edit_custom_payment',85,86),(379,73,NULL,NULL,'admin_delete_custom_payment',87,88),(380,1,NULL,NULL,'ShippingRates',304,317),(381,380,NULL,NULL,'admin_index',305,306),(382,380,NULL,NULL,'admin_edit',307,308),(383,380,NULL,NULL,'admin_add_price_based',309,310),(384,380,NULL,NULL,'admin_add_weight_based',311,312),(385,380,NULL,NULL,'admin_delete',313,314),(386,380,NULL,NULL,'admin_change_active_status',315,316),(387,86,NULL,NULL,'admin_uploadify',147,148),(388,1,NULL,NULL,'Posts',318,331),(389,388,NULL,NULL,'view',319,320),(390,388,NULL,NULL,'admin_view',321,322),(391,388,NULL,NULL,'admin_add',323,324),(392,388,NULL,NULL,'admin_edit',325,326),(393,388,NULL,NULL,'admin_delete',327,328),(394,388,NULL,NULL,'admin_change_active_status',329,330),(395,173,NULL,NULL,'admin_index',211,212),(396,1,NULL,NULL,'DebugKit',332,341),(397,396,NULL,NULL,'ToolbarAccess',333,340),(398,397,NULL,NULL,'history_state',334,335),(399,397,NULL,NULL,'sql_explain',336,337),(400,397,NULL,NULL,'admin_change_active_status',338,339),(401,1,NULL,NULL,'LilBlogs',342,429),(402,401,NULL,NULL,'Categories',343,358),(403,402,NULL,NULL,'admin_index',344,345),(404,402,NULL,NULL,'admin_add',346,347),(405,402,NULL,NULL,'admin_edit',348,349),(406,402,NULL,NULL,'admin_delete',350,351),(407,402,NULL,NULL,'parseUrl',352,353),(408,402,NULL,NULL,'error404',354,355),(409,402,NULL,NULL,'admin_change_active_status',356,357),(410,401,NULL,NULL,'Blogs',359,374),(411,410,NULL,NULL,'view',360,361),(412,410,NULL,NULL,'admin_index',362,363),(413,410,NULL,NULL,'admin_view',364,365),(414,410,NULL,NULL,'admin_add',366,367),(415,410,NULL,NULL,'admin_edit',368,369),(416,410,NULL,NULL,'admin_delete',370,371),(417,410,NULL,NULL,'admin_change_active_status',372,373),(418,401,NULL,NULL,'Comments',375,394),(419,418,NULL,NULL,'index',376,377),(420,418,NULL,NULL,'admin_edit',378,379),(421,418,NULL,NULL,'admin_delete',380,381),(422,418,NULL,NULL,'admin_index',382,383),(423,418,NULL,NULL,'admin_quick',384,385),(424,418,NULL,NULL,'admin_categorize',386,387),(425,418,NULL,NULL,'parseUrl',388,389),(426,418,NULL,NULL,'error404',390,391),(427,418,NULL,NULL,'admin_change_active_status',392,393),(428,401,NULL,NULL,'Authors',395,414),(429,428,NULL,NULL,'login',396,397),(430,428,NULL,NULL,'logout',398,399),(431,428,NULL,NULL,'admin_index',400,401),(432,428,NULL,NULL,'admin_add',402,403),(433,428,NULL,NULL,'admin_edit',404,405),(434,428,NULL,NULL,'admin_delete',406,407),(435,428,NULL,NULL,'parseUrl',408,409),(436,428,NULL,NULL,'error404',410,411),(437,428,NULL,NULL,'admin_change_active_status',412,413),(438,401,NULL,NULL,'Posts',415,428),(439,438,NULL,NULL,'view',416,417),(440,438,NULL,NULL,'admin_view',418,419),(441,438,NULL,NULL,'admin_add',420,421),(442,438,NULL,NULL,'admin_edit',422,423),(443,438,NULL,NULL,'admin_delete',424,425),(444,438,NULL,NULL,'admin_change_active_status',426,427),(445,1,NULL,NULL,'ThemeFolder',430,431),(446,1,NULL,NULL,'Uploadify',432,433),(447,1,NULL,NULL,'JamienayZendLucene',434,435),(448,1,NULL,NULL,'Carts',436,447),(449,448,NULL,NULL,'index',437,438),(450,448,NULL,NULL,'view',439,440),(451,448,NULL,NULL,'edit',441,442),(452,448,NULL,NULL,'delete',443,444),(453,448,NULL,NULL,'admin_change_active_status',445,446),(454,47,NULL,NULL,'admin_login',45,46),(455,47,NULL,NULL,'admin_logout',47,48),(456,47,NULL,NULL,'admin_edit',49,50),(457,160,NULL,NULL,'admin_make_this_primary',205,206),(458,61,NULL,NULL,'success',69,70),(459,61,NULL,NULL,'updatePrices',71,72),(460,61,NULL,NULL,'pay',73,74),(461,92,NULL,NULL,'admin_edit',153,154);

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
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

/*Data for the table `addresses` */

insert  into `addresses`(`id`,`address`,`city`,`region`,`zip_code`,`country`,`customer_id`,`type`,`full_name`) values (1,'qwe','qwe','qwe','123456','qwe',0,1,NULL),(2,'adderss','singapore','singapore','123','sng',0,1,NULL),(3,'adderss','singapore','singapore','123','sng',0,1,NULL),(4,'3dress','3ingapore','3ea','323','3gp',0,1,NULL),(5,'4dress','4ingapore','4ea','423','4gp',0,1,NULL),(6,'5dress','5ingapore','5ea','523','5gp',0,1,NULL),(7,'7ddress1','7ingapore','7eas','7','7gp',0,7,NULL),(8,'8ddress3','8ingapore','8ea','8','8gp',0,8,NULL),(9,'9ddress4','9ingapore','9ea','9','9gp',0,9,NULL),(10,'address5','singapore','sea','1','sgp',10,1,NULL),(11,'adderss1','1','1','1','1',11,1,NULL),(12,'adderss1','1','1','1','1',12,1,NULL),(13,'adderss1','1','1','1','1',12,1,NULL),(14,'address1','1','1','1','1',13,1,NULL),(15,'address3','3','3','3','3',14,1,NULL),(16,'address3','3','3','3','3',14,1,NULL),(17,'address3','3','3','3','3',15,1,NULL),(18,'address3','3','3','3','3',15,2,NULL),(19,'address3','3','3','3','3',16,1,NULL),(20,'address3','3','3','3','3',16,2,NULL),(21,'nana','n','n','n','n',17,1,NULL),(22,'nana','n','n','n','n',17,2,NULL),(47,NULL,NULL,NULL,NULL,NULL,17,1,NULL),(48,NULL,NULL,NULL,NULL,NULL,17,1,NULL),(49,NULL,NULL,NULL,NULL,NULL,17,1,NULL),(50,NULL,NULL,NULL,NULL,NULL,17,1,NULL),(51,'n1','n','n','n','n',17,1,NULL),(52,'n1','n','n','n','n',17,2,NULL),(53,'new address','1','1','1','1',0,1,NULL),(54,'new address','1','1','1','1',0,2,NULL),(55,'address 1','11','12','1','1',0,1,NULL),(56,'address 1','11','12','1','1',0,2,NULL),(57,'adssa','asd','asd','ad','d',1,1,NULL),(58,'adssa','asd','asd','ad','d',1,2,NULL),(59,'','','','','',1,1,NULL),(60,'','','','','',1,2,NULL),(61,'t','t','t','t','t',1,1,NULL),(62,'t','t','t','t','t',1,2,NULL),(63,'t','t','t','t','t',1,1,NULL),(64,'t','t','t','t','t',1,2,NULL),(65,'bbb','t','t','t','t',1,1,NULL),(66,'bbb','t','t','t','t',1,2,NULL),(67,'new address','t','t','t','t',1,1,NULL),(68,'new address','t','t','t','t',1,2,NULL),(69,'new2','n','n','n','n',22,1,NULL),(70,'new2','n','n','n','n',22,2,NULL),(71,'n','n','n','n','n',23,1,NULL),(72,'n','n','n','n','n',23,2,NULL),(73,'c','c','c','c','c',24,1,'cherry'),(74,'c','c','c','c','c',24,2,'cherry'),(75,'t','t','t','t','t',1,1,'t'),(76,'t','t','t','t','t',1,2,'t'),(77,'make','singapore','singapore','123456','sin',25,1,'make'),(78,'make','singapore','singapore','123456','sin',25,2,'make'),(79,'sa','a','a','a','a',25,1,'a'),(80,'sa','a','a','a','a',25,2,'a'),(81,'a','a','a','a','a',26,1,'a'),(82,'a','a','a','a','a',26,2,'a'),(83,'1 Main St','San Jose','CA','95131','US',30,2,'Test User'),(84,'1 Main St','San Jose','CA','95131','US',30,1,'Test User'),(85,'a','a','a','a','a',31,1,'a'),(86,'a','a','a','a','a',31,2,'a'),(87,'a','a','a','a','a',32,1,'full'),(88,'a','a','a','a','a',32,2,'full'),(89,'a','a','a','a','a',33,1,'full'),(90,'a','a','a','a','a',33,2,'full'),(91,'a','a','a','a','a',34,1,'a'),(92,'a','a','a','a','a',34,2,'a'),(93,'a','a','a','a','a',35,1,'a'),(94,'a','a','a','a','a',35,2,'a'),(95,'a','a','a','a','a',36,1,'a'),(96,'a','a','a','a','a',36,2,'a'),(97,'asd','asd','asd','123','sin',37,1,'full name'),(98,'asd','asd','asd','123','sin',37,2,'full name'),(99,'1','singapore','singapore','234','sin',25,1,'1'),(100,'1','singapore','singapore','234','sin',25,2,'1'),(101,'a','a','a','a','a',25,1,'a'),(102,'a','a','a','a','a',25,2,'a'),(103,'coffee house 101','Singapore',NULL,'123456','SG',38,2,'mister customer'),(104,'coffee house 101','Singapore',NULL,'123456','SG',38,1,'mister customer'),(105,'coffee house 101','Singapore','','123456','SG',38,1,'mister customer'),(106,'coffee house 101','Singapore','','123456','SG',38,2,'mister customer'),(107,'','','','','',1,1,''),(108,'','','','','',1,2,''),(109,'adssa','asd','asd','ad','d',1,1,NULL),(110,'adssa','asd','asd','ad','d',1,1,NULL),(111,'coffee house 101','Singapore','','123456','SG',1,1,'mister customer'),(112,'coffee house 101','Singapore','','123456','SG',1,2,'mister customer');

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
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `aros` */

insert  into `aros`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'Group',1,'administrators',1,2),(2,NULL,'Group',2,'editors',3,4),(3,NULL,'Group',3,'merchants',5,370),(4,NULL,'Group',4,'customers',371,438),(5,3,'User',1,NULL,6,7),(6,3,'User',2,NULL,8,9),(7,3,'User',2,NULL,10,11),(8,3,'User',1,NULL,12,13),(9,3,'User',1,NULL,14,15),(10,3,'User',1,NULL,16,17),(11,3,'User',1,NULL,18,19),(12,3,'User',1,NULL,20,21),(13,3,'User',1,NULL,22,23),(14,3,'User',1,NULL,24,25),(15,3,'User',1,NULL,26,27),(16,3,'User',2,NULL,28,29),(17,3,'User',2,NULL,30,31),(18,3,'User',2,NULL,32,33),(19,3,'User',2,NULL,34,35),(20,3,'User',2,NULL,36,37),(21,3,'User',2,NULL,38,39),(22,3,'User',2,NULL,40,41),(23,3,'User',2,NULL,42,43),(24,3,'User',2,NULL,44,45),(25,3,'User',2,NULL,46,47),(26,3,'User',2,NULL,48,49),(27,3,'User',2,NULL,50,51),(28,3,'User',2,NULL,52,53),(29,3,'User',2,NULL,54,55),(30,3,'User',2,NULL,56,57),(31,3,'User',2,NULL,58,59),(32,NULL,'User',2,NULL,439,440),(33,NULL,'User',2,NULL,441,442),(34,NULL,'User',2,NULL,443,444),(35,NULL,'User',2,NULL,445,446),(36,NULL,'User',2,NULL,447,448),(37,NULL,'User',2,NULL,449,450),(38,NULL,'User',2,NULL,451,452),(39,NULL,'User',2,NULL,453,454),(40,NULL,'User',2,NULL,455,456),(41,NULL,'User',2,NULL,457,458),(42,NULL,'User',2,NULL,459,460),(43,NULL,'User',2,NULL,461,462),(44,NULL,'User',2,NULL,463,464),(45,NULL,'User',2,NULL,465,466),(46,NULL,'User',2,NULL,467,468),(47,NULL,'User',3,NULL,469,470),(48,NULL,'User',2,NULL,471,472),(49,NULL,'User',2,NULL,473,474),(50,NULL,'User',2,NULL,475,476),(51,NULL,'User',2,NULL,477,478),(52,3,'User',2,NULL,60,61),(53,NULL,'User',2,NULL,479,480),(54,3,'User',2,NULL,62,63),(55,NULL,'User',2,NULL,481,482),(56,3,'User',2,NULL,64,65),(57,NULL,'User',2,NULL,483,484),(58,3,'User',2,NULL,66,67),(59,NULL,'User',2,NULL,485,486),(60,NULL,'User',2,NULL,487,488),(61,NULL,'User',2,NULL,489,490),(62,NULL,'User',2,NULL,491,492),(63,NULL,'User',2,NULL,493,494),(64,3,'User',2,NULL,68,69),(65,3,'User',2,NULL,70,71),(66,3,'User',2,NULL,72,73),(67,3,'User',2,NULL,74,75),(68,3,'User',4,NULL,76,77),(69,3,'User',5,NULL,78,79),(70,3,'User',2,NULL,80,81),(71,3,'User',2,NULL,82,83),(72,3,'User',2,NULL,84,85),(73,3,'User',2,NULL,86,87),(74,3,'User',6,NULL,88,89),(75,3,'User',7,NULL,90,91),(76,3,'User',2,NULL,92,93),(77,3,'User',2,NULL,94,95),(78,3,'User',2,NULL,96,97),(79,3,'User',2,NULL,98,99),(80,3,'User',2,NULL,100,101),(81,3,'User',2,NULL,102,103),(82,3,'User',2,NULL,104,105),(83,3,'User',2,NULL,106,107),(84,3,'User',2,NULL,108,109),(85,3,'User',2,NULL,110,111),(86,3,'User',2,NULL,112,113),(87,3,'User',2,NULL,114,115),(88,3,'User',2,NULL,116,117),(89,3,'User',2,NULL,118,119),(90,3,'User',2,NULL,120,121),(91,3,'User',2,NULL,122,123),(92,4,'User',6,NULL,372,373),(93,3,'User',2,NULL,124,125),(94,3,'User',2,NULL,126,127),(95,3,'User',2,NULL,128,129),(96,3,'User',2,NULL,130,131),(97,3,'User',2,NULL,132,133),(98,3,'User',2,NULL,134,135),(99,3,'User',2,NULL,136,137),(100,3,'User',2,NULL,138,139),(101,3,'User',2,NULL,140,141),(102,3,'User',2,NULL,142,143),(103,3,'User',2,NULL,144,145),(104,3,'User',2,NULL,146,147),(105,3,'User',2,NULL,148,149),(106,3,'User',2,NULL,150,151),(107,3,'User',2,NULL,152,153),(108,3,'User',2,NULL,154,155),(109,3,'User',2,NULL,156,157),(110,3,'User',2,NULL,158,159),(111,3,'User',2,NULL,160,161),(112,3,'User',2,NULL,162,163),(113,3,'User',2,NULL,164,165),(114,3,'User',2,NULL,166,167),(115,3,'User',2,NULL,168,169),(116,3,'User',2,NULL,170,171),(117,3,'User',2,NULL,172,173),(118,3,'User',2,NULL,174,175),(119,3,'User',2,NULL,176,177),(120,3,'User',2,NULL,178,179),(121,3,'User',2,NULL,180,181),(122,3,'User',2,NULL,182,183),(123,3,'User',2,NULL,184,185),(124,3,'User',2,NULL,186,187),(125,3,'User',2,NULL,188,189),(126,3,'User',2,NULL,190,191),(127,3,'User',2,NULL,192,193),(128,3,'User',2,NULL,194,195),(129,3,'User',2,NULL,196,197),(130,3,'User',2,NULL,198,199),(131,3,'User',2,NULL,200,201),(132,3,'User',2,NULL,202,203),(133,3,'User',2,NULL,204,205),(134,3,'User',2,NULL,206,207),(135,3,'User',2,NULL,208,209),(136,3,'User',2,NULL,210,211),(137,3,'User',2,NULL,212,213),(138,3,'User',2,NULL,214,215),(139,3,'User',2,NULL,216,217),(140,3,'User',2,NULL,218,219),(141,3,'User',2,NULL,220,221),(142,3,'User',2,NULL,222,223),(143,3,'User',2,NULL,224,225),(144,3,'User',2,NULL,226,227),(145,3,'User',2,NULL,228,229),(146,3,'User',2,NULL,230,231),(147,3,'User',2,NULL,232,233),(148,3,'User',2,NULL,234,235),(149,3,'User',2,NULL,236,237),(150,3,'User',2,NULL,238,239),(151,3,'User',2,NULL,240,241),(152,3,'User',2,NULL,242,243),(153,3,'User',2,NULL,244,245),(154,3,'User',2,NULL,246,247),(155,3,'User',2,NULL,248,249),(156,3,'User',2,NULL,250,251),(157,3,'User',2,NULL,252,253),(158,3,'User',2,NULL,254,255),(159,3,'User',2,NULL,256,257),(160,3,'User',2,NULL,258,259),(161,3,'User',2,NULL,260,261),(162,3,'User',2,NULL,262,263),(163,3,'User',2,NULL,264,265),(164,3,'User',2,NULL,266,267),(165,3,'User',2,NULL,268,269),(166,3,'User',2,NULL,270,271),(167,3,'User',2,NULL,272,273),(168,3,'User',2,NULL,274,275),(169,3,'User',2,NULL,276,277),(170,3,'User',2,NULL,278,279),(171,3,'User',2,NULL,280,281),(172,3,'User',2,NULL,282,283),(173,3,'User',2,NULL,284,285),(174,3,'User',2,NULL,286,287),(175,3,'User',2,NULL,288,289),(176,3,'User',2,NULL,290,291),(177,3,'User',2,NULL,292,293),(178,3,'User',2,NULL,294,295),(179,3,'User',2,NULL,296,297),(180,3,'User',2,NULL,298,299),(181,3,'User',2,NULL,300,301),(182,3,'User',2,NULL,302,303),(183,3,'User',2,NULL,304,305),(184,3,'User',2,NULL,306,307),(185,3,'User',2,NULL,308,309),(186,3,'User',2,NULL,310,311),(187,3,'User',2,NULL,312,313),(188,3,'User',2,NULL,314,315),(189,3,'User',2,NULL,316,317),(190,3,'User',2,NULL,318,319),(191,3,'User',2,NULL,320,321),(192,3,'User',2,NULL,322,323),(193,3,'User',2,NULL,324,325),(194,3,'User',2,NULL,326,327),(195,3,'User',2,NULL,328,329),(196,3,'User',2,NULL,330,331),(197,3,'User',2,NULL,332,333),(198,3,'User',2,NULL,334,335),(199,3,'User',2,NULL,336,337),(200,3,'User',2,NULL,338,339),(201,3,'User',6,NULL,340,341),(202,4,'User',7,NULL,374,375),(204,4,'User',9,NULL,376,377),(205,4,'User',10,NULL,378,379),(206,4,'User',11,NULL,380,381),(207,4,'User',12,NULL,382,383),(208,4,'User',13,NULL,384,385),(209,4,'User',14,NULL,386,387),(210,4,'User',15,NULL,388,389),(211,4,'User',16,NULL,390,391),(212,4,'User',17,NULL,392,393),(213,4,'User',18,NULL,394,395),(214,4,'User',19,NULL,396,397),(215,4,'User',20,NULL,398,399),(216,4,'User',21,NULL,400,401),(217,4,'User',22,NULL,402,403),(218,4,'User',23,NULL,404,405),(219,3,'User',2,NULL,342,343),(220,3,'User',2,NULL,344,345),(221,3,'User',2,NULL,346,347),(222,3,'User',2,NULL,348,349),(223,3,'User',2,NULL,350,351),(224,3,'User',2,NULL,352,353),(225,3,'User',2,NULL,354,355),(226,3,'User',2,NULL,356,357),(227,3,'User',2,NULL,358,359),(228,3,'User',2,NULL,360,361),(229,3,'User',2,NULL,362,363),(230,3,'User',2,NULL,364,365),(231,3,'User',3,NULL,366,367),(232,3,'User',3,NULL,368,369),(235,4,'User',26,NULL,406,407),(236,4,'User',27,NULL,408,409),(237,4,'User',28,NULL,410,411),(238,4,'User',29,NULL,412,413),(239,4,'User',30,NULL,414,415),(240,4,'User',31,NULL,416,417),(241,4,'User',32,NULL,418,419),(243,4,'User',34,NULL,420,421),(244,4,'User',35,NULL,422,423),(245,4,'User',36,NULL,424,425),(246,4,'User',37,NULL,426,427),(247,4,'User',38,NULL,428,429),(248,4,'User',39,NULL,430,431),(249,4,'User',40,NULL,432,433),(250,4,'User',41,NULL,434,435),(251,NULL,'User',42,NULL,495,496),(252,NULL,'Group',5,'casual',497,542),(253,NULL,'User',43,NULL,543,544),(254,252,'User',44,NULL,498,499),(255,252,'User',45,NULL,500,501),(256,252,'User',46,NULL,502,503),(257,4,'User',47,NULL,436,437),(258,252,'User',48,NULL,504,505),(259,252,'User',49,NULL,506,507),(260,252,'User',50,NULL,508,509),(261,252,'User',51,NULL,510,511),(262,252,'User',52,NULL,512,513),(263,252,'User',53,NULL,514,515),(264,252,'User',54,NULL,516,517),(265,252,'User',55,NULL,518,519),(266,252,'User',56,NULL,520,521),(267,252,'User',57,NULL,522,523),(268,252,'User',58,NULL,524,525),(269,252,'User',59,NULL,526,527),(270,252,'User',60,NULL,528,529),(271,252,'User',61,NULL,530,531),(272,252,'User',62,NULL,532,533),(273,252,'User',63,NULL,534,535),(274,252,'User',64,NULL,536,537),(275,252,'User',65,NULL,538,539),(276,252,'User',66,NULL,540,541);

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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

/*Data for the table `aros_acos` */

insert  into `aros_acos`(`id`,`aro_id`,`aco_id`,`_create`,`_read`,`_update`,`_delete`) values (1,1,1,'1','1','1','1'),(2,2,1,'-1','-1','-1','-1'),(3,2,79,'1','1','1','1'),(4,2,92,'1','1','1','1'),(5,3,1,'-1','-1','-1','-1'),(11,3,51,'1','1','1','1'),(12,3,80,'1','1','1','1'),(14,3,138,'1','1','1','1'),(15,3,139,'1','1','1','1'),(16,3,140,'1','1','1','1'),(17,3,137,'1','1','1','1'),(18,3,154,'1','1','1','1'),(20,3,156,'1','1','1','1'),(24,4,105,'1','1','1','1'),(25,4,104,'1','1','1','1'),(26,4,3,'1','1','1','1'),(28,4,159,'1','1','1','1'),(29,4,158,'1','1','1','1'),(30,2,3,'1','1','1','1'),(31,3,3,'1','1','1','1'),(32,4,1,'-1','-1','-1','-1'),(33,2,98,'1','1','1','1'),(34,2,160,'1','1','1','1'),(35,3,163,'1','1','1','1'),(36,3,164,'1','1','1','1'),(37,3,165,'1','1','1','1'),(38,3,162,'1','1','1','1'),(39,3,161,'1','1','1','1'),(42,3,299,'1','1','1','1'),(43,3,302,'1','1','1','1'),(44,3,316,'1','1','1','1'),(45,3,315,'1','1','1','1'),(46,3,329,'1','1','1','1'),(47,3,330,'1','1','1','1'),(48,3,331,'1','1','1','1'),(49,3,332,'1','1','1','1'),(50,2,173,'1','1','1','1'),(51,3,456,'1','1','1','1'),(52,3,455,'1','1','1','1'),(53,3,454,'1','1','1','1'),(54,3,457,'1','1','1','1'),(55,3,364,'1','1','1','1'),(56,3,368,'1','1','1','1'),(57,3,366,'1','1','1','1'),(58,3,369,'1','1','1','1'),(59,3,371,'1','1','1','1'),(60,3,370,'1','1','1','1'),(61,3,372,'1','1','1','1'),(62,3,373,'1','1','1','1'),(63,3,375,'1','1','1','1'),(64,3,298,'1','1','1','1'),(65,3,376,'1','1','1','1'),(66,3,387,'1','1','1','1');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `blogs` */

insert  into `blogs`(`id`,`name`,`short_name`,`description`,`theme`,`created`,`modified`,`shop_id`) values (1,'My First LilBlog','my-first-lilblog11','This is your first blog. Enyoj!',NULL,'2010-08-18 11:38:30','2010-09-02 11:51:49',5),(2,'new blog','new-blog','te','','2010-09-02 11:55:02','2010-09-02 11:55:02',NULL),(4,'test','test',NULL,NULL,'2010-09-03 04:30:30','2010-09-03 04:30:30',5),(5,'test again','test-again',NULL,NULL,'2010-09-03 04:34:02','2010-09-03 04:34:02',5),(6,'test 1','test-1',NULL,NULL,'2010-09-03 04:41:52','2010-09-03 04:41:52',5),(7,'new','new',NULL,NULL,'2010-09-03 09:41:42','2010-09-03 09:41:42',5),(8,'test 2','test-2',NULL,NULL,'2010-09-03 09:49:00','2010-09-03 09:49:00',5),(9,'test 3','test-3',NULL,NULL,'2010-09-03 09:49:30','2010-09-03 09:49:30',5),(10,'test 4','test-4',NULL,NULL,'2010-09-03 09:51:34','2010-09-03 09:51:34',5),(11,'abc sell cake','abc-sell-cake',NULL,NULL,'2010-09-09 10:36:34','2010-09-09 10:36:34',5),(12,'new','new',NULL,NULL,'2010-09-13 10:17:55','2010-09-13 10:17:55',5),(13,'new 1','new-1',NULL,NULL,'2010-09-13 10:19:44','2010-09-13 10:19:44',5);

/*Table structure for table `cake_sessions` */

DROP TABLE IF EXISTS `cake_sessions`;

CREATE TABLE `cake_sessions` (
  `id` varchar(255) NOT NULL,
  `data` text,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `cake_sessions` */

insert  into `cake_sessions`(`id`,`data`,`expires`) values ('l344v7hndrpfga116thsv6k3s5','Config|a:4:{s:9:\"userAgent\";s:32:\"826867aa3c8467c7df59babea82e842d\";s:4:\"time\";i:1290271997;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:3:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"5\";s:8:\"theme_id\";s:1:\"4\";s:4:\"name\";s:5:\"shop4\";s:11:\"web_address\";s:23:\"http://shop4.ombi60.biz\";s:7:\"created\";N;s:8:\"modified\";s:19:\"2010-10-04 12:40:52\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:2:\"13\";}s:6:\"Domain\";a:5:{s:6:\"domain\";s:16:\"http://localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"5\";s:7:\"primary\";s:1:\"0\";s:20:\"always_redirect_here\";s:1:\"0\";}s:5:\"Theme\";a:9:{s:4:\"name\";s:3:\"alt\";s:2:\"id\";s:1:\"4\";s:11:\"description\";s:3:\"alt\";s:6:\"author\";s:6:\"kimsia\";s:7:\"created\";s:19:\"2010-07-08 00:00:00\";s:8:\"modified\";s:19:\"2010-07-08 00:00:00\";s:17:\"available_for_all\";s:1:\"1\";s:11:\"folder_name\";s:0:\"\";s:7:\"shop_id\";N;}}_Token|s:212:\"a:5:{s:3:\"key\";s:40:\"f58212c7c58cbad5e0d4631307b679f76eb1eb41\";s:7:\"expires\";i:1290253997;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:1:{i:0;s:21:\"ProductImage.filename\";}}\";Message|a:0:{}Auth|a:4:{s:4:\"User\";a:10:{s:2:\"id\";s:1:\"5\";s:5:\"email\";s:15:\"owner@shop4.com\";s:8:\"group_id\";s:1:\"3\";s:9:\"full_name\";s:4:\"evey\";s:12:\"name_to_call\";s:4:\"evey\";s:13:\"last_login_on\";N;s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2010-04-26 03:20:22\";s:8:\"modified\";s:19:\"2010-09-27 08:05:58\";s:11:\"language_id\";s:1:\"1\";}s:8:\"Merchant\";a:4:{s:2:\"id\";s:2:\"11\";s:5:\"owner\";s:1:\"1\";s:7:\"shop_id\";s:1:\"5\";s:7:\"user_id\";s:1:\"5\";}s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"5\";s:8:\"theme_id\";s:1:\"4\";s:4:\"name\";s:5:\"shop4\";s:11:\"web_address\";s:23:\"http://shop4.ombi60.biz\";s:7:\"created\";N;s:8:\"modified\";s:19:\"2010-10-04 12:40:52\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:2:\"13\";}s:8:\"Language\";a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:7:\"English\";s:11:\"locale_name\";s:3:\"eng\";}}Filter|a:1:{s:8:\"products\";a:1:{s:11:\"admin_index\";s:20:\"/Filter.parsed:true/\";}}',1290271998),('ujuulsna1mlpumar6at0c4mcn7','CurrentShop|a:3:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"5\";s:8:\"theme_id\";s:1:\"4\";s:4:\"name\";s:5:\"shop4\";s:11:\"web_address\";s:23:\"http://shop4.ombi60.biz\";s:7:\"created\";N;s:8:\"modified\";s:19:\"2010-10-04 12:40:52\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:2:\"13\";}s:6:\"Domain\";a:5:{s:6:\"domain\";s:16:\"http://localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"5\";s:7:\"primary\";s:1:\"0\";s:20:\"always_redirect_here\";s:1:\"0\";}s:5:\"Theme\";a:9:{s:4:\"name\";s:3:\"alt\";s:2:\"id\";s:1:\"4\";s:11:\"description\";s:3:\"alt\";s:6:\"author\";s:6:\"kimsia\";s:7:\"created\";s:19:\"2010-07-08 00:00:00\";s:8:\"modified\";s:19:\"2010-07-08 00:00:00\";s:17:\"available_for_all\";s:1:\"1\";s:11:\"folder_name\";s:0:\"\";s:7:\"shop_id\";N;}}Config|a:1:{s:8:\"language\";s:3:\"eng\";}Message|a:1:{s:4:\"auth\";a:3:{s:7:\"message\";s:47:\"You are not authorized to access that location.\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}Auth|a:1:{s:8:\"redirect\";s:25:\"/admin/products/upload/17\";}',1290271562),('bf5kudh4rd6j0brva9blpm9700','CurrentShop|a:3:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"5\";s:8:\"theme_id\";s:1:\"4\";s:4:\"name\";s:5:\"shop4\";s:11:\"web_address\";s:23:\"http://shop4.ombi60.biz\";s:7:\"created\";N;s:8:\"modified\";s:19:\"2010-10-04 12:40:52\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:2:\"13\";}s:6:\"Domain\";a:5:{s:6:\"domain\";s:16:\"http://localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"5\";s:7:\"primary\";s:1:\"0\";s:20:\"always_redirect_here\";s:1:\"0\";}s:5:\"Theme\";a:9:{s:4:\"name\";s:3:\"alt\";s:2:\"id\";s:1:\"4\";s:11:\"description\";s:3:\"alt\";s:6:\"author\";s:6:\"kimsia\";s:7:\"created\";s:19:\"2010-07-08 00:00:00\";s:8:\"modified\";s:19:\"2010-07-08 00:00:00\";s:17:\"available_for_all\";s:1:\"1\";s:11:\"folder_name\";s:0:\"\";s:7:\"shop_id\";N;}}Config|a:1:{s:8:\"language\";s:3:\"eng\";}Message|a:1:{s:4:\"auth\";a:3:{s:7:\"message\";s:47:\"You are not authorized to access that location.\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}Auth|a:1:{s:8:\"redirect\";s:25:\"/admin/products/upload/16\";}',1290267076);

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
  UNIQUE KEY `unique_product_cart_id` (`cart_id`,`product_id`),
  KEY `product` (`product_id`),
  KEY `ci_to_cart` (`cart_id`),
  KEY `ci_to_product` (`product_id`),
  KEY `cart` (`cart_id`),
  CONSTRAINT `ci_to_cart` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ci_to_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=326 DEFAULT CHARSET=utf8;

/*Data for the table `cart_items` */

insert  into `cart_items`(`id`,`cart_id`,`product_id`,`product_price`,`product_quantity`,`status`,`product_title`,`product_weight`,`currency`,`weight_unit`,`shipping_required`,`previous_price`,`previous_currency`) values (27,39,3,'123.0000',4,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(28,40,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(29,41,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(30,42,3,'123.0000',3,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(31,43,3,'123.0000',3,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(32,43,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(33,44,3,'123.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(34,44,5,'12.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(35,45,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(36,46,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(37,47,3,'123.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(38,48,3,'123.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(39,49,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(40,50,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(41,51,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(42,52,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(43,53,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(44,54,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(45,55,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(46,56,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(47,57,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(48,58,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(49,59,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(50,60,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(51,61,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(52,62,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(53,63,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(54,64,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(55,65,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(56,66,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(57,67,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(58,68,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(59,69,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(60,70,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(61,71,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(62,72,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(63,73,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(64,74,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(65,75,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(66,76,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(67,77,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(68,78,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(69,79,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(70,80,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(71,81,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(72,82,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(73,83,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(74,84,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(75,85,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(76,86,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(77,87,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(78,88,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(79,89,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(80,90,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(81,91,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(82,92,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(83,93,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(84,94,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(85,95,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(86,96,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(87,97,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(88,98,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(89,99,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(90,100,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(91,101,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(92,102,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(93,103,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(94,104,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(95,105,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(96,106,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(97,107,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(98,108,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(99,109,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(100,110,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(101,111,3,'123.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(102,112,3,'123.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(103,112,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(104,113,3,'123.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(105,113,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(106,114,3,'123.0000',3,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(107,115,3,'123.0000',3,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(108,116,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(109,117,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(110,118,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(111,119,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(112,121,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(113,123,5,'12.0000',3,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(114,124,5,'12.0000',3,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(115,125,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(116,126,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(117,127,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(118,128,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(119,129,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(120,130,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(121,131,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(122,132,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(123,133,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(124,134,5,'12.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(125,135,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(126,136,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(127,137,5,'12.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(128,144,5,'1.0000',3,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(129,145,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(130,146,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(131,147,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(132,148,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(133,149,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(134,150,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(135,151,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(136,152,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(137,153,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(138,154,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(139,155,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(140,156,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(141,157,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(142,158,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(143,159,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(144,160,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(145,161,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(146,162,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(147,163,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(148,164,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(149,165,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(150,166,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(151,167,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(152,168,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(153,169,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(154,170,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(155,171,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(156,172,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(157,173,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(158,174,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(159,175,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(160,176,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(161,177,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(162,178,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(163,179,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(164,180,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(165,181,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(166,182,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(167,183,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(168,184,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(169,185,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(170,186,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(171,187,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(172,188,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(173,189,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(174,190,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(175,191,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(176,192,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(177,193,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(178,194,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(179,195,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(180,196,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(181,197,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(182,198,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(183,199,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(184,200,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(185,201,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(186,202,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(187,203,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(188,204,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(189,205,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(190,206,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(191,207,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(192,208,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(193,209,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(194,210,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(195,211,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(196,212,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(197,213,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(198,214,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(199,215,5,'1.0000',3,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(200,216,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(201,217,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(202,218,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(203,219,5,'1.0000',3,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(204,220,5,'1.0000',4,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(205,221,5,'1.0000',4,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(206,222,5,'1.0000',4,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(207,223,5,'1.0000',4,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(208,224,5,'1.0000',4,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(209,225,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(210,226,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(211,227,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(212,228,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(213,229,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(214,230,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(215,231,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(216,232,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(217,233,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(218,234,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(219,235,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(220,236,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(221,237,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(222,238,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(223,239,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(224,240,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(225,241,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(226,242,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(227,243,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(228,244,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(229,245,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(230,246,5,'1.0000',3,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(231,247,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(232,248,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(233,249,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(234,250,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(235,251,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(236,252,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(237,253,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(238,254,5,'1.0000',1,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(239,255,5,'1.0000',2,1,'','0.0000','SGD','kg',1,'0.0000',NULL),(240,256,5,'1.0000',7,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(241,257,5,'1.0000',1,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(242,258,5,'1.0000',2,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(243,259,5,'1.0000',1,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(244,260,5,'1.0000',3,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(245,261,5,'1.0000',1,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(246,262,5,'1.0000',1,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(247,263,5,'1.0000',2,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(248,264,5,'1.0000',7,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(249,265,5,'1.0000',5,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(250,266,5,'1.0000',3,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(251,267,5,'1.0000',3,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(252,268,5,'1.0000',2,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(253,269,5,'1.0000',2,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(254,270,5,'1.0000',1,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(255,271,5,'1.0000',3,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(256,272,5,'1.0000',3,1,'test for delete','0.0000','SGD','kg',1,'0.0000',NULL),(257,273,3,'123.0000',1,1,'product test','0.0000','SGD','kg',1,'0.0000',NULL),(258,274,3,'123.0000',1,1,'product test','0.0000','SGD','kg',1,'0.0000',NULL),(259,275,3,'123.0000',1,1,'product test','0.0000','SGD','kg',1,'0.0000',NULL),(260,276,3,'123.0000',1,1,'product test','0.0000','SGD','kg',1,'0.0000',NULL),(261,277,3,'123.0000',1,1,'product test','0.0000','SGD','kg',1,'0.0000',NULL),(262,278,3,'123.0000',1,1,'product test','0.0000','SGD','kg',1,'0.0000',NULL),(263,279,3,'123.0000',1,1,'product test','0.0000','SGD','kg',1,'0.0000',NULL),(264,280,3,'123.0000',1,1,'product test','7.0000','SGD','kg',1,'0.0000',NULL),(265,280,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(266,281,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(267,281,14,'3.0000',3,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(268,282,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(269,282,14,'3.0000',4,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(270,283,15,'4.0000',3,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(271,283,14,'3.0000',4,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(272,284,15,'4.0000',3,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(273,284,14,'3.0000',4,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(274,285,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(275,285,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(276,286,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(277,286,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(278,287,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(279,287,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(280,288,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(281,288,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(282,289,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(283,289,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(284,290,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(285,290,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(286,291,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(287,291,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(288,292,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(289,292,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(290,293,14,'3.0000',2,1,'product 3','3.0000','SGD','kg',1,'3.0000','SGD'),(291,293,15,'4.0000',26,1,'prodduct 4','4.0000','SGD','kg',0,'4.0000','SGD'),(293,295,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(294,295,3,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(295,297,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(296,297,3,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(297,298,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(298,298,3,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(299,299,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(300,299,3,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(301,300,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(302,300,3,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'0.0000',NULL),(303,301,15,'4.0000',2,1,NULL,'4.0000','SGD','kg',0,'4.0000','SGD'),(304,301,3,'123.0000',7,1,'product test','4.0000','SGD','kg',0,'123.0000','SGD'),(305,301,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1,'0.0000',NULL),(306,301,7,'1.0000',1,1,'test','7.0000','SGD','kg',0,'1.0000','SGD'),(307,302,3,'123.0000',1,1,'product test','7.0000','SGD','kg',1,'123.0000','SGD'),(308,303,3,'123.0000',2,1,'product test','7.0000','SGD','kg',1,'123.0000','SGD'),(309,304,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1,'123.0000','SGD'),(310,304,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'4.0000','SGD'),(311,293,3,'123.0000',6,1,'product test','7.0000','SGD','kg',1,'123.0000','SGD'),(312,293,13,'77.0000',2,1,'product 2',NULL,'SGD','kg',1,'77.0000','SGD'),(313,305,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'4.0000','SGD'),(314,305,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1,'3.0000','SGD'),(315,306,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'4.0000','SGD'),(316,307,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1,'123.0000','SGD'),(317,307,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1,'77.0000','SGD'),(318,307,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1,'3.0000','SGD'),(319,307,15,'4.0000',13,1,'prodduct 4','4.0000','SGD','kg',0,'4.0000','SGD'),(320,308,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'4.0000','SGD'),(321,309,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'4.0000','SGD'),(322,310,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0,'4.0000','SGD'),(323,311,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'4.0000','SGD'),(324,312,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'4.0000','SGD'),(325,313,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0,'4.0000','SGD');

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
  PRIMARY KEY (`id`),
  KEY `FK_carts` (`shop_id`),
  CONSTRAINT `FK_carts` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=314 DEFAULT CHARSET=utf8;

/*Data for the table `carts` */

insert  into `carts`(`id`,`shop_id`,`user_id`,`created`,`amount`,`status`,`hash`,`total_weight`,`currency`,`weight_unit`,`shipped_amount`,`shipped_weight`,`past_checkout_point`) values (39,5,0,'2010-06-07 10:14:01','492.0000',1,'c12dd89e261b7b14020043f1940530c554045798','0.0000','SGD','kg','0.0000','0.0000',1),(40,5,0,'2010-06-07 10:21:21','246.0000',1,'f709f111f1cfeffefd937146b9e6c593e96bca0e','0.0000','SGD','kg','0.0000','0.0000',1),(41,5,0,'2010-06-07 10:23:55','246.0000',1,'4464f66f4289537350f1ff302175aa4996c16a58','0.0000','SGD','kg','0.0000','0.0000',1),(42,5,0,'2010-06-07 10:27:51','369.0000',1,'68e03fda7a41df73af80604739f13cbcbe92f568','0.0000','SGD','kg','0.0000','0.0000',1),(43,5,0,'2010-06-07 10:34:33','381.0000',1,'6c945fc0eab86835cc6e48800c66bc692de2cdb0','0.0000','SGD','kg','0.0000','0.0000',1),(44,5,0,'2010-06-07 10:44:28','147.0000',1,'2bcebba6e4a658f89d78c46913e86946aec02981','0.0000','SGD','kg','0.0000','0.0000',1),(45,5,0,'2010-06-08 08:27:23','12.0000',1,'7e1745a1aa35a448e2b6e9226da17d88ae8d81ba','0.0000','SGD','kg','0.0000','0.0000',1),(46,5,0,'2010-06-08 12:04:45','12.0000',1,'83cba68a4acfad0c2bd6fafbbb3836b3538afef9','0.0000','SGD','kg','0.0000','0.0000',1),(47,5,0,'2010-06-08 13:08:52','123.0000',1,'362e361d68a946b7bcc4fb9391ee9d371b15a6dd','0.0000','SGD','kg','0.0000','0.0000',1),(48,5,0,'2010-06-08 13:20:06','123.0000',1,'6936c2a96dd65e4c65427b239f67b8b91192c834','0.0000','SGD','kg','0.0000','0.0000',1),(49,5,0,'2010-06-08 15:10:44','246.0000',1,'120084de3fd9398a8e35b523aa1f8bb6b968060f','0.0000','SGD','kg','0.0000','0.0000',1),(50,5,0,'2010-06-08 15:14:52','246.0000',1,'7bf43400093756af857e3f2d851be463df2b5074','0.0000','SGD','kg','0.0000','0.0000',1),(51,5,0,'2010-06-08 15:14:52','246.0000',1,'0b0198682923d789ecfca247ac03ba69a67e0976','0.0000','SGD','kg','0.0000','0.0000',1),(52,5,0,'2010-06-08 15:14:53','246.0000',1,'e7bdff0e08c5938cf7b1d9397e1076dfa554bbf1','0.0000','SGD','kg','0.0000','0.0000',1),(53,5,0,'2010-06-08 15:14:53','246.0000',1,'fe376c8b672a37c10765e146aff628f1acdfe848','0.0000','SGD','kg','0.0000','0.0000',1),(54,5,0,'2010-06-08 15:14:53','246.0000',1,'d461a3fba154e3b8ffc8e4ba518b79924f3db705','0.0000','SGD','kg','0.0000','0.0000',1),(55,5,0,'2010-06-08 15:14:54','246.0000',1,'00d970b2c2a24de182ba77e5dbfb42f0a7188a6b','0.0000','SGD','kg','0.0000','0.0000',1),(56,5,0,'2010-06-08 15:14:54','246.0000',1,'e18cd69a7d7be5f6f3faf8339b06cb571784e3bc','0.0000','SGD','kg','0.0000','0.0000',1),(57,5,0,'2010-06-08 15:14:54','246.0000',1,'2c1396fa3a5e8c15ddaac3eea9faed6fa7dcf44e','0.0000','SGD','kg','0.0000','0.0000',1),(58,5,0,'2010-06-08 15:14:55','246.0000',1,'be18f6a672578c5fb7882b92d21314c6e9bab0ff','0.0000','SGD','kg','0.0000','0.0000',1),(59,5,0,'2010-06-08 15:14:55','246.0000',1,'06506b4f3997ca4e1cec60637d5daad8a769413b','0.0000','SGD','kg','0.0000','0.0000',1),(60,5,0,'2010-06-08 15:14:55','246.0000',1,'29ceb6abbd186f26a71f6caf1f58136a570d9f7a','0.0000','SGD','kg','0.0000','0.0000',1),(61,5,0,'2010-06-08 15:14:56','246.0000',1,'d64e586688c85197f49e0093b0b8e8f67bbc1d7a','0.0000','SGD','kg','0.0000','0.0000',1),(62,5,0,'2010-06-08 15:14:56','246.0000',1,'e63c8f8023b6a4227d50905a5ff87d2dc12158c4','0.0000','SGD','kg','0.0000','0.0000',1),(63,5,0,'2010-06-08 15:14:57','246.0000',1,'40b7bba63d23e518d81f5c8cd82b3283112ef207','0.0000','SGD','kg','0.0000','0.0000',1),(64,5,0,'2010-06-08 15:14:57','246.0000',1,'0d97c5cf48f22f0987aaf3baf817bebeb318aa82','0.0000','SGD','kg','0.0000','0.0000',1),(65,5,0,'2010-06-08 15:14:57','246.0000',1,'2da179aa028911de4dff192265256c644f6e6ad0','0.0000','SGD','kg','0.0000','0.0000',1),(66,5,0,'2010-06-08 15:14:58','246.0000',1,'f29cc33d6c8a3942797fee2c27a99aad6227c0e0','0.0000','SGD','kg','0.0000','0.0000',1),(67,5,0,'2010-06-08 15:14:58','246.0000',1,'e52757f3c908b061151fc900aa5672cd5efdead7','0.0000','SGD','kg','0.0000','0.0000',1),(68,5,0,'2010-06-08 15:14:58','246.0000',1,'2d2d917356b42afd4ea1e7b65f2e6f157298882c','0.0000','SGD','kg','0.0000','0.0000',1),(69,5,0,'2010-06-08 15:14:59','246.0000',1,'3eea35fa4bf3bbd723b59b9cbf4375d6f481a85d','0.0000','SGD','kg','0.0000','0.0000',1),(70,5,0,'2010-06-08 15:14:59','246.0000',1,'77e8f32f91367a0481483f33ea95e53eb1afd108','0.0000','SGD','kg','0.0000','0.0000',1),(71,5,0,'2010-06-08 15:15:45','246.0000',1,'a394137758e4e8be673343464fa814f0a184842c','0.0000','SGD','kg','0.0000','0.0000',1),(72,5,0,'2010-06-08 15:15:46','246.0000',1,'56d6d3e65b8a5aa6d4851d147aecf593bf56ae79','0.0000','SGD','kg','0.0000','0.0000',1),(73,5,0,'2010-06-08 15:15:46','246.0000',1,'ea02ee1454e07648565f2153a5ecd7bde3ccdc03','0.0000','SGD','kg','0.0000','0.0000',1),(74,5,0,'2010-06-08 15:15:46','246.0000',1,'18dda45df62303113ae9e21d678cda3a151182eb','0.0000','SGD','kg','0.0000','0.0000',1),(75,5,0,'2010-06-08 15:15:47','246.0000',1,'1f975f23f6ebd2431e9bcef5e561058a86089a8c','0.0000','SGD','kg','0.0000','0.0000',1),(76,5,0,'2010-06-08 15:15:47','246.0000',1,'73887773a8ab62a76e1a0e16d2e5caec1b9d1098','0.0000','SGD','kg','0.0000','0.0000',1),(77,5,0,'2010-06-08 15:15:48','246.0000',1,'4db34ca1f9f0fce168af1f369bcbaf432a680ab0','0.0000','SGD','kg','0.0000','0.0000',1),(78,5,0,'2010-06-08 15:15:48','246.0000',1,'5816455a202b56addea4d62eec83ddb7d6b6051b','0.0000','SGD','kg','0.0000','0.0000',1),(79,5,0,'2010-06-08 15:15:48','246.0000',1,'5ecc8cc4ccaa40a86a4adc91be061348e4decc1b','0.0000','SGD','kg','0.0000','0.0000',1),(80,5,0,'2010-06-08 15:15:49','246.0000',1,'faf340ac2ce225679a77a5036af9fd7b80b4542f','0.0000','SGD','kg','0.0000','0.0000',1),(81,5,0,'2010-06-08 15:15:49','246.0000',1,'280259298698fdc86b4820173947b30e2c0c72be','0.0000','SGD','kg','0.0000','0.0000',1),(82,5,0,'2010-06-08 15:15:49','246.0000',1,'0431d05d188a3a1982604df872a3396297852497','0.0000','SGD','kg','0.0000','0.0000',1),(83,5,0,'2010-06-08 15:15:50','246.0000',1,'ed17a78b466f3026ced783bf84c2b22be3c7d42e','0.0000','SGD','kg','0.0000','0.0000',1),(84,5,0,'2010-06-08 15:15:50','246.0000',1,'ef93b98b878f927eaf4e80a6e1c5ba453c3efcb6','0.0000','SGD','kg','0.0000','0.0000',1),(85,5,0,'2010-06-08 15:15:51','246.0000',1,'e87fbb48d46e778c4982144ef11e26f46fbf11cc','0.0000','SGD','kg','0.0000','0.0000',1),(86,5,0,'2010-06-08 15:15:51','246.0000',1,'a26adf5d683a6d4d13e354e2514233a71aa3bd98','0.0000','SGD','kg','0.0000','0.0000',1),(87,5,0,'2010-06-08 15:15:51','246.0000',1,'ef81cfaf4559ed0398b0fb20e6017c3e830637f3','0.0000','SGD','kg','0.0000','0.0000',1),(88,5,0,'2010-06-08 15:17:05','246.0000',1,'7a5fec0372966284730b7f2667a06108d0677c15','0.0000','SGD','kg','0.0000','0.0000',1),(89,5,0,'2010-06-08 15:17:06','246.0000',1,'5ec911dfe34bf6702c99896b0fc3f2057964e3aa','0.0000','SGD','kg','0.0000','0.0000',1),(90,5,0,'2010-06-08 15:17:06','246.0000',1,'7bbfe0e52c8a10b919e70f1a5f9ead749b8309fa','0.0000','SGD','kg','0.0000','0.0000',1),(91,5,0,'2010-06-08 15:17:06','246.0000',1,'324a8e84a0daee2a2f2f101e39877a070cf9a4d0','0.0000','SGD','kg','0.0000','0.0000',1),(92,5,0,'2010-06-08 15:17:07','246.0000',1,'5ca14ebd4a727dd470a194d3f61fac2b4170f819','0.0000','SGD','kg','0.0000','0.0000',1),(93,5,0,'2010-06-08 15:17:07','246.0000',1,'edf31de95f3c8a9e6bcb1134846f9c494d5a68da','0.0000','SGD','kg','0.0000','0.0000',1),(94,5,0,'2010-06-08 15:17:07','246.0000',1,'e7aeac77b22f6d220439eb042abf429ef94917f6','0.0000','SGD','kg','0.0000','0.0000',1),(95,5,0,'2010-06-08 15:17:08','246.0000',1,'33c19f24f8d1700bd585ddf827eb5f57ee790742','0.0000','SGD','kg','0.0000','0.0000',1),(96,5,0,'2010-06-08 15:17:08','246.0000',1,'3339447c37859ec50a0f7e445c8f22a66bcdf160','0.0000','SGD','kg','0.0000','0.0000',1),(97,5,0,'2010-06-08 15:17:09','246.0000',1,'f8851800f4d3e4653704fc2af2ba35e59ed75bb7','0.0000','SGD','kg','0.0000','0.0000',1),(98,5,0,'2010-06-08 15:17:09','246.0000',1,'b588cdf903383122f31ab5d638aade452e086eb0','0.0000','SGD','kg','0.0000','0.0000',1),(99,5,0,'2010-06-08 15:17:09','246.0000',1,'9c9082138a881a7fed3cc6f253f451b41ceff92e','0.0000','SGD','kg','0.0000','0.0000',1),(100,5,0,'2010-06-08 15:17:10','246.0000',1,'eeb1e79b422cc9a73c59c3eb86b3e13d30fc660f','0.0000','SGD','kg','0.0000','0.0000',1),(101,5,0,'2010-06-08 15:17:10','246.0000',1,'c2add5935ee90132808cbb6e0b6eed71e4dbadf2','0.0000','SGD','kg','0.0000','0.0000',1),(102,5,0,'2010-06-08 15:17:10','246.0000',1,'8e7d87f8fbdd806ce18d7c4cc1bb2db2184841fb','0.0000','SGD','kg','0.0000','0.0000',1),(103,5,0,'2010-06-08 15:17:11','246.0000',1,'d31c9c7cbb7b85b7778289469fee31db23a53191','0.0000','SGD','kg','0.0000','0.0000',1),(104,5,0,'2010-06-08 15:17:11','246.0000',1,'2aaaf18ad3f4df7f9643d4244e5cd8429d2a9420','0.0000','SGD','kg','0.0000','0.0000',1),(105,5,0,'2010-06-08 15:17:11','246.0000',1,'f23a03a91f9dc54886ee45c4ca1b894d99f2f87c','0.0000','SGD','kg','0.0000','0.0000',1),(106,5,0,'2010-06-08 15:17:12','246.0000',1,'4866e113663634a9991b19f9e25995cfab67bb43','0.0000','SGD','kg','0.0000','0.0000',1),(107,5,0,'2010-06-08 15:17:12','246.0000',1,'c558749d531d6c8a13e1f2f8cdd69aebc46364d0','0.0000','SGD','kg','0.0000','0.0000',1),(108,5,0,'2010-06-08 15:17:13','246.0000',1,'738ede62952d0622a1506c8c5a9c8c7bef1cf09a','0.0000','SGD','kg','0.0000','0.0000',1),(109,5,0,'2010-06-08 15:17:45','246.0000',1,'75cd444f60211f4e7c408634df1c7be289f16da7','0.0000','SGD','kg','0.0000','0.0000',1),(110,5,0,'2010-06-09 04:41:17','12.0000',1,'981f3a75365e13c21611603fe8af3f3abe31a7e5','0.0000','SGD','kg','0.0000','0.0000',1),(111,5,7,'2010-06-09 04:51:30','123.0000',1,'15ac6c0ed847a61edff3d4e0309137e707a65b55','0.0000','SGD','kg','0.0000','0.0000',1),(112,5,7,'2010-06-09 04:55:56','135.0000',1,'b4b950a650900b9d0ec1b41c25c35dfd73504ac1','0.0000','SGD','kg','0.0000','0.0000',1),(113,5,0,'2010-06-09 04:59:45','258.0000',1,'98ea858f43478b0477275e507f44d83302c98c02','0.0000','SGD','kg','0.0000','0.0000',1),(114,5,0,'2010-06-09 05:07:56','369.0000',1,'f624f9d710357adfec83434a9edd270b277faec3','0.0000','SGD','kg','0.0000','0.0000',1),(115,5,0,'2010-06-09 05:12:51','369.0000',1,'73d35a0faa70101719dd4300a81911640244e106','0.0000','SGD','kg','0.0000','0.0000',1),(116,5,0,'2010-06-09 05:33:54','12.0000',1,'c4a9eb439f0c4cf27fb5a4468cf6c95ad1e8e6c3','0.0000','SGD','kg','0.0000','0.0000',1),(117,5,0,'2010-06-09 05:37:21','12.0000',1,'fead420d43dd86cc178aea0dbcbb49ec4908e262','0.0000','SGD','kg','0.0000','0.0000',1),(118,5,0,'2010-06-09 05:38:14','12.0000',1,'ecdff9eceb6b1a70bd9ca4cd0fea6eb208cfd56b','0.0000','SGD','kg','0.0000','0.0000',1),(119,5,0,'2010-06-09 05:44:13','12.0000',1,'254b0a7095bd69ffd5b95f7a321848731dff8036','0.0000','SGD','kg','0.0000','0.0000',1),(121,5,0,'2010-06-09 05:46:14','12.0000',1,'7e073149e16e4fe9daaa4958701852b594b527b7','0.0000','SGD','kg','0.0000','0.0000',1),(123,5,0,'2010-06-09 06:04:32','36.0000',1,'d75417ea4a7b7794472da843adc683c776f1e1b8','0.0000','SGD','kg','0.0000','0.0000',1),(124,5,0,'2010-06-09 06:08:49','36.0000',1,'30ba43fa0bd522c5a8699d65b2e1afc93f8fd1d1','0.0000','SGD','kg','0.0000','0.0000',1),(125,5,0,'2010-06-09 08:12:13','12.0000',1,'a62f956c063c7b2770c9bcd71f73ce0d81eb1c8a','0.0000','SGD','kg','0.0000','0.0000',1),(126,5,0,'2010-06-09 08:13:57','12.0000',1,'bc5d3f491a98fc17e479f9a1ac7eabd983836a0f','0.0000','SGD','kg','0.0000','0.0000',1),(127,5,0,'2010-06-09 08:22:34','12.0000',1,'4ae722ca41ae23e3b8e23efb8af962249e6f40de','0.0000','SGD','kg','0.0000','0.0000',1),(128,5,0,'2010-06-09 08:26:57','12.0000',1,'b562c67cc0b58c39202222b120029d479fd0f442','0.0000','SGD','kg','0.0000','0.0000',1),(129,5,0,'2010-06-09 11:24:49','12.0000',1,'4dc37c8caa5ce1e744e389d0079ab363867677db','0.0000','SGD','kg','0.0000','0.0000',1),(130,5,0,'2010-06-09 12:57:37','12.0000',1,'8eafc4da080d866935e6ba34a9e11c7f3df5b9cb','0.0000','SGD','kg','0.0000','0.0000',1),(131,5,0,'2010-06-10 07:05:11','12.0000',1,'93c487f5fd9c6960d3104e722916bf5aea413ffb','0.0000','SGD','kg','0.0000','0.0000',1),(132,5,0,'2010-07-11 14:20:31','12.0000',1,'e52d76b64c305aad135faa0689ed53ade94e2a1e','0.0000','SGD','kg','0.0000','0.0000',1),(133,5,0,'2010-07-21 11:10:07','12.0000',1,'a4de175c7f635007d43a43f60ee89f548786d72a','0.0000','SGD','kg','0.0000','0.0000',1),(134,5,0,'2010-07-25 04:51:27','24.0000',1,'6ebc39f8e50d56603ba209aa8f81c6390356d5bf','0.0000','SGD','kg','0.0000','0.0000',1),(135,5,0,'2010-07-25 05:00:55','12.0000',1,'83aec630d7fc55ace58437525ec9cf2d05e327fa','0.0000','SGD','kg','0.0000','0.0000',1),(136,5,0,'2010-07-25 06:22:38','12.0000',1,'9509495150e57ef44be714f00a0509c88a7648e3','0.0000','SGD','kg','0.0000','0.0000',1),(137,5,0,'2010-07-25 06:24:02','12.0000',1,'f138288590c0745a07f697287d2b10855a426318','0.0000','SGD','kg','0.0000','0.0000',1),(144,5,0,'2010-07-26 12:06:31','3.0000',1,'0b66427629304a3c6374519b35703446813a3d81','0.0000','SGD','kg','0.0000','0.0000',1),(145,5,0,'2010-07-26 12:11:48','1.0000',1,'5ecaff8979d62327848be2afd3aa63de2a3cfb78','0.0000','SGD','kg','0.0000','0.0000',1),(146,5,0,'2010-07-26 12:14:12','2.0000',1,'1a5356877fcddd480c9210eaf0610ab6f634f278','0.0000','SGD','kg','0.0000','0.0000',1),(147,5,0,'2010-07-26 12:25:37','1.0000',1,'a7fe772406c54916d1fa0e5e7a51c02228a92628','0.0000','SGD','kg','0.0000','0.0000',1),(148,5,0,'2010-07-26 12:38:32','1.0000',1,'5a54dee2a370079824d858f27f3f7ac53191f6bf','0.0000','SGD','kg','0.0000','0.0000',1),(149,5,0,'2010-07-26 12:45:54','1.0000',1,'aab03550362a8e62fb357e2506f51462d44059b0','0.0000','SGD','kg','0.0000','0.0000',1),(150,5,0,'2010-07-27 04:04:02','1.0000',1,'51374d48b4a1804273b510421cb8e78882055328','0.0000','SGD','kg','0.0000','0.0000',1),(151,5,0,'2010-07-27 04:14:44','1.0000',1,'a1a2d303613bd1b257cbd0318b306890731e8874','0.0000','SGD','kg','0.0000','0.0000',1),(152,5,0,'2010-07-28 13:52:38','1.0000',1,'af4ffa36152b940d374228696958b95b464b6953','0.0000','SGD','kg','0.0000','0.0000',1),(153,5,0,'2010-07-28 14:33:30','1.0000',1,'31a97d7bafbb23201b852ef465370f3dea7f902a','0.0000','SGD','kg','0.0000','0.0000',1),(154,5,0,'2010-07-28 15:12:56','1.0000',1,'c6862dad27af1a8fa38c8ca5345e5d62c8809b2b','0.0000','SGD','kg','0.0000','0.0000',1),(155,5,0,'2010-07-28 15:25:17','1.0000',1,'949ac718f8bd1e2d57417c8fd4ffd199ca4edf8b','0.0000','SGD','kg','0.0000','0.0000',1),(156,5,0,'2010-07-29 09:25:24','2.0000',1,NULL,'0.0000','SGD','kg','0.0000','0.0000',1),(157,5,0,'2010-07-29 09:26:35','2.0000',1,NULL,'0.0000','SGD','kg','0.0000','0.0000',1),(158,5,0,'2010-07-29 09:31:07','2.0000',1,NULL,'0.0000','SGD','kg','0.0000','0.0000',1),(159,5,0,'2010-07-29 09:38:44','2.0000',1,NULL,'0.0000','SGD','kg','0.0000','0.0000',1),(160,5,0,'2010-07-29 09:41:15','2.0000',1,'4cb45fef24f1acec7042add4e06e21b5d82ad4ad','0.0000','SGD','kg','0.0000','0.0000',1),(161,5,0,'2010-07-29 09:49:58','2.0000',1,'8a24724c63a4ea08a4cf462ccb604992430e6bbc','0.0000','SGD','kg','0.0000','0.0000',1),(162,5,0,'2010-07-29 09:52:55','2.0000',1,'060f65282c7c518d399707197ce6be1ed859078e','0.0000','SGD','kg','0.0000','0.0000',1),(163,5,0,'2010-07-29 10:25:35','2.0000',1,'86029621f88cef3416ada5a00180d5717664090e','0.0000','SGD','kg','0.0000','0.0000',1),(164,5,0,'2010-07-29 10:51:33','2.0000',1,'a7344af227f7beb5bbe5cffcb261f37f5ba35de2','0.0000','SGD','kg','0.0000','0.0000',1),(165,5,0,'2010-07-29 10:52:31','2.0000',1,'80f3ff78b536ef9e3dbb7bfdcfbbe43c08734458','0.0000','SGD','kg','0.0000','0.0000',1),(166,5,0,'2010-07-29 10:54:37','2.0000',1,'180e422ebf69664566a086edcce314b2ded131b5','0.0000','SGD','kg','0.0000','0.0000',1),(167,5,0,'2010-07-29 10:56:07','2.0000',1,'73eab98729a3e507f3d13f310cbd64114f1f215b','0.0000','SGD','kg','0.0000','0.0000',1),(168,5,0,'2010-07-29 14:17:17','1.0000',1,'c9fda5967e40f7407b556b208b2d9ed3c4781826','0.0000','SGD','kg','0.0000','0.0000',1),(169,5,0,'2010-07-29 15:35:42','1.0000',1,'207b07b169bac76fc0a2300d8e47f639977abad1','0.0000','SGD','kg','0.0000','0.0000',1),(170,5,0,'2010-07-29 15:49:50','1.0000',1,'b29fb440deff6a7dbc78fef4055772a7341e760b','0.0000','SGD','kg','0.0000','0.0000',1),(171,5,0,'2010-07-29 15:50:24','1.0000',1,'8975a7f38d4ae3f49aa34e8f97f4a023e9a24423','0.0000','SGD','kg','0.0000','0.0000',1),(172,5,0,'2010-07-29 16:01:24','1.0000',1,'03c9603df9ad9bba6a9c1b4d44d09ed25a79e2a3','0.0000','SGD','kg','0.0000','0.0000',1),(173,5,0,'2010-07-29 16:08:04','2.0000',1,'e1ac7976a50a38b658f74db9bd02e88b7d9b892a','0.0000','SGD','kg','0.0000','0.0000',1),(174,5,0,'2010-07-29 16:10:54','1.0000',1,'9db395e0897cd6aab54e2f5dc821c6f33682ef4b','0.0000','SGD','kg','0.0000','0.0000',1),(175,5,0,'2010-07-29 16:12:14','1.0000',1,'91e7353c026db073b77d638ba2cb82ddf9d073e8','0.0000','SGD','kg','0.0000','0.0000',1),(176,5,0,'2010-07-29 16:17:40','1.0000',1,'70acc535bb1010a2b40c0810bf8dd3d0e0ba8260','0.0000','SGD','kg','0.0000','0.0000',1),(177,5,0,'2010-07-29 16:26:20','1.0000',1,'24e9ff148cace8e18a5a4fdf3fb9381ae6ed4849','0.0000','SGD','kg','0.0000','0.0000',1),(178,5,0,'2010-07-29 16:28:35','1.0000',1,'f00460fc8963428eb2a15323d9b2f07e4a9f6af5','0.0000','SGD','kg','0.0000','0.0000',1),(179,5,0,'2010-07-29 16:34:26','1.0000',1,'8d2141627deb44ede4cb4cd3d15a8d212b681cad','0.0000','SGD','kg','0.0000','0.0000',1),(180,5,0,'2010-07-29 16:37:06','1.0000',1,'8786aaff4011a8dec7c975eae350d103a1c6e8e1','0.0000','SGD','kg','0.0000','0.0000',1),(181,5,0,'2010-07-29 16:44:42','1.0000',1,'ade07e06b9d26d7a0a211157127a1523ad8ee47c','0.0000','SGD','kg','0.0000','0.0000',1),(182,5,0,'2010-07-29 16:46:21','1.0000',1,'d0b6da488e9f140f129ffed4ba0e016a34cc0c06','0.0000','SGD','kg','0.0000','0.0000',1),(183,5,0,'2010-07-29 16:50:25','1.0000',1,'789dc25e465c950f0cd63d09587233a9b930874f','0.0000','SGD','kg','0.0000','0.0000',1),(184,5,0,'2010-07-29 16:56:34','1.0000',1,'d0b5c1a9e938535156a2715afdcf92517db86a82','0.0000','SGD','kg','0.0000','0.0000',1),(185,5,0,'2010-07-29 17:00:33','1.0000',1,'49ba1fc1505c4aeed190d2794f6b76894a238864','0.0000','SGD','kg','0.0000','0.0000',1),(186,5,0,'2010-07-29 17:59:12','1.0000',1,'9d63bcdb13dbaeb59ca19a543f536c4e6eb1e8bc','0.0000','SGD','kg','0.0000','0.0000',1),(187,5,0,'2010-07-29 18:01:31','1.0000',1,'49ff222aab2789232fc6eaa71bd3fc37f489d479','0.0000','SGD','kg','0.0000','0.0000',1),(188,5,0,'2010-07-29 18:01:35','1.0000',1,'f3f056637be01118a3adfff1a70e0cb49903684a','0.0000','SGD','kg','0.0000','0.0000',1),(189,5,0,'2010-07-29 18:02:38','1.0000',1,'a02dd5c3c69189ec01bf53f89fdde7c810cdb999','0.0000','SGD','kg','0.0000','0.0000',1),(190,5,0,'2010-07-29 18:03:52','1.0000',1,'ed3475d0066b3490a52ef5626d9507e0783174a8','0.0000','SGD','kg','0.0000','0.0000',1),(191,5,0,'2010-07-29 18:05:15','1.0000',1,'999e9b94cb74a93eb9050819f3e8ecd0bb3c31ca','0.0000','SGD','kg','0.0000','0.0000',1),(192,5,0,'2010-07-29 18:07:52','1.0000',1,'8b564e7f5de783fa26cb2a566665efd69561656b','0.0000','SGD','kg','0.0000','0.0000',1),(193,5,0,'2010-07-29 18:08:50','1.0000',1,'0f9b5d00096c5df90c68158c32f7a76430ffbae1','0.0000','SGD','kg','0.0000','0.0000',1),(194,5,0,'2010-07-30 02:17:24','1.0000',1,'70afdf1ab34be3d17430b2151f8d3a0a8609195f','0.0000','SGD','kg','0.0000','0.0000',1),(195,5,0,'2010-07-30 02:49:44','2.0000',1,'c6f82cb8005ec5bd91abed80504945488c84fcb4','0.0000','SGD','kg','0.0000','0.0000',1),(196,5,0,'2010-07-30 02:55:12','2.0000',1,'31e1c87c3d6a618d54a02a9ea32aad42e699c6a7','0.0000','SGD','kg','0.0000','0.0000',1),(197,5,0,'2010-07-30 02:56:09','2.0000',1,'e5552bf2a53889c3aaeffdf71c26acafb320091f','0.0000','SGD','kg','0.0000','0.0000',1),(198,5,0,'2010-07-30 03:02:52','2.0000',1,'1d6893470f7736ed8babb7a5ff67458ba096be33','0.0000','SGD','kg','0.0000','0.0000',1),(199,5,0,'2010-07-30 03:56:48','2.0000',1,'8242aece34c6e679425ac6b1741ede8cc16df020','0.0000','SGD','kg','0.0000','0.0000',1),(200,5,0,'2010-07-30 04:05:16','2.0000',1,'7de8878cc027411d2ab258027f4a7f0e873b882b','0.0000','SGD','kg','0.0000','0.0000',1),(201,5,0,'2010-07-30 04:08:03','2.0000',1,'51dc61bc71ed375bec03bc2c6d37ece40131e540','0.0000','SGD','kg','0.0000','0.0000',1),(202,5,0,'2010-07-30 04:11:07','2.0000',1,'86b26acbdd244913934b0172bbd36140aa70d48a','0.0000','SGD','kg','0.0000','0.0000',1),(203,5,0,'2010-07-30 04:14:01','2.0000',1,'346525b1013788c94c6fe402f4720b6fcd4887b3','0.0000','SGD','kg','0.0000','0.0000',1),(204,5,0,'2010-07-30 04:18:10','2.0000',1,'a78ec069888c87de68b42df2deaf4b519954f58e','0.0000','SGD','kg','0.0000','0.0000',1),(205,5,0,'2010-07-30 04:20:40','2.0000',1,'1ae12a13cf3a1b2da2a58c2a13972983deacb729','0.0000','SGD','kg','0.0000','0.0000',1),(206,5,0,'2010-07-30 04:23:01','2.0000',1,'3c00a9271c15c251d0070244a95dc20bafb91e3b','0.0000','SGD','kg','0.0000','0.0000',1),(207,5,0,'2010-07-30 04:24:52','2.0000',1,'feeda749444f81e93ac53fbad8dd938046a2ef61','0.0000','SGD','kg','0.0000','0.0000',1),(208,5,0,'2010-07-30 04:26:19','2.0000',1,'cbc8ce5c1b74bdb8b3349b5ff51a4a2e48aea8c1','0.0000','SGD','kg','0.0000','0.0000',1),(209,5,0,'2010-07-30 13:26:03','1.0000',1,'687b202cf09a72498744e097fd16d366ed686f03','0.0000','SGD','kg','0.0000','0.0000',1),(210,5,0,'2010-07-30 13:29:34','1.0000',1,'797dc6cfa0560bb7ee907491d69f56caec43e035','0.0000','SGD','kg','0.0000','0.0000',1),(211,5,0,'2010-07-30 13:35:46','1.0000',1,'f5a22d152c574e159b65cbf2ab9035e23ef38401','0.0000','SGD','kg','0.0000','0.0000',1),(212,5,0,'2010-07-30 13:37:22','1.0000',1,'b9769ebe755e61dfe72f49a05f640e09e29a21d0','0.0000','SGD','kg','0.0000','0.0000',1),(213,5,0,'2010-07-30 13:42:56','1.0000',1,'545df42e6d16d4cbf381dad690db0fc2d789d758','0.0000','SGD','kg','0.0000','0.0000',1),(214,5,0,'2010-07-30 13:49:28','2.0000',1,'6042210adc1e59cc93ad52dfa912439977950bd3','0.0000','SGD','kg','0.0000','0.0000',1),(215,5,0,'2010-07-30 13:55:07','3.0000',1,'08b69ca0872668aa350ddeb0c0ab8ba578e4a2b1','0.0000','SGD','kg','0.0000','0.0000',1),(216,5,0,'2010-07-30 14:06:22','1.0000',1,'f2a116f41bd7548a50873b346be3ded63765ddb0','0.0000','SGD','kg','0.0000','0.0000',1),(217,5,0,'2010-07-30 14:19:46','1.0000',1,'b6b2be65995e4dd51197a12884eabc0087cbcfa9','0.0000','SGD','kg','0.0000','0.0000',1),(218,5,0,'2010-07-30 15:03:32','2.0000',1,'b5a23057eabd7636c286950b56646a2964925eb6','0.0000','SGD','kg','0.0000','0.0000',1),(219,5,0,'2010-07-30 15:03:45','3.0000',1,'cae5266878e5eee9d88d33dcdb1975a08a835331','0.0000','SGD','kg','0.0000','0.0000',1),(220,5,0,'2010-07-30 16:11:00','4.0000',1,'8b104f6062b831a7d9d4381f5fd4b180d47d06f5','0.0000','SGD','kg','0.0000','0.0000',1),(221,5,0,'2010-07-30 16:13:41','4.0000',1,'35267c2e1167db7aa836dd0d532343591fdb3223','0.0000','SGD','kg','0.0000','0.0000',1),(222,5,0,'2010-07-30 16:25:33','4.0000',1,'fae2f4c95e72a692cb3caf4e93909f859f1b9de9','0.0000','SGD','kg','0.0000','0.0000',1),(223,5,0,'2010-07-30 16:26:56','4.0000',1,'699bada56afa423ec3ac3b3122b4a23b4ed7d943','0.0000','SGD','kg','0.0000','0.0000',1),(224,5,0,'2010-07-30 16:28:24','4.0000',1,'8a4af0deb3da7c146299da0fbac87f8f92bad9ca','0.0000','SGD','kg','0.0000','0.0000',1),(225,5,0,'2010-07-30 16:29:25','2.0000',1,'2923f46d4a61f5e125c9740983f99e280787fb58','0.0000','SGD','kg','0.0000','0.0000',1),(226,5,0,'2010-07-30 16:33:02','2.0000',1,'a9c12d2e63fdd167cba16203822bf597da2e07f4','0.0000','SGD','kg','0.0000','0.0000',1),(227,5,0,'2010-07-30 16:35:57','2.0000',1,'5b41b539215137a604bbbd50876ebe516e21c069','0.0000','SGD','kg','0.0000','0.0000',1),(228,5,0,'2010-07-30 16:38:55','2.0000',1,'b7ad379eab4ffb4663d686c98aefc0e1c5c48b6b','0.0000','SGD','kg','0.0000','0.0000',1),(229,5,0,'2010-07-30 17:29:56','1.0000',1,'6d7441e0b16e26e7c321a21bfada31fbfd6253bb','0.0000','SGD','kg','0.0000','0.0000',1),(230,5,0,'2010-07-30 19:01:56','1.0000',1,'b79a6bc2daf6266334bedd6871b0f2cf7079d5f0','0.0000','SGD','kg','0.0000','0.0000',1),(231,5,0,'2010-07-30 19:08:57','1.0000',1,'40b51dc4e9915f8454d6f22595fafcea615d96f9','0.0000','SGD','kg','0.0000','0.0000',1),(232,5,0,'2010-07-30 19:12:09','1.0000',1,'7ebc1fd00622a5082a5da225e05012bf3c81828b','0.0000','SGD','kg','0.0000','0.0000',1),(233,5,0,'2010-07-30 19:13:28','1.0000',1,'8c561af09909bc39f358179f41a2cb7702a11ba7','0.0000','SGD','kg','0.0000','0.0000',1),(234,5,0,'2010-07-30 19:14:08','1.0000',1,'7809cc9e0b52bb7d9879265ba1ec300e4b2d0e70','0.0000','SGD','kg','0.0000','0.0000',1),(235,5,0,'2010-07-30 19:14:10','1.0000',1,'a3bf96f8ef44ca2e2064da139676ac0913c85e97','0.0000','SGD','kg','0.0000','0.0000',1),(236,5,0,'2010-07-30 19:14:12','1.0000',1,'c78020761110464551021546ad49581c22bceee9','0.0000','SGD','kg','0.0000','0.0000',1),(237,5,0,'2010-07-30 19:17:33','1.0000',1,'86f5e9b2c61a206edbf80c2014cc775ced34fb15','0.0000','SGD','kg','0.0000','0.0000',1),(238,5,0,'2010-07-30 19:19:27','1.0000',1,'c4e51076b6955ff6a866c28c57c2a9acaa1b301a','0.0000','SGD','kg','0.0000','0.0000',1),(239,5,0,'2010-07-30 19:22:51','1.0000',1,'d7482dc48d23a5e4b2079a5815a8bfeb6dce0a11','0.0000','SGD','kg','0.0000','0.0000',1),(240,5,0,'2010-07-30 19:24:28','1.0000',1,'142d9d7b0a722353b3a6f137aa744288d97cf5a1','0.0000','SGD','kg','0.0000','0.0000',1),(241,5,0,'2010-07-30 19:25:55','1.0000',1,'457523570f2226cfd9400bb82b93813d4c2c105d','0.0000','SGD','kg','0.0000','0.0000',1),(242,5,0,'2010-07-30 19:29:20','1.0000',1,'cfc172531038e62d72e8a14cb0b618168a88053c','0.0000','SGD','kg','0.0000','0.0000',1),(243,5,0,'2010-07-30 19:38:32','2.0000',1,'3bee661c8ea2f0ce234c18b2532e3e0482223fe4','0.0000','SGD','kg','0.0000','0.0000',1),(244,5,0,'2010-07-30 19:41:15','2.0000',1,'93aa149974ec0c5dfef35d023aae3e9ce81e8052','0.0000','SGD','kg','0.0000','0.0000',1),(245,5,0,'2010-07-30 19:47:13','1.0000',1,'697751098cbc446855c41cfd7a4099feb880c870','0.0000','SGD','kg','0.0000','0.0000',1),(246,5,0,'2010-07-30 19:49:25','3.0000',1,'b0522d529a4f3b89616a17dfefbe968e000e0056','0.0000','SGD','kg','0.0000','0.0000',1),(247,5,0,'2010-07-30 19:55:24','1.0000',1,'558521c8100c2e98613d038bfb15b83df3db8169','0.0000','SGD','kg','0.0000','0.0000',1),(248,5,0,'2010-07-30 20:15:56','1.0000',1,'943d96813ffa408c7973e6c1b2b0fdb4b9e4540a','0.0000','SGD','kg','0.0000','0.0000',1),(249,5,0,'2010-07-30 20:18:49','1.0000',1,'a7ea67501e8a39b27b24841ccc996f25a117516d','0.0000','SGD','kg','0.0000','0.0000',1),(250,5,0,'2010-07-30 20:22:34','1.0000',1,'da0ef0cc9af44bc7981fde9d060533ba9202154d','0.0000','SGD','kg','0.0000','0.0000',1),(251,5,0,'2010-07-31 03:38:52','1.0000',1,'3e930481e873929f8416ca708b7c36f4a5e7dfe7','0.0000','SGD','kg','0.0000','0.0000',1),(252,5,0,'2010-07-31 07:27:46','2.0000',1,'47cc3b79f408346a55344b1ebaa22b7564cd5134','0.0000','SGD','kg','0.0000','0.0000',1),(253,5,0,'2010-07-31 07:56:03','1.0000',1,'9c94dfc10322b5edd4c610f0efcc3b2421a45a73','0.0000','SGD','kg','0.0000','0.0000',1),(254,5,0,'2010-07-31 08:10:59','1.0000',1,'bf2213f39af2aeb69eb4c21f8aba25b92eaa0935','0.0000','SGD','kg','0.0000','0.0000',1),(255,5,0,'2010-07-31 08:19:46','2.0000',1,'e07a76772131a3b23edd467d98e7181792c6dc2e','0.0000','SGD','kg','0.0000','0.0000',1),(256,5,0,'2010-07-31 08:54:13','7.0000',1,'303a1e65bf0c53f77f83340dadfa7923e14536f5','0.0000','SGD','kg','0.0000','0.0000',1),(257,5,0,'2010-08-01 05:53:36','1.0000',1,'14e0cc9d23ebeceee909e13e05027e602460b8aa','0.0000','SGD','kg','0.0000','0.0000',1),(258,5,0,'2010-08-01 06:02:13','2.0000',1,'0de62efb734398ad616b0bf46cdc00d7ddf57f6e','0.0000','SGD','kg','0.0000','0.0000',1),(259,5,0,'2010-08-01 06:04:35','1.0000',1,'dab123c504358a1e4e8284b2c45b6e87660db2a0','0.0000','SGD','kg','0.0000','0.0000',1),(260,5,0,'2010-08-01 06:07:02','3.0000',1,'31d01e01afb5004c016a47d2ed89d263ccffd37b','0.0000','SGD','kg','0.0000','0.0000',1),(261,5,0,'2010-08-01 06:15:11','1.0000',1,'667630253f9d54efcf2062beef3a462ac117ad3c','0.0000','SGD','kg','0.0000','0.0000',1),(262,5,0,'2010-08-01 06:16:13','1.0000',1,'fd89f06ae35d55ae3c136d8b7723e1537e10e4eb','0.0000','SGD','kg','0.0000','0.0000',1),(263,5,0,'2010-08-01 06:17:53','2.0000',1,'28cb21eb715a88c6f722e60adb3f68d3f3531e2f','0.0000','SGD','kg','0.0000','0.0000',1),(264,5,0,'2010-08-01 06:31:13','7.0000',1,'b73b8ffe5768a669c4274e5bc3d59e69a2e71b74','0.0000','SGD','kg','0.0000','0.0000',1),(265,5,0,'2010-08-01 06:31:43','5.0000',1,'ab90a17f1203e32f48fca456091d764786c7a683','0.0000','SGD','kg','0.0000','0.0000',1),(266,5,0,'2010-08-01 06:34:35','3.0000',1,'d74a746151afe9e82a8f5b10b3969f0e1bcd89da','0.0000','SGD','kg','0.0000','0.0000',1),(267,5,0,'2010-08-01 06:57:45','3.0000',1,'cee356ef789943814d1b76f2d605106dd0c12294','0.0000','SGD','kg','0.0000','0.0000',1),(268,5,0,'2010-08-01 10:38:40','2.0000',1,'5d5d116208cb297f791f01fab0cf1d6c1fd1d690','0.0000','SGD','kg','0.0000','0.0000',1),(269,5,0,'2010-08-01 10:38:59','2.0000',1,'30f1f5ccbdee8029d6d6f3930e01a9d47ec6de12','0.0000','SGD','kg','0.0000','0.0000',1),(270,5,0,'2010-08-01 10:54:23','1.0000',1,'17616c873ec4e2d214856ec4b852d45d723e4bc6','0.0000','SGD','kg','0.0000','0.0000',1),(271,5,0,'2010-08-10 04:57:53','3.0000',1,'579e0be26f18cbfafc3c2e2f5bd2c3bd15bb33c9','0.0000','SGD','kg','0.0000','0.0000',1),(272,5,0,'2010-08-10 04:58:03','3.0000',1,'6a1858f8b196ecf1c219e96e45f8a36e362c3c3f','0.0000','SGD','kg','0.0000','0.0000',1),(273,5,0,'2010-09-17 07:11:01','123.0000',1,'30d9bc1ab953b40ae2def4480f2d8af792b534bc','0.0000','SGD','kg','0.0000','0.0000',1),(274,5,0,'2010-09-17 07:25:00','123.0000',1,'20f8029ba4addc672a116b3da9f41c63b106c7e4','0.0000','SGD','kg','0.0000','0.0000',1),(275,5,0,'2010-09-17 07:26:32','123.0000',1,'93c4daf4adb7d7ce5b891a78e216bb3fd898d11a','0.0000','SGD','kg','0.0000','0.0000',1),(276,5,0,'2010-09-17 07:28:40','123.0000',1,'90ada192b7633c8981f36f9cf46640e20a0a13d2','0.0000','SGD','kg','0.0000','0.0000',1),(277,5,0,'2010-09-17 07:32:52','123.0000',1,'807c7c861ac43175dc4f18271d52471ccfb8b0db','0.0000','SGD','kg','0.0000','0.0000',1),(278,5,0,'2010-09-17 07:34:50','123.0000',1,'e5ce3a0d021457c5b587d67e0f695cce20cb8ebc','0.0000','SGD','kg','0.0000','0.0000',1),(279,5,0,'2010-09-17 08:02:15','123.0000',1,'7317bb41b79c1177859b4f1bb3de6632774749b4','0.0000','SGD','kg','0.0000','0.0000',1),(280,5,0,'2010-09-20 08:29:25','131.0000',1,'30de8d8a33b1b380604d09d4c67dcda007c8f901','15.0000','SGD','kg','123.0000','0.0000',1),(281,5,0,'2010-09-21 08:12:35','17.0000',1,'a30829a8b3c9386bef065be4970a09c0555c0fe2','17.0000','SGD','kg','9.0000','9.0000',1),(282,5,0,'2010-09-21 09:24:48','20.0000',1,'983958a5049869636fb9dace1e6dee3b5d188c48','20.0000','SGD','kg','12.0000','12.0000',1),(283,5,0,'2010-09-21 09:58:43','24.0000',1,'6da66ab9735c3998c3376917a834a426bd4f7dfe','24.0000','SGD','kg','12.0000','12.0000',1),(284,5,0,'2010-09-21 11:18:37','24.0000',1,'ba3c579888a2f7ae6663c139a40b1a6bf3bc9f66','24.0000','SGD','kg','12.0000','12.0000',1),(285,5,0,'2010-09-22 03:28:07','11.0000',1,'708cc556e9b9b2dd20cac93e9e8c6a372af1e329','11.0000','SGD','kg','3.0000','3.0000',1),(286,5,0,'2010-09-22 03:28:34','11.0000',1,'f5cb32cad1cd7c368ca600dac27eee6e92cdda5b','11.0000','SGD','kg','3.0000','3.0000',1),(287,5,0,'2010-09-22 03:28:58','11.0000',1,'f1b0812ab732af34c706f5b0f283ec3b72fd1fc3','11.0000','SGD','kg','3.0000','3.0000',1),(288,5,0,'2010-09-22 03:31:11','11.0000',1,'217b940d65aa52af2222df7de952733f42d284b9','11.0000','SGD','kg','3.0000','3.0000',1),(289,5,0,'2010-09-22 03:32:36','11.0000',1,'3692effabe33be94aeb08a86c2a0abb5569e0cfe','11.0000','SGD','kg','3.0000','3.0000',1),(290,5,0,'2010-09-22 03:34:21','11.0000',1,'5e32620538a97532539dae510d788ce90174ad0c','11.0000','SGD','kg','3.0000','3.0000',1),(291,5,0,'2010-09-22 03:37:28','11.0000',1,'20632dd85103331b6e469639f893a04b5e82bdda','11.0000','SGD','kg','3.0000','3.0000',1),(292,5,0,'2010-09-22 03:39:14','11.0000',1,'ce6e6cd5555ddddcf1c4d190d4e3e811dad183ac','11.0000','SGD','kg','3.0000','3.0000',1),(293,5,7,'2010-09-24 04:32:01','1002.0000',1,'ada2ba082b6a3dfd5104c865c204795da3e54039','152.0000','SGD','kg','898.0000','48.0000',0),(295,5,2,'2010-09-24 11:19:04','8.0000',1,'eb5778f75bbcc74bdbc60198a2def2351957ac54','8.0000','SGD','kg','0.0000','0.0000',0),(297,5,5,'2010-09-24 12:04:30','8.0000',1,'e4dd6d4d895adfebe1553a35bf70c1c4f04eb4fb','8.0000','SGD','kg','0.0000','0.0000',0),(298,5,6,'2010-09-24 12:06:08','0.0000',1,'908e0dfc8c5f3745a3cab4d93af0e0fdfa30c279','0.0000','SGD','kg','0.0000','0.0000',0),(299,5,7,'2010-09-24 12:08:54','0.0000',1,'6b0559d6b72148af25735a357e18141764f1d7b1','0.0000','SGD','kg','0.0000','0.0000',0),(300,5,8,'2010-09-24 12:10:50','0.0000',1,'e9bf4db7329d7541e46d19106f3574531795dd2b','0.0000','SGD','kg','0.0000','0.0000',0),(301,5,9,'2010-09-24 12:12:36','873.0000',1,'f4d371a5ffc96a65c46a4873ef482f84e5d9ff17','46.0000','SGD','kg','3.0000','3.0000',0),(302,5,0,'2010-09-30 00:16:29','123.0000',1,'759fd30374cab7c01d806f77fb7afeab0aa2bb2f','7.0000','SGD','kg','123.0000','7.0000',0),(303,5,45,'2010-09-30 00:27:05','246.0000',1,'ce177d6748d1aa1355fc1829cc94fde81590bd43','14.0000','SGD','kg','246.0000','14.0000',0),(304,5,46,'2010-10-01 04:14:29','373.0000',1,'0275a288286855d72306c1bb60bb2ef56775dfaf','25.0000','SGD','kg','369.0000','21.0000',0),(305,5,51,'2010-10-09 11:42:42','7.0000',1,'3f861a2b62463df9e546de4c2813a8b8f0b440f9','7.0000','SGD','kg','3.0000','3.0000',0),(306,5,52,'2010-10-09 12:15:02','8.0000',1,'95110610a7d6a023fbd0ac43946707ccd995c708','8.0000','SGD','kg','0.0000','0.0000',0),(307,5,61,'2010-10-11 09:18:47','501.0000',1,'ac6de72cec583f8088d4d8eabf68fd2ec7a7eb1a','76.0000','SGD','kg','449.0000','24.0000',0),(308,5,62,'2010-11-05 01:38:58','4.0000',1,'bdeaa6ce68935eaab08ced819aaa270d2d5d10f2','4.0000','SGD','kg','0.0000','0.0000',0),(309,5,63,'2010-11-06 07:39:58','4.0000',1,'686af27ef3640faca57a2d4f2b54ea37d4e3faf3','4.0000','SGD','kg','0.0000','0.0000',0),(310,5,64,'2010-11-06 07:48:18','4.0000',1,'8b568e5fd88e0dadee0d2cf25af226c87d0be34f','4.0000','SGD','kg','0.0000','0.0000',0),(311,5,65,'2010-11-06 07:50:54','8.0000',1,'08baf09ad0454e42d446dcd74ea9ef0a78e560cc','8.0000','SGD','kg','0.0000','0.0000',0),(312,5,66,'2010-11-06 07:59:16','8.0000',1,'9800ac4acd5261a134266eb171679f86db1955a4','8.0000','SGD','kg','0.0000','0.0000',0),(313,5,48,'2010-11-10 08:53:35','8.0000',1,'1521c972252fcacf0c133a78ab27a90aad7305fd','8.0000','SGD','kg','0.0000','0.0000',0);

/*Table structure for table `casual_surfers` */

DROP TABLE IF EXISTS `casual_surfers`;

CREATE TABLE `casual_surfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shop` (`shop_id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `casual_surfers` */

insert  into `casual_surfers`(`id`,`shop_id`,`user_id`) values (1,5,42),(2,5,43),(3,5,44),(4,5,45),(5,5,46),(6,5,48),(7,5,49),(8,5,50),(9,5,51),(10,5,52),(11,5,53),(12,5,54),(13,5,55),(14,5,56),(15,5,57),(16,5,58),(17,5,59),(18,5,60),(19,5,61),(20,5,62),(21,5,63),(22,5,64),(23,5,65),(24,5,66);

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
  PRIMARY KEY (`id`),
  KEY `shop` (`shop_id`),
  KEY `user` (`user_id`),
  CONSTRAINT `shop` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

/*Data for the table `customers` */

insert  into `customers`(`id`,`identity_code`,`shop_id`,`user_id`) values (1,NULL,5,7),(3,NULL,5,9),(4,NULL,5,10),(5,NULL,5,11),(6,NULL,5,12),(7,NULL,5,13),(8,NULL,5,14),(9,NULL,5,15),(10,NULL,5,16),(11,NULL,5,17),(12,NULL,5,18),(13,NULL,5,19),(14,NULL,5,20),(15,NULL,5,21),(16,NULL,5,22),(17,NULL,5,23),(20,NULL,5,26),(21,NULL,5,27),(22,NULL,5,28),(23,NULL,5,29),(24,NULL,5,30),(25,NULL,5,31),(26,NULL,5,32),(30,NULL,5,34),(31,NULL,5,35),(32,NULL,5,36),(33,NULL,5,37),(34,NULL,5,38),(35,NULL,5,39),(36,NULL,5,40),(37,NULL,5,41),(38,NULL,5,47);

/*Table structure for table `domains` */

DROP TABLE IF EXISTS `domains`;

CREATE TABLE `domains` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `primary` tinyint(1) NOT NULL DEFAULT '0',
  `always_redirect_here` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UniqueDomain` (`domain`),
  KEY `domain_to_shop` (`shop_id`),
  CONSTRAINT `domain_to_shop` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `domains` */

insert  into `domains`(`id`,`domain`,`shop_id`,`primary`,`always_redirect_here`) values (1,'http://localhost',5,0,0),(3,'http://shop4.ombi60.biz',5,1,0),(4,'http://shop3.ombi60.biz',4,1,0),(5,'http://shop7.ombi60.biz',6,1,0),(6,'http://test.com',5,0,0);

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
  PRIMARY KEY (`id`),
  KEY `merchant_to_shop` (`shop_id`),
  KEY `merchant_to_user` (`user_id`),
  CONSTRAINT `merchant_to_shop` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `merchant_to_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `merchants` */

insert  into `merchants`(`id`,`owner`,`shop_id`,`user_id`) values (7,1,1,1),(8,1,2,2),(9,1,3,3),(10,1,5,4),(11,1,5,5),(12,1,6,6);

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`,`product_id`),
  KEY `oli_to_order` (`order_id`),
  KEY `oli_to_product` (`product_id`),
  CONSTRAINT `oli_to_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `oli_to_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;

/*Data for the table `order_line_items` */

insert  into `order_line_items`(`id`,`order_id`,`product_id`,`product_price`,`product_quantity`,`status`,`product_title`,`product_weight`,`currency`,`weight_unit`,`shipping_required`) values (1,56,3,'123.0000',3,1,'product test',NULL,'SGD','kg',1),(4,58,3,'123.0000',3,1,'product test',NULL,'SGD','kg',1),(6,61,3,'123.0000',5,1,'product test',NULL,'SGD','kg',1),(7,62,3,'123.0000',5,1,'product test',NULL,'SGD','kg',1),(8,64,3,'123.0000',5,1,'product test',NULL,'SGD','kg',1),(9,66,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(10,67,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(11,68,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(12,69,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(26,92,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(27,93,3,'123.0000',4,1,'product test',NULL,'SGD','kg',1),(28,94,3,'123.0000',2,1,'product test',NULL,'SGD','kg',1),(29,96,3,'123.0000',2,1,'product test',NULL,'SGD','kg',1),(30,89,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(31,90,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(32,91,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(33,97,3,'123.0000',3,1,'product test',NULL,'SGD','kg',1),(34,98,3,'123.0000',3,1,'product test',NULL,'SGD','kg',1),(35,98,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(36,99,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(37,99,5,'12.0000',2,1,'test for delete',NULL,'SGD','kg',1),(38,100,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(39,100,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(40,101,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(41,101,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(42,102,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(43,103,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(44,104,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(45,105,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(46,106,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(47,107,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(48,108,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(49,109,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(50,110,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(51,111,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(52,112,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(53,113,3,'123.0000',2,1,'product test',NULL,'SGD','kg',1),(54,117,3,'123.0000',2,1,'product test',NULL,'SGD','kg',1),(55,118,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(56,119,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(57,120,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(58,120,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(59,121,3,'123.0000',2,1,'product test',NULL,'SGD','kg',1),(60,121,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(61,122,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(62,123,5,'12.0000',3,1,'test for delete',NULL,'SGD','kg',1),(63,124,5,'12.0000',3,1,'test for delete',NULL,'SGD','kg',1),(64,125,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(65,126,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(66,127,5,'12.0000',1,1,'test for delete',NULL,'SGD','kg',1),(67,128,5,'12.0000',2,1,NULL,NULL,'SGD','kg',1),(68,129,5,'12.0000',1,1,NULL,NULL,'SGD','kg',1),(69,130,5,'1.0000',1,1,NULL,NULL,'SGD','kg',1),(70,131,5,'1.0000',2,1,NULL,NULL,'SGD','kg',1),(71,132,5,'1.0000',7,1,'test for delete',NULL,'SGD','kg',1),(72,133,5,'1.0000',3,1,'test for delete',NULL,'SGD','kg',1),(73,134,5,'1.0000',1,1,'test for delete',NULL,'SGD','kg',1),(74,135,5,'1.0000',2,1,'test for delete',NULL,'SGD','kg',1),(75,136,5,'1.0000',5,1,'test for delete',NULL,'SGD','kg',1),(76,137,5,'1.0000',3,1,'test for delete',NULL,'SGD','kg',1),(77,138,5,'1.0000',3,1,'test for delete',NULL,'SGD','kg',1),(78,139,5,'1.0000',2,1,'test for delete',NULL,'SGD','kg',1),(79,140,5,'1.0000',1,1,'test for delete',NULL,'SGD','kg',1),(80,141,3,'123.0000',1,1,'product test',NULL,'SGD','kg',1),(81,142,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0),(82,142,14,'3.0000',3,1,'product 3','3.0000','SGD','kg',1),(83,143,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0),(84,143,14,'3.0000',4,1,'product 3','3.0000','SGD','kg',1),(85,144,15,'4.0000',3,1,'prodduct 4','4.0000','SGD','kg',0),(86,144,14,'3.0000',4,1,'product 3','3.0000','SGD','kg',1),(87,146,15,'4.0000',3,1,'prodduct 4','4.0000','SGD','kg',0),(88,146,14,'3.0000',4,1,'product 3','3.0000','SGD','kg',1),(89,147,15,'4.0000',2,1,'prodduct 4','4.0000','SGD','kg',0),(90,147,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(91,148,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(92,148,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(93,148,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(94,148,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(95,149,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(96,149,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(97,149,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(98,149,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(99,150,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(100,150,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(101,150,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(102,150,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(103,151,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(104,151,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(105,151,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(106,151,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(107,152,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(108,152,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(109,152,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(110,152,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(111,153,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(112,153,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(113,153,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(114,153,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(115,154,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(116,154,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(117,154,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(118,154,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(119,155,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(120,155,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(121,155,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(122,155,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(123,156,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(124,156,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(125,156,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(126,156,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(127,157,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(128,157,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(129,157,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(130,157,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(131,158,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(132,158,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(133,158,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(134,158,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(135,159,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(136,159,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(137,159,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(138,159,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(139,160,3,'123.0000',3,1,'product test','7.0000','SGD','kg',1),(140,160,13,'77.0000',1,1,'product 2',NULL,'SGD','kg',1),(141,160,14,'3.0000',1,1,'product 3','3.0000','SGD','kg',1),(142,160,15,'4.0000',9,1,'prodduct 4','4.0000','SGD','kg',0),(143,161,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0),(144,162,3,'123.0000',6,1,'product test','7.0000','SGD','kg',1),(145,162,13,'77.0000',2,1,'product 2',NULL,'SGD','kg',1),(146,162,14,'3.0000',2,1,'product 3','3.0000','SGD','kg',1),(147,162,15,'4.0000',26,1,'prodduct 4','4.0000','SGD','kg',0),(148,163,3,'123.0000',6,1,'product test','7.0000','SGD','kg',1),(149,163,13,'77.0000',2,1,'product 2',NULL,'SGD','kg',1),(150,163,14,'3.0000',2,1,'product 3','3.0000','SGD','kg',1),(151,163,15,'4.0000',26,1,'prodduct 4','4.0000','SGD','kg',0),(152,164,3,'123.0000',6,1,'product test','7.0000','SGD','kg',1),(153,164,13,'77.0000',2,1,'product 2',NULL,'SGD','kg',1),(154,164,14,'3.0000',2,1,'product 3','3.0000','SGD','kg',1),(155,164,15,'4.0000',26,1,'prodduct 4','4.0000','SGD','kg',0),(156,165,3,'123.0000',6,1,'product test','7.0000','SGD','kg',1),(157,165,13,'77.0000',2,1,'product 2',NULL,'SGD','kg',1),(158,165,14,'3.0000',2,1,'product 3','3.0000','SGD','kg',1),(159,165,15,'4.0000',26,1,'prodduct 4','4.0000','SGD','kg',0),(160,166,3,'123.0000',6,1,'product test','7.0000','SGD','kg',1),(161,166,13,'77.0000',2,1,'product 2',NULL,'SGD','kg',1),(162,166,14,'3.0000',2,1,'product 3','3.0000','SGD','kg',1),(163,166,15,'4.0000',26,1,'prodduct 4','4.0000','SGD','kg',0),(164,167,3,'123.0000',6,1,'product test','7.0000','SGD','kg',1),(165,167,13,'77.0000',2,1,'product 2',NULL,'SGD','kg',1),(166,167,14,'3.0000',2,1,'product 3','3.0000','SGD','kg',1),(167,167,15,'4.0000',26,1,'prodduct 4','4.0000','SGD','kg',0),(168,168,15,'4.0000',1,1,'prodduct 4','4.0000','SGD','kg',0);

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
  PRIMARY KEY (`id`),
  KEY `order_to_billing_address` (`billing_address_id`),
  KEY `order_to_customer` (`customer_id`),
  KEY `order_to_delivery_address` (`delivery_address_id`),
  KEY `order_to_shop` (`shop_id`),
  CONSTRAINT `order_to_billing_address` FOREIGN KEY (`billing_address_id`) REFERENCES `addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order_to_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order_to_delivery_address` FOREIGN KEY (`delivery_address_id`) REFERENCES `addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order_to_shop` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;

/*Data for the table `orders` */

insert  into `orders`(`id`,`shop_id`,`customer_id`,`billing_address_id`,`delivery_address_id`,`order_no`,`created`,`amount`,`status`,`hash`,`cart_id`,`payment_status`,`fulfillment_status`,`shipped_weight`,`shipped_amount`,`weight_unit`,`currency`,`total_weight`,`past_checkout_point`) values (56,1,1,1,1,'1001','2010-05-27 11:35:22','123.0000',1,NULL,0,1,0,'0.0000',NULL,'kg','SGD','0.0000',0),(58,1,1,1,1,'1002','2010-05-27 14:27:12','123.0000',1,NULL,0,1,0,'0.0000',NULL,'kg','SGD','0.0000',0),(61,5,1,1,1,'1001','2010-05-28 02:00:07','615.0000',1,NULL,0,1,0,'0.0000',NULL,'kg','SGD','0.0000',0),(62,5,1,1,1,'1002','2010-05-28 02:16:42','615.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(64,5,1,1,1,'1003','2010-05-28 02:19:18','615.0000',1,NULL,0,1,0,'0.0000',NULL,'kg','SGD','0.0000',0),(66,5,1,3,3,'1004','2010-05-29 06:46:38','123.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(67,5,1,3,3,'1005','2010-05-29 07:40:46','123.0000',1,NULL,0,1,0,'0.0000',NULL,'kg','SGD','0.0000',0),(68,5,1,3,3,'1006','2010-05-29 07:41:33','123.0000',1,NULL,0,1,0,'0.0000',NULL,'kg','SGD','0.0000',0),(69,5,1,3,3,'1007','2010-05-29 07:41:42','123.0000',1,NULL,0,1,0,'0.0000',NULL,'kg','SGD','0.0000',0),(88,5,1,53,54,'1008','2010-05-31 04:52:58','123.0000',1,NULL,0,1,0,'0.0000',NULL,'kg','SGD','0.0000',0),(89,5,1,55,56,'1009','2010-05-31 04:55:12','123.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(90,5,1,57,58,'1010','2010-05-31 04:56:05','123.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(91,5,1,59,60,'1011','2010-05-31 06:58:13','123.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(92,5,1,61,62,'1012','2010-06-07 10:10:10','123.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(93,5,1,61,62,'1013','2010-06-07 10:15:20','492.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(94,5,1,61,62,'1014','2010-06-07 10:21:31','246.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(95,5,1,61,62,'1015','2010-06-07 10:24:09','246.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(96,5,1,61,62,'1016','2010-06-07 10:26:29','246.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(97,5,1,61,62,'1017','2010-06-07 10:28:19','369.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(98,5,1,61,62,'1018','2010-06-07 10:34:43','381.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(99,5,1,61,62,'1019','2010-06-07 10:44:43','147.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(100,5,1,61,62,'1020','2010-06-07 10:46:13','135.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(101,5,1,61,62,'1021','2010-06-07 10:46:48','135.0000',1,NULL,0,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(102,5,1,61,62,'1022','2010-06-08 12:07:34','12.0000',1,'744ff0a96f49e50f709691f81cf171e88f5e0a32',46,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(103,5,1,61,62,'1023','2010-06-08 12:17:57','12.0000',1,'821802a14c41c52ccd91e4817af66617e2367bb0',46,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(104,5,1,61,62,'1024','2010-06-08 12:18:55','12.0000',1,'d4848eabbdb4d6084dd22c23e83144ca382a8b3a',46,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(105,5,1,63,64,'1025','2010-06-08 12:21:28','12.0000',1,'4b951e267a191ef26899d35ad7e167420b3df388',46,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(106,5,1,61,62,'1026','2010-06-08 12:23:18','12.0000',1,'8531f45367c2b23e5ec94b792bf13a270b3ac54d',46,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(107,5,1,61,62,'1027','2010-06-08 13:09:04','123.0000',1,'ccb4f4ba532f02576352acbe1779ae421a49a1d9',47,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(108,5,1,61,62,'1028','2010-06-08 13:11:01','123.0000',1,'bf3d75bd1de78d42303ed5e8ac98bd18c4783ce5',47,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(109,5,1,61,62,'1029','2010-06-08 13:16:15','123.0000',1,'0e484d3b52e10ff5596d474ed1db0ea216fb58b0',47,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(110,5,1,61,62,'1030','2010-06-08 13:20:51','123.0000',1,'3db6cbb1387d234c23cfafdedf56e1a349fac0fa',48,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(111,5,1,61,62,'1031','2010-06-08 13:36:08','123.0000',1,'3a402ec21bece7730025530603adee3dd6ae2cef',48,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(112,5,1,61,62,'1032','2010-06-08 13:39:36','123.0000',1,'a1228b41a02ac966680bbdcc4cba6e3330246664',48,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(113,5,1,61,62,'1033','2010-06-08 15:17:59','246.0000',1,'24ac5069808cae012b8137f0a6c66a52621f8ac2',109,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(117,5,1,61,62,'1034','2010-06-08 15:27:12','246.0000',1,'ce976afb74c44a33ea0bec75417870ec609fdcda',109,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(118,5,1,61,62,'1035','2010-06-09 04:41:37','12.0000',1,'5e067807fefb9eebe49095815ef605a69e9766a4',110,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(119,5,1,61,62,'1036','2010-06-09 04:54:22','123.0000',1,'eb4d26329ee12f22c4e49bd7bb72158dbaa27ec5',111,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(120,5,1,65,66,'1037','2010-06-09 04:56:04','135.0000',1,'e43b6f66e0b41938e73dcb1e5b2417684772229e',112,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(121,5,1,67,68,'1038','2010-06-09 05:01:15','258.0000',1,'1367ee1ce505ac0940956eca91780655d86b0ece',113,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(122,5,20,1,1,'1039','2010-06-09 05:50:07','12.0000',1,'e065cc24a126747ded4bcdf1e57d7f0cdaa0c05c',121,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(123,5,21,1,1,'1040','2010-06-09 06:04:47','36.0000',1,'7e60fa7f7783dfe2332f4484848f4f2326822e4f',123,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(124,5,22,69,70,'1041','2010-06-09 06:09:05','36.0000',1,'db063d0442bad9fa85977f784764c0277dc93d8c',124,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(125,5,23,71,72,'1042','2010-06-09 11:25:02','12.0000',1,'ba36c26c4da4b09aa7a6498d6c5b4363df532607',129,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(126,5,24,73,74,'1043','2010-06-09 12:57:58','12.0000',1,'9f951344177152e7ea5e0c4f101fe1cefe80c275',130,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(127,5,1,75,76,'1044','2010-06-10 07:05:44','12.0000',1,'61815332e2c116c4abca1741075dd8893e54cf68',131,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(128,5,25,77,78,'1045','2010-07-25 04:52:23','24.0000',1,'8cd7a7af941aa62ca816e0293a9c43814db9d903',134,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(129,5,25,79,80,'1046','2010-07-25 06:24:15','12.0000',1,'ba159d98b7f306b344c9b4ae39b3d7dbfa30db52',137,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(130,5,26,81,82,'1047','2010-07-29 14:17:57','1.0000',1,'b0f60dfb4140f540f5cbb42304d46a0eebc77619',168,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(131,5,30,84,83,'1048','2010-07-31 08:20:49','2.0000',1,'7dbd1d9557e0f12d50306a97d9d1fa7628e82ed4',255,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(132,5,30,84,83,'1049','2010-07-31 08:55:56','7.0000',1,'666fb46f1301f59628b14679804fdd21dd8ecdff',256,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(133,5,30,84,83,'1050','2010-08-01 06:07:44','3.0000',1,'a3c396ec0050fc75d7781e55c80375cb15364d1e',260,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(134,5,31,85,86,'1051','2010-08-01 06:16:33','1.0000',1,'9f08e7f13909a8b0d5d126554ca23a3221e5aa9d',262,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(135,5,32,87,88,'1052','2010-08-01 06:18:06','2.0000',1,'b1b3d8c339075cefbd4c5feb91ab825e018e1eca',263,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(136,5,33,89,90,'1053','2010-08-01 06:32:20','5.0000',1,'57342ddbd4cf573faf6a44edec85f06b12eb3064',265,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(137,5,34,91,92,'1054','2010-08-01 06:34:48','3.0000',1,'6fb71e4f39817c1601798ea712820f6c6fc7d0cf',266,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(138,5,35,93,94,'1055','2010-08-01 06:58:09','3.0000',1,'970f49c1eff75b9367aa6b1258816127d4ed64e4',267,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(139,5,36,95,96,'1056','2010-08-01 10:53:51','2.0000',1,'0792bf850565f1b2880cd9c2aba383e8fa555fc5',269,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(140,5,30,84,83,'1057','2010-08-01 10:54:56','1.0000',1,'1430bad4b53b4b7ae5b143dc4b262cdd48ad39ad',270,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(141,5,37,97,98,'1058','2010-09-17 08:03:01','123.0000',1,'688eacbc926bfa23c8d2d74efc0dbe784522323a',279,0,0,'0.0000',NULL,'kg','SGD','0.0000',0),(142,5,25,99,100,'1059','2010-09-21 08:14:01','17.0000',1,'ad1ab5ce51ab6a3469337ba4992f77d1fb2a9eec',281,0,0,'9.0000','9.0000','kg','SGD','17.0000',0),(143,5,25,101,102,'1060','2010-09-21 09:25:00','20.0000',1,'e11095a0b1821d9c55215c185b6229b24e41978d',282,0,0,'12.0000','12.0000','kg','SGD','20.0000',0),(144,5,25,101,102,'1061','2010-09-21 09:59:01','24.0000',1,'d5ffc7e5be7a44dd80327a6ed06a0cae2d2a6d28',283,0,0,'12.0000','12.0000','kg','SGD','24.0000',0),(146,5,25,101,102,'1001','2010-09-21 11:18:53','24.0000',1,'edef317a77b599e8bc2d4ae1b08d865df34d5682',284,0,0,'12.0000','12.0000','kg','SGD','24.0000',0),(147,5,25,101,102,'1001','2010-09-22 03:45:19','11.0000',1,'15876d58d1cdd0b4623cd14d2a3d3a69422b7b09',292,0,0,'3.0000','3.0000','kg','SGD','11.0000',0),(148,5,25,101,102,'1062','2010-10-04 10:03:34','485.0000',1,'39ca974326a01c559e64579592d703f8dee47904',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(149,5,25,101,102,'1063','2010-10-04 10:06:09','485.0000',1,'7554b044df3cf5cc8f2b506c40aec06d9d367083',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(150,5,25,101,102,'1064','2010-10-04 10:16:28','485.0000',1,'82cab1a6a4747bb7792b0de0d22b2a103a1bd609',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(151,5,38,104,103,'1065','2010-10-06 05:00:16','485.0000',1,'82102226ee2818c95b3f01d2e3e0c12aa9238b4e',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(152,5,38,105,106,'1066','2010-10-06 05:15:57','485.0000',1,'fefd27ba4da4c8b32e0d72707ef2452a9f2562d4',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(153,5,38,105,106,'1067','2010-10-06 05:39:08','485.0000',1,'01cf060680ce58ac6f2e4fd9341fd2fe0e36a9b4',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(154,5,38,105,106,'1068','2010-10-06 05:54:07','485.0000',1,'0dc52dca11b76a0dc6a0833434d012f4ffefe0e6',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(155,5,38,105,106,'1069','2010-10-06 08:41:43','485.0000',1,'e019f828b0c7bca9f799d986481f99552e788148',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(156,5,38,105,106,'1070','2010-10-08 10:13:34','485.0000',1,'b4fe57cb3e5640d4aa0e9b2c8f6f6fdda2f9bace',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(157,5,38,105,106,'1071','2010-10-08 10:32:11','485.0000',1,'6fb3eb3c32bee685c590f45a23f00f7629f1b40b',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(158,5,25,101,102,'1072','2010-10-08 10:34:14','485.0000',1,'4d856af959933b32fb99876f0d50b674e7ddb23b',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(159,5,25,101,102,'1073','2010-10-08 11:35:36','485.0000',1,'3a638bed37ab835415604731d8fe59065ac24266',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(160,5,25,101,102,'1074','2010-10-08 11:46:01','485.0000',1,'28b93e8845826fd5cd94b6a643ccc816fda9590f',293,0,0,'24.0000','449.0000','kg','SGD','60.0000',0),(161,5,25,101,102,'1075','2010-10-09 11:44:19','4.0000',1,'548daa73cb5897516cf7b097d7f55860699589f4',305,0,0,'0.0000','0.0000','kg','SGD','4.0000',0),(162,5,1,107,108,'1076','2010-10-12 09:49:50','1002.0000',1,'a8fa7d0ec09469e67d7a5b9a614bedb4caf9e109',293,0,0,'48.0000','898.0000','kg','SGD','152.0000',0),(163,5,1,107,108,'1077','2010-10-12 10:00:37','1002.0000',1,'c163754c87f0401267402b1c7576c29436a9fb84',293,0,0,'48.0000','898.0000','kg','SGD','152.0000',0),(164,5,1,110,58,'1078','2010-10-12 10:14:35','1002.0000',1,'f8bd3410b02ece9d58993bc577f382c3c2f441cd',293,0,0,'48.0000','898.0000','kg','SGD','152.0000',0),(165,5,38,105,106,'1079','2010-10-13 02:36:57','1002.0000',1,'6df0d73ede0d5eecc845bcc419e08572b92d4475',293,0,0,'48.0000','898.0000','kg','SGD','152.0000',0),(166,5,38,105,106,'1080','2010-10-13 02:45:54','1002.0000',1,'c59167e9d95872244ff08ed208786bde4f6aa20c',293,0,0,'48.0000','898.0000','kg','SGD','152.0000',0),(167,5,1,111,112,'1081','2010-10-13 02:53:23','1002.0000',1,'dee8c036c504209944fbfd62242143d9f68a1bf1',293,0,0,'48.0000','898.0000','kg','SGD','152.0000',0),(168,5,38,105,106,'1082','2010-11-11 10:46:01','4.0000',1,'23afb5a42544fdaf599285050a4dbef411316a2b',312,0,0,'0.0000','0.0000','kg','SGD','4.0000',0);

/*Table structure for table `page_types` */

DROP TABLE IF EXISTS `page_types`;

CREATE TABLE `page_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `alias` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `page_types` */

/*Table structure for table `papers` */

DROP TABLE IF EXISTS `papers`;

CREATE TABLE `papers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `papers` */

insert  into `papers`(`id`,`name`) values (1,'asd');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `payments` */

insert  into `payments`(`id`,`shops_payment_module_id`,`order_id`,`completed`,`name`,`transaction_id_from_gateway`,`payment_email`) values (1,1,117,0,'Cash On Delivery',NULL,NULL),(2,1,118,0,'Cash On Delivery',NULL,NULL),(3,1,119,0,'Cash On Delivery',NULL,NULL),(4,1,120,0,'Cash On Delivery',NULL,NULL),(5,1,121,0,'Cash On Delivery',NULL,NULL),(6,1,123,0,'Cash On Delivery',NULL,NULL),(7,1,124,0,'Cash On Delivery',NULL,NULL),(8,1,125,0,'Cash On Delivery',NULL,NULL),(9,1,126,0,'Cash On Delivery',NULL,NULL),(10,2,127,0,'Cash On Delivery',NULL,NULL),(11,1,143,0,'',NULL,NULL),(12,1,146,0,'',NULL,NULL),(13,1,150,0,'',NULL,NULL),(14,3,157,0,'',NULL,NULL),(15,3,159,0,'','EC-6BW38344C4697113L',NULL),(16,3,160,1,'','EC-2PN56109AC161501D',NULL),(17,3,161,0,'',NULL,NULL),(18,3,165,0,'',NULL,NULL),(19,3,167,0,'',NULL,NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `posts` */

insert  into `posts`(`id`,`blog_id`,`author_id`,`status`,`title`,`slug`,`body`,`no_comments`,`allow_comments`,`allow_pingback`,`created`,`modified`) values (1,1,1,2,'My First Post','my-first-post','Hello world! This is my first post. Please do enjoy your reading.',0,1,1,NULL,NULL),(3,1,5,1,'something there say goodbye','something-up-there','as',0,1,1,'2010-09-02 05:38:35','2010-09-02 06:07:35'),(4,1,5,1,'something body tell me why',NULL,'try',0,1,1,'2010-09-02 05:39:44','2010-09-02 05:39:44'),(5,1,5,1,'where or where can it be??','where-or-where-can-it-be','test',0,1,1,'2010-09-02 05:42:19','2010-09-02 05:42:19'),(6,1,5,1,'test','test','test',0,1,1,'2010-09-02 08:42:16','2010-09-02 08:42:16'),(7,11,5,1,'my first post','my-first-post-234','abc',0,1,1,'2010-09-09 10:37:17','2010-09-09 10:41:45');

/*Table structure for table `price_based_rates` */

DROP TABLE IF EXISTS `price_based_rates`;

CREATE TABLE `price_based_rates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `min_price` decimal(10,3) unsigned NOT NULL DEFAULT '0.000',
  `max_price` decimal(10,3) DEFAULT NULL,
  `shipping_rate_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `price_based_rates` */

insert  into `price_based_rates`(`id`,`min_price`,`max_price`,`shipping_rate_id`) values (3,'50.000',NULL,9),(2,'50.000',NULL,8),(4,'50.000',NULL,10),(5,'50.000',NULL,11),(7,'3.000',NULL,13);

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`cover`,`created`,`modified`,`filename`,`dir`,`mimetype`,`filesize`) values (1,1,1,'2010-05-20 07:59:19','2010-05-20 07:59:19','default.jpg','uploads\\products','image/jpeg',6103),(5,5,1,'2010-06-02 08:20:45','2010-06-02 08:20:45','Desert.jpg','uploads\\products','image/jpeg',845941),(6,5,0,'2010-06-02 08:20:47','2010-06-02 08:20:47','Chrysanthemum.jpg','uploads\\products','image/jpeg',879394),(7,6,0,'2010-07-25 05:06:20','2010-07-25 05:06:20','Screenshot_IOS_images_and_hypervisors.png','uploads/products','image/png',57022),(8,6,1,'2010-07-25 05:06:22','2010-07-25 05:06:22','Screenshot_kei_kei_laptop_opt_lampp_htdocs_wp_app_vendors_paypal_includes.png','uploads/products','image/png',32103),(9,6,0,'2010-07-25 05:06:48','2010-07-25 05:06:48','Screenshot_CISCO_IOS_terminal_GNS3.png','uploads/products','image/png',244996),(10,6,0,'2010-07-25 06:26:37','2010-07-25 06:26:37','Screenshot_FileZilla.png','uploads/products','image/png',108628),(11,6,0,'2010-07-25 06:26:38','2010-07-25 06:26:38','Screenshot_IOS_images_and_hypervisors-0.png','uploads/products','image/png',57022),(13,7,1,'2010-08-24 05:54:52','2010-08-24 05:54:52','admin_blogs_view.png','uploads/products','image/png',87553),(14,8,1,'2010-08-24 06:07:32','2010-08-24 06:07:32','admin_blogs_articles_edit.png','uploads/products','image/png',81962),(17,5,0,'2010-08-24 06:35:48','2010-08-24 06:35:48','admin_blogs_edit-0.png','uploads/products','image/png',76876),(18,5,0,'2010-08-24 06:35:50','2010-08-24 06:35:50','admin_blogs_new.png','uploads/products','image/png',66403),(19,5,0,'2010-08-24 06:35:52','2010-08-24 06:35:52','admin_blogs_view-0.png','uploads/products','image/png',87553),(20,3,0,'2010-08-31 08:22:17','2010-08-31 08:22:17','admin_blogs_edit-1.png','uploads/products','image/png',76876),(21,3,0,'2010-08-31 08:22:19','2010-08-31 08:22:19','admin_blogs_new-2.png','uploads/products','image/png',66403),(22,3,1,'2010-08-31 08:24:18','2010-08-31 08:24:18','karthik.jpg','uploads/products','image/jpeg',9637),(23,3,0,'2010-08-31 08:51:36','2010-08-31 08:51:36','Screenshot_CakePHP_the_rapid_development_php_framework_Products_Google_Chrome.png','uploads/products','image/png',38701),(24,3,0,'2010-08-31 08:51:38','2010-08-31 08:51:38','Screenshot_CakePHP_the_rapid_development_php_framework_Products_Google_Chrome_1.png','uploads/products','image/png',100017),(25,3,0,'2010-08-31 09:02:03','2010-08-31 09:02:03','admin_blogs_new-3.png','uploads/products','image/png',66403),(26,9,0,'2010-09-13 07:22:31','2010-09-13 07:22:31','admin_blogs_new-17.png','uploads/products','image/png',66403),(27,9,0,'2010-09-13 07:22:34','2010-09-13 07:22:34','admin_blogs_view-2.png','uploads/products','image/png',87553),(28,10,1,'2010-09-13 07:32:38','2010-09-13 07:32:38','admin_blogs_new-18.png','uploads/products','image/png',66403),(30,10,0,'2010-09-13 07:34:54','2010-09-13 07:34:54','admin_blogs_new-19.png','uploads/products','image/png',66403),(31,10,0,'2010-09-13 07:34:56','2010-09-13 07:34:56','admin_blogs_view-3.png','uploads/products','image/png',87553),(32,15,0,'2010-11-19 12:33:48','2010-11-19 12:33:48','admin_blogs_articles_edit.png','uploads/products','image/png',81962),(34,14,1,'2010-11-19 13:23:01','2010-11-19 13:23:01','wal_mart_t_shirt_for_web-0.jpg','uploads/products','image/jpeg',14479),(35,14,0,'2010-11-19 13:26:21','2010-11-19 13:26:21','Superman_Shield_t_shirt.jpg','uploads/products','image/jpeg',26190),(36,14,0,'2010-11-19 13:27:21','2010-11-19 13:27:21','images.jpg','uploads/products','image/jpeg',5257),(37,14,0,'2010-11-19 14:10:42','2010-11-19 14:10:42','8cb42ecccafe.jpg','uploads/products','image/jpeg',25926),(39,14,0,'2010-11-19 14:31:07','2010-11-19 14:31:07','Superman_Shield_t_shirt-0.jpg','uploads/products','image/jpeg',26190),(42,14,0,'2010-11-19 14:55:35','2010-11-19 14:55:35','Superman_Shield_t_shirt-1.jpg','uploads/products','image/jpeg',26190),(43,14,0,'2010-11-19 14:58:43','2010-11-19 14:58:43','t_shirt_with_logo.gif','uploads/products','image/gif',14477),(44,14,0,'2010-11-19 15:04:31','2010-11-19 15:04:31','admin_blogs_articles_edit-0.png','uploads/products','image/png',81962),(46,14,0,'2010-11-19 15:15:56','2010-11-19 15:15:56','8cb42ecccafe-0.jpg','uploads/products','image/jpeg',25926),(48,14,0,'2010-11-19 15:23:17','2010-11-19 15:23:17','Superman_Shield_t_shirt-3.jpg','uploads/products','image/jpeg',26190),(49,16,0,'2010-11-20 05:31:36','2010-11-20 05:31:36','500_506.png','uploads/products','image/png',4797),(50,16,0,'2010-11-20 05:34:13','2010-11-20 05:34:13','admin_blogs_view_small.png','uploads/products','image/png',3817),(51,18,1,'2010-11-20 06:53:07','2010-11-20 06:53:07','500_506-0.png','uploads/products','image/png',4797);

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
  PRIMARY KEY (`id`),
  KEY `FK_products` (`shop_id`),
  CONSTRAINT `FK_products` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `products` */

insert  into `products`(`id`,`shop_id`,`title`,`code`,`description`,`price`,`created`,`modified`,`status`,`weight`,`currency`,`weight_unit`,`shipping_required`) values (1,1,'Dummy Product',NULL,NULL,'0.0000','2010-05-20 08:00:24','2010-05-20 08:00:24',1,'7.0000','SGD','kg',1),(3,5,'product test','test','asdsadsadasd','123.0000','2010-05-20 12:47:39','2010-05-20 12:47:39',1,'7.0000','SGD','kg',1),(5,5,'test for delete','de','de','1.0000','2010-06-02 08:20:45','2010-06-02 08:20:45',1,'7.0000','SGD','kg',1),(6,5,'test1','1','description','1.0000','2010-07-25 05:06:20','2010-07-25 05:06:20',1,'7.0000','SGD','kg',1),(7,5,'test','1','1','1.0000','2010-08-24 05:54:51','2010-09-20 06:38:18',1,'7.0000','SGD','kg',0),(8,5,'test2','','','2.0000','2010-08-24 06:07:32','2010-08-24 06:07:32',1,'7.0000','SGD','kg',1),(9,5,'abc','','','1.0000','2010-09-13 07:22:31','2010-09-13 07:22:36',1,'7.0000','SGD','kg',1),(10,5,'abc1','','','1.0000','2010-09-13 07:32:37','2010-09-13 07:32:42',1,'7.0000','SGD','kg',1),(11,5,'test 1','123','description','123.0000','2010-09-20 06:10:38','2010-09-20 06:10:38',1,'23.0000','SGD','kg',1),(12,5,'product 1','123','description','1.0000','2010-09-20 06:12:28','2010-09-20 06:12:28',1,NULL,'SGD','kg',1),(13,5,'product 2','11','desc','77.0000','2010-09-20 06:14:45','2010-09-20 06:14:45',1,NULL,'SGD','kg',1),(14,5,'product 3','3','desc','3.0000','2010-09-20 06:19:01','2010-09-20 06:19:01',1,'3.0000','SGD','kg',1),(15,5,'prodduct 4','54','4','4.0000','2010-09-20 06:20:29','2010-09-20 07:18:06',1,'4.0000','SGD','kg',0),(16,5,'Love Singapore','T001','','50.0000','2010-11-20 05:31:15','2010-11-20 05:31:17',1,'0.5000','SGD','kg',1),(18,5,'Love Singapore','T001','description','50.0000','2010-11-20 06:53:06','2010-11-20 06:53:09',1,'0.5000','SGD','kg',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `saved_themes` */

insert  into `saved_themes`(`id`,`name`,`description`,`author`,`created`,`modified`,`folder_name`,`shop_id`,`theme_id`,`featured`) values (1,'c2','','','2010-08-28 16:50:57','2010-08-28 16:50:58','5_c2',5,0,0),(2,'c3','','evey','2010-08-28 17:05:47','2010-08-28 17:05:48','5_c3',5,0,0),(3,'c4','','evey','2010-08-29 12:26:22','2010-08-29 12:26:23','5_c4',5,0,0),(4,'c5','abcd','evey','2010-08-29 12:27:03','2010-08-29 17:09:49','5_c5',5,0,0),(5,'c6','','evey','2010-08-29 12:28:21','2010-08-29 12:28:22','5_c6',5,0,0),(6,'c7','','evey','2010-08-29 12:28:54','2010-08-29 12:28:55','5_c7',5,0,0),(7,'c8','','evey','2010-08-29 12:29:35','2010-08-29 12:29:36','5_c8',5,0,0),(9,'c10','','evey','2010-08-29 13:55:19','2010-08-29 13:55:20','5_c10',5,0,0),(10,'c11','','evey','2010-08-29 13:55:44','2010-08-29 13:55:45','5_c11',5,0,0),(11,'c12','','evey','2010-08-29 13:57:04','2010-08-29 13:57:04','5_c12',5,0,0),(12,'c13','','evey','2010-08-29 13:59:40','2010-08-29 13:59:41','5_c13',5,0,0),(13,'default','','evey','2010-09-15 06:21:11','2010-09-15 06:21:12','5_default',5,0,1),(14,'alt','','evey','2010-09-15 06:23:34','2010-09-15 06:23:36','5_alt',5,0,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `shipments` */

insert  into `shipments`(`id`,`order_id`,`completed`,`name`,`price`,`description`) values (1,117,0,'International Shipping','10.0000','From 10kg to 20kg'),(2,146,0,'test2','0.0000','From $2 to $20'),(3,150,0,'Heavy Duty Shipping','25.0000','From 20kg to 50kg'),(5,157,0,'Heavy Duty Shipping','25.0000','From 20kg to 50kg'),(6,159,0,'test2','5.0000','From $2 to $20'),(7,160,0,'test2','5.0000','From $2 to $20'),(8,165,0,'test2','5.0000','From $2 to $20'),(9,167,0,'test2','5.0000','From $2 to $20');

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
  `theme_id` int(11) unsigned NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `web_address` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `saved_theme_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shop_to_theme` (`theme_id`),
  CONSTRAINT `FK_shops_themes` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `shops` */

insert  into `shops`(`id`,`theme_id`,`name`,`web_address`,`created`,`modified`,`status`,`saved_theme_id`) values (1,1,'a','http://a.myspree2shop.com',NULL,NULL,1,0),(2,1,'abcde','http://shop1.myspree2shop.com',NULL,NULL,1,0),(3,1,'shop2','http://shop2.myspree2shop.com',NULL,NULL,1,0),(4,1,'shop3','http://shop3.myspree2shop.com',NULL,NULL,1,0),(5,4,'shop4','http://shop4.ombi60.biz',NULL,'2010-10-04 12:40:52',1,13),(6,1,'shop7','http://shop7.myspree2shop.com',NULL,NULL,1,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `shops_payment_modules` */

insert  into `shops_payment_modules`(`id`,`shop_id`,`payment_module_id`,`default`,`active`,`display_name`) values (1,5,1,0,1,'Cash On Delivery'),(2,5,1,0,1,'Money Order'),(3,5,2,0,1,'Paypal');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `themes` */

insert  into `themes`(`id`,`name`,`description`,`author`,`created`,`modified`,`available_for_all`,`folder_name`,`shop_id`) values (1,'blue-white','blue-white','kimsia','2010-05-13 00:00:00','2010-05-13 00:00:00',1,'',NULL),(2,'orange','orange','kimsia','2010-05-13 00:00:00','2010-05-13 00:00:00',1,'',NULL),(3,'default','default','kimsia','2010-07-06 12:55:23','2010-07-06 12:55:28',1,'',NULL),(4,'alt','alt','kimsia','2010-07-08 00:00:00','2010-07-08 00:00:00',1,'',NULL);

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
  PRIMARY KEY (`id`),
  KEY `FK_users` (`group_id`),
  CONSTRAINT `FK_users` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`group_id`,`full_name`,`name_to_call`,`last_login_on`,`status`,`created`,`modified`,`language_id`) values (1,'m1@a.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'full name','ally',NULL,1,'2010-04-25 06:13:48','2010-04-25 06:13:48',1),(2,'merchant1@shop1.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'full','barry',NULL,1,'2010-04-26 02:39:27','2010-04-26 02:39:27',1),(3,'owner@shop2.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'cherry','cherry',NULL,1,'2010-04-26 02:43:00','2010-04-26 02:43:00',1),(4,'owner@shop3.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'dolly','dolly',NULL,1,'2010-04-26 03:19:15','2010-04-26 03:19:15',1),(5,'owner@shop4.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'evey','evey',NULL,1,'2010-04-26 03:20:22','2010-09-27 08:05:58',1),(6,'owner@shop7.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'cherry','cherry',NULL,1,'2010-05-20 08:11:42','2010-05-20 08:11:42',1),(7,'test@test.com','dd7d4e2151754e51cde4cb43dedd4958a0f8b5d5',4,'test','test',NULL,1,'2010-05-27 11:10:40','2010-05-27 11:10:40',1),(9,'molly@m.com','b42ce95fab13ebd95a8eede6a95a7e0ae2ed4f42',4,'molly','molly',NULL,1,'2010-05-29 07:43:01','2010-05-29 07:43:01',1),(10,'molly@m.com','4b3dc7bf39b4b34deaf638b039aa588729e0dd12',4,'molly','molly',NULL,1,'2010-05-29 07:43:57','2010-05-29 07:43:57',1),(11,'molly@m.com','4a42c15faa758aca03207c93c56a681973135994',4,'molly','molly',NULL,1,'2010-05-29 07:45:30','2010-05-29 07:45:30',1),(12,'molly1@m.com','b2f62e6e90ab8ec916f79e4afc9b295ce6e9302f',4,'molly','mollt',NULL,1,'2010-05-29 07:49:29','2010-05-29 07:49:29',1),(13,'molly2@m.com','23dda2ab1291ba6f90027a62e181ff50efb20267',4,'m','m',NULL,1,'2010-05-29 07:51:21','2010-05-29 07:51:21',1),(14,'molly3@m.com','ced0575592aa814632099560a6d2762d32f92bfa',4,'m','m',NULL,1,'2010-05-29 08:08:24','2010-05-29 08:08:24',1),(15,'molly4@m.com','684f2df0649e7fb1d867d4ce777b36a5006cddeb',4,'m','m',NULL,1,'2010-05-29 08:14:56','2010-05-29 08:14:56',1),(16,'molly5@m.com','9704303d90f71afaa74eed13153ead90d041c5f8',4,'5','5',NULL,1,'2010-05-29 08:23:56','2010-05-29 08:23:56',1),(17,'nellly1@n.com','ad6e39539da5557890e19f6b67e4ccf7e136e6d5',4,'nelly','nelly',NULL,1,'2010-05-29 09:35:49','2010-05-29 09:35:49',1),(18,'nellly1@n.com','92770ef1a9ef46521e7c8f56723b1a32f46f5e13',4,'nelly','nelly',NULL,1,'2010-05-29 09:36:19','2010-05-29 09:36:19',1),(19,'nellly2@n.com','5bbab3a7d685eb5e8a9b1f8d4464e3d52aea27a8',4,'nelly','nelly',NULL,1,'2010-05-29 09:38:15','2010-05-29 09:38:15',1),(20,'nellly3@n.com','0e887c525d0ebe40789bd9d01d000b7fb70a74fb',4,'n','n',NULL,1,'2010-05-29 09:50:46','2010-05-29 09:50:46',1),(21,'nellly3@n.com','b64e6c5d06ff717ddcd482872020ab3dfd83028c',4,'n','n',NULL,1,'2010-05-29 09:53:06','2010-05-29 09:53:06',1),(22,'nellly3@n.com','0b3ea8cb109fa974aca094e05985828c543e11d6',4,'n','n',NULL,1,'2010-05-29 09:53:29','2010-05-29 09:53:29',1),(23,'nana@n.com','168972b0185c97f17796232aa7a754627f2baf35',4,'nana','nana',NULL,1,'2010-05-30 08:37:03','2010-05-30 08:37:03',1),(26,'newcustomer@mail.com','43370f2224c386ba8c5f6f441ae6d5b596d8dba0',4,'n','n',NULL,1,'2010-06-09 05:50:07','2010-06-09 05:50:07',1),(27,'newcustomer1@mail.com','5affb584fe4b05475262becca83bfcf63a51022b',4,'n','n',NULL,1,'2010-06-09 06:04:47','2010-06-09 06:04:47',1),(28,'newcustomer2@mail.com','ad9b878b30b75183dbd0f5915c1f73a1c6d0887b',4,'a','a',NULL,1,'2010-06-09 06:09:05','2010-06-09 06:09:05',1),(29,'totally@brand.com','97b3e97fac3d465ec4640a5f63b6698c8d132263',4,'new','n',NULL,1,'2010-06-09 11:25:02','2010-06-09 11:25:02',1),(30,'email@mail.com','bdbd1ebcdb69e050a2ce44717d17dc856fb97207',4,'cherry','cherry',NULL,1,'2010-06-09 12:57:58','2010-06-09 12:57:58',1),(31,'a@a.com','e8219909231a2a32bbe6b0e4502fd85686ccfdd6',4,'make','make',NULL,1,'2010-07-25 04:52:23','2010-07-25 04:52:23',1),(32,'b@a.com','69aa57981689052f6b1759d4a908fffa4085368e',4,'a','a',NULL,1,'2010-07-29 14:17:57','2010-07-29 14:17:57',1),(34,'cust.t_1277746287_per@gmail.com','af8f6abc574449a86e81dcc79ad4eee8bd2ea963',4,'Test User','Test User',NULL,1,'2010-07-31 08:14:06','2010-07-31 08:14:06',1),(35,'cust1@mail.com','41cebb91ab0404aad68bca70eabce327b5a591e2',4,'a','a',NULL,1,'2010-08-01 06:16:33','2010-08-01 06:16:33',1),(36,'cust2@mail.com','e481e6992c8f93303c3ecff1f96430438911f6a1',4,'full','full',NULL,1,'2010-08-01 06:18:06','2010-08-01 06:18:06',1),(37,'cust3@mail.com','e2e747818c10d099c72a4f0425932dd6f66dcf82',4,'full','full',NULL,1,'2010-08-01 06:32:20','2010-08-01 06:32:20',1),(38,'cust4@mail.com','e21c5331e3f171ceab86f38c8936040dbf400fc9',4,'a','a',NULL,1,'2010-08-01 06:34:47','2010-08-01 06:34:47',1),(39,'cust5@mail.com','eb57dd3121ab1869d2d110d02e8b61f9ee4a36c3',4,'a','a',NULL,1,'2010-08-01 06:58:08','2010-08-01 06:58:08',1),(40,'mac@mac.com','b5a95b01e762743daf979ec11d13e0897132bfc4',4,'a','a',NULL,1,'2010-08-01 10:53:51','2010-08-01 10:53:51',1),(41,'mail@1.com','3c1ad7a11dbb0ff43a5cccb65f7fdb6e94d9cb3f',4,'full name','full name',NULL,1,'2010-09-17 08:03:01','2010-09-17 08:03:01',1),(42,'be6y8v5p@ombi60.com','cabaf65b701fa3c51d016abd9d95313e7d26d948',5,'casual','casual',NULL,1,'2010-09-29 04:08:11','2010-09-29 04:08:11',1),(43,'yvmob0gu@ombi60.com','c84d85b2c605718a9e4df98cde0edbb5c0c8cb1b',5,'casual','casual',NULL,1,'2010-09-29 04:19:05','2010-09-29 04:19:05',1),(44,'a5crgn$2@ombi60.com','1bdde8e8be5918bf3056ae32eee50ded07799ea6',5,'casual','casual',NULL,1,'2010-09-29 04:20:34','2010-09-29 04:20:34',1),(45,'4algrmw5@ombi60.com','b7fd702b71d73c81e542519d9336cddf535b7162',5,'casual','casual',NULL,1,'2010-09-30 00:03:26','2010-09-30 00:03:26',1),(46,'r9j4ziu0@ombi60.com','6fd6acb6c995a7cd9500766f846e0f96bf4ca7a7',5,'casual','casual',NULL,1,'2010-10-01 03:52:49','2010-10-01 03:52:49',1),(47,'cust_spore@gmail.com','6ac762c9a9c8e21d2ca3eed9cd39e5f0e245459a',4,'mister customer','mister customer',NULL,1,'2010-10-06 05:00:16','2010-10-06 05:00:16',1),(48,'3zwahrx$@ombi60.com','98eae1354aec99a44ec172eb54344e54f56e74b5',5,'casual','casual',NULL,1,'2010-10-07 12:19:18','2010-10-07 12:19:18',1),(49,'voyfc3eg@ombi60.com','b9543d98aba0102b77ba4b6a24ba84b47c450ba1',5,'casual','casual',NULL,1,'2010-10-09 03:41:13','2010-10-09 03:41:13',1),(50,'csko4rqg@ombi60.com','89aa27c0815493816b3e1c11299d7262a53b975d',5,'casual','casual',NULL,1,'2010-10-09 03:44:19','2010-10-09 03:44:19',1),(51,'h8prvlxc@ombi60.com','6e45233d4491c692dbc2182d9a1475dcfb526255',5,'casual','casual',NULL,1,'2010-10-09 11:38:15','2010-10-09 11:38:15',1),(52,'85mexald@ombi60.com','d5249be4c8d09dce17049620e931fa75c39dd13b',5,'casual','casual',NULL,1,'2010-10-09 12:14:47','2010-10-09 12:14:47',1),(53,'t3au7rzf@ombi60.com','71c1f7761461209c2e3fe3e31f8ac2f03ada24b6',5,'casual','casual',NULL,1,'2010-10-11 07:42:32','2010-10-11 07:42:32',1),(54,'59$y871e@ombi60.com','6ac4340a60d9abfc49eb877daa8e16926714e2ba',5,'casual','casual',NULL,1,'2010-10-11 07:44:42','2010-10-11 07:44:42',1),(55,'arw0de$t@ombi60.com','01db6f42f558c0ca47950c72c0f9c18e2810b0b1',5,'casual','casual',NULL,1,'2010-10-11 07:55:26','2010-10-11 07:55:26',1),(56,'9sfmayru@ombi60.com','9c9ffe4f8d84bc58a8b30700a91925ff569ccbf8',5,'casual','casual',NULL,1,'2010-10-11 07:58:53','2010-10-11 07:58:53',1),(57,'iuvhsl$k@ombi60.com','aebdd9be72adbf838d2e35099bd9d15c99ebafa3',5,'casual','casual',NULL,1,'2010-10-11 08:01:58','2010-10-11 08:01:58',1),(58,'4cpfh8ra@ombi60.com','6ec0315c3d06057f981693980f6cbe5d447a600b',5,'casual','casual',NULL,1,'2010-10-11 08:18:47','2010-10-11 08:18:47',1),(59,'pw1snqu8@ombi60.com','ec76c28e20d1ea730f519afe271c0dfd4db800de',5,'casual','casual',NULL,1,'2010-10-11 09:17:20','2010-10-11 09:17:20',1),(60,'dbhwx8l6@ombi60.com','4dda1da880198252c335f8ff1e0c2b0bd60b07ac',5,'casual','casual',NULL,1,'2010-10-11 09:17:21','2010-10-11 09:17:21',1),(61,'jp6f1oba@ombi60.com','4cd3386617011251a222dcfae64f4b316d886fff',5,'casual','casual',NULL,1,'2010-10-11 09:18:47','2010-10-11 09:18:47',1),(62,'rnudp9i7@ombi60.com','f1734ab2e0a50e47061ee71d0478703546be8fa7',5,'casual','casual',NULL,1,'2010-11-05 01:38:46','2010-11-05 01:38:46',1),(63,'ptx58v17@ombi60.com','6798b3ec43d43a343fe073959feaa5aeb20f28b8',5,'casual','casual',NULL,1,'2010-11-06 07:39:42','2010-11-06 07:39:42',1),(64,'og234iws@ombi60.com','f727bb9082fecb0cac91f9dac7fb2e903e67af03',5,'casual','casual',NULL,1,'2010-11-06 07:48:04','2010-11-06 07:48:04',1),(65,'i3sbdo2j@ombi60.com','8d0e3dec095f31942a13cfd196609b891bd11730',5,'casual','casual',NULL,1,'2010-11-06 07:50:38','2010-11-06 07:50:38',1),(66,'gac7f1v5@ombi60.com','eab8ef31afd4f5c6d26c1cc567a3e44e7db97c57',5,'casual','casual',NULL,1,'2010-11-06 07:59:02','2010-11-06 07:59:02',1);

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

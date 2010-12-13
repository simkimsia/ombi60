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
) ENGINE=InnoDB AUTO_INCREMENT=464 DEFAULT CHARSET=utf8;

/*Data for the table `acos` */

insert  into `acos`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,NULL,NULL,'controllers',1,450),(2,1,NULL,NULL,'Pages',2,7),(3,2,NULL,NULL,'display',3,4),(9,1,NULL,NULL,'Addresses',8,13),(10,9,NULL,NULL,'index',9,10),(21,1,NULL,NULL,'Customers',14,23),(27,1,NULL,NULL,'Groups',24,29),(28,27,NULL,NULL,'parentNode',25,26),(47,1,NULL,NULL,'Merchants',30,51),(48,47,NULL,NULL,'register',31,32),(51,47,NULL,NULL,'admin_index',33,34),(53,47,NULL,NULL,'platform_index',35,36),(54,47,NULL,NULL,'platform_view',37,38),(55,47,NULL,NULL,'platform_edit',39,40),(56,47,NULL,NULL,'platform_delete',41,42),(61,1,NULL,NULL,'Orders',52,75),(62,61,NULL,NULL,'index',53,54),(63,61,NULL,NULL,'view',55,56),(64,61,NULL,NULL,'add',57,58),(73,1,NULL,NULL,'Payments',76,89),(79,1,NULL,NULL,'Products',90,133),(80,79,NULL,NULL,'admin_index',91,92),(81,79,NULL,NULL,'index',93,94),(82,79,NULL,NULL,'view',95,96),(86,1,NULL,NULL,'ProductImages',134,149),(92,1,NULL,NULL,'Shops',150,157),(98,1,NULL,NULL,'Users',158,177),(99,98,NULL,NULL,'parentNode',159,160),(104,98,NULL,NULL,'login',161,162),(105,98,NULL,NULL,'logout',163,164),(106,98,NULL,NULL,'platform_login',165,166),(107,98,NULL,NULL,'platform_logout',167,168),(108,98,NULL,NULL,'platform_index',169,170),(115,98,NULL,NULL,'afterSave',171,172),(116,1,NULL,NULL,'Webpages',178,193),(118,116,NULL,NULL,'view',179,180),(122,116,NULL,NULL,'admin_index',181,182),(123,116,NULL,NULL,'admin_view',183,184),(124,116,NULL,NULL,'admin_add',185,186),(125,116,NULL,NULL,'admin_edit',187,188),(126,116,NULL,NULL,'admin_delete',189,190),(137,79,NULL,NULL,'admin_view',97,98),(138,79,NULL,NULL,'admin_add',99,100),(139,79,NULL,NULL,'admin_edit',101,102),(140,79,NULL,NULL,'admin_delete',103,104),(141,79,NULL,NULL,'platform_index',105,106),(142,79,NULL,NULL,'platform_view',107,108),(143,79,NULL,NULL,'platform_add',109,110),(144,79,NULL,NULL,'platform_edit',111,112),(145,79,NULL,NULL,'platform_delete',113,114),(149,98,NULL,NULL,'initDB',173,174),(154,86,NULL,NULL,'admin_add',135,136),(156,86,NULL,NULL,'admin_delete',137,138),(157,21,NULL,NULL,'register',15,16),(158,21,NULL,NULL,'login',17,18),(159,21,NULL,NULL,'logout',19,20),(160,1,NULL,NULL,'Domains',194,209),(161,160,NULL,NULL,'admin_index',195,196),(162,160,NULL,NULL,'admin_view',197,198),(163,160,NULL,NULL,'admin_add',199,200),(164,160,NULL,NULL,'admin_edit',201,202),(165,160,NULL,NULL,'admin_delete',203,204),(173,1,NULL,NULL,'Themes',210,215),(293,1,NULL,NULL,'AclExtras',216,217),(294,1,NULL,NULL,'CodeCheck',218,219),(296,1,NULL,NULL,'Linkable',220,221),(297,1,NULL,NULL,'MeioUpload',222,223),(298,79,NULL,NULL,'admin_duplicate',115,116),(299,86,NULL,NULL,'admin_list_by_product',139,140),(300,1,NULL,NULL,'Copyable',224,225),(301,1,NULL,NULL,'MeioDuplicate',226,227),(302,86,NULL,NULL,'admin_change_active_status',141,142),(303,1,NULL,NULL,'Recaptcha',228,229),(304,2,NULL,NULL,'admin_change_active_status',5,6),(305,9,NULL,NULL,'admin_change_active_status',11,12),(307,21,NULL,NULL,'admin_change_active_status',21,22),(308,160,NULL,NULL,'admin_change_active_status',205,206),(309,27,NULL,NULL,'admin_change_active_status',27,28),(310,47,NULL,NULL,'admin_change_active_status',43,44),(311,61,NULL,NULL,'admin_change_active_status',59,60),(313,73,NULL,NULL,'admin_change_active_status',77,78),(314,79,NULL,NULL,'admin_change_active_status',117,118),(315,86,NULL,NULL,'admin_add_by_product',143,144),(316,86,NULL,NULL,'admin_make_this_cover',145,146),(317,92,NULL,NULL,'admin_change_active_status',151,152),(318,173,NULL,NULL,'admin_change_active_status',211,212),(319,98,NULL,NULL,'admin_change_active_status',175,176),(320,116,NULL,NULL,'admin_change_active_status',191,192),(322,61,NULL,NULL,'checkout',61,62),(323,79,NULL,NULL,'view_cart',119,120),(324,79,NULL,NULL,'edit_quantities_in_cart',121,122),(325,79,NULL,NULL,'add_to_cart',123,124),(326,79,NULL,NULL,'delete_from_cart',125,126),(327,1,NULL,NULL,'RandomString',230,231),(328,1,NULL,NULL,'ClearCache',232,233),(329,73,NULL,NULL,'admin_index',79,80),(330,73,NULL,NULL,'admin_update_settings',81,82),(331,61,NULL,NULL,'admin_index',63,64),(332,61,NULL,NULL,'admin_view',65,66),(335,61,NULL,NULL,'paypal',67,68),(337,79,NULL,NULL,'checkout',127,128),(339,1,NULL,NULL,'Filter',234,235),(340,1,NULL,NULL,'Rest',236,237),(341,1,NULL,NULL,'Paypal',238,239),(342,1,NULL,NULL,'Datasources',240,241),(343,1,NULL,NULL,'Blogs',242,257),(344,343,NULL,NULL,'view',243,244),(345,343,NULL,NULL,'admin_index',245,246),(346,343,NULL,NULL,'admin_view',247,248),(347,343,NULL,NULL,'admin_add',249,250),(348,343,NULL,NULL,'admin_edit',251,252),(349,343,NULL,NULL,'admin_delete',253,254),(350,343,NULL,NULL,'admin_change_active_status',255,256),(351,1,NULL,NULL,'GiftCards',258,281),(352,351,NULL,NULL,'index',259,260),(353,351,NULL,NULL,'view',261,262),(354,351,NULL,NULL,'add',263,264),(355,351,NULL,NULL,'edit',265,266),(356,351,NULL,NULL,'delete',267,268),(357,351,NULL,NULL,'admin_index',269,270),(358,351,NULL,NULL,'admin_view',271,272),(359,351,NULL,NULL,'admin_add',273,274),(360,351,NULL,NULL,'admin_edit',275,276),(361,351,NULL,NULL,'admin_delete',277,278),(362,351,NULL,NULL,'admin_change_active_status',279,280),(363,1,NULL,NULL,'SavedThemes',282,305),(364,363,NULL,NULL,'admin_index',283,284),(365,363,NULL,NULL,'admin_view',285,286),(366,363,NULL,NULL,'admin_add',287,288),(367,363,NULL,NULL,'admin_upload',289,290),(368,363,NULL,NULL,'admin_edit',291,292),(369,363,NULL,NULL,'admin_delete',293,294),(370,363,NULL,NULL,'admin_edit_image',295,296),(371,363,NULL,NULL,'admin_feature',297,298),(372,363,NULL,NULL,'admin_delete_image',299,300),(373,363,NULL,NULL,'admin_edit_css',301,302),(374,363,NULL,NULL,'admin_change_active_status',303,304),(375,79,NULL,NULL,'admin_upload',129,130),(376,79,NULL,NULL,'admin_toggle',131,132),(377,73,NULL,NULL,'admin_add_custom_payment',83,84),(378,73,NULL,NULL,'admin_edit_custom_payment',85,86),(379,73,NULL,NULL,'admin_delete_custom_payment',87,88),(380,1,NULL,NULL,'ShippingRates',306,319),(381,380,NULL,NULL,'admin_index',307,308),(382,380,NULL,NULL,'admin_edit',309,310),(383,380,NULL,NULL,'admin_add_price_based',311,312),(384,380,NULL,NULL,'admin_add_weight_based',313,314),(385,380,NULL,NULL,'admin_delete',315,316),(386,380,NULL,NULL,'admin_change_active_status',317,318),(387,86,NULL,NULL,'admin_uploadify',147,148),(388,1,NULL,NULL,'Posts',320,333),(389,388,NULL,NULL,'view',321,322),(390,388,NULL,NULL,'admin_view',323,324),(391,388,NULL,NULL,'admin_add',325,326),(392,388,NULL,NULL,'admin_edit',327,328),(393,388,NULL,NULL,'admin_delete',329,330),(394,388,NULL,NULL,'admin_change_active_status',331,332),(395,173,NULL,NULL,'admin_index',213,214),(396,1,NULL,NULL,'DebugKit',334,343),(397,396,NULL,NULL,'ToolbarAccess',335,342),(398,397,NULL,NULL,'history_state',336,337),(399,397,NULL,NULL,'sql_explain',338,339),(400,397,NULL,NULL,'admin_change_active_status',340,341),(401,1,NULL,NULL,'LilBlogs',344,431),(402,401,NULL,NULL,'Categories',345,360),(403,402,NULL,NULL,'admin_index',346,347),(404,402,NULL,NULL,'admin_add',348,349),(405,402,NULL,NULL,'admin_edit',350,351),(406,402,NULL,NULL,'admin_delete',352,353),(407,402,NULL,NULL,'parseUrl',354,355),(408,402,NULL,NULL,'error404',356,357),(409,402,NULL,NULL,'admin_change_active_status',358,359),(410,401,NULL,NULL,'Blogs',361,376),(411,410,NULL,NULL,'view',362,363),(412,410,NULL,NULL,'admin_index',364,365),(413,410,NULL,NULL,'admin_view',366,367),(414,410,NULL,NULL,'admin_add',368,369),(415,410,NULL,NULL,'admin_edit',370,371),(416,410,NULL,NULL,'admin_delete',372,373),(417,410,NULL,NULL,'admin_change_active_status',374,375),(418,401,NULL,NULL,'Comments',377,396),(419,418,NULL,NULL,'index',378,379),(420,418,NULL,NULL,'admin_edit',380,381),(421,418,NULL,NULL,'admin_delete',382,383),(422,418,NULL,NULL,'admin_index',384,385),(423,418,NULL,NULL,'admin_quick',386,387),(424,418,NULL,NULL,'admin_categorize',388,389),(425,418,NULL,NULL,'parseUrl',390,391),(426,418,NULL,NULL,'error404',392,393),(427,418,NULL,NULL,'admin_change_active_status',394,395),(428,401,NULL,NULL,'Authors',397,416),(429,428,NULL,NULL,'login',398,399),(430,428,NULL,NULL,'logout',400,401),(431,428,NULL,NULL,'admin_index',402,403),(432,428,NULL,NULL,'admin_add',404,405),(433,428,NULL,NULL,'admin_edit',406,407),(434,428,NULL,NULL,'admin_delete',408,409),(435,428,NULL,NULL,'parseUrl',410,411),(436,428,NULL,NULL,'error404',412,413),(437,428,NULL,NULL,'admin_change_active_status',414,415),(438,401,NULL,NULL,'Posts',417,430),(439,438,NULL,NULL,'view',418,419),(440,438,NULL,NULL,'admin_view',420,421),(441,438,NULL,NULL,'admin_add',422,423),(442,438,NULL,NULL,'admin_edit',424,425),(443,438,NULL,NULL,'admin_delete',426,427),(444,438,NULL,NULL,'admin_change_active_status',428,429),(445,1,NULL,NULL,'ThemeFolder',432,433),(446,1,NULL,NULL,'Uploadify',434,435),(447,1,NULL,NULL,'JamienayZendLucene',436,437),(448,1,NULL,NULL,'Carts',438,449),(449,448,NULL,NULL,'index',439,440),(450,448,NULL,NULL,'view',441,442),(451,448,NULL,NULL,'edit',443,444),(452,448,NULL,NULL,'delete',445,446),(453,448,NULL,NULL,'admin_change_active_status',447,448),(454,47,NULL,NULL,'admin_login',45,46),(455,47,NULL,NULL,'admin_logout',47,48),(456,47,NULL,NULL,'admin_edit',49,50),(457,160,NULL,NULL,'admin_make_this_primary',207,208),(458,61,NULL,NULL,'success',69,70),(459,61,NULL,NULL,'updatePrices',71,72),(460,61,NULL,NULL,'pay',73,74),(462,92,NULL,NULL,'admin_account',153,154),(463,92,NULL,NULL,'admin_cancelaccount',155,156);

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
) ENGINE=InnoDB AUTO_INCREMENT=415 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `aros` */

insert  into `aros`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values (1,NULL,'Group',1,'administrators',1,2),(2,NULL,'Group',2,'editors',3,4),(3,NULL,'Group',3,'merchants',5,484),(4,NULL,'Group',4,'customers',485,552),(5,3,'User',1,NULL,6,7),(6,3,'User',2,NULL,8,9),(7,3,'User',2,NULL,10,11),(8,3,'User',1,NULL,12,13),(9,3,'User',1,NULL,14,15),(10,3,'User',1,NULL,16,17),(11,3,'User',1,NULL,18,19),(12,3,'User',1,NULL,20,21),(13,3,'User',1,NULL,22,23),(14,3,'User',1,NULL,24,25),(15,3,'User',1,NULL,26,27),(16,3,'User',2,NULL,28,29),(17,3,'User',2,NULL,30,31),(18,3,'User',2,NULL,32,33),(19,3,'User',2,NULL,34,35),(20,3,'User',2,NULL,36,37),(21,3,'User',2,NULL,38,39),(22,3,'User',2,NULL,40,41),(23,3,'User',2,NULL,42,43),(24,3,'User',2,NULL,44,45),(25,3,'User',2,NULL,46,47),(26,3,'User',2,NULL,48,49),(27,3,'User',2,NULL,50,51),(28,3,'User',2,NULL,52,53),(29,3,'User',2,NULL,54,55),(30,3,'User',2,NULL,56,57),(31,3,'User',2,NULL,58,59),(32,NULL,'User',2,NULL,553,554),(33,NULL,'User',2,NULL,555,556),(34,NULL,'User',2,NULL,557,558),(35,NULL,'User',2,NULL,559,560),(36,NULL,'User',2,NULL,561,562),(37,NULL,'User',2,NULL,563,564),(38,NULL,'User',2,NULL,565,566),(39,NULL,'User',2,NULL,567,568),(40,NULL,'User',2,NULL,569,570),(41,NULL,'User',2,NULL,571,572),(42,NULL,'User',2,NULL,573,574),(43,NULL,'User',2,NULL,575,576),(44,NULL,'User',2,NULL,577,578),(45,NULL,'User',2,NULL,579,580),(46,NULL,'User',2,NULL,581,582),(47,NULL,'User',3,NULL,583,584),(48,NULL,'User',2,NULL,585,586),(49,NULL,'User',2,NULL,587,588),(50,NULL,'User',2,NULL,589,590),(51,NULL,'User',2,NULL,591,592),(52,3,'User',2,NULL,60,61),(53,NULL,'User',2,NULL,593,594),(54,3,'User',2,NULL,62,63),(55,NULL,'User',2,NULL,595,596),(56,3,'User',2,NULL,64,65),(57,NULL,'User',2,NULL,597,598),(58,3,'User',2,NULL,66,67),(59,NULL,'User',2,NULL,599,600),(60,NULL,'User',2,NULL,601,602),(61,NULL,'User',2,NULL,603,604),(62,NULL,'User',2,NULL,605,606),(63,NULL,'User',2,NULL,607,608),(64,3,'User',2,NULL,68,69),(65,3,'User',2,NULL,70,71),(66,3,'User',2,NULL,72,73),(67,3,'User',2,NULL,74,75),(68,3,'User',4,NULL,76,77),(69,3,'User',5,NULL,78,79),(70,3,'User',2,NULL,80,81),(71,3,'User',2,NULL,82,83),(72,3,'User',2,NULL,84,85),(73,3,'User',2,NULL,86,87),(74,3,'User',6,NULL,88,89),(75,3,'User',7,NULL,90,91),(76,3,'User',2,NULL,92,93),(77,3,'User',2,NULL,94,95),(78,3,'User',2,NULL,96,97),(79,3,'User',2,NULL,98,99),(80,3,'User',2,NULL,100,101),(81,3,'User',2,NULL,102,103),(82,3,'User',2,NULL,104,105),(83,3,'User',2,NULL,106,107),(84,3,'User',2,NULL,108,109),(85,3,'User',2,NULL,110,111),(86,3,'User',2,NULL,112,113),(87,3,'User',2,NULL,114,115),(88,3,'User',2,NULL,116,117),(89,3,'User',2,NULL,118,119),(90,3,'User',2,NULL,120,121),(91,3,'User',2,NULL,122,123),(92,4,'User',6,NULL,486,487),(93,3,'User',2,NULL,124,125),(94,3,'User',2,NULL,126,127),(95,3,'User',2,NULL,128,129),(96,3,'User',2,NULL,130,131),(97,3,'User',2,NULL,132,133),(98,3,'User',2,NULL,134,135),(99,3,'User',2,NULL,136,137),(100,3,'User',2,NULL,138,139),(101,3,'User',2,NULL,140,141),(102,3,'User',2,NULL,142,143),(103,3,'User',2,NULL,144,145),(104,3,'User',2,NULL,146,147),(105,3,'User',2,NULL,148,149),(106,3,'User',2,NULL,150,151),(107,3,'User',2,NULL,152,153),(108,3,'User',2,NULL,154,155),(109,3,'User',2,NULL,156,157),(110,3,'User',2,NULL,158,159),(111,3,'User',2,NULL,160,161),(112,3,'User',2,NULL,162,163),(113,3,'User',2,NULL,164,165),(114,3,'User',2,NULL,166,167),(115,3,'User',2,NULL,168,169),(116,3,'User',2,NULL,170,171),(117,3,'User',2,NULL,172,173),(118,3,'User',2,NULL,174,175),(119,3,'User',2,NULL,176,177),(120,3,'User',2,NULL,178,179),(121,3,'User',2,NULL,180,181),(122,3,'User',2,NULL,182,183),(123,3,'User',2,NULL,184,185),(124,3,'User',2,NULL,186,187),(125,3,'User',2,NULL,188,189),(126,3,'User',2,NULL,190,191),(127,3,'User',2,NULL,192,193),(128,3,'User',2,NULL,194,195),(129,3,'User',2,NULL,196,197),(130,3,'User',2,NULL,198,199),(131,3,'User',2,NULL,200,201),(132,3,'User',2,NULL,202,203),(133,3,'User',2,NULL,204,205),(134,3,'User',2,NULL,206,207),(135,3,'User',2,NULL,208,209),(136,3,'User',2,NULL,210,211),(137,3,'User',2,NULL,212,213),(138,3,'User',2,NULL,214,215),(139,3,'User',2,NULL,216,217),(140,3,'User',2,NULL,218,219),(141,3,'User',2,NULL,220,221),(142,3,'User',2,NULL,222,223),(143,3,'User',2,NULL,224,225),(144,3,'User',2,NULL,226,227),(145,3,'User',2,NULL,228,229),(146,3,'User',2,NULL,230,231),(147,3,'User',2,NULL,232,233),(148,3,'User',2,NULL,234,235),(149,3,'User',2,NULL,236,237),(150,3,'User',2,NULL,238,239),(151,3,'User',2,NULL,240,241),(152,3,'User',2,NULL,242,243),(153,3,'User',2,NULL,244,245),(154,3,'User',2,NULL,246,247),(155,3,'User',2,NULL,248,249),(156,3,'User',2,NULL,250,251),(157,3,'User',2,NULL,252,253),(158,3,'User',2,NULL,254,255),(159,3,'User',2,NULL,256,257),(160,3,'User',2,NULL,258,259),(161,3,'User',2,NULL,260,261),(162,3,'User',2,NULL,262,263),(163,3,'User',2,NULL,264,265),(164,3,'User',2,NULL,266,267),(165,3,'User',2,NULL,268,269),(166,3,'User',2,NULL,270,271),(167,3,'User',2,NULL,272,273),(168,3,'User',2,NULL,274,275),(169,3,'User',2,NULL,276,277),(170,3,'User',2,NULL,278,279),(171,3,'User',2,NULL,280,281),(172,3,'User',2,NULL,282,283),(173,3,'User',2,NULL,284,285),(174,3,'User',2,NULL,286,287),(175,3,'User',2,NULL,288,289),(176,3,'User',2,NULL,290,291),(177,3,'User',2,NULL,292,293),(178,3,'User',2,NULL,294,295),(179,3,'User',2,NULL,296,297),(180,3,'User',2,NULL,298,299),(181,3,'User',2,NULL,300,301),(182,3,'User',2,NULL,302,303),(183,3,'User',2,NULL,304,305),(184,3,'User',2,NULL,306,307),(185,3,'User',2,NULL,308,309),(186,3,'User',2,NULL,310,311),(187,3,'User',2,NULL,312,313),(188,3,'User',2,NULL,314,315),(189,3,'User',2,NULL,316,317),(190,3,'User',2,NULL,318,319),(191,3,'User',2,NULL,320,321),(192,3,'User',2,NULL,322,323),(193,3,'User',2,NULL,324,325),(194,3,'User',2,NULL,326,327),(195,3,'User',2,NULL,328,329),(196,3,'User',2,NULL,330,331),(197,3,'User',2,NULL,332,333),(198,3,'User',2,NULL,334,335),(199,3,'User',2,NULL,336,337),(200,3,'User',2,NULL,338,339),(201,3,'User',6,NULL,340,341),(202,4,'User',7,NULL,488,489),(204,4,'User',9,NULL,490,491),(205,4,'User',10,NULL,492,493),(206,4,'User',11,NULL,494,495),(207,4,'User',12,NULL,496,497),(208,4,'User',13,NULL,498,499),(209,4,'User',14,NULL,500,501),(210,4,'User',15,NULL,502,503),(211,4,'User',16,NULL,504,505),(212,4,'User',17,NULL,506,507),(213,4,'User',18,NULL,508,509),(214,4,'User',19,NULL,510,511),(215,4,'User',20,NULL,512,513),(216,4,'User',21,NULL,514,515),(217,4,'User',22,NULL,516,517),(218,4,'User',23,NULL,518,519),(219,3,'User',2,NULL,342,343),(220,3,'User',2,NULL,344,345),(221,3,'User',2,NULL,346,347),(222,3,'User',2,NULL,348,349),(223,3,'User',2,NULL,350,351),(224,3,'User',2,NULL,352,353),(225,3,'User',2,NULL,354,355),(226,3,'User',2,NULL,356,357),(227,3,'User',2,NULL,358,359),(228,3,'User',2,NULL,360,361),(229,3,'User',2,NULL,362,363),(230,3,'User',2,NULL,364,365),(231,3,'User',3,NULL,366,367),(232,3,'User',3,NULL,368,369),(235,4,'User',26,NULL,520,521),(236,4,'User',27,NULL,522,523),(237,4,'User',28,NULL,524,525),(238,4,'User',29,NULL,526,527),(239,4,'User',30,NULL,528,529),(240,4,'User',31,NULL,530,531),(241,4,'User',32,NULL,532,533),(243,4,'User',34,NULL,534,535),(244,4,'User',35,NULL,536,537),(245,4,'User',36,NULL,538,539),(246,4,'User',37,NULL,540,541),(247,4,'User',38,NULL,542,543),(248,4,'User',39,NULL,544,545),(249,4,'User',40,NULL,546,547),(250,4,'User',41,NULL,548,549),(251,NULL,'User',42,NULL,609,610),(252,NULL,'Group',5,'casual',611,800),(253,NULL,'User',43,NULL,723,802),(254,252,'User',44,NULL,612,613),(255,252,'User',45,NULL,614,615),(256,252,'User',46,NULL,616,617),(257,4,'User',47,NULL,550,551),(258,252,'User',48,NULL,618,619),(259,252,'User',49,NULL,620,621),(260,252,'User',50,NULL,622,623),(261,252,'User',51,NULL,624,625),(262,252,'User',52,NULL,626,627),(263,252,'User',53,NULL,628,629),(264,252,'User',54,NULL,630,631),(265,252,'User',55,NULL,632,633),(266,252,'User',56,NULL,634,635),(267,252,'User',57,NULL,636,637),(268,252,'User',58,NULL,638,639),(269,252,'User',59,NULL,640,641),(270,252,'User',60,NULL,642,643),(271,252,'User',61,NULL,644,645),(272,252,'User',62,NULL,646,647),(273,252,'User',63,NULL,648,649),(274,252,'User',64,NULL,650,651),(275,252,'User',65,NULL,652,653),(276,252,'User',66,NULL,654,655),(277,252,'User',67,NULL,656,657),(278,252,'User',68,NULL,658,659),(279,252,'User',69,NULL,660,661),(280,252,'User',70,NULL,662,663),(281,252,'User',71,NULL,664,665),(282,252,'User',72,NULL,666,667),(283,252,'User',73,NULL,668,669),(284,252,'User',74,NULL,670,671),(285,252,'User',75,NULL,672,673),(286,252,'User',76,NULL,674,675),(287,252,'User',77,NULL,676,677),(288,252,'User',78,NULL,678,679),(289,252,'User',79,NULL,680,681),(290,252,'User',80,NULL,682,683),(291,252,'User',81,NULL,684,685),(292,252,'User',82,NULL,686,687),(293,252,'User',83,NULL,688,689),(294,252,'User',84,NULL,690,691),(295,252,'User',85,NULL,692,693),(296,252,'User',86,NULL,694,695),(297,252,'User',87,NULL,696,697),(298,252,'User',88,NULL,698,699),(299,252,'User',89,NULL,700,701),(300,252,'User',90,NULL,702,703),(301,252,'User',91,NULL,704,705),(302,252,'User',92,NULL,706,707),(303,252,'User',93,NULL,708,709),(304,252,'User',94,NULL,710,711),(305,252,'User',95,NULL,712,713),(306,252,'User',96,NULL,714,715),(307,252,'User',97,NULL,716,717),(308,252,'User',98,NULL,718,719),(309,252,'User',100,NULL,720,725),(312,252,'User',101,NULL,720,723),(313,252,'User',99,NULL,720,721),(314,252,'User',101,NULL,726,727),(315,252,'User',102,NULL,728,729),(316,252,'User',103,NULL,730,731),(317,252,'User',104,NULL,732,737),(320,252,'User',105,NULL,732,735),(321,252,'User',106,NULL,732,733),(322,252,'User',107,NULL,738,739),(323,252,'User',108,NULL,740,741),(324,252,'User',109,NULL,742,743),(325,252,'User',110,NULL,744,745),(326,252,'User',111,NULL,746,747),(327,252,'User',112,NULL,748,749),(328,3,'User',113,NULL,370,371),(329,252,'User',114,NULL,750,751),(330,3,'User',115,NULL,372,373),(331,252,'User',116,NULL,752,753),(332,3,'User',117,NULL,374,375),(333,252,'User',118,NULL,754,755),(334,3,'User',119,NULL,376,377),(335,252,'User',120,NULL,756,757),(336,3,'User',121,NULL,378,379),(337,252,'User',122,NULL,758,759),(338,3,'User',123,NULL,380,381),(339,252,'User',124,NULL,760,761),(340,3,'User',125,NULL,382,383),(341,252,'User',126,NULL,762,763),(342,3,'User',127,NULL,384,385),(343,252,'User',128,NULL,764,765),(344,3,'User',129,NULL,386,387),(345,252,'User',130,NULL,766,767),(346,3,'User',131,NULL,388,389),(347,252,'User',132,NULL,768,769),(348,3,'User',133,NULL,390,391),(349,252,'User',134,NULL,770,771),(350,3,'User',135,NULL,392,393),(351,252,'User',136,NULL,772,773),(352,3,'User',137,NULL,394,395),(353,252,'User',138,NULL,774,775),(354,3,'User',139,NULL,396,397),(355,252,'User',140,NULL,776,777),(356,252,'User',141,NULL,778,779),(357,252,'User',143,NULL,780,787),(361,252,'User',142,NULL,780,785),(362,252,'User',144,NULL,780,783),(363,252,'User',145,NULL,780,781),(364,252,'User',146,NULL,788,789),(365,252,'User',147,NULL,790,791),(366,252,'User',149,NULL,792,797),(369,252,'User',148,NULL,792,795),(370,252,'User',150,NULL,792,793),(371,3,'User',151,NULL,398,399),(372,3,'User',152,NULL,400,401),(373,3,'User',153,NULL,402,403),(374,3,'User',154,NULL,404,405),(375,3,'User',155,NULL,406,407),(376,3,'User',156,NULL,408,409),(377,3,'User',157,NULL,410,411),(378,3,'User',158,NULL,412,413),(379,3,'User',159,NULL,414,415),(380,3,'User',160,NULL,416,417),(381,3,'User',161,NULL,418,419),(382,3,'User',162,NULL,420,421),(383,3,'User',163,NULL,422,423),(384,3,'User',164,NULL,424,425),(385,3,'User',165,NULL,426,427),(386,3,'User',166,NULL,428,429),(387,3,'User',167,NULL,430,431),(388,3,'User',168,NULL,432,433),(389,3,'User',169,NULL,434,435),(390,3,'User',170,NULL,436,437),(391,3,'User',171,NULL,438,439),(392,3,'User',172,NULL,440,441),(393,3,'User',173,NULL,442,443),(394,3,'User',174,NULL,444,445),(395,3,'User',175,NULL,446,447),(396,3,'User',176,NULL,448,449),(397,3,'User',177,NULL,450,451),(398,3,'User',178,NULL,452,453),(399,3,'User',179,NULL,454,455),(400,3,'User',180,NULL,456,457),(401,3,'User',181,NULL,458,459),(402,3,'User',182,NULL,460,461),(403,3,'User',183,NULL,462,463),(404,3,'User',184,NULL,464,465),(405,3,'User',185,NULL,466,467),(406,3,'User',1,NULL,468,469),(407,3,'User',2,NULL,470,471),(408,3,'User',3,NULL,472,473),(409,3,'User',4,NULL,474,475),(410,3,'User',5,NULL,476,477),(411,3,'User',6,NULL,478,479),(412,3,'User',7,NULL,480,481),(413,3,'User',8,NULL,482,483),(414,252,'User',9,NULL,798,799);

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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

/*Data for the table `aros_acos` */

insert  into `aros_acos`(`id`,`aro_id`,`aco_id`,`_create`,`_read`,`_update`,`_delete`) values (1,1,1,'1','1','1','1'),(2,2,1,'-1','-1','-1','-1'),(3,2,79,'1','1','1','1'),(4,2,92,'1','1','1','1'),(5,3,1,'-1','-1','-1','-1'),(11,3,51,'1','1','1','1'),(12,3,80,'1','1','1','1'),(14,3,138,'1','1','1','1'),(15,3,139,'1','1','1','1'),(16,3,140,'1','1','1','1'),(17,3,137,'1','1','1','1'),(18,3,154,'1','1','1','1'),(20,3,156,'1','1','1','1'),(24,4,105,'1','1','1','1'),(25,4,104,'1','1','1','1'),(26,4,3,'1','1','1','1'),(28,4,159,'1','1','1','1'),(29,4,158,'1','1','1','1'),(30,2,3,'1','1','1','1'),(31,3,3,'1','1','1','1'),(32,4,1,'-1','-1','-1','-1'),(33,2,98,'1','1','1','1'),(34,2,160,'1','1','1','1'),(35,3,163,'1','1','1','1'),(36,3,164,'1','1','1','1'),(37,3,165,'1','1','1','1'),(38,3,162,'1','1','1','1'),(39,3,161,'1','1','1','1'),(42,3,299,'1','1','1','1'),(43,3,302,'1','1','1','1'),(44,3,316,'1','1','1','1'),(45,3,315,'1','1','1','1'),(46,3,329,'1','1','1','1'),(47,3,330,'1','1','1','1'),(48,3,331,'1','1','1','1'),(49,3,332,'1','1','1','1'),(50,2,173,'1','1','1','1'),(51,3,456,'1','1','1','1'),(52,3,455,'1','1','1','1'),(53,3,454,'1','1','1','1'),(54,3,457,'1','1','1','1'),(55,3,364,'1','1','1','1'),(56,3,368,'1','1','1','1'),(57,3,366,'1','1','1','1'),(58,3,369,'1','1','1','1'),(59,3,371,'1','1','1','1'),(60,3,370,'1','1','1','1'),(61,3,372,'1','1','1','1'),(62,3,373,'1','1','1','1'),(63,3,375,'1','1','1','1'),(64,3,298,'1','1','1','1'),(65,3,376,'1','1','1','1'),(66,3,387,'1','1','1','1'),(67,3,124,'1','1','1','1'),(68,3,125,'1','1','1','1'),(69,3,126,'1','1','1','1'),(70,3,123,'1','1','1','1'),(71,3,122,'1','1','1','1'),(72,3,462,'1','1','1','1'),(73,3,463,'1','1','1','1');

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

insert  into `cake_sessions`(`id`,`data`,`expires`) values ('k6119dio8dgck7gdajliup8q52','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292069193;s:7:\"timeout\";i:300;}',1292069212),('n4ud4hdesrmaa4ge3tcujnfcb7','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1291907290;s:7:\"timeout\";i:100;}_Token|s:207:\"a:5:{s:3:\"key\";s:40:\"c82a40144e6c31ddfe751e5d63f61284de7b4e13\";s:7:\"expires\";i:1291901289;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:1:{i:0;s:16:\"Shop.web_address\";}}\";',1291907290),('a8qea77sqiuua65ni5o1addqh5','Config|a:4:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292080544;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:2:{s:4:\"Shop\";a:7:{s:2:\"id\";s:1:\"5\";s:4:\"name\";s:6:\"shop10\";s:11:\"web_address\";s:30:\"http://shop10.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-11 08:25:45\";s:8:\"modified\";s:19:\"2010-12-11 08:25:45\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"0\";}s:6:\"Domain\";a:5:{s:6:\"domain\";s:23:\"http://ombi60.localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"5\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";}}Message|a:1:{s:4:\"auth\";a:3:{s:7:\"message\";s:47:\"You are not authorized to access that location.\";s:7:\"element\";s:7:\"default\";s:6:\"params\";a:0:{}}}Auth|a:4:{s:4:\"User\";a:10:{s:2:\"id\";s:1:\"8\";s:5:\"email\";s:16:\"owner@shop14.com\";s:8:\"group_id\";s:1:\"3\";s:9:\"full_name\";s:14:\"barry mortimer\";s:12:\"name_to_call\";s:5:\"barry\";s:13:\"last_login_on\";N;s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2010-12-11 09:03:32\";s:8:\"modified\";s:19:\"2010-12-11 09:03:32\";s:11:\"language_id\";s:1:\"1\";}s:8:\"Merchant\";a:4:{s:2:\"id\";s:1:\"8\";s:5:\"owner\";s:1:\"1\";s:7:\"shop_id\";s:1:\"9\";s:7:\"user_id\";s:1:\"8\";}s:4:\"Shop\";a:7:{s:2:\"id\";s:1:\"9\";s:4:\"name\";s:6:\"shop14\";s:11:\"web_address\";s:30:\"http://shop14.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-11 09:03:32\";s:8:\"modified\";s:19:\"2010-12-11 09:03:32\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"0\";}s:8:\"Language\";a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:7:\"English\";s:11:\"locale_name\";s:3:\"eng\";}}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"219091ada9706eb93e79478ae693bc9e20f80d21\";s:7:\"expires\";i:1292062544;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292080544),('p6rcs64qprfigdi4bviprdd702','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292041412;s:7:\"timeout\";i:100;}_Token|s:207:\"a:5:{s:3:\"key\";s:40:\"3ead7f0ac6bddb0b6fea9039ce7b95648752b50a\";s:7:\"expires\";i:1292035412;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:1:{i:0;s:16:\"Shop.web_address\";}}\";Subscription|a:1:{s:6:\"Paypal\";a:1:{s:5:\"TOKEN\";s:20:\"EC-8214083179591210S\";}}',1292041416),('vhu3gf5g3me0vkenho8tjiufg0','Config|a:4:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292262008;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:2:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"5\";s:4:\"name\";s:6:\"shop10\";s:11:\"web_address\";s:30:\"http://shop10.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-11 08:25:45\";s:8:\"modified\";s:19:\"2010-12-11 08:25:45\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"0\";s:11:\"deny_access\";b:1;}s:6:\"Domain\";a:5:{s:6:\"domain\";s:23:\"http://ombi60.localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"5\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";}}Message|a:0:{}Auth|a:4:{s:8:\"Language\";a:3:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:7:\"English\";s:11:\"locale_name\";s:3:\"eng\";}s:4:\"User\";a:10:{s:2:\"id\";s:1:\"8\";s:5:\"email\";s:16:\"owner@shop14.com\";s:8:\"group_id\";s:1:\"3\";s:9:\"full_name\";s:14:\"barry mortimer\";s:12:\"name_to_call\";s:5:\"barry\";s:13:\"last_login_on\";N;s:6:\"status\";s:1:\"1\";s:7:\"created\";s:19:\"2010-12-11 09:03:32\";s:8:\"modified\";s:19:\"2010-12-11 09:03:32\";s:11:\"language_id\";s:1:\"1\";}s:8:\"Merchant\";a:4:{s:2:\"id\";s:1:\"8\";s:5:\"owner\";s:1:\"1\";s:7:\"shop_id\";s:1:\"9\";s:7:\"user_id\";s:1:\"8\";}s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"9\";s:4:\"name\";s:6:\"shop14\";s:11:\"web_address\";s:30:\"http://shop14.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-11 09:03:32\";s:8:\"modified\";s:19:\"2010-12-11 09:03:32\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"0\";s:11:\"deny_access\";s:1:\"0\";}}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"3563a8be88c8fc6bf101549bb617508162f59375\";s:7:\"expires\";i:1292243367;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292262008),('uqvvakqaet4fc6de9smeeig534','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292237374;s:7:\"timeout\";i:100;}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"d9623e6fcb5d5a51d0e691e929f5ddf98aab5f3a\";s:7:\"expires\";i:1292231368;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292237374),('p49ff5ss82331d02o5v7dcpi50','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292219840;s:7:\"timeout\";i:100;}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"45b6b8f6c4c46ed10d59d5eff4b9f018f7a509f5\";s:7:\"expires\";i:1292213840;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292219841),('3g42e4lsu3juvskg2omb55a9d5','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292223057;s:7:\"timeout\";i:100;}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"cf6804366d130906aac74abf7eff0c8464334114\";s:7:\"expires\";i:1292217056;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292223058),('32dlm39cmglh7h6qoctirdouq7','Config|a:3:{s:9:\"userAgent\";s:32:\"2a5e3a8072a2519c280f8cbfc37ab635\";s:4:\"time\";i:1292223131;s:7:\"timeout\";i:100;}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"0ff2635e7dae87f9badd3cf327a9ba3c1f718b8b\";s:7:\"expires\";i:1292217130;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292223131),('os01d7gv507g7mk086r884dlq1','Config|a:4:{s:9:\"userAgent\";s:32:\"d44d3ad92fc64f25864865e2b87ade5e\";s:4:\"time\";i:1292261026;s:7:\"timeout\";i:300;s:8:\"language\";s:3:\"eng\";}CurrentShop|a:2:{s:4:\"Shop\";a:8:{s:2:\"id\";s:1:\"5\";s:4:\"name\";s:6:\"shop10\";s:11:\"web_address\";s:30:\"http://shop10.myspree2shop.com\";s:7:\"created\";s:19:\"2010-12-11 08:25:45\";s:8:\"modified\";s:19:\"2010-12-13 03:32:10\";s:6:\"status\";s:1:\"1\";s:14:\"saved_theme_id\";s:1:\"0\";s:11:\"deny_access\";s:1:\"1\";}s:6:\"Domain\";a:5:{s:6:\"domain\";s:23:\"http://ombi60.localhost\";s:2:\"id\";s:1:\"1\";s:7:\"shop_id\";s:1:\"5\";s:7:\"primary\";s:1:\"1\";s:20:\"always_redirect_here\";s:1:\"0\";}}Message|a:0:{}Auth|a:1:{s:8:\"redirect\";s:6:\"/admin\";}_Token|s:179:\"a:5:{s:3:\"key\";s:40:\"9d3931bb484b0f3ba8260479ca5b1fa48a7cd276\";s:7:\"expires\";i:1292243026;s:18:\"allowedControllers\";a:0:{}s:14:\"allowedActions\";a:0:{}s:14:\"disabledFields\";a:0:{}}\";',1292261026);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `cancellations` */

insert  into `cancellations`(`id`,`short_reason`,`long_reason`,`shop_id`,`created`,`modified`,`user_id`) values (1,NULL,NULL,5,'2010-12-13 03:30:56','2010-12-13 03:30:56',8),(2,'Stop business','test 123',5,'2010-12-13 03:32:10','2010-12-13 03:32:10',8),(3,'Stop business','test',5,'2010-12-13 07:29:28','2010-12-13 07:29:28',8);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `casual_surfers` */

insert  into `casual_surfers`(`id`,`shop_id`,`user_id`) values (1,5,9);

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

/*Data for the table `domains` */

insert  into `domains`(`id`,`domain`,`shop_id`,`primary`,`always_redirect_here`) values (1,'http://ombi60.localhost',5,1,0),(3,'http://shop4.ombi60.biz',5,0,0),(4,'http://shop3.ombi60.biz',4,1,0),(5,'http://shop7.ombi60.biz',6,1,0),(6,'http://test.com',5,0,0),(7,'http://shop17.myspree2shop.com',9,1,0),(56,'http://shop07.myspree2shop.com',2,1,0),(57,'http://shop08.myspree2shop.com',3,1,0),(58,'http://shop09.myspree2shop.com',4,1,0),(59,'http://shop10.myspree2shop.com',5,1,0),(60,'http://shop11.myspree2shop.com',6,1,0),(61,'http://shop12.myspree2shop.com',7,1,0),(62,'http://shop13.myspree2shop.com',8,1,0),(63,'http://shop14.myspree2shop.com',9,1,0);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `invoices` */

insert  into `invoices`(`id`,`created`,`title`,`shop_id`,`description`,`payment_number`,`payer_user`) values (1,'2010-12-07 13:31:52','starter',2,'Initial signup',NULL,NULL),(2,'2010-12-07 20:13:19','starter',3,'Initial signup',NULL,NULL),(3,'2010-12-11 08:24:45','starter',4,'Initial signup',NULL,NULL),(4,'2010-12-11 08:25:46','starter',5,'Initial signup',NULL,NULL),(5,'2010-12-11 08:27:14','starter',6,'Initial signup',NULL,NULL),(6,'2010-12-11 08:32:25','starter',7,'Initial signup',NULL,NULL),(7,'2010-12-11 08:34:46','starter',8,'Initial signup',NULL,NULL),(8,'2010-12-11 09:03:32','starter',9,'Initial signup',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `merchants` */

insert  into `merchants`(`id`,`owner`,`shop_id`,`user_id`) values (1,1,2,1),(2,1,3,2),(3,1,4,3),(4,1,5,4),(5,1,6,5),(6,1,7,6),(7,1,8,7),(8,1,9,8);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`cover`,`created`,`modified`,`filename`,`dir`,`mimetype`,`filesize`) values (1,1,1,'2010-05-20 07:59:19','2010-05-20 07:59:19','default.jpg','uploads\\products','image/jpeg',6103),(2,2,1,'2010-12-07 13:31:53','2010-12-07 13:31:53','default-9.jpg','uploads/products','image/jpeg',6103),(3,3,1,'2010-12-07 20:13:20','2010-12-07 20:13:20','default-10.jpg','uploads/products','image/jpeg',6103),(4,4,1,'2010-12-11 08:24:46','2010-12-11 08:24:46','default-11.jpg','uploads/products','image/jpeg',6103),(5,5,1,'2010-12-11 08:25:46','2010-12-11 08:25:46','default-12.jpg','uploads/products','image/jpeg',6103),(6,6,1,'2010-12-11 08:27:14','2010-12-11 08:27:14','default-13.jpg','uploads/products','image/jpeg',6103),(7,7,1,'2010-12-11 08:32:25','2010-12-11 08:32:25','default-14.jpg','uploads/products','image/jpeg',6103),(8,8,1,'2010-12-11 08:34:46','2010-12-11 08:34:46','default-15.jpg','uploads/products','image/jpeg',6103),(9,9,1,'2010-12-11 09:03:32','2010-12-11 09:03:32','default-16.jpg','uploads/products','image/jpeg',6103);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `products` */

insert  into `products`(`id`,`shop_id`,`title`,`code`,`description`,`price`,`created`,`modified`,`status`,`weight`,`currency`,`weight_unit`,`shipping_required`) values (1,1,'Dummy Product',NULL,NULL,'0.0000','2010-05-20 08:00:24','2010-05-20 08:00:24',1,'7.0000','SGD','kg',1),(2,2,'Dummy Product',NULL,NULL,'0.0000','2010-12-07 13:31:52','2010-12-07 13:31:53',1,'7.0000','SGD','kg',1),(3,3,'Dummy Product',NULL,NULL,'0.0000','2010-12-07 20:13:19','2010-12-07 20:13:20',1,'7.0000','SGD','kg',1),(4,4,'Dummy Product',NULL,NULL,'0.0000','2010-12-11 08:24:45','2010-12-11 08:24:46',1,'7.0000','SGD','kg',1),(5,5,'Dummy Product',NULL,NULL,'0.0000','2010-12-11 08:25:46','2010-12-11 08:25:46',1,'7.0000','SGD','kg',1),(6,6,'Dummy Product',NULL,NULL,'0.0000','2010-12-11 08:27:14','2010-12-11 08:27:14',1,'7.0000','SGD','kg',1),(7,7,'Dummy Product',NULL,NULL,'0.0000','2010-12-11 08:32:25','2010-12-11 08:32:25',1,'7.0000','SGD','kg',1),(8,8,'Dummy Product',NULL,NULL,'0.0000','2010-12-11 08:34:46','2010-12-11 08:34:46',1,'7.0000','SGD','kg',1),(9,9,'Dummy Product',NULL,NULL,'0.0000','2010-12-11 09:03:32','2010-12-11 09:03:32',1,'7.0000','SGD','kg',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `saved_themes` */

insert  into `saved_themes`(`id`,`name`,`description`,`author`,`created`,`modified`,`folder_name`,`shop_id`,`theme_id`,`featured`) values (13,'default','','evey','2010-09-15 06:21:11','2010-09-15 06:21:12','5_default',5,0,0),(14,'alt','','evey','2010-09-15 06:23:34','2010-09-15 06:23:36','5_alt',5,0,1),(15,'alt','alt','barry mortimer','2010-12-11 08:34:46','2010-12-11 08:34:46','7_alt',8,4,1),(16,'alt','alt','barry mortimer','2010-12-11 09:03:33','2010-12-11 09:03:33','8_alt',9,4,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `shops` */

insert  into `shops`(`id`,`name`,`web_address`,`created`,`modified`,`status`,`saved_theme_id`,`deny_access`) values (1,'a','http://a.myspree2shop.com',NULL,NULL,1,0,0),(2,'shop07','http://shop07.myspree2shop.com','2010-12-07 13:31:52','2010-12-07 13:31:52',1,0,0),(3,'shop08','http://shop08.myspree2shop.com','2010-12-07 20:13:19','2010-12-07 20:13:19',1,0,0),(4,'shop09','http://shop09.myspree2shop.com','2010-12-11 08:24:45','2010-12-11 08:24:45',1,0,0),(5,'shop10','http://shop10.myspree2shop.com','2010-12-11 08:25:45','2010-12-13 07:29:27',1,0,1),(6,'shop11','http://shop11.myspree2shop.com','2010-12-11 08:27:13','2010-12-11 08:27:13',1,0,0),(7,'shop12','http://shop12.myspree2shop.com','2010-12-11 08:32:25','2010-12-11 08:32:25',1,0,0),(8,'shop13','http://shop13.myspree2shop.com','2010-12-11 08:34:46','2010-12-11 08:34:46',1,0,0),(9,'shop14','http://shop14.myspree2shop.com','2010-12-11 09:03:32','2010-12-11 09:03:32',1,0,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8;

/*Data for the table `shops_payment_modules` */

insert  into `shops_payment_modules`(`id`,`shop_id`,`payment_module_id`,`default`,`active`,`display_name`) values (1,5,1,0,1,'Cash On Delivery'),(2,5,1,0,1,'Money Order'),(3,5,2,0,1,'Paypal'),(136,2,1,0,1,''),(137,2,2,0,1,''),(138,2,3,0,1,''),(139,2,4,0,1,''),(140,3,1,0,1,''),(141,3,2,0,1,''),(142,3,3,0,1,''),(143,3,4,0,1,''),(144,4,1,0,1,''),(145,4,2,0,1,''),(146,4,3,0,1,''),(147,4,4,0,1,''),(148,5,1,0,1,''),(149,5,2,0,1,''),(150,5,3,0,1,''),(151,5,4,0,1,''),(152,6,1,0,1,''),(153,6,2,0,1,''),(154,6,3,0,1,''),(155,6,4,0,1,''),(156,7,1,0,1,''),(157,7,2,0,1,''),(158,7,3,0,1,''),(159,7,4,0,1,''),(160,8,1,0,1,''),(161,8,2,0,1,''),(162,8,3,0,1,''),(163,8,4,0,1,''),(164,9,1,0,1,''),(165,9,2,0,1,''),(166,9,3,0,1,''),(167,9,4,0,1,'');

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
  `folder_name` varchar(255) NOT NULL,
  `shop_id` int(11) DEFAULT '0',
  `price` decimal(7,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `themes` */

insert  into `themes`(`id`,`name`,`description`,`author`,`created`,`modified`,`available_for_all`,`folder_name`,`shop_id`,`price`) values (1,'blue-white','blue-white','kimsia','2010-05-13 00:00:00','2010-05-13 00:00:00',1,'',NULL,'1.00'),(2,'orange','orange','kimsia','2010-05-13 00:00:00','2010-05-13 00:00:00',1,'',NULL,'1.00'),(3,'default','default','kimsia','2010-07-06 12:55:23','2010-07-06 12:55:28',1,'',NULL,'0.00'),(4,'alt','alt','kimsia','2010-07-08 00:00:00','2010-07-08 00:00:00',1,'alt',NULL,'0.00');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`group_id`,`full_name`,`name_to_call`,`last_login_on`,`status`,`created`,`modified`,`language_id`) values (1,'owner@shop07.com','9d0f66382ba9016dfce844f113f9778f6c405236',3,'molly','molly',NULL,1,'2010-12-07 13:31:52','2010-12-07 13:31:52',1),(2,'owner@shop08.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'molly','molly',NULL,1,'2010-12-07 20:13:19','2010-12-07 20:13:19',1),(3,'owner@shop09.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'barry mortimer','barry',NULL,1,'2010-12-11 08:24:45','2010-12-11 08:24:45',1),(4,'owner@shop10.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'barry mortimer','barry',NULL,1,'2010-12-11 08:25:45','2010-12-11 08:25:45',1),(5,'owner@shop11.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'barry mortimer','barry',NULL,1,'2010-12-11 08:27:13','2010-12-11 08:27:13',1),(6,'owner@shop12.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'barry mortimer','barry',NULL,1,'2010-12-11 08:32:25','2010-12-11 08:32:25',1),(7,'owner@shop13.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'barry mortimer','barry',NULL,1,'2010-12-11 08:34:46','2010-12-11 08:34:46',1),(8,'owner@shop14.com','78e8f77082028fa96a619aa568aa3ca88a72ec8e',3,'barry mortimer','barry',NULL,1,'2010-12-11 09:03:32','2010-12-11 09:03:32',1),(9,'rv4zs0tn@ombi60.com','aeb57bf8f386172cccbaf637f4500d05fdc8e255',5,'casual','casual',NULL,1,'2010-12-11 05:15:01','2010-12-11 05:15:01',1);

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
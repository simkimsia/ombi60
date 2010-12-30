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

insert  into `paypal_payment_modules`(`id`,`shop_payment_module_id`,`name`,`account_email`) values (1,3,'Paypal ','owner@shop001.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

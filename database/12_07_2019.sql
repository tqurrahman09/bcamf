/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.10-MariaDB : Database - memo_payment
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `_authority` */

DROP TABLE IF EXISTS `_authority`;

CREATE TABLE `_authority` (
  `group_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `insert` tinyint(1) NOT NULL DEFAULT '0',
  `update` tinyint(1) NOT NULL DEFAULT '0',
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `view` tinyint(1) NOT NULL DEFAULT '1',
  `detail` tinyint(1) NOT NULL DEFAULT '0',
  `print` tinyint(1) NOT NULL DEFAULT '0',
  KEY `modul_id` (`module_id`),
  KEY `groups` (`group_id`),
  CONSTRAINT `_authority_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `_authority_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_authority` */

insert  into `_authority`(`group_id`,`module_id`,`insert`,`update`,`delete`,`view`,`detail`,`print`) values 
(7,1,1,1,0,1,1,0),
(7,11,1,1,0,1,0,0),
(7,14,1,1,0,1,0,0),
(7,17,1,1,0,1,0,0),
(7,20,0,0,0,1,0,0),
(7,21,0,0,0,1,0,0),
(8,1,1,1,1,1,1,0),
(8,11,1,1,1,1,0,0),
(8,14,1,1,1,1,0,0),
(8,17,1,1,1,1,0,0),
(8,20,0,0,0,1,0,0),
(8,21,0,0,0,1,0,0);

/*Table structure for table `_functional` */

DROP TABLE IF EXISTS `_functional`;

CREATE TABLE `_functional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `functional` varchar(30) NOT NULL,
  `note` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `_functional` */

insert  into `_functional`(`id`,`functional`,`note`) values 
(6,'insert',NULL),
(7,'update',NULL),
(8,'delete',NULL),
(9,'view',NULL),
(10,'set_flock',NULL),
(11,'export_excel',NULL),
(12,'print',NULL),
(13,'set_status',NULL),
(14,'detail',NULL),
(15,'generate',NULL);

/*Table structure for table `_group` */

DROP TABLE IF EXISTS `_group`;

CREATE TABLE `_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`group_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `_group` */

insert  into `_group`(`id`,`group_name`) values 
(7,'Admin Farm'),
(1,'administrator'),
(8,'Manager Farm');

/*Table structure for table `_log_delete` */

DROP TABLE IF EXISTS `_log_delete`;

CREATE TABLE `_log_delete` (
  `module_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `data` longtext,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(200) DEFAULT NULL,
  KEY `module_id` (`module_id`),
  CONSTRAINT `_log_delete_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `_module` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_log_delete` */

insert  into `_log_delete`(`module_id`,`user_id`,`data`,`log_date`,`note`) values 
(1,9,'{\"id\":\"19\",\"flock_id\":\"123\",\"farm_id\":\"1\",\"house_id\":\"2\",\"strain_id\":\"1\",\"vendor_id\":\"3\",\"company_id\":\"1\",\"trans_date\":\"2018-10-12\",\"trans_time\":\"15:20:00\",\"forder\":\"1\",\"fship\":\"1\",\"fdoa\":\"1\",\"fculling\":\"1\",\"morder\":\"1\",\"mship\":\"1\",\"mdoa\":\"1\",\"mculling\":\"1\",\"status\":\"1\",\"insert_date\":\"2018-10-12 15:23:08\",\"modify_date\":\"2018-10-12 00:00:00\",\"insert_by\":\"9\",\"modify_by\":\"9\"}','2018-10-12 16:24:39','Data dengan ID: 19'),
(11,9,'{\"id\":\"1\",\"farm_id\":\"1\",\"house_id\":\"2\",\"flock_id\":\"FLK-EX-002\",\"production_type_id\":\"1\",\"item_id\":\"1\",\"vendor_id\":\"2\",\"depletion_id\":\"1\",\"company_id\":\"1\",\"remark\":\"Ex remark\",\"trans_date\":\"2018-09-21\",\"fweight\":\"0\",\"fdead\":\"0\",\"fcullet\":\"0\",\"fdpopulate\":\"0\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"0\",\"mcullet\":\"0\",\"mdpopulate\":\"0\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"0\",\"male\":\"0\",\"insert_date\":\"2018-09-21 09:11:04\",\"modify_date\":\"2018-10-15 00:00:00\",\"insert_by\":\"13\",\"modify_by\":\"9\"}','2018-10-15 10:19:49','Data dengan ID: 1'),
(1,9,'{\"id\":\"18\",\"flock_id\":\"FMJK-121018-001\",\"farm_id\":\"1\",\"house_id\":\"1\",\"strain_id\":\"1\",\"vendor_id\":\"2\",\"company_id\":\"1\",\"trans_date\":\"2018-10-12\",\"trans_time\":\"10:30:00\",\"forder\":\"10\",\"fship\":\"10\",\"fdoa\":\"0\",\"fculling\":\"10\",\"morder\":\"10\",\"mship\":\"10\",\"mdoa\":\"1\",\"mculling\":\"10\",\"status\":\"1\",\"insert_date\":\"2018-10-12 10:37:35\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-10-17 10:09:35','Data dengan ID: 18'),
(2,9,'{\"id\":\"8\",\"company_id\":\"COM-003\",\"description\":\"Prima Fajar\",\"insert_date\":\"2018-10-17 16:19:36\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-10-17 16:19:42','Data dengan ID: 8'),
(1,9,'{\"id\":\"20\",\"flock_id\":\"123\",\"farm_id\":\"1\",\"house_id\":\"1\",\"strain_id\":\"1\",\"vendor_id\":\"2\",\"company_id\":\"1\",\"trans_date\":\"2018-10-22\",\"trans_time\":\"00:00:00\",\"forder\":\"1\",\"fship\":\"1\",\"fdoa\":\"1\",\"fculling\":\"1\",\"morder\":\"1\",\"mship\":\"1\",\"mdoa\":\"1\",\"mculling\":\"1\",\"status\":\"1\",\"insert_date\":\"2018-10-22 09:49:27\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-10-22 09:50:14','Data dengan ID: 20'),
(3,9,'{\"id\":\"28\",\"farm_id\":\"Z\",\"company_id\":\"1\",\"description\":\"Z\",\"insert_date\":\"2018-10-22 11:43:53\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-10-22 11:44:00','Data dengan ID: 28'),
(3,9,'{\"id\":\"34\",\"farm_id\":\"Y\",\"company_id\":\"1\",\"description\":\"Y\",\"insert_date\":\"2018-10-22 13:24:42\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-10-22 13:25:11','Data dengan ID: 34'),
(3,9,'{\"id\":\"32\",\"farm_id\":\"Z\",\"company_id\":\"1\",\"description\":\"Z\",\"insert_date\":\"2018-10-22 13:13:08\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-10-22 13:25:17','Data dengan ID: 32'),
(3,9,'{\"id\":\"26\",\"farm_id\":\"X\",\"company_id\":\"1\",\"description\":\"X\",\"insert_date\":\"2018-10-22 11:31:23\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-10-22 13:25:23','Data dengan ID: 26'),
(1,9,'{\"id\":\"21\",\"flock_id\":\"123\",\"farm_id\":\"1\",\"house_id\":\"1\",\"strain_id\":\"1\",\"vendor_id\":\"2\",\"company_id\":\"1\",\"trans_date\":\"2018-10-22\",\"trans_time\":\"09:50:00\",\"forder\":\"1\",\"fship\":\"1\",\"fdoa\":\"1\",\"fculling\":\"1\",\"morder\":\"1\",\"mship\":\"1\",\"mdoa\":\"1\",\"mculling\":\"1\",\"status\":\"0\",\"insert_date\":\"2018-10-22 09:50:37\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-10-22 13:49:21','Data dengan ID: 21'),
(1,9,'{\"id\":\"17\",\"flock_id\":\"FLK-EX-003\",\"farm_id\":\"1\",\"house_id\":\"1\",\"strain_id\":\"2\",\"vendor_id\":\"3\",\"company_id\":\"1\",\"trans_date\":\"2018-09-25\",\"trans_time\":\"02:10:00\",\"forder\":\"88\",\"fship\":\"88\",\"fdoa\":\"76\",\"fculling\":\"88\",\"morder\":\"88\",\"mship\":\"88\",\"mdoa\":\"88\",\"mculling\":\"88\",\"status\":\"1\",\"insert_date\":\"2018-09-24 14:11:53\",\"modify_date\":\"2018-10-17 00:00:00\",\"insert_by\":\"9\",\"modify_by\":\"9\"}','2018-10-22 13:49:28','Data dengan ID: 17'),
(17,13,'{\"id\":\"00002\",\"hatc_no\":\"P00002\",\"egg_id\":\"1\",\"hatchery_id\":\"1\",\"farm_id\":\"1\",\"flock_id\":\"FMJK-171018-001\",\"house_id\":\"1\",\"strain_id\":\"1\",\"company_id\":\"1\",\"date_set\":\"2018-10-25\",\"fecn_date\":\"2018-10-25\",\"tecn_date\":\"2018-10-27\",\"bal\":\"123\",\"trsf\":\"123\",\"qty\":\"0\",\"total_set\":\"1\",\"dirty\":\"1\",\"cracked\":\"1\",\"break\":\"1\",\"che\":\"1\",\"adjust\":\"1\",\"export\":\"123\",\"remark\":\"\",\"insert_date\":\"2018-10-25 15:00:57\",\"modify_date\":null,\"insert_by\":\"0\",\"modify_by\":null}','2018-10-26 13:57:27','Data dengan ID: 00002'),
(17,13,'{\"id\":\"00001\",\"hatc_no\":\"P00001\",\"egg_id\":\"1\",\"hatchery_id\":\"1\",\"farm_id\":\"1\",\"flock_id\":\"FMJK-171018-001\",\"house_id\":\"1\",\"strain_id\":\"1\",\"company_id\":\"1\",\"date_set\":\"2018-10-31\",\"fecn_date\":\"2018-10-31\",\"tecn_date\":\"2018-11-03\",\"bal_cf\":\"123\",\"trsf\":\"123\",\"qty\":\"123\",\"total_set\":\"1\",\"dirty\":\"1\",\"cracked\":\"1\",\"break\":\"1\",\"che\":\"1\",\"adjust\":\"1\",\"export\":\"123\",\"remark\":\"1\",\"culled\":\"1\",\"bal_bf\":\"0\",\"total\":\"0\",\"insert_date\":\"2018-10-31 16:35:33\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-05 10:08:11','Data dengan ID: 00001'),
(17,13,'{\"id\":\"00002\",\"hatc_no\":\"P00002\",\"egg_id\":\"1\",\"hatchery_id\":\"1\",\"farm_id\":\"1\",\"flock_id\":\"FMJK-171018-001\",\"house_id\":\"1\",\"strain_id\":\"1\",\"company_id\":\"1\",\"date_set\":\"2018-11-01\",\"fecn_date\":\"2018-10-28\",\"tecn_date\":\"2018-10-31\",\"bal_cf\":\"193\",\"trsf\":\"0\",\"qty\":\"80\",\"total_set\":\"2\",\"dirty\":\"2\",\"cracked\":\"2\",\"break\":\"2\",\"che\":\"2\",\"adjust\":\"2\",\"export\":\"0\",\"remark\":\"2\",\"culled\":\"2\",\"bal_bf\":\"0\",\"total\":\"0\",\"insert_date\":\"2018-11-01 14:08:40\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-05 10:08:16','Data dengan ID: 00002'),
(4,13,'{\"id\":\"6\",\"house_id\":\"\",\"farm_id\":null,\"company_id\":\"1\",\"description\":\"\",\"active\":\"0\",\"insert_date\":\"2018-11-05 14:50:44\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-05 14:50:50','Data dengan ID: 6'),
(13,9,'{\"id\":\"1\",\"egg_id\":\"EGG-001\",\"company_id\":\"1\",\"farm_id\":\"1\",\"description\":\"Egg 1\",\"insert_date\":\"2018-10-04 09:49:45\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"0\",\"modify_by\":null}','2018-11-06 09:17:40','Data dengan ID: 1'),
(13,9,'{\"id\":\"2\",\"egg_id\":\"EGG-002\",\"company_id\":\"1\",\"farm_id\":\"1\",\"description\":\"Egg 2\",\"insert_date\":\"2018-10-15 15:22:56\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"9\",\"modify_by\":null}','2018-11-06 09:17:52','Data dengan ID: 2'),
(13,9,'{\"id\":\"1\",\"egg_id\":\"EGG-001\",\"company_id\":\"1\",\"farm_id\":\"1\",\"description\":\"Egg 1\",\"insert_date\":\"2018-10-04 09:49:45\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"0\",\"modify_by\":null}','2018-11-06 09:18:02','Data dengan ID: 1'),
(13,9,'{\"id\":\"1\",\"egg_id\":\"EGG-001\",\"company_id\":\"1\",\"farm_id\":\"1\",\"description\":\"Egg 1\",\"insert_date\":\"2018-10-04 09:49:45\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"0\",\"modify_by\":null}','2018-11-06 09:18:07','Data dengan ID: 1'),
(12,9,'{\"id\":\"1\",\"hatchery_id\":\"HAT-001\",\"farm_id\":\"1\",\"company_id\":\"1\",\"description\":\"Hatchery 1\",\"insert_date\":\"2018-10-04 09:49:11\",\"modify_date\":null,\"insert_by\":null,\"modify_by\":null}','2018-11-06 09:18:15','Data dengan ID: 1'),
(17,9,'{\"id\":\"00004\",\"hatc_no\":\"P00004\",\"egg_id\":\"1\",\"hatchery_id\":\"1\",\"farm_id\":\"1\",\"flock_id\":\"FMJK-171018-001\",\"house_id\":\"1\",\"strain_id\":\"1\",\"company_id\":\"1\",\"date_set\":\"2018-11-05\",\"fecn_date\":\"2018-11-01\",\"tecn_date\":\"2018-11-04\",\"bal_cf\":\"145\",\"trsf\":\"0\",\"qty\":\"80\",\"total_set\":\"2\",\"dirty\":\"2\",\"cracked\":\"2\",\"break\":\"2\",\"che\":\"2\",\"adjust\":\"2\",\"export\":\"0\",\"remark\":\"Ex remark\",\"culled\":\"2\",\"bal_bf\":\"75\",\"total\":\"155\",\"insert_date\":\"2018-11-05 10:45:58\",\"modify_date\":\"2018-11-05 15:21:00\",\"insert_by\":\"13\",\"modify_by\":\"13\"}','2018-11-06 09:18:38','Data dengan ID: 00004'),
(17,9,'{\"id\":\"00003\",\"hatc_no\":\"P00001\",\"egg_id\":\"2\",\"hatchery_id\":\"1\",\"farm_id\":\"1\",\"flock_id\":\"FMJK-171018-001\",\"house_id\":\"1\",\"strain_id\":\"1\",\"company_id\":\"1\",\"date_set\":\"2018-11-05\",\"fecn_date\":\"2018-11-01\",\"tecn_date\":\"2018-11-04\",\"bal_cf\":\"75\",\"trsf\":\"0\",\"qty\":\"80\",\"total_set\":\"1\",\"dirty\":\"1\",\"cracked\":\"1\",\"break\":\"1\",\"che\":\"1\",\"adjust\":\"1\",\"export\":\"0\",\"remark\":\"Ex remark\",\"culled\":\"1\",\"bal_bf\":\"0\",\"total\":\"80\",\"insert_date\":\"2018-11-05 10:37:00\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-06 09:18:45','Data dengan ID: 00003'),
(11,9,'{\"id\":\"1\",\"farm_id\":\"1\",\"house_id\":\"1\",\"flock_id\":\"FMJK-171018-001\",\"production_type_id\":\"1\",\"item_id\":\"1\",\"vendor_id\":\"3\",\"depletion_id\":\"1\",\"company_id\":\"1\",\"remark\":\"test 1\",\"trans_date\":\"2018-10-17\",\"fweight\":\"2\",\"fdead\":\"1\",\"fcullet\":\"2\",\"fdpopulate\":\"1\",\"fsexing_error\":\"2\",\"mweight\":\"2\",\"mdead\":\"1\",\"mcullet\":\"2\",\"mdpopulate\":\"1\",\"msexing_error\":\"2\",\"weight\":\"1\",\"std_weight\":\"1\",\"hatcing\":\"1\",\"culled\":\"1\",\"fconsumption\":\"1\",\"mconsumption\":\"1\",\"female\":\"1\",\"male\":\"1\",\"damage\":\"1\",\"jumbo\":\"1\",\"crack\":\"1\",\"thin\":\"1\",\"small\":\"1\",\"insert_date\":\"2018-10-17 10:27:03\",\"modify_date\":\"2018-10-26 00:00:00\",\"insert_by\":\"9\",\"modify_by\":\"13\"}','2018-11-06 09:19:53','Data dengan ID: 1'),
(11,9,'{\"id\":\"2\",\"farm_id\":\"1\",\"house_id\":\"1\",\"flock_id\":\"FMJK-171018-001\",\"production_type_id\":\"1\",\"item_id\":\"0\",\"vendor_id\":\"0\",\"depletion_id\":\"0\",\"company_id\":\"1\",\"remark\":\"x\",\"trans_date\":\"2018-10-26\",\"fweight\":\"0\",\"fdead\":\"0\",\"fcullet\":\"0\",\"fdpopulate\":\"0\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"0\",\"mcullet\":\"0\",\"mdpopulate\":\"0\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"0\",\"male\":\"0\",\"damage\":\"1\",\"jumbo\":\"1\",\"crack\":\"1\",\"thin\":\"1\",\"small\":\"1\",\"insert_date\":\"2018-10-26 16:44:38\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"13\",\"modify_by\":null}','2018-11-06 09:19:59','Data dengan ID: 2'),
(1,9,'{\"id\":\"19\",\"flock_id\":\"FMJK-171018-001\",\"farm_id\":\"1\",\"house_id\":\"1\",\"strain_id\":\"1\",\"vendor_id\":\"3\",\"company_id\":\"1\",\"trans_date\":\"2018-10-17\",\"trans_time\":\"10:00:00\",\"forder\":\"10\",\"fship\":\"10\",\"fdoa\":\"0\",\"fculling\":\"10\",\"morder\":\"15\",\"mship\":\"15\",\"mdoa\":\"10\",\"mculling\":\"10\",\"status\":\"1\",\"insert_date\":\"2018-10-17 10:11:04\",\"modify_date\":\"2018-10-25 00:00:00\",\"insert_by\":\"9\",\"modify_by\":\"13\"}','2018-11-06 09:20:08','Data dengan ID: 19'),
(1,9,'{\"id\":\"21\",\"flock_id\":\"4321\",\"farm_id\":\"1\",\"house_id\":\"3\",\"strain_id\":\"1\",\"vendor_id\":\"2\",\"company_id\":\"1\",\"trans_date\":\"2018-11-05\",\"trans_time\":\"09:00:00\",\"forder\":\"12\",\"fship\":\"12\",\"fdoa\":\"6\",\"fculling\":\"12\",\"morder\":\"12\",\"mship\":\"12\",\"mdoa\":\"8\",\"mculling\":\"12\",\"status\":\"1\",\"insert_date\":\"2018-11-05 09:01:46\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-06 09:20:14','Data dengan ID: 21'),
(1,9,'{\"id\":\"15\",\"flock_id\":\"FLK-EX-001\",\"farm_id\":\"1\",\"house_id\":\"1\",\"strain_id\":\"2\",\"vendor_id\":\"2\",\"company_id\":\"1\",\"trans_date\":\"2018-09-20\",\"trans_time\":\"03:35:00\",\"forder\":\"90\",\"fship\":\"90\",\"fdoa\":\"80\",\"fculling\":\"90\",\"morder\":\"90\",\"mship\":\"90\",\"mdoa\":\"90\",\"mculling\":\"90\",\"status\":\"0\",\"insert_date\":\"2018-09-20 15:41:42\",\"modify_date\":\"2018-10-25 00:00:00\",\"insert_by\":\"9\",\"modify_by\":\"13\"}','2018-11-06 09:20:19','Data dengan ID: 15'),
(1,9,'{\"id\":\"16\",\"flock_id\":\"FLK-EX-002\",\"farm_id\":\"1\",\"house_id\":\"2\",\"strain_id\":\"1\",\"vendor_id\":\"2\",\"company_id\":\"1\",\"trans_date\":\"2018-09-25\",\"trans_time\":\"02:10:00\",\"forder\":\"900\",\"fship\":\"900\",\"fdoa\":\"899\",\"fculling\":\"70\",\"morder\":\"900\",\"mship\":\"900\",\"mdoa\":\"70\",\"mculling\":\"70\",\"status\":\"0\",\"insert_date\":\"2018-09-21 14:16:37\",\"modify_date\":\"2018-10-25 00:00:00\",\"insert_by\":\"13\",\"modify_by\":\"13\"}','2018-11-06 09:20:24','Data dengan ID: 16'),
(3,9,'{\"id\":\"1\",\"farm_id\":\"FARM-001\",\"company_id\":\"1\",\"description\":\"Farm Majalengka 1\",\"insert_date\":\"2018-08-07 13:46:40\",\"modify_date\":\"2018-10-12 00:00:00\",\"insert_by\":\"0\",\"modify_by\":\"9\"}','2018-11-06 09:20:48','Data dengan ID: 1'),
(13,9,'{\"id\":\"1\",\"egg_id\":\"EGG-001\",\"company_id\":\"1\",\"farm_id\":\"1\",\"description\":\"Egg 1\",\"insert_date\":\"2018-10-04 09:49:45\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"0\",\"modify_by\":null}','2018-11-06 09:20:58','Data dengan ID: 1'),
(13,9,'{\"id\":\"2\",\"egg_id\":\"EGG-002\",\"company_id\":\"1\",\"farm_id\":\"1\",\"description\":\"Egg 2\",\"insert_date\":\"2018-10-15 15:22:56\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"9\",\"modify_by\":null}','2018-11-06 09:21:02','Data dengan ID: 2'),
(12,9,'{\"id\":\"1\",\"hatchery_id\":\"HAT-001\",\"farm_id\":\"1\",\"company_id\":\"1\",\"description\":\"Hatchery 1\",\"insert_date\":\"2018-10-04 09:49:11\",\"modify_date\":null,\"insert_by\":null,\"modify_by\":null}','2018-11-06 09:21:11','Data dengan ID: 1'),
(10,9,'{\"id\":\"1\",\"production_type_id\":\"PROD-001\",\"description\":\"Production Type 1\",\"farm_id\":\"1\",\"company_id\":\"1\",\"insert_date\":\"2018-09-20 13:45:07\",\"modify_date\":null,\"insert_by\":null,\"modify_by\":null}','2018-11-06 09:21:20','Data dengan ID: 1'),
(9,9,'{\"id\":\"1\",\"farm_id\":\"1\",\"company_id\":\"1\",\"depletion_id\":\"DEP-001\",\"type\":\"Type 1\",\"description\":\"Depletion 1\",\"insert_date\":\"2018-09-20 13:45:38\",\"modify_date\":null,\"insert_by\":null,\"modify_by\":null}','2018-11-06 09:21:34','Data dengan ID: 1'),
(8,9,'{\"id\":\"1\",\"company_id\":\"1\",\"farm_id\":\"1\",\"item_id\":\"IT-001\",\"description\":\"Item 1\",\"insert_date\":\"2018-09-20 13:46:02\",\"modify_date\":null,\"insert_by\":null,\"modify_by\":null}','2018-11-06 09:21:40','Data dengan ID: 1'),
(6,9,'{\"id\":\"2\",\"vendor_id\":\"VEN-001\",\"farm_id\":\"1\",\"company_id\":\"1\",\"description\":\"Vendor 1\",\"insert_date\":\"2018-08-29 16:51:05\",\"modify_date\":null,\"insert_by\":\"0\",\"modify_by\":null}','2018-11-06 09:21:47','Data dengan ID: 2'),
(6,9,'{\"id\":\"3\",\"vendor_id\":\"V002\",\"farm_id\":\"1\",\"company_id\":\"1\",\"description\":\"PT Telur\",\"insert_date\":\"2018-09-18 09:49:40\",\"modify_date\":null,\"insert_by\":\"0\",\"modify_by\":null}','2018-11-06 09:21:51','Data dengan ID: 3'),
(5,9,'{\"id\":\"1\",\"strain_id\":\"STR-001\",\"company_id\":\"1\",\"description\":\"Strain 1\",\"type\":\"Type Strain 1\",\"insert_date\":\"2018-09-04 11:16:47\",\"modify_date\":null,\"insert_by\":\"0\",\"modify_by\":null}','2018-11-06 09:22:01','Data dengan ID: 1'),
(5,9,'{\"id\":\"2\",\"strain_id\":\"STR002\",\"company_id\":\"1\",\"description\":\"Strain02\",\"type\":\"STR2\",\"insert_date\":\"2018-09-18 09:47:46\",\"modify_date\":null,\"insert_by\":\"0\",\"modify_by\":null}','2018-11-06 09:22:06','Data dengan ID: 2'),
(4,9,'{\"id\":\"7\",\"house_id\":\"asas\",\"farm_id\":\"1\",\"company_id\":\"1\",\"description\":\"asas\",\"active\":\"1\",\"insert_date\":\"2018-11-05 14:51:53\",\"modify_date\":\"2018-11-05 14:52:46\",\"insert_by\":\"13\",\"modify_by\":\"13\"}','2018-11-06 09:22:14','Data dengan ID: 7'),
(4,9,'{\"id\":\"5\",\"house_id\":\"asasa\",\"farm_id\":\"1\",\"company_id\":\"1\",\"description\":\"asasa\",\"active\":\"1\",\"insert_date\":\"2018-11-05 14:50:42\",\"modify_date\":\"2018-11-05 14:51:42\",\"insert_by\":\"13\",\"modify_by\":\"13\"}','2018-11-06 09:22:18','Data dengan ID: 5'),
(4,9,'{\"id\":\"4\",\"house_id\":\"A\",\"farm_id\":\"14\",\"company_id\":\"1\",\"description\":\"A\",\"active\":\"0\",\"insert_date\":\"2018-11-02 16:19:32\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-06 09:22:22','Data dengan ID: 4'),
(4,9,'{\"id\":\"3\",\"house_id\":\"X\",\"farm_id\":\"1\",\"company_id\":\"1\",\"description\":\"X\",\"active\":\"0\",\"insert_date\":\"2018-10-22 13:37:11\",\"modify_date\":\"2018-10-22 13:41:51\",\"insert_by\":\"9\",\"modify_by\":\"9\"}','2018-11-06 09:22:28','Data dengan ID: 3'),
(4,9,'{\"id\":\"2\",\"house_id\":\"H-002\",\"farm_id\":\"1\",\"company_id\":\"1\",\"description\":\"House 2\",\"active\":\"1\",\"insert_date\":\"2018-09-18 09:41:38\",\"modify_date\":\"2018-10-17 16:28:28\",\"insert_by\":\"0\",\"modify_by\":\"9\"}','2018-11-06 09:22:31','Data dengan ID: 2'),
(4,9,'{\"id\":\"1\",\"house_id\":\"H-001\",\"farm_id\":\"1\",\"company_id\":\"1\",\"description\":\"House 1\",\"active\":\"1\",\"insert_date\":\"2018-08-07 13:50:09\",\"modify_date\":null,\"insert_by\":\"0\",\"modify_by\":null}','2018-11-06 09:22:34','Data dengan ID: 1'),
(3,9,'{\"id\":\"15\",\"farm_id\":\"as\",\"company_id\":\"1\",\"description\":\"as\",\"insert_date\":\"2018-11-02 16:05:30\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-06 09:22:40','Data dengan ID: 15'),
(3,9,'{\"id\":\"14\",\"farm_id\":\"FARM-004\",\"company_id\":\"1\",\"description\":\"Farm ex\",\"insert_date\":\"2018-10-15 14:17:07\",\"modify_date\":\"2018-10-17 16:27:25\",\"insert_by\":\"9\",\"modify_by\":\"9\"}','2018-11-06 09:22:45','Data dengan ID: 14'),
(3,9,'{\"id\":\"12\",\"farm_id\":\"Farm-003\",\"company_id\":\"1\",\"description\":\"Farm Majalengka 3\",\"insert_date\":\"2018-10-12 10:10:06\",\"modify_date\":\"2018-10-12 00:00:00\",\"insert_by\":\"9\",\"modify_by\":\"9\"}','2018-11-06 09:22:48','Data dengan ID: 12'),
(3,9,'{\"id\":\"11\",\"farm_id\":\"Farm-002\",\"company_id\":\"1\",\"description\":\"Farm Majalengka 2\",\"insert_date\":\"2018-09-18 09:40:01\",\"modify_date\":\"2018-10-15 14:18:26\",\"insert_by\":\"0\",\"modify_by\":\"9\"}','2018-11-06 09:22:57','Data dengan ID: 11'),
(3,9,'{\"id\":\"1\",\"farm_id\":\"FARM-001\",\"company_id\":\"1\",\"description\":\"Farm Majalengka 1\",\"insert_date\":\"2018-08-07 13:46:40\",\"modify_date\":\"2018-10-12 00:00:00\",\"insert_by\":\"0\",\"modify_by\":\"9\"}','2018-11-06 09:23:01','Data dengan ID: 1'),
(2,9,'{\"id\":\"9\",\"company_id\":\"COM-003\",\"description\":\"Prima Fajar\",\"insert_date\":\"2018-10-17 16:26:15\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-06 09:28:18','Data dengan ID: 9'),
(2,9,'{\"id\":\"5\",\"company_id\":\"COM-002\",\"description\":\"PT SCI\",\"insert_date\":\"2018-08-30 14:23:28\",\"modify_date\":null,\"insert_by\":\"0\",\"modify_by\":null}','2018-11-06 09:28:43','Data dengan ID: 5'),
(2,9,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 11:50:00','Data dengan ID: 1'),
(2,9,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 11:50:09','Data dengan ID: 1'),
(2,9,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 11:50:16','Data dengan ID: 1'),
(2,9,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 11:51:11','Data dengan ID: 1'),
(2,9,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 11:52:29','Data dengan ID: 1'),
(2,9,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 11:52:34','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 11:53:23','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 11:53:30','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 11:54:09','Data dengan ID: 1'),
(3,13,'{\"id\":\"16\",\"farm_id\":\"FARM-001\",\"company_id\":\"1\",\"description\":\"Farm Majalengka\",\"insert_date\":\"2018-11-06 10:45:08\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-06 11:55:31','Data dengan ID: 16'),
(2,9,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 13:43:26','Data dengan ID: 1'),
(3,13,'{\"id\":\"16\",\"farm_id\":\"FARM-001\",\"company_id\":\"1\",\"description\":\"Farm Majalengka\",\"insert_date\":\"2018-11-06 10:45:08\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-06 13:44:03','Data dengan ID: 16'),
(3,13,'{\"id\":\"16\",\"farm_id\":\"FARM-001\",\"company_id\":\"1\",\"description\":\"Farm Majalengka\",\"insert_date\":\"2018-11-06 10:45:08\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-06 13:44:11','Data dengan ID: 16'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 13:44:25','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 13:44:58','Data dengan ID: 1'),
(3,13,'{\"id\":\"16\",\"farm_id\":\"FARM-001\",\"company_id\":\"1\",\"description\":\"Farm Majalengka\",\"insert_date\":\"2018-11-06 10:45:08\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-06 13:46:18','Data dengan ID: 16'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 13:46:28','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 13:46:40','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 13:46:52','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 13:47:57','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 13:48:20','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 13:50:13','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 13:50:43','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 13:51:01','Data dengan ID: 1'),
(2,13,'{\"id\":\"1\",\"company_id\":\"COM-001\",\"description\":\"PT Bibit Indonesia\",\"insert_date\":\"2018-08-07 11:12:38\",\"modify_date\":null,\"insert_by\":\"1\",\"modify_by\":null}','2018-11-06 15:17:06','Data dengan ID: 1'),
(1,9,'{\"id\":\"30\",\"flock_id\":\"wewrewrewr\",\"farm_id\":\"17\",\"house_id\":\"9\",\"strain_id\":\"3\",\"vendor_id\":\"6\",\"company_id\":\"10\",\"trans_date\":\"2018-11-06\",\"trans_time\":\"04:49:00\",\"forder\":\"200\",\"fship\":\"200\",\"fdoa\":\"0\",\"fculling\":\"0\",\"morder\":\"200\",\"mship\":\"200\",\"mdoa\":\"0\",\"mculling\":\"0\",\"status\":\"1\",\"insert_date\":\"2018-11-06 16:50:58\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-06 16:51:10','Data dengan ID: 30'),
(10,13,'{\"id\":\"1\",\"production_type_id\":\"x\",\"description\":\"x\",\"farm_id\":\"17\",\"company_id\":\"10\",\"insert_date\":\"2018-11-07 15:47:09\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-07 15:51:23','Data dengan ID: 1'),
(10,13,'{\"id\":\"2\",\"production_type_id\":\"xx\",\"description\":\"x\",\"farm_id\":\"17\",\"company_id\":\"10\",\"insert_date\":\"2018-11-07 15:51:02\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-07 15:51:30','Data dengan ID: 2'),
(4,13,'{\"id\":\"15\",\"house_id\":\"xxx\",\"farm_id\":\"18\",\"company_id\":\"10\",\"description\":\"xxx\",\"active\":\"1\",\"insert_date\":\"2018-11-07 15:55:34\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-07 15:55:58','Data dengan ID: 15'),
(4,13,'{\"id\":\"14\",\"house_id\":\"xx\",\"farm_id\":\"17\",\"company_id\":\"10\",\"description\":\"aa\",\"active\":\"1\",\"insert_date\":\"2018-11-07 15:54:59\",\"modify_date\":\"2018-11-07 15:55:12\",\"insert_by\":\"13\",\"modify_by\":\"13\"}','2018-11-07 15:56:04','Data dengan ID: 14'),
(4,9,'{\"id\":\"17\",\"house_id\":\"xxxx\",\"farm_id\":\"17\",\"company_id\":\"10\",\"description\":\"xxxx\",\"active\":\"1\",\"insert_date\":\"2018-11-07 15:57:28\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-07 16:00:02','Data dengan ID: 17'),
(4,9,'{\"id\":\"16\",\"house_id\":\"xxx\",\"farm_id\":\"17\",\"company_id\":\"10\",\"description\":\"xxx\",\"active\":\"1\",\"insert_date\":\"2018-11-07 15:57:10\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-07 16:00:09','Data dengan ID: 16'),
(4,9,'{\"id\":\"21\",\"house_id\":\"xxxx\",\"farm_id\":\"17\",\"company_id\":\"10\",\"description\":\"xxxx\",\"active\":\"1\",\"insert_date\":\"2018-11-07 16:13:28\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-07 16:34:12','Data dengan ID: 21'),
(4,9,'{\"id\":\"22\",\"house_id\":\"a\",\"farm_id\":\"17\",\"company_id\":\"10\",\"description\":\"a\",\"active\":\"1\",\"insert_date\":\"2018-11-07 16:16:25\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-07 16:34:17','Data dengan ID: 22'),
(4,9,'{\"id\":\"23\",\"house_id\":\"aa\",\"farm_id\":\"17\",\"company_id\":\"10\",\"description\":\"aa\",\"active\":\"1\",\"insert_date\":\"2018-11-07 16:18:08\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-07 16:34:22','Data dengan ID: 23'),
(4,9,'{\"id\":\"24\",\"house_id\":\"aaa\",\"farm_id\":\"17\",\"company_id\":\"10\",\"description\":\"aaa\",\"active\":\"1\",\"insert_date\":\"2018-11-07 16:18:21\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-07 16:34:27','Data dengan ID: 24'),
(4,9,'{\"id\":\"20\",\"house_id\":\"xxx\",\"farm_id\":\"17\",\"company_id\":\"10\",\"description\":\"xxx\",\"active\":\"1\",\"insert_date\":\"2018-11-07 16:10:40\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-07 16:34:32','Data dengan ID: 20'),
(4,9,'{\"id\":\"19\",\"house_id\":\"xx\",\"farm_id\":\"17\",\"company_id\":\"10\",\"description\":\"xx\",\"active\":\"1\",\"insert_date\":\"2018-11-07 16:09:01\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-07 16:34:36','Data dengan ID: 19'),
(4,9,'{\"id\":\"18\",\"house_id\":\"x\",\"farm_id\":\"17\",\"company_id\":\"10\",\"description\":\"x\",\"active\":\"1\",\"insert_date\":\"2018-11-07 16:07:35\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-07 16:34:40','Data dengan ID: 18'),
(6,9,'{\"id\":\"7\",\"vendor_id\":\"x\",\"company_id\":\"10\",\"description\":\"x\",\"insert_date\":\"2018-11-08 08:55:13\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-08 08:55:19','Data dengan ID: 7'),
(6,9,'{\"id\":\"8\",\"vendor_id\":\"x\",\"company_id\":\"10\",\"description\":\"x\",\"insert_date\":\"2018-11-08 08:57:13\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-08 08:57:18','Data dengan ID: 8'),
(8,9,'{\"id\":\"6\",\"company_id\":\"10\",\"item_id\":\"xx\",\"category_id\":\"1\",\"description\":\"x\",\"uom\":\"1\",\"u_weight\":\"1\",\"unit\":\"xx\",\"feed_type\":\"Starter Mash\",\"insert_date\":\"2018-11-08 09:45:15\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-08 09:45:28','Data dengan ID: 6'),
(8,9,'{\"id\":\"4\",\"company_id\":\"10\",\"item_id\":\"x\",\"category_id\":null,\"description\":\"x\",\"uom\":\"1\",\"u_weight\":\"1\",\"unit\":\"1\",\"feed_type\":\"Grower Mash\",\"insert_date\":\"2018-11-08 09:38:57\",\"modify_date\":\"2018-11-08 09:40:35\",\"insert_by\":\"9\",\"modify_by\":\"9\"}','2018-11-08 09:45:33','Data dengan ID: 4'),
(12,9,'{\"id\":\"3\",\"hatchery_id\":\"x\",\"company_id\":\"10\",\"description\":\"x\",\"insert_date\":\"2018-11-08 10:16:53\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-08 10:17:00','Data dengan ID: 3'),
(19,9,'null','2018-11-08 10:57:17','Data dengan ID: 0'),
(19,9,'{\"id\":\"1\",\"source_id\":\"x\",\"company_id\":\"10\",\"description\":\"xx\",\"insert_date\":\"2018-11-08 10:58:22\",\"modify_date\":\"2018-11-08 10:58:40\",\"insert_by\":\"9\",\"modify_by\":\"9\"}','2018-11-08 10:59:01','Data dengan ID: 1'),
(11,13,'{\"id\":\"1\",\"farm_id\":\"17\",\"house_id\":\"8\",\"flock_id\":\"123\",\"production_type_id\":\"2\",\"item_id\":\"0\",\"vendor_id\":\"0\",\"depletion_id\":\"2\",\"company_id\":\"10\",\"remark\":\"x\",\"trans_date\":\"2018-11-12\",\"fweight\":\"0\",\"fdead\":\"0\",\"fcullet\":\"0\",\"fdpopulate\":\"0\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"0\",\"mcullet\":\"0\",\"mdpopulate\":\"0\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"0\",\"male\":\"0\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":null,\"dfemale\":null,\"insert_date\":\"2018-11-12 13:45:42\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"13\",\"modify_by\":null}','2018-11-12 13:47:59','Data dengan ID: 1'),
(11,13,'{\"id\":\"2\",\"farm_id\":\"17\",\"house_id\":\"8\",\"flock_id\":\"123\",\"production_type_id\":\"2\",\"item_id\":\"0\",\"vendor_id\":\"0\",\"depletion_id\":\"0\",\"company_id\":\"10\",\"remark\":\"x\",\"trans_date\":\"2018-11-12\",\"fweight\":\"0\",\"fdead\":\"0\",\"fcullet\":\"0\",\"fdpopulate\":\"0\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"0\",\"mcullet\":\"0\",\"mdpopulate\":\"0\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"0\",\"male\":\"0\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"0\",\"dfemale\":\"0\",\"insert_date\":\"2018-11-12 13:48:18\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"13\",\"modify_by\":null}','2018-11-12 14:22:33','Data dengan ID: 2'),
(11,13,'{\"id\":\"3\",\"farm_id\":\"17\",\"house_id\":\"8\",\"flock_id\":\"123\",\"production_type_id\":\"2\",\"item_id\":\"0\",\"vendor_id\":\"0\",\"depletion_id\":\"0\",\"company_id\":\"10\",\"remark\":\"x\",\"trans_date\":\"2018-11-12\",\"fweight\":\"0\",\"fdead\":\"0\",\"fcullet\":\"0\",\"fdpopulate\":\"0\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"0\",\"mcullet\":\"0\",\"mdpopulate\":\"0\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"90\",\"male\":\"90\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"0\",\"dfemale\":\"0\",\"insert_date\":\"2018-11-12 14:24:56\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"13\",\"modify_by\":null}','2018-11-12 14:44:14','Data dengan ID: 3'),
(11,13,'{\"id\":\"5\",\"farm_id\":\"17\",\"house_id\":\"8\",\"flock_id\":\"123\",\"production_type_id\":\"2\",\"item_id\":\"0\",\"vendor_id\":\"0\",\"depletion_id\":\"0\",\"company_id\":\"10\",\"remark\":\"x\",\"trans_date\":\"2018-11-13\",\"fweight\":\"0\",\"fdead\":\"12\",\"fcullet\":\"12\",\"fdpopulate\":\"12\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"12\",\"mcullet\":\"12\",\"mdpopulate\":\"12\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"54\",\"male\":\"54\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"0\",\"dfemale\":\"0\",\"insert_date\":\"2018-11-12 14:50:11\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"13\",\"modify_by\":null}','2018-11-12 14:55:12','Data dengan ID: 5'),
(11,13,'{\"id\":\"4\",\"farm_id\":\"17\",\"house_id\":\"8\",\"flock_id\":\"123\",\"production_type_id\":\"2\",\"item_id\":\"0\",\"vendor_id\":\"0\",\"depletion_id\":\"0\",\"company_id\":\"10\",\"remark\":\"x\",\"trans_date\":\"2018-11-12\",\"fweight\":\"0\",\"fdead\":\"0\",\"fcullet\":\"0\",\"fdpopulate\":\"0\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"0\",\"mcullet\":\"0\",\"mdpopulate\":\"0\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"90\",\"male\":\"90\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"0\",\"dfemale\":\"0\",\"insert_date\":\"2018-11-12 14:49:26\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"13\",\"modify_by\":null}','2018-11-12 16:45:57','Data dengan ID: 4'),
(11,13,'{\"id\":\"6\",\"farm_id\":\"17\",\"house_id\":\"8\",\"flock_id\":\"123\",\"production_type_id\":\"2\",\"item_id\":\"0\",\"vendor_id\":\"0\",\"depletion_id\":\"0\",\"company_id\":\"10\",\"remark\":\"ex\",\"trans_date\":\"2018-11-13\",\"fweight\":\"0\",\"fdead\":\"12\",\"fcullet\":\"12\",\"fdpopulate\":\"12\",\"fsexing_error\":\"12\",\"mweight\":\"0\",\"mdead\":\"12\",\"mcullet\":\"12\",\"mdpopulate\":\"12\",\"msexing_error\":\"12\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"54\",\"male\":\"54\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"0\",\"dfemale\":\"0\",\"insert_date\":\"2018-11-12 14:55:57\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"13\",\"modify_by\":null}','2018-11-12 16:46:03','Data dengan ID: 6'),
(10,13,'{\"id\":\"3\",\"production_type_id\":\"xx\",\"description\":\"xx\",\"company_id\":\"10\",\"insert_date\":\"2018-11-13 08:54:16\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 09:24:43','Data dengan ID: 3'),
(10,13,'{\"id\":\"2\",\"production_type_id\":\"x\",\"description\":\"x\",\"company_id\":\"10\",\"insert_date\":\"2018-11-08 10:05:20\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 09:24:48','Data dengan ID: 2'),
(10,13,'{\"id\":\"2\",\"production_type_id\":\"x\",\"description\":\"x\",\"company_id\":\"10\",\"insert_date\":\"2018-11-08 10:05:20\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 09:24:59','Data dengan ID: 2'),
(11,13,'{\"id\":\"7\",\"farm_id\":\"17\",\"house_id\":\"8\",\"flock_id\":\"123\",\"production_type_id\":\"2\",\"item_id\":\"0\",\"vendor_id\":\"0\",\"depletion_id\":\"0\",\"company_id\":\"10\",\"remark\":\"Ex\",\"trans_date\":\"2018-11-12\",\"fweight\":\"0\",\"fdead\":\"20\",\"fcullet\":\"10\",\"fdpopulate\":\"30\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"20\",\"mcullet\":\"10\",\"mdpopulate\":\"30\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"90\",\"male\":\"90\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"0\",\"dfemale\":\"0\",\"insert_date\":\"2018-11-12 16:47:11\",\"modify_date\":\"2018-11-12 00:00:00\",\"insert_by\":\"13\",\"modify_by\":\"13\"}','2018-11-13 09:33:18','Data dengan ID: 7'),
(1,13,'{\"id\":\"23\",\"flock_id\":\"123\",\"farm_id\":\"17\",\"house_id\":\"8\",\"strain_id\":\"3\",\"source_id\":\"1\",\"company_id\":\"10\",\"trans_date\":\"2018-11-06\",\"trans_time\":\"09:25:00\",\"forder\":\"1\",\"fship\":\"110\",\"fdoa\":\"10\",\"fculling\":\"10\",\"fstart\":\"90\",\"fexsho\":\"109\",\"morder\":\"1\",\"mship\":\"110\",\"mdoa\":\"10\",\"mculling\":\"10\",\"mstart\":\"90\",\"mexsho\":\"109\",\"status\":\"1\",\"insert_date\":\"2018-11-09 09:26:20\",\"modify_date\":\"2018-11-12 00:00:00\",\"insert_by\":\"9\",\"modify_by\":\"13\"}','2018-11-13 09:33:27','Data dengan ID: 23'),
(4,9,'{\"id\":\"11\",\"house_id\":\"4\",\"farm_id\":\"18\",\"company_id\":\"10\",\"description\":\"House 4\",\"active\":\"1\",\"insert_date\":\"2018-11-06 15:37:21\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 10:12:48','Data dengan ID: 11'),
(4,9,'{\"id\":\"12\",\"house_id\":\"5\",\"farm_id\":\"18\",\"company_id\":\"10\",\"description\":\"House 5\",\"active\":\"1\",\"insert_date\":\"2018-11-06 15:37:32\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 10:12:52','Data dengan ID: 12'),
(4,9,'{\"id\":\"13\",\"house_id\":\"6\",\"farm_id\":\"18\",\"company_id\":\"10\",\"description\":\"House 6\",\"active\":\"1\",\"insert_date\":\"2018-11-06 15:37:44\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 10:12:57','Data dengan ID: 13'),
(19,9,'{\"id\":\"1\",\"source_id\":\"SRC-001\",\"company_id\":\"10\",\"description\":\"Source 1\",\"insert_date\":\"2018-11-09 09:10:58\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 10:22:30','Data dengan ID: 1'),
(18,9,'{\"id\":\"1\",\"company_id\":\"10\",\"cat\":\"x\",\"category_name\":\"x\",\"insert_date\":\"2018-11-08 09:15:11\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 10:47:43','Data dengan ID: 1'),
(8,9,'{\"id\":\"2\",\"company_id\":\"10\",\"item_id\":\"F-BSC1\",\"category_id\":\"1\",\"description\":\"B. STARTER CRUMBLE (\",\"uom\":\"1\",\"u_weight\":\"1\",\"unit\":\"1\",\"feed_type\":\"Starter Mash\",\"insert_date\":\"2018-11-06 16:18:38\",\"modify_date\":\"2018-11-13 09:51:56\",\"insert_by\":\"9\",\"modify_by\":\"13\"}','2018-11-13 11:02:30','Data dengan ID: 2'),
(8,9,'{\"id\":\"3\",\"company_id\":\"10\",\"item_id\":\"F-BP3 \",\"category_id\":null,\"description\":\"BREEDER BROILER PROD\",\"uom\":null,\"u_weight\":null,\"unit\":null,\"feed_type\":null,\"insert_date\":\"2018-11-06 16:21:29\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 11:02:35','Data dengan ID: 3'),
(11,13,'{\"id\":\"9\",\"farm_id\":\"17\",\"house_id\":\"8\",\"flock_id\":\"123\",\"production_type_id\":\"2\",\"item_id\":\"0\",\"vendor_id\":\"0\",\"depletion_id\":\"0\",\"company_id\":\"10\",\"remark\":\"123\",\"trans_date\":\"2018-11-27\",\"fweight\":\"0\",\"fdead\":\"0\",\"fcullet\":\"0\",\"fdpopulate\":\"0\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"0\",\"mcullet\":\"0\",\"mdpopulate\":\"0\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"100\",\"male\":\"100\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"0\",\"dfemale\":\"0\",\"insert_date\":\"2018-11-13 10:44:47\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"13\",\"modify_by\":null}','2018-11-13 11:54:13','Data dengan ID: 9'),
(4,9,'{\"id\":\"51\",\"house_id\":\"ecn\",\"farm_id\":\"18\",\"company_id\":\"10\",\"description\":\"sadsd\",\"active\":\"1\",\"insert_date\":\"2018-11-13 15:37:42\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 15:37:53','Data dengan ID: 51'),
(10,9,'{\"id\":\"2\",\"production_type_id\":\"x\",\"description\":\"x\",\"company_id\":\"10\",\"insert_date\":\"2018-11-08 10:05:20\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 16:31:19','Data dengan ID: 2'),
(11,9,'{\"id\":\"8\",\"farm_id\":\"17\",\"house_id\":\"8\",\"flock_id\":\"123\",\"production_type_id\":\"2\",\"item_id\":\"0\",\"vendor_id\":\"0\",\"depletion_id\":\"0\",\"company_id\":\"10\",\"remark\":\"123\",\"trans_date\":\"2018-11-13\",\"fweight\":\"0\",\"fdead\":\"9\",\"fcullet\":\"1\",\"fdpopulate\":\"10\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"9\",\"mcullet\":\"1\",\"mdpopulate\":\"10\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"100\",\"male\":\"100\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"0\",\"dfemale\":\"0\",\"insert_date\":\"2018-11-13 10:44:13\",\"modify_date\":\"2018-11-13 00:00:00\",\"insert_by\":\"13\",\"modify_by\":\"13\"}','2018-11-13 16:31:37','Data dengan ID: 8'),
(10,9,'{\"id\":\"2\",\"production_type_id\":\"x\",\"description\":\"x\",\"company_id\":\"10\",\"insert_date\":\"2018-11-08 10:05:20\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-13 16:31:49','Data dengan ID: 2'),
(1,9,'{\"id\":\"24\",\"flock_id\":\"123\",\"farm_id\":\"17\",\"house_id\":\"8\",\"strain_id\":\"3\",\"source_id\":\"2\",\"company_id\":\"10\",\"trans_date\":\"2018-11-13\",\"trans_time\":\"10:40:00\",\"forder\":\"90\",\"fship\":\"122\",\"fdoa\":\"11\",\"fculling\":\"11\",\"fstart\":\"100\",\"fexsho\":\"32\",\"morder\":\"90\",\"mship\":\"122\",\"mdoa\":\"11\",\"mculling\":\"11\",\"mstart\":\"100\",\"mexsho\":\"32\",\"status\":\"1\",\"insert_date\":\"2018-11-13 10:43:13\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-13 17:05:16','Data dengan ID: 24'),
(11,9,'{\"id\":\"1\",\"farm_id\":\"17\",\"house_id\":\"9\",\"flock_id\":\"PBF1\\/2\\/13112018 \",\"production_type_id\":\"3\",\"item_id\":\"0\",\"vendor_id\":\"0\",\"depletion_id\":\"0\",\"company_id\":\"10\",\"remark\":\"Ex\",\"trans_date\":\"2018-11-14\",\"fweight\":\"0\",\"fdead\":\"9\",\"fcullet\":\"1\",\"fdpopulate\":\"0\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"9\",\"mcullet\":\"1\",\"mdpopulate\":\"0\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"936\",\"male\":\"5892\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"0\",\"dfemale\":\"0\",\"insert_date\":\"2018-11-14 10:08:23\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"9\",\"modify_by\":null}','2018-11-14 13:51:22','Data dengan ID: 1'),
(1,9,'{\"id\":\"25\",\"flock_id\":\"PBF1\\/2\\/13112018 \",\"farm_id\":\"17\",\"house_id\":\"9\",\"strain_id\":\"8\",\"source_id\":\"3\",\"company_id\":\"10\",\"trans_date\":\"2018-11-14\",\"trans_time\":\"05:07:00\",\"forder\":\"6240\",\"fship\":\"6240\",\"fdoa\":\"347\",\"fculling\":\"1\",\"fstart\":\"936\",\"fexsho\":\"0\",\"morder\":\"960\",\"mship\":\"960\",\"mdoa\":\"24\",\"mculling\":\"0\",\"mstart\":\"5892\",\"mexsho\":\"0\",\"male_percentage\":\"15.89\",\"status\":\"1\",\"insert_date\":\"2018-11-13 17:09:40\",\"modify_date\":\"2018-11-14 00:00:00\",\"insert_by\":\"9\",\"modify_by\":\"9\"}','2018-11-14 15:26:24','Data dengan ID: 25'),
(11,9,'{\"id\":\"2\",\"farm_id\":\"17\",\"house_id\":\"9\",\"flock_id\":\"PBF1\\/2\\/30012018 \",\"production_type_id\":\"3\",\"item_id\":\"4\",\"vendor_id\":\"4\",\"depletion_id\":\"0\",\"company_id\":\"10\",\"remark\":\"Test 1\",\"trans_date\":\"2018-01-30\",\"fweight\":\"0\",\"fdead\":\"0\",\"fcullet\":\"0\",\"fdpopulate\":\"0\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"0\",\"mcullet\":\"0\",\"mdpopulate\":\"0\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"112\",\"mconsumption\":\"20\",\"female\":\"5893\",\"male\":\"936\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"0\",\"dfemale\":\"0\",\"insert_date\":\"2018-11-14 15:50:07\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"9\",\"modify_by\":null}','2018-11-15 09:19:19','Data dengan ID: 2'),
(11,9,'{\"id\":\"3\",\"farm_id\":\"17\",\"house_id\":\"9\",\"flock_id\":\"PBF1\\/2\\/30012018 \",\"production_type_id\":\"3\",\"item_id\":\"4\",\"vendor_id\":\"4\",\"depletion_id\":\"0\",\"company_id\":\"10\",\"remark\":\"test\",\"trans_date\":\"2018-01-31\",\"fweight\":\"0\",\"fdead\":\"0\",\"fcullet\":\"0\",\"fdpopulate\":\"0\",\"fsexing_error\":\"0\",\"mweight\":\"0\",\"mdead\":\"0\",\"mcullet\":\"0\",\"mdpopulate\":\"0\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"125\",\"mconsumption\":\"22\",\"female\":\"5893\",\"male\":\"936\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"0\",\"dfemale\":\"0\",\"insert_date\":\"2018-11-14 16:00:39\",\"modify_date\":\"0000-00-00 00:00:00\",\"insert_by\":\"9\",\"modify_by\":null}','2018-11-15 09:19:23','Data dengan ID: 3'),
(1,9,'{\"id\":\"28\",\"flock_id\":\"PBF1\\/3\\/123456\",\"farm_id\":\"17\",\"house_id\":\"10\",\"strain_id\":\"7\",\"source_id\":\"2\",\"company_id\":\"10\",\"trans_date\":\"2017-09-15\",\"trans_time\":\"09:15:00\",\"forder\":\"100\",\"fship\":\"100\",\"fdoa\":\"0\",\"fculling\":\"0\",\"fstart\":\"100\",\"fexsho\":\"0\",\"morder\":\"100\",\"mship\":\"100\",\"mdoa\":\"0\",\"mculling\":\"0\",\"mstart\":\"100\",\"mexsho\":\"0\",\"male_percentage\":\"100\",\"status\":\"1\",\"insert_date\":\"2018-11-28 09:17:30\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-28 09:19:44','Data dengan ID: 28'),
(4,9,'{\"id\":\"54\",\"house_id\":\"X\",\"farm_id\":\"19\",\"company_id\":\"11\",\"description\":\"Example\",\"active\":\"1\",\"insert_date\":\"2018-11-28 09:53:33\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-28 09:53:49','Data dengan ID: 54'),
(4,9,'{\"id\":\"57\",\"house_id\":\"X\",\"farm_id\":\"19\",\"company_id\":\"11\",\"description\":\"Example\",\"active\":\"1\",\"insert_date\":\"2018-11-28 09:57:41\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-28 10:00:14','Data dengan ID: 57'),
(4,9,'{\"id\":\"56\",\"house_id\":\"XX\",\"farm_id\":\"19\",\"company_id\":\"11\",\"description\":\"Example\",\"active\":\"1\",\"insert_date\":\"2018-11-28 09:54:38\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-28 10:06:35','Data dengan ID: 56'),
(4,9,'{\"id\":\"58\",\"house_id\":\"XXX\",\"farm_id\":\"19\",\"company_id\":\"11\",\"description\":\"Example\",\"active\":\"1\",\"insert_date\":\"2018-11-28 09:58:11\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-11-28 10:06:40','Data dengan ID: 58'),
(11,9,'{\"id\":\"284\",\"farm_id\":\"18\",\"house_id\":\"31\",\"flock_id\":\"FLOCK21\",\"production_type_id\":\"3\",\"depletion_id\":\"2\",\"company_id\":\"10\",\"remark\":\"Test\",\"trans_date\":\"2018-11-26\",\"fweight\":\"10\",\"fdead\":\"2\",\"fcullet\":\"11\",\"fdpopulate\":\"0\",\"fsexing_error\":\"0\",\"mweight\":\"10\",\"mdead\":\"1\",\"mcullet\":\"1\",\"mdpopulate\":\"0\",\"msexing_error\":\"0\",\"weight\":\"0\",\"std_weight\":\"0\",\"hatcing\":\"0\",\"culled\":\"0\",\"fconsumption\":\"0\",\"mconsumption\":\"0\",\"female\":\"2000\",\"male\":\"1000\",\"damage\":\"0\",\"jumbo\":\"0\",\"crack\":\"0\",\"thin\":\"0\",\"small\":\"0\",\"dmale\":\"10\",\"dfemale\":\"10\",\"ubnormal\":null,\"dirty\":null,\"insert_date\":\"2018-11-26 10:41:23\",\"modify_date\":null,\"insert_by\":\"9\",\"modify_by\":null}','2018-11-29 09:34:45','Data dengan ID: 284'),
(17,13,'{\"id\":\"00023\",\"hatc_no\":\"123\",\"egg_id\":\"4\",\"hatchery_id\":\"4\",\"farm_id\":\"19\",\"flock_id\":\"SGF1\\/1\\/15092017\",\"house_id\":\"59\",\"strain_id\":\"10\",\"company_id\":\"11\",\"date_set\":\"2018-03-05\",\"fecn_date\":\"2018-03-01\",\"tecn_date\":\"2018-03-04\",\"bal_cf\":\"0\",\"trsf\":\"0\",\"qty\":\"370\",\"total_set\":\"308\",\"dirty\":\"0\",\"cracked\":\"6\",\"break\":\"0\",\"che\":\"0\",\"adjust\":\"0\",\"export\":\"0\",\"remark\":\"Ex\",\"culled\":\"2\",\"bal_bf\":\"0\",\"total\":\"458\",\"insert_date\":\"2018-12-04 15:27:24\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-12-06 09:51:32','Data dengan ID: 00023'),
(17,13,'{\"id\":\"00024\",\"hatc_no\":\"123\",\"egg_id\":\"4\",\"hatchery_id\":\"4\",\"farm_id\":\"19\",\"flock_id\":\"SGF1\\/1\\/15092017\",\"house_id\":\"59\",\"strain_id\":\"10\",\"company_id\":\"11\",\"date_set\":\"2018-03-05\",\"fecn_date\":\"2018-03-01\",\"tecn_date\":\"2018-03-04\",\"bal_cf\":\"0\",\"trsf\":\"0\",\"qty\":\"370\",\"total_set\":\"1\",\"dirty\":\"2\",\"cracked\":\"3\",\"break\":\"0\",\"che\":\"0\",\"adjust\":\"0\",\"export\":\"0\",\"remark\":\"Ex\",\"culled\":\"0\",\"bal_bf\":\"0\",\"total\":\"458\",\"insert_date\":\"2018-12-06 10:20:35\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-12-06 10:21:36','Data dengan ID: 00024'),
(7,13,'{\"id\":\"18\",\"employee_id\":\"admin.farm\",\"employee_name\":\"admin farm\",\"telp\":\"021\",\"email\":\"a@mail.com\",\"insert_date\":\"2018-12-11 13:51:05\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-12-14 16:13:19','Data dengan ID: 18'),
(7,13,'{\"id\":\"17\",\"employee_id\":\"emp-003\",\"employee_name\":\"Employee 3\",\"telp\":\"021\",\"email\":\"a@.com\",\"insert_date\":\"2018-11-14 13:46:28\",\"modify_date\":null,\"insert_by\":\"13\",\"modify_by\":null}','2018-12-14 16:13:24','Data dengan ID: 17'),
(7,13,'{\"id\":\"16\",\"employee_id\":\"EMP-002\",\"employee_name\":\"employee 2\",\"telp\":\"021\",\"email\":\"employee2@mail.com\",\"insert_date\":\"2018-09-12 16:09:11\",\"modify_date\":null,\"insert_by\":\"0\",\"modify_by\":null}','2018-12-14 16:13:28','Data dengan ID: 16'),
(17,13,'{\"id\":\"00001\",\"hatc_no\":\"SG0001\",\"egg_id\":\"1\",\"hatchery_id\":\"2\",\"farm_id\":\"17\",\"flock_id\":\"PBF1\\/1\\/18122018\",\"house_id\":\"8\",\"strain_id\":\"8\",\"company_id\":\"10\",\"date_set\":\"2018-12-19\",\"fecn_date\":\"2018-12-15\",\"tecn_date\":\"2018-12-17\",\"bal_cf\":\"0\",\"trsf\":\"0\",\"qty\":\"0\",\"total_set\":\"10\",\"dirty\":\"0\",\"cracked\":\"0\",\"break\":\"0\",\"che\":\"0\",\"adjust\":\"0\",\"export\":\"0\",\"remark\":\"-\",\"culled\":\"0\",\"bal_bf\":\"0\",\"total\":\"0\",\"insert_date\":\"2018-12-18 14:08:15\",\"modify_date\":null,\"insert_by\":\"15\",\"modify_by\":null}','2018-12-18 15:37:05','Data dengan ID: 00001'),
(1,13,'{\"id\":\"1\",\"flock_id\":\"PBF1\\/1\\/18122018\",\"farm_id\":\"17\",\"house_id\":\"8\",\"strain_id\":\"8\",\"source_id\":\"2\",\"company_id\":\"10\",\"trans_date\":\"2018-12-19\",\"trans_time\":\"01:40:00\",\"forder\":\"1400\",\"fship\":\"1350\",\"fdoa\":\"100\",\"fculling\":\"10\",\"fstart\":\"1240\",\"fexsho\":\"-100\",\"morder\":\"300\",\"mship\":\"200\",\"mdoa\":\"20\",\"mculling\":\"0\",\"mstart\":\"180\",\"mexsho\":\"-50\",\"male_percentage\":\"14.52\",\"status\":\"1\",\"insert_date\":\"2018-12-18 13:46:50\",\"modify_date\":\"2018-12-18 00:00:00\",\"insert_by\":\"15\",\"modify_by\":\"15\"}','2018-12-18 15:37:15','Data dengan ID: 1');

/*Table structure for table `_log_update` */

DROP TABLE IF EXISTS `_log_update`;

CREATE TABLE `_log_update` (
  `module_id` int(11) NOT NULL,
  `column_name` varchar(30) NOT NULL,
  `value` varchar(250) DEFAULT NULL,
  `last_value` varchar(250) DEFAULT NULL,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `note` varchar(200) DEFAULT NULL,
  KEY `module_id` (`module_id`),
  CONSTRAINT `_log_update_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_log_update` */

insert  into `_log_update`(`module_id`,`column_name`,`value`,`last_value`,`log_date`,`user_id`,`note`) values 
(4,'active','1','0','2018-10-17 16:28:28',9,'Data dengan ID: 2'),
(1,'farm_id','1','11','2018-10-17 16:40:09',9,'Data dengan ID: 17'),
(1,'house_id','1','2','2018-10-17 16:40:09',9,'Data dengan ID: 17'),
(1,'trans_time','02:10','14:10:00','2018-10-17 16:40:09',9,'Data dengan ID: 17'),
(1,'mdoa','88','78','2018-10-17 16:40:09',9,'Data dengan ID: 17'),
(1,'trans_time','10:00','10:00:00','2018-10-17 16:53:43',9,'Data dengan ID: 19'),
(1,'mdoa','4','1','2018-10-17 16:53:43',9,'Data dengan ID: 19'),
(1,'mculling','10','4','2018-10-17 16:53:43',9,'Data dengan ID: 19'),
(1,'trans_time','10:00','10:00:00','2018-10-17 16:57:58',17,'Data dengan ID: 19'),
(1,'mdoa','10','4','2018-10-17 16:57:58',17,'Data dengan ID: 19'),
(4,'active','0','1','2018-10-22 13:41:51',9,'Data dengan ID: 3'),
(1,'strain_id','2','1','2018-10-22 14:00:41',9,'Data dengan ID: 15'),
(1,'trans_time','03:35','15:35:00','2018-10-22 14:00:41',9,'Data dengan ID: 15'),
(1,'mdoa','90','80','2018-10-22 14:00:41',9,'Data dengan ID: 15'),
(1,'house_id','2','1','2018-10-22 14:01:14',9,'Data dengan ID: 15'),
(1,'trans_time','03:35','03:35:00','2018-10-22 14:01:14',9,'Data dengan ID: 15'),
(1,'trans_time','02:10','14:10:00','2018-10-22 14:01:59',9,'Data dengan ID: 16'),
(1,'mdoa','70','899','2018-10-22 14:01:59',9,'Data dengan ID: 16'),
(1,'trans_time','10:00','10:00:00','2018-10-22 14:02:46',9,'Data dengan ID: 19'),
(1,'house_id','1','2','2018-10-22 14:21:14',9,'Data dengan ID: 15'),
(1,'trans_time','03:35','03:35:00','2018-10-22 14:21:14',9,'Data dengan ID: 15'),
(1,'status','0','1','2018-10-22 15:51:22',9,'Data dengan ID: 15'),
(1,'status','1','0','2018-10-22 15:51:44',9,'Data dengan ID: 15'),
(11,'house_id','2','1','2018-10-23 10:56:05',13,'Data dengan ID: 1'),
(11,'flock_id','FLK-EX-002','FLK-EX-001','2018-10-23 10:56:05',13,'Data dengan ID: 1'),
(1,'status','0','1','2018-10-25 13:28:57',13,'Data dengan ID: 19'),
(1,'status','1','0','2018-10-25 13:29:06',13,'Data dengan ID: 19'),
(1,'trans_time','02:10','02:10:00','2018-10-25 13:31:53',13,'Data dengan ID: 16'),
(1,'status','0','1','2018-10-25 13:35:53',13,'Data dengan ID: 16'),
(1,'status','0','1','2018-10-25 13:35:59',13,'Data dengan ID: 15'),
(17,'fecn_date','1970-01-01','2018-10-26','2018-10-26 14:01:16',13,'Data dengan ID: 00006'),
(17,'tecn_date','1970-01-01','2018-10-30','2018-10-26 14:01:16',13,'Data dengan ID: 00006'),
(17,'remark','Ex remarks','Ex remark','2018-10-26 14:01:33',13,'Data dengan ID: 00006'),
(17,'fecn_date','2018-10-26','1970-01-01','2018-10-26 14:04:35',13,'Data dengan ID: 00006'),
(17,'tecn_date','2018-10-31','1970-01-01','2018-10-26 14:04:35',13,'Data dengan ID: 00006'),
(17,'fecn_date','1970-01-01','2018-10-25','2018-10-26 14:10:26',13,'Data dengan ID: 00004'),
(17,'tecn_date','1970-01-01','2018-10-27','2018-10-26 14:10:26',13,'Data dengan ID: 00004'),
(17,'remark','Ex remaks','','2018-10-26 14:10:26',13,'Data dengan ID: 00004'),
(17,'fecn_date','2018-10-25','1970-01-01','2018-10-26 14:12:08',13,'Data dengan ID: 00004'),
(17,'tecn_date','2018-10-31','1970-01-01','2018-10-26 14:12:08',13,'Data dengan ID: 00004'),
(17,'fecn_date','1970-01-01','2018-10-25','2018-10-26 14:12:37',13,'Data dengan ID: 00004'),
(17,'tecn_date','1970-01-01','2018-10-31','2018-10-26 14:12:37',13,'Data dengan ID: 00004'),
(17,'fecn_date','2018-10-26','1970-01-01','2018-10-26 14:17:33',13,'Data dengan ID: 00004'),
(17,'tecn_date','2018-10-27','1970-01-01','2018-10-26 14:17:33',13,'Data dengan ID: 00004'),
(17,'fecn_date','1970-01-01','2018-10-26','2018-10-26 14:17:43',13,'Data dengan ID: 00004'),
(17,'tecn_date','1970-01-01','2018-10-27','2018-10-26 14:17:43',13,'Data dengan ID: 00004'),
(17,'fecn_date','2018-01-10','1970-01-01','2018-10-26 14:42:39',13,'Data dengan ID: 00004'),
(17,'tecn_date','2018-01-11','1970-01-01','2018-10-26 14:42:39',13,'Data dengan ID: 00004'),
(17,'fecn_date','2018-10-01','2018-01-10','2018-10-26 14:43:14',13,'Data dengan ID: 00004'),
(17,'tecn_date','2018-11-01','2018-01-11','2018-10-26 14:43:14',13,'Data dengan ID: 00004'),
(11,'house_id','1','2','2018-10-26 16:27:26',13,'Data dengan ID: 1'),
(11,'flock_id','FMJK-171018-001','FLK-EX-002','2018-10-26 16:27:26',13,'Data dengan ID: 1'),
(11,'fdead','1','0','2018-10-26 16:27:26',13,'Data dengan ID: 1'),
(11,'fdpopulate','1','0','2018-10-26 16:27:26',13,'Data dengan ID: 1'),
(11,'mdead','1','0','2018-10-26 16:27:26',13,'Data dengan ID: 1'),
(11,'mdpopulate','1','0','2018-10-26 16:27:26',13,'Data dengan ID: 1'),
(11,'vendor_id','3','2','2018-10-26 16:28:09',13,'Data dengan ID: 1'),
(11,'weight','1','0','2018-10-26 16:28:09',13,'Data dengan ID: 1'),
(11,'std_weight','1','0','2018-10-26 16:28:09',13,'Data dengan ID: 1'),
(11,'hatcing','1','0','2018-10-26 16:28:09',13,'Data dengan ID: 1'),
(11,'culled','1','0','2018-10-26 16:28:09',13,'Data dengan ID: 1'),
(11,'female','1','0','2018-10-26 16:28:09',13,'Data dengan ID: 1'),
(11,'male','1','0','2018-10-26 16:28:09',13,'Data dengan ID: 1'),
(11,'damage','1',NULL,'2018-10-26 16:48:48',13,'Data dengan ID: 1'),
(11,'jumbo','1',NULL,'2018-10-26 16:48:48',13,'Data dengan ID: 1'),
(11,'crack','1',NULL,'2018-10-26 16:48:48',13,'Data dengan ID: 1'),
(11,'thin','1',NULL,'2018-10-26 16:48:48',13,'Data dengan ID: 1'),
(11,'small','1',NULL,'2018-10-26 16:48:48',13,'Data dengan ID: 1'),
(17,'fecn_date','2018-01-10','2018-10-01','2018-10-29 16:20:13',9,'Data dengan ID: 00004'),
(17,'tecn_date','2018-01-11','2018-11-01','2018-10-29 16:20:13',9,'Data dengan ID: 00004'),
(17,'culled','1',NULL,'2018-10-29 16:20:13',9,'Data dengan ID: 00004'),
(17,'fecn_date','2018-10-01','2018-01-10','2018-10-30 09:13:25',13,'Data dengan ID: 00004'),
(17,'tecn_date','2018-11-01','2018-01-11','2018-10-30 09:13:25',13,'Data dengan ID: 00004'),
(17,'fecn_date','1970-01-01','2018-10-01','2018-10-31 15:09:08',9,'Data dengan ID: 00004'),
(17,'tecn_date','1970-01-01','2018-11-01','2018-10-31 15:09:08',9,'Data dengan ID: 00004'),
(17,'fecn_date','1970-01-01','2018-11-01','2018-10-31 15:28:22',13,'Data dengan ID: 00007'),
(17,'tecn_date','1970-01-01','2018-11-03','2018-10-31 15:28:22',13,'Data dengan ID: 00007'),
(17,'fecn_date','2018-01-11','2018-11-01','2018-10-31 15:30:59',13,'Data dengan ID: 00007'),
(17,'tecn_date','2018-03-11','2018-11-03','2018-10-31 15:30:59',13,'Data dengan ID: 00007'),
(17,'fecn_date','2018-01-11','2018-11-01','2018-10-31 15:42:40',13,'Data dengan ID: 00007'),
(17,'tecn_date','1970-01-01','2018-11-03','2018-10-31 15:42:40',13,'Data dengan ID: 00007'),
(17,'tecn_date','1970-01-01','2018-02-11','2018-10-31 15:45:20',13,'Data dengan ID: 00008'),
(17,'fecn_date','2018-01-10','1970-01-01','2018-10-31 15:53:18',13,'Data dengan ID: 00008'),
(17,'tecn_date','2018-02-10','1970-01-01','2018-10-31 15:53:18',13,'Data dengan ID: 00008'),
(17,'fecn_date','2018-05-01','2018-01-10','2018-10-31 15:55:58',13,'Data dengan ID: 00008'),
(17,'tecn_date','1970-01-01','2018-02-10','2018-10-31 15:55:58',13,'Data dengan ID: 00008'),
(17,'fecn_date','2018-01-05','2018-05-01','2018-10-31 16:12:55',13,'Data dengan ID: 00008'),
(17,'tecn_date','2018-05-05','1970-01-01','2018-10-31 16:12:55',13,'Data dengan ID: 00008'),
(17,'fecn_date','2018-01-11','2018-01-05','2018-10-31 16:14:53',13,'Data dengan ID: 00008'),
(17,'tecn_date','2018-03-11','2018-05-05','2018-10-31 16:14:53',13,'Data dengan ID: 00008'),
(17,'fecn_date','2018-10-02','2018-01-11','2018-10-31 16:20:35',13,'Data dengan ID: 00008'),
(17,'tecn_date','2018-10-06','2018-03-11','2018-10-31 16:20:35',13,'Data dengan ID: 00008'),
(17,'fecn_date','2018-10-01','2018-10-02','2018-10-31 16:21:08',13,'Data dengan ID: 00008'),
(17,'tecn_date','2018-10-13','2018-10-06','2018-10-31 16:21:08',13,'Data dengan ID: 00008'),
(17,'fecn_date','2018-12-01','2018-11-01','2018-10-31 16:23:36',13,'Data dengan ID: 00009'),
(17,'tecn_date','2018-12-08','2018-11-10','2018-10-31 16:23:36',13,'Data dengan ID: 00009'),
(17,'tecn_date','2018-11-17','2018-11-03','2018-10-31 16:27:57',13,'Data dengan ID: 00010'),
(9,'description','I. BRONCHITIS','BRONCHITIS','2018-11-06 16:26:51',9,'Data dengan ID: 3'),
(1,'trans_time','04:42','04:42:00','2018-11-07 09:48:10',9,'Data dengan ID: 22'),
(8,'unit','1',NULL,'2018-11-08 09:40:35',9,'Data dengan ID: 4'),
(19,'description','xx','x','2018-11-08 10:58:40',9,'Data dengan ID: 1'),
(1,'status','0','1','2018-11-09 10:09:17',13,'Data dengan ID: 23'),
(1,'status','1','0','2018-11-09 10:12:14',9,'Data dengan ID: 23'),
(1,'status','0','1','2018-11-09 10:15:02',13,'Data dengan ID: 23'),
(1,'status','1','0','2018-11-09 10:17:41',9,'Data dengan ID: 23'),
(1,'trans_time','09:25','09:25:00','2018-11-09 10:26:25',9,'Data dengan ID: 23'),
(1,'forder','11','1','2018-11-09 10:26:25',9,'Data dengan ID: 23'),
(1,'fship','111','11','2018-11-09 10:26:25',9,'Data dengan ID: 23'),
(1,'fdoa','11','1','2018-11-09 10:26:25',9,'Data dengan ID: 23'),
(1,'morder','11','1','2018-11-09 10:26:25',9,'Data dengan ID: 23'),
(1,'mship','111','11','2018-11-09 10:26:25',9,'Data dengan ID: 23'),
(1,'mdoa','11','1','2018-11-09 10:26:25',9,'Data dengan ID: 23'),
(1,'trans_time','09:25','09:25:00','2018-11-09 10:35:41',9,'Data dengan ID: 23'),
(1,'forder','1','11','2018-11-09 10:35:41',9,'Data dengan ID: 23'),
(1,'fship','11','111','2018-11-09 10:35:41',9,'Data dengan ID: 23'),
(1,'fdoa','1','11','2018-11-09 10:35:41',9,'Data dengan ID: 23'),
(1,'fstart','10','0','2018-11-09 10:35:41',9,'Data dengan ID: 23'),
(1,'fexsho','10','0','2018-11-09 10:35:41',9,'Data dengan ID: 23'),
(1,'morder','1','11','2018-11-09 10:35:41',9,'Data dengan ID: 23'),
(1,'mship','11','111','2018-11-09 10:35:41',9,'Data dengan ID: 23'),
(1,'mdoa','1','11','2018-11-09 10:35:41',9,'Data dengan ID: 23'),
(1,'mstart','10','0','2018-11-09 10:35:41',9,'Data dengan ID: 23'),
(1,'mexsho','10','0','2018-11-09 10:35:41',9,'Data dengan ID: 23'),
(1,'trans_time','09:25','09:25:00','2018-11-12 11:53:35',13,'Data dengan ID: 23'),
(1,'fship','110','11','2018-11-12 11:53:35',13,'Data dengan ID: 23'),
(1,'fdoa','10','1','2018-11-12 11:53:35',13,'Data dengan ID: 23'),
(1,'fculling','10','1','2018-11-12 11:53:35',13,'Data dengan ID: 23'),
(1,'fstart','90','10','2018-11-12 11:53:35',13,'Data dengan ID: 23'),
(1,'fexsho','109','10','2018-11-12 11:53:35',13,'Data dengan ID: 23'),
(1,'mship','110','11','2018-11-12 11:53:35',13,'Data dengan ID: 23'),
(1,'mdoa','10','1','2018-11-12 11:53:35',13,'Data dengan ID: 23'),
(1,'mculling','10','1','2018-11-12 11:53:35',13,'Data dengan ID: 23'),
(1,'mstart','90','10','2018-11-12 11:53:35',13,'Data dengan ID: 23'),
(1,'mexsho','109','10','2018-11-12 11:53:35',13,'Data dengan ID: 23'),
(11,'item_id','','0','2018-11-12 16:47:52',13,'Data dengan ID: 7'),
(11,'vendor_id','','0','2018-11-12 16:47:52',13,'Data dengan ID: 7'),
(11,'depletion_id','','0','2018-11-12 16:47:52',13,'Data dengan ID: 7'),
(11,'fdead','20','0','2018-11-12 16:47:52',13,'Data dengan ID: 7'),
(11,'fcullet','10','0','2018-11-12 16:47:52',13,'Data dengan ID: 7'),
(11,'fdpopulate','30','0','2018-11-12 16:47:52',13,'Data dengan ID: 7'),
(11,'mdead','20','0','2018-11-12 16:47:52',13,'Data dengan ID: 7'),
(11,'mcullet','10','0','2018-11-12 16:47:52',13,'Data dengan ID: 7'),
(11,'mdpopulate','30','0','2018-11-12 16:47:52',13,'Data dengan ID: 7'),
(8,'category_id','1',NULL,'2018-11-13 09:51:56',13,'Data dengan ID: 2'),
(8,'uom','1',NULL,'2018-11-13 09:51:56',13,'Data dengan ID: 2'),
(8,'u_weight','1',NULL,'2018-11-13 09:51:56',13,'Data dengan ID: 2'),
(8,'unit','1',NULL,'2018-11-13 09:51:56',13,'Data dengan ID: 2'),
(8,'feed_type','Starter Mash',NULL,'2018-11-13 09:51:56',13,'Data dengan ID: 2'),
(4,'description','House 19','House 20','2018-11-13 10:30:14',9,'Data dengan ID: 29'),
(11,'item_id','','0','2018-11-13 11:54:50',13,'Data dengan ID: 8'),
(11,'vendor_id','','0','2018-11-13 11:54:50',13,'Data dengan ID: 8'),
(11,'depletion_id','','0','2018-11-13 11:54:50',13,'Data dengan ID: 8'),
(11,'fdead','9','0','2018-11-13 11:54:50',13,'Data dengan ID: 8'),
(11,'fcullet','1','0','2018-11-13 11:54:50',13,'Data dengan ID: 8'),
(11,'fdpopulate','10','0','2018-11-13 11:54:50',13,'Data dengan ID: 8'),
(11,'mdead','9','0','2018-11-13 11:54:50',13,'Data dengan ID: 8'),
(11,'mcullet','1','0','2018-11-13 11:54:50',13,'Data dengan ID: 8'),
(11,'mdpopulate','10','0','2018-11-13 11:54:50',13,'Data dengan ID: 8'),
(1,'trans_time','05:07','05:07:00','2018-11-14 09:54:23',9,'Data dengan ID: 25'),
(1,'fculling','1','0','2018-11-14 09:54:23',9,'Data dengan ID: 25'),
(1,'fstart','936','5893','2018-11-14 09:54:23',9,'Data dengan ID: 25'),
(1,'mstart','5892','936','2018-11-14 09:54:23',9,'Data dengan ID: 25'),
(1,'male_percentage','15.89','0','2018-11-14 09:54:23',9,'Data dengan ID: 25'),
(8,'uom','BAG','1','2018-11-14 11:03:17',9,'Data dengan ID: 4'),
(8,'uom','BAG','1','2018-11-14 11:03:44',9,'Data dengan ID: 5'),
(8,'uom','BAG','1','2018-11-14 11:04:06',9,'Data dengan ID: 6'),
(8,'uom','BAG','1','2018-11-14 11:04:36',9,'Data dengan ID: 7'),
(8,'uom','BAG','1','2018-11-14 11:05:38',9,'Data dengan ID: 8'),
(8,'uom','BAG','1','2018-11-14 11:06:07',9,'Data dengan ID: 9'),
(8,'uom','BAG','1','2018-11-14 11:06:55',9,'Data dengan ID: 10'),
(8,'uom','BAG','1','2018-11-14 11:07:05',9,'Data dengan ID: 11'),
(12,'description','Cibatu Hatchery','CIBATU HATCHERY','2018-11-14 11:09:28',9,'Data dengan ID: 3'),
(1,'trans_time','05:30','05:30:00','2018-11-15 09:17:01',9,'Data dengan ID: 26'),
(1,'fstart','936','5893','2018-11-15 09:17:01',9,'Data dengan ID: 26'),
(1,'mstart','5893','936','2018-11-15 09:17:01',9,'Data dengan ID: 26'),
(11,'item_id','','0','2018-11-16 11:07:33',9,'Data dengan ID: 15'),
(11,'vendor_id','','0','2018-11-16 11:07:33',9,'Data dengan ID: 15'),
(11,'item_id','','0','2018-11-16 13:21:42',9,'Data dengan ID: 27'),
(11,'vendor_id','','0','2018-11-16 13:21:42',9,'Data dengan ID: 27'),
(11,'dmale','','0','2018-11-16 13:21:42',9,'Data dengan ID: 27'),
(11,'item_id','','0','2018-11-16 13:22:12',9,'Data dengan ID: 19'),
(11,'vendor_id','','0','2018-11-16 13:22:12',9,'Data dengan ID: 19'),
(11,'item_id','','0','2018-11-16 13:22:54',9,'Data dengan ID: 19'),
(11,'vendor_id','','0','2018-11-16 13:22:54',9,'Data dengan ID: 19'),
(11,'dmale','1','0','2018-11-16 13:22:54',9,'Data dengan ID: 19'),
(11,'dfemale','0','1','2018-11-16 13:22:54',9,'Data dengan ID: 19'),
(11,'item_id','','0','2018-11-16 13:30:23',9,'Data dengan ID: 19'),
(11,'vendor_id','','0','2018-11-16 13:30:23',9,'Data dengan ID: 19'),
(11,'dmale','0','1','2018-11-16 13:30:23',9,'Data dengan ID: 19'),
(11,'dfemale','1','0','2018-11-16 13:30:23',9,'Data dengan ID: 19'),
(11,'item_id','','0','2018-11-16 13:55:25',9,'Data dengan ID: 38'),
(11,'vendor_id','','0','2018-11-16 13:55:25',9,'Data dengan ID: 38'),
(11,'depletion_id','10','0','2018-11-16 13:55:25',9,'Data dengan ID: 38'),
(11,'item_id','','0','2018-11-16 13:58:15',9,'Data dengan ID: 41'),
(11,'vendor_id','','0','2018-11-16 13:58:15',9,'Data dengan ID: 41'),
(11,'depletion_id','10','0','2018-11-16 13:58:15',9,'Data dengan ID: 41'),
(11,'dmale','6','1','2018-11-16 13:58:15',9,'Data dengan ID: 41'),
(11,'dfemale','1','6','2018-11-16 13:58:15',9,'Data dengan ID: 41'),
(11,'item_id','','0','2018-11-16 16:56:29',9,'Data dengan ID: 72'),
(11,'vendor_id','','0','2018-11-16 16:56:29',9,'Data dengan ID: 72'),
(11,'damage','34','33','2018-11-16 16:56:29',9,'Data dengan ID: 72'),
(11,'item_id','','0','2018-11-19 11:27:07',9,'Data dengan ID: 128'),
(11,'vendor_id','','0','2018-11-19 11:27:07',9,'Data dengan ID: 128'),
(11,'depletion_id','10','0','2018-11-19 11:27:07',9,'Data dengan ID: 128'),
(11,'dmale','1','0','2018-11-19 11:27:07',9,'Data dengan ID: 128'),
(11,'dfemale','4','0','2018-11-19 11:27:07',9,'Data dengan ID: 128'),
(11,'item_id','','0','2018-11-19 11:29:26',9,'Data dengan ID: 131'),
(11,'vendor_id','','0','2018-11-19 11:29:26',9,'Data dengan ID: 131'),
(11,'depletion_id','10','0','2018-11-19 11:29:26',9,'Data dengan ID: 131'),
(11,'dfemale','6','0','2018-11-19 11:29:26',9,'Data dengan ID: 131'),
(11,'item_id','','0','2018-11-19 14:16:57',9,'Data dengan ID: 120'),
(11,'vendor_id','','0','2018-11-19 14:16:57',9,'Data dengan ID: 120'),
(11,'depletion_id','10','0','2018-11-19 14:16:57',9,'Data dengan ID: 120'),
(11,'dfemale','3','0','2018-11-19 14:16:57',9,'Data dengan ID: 120'),
(11,'item_id','','0','2018-11-19 14:18:38',9,'Data dengan ID: 121'),
(11,'vendor_id','','0','2018-11-19 14:18:38',9,'Data dengan ID: 121'),
(11,'depletion_id','','0','2018-11-19 14:18:38',9,'Data dengan ID: 121'),
(11,'dfemale','7','0','2018-11-19 14:18:38',9,'Data dengan ID: 121'),
(11,'item_id','','0','2018-11-19 14:20:03',9,'Data dengan ID: 122'),
(11,'vendor_id','','0','2018-11-19 14:20:03',9,'Data dengan ID: 122'),
(11,'depletion_id','10','0','2018-11-19 14:20:03',9,'Data dengan ID: 122'),
(11,'dmale','1','0','2018-11-19 14:20:03',9,'Data dengan ID: 122'),
(11,'dfemale','2','0','2018-11-19 14:20:03',9,'Data dengan ID: 122'),
(11,'item_id','','0','2018-11-19 14:20:21',9,'Data dengan ID: 123'),
(11,'vendor_id','','0','2018-11-19 14:20:21',9,'Data dengan ID: 123'),
(11,'depletion_id','10','0','2018-11-19 14:20:21',9,'Data dengan ID: 123'),
(11,'dmale','1','0','2018-11-19 14:20:21',9,'Data dengan ID: 123'),
(11,'dfemale','2','0','2018-11-19 14:20:21',9,'Data dengan ID: 123'),
(11,'item_id','','0','2018-11-19 14:24:52',9,'Data dengan ID: 125'),
(11,'vendor_id','','0','2018-11-19 14:24:52',9,'Data dengan ID: 125'),
(11,'depletion_id','10','0','2018-11-19 14:24:52',9,'Data dengan ID: 125'),
(11,'dfemale','1','0','2018-11-19 14:24:52',9,'Data dengan ID: 125'),
(11,'item_id','','0','2018-11-19 14:25:52',9,'Data dengan ID: 126'),
(11,'vendor_id','','0','2018-11-19 14:25:52',9,'Data dengan ID: 126'),
(11,'depletion_id','10','0','2018-11-19 14:25:52',9,'Data dengan ID: 126'),
(11,'dfemale','3','0','2018-11-19 14:25:52',9,'Data dengan ID: 126'),
(11,'item_id','','0','2018-11-19 14:26:08',9,'Data dengan ID: 130'),
(11,'vendor_id','','0','2018-11-19 14:26:08',9,'Data dengan ID: 130'),
(11,'depletion_id','10','0','2018-11-19 14:26:08',9,'Data dengan ID: 130'),
(11,'dmale','01','0','2018-11-19 14:26:08',9,'Data dengan ID: 130'),
(11,'dfemale','01','0','2018-11-19 14:26:08',9,'Data dengan ID: 130'),
(11,'item_id','','0','2018-11-19 14:26:48',9,'Data dengan ID: 132'),
(11,'vendor_id','','0','2018-11-19 14:26:48',9,'Data dengan ID: 132'),
(11,'depletion_id','10','0','2018-11-19 14:26:48',9,'Data dengan ID: 132'),
(11,'dfemale','1','0','2018-11-19 14:26:48',9,'Data dengan ID: 132'),
(11,'item_id','','0','2018-11-19 14:27:31',9,'Data dengan ID: 133'),
(11,'vendor_id','','0','2018-11-19 14:27:31',9,'Data dengan ID: 133'),
(11,'depletion_id','10','0','2018-11-19 14:27:31',9,'Data dengan ID: 133'),
(11,'dmale','2','0','2018-11-19 14:27:31',9,'Data dengan ID: 133'),
(11,'dfemale','1','0','2018-11-19 14:27:31',9,'Data dengan ID: 133'),
(11,'item_id','','0','2018-11-19 14:28:19',9,'Data dengan ID: 134'),
(11,'vendor_id','','0','2018-11-19 14:28:19',9,'Data dengan ID: 134'),
(11,'depletion_id','10','0','2018-11-19 14:28:19',9,'Data dengan ID: 134'),
(11,'dmale','1','0','2018-11-19 14:28:19',9,'Data dengan ID: 134'),
(11,'item_id','','0','2018-11-19 14:28:54',9,'Data dengan ID: 135'),
(11,'vendor_id','','0','2018-11-19 14:28:54',9,'Data dengan ID: 135'),
(11,'depletion_id','10','0','2018-11-19 14:28:54',9,'Data dengan ID: 135'),
(11,'dfemale','2','0','2018-11-19 14:28:54',9,'Data dengan ID: 135'),
(11,'item_id','','0','2018-11-19 14:29:26',9,'Data dengan ID: 137'),
(11,'vendor_id','','0','2018-11-19 14:29:26',9,'Data dengan ID: 137'),
(11,'depletion_id','10','0','2018-11-19 14:29:26',9,'Data dengan ID: 137'),
(11,'dfemale','1','0','2018-11-19 14:29:26',9,'Data dengan ID: 137'),
(11,'item_id','','0','2018-11-19 14:29:46',9,'Data dengan ID: 138'),
(11,'vendor_id','','0','2018-11-19 14:29:46',9,'Data dengan ID: 138'),
(11,'depletion_id','10','0','2018-11-19 14:29:46',9,'Data dengan ID: 138'),
(11,'dfemale','2','0','2018-11-19 14:29:46',9,'Data dengan ID: 138'),
(11,'item_id','','0','2018-11-19 14:33:15',9,'Data dengan ID: 140'),
(11,'vendor_id','','0','2018-11-19 14:33:15',9,'Data dengan ID: 140'),
(11,'depletion_id','10','0','2018-11-19 14:33:15',9,'Data dengan ID: 140'),
(11,'dmale','1','0','2018-11-19 14:33:15',9,'Data dengan ID: 140'),
(11,'dfemale','1','0','2018-11-19 14:33:15',9,'Data dengan ID: 140'),
(11,'item_id','','0','2018-11-19 14:33:28',9,'Data dengan ID: 141'),
(11,'vendor_id','','0','2018-11-19 14:33:28',9,'Data dengan ID: 141'),
(11,'depletion_id','10','0','2018-11-19 14:33:28',9,'Data dengan ID: 141'),
(11,'dfemale','1','0','2018-11-19 14:33:28',9,'Data dengan ID: 141'),
(11,'item_id','','0','2018-11-19 14:33:45',9,'Data dengan ID: 142'),
(11,'vendor_id','','0','2018-11-19 14:33:45',9,'Data dengan ID: 142'),
(11,'depletion_id','10','0','2018-11-19 14:33:45',9,'Data dengan ID: 142'),
(11,'dfemale','1','0','2018-11-19 14:33:45',9,'Data dengan ID: 142'),
(11,'item_id','','0','2018-11-19 14:34:03',9,'Data dengan ID: 143'),
(11,'vendor_id','','0','2018-11-19 14:34:03',9,'Data dengan ID: 143'),
(11,'depletion_id','10','0','2018-11-19 14:34:03',9,'Data dengan ID: 143'),
(11,'dfemale','1','0','2018-11-19 14:34:03',9,'Data dengan ID: 143'),
(11,'item_id','','0','2018-11-19 14:34:26',9,'Data dengan ID: 146'),
(11,'vendor_id','','0','2018-11-19 14:34:26',9,'Data dengan ID: 146'),
(11,'depletion_id','10','0','2018-11-19 14:34:26',9,'Data dengan ID: 146'),
(11,'dmale','1','0','2018-11-19 14:34:26',9,'Data dengan ID: 146'),
(11,'item_id','','0','2018-11-19 14:34:39',9,'Data dengan ID: 147'),
(11,'vendor_id','','0','2018-11-19 14:34:39',9,'Data dengan ID: 147'),
(11,'depletion_id','10','0','2018-11-19 14:34:39',9,'Data dengan ID: 147'),
(11,'dmale','1','0','2018-11-19 14:34:39',9,'Data dengan ID: 147'),
(11,'item_id','','0','2018-11-19 14:35:13',9,'Data dengan ID: 148'),
(11,'vendor_id','','0','2018-11-19 14:35:13',9,'Data dengan ID: 148'),
(11,'depletion_id','10','0','2018-11-19 14:35:13',9,'Data dengan ID: 148'),
(11,'dfemale','2','0','2018-11-19 14:35:13',9,'Data dengan ID: 148'),
(11,'item_id','','0','2018-11-19 14:36:06',9,'Data dengan ID: 150'),
(11,'vendor_id','','0','2018-11-19 14:36:06',9,'Data dengan ID: 150'),
(11,'depletion_id','10','0','2018-11-19 14:36:06',9,'Data dengan ID: 150'),
(11,'dfemale','2','0','2018-11-19 14:36:06',9,'Data dengan ID: 150'),
(11,'item_id','','0','2018-11-19 14:36:24',9,'Data dengan ID: 151'),
(11,'vendor_id','','0','2018-11-19 14:36:24',9,'Data dengan ID: 151'),
(11,'depletion_id','10','0','2018-11-19 14:36:24',9,'Data dengan ID: 151'),
(11,'dfemale','3','0','2018-11-19 14:36:24',9,'Data dengan ID: 151'),
(11,'item_id','','0','2018-11-19 14:36:40',9,'Data dengan ID: 152'),
(11,'vendor_id','','0','2018-11-19 14:36:40',9,'Data dengan ID: 152'),
(11,'depletion_id','10','0','2018-11-19 14:36:40',9,'Data dengan ID: 152'),
(11,'dfemale','2','0','2018-11-19 14:36:40',9,'Data dengan ID: 152'),
(11,'item_id','','0','2018-11-19 14:36:52',9,'Data dengan ID: 153'),
(11,'vendor_id','','0','2018-11-19 14:36:52',9,'Data dengan ID: 153'),
(11,'depletion_id','10','0','2018-11-19 14:36:52',9,'Data dengan ID: 153'),
(11,'dfemale','3','0','2018-11-19 14:36:52',9,'Data dengan ID: 153'),
(11,'item_id','','0','2018-11-19 14:38:37',9,'Data dengan ID: 155'),
(11,'vendor_id','','0','2018-11-19 14:38:37',9,'Data dengan ID: 155'),
(11,'depletion_id','10','0','2018-11-19 14:38:37',9,'Data dengan ID: 155'),
(11,'dfemale','2','0','2018-11-19 14:38:37',9,'Data dengan ID: 155'),
(11,'item_id','','0','2018-11-19 14:38:56',9,'Data dengan ID: 156'),
(11,'vendor_id','','0','2018-11-19 14:38:56',9,'Data dengan ID: 156'),
(11,'depletion_id','10','0','2018-11-19 14:38:56',9,'Data dengan ID: 156'),
(11,'dfemale','6','0','2018-11-19 14:38:56',9,'Data dengan ID: 156'),
(11,'item_id','','0','2018-11-19 14:43:26',9,'Data dengan ID: 162'),
(11,'vendor_id','','0','2018-11-19 14:43:26',9,'Data dengan ID: 162'),
(11,'depletion_id','10','0','2018-11-19 14:43:26',9,'Data dengan ID: 162'),
(11,'dmale','1','0','2018-11-19 14:43:26',9,'Data dengan ID: 162'),
(11,'dfemale','33','0','2018-11-19 14:43:26',9,'Data dengan ID: 162'),
(11,'item_id','','0','2018-11-19 14:44:16',9,'Data dengan ID: 163'),
(11,'vendor_id','','0','2018-11-19 14:44:16',9,'Data dengan ID: 163'),
(11,'depletion_id','10','0','2018-11-19 14:44:16',9,'Data dengan ID: 163'),
(11,'dfemale','59','0','2018-11-19 14:44:16',9,'Data dengan ID: 163'),
(11,'item_id','','0','2018-11-19 14:44:34',9,'Data dengan ID: 164'),
(11,'vendor_id','','0','2018-11-19 14:44:34',9,'Data dengan ID: 164'),
(11,'depletion_id','10','0','2018-11-19 14:44:34',9,'Data dengan ID: 164'),
(11,'dmale','3','0','2018-11-19 14:44:34',9,'Data dengan ID: 164'),
(11,'dfemale','98','0','2018-11-19 14:44:34',9,'Data dengan ID: 164'),
(11,'item_id','','0','2018-11-19 14:47:24',9,'Data dengan ID: 165'),
(11,'vendor_id','','0','2018-11-19 14:47:24',9,'Data dengan ID: 165'),
(11,'depletion_id','10','0','2018-11-19 14:47:24',9,'Data dengan ID: 165'),
(11,'dfemale','108','0','2018-11-19 14:47:24',9,'Data dengan ID: 165'),
(11,'item_id','','0','2018-11-19 14:47:49',9,'Data dengan ID: 166'),
(11,'vendor_id','','0','2018-11-19 14:47:49',9,'Data dengan ID: 166'),
(11,'depletion_id','10','0','2018-11-19 14:47:49',9,'Data dengan ID: 166'),
(11,'dmale','3','0','2018-11-19 14:47:49',9,'Data dengan ID: 166'),
(11,'dfemale','113','0','2018-11-19 14:47:49',9,'Data dengan ID: 166'),
(11,'item_id','','0','2018-11-19 14:50:57',9,'Data dengan ID: 167'),
(11,'vendor_id','','0','2018-11-19 14:50:57',9,'Data dengan ID: 167'),
(11,'depletion_id','10','0','2018-11-19 14:50:57',9,'Data dengan ID: 167'),
(11,'dmale','2','0','2018-11-19 14:50:57',9,'Data dengan ID: 167'),
(11,'dfemale','49','0','2018-11-19 14:50:57',9,'Data dengan ID: 167'),
(11,'item_id','','0','2018-11-19 14:51:24',9,'Data dengan ID: 171'),
(11,'vendor_id','','0','2018-11-19 14:51:24',9,'Data dengan ID: 171'),
(11,'depletion_id','10','0','2018-11-19 14:51:24',9,'Data dengan ID: 171'),
(11,'dmale','3','0','2018-11-19 14:51:24',9,'Data dengan ID: 171'),
(11,'dfemale','47','0','2018-11-19 14:51:24',9,'Data dengan ID: 171'),
(11,'item_id','','0','2018-11-19 14:53:58',9,'Data dengan ID: 172'),
(11,'vendor_id','','0','2018-11-19 14:53:58',9,'Data dengan ID: 172'),
(11,'depletion_id','10','0','2018-11-19 14:53:58',9,'Data dengan ID: 172'),
(11,'dmale','3','0','2018-11-19 14:53:58',9,'Data dengan ID: 172'),
(11,'dfemale','29','0','2018-11-19 14:53:58',9,'Data dengan ID: 172'),
(11,'item_id','','0','2018-11-19 14:54:12',9,'Data dengan ID: 173'),
(11,'vendor_id','','0','2018-11-19 14:54:12',9,'Data dengan ID: 173'),
(11,'depletion_id','10','0','2018-11-19 14:54:12',9,'Data dengan ID: 173'),
(11,'dmale','2','0','2018-11-19 14:54:12',9,'Data dengan ID: 173'),
(11,'dfemale','13','0','2018-11-19 14:54:12',9,'Data dengan ID: 173'),
(11,'item_id','','0','2018-11-19 14:59:24',9,'Data dengan ID: 174'),
(11,'vendor_id','','0','2018-11-19 14:59:24',9,'Data dengan ID: 174'),
(11,'depletion_id','10','0','2018-11-19 14:59:24',9,'Data dengan ID: 174'),
(11,'dmale','2','0','2018-11-19 14:59:24',9,'Data dengan ID: 174'),
(11,'dfemale','16','0','2018-11-19 14:59:24',9,'Data dengan ID: 174'),
(11,'item_id','','0','2018-11-19 14:59:44',9,'Data dengan ID: 175'),
(11,'vendor_id','','0','2018-11-19 14:59:44',9,'Data dengan ID: 175'),
(11,'depletion_id','10','0','2018-11-19 14:59:44',9,'Data dengan ID: 175'),
(11,'dfemale','9','0','2018-11-19 14:59:44',9,'Data dengan ID: 175'),
(11,'item_id','','0','2018-11-19 15:00:04',9,'Data dengan ID: 176'),
(11,'vendor_id','','0','2018-11-19 15:00:04',9,'Data dengan ID: 176'),
(11,'depletion_id','10','0','2018-11-19 15:00:04',9,'Data dengan ID: 176'),
(11,'dfemale','5','0','2018-11-19 15:00:04',9,'Data dengan ID: 176'),
(11,'item_id','','0','2018-11-19 15:00:33',9,'Data dengan ID: 177'),
(11,'vendor_id','','0','2018-11-19 15:00:33',9,'Data dengan ID: 177'),
(11,'depletion_id','10','0','2018-11-19 15:00:33',9,'Data dengan ID: 177'),
(11,'dmale','1','0','2018-11-19 15:00:33',9,'Data dengan ID: 177'),
(11,'dfemale','10','0','2018-11-19 15:00:33',9,'Data dengan ID: 177'),
(11,'item_id','','0','2018-11-19 15:00:46',9,'Data dengan ID: 178'),
(11,'vendor_id','','0','2018-11-19 15:00:46',9,'Data dengan ID: 178'),
(11,'depletion_id','10','0','2018-11-19 15:00:46',9,'Data dengan ID: 178'),
(11,'dfemale','9','0','2018-11-19 15:00:46',9,'Data dengan ID: 178'),
(11,'item_id','','0','2018-11-19 15:01:08',9,'Data dengan ID: 179'),
(11,'vendor_id','','0','2018-11-19 15:01:08',9,'Data dengan ID: 179'),
(11,'depletion_id','10','0','2018-11-19 15:01:08',9,'Data dengan ID: 179'),
(11,'dfemale','14','0','2018-11-19 15:01:08',9,'Data dengan ID: 179'),
(11,'item_id','','0','2018-11-19 15:02:23',9,'Data dengan ID: 180'),
(11,'vendor_id','','0','2018-11-19 15:02:23',9,'Data dengan ID: 180'),
(11,'depletion_id','10','0','2018-11-19 15:02:23',9,'Data dengan ID: 180'),
(11,'dfemale','15','0','2018-11-19 15:02:23',9,'Data dengan ID: 180'),
(11,'item_id','','0','2018-11-19 15:03:53',9,'Data dengan ID: 182'),
(11,'vendor_id','','0','2018-11-19 15:03:53',9,'Data dengan ID: 182'),
(11,'depletion_id','10','0','2018-11-19 15:03:53',9,'Data dengan ID: 182'),
(11,'dfemale','13','0','2018-11-19 15:03:53',9,'Data dengan ID: 182'),
(11,'item_id','','0','2018-11-19 15:04:33',9,'Data dengan ID: 183'),
(11,'vendor_id','','0','2018-11-19 15:04:33',9,'Data dengan ID: 183'),
(11,'depletion_id','10','0','2018-11-19 15:04:33',9,'Data dengan ID: 183'),
(11,'dmale','1','0','2018-11-19 15:04:33',9,'Data dengan ID: 183'),
(11,'dfemale','11','0','2018-11-19 15:04:33',9,'Data dengan ID: 183'),
(11,'item_id','','0','2018-11-19 15:59:38',9,'Data dengan ID: 186'),
(11,'vendor_id','','0','2018-11-19 15:59:38',9,'Data dengan ID: 186'),
(11,'depletion_id','10','0','2018-11-19 15:59:38',9,'Data dengan ID: 186'),
(11,'dfemale','15','0','2018-11-19 15:59:38',9,'Data dengan ID: 186'),
(11,'item_id','','0','2018-11-19 15:59:55',9,'Data dengan ID: 187'),
(11,'vendor_id','','0','2018-11-19 15:59:55',9,'Data dengan ID: 187'),
(11,'depletion_id','10','0','2018-11-19 15:59:55',9,'Data dengan ID: 187'),
(11,'dmale','1','0','2018-11-19 15:59:55',9,'Data dengan ID: 187'),
(11,'dfemale','27','0','2018-11-19 15:59:55',9,'Data dengan ID: 187'),
(11,'item_id','','0','2018-11-19 16:01:11',9,'Data dengan ID: 189'),
(11,'vendor_id','','0','2018-11-19 16:01:11',9,'Data dengan ID: 189'),
(11,'depletion_id','10','0','2018-11-19 16:01:11',9,'Data dengan ID: 189'),
(11,'dmale','2','0','2018-11-19 16:01:11',9,'Data dengan ID: 189'),
(11,'dfemale','17','0','2018-11-19 16:01:11',9,'Data dengan ID: 189'),
(11,'item_id','','0','2018-11-19 16:08:11',9,'Data dengan ID: 181'),
(11,'vendor_id','','0','2018-11-19 16:08:11',9,'Data dengan ID: 181'),
(11,'depletion_id','10','0','2018-11-19 16:08:11',9,'Data dengan ID: 181'),
(11,'dfemale','11','0','2018-11-19 16:08:11',9,'Data dengan ID: 181'),
(11,'item_id','','0','2018-11-19 16:09:37',9,'Data dengan ID: 192'),
(11,'vendor_id','','0','2018-11-19 16:09:37',9,'Data dengan ID: 192'),
(11,'depletion_id','10','0','2018-11-19 16:09:37',9,'Data dengan ID: 192'),
(11,'dfemale','16','0','2018-11-19 16:09:37',9,'Data dengan ID: 192'),
(11,'item_id','','0','2018-11-19 16:09:51',9,'Data dengan ID: 193'),
(11,'vendor_id','','0','2018-11-19 16:09:51',9,'Data dengan ID: 193'),
(11,'depletion_id','10','0','2018-11-19 16:09:51',9,'Data dengan ID: 193'),
(11,'dfemale','11','0','2018-11-19 16:09:51',9,'Data dengan ID: 193'),
(11,'item_id','','0','2018-11-19 16:10:28',9,'Data dengan ID: 195'),
(11,'vendor_id','','0','2018-11-19 16:10:28',9,'Data dengan ID: 195'),
(11,'depletion_id','10','0','2018-11-19 16:10:28',9,'Data dengan ID: 195'),
(11,'dmale','2','0','2018-11-19 16:10:28',9,'Data dengan ID: 195'),
(11,'dfemale','28','0','2018-11-19 16:10:28',9,'Data dengan ID: 195'),
(11,'item_id','','0','2018-11-19 16:10:39',9,'Data dengan ID: 196'),
(11,'vendor_id','','0','2018-11-19 16:10:39',9,'Data dengan ID: 196'),
(11,'depletion_id','10','0','2018-11-19 16:10:39',9,'Data dengan ID: 196'),
(11,'dfemale','16','0','2018-11-19 16:10:39',9,'Data dengan ID: 196'),
(11,'item_id','','0','2018-11-19 16:10:53',9,'Data dengan ID: 197'),
(11,'vendor_id','','0','2018-11-19 16:10:53',9,'Data dengan ID: 197'),
(11,'depletion_id','10','0','2018-11-19 16:10:53',9,'Data dengan ID: 197'),
(11,'dfemale','28','0','2018-11-19 16:10:53',9,'Data dengan ID: 197'),
(11,'item_id','','0','2018-11-19 16:11:08',9,'Data dengan ID: 198'),
(11,'vendor_id','','0','2018-11-19 16:11:08',9,'Data dengan ID: 198'),
(11,'depletion_id','10','0','2018-11-19 16:11:08',9,'Data dengan ID: 198'),
(11,'dfemale','15','0','2018-11-19 16:11:08',9,'Data dengan ID: 198'),
(11,'item_id','','0','2018-11-19 16:11:25',9,'Data dengan ID: 199'),
(11,'vendor_id','','0','2018-11-19 16:11:25',9,'Data dengan ID: 199'),
(11,'depletion_id','10','0','2018-11-19 16:11:25',9,'Data dengan ID: 199'),
(11,'dmale','1','0','2018-11-19 16:11:25',9,'Data dengan ID: 199'),
(11,'dfemale','13','0','2018-11-19 16:11:25',9,'Data dengan ID: 199'),
(11,'item_id','','0','2018-11-19 16:11:41',9,'Data dengan ID: 200'),
(11,'vendor_id','','0','2018-11-19 16:11:41',9,'Data dengan ID: 200'),
(11,'depletion_id','10','0','2018-11-19 16:11:41',9,'Data dengan ID: 200'),
(11,'dmale','1','0','2018-11-19 16:11:41',9,'Data dengan ID: 200'),
(11,'dfemale','9','0','2018-11-19 16:11:41',9,'Data dengan ID: 200'),
(11,'item_id','','0','2018-11-19 16:12:25',9,'Data dengan ID: 201'),
(11,'vendor_id','','0','2018-11-19 16:12:25',9,'Data dengan ID: 201'),
(11,'depletion_id','10','0','2018-11-19 16:12:25',9,'Data dengan ID: 201'),
(11,'dmale','1','0','2018-11-19 16:12:25',9,'Data dengan ID: 201'),
(11,'dfemale','4','0','2018-11-19 16:12:25',9,'Data dengan ID: 201'),
(11,'item_id','','0','2018-11-19 16:12:43',9,'Data dengan ID: 202'),
(11,'vendor_id','','0','2018-11-19 16:12:43',9,'Data dengan ID: 202'),
(11,'depletion_id','10','0','2018-11-19 16:12:43',9,'Data dengan ID: 202'),
(11,'dfemale','12','0','2018-11-19 16:12:43',9,'Data dengan ID: 202'),
(11,'item_id','','0','2018-11-19 16:14:27',9,'Data dengan ID: 203'),
(11,'vendor_id','','0','2018-11-19 16:14:27',9,'Data dengan ID: 203'),
(11,'depletion_id','10','0','2018-11-19 16:14:27',9,'Data dengan ID: 203'),
(11,'dfemale','5','0','2018-11-19 16:14:27',9,'Data dengan ID: 203'),
(11,'item_id','','0','2018-11-19 16:14:46',9,'Data dengan ID: 204'),
(11,'vendor_id','','0','2018-11-19 16:14:46',9,'Data dengan ID: 204'),
(11,'depletion_id','10','0','2018-11-19 16:14:46',9,'Data dengan ID: 204'),
(11,'dfemale','11','0','2018-11-19 16:14:46',9,'Data dengan ID: 204'),
(11,'item_id','','0','2018-11-19 16:15:36',9,'Data dengan ID: 205'),
(11,'vendor_id','','0','2018-11-19 16:15:36',9,'Data dengan ID: 205'),
(11,'depletion_id','10','0','2018-11-19 16:15:36',9,'Data dengan ID: 205'),
(11,'dfemale','4','0','2018-11-19 16:15:36',9,'Data dengan ID: 205'),
(11,'item_id','','0','2018-11-19 16:15:50',9,'Data dengan ID: 206'),
(11,'vendor_id','','0','2018-11-19 16:15:50',9,'Data dengan ID: 206'),
(11,'depletion_id','10','0','2018-11-19 16:15:50',9,'Data dengan ID: 206'),
(11,'dmale','2','0','2018-11-19 16:15:50',9,'Data dengan ID: 206'),
(11,'dfemale','4','0','2018-11-19 16:15:50',9,'Data dengan ID: 206'),
(11,'item_id','','0','2018-11-19 16:16:08',9,'Data dengan ID: 207'),
(11,'vendor_id','','0','2018-11-19 16:16:08',9,'Data dengan ID: 207'),
(11,'depletion_id','10','0','2018-11-19 16:16:08',9,'Data dengan ID: 207'),
(11,'dfemale','5','0','2018-11-19 16:16:08',9,'Data dengan ID: 207'),
(11,'item_id','','0','2018-11-19 16:16:45',9,'Data dengan ID: 208'),
(11,'vendor_id','','0','2018-11-19 16:16:45',9,'Data dengan ID: 208'),
(11,'depletion_id','10','0','2018-11-19 16:16:45',9,'Data dengan ID: 208'),
(11,'dmale','1','0','2018-11-19 16:16:45',9,'Data dengan ID: 208'),
(11,'dfemale','6','0','2018-11-19 16:16:45',9,'Data dengan ID: 208'),
(11,'item_id','','0','2018-11-19 16:17:02',9,'Data dengan ID: 209'),
(11,'vendor_id','','0','2018-11-19 16:17:02',9,'Data dengan ID: 209'),
(11,'depletion_id','10','0','2018-11-19 16:17:02',9,'Data dengan ID: 209'),
(11,'dmale','1','0','2018-11-19 16:17:02',9,'Data dengan ID: 209'),
(11,'dfemale','4','0','2018-11-19 16:17:02',9,'Data dengan ID: 209'),
(11,'item_id','','0','2018-11-19 16:17:15',9,'Data dengan ID: 210'),
(11,'vendor_id','','0','2018-11-19 16:17:15',9,'Data dengan ID: 210'),
(11,'depletion_id','10','0','2018-11-19 16:17:15',9,'Data dengan ID: 210'),
(11,'dfemale','2','0','2018-11-19 16:17:15',9,'Data dengan ID: 210'),
(11,'item_id','','0','2018-11-19 16:17:28',9,'Data dengan ID: 211'),
(11,'vendor_id','','0','2018-11-19 16:17:28',9,'Data dengan ID: 211'),
(11,'depletion_id','10','0','2018-11-19 16:17:28',9,'Data dengan ID: 211'),
(11,'dfemale','4','0','2018-11-19 16:17:28',9,'Data dengan ID: 211'),
(11,'item_id','','0','2018-11-19 16:17:45',9,'Data dengan ID: 212'),
(11,'vendor_id','','0','2018-11-19 16:17:45',9,'Data dengan ID: 212'),
(11,'depletion_id','10','0','2018-11-19 16:17:45',9,'Data dengan ID: 212'),
(11,'dfemale','3','0','2018-11-19 16:17:45',9,'Data dengan ID: 212'),
(11,'item_id','','0','2018-11-19 16:18:06',9,'Data dengan ID: 213'),
(11,'vendor_id','','0','2018-11-19 16:18:06',9,'Data dengan ID: 213'),
(11,'depletion_id','10','0','2018-11-19 16:18:06',9,'Data dengan ID: 213'),
(11,'dmale','1','0','2018-11-19 16:18:06',9,'Data dengan ID: 213'),
(11,'dfemale','1','0','2018-11-19 16:18:06',9,'Data dengan ID: 213'),
(11,'item_id','','0','2018-11-19 16:18:21',9,'Data dengan ID: 214'),
(11,'vendor_id','','0','2018-11-19 16:18:21',9,'Data dengan ID: 214'),
(11,'depletion_id','10','0','2018-11-19 16:18:21',9,'Data dengan ID: 214'),
(11,'dfemale','2','0','2018-11-19 16:18:21',9,'Data dengan ID: 214'),
(11,'item_id','','0','2018-11-19 16:18:44',9,'Data dengan ID: 215'),
(11,'vendor_id','','0','2018-11-19 16:18:44',9,'Data dengan ID: 215'),
(11,'depletion_id','10','0','2018-11-19 16:18:44',9,'Data dengan ID: 215'),
(11,'dmale','1','0','2018-11-19 16:18:44',9,'Data dengan ID: 215'),
(11,'dfemale','1','0','2018-11-19 16:18:44',9,'Data dengan ID: 215'),
(11,'item_id','','0','2018-11-19 16:18:59',9,'Data dengan ID: 216'),
(11,'vendor_id','','0','2018-11-19 16:18:59',9,'Data dengan ID: 216'),
(11,'depletion_id','10','0','2018-11-19 16:18:59',9,'Data dengan ID: 216'),
(11,'dfemale','5','0','2018-11-19 16:18:59',9,'Data dengan ID: 216'),
(11,'item_id','','0','2018-11-19 16:19:13',9,'Data dengan ID: 217'),
(11,'vendor_id','','0','2018-11-19 16:19:13',9,'Data dengan ID: 217'),
(11,'depletion_id','10','0','2018-11-19 16:19:13',9,'Data dengan ID: 217'),
(11,'dfemale','2','0','2018-11-19 16:19:13',9,'Data dengan ID: 217'),
(11,'item_id','','0','2018-11-19 16:19:27',9,'Data dengan ID: 218'),
(11,'vendor_id','','0','2018-11-19 16:19:27',9,'Data dengan ID: 218'),
(11,'depletion_id','10','0','2018-11-19 16:19:27',9,'Data dengan ID: 218'),
(11,'dfemale','2','0','2018-11-19 16:19:27',9,'Data dengan ID: 218'),
(11,'item_id','','0','2018-11-19 16:19:38',9,'Data dengan ID: 219'),
(11,'vendor_id','','0','2018-11-19 16:19:38',9,'Data dengan ID: 219'),
(11,'depletion_id','10','0','2018-11-19 16:19:38',9,'Data dengan ID: 219'),
(11,'dfemale','2','0','2018-11-19 16:19:38',9,'Data dengan ID: 219'),
(11,'item_id','','0','2018-11-19 16:19:57',9,'Data dengan ID: 220'),
(11,'vendor_id','','0','2018-11-19 16:19:57',9,'Data dengan ID: 220'),
(11,'depletion_id','10','0','2018-11-19 16:19:57',9,'Data dengan ID: 220'),
(11,'dfemale','2','0','2018-11-19 16:19:57',9,'Data dengan ID: 220'),
(11,'item_id','','0','2018-11-19 16:20:20',9,'Data dengan ID: 221'),
(11,'vendor_id','','0','2018-11-19 16:20:20',9,'Data dengan ID: 221'),
(11,'depletion_id','10','0','2018-11-19 16:20:20',9,'Data dengan ID: 221'),
(11,'dmale','2','0','2018-11-19 16:20:20',9,'Data dengan ID: 221'),
(11,'dfemale','1','0','2018-11-19 16:20:20',9,'Data dengan ID: 221'),
(11,'item_id','','0','2018-11-19 16:23:52',9,'Data dengan ID: 222'),
(11,'vendor_id','','0','2018-11-19 16:23:52',9,'Data dengan ID: 222'),
(11,'depletion_id','10','0','2018-11-19 16:23:52',9,'Data dengan ID: 222'),
(11,'dmale','2','0','2018-11-19 16:23:52',9,'Data dengan ID: 222'),
(11,'dfemale','1','0','2018-11-19 16:23:52',9,'Data dengan ID: 222'),
(11,'item_id','','0','2018-11-19 16:24:30',9,'Data dengan ID: 223'),
(11,'vendor_id','','0','2018-11-19 16:24:30',9,'Data dengan ID: 223'),
(11,'depletion_id','10','0','2018-11-19 16:24:30',9,'Data dengan ID: 223'),
(11,'dfemale','1','0','2018-11-19 16:24:30',9,'Data dengan ID: 223'),
(11,'item_id','','0','2018-11-19 16:24:43',9,'Data dengan ID: 222'),
(11,'vendor_id','','0','2018-11-19 16:24:43',9,'Data dengan ID: 222'),
(11,'dmale','0','2','2018-11-19 16:24:43',9,'Data dengan ID: 222'),
(11,'item_id','','0','2018-11-19 16:24:57',9,'Data dengan ID: 224'),
(11,'vendor_id','','0','2018-11-19 16:24:57',9,'Data dengan ID: 224'),
(11,'depletion_id','10','0','2018-11-19 16:24:57',9,'Data dengan ID: 224'),
(11,'dmale','1','0','2018-11-19 16:24:57',9,'Data dengan ID: 224'),
(11,'dfemale','2','0','2018-11-19 16:24:57',9,'Data dengan ID: 224'),
(1,'trans_time','05:30','05:30:00','2018-11-19 16:51:22',9,'Data dengan ID: 26'),
(1,'status','0','1','2018-11-26 10:46:27',9,'Data dengan ID: 27'),
(3,'description','Sagalaherang 1','SAGALAHERANG 1','2018-11-28 09:34:30',13,'Data dengan ID: 19'),
(4,'description','House 1','Example','2018-11-28 10:52:22',9,'Data dengan ID: 59'),
(1,'trans_date','2017-09-15','2018-09-15','2018-11-28 11:15:58',9,'Data dengan ID: 29'),
(1,'trans_time','11:10','11:10:00','2018-11-28 11:15:58',9,'Data dengan ID: 29'),
(17,'date_set','2018-10-02','0000-00-00','2018-11-28 15:55:01',9,'Data dengan ID: 00002'),
(17,'total','20176','10126','2018-11-28 15:55:01',9,'Data dengan ID: 00002'),
(1,'status','1','0','2018-11-29 10:48:31',9,'Data dengan ID: 27'),
(1,'trans_date','2018-11-25','2018-11-26','2018-11-29 15:02:04',9,'Data dengan ID: 27'),
(1,'trans_time','10:39','10:39:00','2018-11-29 15:02:04',9,'Data dengan ID: 27'),
(1,'status','0','1','2018-11-29 15:02:08',9,'Data dengan ID: 27'),
(17,'qty','252','370','2018-12-07 09:10:35',9,'Data dengan ID: 00025'),
(17,'total','340','458','2018-12-07 09:10:35',9,'Data dengan ID: 00025'),
(17,'qty','370','252','2018-12-07 09:12:10',9,'Data dengan ID: 00025'),
(17,'total','458','340','2018-12-07 09:12:10',9,'Data dengan ID: 00025'),
(3,'description','Purwakarta Breeder Farm 1','Purwakarta Farm 1','2018-12-14 16:25:56',13,'Data dengan ID: 17'),
(3,'description','Purwakarta Breeder Farm 2','Purwakarta Farm 2','2018-12-14 16:38:28',13,'Data dengan ID: 18'),
(7,'employee_name','IT Breeder','Dede Juniawan','2018-12-17 08:56:10',13,'Data dengan ID: 14'),
(7,'telp','0811','081222333444','2018-12-17 08:56:10',13,'Data dengan ID: 14'),
(7,'email','a@a','dede@mail.com','2018-12-17 08:56:10',13,'Data dengan ID: 14'),
(8,'u_weight','50','50000','2018-12-17 10:10:19',13,'Data dengan ID: 4'),
(1,'trans_date','2018-12-19','2018-12-18','2018-12-18 13:47:46',15,'Data dengan ID: 1'),
(1,'trans_time','01:40','01:40:00','2018-12-18 13:47:46',15,'Data dengan ID: 1'),
(1,'fexsho','-100','-50','2018-12-18 13:47:46',15,'Data dengan ID: 1'),
(1,'mexsho','-50','-100','2018-12-18 13:47:46',15,'Data dengan ID: 1'),
(1,'strain_id','8','7','2018-12-24 09:29:37',15,'Data dengan ID: 6'),
(1,'trans_date','2018-01-26','2018-01-21','2018-12-24 09:29:37',15,'Data dengan ID: 6'),
(1,'trans_time','06:00','06:00:00','2018-12-24 09:29:37',15,'Data dengan ID: 6'),
(1,'strain_id','8','7','2018-12-24 09:33:23',15,'Data dengan ID: 7'),
(1,'trans_time','05:30','05:30:00','2018-12-24 09:33:23',15,'Data dengan ID: 7'),
(1,'morder','960','959','2018-12-24 09:33:23',15,'Data dengan ID: 7'),
(1,'mexsho','0','1','2018-12-24 09:33:23',15,'Data dengan ID: 7'),
(1,'strain_id','8','7','2018-12-24 09:34:46',15,'Data dengan ID: 8'),
(1,'trans_time','06:30','06:30:00','2018-12-24 09:34:46',15,'Data dengan ID: 8'),
(1,'strain_id','3','11','2018-12-24 09:59:00',15,'Data dengan ID: 11'),
(1,'trans_time','06:00','06:00:00','2018-12-24 09:59:00',15,'Data dengan ID: 11'),
(1,'strain_id','3','11','2018-12-24 09:59:59',15,'Data dengan ID: 12'),
(1,'trans_time','05:30','05:30:00','2018-12-24 09:59:59',15,'Data dengan ID: 12'),
(14,'status','0','1','2019-01-07 14:36:38',13,'Data dengan ID: 9'),
(1,'status','0','1','2019-01-26 14:20:15',16,'Data dengan ID: 26'),
(1,'status','0','1','2019-01-26 14:23:28',16,'Data dengan ID: 27'),
(1,'status','0','1','2019-01-26 14:26:17',16,'Data dengan ID: 28'),
(1,'status','0','1','2019-01-26 14:32:45',16,'Data dengan ID: 29'),
(1,'status','0','1','2019-01-26 14:36:30',16,'Data dengan ID: 31'),
(1,'status','0','1','2019-01-26 14:36:36',16,'Data dengan ID: 30'),
(1,'status','0','1','2019-01-26 14:39:02',16,'Data dengan ID: 32'),
(1,'status','0','1','2019-01-26 14:45:14',16,'Data dengan ID: 34'),
(1,'status','0','1','2019-01-26 14:45:18',16,'Data dengan ID: 33'),
(1,'status','0','1','2019-01-26 14:53:32',16,'Data dengan ID: 35'),
(1,'status','0','1','2019-01-26 14:56:10',16,'Data dengan ID: 36'),
(1,'status','0','1','2019-01-26 15:15:38',16,'Data dengan ID: 37'),
(1,'status','0','1','2019-01-26 15:20:46',16,'Data dengan ID: 39'),
(1,'status','0','1','2019-01-26 15:24:55',16,'Data dengan ID: 40'),
(1,'status','0','1','2019-01-26 15:24:58',16,'Data dengan ID: 38'),
(1,'status','0','1','2019-01-26 15:28:51',16,'Data dengan ID: 41'),
(1,'status','0','1','2019-01-26 15:30:56',16,'Data dengan ID: 42'),
(1,'status','0','1','2019-01-26 15:32:38',16,'Data dengan ID: 43'),
(1,'status','1','0','2019-01-26 15:36:32',16,'Data dengan ID: 26'),
(1,'status','1','0','2019-01-26 15:36:39',16,'Data dengan ID: 27'),
(1,'status','1','0','2019-01-26 15:36:43',16,'Data dengan ID: 28'),
(1,'status','1','0','2019-01-26 15:36:47',16,'Data dengan ID: 29'),
(1,'status','1','0','2019-01-26 15:36:51',16,'Data dengan ID: 30'),
(1,'status','1','0','2019-01-26 15:36:55',16,'Data dengan ID: 31'),
(1,'status','1','0','2019-01-26 15:36:59',16,'Data dengan ID: 32'),
(1,'status','1','0','2019-01-26 15:37:03',16,'Data dengan ID: 33'),
(1,'status','1','0','2019-01-26 15:37:06',16,'Data dengan ID: 34'),
(1,'status','1','0','2019-01-26 15:37:09',16,'Data dengan ID: 35'),
(1,'status','1','0','2019-01-26 15:37:14',16,'Data dengan ID: 36'),
(1,'status','1','0','2019-01-26 15:37:17',16,'Data dengan ID: 37'),
(1,'status','1','0','2019-01-26 15:37:19',16,'Data dengan ID: 38'),
(1,'status','1','0','2019-01-26 15:37:25',16,'Data dengan ID: 39'),
(1,'status','1','0','2019-01-26 15:37:28',16,'Data dengan ID: 40'),
(1,'status','1','0','2019-01-26 15:37:31',16,'Data dengan ID: 41'),
(1,'status','1','0','2019-01-26 15:37:35',16,'Data dengan ID: 42'),
(1,'status','1','0','2019-01-26 15:37:38',16,'Data dengan ID: 43'),
(22,'alias','11','1','2019-04-23 16:55:39',13,'Data dengan ID: 193'),
(22,'desc1','1121dada','1','2019-04-23 16:55:39',13,'Data dengan ID: 193'),
(22,'desc2','1ada','1','2019-04-23 16:55:39',13,'Data dengan ID: 193'),
(22,'update_by','13',NULL,'2019-04-23 16:55:39',13,'Data dengan ID: 193'),
(22,'update_date','2019-04-23',NULL,'2019-04-23 16:55:39',13,'Data dengan ID: 193'),
(22,'icode','','1','2019-04-23 16:56:54',13,'Data dengan ID: 193'),
(22,'desc1','1121DADAXZXZ','1121dada','2019-04-23 16:56:54',13,'Data dengan ID: 193'),
(22,'desc2','1ADAZXZ','1ada','2019-04-23 16:56:54',13,'Data dengan ID: 193');

/*Table structure for table `_module` */

DROP TABLE IF EXISTS `_module`;

CREATE TABLE `_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `_module` */

insert  into `_module`(`id`,`module_name`,`alias`,`note`) values 
(1,'chickin','Chickin','Form untuk data chickin'),
(2,'company','Company','Form untuk master company'),
(3,'farm','Farm','Form untuk master farm'),
(4,'house','House','Form untuk master house'),
(5,'strain','Strain','Form untuk master strain'),
(6,'vendor','Vendor','Form untuk master vendor'),
(7,'employee','Employee','Form untuk master employee'),
(8,'item','Item','Form untuk master item'),
(9,'depletion','Depletion','Form untuk master depletion'),
(10,'production_type','Production Type','Form untuk master production type'),
(11,'daily','Daily','Form untuk data daily'),
(12,'hatchery','Hatcery','Form untuk master hatchery'),
(13,'egg','Egg','Form untuk master egg'),
(14,'ecn','ECN','Form untuk data ECN'),
(15,'user','User','Form untuk data user'),
(16,'otoritas','Otoritas','Form untuk manage otoritas user'),
(17,'asr','ASR','Form untuk data ASR'),
(18,'category','Category','Form untuk master category'),
(19,'source','Source','Form untuk master source'),
(20,'weekly_growing','Weekly Growing','Report weekly growing'),
(21,'weekly_laying','Weekly Laying','Report weekly laying'),
(22,'item_pur','Item Purchasing','Form untuk itemast'),
(23,'category_pur','category Purchasing','Form untuk catmast');

/*Table structure for table `_module_functional` */

DROP TABLE IF EXISTS `_module_functional`;

CREATE TABLE `_module_functional` (
  `module_id` int(11) NOT NULL,
  `functional_id` int(11) NOT NULL,
  KEY `modul_id` (`module_id`),
  KEY `functional_id` (`functional_id`),
  CONSTRAINT `_module_functional_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `_module` (`id`),
  CONSTRAINT `_module_functional_ibfk_2` FOREIGN KEY (`functional_id`) REFERENCES `_functional` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_module_functional` */

insert  into `_module_functional`(`module_id`,`functional_id`) values 
(1,6),
(1,7),
(1,8),
(1,9),
(2,6),
(2,7),
(2,8),
(2,9),
(3,6),
(3,7),
(3,8),
(3,9),
(4,6),
(4,7),
(4,8),
(4,9),
(5,6),
(5,7),
(5,8),
(5,9),
(6,7),
(6,6),
(6,8),
(6,9),
(7,6),
(7,7),
(7,8),
(7,9),
(8,6),
(8,7),
(8,8),
(8,9),
(9,6),
(9,7),
(9,8),
(9,9),
(10,6),
(10,7),
(10,8),
(10,9),
(1,10),
(11,6),
(11,7),
(11,8),
(2,11),
(2,12),
(3,11),
(3,12),
(4,11),
(4,12),
(5,11),
(5,12),
(6,11),
(6,12),
(7,11),
(7,12),
(8,11),
(8,12),
(9,11),
(9,12),
(10,11),
(10,12),
(12,6),
(12,7),
(12,8),
(12,9),
(12,11),
(12,12),
(13,6),
(13,7),
(13,8),
(13,9),
(13,11),
(13,12),
(14,6),
(14,7),
(14,8),
(14,9),
(1,13),
(17,6),
(17,7),
(17,8),
(17,9),
(18,6),
(18,7),
(18,8),
(18,9),
(18,11),
(18,12),
(19,6),
(19,7),
(19,8),
(19,9),
(19,11),
(19,12),
(1,14),
(20,15),
(14,13),
(21,15),
(20,9),
(21,9),
(11,9),
(11,14),
(14,14),
(17,14),
(22,6),
(22,7),
(22,8),
(22,9),
(23,6),
(23,7),
(23,8),
(23,9);

/*Table structure for table `keys` */

DROP TABLE IF EXISTS `keys`;

CREATE TABLE `keys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(11) NOT NULL,
  `ignore_limits` tinyint(4) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(4) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `keys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `master_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `keys` */

insert  into `keys`(`id`,`user_id`,`key`,`level`,`ignore_limits`,`is_private_key`,`ip_addresses`,`date_created`) values 
(1,NULL,'@test123',10,0,0,NULL,'2019-07-02 11:40:07');

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `api_key` varchar(40) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(10) NOT NULL,
  `params` text,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `logs` */

/*Table structure for table `master_area` */

DROP TABLE IF EXISTS `master_area`;

CREATE TABLE `master_area` (
  `area_code` varchar(10) NOT NULL,
  `company_code` varchar(3) DEFAULT NULL,
  `area_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`area_code`),
  KEY `company_code` (`company_code`),
  CONSTRAINT `master_area_ibfk_1` FOREIGN KEY (`company_code`) REFERENCES `master_company` (`company_code`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_area` */

insert  into `master_area`(`area_code`,`company_code`,`area_name`) values 
('CKR','MFD','MFD Cikarang');

/*Table structure for table `master_company` */

DROP TABLE IF EXISTS `master_company`;

CREATE TABLE `master_company` (
  `company_code` varchar(3) NOT NULL,
  `company_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`company_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_company` */

insert  into `master_company`(`company_code`,`company_name`) values 
('MFD','MALINDO FOOD DELIGHT');

/*Table structure for table `master_cost_center` */

DROP TABLE IF EXISTS `master_cost_center`;

CREATE TABLE `master_cost_center` (
  `cost_center_code` varchar(3) NOT NULL,
  `dept_code` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`cost_center_code`),
  KEY `dept_code` (`dept_code`),
  CONSTRAINT `master_cost_center_ibfk_1` FOREIGN KEY (`dept_code`) REFERENCES `master_department` (`dept_code`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_cost_center` */

insert  into `master_cost_center`(`cost_center_code`,`dept_code`) values 
('COS','ACC');

/*Table structure for table `master_department` */

DROP TABLE IF EXISTS `master_department`;

CREATE TABLE `master_department` (
  `dept_code` varchar(3) NOT NULL,
  `dept_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`dept_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_department` */

insert  into `master_department`(`dept_code`,`dept_name`) values 
('ACC','Accounting');

/*Table structure for table `master_me_group` */

DROP TABLE IF EXISTS `master_me_group`;

CREATE TABLE `master_me_group` (
  `me_group_code` varchar(2) NOT NULL,
  `me_group_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`me_group_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_me_group` */

/*Table structure for table `master_me_type` */

DROP TABLE IF EXISTS `master_me_type`;

CREATE TABLE `master_me_type` (
  `me_code` varchar(4) NOT NULL,
  `me_name` varchar(20) DEFAULT NULL,
  `me_criteria` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`me_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_me_type` */

insert  into `master_me_type`(`me_code`,`me_name`,`me_criteria`) values 
('ME-C','me name test','Cr');

/*Table structure for table `master_rekening_bank` */

DROP TABLE IF EXISTS `master_rekening_bank`;

CREATE TABLE `master_rekening_bank` (
  `rek_no` varchar(30) NOT NULL,
  `bank` varchar(30) DEFAULT NULL,
  `rek_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rek_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_rekening_bank` */

insert  into `master_rekening_bank`(`rek_no`,`bank`,`rek_name`) values 
('1234','BCA','Test');

/*Table structure for table `master_supplier` */

DROP TABLE IF EXISTS `master_supplier`;

CREATE TABLE `master_supplier` (
  `supp_code` varchar(8) NOT NULL,
  `supp_name` varchar(30) DEFAULT NULL,
  `rek_no` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`supp_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_supplier` */

/*Table structure for table `master_user` */

DROP TABLE IF EXISTS `master_user`;

CREATE TABLE `master_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_code` varchar(3) DEFAULT NULL,
  `area_code` varchar(3) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `worker_code` varchar(8) DEFAULT NULL,
  `division` varchar(3) DEFAULT NULL,
  `customer` varchar(10) DEFAULT NULL,
  `customer_group` varchar(5) DEFAULT NULL,
  `wh` varchar(5) DEFAULT NULL,
  `position` varchar(10) DEFAULT NULL,
  `rek_no` varchar(30) DEFAULT NULL,
  `veh_no` varchar(10) DEFAULT NULL,
  `cookie` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `image` varchar(100) DEFAULT 'assets/malindo/img/user/default.png',
  `insert_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NULL DEFAULT NULL,
  `insert_by` int(11) DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dept_code` (`dept_code`),
  KEY `area_code` (`area_code`),
  KEY `rek_no` (`rek_no`),
  KEY `veh_no` (`veh_no`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `master_user_ibfk_1` FOREIGN KEY (`dept_code`) REFERENCES `master_department` (`dept_code`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_2` FOREIGN KEY (`area_code`) REFERENCES `master_area` (`area_code`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_4` FOREIGN KEY (`rek_no`) REFERENCES `master_rekening_bank` (`rek_no`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_5` FOREIGN KEY (`veh_no`) REFERENCES `master_vehicle` (`veh_no`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_6` FOREIGN KEY (`group_id`) REFERENCES `_group` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `master_user` */

insert  into `master_user`(`id`,`dept_code`,`area_code`,`group_id`,`username`,`password`,`worker_code`,`division`,`customer`,`customer_group`,`wh`,`position`,`rek_no`,`veh_no`,`cookie`,`status`,`image`,`insert_date`,`modify_date`,`insert_by`,`modify_by`) values 
(1,'ACC','CKR',1,'test','$2a$08$YcgKKVQ2EiwBq4Z9WtmqUuudCeB7V3d26yx8SdGNcglqLdLd8vB1G','Worker c','Div','customer t','Custo','Wh te','Staff','1234','A 1234 B',NULL,1,'assets/malindo/img/user/default.png','2019-07-04 13:18:17',NULL,NULL,NULL),
(4,'ACC','CKR',8,'admin','$2a$08$hQ0jVjF9agRRVe2oU/ZQrefidXNocczA4g3spSjQPLl4p4dnbAjmm','1234','123','1234','1234','1234','1234','1234','A 1234 B',NULL,1,'assets/malindo/img/user/default.png','2019-07-05 13:36:33',NULL,1,NULL);

/*Table structure for table `master_vehicle` */

DROP TABLE IF EXISTS `master_vehicle`;

CREATE TABLE `master_vehicle` (
  `veh_no` varchar(10) NOT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`veh_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_vehicle` */

insert  into `master_vehicle`(`veh_no`,`jenis`) values 
('A 1234 B','Mini Bus'),
('A1234 B','Truck');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migrations` */

insert  into `migrations`(`version`) values 
(2);

/*Table structure for table `monthly_expense` */

DROP TABLE IF EXISTS `monthly_expense`;

CREATE TABLE `monthly_expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `month` date DEFAULT NULL,
  `sum` decimal(16,2) DEFAULT NULL,
  `post` tinyint(1) DEFAULT NULL,
  `import` tinyint(1) DEFAULT '0',
  `ax_journal_num` varchar(20) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` int(11) DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `monthly_expense_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `master_user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `monthly_expense` */

insert  into `monthly_expense`(`id`,`user_id`,`month`,`sum`,`post`,`import`,`ax_journal_num`,`insert_date`,`insert_by`,`modify_date`,`modify_by`) values 
(1,1,'2019-07-02',300000.00,0,1,'1000','2019-07-02 15:31:15',NULL,'2019-07-10 09:59:29',1),
(11,1,'1970-01-01',200000.00,0,0,NULL,'2019-07-08 15:25:17',1,'2019-07-08 15:25:17',NULL),
(12,1,'1970-01-01',200000.00,0,0,NULL,'2019-07-08 15:26:27',1,'2019-07-08 15:26:27',NULL),
(13,1,'2019-07-08',200000.00,0,0,NULL,'2019-07-08 15:29:26',1,'2019-07-11 11:13:06',1),
(14,1,'2019-07-08',200000.00,1,0,NULL,'2019-07-08 15:30:34',1,'2019-07-08 15:30:34',NULL),
(15,1,'2019-07-08',200000.00,0,0,NULL,'2019-07-08 15:46:40',1,'2019-07-08 15:46:40',NULL),
(16,1,'2019-07-08',200000.00,0,0,NULL,'2019-07-08 15:51:16',1,'2019-07-08 15:51:16',NULL),
(17,1,'2019-07-08',200000.00,0,0,NULL,'2019-07-08 16:00:18',1,'2019-07-08 16:00:18',NULL),
(18,1,'2019-07-08',200000.00,0,0,NULL,'2019-07-08 16:01:51',1,'2019-07-08 16:01:51',NULL),
(20,1,'2019-07-08',200000.00,0,0,NULL,'2019-07-08 16:07:24',1,'2019-07-10 11:16:01',1),
(21,1,'2019-07-09',600000.00,0,0,NULL,'2019-07-09 11:40:27',1,'2019-07-09 14:24:44',1);

/*Table structure for table `monthly_expense_detail` */

DROP TABLE IF EXISTS `monthly_expense_detail`;

CREATE TABLE `monthly_expense_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `me_code` varchar(4) DEFAULT NULL,
  `me_id` int(11) DEFAULT NULL,
  `trans_date` date DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  `km_begin` int(11) DEFAULT NULL,
  `km_end` int(11) DEFAULT NULL,
  `liter` decimal(5,2) DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `remark` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `me_id` (`me_id`),
  KEY `me_code` (`me_code`),
  CONSTRAINT `monthly_expense_detail_ibfk_1` FOREIGN KEY (`me_id`) REFERENCES `monthly_expense` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `monthly_expense_detail_ibfk_3` FOREIGN KEY (`me_code`) REFERENCES `master_me_type` (`me_code`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Data for the table `monthly_expense_detail` */

insert  into `monthly_expense_detail`(`id`,`me_code`,`me_id`,`trans_date`,`description`,`km_begin`,`km_end`,`liter`,`amount`,`remark`) values 
(10,'ME-C',11,'1970-01-01','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(11,'ME-C',12,'1970-01-01','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(13,'ME-C',14,'2019-07-07','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(14,'ME-C',15,'2019-07-08','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(15,'ME-C',16,'2019-07-08','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(16,'ME-C',17,'2019-07-08','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(17,'ME-C',18,'2019-07-08','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(22,'ME-C',NULL,'2019-07-09','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(23,'ME-C',NULL,'2019-07-09','Test 2 update',2400,3000,50.00,400000.00,'Ket 2 update'),
(24,'ME-C',NULL,'2019-07-09','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(25,'ME-C',NULL,'2019-07-09','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(29,'ME-C',21,'2019-07-09','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(30,'ME-C',21,'2019-07-08','Test 2',2400,3000,50.00,400000.00,'Ket 2'),
(36,'ME-C',1,'2019-07-02','Desc test',0,100,30.00,300000.00,'Remark test'),
(37,'ME-C',20,'2019-07-08','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(38,'ME-C',13,'2019-07-08','Test 1',2000,2400,50.00,200000.00,'Ket 1');

/*Table structure for table `monthly_expense_file` */

DROP TABLE IF EXISTS `monthly_expense_file`;

CREATE TABLE `monthly_expense_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `me_id` int(11) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `monthly_expense_file_ibfk_1` (`me_id`),
  CONSTRAINT `monthly_expense_file_ibfk_1` FOREIGN KEY (`me_id`) REFERENCES `monthly_expense` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `monthly_expense_file` */

insert  into `monthly_expense_file`(`id`,`me_id`,`file`) values 
(1,1,'./uploads/monthly-expense/c4ca4238a0b923820dcc509a6f75849b/78ee93b68ff32873fc5204de0c90e6a9.png');

/*Table structure for table `pc_type` */

DROP TABLE IF EXISTS `pc_type`;

CREATE TABLE `pc_type` (
  `pc_code` varchar(4) NOT NULL,
  `pc_name` varchar(20) DEFAULT NULL,
  `account_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pc_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pc_type` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

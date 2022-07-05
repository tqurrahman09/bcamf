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
  `export_excel` tinyint(1) NOT NULL DEFAULT '0',
  `post` tinyint(1) NOT NULL DEFAULT '0',
  `cancel` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  KEY `modul_id` (`module_id`),
  KEY `groups` (`group_id`),
  CONSTRAINT `_authority_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `_authority_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `_authority` */

insert  into `_authority`(`group_id`,`module_id`,`insert`,`update`,`delete`,`view`,`detail`,`print`,`export_excel`,`post`,`cancel`,`attachment`) values 
(2,3,0,0,0,1,0,0,0,0,0,0),
(2,4,0,0,0,1,0,0,0,0,0,0),
(2,5,0,0,0,1,0,0,0,0,0,0),
(2,6,0,0,0,1,0,0,0,0,0,0),
(2,7,1,1,1,1,0,1,0,1,1,1),
(2,8,1,1,1,1,0,1,0,1,1,1),
(2,9,1,1,1,1,0,1,0,1,1,1),
(3,7,1,1,1,1,0,1,0,1,1,1),
(3,8,1,1,1,1,0,1,0,1,1,1),
(3,9,1,1,1,1,0,1,0,1,1,1);

/*Table structure for table `_functional` */

DROP TABLE IF EXISTS `_functional`;

CREATE TABLE `_functional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `functional` varchar(30) NOT NULL,
  `note` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `_functional` */

insert  into `_functional`(`id`,`functional`,`note`) values 
(1,'insert',NULL),
(2,'update',NULL),
(3,'delete',NULL),
(4,'view',NULL),
(5,'export_excel',NULL),
(6,'print',NULL),
(7,'detail',NULL),
(8,'post',NULL),
(9,'attachment',NULL),
(10,'cancel',NULL);

/*Table structure for table `_group` */

DROP TABLE IF EXISTS `_group`;

CREATE TABLE `_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(30) NOT NULL,
  `is_accounting` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`group_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `_group` */

insert  into `_group`(`id`,`group_name`,`is_accounting`) values 
(1,'administrator',0),
(2,'accounting',1),
(3,'User',0);

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

/*Table structure for table `_module` */

DROP TABLE IF EXISTS `_module`;

CREATE TABLE `_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `_module` */

insert  into `_module`(`id`,`module_name`,`alias`,`note`) values 
(1,'user','User','Form untuk data user'),
(2,'otoritas','Otoritas','Form untuk manage otoritas user'),
(3,'company','Company','Form untuk data company'),
(4,'department','Department','Form untuk data department'),
(5,'rekening','Rekening','Form untuk data rekening'),
(6,'vehicle','Vehicle','Form untuk data vehicle'),
(7,'monthly_expense','Monthly Expense','Form untuk data monthly expense'),
(8,'memo_payment','Memo Payment','Form untuk data memo payment'),
(9,'petty_chash','Petty Chash','Form untuk data petty chash');

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
(3,1),
(3,2),
(3,3),
(3,4),
(3,5),
(3,6),
(3,7),
(4,1),
(4,2),
(4,3),
(4,4),
(4,5),
(4,6),
(4,7),
(5,1),
(5,2),
(5,3),
(5,4),
(5,5),
(5,6),
(5,7),
(6,1),
(6,2),
(6,3),
(6,4),
(6,5),
(6,6),
(6,7),
(7,1),
(7,2),
(7,3),
(7,4),
(7,6),
(7,8),
(7,9),
(7,10),
(8,1),
(8,2),
(8,3),
(8,4),
(8,6),
(8,8),
(8,9),
(8,10),
(9,1),
(9,2),
(9,3),
(9,4),
(9,6),
(9,8),
(9,9),
(9,10);

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
  `cost_center_code` varchar(10) NOT NULL,
  `description` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cost_center_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_cost_center` */

insert  into `master_cost_center`(`cost_center_code`,`description`) values 
('C001','Production'),
('C002','Admin'),
('C003','Marketing');

/*Table structure for table `master_customer` */

DROP TABLE IF EXISTS `master_customer`;

CREATE TABLE `master_customer` (
  `customer_id` varchar(10) NOT NULL,
  `customer_name` varchar(30) DEFAULT NULL,
  `customer_group` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_customer` */

insert  into `master_customer`(`customer_id`,`customer_name`,`customer_group`) values 
('CA000001','MFD','CG08');

/*Table structure for table `master_department` */

DROP TABLE IF EXISTS `master_department`;

CREATE TABLE `master_department` (
  `dept_code` varchar(10) NOT NULL,
  `dept_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`dept_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_department` */

insert  into `master_department`(`dept_code`,`dept_name`) values 
('ACC','Accounting'),
('D001','Production'),
('D002','Logistic'),
('D003','Depo');

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
('ME-C','Petrol','Pe'),
('ME-D','Maintanance','Ma'),
('ME-E','Food','Fo');

/*Table structure for table `master_pc_type` */

DROP TABLE IF EXISTS `master_pc_type`;

CREATE TABLE `master_pc_type` (
  `pc_code` varchar(4) NOT NULL,
  `pc_name` varchar(20) DEFAULT NULL,
  `account_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pc_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_pc_type` */

insert  into `master_pc_type`(`pc_code`,`pc_name`,`account_code`) values 
('PC-0','PC TEST','Account Test');

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
  `bank_name` varchar(30) DEFAULT NULL,
  `akun_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`supp_code`),
  UNIQUE KEY `rek_no` (`rek_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_supplier` */

insert  into `master_supplier`(`supp_code`,`supp_name`,`rek_no`,`bank_name`,`akun_name`) values 
('SUPP-001','Supplier 1','1234','BNI','Supplier 1');

/*Table structure for table `master_user` */

DROP TABLE IF EXISTS `master_user`;

CREATE TABLE `master_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_code` varchar(10) DEFAULT NULL,
  `area_code` varchar(3) DEFAULT NULL,
  `cost_center_code` varchar(10) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `worker_code` varchar(8) DEFAULT NULL,
  `division` varchar(3) DEFAULT NULL,
  `customer_id` varchar(10) DEFAULT NULL,
  `wh_code` varchar(10) DEFAULT NULL,
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
  KEY `area_code` (`area_code`),
  KEY `rek_no` (`rek_no`),
  KEY `veh_no` (`veh_no`),
  KEY `group_id` (`group_id`),
  KEY `dept_code` (`dept_code`),
  KEY `cost_center_code` (`cost_center_code`),
  KEY `worker_code` (`worker_code`),
  KEY `customer_id` (`customer_id`),
  KEY `wh_code` (`wh_code`),
  CONSTRAINT `master_user_ibfk_10` FOREIGN KEY (`customer_id`) REFERENCES `master_customer` (`customer_id`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_11` FOREIGN KEY (`wh_code`) REFERENCES `master_wh` (`wh_code`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_2` FOREIGN KEY (`area_code`) REFERENCES `master_area` (`area_code`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_4` FOREIGN KEY (`rek_no`) REFERENCES `master_rekening_bank` (`rek_no`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_5` FOREIGN KEY (`veh_no`) REFERENCES `master_vehicle` (`veh_no`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_6` FOREIGN KEY (`group_id`) REFERENCES `_group` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_7` FOREIGN KEY (`dept_code`) REFERENCES `master_department` (`dept_code`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_8` FOREIGN KEY (`cost_center_code`) REFERENCES `master_cost_center` (`cost_center_code`) ON UPDATE CASCADE,
  CONSTRAINT `master_user_ibfk_9` FOREIGN KEY (`worker_code`) REFERENCES `master_worker` (`worker_code`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `master_user` */

insert  into `master_user`(`id`,`dept_code`,`area_code`,`cost_center_code`,`group_id`,`username`,`password`,`worker_code`,`division`,`customer_id`,`wh_code`,`position`,`rek_no`,`veh_no`,`cookie`,`status`,`image`,`insert_date`,`modify_date`,`insert_by`,`modify_by`) values 
(1,'D001','CKR','C001',1,'admin','$2a$08$KsREUNpHWKSH7/BNGNIg5.WdavajNAbKvYOej8Lip1ip2pxmBFxhC','000001','01','CA000001','CKR-01','Staff','1234','A 1234 B',NULL,1,'assets/malindo/img/user/default.png','2019-07-04 13:18:17',NULL,NULL,NULL),
(4,'D002','CKR','C002',2,'accounting','$2a$08$YcgKKVQ2EiwBq4Z9WtmqUuudCeB7V3d26yx8SdGNcglqLdLd8vB1G','000002','01','CA000001','CKR-01','Staff','1234','A 1234 B',NULL,1,'assets/malindo/img/user/default.png','2019-07-05 13:36:33',NULL,1,NULL),
(5,'D001','CKR','C003',3,'user','$2a$08$YcgKKVQ2EiwBq4Z9WtmqUuudCeB7V3d26yx8SdGNcglqLdLd8vB1G','000002','01','CA000001','CKR-01','staff','1234','A 1234 B',NULL,1,'assets/malindo/img/user/default.png','2019-07-23 09:59:08',NULL,NULL,NULL);

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

/*Table structure for table `master_wh` */

DROP TABLE IF EXISTS `master_wh`;

CREATE TABLE `master_wh` (
  `wh_code` varchar(10) NOT NULL,
  `description` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`wh_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_wh` */

insert  into `master_wh`(`wh_code`,`description`) values 
('CKR-01','Cikarang');

/*Table structure for table `master_worker` */

DROP TABLE IF EXISTS `master_worker`;

CREATE TABLE `master_worker` (
  `worker_code` varchar(10) NOT NULL,
  `description` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`worker_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_worker` */

insert  into `master_worker`(`worker_code`,`description`) values 
('000001','Malindo'),
('000002','Andi Kusumo');

/*Table structure for table `memo_payment` */

DROP TABLE IF EXISTS `memo_payment`;

CREATE TABLE `memo_payment` (
  `no_ref` varchar(30) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `supp_code` varchar(8) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `to_dept` varchar(3) DEFAULT NULL,
  `subject` tinytext,
  `amount` decimal(16,2) DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `pay_desc` tinytext,
  `total_amount` decimal(16,2) DEFAULT NULL,
  `post` tinyint(1) DEFAULT '0',
  `import` tinyint(1) DEFAULT '0',
  `cancel` tinyint(1) DEFAULT '0',
  `journal_num_ax` varchar(20) DEFAULT NULL,
  `pph` decimal(10,0) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` time DEFAULT NULL,
  `insert_by` int(11) DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_ref`),
  KEY `user_id` (`user_id`),
  KEY `to_dept` (`to_dept`),
  KEY `supp_code` (`supp_code`),
  CONSTRAINT `memo_payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `master_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `memo_payment_ibfk_2` FOREIGN KEY (`to_dept`) REFERENCES `master_department` (`dept_code`) ON UPDATE CASCADE,
  CONSTRAINT `memo_payment_ibfk_3` FOREIGN KEY (`supp_code`) REFERENCES `master_supplier` (`supp_code`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `memo_payment` */

insert  into `memo_payment`(`no_ref`,`user_id`,`supp_code`,`date`,`to_dept`,`subject`,`amount`,`pay_date`,`pay_desc`,`total_amount`,`post`,`import`,`cancel`,`journal_num_ax`,`pph`,`insert_date`,`modify_date`,`insert_by`,`modify_by`) values 
('2/D001/07/19',1,'SUPP-001','2019-07-17','ACC','a',120000.00,'2019-07-17','a',NULL,0,0,0,'AXTEST01',2,'2019-07-17 15:45:11','16:02:38',1,4);

/*Table structure for table `memo_payment_file` */

DROP TABLE IF EXISTS `memo_payment_file`;

CREATE TABLE `memo_payment_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_ref` varchar(30) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `no_ref` (`no_ref`),
  CONSTRAINT `memo_payment_file_ibfk_1` FOREIGN KEY (`no_ref`) REFERENCES `memo_payment` (`no_ref`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `memo_payment_file` */

insert  into `memo_payment_file`(`id`,`no_ref`,`file`) values 
(1,'2/D001/07/19','./uploads/memo-payment/d84de3f33105f5364423aaef925c94bf/33c5c92ca5bda68f8cfa67e533c84feb.jpg');

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
  `cancel` tinyint(1) DEFAULT '0',
  `pph` decimal(10,0) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `insert_by` int(11) DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `monthly_expense_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `master_user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `monthly_expense` */

insert  into `monthly_expense`(`id`,`user_id`,`month`,`sum`,`post`,`import`,`ax_journal_num`,`cancel`,`pph`,`insert_date`,`insert_by`,`modify_date`,`modify_by`) values 
(12,1,'2019-07-23',300000.00,0,1,'AXTEST02',0,3,'2019-07-08 15:26:27',1,'2019-07-23 14:51:55',4);

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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

/*Data for the table `monthly_expense_detail` */

insert  into `monthly_expense_detail`(`id`,`me_code`,`me_id`,`trans_date`,`description`,`km_begin`,`km_end`,`liter`,`amount`,`remark`) values 
(57,'ME-C',12,'2019-07-23','Test 1',2000,2400,50.00,200000.00,'Ket 1'),
(58,'ME-D',12,'2019-07-23','Test 2',2400,3000,23.00,100000.00,'Ket 2'),
(59,'ME-E',12,'2019-07-23','Test 3',3000,3200,30.00,150000.00,'Ket 3'),
(60,'ME-C',12,'2019-07-24','Test 4',3200,3500,40.00,180000.00,'Ket 4');

/*Table structure for table `monthly_expense_file` */

DROP TABLE IF EXISTS `monthly_expense_file`;

CREATE TABLE `monthly_expense_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `me_id` int(11) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `monthly_expense_file_ibfk_1` (`me_id`),
  CONSTRAINT `monthly_expense_file_ibfk_1` FOREIGN KEY (`me_id`) REFERENCES `monthly_expense` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `monthly_expense_file` */

/*Table structure for table `petty_chash` */

DROP TABLE IF EXISTS `petty_chash`;

CREATE TABLE `petty_chash` (
  `pc_no` varchar(30) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `post` tinyint(1) DEFAULT '0',
  `import` tinyint(1) DEFAULT '0',
  `journal_ax_num` varchar(20) DEFAULT NULL,
  `cancel` tinyint(1) DEFAULT '0',
  `pph` decimal(10,0) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `insert_by` int(11) DEFAULT NULL,
  `modify_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`pc_no`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `petty_chash_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `master_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `petty_chash` */

insert  into `petty_chash`(`pc_no`,`user_id`,`date_from`,`date_to`,`amount`,`post`,`import`,`journal_ax_num`,`cancel`,`pph`,`insert_date`,`modify_date`,`insert_by`,`modify_by`) values 
('1/ACC/07/19',4,'2019-07-01','2019-08-31',200000.00,0,0,NULL,0,NULL,'2019-07-16 16:34:55','2019-07-23 16:37:48',4,4),
('2/ACC/07/19',4,'2019-07-16','2019-07-16',200000.00,0,0,'AXTEST03',1,4,'2019-07-16 16:39:15','2019-07-23 11:44:37',4,4);

/*Table structure for table `petty_chash_detail` */

DROP TABLE IF EXISTS `petty_chash_detail`;

CREATE TABLE `petty_chash_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pc_no` varchar(30) DEFAULT NULL,
  `bkk_no` varchar(20) DEFAULT NULL,
  `trans_date` date DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `pc_code` varchar(4) DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pc_no` (`pc_no`),
  CONSTRAINT `petty_chash_detail_ibfk_1` FOREIGN KEY (`pc_no`) REFERENCES `petty_chash` (`pc_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `petty_chash_detail` */

insert  into `petty_chash_detail`(`id`,`pc_no`,`bkk_no`,`trans_date`,`remark`,`pc_code`,`amount`) values 
(15,'2/ACC/07/19','asas','2019-07-23','asas','PC-0',200000.00),
(17,'1/ACC/07/19','asas','2019-07-23','asas','PC-0',200000.00);

/*Table structure for table `petty_chash_file` */

DROP TABLE IF EXISTS `petty_chash_file`;

CREATE TABLE `petty_chash_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pc_no` varchar(30) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pc_no` (`pc_no`),
  CONSTRAINT `petty_chash_file_ibfk_1` FOREIGN KEY (`pc_no`) REFERENCES `petty_chash` (`pc_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `petty_chash_file` */

/*Table structure for table `seq_memo_payment` */

DROP TABLE IF EXISTS `seq_memo_payment`;

CREATE TABLE `seq_memo_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `seq_memo_payment` */

insert  into `seq_memo_payment`(`id`) values 
(1),
(2);

/*Table structure for table `seq_petty_cash` */

DROP TABLE IF EXISTS `seq_petty_cash`;

CREATE TABLE `seq_petty_cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `seq_petty_cash` */

insert  into `seq_petty_cash`(`id`) values 
(1),
(2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

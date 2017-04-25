/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.9 : Database - l54
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`l54` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `l54`;

/*Table structure for table `li_admins` */

DROP TABLE IF EXISTS `li_admins`;

CREATE TABLE `li_admins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `section_id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `realname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lasttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_name_unique` (`name`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_admins` */

insert  into `li_admins`(`id`,`section_id`,`name`,`realname`,`email`,`password`,`remember_token`,`phone`,`lasttime`,`lastip`,`status`,`created_at`,`updated_at`) values (1,1,'admin','adminss','fsda@eee.com','eyJpdiI6Imh3enVSWE9cL09MYkhRRTJtTlBrWFFRPT0iLCJ2YWx1ZSI6InRjamFCTnpmT3VzVys0cmd3bkdwblE9PSIsIm1hYyI6IjM3Y2ZmMjlhNjVjODhhMWM0Njc4M2RlN2E2MGI3NGRjZjE1MGUzOTZlOGU3NWFmMGY3YTc4Mjc5Y2RiOTMyYWUifQ==','1o7hGhXUE4f6Gl7mDamfRJwzVUvWEW4jZjskzK7AMFRM1fcuk77VpfbcCXrQ','13123212345','2017-04-25 23:04:35','127.0.0.1',1,'2016-08-07 10:05:54','2017-04-17 13:41:46'),(2,1,'market','dddd','fsda@qq.com','eyJpdiI6IkxiRERmOTRhb2ZcL0hpb0JmS2hNN3pBPT0iLCJ2YWx1ZSI6IjNtdnNhaWVYMzF5cElqQ08xeWs0dVE9PSIsIm1hYyI6ImRjY2M0ZWFmNmRhYzcxNDg2ODUwNDE2YWRhNmRjOGI3NzA5NmEwNWQzNWE2YTAwMzQyODM1YWYxYjM5YzI1OTMifQ==','DYIZEeUGarGtADYvjxBzQuLCTfuvtpV83HuZ12oJAE1BMKqV7qSKZrlZm8Xz','','2017-04-25 23:11:09','192.168.1.162',1,'2016-12-15 09:46:33','2017-04-25 15:11:09');

/*Table structure for table `li_articles` */

DROP TABLE IF EXISTS `li_articles`;

CREATE TABLE `li_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `describe` text COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_articles` */

/*Table structure for table `li_attrs` */

DROP TABLE IF EXISTS `li_attrs`;

CREATE TABLE `li_attrs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_attrs` */

/*Table structure for table `li_categorys` */

DROP TABLE IF EXISTS `li_categorys`;

CREATE TABLE `li_categorys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(11) unsigned NOT NULL,
  `arrparentid` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `child` tinyint(4) NOT NULL,
  `arrchildid` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标题',
  `keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '关键字',
  `describe` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `theme` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'list' COMMENT '模板',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_categorys` */

/*Table structure for table `li_config` */

DROP TABLE IF EXISTS `li_config`;

CREATE TABLE `li_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sitename` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '站点名称',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'SEO标题',
  `keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '关键字',
  `describe` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '描述',
  `theme` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'default' COMMENT '主题',
  `person` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '联系人',
  `phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '联系电话',
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '地址',
  `content` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '介绍',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_config` */

insert  into `li_config`(`id`,`sitename`,`title`,`keyword`,`describe`,`theme`,`person`,`phone`,`email`,`address`,`content`,`created_at`,`updated_at`) values (1,'希夷CMS','希夷CMS',NULL,NULL,'default',NULL,NULL,NULL,NULL,NULL,NULL,'2017-04-25 15:08:31');

/*Table structure for table `li_logs` */

DROP TABLE IF EXISTS `li_logs`;

CREATE TABLE `li_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_logs` */

insert  into `li_logs`(`id`,`admin_id`,`user`,`url`,`created_at`) values (1,1,'admin','/admin/menu/add/5','2017-04-25 21:49:13'),(2,1,'admin','/admin/menu/edit/6','2017-04-25 21:49:24'),(3,1,'admin','/admin/menu/edit/151','2017-04-25 21:49:45'),(4,1,'admin','/admin/menu/edit/148','2017-04-25 21:50:02'),(5,1,'admin','/admin/menu/edit/67','2017-04-25 21:50:09'),(6,1,'admin','/admin/config/index','2017-04-25 21:58:45'),(7,1,'admin','/xycms/config/index','2017-04-25 15:07:35'),(8,1,'admin','/xycms/config/index','2017-04-25 15:08:31'),(9,1,'admin','/xycms/menu/edit/28','2017-04-25 15:08:49'),(10,1,'admin','/xycms/admin/pwd/2','2017-04-25 15:10:08'),(11,1,'admin','/xycms/admin/pwd/2','2017-04-25 15:10:21'),(12,1,'admin','/xycms/admin/pwd/2','2017-04-25 15:11:09');

/*Table structure for table `li_menus` */

DROP TABLE IF EXISTS `li_menus`;

CREATE TABLE `li_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL,
  `arrparentid` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `child` tinyint(1) NOT NULL DEFAULT '0',
  `arrchildid` mediumtext COLLATE utf8_unicode_ci,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `display` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_parentid_index` (`parentid`),
  KEY `menus_url_index` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_menus` */

insert  into `li_menus`(`id`,`parentid`,`arrparentid`,`child`,`arrchildid`,`name`,`url`,`label`,`display`,`listorder`,`created_at`,`updated_at`) values (1,0,'0',1,'1,5,6,7,8,9,67,68,74,148,149,150,151,152,153,154,174,10,11,12,13,14,15,16,17,18,19,140,170,171,172,173,20,21,143,144,145','系统','index/index','index-index',1,0,'2016-03-18 15:46:02','2017-04-25 21:49:13'),(2,0,'0',1,'2,22,23,24,25,26,27,28,29,75,30,31,32,33,34,121,136','内容','content/index','content-index',1,0,'2016-03-18 15:46:21','2016-12-14 10:15:49'),(5,1,'0,1',1,'5,6,7,8,9,67,68,74,148,149,150,151,152,153,154,174','系统设置','sys/index','sys-index',1,0,'2016-03-18 15:47:40','2017-04-25 21:49:13'),(6,5,'0,1,5',1,'6,7,8,9','菜单管理','menu/index','menu-index',1,1,'2016-03-18 15:48:07','2017-04-25 21:49:25'),(7,6,'0,1,5,6',0,'7','添加菜单','menu/add','menu-add',1,0,'2016-03-18 15:49:03','2016-03-23 08:25:50'),(8,6,'0,1,5,6',0,'8','修改菜单','menu/edit','menu-edit',0,0,'2016-03-18 15:51:08','2016-03-23 14:23:43'),(9,6,'0,1,5,6',0,'9','删除菜单','menu/del','menu-del',0,0,'2016-03-18 15:51:30','2016-03-23 08:25:50'),(10,1,'0,1',1,'10,11,12,13,14,15,16,17,18,19,140,170,171,172,173','用户中心','admin/manage','admin-manage',1,0,'2016-03-18 16:04:01','2016-12-15 08:32:44'),(11,10,'0,1,10',1,'11,12,13,14,15','用户管理','admin/index','admin-index',1,0,'2016-03-18 16:04:38','2016-03-24 11:31:08'),(12,11,'0,1,10,11',0,'12','添加用户','admin/add','admin-add',1,0,'2016-03-18 16:05:14','2016-03-24 11:31:16'),(13,11,'0,1,10,11',0,'13','修改用户','admin/edit','admin-edit',0,0,'2016-03-18 16:06:10','2016-03-24 11:31:24'),(14,11,'0,1,10,11',0,'14','删除用户','admin/del','admin-del',0,0,'2016-03-18 16:06:31','2016-03-24 11:31:32'),(15,11,'0,1,10,11',0,'15','修改密码','admin/pwd','admin-pwd',0,0,'2016-03-18 16:07:07','2016-03-24 11:31:44'),(16,10,'0,1,10',1,'16,17,18,19,140','角色管理','role/index','role-index',1,0,'2016-03-18 16:07:58','2016-12-02 09:41:15'),(17,16,'0,1,10,16',0,'17','添加角色','role/add','role-add',1,0,'2016-03-18 16:08:23','2016-03-23 08:25:50'),(18,16,'0,1,10,16',0,'18','修改角色','role/edit','role-edit',0,0,'2016-03-18 16:08:50','2016-03-23 08:25:50'),(19,16,'0,1,10,16',0,'19','删除角色','role/del','role-del',0,0,'2016-03-18 16:09:10','2016-03-23 08:25:50'),(20,1,'0,1',1,'20,21','系统信息','index/main','index-main',0,0,'2016-03-24 15:42:14','2016-03-25 10:34:44'),(21,20,'0,1,20',0,'21','左侧菜单','index/left','index-left',0,0,'2016-03-25 10:34:44','2016-03-25 10:35:27'),(22,2,'0,2',1,'22,23,24,25,26,27,28,29,75,30,31,32,33,34,121,136','内容管理','content/manage','content-manage',1,0,'2016-03-29 08:39:52','2016-12-02 09:44:29'),(23,22,'0,2,22',1,'23,24,25,26,27','栏目管理','cate/index','cate-index',1,0,'2016-03-29 08:40:08','2016-03-29 08:41:30'),(24,23,'0,2,22,23',0,'24','添加栏目','cate/add','cate-add',1,0,'2016-03-29 08:40:25','2016-03-29 08:40:25'),(25,23,'0,2,22,23',0,'25','修改栏目','cate/edit','cate-edit',0,0,'2016-03-29 08:40:42','2016-03-29 08:41:00'),(26,23,'0,2,22,23',0,'26','删除栏目','cate/del','cate-del',0,0,'2016-03-29 08:40:54','2016-03-29 08:41:07'),(27,23,'0,2,22,23',0,'27','更新栏目缓存','cate/cache','cate-cache',0,0,'2016-03-29 08:41:30','2016-03-29 08:41:30'),(28,22,'0,2,22',1,'28,29,75','附件管理','attr/index','attr-index',0,5,'2016-03-31 08:23:28','2017-04-25 15:08:49'),(29,28,'0,2,22,28',0,'29','上传图片','attr/uploadimg','attr-uploadimg',0,0,'2016-03-31 08:24:45','2016-06-14 19:12:33'),(30,22,'0,2,22',1,'30,31,32,33,34,121,136','文章管理','art/index','art-index',1,0,'2016-03-31 08:25:22','2016-12-02 09:44:16'),(31,30,'0,2,22,30',0,'31','添加文章','art/add','art-add',1,0,'2016-03-31 08:25:40','2016-07-23 17:39:54'),(32,30,'0,2,22,30',0,'32','修改文章','art/edit','art-edit',0,0,'2016-03-31 08:25:59','2016-03-31 08:25:59'),(33,30,'0,2,22,30',0,'33','删除文章','art/del','art-del',0,0,'2016-03-31 08:26:15','2016-03-31 08:26:15'),(34,30,'0,2,22,30',0,'34','查看文章','art/show','art-show',0,0,'2016-03-31 08:26:35','2016-03-31 08:26:36'),(67,5,'0,1,5',1,'67,68','操作日志','log/index','log-index',1,4,'2016-04-11 10:38:34','2017-04-25 21:50:09'),(68,67,'0,1,5,67',0,'68','清除7天前日志','log/del','log-del',0,0,'2016-04-11 10:38:53','2016-05-11 17:37:46'),(74,5,'0,1,5',0,'74','更新缓存','index/cache','index-cache',1,5,'2016-04-11 16:00:30','2016-05-15 08:25:53'),(75,28,'0,2,22,28',0,'75','删除附件','attr/delfile','attr-delfile',0,0,'2016-05-09 19:29:09','2016-05-09 19:29:09'),(121,30,'0,2,22,30',0,'121','批量删除','art/alldel','art-alldel',0,0,'2016-06-15 08:52:32','2016-06-15 08:52:32'),(136,30,'0,2,22,30',0,'136','批量排序','art/listorder','art-listorder',0,0,'2016-07-25 08:35:42','2016-07-25 08:35:42'),(140,16,'0,1,10,16',0,'140','角色权限','role/priv','role-priv',0,0,'2016-07-25 11:34:39','2016-07-25 11:34:40'),(143,1,'0,1',1,'143,144,145','个人信息','admin/info','admin-info',1,0,'2016-07-28 14:01:45','2016-07-28 14:02:37'),(144,143,'0,1,143',0,'144','修改个人资料','admin/myedit','admin-myedit',1,0,'2016-07-28 14:02:12','2016-07-28 14:02:12'),(145,143,'0,1,143',0,'145','修改个人密码','admin/mypwd','admin-mypwd',1,0,'2016-07-28 14:02:37','2016-07-28 14:02:37'),(148,5,'0,1,5',1,'148,149,150','数据管理','database/export','database-export',1,3,'2016-12-02 10:21:37','2017-04-25 21:50:02'),(149,148,'0,1,5,148',0,'149','恢复数据','database/import','database-import',0,0,'2016-12-02 10:22:16','2016-12-02 10:22:23'),(150,148,'0,1,5,148',0,'150','删除备份文件','database/delfile','database-delfile',0,0,'2016-12-02 10:22:47','2016-12-02 10:22:48'),(151,5,'0,1,5',1,'151,152,153,154','分类管理','type/index','type-index',1,2,'2016-12-14 09:56:01','2017-04-25 21:49:45'),(152,151,'0,1,5,151',0,'152','添加分类','type/add','type-add',1,0,'2016-12-14 09:56:23','2016-12-14 09:56:23'),(153,151,'0,1,5,151',0,'153','修改分类','type/edit','type-edit',0,0,'2016-12-14 09:56:42','2016-12-14 09:56:42'),(154,151,'0,1,5,151',0,'154','删除分类','type/del','type-del',0,0,'2016-12-14 09:56:57','2016-12-14 09:56:58'),(170,10,'0,1,10',1,'170,171,172,173','部门管理','section/index','section-index',1,0,'2016-12-15 08:31:39','2016-12-15 08:32:44'),(171,170,'0,1,10,170',0,'171','添加部门','section/add','section-add',1,0,'2016-12-15 08:32:01','2016-12-15 08:32:02'),(172,170,'0,1,10,170',0,'172','修改部门','section/edit','section-edit',0,0,'2016-12-15 08:32:23','2016-12-15 08:32:23'),(173,170,'0,1,10,170',0,'173','删除部门','section/del','section-del',0,0,'2016-12-15 08:32:44','2016-12-15 08:32:44'),(174,5,'0,1,5',0,'174','系统配置','config/index','config-index',1,0,'2017-04-25 21:49:13','2017-04-25 21:49:13');

/*Table structure for table `li_role_privs` */

DROP TABLE IF EXISTS `li_role_privs`;

CREATE TABLE `li_role_privs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_privs_roleid_index` (`role_id`),
  KEY `role_privs_url_index` (`url`),
  KEY `role_privs_label_index` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_role_privs` */

insert  into `li_role_privs`(`id`,`menu_id`,`role_id`,`url`,`label`,`created_at`,`updated_at`) values (1,1,2,'index/index','index-index','2016-08-07 10:05:38','2016-08-07 10:05:38'),(2,2,2,'content/index','content-index','2016-08-07 10:05:38','2016-08-07 10:05:38'),(3,5,2,'sys/index','sys-index','2016-08-07 10:05:38','2016-08-07 10:05:38'),(4,20,2,'index/main','index-main','2016-08-07 10:05:38','2016-08-07 10:05:38'),(5,21,2,'index/left','index-left','2016-08-07 10:05:38','2016-08-07 10:05:38'),(6,22,2,'content/manage','content-manage','2016-08-07 10:05:38','2016-08-07 10:05:38'),(7,23,2,'cate/index','cate-index','2016-08-07 10:05:38','2016-08-07 10:05:38'),(8,24,2,'cate/add','cate-add','2016-08-07 10:05:38','2016-08-07 10:05:38'),(9,25,2,'cate/edit','cate-edit','2016-08-07 10:05:38','2016-08-07 10:05:38'),(10,26,2,'cate/del','cate-del','2016-08-07 10:05:38','2016-08-07 10:05:38'),(11,27,2,'cate/cache','cate-cache','2016-08-07 10:05:38','2016-08-07 10:05:38'),(12,30,2,'art/index','art-index','2016-08-07 10:05:38','2016-08-07 10:05:38'),(13,31,2,'art/add','art-add','2016-08-07 10:05:38','2016-08-07 10:05:38'),(14,32,2,'art/edit','art-edit','2016-08-07 10:05:38','2016-08-07 10:05:38'),(15,33,2,'art/del','art-del','2016-08-07 10:05:38','2016-08-07 10:05:38'),(16,34,2,'art/show','art-show','2016-08-07 10:05:38','2016-08-07 10:05:38'),(17,74,2,'index/cache','index-cache','2016-08-07 10:05:38','2016-08-07 10:05:38'),(18,91,2,'type/index','type-index','2016-08-07 10:05:38','2016-08-07 10:05:38'),(19,92,2,'type/add','type-add','2016-08-07 10:05:38','2016-08-07 10:05:38'),(20,93,2,'type/edit','type-edit','2016-08-07 10:05:38','2016-08-07 10:05:38'),(21,94,2,'type/del','type-del','2016-08-07 10:05:38','2016-08-07 10:05:38'),(22,121,2,'art/alldel','art-alldel','2016-08-07 10:05:38','2016-08-07 10:05:38'),(23,122,2,'art/poslist','art-poslist','2016-08-07 10:05:38','2016-08-07 10:05:38'),(24,123,2,'add/status/0','add-status-0','2016-08-07 10:05:38','2016-08-07 10:05:38'),(25,124,2,'add/status/1','add-status-1','2016-08-07 10:05:38','2016-08-07 10:05:38'),(26,125,2,'add/status/2','add-status-2','2016-08-07 10:05:38','2016-08-07 10:05:38'),(27,126,2,'add/status/3','add-status-3','2016-08-07 10:05:38','2016-08-07 10:05:38'),(28,127,2,'edit/status/0','edit-status-0','2016-08-07 10:05:38','2016-08-07 10:05:38'),(29,128,2,'edit/status/1','edit-status-1','2016-08-07 10:05:38','2016-08-07 10:05:38'),(30,129,2,'edit/status/2','edit-status-2','2016-08-07 10:05:38','2016-08-07 10:05:38'),(31,130,2,'edit/status/3','edit-status-3','2016-08-07 10:05:38','2016-08-07 10:05:38'),(32,131,2,'all/status/0','all-status-0','2016-08-07 10:05:38','2016-08-07 10:05:38'),(33,132,2,'all/status/1','all-status-1','2016-08-07 10:05:38','2016-08-07 10:05:38'),(34,133,2,'all/status/2','all-status-2','2016-08-07 10:05:38','2016-08-07 10:05:38'),(35,134,2,'all/status/3','all-status-3','2016-08-07 10:05:38','2016-08-07 10:05:38'),(36,135,2,'art/priv','art-priv','2016-08-07 10:05:38','2016-08-07 10:05:38'),(37,136,2,'art/listorder','art-listorder','2016-08-07 10:05:38','2016-08-07 10:05:38'),(38,142,2,'art/poslistorder','art-poslistorder','2016-08-07 10:05:38','2016-08-07 10:05:38'),(39,143,2,'admin/info','admin-info','2016-08-07 10:05:38','2016-08-07 10:05:38'),(40,144,2,'admin/myedit','admin-myedit','2016-08-07 10:05:38','2016-08-07 10:05:38'),(41,145,2,'admin/mypwd','admin-mypwd','2016-08-07 10:05:38','2016-08-07 10:05:38');

/*Table structure for table `li_role_users` */

DROP TABLE IF EXISTS `li_role_users`;

CREATE TABLE `li_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_role_users` */

insert  into `li_role_users`(`role_id`,`user_id`) values (1,1),(2,2);

/*Table structure for table `li_roles` */

DROP TABLE IF EXISTS `li_roles`;

CREATE TABLE `li_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_roles` */

insert  into `li_roles`(`id`,`name`,`status`,`created_at`,`updated_at`) values (1,'超级管理员',1,'2016-03-18 16:42:51','2016-03-18 16:42:51'),(2,'编辑',1,'2016-08-07 10:05:54','2016-08-07 10:05:54');

/*Table structure for table `li_sections` */

DROP TABLE IF EXISTS `li_sections`;

CREATE TABLE `li_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_sections` */

insert  into `li_sections`(`id`,`name`,`status`,`created_at`,`updated_at`) values (1,'市场',1,'2016-12-15 08:43:05','2016-12-15 08:43:05');

/*Table structure for table `li_types` */

DROP TABLE IF EXISTS `li_types`;

CREATE TABLE `li_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(10) unsigned NOT NULL,
  `arrparentid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `child` tinyint(4) NOT NULL,
  `arrchildid` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_types` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

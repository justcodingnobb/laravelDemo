insert  into `li_menus`(`id`,`parentid`,`arrparentid`,`child`,`arrchildid`,`name`,`url`,`label`,`display`,`listorder`,`created_at`,`updated_at`) values (4,0,'0',1,'4,36,37,51,52,38,39,40,41,42,43,44,45,50,46,47,48,49','微信','wx/index','wx-index',1,10,'2016-03-18 15:46:50','2016-08-08 10:05:16'),(36,4,'0,4',1,'36,37,51,52,38,39,40,41,42,43,44,45,50,46,47,48,49','微信设置','wx/manage','wx-manage',1,0,'2016-04-05 08:51:41','2016-04-08 21:13:23'),(37,36,'0,4,36',1,'37,51,52','微信配置','wx/config','wx-config',1,0,'2016-04-05 08:52:10','2016-04-05 14:00:22'),(38,36,'0,4,36',1,'38,39,40,41','微信关联菜单','wxlinkage/index','wxlinkage-index',1,0,'2016-04-05 08:53:16','2016-04-07 22:23:19'),(39,38,'0,4,36,38',0,'39','添加关联菜单','wxlinkage/add','wxlinkage-add',1,0,'2016-04-05 08:54:01','2016-04-05 08:58:48'),(40,38,'0,4,36,38',0,'40','修改关联菜单','wxlinkage/edit','wxlinkage-edit',0,0,'2016-04-05 08:54:27','2016-04-05 08:58:57'),(41,38,'0,4,36,38',0,'41','删除关联菜单','wxlinkage/del','wxlinkage-del',0,0,'2016-04-05 08:54:55','2016-04-05 08:59:05'),(42,36,'0,4,36',1,'42,43,44,45,50','自定义菜单','wxmenu/index','wxmenu-index',1,0,'2016-04-05 08:57:27','2016-04-05 11:33:40'),(43,42,'0,4,36,42',0,'43','添加自定义菜单','wxmenu/add','wxmenu-add',1,0,'2016-04-05 08:57:50','2016-04-05 08:57:50'),(44,42,'0,4,36,42',0,'44','修改自定义菜单','wxmenu/edit','wxmenu-edit',0,0,'2016-04-05 08:58:12','2016-04-05 08:58:12'),(45,42,'0,4,36,42',0,'45','删除自定义菜单','wxmenu/del','wxmenu-del',0,0,'2016-04-05 08:58:31','2016-04-05 08:58:31'),(46,36,'0,4,36',1,'46,47,48,49','自动回复','wxmsg/index','wxmsg-index',1,0,'2016-04-05 09:03:49','2016-04-05 09:05:07'),(47,46,'0,4,36,46',0,'47','添加回复','wxmsg/add','wxmsg-add',1,0,'2016-04-05 09:04:21','2016-04-05 09:04:21'),(48,46,'0,4,36,46',0,'48','修改回复','wxmsg/edit','wxmsg-edit',0,0,'2016-04-05 09:04:45','2016-04-05 09:04:45'),(49,46,'0,4,36,46',0,'49','删除回复','wxmsg/del','wxmsg-del',0,0,'2016-04-05 09:05:07','2016-04-05 09:05:07'),(50,42,'0,4,36,42',0,'50','刷新菜单','wxmenu/update','wxmenu-update',0,0,'2016-04-05 11:33:40','2016-04-05 11:33:40'),(51,37,'0,4,36,37',0,'51','清空缓存','wx/emptycache','wx-emptycache',0,0,'2016-04-05 13:59:58','2016-04-05 13:59:58'),(52,37,'0,4,36,37',0,'52','清空数据','wx/emptydata','wx-emptydata',0,0,'2016-04-05 14:00:22','2016-04-05 14:00:22');


DROP TABLE IF EXISTS `li_wxconfigs`;

CREATE TABLE `li_wxconfigs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `appsecret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rzurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_wxconfigs` */

insert  into `li_wxconfigs`(`id`,`appid`,`appsecret`,`rzurl`,`token`,`created_at`,`updated_at`) values (1,'wx1bb03278d5d74909','d8f9f0b33a89b1b78038c9fbe9b9d29a','http://www.muzisheji.com/wx/index','ddd222',NULL,'2016-04-08 09:08:07');

/*Table structure for table `li_wxgroups` */

DROP TABLE IF EXISTS `li_wxgroups`;

CREATE TABLE `li_wxgroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_wxgroups` */

/*Table structure for table `li_wxlinkages` */

DROP TABLE IF EXISTS `li_wxlinkages`;

CREATE TABLE `li_wxlinkages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `val` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `listorder` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_wxlinkages` */

insert  into `li_wxlinkages`(`id`,`parentid`,`name`,`val`,`listorder`,`created_at`,`updated_at`) values (1,0,'菜单类型','menutype',0,'2016-04-05 10:32:19','2016-04-05 11:10:05'),(2,0,'回复类型','msgtype',0,'2016-04-05 10:32:54','2016-04-05 11:05:40'),(3,2,'文本','text',0,'2016-04-05 10:40:36','2016-04-05 10:40:36'),(4,2,'图片','image',0,'2016-04-05 10:41:22','2016-04-05 10:41:22'),(5,2,'图文','news',0,'2016-04-05 10:41:34','2016-04-05 10:41:34'),(6,1,'点击','click',0,'2016-04-05 11:07:16','2016-04-05 11:07:16'),(7,1,'链接','url',0,'2016-04-05 11:07:46','2016-04-05 11:07:46');

/*Table structure for table `li_wxmenus` */

DROP TABLE IF EXISTS `li_wxmenus`;

CREATE TABLE `li_wxmenus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `listorder` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_wxmenus` */

insert  into `li_wxmenus`(`id`,`parentid`,`name`,`type`,`key`,`url`,`listorder`,`created_at`,`updated_at`) values (1,0,'第一个','click','好人','',0,'2016-04-05 11:23:20','2016-04-05 11:23:20'),(2,0,'第二个','url','','http://www.xi-yi.ren/',0,'2016-04-05 11:23:51','2016-04-05 11:28:30'),(3,1,'一一','click','一一','',0,'2016-04-05 11:39:58','2016-04-05 11:39:58'),(4,1,'一二','click','一二','',0,'2016-04-05 11:40:09','2016-04-05 11:40:09');

/*Table structure for table `li_wxmsgs` */

DROP TABLE IF EXISTS `li_wxmsgs`;

CREATE TABLE `li_wxmsgs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `con` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `mediaid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `music_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hq_music_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_wxmsgs` */

insert  into `li_wxmsgs`(`id`,`type`,`con`,`title`,`content`,`mediaid`,`url`,`music_url`,`hq_music_url`,`created_at`,`updated_at`) values (1,'text','一一','一一','一个一','','','','','2016-04-05 14:28:59','2016-04-05 14:28:59'),(2,'text','一二','一二','一个二','','','','','2016-04-05 14:29:12','2016-04-05 14:40:04');

/*Table structure for table `li_wxusers` */

DROP TABLE IF EXISTS `li_wxusers`;

CREATE TABLE `li_wxusers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` smallint(6) NOT NULL DEFAULT '0',
  `openid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sex` tinyint(4) NOT NULL DEFAULT '0',
  `headimgurl` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subscribe_time` int(10) unsigned NOT NULL,
  `remark` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subscribe` tinyint(4) NOT NULL DEFAULT '0',
  `unionid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
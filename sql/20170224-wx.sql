/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.6.29 : Database - laravel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `laravel`;

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

insert  into `li_admins`(`id`,`section_id`,`name`,`realname`,`email`,`password`,`remember_token`,`phone`,`lasttime`,`lastip`,`status`,`created_at`,`updated_at`) values (1,1,'admin','adminss','fsda@eee.com','$2y$10$4NxndXs1LRKMWz9llkg8DO5S5VgH6RIiomVb/980bCgfCPFZUJS5i','uHWMiL5DbPOa5t4fmYJXL6sSggua7alz1EvWErY54cCdH1aPWYQDl2p6yTrN','13123212345','2016-08-07 10:05:54','127.0.0.1',1,'2016-08-07 10:05:54','2016-12-15 10:09:02'),(2,1,'market','dddd','fsda@qq.com','$2y$10$UCK/ej.B8PjZ5rwcLtyyb.T.1MQj6cv2GeeBa6MgUd5PbXDiyOcoy','DYIZEeUGarGtADYvjxBzQuLCTfuvtpV83HuZ12oJAE1BMKqV7qSKZrlZm8Xz','','2016-12-15 09:46:33','192.168.1.162',1,'2016-12-15 09:46:33','2016-12-15 10:10:01');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_articles` */

insert  into `li_articles`(`id`,`catid`,`title`,`thumb`,`describe`,`content`,`source`,`url`,`status`,`listorder`,`created_at`,`updated_at`) values (1,1,'设备2-1','','','<p>&nbsp; &nbsp; &nbsp;sss &nbsp; &nbsp;fsdad &nbsp; &nbsp;</p>','','',0,4,'2016-08-07 10:36:48','2016-12-02 10:14:42'),(2,1,'fsa','','','<p>\r\n	fsfdfdfdfddadfd\r\n</p>\r\n<style type=\"text/css\">\r\n    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}\r\n    .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}\r\n    #dituContent ,#dituContent *,#dituContent *:before,#dituContent *:after {box-sizing: content-box; -webkit-box-sizing: content-box; -moz-box-sizing: content-box;}\r\n</style>\r\n<script type=\"text/javascript\" src=\"http://api.map.baidu.com/api?key=&v=1.1&services=true\"></script>\r\n<!--百度地图容器-->\r\n<div style=\"width:690px;height:550px;border:#ccc solid 1px;\" id=\"dituContent\">\r\n</div>\r\n<script type=\"text/javascript\">\r\n    //创建和初始化地图函数：\r\n    function initMap(){\r\n        createMap();//创建地图\r\n        setMapEvent();//设置地图事件\r\n        addMapControl();//向地图添加控件\r\n        addMarker();//向地图中添加marker\r\n    }\r\n    //创建地图函数：\r\n    function createMap(){\r\n        var map = new BMap.Map(\"dituContent\");//在百度地图容器中创建一个地图\r\n        var point = new BMap.Point(115.68839,37.746701);//定义一个中心点坐标\r\n        map.centerAndZoom(point,14);//设定地图的中心点和坐标并将地图显示在地图容器中\r\n        window.map = map;//将map变量存储在全局\r\n    }\r\n    //地图事件设置函数：\r\n    function setMapEvent(){\r\n        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)\r\n        map.enableScrollWheelZoom();//启用地图滚轮放大缩小\r\n        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)\r\n        map.enableKeyboard();//启用键盘上下左右键移动地图\r\n    }\r\n    //地图控件添加函数：\r\n    function addMapControl(){\r\n        //向地图中添加缩放控件\r\n	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});\r\n	map.addControl(ctrl_nav);\r\n        //向地图中添加缩略图控件\r\n	var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});\r\n	map.addControl(ctrl_ove);\r\n        //向地图中添加比例尺控件\r\n	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});\r\n	map.addControl(ctrl_sca);\r\n    }\r\n    //标注点数组\r\n    var markerArr = [{title:\"衡水复明眼科医院\",content:\"全国免费眼科咨询热线：4006-9666-01<br />\r\n24小时眼科专线：0318-2228513，2691120，2991120\",point:\"115.674879|37.732647\",isOpen:1,icon:{w:23,h:25,l:0,t:21,x:9,lb:12}}\r\n		 ];\r\n    //创建marker\r\n    function addMarker(){\r\n        for(var i=0;i<markerArr.length;i++){ var json = markerArr[i]; var p0 = json.point.split(\"|\")[0]; var p1 = json.point.split(\"|\")[1]; var point = new BMap.Point(p0,p1); var iconImg = createIcon(json.icon); var marker = new BMap.Marker(point,{icon:iconImg}); var iw = createInfoWindow(i); var label = new BMap.Label(json.title,{\"offset\":new BMap.Size(json.icon.lb-json.icon.x+10,-20)}); marker.setLabel(label); map.addOverlay(marker); label.setStyle({ borderColor:\"#808080\", color:\"#333\", cursor:\"pointer\" }); (function(){ var index = i; var _iw = createInfoWindow(i); var _marker = marker; _marker.addEventListener(\"click\",function(){ this.openInfoWindow(_iw); }); _iw.addEventListener(\"open\",function(){ _marker.getLabel().hide(); }) _iw.addEventListener(\"close\",function(){ _marker.getLabel().show(); }) label.addEventListener(\"click\",function(){ _marker.openInfoWindow(_iw); }) if(!!json.isOpen){ label.hide(); _marker.openInfoWindow(_iw); } })() } } //创建InfoWindow function createInfoWindow(i){ var json = markerArr[i]; var iw = new BMap.InfoWindow(\"<b class=\"iw_poi_title\" title=\"&quot; + json.title + &quot;\">\" + json.title + \"</b> \r\n<div class=\"iw_poi_content\">\r\n	\"+json.content+\"\r\n</div>\r\n\");\r\n        return iw;\r\n    }\r\n    //创建一个Icon\r\n    function createIcon(json){\r\n        var icon = new BMap.Icon(\"http://app.baidu.com/map/images/us_mk_icon.png\", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})\r\n        return icon;\r\n    }\r\n    initMap();//创建和初始化地图\r\n</script>','','',0,2,'2016-08-07 10:44:08','2017-01-11 09:38:54');

/*Table structure for table `li_attrs` */

DROP TABLE IF EXISTS `li_attrs`;

CREATE TABLE `li_attrs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_attrs` */

insert  into `li_attrs`(`id`,`filename`,`url`,`created_at`,`updated_at`) values (1,'editor.gif','/upload/attrs/20170111/20170111092049833.gif','2017-01-11 09:20:49','2017-01-11 09:20:49'),(2,'app.png','/upload/thumb/20170111/20170111092150914.jpg','2017-01-11 09:21:50','2017-01-11 09:21:50'),(3,'app.png','/upload/attrs/20170111/20170111092203222.png','2017-01-11 09:22:03','2017-01-11 09:22:03'),(4,'favicon.png','/upload/attrs/20170111/20170111092204299.png','2017-01-11 09:22:04','2017-01-11 09:22:04'),(5,'favicon.png','/upload/thumb/20170111/20170111092315192.jpg','2017-01-11 09:23:15','2017-01-11 09:23:15'),(6,'favicon.png','/upload/thumb/20170111/20170111092458787.jpg','2017-01-11 09:24:58','2017-01-11 09:24:58'),(7,'favicon.png','/upload/attrs/20170111/20170111093214478.png','2017-01-11 09:32:14','2017-01-11 09:32:14'),(8,'app.png','/upload/attrs/20170111/20170111093245696.png','2017-01-11 09:32:45','2017-01-11 09:32:45');

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
  `describe` text COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_categorys` */

insert  into `li_categorys`(`id`,`parentid`,`arrparentid`,`child`,`arrchildid`,`name`,`thumb`,`describe`,`type`,`url`,`listorder`,`created_at`,`updated_at`) values (1,0,'0',0,'1','关于我们','','daf',0,'',0,'2016-08-07 10:15:43','2016-08-07 10:17:49');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_logs` */

insert  into `li_logs`(`id`,`admin_id`,`user`,`url`,`created_at`) values (1,1,'admin','/admin/attr/uploadimg?dir=image','2017-01-11 09:20:49'),(2,1,'admin','/admin/attr/uploadimg?dir=image','2017-01-11 09:21:50'),(3,1,'admin','/admin/attr/uploadimg?dir=image','2017-01-11 09:22:03'),(4,1,'admin','/admin/attr/uploadimg?dir=image','2017-01-11 09:22:03'),(5,1,'admin','/admin/attr/uploadimg?dir=image','2017-01-11 09:23:15'),(6,1,'admin','/admin/attr/uploadimg?dir=image','2017-01-11 09:24:58'),(7,1,'admin','/admin/attr/uploadimg','2017-01-11 09:32:14'),(8,1,'admin','/admin/attr/uploadimg','2017-01-11 09:32:45'),(9,1,'admin','/admin/art/edit/2','2017-01-11 09:38:54'),(10,1,'admin','/admin/wxmenu/edit/2','2017-02-24 09:08:47'),(11,1,'admin','/admin/wxmenu/edit/2','2017-02-24 09:10:14'),(12,1,'admin','/admin/wxmenu/edit/2','2017-02-24 09:10:49'),(13,1,'admin','/admin/wxmenu/edit/2','2017-02-24 09:11:06'),(14,1,'admin','/admin/wxlinkage/edit/7','2017-02-24 09:12:43'),(15,1,'admin','/admin/wx/config','2017-02-24 09:13:29'),(16,1,'admin','/admin/wx/config','2017-02-24 09:22:05'),(17,1,'admin','/admin/wxlinkage/add/0','2017-02-24 09:32:26'),(18,1,'admin','/admin/wxlinkage/add/2','2017-02-24 09:34:35'),(19,1,'admin','/admin/wxlinkage/add/2','2017-02-24 09:34:56'),(20,1,'admin','/admin/wxlinkage/add/2','2017-02-24 09:35:15'),(21,1,'admin','/admin/wx/config','2017-02-24 10:19:09'),(22,1,'admin','/admin/wxlinkage/edit/2','2017-02-24 10:19:22'),(23,1,'admin','/admin/wxlinkage/edit/7','2017-02-24 10:51:41'),(24,1,'admin','/admin/wx/config','2017-02-24 11:13:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_menus` */

insert  into `li_menus`(`id`,`parentid`,`arrparentid`,`child`,`arrchildid`,`name`,`url`,`label`,`display`,`listorder`,`created_at`,`updated_at`) values (1,0,'0',1,'1,5,6,7,8,9,67,68,74,148,149,150,151,152,153,154,10,11,12,13,14,15,16,17,18,19,140,170,171,172,173,20,21,143,144,145','系统','index/index','index-index',1,0,'2016-03-18 15:46:02','2016-12-15 08:32:44'),(2,0,'0',1,'2,22,23,24,25,26,27,28,29,75,30,31,32,33,34,121,136','内容','content/index','content-index',1,0,'2016-03-18 15:46:21','2016-12-14 10:15:49'),(4,0,'0',1,'4,36,37,51,52,38,39,40,41,42,43,44,45,50,46,47,48,49','微信','wx/index','wx-index',1,10,'2016-03-18 15:46:50','2016-08-08 10:05:16'),(5,1,'0,1',1,'5,6,7,8,9,67,68,74,148,149,150,151,152,153,154','系统设置','sys/index','sys-index',1,0,'2016-03-18 15:47:40','2016-12-14 09:56:58'),(6,5,'0,1,5',1,'6,7,8,9','菜单管理','menu/index','menu-index',1,0,'2016-03-18 15:48:07','2016-03-23 14:23:43'),(7,6,'0,1,5,6',0,'7','添加菜单','menu/add','menu-add',1,0,'2016-03-18 15:49:03','2016-03-23 08:25:50'),(8,6,'0,1,5,6',0,'8','修改菜单','menu/edit','menu-edit',0,0,'2016-03-18 15:51:08','2016-03-23 14:23:43'),(9,6,'0,1,5,6',0,'9','删除菜单','menu/del','menu-del',0,0,'2016-03-18 15:51:30','2016-03-23 08:25:50'),(10,1,'0,1',1,'10,11,12,13,14,15,16,17,18,19,140,170,171,172,173','用户中心','admin/manage','admin-manage',1,0,'2016-03-18 16:04:01','2016-12-15 08:32:44'),(11,10,'0,1,10',1,'11,12,13,14,15','用户管理','admin/index','admin-index',1,0,'2016-03-18 16:04:38','2016-03-24 11:31:08'),(12,11,'0,1,10,11',0,'12','添加用户','admin/add','admin-add',1,0,'2016-03-18 16:05:14','2016-03-24 11:31:16'),(13,11,'0,1,10,11',0,'13','修改用户','admin/edit','admin-edit',0,0,'2016-03-18 16:06:10','2016-03-24 11:31:24'),(14,11,'0,1,10,11',0,'14','删除用户','admin/del','admin-del',0,0,'2016-03-18 16:06:31','2016-03-24 11:31:32'),(15,11,'0,1,10,11',0,'15','修改密码','admin/pwd','admin-pwd',0,0,'2016-03-18 16:07:07','2016-03-24 11:31:44'),(16,10,'0,1,10',1,'16,17,18,19,140','角色管理','role/index','role-index',1,0,'2016-03-18 16:07:58','2016-12-02 09:41:15'),(17,16,'0,1,10,16',0,'17','添加角色','role/add','role-add',1,0,'2016-03-18 16:08:23','2016-03-23 08:25:50'),(18,16,'0,1,10,16',0,'18','修改角色','role/edit','role-edit',0,0,'2016-03-18 16:08:50','2016-03-23 08:25:50'),(19,16,'0,1,10,16',0,'19','删除角色','role/del','role-del',0,0,'2016-03-18 16:09:10','2016-03-23 08:25:50'),(20,1,'0,1',1,'20,21','系统信息','index/main','index-main',0,0,'2016-03-24 15:42:14','2016-03-25 10:34:44'),(21,20,'0,1,20',0,'21','左侧菜单','index/left','index-left',0,0,'2016-03-25 10:34:44','2016-03-25 10:35:27'),(22,2,'0,2',1,'22,23,24,25,26,27,28,29,75,30,31,32,33,34,121,136','内容管理','content/manage','content-manage',1,0,'2016-03-29 08:39:52','2016-12-02 09:44:29'),(23,22,'0,2,22',1,'23,24,25,26,27','栏目管理','cate/index','cate-index',1,0,'2016-03-29 08:40:08','2016-03-29 08:41:30'),(24,23,'0,2,22,23',0,'24','添加栏目','cate/add','cate-add',1,0,'2016-03-29 08:40:25','2016-03-29 08:40:25'),(25,23,'0,2,22,23',0,'25','修改栏目','cate/edit','cate-edit',0,0,'2016-03-29 08:40:42','2016-03-29 08:41:00'),(26,23,'0,2,22,23',0,'26','删除栏目','cate/del','cate-del',0,0,'2016-03-29 08:40:54','2016-03-29 08:41:07'),(27,23,'0,2,22,23',0,'27','更新栏目缓存','cate/cache','cate-cache',0,0,'2016-03-29 08:41:30','2016-03-29 08:41:30'),(28,22,'0,2,22',1,'28,29,75','附件管理','attr/index','attr-index',1,5,'2016-03-31 08:23:28','2016-05-09 19:29:09'),(29,28,'0,2,22,28',0,'29','上传图片','attr/uploadimg','attr-uploadimg',0,0,'2016-03-31 08:24:45','2016-06-14 19:12:33'),(30,22,'0,2,22',1,'30,31,32,33,34,121,136','文章管理','art/index','art-index',1,0,'2016-03-31 08:25:22','2016-12-02 09:44:16'),(31,30,'0,2,22,30',0,'31','添加文章','art/add','art-add',1,0,'2016-03-31 08:25:40','2016-07-23 17:39:54'),(32,30,'0,2,22,30',0,'32','修改文章','art/edit','art-edit',0,0,'2016-03-31 08:25:59','2016-03-31 08:25:59'),(33,30,'0,2,22,30',0,'33','删除文章','art/del','art-del',0,0,'2016-03-31 08:26:15','2016-03-31 08:26:15'),(34,30,'0,2,22,30',0,'34','查看文章','art/show','art-show',0,0,'2016-03-31 08:26:35','2016-03-31 08:26:36'),(36,4,'0,4',1,'36,37,51,52,38,39,40,41,42,43,44,45,50,46,47,48,49','微信设置','wx/manage','wx-manage',1,0,'2016-04-05 08:51:41','2016-04-08 21:13:23'),(37,36,'0,4,36',1,'37,51,52','微信配置','wx/config','wx-config',1,0,'2016-04-05 08:52:10','2016-04-05 14:00:22'),(38,36,'0,4,36',1,'38,39,40,41','微信关联菜单','wxlinkage/index','wxlinkage-index',1,0,'2016-04-05 08:53:16','2016-04-07 22:23:19'),(39,38,'0,4,36,38',0,'39','添加关联菜单','wxlinkage/add','wxlinkage-add',1,0,'2016-04-05 08:54:01','2016-04-05 08:58:48'),(40,38,'0,4,36,38',0,'40','修改关联菜单','wxlinkage/edit','wxlinkage-edit',0,0,'2016-04-05 08:54:27','2016-04-05 08:58:57'),(41,38,'0,4,36,38',0,'41','删除关联菜单','wxlinkage/del','wxlinkage-del',0,0,'2016-04-05 08:54:55','2016-04-05 08:59:05'),(42,36,'0,4,36',1,'42,43,44,45,50','自定义菜单','wxmenu/index','wxmenu-index',1,0,'2016-04-05 08:57:27','2016-04-05 11:33:40'),(43,42,'0,4,36,42',0,'43','添加自定义菜单','wxmenu/add','wxmenu-add',1,0,'2016-04-05 08:57:50','2016-04-05 08:57:50'),(44,42,'0,4,36,42',0,'44','修改自定义菜单','wxmenu/edit','wxmenu-edit',0,0,'2016-04-05 08:58:12','2016-04-05 08:58:12'),(45,42,'0,4,36,42',0,'45','删除自定义菜单','wxmenu/del','wxmenu-del',0,0,'2016-04-05 08:58:31','2016-04-05 08:58:31'),(46,36,'0,4,36',1,'46,47,48,49','自动回复','wxmsg/index','wxmsg-index',1,0,'2016-04-05 09:03:49','2016-04-05 09:05:07'),(47,46,'0,4,36,46',0,'47','添加回复','wxmsg/add','wxmsg-add',1,0,'2016-04-05 09:04:21','2016-04-05 09:04:21'),(48,46,'0,4,36,46',0,'48','修改回复','wxmsg/edit','wxmsg-edit',0,0,'2016-04-05 09:04:45','2016-04-05 09:04:45'),(49,46,'0,4,36,46',0,'49','删除回复','wxmsg/del','wxmsg-del',0,0,'2016-04-05 09:05:07','2016-04-05 09:05:07'),(50,42,'0,4,36,42',0,'50','刷新菜单','wxmenu/update','wxmenu-update',0,0,'2016-04-05 11:33:40','2016-04-05 11:33:40'),(51,37,'0,4,36,37',0,'51','清空缓存','wx/emptycache','wx-emptycache',0,0,'2016-04-05 13:59:58','2016-04-05 13:59:58'),(52,37,'0,4,36,37',0,'52','清空数据','wx/emptydata','wx-emptydata',0,0,'2016-04-05 14:00:22','2016-04-05 14:00:22'),(67,5,'0,1,5',1,'67,68','操作日志','log/index','log-index',1,0,'2016-04-11 10:38:34','2016-04-11 10:38:53'),(68,67,'0,1,5,67',0,'68','清除7天前日志','log/del','log-del',0,0,'2016-04-11 10:38:53','2016-05-11 17:37:46'),(74,5,'0,1,5',0,'74','更新缓存','index/cache','index-cache',1,5,'2016-04-11 16:00:30','2016-05-15 08:25:53'),(75,28,'0,2,22,28',0,'75','删除附件','attr/delfile','attr-delfile',0,0,'2016-05-09 19:29:09','2016-05-09 19:29:09'),(121,30,'0,2,22,30',0,'121','批量删除','art/alldel','art-alldel',0,0,'2016-06-15 08:52:32','2016-06-15 08:52:32'),(136,30,'0,2,22,30',0,'136','批量排序','art/listorder','art-listorder',0,0,'2016-07-25 08:35:42','2016-07-25 08:35:42'),(140,16,'0,1,10,16',0,'140','角色权限','role/priv','role-priv',0,0,'2016-07-25 11:34:39','2016-07-25 11:34:40'),(143,1,'0,1',1,'143,144,145','个人信息','admin/info','admin-info',1,0,'2016-07-28 14:01:45','2016-07-28 14:02:37'),(144,143,'0,1,143',0,'144','修改个人资料','admin/myedit','admin-myedit',1,0,'2016-07-28 14:02:12','2016-07-28 14:02:12'),(145,143,'0,1,143',0,'145','修改个人密码','admin/mypwd','admin-mypwd',1,0,'2016-07-28 14:02:37','2016-07-28 14:02:37'),(148,5,'0,1,5',1,'148,149,150','数据管理','database/export','database-export',1,0,'2016-12-02 10:21:37','2016-12-02 10:22:48'),(149,148,'0,1,5,148',0,'149','恢复数据','database/import','database-import',0,0,'2016-12-02 10:22:16','2016-12-02 10:22:23'),(150,148,'0,1,5,148',0,'150','删除备份文件','database/delfile','database-delfile',0,0,'2016-12-02 10:22:47','2016-12-02 10:22:48'),(151,5,'0,1,5',1,'151,152,153,154','分类管理','type/index','type-index',1,0,'2016-12-14 09:56:01','2016-12-14 09:56:58'),(152,151,'0,1,5,151',0,'152','添加分类','type/add','type-add',1,0,'2016-12-14 09:56:23','2016-12-14 09:56:23'),(153,151,'0,1,5,151',0,'153','修改分类','type/edit','type-edit',0,0,'2016-12-14 09:56:42','2016-12-14 09:56:42'),(154,151,'0,1,5,151',0,'154','删除分类','type/del','type-del',0,0,'2016-12-14 09:56:57','2016-12-14 09:56:58'),(170,10,'0,1,10',1,'170,171,172,173','部门管理','section/index','section-index',1,0,'2016-12-15 08:31:39','2016-12-15 08:32:44'),(171,170,'0,1,10,170',0,'171','添加部门','section/add','section-add',1,0,'2016-12-15 08:32:01','2016-12-15 08:32:02'),(172,170,'0,1,10,170',0,'172','修改部门','section/edit','section-edit',0,0,'2016-12-15 08:32:23','2016-12-15 08:32:23'),(173,170,'0,1,10,170',0,'173','删除部门','section/del','section-del',0,0,'2016-12-15 08:32:44','2016-12-15 08:32:44');

/*Table structure for table `li_migrations` */

DROP TABLE IF EXISTS `li_migrations`;

CREATE TABLE `li_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_migrations` */

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

/*Table structure for table `li_wxconfigs` */

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

insert  into `li_wxconfigs`(`id`,`appid`,`appsecret`,`rzurl`,`token`,`created_at`,`updated_at`) values (1,'wx1bb03278d5d74909','d8f9f0b33a89b1b78038c9fbe9b9d29a','http://l53.muzisheji.com/api/wx/index','ddd222',NULL,'2017-02-24 11:13:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_wxlinkages` */

insert  into `li_wxlinkages`(`id`,`parentid`,`name`,`val`,`listorder`,`created_at`,`updated_at`) values (1,0,'菜单类型','menutype',0,'2016-04-05 10:32:19','2016-04-05 11:10:05'),(2,0,'回复类型','msgtype',0,'2016-04-05 10:32:54','2017-02-24 10:19:22'),(3,2,'文本','text',0,'2016-04-05 10:40:36','2016-04-05 10:40:36'),(4,2,'图片','image',0,'2016-04-05 10:41:22','2016-04-05 10:41:22'),(5,2,'图文','news',0,'2016-04-05 10:41:34','2016-04-05 10:41:34'),(6,1,'点击','click',0,'2016-04-05 11:07:16','2016-04-05 11:07:16'),(7,1,'链接','view',0,'2016-04-05 11:07:46','2017-02-24 10:51:41'),(8,2,'视频','video',0,'2017-02-24 09:32:27','2017-02-24 09:32:27'),(9,2,'语音','voice',0,'2017-02-24 09:34:56','2017-02-24 09:34:56'),(10,2,'音乐','music',0,'2017-02-24 09:35:15','2017-02-24 09:35:15');

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

insert  into `li_wxmenus`(`id`,`parentid`,`name`,`type`,`key`,`url`,`listorder`,`created_at`,`updated_at`) values (1,0,'第一个','click','好人','',0,'2016-04-05 11:23:20','2016-04-05 11:23:20'),(2,0,'第二个','view','','http://www.xi-yi.ren/',0,'2016-04-05 11:23:51','2017-02-24 09:11:06'),(3,1,'一一','click','一一','',0,'2016-04-05 11:39:58','2016-04-05 11:39:58'),(4,1,'一二','click','一二','',0,'2016-04-05 11:40:09','2016-04-05 11:40:09');

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

/*Data for the table `li_wxusers` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.9 : Database - xyshop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`xyshop` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `xyshop`;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_admins` */

insert  into `li_admins`(`id`,`section_id`,`name`,`realname`,`email`,`password`,`remember_token`,`phone`,`lasttime`,`lastip`,`status`,`created_at`,`updated_at`) values (1,1,'admin','adminss','fsda@eee.com','eyJpdiI6InRUTm9WaXlMQlV5ekN3Q21UdU1UZmc9PSIsInZhbHVlIjoiQjRpQWNaT0xZc1lQdXJKY0xFTStYQT09IiwibWFjIjoiMzllNTgxNGFjMTA0ZTc1ZGI5OWJmMDkxNzMxYTM5MzJmYjQ5ZTg2MjFlZjg1M2JjNjhhMTdhZDBmYTY5ZGY2MyJ9','1o7hGhXUE4f6Gl7mDamfRJwzVUvWEW4jZjskzK7AMFRM1fcuk77VpfbcCXrQ','13123212345','2017-04-26 08:26:51','127.0.0.1',1,'2016-08-07 10:05:54','2017-04-17 13:41:46'),(2,1,'market','dddd','fsda@qq.com','eyJpdiI6IkxiRERmOTRhb2ZcL0hpb0JmS2hNN3pBPT0iLCJ2YWx1ZSI6IjNtdnNhaWVYMzF5cElqQ08xeWs0dVE9PSIsIm1hYyI6ImRjY2M0ZWFmNmRhYzcxNDg2ODUwNDE2YWRhNmRjOGI3NzA5NmEwNWQzNWE2YTAwMzQyODM1YWYxYjM5YzI1OTMifQ==','DYIZEeUGarGtADYvjxBzQuLCTfuvtpV83HuZ12oJAE1BMKqV7qSKZrlZm8Xz','','2017-04-25 23:11:09','192.168.1.162',1,'2016-12-15 09:46:33','2017-04-25 15:11:09'),(3,1,'adminss','adminss','fsad@qq.com','$2y$10$JpPDEzSfMIN2YJ2l3awAQe7rXyh5BUvGdkH6IGHKt8D3MA5Gt0bLa',NULL,'','2017-04-26 00:43:33','192.168.3.14',1,'2017-04-26 00:43:33','2017-04-26 00:43:33');

/*Table structure for table `li_articles` */

DROP TABLE IF EXISTS `li_articles`;

CREATE TABLE `li_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `describe` text COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_articles` */

insert  into `li_articles`(`id`,`catid`,`title`,`thumb`,`describe`,`content`,`source`,`url`,`status`,`listorder`,`created_at`,`updated_at`) values (1,2,'食品的创意广告','/upload/attrs/20170426/20170426025559900.jpg',NULL,'<p>\r\n  <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <a href=\"http://demo.wpcom.cn/third/234.html\" title=\"食品的创意广告\" style=\"box-sizing:border-box;background-color:#FFFFFF;color:#333333;text-decoration-line:none;outline:0px;display:block;text-overflow:ellipsis;overflow:hidden;word-wrap:normal;font-family:\" font-size:14px;text-align:center;\"=\"\"><br />\r\n</a> \r\n</p>\r\n<p>\r\n <a href=\"http://demo.wpcom.cn/third/234.html\" title=\"食品的创意广告\" style=\"box-sizing:border-box;background-color:#FFFFFF;color:#333333;text-decoration-line:none;outline:0px;display:block;text-overflow:ellipsis;overflow:hidden;word-wrap:normal;font-family:\" font-size:14px;text-align:center;\"=\"\"><img class=\"aligncenter size-full wp-image-241\" src=\"http://demo.wpcom.cn/third/wp-content/uploads/sites/4/2016/02/50473693c45280b1a3b5e075f7975b57d5a93e1e13ed6-omBILt_fw658.jpg\" alt=\"50473693c45280b1a3b5e075f7975b57d5a93e1e13ed6-omBILt_fw658\" width=\"600\" height=\"848\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;display:block;margin:0px auto;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\"></a> \r\n</p>\r\n<p>\r\n  <br />\r\n</p>\r\n<a href=\"http://demo.wpcom.cn/third/234.html\" title=\"食品的创意广告\" style=\"box-sizing:border-box;background-color:#FFFFFF;color:#333333;text-decoration-line:none;outline:0px;display:block;text-overflow:ellipsis;overflow:hidden;word-wrap:normal;font-family:\" font-size:14px;text-align:center;\"=\"\"><br />\r\n</a> \r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>\r\n<p>\r\n <br />\r\n</p>',NULL,'shi-pin-de-chuang-yi-guang-gao',1,0,'2017-04-26 02:57:01','2017-04-26 02:57:19'),(2,2,'日本海报分享','/upload/attrs/20170426/20170426025746572.jpeg',NULL,'<img class=\"aligncenter size-full wp-image-223\" src=\"http://demo.wpcom.cn/third/wp-content/uploads/sites/4/2015/06/f01f3aac2eb89d541be9007e1164051201f91361232da-zMszpS_fw658.jpeg\" alt=\"f01f3aac2eb89d541be9007e1164051201f91361232da-zMszpS_fw658\" width=\"470\" height=\"662\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;display:block;margin:0px auto;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\" />',NULL,'ri-ben-hai-bao-fen-xiang',1,0,'2017-04-26 02:57:50','2017-04-26 02:57:50'),(3,2,'Poster Annual 2015海报设计获奖作品','/upload/attrs/20170426/20170426025817159.jpeg',NULL,'<img class=\"aligncenter size-full wp-image-219\" src=\"http://demo.wpcom.cn/third/wp-content/uploads/sites/4/2015/06/4eff559b17b2b85435c8bb62198896414968572f16a95-Jpnb3e_fw658.jpeg\" alt=\"4eff559b17b2b85435c8bb62198896414968572f16a95-Jpnb3e_fw658\" width=\"658\" height=\"933\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;display:block;margin:0px auto;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\" />',NULL,'Poster-Annual-2015-hai-bao-she-ji-huo-jiang-zuo-pin',1,0,'2017-04-26 02:58:20','2017-04-26 02:58:20'),(4,2,'充满创意的包装设计作品欣赏','/upload/attrs/20170426/20170426025856717.jpg',NULL,'<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n  <img class=\"alignnone size-full wp-image-21 aligncenter\" src=\"http://demo.wpcom.cn/third/wp-content/uploads/sites/4/2015/06/Designs-1.jpg\" alt=\"Designs-1\" width=\"600\" height=\"452\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;display:block;margin:0px auto;\" />\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;text-align:center;\">\r\n <img class=\"aligncenter size-full wp-image-239\" src=\"http://demo.wpcom.cn/third/wp-content/uploads/sites/4/2015/06/Designs-2.jpg\" alt=\"Designs-2\" width=\"600\" height=\"448\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;display:block;margin:0px auto;\" />\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;text-align:center;\">\r\n  <img class=\"alignnone size-full wp-image-23\" src=\"http://demo.wpcom.cn/third/wp-content/uploads/sites/4/2015/06/Designs-3.jpg\" alt=\"Designs-3\" width=\"599\" height=\"747\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;\" />\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;text-align:center;\">\r\n <img class=\"alignnone size-full wp-image-24\" src=\"http://demo.wpcom.cn/third/wp-content/uploads/sites/4/2015/06/Designs-4.jpg\" alt=\"Designs-4\" width=\"600\" height=\"574\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;\" />\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;text-align:center;\">\r\n <img class=\"alignnone size-full wp-image-25\" src=\"http://demo.wpcom.cn/third/wp-content/uploads/sites/4/2015/06/Designs-5.jpg\" alt=\"Designs-5\" width=\"600\" height=\"450\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;\" />\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;text-align:center;\">\r\n <img class=\"alignnone size-full wp-image-26\" src=\"http://demo.wpcom.cn/third/wp-content/uploads/sites/4/2015/06/Designs-6.jpg\" alt=\"Designs-6\" width=\"596\" height=\"532\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;\" />\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;text-align:center;\">\r\n <img class=\"alignnone size-full wp-image-27\" src=\"http://demo.wpcom.cn/third/wp-content/uploads/sites/4/2015/06/Designs-7.jpg\" alt=\"Designs-7\" width=\"600\" height=\"285\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;\" />\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n <img class=\"alignnone size-full wp-image-28 aligncenter\" src=\"http://demo.wpcom.cn/third/wp-content/uploads/sites/4/2015/06/Designs-8.jpg\" alt=\"Designs-8\" width=\"600\" height=\"435\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;display:block;margin:0px auto;\" />\r\n</p>',NULL,'chong-man-chuang-yi-de-bao-zhuang-she-ji-zuo-pin-xin-shang',1,0,'2017-04-26 02:58:59','2017-04-26 02:58:59'),(5,3,'互联网金融：烫手的牌照','/upload/attrs/20170426/20170426025921737.jpeg',NULL,'<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 东方网记者朱恬6月26日报道：随着互联网金融的兴起，相应的牌照是否会逐步放开？互联网金融牌照又有何意义？在2015陆家嘴论坛浦江夜话环节中，互联网金融专家对此发表了看法。\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n <img class=\" aligncenter\" src=\"http://sh.eastday.com/images/thumbnailimg/month_1506/201506271030439311.jpg\" alt=\"\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;display:block;margin:0px auto;\" />\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;text-align:center;\">\r\n  图片说明：汇付天下董事长兼CEO周晔。\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 汇付天下董事长周晔坦言，目前的行业对互联网金融牌照普遍持两种态度，一种是特别想拿到牌照，拿着这张牌照就能踏实经营，防止被同行牵连；另一种是害怕拿牌照，因为牌照意味着束缚。\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n <img class=\" aligncenter\" src=\"http://sh.eastday.com/images/thumbnailimg/month_1506/201506271030434867.jpg\" alt=\"\" style=\"box-sizing:border-box;vertical-align:top;max-width:100%;height:auto;display:block;margin:0px auto;\" />\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;text-align:center;\">\r\n  图片说明：点融网联合首席执行官、共同创始人郭宇航。\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 点融网联合首席执行官郭宇航则认为，作为一个新生的业态，暂缓发牌照更有利于行业发展，“牌照意味着原则、束缚。比如说发放牌照的小贷公司都规定了严格的杠杆比例，而P2P没有，几乎是无限杠杆做业务。但同时没有牌照不代表不要监管。我认为监管是非常必要的，一定要尽快落地。因为在没有牌照的初期广大想要规范做P2P的公司有大量的发挥空间，央行对于牌照公司的严格审查导致了支付公司在创新上受到遏制。”\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n  郭宇航还透露，第三方支付发放牌照有300张，然而真正能够活跃经营的不到100张，大量的牌照在市场上进行转让，“有钱就可以买到的牌照，究竟有多大的监管意义呢？”因此，互联网金融的监管不应该参照传统的金融机构的牌照管理，而是对于越轨的事情及时出台政策，小步快走监管。同时用互联网方式监管，要求互联网金融公司向监管部门开放，用技术进行监管，一旦发生违规行为，可以在银监会上公示这些企业，通过影响声誉的方式进行惩罚，这或许是互联网金融监管的未来。\r\n</p>',NULL,'hu-lian-wang-jin-rong-tang-shou-de-pai-zhao',1,0,'2017-04-26 02:59:34','2017-04-26 02:59:34'),(6,3,'雇佣制过时了，打造你的人才联盟！',NULL,NULL,'<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 二十多年前，中国的国有企业和政府机关的工作大都很稳定，只有你不犯大错误，就可以作为“单位人”一直工作下去。1992年随着市场经济体制的确立，这种事实上的“终身雇佣制”受到了来自外企和民企的冲击，“自由雇佣制”和市场经济被想当然地联系在一起。所谓“自由雇佣”，就是作为个人有选择雇主的自由，但如果雇主对某个雇员不满，他可以以某个理由解雇这名雇员。\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 自由雇佣制催生了大量的猎头和招聘公司。人才开始在各大公司之间高速流动，越来越少的人一辈子只在一家公司工作。企业不再保证会给雇员一个长期稳定的职位，而个人也大多数没想到要在一家企业工作一辈子。你看现在各种各样的互联网招聘公司的广告，创意大都是一样的：对老板不满意？想要更大发展？想要更高薪水？上某某网，更好的职位在等着你！更高的薪水在等着你！\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 这种公司和个人之间的自由雇佣关系优化了人力资源配置，但也带来了一些负面效应，那就是公司和个人之间的信任和忠诚都大幅下降。由于缺乏组织忠诚度，很多人总想着一有机会就跳槽，而一些公司则不愿意培养人，他们的逻辑也很简单：好不容易培养了一个人，别人给高一点的薪水就走了。于是乎，公司在失去高潜力人才，而人才也无法充分投入工作，而是在市场藏上不断寻找机会。\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n  老路已经无法回去了。终身雇佣制这种传统模式非常适合相对稳定的时期，但它对于当今的网络时代来说太过死板，不再适合现在不断变革的宏观环境。几乎没有公司能继续为员工提供传统的职业晋升阶梯，就算以“终身雇佣制”见长的日本企业，在糟糕的宏观经济环境下，很多企业也不得不开始裁员。在这种环境中，要求员工和公司保持长期关系是不现实的，彼此之间的忠诚更是罕见。\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 有没有什么办法在保持自由雇佣制的弹性基础上，又让员工和公司之间保持相互信任和忠诚关系呢？至少在一个阶段内如此。领英（Linkedin）的创始人里德·霍夫曼基于他的观察和实践，提出了一个新的人才策略框架：使雇主与员工之间的关系从商业交易转变为互惠关系的联盟，这种雇佣联盟关系为管理者和员工提供了建立信任、进行投资，以建设强大企业和成功事业所需的框架。\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 这种互惠关系需要把心照不宣的心理契约书面化。雇主需要告诉员工：“只要你让我们的公司更有价值，我们就会让你更有价值。”员工需要告诉他们的老板：“如果公司帮助我的事业发展壮大，我就会帮助公司发展壮大。”于是，员工致力于帮助公司取得成功，而公司致力于提高员工的市场价值。通过建立互惠的联盟，雇主和员工可以投资于这段关系，并承担其中可能发生的一些的风险。\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n  比如说，当老板和人力资源主管为了培养一个人花了很多钱在培训项目上，却看到这个人在参加完培训几个月之后就离职，反应自然是有些沮丧。但如果因此就去削减培训预算，又不能为组织发展提供持久的推动力。这个时候，比较理想的方式是公司和个人都开诚布公地设定各自的预期：员工可以表达自己想要发展的技能以及他对公司的承诺，而公司则可以明确表达他的投资以及期望回报。\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n  其实里德.霍夫曼的这种提法在学理上并不新鲜，在组织行为学的教科书中就有提及：组织存在的目的在于让一群人一起完成一个共同的目标。一个组织就像一个职业球队，每个球员都有明确的目标（比如说赢得比赛），队员为了实现这个目标聚到一起，各自既有分工也有协作。只有当队员们彼此信任，将团队成就置于个人成就之上时，团队才会胜利。团队胜利也是队员实现个人成就的最佳方式，胜利队伍的队员会被其他队争相求购，他们的职业价值也随之提升。\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 尽管职业球队不采用终身雇佣制，但相互信任、相互投资、共同受益的原则仍然适用。只有当队员们彼此非常信任，将团队成就置于个人成就之上时，团队才会胜利。而团队胜利是队员实现个人成就的最佳方式。胜利队伍的队员会被其他队争相求购，它们看中的既有这些队员展现出的技能，也有他们帮助新队伍建立胜利文化的能力。可以说，团队和球员在赢得比赛这件事情是真正的双赢。\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 当然在中国，这种联盟的人才策略也需要做一些本地化的调整。虽然公司不是家庭，无需刻意营造一种温情脉脉的家庭氛围，但组织成员之间的相互关心和欣赏依然是必要的，它能增强人对组织的情感归属。另外，对于那些已经离开公司的员工，公司和员工之间的关系也并非因此而结束。他们可以保持像朋友一样经常联系，这种人力资源网络就像社会资本一样，能给双方带来互惠互利。\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n  在一个快速变化的年代，我们已经没有办法“终身雇佣”了，公司和员工都需要一定的弹性。公司无法假装温情脉脉地说“公司就是家，我们是家人”，员工也无需假装表态“生是公司人、死是公司鬼”。但公司和员工在约定时间内的相互忠诚依然是必要的，因为没有这种忠诚度就无法长期考虑和投资未来。人才联盟制能很好地解决这个问题：它让公司和个人达成一个心理契约，让双方都专注于中长期收益，为公司带来更多创新、韧性和适应性，实现真正的双赢。\r\n</p>',NULL,'gu-yong-zhi-guo-shi-le-da-zao-ni-de-ren-cai-lian-meng',1,0,'2017-04-26 03:00:02','2017-04-26 03:00:02'),(7,3,'首届移动互联网创业峰会聚焦移动支付',NULL,NULL,'<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n  中新网厦门6月27日电 (记者 杨伏山)首届“移动互联网创业峰会”27日在厦门举办，来自社会各界的企业家、品牌规划家、战略投资家、个体营业主和关注移动互联网商业人士300余人参会，聚焦互联网时代移动支付新趋势。\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 据介绍，全球52亿移动用户中，目前仅有30%的智能手机使用率，剩余70%的广阔市场仍待挖掘。随着通信技术的不断高速发展和普及，中国移动互联网迅速起飞，目前，中国移动互联网用户数已达到中国互联网用户数的八成，中国有望主导未来移动商务革命。&emsp;&emsp;由中金汇通金融技术服务有限公司主办的是次峰会，邀请多位互联网业界人士到会分享经验，畅谈移动互联网趋势下热门行业的兴起以及如何把握移动互联网带来的商机。\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 与会业界人士认为，中国移动互联网强劲发展态势2015年将延续，而移动支付则是发展的必要基础。可以预见，未来现金及银行卡交易将逐步被移动支付所取代。\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n 移动支付未来的商业形态有很多种，比如大数据，利用海量的用户支付数据，以此为基础，进行精准营销，获得任何时代都无法企及的高性价比营销收入；比如未来微商，所有人都可能是微商店主，都需要资金交易，因此移动支付的普及将会带来巨额财富，今后势必成为各商家争夺的重点。\r\n</p>\r\n<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;text-indent:2em;color:#333333;font-family:&quot;font-size:14px;white-space:normal;background-color:#FFFFFF;\">\r\n  主办方称，期盼峰会的举办有助于使移动支付能够为更多人所认识并带来利益，从而促进大众创业，万众创新。(完)\r\n</p>',NULL,'shou-jie-yi-dong-hu-lian-wang-chuang-ye-feng-hui-ju-jiao-yi-dong-zhi-fu',1,0,'2017-04-26 03:00:20','2017-04-26 03:00:20'),(8,3,'去中心化：微信抄袭泛滥的原罪？',NULL,'如今微信公众号抄袭泛滥已经是不争的事实，早在今年初，新华社就已发文批判微信公众号抄袭严重，各媒体也呼吁“别让‘抄袭风’毁了微信平','<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 如今微信公众号抄袭泛滥已经是不争的事实，早在今年初，新华社就已发文批判微信公众号抄袭严重，各媒体也呼吁“别让‘抄袭风’毁了微信平台。今年5月份，上海律师朱斌提交的微信公众号抄袭的起诉状已被立案，书面受理通知已经发出，国内首起针对公众号抄袭的案例维权也即将启动。\r\n  </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 关于微信公众号，圈内有句话叫“1人原创，99人抄袭。”笔者最近多次在微信搜索本人文章标题，每篇文章的搜索结果达到几十到几百条不等，大号往往会署名，小号直接抄，不署名或者署上其他人的名字，然后改掉出处的比比皆是。如果要一个个去维权，可能耗费巨大的精力与时间，因此，有时候抓到有知名度的大V抄袭或转载会要求其删稿，但在看到一大波未授权的搜索结果的时候，有时候只能一声叹息。对于微信抄袭现象痛恨但无能为力，这可能是很多原创者共有的悲哀。\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n  目前，微信对公众平台泛滥的抄袭现状也开始有整顿措施，比如发布了处罚规则，侵权达五次将永久封号。另一方面，微信公众平台正式上线“原创声明”功能，第一批公测对象为微信认证的媒体类型公众账号。申请“原创声明”的文章发布后，“原创声明”系统会对会自动注明出处。微信内部有同学向笔者表示，目前仍是原创声明、评论、页面模板合成“原创保护”,按照原创度、原创文章数、注册时间筛选出符合条件的公众帐号，符合条件的帐号即可收到开通通知。\r\n </p>\r\n<h2 style=\"box-sizing:border-box;font-family:\" font-weight:500;line-height:1.1;color:#333333;margin-top:20px;margin-bottom:10px;font-size:30px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 去中心化意味着无为而治缺乏监控&nbsp;流量驱动导致泥沙俱下抄袭泛滥\r\n   </h2>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n  是什么造就了微信公众号抄袭的泛滥？这个我们从微信的去中心化去追溯。微信本质是一个中心化的平台，而微信公众平台是微信服务平台的一端，其本质是需要满足人们对各垂直领域多样化的阅读需求，所以把这部分平台开放出来，让各领域具备“认知盈余”的各类人进入平台提供垂直领域特色的资讯，这就是去中心化。\r\n     </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 去中心化导致的一个结果首先在于微信公众号账号开设的门槛低。可以说，任何人都可以开设公众账号，而公众账号运营者背后的动机无疑就是寄希望该账号形成巨大的粉丝量，进而通过流量变现。利益驱动导致微信公众号粗放式的扩张，泥沙俱下，平台的监管在此时已经难以跟进。\r\n   </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 张小龙曾经阐述微信的去中心化，他希望微信成为一座森林，而不是自建宫殿，所有的生物或者动植物能够在森林里面自由生长，而不是微信自己去建造。这个比喻很好的阐述了去中心化，即微信并不去引导、强设置一个中心化的流量入口来对接公众平台方、第三方。微信是通过无为而治，不引导不设限，让内容与用户行为在其中自由生长，让第三方去中心化地组织自己的客户。\r\n      </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 这导致的结果就是，所有人都必须自己去找流量与用户。流量与用户的来源对于小部分人来说，是来自于个人影响力，比如原微博大V可以通过引导将粉丝导入自身公众号，这部分人很容易可以形成海量粉丝。对于大部分公众号来说，找流量找客户，首先就要找内容。\r\n    </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 通过内容引导关注者分享，形成粉丝吸附力，这是完成利润创收的前提（比如微信公众号流量主开通需要5万粉丝）。但事实上，如前面所述，微信公众号没有任何门槛，结果是许多没有原创能力的公众号运营者都参与了进来，即便对这些抄袭者设置各种处罚条例，依然阻挡了这部分人对内容的复制搬运，这部分运营者如果不去抄袭、转载、搬运，他们的公众号便会荒芜。\r\n     </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 去中心化意味着微信公众号需要跟第三方一起来共同建造一个系统，这个系统的长盛不衰需要将优质内容源源不断的流动触达用户，而微信的去中心化的本质是不推荐、不引导、不监控，这决定了其对内容的放任姿态，在张小龙看来，没有平等话语权的平台里，很难有所谓的用户价值。这只对了一半，去中心化可以让优质内容脱颖而出，但事实上未必可以让优质内容创造者脱颖而出。\r\n    </p>\r\n<h2 style=\"box-sizing:border-box;font-family:\" font-weight:500;line-height:1.1;color:#333333;margin-top:20px;margin-bottom:10px;font-size:30px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 流量生意与去中心化的本质目的产生矛盾&nbsp;&nbsp;原创内容生产者的价值被忽视\r\n </h2>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n  虽然腾讯希望广大合作者能够借助微信平台的巨大能力，实现自身的成长，并同时反哺这个平台。但微信的流量机制又在倾向于扶持垂直领域的一个个中心化的流量个体，推动粉丝与流量的中心化。这里我们看到，微信引入广点通，为粉丝过5万的公众号开通流量主功能匹配流量广告，间接扶持内部的流量中心。\r\n</p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 流量中心不等于优质原创内容中心。在广点通正式放开之后，由于微信公众平台的去中心化形态，那些真正能生产优质原创内容但缺乏粉丝的自媒体，并不能从微信获得中心化的入口曝光与推荐。因为绝大多数有资格试水广点通的公众号以粉丝数为评判标准，这其中，去中心化的自然生长的机制孕育出许多复制粘贴党，变相掠夺别人的文章或内容充实自身的粉丝与流量与收入，并不断变相伤害原创作者本身的内容制造动力与价值释放。\r\n </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 这里看出，微信生态是一个矛盾的综合体。腾讯是做流量生意，流量生意的本质是将内容变现，广点通接入微信之后，即流量资源提供方对应自媒体运营者，共同向广告主收费，但从根本上，公众号导入的流量都被微信吸收。当优质内容被各个中心化的大号轻易拿去换取流量资源时，许多内容创造者的价值被践踏，因为并不是每个优质内容创造者都拥有粉丝号召力，而前面提到原创保护机制，事实上有极高门槛，将这部分原创者的版权保护权利被剥夺，这套机制反过来让原创者的优质文章等内容为其他拥有海量粉丝的大号做了嫁衣。从这里看，微信公众平台生态圈正在不可避免走在微博这种扶持大V的老路上。\r\n</p>\r\n<h2 style=\"box-sizing:border-box;font-family:\" font-weight:500;line-height:1.1;color:#333333;margin-top:20px;margin-bottom:10px;font-size:30px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 微信公众平台的稳定性需要中心化与去中心化的结合\r\n </h2>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n  张小龙曾经说过，如果没有关注任何公众号的话，可能看不到任何公众号的存在，微信并没有一个中心入口来提供给他们，这是去中心化在微信里面的一种体现。\r\n   </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 根据凯文凯利《失控》一书中论述的去中心化的观点就是：它没有强制性的中心控制，次级单位具有自治的特质，并且次级单位之间彼此高度连接。其中的优点很明显，表现为适应性强、可进化性、弹性、无限性、可以放大结果。所以对应到微信，张小龙就说到，每天有近千万的公众号，在微信里面很活跃，他们的活跃是他们通过自身的努力带来的。这里体现出成千上万的公众号的自适应性与无限性的增长可能，我们也看到微信的去中心化机制导致微信公众号迅速形成的指数级别增长。\r\n  </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 但缺点也很明显，就是不可控、不可预测、不可知。优质的原创内容、劣势的谣言、不可避免的版权侵权、不可阻挡的大量抄袭、人云亦云的鸡汤也从中不断涌现诞生这些负面效应不可避免也会对微信产生伤害力。\r\n    </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 去中心化可以对应到我国古代道家的思维本质。《道德经》里面讲：人法地，地法天，天法道，道法自然。讲究无为而治，不讲究控制，这可能是去中心化的思维。而儒家则讲“现世事功，治国平天下。”，讲主观能动性与控制，这是中心化的思维。在古代最终是儒家掌控了主导权，也确实也把这套思维打造成了一个封闭而又稳定的文化体系。而张小龙要把微信打造成一个动态而又稳定的系统，必然需要在去中心化的基础上，加上中心化的控制与主导。\r\n </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 去中心化的本质是让微信公众平台整个生态形成一个缺乏中心点的森林。微信作为一个封闭生态，让森林万物生长。但偌大的森林会将许多东西包裹隐藏起来，大量内容被抄袭同时，也缺乏一个中心化的流量入口去曝光监控它们。这时候去中心化往往会导致一种失控的局面——各种公众号为在基于找流量为自身创收导致抄袭的泛滥，让原创者生产内容的动力下降，并产生大量的原创内容版权法律纠纷，如果抄袭事件持续发酵导致后续大规模的侵权举报大量发生，伤害到的则是微信品牌本身。所以，去中心化的个体生存所依赖资源的资源越少，越需要控制力。公众号本身是偏媒体属性，媒体属性必须要有门槛。那么在这个基础上，必然需要引入中心化的控制，才能避免整个生态系统的失控。\r\n   </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 但去中心化是互联网界推崇的一种思维，在移动互联网行业，很少有产品能够像微信一样可以真正做到这一步。回到标题的命题，我们可以总结，优质原创内容是否为内容生产者带来利益与微信不是共赢关系，而优质内容是否产生足够多的流量才能与微信产生共赢关系，所以我们看到微信“原创保护”的对象也是针对流量大户：比如首先是认证的媒体或企业公众号，运营时间在1年以上，且有持续的运营规划，且按照原创度、原创文章数、注册时间筛选出符合条件的公众帐号。这套过滤机制几乎将绝大部分公众号挡在了原创保护之外。\r\n  </p>\r\n<p class=\"text\" style=\"box-sizing:border-box;margin-top:0px;margin-bottom:20px;line-height:24px;color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#ffffff;\"=\"\">\r\n 因为微信公众平台去中心化的设计，本质是流量生意，每一个公众号个体自己创造或聚拢流量，每一个小的中心都在为整个微信平台大池子贡献流量，各种中心化的个体针对各种原创内容的抄袭转载恰恰让优质内容在公众号之间不断流转，带动了用户活跃度，也带动了整个微信自媒体内容生态圈的繁荣。只有优质内容被持续搬运到流量大户，才能将盘子做大，这符合微信生态设计的愿景，这种顶层设计可能才是微信公众平台抄袭泛滥的原罪。\r\n    </p>',NULL,'qu-zhong-xin-hua-wei-xin-chao-xi-fan-lan-de-yuan-zui',1,0,'2017-04-26 03:00:45','2017-04-26 07:15:15');

/*Table structure for table `li_attrs` */

DROP TABLE IF EXISTS `li_attrs`;

CREATE TABLE `li_attrs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_attrs` */

insert  into `li_attrs`(`id`,`filename`,`url`,`created_at`,`updated_at`) values (1,'1.jpg','/upload/attrs/20170426/20170426025447707.jpg','2017-04-26 02:54:47','2017-04-26 02:54:47'),(2,'11.jpg','/upload/attrs/20170426/20170426025511384.jpg','2017-04-26 02:55:11','2017-04-26 02:55:11'),(3,'4.jpg','/upload/attrs/20170426/20170426025521561.jpg','2017-04-26 02:55:21','2017-04-26 02:55:21'),(4,'3.jpg','/upload/attrs/20170426/20170426025533930.jpg','2017-04-26 02:55:33','2017-04-26 02:55:33'),(5,'1.jpg','/upload/attrs/20170426/20170426025559900.jpg','2017-04-26 02:55:59','2017-04-26 02:55:59'),(6,'8.jpeg','/upload/attrs/20170426/20170426025746572.jpeg','2017-04-26 02:57:46','2017-04-26 02:57:46'),(7,'6.jpeg','/upload/attrs/20170426/20170426025817159.jpeg','2017-04-26 02:58:17','2017-04-26 02:58:17'),(8,'11.jpg','/upload/attrs/20170426/20170426025856717.jpg','2017-04-26 02:58:56','2017-04-26 02:58:56'),(9,'5.jpeg','/upload/attrs/20170426/20170426025921737.jpeg','2017-04-26 02:59:21','2017-04-26 02:59:21'),(10,'9.jpeg','/upload/attrs/20170426/20170426065951690.jpeg','2017-04-26 06:59:51','2017-04-26 06:59:51'),(11,'1.jpg','/upload/20170427/20170427071412169.jpg','2017-04-27 07:14:12','2017-04-27 07:14:12'),(12,'1.jpg','/upload/thumb/20170427/20170427072152911.jpg','2017-04-27 07:21:52','2017-04-27 07:21:52'),(13,'2.jpg','/upload/thumb/20170427/20170427072236213.jpg','2017-04-27 07:22:36','2017-04-27 07:22:36'),(14,'2.jpg','/upload/20170427/20170427072519387.jpg','2017-04-27 07:25:19','2017-04-27 07:25:19'),(15,'3.jpg','/upload/20170427/20170427072624513.jpg','2017-04-27 07:26:24','2017-04-27 07:26:24'),(16,'4.jpg','/upload/20170427/20170427072744814.jpg','2017-04-27 07:27:44','2017-04-27 07:27:44');

/*Table structure for table `li_carts` */

DROP TABLE IF EXISTS `li_carts`;

CREATE TABLE `li_carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'sessionId',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `good_id` int(11) NOT NULL COMMENT '商品ID',
  `format_id` int(11) NOT NULL COMMENT '商品属性ID',
  `nums` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `total_prices` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总价',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_session_id_index` (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_carts` */

/*Table structure for table `li_categorys` */

DROP TABLE IF EXISTS `li_categorys`;

CREATE TABLE `li_categorys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(11) unsigned NOT NULL,
  `arrparentid` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `child` tinyint(4) NOT NULL,
  `arrchildid` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标题',
  `keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '关键字',
  `describe` text COLLATE utf8_unicode_ci,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_categorys` */

insert  into `li_categorys`(`id`,`parentid`,`arrparentid`,`child`,`arrchildid`,`name`,`thumb`,`title`,`keyword`,`describe`,`content`,`theme`,`type`,`url`,`listorder`,`created_at`,`updated_at`) values (1,0,'0',0,'1','关于我们','/upload/attrs/20170426/20170426025447707.jpg','希夷信息技术工作室','希夷信息技术工作室','希夷工作室：拥有多名优秀成员，整个团队工作分工明确，又相互衔接，密不可分。为跟进技术变革，我工作室对工作人员进行定期定向技能培训，保证市场人员拥有先进的行业理念，客服人员可以创造一流的服务质量，设计人员具有敏锐的视觉洞察力，开发人员保持在技术发展的最前延，我们始终认为：不间断的学习才能在飞速发展的互联网时代长久立足。','<span style=\"color:#333333;font-family:\" font-size:14px;white-space:normal;background-color:#f2efea;\"=\"\">\r\n<div class=\"page_content mt30\" style=\"box-sizing:border-box;border:0px;background-image:initial;background-position:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;margin:30px 0px 0px;padding:0px;color:#333333;font-family:\" font-size:14px;white-space:normal;\"=\"\">\r\n<div class=\"bg_about pd30 clearfix\" style=\"box-sizing:border-box;border:0px;background:#F2EFEA;margin:0px;padding:30px;\">\r\n	<div class=\"pull-right about_img\" style=\"box-sizing:border-box;border:0px;background:transparent;margin:0px;padding:0px;float:right !important;\">\r\n		<img src=\"https://img.ibomedia.ca/2016/02/cnt-p04-590x700.jpg\" class=\"img-responsive\" alt=\"\" style=\"box-sizing:border-box;vertical-align:middle;background:transparent;margin:0px;padding:0px;display:block;max-width:100%;height:auto;\" /> \r\n	</div>\r\n	<div class=\"bg_about __reader_view_article_wrap_8603891041262857__\" style=\"box-sizing:border-box;border:0px;background-image:initial;background-position:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;margin:0px;padding:0px;\">\r\n		<h2 class=\"about_h2\" style=\"box-sizing:border-box;font-family:inherit;font-weight:normal;line-height:1.1;color:inherit;margin:30px 0px;font-size:30px;border-width:0px 0px 5px;border-top-style:initial;border-right-style:initial;border-bottom-style:solid;border-left-style:initial;border-top-color:initial;border-right-color:initial;border-bottom-color:#FFFFFF;border-left-color:initial;border-image:initial;background:transparent;padding:0px 0px 30px;\">\r\n			希夷 工作室\r\n		</h2>\r\n		<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:0px;border:0px;background:transparent;padding:0px;\">\r\n			希夷工作室：拥有多名优秀成员，整个团队工作分工明确，又相互衔接，密不可分。为跟进技术变革，我工作室对工作人员进行定期定向技能培训，保证市场人员拥有先进的行业理念，客服人员可以创造一流的服务质量，设计人员具有敏锐的视觉洞察力，开发人员保持在技术发展的最前延，我们始终认为：不间断的学习才能在飞速发展的互联网时代长久立足。\r\n		</p>\r\n		<h2 class=\"about_h2\" style=\"box-sizing:border-box;font-family:inherit;font-weight:normal;line-height:1.1;color:inherit;margin:30px 0px;font-size:30px;border-width:0px 0px 5px;border-top-style:initial;border-right-style:initial;border-bottom-style:solid;border-left-style:initial;border-top-color:initial;border-right-color:initial;border-bottom-color:#FFFFFF;border-left-color:initial;border-image:initial;background:transparent;padding:0px 0px 30px;\">\r\n			核心 理念\r\n		</h2>\r\n		<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:0px;border:0px;background:transparent;padding:0px;\">\r\n			希夷工作室自成立之日一直致力于为客户提升企业形象，创造实际市场价值。因为我们始终从市场的角度与客户本身状态出发，帮助客户找到真正的自我价值，树立良好企业形象，同时展开市场拓展，使得许多客户在同行业激烈竞争中突显出了更高层次的品牌价值。\r\n		</p>\r\n		<h2 class=\"about_h2\" style=\"box-sizing:border-box;font-family:inherit;font-weight:normal;line-height:1.1;color:inherit;margin:30px 0px;font-size:30px;border-width:0px 0px 5px;border-top-style:initial;border-right-style:initial;border-bottom-style:solid;border-left-style:initial;border-top-color:initial;border-right-color:initial;border-bottom-color:#FFFFFF;border-left-color:initial;border-image:initial;background:transparent;padding:0px 0px 30px;\">\r\n			工作 目标\r\n		</h2>\r\n		<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:0px;border:0px;background:transparent;padding:0px;\">\r\n			希夷工作室，以本地的市场为主为多家企业事业单位提供技术支持。我们旨在专心做技术，良心做服务，希望通过专业技术与真诚服务为不同客户创造高质量服务，同时塑造一个立身本地的人性化品牌服务团队。\r\n		</p>\r\n		<p style=\"box-sizing:border-box;margin-top:0px;margin-bottom:0px;border:0px;background:transparent;padding:0px;\">\r\n			《老子》：“视之不见名曰夷，听之不闻名曰希。”虚寂玄妙。\r\n		</p>\r\n	</div>\r\n</div>\r\n	</div>\r\n</span>','page',1,'guan-yu-wo-men',0,'2017-04-26 00:42:45','2017-04-27 06:22:58'),(2,0,'0',0,'2','产品中心','/upload/attrs/20170426/20170426065951690.jpeg','产品中心',NULL,NULL,NULL,'list_pro',0,'chan-pin-zhong-xin',0,'2017-04-26 02:48:36','2017-04-26 06:59:54'),(3,0,'0',0,'3','新闻资讯','/upload/attrs/20170426/20170426025521561.jpg','新闻资讯',NULL,NULL,NULL,'list',0,'xin-wen-zi-xun',0,'2017-04-26 02:49:00','2017-04-26 02:55:23'),(4,0,'0',0,'4','联系我们','/upload/attrs/20170426/20170426025533930.jpg','联系我们',NULL,NULL,NULL,'page',1,'lian-xi-wo-men',0,'2017-04-26 02:49:14','2017-04-26 02:55:35');

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

insert  into `li_config`(`id`,`sitename`,`title`,`keyword`,`describe`,`theme`,`person`,`phone`,`email`,`address`,`content`,`created_at`,`updated_at`) values (1,'希夷SHOP','希夷SHOP',NULL,NULL,'default','李','18932813211','yanLq@muzisheji.com / liZG@muzisheji.com','地址：河北省衡水市育才街永兴路口逸升佳苑29号楼1011','希夷工作室：拥有多名优秀成员，整个团队工作分工明确，又相互衔接，密不可分。为跟进技术变革，我工作室对工作人员进行定期定向技能培训，保证市场人员拥有先进的行业理念，客服人员可以创造一流的服务质量，设计人员具有敏锐的视觉洞察力，开发人员保持在技术发展的最前延，我们始终认为：不间断的学习才能在飞速发展的互联网时代长久立足。',NULL,'2017-04-27 07:45:34');

/*Table structure for table `li_good_attrs` */

DROP TABLE IF EXISTS `li_good_attrs`;

CREATE TABLE `li_good_attrs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '属性名称',
  `value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '属性值',
  `unit` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '单位',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态，1正常0禁用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_good_attrs` */

insert  into `li_good_attrs`(`id`,`parentid`,`name`,`value`,`unit`,`status`,`created_at`,`updated_at`) values (1,0,'身高','height','cm',1,'2017-03-12 10:02:22','2017-04-27 08:22:11'),(2,1,'长','180',NULL,1,'2017-03-12 10:04:10','2017-04-27 08:22:54'),(3,1,'中','175',NULL,1,'2017-03-12 10:05:48','2017-04-27 08:22:58'),(4,1,'短','170',NULL,1,'2017-03-12 10:05:55','2017-04-27 08:23:03'),(5,0,'型号','model',NULL,1,'2017-03-12 10:06:09','2017-04-27 08:22:39'),(6,5,'1','XXL',NULL,1,'2017-03-12 10:06:19','2017-04-27 08:21:27'),(7,5,'2','XL',NULL,1,'2017-03-12 10:06:24','2017-04-27 08:21:32'),(8,5,'3','L',NULL,1,'2017-03-12 10:06:28','2017-04-27 08:21:36'),(9,1,'低','165',NULL,1,'2017-04-27 08:23:14','2017-04-27 08:23:14');

/*Table structure for table `li_good_cate_attr` */

DROP TABLE IF EXISTS `li_good_cate_attr`;

CREATE TABLE `li_good_cate_attr` (
  `cate_id` int(11) NOT NULL COMMENT '分类ID',
  `attr_id` int(11) NOT NULL COMMENT '属性ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_good_cate_attr` */

insert  into `li_good_cate_attr`(`cate_id`,`attr_id`) values (4,5),(5,1),(5,5);

/*Table structure for table `li_good_cates` */

DROP TABLE IF EXISTS `li_good_cates`;

CREATE TABLE `li_good_cates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '父ID',
  `arrparentid` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '所有父ID',
  `child` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否有子栏目',
  `arrchildid` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '所有子栏目',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '栏目名称',
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '缩略图',
  `seotitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'SEO标题',
  `keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '关键字',
  `describe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '描述',
  `sort` mediumint(9) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态，1正常0禁用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_good_cates` */

insert  into `li_good_cates`(`id`,`parentid`,`arrparentid`,`child`,`arrchildid`,`name`,`thumb`,`seotitle`,`keyword`,`describe`,`sort`,`status`,`created_at`,`updated_at`) values (3,'0','0',1,'3,5','服饰',NULL,'服饰',NULL,NULL,0,1,'2017-03-12 10:37:31','2017-04-27 07:49:29'),(4,'6','0,6',0,'4','男装','','','','',0,1,'2017-03-12 10:37:44','2017-03-12 10:48:40'),(5,'3','0,3',0,'5','女装',NULL,'女装',NULL,NULL,0,1,'2017-03-12 10:37:48','2017-04-27 08:03:47'),(6,'0','0',1,'6,4,7,8','配件','','','','',0,1,'2017-03-12 10:38:03','2017-03-12 10:48:40'),(7,'6','0,6',0,'7','衣帽','','','','',0,1,'2017-03-12 10:38:10','2017-03-12 10:46:21'),(8,'6','0,6',0,'8','鞋子','','','','',0,1,'2017-03-12 10:38:33','2017-03-12 10:46:21');

/*Table structure for table `li_good_formats` */

DROP TABLE IF EXISTS `li_good_formats`;

CREATE TABLE `li_good_formats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL COMMENT '商品ID',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '属性名称',
  `attr_ids` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '属性ID（4-5-6）',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `store` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态，1正常0删除',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_good_formats` */

insert  into `li_good_formats`(`id`,`good_id`,`title`,`attr_ids`,`price`,`store`,`status`,`created_at`,`updated_at`) values (11,1,'身高-型号','-3-7-','100.00',2000,1,'2017-04-27 08:29:44','2017-04-27 08:29:44'),(12,1,'身高-型号','-4-8-','120.00',120,1,'2017-04-27 08:29:54','2017-04-27 08:29:54'),(13,1,'身高-型号','-2-7-','180.00',10000,1,'2017-04-27 08:30:02','2017-04-27 08:30:02'),(14,2,'身高-型号','-9-7-','100.00',1500,1,'2017-04-27 08:30:15','2017-04-27 08:30:15'),(15,2,'身高-型号','-3-8-','100.00',1500,1,'2017-04-27 08:30:23','2017-04-27 08:30:23'),(16,2,'身高-型号','-3-7-','1111.00',22222,1,'2017-04-27 08:31:51','2017-04-27 08:31:51'),(17,3,'身高-型号','-2-6-','111.00',23232,1,'2017-04-27 08:32:08','2017-04-27 08:32:08');

/*Table structure for table `li_goods` */

DROP TABLE IF EXISTS `li_goods`;

CREATE TABLE `li_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) NOT NULL COMMENT '商品分类ID',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `pronums` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '商品编号',
  `keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '关键字',
  `describe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '描述',
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '缩略图',
  `content` text COLLATE utf8_unicode_ci COMMENT '内容',
  `notice` text COLLATE utf8_unicode_ci COMMENT '购买须知',
  `pack` text COLLATE utf8_unicode_ci COMMENT '规格包装',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态，1正常0删除',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_goods` */

insert  into `li_goods`(`id`,`cate_id`,`title`,`pronums`,`keyword`,`describe`,`thumb`,`content`,`notice`,`pack`,`price`,`status`,`created_at`,`updated_at`) values (1,5,'Purcarbon连衣裙2017春夏季新款韩版大码女装包臀短袖V领打底裙中长款裙子',NULL,'213',NULL,'/upload/20170427/20170427071412169.jpg','<img alt=\"\" id=\"465b4afcd01f471091ac481eaa2183ef \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t3226/251/9117712133/149278/d7ae7a97/58d0d5e7N033d322e.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\"><br style=\"color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\">\r\n<img alt=\"\" id=\"31a9ea7e14af4851a719fbc39fd97ee8 \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t4303/198/2426168568/158315/274fda96/58d0d5e8N090f6236.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\">','<img alt=\"\" id=\"333a2fb17af9448d8e22f12ca428e80d \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t4402/229/523163245/91691/b56d78a1/58d0d5faN0ce730a1.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\"><br style=\"color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\">\r\n<img alt=\"\" id=\"eab21c18268144ff9e1a247c5f65b481 \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t5026/61/78016391/288097/d193e41e/58da2fbbN06a8bdc3.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\">','<img alt=\"\" id=\"75ec1b1547a94133a5c26506b1ad2082 \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t3304/118/9076285400/101288/dd38e40d/58d0d5e6N1f35a02e.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\">','50.00',1,'2017-03-12 11:16:43','2017-04-27 07:23:43'),(2,5,'聚颜 连衣裙2017春夏装新款A字短裙修身雪纺上衣连衣裙套装',NULL,'1',NULL,'/upload/20170427/20170427072519387.jpg','<img alt=\"\" id=\"460ba61fbb3f4913aa578b90629526c3 \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t4987/262/940814703/840104/93155044/58eab8f3N524e5b00.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\">','<img alt=\"\" id=\"0a8c9f81ed83482d80058992eef33e85 \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t4537/202/2027131489/388791/c2a56f7c/58eab8faN883c4e52.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\"><br style=\"color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\">\r\n<img alt=\"\" id=\"59376a0e0fd04835a5e8bcfb202088f7 \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t4918/109/936888874/487110/143c455c/58eab900Ndc1bbcfd.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\">','<img alt=\"\" id=\"9c49f627e02a452d9973c2dca515773b \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t4726/85/928960699/274062/943fa89/58eab8fdNbf4b8a88.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, \" white-space:normal;background-color:#ffffff;\"=\"\">','20.00',1,'2017-03-16 09:24:42','2017-04-27 07:25:23'),(3,5,'轩薇阁连衣裙2017春装夏季新品女装蕾丝雪纺印花棉麻长袖连衣裙套装女 酒红色',NULL,NULL,NULL,'/upload/20170427/20170427072624513.jpg','<img alt=\"\" id=\"0de7861f6230425c83fd8a10866de6b0 \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t4252/282/2321199373/519241/6537ba2b/58cfa403N6fb7f596.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, &quot;text-align:center;white-space:normal;background-color:#FFFFFF;\" />','<div style=\"margin:0px;padding:0px;color:#666666;font-family:tahoma, arial, &quot;white-space:normal;background-color:#FFFFFF;text-align:center;\">\r\n	<img alt=\"\" id=\"5cd846d31b5c4c01a6adc2ecc075e377 \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t4681/146/458567850/363219/4f0774bd/58cfa404Nb7e4f0ac.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;\" />\r\n</div>\r\n<div style=\"margin:0px;padding:0px;color:#666666;font-family:tahoma, arial, &quot;white-space:normal;background-color:#FFFFFF;text-align:center;\">\r\n	<img alt=\"\" id=\"fd5e5f85ebb24e7d955cf001e3e2980d \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t4384/303/2316359606/406210/b9b639a4/58cfa401Ncf02adeb.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;\" />\r\n</div>','<img alt=\"\" id=\"57808b2acb6f4e6280484850eff714a8 \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t4585/145/447551182/99424/891a5544/58cfa407N77607fa5.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, &quot;text-align:center;white-space:normal;background-color:#FFFFFF;\" />','300.00',1,'2017-04-27 07:26:44','2017-04-27 07:26:44'),(4,4,'马克华菲短袖T恤男士2017夏装新款韩版圆领修身纯色t恤打底衫',NULL,NULL,NULL,'/upload/20170427/20170427072744814.jpg','<img alt=\"\" id=\"ca86b06760e74644a37a0888584e25aa \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t3250/321/6935994571/388696/80e01d2f/58af9870Nce0ea6c4.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, &quot;white-space:normal;background-color:#FFFFFF;\" /><br style=\"color:#666666;font-family:tahoma, arial, &quot;white-space:normal;background-color:#FFFFFF;\" />\r\n<img alt=\"\" id=\"281e95329e9541af8b181c63beeb586f \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t3259/263/6927283466/262866/f5537229/58af9873N1b71b304.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, &quot;white-space:normal;background-color:#FFFFFF;\" />','<img alt=\"\" id=\"8ff2379345c1452595670d4cae2bef45 \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t3073/207/6917026873/137062/c5ef807e/58af9872N307899e2.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, &quot;white-space:normal;background-color:#FFFFFF;\" />','<img alt=\"\" id=\"70b6f625a33944018370a5cc5db81b48 \" class=\"\" src=\"https://img30.360buyimg.com/popWaterMark/jfs/t4162/166/112424885/210991/bd259396/58af9876N9076bb2a.jpg\" style=\"margin:0px;padding:0px;vertical-align:middle;color:#666666;font-family:tahoma, arial, &quot;white-space:normal;background-color:#FFFFFF;\" />','150.00',1,'2017-04-27 07:28:21','2017-04-27 07:28:21');

/*Table structure for table `li_groups` */

DROP TABLE IF EXISTS `li_groups`;

CREATE TABLE `li_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户组名',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态，1正常0禁用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_groups` */

insert  into `li_groups`(`id`,`name`,`status`,`created_at`,`updated_at`) values (1,'普通用户',1,'2017-04-20 16:56:40','2017-04-20 16:57:00'),(2,'VIP用户',1,'2017-04-20 16:56:51','2017-04-20 16:56:51');

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
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_logs` */

insert  into `li_logs`(`id`,`admin_id`,`user`,`url`,`created_at`) values (1,1,'admin','/admin/menu/add/5','2017-04-25 21:49:13'),(2,1,'admin','/admin/menu/edit/6','2017-04-25 21:49:24'),(3,1,'admin','/admin/menu/edit/151','2017-04-25 21:49:45'),(4,1,'admin','/admin/menu/edit/148','2017-04-25 21:50:02'),(5,1,'admin','/admin/menu/edit/67','2017-04-25 21:50:09'),(6,1,'admin','/admin/config/index','2017-04-25 21:58:45'),(7,1,'admin','/xycms/config/index','2017-04-25 15:07:35'),(8,1,'admin','/xycms/config/index','2017-04-25 15:08:31'),(9,1,'admin','/xycms/menu/edit/28','2017-04-25 15:08:49'),(10,1,'admin','/xycms/admin/pwd/2','2017-04-25 15:10:08'),(11,1,'admin','/xycms/admin/pwd/2','2017-04-25 15:10:21'),(12,1,'admin','/xycms/admin/pwd/2','2017-04-25 15:11:09'),(13,1,'admin','/xycms/cate/add/0','2017-04-26 00:41:07'),(14,1,'admin','/xycms/cate/add/0','2017-04-26 00:42:04'),(15,1,'admin','/xycms/cate/add/0','2017-04-26 00:42:45'),(16,1,'admin','/xycms/menu/edit/174','2017-04-26 00:43:00'),(17,1,'admin','/xycms/type/add/0','2017-04-26 00:43:07'),(18,1,'admin','/xycms/log/del','2017-04-26 00:43:13'),(19,1,'admin','/xycms/admin/add','2017-04-26 00:43:33'),(20,1,'admin','/xycms/role/add','2017-04-26 00:43:44'),(21,1,'admin','/xycms/config/index','2017-04-26 00:50:25'),(22,1,'admin','/xycms/config/index','2017-04-26 00:52:54'),(23,1,'admin','/xycms/config/index','2017-04-26 00:53:26'),(24,1,'admin','/xycms/config/index','2017-04-26 01:43:21'),(25,1,'admin','/xycms/cate/add/0','2017-04-26 02:48:36'),(26,1,'admin','/xycms/cate/add/0','2017-04-26 02:49:00'),(27,1,'admin','/xycms/cate/add/0','2017-04-26 02:49:14'),(28,1,'admin','/xycms/attr/uploadimg?dir=image','2017-04-26 02:54:47'),(29,1,'admin','/xycms/cate/edit/1','2017-04-26 02:54:54'),(30,1,'admin','/xycms/attr/uploadimg?dir=image','2017-04-26 02:55:11'),(31,1,'admin','/xycms/cate/edit/2','2017-04-26 02:55:14'),(32,1,'admin','/xycms/attr/uploadimg?dir=image','2017-04-26 02:55:21'),(33,1,'admin','/xycms/cate/edit/3','2017-04-26 02:55:23'),(34,1,'admin','/xycms/attr/uploadimg?dir=image','2017-04-26 02:55:33'),(35,1,'admin','/xycms/cate/edit/4','2017-04-26 02:55:34'),(36,1,'admin','/xycms/attr/uploadimg?dir=image','2017-04-26 02:55:59'),(37,1,'admin','/xycms/art/add','2017-04-26 02:56:23'),(38,1,'admin','/xycms/art/add','2017-04-26 02:57:01'),(39,1,'admin','/xycms/art/edit/1','2017-04-26 02:57:19'),(40,1,'admin','/xycms/attr/uploadimg?dir=image','2017-04-26 02:57:46'),(41,1,'admin','/xycms/art/add','2017-04-26 02:57:50'),(42,1,'admin','/xycms/attr/uploadimg?dir=image','2017-04-26 02:58:17'),(43,1,'admin','/xycms/art/add/2','2017-04-26 02:58:20'),(44,1,'admin','/xycms/attr/uploadimg?dir=image','2017-04-26 02:58:56'),(45,1,'admin','/xycms/art/add/2','2017-04-26 02:58:59'),(46,1,'admin','/xycms/attr/uploadimg?dir=image','2017-04-26 02:59:21'),(47,1,'admin','/xycms/art/add','2017-04-26 02:59:34'),(48,1,'admin','/xycms/art/add/3','2017-04-26 03:00:02'),(49,1,'admin','/xycms/art/add/3','2017-04-26 03:00:20'),(50,1,'admin','/xycms/art/add/3','2017-04-26 03:00:45'),(51,1,'admin','/xycms/cate/edit/1','2017-04-26 03:01:44'),(52,1,'admin','/xycms/config/index','2017-04-26 06:41:15'),(53,1,'admin','/xycms/art/edit/8','2017-04-26 06:47:48'),(54,1,'admin','/xycms/art/edit/8','2017-04-26 06:51:40'),(55,1,'admin','/xycms/art/edit/8','2017-04-26 06:51:51'),(56,1,'admin','/xycms/attr/uploadimg?dir=image','2017-04-26 06:59:51'),(57,1,'admin','/xycms/cate/edit/2','2017-04-26 06:59:54'),(58,1,'admin','/xycms/art/edit/8','2017-04-26 07:13:08'),(59,1,'admin','/xycms/art/edit/8','2017-04-26 07:15:15'),(60,1,'admin','/xyshop/menu/edit/202','2017-04-27 06:22:35'),(61,1,'admin','/xyshop/cate/edit/1','2017-04-27 06:22:53'),(62,1,'admin','/xyshop/cate/edit/1','2017-04-27 06:22:58'),(63,1,'admin','/xyshop/good/edit/1','2017-04-27 06:30:05'),(64,1,'admin','/xyshop/good/edit/2','2017-04-27 06:30:11'),(65,1,'admin','/xyshop/goodcate/edit/5','2017-04-27 06:30:59'),(66,1,'admin','/xyshop/good/edit/1','2017-04-27 07:07:59'),(67,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:10:42'),(68,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:12:22'),(69,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:13:01'),(70,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:14:12'),(71,1,'admin','/xyshop/good/edit/1','2017-04-27 07:15:50'),(72,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:15:57'),(73,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:16:33'),(74,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:16:53'),(75,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:17:22'),(76,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:18:56'),(77,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:19:15'),(78,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:19:28'),(79,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:21:37'),(80,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:21:52'),(81,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:22:36'),(82,1,'admin','/xyshop/good/edit/2','2017-04-27 07:23:07'),(83,1,'admin','/xyshop/good/edit/2','2017-04-27 07:23:26'),(84,1,'admin','/xyshop/good/edit/1','2017-04-27 07:23:43'),(85,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:25:19'),(86,1,'admin','/xyshop/good/edit/2','2017-04-27 07:25:23'),(87,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:26:24'),(88,1,'admin','/xyshop/good/add','2017-04-27 07:26:44'),(89,1,'admin','/xyshop/attr/uploadimg?dir=image','2017-04-27 07:27:44'),(90,1,'admin','/xyshop/good/add','2017-04-27 07:28:21'),(91,1,'admin','/xyshop/config/index','2017-04-27 07:45:34'),(92,1,'admin','/xyshop/goodcate/edit/3','2017-04-27 07:49:28'),(93,1,'admin','/xyshop/goodcate/edit/5','2017-04-27 08:03:47'),(94,1,'admin','/xyshop/goodattr/edit/6','2017-04-27 08:21:27'),(95,1,'admin','/xyshop/goodattr/edit/7','2017-04-27 08:21:32'),(96,1,'admin','/xyshop/goodattr/edit/8','2017-04-27 08:21:36'),(97,1,'admin','/xyshop/goodattr/edit/1','2017-04-27 08:22:05'),(98,1,'admin','/xyshop/goodattr/edit/1','2017-04-27 08:22:11'),(99,1,'admin','/xyshop/goodattr/edit/5','2017-04-27 08:22:39'),(100,1,'admin','/xyshop/goodattr/edit/2','2017-04-27 08:22:54'),(101,1,'admin','/xyshop/goodattr/edit/3','2017-04-27 08:22:58'),(102,1,'admin','/xyshop/goodattr/edit/4','2017-04-27 08:23:03'),(103,1,'admin','/xyshop/goodattr/add/1','2017-04-27 08:23:14'),(104,1,'admin','/xyshop/good/delformat/4','2017-04-27 08:28:30'),(105,1,'admin','/xyshop/good/addformat/1','2017-04-27 08:29:44'),(106,1,'admin','/xyshop/good/addformat/1','2017-04-27 08:29:54'),(107,1,'admin','/xyshop/good/addformat/1','2017-04-27 08:30:02'),(108,1,'admin','/xyshop/good/addformat/2','2017-04-27 08:30:15'),(109,1,'admin','/xyshop/good/addformat/2','2017-04-27 08:30:22'),(110,1,'admin','/xyshop/good/addformat/2','2017-04-27 08:30:34'),(111,1,'admin','/xyshop/good/addformat/2','2017-04-27 08:30:49'),(112,1,'admin','/xyshop/good/addformat/2','2017-04-27 08:31:51'),(113,1,'admin','/xyshop/good/addformat/2','2017-04-27 08:31:58'),(114,1,'admin','/xyshop/good/addformat/3','2017-04-27 08:32:08'),(115,1,'admin','/xyshop/pay/edit/1','2017-04-27 10:14:21'),(116,1,'admin','/xyshop/pay/edit/1','2017-04-27 10:14:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_menus` */

insert  into `li_menus`(`id`,`parentid`,`arrparentid`,`child`,`arrchildid`,`name`,`url`,`label`,`display`,`listorder`,`created_at`,`updated_at`) values (1,0,'0',1,'1,5,6,7,8,9,67,68,74,148,149,150,151,152,153,154,202,204,205,10,11,12,13,14,15,16,17,18,19,140,170,171,172,173,20,21,143,144,145','系统','index/index','index-index',1,0,'2016-03-18 15:46:02','2017-04-27 06:22:35'),(2,0,'0',1,'2,22,23,24,25,26,27,28,29,75,30,31,32,33,34,121,136','内容','content/index','content-index',1,0,'2016-03-18 15:46:21','2016-12-14 10:15:49'),(5,1,'0,1',1,'5,6,7,8,9,67,68,74,148,149,150,151,152,153,154,202,204,205','系统设置','sys/index','sys-index',1,0,'2016-03-18 15:47:40','2017-04-27 06:22:35'),(6,5,'0,1,5',1,'6,7,8,9','菜单管理','menu/index','menu-index',1,1,'2016-03-18 15:48:07','2017-04-25 21:49:25'),(7,6,'0,1,5,6',0,'7','添加菜单','menu/add','menu-add',1,0,'2016-03-18 15:49:03','2016-03-23 08:25:50'),(8,6,'0,1,5,6',0,'8','修改菜单','menu/edit','menu-edit',0,0,'2016-03-18 15:51:08','2016-03-23 14:23:43'),(9,6,'0,1,5,6',0,'9','删除菜单','menu/del','menu-del',0,0,'2016-03-18 15:51:30','2016-03-23 08:25:50'),(10,1,'0,1',1,'10,11,12,13,14,15,16,17,18,19,140,170,171,172,173','用户中心','admin/manage','admin-manage',1,0,'2016-03-18 16:04:01','2016-12-15 08:32:44'),(11,10,'0,1,10',1,'11,12,13,14,15','用户管理','admin/index','admin-index',1,0,'2016-03-18 16:04:38','2016-03-24 11:31:08'),(12,11,'0,1,10,11',0,'12','添加用户','admin/add','admin-add',1,0,'2016-03-18 16:05:14','2016-03-24 11:31:16'),(13,11,'0,1,10,11',0,'13','修改用户','admin/edit','admin-edit',0,0,'2016-03-18 16:06:10','2016-03-24 11:31:24'),(14,11,'0,1,10,11',0,'14','删除用户','admin/del','admin-del',0,0,'2016-03-18 16:06:31','2016-03-24 11:31:32'),(15,11,'0,1,10,11',0,'15','修改密码','admin/pwd','admin-pwd',0,0,'2016-03-18 16:07:07','2016-03-24 11:31:44'),(16,10,'0,1,10',1,'16,17,18,19,140','角色管理','role/index','role-index',1,0,'2016-03-18 16:07:58','2016-12-02 09:41:15'),(17,16,'0,1,10,16',0,'17','添加角色','role/add','role-add',1,0,'2016-03-18 16:08:23','2016-03-23 08:25:50'),(18,16,'0,1,10,16',0,'18','修改角色','role/edit','role-edit',0,0,'2016-03-18 16:08:50','2016-03-23 08:25:50'),(19,16,'0,1,10,16',0,'19','删除角色','role/del','role-del',0,0,'2016-03-18 16:09:10','2016-03-23 08:25:50'),(20,1,'0,1',1,'20,21','系统信息','index/main','index-main',0,0,'2016-03-24 15:42:14','2016-03-25 10:34:44'),(21,20,'0,1,20',0,'21','左侧菜单','index/left','index-left',0,0,'2016-03-25 10:34:44','2016-03-25 10:35:27'),(22,2,'0,2',1,'22,23,24,25,26,27,28,29,75,30,31,32,33,34,121,136','内容管理','content/manage','content-manage',1,0,'2016-03-29 08:39:52','2016-12-02 09:44:29'),(23,22,'0,2,22',1,'23,24,25,26,27','栏目管理','cate/index','cate-index',1,0,'2016-03-29 08:40:08','2016-03-29 08:41:30'),(24,23,'0,2,22,23',0,'24','添加栏目','cate/add','cate-add',1,0,'2016-03-29 08:40:25','2016-03-29 08:40:25'),(25,23,'0,2,22,23',0,'25','修改栏目','cate/edit','cate-edit',0,0,'2016-03-29 08:40:42','2016-03-29 08:41:00'),(26,23,'0,2,22,23',0,'26','删除栏目','cate/del','cate-del',0,0,'2016-03-29 08:40:54','2016-03-29 08:41:07'),(27,23,'0,2,22,23',0,'27','更新栏目缓存','cate/cache','cate-cache',0,0,'2016-03-29 08:41:30','2016-03-29 08:41:30'),(28,22,'0,2,22',1,'28,29,75','附件管理','attr/index','attr-index',0,5,'2016-03-31 08:23:28','2017-04-25 15:08:49'),(29,28,'0,2,22,28',0,'29','上传图片','attr/uploadimg','attr-uploadimg',0,0,'2016-03-31 08:24:45','2016-06-14 19:12:33'),(30,22,'0,2,22',1,'30,31,32,33,34,121,136','文章管理','art/index','art-index',1,0,'2016-03-31 08:25:22','2016-12-02 09:44:16'),(31,30,'0,2,22,30',0,'31','添加文章','art/add','art-add',1,0,'2016-03-31 08:25:40','2016-07-23 17:39:54'),(32,30,'0,2,22,30',0,'32','修改文章','art/edit','art-edit',0,0,'2016-03-31 08:25:59','2016-03-31 08:25:59'),(33,30,'0,2,22,30',0,'33','删除文章','art/del','art-del',0,0,'2016-03-31 08:26:15','2016-03-31 08:26:15'),(34,30,'0,2,22,30',0,'34','查看文章','art/show','art-show',0,0,'2016-03-31 08:26:35','2016-03-31 08:26:36'),(67,5,'0,1,5',1,'67,68','操作日志','log/index','log-index',1,4,'2016-04-11 10:38:34','2017-04-25 21:50:09'),(68,67,'0,1,5,67',0,'68','清除7天前日志','log/del','log-del',0,0,'2016-04-11 10:38:53','2016-05-11 17:37:46'),(74,5,'0,1,5',0,'74','更新缓存','index/cache','index-cache',1,5,'2016-04-11 16:00:30','2016-05-15 08:25:53'),(75,28,'0,2,22,28',0,'75','删除附件','attr/delfile','attr-delfile',0,0,'2016-05-09 19:29:09','2016-05-09 19:29:09'),(121,30,'0,2,22,30',0,'121','批量删除','art/alldel','art-alldel',0,0,'2016-06-15 08:52:32','2016-06-15 08:52:32'),(136,30,'0,2,22,30',0,'136','批量排序','art/listorder','art-listorder',0,0,'2016-07-25 08:35:42','2016-07-25 08:35:42'),(140,16,'0,1,10,16',0,'140','角色权限','role/priv','role-priv',0,0,'2016-07-25 11:34:39','2016-07-25 11:34:40'),(143,1,'0,1',1,'143,144,145','个人信息','admin/info','admin-info',1,0,'2016-07-28 14:01:45','2016-07-28 14:02:37'),(144,143,'0,1,143',0,'144','修改个人资料','admin/myedit','admin-myedit',1,0,'2016-07-28 14:02:12','2016-07-28 14:02:12'),(145,143,'0,1,143',0,'145','修改个人密码','admin/mypwd','admin-mypwd',1,0,'2016-07-28 14:02:37','2016-07-28 14:02:37'),(148,5,'0,1,5',1,'148,149,150','数据管理','database/export','database-export',1,3,'2016-12-02 10:21:37','2017-04-25 21:50:02'),(149,148,'0,1,5,148',0,'149','恢复数据','database/import','database-import',0,0,'2016-12-02 10:22:16','2016-12-02 10:22:23'),(150,148,'0,1,5,148',0,'150','删除备份文件','database/delfile','database-delfile',0,0,'2016-12-02 10:22:47','2016-12-02 10:22:48'),(151,5,'0,1,5',1,'151,152,153,154','分类管理','type/index','type-index',1,2,'2016-12-14 09:56:01','2017-04-25 21:49:45'),(152,151,'0,1,5,151',0,'152','添加分类','type/add','type-add',1,0,'2016-12-14 09:56:23','2016-12-14 09:56:23'),(153,151,'0,1,5,151',0,'153','修改分类','type/edit','type-edit',0,0,'2016-12-14 09:56:42','2016-12-14 09:56:42'),(154,151,'0,1,5,151',0,'154','删除分类','type/del','type-del',0,0,'2016-12-14 09:56:57','2016-12-14 09:56:58'),(170,10,'0,1,10',1,'170,171,172,173','部门管理','section/index','section-index',1,0,'2016-12-15 08:31:39','2016-12-15 08:32:44'),(171,170,'0,1,10,170',0,'171','添加部门','section/add','section-add',1,0,'2016-12-15 08:32:01','2016-12-15 08:32:02'),(172,170,'0,1,10,170',0,'172','修改部门','section/edit','section-edit',0,0,'2016-12-15 08:32:23','2016-12-15 08:32:23'),(173,170,'0,1,10,170',0,'173','删除部门','section/del','section-del',0,0,'2016-12-15 08:32:44','2016-12-15 08:32:44'),(174,0,'0',1,'174,175,176,177,178,179,180,181,182,183,189,184,185,186,187,188,190,191,192','商城','shop/index','shop-index',1,0,'2017-03-12 09:41:52','2017-03-13 09:56:04'),(175,174,'0,174',1,'175,176,177,178,179,180,181,182,183,189,184,185,186,187,188,190,191,192','商品管理','shop/manage','shop-manage',1,0,'2017-03-12 09:42:10','2017-03-13 09:56:04'),(176,175,'0,174,175',1,'176,177,178,179','商品属性','goodattr/index','goodattr-index',1,0,'2017-03-12 09:42:49','2017-03-12 09:44:09'),(177,176,'0,174,175,176',0,'177','商品属性添加','goodattr/add','goodattr-add',1,0,'2017-03-12 09:43:22','2017-03-12 09:43:22'),(178,176,'0,174,175,176',0,'178','商品属性修改','goodattr/edit','goodattr-edit',0,0,'2017-03-12 09:43:47','2017-03-12 09:43:47'),(179,176,'0,174,175,176',0,'179','商品属性删除','goodattr/del','goodattr-del',0,0,'2017-03-12 09:44:09','2017-03-12 09:44:09'),(180,175,'0,174,175',1,'180,181,182,183,189','商品分类','goodcate/index','goodcate-index',1,0,'2017-03-12 09:44:35','2017-03-12 10:43:04'),(181,180,'0,174,175,180',0,'181','商品分类添加','goodcate/add','goodcate-add',1,0,'2017-03-12 09:44:54','2017-03-12 09:44:54'),(182,180,'0,174,175,180',0,'182','商品分类修改','goodcate/edit','goodcate-edit',0,0,'2017-03-12 09:45:32','2017-03-12 09:45:32'),(183,180,'0,174,175,180',0,'183','商品分类删除','goodcate/del','goodcate-del',0,0,'2017-03-12 09:45:48','2017-03-12 09:45:48'),(184,175,'0,174,175',1,'184,185,186,187,188,190,191,192','商品列表','good/index','good-index',1,0,'2017-03-12 09:46:11','2017-03-13 09:56:04'),(185,184,'0,174,175,184',0,'185','添加商品','good/add','good-add',1,0,'2017-03-12 09:46:28','2017-03-12 09:46:28'),(186,184,'0,174,175,184',0,'186','修改商品','good/edit','good-edit',0,0,'2017-03-12 09:46:46','2017-03-12 09:46:46'),(187,184,'0,174,175,184',0,'187','商品删除','good/del','good-del',0,0,'2017-03-12 09:47:04','2017-03-12 09:47:04'),(188,184,'0,174,175,184',0,'188','属性','good/format','good-format',0,0,'2017-03-12 09:47:28','2017-03-13 09:55:21'),(189,180,'0,174,175,180',0,'189','更新分类缓存','goodcate/cache','goodcache-cache',0,0,'2017-03-12 10:43:04','2017-03-12 10:43:04'),(190,184,'0,174,175,184',0,'190','添加商品属性','good/addformart','good-addformart',1,0,'2017-03-13 09:55:15','2017-03-13 09:55:15'),(191,184,'0,174,175,184',0,'191','修改商品属性','good/editformart','good-editformart',0,0,'2017-03-13 09:55:42','2017-03-13 09:55:42'),(192,184,'0,174,175,184',0,'192','删除商品属性','good/delformart','good-delformart',0,0,'2017-03-13 09:56:04','2017-03-13 09:56:04'),(193,0,'0',1,'193,194,195,196,197,198,199,200,201','会员','user/indexs','user-indexs',1,0,'2017-03-17 08:29:58','2017-03-17 08:34:46'),(194,193,'0,193',1,'194,195,196,197,198,199,200,201','会员管理','user/manage','user-manage',1,0,'2017-03-17 08:30:28','2017-03-17 08:34:46'),(195,194,'0,193,194',1,'195,196,197,198','会员组','group/index','group-index',1,0,'2017-03-17 08:30:46','2017-03-17 08:32:47'),(196,195,'0,193,194,195',0,'196','添加会员组','group/add','group-add',1,0,'2017-03-17 08:31:05','2017-03-17 08:32:55'),(197,195,'0,193,194,195',0,'197','修改会员组','group/edit','group-edit',0,0,'2017-03-17 08:31:25','2017-03-17 08:33:02'),(198,195,'0,193,194,195',0,'198','删除会员组','group/del','group-del',0,0,'2017-03-17 08:31:40','2017-03-17 08:33:08'),(199,194,'0,193,194',1,'199,200,201','会员列表','user/index','user-index',1,0,'2017-03-17 08:33:22','2017-03-17 08:34:46'),(200,199,'0,193,194,199',0,'200','禁用会员','user/status','user-status',0,0,'2017-03-17 08:34:25','2017-03-17 08:34:51'),(201,199,'0,193,194,199',0,'201','修改会员','user/edit','user/edit',0,0,'2017-03-17 08:34:46','2017-03-17 08:34:47'),(202,5,'0,1,5',1,'202,204','支付配置','pay/index','pay-index',1,3,'2017-03-28 08:16:45','2017-04-27 06:22:35'),(204,202,'0,1,5,202',0,'204','修改支付方式','pay/edit','pay-edit',0,0,'2017-03-28 08:17:16','2017-03-28 08:17:17'),(205,5,'0,1,5',0,'205','系统配置','config/index','config-index',1,0,'2017-04-25 21:49:13','2017-04-27 06:22:35');

/*Table structure for table `li_migrations` */

DROP TABLE IF EXISTS `li_migrations`;

CREATE TABLE `li_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_migrations` */

insert  into `li_migrations`(`id`,`migration`,`batch`) values (9,'2017_03_09_103952_create_order_goods_table',1),(10,'2017_03_09_104005_create_orders_table',1),(11,'2017_03_09_104015_create_carts_table',1),(12,'2017_03_09_103938_create_ships_table',2);

/*Table structure for table `li_order_goods` */

DROP TABLE IF EXISTS `li_order_goods`;

CREATE TABLE `li_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `good_id` int(11) NOT NULL COMMENT '商品ID',
  `format_id` int(11) NOT NULL COMMENT '商品属性ID',
  `nums` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `total_prices` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总价',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态，1正常0删除',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_order_goods` */

insert  into `li_order_goods`(`id`,`user_id`,`order_id`,`good_id`,`format_id`,`nums`,`price`,`total_prices`,`status`,`created_at`,`updated_at`) values (1,1,3,4,0,6,'150.00','900.00',1,NULL,NULL),(2,1,3,2,14,1,'100.00','100.00',1,NULL,NULL),(3,1,3,3,17,1,'111.00','111.00',1,NULL,NULL),(4,1,3,2,16,1,'1111.00','1111.00',1,NULL,NULL),(5,1,4,4,0,6,'150.00','900.00',1,NULL,NULL),(6,1,4,2,14,1,'100.00','100.00',1,NULL,NULL),(7,1,4,3,17,1,'111.00','111.00',1,NULL,NULL),(8,1,4,2,16,1,'1111.00','1111.00',1,NULL,NULL),(9,1,5,4,0,6,'150.00','900.00',1,'2017-04-28 07:31:47','2017-04-28 07:31:47'),(10,1,5,2,14,1,'100.00','100.00',1,'2017-04-28 07:31:47','2017-04-28 07:31:47'),(11,1,5,3,17,1,'111.00','111.00',1,'2017-04-28 07:31:47','2017-04-28 07:31:47'),(12,1,5,2,16,1,'1111.00','1111.00',1,'2017-04-28 07:31:47','2017-04-28 07:31:47'),(13,1,7,4,0,6,'150.00','900.00',1,'2017-04-28 07:33:12','2017-04-28 07:33:12'),(14,1,7,2,14,1,'100.00','100.00',1,'2017-04-28 07:33:12','2017-04-28 07:33:12'),(15,1,7,3,17,1,'111.00','111.00',1,'2017-04-28 07:33:12','2017-04-28 07:33:12'),(16,1,7,2,16,1,'1111.00','1111.00',1,'2017-04-28 07:33:12','2017-04-28 07:33:12'),(17,1,8,4,0,6,'150.00','900.00',1,'2017-04-28 07:34:07','2017-04-28 07:34:07'),(18,1,8,2,14,1,'100.00','100.00',1,'2017-04-28 07:34:07','2017-04-28 07:34:07'),(19,1,8,3,17,1,'111.00','111.00',1,'2017-04-28 07:34:07','2017-04-28 07:34:07'),(20,1,8,2,16,1,'1111.00','1111.00',1,'2017-04-28 07:34:07','2017-04-28 07:34:07'),(21,1,9,4,0,6,'150.00','900.00',1,'2017-04-28 07:34:25','2017-04-28 07:34:25'),(22,1,9,2,14,1,'100.00','100.00',1,'2017-04-28 07:34:25','2017-04-28 07:34:25'),(23,1,9,3,17,1,'111.00','111.00',1,'2017-04-28 07:34:25','2017-04-28 07:34:25'),(24,1,9,2,16,1,'1111.00','1111.00',1,'2017-04-28 07:34:25','2017-04-28 07:34:25'),(25,1,18,2,15,1,'100.00','100.00',1,'2017-04-28 07:41:50','2017-04-28 07:41:50');

/*Table structure for table `li_orders` */

DROP TABLE IF EXISTS `li_orders`;

CREATE TABLE `li_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` char(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '订单ID',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `total_prices` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总价',
  `create_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '创建IP',
  `paystatus` tinyint(4) NOT NULL DEFAULT '0' COMMENT '支付状态,0未，1已',
  `shipstatus` tinyint(4) NOT NULL DEFAULT '0' COMMENT '发货状态,0未，1已',
  `orderstatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '订单状态，1正常2完成0关闭',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态，1正常0删除',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_orders` */

insert  into `li_orders`(`id`,`order_id`,`user_id`,`total_prices`,`create_ip`,`paystatus`,`shipstatus`,`orderstatus`,`status`,`created_at`,`updated_at`) values (3,'5902ee452001bua4gEAL',1,'2222.00','192.168.3.14',0,0,1,1,'2017-04-28 07:24:53','2017-04-28 07:24:53'),(4,'5902ef849a009pswzT0v',1,'2222.00','192.168.3.14',0,0,1,1,'2017-04-28 07:30:12','2017-04-28 07:30:12'),(5,'5902efe3116fdJPgfcCT',1,'2222.00','192.168.3.14',0,0,1,1,'2017-04-28 07:31:47','2017-04-28 07:31:47'),(7,'5902f038485b0Sh5FViW',1,'2222.00','192.168.3.14',0,0,1,1,'2017-04-28 07:33:12','2017-04-28 07:33:12'),(8,'5902f06f54730G9NggAb',1,'2222.00','192.168.3.14',0,0,1,1,'2017-04-28 07:34:07','2017-04-28 07:34:07'),(9,'5902f081945begYEL35g',1,'2222.00','192.168.3.14',0,0,1,1,'2017-04-28 07:34:25','2017-04-28 07:34:25'),(18,'5902f23e273725bGV4z0',1,'100.00','192.168.3.14',0,0,1,1,'2017-04-28 07:41:50','2017-04-28 07:41:50');

/*Table structure for table `li_pays` */

DROP TABLE IF EXISTS `li_pays`;

CREATE TABLE `li_pays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Code',
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图标',
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '内容',
  `setting` text COLLATE utf8_unicode_ci COMMENT '配置',
  `paystatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：1打开，0关闭',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态，1正常0删除',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_pays` */

insert  into `li_pays`(`id`,`name`,`code`,`thumb`,`content`,`setting`,`paystatus`,`status`,`created_at`,`updated_at`) values (1,'支付宝','alipay','/statics/common/images/alipay.png','阿里的支付功能','{\"alipay_partner\":\"2088521250322033\",\"alipay_key\":\"mi2dfa7vzrdu4qlrs1v7bxcajs2u24h7\",\"alipay_account\":\"969486228@qq.com\",\"alipay_appid\":null,\"alipay_privatekey\":null,\"alipay_publickey\":null}',1,1,NULL,'2017-04-27 10:14:26'),(2,'微信','weixin','/statics/common/images/weixin.png','微信支付','{\"appid\":\"wx067074f336e36d65\",\"appsecret\":\"5ad486a0e704b08ad21319c980658777\",\"mchid\":\"1386782902\",\"appkey\":\"6t1avLsoYfHwWq14XwIaE76wHCCwYpL3\"}',1,1,NULL,'2017-03-28 08:47:25');

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

insert  into `li_role_users`(`role_id`,`user_id`) values (1,1),(2,2),(2,3);

/*Table structure for table `li_roles` */

DROP TABLE IF EXISTS `li_roles`;

CREATE TABLE `li_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_roles` */

insert  into `li_roles`(`id`,`name`,`status`,`created_at`,`updated_at`) values (1,'超级管理员',1,'2016-03-18 16:42:51','2016-03-18 16:42:51'),(2,'编辑',1,'2016-08-07 10:05:54','2016-08-07 10:05:54'),(3,'侃侃',1,'2017-04-26 00:43:44','2017-04-26 00:43:44');

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

/*Table structure for table `li_ships` */

DROP TABLE IF EXISTS `li_ships`;

CREATE TABLE `li_ships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `shipcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '单号',
  `shipname` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '物流名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_ships` */

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_types` */

insert  into `li_types`(`id`,`parentid`,`arrparentid`,`child`,`arrchildid`,`name`,`listorder`,`created_at`,`updated_at`) values (1,0,'0',0,'1','一个',0,'2017-04-26 00:43:07','2017-04-26 00:43:07');

/*Table structure for table `li_users` */

DROP TABLE IF EXISTS `li_users`;

CREATE TABLE `li_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL DEFAULT '1' COMMENT '组ID',
  `openid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '微信openid',
  `username` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户名',
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码',
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'API登陆用',
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `nickname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '昵称',
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号',
  `address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '地址',
  `last_ip` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '最后登陆IP',
  `last_time` timestamp NULL DEFAULT NULL COMMENT '最后登陆时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态，1正常0禁用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `li_users` */

insert  into `li_users`(`id`,`gid`,`openid`,`username`,`password`,`token`,`email`,`nickname`,`phone`,`address`,`last_ip`,`last_time`,`status`,`created_at`,`updated_at`) values (1,1,NULL,'adminss','eyJpdiI6InRUTm9WaXlMQlV5ekN3Q21UdU1UZmc9PSIsInZhbHVlIjoiQjRpQWNaT0xZc1lQdXJKY0xFTStYQT09IiwibWFjIjoiMzllNTgxNGFjMTA0ZTc1ZGI5OWJmMDkxNzMxYTM5MzJmYjQ5ZTg2MjFlZjg1M2JjNjhhMTdhZDBmYTY5ZGY2MyJ9',NULL,'adfsd!@q.com',NULL,NULL,NULL,'192.168.3.14','2017-04-28 07:41:47',1,'2017-04-20 17:16:12','2017-04-28 07:41:47');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

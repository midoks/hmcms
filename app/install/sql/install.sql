
-- ----------------------------
-- Table structure for hm_admin
-- ----------------------------
DROP TABLE IF EXISTS `hm_admin`;
CREATE TABLE `hm_admin` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `pwd` char(32) NOT NULL DEFAULT '',
  `random` char(32) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `auth` text NOT NULL,
  `login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `login_ip` int(10) unsigned NOT NULL DEFAULT '0',
  `login_num` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login_ip` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


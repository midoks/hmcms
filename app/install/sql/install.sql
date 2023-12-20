
-- ----------------------------
-- Table structure for hm_admin
-- ----------------------------
DROP TABLE IF EXISTS `hm_admin`;
CREATE TABLE `hm_admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


-- ----------------------------
-- Table structure for hm_comic
-- ----------------------------
DROP TABLE IF EXISTS `hm_comic`;
CREATE TABLE `hm_comic` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT '' COMMENT '标题',
  `yname` varchar(128) DEFAULT '' COMMENT '英文别名',
  `pic` varchar(255) DEFAULT '' COMMENT '竖版封面',
  `picx` varchar(255) DEFAULT '' COMMENT '横版封面',
  `cid` bigint DEFAULT '0' COMMENT '分类ID',
  `tid` tinyint(1) DEFAULT '0' COMMENT '1推荐，0未推',
  `serialize` varchar(20) DEFAULT '' COMMENT '状态',
  `author` varchar(64) DEFAULT '' COMMENT '漫画作者',
  `uid` bigint DEFAULT '0' COMMENT '用户ID',
  `notice` varchar(255) DEFAULT '' COMMENT '公告',
  `pic_author` varchar(128) DEFAULT '' COMMENT '图作者',
  `txt_author` varchar(128) DEFAULT '' COMMENT '文作者',
  `text` varchar(64) DEFAULT '' COMMENT '一句话简介',
  `content` varchar(500) DEFAULT '' COMMENT '介绍',
  `hits` bigint DEFAULT '0' COMMENT '总点击',
  `yhits` bigint DEFAULT '0' COMMENT '月点击',
  `zhits` bigint DEFAULT '0' COMMENT '周点击',
  `rhits` bigint DEFAULT '0' COMMENT '日点击',
  `hits_uptime` int NOT NULL DEFAULT '0' COMMENT '统计更新时间',
  `shits` int DEFAULT '0' COMMENT '收藏人气',
  `pay` tinyint(1) DEFAULT '0' COMMENT '是否收费,1:金币,2:VIP',
  `cion` int DEFAULT '0' COMMENT '打赏总额',
  `ticket` int DEFAULT '0' COMMENT '月票总额',
  `sid` tinyint(1) DEFAULT '0' COMMENT '0:正常,1:锁定',
  `nums` int DEFAULT '0' COMMENT '章节总数',
  `latest_chapter_id` int NOT NULL DEFAULT '0' COMMENT '最新章节ID',
  `latest_chapter_name` varchar(255) NOT NULL DEFAULT '' COMMENT '最新章节名称',
  `score` decimal(2,1) DEFAULT '9.8' COMMENT '总得分',
  `did` int DEFAULT '0' COMMENT '采集资源ID',
  `ly` varchar(64) DEFAULT '' COMMENT '采集来源标识',
  `yid` tinyint(1) DEFAULT '0' COMMENT '0正常，1待审核',
  `msg` varchar(128) DEFAULT '' COMMENT '未审核原因',
  `addtime` int DEFAULT '0' COMMENT '入库时间',
  `uptime` int NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `serialize` (`serialize`) USING BTREE,
  KEY `hits` (`hits`) USING BTREE,
  KEY `yhits` (`yhits`) USING BTREE,
  KEY `zhits` (`zhits`) USING BTREE,
  KEY `rhits` (`rhits`) USING BTREE,
  KEY `shits` (`shits`) USING BTREE,
  KEY `cion` (`cion`) USING BTREE,
  KEY `yid` (`yid`) USING BTREE,
  KEY `addtime` (`addtime`) USING BTREE,
  KEY `pay` (`pay`) USING BTREE,
  KEY `ticket` (`ticket`) USING BTREE,
  KEY `score` (`score`) USING BTREE,
  KEY `uptime` (`uptime`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='漫画列表';


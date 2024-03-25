
-- ----------------------------
-- Table structure for hm_admin
-- ----------------------------
DROP TABLE IF EXISTS `hm_admin`;
CREATE TABLE `hm_admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `random` char(32) NOT NULL DEFAULT '' COMMENT '随机',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `email` varchar(128) DEFAULT '' COMMENT '邮箱',
  `tel` varchar(15) DEFAULT '' COMMENT '手机',
  `role_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `login_ip` int(10) unsigned NOT NULL DEFAULT '0',
  `login_num` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login_ip` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_uniq` (`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


-- ----------------------------
-- Table structure for hm_admin_access
-- ----------------------------
CREATE TABLE IF NOT EXISTS `hm_admin_access` (  
  `role_id` smallint(6) unsigned NOT NULL,  
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `role_id` (`role_id`),
  KEY `node_id` (`node_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='权限表';

-- ----------------------------
-- Table structure for hm_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `hm_admin_menu`;
CREATE TABLE IF NOT EXISTS `hm_admin_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '名称',
  `icon` varchar(50) DEFAULT NULL COMMENT '图片',
  `alias` varchar(50) DEFAULT '' COMMENT '别名',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态',
  `route` varchar(255) DEFAULT NULL COMMENT '路由',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` smallint(6) unsigned DEFAULT NULL COMMENT '排序',
  `type` char(20) DEFAULT '' COMMENT '菜单类型',
  `display` tinyint NOT NULL DEFAULT '1' COMMENT '是否显示',
  `pid` smallint(6) unsigned DEFAULT '0' COMMENT '上一级ID',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  UNIQUE KEY `name_pid` (`name`,`pid`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='权限关联表';


-- ----------------------------
-- Table structure for hm_admin_access
-- ----------------------------
DROP TABLE IF EXISTS `hm_admin_access`;
CREATE TABLE IF NOT EXISTS `hm_admin_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='权限角色关联表';

-- ----------------------------
-- Table structure for hm_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `hm_admin_role`;
CREATE TABLE IF NOT EXISTS `hm_admin_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `remark` text COMMENT '备注',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态',
  `pid` smallint(6) unsigned DEFAULT '0' COMMENT '上一级ID',
  `create_time` datetime NOT NULL COMMENT '注册时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='权限角色表';


-- ----------------------------
-- Table structure for hm_user
-- ----------------------------
DROP TABLE IF EXISTS `hm_user`;
CREATE TABLE `hm_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '' COMMENT '用户名',
  `tel` varchar(15) DEFAULT '' COMMENT '手机',
  `email` varchar(128) DEFAULT '' COMMENT '邮箱',
  `pass` varchar(64) DEFAULT '' COMMENT '密码',
  `nick` varchar(64) DEFAULT '' COMMENT '昵称',
  `vip` tinyint(1) DEFAULT '0' COMMENT '是否VIP',
  `rmb` decimal(6,2) DEFAULT '0.00' COMMENT '金额',
  `cion` bigint(20) DEFAULT '0' COMMENT '金币',
  `ticket` int DEFAULT '0' COMMENT '月票',
  `viptime` bigint(20) DEFAULT '0' COMMENT 'vip到期时间',
  `pic` varchar(255) DEFAULT '' COMMENT '头像地址',
  `qq` varchar(20) DEFAULT '' COMMENT 'QQ',
  `city` varchar(128) DEFAULT '' COMMENT '地区',
  `sex` varchar(5) DEFAULT '保密' COMMENT '性别',
  `text` varchar(255) DEFAULT '' COMMENT '介绍',
  `sid` tinyint(1) DEFAULT '0' COMMENT '状态｜1:锁定,0:正常',
  `cid` tinyint(1) DEFAULT '0' COMMENT '认证状态',
  `signing` tinyint(1) DEFAULT '0' COMMENT '是否签约|0:未,1:已',
  `realname` varchar(128) DEFAULT '' COMMENT '真实名字',
  `idcard` varchar(64) DEFAULT '' COMMENT '身份证号码',
  `bank` varchar(128) DEFAULT '' COMMENT '收款银行',
  `card` varchar(128) DEFAULT '' COMMENT '收款账号',
  `bankcity` varchar(255) DEFAULT '' COMMENT '开户行地址',
  `pass_err_nums` int DEFAULT '0' COMMENT '密码错误次数',
  `rz_type` tinyint(1) DEFAULT '1' COMMENT '认证方式，1个人，2企业',
  `rz_msg` varchar(128) DEFAULT '' COMMENT '认证失败原因',
  `channel` varchar(200) NOT NULL DEFAULT '' COMMENT '渠道',
  `create_time` datetime NOT NULL COMMENT '注册时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE,
  KEY `email` (`email`) USING BTREE,
  KEY `tel` (`tel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='用户';


-- ----------------------------
-- Table structure for hm_order
-- ----------------------------
DROP TABLE IF EXISTS `hm_order`;
CREATE TABLE `hm_order` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0' COMMENT '用户ID',
  `dd` varchar(64) DEFAULT '' COMMENT '订单号',
  `rmb` decimal(6,2) DEFAULT '0.00' COMMENT '金额',
  `pid` tinyint(1) DEFAULT '0' COMMENT '状态',
  `text` varchar(255) DEFAULT '' COMMENT '备注',
  `zd` varchar(255) DEFAULT '' COMMENT '预增加字段',
  `type` varchar(20) DEFAULT '' COMMENT '支付方式',
  `channel` varchar(200) NOT NULL COMMENT '渠道',
  `create_time` datetime NOT NULL COMMENT '订单时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `dd` (`dd`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='订单记录';


-- ----------------------------
-- Table structure for hm_message
-- ----------------------------
DROP TABLE IF EXISTS `hm_message`;
CREATE TABLE `hm_message` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0' COMMENT '用户ID',
  `name` varchar(64) DEFAULT '' COMMENT '标题',
  `text` varchar(255) DEFAULT '' COMMENT '内容',
  `did` tinyint(1) DEFAULT '0' COMMENT '0:未读,1:已读',
  `create_time` datetime NOT NULL COMMENT '添加时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='用户消息';


-- ----------------------------
-- Table structure for hm_feedback
-- ----------------------------
DROP TABLE IF EXISTS `hm_feedback`;
CREATE TABLE `hm_feedback` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `name` varchar(100) NOT NULL COMMENT '类型名称',
  `text` text NOT NULL COMMENT '内容',
  `images` text NOT NULL COMMENT '图片列表',
  `create_time` datetime NOT NULL COMMENT '添加时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='意见反馈';

-- ----------------------------
-- Table structure for hm_task
-- ----------------------------
DROP TABLE IF EXISTS `hm_task`;
CREATE TABLE `hm_task` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '' COMMENT '任务标题',
  `text` varchar(64) DEFAULT '' COMMENT '任务内容',
  `cion` int(11) DEFAULT '0' COMMENT '奖励金币',
  `vip` int(11) DEFAULT '0' COMMENT '奖励VIP天数',
  `daynum` int(11) DEFAULT '0' COMMENT '每日奖励上限次数，0不限制',
  `type` int(11) DEFAULT '0' COMMENT '0:单任务,1:多任务',
  `pid` int(11) DEFAULT '0' COMMENT '父ID',
  `status` int(11) DEFAULT '0' COMMENT '0:开启,1:关闭',
  `extra` varchar(10) DEFAULT '' COMMENT '额外字段',
  `create_time` datetime NOT NULL COMMENT '添加时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='每日任务';

-- ----------------------------
-- Table structure for hm_task_list
-- ----------------------------
DROP TABLE IF EXISTS `hm_task_list`;
CREATE TABLE `hm_task_list` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0' COMMENT '用户ID',
  `tid` int(11) DEFAULT '0' COMMENT '任务ID',
  `vip` int(11) DEFAULT '0' COMMENT '奖励VIP天数',
  `cion` int(11) DEFAULT '0' COMMENT '获得金币',
  `state` int(11) DEFAULT '0' COMMENT '签到状态',
  `is_repair` tinyint(11) DEFAULT '0' COMMENT '是否是补签',
  `week` tinyint(4) NOT NULL COMMENT '周几',
  `create_time` datetime NOT NULL COMMENT '添加时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `tid` (`tid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='任务记录表';

-- ----------------------------
-- Table structure for hm_user_invite
-- ----------------------------
DROP TABLE IF EXISTS `hm_user_invite`;
CREATE TABLE `hm_user_invite` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0' COMMENT '用户ID',
  `inviteid` int(11) DEFAULT '0' COMMENT '邀请人ID',
  `deviceid` varchar(128) DEFAULT '' COMMENT '设备ID',
  `create_time` datetime NOT NULL COMMENT '添加时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `inviteid` (`inviteid`) USING BTREE,
  KEY `deviceid` (`deviceid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='用户邀请记录';

-- -----------------------------
-- Table structure for hm_option
-- -----------------------------
DROP TABLE IF EXISTS `hm_option`;
CREATE TABLE `hm_option` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT '' COMMENT '配置名称',
  `value` text COMMENT '配置内容',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='配置表';


-- -----------------------------
-- Table structure for hm_app
-- -----------------------------
DROP TABLE IF EXISTS `hm_app`;
CREATE TABLE `hm_app` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT '' COMMENT '应用名称',
  `app_id` varchar(200) COMMENT '应用ID',
  `app_secret` varchar(200) COMMENT '应用密钥',
  `is_flag` text COMMENT '是否可用',
  `access_token` varchar(200) COMMENT '上一次access_token',
  `status` tinyint(1) DEFAULT '0' COMMENT '1:开启,0:关闭',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='应用表';

-- -----------------------------
-- Table structure for hm_telcode
-- -----------------------------
DROP TABLE IF EXISTS `hm_telcode`;
CREATE TABLE `hm_telcode` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tel` varchar(20) DEFAULT '' COMMENT '手机号码',
  `code` varchar(10) DEFAULT '' COMMENT '验证码',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `tel` (`tel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='手机验证码';

-- -----------------------------
-- Table structure for hm_mailcode
-- -----------------------------
DROP TABLE IF EXISTS `hm_mailcode`;
CREATE TABLE `hm_mailcode` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(20) DEFAULT '' COMMENT '邮件地址',
  `code` varchar(10) DEFAULT '' COMMENT '验证码',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='邮件验证码';

-- -----------------------------
-- Table structure for hm_sms_logs
-- -----------------------------
DROP TABLE IF EXISTS `hm_sms_logs`;
CREATE TABLE `hm_sms_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '默认' COMMENT '名称',
  `tel` varchar(20) DEFAULT '' COMMENT '手机号码',
  `request` text COMMENT '请求参数',
  `receive` text COMMENT '接收数据',
  `extra` text COMMENT '额外字段',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `tel` (`tel`) USING BTREE
  KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='短信日志表';

-- -----------------------------
-- Table structure for hm_mail_logs
-- -----------------------------
DROP TABLE IF EXISTS `hm_mail_logs`;
CREATE TABLE `hm_mail_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '默认' COMMENT '名称',
  `email` varchar(200) NOT NULL DEFAULT '' COMMENT '邮件地址',
  `request` text COMMENT '请求参数',
  `receive` text COMMENT '接收数据',
  `extra` text COMMENT '额外字段',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `email` (`email`) USING BTREE
  KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='邮件日志表';

-- ----------------------------
-- Table structure for hm_link
-- ----------------------------
DROP TABLE IF EXISTS `hm_link`;
CREATE TABLE `hm_link` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' ,
  `name` varchar(60) NOT NULL DEFAULT '' ,
  `sort` smallint(6) NOT NULL DEFAULT '0' ,
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击次数',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT 'URL',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT 'LOGO',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='友情链接表';

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
  `tid` tinyint(1) DEFAULT '0' COMMENT '1:推荐，0:未推',
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
  `yid` tinyint(1) DEFAULT '0' COMMENT '0:正常,1:待审核',
  `msg` varchar(128) DEFAULT '' COMMENT '未审核原因',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT "状态|0:正常,1:禁止显示",
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
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
  KEY `pay` (`pay`) USING BTREE,
  KEY `ticket` (`ticket`) USING BTREE,
  KEY `score` (`score`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='漫画列表';

-- ------------------------------------
-- Table structure for hm_comic_chapter
-- ------------------------------------
DROP TABLE IF EXISTS `hm_comic_chapter`;
CREATE TABLE `hm_comic_chapter` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `mid` int(11) DEFAULT '0' COMMENT '漫画ID',
 `xid` int(11) DEFAULT '0' COMMENT '排序ID',
 `image` varchar(255) DEFAULT '' COMMENT '图片',
 `name` varchar(128) DEFAULT '' COMMENT '标题',
 `vip` tinyint(1) DEFAULT '0' COMMENT 'VIP阅读，0否1是',
 `cion` int(11) DEFAULT '0' COMMENT '章节需要金币',
 `pnum` int(11) DEFAULT '0' COMMENT '图片数量',
 `yid` tinyint(1) DEFAULT '0' COMMENT '0已审核，1待审核，2未通过',
 `msg` varchar(128) DEFAULT '' COMMENT '未通过原因',
 `create_time` datetime NOT NULL COMMENT '入库时间',
 `update_time` datetime NOT NULL COMMENT '更新时间',
 PRIMARY KEY (`id`),
 UNIQUE KEY `mid_xid` (`mid`,`xid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='漫画章节';

-- ------------------------------------
-- Table structure for hm_comic_pic
-- ------------------------------------
DROP TABLE IF EXISTS `hm_comic_pic`;
CREATE TABLE `hm_comic_pic` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `cid` int(11) DEFAULT '0' COMMENT '章节ID',
 `mid` int(11) DEFAULT '0' COMMENT '漫画ID',
 `img` varchar(255) DEFAULT '' COMMENT '图片url地址',
 `width` int(11) DEFAULT '0' COMMENT '图片宽度',
 `height` int(11) DEFAULT '0' COMMENT '图片高度',
 `xid` int(11) DEFAULT '0' COMMENT '排序ID',
 `create_time` datetime NOT NULL COMMENT '入库时间',
 `update_time` datetime NOT NULL COMMENT '更新时间',
 PRIMARY KEY (`id`),
 KEY `cid` (`cid`) USING BTREE,
 KEY `mid` (`mid`) USING BTREE,
 KEY `xid` (`xid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='漫画章节图片';


-- ----------------------------
-- Table structure for hm_comic_class
-- ----------------------------
DROP TABLE IF EXISTS `hm_comic_class`;
CREATE TABLE `hm_comic_class` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT '' COMMENT '名称',
  `yname` varchar(255) DEFAULT '' COMMENT '英文名称',
  `sort` int DEFAULT '0' COMMENT '排序ID',
  `pid` int DEFAULT '0' COMMENT '上级ID',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='漫画分类';

-- ----------------------------
-- Table structure for hm_comic_type
-- ----------------------------
DROP TABLE IF EXISTS `hm_comic_type`;
CREATE TABLE `hm_comic_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT '' COMMENT '名称',
  `pid` int DEFAULT '0' COMMENT '上级ID',
  `field` varchar(64) DEFAULT '' COMMENT '字段',
  `sort` int DEFAULT '0' COMMENT '排序ID',
  `mode` tinyint(1) DEFAULT '0' COMMENT '0多选,1单选',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='漫画类型';

-- -----------------------------------------
-- Table structure for hm_comic_type_related
-- -----------------------------------------
DROP TABLE IF EXISTS `hm_comic_type_related`;
CREATE TABLE `hm_comic_type_related` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(11) DEFAULT '0' COMMENT '类别ID',
  `mid` int(11) DEFAULT '0' COMMENT '漫画ID',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tid_mid` (`tid`,`mid`) USING BTREE,
  KEY `tid` (`tid`) USING BTREE,
  KEY `mid` (`mid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='漫画类型关联';

-- ----------------------------
-- Table structure for hm_comic_comment
-- ----------------------------
DROP TABLE IF EXISTS `hm_comic_comment`;
CREATE TABLE `hm_comic_comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int DEFAULT '0' COMMENT '漫画ID',
  `uid` int DEFAULT '0' COMMENT '用户ID',
  `text` varchar(500) DEFAULT '' COMMENT '评论内容',
  `reply_num` int DEFAULT '0' COMMENT '回复总数',
  `machine` varchar(64) DEFAULT '' COMMENT 'pc/wap/app',
  `ip` varchar(30) DEFAULT '' COMMENT 'IP',
  `zan` int DEFAULT '0' COMMENT '被顶次数',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='漫画评论记录';

-- ----------------------------
-- Table structure for hm_comic_comment_reply
-- ----------------------------
DROP TABLE IF EXISTS `hm_comic_comment_reply`;
CREATE TABLE `hm_comic_comment_reply` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int DEFAULT '0' COMMENT '评论ID',
  `fid` int DEFAULT '0' COMMENT '上级ID',
  `mid` int DEFAULT '0' COMMENT '漫画ID',
  `uid` int DEFAULT '0' COMMENT '用户ID',
  `text` varchar(500) DEFAULT '' COMMENT '评论内容',
  `machine` varchar(64) DEFAULT '' COMMENT 'pc/wap/app',
  `ip` varchar(30) DEFAULT '' COMMENT 'ip',
  `zan` int DEFAULT '0' COMMENT '被顶次数',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `fid` (`fid`) USING BTREE,
  KEY `cid` (`cid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='漫画评论回复';

-- ----------------------------
-- Table structure for hm_comic_comment_zan
-- ----------------------------
DROP TABLE IF EXISTS `hm_comic_comment_zan`;
CREATE TABLE `hm_comic_comment_zan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int DEFAULT '0' COMMENT '评论ID',
  `fid` tinyint(1) DEFAULT '0' COMMENT '0评论，1回复',
  `uid` int DEFAULT '0' COMMENT '用户ID',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ucf_id` (`cid`,`fid`,`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='漫画评论顶记录';

-- ----------------------------
-- Table structure for hm_follow
-- ----------------------------
DROP TABLE IF EXISTS `hm_follow`;
CREATE TABLE `hm_follow` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `uid` int(11) DEFAULT '0' COMMENT '用户ID',
 `mid` int(11) DEFAULT '0' COMMENT '漫画ID',
 `create_time` datetime NOT NULL COMMENT '创建时间',
 `update_time` datetime NOT NULL COMMENT '更新时间',
 PRIMARY KEY (`id`),
 UNIQUE KEY `uid_mid` (`uid`,`mid`) USING BTREE,
 KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='关注记录';

-- ----------------------------
-- Table structure for hm_comic_buy
-- ----------------------------
DROP TABLE IF EXISTS `hm_comic_buy`;
CREATE TABLE `hm_comic_buy` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `text` varchar(255) DEFAULT '' COMMENT '消费简介',
 `mid` int(11) DEFAULT '0' COMMENT '漫画ID',
 `cid` int(11) DEFAULT '0' COMMENT '章节ID',
 `uid` int(11) DEFAULT '0' COMMENT '消费会员ID',
 `cion` int(11) DEFAULT '0' COMMENT '消费积分',
 `ip` varchar(20) DEFAULT '' COMMENT 'IP',
 `create_time` datetime NOT NULL COMMENT '创建时间',
 `update_time` datetime NOT NULL COMMENT '更新时间',
 PRIMARY KEY (`id`),
 KEY `mid` (`mid`) USING BTREE,
 KEY `cid` (`cid`) USING BTREE,
 KEY `uid` (`uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='消费记录';

-- -----------------------------------------
-- Table structure for hm_comic_buy_related
-- -----------------------------------------
DROP TABLE IF EXISTS `hm_comic_buy_related`;
CREATE TABLE `hm_comic_buy_related` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(11) DEFAULT '0' COMMENT '漫画ID',
  `cid` int(11) DEFAULT '0' COMMENT '章节ID',
  `uid` int(11) DEFAULT '0' COMMENT '用户ID',
  `auto` tinyint(1) DEFAULT '0' COMMENT '1开启自动购买',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_mid_cid` (`uid`,`mid`,`cid`) USING BTREE,
  KEY `mid` (`mid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='漫画购买记录';


-- -----------------------------------------
-- Table structure for hm_vod_class
-- -----------------------------------------
DROP TABLE IF EXISTS `hm_vod_class`;
CREATE TABLE `hm_vod_class` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0' COMMENT '类型PID',
  `name` varchar(255) DEFAULT '0' COMMENT '名称',
  `en` varchar(255) DEFAULT '0' COMMENT '英文名称',
  `sort` smallint unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `extend` text  COMMENT '扩展信息',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT 'LOGO',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '图片信息',
  `jumpurl` varchar(255) NOT NULL DEFAULT '' COMMENT '跳转地址',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT "状态|1:正常,0:禁止显示",
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`) USING BTREE,
  KEY `pid` (`pid`) USING BTREE,
  KEY `name` (`name`),
  KEY `name_en` (`name_en`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='视频分类';

-- -----------------------------------------
-- Table structure for hm_vod
-- -----------------------------------------
DROP TABLE IF EXISTS `hm_vod`;
CREATE TABLE `hm_vod` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT '0' COMMENT '类型ID',
  `group_id` int(11) DEFAULT '0' COMMENT '分组ID',
  `name` varchar(255) DEFAULT '0' COMMENT '名称',
  `en` varchar(255) DEFAULT '0' COMMENT '名称拼音',
  `sub` varchar(255) NOT NULL DEFAULT '' COMMENT '副标题',
  `letter` char(1) NOT NULL DEFAULT '' COMMENT '首字母',
  `color` varchar(6) NOT NULL DEFAULT '' COMMENT '颜色' ,
  `tag` varchar(100) NOT NULL DEFAULT '' COMMENT '标签',
  `class` varchar(255) NOT NULL DEFAULT '' COMMENT '分类',
  `pic` varchar(1024) NOT NULL DEFAULT '' COMMENT '封面图片',
  `pic_thumb` varchar(1024) NOT NULL DEFAULT '' COMMENT '缩略图片',
  `pic_slide` varchar(1024) NOT NULL DEFAULT '' COMMENT '海报',
  `pic_screenshot` text COMMENT '截图',
  `actor` varchar(255) NOT NULL DEFAULT '' COMMENT '演员',
  `behind` varchar(100) NOT NULL DEFAULT '' COMMENT '幕后',
  `director` varchar(255) NOT NULL DEFAULT '' COMMENT '导演',
  `writer` varchar(100) NOT NULL DEFAULT '' COMMENT '编剧',
  `content` mediumtext NOT NULL COMMENT '详情',
  `blurb` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `remarks` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `pubdate` varchar(100) NOT NULL DEFAULT '' COMMENT '发布日期',
  `total` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '总集数',
  `serial` varchar(20) NOT NULL DEFAULT '0' COMMENT '连载数',
  `tv` varchar(30) NOT NULL DEFAULT '' COMMENT '电影频道',
  `weekday` varchar(30) NOT NULL DEFAULT '' COMMENT '节目周期',
  `area` varchar(20) NOT NULL DEFAULT '' COMMENT '地区',
  `lang` varchar(10) NOT NULL DEFAULT '' COMMENT '语言',
  `year` varchar(10) NOT NULL DEFAULT '' COMMENT '年份',
  `version` varchar(30) NOT NULL DEFAULT '' COMMENT '资源版本',
  `state` varchar(30) NOT NULL DEFAULT '' COMMENT '资源类别',
  `author` varchar(60) NOT NULL DEFAULT '' COMMENT '作者',
  `hits` bigint DEFAULT '0' COMMENT '总点击',
  `yhits` bigint DEFAULT '0' COMMENT '月点击',
  `zhits` bigint DEFAULT '0' COMMENT '周点击',
  `rhits` bigint DEFAULT '0' COMMENT '日点击',
  `hits_uptime` int NOT NULL DEFAULT '0' COMMENT '统计更新时间',
  `shits` bigint(20) DEFAULT '0' COMMENT '收藏人气',
  `pay` tinyint(1) DEFAULT '0' COMMENT '是否收费,1:金币,2:VIP',
  `cion` int DEFAULT '0' COMMENT '打赏总额',
  `msg` varchar(128) DEFAULT '' COMMENT '未审核原因',
  `jumpurl` varchar(150) NOT NULL DEFAULT '' COMMENT '跳转地址',
  `isend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否完结',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '锁定',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '推荐',
  `copyright` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '版权',
  `duration` varchar(10) NOT NULL DEFAULT '' COMMENT '视频时长',
  `up` mediumint(8) unsigned NOT NULL DEFAULT '0'  COMMENT '顶',
  `down` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '踩',
  `score` decimal(3,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '评分',
  `score_all` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '总分数',
  `score_num` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '评论次数',
  `trysee` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '尝试观看',
  `douban_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '豆瓣ID',
  `douban_score` decimal(3,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '豆瓣评分',
  `play_from` varchar(255) NOT NULL DEFAULT '' ,
  `play_server` varchar(255) NOT NULL DEFAULT '' ,
  `play_note` varchar(255) NOT NULL DEFAULT '' ,
  `play_url` mediumtext NOT NULL COMMENT '播放地址',
  `down_from` varchar(255) NOT NULL DEFAULT '' COMMENT '下载来源',
  `down_server` varchar(255) NOT NULL DEFAULT '' COMMENT '下载服务器',
  `down_note` varchar(255) NOT NULL DEFAULT '' COMMENT '下载NOTE',
  `down_url` mediumtext NOT NULL COMMENT '下载地址',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT "状态|0:待审核,1:正常",
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `level` (`level`) USING BTREE,
  KEY `hits` (`hits`) USING BTREE,
  KEY `letter` (`letter`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `year` (`year`) USING BTREE,
  KEY `area` (`area`) USING BTREE,
  KEY `lang` (`lang`) USING BTREE,
  KEY `tag` (`tag`) USING BTREE,
  KEY `class` (`class`) USING BTREE,
  KEY `lock` (`lock`) USING BTREE,
  KEY `up` (`up`) USING BTREE,
  KEY `down` (`down`) USING BTREE,
  KEY `group_id` (`group_id`) USING BTREE,
  KEY `actor` (`actor`) USING BTREE,
  KEY `director` (`director`) USING BTREE,
  KEY `score_all` (`score_all`) USING BTREE,
  KEY `score_num` (`score_num`) USING BTREE,
  KEY `total` (`total`) USING BTREE,
  KEY `score` (`score`) USING BTREE,
  KEY `version` (`version`),
  KEY `state` (`state`),
  KEY `isend` (`isend`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='视频';

-- ----------------------------
-- Table structure for hm_vod_comment
-- ----------------------------
DROP TABLE IF EXISTS `hm_vod_comment`;
CREATE TABLE `hm_vod_comment` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` tinyint(1) unsigned NOT NULL DEFAULT '1' ,
  `rid` bigint(10) unsigned NOT NULL DEFAULT '0' ,
  `pid` bigint(10) unsigned NOT NULL DEFAULT '0' ,
  `uid` bigint(10) unsigned NOT NULL DEFAULT '0' ,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' ,
  `name` varchar(60) NOT NULL DEFAULT '' ,
  `ip` bigint(10) unsigned NOT NULL DEFAULT '0' ,
  `content` text COMMENT '评论内容',
  `up` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
  `down` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
  `reply` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
  `report` tinyint(2) unsigned NOT NULL DEFAULT '0' ,
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`) USING BTREE,
  KEY `rid` (`rid`) USING BTREE,
  KEY `pid` (`pid`),
  KEY `uid` (`uid`),
  KEY `reply` (`reply`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='视频评论';


-- ----------------------------
-- Table structure for hm_article
-- ----------------------------
DROP TABLE IF EXISTS `hm_article`;
CREATE TABLE `hm_article` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uid` bigint unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `group_id` smallint(6) unsigned NOT NULL DEFAULT '0' ,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `en` varchar(255) NOT NULL DEFAULT '' COMMENT '英文',
  `sub` varchar(255) NOT NULL DEFAULT '' COMMENT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `letter` char(1) NOT NULL DEFAULT '' COMMENT '首字母',
  `color` varchar(6) NOT NULL DEFAULT '' COMMENT '颜色',
  `from` varchar(30) NOT NULL DEFAULT '' COMMENT '来自',
  `author` varchar(30) NOT NULL DEFAULT '' COMMENT '作者',
  `tag` varchar(100) NOT NULL DEFAULT ''  COMMENT '标签',
  `class` varchar(255) NOT NULL DEFAULT '' ,
  `pic` varchar(1024) NOT NULL DEFAULT '' ,
  `pic_thumb` varchar(1024) NOT NULL DEFAULT '' ,
  `pic_slide` varchar(1024) NOT NULL DEFAULT '' ,
  `pic_screenshot` text,
  `blurb` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `remarks` varchar(100) NOT NULL DEFAULT '' ,
  `jumpurl` varchar(150) NOT NULL DEFAULT '' ,
  `tpl` varchar(30) NOT NULL DEFAULT '' ,
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' ,
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0' ,
  `points` smallint(6) unsigned NOT NULL DEFAULT '0' ,
  `points_detail` smallint(6) unsigned NOT NULL DEFAULT '0' ,
  `up` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '顶',
  `down` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '',
  `hits` bigint DEFAULT '0' COMMENT '总点击',
  `yhits` bigint DEFAULT '0' COMMENT '月点击',
  `zhits` bigint DEFAULT '0' COMMENT '周点击',
  `rhits` bigint DEFAULT '0' COMMENT '日点击',
  `hits_uptime` bigint NOT NULL DEFAULT '0' COMMENT '统计更新时间',
  `score` decimal(3,1) unsigned NOT NULL DEFAULT '0.0' ,
  `score_all` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
  `score_num` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
  `pwd` varchar(10) NOT NULL DEFAULT '' ,
  `pwd_url` varchar(255) NOT NULL DEFAULT '' ,
  `title` mediumtext NOT NULL ,
  `note` mediumtext NOT NULL ,
  `content` mediumtext NOT NULL ,
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`) USING BTREE,
  KEY `level` (`level`) USING BTREE,
  KEY `letter` (`letter`) USING BTREE,
  KEY `down` (`down`) USING BTREE,
  KEY `up` (`up`) USING BTREE,
  KEY `tag` (`tag`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `en` (`en`) USING BTREE,
  KEY `hits` (`hits`) USING BTREE,
  KEY `yhits` (`yhits`) USING BTREE,
  KEY `zhits` (`zhits`) USING BTREE,
  KEY `rhits` (`rhits`) USING BTREE,
  KEY `hits_uptime` (`hits_uptime`) USING BTREE,
  KEY `lock` (`lock`),
  KEY `score` (`score`),
  KEY `score_all` (`score_all`),
  KEY `score_num` (`score_num`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='文章';

-- -----------------------------------------
-- Table structure for hm_article_class
-- -----------------------------------------
DROP TABLE IF EXISTS `hm_article_class`;
CREATE TABLE `hm_article_class` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0' COMMENT '类型PID',
  `name` varchar(255) DEFAULT '0' COMMENT '名称',
  `en` varchar(255) DEFAULT '0' COMMENT '英文名称',
  `sort` smallint unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `extend` text  COMMENT '扩展信息',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT 'LOGO',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '图片信息',
  `jumpurl` varchar(255) NOT NULL DEFAULT '' COMMENT '跳转地址',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT "状态|1:正常,0:禁止显示",
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`) USING BTREE,
  KEY `pid` (`pid`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `en` (`en`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='文章分类';


-- ----------------------------
-- Table structure for hm_article_comment
-- ----------------------------
DROP TABLE IF EXISTS `hm_article_comment`;
CREATE TABLE `hm_article_comment` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型|1,文章:2,专题',
  `rid` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复ID',
  `pid` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `uid` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `name` varchar(60) NOT NULL DEFAULT '' ,
  `ip` bigint(10) unsigned NOT NULL DEFAULT '0' ,
  `content` text,
  `up` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
  `down` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
  `reply` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
  `report` tinyint(2) unsigned NOT NULL DEFAULT '0' ,
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`) USING BTREE,
  KEY `rid` (`rid`) USING BTREE,
  KEY `pid` (`pid`),
  KEY `uid` (`uid`),
  KEY `reply` (`reply`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='文章评论';


-- ----------------------------
-- Table structure for hm_novel
-- ----------------------------
DROP TABLE IF EXISTS `hm_novel`;
CREATE TABLE `hm_novel` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uid` bigint unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `group_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '组ID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `en` varchar(255) NOT NULL DEFAULT '' COMMENT '英文',
  `sub` varchar(255) NOT NULL DEFAULT '' COMMENT '副标题',
  `letter` char(1) NOT NULL DEFAULT '' COMMENT '首字母',
  `color` varchar(6) NOT NULL DEFAULT '' COMMENT '颜色',
  `from` varchar(30) NOT NULL DEFAULT '' COMMENT '来自',
  `author` varchar(30) NOT NULL DEFAULT '' COMMENT '作者',
  `tag` varchar(100) NOT NULL DEFAULT ''  COMMENT '标签',
  `class` varchar(255) NOT NULL DEFAULT '' COMMENT '扩展分类',
  `pic` varchar(1024) NOT NULL DEFAULT '' COMMENT '封面',
  `pic_thumb` varchar(1024) NOT NULL DEFAULT '' COMMENT '封面缩略',
  `pic_slide` varchar(1024) NOT NULL DEFAULT '' COMMENT '海报',
  `remarks` varchar(100) NOT NULL DEFAULT ''  COMMENT '备注',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '推荐方式',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否锁定',
  `up` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '顶👍',
  `down` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '踩👎',
  `hits` bigint DEFAULT '0' COMMENT '总点击',
  `yhits` bigint DEFAULT '0' COMMENT '月点击',
  `zhits` bigint DEFAULT '0' COMMENT '周点击',
  `rhits` bigint DEFAULT '0' COMMENT '日点击',
  `hits_uptime` bigint NOT NULL DEFAULT '0' COMMENT '统计更新时间',
  `score` decimal(3,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '评分',
  `score_all` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '评分总分',
  `score_num` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '评分人数',
  `blurb` varchar(255) NOT NULL DEFAULT '' COMMENT '短简介',
  `content` mediumtext NOT NULL COMMENT '简介',
  `pay` tinyint(1) DEFAULT '0' COMMENT '0:是否收费,1:金币,2:VIP',
  `cion` int DEFAULT '0' COMMENT '金币',
  `status` tinyint(1) DEFAULT '0' COMMENT '0:已审核，1:待审核，2:未通过',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`) USING BTREE,
  KEY `level` (`level`) USING BTREE,
  KEY `letter` (`letter`) USING BTREE,
  KEY `down` (`down`) USING BTREE,
  KEY `up` (`up`) USING BTREE,
  KEY `tag` (`tag`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `en` (`en`) USING BTREE,
  KEY `hits` (`hits`) USING BTREE,
  KEY `yhits` (`yhits`) USING BTREE,
  KEY `zhits` (`zhits`) USING BTREE,
  KEY `rhits` (`rhits`) USING BTREE,
  KEY `hits_uptime` (`hits_uptime`) USING BTREE,
  KEY `lock` (`lock`),
  KEY `score` (`score`),
  KEY `score_all` (`score_all`),
  KEY `score_num` (`score_num`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='小说';


-- ------------------------------------
-- Table structure for hm_novel_chapter
-- ------------------------------------
DROP TABLE IF EXISTS `hm_novel_chapter`;
CREATE TABLE `hm_novel_chapter` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `nid` int(11) DEFAULT '0' COMMENT '小说ID',
 `name` varchar(128) DEFAULT '' COMMENT '章节名称',
 `addr` text COMMENT '内容地址',
 `vip` tinyint(1) DEFAULT '0' COMMENT 'VIP阅读，0否1是',
 `cion` int(11) DEFAULT '0' COMMENT '章节需要金币',
 `create_time` datetime NOT NULL COMMENT '入库时间',
 `update_time` datetime NOT NULL COMMENT '更新时间',
 PRIMARY KEY (`id`),
 UNIQUE KEY `nid_name` (`nid`,`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='小说章节';

-- -----------------------------------------
-- Table structure for hm_novel_class
-- -----------------------------------------
DROP TABLE IF EXISTS `hm_novel_class`;
CREATE TABLE `hm_novel_class` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0' COMMENT '类型PID',
  `name` varchar(255) DEFAULT '0' COMMENT '名称',
  `en` varchar(255) DEFAULT '0' COMMENT '英文名称',
  `sort` smallint unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '关键词',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `extend` text  COMMENT '扩展信息',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT 'LOGO',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '图片信息',
  `jumpurl` varchar(255) NOT NULL DEFAULT '' COMMENT '跳转地址',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT "状态|1:正常,0:禁止显示",
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`) USING BTREE,
  KEY `pid` (`pid`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `en` (`en`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='小说分类';

-- -----------------------------------------
-- Table structure for hm_novel_source
-- -----------------------------------------
DROP TABLE IF EXISTS `hm_novel_source`;
CREATE TABLE `hm_novel_source` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '0' COMMENT '名称',
  `en` varchar(255) DEFAULT '0' COMMENT '英文名称',
  `remarks` varchar(100) NOT NULL DEFAULT ''  COMMENT '备注',
  `sort` smallint unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT "状态|1:正常,0:禁止显示",
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `en` (`en`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='小说来源';

-- -----------------------------------------
-- Table structure for hm_novel_level
-- -----------------------------------------
DROP TABLE IF EXISTS `hm_novel_level`;
CREATE TABLE `hm_novel_level` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '0' COMMENT '名称',
  `remarks` varchar(100) NOT NULL DEFAULT ''  COMMENT '备注',
  `sort` smallint unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT "状态|1:正常,0:禁止显示",
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `en` (`en`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='小说推荐管理';


-- ----------------------------
-- Table structure for hm_novel_comment
-- ----------------------------
DROP TABLE IF EXISTS `hm_novel_comment`;
CREATE TABLE `hm_novel_comment` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型|1,文章:2,专题',
  `rid` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复ID',
  `pid` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `uid` bigint(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `name` varchar(60) NOT NULL DEFAULT '' ,
  `ip` bigint(10) unsigned NOT NULL DEFAULT '0' ,
  `content` text,
  `up` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
  `down` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
  `reply` mediumint(8) unsigned NOT NULL DEFAULT '0' ,
  `report` tinyint(2) unsigned NOT NULL DEFAULT '0' ,
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`) USING BTREE,
  KEY `rid` (`rid`) USING BTREE,
  KEY `pid` (`pid`),
  KEY `uid` (`uid`),
  KEY `reply` (`reply`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='小说评论';







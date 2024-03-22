
truncate table hm_admin_menu;
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(1,  '系统', '', 'sys',   1, '','系统', 1, 'nav', 1,0),
(2,  '小说', '', 'novel', 1, '', '小说', 2, 'nav',1, 0),
(3,  '漫画', '', 'comic', 1, '', '漫画', 3, 'nav', 1, 0),
(4,  '视频', '', 'video', 1, '', '视频', 4, 'nav', 1,0),
(5,  '文章', '', 'article', 1, '','文章', 5, 'nav', 1, 0),
(6,  '运营', '', 'bus', 1, '','运营', 7, 'nav', 1,0);

-- 系统【权限管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(7,  '权限管理', 'layui-icon-senior',  '', 1, '','权限管理', 1, 'menu', 1,1),
(8,  '菜单管理', '',  '', 1, 'admin_menu/index','菜单管理', 1, 'submenu', 1,7),
(9,  '角色管理', '',  '', 1, 'admin_role/index','角色管理', 1, 'submenu', 1,7),
(10, '管理员', '',  '', 1, 'admin/index','管理员', 1, 'submenu', 1,7);

-- 系统【基础设置】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(11,  '基础设置', 'layui-icon-set',  '', 1, '','基础设置', 1, 'menu', 1,1),
(12,  '网站配置', '',  '', 1, 'setting/index','网站配置', 1, 'submenu', 1,11),
(13,  '用户配置', '',  '', 1, 'setting/user','用户管理', 1, 'submenu', 1,11),
(14,  '缓存配置', '',  '', 1, 'setting/cache','缓存配置', 1, 'submenu', 1,11),
(15,  '短信配置', '',  '', 1, 'setting/sms','短信配置', 1, 'submenu', 1,11),
(16,  '邮件配置', '',  '', 1, 'setting/mail','邮件配置', 1, 'submenu', 1,11),
(17,  '财务配置', '',  '', 1, 'setting/pay','财务管理', 1, 'submenu', 1,11),
(18,  '协议配置', '',  '', 1, 'setting/protocol','协议配置', 1, 'submenu', 1,11);

-- 系统【应用管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(19,  '应用管理', 'layui-icon-release',  '', 1, '','应用管理', 1, 'menu', 1,1),
(20,  '应用列表', '',  '', 1, 'app/index','应用列表', 1, 'submenu', 1,19);

-- 运营【会员管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(21,  '会员管理', 'layui-icon-username',  '', 1, '','会员管理', 1, 'menu', 1,6),
(22,  '用户列表', '',  '', 1, 'user/index','用户列表', 1, 'submenu', 1,21),
(23,  '消息管理', '',  '', 1, 'message/index','消息管理', 1, 'submenu', 1,21),
(24,  '反馈管理', '',  '', 1, 'feedback/index','反馈管理', 1, 'submenu', 1,21);

-- 运营【财务管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(25,  '财务管理', 'layui-icon-rmb',  '', 1, '','财务管理', 1, 'menu', 1,6),
(26,  '订单管理', '',  '', 1, 'order/index','订单管理', 1, 'submenu', 1,25);

-- 运营【任务管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(27,  '任务管理', 'layui-icon-chart',  '', 1, '','任务管理', 1, 'menu', 1,6),
(28,  '任务列表', '',  '', 1, 'task/index','任务列表', 1, 'submenu', 1,27),
(29,  '任务记录', '',  '', 1, 'task_list/index','任务记录', 1, 'submenu', 1,27),
(30,  '邀请记录', '',  '', 1, 'user_invite/index','邀请记录', 1, 'submenu', 1,27);

-- 运营【验证码管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(31,  '验证码', 'layui-icon-reply-fill',  '', 1, '','验证码管理', 1, 'menu', 1,6),
(32,  '手机', '',  '', 1, 'tel_code/index','手机验证码', 1, 'submenu', 1,31),
(33,  '邮件', '',  '', 1, 'mail_code/index','邮件验证码', 1, 'submenu', 1,31);

-- 漫画【漫画管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(34,  '漫画管理', 'layui-icon-template',  '', 1, '','漫画管理', 1, 'menu', 1,3),
(35,  '漫画列表', '',  '', 1, 'comic/index','漫画列表', 1, 'submenu', 1,34),
(36,  '漫画分类', '',  '', 1, 'comic_class/index','漫画分类', 1, 'submenu', 1,34),
(37,  '漫画类型', '',  '', 1, 'comic_type/index','漫画类型', 1, 'submenu', 1,34),
(38,  '漫画章节', '',  '', 1, 'comic_chapter/index','漫画分类', 1, 'submenu', 1,34);

-- 漫画【评论管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(39,  '评论管理', 'layui-icon-template-1',  '', 1, '','评论管理', 1, 'menu', 1,3),
(40,  '评论列表', '',  '', 1, 'comic_comment/index','评论列表', 1, 'submenu', 1,39),
(41,  '回复列表', '',  '', 1, 'comic_comment_reply/index','回复列表', 1, 'submenu', 1,39);

-- 视频【视频管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(42,  '视频管理', 'layui-icon-play',  '', 1, '','视频管理', 1, 'menu', 1,4),
(43,  '视频列表', '',  '', 1, 'vod/index','视频列表', 1, 'submenu', 1,42),
(44,  '视频分类', '',  '', 1, 'vod_class/index','视频分类', 1, 'submenu', 1,42);

-- 视频【评论管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(45,  '视频评论', 'layui-icon-template-1',  '', 1, '','视频评论', 1, 'menu', 1,4),
(46,  '评论列表', '',  '', 1, 'vod_comment/index','评论列表', 1, 'submenu', 1,45);

-- 小说【小说管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(47,  '小说管理', 'layui-icon-read',  '', 1, '','小说管理', 1, 'menu', 1, 2),
(48,  '小说列表', '',  '', 1, 'novel/index','小说列表', 1, 'submenu', 1, 47),
(49,  '小说分类', '',  '', 1, 'novel_class/index','小说分类', 1, 'submenu', 1, 47);

-- 小说【评论管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(50,  '小说评论', 'layui-icon-template-1',  '', 1, '','小说评论', 1, 'menu', 1, 2),
(51,  '评论列表', '',  '', 1, 'novel_comment/index','评论列表', 1, 'submenu', 1, 50);

-- 文章【文章管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(52,  '文章管理', 'layui-icon-list',  '', 1, '','文章管理', 1, 'menu', 1,5),
(53,  '文章列表', '',  '', 1, 'article/index','文章列表', 1, 'submenu', 1,52),
(54,  '文章分类', '',  '', 1, 'article_class/index','文章分类', 1, 'submenu', 1,52);

-- 文章【评论管理】
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(55,  '文章评论', 'layui-icon-template-1',  '', 1, '','文章评论', 1, 'menu', 1,5),
(56,  '评论列表', '',  '', 1, 'article_comment/index','评论列表', 1, 'submenu', 1,55);


-- 系统【权限管理】| API
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('添加/编辑', '',  '', 1, 'admin_menu/save','接口', 1, 'api', 1,8),
('删除', '',  '', 1, 'admin_menu/del','接口', 1, 'api', 1,8),
('批量删除', '',  '', 1, 'admin_menu/batchDel','接口', 1, 'api', 1,8),
('是否显示', '',  '', 1, 'admin_menu/triggerDisplay','接口', 1, 'api', 1,8),
('是否禁用', '',  '', 1, 'admin_menu/triggerStatus','接口', 1, 'api', 1,8);
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('添加/编辑', '',  '', 1, 'admin_role/save','接口', 1, 'api', 1,9),
('删除', '',  '', 1,  'admin_role/del','接口', 1, 'api', 1,9),
('设置权限', '',  '', 1, 'admin_menu/setAcl','接口', 1, 'api', 1,9);
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('添加/编辑', '',  '', 1, 'admin/save','接口', 1, 'api', 1,10),
('删除', '',  '', 1,  'admin/del','接口', 1, 'api', 1,10);

-- 系统【基础设置】| API
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('保存', '',  '', 1, 'setting/save','接口', 1, 'api', 1,12);

INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('添加/编辑', '',  '', 1, 'app/save','接口', 1, 'api', 1,20),
('批量删除', '',  '', 1, 'app/batchDel','接口', 1, 'api', 1,20),
('删除', '',  '', 1,  'app/del','接口', 1, 'api', 1,20);

-- 运营【会员管理】| API
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'user/list','接口', 1, 'api', 1,22),
('保存API', '',  '', 1, 'user/save','接口', 1, 'api', 1,22),
('批量删除', '',  '', 1, 'user/batchDel','接口', 1, 'api', 1,22),
('删除', '',  '', 1, 'user/del','接口', 1, 'api', 1,22),
('添加/保存', '',  '', 1, 'user/edit','接口', 1, 'api', 1,22);
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'message/list','接口', 1, 'api', 1,23),
('保存API', '',  '', 1, 'message/save','接口', 1, 'api', 1,23),
('批量删除', '',  '', 1, 'message/batchDel','接口', 1, 'api', 1,23),
('删除', '',  '', 1, 'message/del','接口', 1, 'api', 1,23),
('添加/保存', '',  '', 1, 'message/edit','接口', 1, 'api', 1,23);
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'feedback/list','接口', 1, 'api', 1,24),
('批量删除', '',  '', 1, 'feedback/batchDel','接口', 1, 'api', 1,24),
('删除', '',  '', 1, 'feedback/del','接口', 1, 'api', 1,24);

-- 运营【财务管理】| API
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'order/list','接口', 1, 'api', 1,26),
('批量删除', '',  '', 1, 'order/batchDel','接口', 1, 'api', 1,26),
('删除', '',  '', 1, 'order/del','接口', 1, 'api', 1,26);

-- 运营【任务管理】 | API
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'task/list','接口', 1, 'api', 1,28),
('编辑', '',  '', 1, 'task/edit','接口', 1, 'api', 1,28),
('子列表', '',  '', 1, 'task/type','接口', 1, 'api', 1,28),
('更改开启状态', '',  '', 1, 'task/triggerStatus','接口', 1, 'api', 1,28);
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'task_list/list','接口', 1, 'api', 1,29),
('批量删除', '',  '', 1, 'task_list/batchDel','接口', 1, 'api', 1,29),
('删除', '',  '', 1, 'task_list/del','接口', 1, 'api', 1,29);
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'user_invite/list','接口', 1, 'api', 1,30),
('批量删除', '',  '', 1, 'user_invite/batchDel','接口', 1, 'api', 1,30),
('删除', '',  '', 1, 'user_invite/del','接口', 1, 'api', 1,30);

-- 运营【验证码管理】| API
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'tel_code/list','接口', 1, 'api', 1,32),
('批量删除', '',  '', 1, 'tel_code/batchDel','接口', 1, 'api', 1,32),
('删除', '',  '', 1, 'tel_code/del','接口', 1, 'api', 1,32);
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'mail_code/list','接口', 1, 'api', 1,33),
('批量删除', '',  '', 1, 'mail_code/batchDel','接口', 1, 'api', 1,33),
('删除', '',  '', 1, 'mail_code/del','接口', 1, 'api', 1,33);

-- 漫画【漫画管理】| API
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'comic/list','接口', 1, 'api', 1,35),
('添加/编辑', '',  '', 1, 'comic/save','接口', 1, 'api', 1,35),
('批量删除', '',  '', 1, 'comic/batchDel','接口', 1, 'api', 1,35),
('删除', '',  '', 1, 'comic/del','接口', 1, 'api', 1,35);
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'comic_class/list','接口', 1, 'api', 1,36),
('添加/编辑', '',  '', 1, 'comic_class/save','接口', 1, 'api', 1,36),
('批量删除', '',  '', 1, 'comic_class/batchDel','接口', 1, 'api', 1,36),
('删除', '',  '', 1, 'comic_class/del','接口', 1, 'api', 1,36);
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'comic_class/list','接口', 1, 'api', 1,37),
('添加/编辑', '',  '', 1, 'comic_class/save','接口', 1, 'api', 1,37),
('批量删除', '',  '', 1, 'comic_class/batchDel','接口', 1, 'api', 1,37),
('删除', '',  '', 1, 'comic_class/del','接口', 1, 'api', 1,37);
INSERT INTO `hm_admin_menu` (`name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
('列表', '',  '', 1, 'comic_class/list','接口', 1, 'api', 1,38),
('添加/编辑', '',  '', 1, 'comic_class/save','接口', 1, 'api', 1,38),
('批量删除', '',  '', 1, 'comic_class/batchDel','接口', 1, 'api', 1,38),
('删除', '',  '', 1, 'comic_class/del','接口', 1, 'api', 1,38);


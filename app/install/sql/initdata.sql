-- INSERT INTO `hm_task` VALUES ('1', '0', '签到有礼', '每天签到可以获得奖励', '10', '0', '1');
-- INSERT INTO `hm_task` VALUES ('2', '0', '邀请用户', '每成功邀请1人可获得相应奖励', '10', '1', '0');
-- INSERT INTO `hm_task` VALUES ('3', '0', '评论漫画', '每天评论漫画可以获得奖励', '5', '0', '3');
-- INSERT INTO `hm_task` VALUES ('4', '0', '收藏漫画', '每天收藏漫画可以获得奖励', '5', '0', '3');
-- INSERT INTO `hm_task` VALUES ('5', '0', '评论小说', '每天评论小说可以获得奖励', '5', '0', '3');
-- INSERT INTO `hm_task` VALUES ('6', '0', '收藏小说', '每天收藏小说可以获得奖励', '5', '0', '3');

INSERT INTO `hm_task` (`id`, `type`, `pid`, `status`, `name`, `text`, `cion`, `vip`, `daynum`, `create_time`, `update_time`) VALUES 
('1', '1', '0', '0', '签到有礼', '每天签到可以获得奖励', '10', '0', '1', '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('2', '0', '0', '0', '邀请用户', '每成功邀请1人可获得相应奖励', '10', '1', '0', '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('3', '0', '0', '0', '评论漫画', '每天评论漫画可以获得奖励', '5', '0', '3', '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('4', '0', '0', '0', '收藏漫画', '每天收藏漫画可以获得奖励', '5', '0', '3', '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('5', '0', '0', '0', '评论小说', '每天评论小说可以获得奖励', '5', '0', '3', '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('6', '0', '0', '0', '收藏小说', '每天收藏小说可以获得奖励', '5', '0', '3', '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('7', '0', '0', '0', '评论视频', '每天评论视频可以获得奖励', '5', '0', '3', '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('8', '0', '0', '0', '收藏视频', '每天收藏视频可以获得奖励', '5', '0', '3', '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('9', '0', '0', '0', '评论文章', '每天评论文章可以获得奖励', '5', '0', '3', '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('10','0', '0', '0', '收藏文章', '每天收藏文章可以获得奖励', '5', '0', '3', '2024-01-14 23:58:37', '2024-01-14 23:58:37');
INSERT INTO `hm_task` (`id`, `type`, `pid`, `status`, `name`, `text`, `cion`, `vip`, `daynum`, `extra`,`create_time`, `update_time`) VALUES
('11','0', '1', '0', '周一签到', '周一签到获得奖励', '5', '0', '1', '1','2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('12','0', '1', '0', '周二签到', '周二签到获得奖励', '5', '0', '1', '2','2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('13','0', '1', '0', '周三签到', '周三签到获得奖励', '5', '0', '1', '3','2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('14','0', '1', '0', '周四签到', '周四签到获得奖励', '5', '0', '1', '4','2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('15','0', '1', '0', '周五签到', '周五签到获得奖励', '5', '0', '1', '5','2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('16','0', '1', '0', '周六签到', '周六签到获得奖励', '5', '0', '1', '6','2024-01-14 23:58:37', '2024-01-14 23:58:37'),
('17','0', '1', '0', '周日签到', '周日签到获得奖励', '5', '0', '1', '0','2024-01-14 23:58:37', '2024-01-14 23:58:37');

INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(1,  '系统', '', 'sys',   0, '','系统', 1, 'nav', 1,0),
(2,  '小说', '', 'novel', 0, '', '小说', 2, 'nav',1, 0),
(3,  '漫画', '', 'comic', 0, '', '漫画', 3, 'nav', 1, 0),
(4,  '视频', '', 'video', 0, '', '视频', 4, 'nav', 1,0),
(5,  '文章', '', 'article', 0, '','文章', 5, 'nav', 1, 0),
(6,  '运营', '', 'bus', 0, '','运营', 7, 'nav', 1,0);
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(7,  '权限管理', 'layui-icon-senior',  '', 0, '','权限管理', 1, 'menu', 1,1),
(8,  '菜单管理', '',  '', 0, 'adminmenu/index','菜单管理', 1, 'submenu', 1,8),
(9,  '角色管理', '',  '', 0, 'adminrole/index','角色管理', 1, 'submenu', 1,8),
(10, '管理员', '',  '', 0, 'admin/index','管理员', 1, 'submenu', 1,8);
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(11,  '基础设置', 'layui-icon-set',  '', 0, '','基础设置', 1, 'menu', 1,1),
(12,  '网站配置', '',  '', 0, 'setting/index','网站配置', 1, 'submenu', 1,11),
(13,  '用户管理', '',  '', 0, 'setting/user','用户管理', 1, 'submenu', 1,1),
(14,  '缓存配置', '',  '', 0, 'setting/cache','缓存配置', 1, 'submenu', 1,11),
(15,  '短信配置', '',  '', 0, 'setting/sms','短信配置', 1, 'submenu', 1,11),
(16,  '邮件配置', '',  '', 0, 'setting/mail','邮件配置', 1, 'submenu', 1,11),
(17,  '财务管理', '',  '', 0, 'setting/pay','财务管理', 1, 'submenu', 1,11);
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `display`,`pid`) VALUES
(18,  '应用管理', 'layui-icon-release',  '', 0, '','应用管理', 1, 'menu', 1,1),
(19,  '应用列表', '',  '', 0, 'app/index','应用列表', 1, 'submenu', 1,18);


INSERT INTO `hm_comic_class` (`id`, `name`, `yname`, `sort`,`pid`, `create_time`,`update_time`) VALUES
(1, '韩漫', 'hanime', 1, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(2, '台漫', 'tanime', 2, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(3, '3D', '3d', 3, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(4, '同人', 'colleagues', 4, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(5, '耽美', 'slash', 4, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(6, '出版', 'publish', 6, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(7, '真人', 'real', 7, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37');


INSERT INTO `hm_comic_type` (`id`, `name`, `pid`, `field`,`sort`, `mode`, `create_time`,`update_time`) VALUES
(1, '标签', 0, 'tag', 1, 1,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(2, '类型', 0, 'theme', 2, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(3, '品质', 0, 'quality', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(4, '地区', 0, 'city', 4, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(5, '版权', 0, 'copyright', 5, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(6, '冒险', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(7, '热血', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(8, '科幻', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(9, '霸总', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(10, '玄幻', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(11, '校园', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(12, '修真', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(13, '搞笑', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(14, '穿越', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(15, '后宫', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(16, '耽美', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(17, '恋爱', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(18, '悬疑', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(19, '恐怖', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(20, '战争', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(21, '动作', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(22, '同人', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(23, '竞技', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(24, '励志', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(25, '架空', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(26, '灵异', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(27, '百合', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(28, '古风', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(29, '生活', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(30, '真人', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(31, '都市', 1, 'tags', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(32, '故事漫画', 2, 'theme', 1, 1,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(33, '轻小说', 2, 'theme', 2, 1,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(34, '四格', 2, 'theme', 3, 1,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(35, '绘本', 2, 'theme', 4, 1,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(36, '单幅', 2, 'theme', 5, 1,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(37, '条漫', 2, 'theme', 6, 1,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(38, '签约', 3, 'quality', 1, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(39, '精品', 3, 'quality', 2, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(40, '热门', 3, 'quality', 3, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(41, '新手', 3, 'quality', 4, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(42, '内地', 4, 'city', 1, 1,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(43, '港台', 4, 'city', 2, 1,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(44, '韩国', 4, 'city', 3, 1,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(45, '日本', 4, 'city', 4, 1,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(46, '首发', 5, 'copyright', 1, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(47, '独家', 5, 'copyright', 2, 0,'2024-01-14 23:58:37', '2024-01-14 23:58:37');


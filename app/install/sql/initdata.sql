
INSERT INTO `hm_admin_menu` (`id`, `name`, `icon`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `pid`) VALUES
(1, '系统', '', 'sys',   0, '','系统', 1, 'nav', 0),
(2, '小说', '', 'novel', 0, '', '小说', 2, 'nav', 0),
(3, '漫画', '', 'comic', 0, '', '漫画', 3, 'nav', 0),
(4, '视频', '', 'video', 0, '', '视频', 4, 'nav', 0),
(5, '文章', '', 'article', 0, '','文章', 5, 'nav', 0),
(6, '用户', '', 'user', 0, '','用户', 6, 'nav', 0),
(7, '运营', '', 'bus', 0, '','运营', 7, 'nav', 0),
(8, '权限管理', 'layui-icon-senior',  '', 0, '','权限管理', 1, 'menu', 1),
(9, '菜单管理', '',  '', 0, 'auth/index','菜单管理', 1, 'submenu', 8),
(10, '角色管理', '',  '', 0, 'auth/role','角色管理', 1, 'submenu', 8),
(11, '管理员', '',  '', 0, 'auth/admin','管理员', 1, 'submenu', 8);


INSERT INTO `hm_comic_class` (`id`, `name`, `yname`, `sort`,`pid`, `create_time`,`update_time`) VALUES
(1, '韩漫', 'hanime', 1, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(2, '台漫', 'tanime', 2, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(3, '3D', '3d', 3, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(4, '同人', 'colleagues', 4, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(5, '耽美', 'slash', 4, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(6, '出版', 'publish', 6, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37'),
(7, '真人', 'real', 7, 0, '2024-01-14 23:58:37', '2024-01-14 23:58:37');



INSERT INTO `hm_admin_menu` (`id`, `name`, `title`, `alias`,`status`, `route`,`remark`, `sort`, `type`, `pid`) VALUES
(1, '系统', '系统', 'sys',   0, '','系统', 1, 'nav', 0),
(2, '小说', '小说', 'novel', 0, '', '小说', 2, 'nav', 0),
(3, '漫画', '漫画', 'comic', 0, '', '漫画', 3, 'nav', 0),
(4, '视频', '视频', 'video', 0, '', '视频', 4, 'nav', 0),
(5, '文章', '文章', 'article', 0, '','文章', 5, 'nav', 0),
(6, '用户', '用户', 'user', 0, '','用户', 6, 'nav', 0),
(7, '运营', '运营', 'bus', 0, '','运营', 7, 'nav', 0),
(8, '权限管理', '权限管理',  '', 0, '','权限管理', 1, 'menu', 2),
(9, '菜单管理', '菜单管理',  '', 0, 'auth/index','菜单管理', 1, 'submenu', 9);


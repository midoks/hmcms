<?php /*a:3:{s:65:"/Users/midoks/Desktop/www/tp/hmcms//app/admin/view/auth/role.html";i:1705159499;s:33:"app/admin/view/common/header.html";i:1704905364;s:33:"app/admin/view/common/footer.html";i:1704569025;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>鸿蒙CMS</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/admin/layuiadmin/layui/css/layui.css?v=<?php echo htmlentities($version); ?>" media="all">
    <link rel="stylesheet" href="/static/admin/layuiadmin/style/admin.css?v=<?php echo htmlentities($version); ?>" media="all">
    <!-- <link rel="stylesheet" href="/static/admin/css/admin_style.css?v=<?php echo htmlentities($version); ?>"> -->
    <script src="/static/admin/layuiadmin/layui/layui.js?v=<?php echo htmlentities($version); ?>"></script>
    <script src="/static/admin/js/main.js?v=<?php echo htmlentities($version); ?>"></script>
      
</head>
<body class="layui-layout-body">
<!-- start -->
<div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <!-- 头部区域 -->
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item layadmin-flexible" lay-unselect>
                    <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
                        <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
                    </a>
                </li>

                <?php if(empty($hm_nav_list)): ?>
                    <li class="layui-nav-item layui-hide-xs" lay-unselect><a href="<?php echo url('index/sys'); ?>">系统</a></li>
                <?php else: if(is_array($hm_nav_list) || $hm_nav_list instanceof \think\Collection || $hm_nav_list instanceof \think\Paginator): $k = 0; $__LIST__ = $hm_nav_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
                    <li class="layui-nav-item layui-hide-xs <?php if(app('request')->session('hm_nav_cur') == $v['alias']): ?>layui-this<?php endif; ?>" lay-unselect ><a href="<?php echo url('index/index',['view'=>$v['alias']]); ?>"><?php echo htmlentities($v["name"]); ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                <?php endif; ?>

            </ul>

            <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
            
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="/" target="_blank" title="前台">
                        <i class="layui-icon layui-icon-website"></i>
                    </a>
                </li>

                <!-- <li class="layui-nav-item" lay-unselect>
                    <a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">
                    <i class="layui-icon layui-icon-notice"></i>
                        <span class="layui-badge-dot"></span>
                    </a>
                </li> -->

                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="note">
                        <i class="layui-icon layui-icon-note"></i>
                    </a>
                </li>

                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="fullscreen">
                        <i class="layui-icon layui-icon-screen-full"></i>
                    </a>
                </li>

                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;">
                        <cite>admin</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a lay-href="set/user/info.html">基本资料</a></dd>
                        <dd><a lay-href="set/user/password.html">修改密码</a></dd>
                        <hr>
                        <dd layadmin-event="logout" style="text-align: center;"><a>退出</a></dd>
                    </dl>
                </li>
              
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="theme"><i class="layui-icon layui-icon-more-vertical"></i></a>
                </li>
                <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
                    <a href="javascript:;" layadmin-event="theme"><i class="layui-icon layui-icon-more-vertical"></i></a>
                </li>
            </ul>
        </div>
      
        <!-- 侧边菜单 -->
        <div class="layui-side layui-side-menu">
            <div class="layui-side-scroll">
                <div class="layui-logo layui-hide-xs layui-bg-black">
                    <img style="height: 24px;vertical-align: text-bottom;" src="/static/admin/images/logo.png"/>
                    <span>&nbsp;鸿蒙CMS</span>
                </div>

                <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">

                    <?php if(empty($hm_nav_list)): ?>
                    <li data-name="home" class="layui-nav-item layui-nav-itemed">
                        <a href="javascript:;" lay-tips="主页" lay-direction="2">
                            <i class="layui-icon layui-icon-home"></i>
                            <cite>主页</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd data-name="console" class="layui-this">
                                <a lay-href="home/console.html">控制台</a>
                            </dd>
                        </dl>
                    </li>
                    <?php else: if(is_array($hm_nav_list) || $hm_nav_list instanceof \think\Collection || $hm_nav_list instanceof \think\Paginator): $k = 0; $__LIST__ = $hm_nav_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;if(app('request')->session('hm_nav_cur') == $v['alias'] && !empty($v['submenu'])): if(is_array($v['submenu']) || $v['submenu'] instanceof \think\Collection || $v['submenu'] instanceof \think\Paginator): $k1 = 0; $__LIST__ = $v['submenu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu_v): $mod = ($k1 % 2 );++$k1;?>
                        <li data-name="home" class="layui-nav-item layui-nav-itemed">
                            <a href="javascript:;" lay-tips="<?php echo htmlentities($menu_v['name']); ?>" lay-direction="2">
                                <i class="layui-icon layui-icon-home"></i>
                                <cite><?php echo htmlentities($menu_v["name"]); ?></cite>
                            </a>
                            <dl class="layui-nav-child">

                                <?php if(!empty($menu_v['submenu'])): if(is_array($menu_v['submenu']) || $menu_v['submenu'] instanceof \think\Collection || $menu_v['submenu'] instanceof \think\Paginator): $k2 = 0; $__LIST__ = $menu_v['submenu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu_vv): $mod = ($k2 % 2 );++$k2;?>
                                <dd>
                                    <a href="<?php echo url($menu_vv['route']); ?>"><?php echo htmlentities($menu_vv["name"]); ?></a>
                                </dd>
                                <?php endforeach; endif; else: echo "" ;endif; ?>

                                <?php endif; ?>
                            </dl>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                        <?php endif; ?>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php endif; ?>

                </ul>
            </div>
        </div>

        <!-- 页面标签 -->
        <div class="layadmin-pagetabs" id="LAY_app_tabs">
            <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
            <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>

            <div class="layui-card layadmin-header" style="display: block; line-height: 40px;height: 40px;">
                <div class="layui-breadcrumb" lay-filter="breadcrumb" >
                    <a lay-href="">主页</a>
                    <a><cite>主页一</cite></a>
                </div>
            </div>
        </div>
      
        <!-- 主体内容 -->
        <div class="layui-body" id="LAY_app_body">
            <div class="layadmin-tabsbody-item layui-show" style="overflow-y: auto;margin-bottom: 40px;">
<!--     
        </div>
</div> 
-->


<div class="layui-fluid">

	<div class="layui-col-md4" style="padding: 5px;">
		<div class="layui-card">
		  	<div class="layui-card-header">导航</div>
		  	<div class="layui-card-body">
		  		<script type="text/html" id="toolbar_navlist">
				 	<div class="layui-btn-container">
				    	<button class="layui-btn layui-btn-sm" lay-event="add_nav"><i class="layui-icon"></i>添加</button>
				  	</div>
				</script>
			    <div id="nav_list"></div>
		  	</div>
		</div>
	</div>

	<div class="layui-col-md4" style="padding: 5px;">
		<div class="layui-card">
		  	<div class="layui-card-header">菜单</div>
		  	<div class="layui-card-body">
		  		<script type="text/html" id="toolbar_menulist">
				 	<div class="layui-btn-container">
				    	<button class="layui-btn layui-btn-sm" lay-event="add_menu"><i class="layui-icon"></i>添加</button>
				  	</div>
				</script>
		  		<div id="menu_list"></div>
		  	</div>
		</div>
	</div>

	<div class="layui-col-md4" style="padding: 5px;">
		<div class="layui-card">
		  	<div class="layui-card-header">子菜单</div>
		  	<div class="layui-card-body">
                <script type="text/html" id="toolbar_submenulist">
                    <div class="layui-btn-container">
                        <button class="layui-btn layui-btn-sm" lay-event="add_submenu"><i class="layui-icon"></i>添加</button>
                    </div>
                </script>
			    <div id="submenu_list"></div>
		  	</div>
		</div>
	</div>

<!-- 	<div class="layui-col-md4" style="padding: 5px;">
		<div class="layui-card">
		  	<div class="layui-card-header">权限</div>
		  	<div class="layui-card-body">
		    卡片式面板面板通常用于非白色背景色的主体内<br>
		    从而映衬出边框投影
		  	</div>
		</div>
	</div> -->

</div>


<script type="text/javascript">

layui.config({base: '/static/admin/layuiadmin/'}).use(['table','jquery','dropdown'], function(){
///
var admin = layui.admin
,$ = layui.$
,form = layui.form
,dropdown = layui.dropdown
,table = layui.table;

table.render({
    elem: '#nav_list',
    url: '<?php echo url("auth/list"); ?>',
    toolbar: '#toolbar_navlist',
    defaultToolbar: [],
    title: '数据表',
    cols: [[
    	{field:'id', title:'ID', width:30, templet:function(data){
    		if (data.LAY_INDEX == 0){
    			renderMenuTable(data);
    		}
    		return data.id;
    	}},
       	{field:'name', title:'名称',},
       	{title:'操作', toolbar: '#nav-list-right-btn', width:120, fixed: 'right',}
     ]],
    page: false
});

//点击行
table.on('row(nav_list)', function(obj){
	var data = obj.data;
	renderMenuTable(data);
});

//点击行
table.on('row(menu_list)', function(obj){
	var data = obj.data;
	renderSubMenuTable(data);
});


//头工具栏事件
table.on('toolbar(nav_list)', function(obj){
    switch(obj.event){
        case 'add_nav':menuAdd(obj, 'nav');break;
    };
});

table.on('toolbar(menu_list)', function(obj){
    switch(obj.event){
        case 'add_menu':menuAdd(obj, 'menu');break;
    };
});

table.on('toolbar(submenu_list)', function(obj){
    switch(obj.event){
        case 'add_submenu':menuAdd(obj, 'submenu');break;
    };
});


table.on('tool(nav_list)', function(obj){
    switch(obj.event){
        case 'delete':menuDelete(obj);break;
        case 'edit':menuAdd(obj, 'nav');break;
    };
});

table.on('tool(menu_list)', function(obj){
    switch(obj.event){
        case 'delete':menuDelete(obj);break;
        case 'edit':menuAdd(obj, 'menu');break;
    };
});

table.on('tool(submenu_list)', function(obj){
    switch(obj.event){
        case 'delete':menuDelete(obj);break;
        case 'edit':menuAdd(obj, 'submenu');break;
    };
});

function menuDelete(obj){
    layer.confirm('你真的要删除吗?', { closeBtn: 2, icon: 3 }, function() {
        $.post('<?php echo url("auth/delete"); ?>', {'id':obj.data.id}, function(data) {
            showMsg(data.msg,function(){
                if (data.code>-1){
                    location.reload();
                }
            },{icon:data.code>-1?1:2});
        },'json');
    });
}

function makeMenuList(data){
    var ndata = [];
    for (var i = 0; i < data.length; i++) {
        var t = {
            'id': data[i]['id'],
            'title': data[i]['name'],
            'type': 'normal'
        };

        if ('submenu' in data[i]){
            t['child'] = makeMenuList(data[i]['submenu']);
        }
        ndata.push(t);
    }
    return ndata;
}


function makeIconList(){
    var icon_list = [
        'layui-icon-heart-fill','layui-icon-heart','layui-icon-light','layui-icon-time','layui-icon-bluetooth','layui-icon-at',
        'layui-icon-mute','layui-icon-mike','layui-icon-key','layui-icon-gift','layui-icon-email','layui-icon-rss',
        'layui-icon-wifi','layui-icon-logout','layui-icon-android','layui-icon-ios','layui-icon-windows','layui-icon-transfer',
        'layui-icon-service','layui-icon-subtraction','layui-icon-addition','layui-icon-slider','layui-icon-print','layui-icon-export',
        'layui-icon-cols','layui-icon-screen-restore','layui-icon-screen-full','ayui-icon-rate-half','layui-icon-rate','layui-icon-rate-solid',
        'layui-icon-cellphone','layui-icon-vercode','layui-icon-login-wechat','layui-icon-login-qq','layui-icon-login-weibo','layui-icon-password',
        'layui-icon-username','layui-icon-refresh-3','layui-icon-auz','layui-icon-spread-left','layui-icon-shrink-right','layui-icon-snowflake',
        'layui-icon-tips','layui-icon-note','layui-icon-home','layui-icon-senior','layui-icon-refresh','layui-icon-refresh-1',
        'layui-icon-flag','layui-icon-theme','layui-icon-notice','layui-icon-website','layui-icon-console','layui-icon-face-surprised',
        'layui-icon-set','layui-icon-template-1','layui-icon-app','layui-icon-template','layui-icon-praise','layui-icon-tread',
        'layui-icon-male','layui-icon-female','layui-icon-camera','layui-icon-camera-fill','layui-icon-more','layui-icon-more-vertical',
        'layui-icon-rmb','layui-icon-dollar','layui-icon-diamond','layui-icon-fire','layui-icon-return','layui-icon-location',
        'layui-icon-read','layui-icon-survey','layui-icon-face-smile','layui-icon-face-cry','layui-icon-cart-simple','layui-icon-cart',
        'layui-icon-next','layui-icon-prev','layui-icon-upload-drag','layui-icon-upload','layui-icon-download-circle','ayui-icon-component',
        'layui-icon-file-b','layui-icon-user','layui-icon-find-fill','layui-icon-add-1','layui-icon-play','layui-icon-pause',
        'layui-icon-headset','layui-icon-video','layui-icon-voice','layui-icon-speaker','layui-icon-fonts-del',
        'layui-icon-fonts-code','layui-icon-fonts-html','layui-icon-fonts-strong','layui-icon-unlink','layui-icon-picture',
        'layui-icon-link','layui-icon-face-smile-b','layui-icon-fonts-u','layui-icon-fonts-i','layui-icon-tabs','layui-icon-radio',
        'layui-icon-circle','layui-icon-edit','layui-icon-share','layui-icon-delete','layui-icon-form','layui-icon-cellphone-fine',
        'layui-icon-dialogue','layui-icon-fonts-clear','layui-icon-layer','layui-icon-date','layui-icon-water','layui-icon-code-circle',
        'layui-icon-carousel','layui-icon-prev-circle','layui-icon-layouts','layui-icon-util','layui-icon-templeate-1',
        'layui-icon-upload-circle','layui-icon-tree','layui-icon-table','layui-icon-chart',
        'layui-icon-chart-screen','layui-icon-engine','layui-icon-file','layui-icon-reduce-circle','layui-icon-add-circle','layui-icon-404',
        'layui-icon-about','layui-icon-search','layui-icon-set-fill','layui-icon-group','layui-icon-reply-fill','layui-icon-release',
        'layui-icon-help','layui-icon-top','layui-icon-star-fill','layui-icon-close-fill'
    ];

    var ndata = [];
    for (var i = 0; i < icon_list.length; i++) {
        var t = {
            'id': icon_list[i],
            'templet': '<i class="layui-icon '+icon_list[i]+'"></i> '+icon_list[i],
            'href': '#'
        };
        ndata.push(t);
    }

    return ndata;
}


// add
function menuAdd(obj,mtype){

    var name = '';
    var alias = ''
    var remark = '';
    var route = '';
    var icon = '';

    if (obj.event == 'edit'){
        name = obj.data.name;
        alias = obj.data.alias;
        remark = obj.data.remark;
        route = obj.data.route;
        icon = obj.data.icon;
    }


    var type_option_html = '';
    var title_nav = '';

    if (mtype == 'nav'){
        title_nav = '导航';
        type_option_html = '<option value="nav">导航</option>';
    } else if (mtype == 'menu'){
        title_nav = '菜单';
        type_option_html = '<option value="menu">菜单</option>';
    }else if (mtype == 'submenu'){
        title_nav = '子菜单';
        type_option_html = '<option value="submenu">子菜单</option>';
    } else if (mtype == 'api'){
        title_nav = 'API';
        type_option_html = '<option value="api">API</option>';
    }

    var btn_action = ['添加','取消'];
    var layer_title = '添加【'+title_nav+'】';
    if (obj.event == 'edit'){
        btn_action = ['更新','取消'];
        layer_title = '编辑【'+title_nav+'】';
    }

    layer.open({
        area: ['400px',"400px"],
        title:layer_title,
        content: '<form id="add_menu_form" class="layui-form layui-form-pane" style="padding:5px;">\
        	<div class="layui-form-item">\
              <label class="layui-form-label">父级</label>\
              <div class="layui-input-block">\
                <button id="pid_txt" type="button" class="layui-btn" style="width:100%;">无</button>\
              </div>\
            </div>\
	        <div class="layui-form-item">\
	            <label class="layui-form-label">类型</label>\
	            <div class="layui-input-block">\
	                <select name="type" lay-verify="required">'+type_option_html+'</select>\
	            </div>\
	        </div>\
            <div class="layui-form-item">\
              <label class="layui-form-label">名称</label>\
              <div class="layui-input-block">\
                <input type="text" name="name" value="'+name+'" autocomplete="off" placeholder="请输入名称" class="layui-input">\
              </div>\
            </div>\
            <div class="layui-form-item" id="div_alias">\
             	<label class="layui-form-label">别名</label>\
              	<div class="layui-input-block">\
                	<input type="text" name="alias" value="'+alias+'" autocomplete="off" placeholder="请输入名称" class="layui-input">\
              	</div>\
            </div>\
            <div class="layui-form-item" id="div_route">\
             	<label class="layui-form-label">路由</label>\
              	<div class="layui-input-block">\
                	<input type="text" name="route" value="'+route+'" autocomplete="off" placeholder="请输入路由地址" class="layui-input">\
              	</div>\
            </div>\
            <div class="layui-form-item" id="div_icon">\
             	<label class="layui-form-label">图标</label>\
              	<div class="layui-input-block">\
                	<input type="text" name="icon" value="'+icon+'" autocomplete="off" placeholder="请输入图标标识" class="layui-input">\
              	</div>\
            </div>\
            <div class="layui-form-item">\
              <label class="layui-form-label">备注</label>\
              <div class="layui-input-block">\
                <input type="text" name="remark" value="'+remark+'" autocomplete="off" placeholder="请输入备注" class="layui-input">\
              </div>\
            </div>\
            <input type="hidden" name="id" value="">\
            <input type="hidden" name="pid" value="0">\
        </form>',
        btn: btn_action,
        type: 1,
        shadeClose: false,
        success:function(){
            form.render();
            if (obj.event == 'edit'){
                $('input[name="id"]').val(obj.data.id);
            }

            if (mtype == 'nav'){
                $('#div_route').css('display','none');
                $('#div_icon').css('display','none');
            } else if (mtype == 'menu'){
                $('#div_route').css('display','none');
                $('#div_alias').css('display','none');

                var pdata = $('#toolbar_menulist').data('pdata');
                $('input[name="pid"]').val(pdata.id);
                $('#pid_txt').text(pdata.name);
            } else if (mtype == 'submenu'){

                $('#div_icon').css('display','none');
                $('#div_alias').css('display','none');

                var pdata = $('#toolbar_submenulist').data('pdata');
                $('input[name="pid"]').val(pdata.id);
                $('#pid_txt').text(pdata.name);
            }

            $('input[name="name"]').change(function(){
                $('input[name="remark"]').val($(this).val());
            });

            var ico_list = makeIconList();
            dropdown.render({
                elem: 'input[name="icon"]',
                data: ico_list,
                click: function(item){
                    $('input[name="icon"]').val(item['id']);
                }
            });


        },
        yes: function(index, layero){
            var data = $("#add_menu_form").serialize();
            $.post('<?php echo url("auth/add"); ?>', data, function(data) {
                showMsg(data.msg,function(){
                    if (data.code>-1){
                        layer.close(index);
                        location.reload();
                        if (mtype == 'nav'){

                        }

                    }
                },{icon:data.code>-1?1:2});
            },'json');
            return;
        }
    });
}

// 渲染table
function renderMenuTable(data){
    $('#toolbar_menulist').data('pdata', data);
	table.render({
	    elem: '#menu_list',
	    toolbar: '#toolbar_menulist',
	    defaultToolbar: [],
	    url: '<?php echo url("auth/listpid"); ?>?pid='+data.id,
	    title: '数据表',
	    cols: [[
	    	{field:'id', title:'ID', width:30, templet:function(data){
	    		if (data.LAY_INDEX == 0){
	    			renderSubMenuTable(data);
	    		}
	    		return data.id;
    		}},
	       	{field:'name', title:'名称',},
	       	{title:'操作', toolbar: '#nav-list-right-btn', width:120, fixed: 'right'}
	     ]],
	    page: false
	});
}

function renderSubMenuTable(data){
    $('#toolbar_submenulist').data('pdata', data);
	table.render({
	    elem: '#submenu_list',
	    toolbar: '#toolbar_submenulist',
	    defaultToolbar: [],
	    url: '<?php echo url("auth/listpid"); ?>?pid='+data.id,
	    title: '数据表',
	    cols: [[
	    	{field:'id', title:'ID', width:30},
	       	{field:'name', title:'名称',},
	       	{title:'操作', toolbar: '#nav-list-right-btn', width:120, fixed: 'right'}
	     ]],
	    page: false
	});
}

///
});
</script>


<script type="text/html" id="nav-list-right-btn">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">删除</a>
</script>


            </div>
        </div>

        <div class="layui-footer" style="height: 20px;line-height: 20px; text-align: center;">
            鸿蒙CMS © <a href="#" target="_blank">HMCMS</a> All Rights Reserved.
        </div>
      
    </div>
</div>
<!-- end -->

<!-- 辅助元素，一般用于移动设备下遮罩 -->
<div class="layadmin-body-shade" layadmin-event="shade"></div>


<script>
layui.config({
    base: '/static/admin/layuiadmin/'
}).extend({
    index: 'lib/index'
}).use('index');
</script>
  
</body>
</html>
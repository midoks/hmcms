<?php /*a:3:{s:67:"/Users/midoks/Desktop/www/tp/hmcms//app/admin/view/index/index.html";i:1705159515;s:33:"app/admin/view/common/header.html";i:1704905364;s:33:"app/admin/view/common/footer.html";i:1704569025;}*/ ?>
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
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md8">
        <div class="layui-row layui-col-space15">
          <div class="layui-col-md6">
            <div class="layui-card">
              <div class="layui-card-header">快捷方式</div>
              <div class="layui-card-body">
                
                <div class="layui-carousel layadmin-carousel layadmin-shortcut">
                  <div carousel-item>
                    <ul class="layui-row layui-col-space10">
                      <li class="layui-col-xs3">
                        <a lay-href="home/homepage1.html">
                          <i class="layui-icon layui-icon-console"></i>
                          <cite>主页一</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="home/homepage2.html">
                          <i class="layui-icon layui-icon-chart"></i>
                          <cite>主页二</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="component/layer/list.html">
                          <i class="layui-icon layui-icon-template-1"></i>
                          <cite>弹层</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a layadmin-event="im">
                          <i class="layui-icon layui-icon-chat"></i>
                          <cite>聊天</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="component/progress/index.html">
                          <i class="layui-icon layui-icon-find-fill"></i>
                          <cite>进度条</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="app/workorder/list.html">
                          <i class="layui-icon layui-icon-survey"></i>
                          <cite>工单</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="user/user/list.html">
                          <i class="layui-icon layui-icon-user"></i>
                          <cite>用户</cite>
                        </a>
                      </li>
                      <li class="layui-col-xs3">
                        <a lay-href="set/system/website.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>设置</cite>
                        </a>
                      </li>
                    </ul>
                    <ul class="layui-row layui-col-space10">
                      <li class="layui-col-xs3">
                        <a lay-href="set/user/info.html">
                          <i class="layui-icon layui-icon-set"></i>
                          <cite>我的资料</cite>
                        </a>
                      </li>
                    </ul>
                    
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="layui-col-md6">
            <div class="layui-card">
              <div class="layui-card-header">待办事项</div>
              <div class="layui-card-body">

                <div class="layui-carousel layadmin-carousel layadmin-backlog">
                  <div carousel-item>
                    <ul class="layui-row layui-col-space10">
                      <li class="layui-col-xs6">
                        <a lay-href="app/content/comment.html" class="layadmin-backlog-body">
                          <h3>待审评论</h3>
                          <p><cite>66</cite></p>
                        </a>
                      </li>
                      <li class="layui-col-xs6">
                        <a lay-href="app/forum/list.html" class="layadmin-backlog-body">
                          <h3>待审帖子</h3>
                          <p><cite>12</cite></p>
                        </a>
                      </li>
                      <li class="layui-col-xs6">
                        <a lay-href="template/goodslist.html" class="layadmin-backlog-body">
                          <h3>待审商品</h3>
                          <p><cite>99</cite></p>
                        </a>
                      </li>
                      <li class="layui-col-xs6">
                        <a href="javascript:;" onclick="layer.tips('不跳转', this, {tips: 3});" class="layadmin-backlog-body">
                          <h3>待发货</h3>
                          <p><cite>20</cite></p>
                        </a>
                      </li>
                    </ul>
                    <ul class="layui-row layui-col-space10">
                      <li class="layui-col-xs6">
                        <a href="javascript:;" class="layadmin-backlog-body">
                          <h3>待审友情链接</h3>
                          <p><cite style="color: #FF5722;">5</cite></p>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="layui-col-md12">
            <div class="layui-card">
              <div class="layui-card-header">数据概览</div>
              <div class="layui-card-body">
                
                <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-dataview">
                  <div carousel-item id="LAY-index-dataview">
                    <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                    <div></div>
                    <div></div>
                  </div>
                </div>
                
              </div>
            </div>
            <div class="layui-card">
              <div class="layui-tab layui-tab-brief layadmin-latestData">
                <ul class="layui-tab-title">
                  <li class="layui-this">今日热搜</li>
                  <li>今日热帖</li>
                </ul>
                <div class="layui-tab-content">
                  <div class="layui-tab-item layui-show">
                    <table id="LAY-index-topSearch"></table>
                  </div>
                  <div class="layui-tab-item">
                    <table id="LAY-index-topCard"></table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="layui-col-md4">
        <div class="layui-card">
          <div class="layui-card-header">版本信息</div>
          <div class="layui-card-body layui-text">
            <table class="layui-table">
              <colgroup>
                <col width="100">
                <col>
              </colgroup>
              <tbody>
                <tr>
                  <td>PHP</td>
                  <td>8.1</td>
                </tr>
                <tr>
                  <td>WEB</td>
                  <td>OPENRESTY</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
        <div class="layui-card">
          <div class="layui-card-header">效果报告</div>
          <div class="layui-card-body layadmin-takerates">
            <div class="layui-progress" lay-showPercent="yes">
              <h3>转化率（日同比 28% <span class="layui-edge layui-edge-top" lay-tips="增长" lay-offset="-15"></span>）</h3>
              <div class="layui-progress-bar" lay-percent="65%"></div>
            </div>
            <div class="layui-progress" lay-showPercent="yes">
              <h3>签到率（日同比 11% <span class="layui-edge layui-edge-bottom" lay-tips="下降" lay-offset="-15"></span>）</h3>
              <div class="layui-progress-bar" lay-percent="32%"></div>
            </div>
          </div>
        </div>
        
        <div class="layui-card">
          <div class="layui-card-header">实时监控</div>
          <div class="layui-card-body layadmin-takerates">
            <div class="layui-progress" lay-showPercent="yes">
              <h3>CPU使用率</h3>
              <div class="layui-progress-bar" lay-percent="58%"></div>
            </div>
            <div class="layui-progress" lay-showPercent="yes">
              <h3>内存占用率</h3>
              <div class="layui-progress-bar layui-bg-red" lay-percent="90%"></div>
            </div>
          </div>
        </div>
      
    </div>
</div>

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

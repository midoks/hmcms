<?php

namespace app\common\controller;

use think\facade\View;
use think\facade\Db;
use app\common\model\AdminMenu;

class Admin extends Base
{

	// 初始化
    protected function initialize()
    {
        //权限验证
        $this->auth();

        //菜单
        $list = AdminMenu::getInstance()->list();
        // var_dump($list);  

        $controller = $this->request->controller();
        $action = $this->request->action();
        $list = $this->selectdMenu($list, $controller, $action);

        // echo json_encode($list);
        // exit;

        // var_dump($controller, $action);

        // 全局变量
        View::assign("version", time());
        View::assign("hm_nav_list", $list);
        // if(!empty($list)){
        //     $alias = $list[0]['alias'];
        //     View::assign("hm_nav_cur", $alias); 
        //     session('hm_nav_cur', $alias);
        // }
    }


    public function selectdMenu($list, $controller, $action){
        $route_url = strtolower($controller).'/'.strtolower($action);
        // var_dump($route_url);
        // 一级栏目
        foreach ($list as $k => $v) {
            // 二级菜单
            foreach ($v['submenu'] as $k1 => $v1) {
                // 三级菜单
                foreach ($v1['submenu'] as $k2 => $v2) {

                    if ($route_url == 'index/index' && $k2 == 0 && $k1==0){
                        $list[$k]['submenu'][$k1]['submenu'][$k2]['selected'] = true;
                        $list[$k]['submenu'][$k1]['selected'] = true;
                    }

                    if (strtolower($v2['route']) == $route_url){
                        $list[$k]['submenu'][$k1]['submenu'][$k2]['selected'] = true;
                        $list[$k]['submenu'][$k1]['selected'] = true;
                    }
                }

            }  
        }
        return $list;
    }

    protected function makeUrl($s = 'index/index'){
        return \think\facade\Route::buildUrl($s);;
    }

    protected function auth()
    {
        $login_id = session('login_id');
        if (!$login_id){
            $url = $this->makeUrl('login/index');
            return redirect($url)->send();
        }
    }

    protected function fetch($tpl='index/index')
    {
        $root_path = $this->app->getRootPath();
        $install_path = $root_path.'/app/admin/view';
        return View::fetch($install_path.'/'.$tpl.'.html');
    }


}

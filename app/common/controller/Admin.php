<?php

namespace app\common\controller;

use think\facade\View;
use think\facade\Db;
use app\common\model\AdminMenu;

class Admin extends Base
{

    private function initVar(){
        // 全局变量
        View::assign("version", time());
    }
	// 初始化
    protected function initialize()
    {
        $this->initVar();
        //权限验证
        $this->auth();

        $login_id = session('login_id');
        if (!$login_id){
            $url = $this->makeUrl('login/index');
            return redirect($url)->send();
        }

        $admin = $this->model('Admin');
        $row = $admin->getDataByID($login_id);
        if ($row['id'] != 1 && $row['role_id']<1){
            echo $this->fetch('login/noacl');exit;
        }

        $m = $this->model('AdminMenu');
        //菜单
        $list = $m->list();
        if ($row['id'] != 1){
            $list = $this->getValidMenu($list, $row['role_id']);
        }

        $controller = $this->request->controller();
        $action = $this->request->action();
        $list = $this->selectdMenu($list, $controller, $action);

        
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

    //获取有效菜单[递归]
    private function getValidMenuRecursion($data, $ids, $dep = 0){
        $rdata = [];
        foreach($data as $k=>$v){
            if (!empty($v['submenu'])){
                $v['submenu'] = $this->getValidMenuRecursion($v['submenu'], $ids, $dep+1);
            }
            if (in_array($v['id'], $ids)){
                $rdata[] = $v;
            }
        }
        return $rdata;
    }

    //获取有效菜单
    public function getValidMenu($list, $role_id)
    {
        $ids = $this->getMenuNodeId($role_id);
        $menu =  $this->getValidMenuRecursion($list, $ids);
        return $menu;
    }

    private function getMenuNodeId($role_id){
        $aa = $this->model('AdminAccess');
        $aa_list =$aa->list($role_id);
        //重新组装节点ID
        $ids = $aa->getFieldList($aa_list,'node_id');
        return $ids;
    }


    private function isValidMenu($role_id){
        //重新组装节点ID
        $aa_ids = $this->getMenuNodeId($role_id);

        $controller = $this->request->controller();
        $action = $this->request->action();

        $adminmenu = $this->model('AdminMenu');
        $menu_list =$adminmenu->getDataByIds($aa_ids);

        $route = strtolower($controller.'/'.$action);

        if ($route == 'index/index'){
            return true;
        }

        foreach ($menu_list as $menu_k => $menu_v) {
            // var_dump($route == strtolower($menu_v['route']),$route , strtolower($menu_v['route']));
            if ($route == strtolower($menu_v['route'])){
                // var_dump($route , strtolower($menu_v['route']));
                return true;
            }
        }
        return false;
    }

    protected function auth()
    {
        $login_id = session('login_id');
        if (!$login_id){
            $url = $this->makeUrl('login/index');
            return redirect($url)->send();
        }

        $m = $this->model('Admin');
        $row = $m->getDataByID($login_id);
        if ($row['id'] != 1 && $row['role_id']<1){
            echo $this->fetch('login/noacl');exit;
        }

        //当后台ID为1时,为系统创始人,具有全部权限
        if ($row['id'] != 1 && !$this->isValidMenu($row['role_id'])){
            if ($this->request->isAjax()){
                echo json_encode(['code'=>-1, 'msg'=>'无权访问']);exit;
            } else {
                echo $this->fetch('login/noacl');exit;
            }            
        }
    }

    protected function fetch($tpl='index/index')
    {
        $root_path = $this->app->getRootPath();
        $install_path = $root_path.'/app/admin/view';
        return View::fetch($install_path.'/'.$tpl.'.html');
    }


}

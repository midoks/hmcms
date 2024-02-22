<?php

namespace app\admin\controller;

use app\common\controller\Admin;
use think\facade\View;
use think\facade\Db;

class Index extends Admin
{

    private function selectedDefaultPage($list, $view){
        $route_url = 'index/index';
        if ($view != ''){
            foreach ($list as $k => $v) {
                if ($view == $v['alias']){
                    $menu_num = count($v['submenu']);
                    if ($menu_num>0){
                        if (count($v['submenu'][0]['submenu'])>0){
                            $route_url = $v['submenu'][0]['submenu'][0]['route'];
                        }
                    }
                }
            }
        } else {
            $data = $list[0];
            $route_url = $data['submenu'][0]['submenu'][0]['route'];
        }
        return $route_url;
    }

    public function index($view = '')
    {
        if (!empty($view)){
            View::assign('hm_nav_cur',$view);
        }

        $list = $this->menu_list;
        $pageTpl = $this->selectedDefaultPage($list, $view);
        return $this->fetch($pageTpl);
    }


}

<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin;
use think\facade\View;
use think\facade\Db;

use app\common\model\Comic;


class Index extends Admin
{

    private function selectedDefaultPage($list, $page){
        $route_url = 'index/index';
        // 一级栏目
        foreach ($list as $k => $v) {
            if ($page == $v['alias']){
                // var_dump($v['submenu']);
                $menu_num = count($v['submenu']);
                if ($menu_num>0){
                    if (count($v['submenu'][0]['submenu'])>0){
                        $route_url = $v['submenu'][0]['submenu'][0]['route'];
                    }
                }
            }
        }
        return $route_url;
    }

    public function index($view = '')
    {
        if (!empty($view)){
            View::assign('hm_nav_cur',$view);
            session('hm_nav_cur', $view);
        } else {

            // var_dump($list);
            // $alias = $list[0]['alias'];

            // var_dump($alias);
            // View::assign("hm_nav_cur", $alias); 
            // session('hm_nav_cur', $alias);
        }

        $list = $this->model('AdminMenu')->list();
        $pageTpl = $this->selectedDefaultPage($list, $view);
        return $this->fetch($pageTpl);
    }


    public function welcome()
    {
        return $this->fetch('index/welcome');
    }

    public function nav(){
        return $this->fetch('index/index');
    }


    public function test3()
    {

        $comic_model = new Comic();

        $data = $comic_model->getDataByID('1');

        var_dump($data);
    
    }
}

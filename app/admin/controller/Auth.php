<?php

namespace app\admin\controller;

use think\facade\View;
use think\facade\Db;

use app\BaseController;
use app\common\controller\Admin;
use app\common\model\AdminMenu;


class Auth extends Admin
{
    public function index()
    {
        return $this->fetch('auth/index');
    }

    //获取列表
    public function list(){
        $ammodel = AdminMenu::getInstance();
        $list = $ammodel->submenu(0);
        return $this->layuiJson(0,'ok',  $list, );
    }

    //获取列表
    public function listpid(){
        $ammodel = AdminMenu::getInstance();
        $pid = $this->request->param('pid');
        // var_dump($pid);
        $list = $ammodel->submenu($pid);
        return $this->layuiJson(0,'ok',  $list, );
    }

    public function menu_plist(){
        $ammodel = AdminMenu::getInstance();
        $list = $ammodel->submenu(0,true);
        return $this->layuiJson(0,'ok',  $list, );
    }

    public function add(){
        $name = $this->request->param('name');

        var_dump($name);
    }



}

<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin;
use think\facade\View;
use think\facade\Db;


class Index extends Admin
{

    private function fetch($tpl='index/index')
    {
        $root_path = $this->app->getRootPath();
        $install_path = $root_path.'/app/admin/view';
        return View::fetch($install_path.'/'.$tpl.'.html');
    }

    public function index()
    {
        return $this->fetch('index/index');
    }


    public function welcome()
    {
        return $this->fetch('index/welcome');
    }

    public function test()
    {
        return $this->fetch('index/test');
    }
}

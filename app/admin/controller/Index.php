<?php

namespace app\admin\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Db;


class Index extends BaseController
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

}

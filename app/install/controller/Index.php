<?php

namespace app\install\controller;

use app\BaseController;
use think\facade\View;

class Index extends BaseController
{

    private function fech($tpl='index/index')
    {
        $root_path = $this->app->getRootPath();
        $install_path = $root_path.'/app/install/view';

        // var_dump($install_path.'/'.$tpl);
        return View::fetch($install_path.'/'.$tpl.'.html');
    }

    public function index()
    {
        return $this->fech('index/index');
    }

    public function hello($name = 'ThinkPHP8')
    {
        return 'hello,' . $name;
    }
}

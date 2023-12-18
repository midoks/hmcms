<?php

namespace app\install\controller;

use app\BaseController;

class Index extends BaseController
{
    public function index()
    {
        $root_path = $this->app->getRootPath();

        var_dump($root_path);



        return $this->fetch('install@/index/index');
    }

    public function hello($name = 'ThinkPHP8')
    {
        return 'hello,' . $name;
    }
}

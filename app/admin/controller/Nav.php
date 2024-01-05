<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin;
use think\facade\View;
use think\facade\Db;

use app\common\model\Comic;


class Nav extends Admin
{


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

    public function test2()
    {
        return $this->fetch('index/test2');
    }


    public function test3()
    {

        $comic_model = new Comic();

        $data = $comic_model->getDataByID('1');

        var_dump($data);
    
    }
}
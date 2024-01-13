<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;
use think\facade\View;
use think\facade\Db;

class Comic extends AdminBase
{

    public function index()
    {
        return $this->fetch('comic/index');
    }


    public function login()
    {
        return $this->fetch('index/login');
    }


    public function test3()
    {

        $comic_model = new Comic();

        $data = $comic_model->getDataByID('1');

        var_dump($data);
    
    }
}

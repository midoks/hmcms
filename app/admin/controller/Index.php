<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin;
use think\facade\View;
use think\facade\Db;

use app\common\model\Comic;


class Index extends Admin
{


    public function index($view = '')
    {
        // if (!empty($view)){
            View::assign('hm_nav_cur',$view);
            session('hm_nav_cur', $view);
        // } 
        return $this->fetch('index/index');
    }


    public function welcome()
    {
        return $this->fetch('index/welcome');
    }

    public function nav(){
        // var_dump($view);
        return $this->fetch('index/index');
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

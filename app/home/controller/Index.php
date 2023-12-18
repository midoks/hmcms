<?php

namespace app\home\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Db;
use think\DbManager;


class Index extends BaseController
{

    public function index($step = 0)
    {
        return 'home';
    }

}

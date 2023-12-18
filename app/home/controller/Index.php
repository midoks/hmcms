<?php

namespace app\home\controller;

use app\common\controller\Base;
use think\facade\View;
use think\facade\Db;
use think\DbManager;


class Index extends Base
{

    public function index($step = 0)
    {
        return 'home';
    }

}

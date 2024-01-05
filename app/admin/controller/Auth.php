<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin;
use think\facade\View;
use think\facade\Db;


class Auth extends Admin
{
    public function index()
    {
        return $this->fetch('auth/index');
    }

}

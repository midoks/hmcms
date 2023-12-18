<?php

namespace app\common\controller;

use think\facade\View;
use think\facade\Db;


class Admin extends Base
{

	 // 初始化
    protected function initialize()
    {
    	View::assign("version",time());
    }


}

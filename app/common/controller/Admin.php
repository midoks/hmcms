<?php

namespace app\common\controller;

use think\facade\View;
use think\facade\Db;


class Admin extends Base
{

	 // 初始化
    protected function initialize()
    {
    	View::assign("version", time());
    }

    public function fetch($tpl='index/index')
    {
        $root_path = $this->app->getRootPath();
        $install_path = $root_path.'/app/admin/view';
        return View::fetch($install_path.'/'.$tpl.'.html');
    }


}

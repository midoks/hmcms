<?php

namespace app\common\controller;

use think\facade\View;
use think\facade\Db;


class Admin extends Base
{

	// 初始化
    protected function initialize()
    {
        //权限验证
        $this->auth();

    	View::assign("version", time());
    }

    protected function auth()
    {
        
        
    }

    protected function fetch($tpl='index/index')
    {
        $root_path = $this->app->getRootPath();
        $install_path = $root_path.'/app/admin/view';
        return View::fetch($install_path.'/'.$tpl.'.html');
    }


}

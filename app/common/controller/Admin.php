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

    protected function makeUrl($s = 'index/index'){
        return \think\facade\Route::buildUrl($s);;
    }

    protected function auth()
    {
        $login_id = session('login_id');
        if (!$login_id){
            $url = $this->makeUrl('login/index');
            return redirect($url)->send();
        }
    }

    protected function fetch($tpl='index/index')
    {
        $root_path = $this->app->getRootPath();
        $install_path = $root_path.'/app/admin/view';
        return View::fetch($install_path.'/'.$tpl.'.html');
    }


}

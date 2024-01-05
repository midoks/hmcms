<?php

namespace app\common\controller;

use think\facade\View;
use think\facade\Db;
use app\common\model\AdminMenu;

class Admin extends Base
{

	// 初始化
    protected function initialize()
    {
        //权限验证
        $this->auth();

    	View::assign("version", time());

        //菜单
        $ammodel = AdminMenu::getInstance();
        $list = $ammodel->list();
        // var_dump($list);
        View::assign("hm_nav_list", $list);
        View::assign("hm_nav_cur", '');



        // var_dump($this->request->controller());
        // var_dump($this->request->action());
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

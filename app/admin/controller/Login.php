<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Base;
use think\facade\View;
use think\facade\Db;

use think\captcha\facade\Captcha;

class Login extends Base
{
    // 初始化
    protected function initialize()
    {
        View::assign("version", time());
    }

    protected function fetch($tpl='index/index')
    {
        $root_path = $this->app->getRootPath();
        $install_path = $root_path.'/app/admin/view';
        return View::fetch($install_path.'/'.$tpl.'.html');
    }


    public function index()
    {
        return $this->fetch('login/index');
    }

    public function code()
    {
        return Captcha::create();
    }

    // 登录
    public function in(){
        return $this->success("ok");
    }


    public function test3()
    {

        $comic_model = new Comic();

        $data = $comic_model->getDataByID('1');
        var_dump($data);

    }
}

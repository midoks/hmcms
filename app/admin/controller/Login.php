<?php

namespace app\admin\controller;

use app\common\controller\Base;
use think\facade\View;
use think\facade\Db;
use think\facade\Session;
use think\captcha\facade\Captcha;

use app\common\model\Admin;

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

    public function updatePass(){
        $pass = $this->request->post('pass');
        $uid = session('login_id');

        $m = $this->model('Admin');
        if ($uid>0){
            $status = $m->updatePass($uid,$pass);
            if ($status>0){
                Session::clear();
                return $this->returnJson(1,'修改成功!');
            }
        }

        return $this->returnJson(-1,'修改失败!');
    }

    public function code()
    {
        return Captcha::create();
    }

    public function out(){
        Session::clear();
        $this->success("退出成功!",url('/login/index'));
    }

    // 登录
    public function in()
    {
        $username = $this->request->param('username');
        $password = $this->request->param('password');

        $m = $this->model('Admin');
        $data = $m->verifyLogin($username,$password);

        if ($data['status']){
            $time = time();
            $make_token_args = [
                'iat' => $time,
                'nbf' => $time,
                'exp' => $time + 7*24*60*60,
                'data' => [
                    'uid' => $data['data']['id'],
                    'username' => $data['data']['username'],
                ]
            ];
            session('login_id', $data['data']['id']);
            session('login_timeout', $time + 7*24*60*60);
            $access_token = $this->createJWT($make_token_args);
            return  $this->returnJson(0,'登录成功',['access_token'=>$access_token]);
            // return $retdata;
        } else{
            return $this->returnJson(-1,'登录失败');
        }
    }

}

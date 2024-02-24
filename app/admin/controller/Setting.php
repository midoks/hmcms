<?php

namespace app\admin\controller;

use think\facade\View;
use think\facade\Db;

use app\BaseController;
use app\common\controller\Admin;
use app\common\model\AdminMenu;
use app\common\model\AdminRole;
use app\common\model\Admin as AdminModel;


class Setting extends Admin
{   
    protected $op = [
        'base', 'user', 'cache',
        'sms', 'mail', 'pay'
    ];

    protected function initCommonVar($tag='')
    {
        $m = $this->model('Option');
        $data = $m->getValueByName($tag);
        View::assign($tag, $data);
    }

    protected function initVarByPay()
    {
        $m = $this->model('Option');
        $pay = $m->getValueByName('pay');


        // 针对支付初始化配置
        // VIP默认配置
        $pay['vip_def'] = [
            'day' => '30',
            'rmb' => '1000',
            'cion' => '10',
        ];
        $pay['vip_def_num'] = 4;
       
        // 充值默认配置
        $pay['cion_def'] = [
            'cion' => '4000',
            'rmb' => '4000',
        ];
        $pay['cion_def_num'] = 6;
        View::assign('pay', $pay);
    }

    //基础
    public function index()
    {
        $this->initCommonVar('base');
        return $this->fetch('setting/index');
    }

    // 统一配置
    // public function cfg($page='')
    // {
    //     $op = ['user','sms'];
    //     if (in_array($page, $op)){
    //         $this->initCommonVar($page);
    //         return $this->fetch('setting/'.$page);
    //     }
    // }

    //用户
    public function user(){
        $this->initCommonVar('user');
        return $this->fetch('setting/user');
    }

    //缓存
    public function cache(){
        $this->initCommonVar('cache');
        return $this->fetch('setting/cache');
    }

    //短信
    public function sms(){
        $this->initCommonVar('sms');
        return $this->fetch('setting/sms');
    }

    //短信
    public function mail(){
        $this->initCommonVar('mail');
        return $this->fetch('setting/mail');
    }

    //财务
    public function pay(){
        $this->initVarByPay();
        return $this->fetch('setting/pay');
    }

    //附件管理
    public function annex(){
        $this->initCommonVar('annex');
        return $this->fetch('setting/annex');
    }

    public function save()
    {
        $m = $this->model('Option');
        $op = $this->op;

        $initNum = 0;
        foreach ($op as $k => $v) {
            $req = $this->request->param($v);
            if (!empty($req)){
                $initNum+=1;
            }
        }

        if ($initNum>1){
            return $this->returnJson(-1, '设置,一页只能有一个数组保持!');
        }

        foreach ($op as $k => $v) {
            $req = $this->request->param($v);
            if (!empty($req)){
                if ($v == 'cache'){
                    $this->makeCacheCfg();
                }

                $r = $m->setValueByName(json_encode($req), $v);
                if($r){
                    return $this->returnJson(1, '更新成功!');
                }
                return $this->returnJson(-1, '更新失败!');
            }            
        }

        return $this->returnJson(-1, '更新失败!');
    }

    //生产配置文件
    private function makeCacheCfg(){
        $cache = $this->request->param('cache');

        $data = config('cache');

        // var_dump($data);
        $data['default'] = 'file';
        if ($cache['mode'] == 1){
            $data['use_redis'] = true;
        } else{
            $data['use_redis'] = false;
        }

        if(isset($cache['prefix'])){
            $data['prefix'] = $cache['prefix'];
        }

        if(isset($cache['master'])){
            $data['stores']['master']['type'] = 'redis';
            $data['stores']['master']['host'] = $cache['master']['host'];
            $data['stores']['master']['port'] = $cache['master']['port'];
            $data['stores']['master']['password'] = $cache['master']['pass'];

            if ($cache['master']['persistent'] == 0){
                $data['stores']['master']['persistent'] = false;
            } else {
                $data['stores']['master']['persistent'] = true;
            }
        }

        if(isset($cache['slave'])){
            $data['stores']['slave']['type'] = 'redis';
            $data['stores']['slave']['host'] = $cache['slave']['host'];
            $data['stores']['slave']['port'] = $cache['slave']['port'];
            $data['stores']['slave']['password'] = $cache['slave']['pass'];

            if ($cache['slave']['persistent'] == 0){
                $data['stores']['slave']['persistent'] = false;
            } else {
                $data['stores']['slave']['persistent'] = true;
            }
        }

        // 更新程序配置文件
        $root_path = $this->app->getRootPath();
        hm_arr2file($root_path . 'config/cache.php', $data);
        return true;
    }

    public function multiSave(){
        $m = $this->model('Option');
        $op = $this->op;
        foreach ($op as $k => $v) {
            $req = $this->request->param($v);
            if (!empty($req)){
                $r = $m->setValueByName(json_encode($req), $v);
                if($r){
                    return $this->returnJson(1, '更新成功!');
                }
                return $this->returnJson(-1, '更新失败!');
            }            
        }
    }   

    public function checkCache(){
        $id = (int) $this->request->post('id');
        $ip = $this->request->post('ip');
        $port = (int) $this->request->post('port');
        $pass = $this->request->post('pass');
        if (empty($ip) || $port == 0) {
            return $this->returnJson(-1, '缺少参数');
        }

        if ($id == 2) {
            if (!class_exists('Memcache')) {
                return $this->returnJson(-1, '发生错误，请检查是否开启相应扩展库!');
            }

            //创建对象
            $conn = new Memcache;
            $res = $conn->pconnect($ip, $port);
            if (!$res) {
                return $this->returnJson(-1, '链接失败，请检查主机地址或者端口是否有误!');
            }

        } else {
            if (!class_exists('Redis')) {
                return $this->returnJson(-1, '发生错误，请检查是否开启相应扩展库!');
            }

                try {
                    //创建对象
                    $redis = new \Redis();
                    $res = $redis->connect($ip, $port);
                    if (!$res) {
                        return $this->returnJson(-1, '链接失败，请检查主机地址或者端口是否有误!');
                    }

                    if(!empty($pass)){
                        $res = $redis->auth($pass);
                    }

                    if(!$redis->ping()) {
                        return $this->returnJson(-1, '链接失败，请检查主机地址或者端口是否有误.');
                    }
                } catch (RedisException $ex) {
                    return $this->returnJson(-1, $ex->getMessage());
                }
                
            
        }
        return $this->returnJson(1, '链接成功');
    }

    //测试邮件
    public function mailcheck()
    {
        $arr = array(
            'type' => $this->request->post('type'),
            'host' => $this->request->post('host'),
            'port' => $this->request->post('port'),
            'username' => $this->request->post('username'),
            'password' => $this->request->post('password'),
            'secure' => $this->request->post('secure'),
            'form_mail' => $this->request->post('form_mail'),
            'nick' => $this->request->post('nick'),
            'to_mail' => $this->request->post('to_mail'),
            'title' => '这是一封测试邮件',
            'html' => '这是一封测试邮件，收到就说明我来过了，无需回复，谢谢!!!',
        );

        foreach ($arr as $k => $v) {
            if (empty($v) && $k != 'secure') {
                return $this->returnJson(-1, $k . '-->参数内容不完整!');
            }
        }
        
        $res = send_mail($arr['to_mail'], $arr['title'], $arr['html'], $arr);
        if ($res['code']!=1) {
            return $this->returnJson(-1, '邮件发送失败，请检查信息是否有误!');
        } else {
            return $this->returnJson(1, '哇，恭喜，邮件发送成功...');
        }
    }



}

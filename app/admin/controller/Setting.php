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
        $data = json_decode($data, true);
        View::assign($tag, $data);
    }

    protected function initVarByPay()
    {
        $m = $this->model('Option');
        $pay = $m->getValueByName('pay');
        $pay = json_decode($pay, true);


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
                $r = $m->setValueByName(json_encode($req), $v);
                if($r){
                    return $this->returnJson(1, '更新成功!');
                }
                return $this->returnJson(-1, '更新失败!');
            }            
        }

        return $this->returnJson(-1, '更新失败!');
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
        $ip = $this->request->post('ip', true);
        $port = (int) $this->request->post('port');
        $pass = $this->request->post('pass', true);
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

            //创建对象
            $redis = new \Redis();
            $res = $redis->connect($ip, $port);
            if (!$res) {
                return $this->returnJson(-1, '链接失败，请检查主机地址或者端口是否有误!');
            }

        }
        return $this->returnJson(1, '链接成功');
    }

    //测试邮件
    public function mailadd()
    {
        $arr = array(
            'type' => $this->request->post('type'),
            'host' => $this->request->post('host'),
            'port' => $this->request->post('port'),
            'user' => $this->request->post('user'),
            'pass' => $this->request->post('pass'),
            'crypto' => $this->request->post('crypto'),
            'form_mail' => $this->request->post('form_mail'),
            'form_name' => $this->request->post('form_name'),
            'to_mail' => $this->request->post('to_mail'),
            'title' => '这是一封测试邮件',
            'html' => '这是一封测试邮件，收到就说明我来过了，无需回复，谢谢!!!',
        );

        return $this->returnJson(-1, '开发中..');

        // if ($arr['pass'] == hm_hidden_pass(Mail_Pass)) {
        //     $arr['pass'] = Mail_Pass;
        // }

        foreach ($arr as $k => $v) {
            if (empty($v) && $k != 'crypto') {
                return $this->returnJson(-1, $k . '-->参数内容不完整!');
            }
        }
        $this->load->model('mail');
        $res = $this->mail->send($arr);
        if ($res) {
            return $this->returnJson(-1, '邮件发送失败，请检查信息是否有误!');
        } else {
            return $this->returnJson(1, '哇，恭喜，邮件发送成功...');
        }
    }



}

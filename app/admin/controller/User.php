<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class User extends AdminBase
{

    public function index()
    {
        return $this->fetch('user/index');
    }

    public function show(){
        $id = $this->request->param('id');
        $m = $this->model('user');
        
        if (!empty($id)){
            $data = $m->getDataByID($id);
        } else {
            $data = [
                'id' => 0,
                'viptime'=>0,
                'rz_type' =>1,
                'bank'=>'',
            ];
        }
        View::assign("data", $data);
        return $this->fetch('user/show');
    }

    public function edit(){
        $id = $this->request->param('id');
        $m = $this->model('user');
        
        if (!empty($id)){
            $data = $m->getDataByID($id);
        } else {
            $data = [
                'id' => 0,
                'viptime'=>0,
                'rz_type' =>1,
                'bank'=>'',
            ];
        }
        View::assign("data", $data);
        return $this->fetch('user/edit');
    }


    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $zd = $this->request->param('zd');
        $key = $this->request->param('key','');
        $kstime = $this->request->param('kstime');
        $jstime = $this->request->param('jstime');

        if( $page == 0 ) {
            $page=1;
        }

        $m = $this->model('user');

        $wh = [
            'zd' => $zd,
            'key' => $key,
            'kstime' => $kstime,
            'jstime' => $jstime,
        ];

        $data = $m->list($page, $limit, $wh);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function save(){
        $id = $this->request->post('id');

        $data = [];
        $data['cid'] = $this->request->post('cid');
        $data['sid'] = $this->request->post('sid');
        $data['signing'] = $this->request->post('signing');
        $data['name'] = $this->request->post('name');
        $data['nick'] = $this->request->post('nick');
        $data['tel'] = $this->request->post('tel');
        $data['qq'] = $this->request->post('qq');
        $data['email'] = $this->request->post('email');
        $data['city'] = $this->request->post('city');
        $data['sex'] = $this->request->post('sex');
        $data['text'] = $this->request->post('text');
        $data['rz_msg'] = $this->request->post('rz_msg');
        $data['vip'] = $this->request->post('vip');
        $data['cion'] = $this->request->post('cion');
        $data['rmb'] = $this->request->post('rmb');
        $data['ticket'] = $this->request->post('ticket');
        $data['realname'] = $this->request->post('realname');
        $data['idcard'] = $this->request->post('idcard');
        $data['bank'] = $this->request->post('bank');
        $data['card'] = $this->request->post('card');
        $data['bankcity'] = $this->request->post('bankcity');


        if(empty($data['name'])){
            return $this->returnJson(-2, '登陆账号不能为空~！');
        }

        if($id == 0 && empty($pass)){
            return $this->returnJson(-2, '登陆密码不能为空~！');
        }

        $viptime = $this->request->post('viptime');
        if($data['vip'] > 0 && empty($viptime)){
            return $this->returnJson(-2, 'Vip到期时间不能为空~！');
        }

        if($data['vip'] > 0){
            $data['viptime'] = strtotime($viptime);
        }
        
        $pass = $this->request->post('pass');
        if(!empty($pass)){
            $data['pass'] = md5($pass);
        }
        
        $m = $this->model('User');
        $r = $m->dataSave($data, $id);


        $msg_head = $id > 0 ? '更新' : '添加';
        if ($r){
            return $this->returnJson(1, $msg_head.'成功!');
        } else {
            return $this->returnJson(-2, $msg_head.'失败!');
        }


    }


    public function del(){
        $id = $this->request->param('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $m = $this->model('user');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }


    public function batchDel(){
        $ids = $this->request->param('id');
        $m = $this->model('user');

        foreach ($ids as $k => $id) {
            $res = $m->dataDelete($id);
            if (!$res){
                return $this->returnJson(-1, '删除失败['.$id.']!');
            }
        }

        return $this->returnJson(1, '批量删除成功!');
    }

}

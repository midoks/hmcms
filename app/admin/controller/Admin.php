<?php

namespace app\admin\controller;

use app\common\controller\Admin as AdminBase;
use think\facade\View;
use think\facade\Db;
use think\helper\Str;

class Admin extends AdminBase
{
    

    public function index()
    {
        return $this->fetch('admin/index');
    }


    public function login()
    {
        return $this->fetch('index/login');
    }

    public function edit($id=''){
        $m = $this->model('Admin');

        if (!empty($id)){
            $data = $m->getDataByID($id);
        } else {
            $data = [
                'id' => 0,
                'role_id'=>0,
            ];
        }
        View::assign("data", $data);

        $roleM = $this->model('AdminRole');

        $role_list =$roleM->listAll(1,1000);
        View::assign("roleList", $role_list);

        if ($id<1){
            return $this->fetch('admin/add');
        }
        return $this->fetch('admin/edit');
    }


    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $m = $this->model('Admin');
        $data = $m->list();
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function save(){
        $data = [];

        $id = $this->request->post('id');
        if ($id<1){
            $data['username'] = $this->request->post('username');
            if (empty($data['username'])){
                return $this->returnJson(-1, '用户名不能为空~!');
            }
        }

        $password = $this->request->post('password');

        if (!empty($password)){
            $random = Str::random(4);
            $data['password'] = md5($password.'|'.$random);
            $data['random'] = $random;
        }

        $data['role_id'] = $this->request->post('role_id');
        $data['status'] = $this->request->post('status');


        $m = $this->model('Admin');
        $r = $m->dataSave($data, $id);

        $msg_head = $id > 0 ? '更新' : '添加';
        
        if ($r){
            return $this->returnJson(0, $msg_head.'成功!');
        } else {
            return $this->returnJson(-1, $msg_head.'失败!');
        }
    }

    public function triggerStatus(){
        $id = $this->request->post('id');
        if (empty($id)){
            return $this->returnJson(-1, '用户ID不能空!');
        }

        $m = $this->model('Admin');
        $m->dataTriggerField($id,'status');
        return $this->returnJson(1, '设置成功!');
    }

    public function del(){
        $id = $this->request->param('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $m = $this->model('Admin');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }

}

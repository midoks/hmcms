<?php

namespace app\admin\controller;

use app\common\controller\Admin as AdminBase;
use think\facade\View;
use think\facade\Db;
use think\helper\Str;

class App extends AdminBase
{

    public function index()
    {
        return $this->fetch('app/index');
    }

    public function edit($id=''){
        $m = $this->model('App');
        if (!empty($id)){
            $data = $m->getDataByID($id);
        } else {
            $data = [
                'id' => 0,
            ];
        }
        View::assign("data", $data);
        return $this->fetch('app/edit');
    }


    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $m = $this->model('App');
        $data = $m->list();
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function save(){
        $id = $this->request->post('id');

        $data = [];
        $data['name'] = $this->request->post('name');
        $data['apikey'] = $this->request->post('apikey');
        $data['aeskey'] = $this->request->post('aeskey');
        $data['is_encrypt'] = $this->request->post('is_encrypt');
        $data['status'] = $this->request->post('status');
        $m = $this->model('App');
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

        $m = $this->model('App');
        $m->dataTriggerField($id,'status');
        return $this->returnJson(1, '设置成功!');
    }

    public function del(){
        $id = $this->request->param('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $m = $this->model('App');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }

}

<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class Task extends AdminBase
{

    public function index()
    {
        return $this->fetch('task/index');
    }

    public function edit($id='')
    {
        $m = $this->model('task');
        $data = $m->getDataByID($id);
        View::assign("data", $data);
        return $this->fetch('task/edit');
    }

    public function type($pid = ''){
        View::assign("pid", $pid);
        return $this->fetch('task/type');
    }

    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $wh = [];
        $wh['pid'] = 0;
        if( $page == 0 ) {
            $page=1;
        }


        $m = $this->model('task');

        $data = $m->list($page, $limit, $wh);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }


    public function type_list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $wh = [];
        $wh['pid'] = $this->request->param('pid');
        if( $page == 0 ) {
            $page = 1;
        }

        if( $limit == 0 ) {
            $limit = 20;
        }

        $m = $this->model('task');

        $data = $m->list($page, $limit, $wh);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function update()
    {
        $id = $this->request->param('id');
        $zd = $this->request->param('zd');
        $val = $this->request->param('val');

        if(empty($id)) {
            return $this->returnJson(-1, 'ID不能为空~!');
        }

        if(empty($zd)) {
            return $this->returnJson(-1, '字段不能为空~!');
        }

        if(empty($val)) {
            return $this->returnJson(-1, '值不能为空~!');
        }

        if(!is_numeric($val)) {
            return $this->returnJson(-1, '请输入正确数字~!');
        }

        $m = $this->model('task');
        $r = $m->dataSave([$zd => $val], $id);
        if ($r){
            return $this->returnJson(1, '更新成功!');
        }
        return $this->returnJson(-1, '更新失败!');
    }

    public function triggerStatus(){
        $id = $this->request->post('id');
        if (empty($id)){
            return $this->returnJson(-1, '设置ID不能空!');
        }

        $m = $this->model('task');
        $m->dataTriggerField($id,'status');
        return $this->returnJson(1, '设置成功!');
    }


    public function save(){
        
        $id = $this->request->post('id');

        $data = [];
        $data['name'] = $this->request->post('name');
        $data['text'] = $this->request->post('text');
        $data['cion'] = $this->request->post('cion');
        $data['vip'] = $this->request->post('vip');
        $data['status'] = $this->request->post('status');
        $data['daynum'] = $this->request->post('daynum');

        if(empty($data['name'])){
            return $this->returnJson(-1, '任务标题不能为空~!');
        }
        if(empty($data['text'])) {
            return $this->returnJson(-1, '任务介绍不能为空~!');
        }

        $m = $this->model('task');
        $r = $m->dataSave($data, $id);

        $msg_head = $id > 0 ? '更新' : '添加';
        
        if ($r){
            return $this->returnJson(0, $msg_head.'成功!');
        } else {
            return $this->returnJson(-1, $msg_head.'失败!');
        }
    }

}

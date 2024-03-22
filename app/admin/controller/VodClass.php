<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class VodClass extends AdminBase
{

    public function index()
    {
        return $this->fetch('vod_class/index');
    }

    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $wh = [];
        $wh['status'] = $this->request->param('status');
        $wh['sort_field'] = $this->request->param('sort_field','');
        $wh['sort_order'] = $this->request->param('sort_order','');

        $m = $this->model('VodClass');
        $list = $m->tree(0, true, $wh);
        return $this->layuiJson(0, 'ok', $list);
    }


    public function edit($id=''){
        $vod_class = $this->model('VodClass');

        if (!empty($id)){
            $data = $m->getDataByID($id);
        } else {
            $data = ['id' => 0,'status' => 0,'pid'=>0];
        }
        View::assign("data", $data);

        $wh = [];
        $wh['pid'] = 0;
        $wh['order'] = 'sort asc';
        $parent = $m->list(1, 10000, $wh);
        View::assign("parent", $parent['data']);
        return $this->fetch('vod_class/edit');
    }

    public function save(){
        $id = $this->request->post('id');

        $data = [];
        $data['name'] = $this->request->post('name');
        $data['sort'] = $this->request->post('sort');
        $data['pid'] = $this->request->post('pid');
        $data['title'] = $this->request->post('title');
        $data['key'] = $this->request->post('key');
        $data['desc'] = $this->request->post('desc');
        $data['status'] = $this->request->post('status');
        $data['jumpurl'] = $this->request->post('jumpurl');
        

        if(empty($data['name'])){
            return $this->returnJson(-1, '分类名称不能为空~!');
        }

        if (empty($data['name_en'])) {
            $data['name_en'] = toPinyin($data['name']);
        }

        $m = $this->model('VodClass');
        $r = $m->dataSave($data, $id);

        $msg_head = $id > 0 ? '更新' : '添加';
        if ($r){
            return $this->returnJson(1, $msg_head.'成功!');
        } else {
            return $this->returnJson(-1, $msg_head.'失败!');
        }
    }

    //是否开启
    public function triggerStatus(){
        $id = $this->request->post('id');
        if (empty($id)){
            return $this->returnJson(-1, '设置ID不能空!');
        }

        $m = $this->model('VodClass');
        $m->dataTriggerField($id,'status');
        return $this->returnJson(1, '设置成功!');
    }

    public function del(){
        $id = $this->request->param('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $m = $this->model('VodClass');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }


}

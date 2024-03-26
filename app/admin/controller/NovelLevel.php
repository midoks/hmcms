<?php

namespace app\admin\controller;

use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class NovelLevel extends AdminBase
{

    public function index()
    {
        return $this->fetch('novel_level/index');
    }

    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $wh = [];
        $wh['status'] = $this->request->param('status');
        $wh['sort_field'] = $this->request->param('sort_field','');
        $wh['sort_order'] = $this->request->param('sort_order','');

        $m = $this->model('NovelLevel');
        $list = $m->list($page, $limit, $wh);
        return $this->layuiJson(0, 'ok', $list['data']);
    }


    public function edit($id=''){
        $vod_class = $this->model('NovelLevel');

        if (!empty($id)){
            $data = $vod_class->getDataByID($id);
        } else {
            $data = ['id' => 0,'status' => 0,'pid'=>0];
        }
        View::assign("data", $data);

        $wh = [];
        $wh['pid'] = 0;
        $wh['order'] = 'sort asc';
        $parent = $vod_class->list(1, 10000, $wh);
        View::assign("parent", $parent['data']);
        return $this->fetch('novel_level/edit');
    }

    public function save(){
        $id = $this->request->post('id');

        $data = [];
        $data['name'] = $this->request->post('name');
        $data['sort'] = $this->request->post('sort');
        $data['remark'] = $this->request->post('remark');
        $data['status'] = $this->request->post('status');
        
        if(empty($data['name'])){
            return $this->returnJson(-1, '名称不能为空~!');
        }

        $m = $this->model('NovelLevel');
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

        $m = $this->model('NovelLevel');
        $m->dataTriggerField($id,'status');
        return $this->returnJson(1, '设置成功!');
    }


    public function batchDel(){
        $ids = $this->request->param('id');
        $m = $this->model('NovelLevel');

        foreach ($ids as $k => $id) {
            $res = $m->dataDelete($id);
            if (!$res){
                return $this->returnJson(-1, '删除失败['.$id.']!');
            }
        }

        return $this->returnJson(1, '批量删除成功!');
    }
    
    public function del(){
        $id = $this->request->param('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $m = $this->model('NovelLevel');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }


}

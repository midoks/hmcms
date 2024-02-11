<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;
use app\common\model\Comic as ComicModel;

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
        $data = $m->dataById($id);
        View::assign("data", $data);
        return $this->fetch('task/edit');
    }


    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $pid = $this->request->param('pid');
        $zd = $this->request->param('zd');
        $key = $this->request->param('key','');
        $kstime = $this->request->param('kstime');
        $jstime = $this->request->param('jstime');

        if( $page == 0 ) {
            $page=1;
        }

        $m = $this->model('task');

        $wh = [
            'pid'=>$pid,
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


    public function del(){
        $id = $this->request->param('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $m = $this->model('order');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }


    public function batchDel(){
        $ids = $this->request->param('id');
        $m = $this->model('task');

        foreach ($ids as $k => $id) {
            $res = $m->dataDelete($id);
            if (!$res){
                return $this->returnJson(-1, '删除失败['.$id.']!');
            }
        }

        return $this->returnJson(1, '批量删除成功!');
    }

    public function save(){
        
        $id = $this->request->param('id');

        $data = [];
        $data['name'] = $this->request->param('name');
        $data['text'] = $this->request->param('text');
        $data['cion'] = $this->request->param('cion');
        $data['vip'] = $this->request->param('vip');
        $data['status'] = $this->request->param('status');
        $data['daynum'] = $this->request->param('daynum');

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

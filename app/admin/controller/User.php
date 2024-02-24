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

<?php

namespace app\admin\controller;

use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class VodComment extends AdminBase
{

    public function index()
    {
        return $this->fetch('vod_comment/index');
    }


    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $wh = [];
        $wh['zd'] = $this->request->param('zd');
        $wh['key'] = $this->request->param('key','');
        $wh['kstime'] = $this->request->param('kstime');
        $wh['jstime'] = $this->request->param('jstime');

        if( $page == 0 ) {
            $page=1;
        }

        $m = $this->model('VodComment');

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

        $m = $this->model('VodComment');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }


    public function batchDel(){
        $ids = $this->request->param('id');
        $m = $this->model('VodComment');

        foreach ($ids as $k => $id) {
            $res = $m->dataDelete($id);
            if (!$res){
                return $this->returnJson(-1, '删除失败['.$id.']!');
            }
        }

        return $this->returnJson(1, '批量删除成功!');
    }

}

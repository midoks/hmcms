<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;
use app\common\model\Comic as ComicModel;

use think\facade\View;
use think\facade\Db;

class Message extends AdminBase
{

    public function index()
    {
        return $this->fetch('message/index');
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

        $m = $this->model('message');

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

        $m = $this->model('message');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }


    public function batchDel(){
        $ids = $this->request->param('id');
        $m = $this->model('message');

        foreach ($ids as $k => $id) {
            $res = $m->dataDelete($id);
            if (!$res){
                return $this->returnJson(-1, '删除失败['.$id.']!');
            }
        }

        return $this->returnJson(1, '批量删除成功!');
    }

}

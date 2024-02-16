<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class ComicChapter extends AdminBase
{

    public function index($mid='')
    {
        View::assign("mid", $mid);
        return $this->fetch('comic_chapter/index');
    }

    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $wh = [];
        $wh['yid'] = $this->request->param('yid');
        $wh['kstime'] = $this->request->param('kstime');
        $wh['jstime'] = $this->request->param('jstime');
        $wh['zd'] = $this->request->param('zd');
        $wh['key'] = $this->request->param('key');
        $wh['pay'] = $this->request->param('pay');

        $wh['sort_field'] = $this->request->param('sort_field','');
        $wh['sort_order'] = $this->request->param('sort_order','');

        $m = $this->model('ComicChapter');
        $data = $m->list($page, $limit, $wh);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }


    public function edit(){
        $m = $this->model('ComicChapter');

        $id = $this->request->param('id');
        $mid = $this->request->param('mid');
        $data = $m->getDataByID($id);

        if (empty($data)){
            $data = [
                'id' => 0,
                'yid' => 0,
                'xid' => 0,
                'name' => '',
                'mid' => $mid,
                'vip' => 0,
                'cion' => 0,
                'msg' => '',
                'pic' => [],
                'image' => ''
            ];
        } else {
            $picM = $this->model('ComicPic');
            $data['pic']= $picM->dataListByCid($id);
        }

        // var_dump($data);
        View::assign("data", $data);
        return $this->fetch('comic_chapter/edit');
    }

    public function save(){
        $id = $this->request->post('id');

        $data = [];
        $data['name'] = $this->request->post('name');
        $data['image'] = $this->request->post('image');
        $data['pnum'] = $this->request->post('pnum');
        $data['xid'] = $this->request->post('xid');
        $data['vip'] = $this->request->post('vip');
        $data['yid'] = $this->request->post('yid');
        $data['mid'] = $this->request->post('mid');
        $data['cion'] = $this->request->post('cion');


        if(empty($data['name'])){
            return $this->returnJson(-1, '章节名称不能为空~!');
        }

        if(empty($data['mid'])){
            return $this->returnJson(-1, '章节ID不能为空~!');
        }

        $m = $this->model('ComicChapter');
        $r = $m->dataSave($data, $id);

        $msg_head = $id > 0 ? '更新' : '添加';
        if ($r){
            return $this->returnJson(0, $msg_head.'成功!');
        } else {
            return $this->returnJson(-1, $msg_head.'失败!');
        }
    }

    public function batchUpdate(){
        $op = $this->request->param('op');
        $mid =  $this->request->param('mid');
        $ids = $this->request->param('id');
        $ids = implode(',', $ids);
        if (is_numeric($ids) || preg_match('/^([0-9]+[,]?)+$/', $ids)) {
            $id = $ids;
        }

        if (empty($id)) {
            return $this->returnJson(-1, 'ID不能为空!');
        }
        $arr = explode(',', $id);

        $m = $this->model('ComicChapter');
        // 设置VIP
        if ($op == 'vip'){
            $vip =  $this->request->param('vip');
            $cion =  $this->request->param('cion');
            
            if ($vip != 1) {
                $vip = 0;
            }

            $edit = array('vip' => $vip, 'cion' => 0);
            foreach ($arr as $_id) {
                $m->dataSave($edit, $_id);
            }

            $row = $m->list(1,1,['vip' => 1,'mid'=>$mid], false);
            if (count($row)>0) {
                $pay = 2;
            } else {
                $row = $m->list(1,1,['pay' => 3,'mid'=>$mid], false);
                $pay = count($row)>0 ? 1 : 0;
            }

            $comicM = $this->model('Comic');
            $comicM->dataSave(['pay' => $pay], $mid);

            return $this->returnJson(1, '设置VIP成功!');
        } else if ($op == 'cion'){ //设置金币
            
            $vip =  $this->request->param('vip');
            $cion =  $this->request->param('cion');

            $edit = array('vip' => 0, 'cion' => $cion);
            foreach ($arr as $_id) {
                $m->dataSave($edit, $_id);
            }

            $row = $m->list(1,1,['cion>' => 0,'mid'=>$mid], false);
            if (count($row)>0) {
                $pay = 1;
            } else {
                $row = $m->list(1,1,['vip' => 1,'mid'=>$mid], false);
                $pay = count($row)>0 ? 2 : 0;
            }

            $comicM = $this->model('Comic');
            $comicM->dataSave(['pay' => $pay], $mid);

            return $this->returnJson(1, '设置金币成功!');
        } else if ($op == 'px'){
            $xids = $this->request->param('xid');
            foreach ($arr as $k => $_id) {
                $_xid = $xids[$k];
                $m->dataSave(['xid' => $_xid], $_id);
            }

            return $this->returnJson(1, '设置排序成功!');
        }

        return $this->returnJson(-1, '批量操作失败!');
    }


    public function del(){
        $id = $this->request->param('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $m = $this->model('ComicChapter');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        $cpM = $this->model('ComicPic');
        $cpM->dataDeleteByCid($id);

        return $this->returnJson(1, '删除成功!');
    }


}

<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;
use app\common\model\Comic as ComicModel;

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
        $wh['tid'] = $this->request->param('tid');
        $wh['ttid'] = $this->request->param('ttid');
        $wh['pay'] = $this->request->param('pay');
        $wh['serialize'] = $this->request->param('serialize');


        $m = $this->model('ComicChapter');
        $data = $m->list($page, $limit, $wh);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }


    public function edit($id=''){
        $m = $this->model('ComicChapter');
        $data = $m->getDataByID($id);

        if (empty($data)){
            $data['pic'] = [];
        } else {
            
        }
        var_dump($data);
        View::assign("data", $data);

        // $classM = $this->model('ComicClass');
        // $classData = $classM->list(1, 100, ['pid'=>0]);
        // View::assign("classData", $classData['data']);

        // $typeM = $this->model('ComicType');
        // $typeData = $typeM->menuList(0);
        // View::assign("typeData", $typeData);

        return $this->fetch('comic_chapter/edit');
    }

    public function save(){
        $id = $this->request->post('id');

        $data = [];
        $data['name'] = $this->request->post('name');
        $data['yname'] = $this->request->post('yname');
        $data['sid'] = $this->request->post('sid');
        $data['yid'] = $this->request->post('yid');
        $data['tid'] = $this->request->post('tid');
        $data['ttid'] = $this->request->post('ttid');
        $data['score'] = $this->request->post('score');
        $data['notice'] = $this->request->post('notice');
        $data['text'] = $this->request->post('text');
        $data['pic'] = $this->request->post('pic');
        $data['picx'] = $this->request->post('picx');
        $data['msg'] = $this->request->post('msg');
        $data['serialize'] = $this->request->post('serialize');
        $data['author'] = $this->request->post('author');
        $data['pic_author'] = $this->request->post('pic_author');
        $data['txt_author'] = $this->request->post('txt_author');
        $data['content'] = $this->request->post('content');
        $data['hits'] = $this->request->post('hits');
        $data['yhits'] = $this->request->post('yhits');
        $data['zhits'] = $this->request->post('zhits');
        $data['rhits'] = $this->request->post('rhits');

        // $data['update_time'] = date('Y-m-d H:i:s');

        if ($data['yid'] == 2 && empty($data['msg'])) {
            return $this->returnJson(-1, '未通过原因不能为空~!');
        }


        if(empty($data['name'])){
            return $this->returnJson(-1, '漫画名称不能为空~!');
        }

        if (empty($data['yname'])) {
            $data['yname'] = toPinyin($data['name']);
        }

        $m = $this->model('ComicChapter');
        $r = $m->dataSave($data, $id);



        $type = $this->request->post('type');
        //更新附表内容
        if ($r || $id > 0){
            $ctr_m = $this->model('ComicTypeRelated');
            $ctr_m->setType($id, $type);
        }

        $msg_head = $id > 0 ? '更新' : '添加';
        if ($r){
            return $this->returnJson(0, $msg_head.'成功!');
        } else {
            return $this->returnJson(-1, $msg_head.'失败!');
        }


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

        return $this->returnJson(1, '删除成功!');
    }


}

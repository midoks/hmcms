<?php

namespace app\admin\controller;

use app\common\controller\Admin as AdminBase;
use think\facade\View;
use think\facade\Db;
use think\helper\Str;

class MailCode extends AdminBase
{

    public function index()
    {
        return $this->fetch('mail_code/index');
    }

    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $wh = [];
        $wh['zd'] = $this->request->param('zd');
        $wh['key'] = $this->request->param('key','');
        $wh['kstime'] = $this->request->param('kstime');
        $wh['jstime'] = $this->request->param('jstime');

        $m = $this->model('MailCode');
        $data = $m->list($page, $limit, $wh);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function batchDel(){
        $ids = $this->request->param('id');
        $m = $this->model('MailCode');

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

        $m = $this->model('MailCode');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }

}

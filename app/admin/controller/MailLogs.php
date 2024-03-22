<?php

namespace app\admin\controller;

use app\common\controller\Admin as AdminBase;
use think\facade\View;
use think\facade\Db;
use think\helper\Str;

class MailLogs extends AdminBase
{

    public function index()
    {
        return $this->fetch('maillogs/index');
    }


    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $m = $this->model('MailLogs');
        $data = $m->list($page, $limit);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function del(){
        $id = $this->request->param('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $m = $this->model('App');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }

}

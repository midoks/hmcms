<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class TaskList extends AdminBase
{

    public function index()
    {
        return $this->fetch('task_list/index');
    }

    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        
        if( $page == 0 ) {
            $page = 1;
        }

        if( $limit == 0 ) {
            $limit = 10;
        }

        $wh = [];

        $m = $this->model('TaskList');

        $data = $m->list($page, $limit, $wh);

        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function batchDel(){
        $ids = $this->request->param('id');
        $m = $this->model('TaskList');

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

        $m = $this->model('TaskList');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }

}

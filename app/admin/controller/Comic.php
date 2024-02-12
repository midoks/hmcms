<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;
use app\common\model\Comic as ComicModel;

use think\facade\View;
use think\facade\Db;

class Comic extends AdminBase
{

    public function index()
    {
        return $this->fetch('comic/index');
    }

    public function edit($id=''){
        $m = $this->model('Comic');
        $data = $m->getDataByID($id);
        View::assign("data", $data);

        $classM = $this->model('ComicClass');
        $classData = $classM->list(1, 100, ['pid'=>0]);
        View::assign("classData", $classData['data']);

        $typeM = $this->model('ComicType');
        $typeData = $typeM->list(1,100,['pid'=>0]);

        var_dump($typeData);

        return $this->fetch('comic/edit');
    }

    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $wh = [];

        $m = $this->model('Comic');
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

        $m = $this->model('Comic');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }

   

}

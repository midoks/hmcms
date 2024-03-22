<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class ComicClass extends AdminBase
{

    public function index()
    {
        return $this->fetch('comic_class/index');
    }

    public function edit($id = ''){
        $m = $this->model('ComicClass');

        if ($id > 0){
            $data = $m->getDataByID($id);
            View::assign("data", $data);
        } else {
            View::assign("data", []);   
        }
        return $this->fetch('comic_class/edit');
    }


    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $comic_class = $this->model('ComicClass');
        $data = $comic_class->list();
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function classAdd(){
        
        $id = $this->request->post('id');

        $data = [];
        $data['name'] = $this->request->post('name');
        $data['yname'] = $this->request->post('yname');
        $data['pid'] = $this->request->post('pid');
        $data['sort'] = $this->request->post('sort');

        if (empty($data['name'])){
            return $this->layuiJson(-1, '名称不能为空');
        }

        $comic_class = $this->model('ComicClass');
        $r = $comic_class->dataSave($data, $id);
        if ($id>0){
            return $this->returnJson(0, '更新成功!');
        } else{
            return $this->returnJson(0, '添加成功!');
        }
    }

    public function del(){
        $id = $this->request->post('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $comic_class = $this->model('ComicClass');
        $comic_class->recursionDelete($id);

        return $this->returnJson(0, '删除成功!');
    }

}

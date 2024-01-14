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

    public function class()
    {
        return $this->fetch('comic/class');
    }

    public function type()
    {
        return $this->fetch('comic/class');
    }


    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $comic = $this->model('Comic');
        $data = $comic->list();
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    // ************ class ************* //
    public function classList(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $comic_class = $this->model('ComicClass');
        $data = $comic_class->list();
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function classAdd(){
        $name = $this->request->post('name');
        $yname = $this->request->post('yname');
        $pid = $this->request->post('pid');
        $sort = $this->request->post('sort');
        $id = $this->request->post('id');

        if (empty($name)){
            return $this->layuiJson(-1, '名称不能为空');
        }

        $data = [
            'name' => $name,
            'yname' => $yname,
            'pid' => $pid,
            'sort' => $sort,
        ];

        if ($pid){
            $data['pid'] = $pid;
        }

        $comic_class = $this->model('ComicClass');
        $r = $comic_class->dataSave($data, $id);
        if ($id>0){
            return $this->returnJson(0, '更新成功!');
        } else{
            return $this->returnJson(0, '添加成功!');
        }
    }

    public function classDelete(){
        $id = $this->request->post('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $comic_class = $this->model('ComicClass');
        $comic_class->recursionDelete($id);

        return $this->returnJson(0, '删除成功!');
    }

    // ************ class ************* //

}

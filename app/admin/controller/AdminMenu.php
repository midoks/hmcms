<?php

namespace app\admin\controller;

use think\facade\View;
use think\facade\Db;

use app\BaseController;
use app\common\controller\Admin;
use app\common\model\AdminRole;
use app\common\model\Admin as AdminModel;


class AdminMenu extends Admin
{
    public function index()
    {
        return $this->fetch('adminmenu/index');
    }

    public function api(){
        $pid = $this->request->param('pid');
        View::assign("pid", strval($pid));
        return $this->fetch('adminmenu/api');
    }

    public function apiedit(){
        $pid = $this->request->param('pid');
        $id = $this->request->param('id');
        View::assign("pid", $pid);

        $m = $this->model('AdminMenu');
        if (!empty($id)){
            $data = $m->getDataByID($id);
        } else {
            $data = [
                'id' => 0,
            ];
        }
        View::assign("data", $data);
        return $this->fetch('adminmenu/apiedit');
    }

    //获取后台菜单权限列表
    public function list(){
        $m = $this->model('AdminMenu');
        $list = $m->submenu(0);
        return $this->layuiJson(0, 'ok',  $list);
    }

    //获取列表
    public function listpid(){
        $pid = $this->request->param('pid');

        $m = $this->model('AdminMenu');
        $list = $m->submenu($pid);
        return $this->layuiJson(0, 'ok',  $list, );
    }

    public function menu_plist(){
        $m = $this->model('AdminMenu');
        $list = $m->submenu2(0,false);
        return $this->layuiJson(0, 'ok',  $list, );
    }

    public function del(){
        $id = $this->request->post('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        // if ($id<100){
        //     return $this->returnJson(-1, '不能删除!');
        // }

        $m = $this->model('AdminMenu');
        $r = $m->recursionDelete($id);
        if ($r){
            return $this->returnJson(0, '删除成功!');
        }
        return $this->returnJson(-1, '删除失败!');
    }

    public function batchDel(){
        $ids = $this->request->param('id');
        $m = $this->model('AdminMenu');

        foreach ($ids as $k => $id) {
            $res = $m->dataDelete($id);
            if (!$res){
                return $this->returnJson(-1, '删除失败['.$id.']!');
            }
        }

        return $this->returnJson(1, '批量删除成功!');
    }

    public function triggerDisplay(){
        $id = $this->request->post('id');
        if (empty($id)){
            return $this->returnJson(-1, '设置ID不能空!');
        }

        $m = $this->model('AdminMenu');
        $m->dataTriggerField($id,'display');
        return $this->returnJson(1, '设置成功!');
    }

    public function triggerStatus(){
        $id = $this->request->post('id');
        if (empty($id)){
            return $this->returnJson(-1, '设置ID不能空!');
        }

        $m = $this->model('AdminMenu');
        $m->dataTriggerField($id,'status');
        return $this->returnJson(1, '设置成功!');
    }

    public function save(){
         
        $id = $this->request->post('id');

        $data = [
            'name' => $this->request->post('name'),
            'alias' => $this->request->post('alias'),
            'remark' => $this->request->post('remark'),
            'icon' => $this->request->post('icon'),
            'route' => $this->request->post('route'),
            'type' => $this->request->post('type'),
            'sort' => $this->request->post('sort'),
        ];

        if (empty($data['name'])){
            return $this->layuiJson(-1, '名称不能为空');
        }

        $pid = $this->request->post('pid');
        if ($pid){
            $data['pid'] = $pid;
        }

        $m = $this->model('AdminMenu');
        if ($id>0){
            $m->where('id',$id)->save($data);
            return $this->returnJson(0, '更新成功!');
        } else{
            $m->insert($data);
            return $this->returnJson(0, '添加成功!');
        }
        
        return $this->returnJson(0, '添加成功!');
    }



}

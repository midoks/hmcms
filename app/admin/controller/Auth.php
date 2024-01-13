<?php

namespace app\admin\controller;

use think\facade\View;
use think\facade\Db;

use app\BaseController;
use app\common\controller\Admin;
use app\common\model\AdminMenu;


class Auth extends Admin
{
    public function index()
    {
        return $this->fetch('auth/index');
    }

    public function role()
    {
        return $this->fetch('auth/role');
    }

    //获取列表
    public function list(){
        $ammodel = AdminMenu::getInstance();
        $list = $ammodel->submenu(0);
        return $this->layuiJson(0, 'ok',  $list, );
    }

    //获取列表
    public function listpid(){
        $ammodel = AdminMenu::getInstance();
        $pid = $this->request->param('pid');
        // var_dump($pid);
        $list = $ammodel->submenu($pid);
        return $this->layuiJson(0, 'ok',  $list, );
    }

    public function menu_plist(){
        $ammodel = AdminMenu::getInstance();
        $list = $ammodel->submenu2(0,false);
        return $this->layuiJson(0, 'ok',  $list, );
    }

    public function delete(){
        $id = $this->request->post('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $ammodel = AdminMenu::getInstance();
        $ammodel->recursionDelete($id);

        return $this->returnJson(0, '删除成功!');
    }

    public function add(){
        $name = $this->request->post('name');
        $alias = $this->request->post('alias');
        $remark = $this->request->post('remark');
        $icon = $this->request->post('icon');
        $route = $this->request->post('route');
        $pid = $this->request->post('pid');
        $id = $this->request->post('id');

        if (empty($name)){
            return $this->layuiJson(-1, '名称不能为空');
        }

        $data = [
            'name' => $name,
            'alias' => $alias,
            'remark' => $remark,
            'icon' => $icon,
            'route' => $route,
        ];

        if ($pid){
            $data['pid'] = $pid;
        }

        $ammodel = AdminMenu::getInstance();

        if ($id>0){
            $ammodel->where('id',$id)->save($data);
            return $this->returnJson(0, '更新成功!');
        } else{
            $ammodel->insert($data);
            return $this->returnJson(0, '添加成功!');
        }
        
        return $this->returnJson(0, '添加成功!');
    }



}

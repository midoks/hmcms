<?php

namespace app\admin\controller;

use think\facade\View;
use think\facade\Db;

use app\BaseController;
use app\common\controller\Admin;
use app\common\model\AdminMenu;
use app\common\model\AdminRole;


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

    public function admin()
    {
        return $this->fetch('auth/admin');
    }

    //获取后台菜单权限列表
    public function list(){
        $menu = AdminMenu::getInstance();
        $list = $menu->submenu(0);
        return $this->layuiJson(0, 'ok',  $list);
    }

    // ************ role ************* //
    public function roleList(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $role = AdminRole::getInstance();
        $data = $role->list();
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function roleAdd(){
        $name = $this->request->post('name');
        $remark = $this->request->post('remark');
        $id = $this->request->post('id');

        if (empty($name)){
            return $this->layuiJson(-1, '名称不能为空');
        }

        $data = [
            'name' => $name,
            'remark' => $remark,
        ];

        $role = AdminRole::getInstance();
        if ($id>0){
            $role->where('id',$id)->save($data);
            return $this->returnJson(0, '更新成功!');
        } else{
            $role->insert($data);
            return $this->returnJson(0, '添加成功!');
        }
    }

    public function roleDelete(){
        $id = $this->request->post('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $role = AdminRole::getInstance();
        $role->where('id', $id)->delete();
        return $this->returnJson(0, '删除成功!');
    }

    // ************ role ************* //


    // ************ admin ************* //

    public function adminList(){

    }


    // ************ admin ************* //


    //获取列表
    public function listpid(){
        $menu = AdminMenu::getInstance();
        $pid = $this->request->param('pid');
        // var_dump($pid);
        $list = $menu->submenu($pid);
        return $this->layuiJson(0, 'ok',  $list, );
    }

    public function menu_plist(){
        $menu = AdminMenu::getInstance();
        $list = $menu->submenu2(0,false);
        return $this->layuiJson(0, 'ok',  $list, );
    }

    public function delete(){
        $id = $this->request->post('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $menu = AdminMenu::getInstance();
        $menu->recursionDelete($id);

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

        $menu = AdminMenu::getInstance();

        if ($id>0){
            $menu->where('id',$id)->save($data);
            return $this->returnJson(0, '更新成功!');
        } else{
            $menu->insert($data);
            return $this->returnJson(0, '添加成功!');
        }
        
        return $this->returnJson(0, '添加成功!');
    }



}

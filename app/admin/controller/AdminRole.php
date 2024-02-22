<?php
namespace app\admin\controller;

use app\common\controller\Admin as AdminBase;
use think\facade\View;
// use think\Db;
use think\facade\Db;

class AdminRole extends AdminBase
{

	public function index()
    {
        return $this->fetch('adminrole/index');
    }

    public function edit($id = ''){
        $m = $this->model('AdminRole');
        if (!empty($id)){
            $data = $m->getDataByID($id);
        } else {
            $data = [
                'id' => 0,
            ];
        }
        View::assign("data", $data);
        return $this->fetch('adminrole/edit');
    }

    //构造菜单
    private function makeMenuStruct($data, $aa_ids, $dep = 0){
        $rdata = [];
        foreach($data as $k=>$v){
            $t = [];
            $t['title'] = $v['name'];
            $t['id'] = $v['id'];

            if (in_array($t['id'], $aa_ids)){
                $t['spread'] = true;
            }

            if (in_array($t['id'], $aa_ids) && $dep == 3){
                $t['checked'] = true;
            }

            if (!empty($v['submenu'])){
                $t['children'] = $this->makeMenuStruct($v['submenu'], $aa_ids, $dep+1);
            }

            $rdata[] = $t;
        }
        return $rdata;
    }

    public function acl($role_id = ''){
        //节点表
        $aa = $this->model('AdminAccess');
        $aa_list =$aa->list($role_id);

        //重新组装节点ID
        $aa_ids = $aa->getFieldList($aa_list,'node_id');

        //获取所有菜单及权限
        $am = $this->model('AdminMenu');
        $menu_list = $am->submenu(0,true,['status'=>1]);

        $jdata = $this->makeMenuStruct($menu_list, $aa_ids, 0);

        View::assign("menu_data", json_encode($jdata));
        View::assign("role_id", $role_id);
        return $this->fetch('adminrole/acl');
    }

    public function setAcl(){
        $role_id = $this->request->param('role_id');
        $ids = $this->request->param('ids');

        $batchData = [];
        foreach ($ids as $id) {
            $t = [
                'role_id' => $role_id,
                'node_id' => $id,
                'level' => 0,
                'module' => 'admin',
            ];
            $batchData[] = $t;
        }

        // 启动事务
        Db::startTrans();
        try {
            $aa = $this->model('AdminAccess');
            $aa->where('role_id', $role_id)->delete();
            $aa->insertAll($batchData);
            // 提交事务
            Db::commit();
            return $this->returnJson(1, '权限设置成功!');
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return $this->returnJson(-1, '操作失败,请重试!');
        }
    }

    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $m = $this->model('AdminRole');
        $data = $m->list();
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function save(){
        $id = $this->request->post('id');

        $data = [];
        $data['name'] = $this->request->post('name');
        $data['remark'] = $this->request->post('remark');
        $m = $this->model('AdminRole');
        $r = $m->dataSave($data, $id);
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

        $m = $this->model('AdminRole');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }

}

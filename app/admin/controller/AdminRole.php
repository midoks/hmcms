<?php

namespace app\admin\controller;

use app\common\controller\Admin as AdminBase;
use think\facade\View;
use think\facade\Db;

class AdminRole extends AdminBase
{

	public function index()
    {
        return $this->fetch('adminrole/index');
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

}

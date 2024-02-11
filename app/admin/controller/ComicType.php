<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;
use app\common\model\Comic as ComicModel;

use think\facade\View;
use think\facade\Db;

class ComicType extends AdminBase
{

    public function index()
    {
        return $this->fetch('comic_type/index');
    }

    public function edit($id = ''){
        $m = $this->model('ComicType');

        // if ($id > 0){
            $data = $m->getDataByID($id);
            View::assign("data", $data);
        // } else {
        //     View::assign("data", []);   
        // }
        
        return $this->fetch('comic_type/edit');
    }

    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $m = $this->model('ComicType');

        $data = $m->list($page, $limit);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

}

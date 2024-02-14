<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;

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

        if ($id > 0){
            $data = $m->getDataByID($id);
            View::assign("data", $data);
        } else {
            View::assign("data", []);
        }
        return $this->fetch('comic_type/edit');
    }

    public function sublist($pid = ''){
        View::assign("pid", $pid);
        return $this->fetch('comic_type/sublist');
    }

    public function pidlist(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $wh = [];
        $wh['pid'] = $this->request->param('pid');

        $m = $this->model('ComicType');


        $data = $m->list($page, $limit, $wh);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $m = $this->model('ComicType');

        $wh['pid'] = '0';

        $data = $m->list($page, $limit, $wh);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

}

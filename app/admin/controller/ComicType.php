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


    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $comic_type = $this->model('ComicType');

        $data = $comic_type->list($page, $limit);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

}

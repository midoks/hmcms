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


    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $comic = ComicModel::getInstance();
        $data = $comic->list();
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }

    public function test3()
    {

        $comic_model = new Comic();

        $data = $comic_model->getDataByID('1');

        var_dump($data);
    
    }
}

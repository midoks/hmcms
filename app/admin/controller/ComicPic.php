<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class ComicPic extends AdminBase
{


    public function del(){
        $id = $this->request->param('id');
        $ac = $this->request->param('ac');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        if ($ac == 'all'){
            $m = $this->model('ComicPic');
            $res = $m->dataDeleteByCid($id);

            $ccM = $this->model('ComicChapter');
            $ccM->where('id', $id)->update(['pnum'=>0]);

            if (!$res){
                return $this->returnJson(-1, '全部删除失败!');
            }

        } else {
            $m = $this->model('ComicPic');

            // 硬删除
            $row = $m->where('id',$id)->find();
            $path = app()->getRootPath().'/upload/'.$row['img'];
            if (file_exists($path)){
                unlink($path);
            }

            $res = $m->dataDelete($id);
            if (!$res){
                return $this->returnJson(-1, '删除失败!');
            }

            $ccM = $this->model('ComicChapter');
            $ccM->where('id', $id)->dec('pnum')->update();
        }

        $msg_head = $ac == 'all' ? '批量' : '';
        return $this->returnJson(1, $msg_head.'删除成功!');
    }


}

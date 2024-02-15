<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class Common extends AdminBase
{

    //上传章节封面
    public function uploadCoverByCid(){
        $cid = $this->request->param('cid');
        if ($cid <= 0){
            return $this->returnJson(-1, '缺少章节ID!,先创建章节再上传封面!');
        }

        $file = $this->request->file('file');
        $path = \think\facade\Filesystem::disk('upload')->putFile('comic_cover', $file);


        $m = $this->model('ComicChapter');

        $r = $m->dataSave(['image'=> $path], $cid);
        $rdata = ['url'=>$path];
        if ($r){
            return $this->returnJson(1, '上传成功!', $rdata);
        }
        return $this->returnJson(0, '上传失败!');
    }


    //上传章节图片通过章节ID
    public function uploadPicByCid(){
        $cid = $this->request->param('cid');
        if ($cid <= 0){
            return $this->returnJson(-1, '缺少章节ID!,先创建章节再上传封面!');
        }

        $file = $this->request->file('file');

        // validate(['image'=>'fileExt:jpg,png'])->check([$file]);
       $path = \think\facade\Filesystem::disk('upload')->putFile('comic', $file);


       // $m = $this->model('ComicChapter');
       $m = $this->model('ComicPic', $cid);

       $id = $m->dataAdd($path, $cid);
       $rdata = ['url'=>$path, 'id'=>$id];
       return $this->returnJson(0, '上传成功!', $rdata);
    }

}

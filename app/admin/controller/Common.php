<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class Common extends AdminBase
{
    public function upload(){
    


        $file = $this->request->file('file');

        // var_dump($file);

        // validate(['image'=>'fileExt:jpg,png'])->check([$file]);

        $savename = \think\facade\Filesystem::disk('upload')->putFile('comic', $file);
        // var_dump($savename);


        return json(['code'=>1]);
    }

}

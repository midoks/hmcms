<?php
declare (strict_types = 1);

namespace app\v3\controller;

class Comic extends BaseLogin
{
    public function list(){

        $add = [];
        $add['uid'] = $this->request->post('user_id');
        $add['name'] = $this->request->post('name');
        $add['text'] =  $this->request->post('text');
        $add['images'] =  $this->request->post('images');

        $m = $this->model('Comic');

        $r = $m->dataSave($add);
        if ($r>0){
            return $this->returnData(1,'反馈成功！');
        }
        return $this->returnData(-1,'反馈异常,联系管理员!');
    }


}

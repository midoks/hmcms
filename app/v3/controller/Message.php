<?php
declare (strict_types = 1);

namespace app\v3\controller;

class Message extends BaseLogin
{

    //获取消息列表
    public function index(){
        $uid = $this->request->post('user_id');
        $pos = $this->request->post('pos', 0);
        $size = $this->request->post('size', 8);
        if ($size>20){
            $size = 20;
        }
        $m = $this->model('Message');

        $msg_list = $m->dataListPos($pos);


        //输出
        $d['code'] = 1;
        $d['data'] = $msg_list;
        return $this->returnData(1, $d);
    }

    //获取未读数据
    public function get_unread_num(){

        $uid = $this->request->post('user_id');
        $m = $this->model('Message');
        $count = $m->dataCount(['uid'=>$uid,'did'=>'0']);

        $d['code'] = 1;
        $d['msg'] = '总数';
        $d['nums'] = $count;
        return $this->returnData(1, $d);
    }

    public function read(){
        $id = $this->request->post('id');
        if ($id<1){
            return $this->returnData(-1, "缺少消息ID");
        }

        $m = $this->model('Message');
        $r =$m->dataSave(['did'=>1], $id);
        if ($r){
            return $this->returnData(1, "已读成功!");
        }
        return $this->returnData(-1,'系统异常!');
    }

}

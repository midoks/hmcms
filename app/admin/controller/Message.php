<?php

namespace app\admin\controller;

use app\BaseController;
use app\common\controller\Admin as AdminBase;

use think\facade\View;
use think\facade\Db;

class Message extends AdminBase
{

    public function index()
    {
        return $this->fetch('message/index');
    }

    public function reply($uid){
        View::assign("uid", $uid);
        return $this->fetch('message/reply');
    }

    public function save()
    {
        $m = $this->model('message');

        $data = [];
        $data['uid'] = $this->request->param('uid');
        $data['name'] = $this->request->param('name');
        $data['text'] = $this->request->param('text');
        $data['did'] = 0;

        if($data['uid']<1){
            return $this->returnJson(-1, '用户ID不能空!');
        }

        $r = $m->dataSave($data);
        if ($r > 0){
            return $this->returnJson(1, '消息发送成功!');
        }
        return $this->returnJson(-1, '异常,联系管理员!');
    }


    public function list(){
        $page = $this->request->param('page');
        $limit = $this->request->param('limit');

        $name = $this->request->param('name');
        $kstime = $this->request->param('kstime');
        $jstime = $this->request->param('jstime');
        $zd = $this->request->param('zd');
        $key = $this->request->param('key','');

        if( $page == 0 ) {
            $page=1;
        }

        $m = $this->model('message');

        $wh = [
            'name' => $name,
            'zd' => $zd,
            'key' => $key,
            'kstime' => $kstime,
            'jstime' => $jstime,
        ];

        $data = $m->list($page, $limit, $wh);
        $count = $data['total'];
        $list = $data['data'];

        return $this->layuiJson(0, 'ok', $list, $count);
    }


    public function del(){
        $id = $this->request->param('id');
        if (empty($id)){
            return $this->returnJson(-1, '删除ID不能空!');
        }

        $m = $this->model('message');
        $res = $m->dataDelete($id);
        if (!$res){
            return $this->returnJson(-1, '删除失败!');
        }

        return $this->returnJson(1, '删除成功!');
    }


    public function batchDel(){
        $ids = $this->request->param('id');
        $m = $this->model('message');

        foreach ($ids as $k => $id) {
            $res = $m->dataDelete($id);
            if (!$res){
                return $this->returnJson(-1, '删除失败['.$id.']!');
            }
        }

        return $this->returnJson(1, '批量删除成功!');
    }

}

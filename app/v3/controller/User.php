<?php
declare (strict_types = 1);

namespace app\v3\controller;

class User extends BaseLogin
{
    public function index(){

        $uid = $this->request->post('user_id');

        $m = $this->model('User');
        $row = $m->getDataByID($uid);

        $d = [];
        if (!$row){
            $row['inviteid'] = $row['id'] + 10000;
            $d['code'] = 1;
            $d['user'] = $row;
        } else {
            $row['inviteid'] = $row['id'] + 10000;
            $d['code'] = 1;
            $d['user'] = $row;

            $d['user'] = [
                'id' => 0, 
                'nichen' => '立即登录', 
                'pic' => 'https:///packs/mccms/user.png', 
                'tel' => '', 
                'vip' => 0, 
                'viptime' => '未开通', 
                'cion' => 0, 
                'ticket' => 0, 
                'rmb' => 0, 
                'vipday' => 0
            ];
        }
        // $d['user'] = get_app_data($row);

        return $this->returnData(1,$d);

    }

}

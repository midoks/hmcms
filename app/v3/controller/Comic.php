<?php
declare (strict_types = 1);

namespace app\v3\controller;

class Comic extends BaseLogin
{
    public function list(){
        $m = $this->model('Comic');

        $data = $m->dataListPos();

        var_dump($data);


        return $this->returnData(-1,'反馈异常,联系管理员!');
    }

    // 搜索分离 by sphinx
    public function search($keyword, $page, $size)
    {

        $offset = $size * ($page - 1);
        $sphinx = new \sphinx\SphinxClient();
        $sphinx->setServer('127.0.0.1', 9312);

        // 本地测试
        // $sphinx->setServer('xx.xxx.xxx.xx', 9312);
        $sphinx->SetLimits($offset, $size);
        $res = $sphinx->query($keyword, 'comic');
        $count = 0;
        $list = [];

        if ($res){
            $count = $res['total_found'];

            if ($res['total_found'] > 0 && isset($res['matches'])) {
                foreach ($res['matches'] as $key => $value) {
                    $value['attrs']['id'] = $key;
                    $res['matches'][$key] = $value; 
                }

                $list = array_column($res['matches'], 'attrs');
            }
            $list = get_app_data($list);
        }
        return ['count'=>$count,'list'=> $list];
    }


}

<?php
declare (strict_types = 1);

namespace app\v3\controller;

use app\common\controller\Base as B;

class BaseLogin extends B
{

    protected $middleware = [
        \app\middleware\v3::class,
        \app\middleware\v3LoginCheck::class,
    ];

    public function returnData($code, $arr, $msg = 'ok'){

        if (!is_array($arr)){
            $data['msg'] = $arr;
            $data['code'] = $code;
        } else {
            $data = $arr;
            if (!isset($data['code'])) {
                $data['code'] = $code;
            }
        }

        $data = encrypt_data($data);
        return $this->returnJson($code, $msg, $data); 
    }

}

<?php
declare (strict_types = 1);

namespace app\v3\controller;

use app\common\controller\Base as B;

class Base extends B
{

    public function returnData($code, $data, $msg = 'ok'){
        $data = encrypt_data($data);
        return $this->returnJson($code, $msg, $data); 
    }

}

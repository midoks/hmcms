<?php
declare (strict_types = 1);

namespace app\v3\controller;

use app\common\controller\Base;

class App extends Base
{
    public function index()
    {
        return '您好！这是一个[v3]示例应用';
    }
}

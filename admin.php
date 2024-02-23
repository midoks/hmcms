<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;

if(!is_file('./app/data/install/install.lock')) {
    header("Location: ./install.php");
    exit;
}

require __DIR__ . '/vendor/autoload.php';

// 执行HTTP应用并响应
// ->debug()
// $http = (new App())->http;
$http = (new App())->debug()->http;
$response = $http->name('admin')->run();
$response->send();
$http->end($response);

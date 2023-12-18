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

if(is_file('./app/data/install/install.lock')) {
	echo '如需重新安装请删除【To re install, please remove】 >>> /app/data/install/install.lock';
	exit;
}

if(!is_writable('./runtime')) {
	echo '请开启[runtime]目录的读写权限【Please turn on the read and write permissions of the [runtime] folder】';
	exit;
}

require __DIR__ . '/vendor/autoload.php';

// 执行HTTP应用并响应
$http = (new App())->debug()->http;
$response = $http->name('install')->run();
$response->send();
$http->end($response);

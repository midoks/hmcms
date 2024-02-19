<?php
// +----------------------------------------------------------------------
// | 控制台配置
// +----------------------------------------------------------------------
return [
    // 指令定义
    'commands' => [
        'hello' => 'app\command\Hello',
        'autoupdate' => 'app\command\AutoUpdate',
    ],

    'trace' =>[
        // 使用浏览器console输出trace信息
        'type'  =>  'console',
    ]
];

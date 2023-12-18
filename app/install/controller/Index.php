<?php

namespace app\install\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Db;
use think\DbManager;


class Index extends BaseController
{

    private function fetch($tpl='index/index')
    {
        $root_path = $this->app->getRootPath();
        $install_path = $root_path.'/app/install/view';
        return View::fetch($install_path.'/'.$tpl.'.html');
    }

    public function index($step = 0)
    {
        $langs = glob('./app/install/lang/*.php');
        foreach ($langs as $k => &$v) {
            $v = str_replace(['./app/install/lang/','.php'], ['',''], $v);
        }
        View::assign('langs', $langs);
        
        $lang = $this->request->param('lang');
        if ($lang != ''){
            if(!in_array($lang,$langs)) {
                $lang = 'zh-cn';
            }
            session('lang', $lang);
            $this->app->lang->load('./app/install/lang/'.$lang.'.php');
        } else {
            $lang = session('lang');
        }
        View::assign('lang', $lang);

        switch ($step) {
            case 2:
                session('install_error', false);
                return self::step2();
                break;
            case 3:
                if (session('install_error')) {
                    return $this->error(lang('install/environment_failed'));
                }
                return self::step3();
                break;
            case 4:
                if (session('install_error')) {
                    return $this->error(lang('install/environment_failed'));
                }
                return self::step4();
                break;
            case 5:
                if (session('install_error')) {
                    return $this->error(lang('install/init_err'));
                }
                return self::step5();
                break;
            default:
                break;
        }


        return $this->fetch('index/index');
    }


    /**
     * 第二步：环境检测
     * @return mixed
     */
    private function step2()
    {
        $data = [];
        $data['env'] = self::checkNnv();
        $data['dir'] = self::checkDir();
        $data['func'] = self::checkFunc();
        View::assign('data', $data);
        return $this->fetch('index/step2');
    }
    
    /**
     * 第三步：初始化配置
     * @return mixed
     */
    private function step3()
    {
        $install_dir = $_SERVER["SCRIPT_NAME"];
        $install_dir = hm_substring($install_dir, strripos($install_dir, "/")+1);
        View::assign('install_dir', $install_dir);
        return $this->fetch('index/step3');
    }
    
    /**
     * 第四步：执行安装
     * @return mixed
     */
    private function step4()
    {
        $root_path = $this->app->getRootPath();
        if ($this->request->isPost()) {
            if (!is_writable($root_path.'config/database.php')) {
                return $this->error('[app/database.php]'.lang('install/write_read_err'));
            }
            $data = input('post.');
            $data['type'] = 'mysql';
            $rule = [
                'hostname|'.lang('install/server_address') => 'require',
                'hostport|'.lang('install/database_port') => 'require|number',
                'database|'.lang('install/database_name') => 'require',
                'username|'.lang('install/database_username') => 'require',
                'prefix|'.lang('install/database_pre') => 'require|regex:^[a-z0-9]{1,20}[_]{1}',
                'cover|'.lang('install/overwrite_database') => 'require|in:0,1',
            ];
            $validate = $this->validate($data, $rule);
            if (true !== $validate) {
                return $this->error($validate);
            }
            $cover = $data['cover'];
            unset($data['cover']);
            $config = include $root_path.'config/database.php';
            foreach ($data as $k => $v) {
                if (array_key_exists($k, $config['connections']['mysql']) === false) {
                    return $this->error(lang('param').''.$k.''.lang('install/not_found'));
                }
            }
            // 不存在的数据库会导致连接失败
            $database = $data['database'];
            unset($data['database']);

            // 创建数据库连接
            $db_connect = $this->db_connect($data);
            // 检测数据库连接
            try{
                $db_connect->execute('select version()');
            }catch(\Exception $e){
                $this->error(lang('install/database_connect_err'));
            }

            // 生成数据库配置文件
            $data['database'] = $database;
            self::mkDatabase($data);

            // 不覆盖检测是否已存在数据库
            if (!$cover) {
                $check = $db_connect->execute("SELECT * FROM information_schema.schemata WHERE schema_name='{$database}'");
                if ($check>0) {
                    return $this->success(lang('install/database_name_haved'),'');
                }
            }
            // 创建数据库
            if (!$db_connect->execute("CREATE DATABASE IF NOT EXISTS `{$database}` DEFAULT CHARACTER SET utf8")) {
                return $this->error($db_connect->getError());
            }


            return $this->success(lang('install/database_connect_ok'), '');
        } else {
            return $this->error(lang('install/access_denied'));
        }
    }

    public function testdb()
    {
        $data = [
            'type'=>'mysql',
            'hostname'=>'127.0.0.1',
            'hostport'=>'3306',
            'username'=>'root',
            'password'=>'root',
            'prefix'=>'hm_',
            'database' => 'test',
        ];

        $db = $this->db_connect($data);
        $data = $db->query('select version()');
        var_dump($data);
    }

    public function testerr()
    {
        $this->error("11",null,'',100000);
    }


    private function db_connect($data){
        $config =  [
            'default'         => 'mysql',
            'connections'     => [
                'mysql' => [
                    'type'            => 'mysql',
                    // 服务器地址
                    'hostname'        => $data['hostname'],
                    // 用户名
                    'username'        => $data['username'],
                    // 密码
                    'password'        => $data['password'],
                    // 端口
                    'hostport'        => $data['hostport'],
                    'params'          => [],
                    'charset'         => 'utf8',
                    'prefix'          => $data['prefix'],
                    'deploy'          => 0,
                    'rw_separate'     => false,
                    'master_num'      => 1,
                    'slave_no'        => '',
                    'fields_strict'   => true,
                    'break_reconnect' => false,
                    'trigger_sql'     => false,
                    'fields_cache'    => false,
                ],
            ]
        ];

        $db_mgr = new DbManager();
        $db_mgr->setConfig($config);
        $db = $db_mgr->connect('mysql');
        return $db;

    }
    
    /**
     * 第五步：数据库安装
     * @return mixed
     */
    private function step5()
    {
        $account = input('post.account');
        $password = input('post.password');
        $install_dir = input('post.install_dir');
        $initdata = input('post.initdata');

        $root_path = $this->app->getRootPath();

        $config = include $root_path.'config/database.php';
        $db_config = $config['connections']['mysql'];
        if (empty($db_config['hostname']) || empty($db_config['database']) || empty($db_config['username'])) {
            return $this->error(lang('install/please_test_connect'));
        }
        if (empty($account) || empty($password)) {
            return $this->error(lang('install/please_input_admin_name_pass'));
        }

        $rule = [
            'account|'.lang('install/admin_name') => 'require|alphaNum',
            'password|'.lang('install/admin_pass') => 'require|length:4,20',
        ];
        $validate = $this->validate(['account' => $account, 'password' => $password], $rule);
        if (true !== $validate) {
            return $this->error($validate);
        }
        if(empty($install_dir)) {
            $install_dir='/';
        }
        $config_new = config('hmcms');
        $cofnig_new['app']['cache_flag'] = substr(md5(time()),0,10);
        $cofnig_new['app']['lang'] = session('lang');

        $config_new['api']['vod']['status'] = 0;
        $config_new['api']['art']['status'] = 0;

        $config_new['interface']['status'] = 0;
        $config_new['interface']['pass'] = hm_get_rndstr(16);
        $config_new['site']['install_dir'] = $install_dir;
        
        // 更新程序配置文件
        $res = hm_arr2file($root_path . 'config/hmcms.php', $config_new);
        if ($res === false) {
            return $this->error(lang('write_err_config'));
        }
        
        // 导入系统初始数据库结构
        // 导入SQL
        $sql_file = $root_path.'app/install/sql/install.sql';
        if (file_exists($sql_file)) {
            $sql = file_get_contents($sql_file);
            $sql_list = hm_parse_sql($sql, 0, ['hm_' => $db_config['prefix']]);
            if ($sql_list) {
                $sql_list = array_filter($sql_list);
                foreach ($sql_list as $v) {
                    try {
                        Db::execute($v);
                    } catch(\Exception $e) {
                        return $this->error(lang('install/sql_err'). $e);
                    }
                }
            }
        }
        //初始化数据
        if($initdata=='1'){
            $sql_file = $root_path.'app/install/sql/initdata.sql';
            if (file_exists($sql_file)) {
                $sql = file_get_contents($sql_file);
                $sql_list = hm_parse_sql($sql, 0, ['hm_' => $db_config['prefix']]);
                if ($sql_list) {
                    $sql_list = array_filter($sql_list);
                    foreach ($sql_list as $v) {
                        try {
                            Db::execute($v);
                        } catch(\Exception $e) {
                            return $this->error(lang('install/init_data_err'). $e);
                        }
                    }
                }
            }
        }

        // 注册管理员账号
        $data = [
            'admin_name' => $account,
            'admin_pwd' => $password,
            'admin_status' =>1,
            'admin_auth' => '',
        ];
        $res = Db::name('admin')->save($data);
        if ($res>1) {
            return $this->error(lang('install/admin_name_err').'：'.$res['msg']);
        }
        file_put_contents($root_path.'app/data/install/install.lock', date('Y-m-d H:i:s'));

        // 获取站点根目录
        $root_dir = $this->request->baseFile();
        $root_dir  = preg_replace(['/install.php$/'], [''], $root_dir);
        return $this->success(lang('install/is_ok'), $root_dir.'admin.php');
    }
    
    /**
     * 环境检测
     * @return array
     */
    private function checkNnv()
    {
        $items = [
            'os'      => [lang('install/os'), lang('install/not_limited'), 'Windows/Unix', PHP_OS, 'ok'],
            'php'     => [lang('install/php'), '8.0', '8.0及以上', PHP_VERSION, 'ok'],
        ];
        if ($items['php'][3] < $items['php'][1]) {
            $items['php'][4] = 'no';
            session('install_error', true);
        }
        return $items;
    }
    
    /**
     * 目录权限检查
     * @return array
     */
    private function checkDir()
    {
        $items = [
            ['file', './config/database.php', lang('install/read_and_write'), lang('install/read_and_write'), 'ok'],
            ['file', './config/route.php', lang('install/read_and_write'), lang('install/read_and_write'), 'ok'],
            ['dir', './app/data/backup', lang('install/read_and_write'), lang('install/read_and_write'), 'ok'],
            ['dir', './app/data/update', lang('install/read_and_write'), lang('install/read_and_write'), 'ok'],
            ['dir', './runtime', lang('install/read_and_write'), lang('install/read_and_write'), 'ok'],
            ['dir', './upload', lang('install/read_and_write'), lang('install/read_and_write'), 'ok'],
        ];
        foreach ($items as &$v) {
            if ($v[0] == 'dir') {// 文件夹
                if(!is_writable($v[1])) {
                    if(is_dir($v[1])) {
                        $v[3] = lang('install/not_writable');
                        $v[4] = 'no';
                    } else {
                        $v[3] = lang('install/not_found');
                        $v[4] = 'no';
                    }
                    session('install_error', true);
                }
            } else {// 文件
                if(!is_writable($v[1])) {
                    $v[3] = lang('install/not_writable');
                    $v[4] = 'no';
                    session('install_error', true);
                }
            }
        }
        return $items;
    }
    
    /**
     * 函数及扩展检查
     * @return array
     */
    private function checkFunc()
    {
        $items = [
            ['pdo', lang('install/support'), 'yes',lang('install/class')],
            ['pdo_mysql', lang('install/support'), 'yes', lang('install/model')],
            ['zip', lang('install/support'), 'yes', lang('install/model')],
            ['fileinfo', lang('install/support'), 'yes', lang('install/model')],
            ['curl', lang('install/support'), 'yes', lang('install/model')],
            ['xml', lang('install/support'), 'yes', lang('install/function')],
            ['file_get_contents', lang('install/support'), 'yes', lang('install/function')],
            ['mb_strlen', lang('install/support'), 'yes', lang('install/function')],
        ];

        if(version_compare(PHP_VERSION,'5.6.0','ge') && version_compare(PHP_VERSION,'5.7.0','lt')){
            $items[] = ['always_populate_raw_post_data',lang('install/support'),'yes',lang('install/config')];
        }

        foreach ($items as &$v) {
            if(('类'==$v[3] && !class_exists($v[0])) || (lang('install/model')==$v[3] && !extension_loaded($v[0])) || (lang('install/function')==$v[3] && !function_exists($v[0])) || (lang('install/config')==$v[3] && ini_get('always_populate_raw_post_data')!=-1)) {
                $v[1] = lang('install/not_support');
                $v[2] = 'no';
                session('install_error', true);
            }
        }

        return $items;
    }
    
    /**
     * 生成数据库配置文件
     * @return array
     */
    private function mkDatabase(array $data)
    {
        $code = <<<INFO
<?php

return [
    // 默认使用的数据库连接配置
    'default'         => 'mysql',

    // 自定义时间查询规则
    'time_query_rule' => [],

    // 自动写入时间戳字段
    // true为自动识别类型 false关闭
    // 字符串则明确指定时间字段类型 支持 int timestamp datetime date
    'auto_timestamp'  => true,

    // 时间字段取出后的默认时间格式
    'datetime_format' => 'Y-m-d H:i:s',

    // 时间字段配置 配置格式：create_time,update_time
    'datetime_field'  => '',

    // 数据库连接配置信息
    'connections'     => [
        'mysql' => [
            // 数据库类型
            'type'            => 'mysql',
            // 服务器地址
            'hostname'        => '{$data['hostname']}',
            // 数据库名
            'database'        => '{$data['database']}',
            // 用户名
            'username'        => '{$data['username']}',
            // 密码
            'password'        => '{$data['password']}',
            // 端口
            'hostport'        => '{$data['hostport']}',
            // 数据库连接参数
            'params'          => [],
            // 数据库编码默认采用utf8mb4
            'charset'         => 'utf8mb4',
            // 数据库表前缀
            'prefix'          => '{$data['prefix']}',

            // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
            'deploy'          => 0,
            // 数据库读写是否分离 主从式有效
            'rw_separate'     => false,
            // 读写分离后 主服务器数量
            'master_num'      => 1,
            // 指定从服务器序号
            'slave_no'        => '',
            // 是否严格检查字段是否存在
            'fields_strict'   => true,
            // 是否需要断线重连
            'break_reconnect' => false,
            // 监听SQL
            'trigger_sql'     => false,
            // 开启字段缓存
            'fields_cache'    => false,
        ],
    ],
];

INFO;
        $root_path = $this->app->getRootPath();
        file_put_contents($root_path.'config/database.php', $code);
        // 判断写入是否成功
        $config = include $root_path.'config/database.php';
        if (empty($config['database']) || $config['database'] != $data['database']) {
            return $this->error('[application/database.php]'.lang('write_err_database'));
            exit;
        }
    }

}

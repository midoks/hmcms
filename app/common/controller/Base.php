<?php
declare (strict_types = 1);

namespace app\common\controller;

use think\App;
use think\exception\ValidateException;
use think\exception\HttpResponseException;
use think\Validate;
use think\response\Json;
use think\response\Redirect;
use think\facade\Config;
use think\facade\View;
use think\Response;


/**
 * 控制器基础类
 */
abstract class Base
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 缓存model
     */
    public $__cacheModel = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    public  function model($name)
    {   
        if (isset($__cacheModel[$name])){
            return $__cacheModel[$name];
        } else{
            $className = "app\common\model\\".$name;
            $instance = $className::getInstance();
            $__cacheModel[$name] = $instance;
            return $instance;
        }
    }

    // 初始化
    protected function initialize()
    {}

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, string|array $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

    public function returnJson($code = 0, $msg = '', $data = []){
         $result = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ];
        return Json()->data($result);
    }

    public function layuiJson($code = 0, $msg = '', $data = [], $count = 1){
         $result = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
            'count'=> $count
        ];
        return Json()->data($result);
    }

    /**
     * 操作成功跳转的快捷方法
     * @access protected
     * @param mixed  $msg    提示信息
     * @param string $url    跳转的 URL 地址
     * @param mixed  $data   返回的数据
     * @param int    $wait   跳转等待时间
     * @param array  $header 发送的 Header 信息
     * @return void
     * @throws HttpResponseException
     */
    protected function success($msg = '', $url = null, $data = '', $wait = 3, array $header = [])
    {
        $type = $this->getResponseType();
        $result = [
            'code' => 0,
            'msg'  => $msg,
            'data' => $data,
            'url'  => $url,
            'wait' => $wait,
        ];

        if ('html' == strtolower($type)) {
            $data = View::fetch(Config::get('app.dispatch_success_tmpl'), $result);
            $response = Response::create($data, $type)->header($header);
            throw new HttpResponseException($response);
        }

        return Json()->data($result);
    }

    /**
     * 操作错误跳转的快捷方法
     * @access protected
     * @param mixed  $msg    提示信息
     * @param string $url    跳转的 URL 地址
     * @param mixed  $data   返回的数据
     * @param int    $wait   跳转等待时间
     * @param array  $header 发送的 Header 信息
     * @return void
     * @throws HttpResponseException
     */
    protected function error($msg = '', $url = null, $data = '', $wait = 3, array $header = [])
    {
        $type = $this->getResponseType();
        $result = [
            'code' => -1,
            'msg'  => $msg,
            'data' => $data,
            'url'  => $url,
            'wait' => $wait,
        ];

        if ('html' == strtolower($type)) {
            $data = View::fetch(Config::get('app.dispatch_error_tmpl'), $result);
            $response = Response::create($data, $type)->header($header);
            throw new HttpResponseException($response);
        }

        return Json()->data($result);
    }

    /**
     * 返回封装后的 API 数据到客户端
     * @access protected
     * @param mixed  $data   要返回的数据
     * @param int    $code   返回的 code
     * @param mixed  $msg    提示信息
     * @param string $type   返回数据格式
     * @param array  $header 发送的 Header 信息
     * @return void
     * @throws HttpResponseException
     */
    protected function result($data, $code = 0, $msg = '', $type = '', array $header = [])
    {
        $result = [
            'code' => $code,
            'msg'  => $msg,
            'time' => $this->request->server('REQUEST_TIME'),
            'data' => $data,
        ];

        return Json()->data($result);
    }

    /**
     * 获取当前的 response 输出类型
     * @access protected
     * @return string
     */
    protected function getResponseType()
    {
        return $this->request->isAjax() ? 'json' : 'html';
    }

    // composer require firebase/php-jwt
    /**
     *  jwt解码
     */
    protected function checkJWT($token)
    {
        if(empty($token)){
            return [false,[]];
        }
        try{
            $jwt_key = 'sdadsfasdfa';
            $data = new \Firebase\JWT\Key($jwt_key, 'HS256');
            $jwt = \Firebase\JWT\JWT::decode($token, $data);
            return [true,$jwt->data];
        }catch (\Exception $e){
            return [false,[]];
        }
    }
    
    /**
     * 创建jwt
     */
    protected function createJWT($data)
    {
        if(empty($data)){
            return false;
        }
        $jwt_key = 'sdadsfasdfa';
        $jwt = \Firebase\JWT\JWT::encode($data, $jwt_key, 'HS256');
        return $jwt;
    }

}

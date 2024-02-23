<?php
declare (strict_types = 1);

namespace app\middleware;

class v3LoginCheck
{

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

    public function returnJson($code = 0, $msg = '', $data = []){
         $result = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ];
        return Json()->data($result);
    }

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

    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $facility = $request->post('facility');
        $deviceid = $request->post('deviceid');
        $timestamp = $request->post('timestamp');

        if (empty($facility) || empty($deviceid) || empty($timestamp)) {
            return $this->returnData(11, '非法请求!');
        }


        $uid = $request->post('user_id');
        $token = $request->post('user_token');

        $m = $this->model('User');

        $row = $m->getDataByID($uid);
        if (!$row){
            return $this->returnData(0, '未登录!');
        }

        $_db_token = md5('mccms_app' . $row['id']  . $row['pass'] . Mc_Encryption_Key);

        if ($_db_token != $token){
            return $this->returnData(0, '未登录!');
        }
        return $next($request);
    }

}

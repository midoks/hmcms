<?php
declare (strict_types = 1);

namespace app\middleware;

class v3
{

    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        // $app_name = $request->post('app_name');

        // if(empty($app_name)){
        //     return $next($request);
        // }


        // $m = \app\common\model\App::getInstance();
        // $app_data = $m->getDataByName($app_name);

        // var_dump($app_data);

        $data = $request->post('data');
        if ($data) {
            $t = decrypt_data($data);
            unset($_POST['data']);
            $_POST = array_merge($_POST, $t);
            $request->withPost($_POST);
        }
        return $next($request);
    }

}

<?php
namespace app\common\logic;


class Tel extends Base {

    private static $instance = NULL;
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function send($tel, $code, $type = ''){

        $m = $this->model('Option');

        $data = $m->getValueByName('sms');

        // var_dump($data);
        $mode = getDefault($data,'mode', 0);

        if ($mode != 1){
            return ['code'=> -1 ,'msg' => '短信发送已经关闭!'];
        }

        $sms_list = [];
        if (isset($data['tx']['mode']) && $data['tx']['mode'] == '1'){
            $sms_list[] = 'tx';
        }

        if (isset($data['hx']['mode']) && $data['hx']['mode'] == '1'){
            $sms_list[] = 'hx';
        }

        if (count($sms_list) == 0){
            return ['code'=> -2 ,'msg' => '没有可用短信渠道!'];
        }

        $dst_sms = '';
        $method = getDefault($data, 'method', 0);
        if ( '0' == $method ){
            $count = count($sms_list);
            $index = mt_rand(0, $count-1);
            $dst_sms = $sms_list[$index];
        }

        if ('' == $dst_sms){
            return ['code'=> -2 ,'msg' => '没有可用短信渠道。'];
        }

        $config = $data[$dst_sms];

        $mapping = [
            'tx' => 'Tencent',
            'hx' => 'Huanxun',
        ];

        $sms_type = $mapping[$dst_sms];
        return send_sms($tel, $code, $type, $sms_type, $config);
    }
}
<?php
namespace app\common\logic;


class Email extends Base {

    private static $instance = NULL;
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function send($title, $content, $to_mail){

        $m = $this->model('Option');

        $data = $m->getValueByName('mail');
        $mode = getDefault($data,'mode', 0);

        if ($mode != 1){
            return ['code'=> 1 ,'msg' => '邮件发送已经关闭!'];
        }

        var_dump($mode);

        var_dump($data);








        var_dump($title, $content, $to_mail);
    }
}
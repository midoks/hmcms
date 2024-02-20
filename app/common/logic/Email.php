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

    public function getTitle($code){
        $m = $this->model('Option');
        $data = $m->getValueByName('mail');

        $tpl = $data['tpl'];

        $code_title = getDefault($tpl,'code_title','验证码');
        $code_title = str_replace('{code}', "$code", $code_title);
        return $code_title;
    }

    public function getContent($code){
        $m = $this->model('Option');
        $data = $m->getValueByName('mail');

        $tpl = $data['tpl'];

        $code_msg = getDefault($tpl,'code_msg','验证码为：{code}，验证码将在5分钟后失效。请及时使用');
        $code_msg = str_replace('{code}', "$code", $code_msg);
        return $code_msg;
    }

    public function send($title, $content, $to_mail){

        $m = $this->model('Option');

        $data = $m->getValueByName('mail');
        $mode = getDefault($data,'mode', 0);

        if ($mode != 1){
            return ['code'=> -1 ,'msg' => '邮件发送已经关闭!'];
        }

        $mail_list = [];
        if (isset($data['master']['mode']) && $data['master']['mode'] == '1'){
            $mail_list[] = $data['master'];
        }

        if (isset($data['backup']['mode']) && $data['backup']['mode'] == '1'){
            $mail_list[] = $data['backup'];
        }

        if (count($mail_list) == 0){
            return ['code'=> -2 ,'msg' => '没有可用邮件资源!'];
        }

        $dst_mail = [];
        $method = getDefault($data, 'method', 0);
        if ($method == 0){
            $count = count($mail_list);
            $index = mt_rand(0, $count-1);
            $dst_mail = $mail_list[$index];
        }
        return send_mail($to_mail, $title, $content, $dst_mail);
    }
}
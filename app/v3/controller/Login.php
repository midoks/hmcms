<?php
declare (strict_types = 1);

namespace app\v3\controller;

class Login extends Base
{

    public function reg(){

        $type = $this->request->post('type');
        $email = $this->request->post('email');
        $tel = $this->request->post('tel');

        $pass = $this->request->post('pass');
        $code = $this->request->post('code');
        $channelCode = $this->request->post('channelCode');
        //邀请码
        $inviteid = $this->request->post('invite') - 10000;
        //设备id
        $deviceid = $this->request->post('deviceid');

        if (empty($pass)) {
            return $this->returnData(0, '请输入登录密码');
        }

        if (empty($code)) {
            return $this->returnData(0, '请输入验证码');
        }

        if ($type == 'email'){
            if (!is_email($email)){
                return $this->returnData(0, '请输入正确的邮件地址');
            }

            //判断手机验证码是否正确
            $row = $this->model('MailCode')->getDataByMail($email);
            if (!$row || $row['code'] != $code) {
                return $this->returnData(0, '邮件验证码错误');
            }

            //判断账号是否存在
            $row = $this->model('User')->getDataByMail($email);
            if ($row) {
                return $this->returnData(0, '该邮件地址已注册');
            }

        if ($type == 'tel') {
            if (!is_tel($tel)){
                return $this->returnData(0, '请输入正确的手机号');
            }

            //判断手机验证码是否正确
            $row = $this->model('TelCode')->getDataByTel($tel);
            if (!$row || $row['code'] != $code) 
                return $this->returnData(0, '手机验证码错误');
            }
            
            //判断账号是否存在
            $row = $this->model('User')->getDataByTel($tel);
            if ($row) {
                return $this->returnData(0, '该手机已注册');
            }
        } else {
            return $this->returnData(0, '请选择有效类型！');
        }

        $optionM = $this->model('Option');

        // 注册
        $add = [];
        $add['addtime'] = time();
        $add['name'] = 'T-' . substr(md5($add['addtime']), 8, -8);
        $add['sid'] = 0;
        $add['vip'] = 0;
        $add['viptime'] = 0;
        $add['channel'] = $channelCode;
        $add['pass'] = md5($pass);

        if ($type == 'email'){
            $add['email'] = $email;
        } else if ($type == 'tel') {
            $add['tel'] = $tel;
        }    
        $add['cion'] = $optionM->getDefault('user','user_reg_cion', 0);

        $user_reg_vid_day = $optionM->getDefault('user','user_reg_vid_day', 0);
        if ($user_reg_vid_day > 0) {
            $add['vip'] = 1;
            $add['viptime'] = time() + 86400 * $user_reg_vid_day;
        }

        $res = $this->model('User')->dataSave($add);
        if (!$res) {
            return $this->returnData(0, '注册失败');
        }

        //输出
        $d = [];
        $d['code'] = 1;
        $d['msg'] = '注册成功';
        $d['uid'] = $res;
        return $this->returnData(1,$d);
    }


    public function mailcode(){
        $email = $this->request->post('email');
        if (!is_email($email)) {
            return $this->returnData(0, '非法邮箱格式');
        }


        $code = rand(111111, 999999);

        $content = '验证码为：{code}，您正在进行验证码操作
验证码将在5分钟后失效。请及时使用。
如果非本人操作请忽略,有任何疑问与我们联系。';

        $content = str_replace('{code}', "$code", $content);
        $arr = array(
            'to_mail' => $email,
            'title' => '51官方-验证码',
            'html' => $content,
        );

        $res = $this->logic('Email')->send('51官方-验证码', $content, $email);

        var_dump($res);

//         $row = $this->mcdb->get_row_arr('mailcode', '*', array('email' => $email));
//         if ($row) {
//             if ($row['addtime'] + 300 > time()) {
//                 get_json_encrypt('操作太频繁', 0);
//             }
//         }

//         $this->load->model('mail');
//         $res = $this->mail->send($arr);
//         if ($res) {
//             get_json_encrypt('邮件发送失败!', -1);
//         } else {

//             if ($row) {
//                 $this->mcdb->get_update('mailcode', $row['id'], array('code' => $tcode, 'addtime' => time()));
//             } else {
//                 $this->mcdb->get_insert('mailcode', array('email' => $email, 'code' => $tcode, 'addtime' => time()));
//             }

//             get_json_encrypt('邮件发送成功...', 1);
//         }
    }
}

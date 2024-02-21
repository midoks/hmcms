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
        $time = strval(time());
        // 注册
        $add = [];
        $add['name'] = 'T-' . substr(md5($time), 8, -8);
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


        $mailcode = $this->model('MailCode');

        $row = $mailcode->field('id,code,update_time')->where('email', $email)->find();
        if ($row){
            $row = $row->toArray();
            $utime = strtotime($row['update_time']);
            // var_dump($utime+300,time());
            if ($utime+300>time()){
                return $this->returnData(0, '操作太频繁!');
            }
        }

        $title = $this->logic('Email')->getTitle($code);
        $content = $this->logic('Email')->getContent($code);
        $res = $this->logic('Email')->send($title, $content, $email);
        if ($res['code'] <= 0){
            return $this->returnData(0, '邮件发送失败!');
        }
    
        if ($row){
            $update = [
                'code'=>$code,
                'update_time'=>date('Y-m-d H:i:s')
            ];
            $mailcode->where('email', $email)->update($update);
        } else{
            $add = [];
            $add['code'] = $code;
            $add['email'] = $email;
            $mailcode->dataSave($add);
        }
        
        return $this->returnData(1, '发送成功!');
    }


    public function telcode(){
        $tel = $this->request->post('tel');
        $op = $this->request->post('op');
        if (!is_tel($tel)) {
            return $this->returnData(0, '手机号码格式错误!');
        }

        $telcode = $this->model('TelCode');
        $row = $telcode->getDataByTel($tel);
        
        if ($op == 'reg') { //注册
            //判断手机是否注册
            if ($row) {
                return $this->returnData(0, '该手机已注册!');
            }
        }

        if ($op == 'pass') { //修改密码
            //判断手机是否注册
            if ($row) {
                return $this->returnData(0, '该手机已注册。');
            }
        }

        //判断发送时间
        if ($row) {
            $utime = strtotime($row['update_time']);
            if ($utime + 300 > time()) {
                return $this->returnData(0, '操作太频繁!');
            }
        }

        //验证码
        $tcode = rand(111111, 999999);
        $res = $this->logic('Tel')->send($tel, $tcode, $op);
        // var_dump($res);
        if ($res['code'] == 1){
            if ($row){
                $update = [
                    'code'=>$code,
                    'update_time'=>date('Y-m-d H:i:s')
                ];
                $telcode->where('tel', $tel)->update($update);
            } else{
                $add = [];
                $add['code'] = $code;
                $add['tel'] = $tel;
                $telcode->dataSave($add);
            }

            return $this->returnData(1, '验证码发送成功!');
        }
        return $this->returnData(0, '发送失败，稍后再试!');
    }
}

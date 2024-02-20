<?php
namespace sms;

class Huanxun {

    public $name = '幻讯短信';
    public $ver = '2.7';
	private $url;
    private $config;

    public function __construct($config = [])
    {
        $this->url = 'https://api.huanxun58.com/sms/Api/Send.do';
        $this->config =  $config;
    }
	
	/**
     * 发送请求
     *
     * @param string $url      请求地址
     * @param array  $dataObj  请求内容
     * @return string 应答json字符串
     */
    public function sendCurlPost($url, $dataObj)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($dataObj));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $ret = curl_exec($curl);
        if (false == $ret) {
            // curl_exec failed
            $result = "result=-2&description=" . curl_error($curl);
        } else {
            $rsp = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if (200 != $rsp) {
				$result = "result=-1&description=" . $rsp
                    . " " . curl_error($curl);
            } else {
                $result = $ret;
            }
        }
        curl_close($curl);
        return $result;
    }
	
	public function sendWithParam($nationCode, $phoneNumber, $code)                              
    {
        $msg = '【傲天网络】您的验证码是'. $code .'，5分钟有效，请尽快验证。';
        if ('' != $this->config['sign']){
            $msg = '【'.$this->config['sign'].'】您的验证码是'. $code .'，5分钟有效，请尽快验证。';
        }
        
        $data = [
			'SpCode' => $this->config['spcode'],
			'LoginName' => $this->config['login_name'],
			'Password' => $this->config['pass'],
			'MessageContent' => $msg,
			'UserNumber' => $phoneNumber
		];
        return $this->sendCurlPost($this->url, $data);
    }

    public function submit($phone, $code, $type)
    {
        if(empty($phone) || empty($code)){
            return ['code'=>101,'msg'=>'参数错误'];
        }

        try {
            $result = $this->sendWithParam("86", $phone, $code);
			parse_str($result, $rsp);
            if($rsp['result'] == 0){
                return ['code'=> 1,'msg' => 'ok' ];
            }
            return ['code'=>-101,'msg'=>$rsp['description']];
        }
        catch(\Exception $e) {
            return ['code'=>-102,'msg'=>'发生异常请重试'];
        }
    }
}

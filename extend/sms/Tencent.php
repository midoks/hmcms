<?php
namespace sms;

class Tencent {

    public $name = '腾讯云短信';
    private $host;
    private $config;

    public function __construct($config = [])
    {
        $this->host = "sms.tencentcloudapi.com";
        $this->config = $config;
    }

    /**
     * 发送请求
     *
     * @param string $url      请求地址
     * @param array  $dataObj  请求内容
     * @return string 应答json字符串
     */
    public function sendCurlPost($url, $header ,$dataObj)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $dataObj);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }


    //腾讯云发送
    public function tencent($tel,$code,$type){
        $tplid = $this->config['tpl_log'];
        if($type == 'pass'){
            $tplid = $this->config['tpl_pass'];
        } else if ( $type == 'reg'){
            $tplid = $this->config['tpl_pass'];
        }

        // 发送短信 单发指定模板
        $random = rand(1111,9999);
        $time = time();

        $secretId = $this->config['secret_id'];
        $secretKey = $this->config['secret_key'];
        $SmsSdkAppId = $this->config['app_id'];
        $SignName = $this->config['sign_name'];

        $host = $this->host;
        $service = "sms";
        $version = "2021-01-11";
        $action = "SendSms";
        $region = "ap-guangzhou";
        $timestamp = $time;
        $algorithm = "TC3-HMAC-SHA256";

        // step 1: build canonical request string
        $httpRequestMethod = "POST";
        $canonicalUri = "/";
        $canonicalQueryString = "";
        $canonicalHeaders = "content-type:application/json; charset=utf-8\n"."host:".$host."\n";
        $signedHeaders = "content-type;host";
        $payloadObj = array(
            "SmsSdkAppId" => $SmsSdkAppId,
            "SignName" => $SignName,
            "TemplateId" => $tplid,
            "TemplateParamSet" => array(strval($code)),
            // "TemplateParamSet" => array(strval($code),'5'),
            "PhoneNumberSet" => array($tel),
            // "SessionContext" => "您正在申请手机注册，验证码为：{1}，{2}分钟内有效！",
        );

        $payload = json_encode($payloadObj);
        $hashedRequestPayload = hash("SHA256", $payload);
        $canonicalRequest = $httpRequestMethod."\n"
                .$canonicalUri."\n"
                .$canonicalQueryString."\n"
                .$canonicalHeaders."\n"
                .$signedHeaders."\n"
                .$hashedRequestPayload;

        // step 2: build string to sign
        $date = gmdate("Y-m-d", $timestamp);
        $credentialScope = $date."/".$service."/tc3_request";
        $hashedCanonicalRequest = hash("SHA256", $canonicalRequest);
        $stringToSign = $algorithm."\n"
            .$timestamp."\n"
            .$credentialScope."\n"
            .$hashedCanonicalRequest;


        // step 3: sign string
        $secretDate = hash_hmac("SHA256", $date, "TC3".$secretKey, true);
        $secretService = hash_hmac("SHA256", $service, $secretDate, true);
        $secretSigning = hash_hmac("SHA256", "tc3_request", $secretService, true);
        $signature = hash_hmac("SHA256", $stringToSign, $secretSigning);

        // step 4: build authorization
        $authorization = $algorithm
            ." Credential=".$secretId."/".$credentialScope
            .", SignedHeaders=content-type;host, Signature=".$signature;

        $url = 'https://'.$host;
        $header = [
            "Authorization: ".$authorization,
            "Content-Type: ".'application/json; charset=utf-8',
            "X-TC-Action: ".$action,
            "X-TC-Timestamp: ".$timestamp,
            "Host: ".$host,
            "X-TC-Version: ".$version,
            "X-TC-Region: ".$region,
        ];
        $json = $this->sendCurlPost($url, $header, $payload);
        $rdata = json_decode($json, true);
        return $rdata;
    }

    public function submit($phone,$code,$type)
    {
        if(empty($phone) || empty($code) || empty($type)){
            return ['code'=>-101,'msg'=>'参数错误'];
        }

        try {
            $result = $this->tencent($phone, $code, $type);
            if (isset($result['Response']['Error'])){
                return ['code'=>-101,'msg'=>$result['Response']['Error']['Message']];
            }

            $rdata = $result['Response']['SendStatusSet'][0];
            if(isset($rdata['Code']) && $rdata['Code'] == 'Ok'){
                return ['code'=>1,'msg'=>'ok'];
            }

            return ['code'=>-101,'msg'=>"未知错误"];
        }
        catch(\Exception $e) {
            return ['code'=>-102,'msg'=>'发生异常请重试'];
        }
    }
}

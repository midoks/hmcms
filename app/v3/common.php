<?php
// 这是系统自动生成的公共文件

// 随机字符串
function get_rndstr($len = 32, $type = 'alpha')
{
    switch ($type) {
        case 'basic':return mt_rand();
            break;
        case 'alnum':
        case 'numeric':
        case 'nozero':
        case 'alpha':
            switch ($type) {
                case 'alpha':$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
                case 'alnum':$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
                case 'numeric':$pool = '0123456789';
                    break;
                case 'nozero':$pool = '123456789';
                    break;
            }
            $str = '';
            for ($i = 0; $i < $len; $i++) {
                $str .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
            }
            return $str;
            break;
        case 'unique':
        case 'md5':
            return md5(uniqid(mt_rand()));
            break;
    }
}

// AES解密数据
function decrypt_data($str, $key = '')
{
    if (empty($str)) {
        return '';
    }

    $mode = 'aes-128-cfb';
    //兼容python同类算法
    if (isset($_POST['aes_mode']) && $_POST['aes_mode'] == 'python') {
        $mode = 'aes-128-cfb8';
    }

    $len = strlen($str);
    if ($len < 48) {
        $content = substr($str, 0, $len - 32);
        $iv = substr($str, -32);
    } else {
        $content = substr($str, 0, 16) . substr($str, 48);
        $iv = substr($str, 16, 32);
    }
    $content = @hex2bin($content);
    $iv = @hex2bin($iv);
    $key = !empty($key) ? $key : 'WB0nMZHXlxNndORe';
    $data = openssl_decrypt($content, $mode, $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv);
    $str = json_decode($data, true);
    return !empty($str) ? $str : $data;
}


// AES加密数据
function encrypt_data($data, $key = '')
{
    if (empty($data)) {
        return '';
    }

    $mode = 'aes-128-cfb';
    //兼容python同类算法
    if (isset($_POST['aes_mode']) && $_POST['aes_mode'] == 'python') {
        $mode = 'aes-128-cfb8';
    }

    if (is_array($data)) {
        $data = json_encode($data);
    }
    $key = !empty($key) ? $key : 'WB0nMZHXlxNndORe';
    $iv = get_rndstr(16, 'alnum');
    $data = openssl_encrypt($data, $mode, $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv);
    $data = bin2hex($data);
    $str = substr($data, 0, 16) . bin2hex($iv) . substr($data, 16);
    return $str;
}


//判断email格式是否正确
function is_email($email) {
    return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}
//判断手机号码格式是否正确
function is_tel($tel) {
    return preg_match("/^1[3456789]\d{9}$/", $tel);
}

function getDefault($data, $key, $def = ''){
    if (empty($data)){
        return $def;
    }

    if (!isset($data[$key])){
        return $def;
    }
    return $data[$key];
}

<?php
// 应用公共文件

define('HMCMS_DIR', '');
// 全局静态目录
define('HMCMS_STATIC', HMCMS_DIR . '/static');

// escape加密字符串
function hm_str_escape($string, $in_encoding='UTF-8',$out_encoding='UCS-2')
{
    $return = '';
    if (function_exists('mb_get_info')) {
        $strs = preg_split('/(?<!^)(?!$)/u', $string);
        foreach ($strs as $str) {
            if (strlen ( $str ) > 1) {
                $return .= '%u' . strtoupper ( bin2hex ( mb_convert_encoding ( $str, $out_encoding, $in_encoding ) ) );
            } else {
                $return .= '%' . strtoupper ( bin2hex ( $str ) );
            }
        }
    }
    return $return;
}

// escape解密字符串
function hm_str_unescape($str)
{
    $ret = '';
    $len = strlen($str);
    for ($i = 0; $i < $len; $i ++)
    {
        if ($str[$i] == '%' && $str[$i + 1] == 'u')
        {
            $val = hexdec(substr($str, $i + 2, 4));
            if ($val < 0x7f){
                $ret .= chr($val);
            }else{
                if ($val < 0x800){
                    $ret .= chr(0xc0 | ($val >> 6)) .
                        chr(0x80 | ($val & 0x3f));
                } else{
                    $ret .= chr(0xe0 | ($val >> 12)) .
                        chr(0x80 | (($val >> 6) & 0x3f)) .
                        chr(0x80 | ($val & 0x3f));
                }
            } 
            $i += 5;
        } else{
           if ($str[$i] == '%')
            {
                $ret .= urldecode(substr($str, $i, 3));
                $i += 2;
            } else{
                $ret .= $str[$i];
            } 
        }
            
    }
    return $ret;
}

function hm_parse_sql($sql='',$limit=0,$prefix=[])
{
    // 被替换的前缀
    $from = '';
    // 要替换的前缀
    $to = '';

    // 替换表前缀
    if (!empty($prefix)) {
        $to   = current($prefix);
        $from = current(array_flip($prefix));
    }

    if ($sql != '') {
        // 纯sql内容
        $pure_sql = [];

        // 多行注释标记
        $comment = false;

        // 按行分割，兼容多个平台
        $sql = str_replace(["\r\n", "\r"], "\n", $sql);
        $sql = explode("\n", trim($sql));
        $cnm = base64_decode('YeeJiOadg+aJgOaciW1hZ2ljYmxhY2vvvIzmupDnoIFodHRwczovL2dpdGh1Yi5jb20vbWFnaWNibGFjaw==');
        // 循环处理每一行
        foreach ($sql as $key => $line) {
            // 跳过空行
            if ($line == '') {
                continue;
            }

            // 跳过以#或者--开头的单行注释
            if (preg_match("/^(#|--)/", $line)) {
                continue;
            }

            // 跳过以/**/包裹起来的单行注释
            if (preg_match("/^\/\*(.*?)\*\//", $line)) {
                continue;
            }

            // 多行注释开始
            if (substr($line, 0, 2) == '/*') {
                $comment = true;
                continue;
            }

            // 多行注释结束
            if (substr($line, -2) == '*/') {
                $comment = false;
                continue;
            }

            // 多行注释没有结束，继续跳过
            if ($comment) {
                continue;
            }

            // 替换表前缀
            if ($from != '') {
                $line = str_replace('`'.$from, '`'.$to, $line);
            }
            if ($line == 'BEGIN;' || $line =='COMMIT;') {
                continue;
            }
            // sql语句
            array_push($pure_sql, $line);
        }

        // 只返回一条语句
        if ($limit == 1) {
            return implode("",$pure_sql);
        }


        // 以数组形式返回sql语句
        $pure_sql = implode("\n",$pure_sql);
        $pure_sql = explode(";\n", $pure_sql);
        return $pure_sql;
    } else {
        return $limit == 1 ? '' : [];
    }
}

function hm_mkdirss($path,$mode=0777)
{
    if (!is_dir(dirname($path))){
        hm_mkdirss(dirname($path));
    }
    if(!file_exists($path)){
        return mkdir($path,$mode);
    }
    return true;
}

function hm_write_file($f,$c='')
{
    $dir = dirname($f);
    if(!is_dir($dir)){
        hm_mkdirss($dir);
    }
    return @file_put_contents($f, $c);
}


function hm_arr2file($f,$arr='')
{
    if(is_array($arr)){
        $con = var_export($arr,true);
    } else{
        $con = $arr;
    }
    $con = "<?php\nreturn $con;";
    hm_write_file($f, $con);
    // opcache清理以实时生效配置
    if (function_exists('opcache_invalidate')) {
        opcache_invalidate($f, true);
    }
}

function hm_get_rndstr($length=32,$f='')
{
    $pattern = "234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if($f=='num'){
        $pattern = '1234567890';
    }
    elseif($f=='letter'){
        $pattern = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }
    $len = strlen($pattern) -1;
    $res='';
    for($i=0; $i<$length; $i++){
        $res .= $pattern[mt_rand(0,$len)];
    }
    // 开头为0的随机替换为1~9，优化导出格式问题
    if (str_starts_with($res, '0')) {
        $res = mt_rand(1, 9) . substr($res, 1);
    }
    return $res;
}


function hm_substring($str, $lenth, $start=0)
{
    $len = strlen($str);
    $r = array();
    $n = 0;
    $m = 0;

    for($i=0;$i<$len;$i++){
        $x = substr($str, $i, 1);
        $a = base_convert(ord($x), 10, 2);
        $a = substr( '00000000 '.$a, -8);

        if ($n < $start){
            if (substr($a, 0, 1) == 0) {
            }
            else if (substr($a, 0, 3) == 110) {
                $i += 1;
            }
            else if (substr($a, 0, 4) == 1110) {
                $i += 2;
            }
            $n++;
        }
        else{
            if (substr($a, 0, 1) == 0) {
                $r[] = substr($str, $i, 1);
            }else if (substr($a, 0, 3) == 110) {
                $r[] = substr($str, $i, 2);
                $i += 1;
            }else if (substr($a, 0, 4) == 1110) {
                $r[] = substr($str, $i, 3);
                $i += 2;
            }else{
                $r[] = ' ';
            }
            if (++$m >= $lenth){
                break;
            }
        }
    }
    return  join('',$r);
}

function encodeImage($imgsrc, $newsrc, $xor_num = '136'){
    $img = file_get_contents($imgsrc);
    $imgData = str_split($img);
    $binData = '';
    foreach ($imgData as $value) {
        $value = hexdec(bin2hex($value)) ^ $xor_num;
        $value = dechex($value);
        if (strlen($value) % 2) {
            $binData .= pack('h*', $value);
        } else {
            $binData .= hex2bin($value);
        }
    }
    file_put_contents($newsrc, $binData);
}

//真实密码隐藏
function hm_hidden_pass($pass, $len = 2, $x = 6)
{
    if (empty($pass)) {
        return '';
    }

    $xh = '';
    for ($i = 0; $i < $x; $i++) {
        $xh .= '*';
    }

    return substr($pass, 0, $len) . $xh . substr($pass, -$len);
}

/**
 *  多位字段排序
 *  @param &$array 数组
 *  @param $field 字段
 *  @param $desc 排序
 */
function sortArrByField(&$array, $field, $desc = false)
{
    $fieldArr = array();
    foreach ($array as $k => $v) {
        $fieldArr[$k] = $v[$field];
    }
    $sort = $desc == false ? SORT_ASC : SORT_DESC;
    array_multisort($fieldArr, $sort, $array);
}


function toPinyin($name){
    $ext_pinyin = '\\pinyin\\Pinyin';
    $ext_pinyin_m = new $ext_pinyin;
    $t = $ext_pinyin_m->send($name);
    return $t;
}

// 发送邮箱
function send_mail($to, $title, $body, $conf=[])
{
    $pattern = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
    if (!preg_match($pattern, $to)) {
        return ['code'=>0, 'msg'=>'邮箱地址不合法~!'];
    }
    if (empty($title)) {
        return ['code'=>0, 'msg'=>'邮件标题不能为空~!'];
    }
    if (empty($body)) {
        return ['code'=>0, 'msg'=>'邮件内容不能为空~!'];
    }
    $cp = '\\email\\Phpmailer';
    if (class_exists($cp)) {
        $c = new $cp;
        return $c->submit($to, $title, $body, $conf);
    } else {
        return ['code'=>0, 'msg'=>'暂不支持邮箱功能~!'];
    }
}

// 发送短信
function send_sms($to, $code, $type_flag, $type_des, $msg)
{
    if (empty($GLOBALS['config']['sms']['type'])) {
        return ['code'=>0, 'msg'=>'暂不支持短信功能~!'];
    }
    $pattern = "/^1[345789][0-9]{9}$/";
    if (!preg_match($pattern, $to)) {
        return ['code'=>0, 'msg'=>'手机号码不合法~!'];
    }
    if (empty($code)) {
        return ['code'=>0, 'msg'=>'发送验证码不能为空~!'];
    }
    if (empty($type_flag)) {
        return ['code'=>0, 'msg'=>'发送样式不能为空~!'];
    }
    $cp = '\\sms\\' . ucfirst($GLOBALS['config']['sms']['type']);
    if (class_exists($cp)) {
        $c = new $cp;
        return $c->submit($to, $code, $type_flag, $type_des, $msg);
    } else {
        return ['code'=>0, 'msg'=>'暂不支持短信功能~!'];
    }
}


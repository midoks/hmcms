<?php

namespace app\common\model;

use think\Db;


//配置模型
class Option extends Base {

	protected $name = 'option';
	protected $pk = 'id';

	// 开启自动写入时间戳字段
	protected $autoWriteTimestamp = true;


	private static $instance = NULL;
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getDefault($name, $key, $def = ''){
        $data = $this->getValueByName($name);
        if (empty($data)){
            return $def;
        }

        if (!isset($data[$key])){
            return $def;
        }
        return $data[$key];
    }

    // 基本方式
    public function getValueByName($name){

        $key = $this->cacheKey('name|'.$name);
        $data = $this->cacheGet($key);
        if ($data){
            return $data;
        }


    	$m = $this->field('value');
    	$one = $m->where('name', $name)->find();

    	if ($one){
    		$one = $one->toArray();
    	}

    	if(empty($one)){
    		return [];
    	}

    	$data = json_decode($one['value'], true);
        $this->cacheSet($key, $data);
        return $data;
    }

    public function setValueByName($data, $name){

    	$m = $this->field('id');
    	$one = $m->where('name', $name)->find();
    	if ($one){
    		$one = $one->toArray();
    	}

        $key = $this->cacheKey('name|'.$name);
        $this->cacheDelete($key);

    	if(!empty($one)){
    		$update_time = date('Y-m-d H:i:s');
    		return $this->where('name', $name)->update(['value'=>$data,'update_time'=>$update_time]);
    	} else {
    		return $this->dataSave(['value'=>$data,'name'=>$name]);
    	}
    }

}
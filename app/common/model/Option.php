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

    public function getValueByName($name){
    	$m = $this->field('value');
    	$one = $m->where('name', $name)->find();

    	if ($one){
    		$one = $one->toArray();
    	}

    	if(empty($one)){
    		return json_encode([]);
    	}

    	return $one['value'];
    }

    public function setValueByName($data, $name){

    	$m = $this->field('id');

    	$one = $m->where('name', $name)->find();
    	if ($one){
    		$one = $one->toArray();
    	}

    	if(!empty($one)){
    		$update_time = date('Y-m-d H:i:s');
    		return $this->where('name', $name)->update(['value'=>$data,'update_time'=>$update_time]);
    	} else {
    		return $this->dataSave(['value'=>$data,'name'=>$name]);
    	}
    	// return $m->where('name', $name)->update(['value'=>$data]);
    }

}
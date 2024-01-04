<?php

namespace app\common\model;

use think\Db;

class Comic extends Base {

	// protected $table = 'hm_comic';

	protected $name = 'comic';
	protected $pk = 'id';


	private static $instance = NULL;
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
	public function list(){
	}


	public function getDataByIds($ids = []){
		$data = $this->field(true)->whereIn('id', $ids)->select();
		if ($data){
			return $data->toArray();
		}
		return [];
	}

	public function getDataByID($id){
		$data = $this->field(true)->where('id', $id)->find();
		if ($data){
			return $data->toArray();
		}
		return [];
	}


}
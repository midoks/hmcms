<?php

namespace app\common\model;

use think\Db;

class Comic extends Base {

	// protected $table = 'hm_comic';

	protected $name = 'comic';
	protected $pk = 'id';


	public function list(){
	}


	public function getDataByIds($ids = []){
		$data = $this->field(true)->whereIn('id', $ids)->select();
		if ($data){
			return $data->toArray();
		}
		return [];
	}


}
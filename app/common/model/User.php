<?php

namespace app\common\model;

use think\Db;

class User extends Base {

	protected $name = 'user';
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
    
	 public function list($page=1, $size=10, $wh = []) {
		$list = $this->field('id')->order('id', 'desc')->paginate(['page'=>$page,'list_rows'=>$size]);
		if ($list){
			$list = $list->toArray();
		}
		return $list;
	}


}
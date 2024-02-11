<?php

namespace app\common\model;

use think\Db;

class User extends Base {

	// protected $table = 'hm_comic';

	protected $name = 'user';
	protected $pk = 'id';


	private static $instance = NULL;
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
	 public function list($page=1, $size=10) {
		$list = $this->field('id')->order('id', 'desc')->paginate(['page'=>$page,'list_rows'=>$size]);
		if ($list){
			$list = $list->toArray();
		}
		return $list;
	}


}
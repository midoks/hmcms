<?php

namespace app\common\model;
use think\Db;
use think\helper\Str;

class AdminMenu extends Base {

	protected $name = 'admin_menu';
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


	public function list() {
		$list = $this->where('level', '1')->select();
		if ($list){
			$list = $list->toArray();
		}
		return $list;
	}


}
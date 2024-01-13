<?php

namespace app\common\model;
use think\Db;
use think\helper\Str;

class AdminRole extends Base {

	protected $name = 'admin_role';
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
		$list = $this->where('status', '1')->order('id', 'desc')->paginate(['page'=>1,'list_rows'=>10]);
		if ($list){
			$list = $list->toArray();
		}
		return $list;
	}



}
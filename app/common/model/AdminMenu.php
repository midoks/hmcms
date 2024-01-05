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

   	public function submenu($pid, $recursion = false){
   		$list = $this->where('pid', $pid)->select();
   		if ($list){
			$list = $list->toArray();
		}


		if (!empty($list) && $recursion){
			foreach ($list as $key => $value) {
				$list[$key]['submenu'] = $this->submenu($value['id']);
			}
		}
		return $list;
   	}

	public function list() {
		$list = $this->where('pid', '0')->select();
		if ($list){
			$list = $list->toArray();
		}

		foreach ($list as $key => $value) {
			$list[$key]['submenu'] = $this->submenu($value['id'], true);
		}
		// var_dump($list);
		return $list;
	}


}
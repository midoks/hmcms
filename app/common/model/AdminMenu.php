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

   	public function submenu($pid, $recursion = false, $wh = [] ){
   		$m = $this->where('pid', $pid);

   		if (isset($wh['status'])){
   			$m->where('status', $wh['status']);
   		}

   		if (isset($wh['display'])){
   			$m->where('display', $wh['display']);
   		}

   		$list = $m->order('sort')->select();
   		if ($list){
			$list = $list->toArray();
		}

		if (!empty($list) && $recursion){
			foreach ($list as $key => $value) {
				$list[$key]['submenu'] = $this->submenu($value['id'], $recursion, $wh);
			}
		}
		return $list;
   	}

   	// 只递归一次
   	public function submenu2($pid, $recursion = false){
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

   	//递归删除菜单及下级
   	public function recursionDelete($id){
   		$list = $this->where('pid', $id)->select();
   		if ($list){
			$list = $list->toArray();
		}

		if (!empty($list)){
			foreach ($list as $k => $v) {
				$this->recursionDelete($v['id']);
			}
			return $this->where('id', $id)->delete($id);
		} else{
			return $this->where('id', $id)->delete();
		}
		return true;
   	}

	public function list() {
		$list = $this->where('pid', '0')->order('sort')->select();
		if ($list){
			$list = $list->toArray();
		}

		foreach ($list as $key => $value) {
			$list[$key]['submenu'] = $this->submenu($value['id'], true);
		}
		return $list;
	}


}
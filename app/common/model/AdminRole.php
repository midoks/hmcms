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

	public function listAll($page=1, $size=100, $wh = []) {
		$m = $this->field('id');

		$list = $m->order('id', 'asc')->paginate(['page'=>$page,'list_rows'=>$size]);

		if ($list){
			$list = $list->toArray();
		}
		$ids = $this->getFieldList($list['data'],'id');
		return $this->getDataByIds($ids);
	}

	public function list($page=1, $size=10, $wh = []) {
		$m = $this->field('id');

		$list = $m->order('id', 'asc')->paginate(['page'=>$page,'list_rows'=>$size]);

		if ($list){
			$list = $list->toArray();
		}
		$ids = $this->getFieldList($list['data'],'id');
		$ids_data = $this->getDataByIds($ids);
		$list['data'] = $ids_data;
		return $list;
	}



}
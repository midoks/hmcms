<?php

namespace app\common\model;

use think\Db;

class Order extends Base {

	protected $name = 'order';
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
		$m = $this->field('id');

		if (!empty($wh['zd']) && !empty($wh['key'])) {
		 	$zd = $wh['zd'];
		 	$key = $wh['key'];
		 	if ($zd == 'text') {
                $m->where($zd, 'like', $key);
            } else {
                $m->where($zd, $key);
            }
        }

        if (!empty($wh['pid'])) {
            $m->where('pid', $wh['pid']);
        }

		if (!empty($wh['kstime'])) {
            $m->whereTime('create_time', '>=', $wh['kstime']);
        }
        if (!empty($wh['jstime'])) {
        	$m->whereTime('create_time', '<=', $wh['jstime']);
        }

        $sum_rmb = $m->sum('rmb');

		$list = $m->order('id', 'desc')->paginate(['page'=>$page,'list_rows'=>$size]);

		if ($list){
			$list = $list->toArray();
		}
		// $ids = $this->getFieldList($list['data'],'id');
		// $ids_data = $this->getDataByIds($ids);
		// $list['data'] = $ids_data;
		$list['sum_rmb'] = $sum_rmb;
		return $list;
	}


}
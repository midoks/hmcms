<?php

namespace app\common\model;
use think\Db;


//用户邀请模型
class UserInvite extends Base {

	protected $name = 'user_invite';
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

		$list = $m->order('id', 'asc')->paginate(['page'=>$page,'list_rows'=>$size]);

		if ($list){
			$list = $list->toArray();
		}
		$ids = $this->getFieldList($list['data'],'id');
		$ids_data = $this->getDataByIds($ids);
		$list['data'] = $ids_data;
		return $list;
	}

	public function dataById($id){
		$data = $this->getDataByID($id);
		return $data;
	}


}
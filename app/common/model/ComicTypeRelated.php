<?php

namespace app\common\model;

use think\Db;

class ComicTypeRelated extends Base {

	protected $name = 'comic_type_related';
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

    //更新漫画的type表记录
    public function setType($mid, $arr_input_val = []){
    	if (!empty($arr_input_val)){
    		$new_id = [];
    		foreach ($arr_input_val as $zd => $v) {
    			foreach ($v as $_id) {
    				$row = $this->field('id')->where('tid', $_id)->where('mid', $mid)->find();
    				if (!$row){
    					$new_id[] = $this->dataSave(['tid'=>$_id, 'mid'=>$mid]);
    				} else {
    					$new_id[] = $row['id'];
    				}
    			}
    		}

    		//先获取去原有的记录
    		$list = $this->field('id')->where('mid', $mid)->limit(10000)->select();
    		if ($list){
				$list = $list->toArray();
			}

			//删除不需要的
			foreach ($list as $row) {
				if (!in_array($row['id'], $new_id)){
					$this->dataDelete($row['id']);
				}
			}
			return true;
    	}
    }

	public function list($page=1, $size=10, $wh = []) {
		$m = $this->field('id');

		$list = $m->order('sort','asc')->paginate(['page'=>$page,'list_rows'=>$size]);
		if ($list){
			$list = $list->toArray();
		}
		$ids = $this->getFieldList($list['data'],'id');
		$ids_data = $this->getDataByIds($ids);
		$list['data'] = $ids_data;
		return $list;
	}


}
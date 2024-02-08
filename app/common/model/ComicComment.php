<?php

namespace app\common\model;

use think\Db;

class ComicComment extends Base {

	protected $name = 'comic_comment';
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
    
	public function list($page=1, $size=10) {
		$list = $this->field('id')->order('id', 'desc')->paginate(['page'=>$page,'list_rows'=>$size]);
		if ($list){
			$list = $list->toArray();
		}
		$ids = $this->getFieldList($list['data'],'id');
		$ids_data = $this->getDataByIds($ids);
		$list['data'] = $ids_data;
		return $list;
	}

	public function dataSave($data, $id=null){
		if ($id>0){
            return $this->where('id',$id)->save($data);
        } else{
            return $this->save($data);
        }
	}


}
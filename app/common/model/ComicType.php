<?php

namespace app\common\model;

use think\Db;

class ComicType extends Base {

	protected $name = 'comic_type';
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

   	//不含有标签[tag]的数据
   	public function menuList($pid, $limit = 100){
   		$m = $this->field('id');
   		$list = $m->where('pid', $pid)->where('field', '<>', 'tag')->limit($limit)->select();
   		if ($list){
			$list = $list->toArray();
		}

		$ids = $this->getFieldList($list,'id');
		$list = $this->getDataByIds($ids);

		if (empty($list)){
			return $list;
		}

		foreach ($list as $k => $v) {
			$t = $this->menuList($v['id'], $limit);
			$list[$k]['submenu'] = $t;
		}
		return $list;
   	}
    
	public function list($page=1, $size=10, $wh = []) {
		$m = $this->field('id');

		if (isset($wh['pid'])){
			$m->where('pid',$wh['pid']);
		}

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
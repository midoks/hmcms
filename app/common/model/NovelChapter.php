<?php

namespace app\common\model;

use think\Db;

class NovelChapter extends Base {

	protected $name = 'novel_chapter';
	protected $pk = 'id';


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

        if (isset($wh['tid'])) {
            $m->where('tid', $wh['tid']);
        }
 
        if (isset($wh['pay'])) {
            $m->where('pay', $wh['pay']);
        }

		if (!empty($wh['kstime'])) {
            $m->whereTime('create_time', '>=', $wh['kstime']);
        }
        if (!empty($wh['jstime'])) {
        	$m->whereTime('create_time', '<=', $wh['jstime']);
        }

        if (!empty($wh['sort_field']) && !empty($wh['sort_order'])){
            $m->order($wh['sort_field'], $wh['sort_order']);
        } else {
        	$m->order('id', 'desc');
        }

        // $this->debugSQL($m);
		$list = $m->paginate(['page'=>$page,'list_rows'=>$size]);
		if ($list){
			$list = $list->toArray();
		}

		$ids = $this->getFieldList($list['data'],'id');
		$ids_data = $this->getDataByIds($ids);
		$list['data'] = $ids_data;
		return $list;
	}


}
<?php

namespace app\common\model;

use think\Db;

// 漫画章节
class ComicChapter extends Base {

	protected $name = 'comic_chapter';
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

        if (isset($wh['yid'])) {
        	$m->where('yid', $wh['yid']);
        }

        if (isset($wh['pay'])) {
        	$pay = $wh['pay'];
        	if ($pay > 0) {
	            if ($pay == 3) {
	                $m->where('cion', '>', 0);
	            } elseif ($pay == 2) {
	                $m->where('vip', 1);
	            } elseif ($pay == 1) {
	                $m->where('vip', 0)->where('cion',0);
	            }
	        }
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
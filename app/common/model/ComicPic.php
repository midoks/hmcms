<?php

namespace app\common\model;

use think\Db;


// 漫画章节图片
class ComicPic extends Base {

	protected $name = 'comic_pic';
	protected $pk = 'id';

	private static $instance = NULL;
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function dataListByCid($cid = '')
    {
    	$m = $this->field('id');
    	$list = $m->where('cid', $cid)->order('xid', 'asc')->limit(10000)->select();
    	if ($list){
			$list = $list->toArray();
		}

		$ids = $this->getFieldList($list,'id');
		$list = $this->getDataByIds($ids);
    	return $list;
    }

    public function dataAdd($pic_path, $cid){
    	$row = $this->field('xid')->where('cid', $cid)->order('xid', 'desc')->find();

    	// var_dump($row);
    	$xid = $row ? $row['xid'] + 1 : 0;

    	$add = [];
    	$add['cid'] = $cid;
    	// $add['mid'] = $mid;
    	$add['img'] = $pic_path;
    	$add['xid'] = $xid;

    	return $this->dataSave($add);
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

		$list = $m->order('id', 'desc')->paginate(['page'=>$page,'list_rows'=>$size]);
		if ($list){
			$list = $list->toArray();
		}

		$ids = $this->getFieldList($list['data'],'id');
		$ids_data = $this->getDataByIds($ids);
		$list['data'] = $ids_data;
		return $list;
	}


}
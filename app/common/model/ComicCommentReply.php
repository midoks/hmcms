<?php

namespace app\common\model;

use think\Db;

class ComicCommentReply extends Base {

	protected $name = 'comic_comment_reply';
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
		 	if ($zd == 'text' || $zd == 'ip') {
                $m->where($zd, 'like', $key);
            } else if ($zd == 'mid' || $zd == 'uid') {
                $m->where($zd, $key);
            }
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

	public function dataDelete($id){
		if ($id < 1){
			return false;
		}
		return $this->where('id',$id)->delete();
	}

	public function dataSave($data, $id=null){
		if ( $id > 0 ){
            return $this->where('id',$id)->save($data);
        } else{
            return $this->save($data);
        }
	}


}
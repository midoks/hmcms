<?php

namespace app\common\model;

use think\Db;

class Message extends Base {

	protected $name = 'message';
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
            } else if ( $zd == 'uid') {
                $m->where($zd, $key);
            }
        }

        if (!empty($wh['name'])) {
            $m->where('name', $wh['name']);
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

	public function send($uid, $text, $name = '系统消息'){
		$data = [];
		$data['uid'] = $uid;
		$data['name'] = $name;
		$data['text'] = $text;
		return $this->dataSave($data);
	}

	//根据条件统计总数
	public function dataCount($wh = []){
		// var_dump($wh);
		$m = $this->field('id');
		if (isset($wh['uid'])){
			$m->where('uid', $wh['uid']);
		}

		if (isset($wh['did'])){
			$m->where('did', $wh['did']);
		}
		return $m->count();;
	}


	public function dataListPos($pos = 0, $wh = [], $size = 10, $order = ['id'=>'desc']){

		$m = $this->field('id');

		if (isset($wh['uid'])){
			$m->where('uid', $wh['uid']);
		}

		if (isset($wh['did'])){
			$m->where('did', $wh['did']);
		}

		if (!empty($order)){
			$m->order($order);
		}

		$data = $m->limit($size)->select();
		if ($data){
			$data = $data->toArray();
		}

		$ids = $this->getFieldList($data,'id');
		$data = $this->getDataByIds($ids);
		return $data;
	}





}
<?php

namespace app\common\model;

use think\Db;

class User extends Base {

	protected $name = 'user';
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

    public function getDataByTel($tel){
    	$m = $this->field('id');
    	$row = $m->where('tel', $tel)->find();
    	if ($row){
    		$row = $row->toArray();
    	}
    	return $row;
    }

    public function getDataByMail($email){
    	$m = $this->field('id');
    	$row = $m->where('email', $email)->find();
    	if ($row){
    		$row = $row->toArray();
    	}
    	return $row;
    }
    
	public function list($page=1, $size=10, $wh = []) {
		$m = $this->field('id');

		if (!empty($wh['zd']) && !empty($wh['key'])) {
		 	$zd = $wh['zd'];
		 	$key = $wh['key'];
		 	
            $m->where($zd, $key);
        }

        if (isset($wh['sid'])) {
            $m->where('sid', $wh['sid']);
        }

		if (!empty($wh['kstime'])) {
            $m->whereTime('addtime', '>=', strtotime($wh['kstime']));
        }
        if (!empty($wh['jstime'])) {
        	$m->whereTime('addtime', '<=', strtotime($wh['jstime']));
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

	public function verifyLogin($username, $password){
		$udata = $this->where('username', $username)->find();
		if ($udata){
			$data = $udata->toArray();
			$verfiy_pwd = md5($password.'|'.$data['random']);
			if ($verfiy_pwd == $data['password']){
				return ['status' => true, 'data'=>$udata];
			}
		}
		return ['status' => false, 'data'=>[]];
	}


}
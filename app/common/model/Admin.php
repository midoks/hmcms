<?php


namespace app\common\model;
use think\Db;
use think\helper\Str;

class Admin extends Base {

	// protected $table = 'hm_admin';

	protected $name = 'admin';
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
    
    public function list($page=1, $size=10, $wh=[]) {
    	$m = $this->field('id');
		$list = $m->order('id', 'asc')->paginate(['page'=>$page,'list_rows'=>$size]);

		if ($list){
			$list = $list->toArray();
		}
		$ids = $this->getFieldList($list['data'],'id');
		$ids_data = $this->getDataByIds($ids);
		$list['data'] = $ids_data;
		return $list;
		return $list;
	}
	

	public function getRootData($id){
		
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

	//仅在安装时使用
	public function setRootData($username, $password){
		// 生成包含大小写字母和数字的随机字符串
		$random = Str::random(4);
		$db_password = md5($password.'|'.$random);
		$data = [
			'username' => $username,
			'password' => $db_password,
			'status' => 1,
			'random' => $random,
			'role_id' => '0',
		];
		$id = $this->save($data);
		return $id;
	}


}
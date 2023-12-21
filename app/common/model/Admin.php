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


	public function getRootData($id){
		
	}

	public function userLog(){
		
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
			'auth' => '',
		];
		$id = $this->save($data);
		return $id;
	}


}
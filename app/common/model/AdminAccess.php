<?php
namespace app\common\model;

use think\Db;

class AdminAccess extends Base {

	protected $name = 'admin_access';

	private static $instance = NULL;
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

	public function list($role_id) {
		$m = $this->field(true);
		$list = $m->where('role_id', $role_id)->select();
		if ($list){
			$list = $list->toArray();
		}
		return $list;
	}

}
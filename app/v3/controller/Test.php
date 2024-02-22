<?php
declare (strict_types = 1);

namespace app\v3\controller;

use app\common\controller\Base;

class Test extends Base
{

	public function index(){


		$title = $this->logic('Task')->doTaskReward(2,1);
		return '1';
	}
    
}

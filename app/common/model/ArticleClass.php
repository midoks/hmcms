<?php

namespace app\common\model;

use think\Db;

class ArticleClass extends Base {

	protected $name = 'article_class';
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
        if (isset($wh['ttid'])) {
            $m->where('ttid', $wh['ttid']);
        }

        if (isset($wh['pay'])) {
            $m->where('pay', $wh['pay']);
        }

        // if (!empty($wh['kstime'])) {
        //     $m->whereTime('addtime', '>=', strtotime($wh['kstime']));
        // }
        // if (!empty($wh['jstime'])) {
        // 	$m->whereTime('addtime', '<=', strtotime($wh['jstime']));
        // }

		if (!empty($wh['kstime'])) {
            $m->whereTime('create_time', '>=', $wh['kstime']);
        }
        if (!empty($wh['jstime'])) {
        	$m->whereTime('create_time', '<', $wh['jstime']);
        }

        if (!empty($wh['sort_field']) && !empty($wh['sort_order'])){
            $m->order($wh['sort_field'], $wh['sort_order']);
        } else {
        	$m->order('id', 'desc');
        }

        if (isset($wh['yid'])) {
        	//检测重复名称
        	if ($wh['yid'] == 3) {

        		$gm = $this->field('name');
        		$gm->group('name');
        		$gm->having('count(*)>1');
        		$sql = $gm->buildSql();

        		$m->alias('a');
        		$m->join([$sql=> 'b'], 'b.name = a.name','right');
        	} else {
        		$m->where('yid', $wh['yid']);
        	}
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

    public function tree($pid = 0, $recursion = false, $wh = [], $deep = 0){
        $m = $this->where('pid', $pid);

        if (isset($wh['status'])){
            $m->where('status', $wh['status']);
        }

        if (isset($wh['order'])){
            $m->order($wh['order']);
        } else {
            $m->order('sort asc');
        }

        $list = $m->select();
        if ($list){
            $list = $list->toArray();
        }

        $new_list = [];
        if (!empty($list) && $recursion){
            $deep++;
            foreach ($list as $k => $v) {
                $t = [];
                $t[] = $v;
                $data = $this->tree($v['id'], $recursion, $wh , $deep);
                foreach ($data as $vd) {
                    $vd['name'] = '    ├ '.$vd['name'];
                    $t[] = $vd;
                }
                $new_list = array_merge($new_list,$t);
            }
        }
        
        return $new_list;
    }

    public function pos($pos = 0, $wh = [], $size = 10, $order = ['id'=>'desc']){

        $args = get_defined_vars();
        // var_dump($args);
        $key = http_build_query($args);
        $key = md5($key);

        $m = $this->field('id');

        if (isset($wh['tid'])) {
            $m->where('tid', $wh['tid']);
        }
        if (isset($wh['ttid'])) {
            $m->where('ttid', $wh['ttid']);
        }

        if (isset($wh['pay'])) {
            $m->where('pay', $wh['pay']);
        }

        if (!empty($wh['kstime'])) {
            $m->whereTime('create_time', '>=', $wh['kstime']);
        }
        if (!empty($wh['jstime'])) {
            $m->whereTime('create_time', '<', $wh['jstime']);
        }

        if (!empty($order)){
            $m->order($order);
        }

        $m->limit($size);

        // $this->debugSQL($m);
        $list = $this->cache($key)->findCacheSelect($m);
        $ids = $this->getFieldList($list,'id');
        return $this->getDataByIds($ids);
    }


}
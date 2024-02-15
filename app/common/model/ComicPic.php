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
    	$add['img'] = $pic_path;
    	$add['xid'] = $xid;

    	return $this->dataSave($add);
    }

	//通过章节ID删除
    public function dataDeleteByCid($cid){
    	// 批量硬删除
        $list = $this->dataListByCid($cid);
        foreach ($list as $k => $v) {
            $path = app()->getRootPath().'/upload/'.$v['img'];
            if (file_exists($path)){
                unlink($path);
            }
        }
        return $this->where('cid',$cid)->delete();
    }

    //通过ID删除
    public function dataDeleteById($id){
        // 硬删除
        $row = $this->where('id',$id)->find();
        $path = app()->getRootPath().'/upload/'.$row['img'];
        if (file_exists($path)){
            unlink($path);
        }
        return $this->dataDelete($id);
    }


}
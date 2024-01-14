<?php
namespace app\common\model;

use think\Model;
use think\Db;
use think\Cache;

class Base extends Model {

    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    public function getFieldList($data, $field='id')
    {
        $field_list = [];
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $field_list[] = $value[$field];
            }
        }
        return $field_list;
    }

    public function getDataByIds($ids = []){
        $data = $this->field(true)->whereIn('id', $ids)->select();
        if ($data){
            return $data->toArray();
        }
        return [];
    }

    public function getDataByID($id){
        $data = $this->field(true)->where('id', $id)->find();
        if ($data){
            return $data->toArray();
        }
        return [];
    }
}
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

    public function dataSave($data, $id=null){
        if ( $id > 0 ){
            $status =  $this->where('id',$id)->save($data);
        } else{
            $status = $this->save($data);
        }

        if ($status){
            return $this->id;
        }
        return $status;

    }

    public function dataDelete($id){
        if ($id < 1){
            return false;
        }
        return $this->where('id',$id)->delete();
    }

    public function debugSQL($m){
        $_m = $m;
        $sql = $_m->fetchSql(true)->select();
        var_dump($sql);
        return $m;
    }

    public function  __destruct(){
        // Db::listen(function($sql, $runtime, $master) {
        //     // 进行监听处理
        //     var_dump($sql);
        // });
    }
}
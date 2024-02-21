<?php
namespace app\common\model;

use think\Model;
use think\Db;
use think\facade\Cache;
use think\facade\Config;

class Base extends Model {

    public $cache_prefix = 'hmcms_';

    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    // 缓存相关方法 | start

    //获取缓存key
    public function cacheKey($name){
        $prefix = $this->cache_prefix;
        $prefix = Config::get('cache.prefix', $prefix);
        if ($this->table){
            return $prefix.'|'.$this->table.'|'.$name;
        }
        return $prefix.'|'.$this->name.'|'.$name;
    }

    public function cacheGet($key){
        $use_redis = Config::get('cache.use_redis',false);
        if (!$use_redis){
            return false;
        }

        // var_dump(Cache::store('master'));
        return Cache::store('slave')->get($key);
    }

    public function cacheSet($key, $data, $time = 3600){
        $use_redis = Config::get('cache.use_redis',false);
        // var_dump($use_redis);
        if (!$use_redis){
            return false;
        }

        // var_dump($key,$data);
        $r = Cache::store('master')->set($key, $data, $time);
        // var_dump($r);
        return $r;
    }

    public function cacheDelete($key){
        $use_redis = Config::get('cache.use_redis',false);
        if (!$use_redis){
            return false;
        }
        return Cache::store('master')->delete($key);
    }


    protected function cacheDeleteByID($id){
        $key = $this->cacheKey('id|'.$id);
        return $this->cacheDelete($key); 
    }
    // 缓存相关方法 | end

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
        $data = [];
        foreach ($ids as $id) {
            $data[] = $this->getDataByID($id);
        }
        return $data;
    }

    // public function getDataByIds($ids = []){
    //     $data = $this->field(true)->whereIn('id', $ids)->select();
    //     if ($data){
    //         return $data->toArray();
    //     }
    //     return [];
    // }

    public function getDataByID($id){
        $key = $this->cacheKey('id|'.$id);
        $data = $this->cacheGet($key);
        // var_dump($data);
        if ($data){
            return $data;
        }

        $data = $this->field(true)->where('id', $id)->find();
        if ($data){
            $data = $data->toArray();
            $this->cacheSet($key, $data);
            return $data;
        }
        return [];
    }

    public function dataSave($data, $id=null){
        if ($id>0){
            $this->cacheDeleteByID($id);
        }

        if ( $id > 0 ){
            $status =  $this->where('id',$id)->update($data);
            if ($status){
                return $status;
            }
        } else{

            $status = $this->save($data);
            if ($status){
                return $this->id;
            }
        }
        return false;
    }

    public function dataDelete($id = 0){
        if ($id < 1){
            return false;
        }

        $this->cacheDeleteByID($id);
        return $this->where('id',$id)->delete();
    }

    public function dataTriggerField($id, $field_name){
        $row = $this->getDataByID($id);
        $d = $row[$field_name];
        $update_status  = $d > 0 ? 0 : 1;
        $r = $this->dataSave([$field_name=> $update_status ], $id);

        $this->cacheDeleteByID($id);
        return $r;
    }

    public function debugSQL($m){
        $_m = $m;
        $sql = $_m->fetchSql(true)->select();
        var_dump($sql);
        return $m;
    }
}
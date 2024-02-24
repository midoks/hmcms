<?php
namespace app\common\model;

use think\Model;
use think\Db;
use think\facade\Cache;
use think\facade\Config;

class Base extends Model {

    public $cache_prefix = 'hmcms_';
    private $default_cache_time = 3600;

    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    // 缓存相关方法 | start

    private function getTableName(){
        if ($this->table){
            return $this->table;
        }
        return $this->name;
    }

    //获取缓存key
    public function cacheKey($name){
        $prefix = $this->cache_prefix;
        $prefix = Config::get('cache.prefix', $prefix);
        $table_name = $this->getTableName();
        return $prefix.'|'.$table_name.'|'.$name;
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

    public function cacheDeleteByID($id){
        $key = $this->cacheKey('id|'.$id);
        return $this->cacheDelete($key); 
    }

    public function clearTag($tag){
        $use_redis = Config::get('cache.use_redis',false);
        if (!$use_redis){
            return false;
        }
        return Cache::store('master')->clearTag($tag);
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

    public function cacheTag($tag = ''){
        $this->default_cache_tag = $tag;
        return $this;
    }

    public function cache($key='', $time = 3600){
        $this->default_cache_key = $key;
        $this->default_cache_time = $time;
        return $this;
    }

    public function findCacheOne($model){
        $use_redis = Config::get('cache.use_redis',false);
        if (!$use_redis){
            $data = $model->find();
            if ($data){
                $data = $data->toArray();
            }
            return $data;
        }

        $table_name = $this->getTableName();
        $cache_tag = $this->default_cache_tag;

        // $l = Cache::store('slave')->getTagItems($table_name);
        // var_dump($l);

        $default_cache_key = $this->default_cache_key;
        if(empty($default_cache_key)){
            $sql = $model->fetchSql(true)->find();
            $default_cache_key = md5($sql);
        }

        $cache_key = $this->cacheKey($default_cache_key);
        $data = Cache::store('slave')->get($cache_key);
        if ($data){
            return $data;
        }

        $cache_time = $this->default_cache_time;

        $data = $model->find();
        if ($data){
            $data = $data->toArray();
        }

        if (empty($cache_tag)){
            Cache::store('master')->tag($table_name)->set($cache_key,$data,$cache_time);
        } else {
            Cache::store('master')->tag($cache_tag)->set($cache_key,$data,$cache_time);
        }
        return $data;
    }

    public function findCacheSelect($model){
        $use_redis = Config::get('cache.use_redis',false);
        if (!$use_redis){
            $data = $model->select();
            if ($data){
                $data = $data->toArray();
            }
            return $data;
        }

        $table_name = $this->getTableName();
        $cache_tag = $this->default_cache_tag;

        // $l = Cache::store('slave')->getTagItems($table_name);
        // var_dump($l);

        $default_cache_key = $this->default_cache_key;
        if(empty($default_cache_key)){
            $sql = $model->fetchSql(true)->select();
            $default_cache_key = md5($sql);
        }

        $cache_key = $this->cacheKey($default_cache_key);
        $data = Cache::store('slave')->get($cache_key);
        if ($data){
            return $data;
        }

        $cache_time = $this->default_cache_time;

        $data = $model->select();
        if ($data){
            $data = $data->toArray();
        }

        if (empty($cache_tag)){
            Cache::store('master')->tag($table_name)->set($cache_key,$data,$cache_time);
        } else {
            Cache::store('master')->tag($cache_tag)->set($cache_key,$data,$cache_time);
        }
        return $data;
    }

    public function __call($func, $args)
    {

        $func_len = strlen($func);
        $suffix_func = substr($func, $func_len - 6);
        //仅对查询有效[HMCMS]
        if ($suffix_func == '_cache') {
            $cache_time = $this->default_cache_time;
            // var_dump($func, $args);
            $redis_slave = Cache::store('slave')->handler();
            $redis_master = Cache::store('master')->handler();
            // var_dump($redis_master->get());

            $real_func = substr($func, 0, $func_len - 6);

            $key = $func . http_build_query($args);
            $md5_key = md5($key);
            $cache_key = $this->cacheKey($md5_key);
            

            $data = $redis_slave->get($cache_key);
            if ($data) {
                $data = unserialize($data);
                return $data;
            }
            $md5_key_lock = $cache_key.'_lock';

            //防穿透
            if ($redis_master->set($md5_key_lock,1,['nx', 'ex' => 5])) {
                $data = call_user_func_array([$this, $real_func], $args);

                $data = serialize($data);
                $redis_master->set($cache_key, $data, $cache_time);
                $redis_master->del($md5_key_lock);
                return $data;
            } else {
                usleep(50);
                $data = $redis_master->get($cache_key);
                if ($data) {
                    $data = unserialize($data);
                    return $data;
                }
            }
            return false;
        }

        return parent::__call($func, $args);
    }
}
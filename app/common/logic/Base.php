<?php
namespace app\common\logic;


class Base {

    public $__cacheModel = [];
    public  function model($name)
    {   
        if (isset($__cacheModel[$name])){
            return $__cacheModel[$name];
        } else{
            $className = "app\common\model\\".$name;
            $instance = $className::getInstance();
            $__cacheModel[$name] = $instance;
            return $instance;
        }
    }


}
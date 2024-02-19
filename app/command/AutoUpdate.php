<?php
declare (strict_types = 1);

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

// /Applications/mdserver/bin/php/php81/bin/php think autoupdate

class AutoUpdate extends Command
{
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

    protected function configure()
    {
        // 指令配置
        $this->setName('run')
            ->setDescription('the run command');
    }

    protected function execute(Input $input, Output $output)
    {
        //缓存通用数据
        $this->cacheATable($input, $output);

        // 指令输出
        $this->write('全部执行完成',$output);
    }

    public function write($msg,Output $output){
        $output->writeln(date('Y-m-d H:i:s').'|'.$msg);
    }

    public function cacheATable(Input $input, Output $output){
        $output->writeln('缓存通用数据|start');

        $model_list = [
            'Comic','ComicChapter','ComicClass','ComicComment','ComicCommentReply','ComicCommentZan',
            'ComicPic','ComicType', 'ComicTypeRelated',
            'Task'
        ];

        foreach ($model_list as $model_name) {
            $this->write('模型['.$model_name.']开始执行',$output);
            $this->cacheTable($model_name, 0);
            $this->write('模型['.$model_name.']结束执行',$output);
        }
        
        
        // var_dump($data);

        $output->writeln('缓存通用数据|end');
    }

    public function cacheTable($name, $pos = 0){
        $m = $this->model($name);

        $data = $m->field('id')->where('id','>',$pos)->limit(10)->select();
        if ($data){
            $data = $data->toArray();
        }

        foreach ($data as $k => $v) {
            $m->getDataByID($v['id']);
        }

        if (!empty($data)){
            $row = end($data);
            $this->cacheTable($name, $row['id']);
        }
    }
}

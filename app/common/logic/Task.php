<?php
namespace app\common\logic;

use think\facade\Db;

class Task extends Base {

    private static $instance = NULL;
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    //任务奖励
    public function doTaskReward($task_id, $uid){
        $task = $this->model('Task');
        $user = $this->model('User');
        $tasklist = $this->model('TaskList');
        $message = $this->model('Message');

        $udata = $user->getDataById($uid);
        $row = $task->getDataById($task_id);

        //任务无效任务
        if (!$row){
            return false;
        }

        //任务未开启
        if ($row['status'] == 0){
            return false;
        }

        //判断每日任务上限
        if ($row['daynum'] > 0) {
            $start_time = date('Y-m-d 0:0:0');
            $daynums = $tasklist->where('tid', $task_id)->where('uid',$uid)->where('create_time','>=', $start_time)->count();
            if ($daynums >= $row['daynum']) {
                return false;
            }
        }

        Db::startTrans();
        try {
            $day_in_week = date('w');
            //签到要特殊处理
            if ($task_id == 1){   
                $row =$task->where('pid', 1)->where('extra',$day_in_week)->find();
                if ($row){
                    $row = $row->toArray();
                }
            }

            $tasklist->save([
                'uid' => $uid, 
                'tid' => $task_id, 
                'cion' => $row['cion'], 
                'vip' => $row['vip'], 
                'w' => $day_in_week,
            ]);

            //增加用户金币，VIP
            $edit = array();
            if ($row['cion'] > 0) {
                $edit['cion'] = $udata['cion'] + $row['cion'];
            }

            if ($row['vip'] > 0) {
                $edit['vip'] = 1;
                if ($udata['viptime'] > time()) {
                    $edit['viptime'] = $udata['viptime'] + 86400 * $row['vip'];
                } else {
                    $edit['viptime'] = time() + 86400 * $row['vip'];
                }
            }

            if( 2 == $task_id ){
                $msg = '成功邀请1人,奖励VIP天数'.$row['vip'].'天,奖励金币数量'.$row['cion'].'金币';
                $message->send($uid, $msg);
            }

            if (!empty($edit) && $uid != 0 ) {
                $user->dataSave($edit,$uid);
            }

            Db::commit();
            return true;
        } catch (\Exception $ex) {
            // var_dump($ex->getMessage());
            Db::rollback();
            return false;
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: gongruixiang
 * Date: 2020/1/16
 * Time: 10:47
 */

namespace app\schedule\service;
use app\schedule\exception\BusinessException;

use app\schedule\interfaces\ScheduleTaskComponent;
use app\schedule\model\ScheduleTask;
use think\Exception;
use think\facade\Log;

/**
 * 处理任务业务类
 * Class ScheduleTaskService
 * @package app\schedule\service
 */
class ScheduleTaskService
{
    /**
     * 获取一个任务类的实现对象
     * @param $type int 任务的typeId
     * @return ScheduleTaskComponent
     * @throws BusinessException
     */
    public static function getTaskComponent($type){
        //根据配置type获取配置
        $className=config("register.$type");
        if (empty($className)) {
            //如果没有配置，则抛出不再执行的业务异常
            Log::error("配置参数{type}在注册文件中不存在",['type',$type]);
            throw new BusinessException("101","配置参数错误");
        }
        //实例化对象
        return new $className();
    }

    /**
     * 获取一百条任务
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \Exception
     */
    public function get100Task(){
       return ScheduleTask::where("status","in",[2,4])
            ->limit(100)
            ->order("update_time,id","asc")
            ->select();
    }

    /**
     * @title 新增任务方法
     * @param $data ["bus_id"=>1234,"bus_type"=>1,"remark"=>"hhhh","params"=>"{'lll':'hhh'}"]
     * @special bus_id 和bus_type必填
     */
    public function addTask($data){
        ScheduleTask::create($data);
    }


    public function updateTask($id,$status,$remark=''){
        ScheduleTask::update(['status'=>$status,'remark'=>$remark],['id'=>$id]);
    }
}
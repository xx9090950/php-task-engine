<?php
/**
 * Created by PhpStorm.
 * User: gongruixiang
 * Date: 2020/1/16
 * Time: 10:46
 */

namespace app\schedule\impl;


use app\schedule\interfaces\ScheduleTaskComponent;

class SendMessageSchedule implements ScheduleTaskComponent
{
    /**
     * 执行任务
     * @param $data array 从表里出的一条数据
     * @return mixed
     */
    public function run($data)
    {
        echo "假装发送了一条消息".$data['bus_id'].$data['params'].PHP_EOL;
    }
}
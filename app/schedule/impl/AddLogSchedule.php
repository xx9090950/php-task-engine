<?php
/**
 * Created by PhpStorm.
 * User: gongruixiang
 * Date: 2020/1/19
 * Time: 17:56
 */

namespace app\schedule\impl;


use app\schedule\interfaces\ScheduleTaskComponent;

class AddLogSchedule implements ScheduleTaskComponent
{

    /**
     * 执行任务
     * @param $data array 从表里出的一条数据
     * @return mixed
     */
    public function run($data)
    {
        echo "假装写了一条日志".$data['remark'].PHP_EOL;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: gongruixiang
 * Date: 2020/1/16
 * Time: 10:38
 */

namespace app\schedule\interfaces;


interface ScheduleTaskComponent
{
    /**
     * 执行任务
     * @param $data array 从表里出的一条数据
     * @return mixed
     */
    public function run($data);
}
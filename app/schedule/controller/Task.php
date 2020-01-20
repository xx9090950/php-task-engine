<?php
/**
 * Created by PhpStorm.
 * User: gongruixiang
 * Date: 2020/1/19
 * Time: 15:15
 */

namespace app\schedule\controller;


use app\BaseController;
use app\schedule\service\ScheduleTaskService;

class Task extends  BaseController
{

    /**
     * @title 新增任务接口
     */
    public function add()
    {
        $post=$this->request->param();
        //其实需要对入参做判断，这里就先省略
        $service=new ScheduleTaskService();
        $service->addTask($post);
        response("加入成功",200,[],"json");
    }

}
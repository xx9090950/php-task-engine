<?php
declare (strict_types = 1);

namespace app\schedule\command;

use app\schedule\exception\BusinessException;
use app\schedule\service\ScheduleTaskService;
use think\console\Command;
use think\console\Input;


use think\console\Output;
use think\Exception;
use think\facade\Log;

class scheduleStart extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('任务引擎启动')
            ->setDescription('the 任务引擎启动 command');        
    }

    protected function execute(Input $input, Output $output)
    {
    	// 指令输出
    	$output->writeln('任务引擎启动');
        while (true){//死循环
            $service = new ScheduleTaskService();
            //在表里获取状态为未执行、失败重试的100条任务
            $task100 = $service->get100Task();
            foreach ($task100 as $item) {
                $updateId=$item['id'];
                $updateRemark='';
                try {
                    $type = $item['bus_type'];
                    //工厂模式，通过type生产不同的类实例
                    $taskComponent = ScheduleTaskService::getTaskComponent($type);
                    //调用类上的run方法
                    $taskComponent->run($item);
                    $updateStatus=1;
                } catch (BusinessException $be) {//约定的业务异常
                    $updateRemark=$be->getMessage();
                    //如果异常是101就视为失败，不会重复执行
                    if ($be->getCode()=="101") {
                        //报错，不执行
                        $updateStatus=3;
                    }else{
                        //如果不是101就说明，还有的救，改为状态为再执行
                        //报错，再次执行
                        $updateStatus=4;
                    }
                } catch (Exception $e) {//系统异常
                    //系统异常
                    Log::error($e->getMessage());
                    $updateStatus=3;//将执行状态改为失败
                    $updateRemark=$e->getMessage();
                }
                //修改任务状态
                $service->updateTask($updateId,$updateStatus,$updateRemark);
            }
            //打印本次操作了多少条
            Log::info("Command/scheduleStart 任务完成数{num}",['num'=>$task100->count()]);
            //线程挂起60秒
            sleep(60);
        }
    }
}

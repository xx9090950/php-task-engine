<?php
/**
 * Created by PhpStorm.
 * User: gongruixiang
 * Date: 2020/1/16
 * Time: 10:56
 */

namespace app\schedule\exception;


use think\Exception;

class BusinessException extends Exception
{
    private $code;

    private $message;

    /**
     * BusinessException constructor.
     * @param $code
     * @param $message
     */
    public function __construct($code, $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

}
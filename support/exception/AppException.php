<?php
namespace support\exception;

/**
 * 自定义全局应用异常类
 */
class AppException extends \RuntimeException
{
    /**
     * @desc 构造函数
     * @param $message
     * @param $code
     * @author cdyun(121625706@qq.com)
     */
    public function __construct($message, $code = null)
    {
        if ($code === null) {
            $code = getenv('ERROR_CODE') ? (int)getenv('ERROR_CODE') : -1;
        }
        parent::__construct($message, $code);
    }

}
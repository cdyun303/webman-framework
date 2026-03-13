<?php
/**
 * AppHandler.php
 * @author cdyun(121625706@qq.com)
 * @date 2025/9/24 22:41
 */
namespace support\exception;

use Throwable;
use Webman\Exception\ExceptionHandler;
use Webman\Http\Request;
use Webman\Http\Response;

class AppHandler extends ExceptionHandler
{
    public function report(Throwable $exception)
    {
        // 自定义异常类，专门用于终止程序并返回错误信息，不需要记录日志
        if ($exception instanceof AppException || $exception instanceof PageNotFoundException) {
            return;
        }
        if ($this->shouldntReport($exception)) {
            return;
        }
        $logs = '';
        if ($request = \request()) {
            $logs = $request->getRealIp() . ' ' . $request->method() . ' ' . trim($request->fullUrl(), '/');
        }
        $this->logger->error($logs . PHP_EOL . $exception);
    }


    public function render(Request $request, Throwable $exception): Response
    {
        // json_decode()将字符串转成布尔型
        $this->debug = json_decode(config('app.debug'));
        $code = $exception->getCode();
        if ($request->expectsJson() || $request->header('content-type') == 'application/json' || $this->debug) {
            $json = ['code' => $code ?: 500, 'message' => $exception->getMessage()];
            if ($this->debug) {
                $json['traces'] = (string)$exception;
            }
            $errorCode = getenv('ERROR_CODE') ? (int)getenv('ERROR_CODE') : -1;
            $successCode = getenv('SUCCESS_CODE') ? (int)getenv('SUCCESS_CODE') : 0;
            if ($code == $errorCode || $code == $successCode) {
                return new Response(200, ['Content-Type' => 'application/json'],
                    json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                );
            }
            return new Response($code, [], $exception->getMessage());
        }
        $error = 'Server internal error';
        return new Response(500, [], $error);
    }

}
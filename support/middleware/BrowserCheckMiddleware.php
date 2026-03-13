<?php
declare (strict_types=1);

namespace support\middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

/**
 * 浏览器和操作系统类型中间件
 */
class BrowserCheckMiddleware implements MiddlewareInterface
{
    /**
     * @param Request $request
     * @param callable $handler
     * @return Response
     * @author cdyun(121625706@qq.com)
     */
    public function process(Request $request, callable $handler): Response
    {
        $ua = $request->header('user-agent');
        $request->os = os($ua);
        $request->browser = browser($ua);
        return $handler($request);
    }
}

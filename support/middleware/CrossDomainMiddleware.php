<?php

namespace support\middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

class CrossDomainMiddleware implements MiddlewareInterface
{
    /**
     * 处理跨域请求，及接口访问白名单域名
     * @param Request $request
     * @param callable $handler
     * @return Response
     */
    public function process(Request $request, callable $handler): Response
    {
        // 缓存常用 headers
        $origin = $request->header('origin');
        $accessControlRequestMethod = $request->header('access-control-request-method');
        $accessControlRequestHeaders = $request->header('access-control-request-headers');
        $accessControlMaxAge = $request->header('access-control-max-age');

        // 白名单域名
        if (!in_array($origin, config('app.allow_origin', []), true)) {
            return response('', 403);
        }

        // 处理 OPTIONS 预检请求，推荐使用 204 No Content
        if ($request->method() === 'OPTIONS') {
            $response = response('', 204);
        } else {
            $response = $handler($request);
        }

        // 添加 CORS 相关响应头
        $response->withHeaders([
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Origin' => $origin,
            'Access-Control-Max-Age' => $accessControlMaxAge ?? 3600,
            'Access-Control-Allow-Methods' => $accessControlRequestMethod ?? 'GET,POST,OPTIONS',
            'Access-Control-Allow-Headers' => $accessControlRequestHeaders ?? 'Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,Keep-Alive,X-Requested-With,X-Csrf-Token,If-Modified-Since,Cdyun-Encrypt',
            'Vary' => 'Origin',
        ]);

        return $response;
    }
}

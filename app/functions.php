<?php

use Cdyun\WebmanResponse\ResponseEnforcer;
use support\Response;

/**
 * 成功响应
 * @param array|string $msg
 * @param mixed|null $data
 * @return Response
 * @author cdyun(121625706@qq.com)
 */
function success(array|string $msg = '操作成功', mixed $data = null): Response
{
    return ResponseEnforcer::success($msg, $data);
}

/**
 * 失败响应
 * @param array|string $msg
 * @param mixed|null $data
 * @return Response
 * @author cdyun(121625706@qq.com)
 */
function error(array|string $msg = '操作失败', mixed $data = null): Response
{
    return ResponseEnforcer::error($msg, $data);
}

/**
 * 程序终止并返回错误信息
 * @param string $msg
 * @param int|null $code
 * @author cdyun(121625706@qq.com)
 */
function abort(string $msg = '服务器内部错误', ?int $code = null)
{
    ResponseEnforcer::abort($msg, $code);
}

/**
 * MISS页面
 * @param string $url
 * @return Response
 */
function miss(string $url = 'admin/miss/index'): Response
{
    return redirect($url);
}

/**
 * 分页响应
 * @param array $data
 * @param int $totalCount
 * @param string $msg
 * @return Response
 * @author cdyun(121625706@qq.com)
 */
function paginate(array $data = [], int $totalCount = 0, string $msg = '加载完成'): Response
{
    return ResponseEnforcer::paginate($data, $totalCount, $msg);
}

/**
 * 获取IP
 */
function get_ip(): string|null
{
    return request()->getRealIp();
}

/**
 * 获取浏览器类型
 * @param $user_agent
 * @return string
 * @author cdyun(121625706@qq.com)
 */
function browser($user_agent): string
{
    if (empty($user_agent)) {
        return '';
    }

    $browserMap = [
        '/micromessenger/i' => 'WeChat',
        '/alipay/i' => 'Alipay',
        '/MSIE|Trident/i' => 'MSIE',
        '/Firefox/i' => 'Firefox',
        '/Chrome/i' => 'Chrome',
        '/Safari/i' => 'Safari',
        '/Opera|OPR/i' => 'Opera',
    ];

    foreach ($browserMap as $pattern => $name) {
        if (preg_match($pattern, $user_agent)) {
            return $name;
        }
    }

    return 'Other';
}

/**
 * 获取操作系统类型
 * @param $user_agent
 * @return string
 * @author cdyun(121625706@qq.com)
 */
function os($user_agent): string
{
    if (empty($user_agent)) {
        return '';
    }

    $osMap = [
        '/win/i' => 'Windows',
        '/mac/i' => 'Mac',
        '/linux/i' => 'Linux',
    ];

    foreach ($osMap as $pattern => $name) {
        if (preg_match($pattern, $user_agent)) {
            return $name;
        }
    }

    return 'Other';
}

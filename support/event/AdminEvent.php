<?php
/**
 * AdminEvent.php
 * @author cdyun(121625706@qq.com)
 * @date 2025/9/29 16:45
 */

namespace support\event;

use support\Log;

class AdminEvent
{
    /**
     * 记录日志
     * @param $response - 响应内容
     * @param $uid - 用户ID
     * @return bool
     * @author cdyun(121625706@qq.com)
     */
    public function log($response = null, $uid = null): bool
    {
//        $data = [
//            'uid' => request()->uid || $uid,
//        ];
//
//        if ($response) {
//            // 限制记录的响应内容，避免过大
//            $_response = $response->rawBody();
//            $data['content'] = mb_substr($_response, 0, 3000, 'utf-8');
//        }
//
//        try {
//            if (!str_contains($data['controller'], 'Log')) {
//                $dao = new AdminLogModel();
//                $dao->bCreate($data);
//            }
//        } catch (\Throwable $e) {
//            Log::error("记录用户日志失败:", [
//                'exception' => $e->getMessage(),
//                'trace' => $e->getTraceAsString()
//            ]);
//        }
        return true;
    }
}
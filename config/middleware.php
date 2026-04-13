<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

return [
    //全局中间件
    '' => [
        //跨域
        support\middleware\CrossDomainMiddleware::class,
        //浏览器检查
        support\middleware\BrowserCheckMiddleware::class,
    ],
    //后台中间件
//    'admin' => [
//        //验证token
//        support\middleware\AdminTokenMiddleware::class,
//        //解密
//        Cdyun\WebmanResponse\middleware\DecryptMiddleware::class,
//        //日志
//        support\middleware\AdminLogMiddleware::class
//    ],
];
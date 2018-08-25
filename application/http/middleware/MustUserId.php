<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2018/8/13
 * Time: 17:17
 */

namespace app\http\middleware;


class MustUserId
{
    public function handle($request, \Closure $next)
    {
        if ( !isset($request->database) || empty($request->database)) {
            return json(['error' => '数据库参数不能空'])->code(403);
        }

        if (!isset($request->sendUserId) || empty($request->sendUserId)) {
            return json(['error' => '发送人ID不能为空'])->code(403);
        }

        if (!isset($request->receiveUserId) || empty($request->receiveUserId)) {
            return json(['error' => '接受人ID不能为空'])->code(403);
        }

        return $next($request);
    }
}
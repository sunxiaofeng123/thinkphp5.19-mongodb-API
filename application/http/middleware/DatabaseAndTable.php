<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2018/8/13
 * Time: 10:43
 */

namespace app\http\middleware;


class DatabaseAndTable
{
    public function handle($request, \Closure $next)
    {
        if (!isset($request->database) || empty($request->database)) {
            return json(['error' => '数据库不能空'])->code(401);
        }

        if (!isset($request->sendUserId) || empty($request->sendUserId)) {
            return json(['error' => '发送人ID不能空'])->code(401);
        }

        return $next($request);
    }
}
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
        if (!isset($request->table) || !isset($request->database) || empty($request->table) || empty($request->database)) {
            return json(['message' => '数据库或数据表不能空'])->code(401);
        }

        return $next($request);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2018/8/12
 * Time: 16:27
 */

namespace app\index\controller;
use think\App;
use think\Controller;


class Base extends Controller
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
    }
}
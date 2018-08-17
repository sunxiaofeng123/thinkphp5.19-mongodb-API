<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2018/8/12
 * Time: 15:51
 */

namespace app\index\controller;
use app\index\controller\Base;
use app\index\model\Message;
use think\App;

class MongoTest extends Base
{
    //引入校验数据表和数据库的中间件，用来校验。
    protected $middleware = ['DatabaseAndTable'];
    protected $mongodb    = "";
    protected $table      = '';
    protected $database   = '';

    public function __construct(Message $message)
    {
        parent::__construct();
        //动态设置mongodb数据表+数据库
        $table     = $this->request->param('table');
        $database  = $this->request->param('database');

        $this->table    = $table;
        $this->database = $database;
        $this->mongodb  = new Message($this->table, $this->database);

    }

    public function addChats()
    {
        return $this->request->param('id');
    }

    public function test()
    {
        
    }

}
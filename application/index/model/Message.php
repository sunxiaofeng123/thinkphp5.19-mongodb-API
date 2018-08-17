<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2018/8/12
 * Time: 23:41
 */

namespace app\index\model;
use app\index\model\MongoBase;


class Message extends MongoBase
{
    protected $table = 'usermessage';

    public function __construct($table = '', $database = '', array $data = [])
    {
        if (!empty($table)) {
            $this->table = $table;
        }
        parent::__construct($database, $data);
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2018/8/16
 * Time: 17:40
 * 用户消息记录模型
 */

namespace app\index\model;
use app\index\model\MongoBase;

class UserChat extends MongoBase
{
    public  $table = "";

    public function __construct($table = '', $database = '', array $data = [])
    {
        if (!empty($table)) {
            $this->table = $table;
        }

        parent::__construct($database, $data);
    }

    /*
     * 插入聊天记录
     * @param array $data;
     * @return $blnsucc;
     */

    public function addUserRecord(array $data)
    {
        return $this->save($data);
    }

    /*
     * w
     * @param $toId
     * @return $table 返回表名
     */

    public function checkRecord($toId)
    {
        $table = '';

        $data = $this->where('toId', $toId)->value('tableName');

        if (!empty($data)) {
            $table = $data;
        }

        return $table;
    }
}
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
    public    $table    = "";
    protected $endModel = '_record';

    public function __construct($table = '', $database = '', array $data = [])
    {
        if (!empty($table)) {
            $this->table = $table.$this->endModel;
        }

        parent::__construct($database, $data);
    }

    /*
     * 插入聊天记录
     * @param string $toId;
     * @param  string $tableName;
     * @return $blnsucc;
     */

    public function addUserRecord($toId, $tableName)
    {
        return $this->save(['toId' => $toId, 'tableName' => $tableName]);
    }

    /*
     * w
     * @param $toId
     * @return $table 返回表名
     */

    public function checkRecord($toId)
    {
        $table = '';

        $data = $this->where('toId', $toId)->find();
        if (!empty($data)) {
            $table = $data['tableName'];
        }

        return $table;
    }
}
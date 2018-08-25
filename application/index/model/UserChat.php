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
use app\index\model\UserChatMessage;

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

    /*
     * 查询列表信息
     * @return array $list
     */

    public function getMessageList()
    {
        $list = $this->order('id asc')->select();

        $messageList = array();
        $message     = array();

        if (!empty($list)){
            $message =  array_map(function($value) use ($message) {
                $userChatMessage = new UserChatMessage($value['tableName'], $this->connection['database']);

                $message['userId']      = $value['toId'];
                $message['unreadCount'] = $userChatMessage->getMessageCountForUserId($value['toId']);

                return $message;
            },$list);

            $messageList[] = $message;
        }

        return $messageList;
    }
}
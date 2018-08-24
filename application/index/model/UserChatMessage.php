<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2018/8/13
 * Time: 17:05
 * 用户消息聊天记录模型
 */

namespace app\index\model;

use app\index\model\MongoBase;
use think\Db;

class UserChatMessage extends MongoBase
{
    public $table = "";

    public function __construct($table = '', $database = '', array $data = [])
    {
        if (!empty($table)) {
            $this->table = $table;
        }

        parent::__construct($database, $data);
    }

    /*
     * 插入聊天信息
     * @param string $sendId
     * @param string $toId
     * @param string $content
     * @param string $posttime
     * @return $blnsucc
     */

    public function addChatMessage($messageData)
    {
        return $this->save($messageData);
    }

    /*
     * 查询双方基础聊天记录聊天信息
     * @return array
     */

    public function getChatMessage()
    {
        return $this->order('id', 'asc')->select();
    }

     /*
      * 查询回复消息
      * @param string $sendUserId
      * @return array $message
      */

     public function getReplyMessage($sendUserId)
     {
        return $this->where('sendUserId', $sendUserId)
                    ->where('isread', '1')
                    ->order('posttime asc')
                    ->select();
     }

     /*
      * 修改未读消息的状态
      * @param string $receiveUserId 回复人消息id
      * @return boolean $blnsucc
      */

     public function updReadStatus($receiveUserId)
     {
         $unreadMessage = $this->getUnreadMessage($receiveUserId);
         if (empty($unreadMessage)) {
             return true;
         }

         $result = array();
         foreach($unreadMessage as $key => $val){
             $result[$key] = $this->where(['id' => $val['id']])->update(['isread' => '2']);
         }

         return $result;
     }
     /*
      * 获取未读消息
      * @param string $receiveUserId 回复消息ID
      * @return array $unreadMessage
      */
     protected function getUnreadMessage($receiveUserId)
     {
         return $this->where('sendUserId', $receiveUserId)
                     ->where('isread', '1')
                     ->select();
     }

     /*
      * 获取未读消息记录条数
      * @param string $receiveUserId
      * @return string $count
      */
     public function getMessageCountForUserId($receiveUserId)
     {
         return $this->where('sendUserId', $receiveUserId)
                     ->where('isread', '1')
                     ->count();
     }
}
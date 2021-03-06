<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2018/8/13
 * Time: 17:07
 */

namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\UserChatMessage;
use app\index\model\UserChat;
use think\App;

class UserMessage extends Base
{
//    protected $middleware     = ['MustUserId'];  //中间件
    protected $sendUserId    = ""; //发送人userID
    protected $receiveUserId = ""; //接收人userId
    protected $database;           //数据库名称（根据不同的项目设置不同的数据库）

    public function __construct()
    {
        parent::__construct();

        $sendUserId    = $this->request->param('sendUserId');
        $receiveUserId = $this->request->param('receiveUserId');
        $database      = $this->request->param('database');

        $this->sendUserId    = $sendUserId;
        $this->receiveUserId = $receiveUserId;
        $this->database      = $database;
    }

    //记录模型
    protected function chatModel($userId): object
    {
        return new UserChat($userId, $this->database);
    }

    //聊天模型
    protected function chatMessageModel($table): object
    {
        return new UserChatMessage($table, $this->database);
    }

    //获取记录聊天表名
    protected function getChatTable()
    {
        return $this->chatModel($this->sendUserId)->checkRecord($this->receiveUserId);
    }

    //进入页面查询基础信息
    public function getBasicsMessage()
    {
        $table = $this->getChatTable();
        if (empty($table)) {//如果table为空没有记录，则没有基础数据

            $tableName = $this->sendUserId.'_'.$this->receiveUserId;
            //添加初始化记录
            $this->addChatRecord($this->sendUserId, ['toId' => $this->receiveUserId, 'tableName' => $tableName]);
            $this->addChatRecord($this->receiveUserId, ['toId' => $this->sendUserId, 'tableName' => $tableName]);

            return json(['message' => array()])->code('200');
        }

        //查询聊天基础信息
        $messageData = $this->chatMessageModel($table)->getChatMessage();
        //如果消息不为空修改修改未读消息为已读
        if (!empty($messageData)) {
            //修改未读消息，为已读。
            $this->updateReadStatus($this->receiveUserId, $table);
        }

        return json(['message' => $messageData])->code('200');
    }

    //查询回复消息
    public function getReplyMessage()
    {
        //获取表名
        $table = $this->getChatTable();

        $message = $this->chatMessageModel($table)->getReplyMessage($this->receiveUserId);
        if (!empty($message)) {
            //修改未读消息，为已读。
            $this->updateReadStatus($this->receiveUserId, $table);
        }

        return json(['message' => $message])->code('200');
    }

    //查询列表信息
    public function getMessageList()
    {

        $messageList = $this->chatModel($this->sendUserId)->getMessageList();

        return json(['messageList' => $messageList])->code('200');
    }

    //添加聊天信息
    public function addChatMessage()
    {
        $bln = false;

        $content = $this->request->param('content');
        if (empty($content)) {
            return json(['error' => '发送的消息不能为空'])->code('403');
        }

        $messageData = [
                'sendUserId'    => $this->sendUserId,
                'receiveUserId' => $this->receiveUserId,
                'posttime'      => time(),
                'isread'        => '1',  //消息读取状态，1是未读，2是已读
                'content'       => htmlspecialchars(addslashes($content)),
            ];

        //获取表名称
        $table = $this->getChatTable();
        if (!empty($table)) {
            //添加发送消息
            $bln = $this->chatMessageModel($table)->addChatMessage($messageData);
        }

        if ($bln !== false) {
            return json(['success' => $bln])->code('200');
        } else {
            return json(['error' => $bln])->code('200');
        }
    }

    //添加聊天记录，初始化只添加一次
    protected function addChatRecord($userId, $data)
    {
        return $this->chatModel($userId)->addUserRecord($data);
    }

    //修改未读信息为已读
    protected function updateReadStatus($unreadMessage,$table)
    {
        return $this->chatMessageModel($table)->updReadStatus($unreadMessage);
    }

}
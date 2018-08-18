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
    protected $middleware     = ['MustUserId'];  //中间件
    protected $_sendUserId    = ""; //发送人userID
    protected $_receiveUserId = ""; //接收人userId
    protected $_database;           //数据库名称（根据不同的项目设置不同的数据库）

    public function __construct()
    {
        parent::__construct();

        $sendUserId    = $this->request->param('sendUserId');
        $receiveUserId = $this->request->param('receiveUserId');
        $database      = $this->request->param('database');

        $this->_sendUserId    = $sendUserId;
        $this->_receiveUserId = $receiveUserId;
        $this->_database      = $database;
    }

    //记录模型
    protected function chatModel($userID): object
    {
        return new UserChat($userID, $this->_database);

    }

    //聊天模型
    protected function chatMessageModel($table): object
    {
        return new UserChatMessage($table, $this->_database);
    }

    //获取记录聊天表名
    protected function getChatTable()
    {
        return $this->chatModel($this->_sendUserId)->checkRecord($this->_receiveUserId);
    }

    //进入页面查询基础信息
    public function getBasicsMessage()
    {
        $table = $this->getChatTable();
        if (empty($table)) { //如果table为空没有记录，则没有基础数据
            return json(['message' => array()])->code('200');
        }

        //查询聊天基础信息
        $messageData = $this->chatMessageModel($table)->getChatMessage();

        return json(['message' => $messageData])->code('200');
    }

    //查询回复消息
    public function getReplyMessage()
    {

    }

    //查询列表信息
    public function getMessageList()
    {

    }

    //添加聊天信息
    public function addChatMessage()
    {

    }

    //添加聊天记录，初始化只添加一次
    protected function addChatRecord()
    {

    }

}
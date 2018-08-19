通用聊天API(version:1)
===============

使用ThinkPHP5.1+mongodb开发，适合PHP7+，数据库配置请到app\index\model\MongoBase中配置。

 + 必备参数：发送人ID：sendUserId，接收人ID：receiveUserId，数据库名称：database；
 每个接口必须传入的参数，所有请求使用post。
 + 初始化聊天页面使用接口：域名／getBasicsMessage
 + 添加发送消息接口：域名／addChatMessage，参数：除必备参数外：消息内容：content
 剩余还在开发中。。。。敬请期待！
 

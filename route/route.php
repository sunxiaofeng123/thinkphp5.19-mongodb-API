<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('/', function () {
    return 'hello,ThinkPHP5!';
});

//信息列表
Route::post('getMessageList', 'userMessage/getMessageList')->middleware('DatabaseAndTable');

//初始化进入聊天页面
Route::post('getBasicsMessage', 'userMessage/getBasicsMessage')->middleware('MustUserId');

//发送聊天信息
Route::post('addChatMessage', 'userMessage/addChatMessage')->middleware('MustUserId');

//查询回复消息
Route::post('getReplyMessage', 'userMessage/getReplyMessage')->middleware('MustUserId');



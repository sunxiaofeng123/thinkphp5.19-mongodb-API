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

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::post('mongotest', 'mongoTest/test');
Route::get('addChats/:id', 'mongoTest/addChats');

//初始化进入聊天页面
Route::post('getBasicsMessage', 'userMessage/getBasicsMessage');

//发送聊天信息
Route::post('addChatMessage', 'userMessage/addChatMessage');



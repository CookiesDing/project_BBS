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
use think\facade\Route;

//主路由
Route::get("/","Index/index");


Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');


//用户模块
Route::resource('user','User');
Route::post('user','User/save');

//帖子模块
Route::resource('post','Post');
Route::post('post','Post/save');

//回复模块
Route::resource('comment','Comment');
Route::post('comment','Comment/save');

//用户对应多个post和commment路由
Route::get('user/:id/post','User/post');
Route::get('user/:id/comment','User/comment');

//帖子对应多个comment路由
Route::get('post/:id/comment','Post/comment');


//
Route::get('/ajaxRequest','User/index');
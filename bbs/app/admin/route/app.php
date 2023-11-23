<?php

use think\facade\Route;

Route::get("/", "admin");

//后台组
Route::group(function () {
    //用户模块资源路由
    Route::resource('user', 'User');
    //帖子模块资源路由
    Route::resource('post', 'Post');

})->middleware(function ($request, \Closure $next) {
    if (!session('?admin')) {
        return redirect('/admin/login');
    }
    return $next($request);
});

// Route::get("user","User");
//用户模块
Route::resource('index', 'Index');

//用户模块
Route::resource('user', 'User');
Route::post('user', 'User/save');

//帖子模块
Route::resource('post', 'Post');
Route::post('post', 'Post/save');


//评论模块
Route::resource('comment', 'Comment');
Route::post('comment', 'Comment/save');

//管理模块
Route::resource('admin', 'Admin');
Route::post('admin', 'Admin/save');

//登录模块路由
Route::group(function () {
    Route::get('login', 'Login/index')->middleware(function ($request, \Closure
    $next) {
        if (session('?admin')) {                    //如果已经有了session,跳转到用户列表
            return redirect('/admin/user');
        }
        return $next($request);
    });
    Route::post('login_check', 'Login/check');
    Route::get('logout', 'Login/out');
});

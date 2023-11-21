<?php
use think\facade\Route;

Route::get("/","Index/index");



// //后台组
Route::group(function () {
    // Route::resource('index','Index');
    Route::get('index/create','Index/create');
 })->middleware(function ($request, \Closure $next) {
     if (!session('?admin')) {
        dump('11');
         return redirect('/index/login');
     }
     return $next($request);
 });

 //帖子模块
 Route::resource('index', 'Index');
//用户模块
Route::resource('user', 'User');
Route::post('user', 'User/save');

//评论模块
Route::resource('comment', 'Comment');
Route::post('comment', 'Comment/save');

//登录模块路由
Route::group(function () {
    Route::get('login', 'Login/index')->middleware(function ($request, \Closure $next) {
        if (session('?admin')) {                    //如果已经有了session,跳转到用户列表
            return redirect('/index/index');
        }
        return $next($request);
    });
    Route::post('login_check', 'Login/check');
    Route::get('logout', 'Login/out');
});



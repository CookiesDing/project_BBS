<?php
use think\facade\Route;

Route::get("/","Index/index");

//用户模块
Route::resource('index','Index');

//用户模块
Route::resource('user','User');
Route::post('user','User/save');
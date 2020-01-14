<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//连接公众号
Route::prefix('wechat')->group(function (){
    Route::any('index','Wechat\WechatController@index'); 
});
//后台方法
Route::prefix('admin')->group(function (){
    Route::any('index','Admin\AdminController@index'); //后台首页
    Route::any('index_v1','Admin\AdminController@index_v1');//后台首页拓展
    Route::any('culcontroller','CurlController@culcontroller');//测试
});
//后台登录
Route::prefix('login')->group(function (){
    Route::any('index','Admin\LoginController@index'); //后台登录首页
    Route::any('save','Admin\LoginController@save'); //登录方法
});
//素材管理
Route::prefix('media')->group(function (){
    Route::any('show','Media\MediaController@show'); //素材展示页面
    Route::any('add','Media\MediaController@add'); //素材添加页面
    Route::any('add_do','Media\MediaController@add_do'); //素材添加方法
});

//考试
Route::prefix('index')->group(function (){
    Route::any('/index','Index\IndexController@index');//添加首页
    Route::any('/add_do','Index\IndexController@add_do');//添加方法
    Route::any('/list','Index\IndexController@list');//列表展示
    Route::any('/del/{id}','Index\IndexController@del');//删除
    Route::any('/upd/{id}','Index\IndexController@upd');//修改页面
    Route::any('/upd_do/{id}','Index\IndexController@upd_do');//修改方法
    Route::any('/weixin','Index\IndexController@weixin');

});

Route::prefix('weixin')->group(function (){
    Route::any('/weixin','Index\IndexController@weixin');//微信
    Route::any('/ticket','Index\IndexController@ticket');//带参数的二维码
});
Route::prefix('ticket')->group(function (){
    Route::any('/add','Ticket\ticketController@add');//带参数的二维码添加
    Route::any('/add_do','Ticket\ticketController@add_do');//带参数的二维码添加方法
    Route::any('/list','Ticket\ticketController@list');//带参数的二维码添加方法
});
Route::prefix('highchar')->group(function (){
    Route::any('/index','Highchar\HighcharController@index');//首页
});
//菜单
Route::prefix('mane')->group(function (){
    Route::any('/mane','Mane\ManeController@mane');//菜单
    Route::any('/index_openid','Mane\ManeController@index_openid');//消息群发
});
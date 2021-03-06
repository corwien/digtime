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

Route::get('/', 'ArticlesController@index');

Auth::routes();

// 邮箱注册验证
Route::get('email/verify/{token}', ['as' => 'email.verify', 'uses' => 'EmailController@verify'] );

Route::get('/home', 'HomeController@index');

// 上传头像
Route::get('avatar', 'UsersController@avatar');
Route::post('avatar', 'UsersController@avatarUpload');

// 密码
Route::get('password', 'PasswordController@password');
Route::post('password/update', 'PasswordController@update');

// 个人设置
// Route::get('setting', 'SettingController@index');
// Route::post('setting', 'SettingController@store');


// 文章
Route::resource('articles', 'ArticlesController', ['names' =>
    ['create' => 'article.create'],
    ['show' => 'article.show'],
    ['edit' => 'article.edit'],
]);

// 评论路由
Route::Post('/articles/{comment}/comment', 'CommentsController@store');

// 用户页
Route::get('user/{user_id}', 'UsersController@show');

// 路由群组-登录，如果未登录则跳转到登录页
Route::group(['middleware' => 'auth'], function(){
    // 用户页
   // Route::get('user/{user_id}', 'UsersController@show');
});

// 评论
Route::get('article/{id}/comments', 'CommentsController@article');

// Test
Route::get('/test', function () {
    return view('test/__test_tools');
});


// 用户控制器
Route::group(['middleware' => ['web']], function(){
    Route::get('/users', 'UsersController@users');
    Route::get('/user/{openId}', 'UsersController@user');
});

// 微信
Route::any('/wechat', 'WechatController@serve');



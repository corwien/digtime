<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 评论
Route::get('article/{id}/comments', 'CommentsController@article');

// 评论
Route::get('article/test', function(){
    $arr = json_encode(array('user_id' => 10086));
    return $arr;
});

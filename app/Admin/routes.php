<?php

// http://z-song.github.io/laravel-admin/#/zh/
use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    // 添加User路由
    $router->resource('users', UserController::class);

    // 博客文章路由
    $router->resource('articles', ArticlesController::class);

    // 分类
    $router->resource('categories', CategoriesController::class);

});

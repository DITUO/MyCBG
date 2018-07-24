<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => ['web','admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('user', UserController::class);
    $router->resource('service', ServiceController::class);
    $router->resource('topic', TopicController::class);
    $router->resource('reply', ReplyController::class);
    $router->resource('category', CategoryController::class);
});

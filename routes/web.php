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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'ServiceController@serviceList')->name('list');
Route::post('services', 'ServiceController@services');
Route::get('choose', 'ServiceController@choose')->name('choose');
Route::get('service_add', 'ServiceController@serviceAdd');
Route::post('service_add', 'ServiceController@serviceStore');
Route::get('test', 'ServiceController@test');
Route::get('test1', 'ServiceController@test1');
Route::get('test2', 'ServiceController@test2');
Route::get('test3', 'ServiceController@test3');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//UserController
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');

//topicsController
Route::resource('topics', 'TopicsController', ['only' => ['show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('topics', 'TopicsController@index')->name('topics.index');

//CategoryControler
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

//ReplyController
Route::resource('replies', 'ReplyController', ['only' => ['store', 'destroy']]);
Route::get('replys', 'ReplyController@index')->name('reply.index');

//notify
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);


Route::get('myTest', function(){
    return view('myTest');
});
Route::get('getData', 'TestController@getData');
Route::post('getData1', 'TestController@getData1');

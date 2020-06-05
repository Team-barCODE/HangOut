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

Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('search/', 'UserController@search')->name('users.search');
    Route::get('/', 'UserController@index')->name('users.index');
    Route::get('/{status}', 'UserController@index')->name('users.list');
    Route::get('show/{id}', 'UserController@show')->name('users.show');
    Route::get('edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('update/{id}', 'UserController@update')->name('users.update');
    Route::get('update/{id}', function () {
        return redirect('/');
    });


});


Route::get('/', function () {
    return view('top');
});

Route::get('/info', function () {
    return view('info');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/matching', 'MatchingController@index')->name('matching');

Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function () {
    Route::get('show', function () {
        return redirect('/');
    });
    Route::post('show', 'ChatController@show')->name('chat.show');
    Route::post('chat', 'ChatController@chat')->name('chat.chat');
});

Route::post('/api/like', 'ReactionController@create');


Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function() {
    Route::get('/', function () {
        return view('admin.auth/login');
    });
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');

Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');

Route::get('register', 'Admin\Auth\RegisterController@showRegisterForm')->name('admin.register');
Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin.register');

Route::get('password/rest', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');


});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function(){
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
});

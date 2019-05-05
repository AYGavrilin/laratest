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

Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () { // для контроллеров в неймспейсе Blog используем префикс blog
    Route::resource('posts', 'PostController')->names('blog.posts'); // для запросов по адресу posts юзаем PostController, даем ему имя blog.posts
});



//Route::resource('rest', 'RestTestController')->names('restTest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

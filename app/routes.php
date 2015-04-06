<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::any('lecture-select', 'HomeController@select');

Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');

Route::get('user/list', 'UserController@index');
Route::any('user/create', 'UserController@create');
Route::any('user/update/{id}', 'UserController@update');

Route::get('lecture/list', 'LectureController@index');
Route::any('lecture/create', 'LectureController@create');
Route::any('lecture/update/{id}', 'LectureController@update');

Route::get('classroom/list', 'ClassRoomController@index');
Route::any('classroom/create', 'ClassRoomController@create');
Route::any('classroom/update/{id}', 'ClassRoomController@update');

Route::get('logout', function(){
    Sentry::logout();
    echo 'Çıkış yapıldı';
});
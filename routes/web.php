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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'userController@index')->name('index');
Route::get('/user', 'UserController@create');
Route::get('/user/{id}', 'UserController@update');
Route::get('/user/save', 'UserController@delete');
Route::get('/user/delete/{id}', 'UserController@delete');

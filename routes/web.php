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

//users
Route::get('/users', 'UserController@index')->name('index');
Route::get('/user', 'UserController@create')->name('create');
Route::get('/user/{id}', 'UserController@update')->name('update');
Route::post('/user/save', 'UserController@save')->name('save');
Route::get('/user/reset-password/{id}', 'UserController@resetPassword')->name('resetPassword');
Route::get('/user/delete/{id}', 'UserController@delete')->name('delete');

//warehouses
Route::get('/warehouses', 'WarehouseController@index')->name('index');
Route::get('/warehouse', 'WarehouseController@create')->name('create');
Route::get('/warehouse/{id}', 'WarehouseController@update')->name('update');
Route::post('/warehouse/save', 'WarehouseController@save')->name('save');
Route::get('/warehouse/delete/{id}', 'WarehouseController@delete')->name('delete');

//supplyType
Route::get('/supply-types', 'SupplyTypeController@index')->name('index');
Route::get('/supply-type', 'SupplyTypeController@create')->name('create');
Route::get('/supply-type/{id}', 'SupplyTypeController@update')->name('update');
Route::post('/supply-type/save', 'SupplyTypeController@save')->name('save');
Route::get('/supply-type/delete/{id}', 'SupplyTypeController@delete')->name('delete');

//supplyCategory
Route::get('/supply-categories', 'SupplyCategoryController@index')->name('index');
Route::get('/supply-category', 'SupplyCategoryController@create')->name('create');
Route::get('/supply-category/{id}', 'SupplyCategoryController@update')->name('update');
Route::post('/supply-category/save', 'SupplyCategoryController@save')->name('save');
Route::get('/supply-category/delete/{id}', 'SupplyCategoryController@delete')->name('delete');

//Season
Route::get('/seasons', 'SeasonController@index')->name('index');
Route::get('/season', 'SeasonController@create')->name('create');
Route::get('/season/{id}', 'SeasonController@update')->name('update');
Route::post('/season/save', 'SeasonController@save')->name('save');
Route::get('/season/delete/{id}', 'SeasonController@delete')->name('delete');

//supplier
Route::get('/supplier', 'SupplyController@new')->name('new');
Route::get('/supplier/{clave}', 'SupplyController@find')->name('find');
Route::post('/supplier/save', 'SupplyController@save')->name('save');
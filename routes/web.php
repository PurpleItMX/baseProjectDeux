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
Route::get('/user/reset-password', 'UserController@resetPassword')->name('resetPassword');
Route::get('/user/delete/{id}', 'UserController@delete')->name('delete');
Route::post('/user/search', 'UserController@search')->name('search');

//warehouses
Route::get('/warehouses', 'WarehouseController@index')->name('index');
Route::get('/warehouse', 'WarehouseController@create')->name('create');
Route::get('/warehouse/{id}', 'WarehouseController@update')->name('update');
Route::post('/warehouse/save', 'WarehouseController@save')->name('save');
Route::get('/warehouse/delete/{id}', 'WarehouseController@delete')->name('delete');
Route::post('/warehouse/search', 'WarehouseController@search')->name('search');

//supplyType
Route::get('/supply-types', 'SupplyTypeController@index')->name('index');
Route::get('/supply-type', 'SupplyTypeController@create')->name('create');
Route::get('/supply-type/{id}', 'SupplyTypeController@update')->name('update');
Route::post('/supply-type/save', 'SupplyTypeController@save')->name('save');
Route::get('/supply-type/delete/{id}', 'SupplyTypeController@delete')->name('delete');
Route::get('/supply-type/category/{id}', 'SupplyTypeController@category')->name('category');
Route::post('/supply-type/search', 'SupplyTypeController@search')->name('search');

//supplyCategory
Route::get('/supply-categories', 'SupplyCategoryController@index')->name('index');
Route::get('/supply-category', 'SupplyCategoryController@create')->name('create');
Route::get('/supply-category/{id}', 'SupplyCategoryController@update')->name('update');
Route::post('/supply-category/save', 'SupplyCategoryController@save')->name('save');
Route::get('/supply-category/delete/{id}', 'SupplyCategoryController@delete')->name('delete');
Route::post('/supply-category/search', 'SupplyCategoryController@search')->name('search');

//Season
Route::get('/seasons', 'SeasonController@index')->name('index');
Route::get('/season', 'SeasonController@create')->name('create');
Route::get('/season/{id}', 'SeasonController@update')->name('update');
Route::post('/season/save', 'SeasonController@save')->name('save');
Route::get('/season/delete/{id}', 'SeasonController@delete')->name('delete');
Route::post('/season/search', 'SeasonController@search')->name('search');

//providerType
Route::get('/provider-types', 'ProviderTypeController@index')->name('index');
Route::get('/provider-type', 'ProviderTypeController@create')->name('create');
Route::get('/provider-type/{id}', 'ProviderTypeController@update')->name('update');
Route::post('/provider-type/save', 'ProviderTypeController@save')->name('save');
Route::get('/provider-type/delete/{id}', 'ProviderTypeController@delete')->name('delete');
Route::get('/provider-type/category/{id}', 'ProviderTypeController@category')->name('category');
Route::post('/provider-type/search', 'ProviderTypeController@search')->name('search');

//providerCategory
Route::get('/provider-categories', 'ProviderCategoryController@index')->name('index');
Route::get('/provider-category', 'ProviderCategoryController@create')->name('create');
Route::get('/provider-category/{id}', 'ProviderCategoryController@update')->name('update');
Route::post('/provider-category/save', 'ProviderCategoryController@save')->name('save');
Route::get('/provider-category/delete/{id}', 'ProviderCategoryController@delete')->name('delete');
Route::post('/provider-category/search', 'ProviderCategoryController@search')->name('search');

//providers
Route::get('/providers', 'ProviderController@index')->name('index');
Route::get('/provider', 'ProviderController@create')->name('create');
Route::get('/provider/{id}', 'ProviderController@update')->name('update');
Route::post('/provider/save', 'ProviderController@save')->name('save');
Route::get('/provider/delete/{id}', 'ProviderController@delete')->name('delete');
Route::post('/provider/search', 'ProviderController@search')->name('search');

//supplier
Route::get('/suppliers', 'SupplyController@index')->name('index');
Route::get('/supplier', 'SupplyController@create')->name('create');
Route::get('/supplier/{id}', 'SupplyController@update')->name('update');
Route::post('/supplier/save', 'SupplyController@save')->name('save');
Route::get('/supplier/delete/{id}', 'SupplyController@delete')->name('delete');
Route::post('/supplier/search', 'SupplyController@search')->name('search');

//productType
Route::get('/product-types', 'ProductTypeController@index')->name('index');
Route::get('/product-type', 'ProductTypeController@create')->name('create');
Route::get('/product-type/{id}', 'ProductTypeController@update')->name('update');
Route::post('/product-type/save', 'ProductTypeController@save')->name('save');
Route::get('/product-type/delete/{id}', 'ProductTypeController@delete')->name('delete');
Route::get('/product-type/category/{id}', 'ProductTypeController@category')->name('category');
Route::post('/product-type/search', 'ProductTypeController@search')->name('search');

//productCategory
Route::get('/product-categories', 'ProductCategoryController@index')->name('index');
Route::get('/product-category', 'ProductCategoryController@create')->name('create');
Route::get('/product-category/{id}', 'ProductCategoryController@update')->name('update');
Route::post('/product-category/save', 'ProductCategoryController@save')->name('save');
Route::get('/product-category/delete/{id}', 'ProductCategoryController@delete')->name('delete');
Route::post('/product-category/search', 'ProductCategoryController@search')->name('search');

//products
Route::get('/products', 'ProductController@index')->name('index');
Route::get('/product', 'ProductController@create')->name('create');
Route::get('/product/{id}', 'ProductController@update')->name('update');
Route::post('/product/save', 'ProductController@save')->name('save');
Route::get('/product/delete/{id}', 'ProductController@delete')->name('delete');
Route::post('/product/search', 'ProductController@search')->name('search');

//subrecipe
Route::get('/subrecipes', 'SubrecipeController@index')->name('index');
Route::get('/subrecipe', 'SubrecipeController@create')->name('create');
Route::get('/subrecipe/{id}', 'SubrecipeController@update')->name('update');
Route::post('/subrecipe/save', 'SubrecipeController@save')->name('save');
Route::get('/subrecipe/delete/{id}', 'SubrecipeController@delete')->name('delete');
Route::post('/subrecipe/search', 'SubrecipeController@search')->name('search');
Route::post('/subrecipe/supply', 'SubrecipeController@supply')->name('supply');
Route::get('/subrecipe/findClave/{clave}', 'SubrecipeController@findClave')->name('findClave');

//recipe
Route::get('/recipes', 'RecipeController@index')->name('index');
Route::get('/recipe', 'RecipeController@create')->name('create');
Route::get('/recipe/{id}', 'RecipeController@update')->name('update');
Route::post('/recipe/save', 'RecipeController@save')->name('save');
Route::get('/recipe/delete/{id}', 'RecipeController@delete')->name('delete');
Route::post('/recipe/search', 'RecipeController@search')->name('search');
Route::post('/recipe/supply', 'RecipeController@supply')->name('supply');

//serviceType
Route::get('/service-types', 'ServiceTypeController@index')->name('index');
Route::get('/service-type', 'ServiceTypeController@create')->name('create');
Route::get('/service-type/{id}', 'ServiceTypeController@update')->name('update');
Route::post('/service-type/save', 'ServiceTypeController@save')->name('save');
Route::get('/service-type/delete/{id}', 'ServiceTypeController@delete')->name('delete');
Route::get('/service-type/category/{id}', 'ServiceTypeController@category')->name('category');
Route::post('/service-type/search', 'ServiceTypeController@search')->name('search');

//serviceCategory
Route::get('/service-categories', 'ServiceCategoryController@index')->name('index');
Route::get('/service-category', 'ServiceCategoryController@create')->name('create');
Route::get('/service-category/{id}', 'ServiceCategoryController@update')->name('update');
Route::post('/service-category/save', 'ServiceCategoryController@save')->name('save');
Route::get('/service-category/delete/{id}', 'ServiceCategoryController@delete')->name('delete');
Route::post('/service-category/search', 'ServiceCategoryController@search')->name('search');

//services
Route::get('/services', 'ServiceController@index')->name('index');
Route::get('/service', 'ServiceController@create')->name('create');
Route::get('/service/{id}', 'ServiceController@update')->name('update');
Route::post('/service/save', 'ServiceController@save')->name('save');
Route::get('/service/delete/{id}', 'ServiceController@delete')->name('delete');
Route::post('/service/search', 'ServiceController@search')->name('search');

//ProjectionSale
Route::get('/projection-sales', 'ProjectionSaleController@index')->name('index');
Route::get('/projection-sale', 'ProjectionSaleController@create')->name('create');
Route::get('/projection-sale/{id}', 'ProjectionSaleController@update')->name('update');
Route::post('/projection-sale/save', 'ProjectionSaleController@save')->name('save');
Route::get('/projection-sale/delete/{id}', 'ProjectionSaleController@delete')->name('delete');
Route::post('/projection-sale/search', 'ProjectionSaleController@search')->name('search');
Route::post('/projection-sale/detail-sales', 'ProjectionSaleController@detailSales')->name('detailSales');

//roles
Route::get('/roles', 'RoleController@index')->name('index');
Route::get('/role', 'RoleController@create')->name('create');
Route::get('/role/{id}', 'RoleController@update')->name('update');
Route::post('/role/save', 'RoleController@save')->name('save');
Route::get('/role/delete/{id}', 'RoleController@delete')->name('delete');
Route::post('/role/search', 'RoleController@search')->name('search');

//Menu
Route::get('/menus', 'MenuController@index')->name('index');
Route::get('/menu', 'MenuController@create')->name('create');
Route::get('/menu/{id}', 'MenuController@update')->name('update');
Route::post('/menu/save', 'MenuController@save')->name('save');
Route::get('/menu/delete/{id}', 'MenuController@delete')->name('delete');
Route::post('/menu/search', 'MenuController@search')->name('search');
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

Route::group(['prefix'=>'home', 'middleware'=>'userrole'], function (){
    Route::post('/profile', 'ProfileController@update');
    Route::get('/profile', 'ProfileController@index');
    Route::get('/ttn', 'TtnController@userTtn');
    Route::get('/ttn/view/{ttn}', 'TtnController@show');
    Route::get('/ttn/create', 'TtnController@create');
    Route::get('/ttn/find', 'TtnController@operatorFind');
});

Route::group(['prefix'=>'operator', 'middleware'=>'operatorrole'], function (){
    Route::get('/ttn/find', 'TtnController@operatorFind');
    Route::get('/ttn/create', 'TtnController@operatorCreate');
    Route::post('/user/profile', 'ProfileController@operatorUpdate');
    Route::get('/user/profile', 'ProfileController@operatorIndex');
});


Route::get('/find', 'TtnController@unregisterFind');


Route::group(['prefix'=>'user', 'middleware'=>'auth'], function (){
    Route::post('/find', 'UserController@find');
});

Route::group(['prefix'=>'regions'], function (){
    Route::get('/listall', 'RegionController@index');
});

Route::group(['prefix'=>'locations'], function (){
    Route::post('/getLocations', 'LocationController@getLocations');
});

Route::group(['prefix'=>'departments'], function (){
    Route::post('/getDepartmens', 'DepartmentController@getDepartments');
});

Route::group(['prefix'=>'ttn'], function (){
    Route::post('/store', 'TtnController@store');
    Route::post('/operator/store', 'TtnController@operatorStore');
    Route::post('/find', 'TtnController@find');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

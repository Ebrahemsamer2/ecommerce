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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'adminsonly']], function () {

    Route::get('/admin/dashboard', 'Admin\HomeController@index')->name('dashboard');
    
    Route::get('/admin', 'Admin\HomeController@index')->name('dashboard');

	Route::resource('admin/users', 'Admin\UserController', ['except' => ['show']]);

    Route::resource('admin/admins', 'Admin\AdminController');

    Route::resource('admin/products', 'Admin\ProductController');

    Route::resource('admin/categories', 'Admin\CategoryController');
	
    Route::get('admin/profile', ['as' => 'profile.edit', 'uses' => 'Admin\ProfileController@edit']);
	
    Route::put('admin/profile', ['as' => 'profile.update', 'uses' => 'Admin\ProfileController@update']);
	
    Route::put('admin/profile/password', ['as' => 'profile.password', 'uses' => 'Admin\ProfileController@password']);
	
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'Admin\PageController@index']);
});


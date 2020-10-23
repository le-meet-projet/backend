<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'as' => 'admin.'], function () {
	Route::get('/', 'DashboardController@home');
	//orders
	Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
		Route::get('/', 'OrdersController@index')->name('index');
		Route::get('/details', 'OrdersController@show')->name('details');
	});
	//spaces
	Route::group(['prefix' => 'spaces', 'as' => 'spaces.'], function () {
		Route::get('/', 'SpaceController@index')->name('index');
		Route::get('/create', 'SpaceController@create')->name('create');
		Route::get('/edit', 'SpaceController@edit')->name('edit');
	});
	//workshops
	Route::group(['prefix' => 'workshops', 'as' => 'workshops.'], function () {
		Route::get('/', 'WorkshopController@index')->name('index');
		Route::get('/create', 'WorkshopController@create')->name('create');
		Route::get('/edit', 'WorkshopController@edit')->name('edit');
	});
	//users
	Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
		Route::get('/', 'UserController@index')->name('index');
		Route::get('/create', 'UserController@create')->name('create');
		Route::get('/edit', 'UserController@edit')->name('edit');
	});
	//coupons
	Route::group(['prefix' => 'coupons', 'as' => 'coupons.'], function () {
		Route::get('/', 'CouponsController@index')->name('index');
		Route::get('/create', 'CouponsController@create')->name('create');
		Route::get('/edit', 'CouponsController@edit')->name('edit');
	});
});


/*
=======
<<<<<<< HEAD
//<<<<<<< HEAD
 
 Route::get('/', 'DashboardController@home');
Route::group(['prefix'=>'dashboard','as'=>'admin.'], function ( ) {
	 	Route::get('/', 'DashboardController@home');
	 	//orders
	 	Route::group(['prefix'=>'orders','as'=>'orders.'], function ( ) {
		    Route::get('/', 'OrdersController@index')->name('index');
		    Route::get('/details', 'OrdersController@show')->name('details');
		    
		});
		//spaces
		Route::group(['prefix'=>'spaces','as'=>'spaces.'], function ( ) {
		    Route::get('/', 'SpaceController@index')->name('index');
		    Route::get('/create', 'SpaceController@create')->name('create');
		    Route::get('/edit', 'SpaceController@edit')->name('edit');
		});
		//workshops
		Route::group(['prefix'=>'workshops','as'=>'workshops.'], function ( ) {
		    Route::get('/', 'WorkshopController@index')->name('index');
		    Route::get('/create', 'WorkshopController@create')->name('create');
		    Route::get('/edit', 'WorkshopController@edit')->name('edit');
		});
		//users
		Route::group(['prefix'=>'users','as'=>'users.'], function ( ) {
		    Route::get('/', 'UserController@index')->name('index');
		    Route::get('/create', 'UserController@create')->name('create');
		    Route::get('/edit', 'UserController@edit')->name('edit');
		});
		
//=======
//>>>>>>> 0dcfb6e39e0d33c8c90d5f970544137bfbd95067
=======
>>>>>>> c0f64b4bc023dc8e407eb5285d8456332ae169a9

>>>>>>> bdce987e6b4111e1dcb886c070c09bb4aaf4ed9d
Route::group(['prefix' => 'home', 'as' => 'home.'], function () {
	Route::get('/', 'DashboardController@home');
	//orders
	Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
		Route::get('/', 'OrderController@index')->name('index');
		Route::get('/details', 'OrderController@show')->name('details');
	});
	//spaces
	Route::group(['prefix' => 'spaces', 'as' => 'spaces.'], function () {
		Route::get('/', 'SpaceController@index')->name('index');
		Route::get('/create', 'SpaceController@create')->name('create');
		Route::get('/edit', 'SpaceController@edit')->name('edit');
	});
	//workshops
	Route::group(['prefix' => 'workshops', 'as' => 'workshops.'], function () {
		Route::get('/', 'WorkshopController@index')->name('index');
		Route::get('/create', 'WorkshopController@create')->name('create');
		Route::get('/edit', 'WorkshopController@edit')->name('edit');
	});
	//users
	Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
		Route::get('/', 'UserController@index')->name('index');
		Route::get('/create', 'UserController@create')->name('create');
		Route::get('/edit', 'UserController@edit')->name('edit');
	});
});
<<<<<<< HEAD
*/


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


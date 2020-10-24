<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'as' => 'admin.' ], function () {
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
		Route::get('/edit/{id}', 'SpaceController@edit')->name('edit');
		Route::get('/delete/{id}', 'SpaceController@destroy')->name('delete');
		Route::post('/update/{id}', 'SpaceController@update')->name('update');
	});
	//workshops
	Route::group(['prefix' => 'workshops', 'as' => 'workshops.'], function () {
		Route::get('/', 'WorkshopController@index')->name('index');
		Route::get('/create', 'WorkshopController@create')->name('create');
		Route::get('/edit', 'WorkshopController@edit')->name('edit');

		Route::get('/delete/{id}', 'WorkshopController@destroy')->name('delete');

		Route::post('/add', 'WorkshopController@store')->name('add');

	});
	//users
	Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
		Route::get('/', 'UserController@index')->name('index');
		Route::get('/create', 'UserController@create')->name('create');

		Route::get('/edit', 'UserController@edit')->name('edit');

		Route::post('/add', 'UserController@store')->name('add');
		Route::get('/edit/{id}', 'UserController@edit')->name('edit');
		Route::post('/update/{id}', 'UserController@update')->name('update');
		

		Route::get('/delete/{id}', 'UserController@destroy')->name('delete');
	});
	//coupons
	Route::group(['prefix' => 'coupons', 'as' => 'coupons.'], function () {
		Route::get('/', 'CouponsController@index')->name('index');
		Route::get('/create', 'CouponsController@create')->name('create');
		Route::get('/edit/{id}', 'CouponsController@edit')->name('edit');
		Route::post('/update/{id}', 'CouponsController@update')->name('update');
		Route::get('/delete/{id}', 'CouponsController@destroy')->name('delete');
		Route::post('/store', 'CouponsController@store')->name('store');

	});
});


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
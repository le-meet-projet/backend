<?php

use Illuminate\Support\Facades\Auth;
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

<<<<<<< HEAD
=======
 
 

>>>>>>> e5e6045300b75ffba736a3eda2903260294bc16e
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
<<<<<<< HEAD
=======
 
>>>>>>> e5e6045300b75ffba736a3eda2903260294bc16e

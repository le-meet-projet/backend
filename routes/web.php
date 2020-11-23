<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::get('/', 'DashboardController@login');
Route::group(['prefix' => '/dashboard', 'as' => 'admin.', 'middleware' => 'Admin' ], function () {

 	Route::get('/', 'DashboardController@home');
	//orders
	Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
		Route::get('/', 'OrdersController@index')->name('index');
		Route::get('/details/{id}', 'OrdersController@show')->name('details');
		Route::get('/printdetails/{id}', 'OrdersController@print')->name('printdetails');
	});
	//spaces
	Route::group(['prefix' => 'spaces', 'as' => 'spaces.'], function () {
		Route::get('/', 'SpaceController@index')->name('index');
		Route::get('/create', 'SpaceController@create')->name('create');
		Route::get('/edit/{id}', 'SpaceController@edit')->name('edit');
		Route::get('/delete/{id}', 'SpaceController@destroy')->name('delete');
		Route::post('/update/{id}', 'SpaceController@update')->name('update');
		Route::post('/store', 'SpaceController@store')->name('store');
	});
	//workshops
	Route::group(['prefix' => 'workshops', 'as' => 'workshops.'], function () {
		Route::get('/', 'WorkshopController@index')->name('index');
		Route::get('/create', 'WorkshopController@create')->name('create');
		Route::get('/edit/{id}', 'WorkshopController@edit')->name('edit');
		Route::post('/update/{id}', 'WorkshopController@update')->name('update');
		Route::get('/delete/{id}', 'WorkshopController@destroy')->name('delete');
		Route::post('/store', 'WorkshopController@store')->name('store');

	});
	//vacations
	Route::group(['prefix' => 'vacations', 'as' => 'vacations.'], function () {
		Route::get('/', 'VacationsController@index')->name('index');
		Route::get('/create', 'VacationsController@create')->name('create');
		Route::get('/edit/{id}', 'VacationsController@edit')->name('edit');
		Route::post('/update/{id}', 'VacationsController@update')->name('update');
		Route::get('/delete/{id}', 'VacationsController@destroy')->name('delete');
		Route::post('/store', 'VacationsController@store')->name('store');

	});
	//users
	Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
		Route::get('/', 'UserController@index')->name('index');
		Route::get('/create', 'UserController@create')->name('create');
		
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
		//Route::get('/changeStatus', 'CouponsController@changeStatus')->name('changeStatus');
		Route::get('changeStatus', 'CouponsController@changeStatus');

	});
	//brands
	Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
		Route::get('/', 'BrandController@index')->name('index');
		Route::get('/create', 'BrandController@create')->name('create');
		Route::get('/edit/{id}', 'BrandController@edit')->name('edit');
		Route::post('/update/{id}', 'BrandController@update')->name('update');
		Route::get('/delete/{id}', 'BrandController@destroy')->name('delete');
		Route::post('/store', 'BrandController@store')->name('store');
		 

	});
	//reviews
	Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], function () {
		Route::get('/', 'ReviewsController@index')->name('index');
		Route::get('/edit/{id}', 'ReviewsController@edit')->name('edit');
		Route::post('/update/{id}', 'ReviewsController@update')->name('update');
		Route::get('/delete/{id}', 'ReviewsController@destroy')->name('delete');
	
		 

	});
	//profile
	Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
		Route::get('/', 'ProfileController@index')->name('index');
		Route::post('/update/{id}', 'ProfileController@update')->name('update');
	 
	
		 

	});
});


Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

<?php

use Illuminate\Support\Facades\Route;




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
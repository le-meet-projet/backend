<?php

use Illuminate\Support\Facades\Route;

Route::get('/','MerchantController@index')->name('orders');
Route::get('/hours/{id}/{date}','MerchantController@sendHours')->name('orders-hours');
Route::view('/profile','providers.profile')->name('profile');
Route::post('/profileEdit','ProfileController@profileEdit')->name('profileEdit');
Route::get('/wallet','MerchantController@wallet')->name('wallet');
Route::get('/rating','MerchantController@rating')->name('rating');
Route::get('/order/create', 'MerchantController@createOrder')->name('order.create');
Route::post('/order/store', 'MerchantController@addOrder')->name('order.store');
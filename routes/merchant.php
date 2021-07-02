<?php

use Illuminate\Support\Facades\Route;

Route::get('/','MerchantController@send')->name('orders');
Route::get('/hours/{id}/{date}','MerchantController@sendHours')->name('orders-hours');
Route::get('/profile','MerchantController@profile')->name('profile');
Route::post('/profileEdit','MerchantController@profileEdit')->name('profileEdit');
Route::get('/wallet','MerchantController@wallet')->name('wallet');
Route::get('/rating','MerchantController@rating')->name('rating');
Route::get('orders', 'MerchantController@brandOrders');
Route::post('/order-details', 'MerchantController@orderDetails');
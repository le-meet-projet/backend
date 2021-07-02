<?php

use Illuminate\Support\Facades\Route;

Route::get('/','OrdersMeetingsController@send')->name('orders');
Route::get('/hours/{id}/{date}','OrdersMeetingsController@sendHours')->name('orders-hours');
Route::get('/profile','OrdersMeetingsController@profile')->name('profile');
Route::post('/profileEdit','OrdersMeetingsController@profileEdit')->name('profileEdit');
Route::get('/wallet','OrdersMeetingsController@wallet')->name('wallet');
Route::get('/rating','OrdersMeetingsController@rating')->name('rating');
Route::get('orders', 'OrdersMeetingsController@brandOrders');
Route::post('/order-details', 'OrdersMeetingsController@orderDetails');
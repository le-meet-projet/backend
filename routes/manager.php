<?php

use Illuminate\Support\Facades\Route;

Route::get('/','ManagerController@index')->name('index');
Route::get('/hours/{id}/{date}','ManagerController@sendHours')->name('orders-hours');
Route::get('/profile','ManagerController@profile')->name('profile');
Route::post('/profileEdit','ManagerController@profileEdit')->name('profileEdit');
Route::get('/wallet','ManagerController@wallet')->name('wallet');
Route::get('/rating','ManagerController@rating')->name('rating');
Route::get('orders', 'ManagerController@brandOrders');
Route::post('/order-details', 'ManagerController@orderDetails');
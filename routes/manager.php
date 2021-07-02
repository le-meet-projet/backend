<?php

use Illuminate\Support\Facades\Route;

Route::get('/','ManagerController@index')->name('index');
Route::get('/hours/{id}/{date}','ManagerController@sendHours')->name('orders-hours');
Route::view('/profile','manager.profile')->name('profile');
Route::post('/profileEdit','ProfileController@profileEdit')->name('profileEdit');
Route::get('/wallet','ManagerController@wallet')->name('wallet');
Route::get('/rating','ManagerController@rating')->name('rating');
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/logs', function(){
    $api_log =  base_path() . '/storage/logs/api.json';
    echo json_encode(array_reverse(json_decode(file_get_contents($api_log),TRUE)));
});

Route::get('/', 'DashboardController@login');

Route::get('/payment/checkout', 'PaymentController@index');
Route::get('/payment/success', 'PaymentController@success')->name('payment.success');

Route::get('/merchant/login','OrdersMeetingsController@login')->name('merchantlogin');
Route::post('/merchant/doLogin','OrdersMeetingsController@doLogin')->name('doLogin');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

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

Route::get('/merchant/login','MerchantController@login')->name('merchant.login');
Route::post('/merchant/login','MerchantController@authenticate')->name('merchant.login');

Route::get('/manager/login','ManagerController@login')->name('manager.login');
Route::post('/manager/login','ManagerController@authenticate')->name('manager.login');

Route::post('/order-details', 'OrdersController@orderDetails');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/logs', function(){
    $api_log =  base_path() . '/storage/logs/api.json';
    echo json_encode(array_reverse(json_decode(file_get_contents($api_log),TRUE)));
});



Route::get('/zkdlld', function(){
         
    $orders = \App\OrderLeMeet::with('shared_table','meeting')->get()->map(function($model){
        
        if($model->type == 'meeting'){
            $thumbnail = $model->meeting->thumbnail;
        }elseif($model->type == 'shared_table'){
            $thumbnail = $model->meeting->thumbnail;
        }

        if($thumbnail== NULL){
            $thumbnail = no_image();
        }
        return [
            'date' =>  $model->created_at->toDateTimeString(),
            'image' => $thumbnail,
            'type' =>  $model->type,
            'description' => $model->description,
            'price' => $model->price,
            'reservationNumber' =>  $model->id,
            'rate' => '4.3 \\ 5 '
        ];
    })->toArray();

    dd($orders);
   

 dd(\DB::table('lemeet_orders')->get(),DB::table('order_unit')->get());
    //dd(\App\Meeting::paginate(10)->toArray());
});



Route::get('/', 'DashboardController@login');

Route::get('/payment/checkout', 'PaymentController@index');
Route::get('/payment/success', 'PaymentController@success')->name('payment.success');
Route::group(['prefix' => '/dashboard', 'as' => 'admin.', 'middleware' => 'Admin'], function () {

    

    Route::get('/', 'DashboardController@home');
    //orders
    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', 'OrdersController@index')->name('index');
        Route::get('/details/{id}', 'OrdersController@show')->name('details');
        Route::get('/createPDF/{id}', 'OrdersController@createPDF')->name('createPDF');
    });
    // Meetings
//    Route::group(['prefix' => 'meetings', 'as' => 'meetings.'], function  () {
//        Route::get('/', 'MeetingController@index')->name('index');
//    });
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
    //qrcode
    Route::group(['prefix' => 'qrcode', 'as' => 'qrcode.'], function () {

        Route::get('qrcode', 'QRController@generateQrCode')->name('qrcode');;


    });

    // Tables
    Route::group(['prefix' => 'tables', 'as' => 'tables.'], function () {
        Route::get('/', 'TableController@index')->name('index');
        Route::get('/create', 'TableController@create')->name('create');
        Route::post('/store', 'TableController@store')->name('store');
        Route::get('/edit/{id}', 'TableController@edit')->name('edit');
        Route::post('/update/{id}', 'TableController@update')->name('update');
        Route::get('/delete/{id}', 'TableController@delete')->name('delete');
    });
});

Route::get('/merchant/login','OrdersMeetingsController@login')->name('merchantlogin');
Route::post('/merchant/doLogin','OrdersMeetingsController@doLogin')->name('doLogin');


Route::group(['prefix' => 'merchant', 'as' => 'merchant.', 'middleware' => 'Brand'], function (){
    Route::get('/','OrdersMeetingsController@send')->name('orders');
    Route::get('/hours/{id}/{date}','OrdersMeetingsController@sendHours')->name('orders-hours');
    Route::get('/profile','OrdersMeetingsController@profile')->name('profile');
    Route::post('/profileEdit','OrdersMeetingsController@profileEdit')->name('profileEdit');
    Route::get('/wallet','OrdersMeetingsController@wallet')->name('wallet');
    Route::get('/rating','OrdersMeetingsController@rating')->name('rating');
    Route::get('orders', 'OrdersMeetingsController@brandOrders');
    Route::post('/order-details', 'OrdersMeetingsController@orderDetails');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

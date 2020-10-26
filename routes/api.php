<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('login', 'UserApiController@login');
        Route::post('register', 'UserApiController@register');
        Route::middleware(['auth:api'])->group(function () {
            Route::post('update', 'UserApiController@update');
            Route::get('', 'UserApiController@index');
            Route::get('users', 'ApiController@users');
            Route::group(['prefix' => 'favorites'], function () {
                Route::get('', 'ApiController@favorites');
                Route::get('add/{id}', 'ApiController@addSpaceToFavorite');
                Route::get('remove/{id}', 'ApiController@removeFromFavorite');
            });
            Route::group(['prefix' => 'orders'], function () {
                Route::get('', 'ApiController@orders');
                Route::get('create', 'ApiController@createOrder');
                Route::get('{id}/edit', 'ApiController@editOrder');
                Route::get('delete/{id}', 'ApiController@deleteOrder');
            });
            Route::post('orders/create', 'ApiController@request');
            Route::group(['prefix' => 'workshop'], function () {
                Route::get('', 'ApiController@userWorkshops');
                Route::post('create', 'ApiController@createWorkshop');
                Route::get('{id}/edit', 'ApiController@editWorkshop');
                Route::get('delete/{id}', 'ApiController@deleteWorkshop');
            });
        });
    });
//    Route::get('search/{id}', 'ApiController@search');
//    Route::get('find', 'ApiController@findClose');
//    Route::get('request', 'ApiController@request');
//    Route::get('index', 'ApiController@index');
//    Route::get('create', 'ApiController@create');
//    Route::get('update', 'ApiController@update');
//    Route::get('delete', 'ApiController@delete');
//    Route::get('rules', 'ApiController@rules');
//    Route::get('booking', 'ApiController@getBooking');
//    Route::get('space-details/{id}', 'ApiController@showSpaceDetails');
//    Route::get('list-feat', 'ApiController@listFeatured');
//    Route::get('apply-coupon', 'ApiController@applyCoupon');
});

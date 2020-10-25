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
        Route::middleware(['auth:api'])->post('update', 'UserApiController@update');
        Route::middleware(['auth:api'])->get('', 'UserApiController@index');
        Route::middleware(['auth:api'])->get('users', 'ApiController@user');
        Route::middleware(['auth:api'])->get('favorites', 'ApiController@favorites');
    });
    Route::get('orders', 'ApiController@orders');
    Route::get('workshops', 'ApiController@workshops');
    Route::get('search/{id}', 'ApiController@search');
    Route::get('add-to-fav/{id}', 'ApiController@addToFavorite');
    Route::get('rem-fav/{id}', 'ApiController@removeFromFavorite');
    Route::get('find', 'ApiController@findClose');
    Route::get('request', 'ApiController@request');
    Route::get('index', 'ApiController@index');
    Route::get('create', 'ApiController@create');
    Route::get('edit', 'ApiController@edit');
    Route::get('update', 'ApiController@update');
    Route::get('delete', 'ApiController@delete');
    Route::get('rules', 'ApiController@rules');
    Route::get('booking', 'ApiController@getBooking');
    Route::get('space-details/{id}', 'ApiController@showSpaceDetails');
    Route::get('list-feat', 'ApiController@listFeatured');
    Route::get('apply-coupon', 'ApiController@applyCoupon');
});

<?php

use Illuminate\Support\Facades\Route;


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

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::group(['prefix' => '/v2'], function () {
        // USER
        Route::post('register', 'Auth\ApiAuthController@register')->name('user.register');
        Route::post('login', 'Auth\ApiAuthController@login')->name('user.login');
        Route::middleware('auth:api')->group(function () {
            Route::get('/logout', 'Auth\ApiAuthController@logout')->name('user.logout');
        });

        // SPACES
        Route::group(['prefix' => 'spaces'], function () {
            Route::get('/', 'ApiController@spaces')->name('spaces.all');
            Route::middleware('auth:api')->group(function () {
                // CREATE EDIT DELETE UPDATE
                Route::post('/create', 'ApiController@createSpace')->name('spaces.create');
                Route::get('/edit/{id}', 'ApiController@edit')->name('spaces.edit');
                Route::post('/update/{id}', 'ApiController@updateSpace')->name('spaces.update');
                Route::post('/delete/{id}', 'ApiController@deleteSpace')->name('spaces.delete');
                // FAVORITE
                Route::post('/favorite/{id}', 'ApiController@addFavorite')->name('spaces.favorite.add');
                Route::post('/favorite/{id}/delete', 'ApiController@deleteFavorite')->name('spaces.favorite.delete');
                // REVIEW
                Route::post('/review/{id}', 'ApiController@addReview')->name('spaces.review.add');
                // INVITATION
                Route::group(['prefix' => 'invitation'], function () {
                    Route::post('{id}', 'ApiController@inviteUserToSpace')->name('spaces.invite.user');
                    Route::get('{id}/edit', 'ApiController@editInvitation')->name('spaces.invite.edit');
                    Route::post('{id}/update', 'ApiController@updateInvitation')->name('spaces.invite.update');
                    Route::post('/{id}/delete', 'ApiController@deleteInvitation')->name('spaces.invite.delete');
                    Route::post('/{id}/answer', 'ApiController@acceptOrDenyInvitation')->name('spaces.invite.respond');
                });
            });
            // ORDER
            Route::get('/{id}/order/details', 'ApiController@spaceOrderDetails')->name('space.order.details');
        });
    });
});

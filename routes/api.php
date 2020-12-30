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
        Route::post('otp', 'ApiController@otpConfirm')->name('otpConfirmation');
        Route::middleware('auth:api')->group(function () {
            Route::get('/logout', 'Auth\ApiAuthController@logout')->name('user.logout');
        });
        // SPACES
        Route::group(['prefix' => 'spaces'], function () {
            Route::get('/', 'ApiController@spaces')->name('spaces.all');
            Route::middleware('auth:api')->group(function () {
                // CREATE EDIT DELETE UPDATE SPACE
                Route::post('/create', 'ApiController@createSpace')->name('spaces.create');
                Route::get('/edit/{id}', 'ApiController@edit')->name('spaces.edit');
                Route::post('/update/{id}', 'ApiController@updateSpace')->name('spaces.update');
                Route::post('/delete/{id}', 'ApiController@deleteSpace')->name('spaces.delete');
                // ADD OR REMOVE FROM FAVORITE
                Route::post('/favorite/{id}', 'ApiController@addFavorite')->name('spaces.favorite.add');
                Route::post('/favorite/{id}/delete', 'ApiController@deleteFavorite')->name('spaces.favorite.delete');
                // ADD REVIEW
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
            // ORDERS
            Route::get('/{id}/order/details', 'ApiController@spaceOrderDetails')->name('space.orders.details');
            // MEETING
            Route::group(['prefix' => '/meeting'], function () {
                Route::get('/', 'ApiController@getMeetingSpaces')->name('spaces.meeting.all');
                Route::post('/sort', 'ApiController@sortMeetingSpaces')->name('spaces.meeting.sort');
                Route::post('/search', 'ApiController@searchMeetingSpaces')->name('spaces.meeting.search');
                Route::get('/{id}', 'ApiController@getMeetingId')->name('spaces.meeting.get');
                Route::get('/{id}/reviews', 'ApiController@getMeetingReviews')->name('spaces.meeting.reviews');
            });
            // WORKSHOPS
            Route::group(['prefix' => 'workshop'], function () {
                Route::get('/', 'ApiController@getWorkShopsSpaces')->name('spaces.workshops.all');
                Route::post('/sort', 'ApiController@sortWorkShops')->name('spaces.workshops.sort');
                Route::post('/search', 'ApiController@searchWorkShops')->name('spaces.workshops.search');
                Route::get('/{id}', 'ApiController@getWorkshopId')->name('spaces.workshops.get');
                Route::get('/{id}/reviews', 'ApiController@getWorkshopReviews')->name('spaces.workshops.reviews');
            });
            // OFFICE
            Route::group(['prefix' => 'office'], function () {
                Route::get('/', 'ApiController@getOfficesSpaces')->name('spaces.offices.all');
                Route::post('/sort', 'ApiController@sortOffices')->name('spaces.offices.sort');
                Route::post('/search', 'ApiController@searchOffices')->name('spaces.offices.search');
                Route::get('/{id}', 'ApiController@getOfficeId')->name('spaces.offices.get');
                Route::get('/{id}/reviews', 'ApiController@getOfficeReviews')->name('spaces.offices.reviews');
            });
            // HOLIDAY
            Route::group(['prefix' => 'holiday'], function () {
                Route::get('/', 'ApiController@getHolidaysSpaces')->name('space.holidays.all');
                Route::post('/sort', 'ApiController@sortHolidays')->name('space.holidays.all');
                Route::post('/search', 'ApiController@searchHolidays')->name('space.holidays.all');
                Route::get('/{id}', 'ApiController@getHolidayId')->name('space.holiday.all');
                Route::get('/{id}/reviews', 'ApiController@getHolidayReviews')->name('space.holiday.all');
            });
        });

        // ORDERS
        Route::group(['prefix' => 'order'], function () {
            Route::middleware('auth:api')->post('/{id}', 'ApiController@orderSpace');
            Route::get('/{id}/details', 'ApiController@orderDetails');
            Route::middleware('auth:api')->post('/payment/{id}', 'ApiController@PayOrder');
        });

        // USER
        Route::group(['middleware' => 'auth:api', 'prefix' => 'user/'], function () {
            Route::get('/profile', 'ApiController@profileUser')->name('user.profile.api');
            Route::get('/edit', 'ApiController@editUser')->name('user.edit.api');
            Route::post('/update', 'ApiController@updateUser')->name('user.update.api');
            Route::post('/update/avatar', 'ApiController@updateAvatar')->name('user.update.avatar.api');
            Route::post('/delete/{id}', 'ApiController@deleteUser')->name('user.delete.api');
            Route::get('/{id}/ads', 'ApiController@userAds')->name('user.ads.api');
            Route::get('/{id}/notifications', 'ApiController@userNotification')->name('user.notifications.api');
            Route::get('/orders', 'ApiController@userOrders')->name('user.orders.api');
            Route::get('/notification', 'ApiController@currentUserNotifications')->name('user.notifications.api');
        });
    });
});


Route::group(['middleware' => ['cors', 'json.response']], function () {

    Route::group(['prefix' => '/v3'], function () {
        // AUTH ROUTES
        Route::post('register', 'Auth\ApiAuthController@register')->name('user.register');
        Route::post('login', 'Auth\ApiAuthController@login')->name('user.login');
        Route::post('otp', 'ApiController@otpConfirm')->name('otpConfirmation');
        Route::middleware('auth:api')->group(function () {
            Route::get('/logout', 'Auth\ApiAuthController@logout')->name('user.logout');
        });


        Route::get('popular/{limit}', 'ApiController\ApiController@index');
        Route::get('favorite', 'ApiController\ApiController@favorite');



        // MEETINGS
        Route::get('meeting', 'ApiController\ApiMeetingController@index')->name('spaces.meetings.index');
        Route::get('meeting/conference', 'ApiController\ApiMeetingController@conference')->name('spaces.meetings.conference');
        Route::get('meeting/meeting', 'ApiController\ApiMeetingController@meeting')->name('spaces.meetings.meeting');


        Route::post('meeting/sort', 'ApiController\ApiMeetingController@sort')->name('spaces.meetings.sort');
        Route::get('meeting/{id}/reviews', 'ApiController\ApiMeetingController@reviews')->name('spaces.meetings.reviews');
        Route::get('meeting/{id}', 'ApiController\ApiMeetingController@getMeeting')->name('spaces.meetings.getMeeting');

        // WORKSHOPS
        Route::get('workshop', 'ApiController\ApiWorkshopController@index')->name('spaces.workshop.index');
        Route::post('workshop/sort', 'ApiController\ApiWorkshopController@sort')->name('spaces.workshop.sort');
        Route::get('workshop/{id}/reviews', 'ApiController\ApiWorkshopController@reviews')->name('spaces.workshop.reviews');
        Route::get('workshop/{id}', 'ApiController\ApiWorkshopController@getWorkshop')->name('spaces.workshop.getWorkshop');

        // OFFICES
        Route::get('office', 'ApiController\ApiOfficeController@index')->name('spaces.office.index');
        Route::post('office/sort', 'ApiController\ApiOfficeController@sort')->name('spaces.office.sort');
        Route::get('office/{id}/reviews', 'ApiController\ApiOfficeController@reviews')->name('spaces.office.reviews');
        Route::post('office/{id}', 'ApiController\ApiOfficeController@getOffice')->name('spaces.office.getOffice');

        // VACATIONS
        Route::get('vacation', 'ApiController\ApiVacationController@index')->name('spaces.vacation.index');
        Route::post('vacation/sort', 'ApiController\ApiVacationController@sort')->name('spaces.vacation.sort');
        Route::get('vacation/{id}/reviews', 'ApiController\ApiVacationController@reviews')->name('spaces.vacation.reviews');
        Route::get('vacation/{id}', 'ApiController\ApiVacationController@getVacation')->name('spaces.vacation.getVacation');

        // FAVORITES
        Route::middleware('auth:api')->group(function () {
            // ADD THE SPACE TO THE USER FAVORITE
            Route::post('favorite/{space_id}', 'ApiController\ApiFavoriteController@add')->name('favorite.space.add');
            // DELETE THE FAVORITE
            Route::get('favorite/{id}/delete', 'ApiController\ApiFavoriteController@delete')->name('favorite.space.delete');
        });
    });

});


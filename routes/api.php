<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cors', 'json.response']], function () {

    Route::group(['prefix' => '/v3'], function () {
        
        Route::post('/search/data', 'ApiController@search_data');

        Route::post('/rating/get', 'ApiController@rate');
        Route::post('/check/phoneNumber', 'ApiController@verify');
        Route::post('/filter/meeting', '\App\Filter\MeetingFilter@init');
        Route::post('/filter/office', '\App\Filter\OfficeFilter@init');
        Route::post('/filter/tables', '\App\Filter\TableFilter@init');
        Route::post('/filter/vacation', '\App\Filter\VacationFilter@init');
        Route::post('/filter/workshop', '\App\Filter\WorkshopFilter@init');
        /// new api start
        Route::post('/order/dates', 'ApiController@order_dates');
        Route::post('/coupon/verify', 'ApiController@verify_coupon');
        Route::post('/coupon/verification', 'ApiController@verify_coupon');
        Route::post('/pay/secure', 'ApiController@pay_secure');
        Route::post('/confirm/payment', 'ApiController@confirm_payment');
        Route::post('/order/cancel', 'ApiController@cancel_order');
        // Route::post('/user/orders/list', 'ApiController@user_orders_list');
        Route::post('/user/orders/list', 'ApiController@user_order');
        // new api end

        Route::get('/check/auth', 'Auth\ApiAuthController@check');

        // AUTH ROUTES
        Route::post('register', 'Auth\ApiAuthController@register')->name('user.register');
        Route::post('login', 'Auth\ApiAuthController@login')->name('user.login');
        Route::post('otp', 'ApiController@otpConfirm')->name('otpConfirmation'); 
        Route::middleware('auth:api')->group(function () {
            Route::post('/phone/invitation', 'ApiController@phone_invitation');
            Route::get('/logout', 'Auth\ApiAuthController@logout')->name('user.logout');
        });
        Route::get('popular/{limit}', 'ApiController\ApiController@index');

        // MEETINGS
        Route::get('meeting', 'ApiController\ApiMeetingController@index')->name('spaces.meetings.index');
        Route::post('meeting/conference', 'ApiController\ApiMeetingController@conference')->name('spaces.meetings.conference');
        Route::post('meeting/meeting', 'ApiController\ApiMeetingController@meeting')->name('spaces.meetings.meeting');
        Route::post('meeting/sort', 'ApiController\ApiMeetingController@sort')->name('spaces.meetings.sort');
        Route::get('meeting/{id}/reviews', 'ApiController\ApiMeetingController@reviews')->name('spaces.meetings.reviews'); // Logic Error: Don't really get reviews
        Route::get('meeting/{id}', 'ApiController\ApiMeetingController@getMeeting')->name('spaces.meetings.getMeeting');

        // SHARED TABLES
        Route::post('shared_table', 'ApiController\ApiSharedTableController@index')->name('spaces.shared_table.index');

        // WORKSHOPS
        Route::get('workshop', 'ApiController\ApiWorkshopController@index')->name('spaces.workshop.index');
        Route::post('workshop/sort', 'ApiController\ApiWorkshopController@sort')->name('spaces.workshop.sort');
        Route::get('workshop/{id}/reviews', 'ApiController\ApiWorkshopController@reviews')->name('spaces.workshop.reviews'); // Logic Error: Don't really get reviews
        Route::get('workshop/{id}', 'ApiController\ApiWorkshopController@getWorkshop')->name('spaces.workshop.getWorkshop'); 

        // OFFICES
        Route::get('office', 'ApiController\ApiOfficeController@index')->name('spaces.office.index');
        Route::post('office/sort', 'ApiController\ApiOfficeController@sort')->name('spaces.office.sort');
        Route::get('office/{id}/reviews', 'ApiController\ApiOfficeController@reviews')->name('spaces.office.reviews'); // Logic Error: Don't really get reviews
        Route::post('office/{id}', 'ApiController\ApiOfficeController@getOffice')->name('spaces.office.getOffice');

        // VACATIONS
        Route::get('vacation', 'ApiController\ApiVacationController@index')->name('spaces.vacation.index');
        Route::post('vacation/sort', 'ApiController\ApiVacationController@sort')->name('spaces.vacation.sort');
        Route::get('vacation/{id}/reviews', 'ApiController\ApiVacationController@reviews')->name('spaces.vacation.reviews'); // Logic Error: Don't really get reviews
        Route::get('vacation/{id}', 'ApiController\ApiVacationController@getVacation')->name('spaces.vacation.getVacation');

        Route::post('/details', 'ApiController@getDetails');

        Route::middleware('auth:api')->group(function () {

            Route::post('/notifications', 'ApiController@notifications');
            Route::get('/favorite/list', 'ApiController\ApiFavoriteController@list');
            Route::post('/add/to/favorite', 'ApiController\ApiFavoriteController@add_to_favorite');
            Route::post('/remove/from/favorite', 'ApiController\ApiFavoriteController@remove_from_favorite');
            Route::post('/remove/many/from/favorite', 'ApiController\ApiFavoriteController@remove_many_from_favorite');

            // ADD THE SPACE TO THE USER FAVORITE
            Route::post('favorite/{space_id}/add', 'ApiController\ApiFavoriteController@add')->name('favorite.space.add');
            // DELETE THE FAVORITE
            Route::get('favorite/{id}/delete', 'ApiController\ApiFavoriteController@delete')->name('favorite.space.delete');
            Route::group(['prefix' => 'invitation/'], function () {
                // INVITE USER TO THE SPACE
                Route::post('{space_id}', 'ApiController\ApiInvitationController@inviteUser')->name('space.invite.user'); // "Undefined variable: user" ::28
                // EDIT THE INVITATION
                Route::get('{invit_id}/edit', 'ApiController\ApiInvitationController@edit')->name('space.invite.edit');
                // UPDATE THE INVITATION
                Route::post('{invit_id}/update', 'ApiController\ApiInvitationController@update')->name('space.invite.update'); // Column user_invite 404 ::71
                // ANSWER TO THE INVITATION
                Route::post('{invit_id}/answer', 'ApiController\ApiInvitationController@answer')->name('space.invite.answer');
                // DELETE THE INVITATION
                Route::post('{invit_id}/delete', 'ApiController\ApiInvitationController@delete')->name('space.invite.delete');
            });

            // Payment routes
            Route::post('/payment/prepare', 'ApiController\PaymentController@request');
            Route::post('/payment/{id}/status', 'ApiController\PaymentController@status');
        });

        // QR CODE
        Route::post('/qrcode', 'ApiController\QrCodeController@index')->name('qr.code.index');

        // USER
        Route::group(['middleware' => 'auth:api', 'prefix' => '/user', 'as' => 'user.'], function () {
            Route::get('/profile', 'ApiController\ApiUserController@profileUser')->name('profile.api');
            Route::get('/edit', 'ApiController\ApiUserController@editUser')->name('edit.api');
            Route::post('/update', 'ApiController\ApiUserController@updateUser')->name('update.api');
            Route::post('/update/avatar', 'ApiController\ApiUserController@updateAvatar')->name('update.avatar.api');
            Route::post('/delete/{id}', 'ApiController\ApiUserController@deleteUser')->name('delete.api');
            Route::get('/{id}/ads', 'ApiController\ApiUserController@userAds')->name('ads.api'); // Ads table 404
            Route::get('/{id}/notifications', 'ApiController\ApiUserController@userNotification')->name('notifications.api'); // Notifications table 404
            Route::get('/orders', 'ApiController\ApiUserController@userOrders')->name('orders.api');
            Route::get('/notification', 'ApiController\ApiUserController@currentUserNotifications')->name('notifications.api'); // Notifications table 404
            Route::post('/review', 'ApiController@review')->name('review');
        });
    });
});

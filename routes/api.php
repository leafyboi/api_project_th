<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    // Route::post('refresh', 'AuthController@refresh');
    // Route::post('me', 'AuthController@me');
    // Route::post('payload', 'AuthController@payload');
    Route::post('register','AuthController@register');
    Route::post('forgot-password-email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('forgot-password-reset', 'Auth\ResetPasswordController@reset');
    Route::post('/reset-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/reset/password', 'Auth\ResetPasswordController@reset')->name('password.reset');

    Route::patch('/user', 'ProfileController@updateUserProfile');
    Route::get('/user}', 'ProfileController@getUserProfile');
    Route::get('/bookmarks', 'ProfileController@getUserBookmarks');
    Route::post('/bookmark', 'ProfileController@addUserBookmark');
    Route::delete('/bookmark', 'ProfileController@deleteUserBookmark');

    Route::get('/user', function (Request $request){ return $request->user(); })->middleware('auth:api');



    Route::post('/theater', 'TheaterController@addTheater');
    Route::get('/theater', 'TheaterController@getTheater');
    Route::get('/theaters', 'TheaterController@getTheaters');
    Route::delete('/theater', 'TheaterController@deleteTheater');
    Route::patch('/theater', 'TheaterController@updateTheater');

    Route::post('/spectacle', 'SpectacleController@addSpectacle');
    Route::get('/spectacle', 'SpectacleController@getSpectacle');
    Route::get('/spectacles', 'SpectacleController@getSpectacles');
    Route::delete('/spectacle', 'SpectacleController@deleteSpectacle');
    Route::patch('/spectacle', 'SpectacleController@updateSpectacle');

    Route::post('/file/theater/logo', 'UploadPhotoController@theaterLogoSave');
    Route::post('/file/theater/photo', 'UploadPhotoController@theaterPhotoSave');
    Route::post('/file/theater/preview', 'UploadPhotoController@theaterPreviewSave');
    Route::post('/file/spectacle/poster', 'UploadPhotoController@spectaclePosterSave');
    Route::post('/file/spectacle/preview', 'UploadPhotoController@spectaclePreviewSave');
    Route::post('/file/spectacle/slider-poster', 'UploadPhotoController@spectacleSliderPosterSave');
    Route::post('/file/hall/scheme', 'UploadPhotoController@hallScheme');

    Route::post('/hall', 'HallsController@addHall');
    Route::get('/hall', 'HallsController@getHall');
    Route::get('/halls', 'HallsController@getHalls');
    Route::delete('/hall', 'HallsController@deleteHall');
    Route::patch('/hall', 'HallsController@updateHall');

    Route::get('/events', 'EventsController@getEvents');
    Route::post('/event', 'EventsController@addEvent');
    Route::get('/event', 'EventsController@getEvent');
    // Route::get('/events/{event_name}/from={date_range_start}/to={date_range_end}/genre={event_genre}/age_from={event_age_start}/age_to={event_age_end}/price_from={event_price_start}/price_to={event_price_end}/duration_from={event_duration_start}/duration_to={event_duration_end}', 'EventsController@getEventss');
    Route::delete('/event', 'EventsController@deleteEvent');
    Route::patch('/event', 'EventsController@updateEvent');
    Route::get('/premieres', 'EventsController@getMainPagePremieres');


});


Route::middleware(['auth:api'])->group(function () {
    // Email Verification Routes...
    Route::post('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::post('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
});

Route::group(['namespace' => 'Profile','prefix'=>'profile'], function () {
    // Current user
    Route::group(['prefix' => 'current', 'middleware' => ['auth:api']], function () {
        Route::post('set-password', 'ProfileController@setPassword');
    });
});

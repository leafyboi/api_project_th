<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout')->middleware('auth:api');
    // Route::post('refresh', 'AuthController@refresh');
    // Route::post('me', 'AuthController@me');
    // Route::post('payload', 'AuthController@payload');
    Route::post('register','AuthController@register');
    Route::post('forgot-password-email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('forgot-password-reset', 'Auth\ResetPasswordController@reset');
    Route::post('/reset-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/reset/password', 'Auth\ResetPasswordController@reset')->name('password.reset');
    Route::get('/user', function (Request $request){ return $request->user(); })->middleware('auth:api');

    Route::get('/theater', 'TheaterController@getTheater'); // просмотр информации о театре
    Route::get('/theaters', 'TheaterController@getTheaters'); // просмотр всех театров

    Route::get('/spectacle', 'SpectacleController@getSpectacle'); // просмотр информации о спектакле
    Route::get('/spectacles', 'SpectacleController@getSpectacles'); // просмотр всех спектаклей

    Route::get('/hall', 'HallsController@getHall'); // просмотр информации о зале
    Route::get('/halls', 'HallsController@getHalls'); // просмотр информации о всех залах

    Route::get('/events', 'EventsController@getEvents'); // просмотр информации всех событий с фильтрами - removed
    Route::get('/allevents', 'EventsController@getAllEvents');  // просмотр всех событий
    Route::get('/event', 'EventsController@getEvent'); // просмотр информации о событии
    Route::get('/premieres', 'EventsController@getMainPagePremieres'); // просмотр премьер - removed

    Route::get('/socialnetwork', 'SocialNetworkController@getSocialNetwork');
    Route::get('/socialnetworks', 'SocialNetworkController@getAllSocialNetwork');

});


Route::middleware(['auth:api'])->group(function () {
    // Email Verification Routes...
    Route::post('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify'); // removed
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend'); // removed
    Route::post('email/verify', 'Auth\VerificationController@show')->name('verification.notice'); // removed

    // Theater Routes
    Route::post('/theater', 'TheaterController@addTheater'); // добавить театр
    Route::patch('/theater', 'TheaterController@updateTheater'); // изменить информацию о театре
    Route::delete('/theater', 'TheaterController@deleteTheater'); // удалить театр

    // Spectacle Routes
    Route::patch('/spectacle', 'SpectacleController@updateSpectacle'); // изменить спектакль
    Route::post('/spectacle', 'SpectacleController@addSpectacle'); // добавить спектакль
    Route::delete('/spectacle', 'SpectacleController@deleteSpectacle'); // удалить спектакль

    // Hall Routes
    Route::delete('/hall', 'HallsController@deleteHall'); // удалить зал
    Route::post('/hall', 'HallsController@addHall'); // добавить зал
    Route::patch('/hall', 'HallsController@updateHall'); // изменить зал

    // Event Routes
    Route::delete('/event', 'EventsController@deleteEvent'); // удалить событие
    Route::patch('/event', 'EventsController@updateEvent'); // изменить событие
    Route::post('/event', 'EventsController@addEvent'); // добавить событие

    // Seats Routes - unreleased
    Route::post('/seats', 'SeatsController@addSeats');

    // User Profile Routes
    Route::patch('/user', 'ProfileController@updateUserProfile'); // изменить информацию в личном профиле
    Route::get('/user', 'ProfileController@getUserProfile'); // получить
    Route::get('/bookmarks', 'ProfileController@getUserBookmarks');
    Route::post('/bookmark', 'ProfileController@addUserBookmark');
    Route::delete('/bookmark', 'ProfileController@deleteUserBookmark');

    Route::patch('/socialnetwork', 'SocialNetworkController@updateSocialNetwork');
    Route::post('/socialnetwork', 'SocialNetworkController@addSocialNetwork');
    Route::delete('/socialnetwork', 'SocialNetworkController@deleteSocialNetwork');

    // File Manager Routes
    Route::post('/file/theater/logo', 'UploadPhotoController@theaterLogoSave');
    Route::post('/file/theater/photo', 'UploadPhotoController@theaterPhotoSave');
    Route::post('/file/theater/preview', 'UploadPhotoController@theaterPreviewSave');
    Route::post('/file/spectacle/poster', 'UploadPhotoController@spectaclePosterSave');
    Route::post('/file/spectacle/preview', 'UploadPhotoController@spectaclePreviewSave');
    Route::post('/file/spectacle/slider-poster', 'UploadPhotoController@spectacleSliderPosterSave');
    Route::post('/file/hall/scheme', 'UploadPhotoController@hallScheme');

});

Route::group(['namespace' => 'Profile','prefix'=>'profile'], function () {
    // Current user
    Route::group(['prefix' => 'current', 'middleware' => ['auth:api']], function () {
        Route::post('set-password', 'ProfileController@setPassword');
    });
});

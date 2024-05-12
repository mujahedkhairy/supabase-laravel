<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::get('/profile', 'ProfileController@show')->name('api.profile.show');
    Route::put('/profile', 'ProfileController@update')->name('api.profile.update');
    Route::delete('/profile', 'ProfileController@destroy')->name('api.profile.destroy');

    // Notification routes
    Route::get('/notifications/form', 'NotificationController@showNotificationForm')->name('api.notification.form');
    Route::post('/send_notification_all', 'NotificationController@sendNotificationToAll')->name('api.notification.send_all');
});

<?php

use Illuminate\Http\Request;
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

Route::prefix('/events')->group(function () {
    Route::get('/index', 'EventController@index')->name('api.events.index');
    Route::get('/{event_id}/show', 'EventController@show')->name('api.events.show');
    Route::post('/store', 'EventController@store')->name('api.events.store');
    Route::post('/{event_id}/update', 'EventController@update')->name('api.events.update');
    Route::post('/{event_id}/destroy', 'EventController@destroy')->name('api.events.destroy');
    Route::post('/{event_id}/settlement', 'EventController@changeSettlement')->name('api.events.settlement');

    Route::prefix('/{event_id}/payments')->group(function () {
        Route::get('/', 'PaymentController@index')->name('api.payments,index');
        Route::post('/store', 'PaymentController@store')->name('api.payments.store');
        Route::post('/{payment_id}/update', 'PaymentController@update')->name('api.payments.update');
        Route::post('/{payment_id}/destroy', 'PaymentController@destroy')->name('api.payments.destroy');
    });
});

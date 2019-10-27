<?php

use Illuminate\Http\Request;

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
Route::get('bookings', 'bookingController@index');

// List single booking
Route::get('booking/{id}', 'bookingController@show');

// Create new booking
Route::post('booking', 'bookingController@store');

// Update booking
Route::put('booking', 'bookingController@store');

// Delete booking
Route::delete('booking/{id}', 'bookingController@destroy');

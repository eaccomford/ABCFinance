<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    echo 'welcome';
});

Route::group(['prefix' => 'api/'], function () {
    Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'bookings']);
    Route::post('/book/', [App\Http\Controllers\BookingController::class, 'book']);
});

//  127.0.0.1:8000/api/bookings
// 127.0.0.1:8000/api/book

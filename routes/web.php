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
    return view('auth.login');
});


Route::group(['prefix' => 'api/'], function () {
    Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'bookings']);
    Route::post('/book', [App\Http\Controllers\BookingController::class, 'book']);
});



Route::get('/new-customer', [App\Http\Controllers\CustomerController::class, 'create']);
Route::get('/new-deposit', [App\Http\Controllers\DepositController::class, 'create']);
Route::get('/new-withdrawal', [App\Http\Controllers\WithdrawalController::class, 'create']);
Route::get('/new-account', [App\Http\Controllers\AccountController::class, 'create']);

Route::get('/show-customer/{id}', [App\Http\Controllers\CustomerController::class, 'show']);
Route::get('/show-deposit/{id}', [App\Http\Controllers\DepositController::class, 'show']);
Route::get('/show-withdrawal/{id}', [App\Http\Controllers\WithdrawalController::class, 'show']);

Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index']);
Route::get('/deposits', [App\Http\Controllers\DepositController::class, 'index']);
Route::get('/withdrawals', [App\Http\Controllers\WithdrawalController::class, 'index']);
Route::get('/accounts', [App\Http\Controllers\AccountController::class, 'index']);

Route::post('/customer', [App\Http\Controllers\CustomerController::class, 'store']);
Route::post('/deposit', [App\Http\Controllers\DepositController::class, 'store']);
Route::post('/withdrawal', [App\Http\Controllers\WithdrawalController::class, 'store']);
Route::post('/account', [App\Http\Controllers\AccountController::class, 'store']);


Route::post('/new-account', [App\Http\Controllers\CustomerController::class, 'new_customer']);

//** End Points */
Route::get('/customer-statement/{id}', [App\Http\Controllers\CustomerController::class, 'statement']);
Route::get('/check-deposit/{id}', [App\Http\Controllers\DepositController::class, 'check_deposit']);
Route::get('/check-withdrawal/{id}', [App\Http\Controllers\WithdrawalController::class, 'check_withdrawal']);





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

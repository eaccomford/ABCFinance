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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => ['jwt.verify'],
    'prefix' => 'auth'

], function ($router) {
    $router->post('/new-account', [App\Http\Controllers\CustomerController::class, 'new_account']);
    $router->get('/customer-statement/{id}', [App\Http\Controllers\CustomerController::class, 'statement']);
    $router->get('/check-withdrawal/{accno}', [App\Http\Controllers\WithdrawalController::class, 'check_withdrawal']);
    $router->get('/check-deposit/{accno}', [App\Http\Controllers\DepositController::class, 'check_deposit']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
});

////
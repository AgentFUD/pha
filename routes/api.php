<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\GameController;

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

Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    // protected route just for checking if auth works
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // player routes
    Route::prefix('player')->controller(PlayerController::class)->group(function() {
        Route::post('/', 'store');
        Route::get('/{player}', 'show');
        Route::put('/{player}', 'update');
        Route::delete('/{player}', 'destroy');
    });

    Route::prefix('game')->controller(GameController::class)->group(function() {
        Route::post('/', 'uploadFile');
        Route::get('/calculate-statistics', 'calculateStatistics');
        Route::get('/get-statistics', 'getStatistics');
    });
});
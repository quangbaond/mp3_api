<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/login', [\App\Http\Controllers\Auth\Api\LoginController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\Auth\Api\RegisterController::class, 'register']);
});

Route::get('/profile', function () {
    return response()->json(['user' => auth()->user()], 200);
})->middleware('auth:api');

Route::get('withdraws', [\App\Http\Controllers\WithDrawController::class, 'index'])->middleware('auth:api');

Route::post('withdraws', [\App\Http\Controllers\WithDrawController::class, 'store'])->middleware('auth:api');

Route::post('vote', [\App\Http\Controllers\WithDrawController::class, 'vote'])->middleware('auth:api');

Route::post('users', [\App\Http\Controllers\UserController::class, 'store'])->middleware('auth:api');

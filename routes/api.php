<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TopicController;
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

Route::post('/auth/register', [AuthController::class, 'postRegister']);
Route::post('/auth/login', [AuthController::class, 'postLogin']);

Route::group(['middleware' => ['auth.jwt'], 'prefix' => 'auth'], function () {

    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/post/create', [PostController::class, 'store']);
});

Route::get('/topic', [TopicController::class, 'index']);

Route::post('/post/create', [PostController::class, 'store']);

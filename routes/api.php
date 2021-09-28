<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostCommentLikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostVoteController;
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
    Route::post('/post/create-content-post', [PostController::class, 'storeContentPost']);
    Route::post('/post/create-video-post', [PostController::class, 'storeVideoPost']);
    Route::post('/post/create-image-post', [PostController::class, 'storeImagePost']);

    Route::post('/post-vote/create', [PostVoteController::class, 'store']);
    Route::post('/post-comment/create', [PostCommentController::class, 'store']);
    Route::post('/comment-like/create', [PostCommentLikeController::class, 'store']);
});

Route::get('/topic', [TopicController::class, 'index']);

Route::post('/post/create', [PostController::class, 'store']);
Route::post('/post/create-content-post', [PostController::class, 'storeContentPost']);
Route::post('/post/create-video-post', [PostController::class, 'storeVideoPost']);
Route::post('/post/create-image-post', [PostController::class, 'storeImagePost']);

Route::get('/post', [PostController::class, 'index']);
Route::post('/post-vote/create', [PostVoteController::class, 'store']);
Route::get('/post/{id}', [PostController::class, 'show']);
Route::post('/post-comment/create', [PostCommentController::class, 'store']);
Route::post('/comment-like/create', [PostCommentLikeController::class, 'store']);

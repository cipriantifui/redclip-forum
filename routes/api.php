<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostCommentLikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Middleware\LastUserActivity;
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
Route::post('/auth/forget-password', [AuthController::class, 'forgotPasswordSendEmail']);
Route::post('/password-reset/create', [AuthController::class, 'resetPassword']);

Route::group(['middleware' => ['auth.jwt'], 'prefix' => 'auth'], function () {

    Route::any('/logout', [AuthController::class, 'logout']);
    Route::post('/post/create', [PostController::class, 'store']);
    Route::post('/post/create-content-post', [PostController::class, 'storeContentPost']);
    Route::post('/post/create-video-post', [PostController::class, 'storeVideoPost']);
    Route::post('/post/create-image-post', [PostController::class, 'storeImagePost']);

    Route::post('/vote/create', [VoteController::class, 'store']);
    Route::post('/post-comment/create', [PostCommentController::class, 'store']);
    Route::get('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    Route::post('/email/change', [UserController::class, 'changeEmail']);
});

Route::get('/topic', [TopicController::class, 'index']);
Route::get('/topic/{id}', [TopicController::class, 'show']);
Route::get('/topics', [TopicController::class, 'getTopics']);

Route::post('/post/create', [PostController::class, 'store']);
Route::post('/post/create-content-post', [PostController::class, 'storeContentPost']);
Route::post('/post/create-video-post', [PostController::class, 'storeVideoPost']);
Route::post('/post/create-image-post', [PostController::class, 'storeImagePost']);

Route::get('/post', [PostController::class, 'index']);
//Route::post('/post-vote/create', [VoteController::class, 'store']);
Route::get('/post/{id}', [PostController::class, 'show']);
Route::post('/post-comment/create', [PostCommentController::class, 'store']);
//Route::post('/comment-like/create', [PostCommentLikeController::class, 'store']);
Route::post('/vote/create', [VoteController::class, 'store']);

Route::get('/search/get-users-posts', [SearchController::class, 'getUsersAndPosts']);
Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');

Route::get('/user/details/{id}', [UserController::class, 'getUserDetails']);
Route::get('/user/posts-details/{id}/{section?}', [UserController::class, 'getUserPostsDetails']);
Route::get('/user/live-status/{id}', [UserController::class, 'getLiveStatus']);

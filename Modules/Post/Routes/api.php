<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Http\Controllers\LatestPostsController;
use Modules\Post\Http\Controllers\PostCategoryController;
use Modules\Post\Http\Controllers\PostController;
use Modules\Post\Http\Controllers\PostTagController;
use Modules\Post\Http\Controllers\PostUserController;
use Modules\Post\Http\Controllers\SubscribedPostsController;

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


Route::resource('posts', PostController::class);
Route::get('tags/{id}/posts', PostTagController::class);
Route::get('latest-posts', LatestPostsController::class);
Route::get('users/{id}/posts', PostUserController::class);
Route::get('users/subscribed-posts', SubscribedPostsController::class);
Route::get('categories/{id}/posts', PostCategoryController::class);

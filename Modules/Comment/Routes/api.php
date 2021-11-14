<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\CommentController;
use Modules\Comment\Http\Controllers\CommentUserController;
use Modules\Comment\Http\Controllers\LatestCommentsController;
use Modules\Comment\Http\Controllers\SubscribedCommentsController;

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

Route::resource('comments', CommentController::class);
Route::get('latest-comments', LatestCommentsController::class);
Route::get('users-subscribed-comments', SubscribedCommentsController::class);
Route::get('users/{id}/comments', CommentUserController::class);

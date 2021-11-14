<?php

use Illuminate\Support\Facades\Route;
use Modules\Subscribe\Http\Controllers\SubscribeController;
use Modules\Subscribe\Http\Controllers\SubscribedCategoriesController;
use Modules\Subscribe\Http\Controllers\SubscribedTagsController;
use Modules\Subscribe\Http\Controllers\SubscribedUsersController;
use Modules\Subscribe\Http\Controllers\UnsubscribeController;
use Modules\User\Http\Controllers\UserSubscribesController;

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

Route::post('subscribe', SubscribeController::class);
Route::post('unsubscribe', UnsubscribeController::class);
Route::get('users/{id}/subscribes', UserSubscribesController::class);
Route::get('users/subscribed-tags', SubscribedTagsController::class);
Route::get('users/subscribed-users', SubscribedUsersController::class);
Route::get('users/subscribed-categories', SubscribedCategoriesController::class);

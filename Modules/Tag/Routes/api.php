<?php

use Illuminate\Support\Facades\Route;
use Modules\Tag\Http\Controllers\TagController;
use Modules\Tag\Http\Controllers\TagPostController;
use Modules\Tag\Http\Controllers\TagVideoController;

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

Route::resource('tags', TagController::class);
Route::get('posts/{id}/tags', TagPostController::class);
Route::get('videos/{id}/tags', TagVideoController::class);

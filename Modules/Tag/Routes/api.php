<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagPostController;
use App\Http\Controllers\TagVideoController;

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

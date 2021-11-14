<?php

use Illuminate\Support\Facades\Route;
use Modules\Image\Http\Controllers\ImageableImageController;
use Modules\Image\Http\Controllers\ImageController;
use Modules\Image\Http\Controllers\ImageUserController;

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

Route::resource('images', ImageController::class);
Route::get('images/{id}/imageable', ImageableImageController::class);
Route::get('users/{id}/image', ImageUserController::class);

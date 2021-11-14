<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoTagController;
use Modules\Subscribe\Http\Controllers\SubscribedVideosController;
use Modules\Video\Http\Controllers\VideoController;

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


Route::get('tags/{id}/videos', VideoTagController::class);
Route::resource('videos', VideoController::class);
Route::get('users/subscribed-videos', SubscribedVideosController::class);

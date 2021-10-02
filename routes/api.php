<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\TagPostController;
use App\Http\Controllers\TagVideoController;
use App\Http\Controllers\VideoController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::resource('posts', PostController::class);
Route::resource('roles', RoleController::class);
Route::resource('categories', CategoryController::class);
Route::resource('videos', VideoController::class);
Route::resource('comments', CommentController::class);
Route::get('posts/{id}/tags', TagPostController::class);
Route::get('videos/{id}/tags', TagVideoController::class);
Route::get('categories/{id}/posts', CategoryPostController::class);
Route::get('roles/{id}/users', RoleUserController::class);
Route::get('images/{id}', RoleUserController::class);



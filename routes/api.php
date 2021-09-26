<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
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

Route::resource('posts', PostController::class);
Route::resource('roles', RoleController::class);
Route::resource('categories', CategoryController::class);
Route::get('categories/{id}/posts', [CategoryPostController::class, '__invoke']);

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});

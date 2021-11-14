<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\TopUsersController;
use Modules\User\Http\Controllers\UserController;
use Modules\User\Http\Controllers\UserRoleController;

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


Route::get('roles/{id}/users', UserRoleController::class);
Route::resource('users', UserController::class);
Route::get('top-users', TopUsersController::class);

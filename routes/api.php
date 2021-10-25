<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryDetailController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentUserController;
use App\Http\Controllers\DashBroadController;
use App\Http\Controllers\ImageableImageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImageUserController;
use App\Http\Controllers\LatestPostsController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\PostUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\SubscribedCategoriesController;
use App\Http\Controllers\SubscribedCommentsController;
use App\Http\Controllers\SubscribedPostsController;
use App\Http\Controllers\SubscribedTagsController;
use App\Http\Controllers\SubscribedUsersController;
use App\Http\Controllers\SubscribedVideosController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagPostController;
use App\Http\Controllers\TagVideoController;
use App\Http\Controllers\TopUsersController;
use App\Http\Controllers\UnsubscribeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\UserSubscribesController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoTagController;
use Illuminate\Support\Facades\Route;

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

Route::get('posts/{id}/tags', TagPostController::class);
Route::get('videos/{id}/tags', TagVideoController::class);
Route::get('tags/{id}/posts', PostTagController::class);
Route::get('tags/{id}/videos', VideoTagController::class);
Route::get('images/{id}/imageable', ImageableImageController::class);
Route::get('users/{id}/comments', CommentUserController::class);
Route::get('users/{id}/posts', PostUserController::class);
Route::get('users/{id}/image', ImageUserController::class);
Route::get('users/{id}/roles', RoleUserController::class);

Route::get('dash-broad', DashBroadController::class);
Route::get('top-users', TopUsersController::class);
Route::get('latest-posts', LatestPostsController::class);
Route::get('users/{id}/subscribes', UserSubscribesController::class);
Route::get('users/subscribed-posts', SubscribedPostsController::class);
Route::get('users/subscribed-videos', SubscribedVideosController::class);
Route::get('users/subscribed-tags', SubscribedTagsController::class);
Route::get('users/subscribed-categories', SubscribedCategoriesController::class);
Route::get('users/subscribed-comments', SubscribedCommentsController::class);
Route::get('users/subscribed-users', SubscribedUsersController::class);

Route::get('categories/{id}/posts', PostCategoryController::class);
Route::get('categoriesDetail', CategoryDetailController::class);
Route::get('roles/{id}/users', UserRoleController::class);

Route::post('unsubscribe', UnsubscribeController::class);
Route::post('subscribe', SubscribeController::class);

Route::resource('users', UserController::class);
Route::resource('posts', PostController::class);
Route::resource('roles', RoleController::class);
Route::resource('categories', CategoryController::class);
Route::resource('videos', VideoController::class);
Route::resource('comments', CommentController::class);
Route::resource('images', ImageController::class);
Route::resource('tags', TagController::class);


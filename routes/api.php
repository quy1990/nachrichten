<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\CategoryDetailController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Comment\CommentUserController;
use App\Http\Controllers\Comment\LatestCommentsController;
use App\Http\Controllers\Dashbroad\DashBroadController;
use App\Http\Controllers\Image\ImageableImageController;
use App\Http\Controllers\Image\ImageController;
use App\Http\Controllers\Image\ImageUserController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Post\LatestPostsController;
use App\Http\Controllers\Post\PostByStatusController;
use App\Http\Controllers\Post\PostCategoryController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostTagController;
use App\Http\Controllers\Post\PostUserController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Role\RoleUserController;
use App\Http\Controllers\Status\StatusController;
use App\Http\Controllers\Subscribe\SubscribeController;
use App\Http\Controllers\Subscribe\SubscribedCategoriesController;
use App\Http\Controllers\Subscribe\SubscribedCommentsController;
use App\Http\Controllers\Subscribe\SubscribedPostsController;
use App\Http\Controllers\Subscribe\SubscribedTagsController;
use App\Http\Controllers\Subscribe\SubscribedUsersController;
use App\Http\Controllers\Subscribe\SubscribedVideosController;
use App\Http\Controllers\Subscribe\UnsubscribeController;
use App\Http\Controllers\Tag\TagController;
use App\Http\Controllers\Tag\TagPostController;
use App\Http\Controllers\Tag\TagVideoController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\TopUsersController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserRoleController;
use App\Http\Controllers\User\UserSubscribesController;
use App\Http\Controllers\User\VideoController;
use App\Http\Controllers\User\VideoTagController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix'     => 'auth'

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
Route::get('statuses/{id}/posts', PostByStatusController::class);
Route::get('dash-broad', DashBroadController::class);
Route::get('top-users', TopUsersController::class);
Route::get('latest-posts', LatestPostsController::class);
Route::get('latest-comments', LatestCommentsController::class);
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
Route::resource('statuses', StatusController::class);
Route::resource('menus', MenuController::class);
Route::resource('posts', PostController::class);
Route::resource('roles', RoleController::class);
Route::resource('categories', CategoryController::class);
Route::resource('videos', VideoController::class);
Route::resource('comments', CommentController::class);
Route::resource('images', ImageController::class);
Route::resource('tags', TagController::class);


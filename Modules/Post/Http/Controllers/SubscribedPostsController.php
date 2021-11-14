<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Post\Resources\PostCollection;


class SubscribedPostsController extends Controller
{
    public function __invoke(): PostCollection
    {
        $user = auth()->user();
        return new PostCollection($user->subscribedPosts);
    }
}

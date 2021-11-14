<?php

namespace Modules\Post\Http\Controllers;

use Modules\Post\Resources\PostCollection;
use App\Http\Controllers\Controller;

;


class SubscribedPostsController extends Controller
{
    public function __invoke(): PostCollection
    {
        $user = auth()->user();
        return new PostCollection($user->subscribedPosts);
    }
}

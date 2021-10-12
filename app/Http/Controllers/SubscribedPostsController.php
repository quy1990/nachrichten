<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostCollection;


class SubscribedPostsController extends Controller
{
    public function __invoke(): PostCollection
    {
        $user = auth()->user();
        return new PostCollection($user->subscribedPosts);
    }
}

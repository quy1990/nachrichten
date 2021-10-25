<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostCollection;
use App\Models\Post;


class LatestPostsController extends Controller
{
    public function __invoke(): PostCollection
    {
        return new PostCollection(Post::paginate(5));
    }
}

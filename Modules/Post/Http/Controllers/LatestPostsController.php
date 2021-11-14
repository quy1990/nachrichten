<?php

namespace Modules\Post\Http\Controllers;

use Modules\Post\Entities\Post;
use Modules\Post\Resources\PostCollection;
use Modules\User\Http\Controllers\Controller;

;


class LatestPostsController extends Controller
{
    public function __invoke(): PostCollection
    {
        return new PostCollection(Post::paginate(5));
    }
}

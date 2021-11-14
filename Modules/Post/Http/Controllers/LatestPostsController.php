<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Post\Entities\Post;
use Modules\Post\Resources\PostCollection;


class LatestPostsController extends Controller
{
    public function __invoke(): PostCollection
    {
        return new PostCollection(Post::paginate(5));
    }
}

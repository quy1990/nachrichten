<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use App\Models\Status;

class PostByStatusController extends Controller
{
    public function __invoke(int $id): PostCollection
    {
        return new PostCollection(Status::find($id)->posts);
    }
}

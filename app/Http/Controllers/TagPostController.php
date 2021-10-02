<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagCollection;
use App\Models\Category;
use App\Models\Post;
use App\Models\Video;

class TagPostController extends Controller
{
    public function __invoke(int $id): TagCollection
    {
        return new TagCollection(Post::find($id)->tags);
    }
}

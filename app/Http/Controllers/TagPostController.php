<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagCollection;
use App\Models\Post;

class TagPostController extends Controller
{
    public function __invoke(int $id): TagCollection
    {
        return new TagCollection(Post::find($id)->tags);
    }
}

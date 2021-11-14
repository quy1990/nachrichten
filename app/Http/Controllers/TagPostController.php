<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagCollection;
use Modules\Category\Entities\Post;

class TagPostController extends Controller
{
    public function __invoke(Post $post): TagCollection
    {
        return new TagCollection($post->tags);
    }
}

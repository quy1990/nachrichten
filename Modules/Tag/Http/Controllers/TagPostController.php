<?php

namespace Modules\Tag\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagCollection;
use Modules\Post\Entities\Post;

class TagPostController extends Controller
{
    public function __invoke(Post $post): TagCollection
    {
        return new TagCollection($post->tags);
    }
}

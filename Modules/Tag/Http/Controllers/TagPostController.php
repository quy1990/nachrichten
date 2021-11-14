<?php

namespace Modules\Tag\Http\Controllers;

use App\Http\Resources\Tag\TagCollection;
use Modules\Post\Entities\Post;
use App\Http\Controllers\Controller;

class TagPostController extends Controller
{
    public function __invoke(Post $post): TagCollection
    {
        return new TagCollection($post->tags);
    }
}

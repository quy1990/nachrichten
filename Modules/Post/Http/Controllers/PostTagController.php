<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Post\Resources\PostCollection;
use Modules\Tag\Entities\Tag;


class PostTagController extends Controller
{
    public function __invoke(int $id): PostCollection
    {
        return new PostCollection(Tag::find($id)->posts);
    }
}

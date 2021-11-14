<?php

namespace Modules\Post\Http\Controllers;

use Modules\Post\Resources\PostCollection;
use Modules\Tag\Entities\Tag;
use Modules\User\Http\Controllers\Controller;

;


class PostTagController extends Controller
{
    public function __invoke(int $id): PostCollection
    {
        return new PostCollection(Tag::find($id)->posts);
    }
}

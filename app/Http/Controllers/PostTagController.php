<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostCollection;
use Modules\Category\Entities\Tag;


class PostTagController extends Controller
{
    public function __invoke(int $id): PostCollection
    {
        return new PostCollection(Tag::find($id)->posts);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostCollection;
use App\Models\Tag;


class PostTagController extends Controller
{
    public function __invoke(Tag $tag): PostCollection
    {
        return new PostCollection($tag->posts);
    }
}

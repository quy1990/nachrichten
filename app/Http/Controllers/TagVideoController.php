<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagCollection;
use App\Models\Category;
use App\Models\Video;

class TagVideoController extends Controller
{
    public function __invoke(int $id): TagCollection
    {
        return new TagCollection(Video::find($id)->tags);
    }
}

<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagCollection;
use App\Models\Video;

class TagVideoController extends Controller
{
    public function __invoke(Video $video): TagCollection
    {
        return new TagCollection($video->tags);
    }
}

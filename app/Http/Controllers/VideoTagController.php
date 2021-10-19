<?php

namespace App\Http\Controllers;

use App\Http\Resources\Video\VideoCollection;
use App\Models\Tag;

class VideoTagController extends Controller
{
    public function __invoke(Tag $tag): VideoCollection
    {
        return new VideoCollection($tag->videos);
    }
}

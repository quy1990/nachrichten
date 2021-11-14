<?php

namespace App\Http\Controllers;

use App\Http\Resources\Video\VideoCollection;
use Modules\Category\Entities\Tag;

class VideoTagController extends Controller
{
    public function __invoke(Tag $tag): VideoCollection
    {
        return new VideoCollection($tag->videos);
    }
}

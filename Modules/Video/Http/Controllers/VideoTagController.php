<?php

namespace App\Http\Controllers;

use Modules\Category\Entities\Tag;
use Modules\Video\Resources\VideoCollection;

class VideoTagController extends Controller
{
    public function __invoke(Tag $tag): VideoCollection
    {
        return new VideoCollection($tag->videos);
    }
}

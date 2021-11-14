<?php

namespace Modules\Video\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Tag\Entities\Tag;
use Modules\Video\Resources\VideoCollection;

class VideoTagController extends Controller
{
    public function __invoke(Tag $tag): VideoCollection
    {
        return new VideoCollection($tag->videos);
    }
}

<?php

namespace Modules\Tag\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagCollection;
use Modules\Video\Entities\Video;

class TagVideoController extends Controller
{
    public function __invoke(Video $video): TagCollection
    {
        return new TagCollection($video->tags);
    }
}

<?php

namespace Modules\Tag\Http\Controllers;

use App\Http\Resources\Tag\TagCollection;
use App\Http\Controllers\Controller;
use Modules\Video\Entities\Video;

class TagVideoController extends Controller
{
    public function __invoke(Video $video): TagCollection
    {
        return new TagCollection($video->tags);
    }
}

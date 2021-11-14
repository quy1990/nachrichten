<?php

namespace App\Http\Controllers;

use App\Http\Resources\Tag\TagCollection;
use Modules\Category\Entities\Video;

class TagVideoController extends Controller
{
    public function __invoke(Video $video): TagCollection
    {
        return new TagCollection($video->tags);
    }
}

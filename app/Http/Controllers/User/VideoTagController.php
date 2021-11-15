<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Video\VideoCollection;
use App\Models\Tag;

class VideoTagController extends Controller
{
    public function __invoke(Tag $tag): VideoCollection
    {
        return new VideoCollection($tag->videos);
    }
}
